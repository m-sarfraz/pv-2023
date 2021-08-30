<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <link rel="shortcut icon" href="{{ asset('assets/image/global/favicon.png')  }}" type="image/x-icon" />
        <title>{{ config('app.name', 'Laravel') }}</title>
        <!-- Scripts -->
        <!-- <script src="{{ asset('js/app.js') }}" defer></script> -->
        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap/css/bootstrap.min.css')  }}" />
        <link rel="stylesheet" href="{{ asset('assets/custom_css/global.css') }}" />
        <!-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">

        @yield('style')
    </head>

    <body>
        <!--loader-->
        <div id="loader" style="display: none;"></div>

        @include('includes.frontend.navbar')
        <div>
            @yield('content')
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <!-- sweet alert cdn-->
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

        @yield('script')
    </body>
</html>
