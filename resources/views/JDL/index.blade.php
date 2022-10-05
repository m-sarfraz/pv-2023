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
        .hidetrID tr td:nth-child(7) , 
        .hidetrID tr td:nth-child(3), 
        .hidetrID tr td:nth-child(18) {
            white-space: nowrap;
            display: list-item;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            width: 264px !important;
            overflow:  hidden;
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

        <div class="row m-0 pt-4">
            <div class="col-lg-12">
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
                                        <input type="text" name="No_of_count" id="No_of_count" disabled=""
                                            required="" class="form-control h-px-20_custom border" value="" />
                                    </div>
                                </div>
                            </div>
                            <p class="mb-0 pt-2">Filter by:</p>
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
                <div class="table-responsive pt-3" id="filter_table_div">
                    <div class="tableFixHead">
                        <table id="jdlTable" class="table borderd">
                            <thead class="bg-light w-100">
                                <tr style="whitespace-nowrap">
                                    <th class="ant-table-cell hideID noVis">id</th>
                                    <th class="ant-table-cell">Sr</th>
                                    <th class="ant-table-cell customWidth">Budget</th>
                                    <th class="ant-table-cell ">Career Level</th>
                                    <th class="ant-table-cell">Client</th>
                                    <th class="ant-table-cell">Domain</th>
                                    <th class="ant-table-cell">Job Description</th>
                                    <th class="ant-table-cell">Keyword</th>
                                    <th class="ant-table-cell">Location</th>
                                    <th class="ant-table-cell">Notes</th>
                                    <th class="ant-table-cell">Position Title</th>
                                    <th class="ant-table-cell"> Priority</th>
                                    <th class="ant-table-cell">Segment</th>
                                    <th class="ant-table-cell">SLL. No</th>
                                    <th class="ant-table-cell">Start Date</th>
                                    <th class="ant-table-cell">Status</th>
                                    <th class="ant-table-cell">Sub-Segment</th>
                                    <th class="ant-table-cell">Work Schedule</th>
                                    <th class="tooltip1">MOR <span class="tooltiptext">Maturity Of
                                            Requirement</span></th>
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


    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog m-auto" style='max-width:80%'>
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Record Details:</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="record_detail"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        style="background: rgb(220 134 39);color: rgb(255 255 255);border:none"
                        data-dismiss="modal">Close</button>
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
            Filter(this, id)
            $('#exampleModal').modal('show');
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

        function load_datatable() {
            option_table = $('#jdlTable').DataTable({
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
                    url: "{{ route('view-jdl-table') }}",
                    type: "GET",
                },
                initComplete: function(settings, json) {
                    // $('#searchKeyword').trigger('input');
                    let tableID = $('#filter_table_div').children().children().attr('id')
                    if (tableID == 'jdlTable_wrapper') {
                        countRecord()
                    }
                    if (tableID == 'filteredJdlTable_wrapper') {
                        countRecordFilter()
                    }
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
                        data: 'budget',
                        name: 'budget',

                    },
                    {
                        data: 'c_level',
                        name: 'c_level',

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
                        data: 'jd',
                        name: 'jd',

                    },
                    {
                        data: 'keyword',
                        name: 'keyword',

                    },
                    {
                        data: 'location',
                        name: 'location',

                    },
                    {
                        data: 'note',
                        name: 'note',

                    },
                    {
                        data: 'p_title',
                        name: 'p_title',

                    },
                    {
                        data: 'priority',
                        name: 'priority',

                    },
                    {
                        data: 'segment',
                        name: 'segment',

                    },
                    {
                        data: 'sll_no',
                        name: 'sll_no',

                    },
                    {
                        data: 'start_date',
                        name: 'start_date',

                    },
                    {
                        data: 'status',
                        name: 'status',

                    },
                    {
                        data: 'subsegment',
                        name: 'subsegment',

                    },
                    {
                        data: 'w_schedule',
                        name: 'w_schedule',

                    },
                    {
                        data: 'maturity',
                        name: 'maturity',

                    }
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
            searchKeyword = $('#searchKeyword').val();
            client = $('#client').val();
            candidateDomain = $('#candidateDomain').val();
            segment = $('#segment').val();
            sub_segment = $('#sub_segment').val();
            position_title = $('#position_title').val();
            career_level = $('#career_level').val();
            status = $('#status').val();
            address = $('#location').val();
            option_table1 = $('#filteredJdlTable').DataTable({
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
                createdRow: function(row, data, dataIndex) {
                    $(row).addClass('id');
                },
                initComplete: function(settings, json) {
                    // $('#searchKeyword').trigger('input');
                    $('#searchKeyword').val(json.search)
                    $('#searchKeyword').change()
                    let tableID = $('#filter_table_div').children().children().attr('id')
                    if (tableID == 'jdlTable_wrapper') {
                        countRecord()
                    }
                    if (tableID == 'filteredJdlTable_wrapper') {
                        countRecordFilter()
                    }
                },
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        searchable: false
                    },
                    {
                        data: 'budget',
                        name: 'budget',
                    },
                    {
                        data: 'c_level',
                        name: 'c_level',
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
                        data: 'jd',
                        name: 'jd',
                    },
                    {
                        data: 'keyword',
                        name: 'keyword',
                    },
                    {
                        data: 'location',
                        name: 'location',
                    },
                    {
                        data: 'note',
                        name: 'note',
                    },
                    {
                        data: 'p_title',
                        name: 'p_title',
                    },
                    {
                        data: 'priority',
                        name: 'priority',
                    },
                    {
                        data: 'segment',
                        name: 'segment',
                    },
                    {
                        data: 'sll_no',
                        name: 'sll_no',
                    },
                    {
                        data: 'start_date',
                        name: 'start_date',
                    },
                    {
                        data: 'status',
                        name: 'status',
                    },
                    {
                        data: 'subsegment',
                        name: 'subsegment',
                    },
                    {
                        data: 'w_schedule',
                        name: 'w_schedule',
                    },
                    {
                        data: 'maturity',
                        name: 'maturity',
                    }
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
    </script>
@endsection
