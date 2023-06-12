@extends('layouts.app')

@section('content')

    <head>
        <script src="js/jquery.min.js" type="text/javascript"></script>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.0/css/jquery.dataTables.css" defer>
        <script src="http://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js" defer></script>
    </head>

    <div class="container table-responsive" style="margin-top: 80px">
        @if (session('success_message'))
            <div class="alert alert-success">
                {{ session('success_message') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Manage My Product</h1>
            <a href="{{ route('product.create') }}" class="btn btn-sm btn-primary shadow-sm">
                <i class="fa fa-plus"></i> Add Product
            </a>
        </div>

        <table id="myTable" class="table table-image table-bordered">
            <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Price</th>
                    <th scope="col">Qty</th>
                    <th scope="col">Category</th>
                    <th scope="col">Weight & Length</th>
                    <th scope="col">Color</th>
                    <th scope="col">Location</th>
                    <th scope="col">Health History</th>
                    <th scope="col">Image</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td>{{ $product->name }}</td>
                        <td>@currency($product->price)</td>
                        <td>{{ $product->quantity }}</td>
                        <td>{{ $product->category->name }}</td>
                        <td>{{ $product->weight }}kg & {{ $product->length }}m</td>
                        <td>{{ $product->color }}</td>
                        <td>{{ $product->location }}</td>
                        <td>{{ $product->health_history }}</td>
                        <td><img src="{{ URL::asset('/file/' . @$product->image) }}" class="card-img-top mx-auto"
                                style="width: 150px;display: block;" alt="{{ $product->image }}"></td>
                        <td>
                            <a href="{{ route('product.edit', $product->id) }}" class="btn btn-info">
                                <i class="fa fa-pencil"></i>
                            </a>
                            <form action="{{ route('product.destroy', $product->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button class="btn btn-danger">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>
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
