@extends('layouts.app')
@section('style')
    <!-- ================= -->
    <!-- Datatable css start-->
    <link rel="stylesheet" href="{{ asset('assets/css/jquery.dataTables.min.css') }}" />

    <!-- Datatable css end-->
    <!-- ================= -->
    <style>
        button.dt-button.buttons-columnVisibility:not(.active) {
            background-color: #e8e8e8 !important;
            background: #e8e8e8 !important;
            color: black !important;
        }

        button.dt-button.buttons-columnVisibility {
            background-color: #dc8627 !important;
            background: #dc8627 !important;
            color: white !important;
        }

        #filteredJdlTable td {
            text-align: center;
            max-width: 40ch;
            text-overflow: ellipsis;
            white-space: nowrap;
            overflow: hidden;
        }

        #jdlTable td {
            text-align: center;
            max-width: 40ch;
            text-overflow: ellipsis;
            white-space: nowrap;
            overflow: hidden;
        }

        .row {
            margin: 0px !important;
        }

        #example1_filter label {
            display: flex;
            width: fit-content;
            margin-left: auto;
        }

        table th.resizing {
            cursor: col-resize;
        }

        /* overflow: hidden;
                                                                                                                                                                                                                                                                                                                                                                                                    text-overflow: ellipsis;
                                                                                                                                                                                                                                                                                                                                                                                                    /* height: 113px; */
        .hidetrID tr td:nth-child(17),
        .hidetrID tr td:nth-child(12),
        .hidetrID tr td:nth-child(3),
        .hidetrID tr td:nth-child(18) {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 30ch;
        }

        .hideID:first-child,
        .hidetrID tr td:first-child {
            display: none !important;
        }

        .hideID:first-child,
        .hidetrID tr td:nth-child(6),
        .hidetrID tr td:nth-child(8) {
            text-align: center !important;
        }

        option_table.fixedHeader-floating {
            position: fixed !important;
            background-color: white
        }

        option_table.fixedHeader-floating.no-footer {
            border-bottom-width: 0
        }

        option_table.fixedHeader-locked {
            position: absolute !important;
            background-color: white
        }

        @media print {
            option_table.fixedHeader-floating {
                display: none
            }
        }

        /* .hidetrID tr td{
                                                                                                                                                                                                                                                                                                                                                                                                        white-space: nowrap !important;
                                                                                                                                                                                                                                                                                                                                                                                                        } */
        #jdlTable thead tr th,
        #jdlTable tbody tr td {
            width: fit-content;

        }

        .hidetrID tr:hover {
            background-color: rgb(220 134 39) !important;
            color: white;

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

        /* .customWidth {
                                                                                                                                                                                                                                                                                                                                                                                                                width: 410px !important;
                                                                                                                                                                                                                                                                                                                                                                                                            } */

        /* Styling for the modal */
        .modal {
            display: none;
            position: fixed;
            z-index: 9999;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #be1717;
            width: 30%;
        }

        .modal-title {
            text-align: center;
        }

        /* Hide the modal when not visible */
        .hidden {
            display: none;
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


        th {
            padding: 8px;
            border: 1px solid silver;
        }



        pre {
            margin: 20px;
            padding: 10px;
            background: #eee;
            border: 1px solid silver;
            border-radius: 4px;
        }

        /*
                                                                                                                                                                                                                                                                                                                                                                                                               this is important!
                                                                                                                                                                                                                                                                                                                                                                                                               make sure you define this here
                                                                                                                                                                                                                                                                                                                                                                                                               or in jQuery codef
                                                                                                                                                                                                                                                                                                                                                                                                            */
        .resizer {
            position: absolute;
            top: 0;
            right: -8px;
            bottom: 0;
            left: auto;
            width: 16px;
            cursor: col-resize;
        }

        .tableFixHead {
            overflow-y: auto;
            height: 600px;
        }

        .tableFixHead thead th {
            position: sticky;
            top: -10px;
        }
    </style>
@endsection


@section('content')
    <div class="container-fluid">
        <div id="loader"></div>
        <div class="row m-0 pt-4">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-6">
                        <p class="C-Heading">Requirements Finder:</p>
                    </div>
                    <div class="col-lg-6 text-right">
                        <a href="{{ route('add-jdl') }}" target="_blank" rel="noopener noreferrer">
                            <button type="button" class="btn btn-sm btn-primary"
                                style="color: #fff;  background-color: #dc8627; border-color: #dc8627;" class="text-end">Add
                                a
                                Job</button>
                        </a>
                    </div>
                </div>
                <div class="card mb-13">
                    <div id="loader1" style="display: block;"></div>
                    <div class="card-body">
                        <form action="">
                            <div class="row mb-4">
                                <div class="col-lg-4">
                                    <div class="form-group mb-0">
                                        <label class="d-block font-size-3 mb-0">
                                            Search (keyword):
                                        </label>
                                        <input type="text" name="searchKeyword" placeholder="search keyword"
                                            id="searchKeyword" required="" class="form-control h-px-20_custom border"
                                            value="" />
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group mb-0">
                                        <label class="d-block font-size-3 mb-0">

                                            Number Of Records Found:
                                        </label>
                                        <input type="text" name="No_of_count" id="No_of_count" disabled=""
                                            required="" class="form-control h-px-20_custom border" value="" />
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group mb-0">
                                        <label class="d-block font-size-3 mb-0">

                                            Turn Around
                                        </label>
                                        <input type="number" name="turnAroundDays" placeholder="" id="turnAroundDays"
                                            class="form-control h-px-20_custom border" onchange="Filter_user()" />
                                    </div>
                                </div>
                            </div>
                            {{-- <p class="mb-0 pt-2">Filter by:</p> --}}
                            <div class="row mb-1 align-items-center">
                                <div class="col-lg-3">
                                    <div class="form-group mb-0">

                                        <label class="d-block font-size-3 mb-0">
                                            Client:
                                        </label>
                                        <select multiple name="client" id="client" class="select2_dropdown  w-100"
                                            onchange="Filter_user()">

                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group mb-0 pt-1">

                                        <label class="d-block font-size-3 Label labelFontSize mb-0">
                                            Domain
                                        </label>
                                        <select name="candidateDomain" id="candidateDomain"
                                            class="select2_dropdown w-100 form-control" multiple onchange="Filter_user()">

                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="form-group mb-0">
                                        <label class="d-block font-size-3 Label labelFontSize mb-0">
                                            Segment
                                        </label>
                                        <select name="segment" id="segment" class="select2_dropdown w-100 form-control"
                                            multiple onchange="Filter_user()">
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="form-group mb-0">

                                        <label class="d-block font-size-3 mb-0">
                                            Sub-Segment
                                        </label>
                                        <select multiple name="sub_segment" id="sub_segment" class="select2_dropdown  w-100"
                                            onchange="Filter_user()">

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
                                        <select multiple name="position_title" id="position_title"
                                            class="select2_dropdown  w-100" onchange="Filter_user()">

                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group mb-0">

                                        <label class="d-block font-size-3 mb-0 pt-lg-1 pt-sm-0 pt-0">
                                            Career Level:
                                        </label>
                                        <select multiple name="career_level" id="career_level"
                                            class="select2_dropdown  w-100" onchange="Filter_user()">

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
                                <div class="col-lg-3">
                                    <div class="form-group mb-0">
                                        <label class="Label labelFontSize">Location</label>
                                        <select name="location" id="location"
                                            class="select2_dropdown w-100 form-control" multiple onchange="Filter_user()">

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
                                        <select name="keyword" id="keyword" class="select2_dropdown w-100 form-control"
                                            multiple onchange="Filter_user()">

                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group mb-0">

                                        <label class="d-block font-size-3 mb-0 pt-lg-1 pt-sm-0 pt-0">
                                            Priority:
                                        </label>

                                        <select name="priority" id="priority"
                                            class="select2_dropdown w-100 form-control" multiple onchange="Filter_user()">

                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="form-group mb-0 pt-1">

                                        <label class="d-block font-size-3 mb-0 Label labelFontSize">
                                            Assignment
                                        </label>
                                        <select name="assignment" id="assignment"
                                            class="select2_dropdown w-100 form-control" multiple onchange="Filter_user()">

                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group mb-0">
                                        <label class="Label labelFontSize">Work Schedule</label>

                                        <select name="wschedule" id="wschedule"
                                            class="select2_dropdown w-100 form-control" multiple onchange="Filter_user()">

                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-12 mt-3">
                                    <div class="d-flex justify-content-end">
                                        <div class="form-group mb-0 text-right">
                                            {{-- <label class="Label-00">Agent Requiremtns Only</label>
                                            <input type="radio" id="agent" name="reqRadioCheck"
                                                onclick="Filter_user()"> --}}
                                            <button class="btn-primary btn-sm w-100 d-none" id="bulk-update-btn"
                                                onclick="showModal()" type="button"
                                                style="background-color: #ca7c27;border: #c97b26;">Bulk Update Selected
                                                Records</button>
                                        </div>
                                        {{-- <div class="form-group mb-0 text-right ml-3">
                                            <label class="Label-00">Non-Agent Requiremtns Only</label>
                                            <input type="radio" id="non-agent" name="reqRadioCheck"
                                                onclick="Filter_user()">
                                        </div> --}}
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>


                <!-- ================= -->
                <!-- Datatable code start-->
                <div class="table-responsive pt-3" id="filter_table_div">
                    <div class="tableFixHead">
                        <table id="jdlTable" class="table borderd">
                            <thead class="bg-light w-100">
                                <tr style="whitespace-nowrap; text-align:center;">
                                    <th class="ant-table-cell hideID noVis">id</th>
                                    <th class="ant-table-cell">Sr</th>
                                    <th class="ant-table-cell"> Action</th>
                                    <th class="ant-table-cell"> Priority</th>
                                    <th class="ant-table-cell">Keyword</th>
                                    <th class="ant-table-cell">Status</th>
                                    <th class="ant-table-cell">Client</th>
                                    <th class="ant-table-cell">Domain</th>
                                    <th class="ant-table-cell">Segment</th>
                                    <th class="ant-table-cell">Sub-Segment</th>
                                    <th class="ant-table-cell">Position Title</th>
                                    <th class="ant-table-cell ">Career Level</th>
                                    <th class="ant-table-cell">Job Description</th>
                                    <th class="ant-table-cell">Educational Attainment</th>
                                    <th class="ant-table-cell">Location</th>
                                    <th class="ant-table-cell">Work Schedule</th>
                                    <th class="ant-table-cell customWidth">Budget</th>
                                    <th class="ant-table-cell">Recruitment Process/POC</th>
                                    <th class="ant-table-cell">Notes</th>
                                    <th class="ant-table-cell">Start Date</th>
                                    <th class="ant-table-cell">SLL. No</th>
                                    <th class="ant-table-cell">Total FTE</th>
                                    <th class="ant-table-cell">Updated FTE</th>
                                    <th class="ant-table-cell">Ref. Code</th>
                                    <th class="ant-table-cell">Requirement Date</th>
                                    <th class="tooltip1">MOR <span class="tooltiptext">Maturity Of
                                            Requirement</span></th>
                                    <th class="ant-table-cell">Update Date</th>
                                    <th class="ant-table-cell">Closed Date</th>
                                    <th class="ant-table-cell">Old Shared Date</th>
                                    <th class="ant-table-cell">Recruiter</th>

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
        </div>
    </div>

    <div id="myModal" class="modal">
        <div class="modal-dialog m-auto" style='max-width:80%'>
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Bulk Update Fields:</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" onclick="closeModal()">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="record_detail">
                    <div class="col-lg-12">
                        <label for="inputField">Location:</label>
                        <input type="text" class="form-control" id="locationBulkUpdateInput"
                            name="locationBulkUpdateInput">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        style="background: rgb(220 134 39);color: rgb(255 255 255);border:none" data-dismiss="modal"
                        onclick="closeModal()"> Close</button>
                    <button type="button" class="btn btn-secondary"
                        style="background: rgb(220 134 39);color: rgb(255 255 255);border:none"
                        onclick="saveBulkDataAjax('{{ route('jdl-bulk-update') }}')">Save</button>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('script')
    <!-- ================= -->
    <!-- Datatable js start-->
    {{-- <script src="{{ asset('assets/plugins/data-tables/script/datatables/jquery.dataTables.min.js') }}"></script> --}}
    <script src="{{ asset('assets/plugins/data-tables/script/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
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
        var option_table = "";
        var option_table1 = "";
        // $.fn.dataTable.ext.search.push(
        //     function(settings, data, dataIndex) {
        //         if (settings.oPreviousSearch.sSearch === "")
        //             return true; // Always return true if search is blank (save processing)

        //         var search = $.fn.DataTable.util.escapeRegex(settings.oPreviousSearch.sSearch);
        //         var newFilter = data.slice();

        //         for (var i = 0; i < settings.aoColumns.length; i++) {
        //             if (!settings.aoColumns[i].bVisible) {
        //                 newFilter.splice(i, 1);
        //             }
        //         }

        //         var regex = new RegExp("^(?=.*?" + search + ").*$", "i");
        //         return regex.test(newFilter.join(" "));
        //     }
        // );
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
                    // for (let i = 0; i < res.location.length; i++) {
                    //     if (res.location[i].location != '') {
                    //         $('#location').append('<option value="' + res.location[i].location + '">' +
                    //             res.location[i].location + '</option>')
                    //     }
                    // }
                    $('#loader1').hide()
                })
                .fail(function(err) {
                    console.log(err);
                });
        }
        // setInterval(function() {
        //     let tableID = $('#filter_table_div').children().children().attr('id')
        //     if (tableID == 'jdlTable_wrapper') {
        //         countRecord()
        //     }
        //     if (tableID == 'filteredJdlTable_wrapper') {
        //         countRecordFilter()
        //     }
        // }, 2000);

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
            // Filter(this, id)
            // $('#exampleModal').modal('show');
            // alert($(this).val())
        })

        //$("td,th")
        $("th")
            .css({
                /* required to allow resizer embedding */
                position: "relative"
            })
            /* check .resizer CSS */
            .prepend("<div class='resizer'></div>")
            .resizable({
                resizeHeight: false,
                // we use the column as handle and filter
                // by the contained .resizer element
                handleSelector: "",
                onDragStart: function(e, $el, opt) {
                    // only drag resizer
                    if (!$(e.target).hasClass("resizer"))
                        return false;
                    return true;
                }
            });
        var option_table = '';

        function load_datatable() {
            option_table = $('#jdlTable').DataTable({
                destroy: true,
                search: {
                    smart: true
                },
                regex: false,
                ordering: true,
                processing: true,
                serverSide: true,

                // "language": {
                //     processing: '<div class="spinner-border mr-3" role="status"> </div><span>Processing ...</span>'
                // }, 

                ajax: {
                    url: "{{ route('view-jdl-table') }}",
                    type: "GET",
                },
                drawCallback: function(settings) {
                    $('.hidetrID').find('tr').each(function() {
                        $(this).on('dblclick', function() {
                            window.open($(this).attr('data-href'), '_blank');
                        });

                    });
                },
                createdRow: function(row, data, dataIndex) {
                    $(row).addClass('id');
                    let id = $(row).find('td:first').text().trim();
                    $(row).attr('data-href', `{{ url('admin/jdl_filter_records_detail/${id}') }}`)

                },
                initComplete: function(settings, json) {
                    $('#No_of_count').val(settings.json.totalCount)
                    // $('#searchKeyword').trigger('input');
                    $('#jdlTable').on('draw.dt', function() {
                        if (settings.oFeatures.bServerSide === true) {
                            // This condition ensures that the callback is only executed for client-side processing
                            console.log(settings.json.totalCount);
                            $('#No_of_count').val(settings.json.totalCount)
                        }
                    });
                    $('#filter_table_div').find('.dt-buttons').append(
                        '<button type=checkbox onclick="showAllColumnFunc()" class="customColumnBtn  btn btn-sm" id="selectAll">&nbsp; Show All Columns</button>'
                    )
                    $('#filter_table_div').find('.dt-buttons').append(
                        '<button type=checkbox onclick="showNoColumnFunc()" class="customColumnBtn ml-2 btn btn-sm" id="selectAll">&nbsp; Hide All Columns</button>'
                    )

                    $('#jdlTable_length').addClass('d-none');
                },
                columns: [{
                        data: 'id',
                        name: 'id',
                        searchable: false
                    },
                    {
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        searchable: false
                    },
                    {
                        data: 'action',
                        name: 'action',

                    },
                    {
                        data: 'priority',
                        name: 'priority',

                    },
                    {
                        data: 'keyword',
                        name: 'keyword',

                    },
                    {
                        data: 'status',
                        name: 'status',

                    },
                    {
                        data: 'client',
                        name: 'client',

                    },
                    {
                        data: 'domain',
                        name: 'domain',

                    },
                    {
                        data: 'segment',
                        name: 'segment',

                    },
                    {
                        data: 'subsegment',
                        name: 'subsegment',

                    },
                    {
                        data: 'p_title',
                        name: 'p_title',

                    },
                    {
                        data: 'c_level',
                        name: 'c_level',

                    },
                    {
                        data: 'jd',
                        name: 'jd',

                    },
                    {
                        data: 'edu_attainment',
                        name: 'edu_attainment',

                    },
                    {
                        data: 'location',
                        name: 'location',

                    },
                    {
                        data: 'w_schedule',
                        name: 'w_schedule',

                    },
                    {
                        data: 'budget',
                        name: 'budget',

                    },
                    {
                        data: 'poc',
                        name: 'poc',

                    },
                    {
                        data: 'note',
                        name: 'note',

                    },
                    {
                        data: 'start_date',
                        name: 'start_date',

                    },
                    {
                        data: 'sll_no',
                        name: 'sll_no',

                    },
                    {
                        data: 't_fte',
                        name: 't_fte',

                    }, {
                        data: 'updated_fte',
                        name: 'updated_fte',

                    }, {
                        data: 'ref_code',
                        name: 'ref_code',

                    }, {
                        data: 'req_date',
                        name: 'req_date',

                    }, {
                        data: 'maturity',
                        name: 'maturity',

                    }, {
                        data: 'updated_date',
                        name: 'updated_date',

                    }, {
                        data: 'closed_date',
                        name: 'closed_date',

                    }, {
                        data: 'os_date',
                        name: 'os_date',

                    }, {
                        data: 'recruiter',
                        name: 'recruiter',

                    },
                ],
                dom: 'Blfrtip',
                columnDefs: [{
                    targets: 1,
                    className: 'noVis'
                }],
                buttons: [{
                    extend: 'colvis',
                    text: 'List of Visible Coloumn Names in Current Table(Click to Deselect a Coloumn)',
                    columns: ':not(.noVis)'
                }]
            });
        }

        function load_datatable1() {
            agent = 0;
            nonAgent = 0;
            $('#agent').is(':checked') ? agent = 1 : 0;
            $('#non-agent').is(':checked') ? nonAgent = 1 : 0;
            searchKeyword = $('#searchKeyword').val();
            client = $('#client').val();
            candidateDomain = $('#candidateDomain').val();
            segment = $('#segment').val();
            sub_segment = $('#sub_segment').val();
            position_title = $('#position_title').val();
            career_level = $('#career_level').val();
            status = $('#status').val();
            address = $('#location').val();
            keyword = $('#keyword').val();
            priority = $('#priority').val();
            turnAroundDaysVar = $('#turnAroundDays').val();
            wschedule = $('#wschedule').val();
            assignment = $('#assignment').val();
            option_table = $('#filteredJdlTable').DataTable({
                destroy: true,
                // search: {
                //     smart: false
                // },
                processing: true,
                serverSide: false,

                // "language": {
                //     processing: '<div class="spinner-border mr-3" role="status"> </div><span>Processing ...</span>'
                // },

                ajax: {
                    url: "{{ route('view-jdl-filter-table') }}",
                    type: "GET",
                    data: {
                        _token: token,
                        searchKeyword: searchKeyword,
                        turnAroundDaysVar: turnAroundDaysVar,
                        agent: agent,
                        nonAgent: nonAgent,
                        client: client,
                        candidateDomain: candidateDomain,
                        segment: segment,
                        sub_segment: sub_segment,
                        position_title: position_title,
                        career_level: career_level,
                        address: address,
                        keyword: keyword,
                        priority: priority,
                        wschedule: wschedule,
                        assignment: assignment,
                        status: status,
                    },
                },
                drawCallback: function(settings) {
                    $('.hidetrID').find('tr').each(function() {
                        $(this).on('dblclick', function() {
                            window.open($(this).attr('data-href'), '_blank');
                        });

                    });
                },
                createdRow: function(row, data, dataIndex) {
                    $(row).addClass('id');
                    let id = $(row).find('td:first').text().trim();
                    $(row).attr('data-href', `{{ url('admin/jdl_filter_records_detail/${id}') }}`)

                },
                initComplete: function(settings, json) {
                    // $('#searchKeyword').trigger('input');
                    if (json.search != null) {
                        $('#searchKeyword').val(json.search)
                        $('#searchKeyword').change()
                    }
                    let tableID = $('#filter_table_div').children().children().attr('id')
                    if (tableID == 'jdlTable_wrapper') {
                        countRecord()
                    }
                    if (tableID == 'filteredJdlTable_wrapper') {
                        countRecordFilter()
                    }
                    $('#filter_table_div').find('.dt-buttons').append(
                        '<button type=checkbox onclick="showAllColumnFunc()" class="customColumnBtn  btn btn-sm" id="selectAll">&nbsp; Show All Columns</button>'
                    )
                    $('#filter_table_div').find('.dt-buttons').append(
                        '<button type=checkbox onclick="showNoColumnFunc()" class="customColumnBtn ml-2 btn btn-sm" id="selectAll">&nbsp; Hide All Columns</button>'
                    )

                    $('#filteredJdlTable_length').addClass('d-none');
                },
                columns: [{
                        data: 'id',
                        name: 'id',
                        searchable: false
                    },
                    {
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        searchable: false
                    },
                    {
                        data: 'priority',
                        name: 'priority',

                    },
                    {
                        data: 'keyword',
                        name: 'keyword',

                    },
                    {
                        data: 'status',
                        name: 'status',

                    },
                    {
                        data: 'client',
                        name: 'client',

                    },
                    {
                        data: 'domain',
                        name: 'domain',

                    },
                    {
                        data: 'segment',
                        name: 'segment',

                    },
                    {
                        data: 'subsegment',
                        name: 'subsegment',

                    },
                    {
                        data: 'p_title',
                        name: 'p_title',

                    },
                    {
                        data: 'c_level',
                        name: 'c_level',

                    },
                    {
                        data: 'jd',
                        name: 'jd',

                    },
                    {
                        data: 'edu_attainment',
                        name: 'edu_attainment',

                    },
                    {
                        data: 'location',
                        name: 'location',

                    },
                    {
                        data: 'w_schedule',
                        name: 'w_schedule',

                    },
                    {
                        data: 'budget',
                        name: 'budget',

                    },
                    {
                        data: 'poc',
                        name: 'poc',

                    },
                    {
                        data: 'note',
                        name: 'note',

                    },
                    {
                        data: 'start_date',
                        name: 'start_date',

                    },
                    {
                        data: 'sll_no',
                        name: 'sll_no',

                    },
                    {
                        data: 't_fte',
                        name: 't_fte',

                    }, {
                        data: 'updated_fte',
                        name: 'updated_fte',

                    }, {
                        data: 'ref_code',
                        name: 'ref_code',

                    }, {
                        data: 'req_date',
                        name: 'req_date',

                    }, {
                        data: 'maturity',
                        name: 'maturity',

                    }, {
                        data: 'updated_date',
                        name: 'updated_date',

                    }, {
                        data: 'closed_date',
                        name: 'closed_date',

                    }, {
                        data: 'os_date',
                        name: 'os_date',

                    }, {
                        data: 'recruiter',
                        name: 'recruiter',

                    },
                ],
                dom: 'Blfrtip',
                columnDefs: [{
                    targets: 1,
                    className: 'noVis'
                }],
                buttons: [{
                    extend: 'colvis',
                    text: 'List of Visible Coloumn Names in Current Table(Click to Deselect a Coloumn)',
                    columns: ':not(.noVis)'
                }]
            });
        }
        $('#searchKeyword').on("change", function() {
            // $('#jdlTable_filter').children().children().val($('#searchKeyword').val());
            // $('#filteredJdlTable_filter').children().children().val($('#searchKeyword').val());
            // $('#jdlTable_filter').children().children().focus();
            // $('#filteredJdlTable_filter').children().children().focus();
            // $('#searchKeyword').focus();
            // $('#jdlTable_filter').children().children().trigger('input');
            // $('#filteredJdlTable_filter').children().children().trigger('input');
            // $('#jdlTable_filter').hide('div');
            // $('#filteredJdlTable_filter').hide('div');


            $('#jdlTable_filter').children().children().val($('#searchKeyword').val());
            $('#jdlTable_filter').children().children().trigger('input');

            $('#filteredJdlTable_filter').children().children().val($('#searchKeyword').val());
            $('#filteredJdlTable_filter').children().children().trigger('input');
            let tableID = $('#filter_table_div').children().children().attr('id')
            if (tableID == 'jdlTable_wrapper') {
                countRecord()
            }
            if (tableID == 'filteredJdlTable_wrapper') {
                countRecordFilter()
            }
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
            // $('#searchKeyword').val('');
            turnAroundDaysVar = $('#turnAroundDays').val();
            client = $('#client').val();
            candidateDomain = $('#candidateDomain').val();
            segment = $('#segment').val();
            sub_segment = $('#sub_segment').val();

            position_title = $('#position_title').val();
            career_level = $('#career_level').val();
            status = $('#status').val();
            address = $('#location').val();

            keyword = $('#keyword').val();
            priority = $('#priority').val();
            wschedule = $('#wschedule').val();
            assignment = $('#assignment').val();
            console.log(turnAroundDaysVar);
            // call Ajax for returning the data as view
            $.ajax({
                type: "GET",
                url: "{{ url('admin/filter_records_jdl') }}",
                data: {
                    _token: token,
                    turnAroundDaysVar: turnAroundDaysVar,
                    client: client,
                    candidateDomain: candidateDomain,
                    segment: segment,
                    sub_segment: sub_segment,
                    position_title: position_title,
                    career_level: career_level,
                    address: address,
                    status: status,
                    keyword: keyword,
                    priority: priority,
                    assignment: assignment,
                    wschedule: wschedule,
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
                    <th class="ant-table-cell">Sub-Segment</th>
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
        var candidateIDSBulkUpdateArr = [];

        function selectDataForBulkUpdate(id) {
            if ($('.selectCheckBox').is(':checked') == false) {
                $('#bulk-update-btn').addClass('d-none');
                $('#bulk-update-btn').removeClass('d-block');
            } else {

                $('#bulk-update-btn').addClass('d-block');
                $('#bulk-update-btn').removeClass('d-none');
            }

            var index = candidateIDSBulkUpdateArr.indexOf(id);
            if (index === -1) {
                candidateIDSBulkUpdateArr.push(id);
            } else {
                candidateIDSBulkUpdateArr.splice(index, 1);
            }
            console.log(candidateIDSBulkUpdateArr);

        }

        function showModal() {
            $("#myModal").show();

        }

        function closeModal() {
            $("#myModal").hide();

        }

        function saveBulkDataAjax(route) {
            $("#myModal").hide();
            $("#loader").show();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            locationData = $('#locationBulkUpdateInput').val();
            // return;
            $.ajax({
                type: "POST",
                url: route,
                data: {
                    _token: token,
                    location: locationData,
                    idArray: candidateIDSBulkUpdateArr,
                },
                // Success fucniton of Ajax
                success: function(data) {
                    $("#loader").hide();
                    Swal.fire({
                        position: 'center',
                        icon: data.type,
                        title: data.message,
                        showConfirmButton: false,
                        timer: 1000
                    })
                    setTimeout(() => {
                        location.reload()
                    }, 1200);
                }
            });

        }
    </script>
@endsection
