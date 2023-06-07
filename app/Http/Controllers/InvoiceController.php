<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\Invoice;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class InvoiceController extends Controller
{
    public function genPDF($in)
    {
        $items = Invoice::where('invoice_id', $in)->get();
        $total = 0;

        foreach ($items as $item)
        {
            $subtotal = $item->total * $item->qty;
            $total = $total + $subtotal;
        }

        $data = [
            'items' => $items,
            'invoice' => $in,
            'total' => $total,
            'date' => date('m/d/Y'),
        ];

        $pdf = PDF::loadView('myPDF', $data);

        return $pdf->stream();
    }

    public function genAllPDF()
    {
        $items = Invoice::where('user_id', Auth::user()->id)->get();
        $subtotal = 0;
        $total = 0;

        foreach ($items as $item)
        {
            $subtotal = $item->total * $item->qty;
            $total = $total + $subtotal;
        }

        $invoices = DB::table('invoices')->select('invoice_id')->where('user_id', Auth::user()->id)->distinct()->get();

        $data = [
            'items' => $items,
            'invoices' => $invoices,
            'total' => $total,
            'subtotal' => $subtotal,
            'date' => date('m/d/Y'),
        ];

        $pdf = PDF::loadView('allPDF', $data);

        return $pdf->stream();
    }
}
