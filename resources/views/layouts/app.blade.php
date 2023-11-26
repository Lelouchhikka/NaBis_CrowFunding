<!DOCTYPE html>
@inject('types', 'app.types')
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span> </button>
        <div class="collapse navbar-collapse" id="navbarNav"> <ul class="navbar-nav me-3 mb-2 mb-lg-0 w-">
                <li class="nav-item">
                    <a class="nav-link active " href="{{ route('home') }}">Проекты</a>
                </li>
            </ul>
            <a class="navbar-brand mx-auto" href="{{ route('home') }}">
                NaBis</a>
            <ul class="navbar-nav">
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
                        <a class="nav-link" href="{{ route('login') }}">Логин</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">Регистрация</a>
                    </li>
                @endauth
                   </ul>
        </div> </div> </nav>
<hr class="mb-0">
<div class="row bg-white">
    <ul class="nav nav-pills justify-content-center category-nav mt-0">

        @foreach($types as $type)
            <li class="nav-item">
                <a class="nav-link" href="{{ route('projects.by_type', $type->name) }}">{{ $type->name }}</a>
            </li>
        @endforeach

    </ul>
</div>
<hr class="mt-0">
<div class="container py-5">


    @yield('content')
</div>
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
<script src="{{ mix('js/app.js') }}"></script>

<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
