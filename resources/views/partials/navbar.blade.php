<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark shadow-sm">
    <div class="container">
        <img src="{{ URL::asset('/images/Logo_Barn_Boss_White.png') }}" alt="" style="width: 50px; height: 50px">
        &nbsp; &nbsp;
        <a class="navbar-brand" href="{{ url('/') }}">
            Barn Boss
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                @if (Auth::user()->role == 2)
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin') }}">Manage Product</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('order') }}">My Order</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('chat.seller') }}">Chat</a>
                    </li>
                @endif
                @if (Auth::user()->role == 1)
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('seller') }}">Manage Seller</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('category') }}">Manage Category</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('news') }}">Manage News</a>
                    </li>
                @endif
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('dashboard') }}">View Product</a>
                </li>
                @if (Auth::user()->role == 0 || Auth::user()->role == 2)
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('transaction') }}">My Transaction</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="badge badge-pill badge-dark">
                                <i class="fa fa-shopping-cart"></i> {{ \Cart::getTotalQuantity() }}
                            </span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown"
                            style="width: 450px; padding: 0px; border-color: #9DA0A2">
                            <ul class="list-group" style="margin: 20px;">
                                @include('partials.cart-drop')
                            </ul>

                        </div>
                    </li>
                @endif
                <form method="POST" action="{{ route('logout') }}" x-data>
                    @csrf
                    <li class="nav-item">
                        <button type="submit" class="nav-link">Logout</a>
                    </li>
                </form>
            </ul>
        </div>
    </div>
</nav>
