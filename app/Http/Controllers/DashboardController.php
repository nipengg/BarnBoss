<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Rating;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::where('owner_id', Auth::user()->id)->get();
        return view('admin.product.dashboard', ['products' => $products]);
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.product.create', ['categories' => $categories]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'max:2000|mimes:jpeg,jpg,png,webp'
        ]);

        $data = $request->all();
        if ($file = $request->file('image')) {
            $destinationPath = 'file/';
            $fileInput = date('YmdHis') . "." . $file->getClientOriginalExtension();
            $file->move($destinationPath, $fileInput);
            $data['image'] = $fileInput;
        }

        Product::create($data);
        return redirect()->route('admin')->with('success_message', 'Success!');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();

        return view('admin.product.edit', ['product' => $product, 'categories' => $categories]);
    }

    public function update($id, Request $request)
    {
        $data = $request->all();

        $item = Product::findOrFail($id);

        if ($file = $request->file('image')) {

            // Delete Old File
            $file_path = public_path() . '/file/' . $item['image'];
            File::delete($file_path);

            // Update New File
            $destinationPath = 'file/';
            $fileInput = date('YmdHis') . "." . $file->getClientOriginalExtension();
            $file->move($destinationPath, $fileInput);
            $data['image'] = $fileInput;
        }

        $item->update($data);

        return redirect()->route('admin')->with('success_message', 'Success!');
    }

    public function destroy($id)
    {
        $data = Product::findOrFail($id);
        $file_path = public_path() . '/file/' . $data['image'];
        File::delete($file_path);
        $data->delete();

        return redirect()->route('admin')->with('success_message', 'Success!');
    }

    public function productDetail($id)
    {
        $product = Product::where('id', $id)->firstOrFail();
        $invoice = Invoice::where('product_id', $product->id)->get();
        $sumPoint = 0; $enjoyProduct = 0; $countRating = 0; $avg = 0; $enjoyPercentage = 0; $ratings = [];
        
        foreach ($invoice as $item) {
            $rating = Rating::where('invoice_id', $item->id)->first();
            if (!empty($rating))
            {
                if ($rating->rating >= 3) $enjoyProduct++;
                $sumPoint += $rating->rating;
                $countRating++;
                $ratings[] = $rating;
            }
        }

        if ($countRating != 0)
        {
            $avg = $sumPoint / $countRating;
            $enjoyPercentage = ($enjoyProduct / $countRating) * 100;
        }

        return view('product-detail', [
            'product' => $product, 
            'countRating' => $countRating, 
            'avg' => $avg, 
            'percentage' => $enjoyPercentage,
            'ratings' => $ratings
        ]);
    }
}
