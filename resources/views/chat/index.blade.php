@extends('layouts.app')

@section('content')

    <head>
        <script src="js/jquery.min.js" type="text/javascript"></script>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.0/css/jquery.dataTables.css" defer>
        <script src="http://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js" defer></script>
    </head>

    <div class="container table-responsive" style="margin-top: 80px">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Transaction Chat #{{ $invoice }}</h1>
        </div>

        <table id="myTable" class="table table-image table-bordered">
            <thead>
                <tr>
                    <th scope="col">Seller</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($chats as $item)
                    <tr>
                        <td>{{ $item->seller->name }}</td>
                        <td><a href="{{ route('room', $item->id) }}" class="btn btn-secondary">Chat</a></td>
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
