@extends('layouts.app')

@section('content')

    <head>
        <script src="js/jquery.min.js" type="text/javascript"></script>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.0/css/jquery.dataTables.css" defer>
        <script src="http://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js" defer></script>
    </head>

    <div class="container table-responsive" style="margin-top: 80px">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Transaction Detail #{{ $id }} &nbsp; <a target="_blank" href="{{ url('pdf', $id) }}" class="btn btn-secondary">Export PDF</a></h1>
        </div>

        <table id="myTable" class="table table-image table-bordered">
            <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">Price</th>
                    <th scope="col">Qty</th>
                    <th scope="col">Category</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transactions as $item)
                    <tr>
                        <td>{{ $item->product->name }}</td>
                        <td>{{ $item->product->description }}</td>
                        <td>@currency($item->product->price)</td>
                        <td>{{ $item->qty }}</td>
                        <td>{{ $item->product->category->name }}</td>
                        <td>{{ $item->status }}</td>
                        <td>
                            <a href="{{ route('transaction.rating', $item->id) }}" class="btn {{ $item->status != 'Done' ? 'btn-danger disabled' : 'btn-info' }}">
                                Give Rating
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <td colspan="7">Total : @currency($total)</td>
            </tfoot>
        </table>
    </div>

    <script>
        $(function() {
            $('#myTable').DataTable();
        })
    </script>
@endsection
