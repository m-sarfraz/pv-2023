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
                                        <input type="text" name="REF_CODE" placeholder="search keyword" required=""
                                            class="form-control h-px-20_custom border" value="" />
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group mb-0">
                                        <label class="d-block font-size-3 mb-0">
                                            # of Records Found:
                                        </label>
                                        <input type="text" name="REF_CODE" value="" disabled="" required=""
                                            class="form-control h-px-20_custom border" />
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
                                            class="select2_dropdown w-100 form-control" multiple onchange="Filter_user()">
                                            @foreach ($candidateDomain->options as $render_domain)

                                                <option value="{{ $render_domain->option_name }}">
                                                    {{ $render_domain->option_name }}
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
                                            multiple onchange="Filter_user()">
                                            @foreach ($segments->options as $segmentsrender)

                                                <option value="{{ $segmentsrender->option_name }}">
                                                    {{ $segmentsrender->option_name }}
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
                                            S-Segment
                                        </label>
                                        <select multiple name="sub_segment" id="sub_segment" class="select2_dropdown  w-100"
                                            onchange="Filter_user()">
                                            @foreach ($sub_segment->options as $sub_segmentOption)
                                                <option value="{{ $sub_segmentOption->option_name }}">
                                                    {{ $sub_segmentOption->option_name }}
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
                                            @foreach ($position_title->options as $position_titleOption)
                                                <option value="{{ $position_titleOption->option_name }}">
                                                    {{ $position_titleOption->option_name }}
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
                                            Career 1 level:
                                        </label>
                                        <select multiple name="career_level" id="career_level"
                                            class="select2_dropdown  w-100" onchange="Filter_user()">
                                            @foreach ($CareerLevel->options as $CareerLevelOptions)
                                                <option value="{{ $CareerLevelOptions->option_name }}">
                                                    {{ $CareerLevelOptions->option_name }}
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
                                            <option value="Lahore"> Lahore</option>
                                            <option value="faisalabad"> faisalabad</option>
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
                                <th class="ant-table-cell">carrer Level</th>
                                <th class="ant-table-cell">Position title</th>
                                <th class="ant-table-cell">Budget</th>
                                <th class="ant-table-cell">Location</th>
                                <th class="ant-table-cell">Work shed</th>
                                <th class="ant-table-cell">Priorty</th>
                                <th class="ant-table-cell">Status</th>
                                <th class="ant-table-cell ant-table-cell-scrollbar"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($Userdata as $renderIndex)

                                <tr onclick="Filter('{{ $renderIndex->cid }}')">
                                    <!-- Table data 1 -->
                                    <td>{{ $renderIndex->client }}</td>
                                    <td>{{ $renderIndex->segment }}</td>
                                    <td>{{ $renderIndex->sub_segment }}</td>
                                    <td>{{ $renderIndex->career_finance }}</td>
                                    <td>{{ $renderIndex->position_title }}</td>
                                    <td>no data</td>
                                    <td>{{ $renderIndex->address }}</td>
                                    <td>no data</td>
                                    <td>no data</td>
                                    <td>no data</td>
                                </tr>
                            @endforeach

                        </tbody>
                        </table>
                    </div>
                </div>
                <!-- Datatable code end-->
                <!-- ================= -->
                {{ $Userdata->links() }}


            </div>
            <div class="col-lg-6" id="record_detail">
                <p class="C-Heading">Requirement Details:</p>
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
                                            <label class="Label"># of Endo:</label>
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
                                                Carrer Level
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
                                                placeholder="Enter Interview Notes"></textarea>
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
                                                placeholder="Enter Interview Notes"></textarea>
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
                                                placeholder="Enter Interview Notes"></textarea>
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
        function Filter(id) {

            // show loader for waiting
            $("#loader").show();
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

            $("#loader").show();
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
    </script>
@endsection
