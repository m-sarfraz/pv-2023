<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ asset('assets/image/global/favicon.png')  }}" type="image/x-icon">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap/css/bootstrap.min.css')  }}" />
    <link rel="stylesheet" href="{{ asset('assets/custom_css/global.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/custom_css/searchable.css') }}">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
        <nav>
            there is navbar
        </nav>

        <div>
                @yield('content')
        </div>

        <footer>
            there is footer
        </footer>

        <script src="{{ asset('assets/plugins/bootstrap/script/jquery.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/bootstrap/script/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/bootstrap/script/jquery-3.5.1.slim.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/bootstrap/script/popper.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/bootstrap/script/bootstrap.min.js') }}"></script>

        @yield('script')
</body>
</html>
