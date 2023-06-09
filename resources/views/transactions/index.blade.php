@extends('layouts.app')

@section('content')

    <head>
        <script src="js/jquery.min.js" type="text/javascript"></script>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.0/css/jquery.dataTables.css" defer>
        <script src="http://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js" defer></script>
    </head>

    <div class="container table-responsive" style="margin-top: 80px">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">My Transaction &nbsp; <a target="_blank" href="{{ url('allpdf') }}" class="btn btn-secondary">Export PDF</a></h1>
        </div>

        <table id="myTable" class="table table-image table-bordered">
            <thead>
                <tr>
                    <th scope="col">#ID</th>
                    <th scope="col">Chat</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transactions as $item)
                    <tr>
                        <td>{{ $item->invoice_id }}</td>
                        <td><a href="{{ route('chat', $item->invoice_id) }}" class="btn btn-secondary">Chat Seller</a></td>
                        <td>
                            <a href="{{ route('transaction.detail', $item->invoice_id) }}" class="btn btn-info">
                                View
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script>
        $(function() {
            $('#myTable').DataTable();
        })
    </script>
@endsection
