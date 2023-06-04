@extends('layouts.app')

@section('content')

    <!-- Begin Page Content -->
    <div class="container" style="margin-top: 80px">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Edit {{ $seller->name }}</h1>
            <a href="{{ route('seller') }}" class="btn btn-sm btn-danger shadow-sm">
                Back
            </a>
        </div>

        @if (session('error_message'))
            <div class="alert alert-danger">
                {{ session('error_message') }}
            </div>
        @endif

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
                <form action="{{ route('seller.update', $seller->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="name">Seller Name</label>
                        <input type="text" class="form-control" value="{{ $seller->name }}" name="name" placeholder="Name"
                            value="{{ old('name') }}">
                    </div>
                    <div class="form-group">
                        <label for="email">Seller email</label>
                        <input type="email" class="form-control" value="{{ $seller->email }}" name="email" placeholder="Email"
                            value="{{ old('email') }}">
                    </div>
                    <div class="form-group">
                        <label for="phone">Seller phone</label>
                        <input type="number" class="form-control" value="{{ $seller->phone }}" name="phone" placeholder="Phone Number"
                            value="{{ old('phone') }}">
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
