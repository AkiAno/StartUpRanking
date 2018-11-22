<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'StartUpAnalytics') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Catamaran:400,600,700" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    
        <nav id="nav-menu" class="navbar navbar-expand-md navbar-laravel">
        <div class="container-fluid">
            <div class="navbar-header">
                    <div className="container">
                            <a id="link" class="navbar-brand" to="/">
                                <span class="start">Start</span>
                                <span class="ups">ups</span>
                                <span class="today">Today</span>
                            </a>
                        </div>
            </div>
            <ul class="nav navbar-nav">
                <li class="active">
                    <a href="#">Home</a>
                </li>
                <li>
                    <a href="/news">News</a>
                </li>
                <li>
                    <a href="#">Login</a>
                </li>
                <li>
                    <a href="#">Register</a>
                </li>
            </ul>
        </div>
    </nav>
    <div id="app">
        <main>
            @yield('content')
        </main>
    </div>
    <br>
    <br>
    <div class="footer fixed-bottom d-flex align-items-lg-center justify-content-lg-center">
            copyright @Startups Today
    </div>


</body>
</html>
