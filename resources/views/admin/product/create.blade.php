@extends('layouts.app')

@section('content')

    <!-- Begin Page Content -->
    <div class="container" style="margin-top: 80px">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Add Product</h1>
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
                <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="owner_id" value={{ Auth::user()->id }}>
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" name="name" placeholder="Name"
                            value="{{ old('name') }}" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Description (Optional)</label>
                        <textarea class="form-control" name="description" id="description" cols="30" rows="2" placeholder="Description">{{ old('description') }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="price">Price</label>
                        <input type="number" class="form-control" name="price" placeholder="Price"
                            value="{{ old('price') }}" required>
                    </div>
                    <div class="form-group">
                        <label for="weight">Weight</label>
                        <input type="number" class="form-control" name="weight" placeholder="Weight"
                            value="{{ old('weight') }}" required>
                    </div>
                    <div class="form-group">
                        <label for="length">Length</label>
                        <input type="number" class="form-control" name="length" placeholder="Length"
                            value="{{ old('length') }}" required>
                    </div>
                    <div class="form-group">
                        <label for="color">Color</label>
                        <input type="text" class="form-control" name="color" placeholder="Color"
                            value="{{ old('color') }}" required>
                    </div>
                    <div class="form-group">
                        <label for="location">Location</label>
                        <input type="text" class="form-control" name="location" placeholder="Location"
                            value="{{ old('location') }}" required>
                    </div>
                    <div class="form-group">
                        <label for="health_history">Health History</label>
                        <input type="text" class="form-control" name="health_history" placeholder="Health History"
                            value="{{ old('health_histor') }}" required>
                    </div>
                    <div class="form-group">
                        <label for="quantity">Quantity</label>
                        <input type="number" class="form-control" name="quantity" placeholder="Quantity"
                            value="{{ old('quantity') }}" required>
                    </div>
                    <div class="form-group">
                        <label for="category_id">Category</label>
                        <select name="category_id" required class="form-control" required>
                            <option value="">Choose Category</option>
                            @foreach ($categories as $c)
                                <option value="{{ $c->id }}">{{ $c->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="image">Image</label>
                        <input type="file" class="form-control" name="image" placeholder="Image" required>
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
