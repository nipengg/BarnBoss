<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Product;
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
            $total = $total + $item->total;
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
}
