<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="user-id" content="{{ auth()->id() }}">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="shortcut icon" href="{{ asset('assets/image/global/favicon.png') }}" type="image/x-icon" />
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Scripts -->
    <!-- <script src="{{ asset('js/app.js') }}" defer></script> -->
    <!-- Styles -->
    <script src="{{ asset('assets/plugins/bootstrap/script/popper.min.js') }}"> </script>
    <link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/custom_css/global.css') }}" />
    <!-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> -->
    <link rel="stylesheet" href="{{ asset('assets/css/font-awesome.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/sweetalert.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/buttons.dataTables.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-icons.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/jquery.dataTables.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/sweetalert2.min.cs') }}" />

    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css"> --}}
    <!-- ================= -->
    <!-- Datatable css start-->
    <link rel="stylesheet" href="{{ asset('assets/css/jquery.dataTables.min.css') }}" />
    {{-- <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css"> --}}
    <!-- Datatable css end-->
    <!-- ================= -->
    @yield('style')
</head>

<body>
    <!--loader-->
    <div id="loader" style="display: none;"></div>

    @include('includes.frontend.navbar')
    <div>
        @yield('content')
    </div>
    <script>
        var url = "{{ url('/') }}";
        var token = "{{ csrf_token() }}";
    </script>
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap/script/bootstrap.bundle.min.js') }}"></script>
    {{-- <script src="{{ asset('assets/plugins/bootstrap/script/jquery-3.5.1.slim.min.js') }}" ></script> --}}
    <script src="{{ asset('assets/plugins/bootstrap/script/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/select2.min.js') }}"></script>
    <!-- sweet alert cdn-->
    <script src="{{ asset('assets/js/sweetalert.min.js') }}"></script>
    <script src="{{ asset('assets/js/global.js') }}"></script>
    <script src="{{ asset('assets/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery-resizable.js') }}"></script> 
    <script src="{{ asset('assets/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ asset('assets/js/sweetalert2.all.min.js') }}"></script>
    {{-- <script src="https://rawgit.com/RickStrahl/jquery-resizable/master/src/jquery-resizable.js"></script> --}}
    {{-- <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script> --}}
    {{-- <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.colVis.min.js"></script> --}}

    {{-- <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js" type="text/javascript"></script> --}}
    {{-- <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js" type="text/javascript"></script> --}}
    {{-- <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js" type="text/javascript"></script> --}}

    @yield('script')

</body>

</html>
{{-- script for saving the activity of user untill logged in --}}
