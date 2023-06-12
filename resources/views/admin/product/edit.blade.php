@extends('layouts.app')

@section('content')

    <!-- Begin Page Content -->
    <div class="container" style="margin-top: 80px">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Edit Product</h1>
            <a href="{{ route('admin') }}" class="btn btn-sm btn-danger shadow-sm">
                Back
            </a>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card shadow">
            <div class="card-body">
                <form action="{{ route('product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" name="name" placeholder="Name"
                            value="{{ $product->name }}" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" name="description" id="description" cols="30" rows="2" placeholder="Description">{{ $product->description }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="price">Price</label>
                        <input type="number" class="form-control" name="price" placeholder="Price"
                            value="{{ $product->price }}" required>
                    </div>
                    <div class="form-group">
                        <label for="weight">Weight</label>
                        <input type="number" class="form-control" name="weight" placeholder="Weight"
                            value="{{ $product->weight }}" required>
                    </div>
                    <div class="form-group">
                        <label for="length">Length</label>
                        <input type="number" class="form-control" name="length" placeholder="Length"
                            value="{{ $product->length }}" required>
                    </div>
                    <div class="form-group">
                        <label for="color">Color</label>
                        <input type="text" class="form-control" name="color" placeholder="Color"
                            value="{{ $product->color }}" required>
                    </div>
                    <div class="form-group">
                        <label for="location">Location</label>
                        <input type="text" class="form-control" name="location" placeholder="Location"
                            value="{{ $product->location }}" required>
                    </div>
                    <div class="form-group">
                        <label for="health_history">Health History</label>
                        <input type="text" class="form-control" name="health_history" placeholder="Health History"
                            value="{{ $product->health_history }}" required>
                    </div>
                    <div class="form-group">
                        <label for="quantity">Quantity</label>
                        <input type="number" class="form-control" name="quantity" placeholder="Quantity"
                            value="{{ $product->quantity }}" required>
                    </div>
                    <div class="form-group">
                        <label for="category_id">Category</label>
                        <select name="category_id" required class="form-control">
                            <option value="{{ $product->category_id }}">Jangan diubah</option>
                            @foreach ($categories as $c)
                                <option value="{{ $c->id }}">{{ $c->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="image">Image</label>
                        <input type="file" class="form-control" name="image" placeholder="Image">
                    </div>
                    <button class="btn btn-primary btn-block" type="submit">
                        Simpan
                    </button>
                </form>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

@endsection
