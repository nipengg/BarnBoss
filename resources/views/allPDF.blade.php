<!DOCTYPE html>
<html>

<head>
    <title>Data Transaksi</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <style type="text/css">
        table tr td,
        table tr th {
            font-size: 9pt;
        }
    </style>

    <center>
        <h5>Struk</h5>
        <h5></h5>
    </center>

    @foreach ($invoices as $in)
        <h4>Invoice #{{ $in->invoice_id }}</h4>
        <table id="table_id" class="table table-sm">
            <thead>
                <tr>
                    <th>Nama Produk</th>
                    <th>Harga</th>
                    <th>Qty</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($items as $item)
                    @if ($in->invoice_id == $item->invoice_id)
                        <tr>
                            <td>{{ $item->product->name }}</td>
                            <td>@currency($item->product->price)</td>
                            <td>{{ $item->qty }}</td>
                            <td>@currency($item->product->price * $item->qty)</td>
                        </tr>
                    @endif
                @endforeach
                <tr>
                    <?php 
                        $subtotal = 0;
                        foreach ($items as $item) {
                            if ($in->invoice_id == $item->invoice_id) {
                                $subtotal = $subtotal + ($item->total * $item->qty);
                            }
                        }
                    ?>
                    <td colspan="6" style="text-align: center; font-weight: bold; font-size: 12pt">Grand Total : @currency($subtotal)</td>
                </tr>
            </tbody>
        </table>
    @endforeach
    <br>
    <h3 style="text-align: center; font-weight: bold;">Grand Total :
        @currency($total)</h3>
</body>

</html>
