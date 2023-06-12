@extends('layouts.app')

@section('content')
    <div class="container" style="margin-top: 80px">
        @if (session()->has('success_msg'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session()->get('success_msg') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
        @endif
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Products</li>
            </ol>
        </nav>
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                @foreach ($news as $key => $item)
                    <li data-target="#carouselExampleIndicators" data-slide-to="{{ $key }}"
                        class="{{ $loop->iteration == 1 ? 'active' : '' }}"></li>
                @endforeach
            </ol>
            <div class="carousel-inner">
                @foreach ($news as $item)
                    <div class="carousel-item {{ $loop->iteration == 1 ? 'active' : '' }}">
                        <img class="d-block w-100" src="{{ URL::asset('/file/' . @$item->images) }}" style="height: 25vh;"
                            alt="First slide">
                        <div class="carousel-caption d-none d-md-block">
                            <h5>{{ $item->title }}</h5>
                            <p>{{ $item->description }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
        <br />
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-7">
                        <h4>All Product</h4>
                        <div class="row">
                            <div class="col">
                                <input class="form-control" value="{{ $search }}" type="text" name="search"
                                    id="search" placeholder="Search...">
                            </div>
                            <div class="col">
                                <select name="category" id="category" class="form-control" onchange="handleSelectChange()">
                                    <option value="All" {{ $category == 'All' ? 'selected' : '' }}>All</option>
                                    @foreach ($categories as $item)
                                        <option value={{ $item->name }} {{ $category == $item->name ? 'selected' : '' }}>
                                            {{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    @foreach ($products as $pro)
                        <div class="col-lg-3">
                            <div class="card" style="margin-bottom: 20px; height: 300px;">
                                <img src="file/{{ $pro->image }}" class="card-img-top mx-auto"
                                    style="margin-top: 20px; width: 150px; display: block;" alt="{{ $pro->image }}">
                                <div class="card-body">
                                    <a href="{{ route('product.detail', $pro->id) }}">
                                        <h6 class="card-title">{{ $pro->name }}</h6>
                                    </a>
                                    <p>{{ $pro->owner->name }}</p>
                                    <p>@currency($pro->price) | Stock: {{ $pro->quantity }}</p>

                                    <form action="{{ route('cart.store') }}" method="POST">
                                        {{ csrf_field() }}
                                        <input type="hidden" value="{{ $pro->id }}" id="id" name="id">
                                        <input type="hidden" value="{{ $pro->name }}" id="name" name="name">
                                        <input type="hidden" value="{{ $pro->price }}" id="price" name="price">
                                        <input type="hidden" value="{{ $pro->image }}" id="img" name="img">
                                        <input type="hidden" value="1" id="quantity" name="quantity">
                                        <div class="card-footer" style="background-color: white;">
                                            <div class="row">
                                                @if (Auth::user()->role != 1)
                                                    <button class="btn btn-secondary btn-sm" class="tooltip-test"
                                                        title="add to cart">
                                                        Add to cart
                                                    </button>
                                                @endif
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        function handleSelectChange(event) {
            if ($("#category").val() != 'All') {
                window.location.href = "{{ url('/dashboard/?category=') }}" + $("#category").val();
            } else {
                window.location.href = "{{ url('/dashboard/') }}";
            }
        }

        var input = document.getElementById("search");

        input.addEventListener("keypress", function(event) {
            if (event.keyCode == 13) {
                window.location.href = "{{ url('/dashboard/?search=') }}" + $("#search").val();
            }
        });
    </script>
@endsection
