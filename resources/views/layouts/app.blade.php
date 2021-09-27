<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="shortcut icon" href="{{ asset('assets/image/global/favicon.png') }}" type="image/x-icon" />
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Scripts -->
    <!-- <script src="{{ asset('js/app.js') }}" defer></script> -->
    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/custom_css/global.css') }}" />
    <!-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> -->
    <link rel="stylesheet" href= "{{ asset('assets/css/font-awesome.min.css') }}" />
    <link rel="stylesheet"  href= "{{ asset('assets/css/sweetalert.min.css') }}" /> 
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}"  />
    <link rel="stylesheet"   href= "{{ asset('assets/css/jquery.dataTables.min.css') }}" /> 
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <!-- ================= -->
    <!-- Datatable css start-->
    <link rel="stylesheet"   href= "{{ asset('assets/css/jquery.dataTables.min.css') }}" /> 
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
    <script src= "{{ asset('assets/js/jquery.min.js') }}" ></script>
    <script src= "{{ asset('assets/js/jquery.dataTables.min.js') }}" ></script>
    <script src="{{ asset('assets/plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap/script/bootstrap.bundle.min.js') }}"></script>
    {{-- <script src="{{ asset('assets/plugins/bootstrap/script/jquery-3.5.1.slim.min.js') }}" ></script> --}}
    <script src="{{ asset('assets/plugins/bootstrap/script/bootstrap.min.js') }}" ></script>
    <script src="{{ asset('assets/js/select2.min.js') }}"></script>
    <!-- sweet alert cdn-->
    <script src= "{{ asset('assets/js/sweetalert.min.js') }}" ></script>
    <script src="{{ asset('assets/js/global.js') }}"></script>
    @yield('script')

</body>

</html>
