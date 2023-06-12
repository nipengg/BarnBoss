@extends('layouts.app')

@section('content')

    <head>
        <style>
            body {
                overflow-x: hidden;
            }

            img {
                max-width: 100%;
            }

            .preview {
                display: -webkit-box;
                display: -webkit-flex;
                display: -ms-flexbox;
                display: flex;
                -webkit-box-orient: vertical;
                -webkit-box-direction: normal;
                -webkit-flex-direction: column;
                -ms-flex-direction: column;
                flex-direction: column;
            }

            @media screen and (max-width: 996px) {
                .preview {
                    margin-bottom: 20px;
                }
            }

            .preview-pic {
                -webkit-box-flex: 1;
                -webkit-flex-grow: 1;
                -ms-flex-positive: 1;
                flex-grow: 1;
            }

            .preview-thumbnail.nav-tabs {
                border: none;
                margin-top: 15px;
            }

            .preview-thumbnail.nav-tabs li {
                width: 18%;
                margin-right: 2.5%;
            }

            .preview-thumbnail.nav-tabs li img {
                max-width: 100%;
                display: block;
            }

            .preview-thumbnail.nav-tabs li a {
                padding: 0;
                margin: 0;
            }

            .preview-thumbnail.nav-tabs li:last-of-type {
                margin-right: 0;
            }

            .tab-content {
                overflow: hidden;
            }

            .tab-content img {
                width: 100%;
                -webkit-animation-name: opacity;
                animation-name: opacity;
                -webkit-animation-duration: .3s;
                animation-duration: .3s;
            }

            .card {
                margin-top: 50px;
                background: #eee;
                padding: 3em;
                line-height: 1.5em;
            }

            @media screen and (min-width: 997px) {
                .wrapper {
                    display: -webkit-box;
                    display: -webkit-flex;
                    display: -ms-flexbox;
                    display: flex;
                }
            }

            .details {
                display: -webkit-box;
                display: -webkit-flex;
                display: -ms-flexbox;
                display: flex;
                -webkit-box-orient: vertical;
                -webkit-box-direction: normal;
                -webkit-flex-direction: column;
                -ms-flex-direction: column;
                flex-direction: column;
            }

            .colors {
                -webkit-box-flex: 1;
                -webkit-flex-grow: 1;
                -ms-flex-positive: 1;
                flex-grow: 1;
            }

            .product-title,
            .price,
            .sizes,
            .colors {
                text-transform: UPPERCASE;
                font-weight: bold;
            }

            .checked,
            .price span {
                color: #ff9f1a;
            }

            .product-title,
            .rating,
            .price,
            .vote,
            .sizes {
                padding-top: 15px;
            }

            .product-title {
                margin-top: 0;
            }

            .size {
                margin-right: 10px;
            }

            .size:first-of-type {
                margin-left: 10px;
            }

            .color {
                display: inline-block;
                vertical-align: middle;
                margin-right: 10px;
                height: 2em;
                width: 2em;
                border-radius: 2px;
            }

            .color:first-of-type {
                margin-left: 20px;
            }

            .add-to-cart,
            .like {
                background: #ff9f1a;
                padding: 1.2em 1.5em;
                border: none;
                text-transform: UPPERCASE;
                font-weight: bold;
                color: #fff;
                -webkit-transition: background .3s ease;
                transition: background .3s ease;
            }

            .add-to-cart:hover,
            .like:hover {
                background: #b36800;
                color: #fff;
            }

            .not-available {
                text-align: center;
                line-height: 2em;
            }

            .not-available:before {
                font-family: fontawesome;
                content: "\f00d";
                color: #fff;
            }

            .orange {
                background: #ff9f1a;
            }

            .green {
                background: #85ad00;
            }

            .blue {
                background: #0076ad;
            }

            .tooltip-inner {
                padding: 1.3em;
            }

            .rate {
                float: left;
                height: 46px;
                padding: 0 0px;
            }

            .rate:not(:checked)>input {
                position: absolute;
                display: none;
            }

            .rate:not(:checked)>label {
                float: right;
                width: 1em;
                overflow: hidden;
                white-space: nowrap;
                cursor: pointer;
                font-size: 30px;
                color: #ccc;
            }

            .rated:not(:checked)>label {
                float: right;
                width: 1em;
                overflow: hidden;
                white-space: nowrap;
                cursor: pointer;
                font-size: 30px;
                color: #ccc;
            }

            .rate:not(:checked)>label:before {
                content: '★ ';
            }

            .rate>input:checked~label {
                color: #ffc700;
            }

            .rate:not(:checked)>label:hover,
            .rate:not(:checked)>label:hover~label {
                color: #deb217;
            }

            .rate>input:checked+label:hover,
            .rate>input:checked+label:hover~label,
            .rate>input:checked~label:hover,
            .rate>input:checked~label:hover~label,
            .rate>label:hover~input:checked~label {
                color: #c59b08;
            }

            .star-rating-complete {
                color: #c59b08;
            }

            .rating-container .form-control:hover,
            .rating-container .form-control:focus {
                background: #fff;
                border: 1px solid #ced4da;
            }

            .rating-container textarea:focus,
            .rating-container input:focus {
                color: #000;
            }

            .rated {
                float: left;
                height: 46px;
                padding: 0 10px;
            }

            .rated:not(:checked)>input {
                position: absolute;
                display: none;
            }

            .rated:not(:checked)>label {
                float: right;
                width: 1em;
                overflow: hidden;
                white-space: nowrap;
                cursor: pointer;
                font-size: 30px;
                color: #ffc700;
            }

            .rated:not(:checked)>label:before {
                content: '★ ';
            }

            .rated>input:checked~label {
                color: #ffc700;
            }

            .rated:not(:checked)>label:hover,
            .rated:not(:checked)>label:hover~label {
                color: #deb217;
            }

            .rated>input:checked+label:hover,
            .rated>input:checked+label:hover~label,
            .rated>input:checked~label:hover,
            .rated>input:checked~label:hover~label,
            .rated>label:hover~input:checked~label {
                color: #c59b08;
            }

            @-webkit-keyframes opacity {
                0% {
                    opacity: 0;
                    -webkit-transform: scale(3);
                    transform: scale(3);
                }

                100% {
                    opacity: 1;
                    -webkit-transform: scale(1);
                    transform: scale(1);
                }
            }

            @keyframes opacity {
                0% {
                    opacity: 0;
                    -webkit-transform: scale(3);
                    transform: scale(3);
                }

                100% {
                    opacity: 1;
                    -webkit-transform: scale(1);
                    transform: scale(1);
                }
            }
        </style>
    </head>

    <div class="container" style="margin-top: 80px">
        <div class="card">
            <div class="container-fliud">
                <div class="wrapper row">
                    <div class="preview col-md-6">

                        <div class="preview-pic tab-content">
                            <div class="tab-pane active" id="pic-1"><img
                                    src="{{ URL::asset('/file/' . @$product->image) }}" /></div>
                        </div>

                    </div>
                    <div class="details col-md-6">
                        <h3 class="product-title">{{ $product->name }}</h3>
                        <div class="rating">
                            <div class="stars">
                                <div class="rate">
                                    <input type="radio" id="star5" class="rate" name="rating" value="5"
                                        {{ $avg == 5 ? 'checked' : '' }} disabled />
                                    <label for="star5" title="text">5 stars</label>
                                    <input type="radio" id="star4" class="rate" name="rating" value="4"
                                        {{ $avg == 4 ? 'checked' : '' }} disabled />
                                    <label for="star4" title="text">4 stars</label>
                                    <input type="radio" id="star3" class="rate" name="rating" value="3"
                                        {{ $avg == 3 ? 'checked' : '' }} disabled />
                                    <label for="star3" title="text">3 stars</label>
                                    <input type="radio" id="star2" class="rate" name="rating" value="2"
                                        {{ $avg == 2 ? 'checked' : '' }} disabled />
                                    <label for="star2" title="text">2 stars</label>
                                    <input type="radio" id="star1" class="rate" name="rating" value="1"
                                        {{ $avg == 1 ? 'checked' : '' }} disabled />
                                    <label for="star1" title="text">1 star</label>
                                </div>
                            </div>
                            <span class="review-no">{{ $countRating }} reviews</span>
                        </div>
                        <p class="product-description">Location: <strong>{{ $product->location }}</strong> | Health History: <strong>{{ $product->health_history }}</strong></p>
                        <p class="product-description">Weight: <strong>{{ $product->weight }}kg</strong>  |  Length: <strong>{{ $product->length }}m</strong>  |  Color: <strong>{{ $product->color }}</strong></p>
                        <h4 class="price">price: <span>@currency($product->price)</span></h4>
                        @if ($percentage != 0)
                            <p class="vote"><strong>{{ $percentage }}%</strong> of buyers enjoyed this product!
                        @endif
                        </p>
                        <form action="{{ route('cart.store') }}" method="POST">
                            {{ csrf_field() }}
                            <input type="hidden" value="{{ $product->id }}" id="id" name="id">
                            <input type="hidden" value="{{ $product->name }}" id="name" name="name">
                            <input type="hidden" value="{{ $product->price }}" id="price" name="price">
                            <input type="hidden" value="{{ $product->image }}" id="img" name="img">
                            <input type="hidden" value="1" id="quantity" name="quantity">
                            <button class="add-to-cart btn btn-default" class="tooltip-test" title="add to cart" {{ Auth::user()->role != 1 ? '' : 'disabled' }}>
                                Add to cart
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <hr>
        <h1>Ratings</h1>
        @forelse ($ratings as $item)
            <div class="card">
                <div class="details col-md-6">
                    <h3 class="product-title">{{ $item->invoice->user->name }}</h3>
                    <div class="rating">
                        <div class="stars">
                            <div class="rate">
                                <input type="radio" id="star5" class="rate" name="ratings{{ $item->id }}"
                                    value="5" {{ $item->rating == 5 ? 'checked' : '' }} disabled />
                                <label for="star5" title="text">5 stars</label>
                                <input type="radio" id="star4" class="rate" name="ratings{{ $item->id }}"
                                    value="4" {{ $item->rating == 4 ? 'checked' : '' }} disabled />
                                <label for="star4" title="text">4 stars</label>
                                <input type="radio" id="star3" class="rate" name="ratings{{ $item->id }}"
                                    value="3" {{ $item->rating == 3 ? 'checked' : '' }} disabled />
                                <label for="star3" title="text">3 stars</label>
                                <input type="radio" id="star2" class="rate" name="ratings{{ $item->id }}"
                                    value="2" {{ $item->rating == 2 ? 'checked' : '' }} disabled />
                                <label for="star2" title="text">2 stars</label>
                                <input type="radio" id="star1" class="rate" name="ratings{{ $item->id }}"
                                    value="1" {{ $item->rating == 1 ? 'checked' : '' }} disabled />
                                <label for="star1" title="text">1 star</label>
                            </div>
                        </div>
                    </div>
                    <p class="product-description">{{ $item->comment }}</p>
                </div>
            </div>
        @empty
            <h4>No Review for this product...</h4>
        @endforelse
    </div>
    <script type="text/javascript">
        function handleSelectChange(event) {
            window.location.href = "{{ url('/dashboard/?category=') }}" + $("#category").val();
        }
    </script>
@endsection
