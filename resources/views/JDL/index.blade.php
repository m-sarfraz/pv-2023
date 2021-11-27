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
            margin-left: auto;
        }

        .hideID:first-child,
        .hidetrID tr td:first-child {
            display: none !important;
        }

        .hidetrID tr:hover {
            background-color: rgb(159, 165, 243);
        }

        .tooltiptext {
            display: none;
            position: absolute;
            z-index: 100;
            border: 1px;
            background-color: #eee;
            border-style: solid;
            border-width: 1px;
            /* border-color:blue; */
            border-radius: 6px;
            padding: 3px;
            color: rgb(0, 0, 0);
            top: 20px;
            left: 20px;
        }

        .tooltip1:hover span.tooltiptext {
            display: block;
        }

        .tooltip:hover span.tooltiptext {
            display: block;
        }

        th.tooltip1 {
            position: relative;
            z-index: 37;
        }

    </style>
@endsection


@section('content')
    <div class="container-fluid">
        <div class="row m-0 pt-4">
            <div class="col-lg-6">
                <p class="C-Heading">Requirements Finder:</p>
                <div class="card mb-13">
                    <div id="loader1" style="display: block;"></div>
                    <div class="card-body">
                        <form action="">
                            <div class="row mb-4">
                                <div class="col-lg-6">
                                    <div class="form-group mb-0">
                                        <label class="d-block font-size-3 mb-0">
                                            Search (keyword):
                                        </label>
                                        <input type="text" name="searchKeyword" placeholder="search keyword"
                                            id="searchKeyword" required="" class="form-control h-px-20_custom border"
                                            value="" />
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group mb-0">
                                        <label class="d-block font-size-3 mb-0">

                                            Number Of Records Found:
                                        </label>
                                        <input type="text" name="No_of_count" id="No_of_count" disabled="" required=""
                                            class="form-control h-px-20_custom border" value="" />
                                    </div>
                                </div>
                            </div>
                            <p class="mb-0 pt-2">Filter by:</p>
                            <div class="row mb-1 align-items-center">
                                <div class="col-lg-6">
                                    <div class="form-group mb-0">

                                        <label class="d-block font-size-3 mb-0">
                                            Client:
                                        </label>
                                        <select multiple name="client" id="client" class="select2_dropdown  w-100" onchange="Filter_user()" >

                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group mb-0 pt-1">

                                        <label class="d-block font-size-3 Label labelFontSize mb-0">
                                            Domain
                                        </label>
                                        <select name="candidateDomain" id="candidateDomain"
                                            class="select2_dropdown w-100 form-control" multiple onchange="Filter_user()">

                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-1 align-items-center">
                                <div class="col-lg-6">
                                    <div class="form-group mb-0">
                                        <label class="d-block font-size-3 Label labelFontSize mb-0">
                                            Segment
                                        </label>
                                        <select name="segment" id="segment" class="select2_dropdown w-100 form-control"
                                            multiple onchange="Filter_user()">
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group mb-0">

                                        <label class="d-block font-size-3 mb-0">
                                            Sub Segment
                                        </label>
                                        <select multiple name="sub_segment" id="sub_segment" class="select2_dropdown  w-100"
                                            onchange="Filter_user()">

                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-1 align-items-center">
                                <div class="col-lg-6">
                                    <div class="form-group mb-0">

                                        <label class="d-block font-size-3 mb-0">
                                            Position
                                        </label>
                                        <select multiple name="position_title" id="position_title"
                                            class="select2_dropdown  w-100" onchange="Filter_user()">

                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group mb-0">

                                        <label class="d-block font-size-3 mb-0 pt-lg-1 pt-sm-0 pt-0">
                                            Career Level:
                                        </label>
                                        <select multiple name="career_level" id="career_level"
                                            class="select2_dropdown  w-100" onchange="Filter_user()">

                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-1 align-items-center">
                                <div class="col-lg-6">
                                    <div class="form-group mb-0 pt-1">
                                        @php
                                            $status = Helper::get_dropdown('status');
                                        @endphp
                                        <label class="d-block font-size-3 mb-0 Label labelFontSize">
                                            Status
                                        </label>
                                        <select name="status" id="status" class="select2_dropdown w-100 form-control"
                                            multiple onchange="Filter_user()">
                                            @foreach ($status->options as $render_status)
                                                <option value="{{ $render_status->option_name }}">
                                                    {{ $render_status->option_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group mb-0">
                                        <label class="Label labelFontSize">Location</label>
                                        <select name="location" id="location" class="select2_dropdown w-100 form-control"
                                            multiple onchange="Filter_user()">

                                        </select>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>


                <!-- ================= -->
                <!-- Datatable code start-->
                <div class="table-responsive border-right pt-3" id="filter_table_div">
                    <div class="">
                        <table id="jdlTable" class="table">
                            <thead class="bg-light w-100">
                                <tr style="border-bottom: 3px solid white;border-top: 3px solid white; white-space:nowrap">
                                    <th class="ant-table-cell hideID">id</th>
                                    <th class="ant-table-cell">Sr</th>
                                    <th class="ant-table-cell">Client</th>
                                    <th class="ant-table-cell">Segment</th>
                                    <th class="ant-table-cell">S segment</th>
                                    <th class="ant-table-cell">Career Level</th>
                                    <th class="ant-table-cell">Position Title</th>
                                    <th class="tooltip1">MOR <span class="tooltiptext">Maturity Of
                                            Requirement</span></th>
                                    <th class="ant-table-cell">Budget</th>
                                    <th class="ant-table-cell">Location</th>
                                    <th class="ant-table-cell">Work Sched</th>
                                    <th class="ant-table-cell">Status</th>
                                    <th class="ant-table-cell"> Priority</th>
                                    {{-- <th class="ant-table-cell ant-table-cell-scrollbar"></th> --}}
                                </tr>
                            </thead>
                            <tbody class="hidetrID" style="height:100px">
                            </tbody>
                        </table>
                    </div>
                    {{-- {{ $Userdata->links() }} --}}
                </div>
                <!-- Datatable code end-->
                <!-- ================= -->



            </div>
            <div class="col-lg-6" id="record_detail">
                <p class="C-Heading">Record Details:</p>
                <div class="card mb-13">
                    <div class="card-body">
                        <form action="">
                            <fieldset disabled="">
                                <div class="row mb-1">
                                    <div class="col-lg-4">
                                        <div class="form-group mb-0">
                                            <label class="Label">
                                                Position Title
                                            </label>
                                            <input type="text" class="form-control users-input-S-C" />
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group mb-0">
                                            <label class="Label">Priority</label>
                                            <input type="text" class="form-control users-input-S-C" />
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group mb-0">
                                            <label class="Label">FTE:</label>
                                            <input type="text" class="form-control users-input-S-C" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-1">
                                    <div class="col-lg-4">
                                        <div class="form-group mb-0">
                                            <label class="Label">No of Endo:</label>
                                            <input type="text" class="form-control users-input-S-C" />
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group mb-0">
                                            <label class="d-block font-size-3 mb-0">
                                                Client:
                                            </label>
                                            <input type="text" class="form-control users-input-S-C" />
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group mb-0">
                                            <label class="d-block font-size-3 mb-0">
                                                Segment
                                            </label>
                                            <input type="text" class="form-control users-input-S-C" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-1">
                                    <div class="col-lg-4">
                                        <div class="form-group mb-0">
                                            <label class="d-block font-size-3 mb-0">
                                                Sub-Segment
                                            </label>
                                            <input type="text" class="form-control users-input-S-C" />
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group mb-0">
                                            <label class="d-block font-size-3 mb-0">
                                                Start Date
                                            </label>
                                            <input type="text" class="form-control users-input-S-C" />
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group mb-0">
                                            <label class="d-block font-size-3 mb-0">
                                                Career Level
                                            </label>
                                            <input type="text" class="form-control users-input-S-C" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-1">
                                    <div class="col-lg-4">
                                        <div class="form-group mb-0">
                                            <label class="Label">SLL No:</label>
                                            <input type="text" class="form-control users-input-S-C" />
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group mb-0">
                                            <label class="Label">Location:</label>
                                            <input type="text" class="form-control users-input-S-C" />
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group mb-0">
                                            <label class="Label">
                                                Work Schedule:
                                            </label>
                                            <input type="text" class="form-control users-input-S-C" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-1">
                                    <div class="col-lg-6">
                                        <div class="form-group mb-0">
                                            <label class="Label">Budget:</label>
                                            <input type="text" class="form-control users-input-S-C" />
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group mb-0">
                                            <label class="Label">
                                                Educational Background:
                                            </label>
                                            <input type="text" class="form-control users-input-S-C" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-1">
                                    <div class="col-lg-12">
                                        <div class="form-group mb-0">
                                            <label class="d-block font-size-3 mb-0">
                                                Job Description &amp; Work Experience:
                                            </label>
                                            <textarea name="EMPLOYMENT_HISTORY" rows="3" type="text"
                                                class="form-control border E_H h-px-20_custom"
                                                placeholder="Job Description &amp; Work Experience"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-1">
                                    <div class="col-lg-6">
                                        <div class="form-group mb-0">
                                            <label class="d-block font-size-3 mb-0">
                                                Recruitment Process:
                                            </label>
                                            <textarea name="EMPLOYMENT_HISTORY" rows="3" type="text"
                                                class="form-control border E_H h-px-20_custom"
                                                placeholder="Enter  Recruitment Process"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group mb-0">
                                            <label class="d-block font-size-3 mb-0">
                                                Notes:
                                            </label>
                                            <textarea name="EMPLOYMENT_HISTORY" rows="3" type="text"
                                                class="form-control border E_H h-px-20_custom"
                                                placeholder="Enter Interview Notes"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-1">
                                    <div class="col-lg-6">
                                        <div class="form-group mb-0">
                                            <label class="d-block font-size-3 mb-0">
                                                Assigned Recruiters:
                                            </label>
                                            <textarea name="EMPLOYMENT_HISTORY" rows="3" type="text"
                                                class="form-control border E_H h-px-20_custom"
                                                placeholder=" Assigned Recruiters"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group mb-0">
                                            <label class="d-block font-size-3 mb-0">
                                                Updated Date:
                                            </label>
                                            <input type="date" name="UPDATED_DATE"
                                                class="form-control border h-px-20_custom" />
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection


@section('script')
    <!-- ================= -->
    <!-- Datatable js start-->
    <script src="{{ asset('assets/plugins/data-tables/script/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/data-tables/script/datatables-bs4/js/dataTables.bootstrap4.min.js') }}">
    </script>
    <script src="{{ asset('assets/plugins/data-tables/script/datatables-responsive/js/dataTables.responsive.min.js') }}">
    </script>
    <script src="{{ asset('assets/plugins/data-tables/script/datatables-responsive/js/responsive.bootstrap4.min.js') }}">
    </script>
    <script>
        $(document).ready(function() {
            load_datatable()
            appendJdlOptions()
            $('#jdlTable_filter').hide('div');
        })
        select2Dropdown("select2_dropdown");
        // count total number of records coming from data table with interval starts
        function appendJdlOptions() {
            $.ajax({
                    type: "GET",
                    url: '{{ url('admin/appendJdlOptions') }}',
                })
                .done(function(res) {
                    for (let i = 0; i < res.client.length; i++) {
                        if (res.client[i].client != '') {
                            $('#client').append('<option value="' + res.client[i].client + '">' +
                                res.client[i].client + '</option>')
                        }
                    }
                    for (let i = 0; i < res.domains.length; i++) {
                        if (res.domains[i].domain != '') {
                            $('#candidateDomain').append('<option value="' + res.domains[i].domain + '">' + res.domains[
                                    i]
                                .domain +
                                '</option>')
                        }
                    }
                    for (let i = 0; i < res.segment.length; i++) {
                        if (res.segment[i].segment != '') {
                            $('#segment').append('<option value="' + res.segment[i].segment + '">' + res.segment[i]
                                .segment + '</option>')
                        }
                    }
                    for (let i = 0; i < res.subSegment.length; i++) {
                        if (res.subSegment[i].subsegment != '') {

                            $('#sub_segment').append('<option value="' + res.subSegment[i].subsegment + '">' +
                                res.subSegment[i].subsegment + '</option>')
                        }
                    }
                    for (let i = 0; i < res.position_title.length; i++) {
                        if (res.position_title[i].p_title != '') {
                            $('#position_title').append('<option value="' + res.position_title[i].p_title + '">' +
                                res.position_title[i].p_title + '</option>')
                        }
                    }
                    for (let i = 0; i < res.career_level.length; i++) {
                        if (res.career_level[i].c_level != '') {
                            $('#career_level').append('<option value="' + res.career_level[i].c_level + '">' +
                                res.career_level[i].c_level + '</option>')
                        }
                    }
                    for (let i = 0; i < res.location.length; i++) {
                        if (res.location[i].location != '') {
                            $('#location').append('<option value="' + res.location[i].location + '">' +
                                res.location[i].location + '</option>')
                        }
                    }
                    $('#loader1').hide()
                })
                .fail(function(err) {
                    console.log(err);
                });
        }
        setInterval(function() {
            let tableID = $('#filter_table_div').children().children().attr('id')
            if (tableID == 'jdlTable_wrapper') {
                countRecord()
            }
            if (tableID == 'filteredJdlTable_wrapper') {
                countRecordFilter()
            }
        }, 2000);

        // count record on page load 
        function countRecord() {
            var count = $('#jdlTable_info').text().split(' ');
            $('#No_of_count').val(count[5])
        }
        // close 

        // count record of filtered data
        function countRecordFilter() {
            var count = $('#filteredJdlTable_info').text().split(' ');
            $('#No_of_count').val(count[5])
        }
        // close 
        $('#jdlTable').on('click', 'tbody tr', function() {
            // $(this).css('background-color','red')
            $('tr').removeClass('hover-primary1');
            $(this).addClass('hover-primary1');
            let tdVal = $(this).children()[0];
            var id = tdVal.innerHTML
            Filter(this, id)
            // alert($(this).val())
        })

        function load_datatable() {
            var option_table = $('#jdlTable').DataTable({
                destroy: true,
                processing: true,
                serverSide: true,
                "language": {
                    processing: '<div class="spinner-border mr-3" role="status"> </div><span>Processing ...</span>'
                },

                ajax: {
                    url: "{{ route('view-jdl-table') }}",
                    type: "GET",
                },
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'client',
                        name: 'client'
                    },
                    {
                        data: 'segment',
                        name: 'segment',
                        // searchable: false,
                        // orderable: false
                    },
                    {
                        data: 'subsegment',
                        name: 'subsegment'
                    },
                    {
                        data: 'c_level',
                        name: 'c_level'
                    },
                    {
                        data: 'p_title',
                        name: 'p_title'
                    },
                    {
                        data: 'maturity',
                        name: 'maturity'
                    },
                    {
                        data: 'budget',
                        name: 'budget'
                    },
                    {
                        data: 'location',
                        name: 'location'
                    },
                    {
                        data: 'w_schedule',
                        name: 'w_schedule'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'priority',
                        name: 'priority'
                    },
                ]
            });
        }

        function load_datatable1() {
            searchKeyword = $('#searchKeyword').val();
            client = $('#client').val();
            candidateDomain = $('#candidateDomain').val();
            segment = $('#segment').val();
            sub_segment = $('#sub_segment').val();
            position_title = $('#position_title').val();
            career_level = $('#career_level').val();
            status = $('#status').val();
            address = $('#location').val();
            var option_table = $('#filteredJdlTable').DataTable({
                destroy: true,
                processing: true,
                serverSide: false,
                "language": {
                    processing: '<div class="spinner-border mr-3" role="status"> </div><span>Processing ...</span>'
                },

                ajax: {
                    url: "{{ route('view-jdl-filter-table') }}",
                    type: "GET",
                    data: {
                        _token: token,
                        // searchKeyword: searchKeyword,
                        client: client,
                        candidateDomain: candidateDomain,
                        segment: segment,
                        sub_segment: sub_segment,
                        position_title: position_title,
                        career_level: career_level,
                        address: address,
                        status: status,
                    },
                },
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'client',
                        name: 'client'
                    },
                    {
                        data: 'segment',
                        name: 'segment',
                        // searchable: false,
                        // orderable: false
                    },
                    {
                        data: 'subsegment',
                        name: 'subsegment'
                    },
                    {
                        data: 'c_level',
                        name: 'c_level'
                    },
                    {
                        data: 'p_title',
                        name: 'p_title'
                    },
                    {
                        data: 'maturity',
                        name: 'maturity'
                    },
                    {
                        data: 'budget',
                        name: 'budget'
                    },
                    {
                        data: 'location',
                        name: 'location'
                    },
                    {
                        data: 'w_schedule',
                        name: 'w_schedule'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'priority',
                        name: 'priority'
                    },
                ]
            });
        }
        $('#searchKeyword').on("input", function() {
            $('#jdlTable_filter').children().children().val($('#searchKeyword').val());
            $('#filteredJdlTable_filter').children().children().val($('#searchKeyword').val());
            $('#jdlTable_filter').children().children().focus();
            $('#filteredJdlTable_filter').children().children().focus();
            $('#searchKeyword').focus();
            $('#jdlTable_filter').children().children().trigger('input');
            $('#filteredJdlTable_filter').children().children().trigger('input');
            $('#jdlTable_filter').hide('div');
            $('#filteredJdlTable_filter').hide('div');
        });

        function Filter(elem, id) {
            $('.common-tr').removeClass('hover-primary1');
            $(elem).addClass('hover-primary1');
            $("#loader").show();
            // show loader for waiting

            // call Ajax whihc will return view of detail data of user
            $.ajax({
                type: "GET",
                url: "{{ url('admin/jdl_filter_records_detail') }}",
                data: {
                    _token: token,
                    id: id,
                },

                // Ajax Success funciton
                success: function(data) {

                    // append retured view view to div 
                    $('#record_detail').html('');
                    $('#record_detail').html(data);
                    $("#loader").hide();

                },
            });
        }

        function Filter_user() {

            // if ($('#searchKeyword').val() == '' && $('#client').val() == '' && $('#candidateDomain').val() == '' &&
            //     $('#segment').val() == '' && $('#sub_segment').val() == '' && $('#position_title').val() == '' && $(
            //         '#position_title').val() == '' &&
            //     $('#career_level').val() == '' && $('#status').val() == '' && $('#location').val() == '') {
            //     location.reload();
            // }
            $("#loader").show();
            $('#searchKeyword').val('');
            client = $('#client').val();
            candidateDomain = $('#candidateDomain').val();
            segment = $('#segment').val();
            sub_segment = $('#sub_segment').val();
            position_title = $('#position_title').val();
            career_level = $('#career_level').val();
            status = $('#status').val();
            address = $('#location').val();

            // call Ajax for returning the data as view
            $.ajax({
                type: "GET",
                url: "{{ url('admin/filter_records_jdl') }}",
                data: {
                    _token: token,
                    // searchKeyword: searchKeyword,
                    client: client,
                    candidateDomain: candidateDomain,
                    segment: segment,
                    sub_segment: sub_segment,
                    position_title: position_title,
                    career_level: career_level,
                    address: address,
                    status: status,
                },

                // Success fucniton of Ajax
                success: function(data) {

                    if (data) {

                        $('#filter_table_div').html(' ');
                        $('#filter_table_div').html(data);
                        if (data.count != undefined) {

                            $('#No_of_count').val(data.count);
                        }
                        $("#loader").hide();
                    }
                    if (data.sms) {

                        // Show notification message if fields are empty in candidate position fields
                        $('#filter_table_div').html(`
                        <table id=" example1" class="table">
            <thead class="bg-light w-100">
                <tr style="border-bottom: 3px solid white;border-top: 3px solid white; white-space:nowrap">
                    <th class="ant-table-cell">Client</th>
                    <th class="ant-table-cell">Segment</th>
                    <th class="ant-table-cell">Sub Segment</th>
                    <th class="ant-table-cell">Career Level</th>
                    <th class="ant-table-cell">Position Title</th>
                    <th class="ant-table-cell">Budget</th>
                    <th class="ant-table-cell">Location</th>
                    <th class="ant-table-cell">Work Sched</th>
                    <th class="ant-table-cell">Priorty</th>
                    <th class="ant-table-cell">Maturity Of Requirement</th>
                    <th class="ant-table-cell">Status</th>
                    <th class="ant-table-cell ant-table-cell-scrollbar"></th>
                </tr>
            </thead>
            <tbody>
            <tr>
            <td colspan='8' class='text-center'>
            no data found according to this search
            </td>
            </tr>
            </tbody>
            </table>
                        
                        `);
                    }
                },
            });
        }
    </script>
@endsection
