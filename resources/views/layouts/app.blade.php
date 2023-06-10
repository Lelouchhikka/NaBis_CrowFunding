<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light m-3">
    <a class="navbar-brand" href="{{ route('home') }}">NaBis</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('home') }}">Projects</a>
            </li>
            @auth
                <li class="nav-item">
                    <form action="{{route('logout')}}" method="post">
                        {{csrf_field()}}
                        <button class="nav-link">Logout</button>
                    </form>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('profile') }}">Профиль</a>
                </li>
            @else
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}">Register</a>
                </li>
            @endauth
        </ul>
    </div>
</nav>

<div class="container py-5">


    @yield('content')
</div>
<footer class="bg-dark text-light">
        <div class="row">
            <div class="col-md-6">
                <h5>About Us</h5>
                <p>Some information about your project or company.</p>
            </div>
            <div class="col-md-6">
                <h5>Contact</h5>
                <ul class="list-unstyled">
                    <li>Address</li>
                    <li>Phone</li>
                    <li>Email</li>
                </ul>
            </div>
        </div>
</footer>

<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
