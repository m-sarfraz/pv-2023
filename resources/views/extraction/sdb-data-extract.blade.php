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







        /* -----------------------------------------
                                                                                                                                                                                                                                                                                                                                              =CSS3 Loading animations
                                                                                                                                                                                                                                                                                                                                            -------------------------------------------- */

        /* =Elements style
                                                                                                                                                                                                                                                                                                                                            ---------------------- */
        .load-wrapp {
            float: left;
            /* width: 100px;
                                                                                                                                                                                                                                                                                                                                              height: 100px; */
            /* margin: 0 10px 10px 0; */
            /* padding: 20px 20px 20px; */
            /* border-radius: 5px; */
            /* text-align: center;
                                                                                                                                                                                                                                                                                                                                              background-color: #d8d8d8; */
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
                <div class="row mx-0 card align-items-center">
                    <div class="col-lg-12">
                        <div class=" mb-13 h-100">
                            <div class="card-body px-0">
                                <div id="loader1" style="display: block;"></div>
                                <div class="row mx-0">
                                    <div class="col-lg-6">
                                        <div class="row mx-0">
                                            <div class="col-lg-6">
                                                <div class="form-group mb-0">
                                                    <label class="Label-00">Domain:</label>
                                                    <select multiple name="domain" id="domain"
                                                        class="form-control p-0 users-input-S-C select2_dropdown w-100">

                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group mb-0">
                                                    <label class="Label-00">Client:</label>
                                                    <select multiple name="client" id="client"
                                                        class="form-control p-0 users-input-S-C select2_dropdown w-100">

                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mx-0 pt-3">
                                            <div class="col-lg-6">
                                                <div class="form-group mb-0">
                                                    <label class="Label-00">Category:</label>
                                                    <select multiple name="category" id="category"
                                                        class="form-control p-0 users-input-S-C select2_dropdown w-100">
                                                        <option value="Active - Initial Stage"> Active - Initial
                                                            Stage</option>
                                                        <option value="Active - Mid Stage">Active - Mid Stage
                                                        </option>
                                                        <option value="Active - Final Stage">Active - Final Stage
                                                        </option>
                                                        <option value="Converted - Final Stage">Converted - Final
                                                            Stage</option>
                                                        <option value="Inactive - Initial Stage">Inactive - Initial
                                                            Stage</option>
                                                        <option value="Inactive - Mid Stage">Inactive - Mid Stage
                                                        </option>
                                                        <option value="Inactive - Final Stage"> Inactive - Final
                                                            Stage</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group mb-0">
                                                    <label class="Label-00">Career Level:</label>
                                                    <select multiple name="career" id="career"
                                                        class="form-control p-0 users-input-S-C select2_dropdown w-100">

                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mx-0 pt-3">
                                            <div class="col-lg-6">
                                                <div class="form-group mb-0">
                                                    <label class="Label-00">Application status:</label>
                                                    <select multiple name="app_status" id="app_status"
                                                        class="form-control p-0 users-input-S-C select2_dropdown w-100">

                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group mb-0">
                                                    <label class="Label-00">Remarks:</label>
                                                    <select multiple name="remarks" id="remarks"
                                                        class="form-control p-0 users-input-S-C select2_dropdown w-100">

                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="row mx-0">
                                            <div class="col-lg-6">
                                                <div class="form-group mb-0">
                                                    <label class="Label-00">Start Date (Sifted):</label>
                                                    <input type="date" id="sifted_start" name="sifted_start"
                                                        class="w-100 users-input-S-C form-control" />
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group mb-0">
                                                    <label class="Label-00">End Date (Sifted):</label>
                                                    <input type="date" id="sifted_end" name="sifted_end"
                                                        class="w-100 users-input-S-C form-control" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mx-0 pt-3 justify-content-center">
                                            <div class="col-lg-6">
                                                <div class="form-group mb-0">
                                                    <label class="Label">Start Date (Onboarding)</label>
                                                    <input type="date" id="ob_start" name="ob_start"
                                                        class="w-100 users-input-S-C form-control" />
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group mb-0">
                                                    <label class="Label">End Date (Onboarding)</label>
                                                    <input type="date" id="ob_end" name="ob_end"
                                                        class="w-100 users-input-S-C form-control" />
                                                </div>
                                            </div>

                                        </div>
                                        <div class="row mx-0 pt-3 justify-content-center">
                                            <div class="col-lg-6">
                                                <div class="form-group mb-0">
                                                    <label class="Label-00">Start Date (Endo):</label>
                                                    <input type="date" id="endo_start" name="endo_start"
                                                        class="w-100 users-input-S-C form-control" />
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group mb-0">
                                                    <label class="Label-00">End Date (Endo):</label>
                                                    <input type="date" id="endo_end" name="endo_end"
                                                        class="w-100 users-input-S-C form-control" />
                                                </div>
                                            </div>
                                            <div class="text-center col-4 mt-5">
                                                <button type="buton" onclick="extractResultFunction(this)"
                                                    id="buttonExtract"
                                                    class="btn btn-warning btn btn-lg w-75 text-white">Extract
                                                    Data (SDB)
                                                    <span id="buttonTimer"></span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>

    </div>

    </div>
    </div>
    <div class="d-flex align-items-end">
        <h2 class="mt-4 mb-0 ml-3 mt-3 px-2">Extract History(SDB) </h2>
        <h4> <span>
                <a style="color:blue"
                    tooltip="Click on Extract Data button after selecting any filter,&#013; Downlaod Link will be available after report is ready to download!"
                    flow="right">
                    <i class="bi bi-info-circle"></i> </a>
            </span>
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
        select2Dropdown("select2_dropdown");
        $(document).ready(function() {
            appendFilterOptions();
            appendHistory();
            // onTimer();
        })
        //append  dropdowns
        function appendFilterOptions() {
            $.ajax({
                    type: "GET",
                    url: '{{ route('append-extract-option') }}',
                })
                .done(function(res) {
                    console.log(res.career.options[0].option_name)
                    for (let i = 0; i < res.domain.length; i++) {
                        $('#domain').append('<option value="' + res.domain[i].domain_name + '">' + res.domain[i]
                            .domain_name +
                            '</option>')
                    }
                    for (let i = 0; i < res.client.length; i++) {
                        if (res.client[i].client != '') {

                            $('#client').append('<option value="' + res.client[i].client + '">' + res.client[i].client +
                                '</option>')
                        }
                    }
                    for (let i = 0; i < res.career.options.length; i++) {
                        $('#career').append('<option value="' + res.career.options[i].option_name + '">' + res
                            .career
                            .options[i]
                            .option_name + '</option>')
                    }
                    for (let i = 0; i < res.status.options.length; i++) {
                        $('#app_status').append('<option value="' + res.status.options[i].option_name + '">' + res
                            .status.options[i].option_name + '</option>')
                    }
                    for (let i = 0; i < res.remarks.options.length; i++) {
                        $('#remarks').append('<option value="' + res.remarks.options[i].option_name + '">' + res
                            .remarks.options[i].option_name + '</option>')
                    }
                    $('#loader1').hide()
                })
                .fail(function(err) {
                    console.log(err);
                });
        }
        //close 

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
        // extract result function starts 
        function extractResultFunction(elem) {
            // $('#buttonExtract').attr('disabled', true)

            // onTimer();
            Swal.fire({
                icon: "success",
                text: "{{ __('Report has been put to Queue!') }}",
                //content: wrapper,
                icon: "success",
            });
            // appendHistory();
            // elem.preventDefault();
            // get values of selected inputs of users
            domain = $('#domain').val();
            client = $('#client').val();
            career_level = $('#career').val();
            category = $('#category').val();
            status = $('#app_status').val();
            remarks = $('#remarks').val();
            sift_start = $('#sifted_start').val();
            sift_end = $('#sifted_end').val();
            endo_start = $('#endo_start').val();
            endo_end = $('#endo_end').val();
            ob_start = $('#ob_start').val();
            ob_end = $('#ob_end').val();
            //Calling Ajax
            $.ajax({
                    url: "{{ route('extract-search-filter') }}",
                    type: "GET",
                    data: {
                        _token: token,
                        domain: domain,
                        client: client,
                        career_level: career_level,
                        category: category,
                        status: status,
                        remarks: remarks,
                        endo_start: endo_start,
                        endo_end: endo_end,
                        sift_start: sift_start,
                        sift_end: sift_end,
                        ob_start: ob_start,
                        ob_end: ob_end,
                        // searchKeyword: searchKeyword,
                    }
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
        }
        //close

        // set interval for appending the history periodically 
        setInterval(() => {
            appendHistory();
        }, 60000);
        // close 

        // append  history function 
        function appendHistory() {
            $.ajax({
                    url: "{{ route('get-report-history') }}",
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

        // function for data table 
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
            });
        });
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
    </script>
@endsection
