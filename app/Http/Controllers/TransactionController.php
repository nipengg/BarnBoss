<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Product;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Invoice::where('user_id', Auth::user()->id)->distinct()->get(['invoice_id']); 
        return view('transactions.index', ['transactions' => $transactions]);
    }

    public function detail($id)
    {
        $transactions = Invoice::where('invoice_id', $id)->get();
        $total = 0;
        foreach ($transactions as $item) {
            $total = $total + ($item->total * $item->qty);
        }
        return view('transactions.detail', ['transactions' => $transactions, 'id' => $id, 'total' => $total]);
    }

    public function order()
    {
        $products = Product::where('owner_id', Auth::user()->id)->get();
        $orders = null;
        
        foreach ($products as $item) {
            $orders[] = Invoice::where('product_id', $item->id)->get();
        }
        // dd($orders);

        return view('transactions.order', ['orders' => $orders]);
    }

    public function rating($id)
    {
        $rating = Rating::where('invoice_id', $id)->first();
    
        $invoice = Invoice::where('id', $id)->firstOrFail();
        return view('transactions.rating', ['invoice' => $invoice, 'rating' => $rating]);
    }

    public function storeRating($id, Request $request)
    {
        $data = $request->all();

        Rating::create([
            'invoice_id' => $id,
            'rating' => $data['rating'],
            'comment' => $data['comment'],
        ]);

        return redirect()->route('transaction.rating', $id);
    }

    public function updateRating($id, Request $request)
    {
        $data = $request->all();

        // dd($data);

        Rating::where('id', $id)->update([
            'rating' => $data['rating'],
            'comment' => $data['comment'],
        ]);

        return redirect()->route('transaction.rating', $data['invoice']);
    }

    public function updateStatus($id, Request $request)
    {   
        $data = $request->all();
        Invoice::where('invoice_id', $id)->update([
            'status' => $data['status']
        ]);

        return redirect()->route('order');
    }
}
