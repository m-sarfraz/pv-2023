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
                                            value="" onkeyup="Filter_user()" />
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group mb-0">
                                        <label class="d-block font-size-3 mb-0">

                                            Number Of Records Found:
                                        </label>
                                        <input type="text" name="No_of_count" id="No_of_count" disabled="" required=""
                                            class="form-control h-px-20_custom border" value="{{ $AllData }}" />
                                    </div>
                                </div>
                            </div>
                            <p class="mb-0 pt-2">Filter by:</p>
                            <div class="row mb-1 align-items-center">
                                <div class="col-lg-6">
                                    <div class="form-group mb-0">
                                        @php
                                            $client = Helper::get_dropdown('clients');
                                        @endphp
                                        <label class="d-block font-size-3 mb-0">
                                            Client:
                                        </label>
                                        <select multiple name="client" id="client" class="select2_dropdown  w-100"
                                            onchange="Filter_user()">
                                            @foreach ($client->options as $clientOptions)
                                                <option value="{{ $clientOptions->option_name }}">
                                                    {{ $clientOptions->option_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group mb-0 pt-1">
                                        <?php
                                        $candidateDomain = Helper::get_dropdown('domains');
                                        ?>
                                        <label class="d-block font-size-3 Label labelFontSize mb-0">
                                            Domain
                                        </label>
                                        <select name="candidateDomain" id="candidateDomain"
                                            class="select2_dropdown w-100 form-control" multiple onchange="changeDomain()">
                                            @foreach ($Alldomains as $render_domain)

                                                <option value="{{ $render_domain->domain }}">
                                                    {{ $render_domain->domain }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-1 align-items-center">
                                <div class="col-lg-6">
                                    <div class="form-group mb-0">
                                        @php
                                            $segments = Helper::get_dropdown('segments');
                                        @endphp
                                        <label class="d-block font-size-3 Label labelFontSize mb-0">
                                            Segment
                                        </label>
                                        <select name="segment" id="segment" class="select2_dropdown w-100 form-control"
                                            multiple onchange="changeValues()">
                                            @foreach ($Allsegments as $segmentsrender)

                                                <option value="{{ $segmentsrender->segment }}">
                                                    {{ $segmentsrender->segment }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group mb-0">
                                        <?php
                                        $sub_segment = Helper::get_dropdown('sub_segment');
                                        ?>
                                        <label class="d-block font-size-3 mb-0">
                                            Sub Segment
                                        </label>
                                        <select multiple name="sub_segment" id="sub_segment" class="select2_dropdown  w-100"
                                            onchange="Filter_user()">
                                            @foreach ($SubSegment as $sub_segmentOption)
                                                <option value="{{ $sub_segmentOption->subsegment }}">
                                                    {{ $sub_segmentOption->subsegment }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-1 align-items-center">
                                <div class="col-lg-6">
                                    <div class="form-group mb-0">
                                        <?php
                                        $position_title = Helper::get_dropdown('position_title');
                                        ?>
                                        <label class="d-block font-size-3 mb-0">
                                            Position
                                        </label>
                                        <select multiple name="position_title" id="position_title"
                                            class="select2_dropdown  w-100" onchange="Filter_user()">
                                            @foreach ($positions as $position_titleOption)
                                                <option value="{{ $position_titleOption->p_title }}">
                                                    {{ $position_titleOption->p_title }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group mb-0">
                                        @php
                                            $CareerLevel = Helper::get_dropdown('career_level');
                                        @endphp
                                        <label class="d-block font-size-3 mb-0 pt-lg-1 pt-sm-0 pt-0">
                                            Career Level:
                                        </label>
                                        <select multiple name="career_level" id="career_level"
                                            class="select2_dropdown  w-100" onchange="Filter_user()">
                                            @foreach ($c_levels as $CareerLevelOptions)
                                                <option value="{{ $CareerLevelOptions->c_level }}">
                                                    {{ $CareerLevelOptions->c_level }}
                                                </option>
                                            @endforeach
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
                                            @foreach ($Location as $render_Location)
                                                <option value="{{ $render_Location->location }}">
                                                    {{ $render_Location->location }}
                                                </option>
                                            @endforeach
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
                        <table id=" example1" class="table">
                            <thead class="bg-light w-100">
                                <tr style="border-bottom: 3px solid white;border-top: 3px solid white; white-space:nowrap">
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
                                    <th class="ant-table-cell">Priorty</th>
                                    <th class="ant-table-cell">Status</th>
                                    <th class="ant-table-cell ant-table-cell-scrollbar"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($Userdata as $renderIndex)

                                    <tr onclick="Filter(this,'{{ $renderIndex->id }}')"
                                        class="hover common-tr hover-primary">
                                        <!-- Table data 1 -->
                                        <td>{{ $renderIndex->client }}</td>
                                        <td>{{ $renderIndex->segment }}</td>
                                        <td>{{ $renderIndex->subsegment }}</td>
                                        <td>{{ $renderIndex->c_level }}</td>
                                        <td>{{ $renderIndex->p_title }}</td>
                                        <td>
                                            @php
                                                $date = Carbon\Carbon::parse($renderIndex->req_date);
                                                // echo  $date;
                                                
                                                $now = Carbon\Carbon::now();
                                                echo $diff = $date->diffInDays($now);
                                            @endphp
                                        </td>
                                        <td>{{ $renderIndex->budget }}</td>
                                        <td>{{ $renderIndex->location }}</td>
                                        <td>{{ $renderIndex->w_schedule }}</td>
                                        <td>{{ $renderIndex->priority }}</td>

                                        <td>{{ $renderIndex->status }}</td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                    {{ $Userdata->links() }}
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
        select2Dropdown("select2_dropdown");
    </script>
    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
            });
        });
    </script>
    <!-- Datatable js end-->
    <!-- ================= -->
    <script>
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

            if ($('#searchKeyword').val() == '' && $('#client').val() == '' && $('#candidateDomain').val() == '' &&
                $('#segment').val() == '' && $('#sub_segment').val() == '' && $('#position_title').val() == '' && $(
                    '#position_title').val() == '' &&
                $('#career_level').val() == '' && $('#status').val() == '' && $('#location').val() == '') {
                location.reload();
            }
            $("#loader").show();
            searchKeyword = $('#searchKeyword').val();
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

                // Success fucniton of Ajax
                success: function(data) {

                    $('#filter_table_div').html(' ');
                    $('#filter_table_div').html(data);

                    $("#loader").hide();
                },
            });
        }


        // function for (if domain is changed append segments acoordingly) starts
        function changeDomain() {

            let arr = $("#candidateDomain :selected").map(function(i, el) {
                return $(el).val();
            }).get();

            let uppercased = arr.map(arr => arr.toUpperCase());

            $("#segment").empty();
            let domain = {!! $Alldomains !!};
            let segment = {!! $Allsegments !!};
            domain.forEach(elementDomain => {
                segment.forEach(elementsegment => {
                    uppercased.forEach(element => {
                        if (element == elementDomain.domain_name) {
                            if (elementsegment.domain_id == elementDomain.id) {
                                $("#segment").append('<option selected value="' +
                                    elementsegment
                                    .segment_name +
                                    '">' + elementsegment.segment_name +
                                    '</option>');
                            }
                        }
                    })

                });
            });
            Filter_user();
            changeValues();
        }
        $('#client').change(function() {
            // call Ajax for returning the data as view

            $.ajax({
                type: "post",
                url: "{{ url('admin/filter_records_jdl_getclient') }}",
                data: {
                    _token: token,
                    client: $('#client').val(),

                },

                // Success fucniton of Ajax
                success: function(res) {
                    // if (res[0] == null) {
                    //     location.reload();
                    // }

                    var i;
                    let domains = {!! $candidateDomain->options !!}
                    domains.forEach(element => {

                        for (var i = 0; i < res.length; i++) {

                            if (element.option_name == res[i].domain.toUpperCase()) {

                                $("#candidateDomain").append(
                                    `<option selected   value="${element.option_name}">${element.option_name}</option>`
                                );
                                changecareer_level(res);
                                changeposition_title(res)
                                changesegmentbyClient(res)
                                changesubsegmentbyClient(res)
                                changelocation(res)
                                changestatus(res)

                            }


                        }
                    });

                }
            });
        })

        function changeValues() {

            let arr = $("#segment :selected").map(function(i, el) {
                return $(el).val();
            }).get();
            $("#sub_segment").empty();
            let segment = {!! $Allsegments !!};
            let SubSegment = {!! $SubSegment !!};
            segment.forEach(elementsegment => {
                SubSegment.forEach(elementsubsegment => {

                    arr.forEach(element => {
                        if (element === elementsegment.segment_name) {
                            if (elementsubsegment.segment_id == elementsegment.id) {
                                $("#sub_segment").append('<option  value="' +
                                    elementsubsegment.sub_segment_name +
                                    '">' + elementsubsegment.sub_segment_name +
                                    '</option>');
                            }
                        }
                    })

                });
            });
            Filter_user();

        }

        function changecareer_level(res) {

            for (var i = 0; i < res.length; i++) {
                // $('#career_level').empty();
                $('#career_level').append('<option selected  value="' +
                    res[i].c_level +
                    '">' + res[i].c_level +
                    '</option>');
            }


        }

        function changeposition_title(res) {

            for (var i = 0; i < res.length; i++) {
                $('#position_title').append('<option selected value="' +
                    res[i].p_title +
                    '">' + res[i].p_title +
                    '</option>');
            }

        }

        function changesegmentbyClient(res) {


            for (var i = 0; i < res.length; i++) {
                $('#segment').append('<option selected value="' +
                    res[i].segment +
                    '">' + res[i].segment +
                    '</option>');
            }

        }

        function changesubsegmentbyClient(res) {


            for (var i = 0; i < res.length; i++) {
                $('#sub_segment').append('<option selected value="' +
                    res[i].subsegment +
                    '">' + res[i].subsegment +
                    '</option>');

            }
        }

        function changelocation(res) {


            for (var i = 0; i < res.length; i++) {
                $('#location').append('<option selected value="' +
                    res[i].location +
                    '">' + res[i].location +
                    '</option>');

            }
        }

        function changestatus(res) {

            for (var i = 0; i < res.length; i++) {
                $('#status').append('<option selected value="' +
                    res[i].status +
                    '">' + res[i].status +
                    '</option>');

            }
        }
    </script>
@endsection
