@extends('layouts.app')

@section('content')

    <head>
        <script src="js/jquery.min.js" type="text/javascript"></script>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.0/css/jquery.dataTables.css" defer>
        <script src="http://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js" defer></script>
        <style>
            .rate {
                float: left;
                height: 46px;
                padding: 0 10px;
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
        </style>
    </head>

    <div class="container table-responsive" style="margin-top: 80px">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Transaction Detail #{{ $invoice->invoice_id }}</h1>
        </div>

        @if (empty($rating))
            <div class="container">
                <div class="row">
                    <div class="col mt-1">
                        <form class="py-2 px-4" action="{{ route('store.rating', $invoice->id) }}"
                            style="border: 1px #ddd solid" method="POST" autocomplete="off">
                            @csrf
                            <p class="font-weight-bold">Review {{ $invoice->product->name }}</p>
                            <div class="form-group row">
                                <input type="hidden" name="id" value="{{ $invoice->id }}">
                                <div class="col">
                                    <div class="rate">
                                        <input type="radio" id="star5" class="rate" name="rating" value="5" />
                                        <label for="star5" title="text">5 stars</label>
                                        <input type="radio" checked id="star4" class="rate" name="rating"
                                            value="4" />
                                        <label for="star4" title="text">4 stars</label>
                                        <input type="radio" id="star3" class="rate" name="rating" value="3" />
                                        <label for="star3" title="text">3 stars</label>
                                        <input type="radio" id="star2" class="rate" name="rating" value="2">
                                        <label for="star2" title="text">2 stars</label>
                                        <input type="radio" id="star1" class="rate" name="rating" value="1" />
                                        <label for="star1" title="text">1 star</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row mt-4">
                                <div class="col">
                                    <textarea class="form-control" name="comment" rows="6 " placeholder="Comment" maxlength="200"></textarea>
                                </div>
                            </div>
                            <div class="mt-3 text-right">
                                <a type="submit" href="{{ route('transaction.detail', $invoice->invoice_id) }}"
                                    class="btn btn-sm py-2 px-3 btn-danger">Back
                                </a>
                                <button type="submit" class="btn btn-sm py-2 px-3 btn-info">Submit review
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @else
            <div class="container">
                <div class="row">
                    <div class="col mt-1">
                        <form class="py-2 px-4" action="{{ route('update.rating', $rating->id) }}"
                            style="border: 1px #ddd solid" method="POST" autocomplete="off">
                            @csrf
                            <p class="font-weight-bold">Review {{ $invoice->product->name }}</p>
                            <div class="form-group row">
                                <input type="hidden" name="id" value="{{ $rating->id }}">
                                <input type="hidden" name="invoice" value="{{ $invoice->id }}">
                                <div class="col">
                                    <div class="rate">
                                        <input type="radio" id="star5" class="rate" name="rating" value="5"
                                            {{ $rating->rating == 5 ? 'checked' : '' }} />
                                        <label for="star5" title="text">5 stars</label>
                                        <input type="radio" id="star4" class="rate" name="rating" value="4"
                                            {{ $rating->rating == 4 ? 'checked' : '' }} />
                                        <label for="star4" title="text">4 stars</label>
                                        <input type="radio" id="star3" class="rate" name="rating"
                                            value="3" {{ $rating->rating == 3 ? 'checked' : '' }} />
                                        <label for="star3" title="text">3 stars</label>
                                        <input type="radio" id="star2" class="rate" name="rating"
                                            value="2" {{ $rating->rating == 2 ? 'checked' : '' }}>
                                        <label for="star2" title="text">2 stars</label>
                                        <input type="radio" id="star1" class="rate" name="rating"
                                            value="1" {{ $rating->rating == 1 ? 'checked' : '' }} />
                                        <label for="star1" title="text">1 star</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row mt-4">
                                <div class="col">
                                    <textarea class="form-control" name="comment" rows="6 " placeholder="Comment" maxlength="200">{{ $rating->comment }}</textarea>
                                </div>
                            </div>
                            <div class="mt-3 text-right">
                                <a type="submit" href="{{ route('transaction.detail', $invoice->invoice_id) }}"
                                    class="btn btn-sm py-2 px-3 btn-danger">Back
                                </a>
                                <button type="submit" class="btn btn-sm py-2 px-3 btn-info">Update review
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <script>
        $(function() {
            $('#myTable').DataTable();
        })
    </script>
@endsection
