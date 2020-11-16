<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Habit</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('stylesheet')
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-lg navbar-info bg-dark">
            <div class="container">
                <div class="navbar-header">
                    <a class="navbar-brand" href="/">
                        Habit
                    </a>
                </div>

                <!-- Navbar Left -->
                <div class="collapse navbar-collapse justify-content-start" id="navbarSupportedContent">
                </div>
                <!-- Navbar Right -->
                <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                </div>
            </div>
        </nav>

        @yield('content')
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        @yield('script')
    </div>
</body>
</html>
