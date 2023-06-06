@extends('layouts.app')

@section('style')
    <!-- ================= -->
    <!-- Datatable css start-->
    <link rel="stylesheet" href="{{ asset('assets/css/jquery.dataTables.min.css') }}" />

    <!-- Datatable css end-->
    <!-- ================= -->
    <style>
        /* START TOOLTIP STYLES */
        [tooltip] {
            position: relative;
            /* opinion 1 */
        }

        /* Applies to all tooltips */
        [tooltip]::before,
        [tooltip]::after {
            text-transform: none;
            /* opinion 2 */
            font-size: .9em;
            /* opinion 3 */
            line-height: 1;
            user-select: none;
            pointer-events: none;
            position: absolute;
            display: none;
            opacity: 0;
        }

        .tooltip-inner {
            white-space: pre-wrap;
        }

        [tooltip]::before {
            content: '';
            border: 5px solid transparent;
            /* opinion 4 */
            z-index: 1001;
            /* absurdity 1 */
        }

        [tooltip]::after {
            content: attr(tooltip);
            /* magic! */

            /* most of the rest of this is opinion */
            font-family: Helvetica, sans-serif;
            text-align: center;

            /*
                                                                                                                                                                                        Let the content set the size of the tooltips
                                                                                                                                                                                        but this will also keep them from being obnoxious
                                                                                                                                                                                        */
            min-width: 3em;
            /* max-width: 21em; */
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            padding: 1ch 1.5ch;
            border-radius: .3ch;
            box-shadow: 0 1em 2em -.5em rgba(0, 0, 0, 0.35);
            background: #333;
            color: #fff;
            z-index: 1000;
            /* absurdity 2 */
        }

        /* Make the tooltips respond to hover */
        [tooltip]:hover::before,
        [tooltip]:hover::after {
            display: block;
        }

        /* don't show empty tooltips */
        [tooltip='']::before,
        [tooltip='']::after {
            display: none !important;
        }

        /* FLOW: UP */
        [tooltip]:not([flow])::before,
        [tooltip][flow^="up"]::before {
            bottom: 100%;
            border-bottom-width: 0;
            border-top-color: #333;
        }

        [tooltip]:not([flow])::after,
        [tooltip][flow^="up"]::after {
            bottom: calc(100% + 5px);
        }

        [tooltip]:not([flow])::before,
        [tooltip]:not([flow])::after,
        [tooltip][flow^="up"]::before,
        [tooltip][flow^="up"]::after {
            left: 50%;
            transform: translate(-50%, -.5em);
        }

        /* FLOW: DOWN */
        [tooltip][flow^="down"]::before {
            top: 100%;
            border-top-width: 0;
            border-bottom-color: #333;
        }

        [tooltip][flow^="down"]::after {
            top: calc(100% + 5px);
        }

        [tooltip][flow^="down"]::before,
        [tooltip][flow^="down"]::after {
            left: 50%;
            transform: translate(-50%, .5em);
        }

        /* FLOW: LEFT */
        [tooltip][flow^="left"]::before {
            top: 50%;
            border-right-width: 0;
            border-left-color: #333;
            left: calc(0em - 5px);
            transform: translate(-.5em, -50%);
        }

        [tooltip][flow^="left"]::after {
            top: 50%;
            right: calc(100% + 5px);
            transform: translate(-.5em, -50%);
        }

        /* FLOW: RIGHT */
        [tooltip][flow^="right"]::before {
            top: 50%;
            border-left-width: 0;
            border-right-color: #333;
            right: calc(0em - 5px);
            transform: translate(.5em, -50%);
        }

        [tooltip][flow^="right"]::after {
            top: 50%;
            left: calc(100% + 5px);
            transform: translate(.5em, -50%);
        }

        /* KEYFRAMES */
        @keyframes tooltips-vert {
            to {
                opacity: .9;
                transform: translate(-50%, 0);
            }
        }

        @keyframes tooltips-horz {
            to {
                opacity: .9;
                transform: translate(0, -50%);
            }
        }

        /* FX All The Things */
        [tooltip]:not([flow]):hover::before,
        [tooltip]:not([flow]):hover::after,
        [tooltip][flow^="up"]:hover::before,
        [tooltip][flow^="up"]:hover::after,
        [tooltip][flow^="down"]:hover::before,
        [tooltip][flow^="down"]:hover::after {
            animation: tooltips-vert 300ms ease-out forwards;
        }

        [tooltip][flow^="left"]:hover::before,
        [tooltip][flow^="left"]:hover::after,
        [tooltip][flow^="right"]:hover::before,
        [tooltip][flow^="right"]:hover::after {
            animation: tooltips-horz 300ms ease-out forwards;
        }

        .row {
            margin: 0px !important;
        }

        #example1_filter label {
            display: flex;
            width: fit-content;
            margin-left: auto;
        }

        .card {
            flex-direction: inherit;
        }

        /* -----------------------------------------
                                                                                                                                                                                                                                                                                                                                                                                                                      =Default css to make the demo more pretty
                                                                                                                                                                                                                                                                                                                                                                                                                    -------------------------------------------- */
        .table td,
        .table th {
            padding: 0.75rem;
            vertical-align: top;
            border-top: 1px solid #dee2e6;
            vertical-align: middle;
        }

        ---------------------- */ .load-wrapp {
            float: left;
            background-color: #d8d8d8;
            */
        }

        .load-wrapp p {
            padding: 0 0 20px;
        }

        .load-wrapp:last-child {
            margin-right: 0;
        }

        .line {
            display: inline-block;
            width: 15px;
            height: 15px;
            border-radius: 15px;
            background-color: #4b9cdb;
        }

        .ring-1 {
            width: 10px;
            height: 10px;
            margin: 0 auto;
            padding: 10px;
            border: 7px dashed #4b9cdb;
            border-radius: 100%;
        }

        .ring-2 {
            position: relative;
            width: 45px;
            height: 45px;
            margin: 0 auto;
            border: 4px solid #4b9cdb;
            border-radius: 100%;
        }

        .ball-holder {
            position: absolute;
            width: 12px;
            height: 45px;
            left: 17px;
            top: 0px;
        }

        .ball {
            position: absolute;
            top: -11px;
            left: 0;
            width: 16px;
            height: 16px;
            border-radius: 100%;
            background: #4282b3;
        }

        .letter-holder {
            /* padding: 16px; */
        }

        .letter {
            float: left;
            font-size: 26px;
            color: rgb(220 134 39);
        }

        .square {
            width: 12px;
            height: 12px;
            border-radius: 4px;
            background-color: #4b9cdb;
        }

        .spinner {
            position: relative;
            width: 45px;
            height: 45px;
            margin: 0 auto;
        }

        .bubble-1,
        .bubble-2 {
            position: absolute;
            top: 0;
            width: 25px;
            height: 25px;
            border-radius: 100%;
            background-color: #4b9cdb;
        }

        .bubble-2 {
            top: auto;
            bottom: 0;
        }

        .bar {
            float: left;
            width: 15px;
            height: 6px;
            border-radius: 2px;
            background-color: #4b9cdb;
        }

        .load-6 .letter {
            animation-name: loadingF;
            animation-duration: 1.6s;
            animation-iteration-count: infinite;
            animation-direction: linear;
        }

        .l-1 {
            animation-delay: 0.48s;
        }

        .l-2 {
            animation-delay: 0.6s;
        }

        .l-3 {
            animation-delay: 0.72s;
        }

        .l-4 {
            animation-delay: 0.84s;
        }

        .l-5 {
            animation-delay: 0.96s;
        }

        .l-6 {
            animation-delay: 1.08s;
        }

        .l-7 {
            animation-delay: 1.2s;
        }

        .l-8 {
            animation-delay: 1.32s;
        }

        .l-9 {
            animation-delay: 1.44s;
        }

        .l-10 {
            animation-delay: 1.56s;
        }

        .load-7 .square {
            animation: loadingG 1.5s cubic-bezier(0.17, 0.37, 0.43, 0.67) infinite;
        }

        .load-8 .line {
            animation: loadingH 1.5s cubic-bezier(0.17, 0.37, 0.43, 0.67) infinite;
        }

        .load-9 .spinner {
            animation: loadingI 2s linear infinite;
        }

        .load-9 .bubble-1,
        .load-9 .bubble-2 {
            animation: bounce 2s ease-in-out infinite;
        }

        .load-9 .bubble-2 {
            animation-delay: -1s;
        }

        .load-10 .bar {
            animation: loadingJ 2s cubic-bezier(0.17, 0.37, 0.43, 0.67) infinite;
        }

        @keyframes loadingA {
            0 {
                height: 15px;
            }

            50% {
                height: 35px;
            }

            100% {
                height: 15px;
            }
        }

        @keyframes loadingB {
            0 {
                width: 15px;
            }

            50% {
                width: 35px;
            }

            100% {
                width: 15px;
            }
        }

        @keyframes loadingC {
            0 {
                transform: translate(0, 0);
            }

            50% {
                transform: translate(0, 15px);
            }

            100% {
                transform: translate(0, 0);
            }
        }

        @keyframes loadingD {
            0 {
                transform: rotate(0deg);
            }

            50% {
                transform: rotate(180deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        @keyframes loadingE {
            0 {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        @keyframes loadingF {
            0% {
                opacity: 0;
            }

            100% {
                opacity: 1;
            }
        }

        @keyframes loadingG {
            0% {
                transform: translate(0, 0) rotate(0deg);
            }

            50% {
                transform: translate(70px, 0) rotate(360deg);
            }

            100% {
                transform: translate(0, 0) rotate(0deg);
            }
        }

        @keyframes loadingH {
            0% {
                width: 15px;
            }

            50% {
                width: 35px;
                padding: 4px;
            }

            100% {
                width: 15px;
            }
        }

        @keyframes loadingI {
            100% {
                transform: rotate(360deg);
            }
        }

        @keyframes bounce {

            0%,
            100% {
                transform: scale(0);
            }

            50% {
                transform: scale(1);
            }
        }

        @keyframes loadingJ {

            0%,
            100% {
                transform: translate(0, 0);
            }

            50% {
                transform: translate(80px, 0);
                background-color: #f5634a;
                width: 25px;
            }
        }

        .card {
            flex-direction: inherit;
        }
    </style>
@endsection


@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <p class="C-Heading pt-3">Filter By:</p>
                <div class="card mb-13">
                    <div id="loader1" style="display: block;"></div>
                    <div class="card-body">
                        <form action="" method="post" enctype="multipart/form-data" id="jdlFormData">
                            @csrf

                            <div class="row mb-1 align-items-center">
                                <div class="col-lg-3">
                                    <div class="form-group mb-0">

                                        <label class="d-block font-size-3 mb-0">
                                            Client:
                                        </label>
                                        <select multiple name="client[]" id="client" class="select2_dropdown  w-100">

                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group mb-0 pt-1">

                                        <label class="d-block font-size-3 Label labelFontSize mb-0">
                                            Domain
                                        </label>
                                        <select name="domain[]" id="domain" class="select2_dropdown w-100 form-control"
                                            multiple>

                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="form-group mb-0">
                                        <label class="d-block font-size-3 Label labelFontSize mb-0">
                                            Segment
                                        </label>
                                        <select name="segment[]" id="segment" class="select2_dropdown w-100 form-control"
                                            multiple>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="form-group mb-0">

                                        <label class="d-block font-size-3 mb-0">
                                            Sub-Segment
                                        </label>
                                        <select multiple name="subSegment[]" id="subSegment"
                                            class="select2_dropdown  w-100">

                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-1 align-items-center">
                                <div class="col-lg-3">
                                    <div class="form-group mb-0">

                                        <label class="d-block font-size-3 mb-0">
                                            Position
                                        </label>
                                        <select multiple name="position_title[]" id="position_title"
                                            class="select2_dropdown  w-100">

                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group mb-0">

                                        <label class="d-block font-size-3 mb-0 pt-lg-1 pt-sm-0 pt-0">
                                            Career Level:
                                        </label>
                                        <select multiple name="career_level[]" id="career_level"
                                            class="select2_dropdown  w-100">

                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="form-group mb-0 pt-1">
                                        @php
                                            $status = Helper::get_dropdown('status');
                                        @endphp
                                        <label class="d-block font-size-3 mb-0 Label labelFontSize">
                                            Status
                                        </label>
                                        <select name="status[]" id="status" class="select2_dropdown w-100 form-control"
                                            multiple>
                                            @foreach ($status->options as $render_status)
                                                <option value="{{ $render_status->option_name }}">
                                                    {{ $render_status->option_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group mb-0">
                                        <label class="Label labelFontSize">Location</label>
                                        <select name="location[]" id="location" class="select2_dropdown w-100 form-control"
                                            multiple>

                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-1 align-items-center">
                                <div class="col-lg-3">
                                    <div class="form-group mb-0">

                                        <label class="d-block font-size-3 mb-0">
                                            Keyword
                                        </label>
                                        <select multiple name="keyword[]" id="keyword" class="select2_dropdown  w-100">

                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group mb-0">

                                        <label class="d-block font-size-3 mb-0 pt-lg-1 pt-sm-0 pt-0">
                                            Priority:
                                        </label>
                                        <select multiple name="priority[]" id="priority" class="select2_dropdown  w-100">

                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="form-group mb-0 pt-1">

                                        <label class="d-block font-size-3 mb-0 Label labelFontSize">
                                            Assignment
                                        </label>
                                        <select name="assignment[]" id="assignment"
                                            class="select2_dropdown w-100 form-control" multiple>

                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group mb-0">
                                        <label class="Label labelFontSize">Work Schedule</label>
                                        <select name="wschedule[]" id="wschedule"
                                            class="select2_dropdown w-100 form-control" multiple>

                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-1">
                                <div class="col-6"></div>
                                <div class="text-right col-6 mt-5">
                                    <button onclick="extractResultFunctionJDL(this)" id="buttonExtract"
                                        class="btn btn-warning btn btn-lg w-50 text-white" type="button">Extract Data (JDL)
                                        <span id="buttonTimer"></span>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

    </div>

    </div>
    </div>
    <div class="d-flex align-items-end">
        <h2 class="mt-4 mb-0 ml-3 mt-3 px-2">Extraction History (JDL) </h2>
        <h4> <span>
                <a style="color:blue"
                    tooltip="Click on Extract Data button after selecting any filter,&#013; Downlaod Link will be available after report is ready to download!"
                    flow="right">
                    <i class="bi bi-info-circle"></i> </a>
            </span>
        <span class="btn btn-lg btn-success bi bi-arrow-clockwise" style="right: 0;
        position: absolute;background-color: #dc8627;  border-color: #dc8627;
        margin-right: 30px;" onclick="appendHistory()">Click to Refresh Reports Status</span>
           
        </h4>
    </div>
    <span class="ml-4 mt-0"> <i>(Report History contains 10 recent reports)</i> </span>

    <div class="col-lg-12 mt-3" id="reportHistoryTable">
        <div class="mt-5" id="loader2"></div>
    </div>
@endsection


<script src="{{ asset('assets/js/sweetalert2.all.min.js') }}"></script>
@section('script')
    <script>
        // doc ready function  starts
        select2Dropdown("select2_dropdown");
        $(document).ready(function() {
            appendFilterOptions();
            appendHistory();
            // onTimer();
        })
        // doc ready function closes 

        // function for data table 
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
            });
        });
        // close 

        //append  dropdowns
        function appendFilterOptions() {
            $.ajax({
                    type: "GET",
                    url: '{{ route('appendJdlOptionsDataExtract') }}',
                })
                .done(function(res) {
                    console.log(res)
                    for (let i = 0; i < res.domains.length; i++) {
                        $('#domain').append('<option value="' + res.domains[i].domain_name + '">' + res.domains[i]
                            .domain_name +
                            '</option>')
                    }
                    for (let i = 0; i < res.segment.length; i++) {
                        $('#segment').append('<option value="' + res.segment[i].segment_name + '">' +
                            res.segment[i].segment_name + '</option>')
                    }
                    for (let i = 0; i < res.domains.length; i++) {
                        $('#subSegment').append('<option value="' + res.subSegment[i].sub_segment_name + '">' + res
                            .subSegment[i]
                            .sub_segment_name +
                            '</option>')
                    }
                    for (let i = 0; i < res.client.options.length; i++) {
                        $('#client').append('<option value="' + res.client.options[i].option_name + '">' + res.client
                            .options[i].option_name +
                            '</option>')

                    }
                    for (let i = 0; i < res.career.options.length; i++) {
                        $('#career_level').append('<option value="' + res.career.options[i].option_name + '">' + res
                            .career.options[i].option_name + '</option>')
                    }
                    for (let i = 0; i < res.status.options.length; i++) {
                        $('#app_status').append('<option value="' + res.status.options[i].option_name + '">' + res
                            .status.options[i].option_name + '</option>')
                    }
                    for (let i = 0; i < res.p_title.options.length; i++) {
                        $('#position_title').append('<option value="' + res.p_title.options[i].option_name + '">' + res
                            .p_title.options[i].option_name + '</option>')
                    }
                    for (let i = 0; i < res.keyword.options.length; i++) {
                        $('#keyword').append('<option value="' + res.keyword.options[i].option_name + '">' + res
                            .keyword.options[i].option_name + '</option>')
                    }
                    for (let i = 0; i < res.assignment.options.length; i++) {
                        $('#assignment').append('<option value="' + res.assignment.options[i].option_name + '">' + res
                            .assignment.options[i].option_name + '</option>')
                    }
                    for (let i = 0; i < res.wschedule.options.length; i++) {
                        $('#wschedule').append('<option value="' + res.wschedule.options[i].option_name + '">' + res
                            .wschedule.options[i].option_name + '</option>')
                    }
                    for (let i = 0; i < res.priority.options.length; i++) {
                        $('#priority').append('<option value="' + res.priority.options[i].option_name + '">' + res
                            .priority.options[i].option_name + '</option>')
                    }
                    for (let i = 0; i < res.location.options.length; i++) {
                        $('#location').append('<option value="' + res.location.options[i].option_name + '">' + res
                            .location.options[i].option_name + '</option>')
                    }

                    $('#loader1').hide()
                })
                .fail(function(err) {
                    console.log(err);
                });
        }
        //close 

        // extract result function starts 
        function extractResultFunctionJDL(elem, url) {
            Swal.fire({
                icon: "success",
                text: "{{ __('Extraction Report has been put to Queue!') }}",
                //content: wrapper,
                icon: "success",
            });
            var myformData = new FormData(document.getElementById('jdlFormData'));
            console.log(myformData);
            // client = $('#client').val();
            // domain = $('#domain').val();
            // segment = $('#segment').val();
            // subSegment = $('#subSegment').val();
            // position_title = $('#position_title').val();
            // career_level = $('#career_level').val();
            // app_status = $('#app_status').val();
            // location = $('#location').val();
            // keyword = $('#keyword').val();
            // priority = $('#priority').val();
            // assignment = $('#assignment').val();
            // wschedule = $('#wschedule').val();
            // console.log('yess');
            $.ajax({
                    type: "post",
                    processData: false,
                    contentType: false,
                    cache: false,
                    data: myformData,
                    enctype: 'multipart/form-data',
                    url: "{{ url('admin/extract-search-filter-jdl') }}",
                    // data: {
                    //     _token: "{{ csrf_token() }}",
                    //     client: client,
                    //     domain: domain,
                    //     segment: segment,
                    //     subSegment: subSegment,
                    //     position_title: position_title,
                    //     career_level: career_level,
                    //     app_status: app_status,
                    //     location: location,
                    //     keyword: keyword,
                    //     priority: priority,
                    //     assignment: assignment,
                    //     wschedule: wschedule,
                    //     // searchKeyword: searchKeyword,
                    // },
                    // processData: false,
                })
                .done(function(res) {
                    //     Swal.fire({
                    //     position: 'center',
                    //     icon: 'success',
                    //     title: res.message,
                    //     showConfirmButton: false,
                    //     timer: 4000
                    // })
                    // location.reload();  
                    $("#loader").hide();
                })
                .fail(function(err) {
                    $("#loader").hide();
                })

            return false;
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            //Calling Ajax

        }
        //close

        // set interval for appending the history periodically 
        // setInterval(() => {
        //     appendHistory();
        // }, 60000);
        // close

        // append  history function 
        function appendHistory() {
            $.ajax({
                    url: "{{ route('get-report-history-jdl') }}",
                    type: "GET",
                })
                .done(function(res) { 
                    $('#reportHistoryTable').html(res)
                })
                // $("#loader").hide();
                .fail(function(err) {
                    // $("#loader").hide();
                });
        }
        // close 

        // var i = 10;

        // function onTimer() {
        //     if (localStorage.getItem('timer') > 1) {
        //         i = localStorage.getItem('timer')
        //         $('#buttonExtract').attr('disabled', true)

        //         // document.getElementById('buttonTimer').innerHTML = i;
        //     }  

        //         document.getElementById('buttonTimer').innerHTML = i;


        //     i--;
        //     if (i < 1) {
        //         document.getElementById('buttonTimer').innerHTML = '';
        //         $('#buttonExtract').attr('disabled', false)
        //         clearInterval(i);
        //     } else {
        //         localStorage.setItem('timer', i)
        //         setTimeout(onTimer, 1000);
        //     }
        // }
        // report download ajax function starts 
        // function downloadReportAjaxCall(elem, fileName) {
        //     console.log('hi')
        //     $.ajax({
        //             url: "{{ route('download-report') }}",
        //             type: "GET",
        //             xhrFields: {
        //                 responseType: 'blob'
        //             },
        //             data: {
        //                 _token: token,
        //                 file_name: fileName,
        //             },
        //         })
        //         .done(function(res) {
        //             var url = window.URL.createObjectURL(res);r
        //             window.open(url)
        //             // var link = document.createElement('a');
        //             // var filename = "data.xlsx";
        //             // link.href = url;
        //             // link.setAttribute('download', filename);
        //             // document.body.appendChild(link);
        //             // link.click();
        //         })
        //         .fail(function(err) {
        //             $("#loader").hide();
        //         });
        // }
        // close 
        
    </script>
@endsection
