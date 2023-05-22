@extends('layouts.app')

@section('content')

    <head>
        <script src="js/jquery.min.js" type="text/javascript"></script>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.0/css/jquery.dataTables.css" defer>
        <script src="http://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js" defer></script>
    </head>

    <div class="container table-responsive" style="margin-top: 80px">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">My Order</h1>
        </div>

        <table id="myTable" class="table table-image table-bordered">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Customer Name</th>
                    <th scope="col">Product name</th>
                    <th scope="col">Qty</th>
                    <th scope="col">Total</th>
                    <th scope="col">Status Order</th>
                    <th scope="col">Order Date</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @if ($orders != null)
                    @foreach ($orders as $p)
                        @foreach ($p as $item)
                            <tr>
                                <td>{{ $item->invoice_id }}</td>
                                <td>{{ $item->user->name }}</td>
                                <td>{{ $item->product->name }}</td>
                                <td>{{ $item->qty }}</td>
                                <td>@currency($item->total)</td>
                                <td>{{ $item->status }}</td>
                                <td>{{ $item->created_at }}</td>
                                <td>
                                    <a href="" class="btn btn-info">
                                        Edit order status
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>

    <script>
        $(function() {
            $('#myTable').DataTable();
        })
    </script>
@endsection
