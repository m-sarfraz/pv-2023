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
    <link rel="stylesheet" href="{{ asset('assets/custom_css/login.css') }}">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <div style="    background-color: #ebf0f4!important;">
        
        <div class="width-78 m-auto vh-100 d-flex align-items-center justify-content-center">
            @yield('content')
        </div>
    </div>
    </div>
</body>
</html>
