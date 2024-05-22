<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/template.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    @yield('css')
    <title>@yield('title')</title>
</head>

<body>
    <nav>
        <img id="logo-navbar" src="{{ asset('assets/logo.png') }}" alt="">
        <div class="menu">
            <a href="/">Home</a>
            <a href="/movies">Movies</a>
            <a href="/actors">Actors</a>
            @auth
            @if(Auth::user()->role == 'member')
            <a href="/watchlists">My Watchlist</a>
            @endif
            <div class="btn-group">
                <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-user-circle-o"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a href="/profile/edit"><button class="dropdown-item">Profile</button></a></li>
                    <li><a href="/logout"><button class="dropdown-item">Logout</button></a></li>
                </ul>
            </div>
            @else
            <a href="/registerPage">Register</a>
            <a href="/loginPage">Login</a>
            @endif
        </div>
    </nav>
    <div class="content">
        @yield('content')
    </div>
    <footer>
        <img id="logo-footer" src="{{ asset('assets/logo.png') }}" alt="">
        <p>MovieList is a website that contains list of movies</p>
        <div id="soc-med">
            <a href="https://www.instagram.com"> <img class="logo-soc-med" src="{{ asset('assets/logo-ig.webp') }}" alt=""> </a>
            <a href="http://www.facebook.com"> <img class="logo-soc-med" src="{{ asset('assets/logo-fb.webp') }}" alt=""> </a>
            <a href="http://www.reddit.com"> <img class="logo-soc-med" src="{{ asset('assets/logo-reddit.png') }}" alt=""> </a>
            <a href="http://www.youtube.com"> <img class="logo-soc-med" src="{{ asset('assets/logo-yt.png') }}" alt=""> </a>
            <a href="http://www.twitter.com"> <img class="logo-soc-med" src="{{ asset('assets/logo-twitter.webp') }}" alt=""> </a>
        </div>
        <div>
            Privacy Policy | Terms of Service | Contact Us | About Us
        </div>
        <div>
            Copyright &copy 2022
            <img src="{{ asset('assets/logo.png') }}" alt="" id="logo-footer-small">
            All Rights Reserved
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous" async></script>
</body>
@yield('scripts')
</html>
