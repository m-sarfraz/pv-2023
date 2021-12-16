@extends('layouts.app')

@section('style')
    <!-- ================= -->
    <!-- Datatable css start-->
    <link rel="stylesheet" href="{{ asset('assets/css/jquery.dataTables.min.css') }}" />
    <!-- Datatable css end-->
    <!-- ================= -->
    <style>
        .row {
            margin: 0px !important;
        }

        #example1_filter label {
            display: flex;
            width: fit-content;
            align-items: center;
            margin-left: auto;
        }

    </style>
@endsection


@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1>Thank You</h1>

            </div>
        </div>
    </div>
    <div style="height: 30px;"></div>

@endsection


@section('script')
    <script>
    //   cid =   {!! $cid !!}
    //   uid =   {!! $uid !!}
    //     $.ajax({
    //         type: "GET",
    //         url: url + "/admin/redirectQrCode" + '/' + cid+ '/' + uid,
    //         data: {
    //             _token: token,
    //             cid: cid,
    //             uid: uid
    //         },
    //         // success function after ajax call starts
    //         success: function(data) {
    //             // $('#QrCode').html(data);
    //         },
    //         // success function after ajax call ends

    //     });
    </script>
    <!-- Datatable js end-->
    <!-- ================= -->
@endsection
