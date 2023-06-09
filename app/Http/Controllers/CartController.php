<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\Chat;
use App\Models\News;

class CartController extends Controller
{
    public function shop(Request $request)
    {
        $category = $request->category;
        $search = $request->search;
        $news = News::all();

        // dd($search);

        if ($category != NULL) {
            $find = Category::where('name', $category)->firstOrFail();
            $products = Product::where('quantity', '>', 0)->where('category_id', $find->id)->get();
        } else if ($search != NULL) {
            $products = Product::where('quantity', '>', 0)->where('name', 'LIKE', '%' . $search . '%')->get();
        } else {
            $category = 'All';
            $search = '';
            $products = Product::where('quantity', '>', 0)->get();
        }
        $categories = Category::all();
        return view('shop')->with([
            'products' => $products,
            'categories' => $categories,
            'category' => $category,
            'search' => $search,
            'news' => $news
        ]);
    }

    public function cart()
    {
        $cartCollection = \Cart::getContent();
        // dd($cartCollection);
        return view('cart')->with(['cartCollection' => $cartCollection]);;
    }

    public function add(Request $request)
    {
        $product = Product::findOrFail($request->id);
        $cartCollection = \Cart::getContent($request->id);

        $stock = 0;

        foreach ($cartCollection as $c) {
            if ($c['id'] == $request->id) {
                $stock = $c['quantity'];
            }
        }

        $max_stock = $request->quantity + $stock;

        if ($product['quantity'] < $max_stock) {
            return redirect()->route('cart.index')->with('alert_msg', 'Stock not Ready');
        } else {
            \Cart::add(array(
                'id' => $request->id,
                'name' => $request->name,
                'price' => $request->price,
                'quantity' => $request->quantity,
                'attributes' => array(
                    'image' => $request->img,
                )
            ));
            return redirect()->route('cart.index')->with('success_msg', 'Item is Added to Cart!');
        }
    }

    public function remove(Request $request)
    {
        \Cart::remove($request->id);
        return redirect()->route('cart.index')->with('success_msg', 'Item is removed!');
    }

    public function update(Request $request)
    {
        $product = Product::findOrFail($request->id);

        if ($product['quantity'] < $request->quantity) {
            return redirect()->route('cart.index')->with('alert_msg', 'Stock not Ready');
        } else {
            \Cart::update(
                $request->id,
                array(
                    'quantity' => array(
                        'relative' => false,
                        'value' => $request->quantity
                    ),
                )
            );
            return redirect()->route('cart.index')->with('success_msg', 'Cart is Updated!');
        }
    }

    public function clear()
    {
        \Cart::clear();
        return redirect()->route('cart.index')->with('success_msg', 'Cart is cleared!');
    }

    public function store()
    {
        $cartCollection = \Cart::getContent();
        $date = Carbon::now()->toDateTimeString();
        $userId = Auth::user()->id;
        $in = uniqid();
        $arr = [];

        foreach ($cartCollection as $item) {
            $product = Product::where("id", $item['id'])->firstOrFail();

            DB::insert("
                    INSERT INTO invoices
                    (invoice_id, product_id, qty, total, user_id, created_at, updated_at)
                    VALUES (?, ?, ?, ?, ?, ?, ?)
            ", [$in, $item['id'], $item['quantity'], $item['price'], $userId, $date, $date]);

            DB::update("
                UPDATE products
                SET quantity = quantity - ?
                WHERE id = ?
            ", [$item['quantity'], $item['id']]);

            if (in_array($product->owner->id, $arr)) {
                continue;
            } else {
                Chat::create([
                    "seller_id" => $product->owner->id,
                    "user_id" => $userId,
                    "invoice_id" => $in
                ]); 
            }
            $arr[] = $product->owner->id;
        }
        \Cart::clear();
        DB::commit();
        return redirect()->route('transaction');
    }
}
