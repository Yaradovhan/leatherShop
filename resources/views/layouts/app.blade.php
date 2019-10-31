<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>
    <!-- Fonts --><!-- Styles -->
    <link href="{{ mix('css/app.css', 'build') }}" rel="stylesheet">

    <script src="{{mix('js/app.js', 'build')}}"></script>
</head>
<body>
<header>
    <nav class="navbar navbar-expand-md">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="https://image.flaticon.com/icons/svg/2088/2088741.svg" width="30" height="30"
                     alt="LeatherShop">
                <span>leatherShop</span>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">
                    <li><a class="nav-link" href="{{route('products')}}">Products</a></li>
                    @foreach (array_slice($menuPages, 0, 3) as $page)
                        <li><a class="nav-link" href="{{ route('page', page_path($page)) }}">{{ $page->getMenuTitle() }}</a></li>
                    @endforeach
                    @if ($morePages = array_slice($menuPages, 3))
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                More... <span class="caret"></span>
                            </a>
                        </li>
                    @endif
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->first_name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a href="{{route('admin.home')}}" class="dropdown-item">Admin</a>
                                <a href="{{route('cabinet.home')}}" class="dropdown-item">Cabinet</a>
                                <a href="{{route('cart.index')}}" class="dropdown-item">Cart</a>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                      style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>
</header>

<main class="app-content">
    <div class="container">
        {{--        @section('breadcrumbs', Breadcrumbs::render())--}}
        {{--        @yield('breadcrumbs')--}}
        @include('layouts.partials.flash')
        @yield('content')
    </div>

</main>

<footer>
    <div class="container">
        <div class="border-top pt-3">
            <p>&copy; {{date('Y')}} - Leather Shop</p>
        </div>
    </div>
</footer>


</body>
</html>
