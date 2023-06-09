@extends('layouts.app')

@section('content')
    <div class="container" style="margin-top: 80px">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Product</a></li>
                <li class="breadcrumb-item active" aria-current="page">Cart</li>
            </ol>
        </nav>
        @if (session()->has('success_msg'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session()->get('success_msg') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
        @endif
        @if (session()->has('alert_msg'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                {{ session()->get('alert_msg') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
        @endif
        @if (count($errors) > 0)
            @foreach ($errors0 > all() as $error)
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ $error }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
            @endforeach
        @endif
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <br>
                @if (\Cart::getTotalQuantity() > 0)
                    <h4>{{ \Cart::getTotalQuantity() }} Produk Cart</h4><br>
                @else
                    <h4>Tidak ada produk di cart</h4><br>
                    <a href="/" class="btn btn-dark">View Product</a>
                @endif

                @foreach ($cartCollection as $item)
                    <div class="row">
                        <div class="col-lg-3">
                            <img src="file/{{ $item->attributes->image }}" class="img-thumbnail" width="200"
                                height="200">
                        </div>
                        <div class="col-lg-5">
                            <p>
                                <b><a href="/cart">@currency($item->price)</a></b><br>
                                <b>Price: </b>@currency($item->price)<br>
                                <b>Sub Total: </b>@currency(\Cart::get($item->id)->getPriceSum())<br>
                                {{-- <b>With Discount: </b>${{ \Cart::get($item->id)->getPriceSumWithConditions() }} --}}
                            </p>
                        </div>
                        <div class="col-lg-4">
                            <div class="row">
                                <form action="{{ route('cart.update') }}" method="POST">
                                    {{ csrf_field() }}
                                    <div class="form-group row">
                                        <input type="hidden" value="{{ $item->id }}" id="id" name="id">
                                        <input type="number" class="form-control form-control-sm"
                                            value="{{ $item->quantity }}" id="quantity" name="quantity"
                                            style="width: 70px; margin-right: 10px;">
                                        <button class="btn btn-secondary btn-sm" style="margin-right: 25px;"><i
                                                class="fa fa-edit"></i></button>
                                    </div>
                                </form>
                                <form action="{{ route('cart.remove') }}" method="POST">
                                    {{ csrf_field() }}
                                    <input type="hidden" value="{{ $item->id }}" id="id" name="id">
                                    <button class="btn btn-dark btn-sm" style="margin-right: 10px;"><i
                                            class="fa fa-trash"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <hr>
                @endforeach
                @if (count($cartCollection) > 0)
                    <form action="{{ route('cart.clear') }}" method="POST">
                        {{ csrf_field() }}
                        <button class="btn btn-secondary btn-md">Clear</button>
                    </form>
                @endif
            </div>
            @if (count($cartCollection) > 0)
                <div class="col-lg-5">
                    <div class="card">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><b>Total: </b>@currency(\Cart::getTotal())</li>
                        </ul>
                    </div>
                    <br><a href="/dashboard" class="btn btn-dark">Kembali</a>
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModalCenter">
                        Checkout
                    </button>
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Checkout</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    Please complete your payment by paying to this virtual account:
                                    Virtual account number: <strong id="virtual">3421{{ Auth::user()->phone }}</strong>
                                    <button onclick="copy()" type="button" class="btn btn-secondary btn-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-clipboard" viewBox="0 0 16 16">
                                            <path
                                                d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1v-1z">
                                            </path>
                                            <path
                                                d="M9.5 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5h3zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3z">
                                            </path>
                                        </svg>
                                    </button>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <a href="/store" class="btn btn-success">Finish Order</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
        <br><br>
    </div>
@endsection

<script>
    function copy() {
        var copyText = $("#virtual").html();
        navigator.clipboard.writeText(copyText);

        alert("Copied!");
    }
</script>
