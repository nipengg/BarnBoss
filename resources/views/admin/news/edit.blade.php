@extends('layouts.app')

@section('content')

    <!-- Begin Page Content -->
    <div class="container" style="margin-top: 80px">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Edit {{ $news->title }}</h1>
            <a href="{{ route('news') }}" class="btn btn-sm btn-danger shadow-sm">
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
                <form action="{{ route('news.update', $news->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="title">News Title</label>
                        <input type="text" class="form-control" name="title" placeholder="Title"
                            value="{{ $news->title }}" required>
                    </div>
                    <div class="form-group">
                        <label for="description">News Description</label>
                        <textarea class="form-control" name="description" id="description" cols="30" rows="2" placeholder="Description" required>{{ $news->description }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="images">Image</label>
                        <input type="file" class="form-control" name="images" placeholder="Image">
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
