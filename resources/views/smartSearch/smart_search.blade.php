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

        #smTable_filter {
            visibility: hidden;
        }

        #smTable1_filter {
            visibility: hidden;
        }

    </style>
@endsection


@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-7">
                <p class="C-Heading pt-3">Record Finder:</p>
                <div class="card mb-13">
                    <div class="card-body">
                        <div id="loader1" style="display: block;"></div>
                        <form action="">
                            <div class="row mb-4">
                                <div class="col-lg-6 ">
                                    <div class="form-group mb-0">
                                        <label class="d-block font-size-3 mb-0">
                                            Search (keyword):
                                        </label>
                                        <input type="text" name="searchKeyword" id="searchKeyword"
                                            placeholder="search keyword" required=""
                                            class="form-control h-px-20_custom border" value="" />
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group mb-0">
                                        <label class="d-block font-size-3 mb-0">
                                            Number Of Records Found:
                                        </label>
                                        <input type="text" name="REF_CODE" value="" disabled="" required="" id="foundRecord"
                                            class="form-control h-px-20_custom border" />
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-lg-2">
                                    <div class="form-group mb-0">
                                        <label class="Label-00">Domain:</label>
                                        <select multiple name="DOMAIN" id="domain" required="" onchange="FilterSearch()"
                                            class="form-control p-0 users-input-S-C select2_dropdown w-100">
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group mb-0">
                                        <label class="Label-00">Recruiter:</label>
                                        <select multiple name="recruiter" id="recruiter" class="select2_dropdown  w-100"
                                            onchange="FilterSearch()" onchange="filterUserData()">
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group mb-0">
                                        <label class="Label-00">Client:</label>
                                        <select multiple name="CLIENT" id="client" onchange="FilterSearch()"
                                            class="form-control border pl-0 arrow-3 h-px-20_custom w-100 font-size-4 d-flex align-items-center select2_dropdown w-100">
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group mb-0">
                                        <label class="Label">Start Date (endorsement):</label>
                                        <input type="date" id="endo_start" class="w-100 users-input-S-C form-control"
                                            onchange="FilterSearch()" />
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group mb-0">
                                        <label class="Label">End date endorsement:</label>
                                        <input type="date" id="endo_end" class="w-100 users-input-S-C form-control"
                                            onchange="FilterSearch()" />
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-lg-2">
                                    <div class="form-group mb-0">
                                        <label class="Label">Portal</label>
                                        <select name="portal" id="portal" class="w-100 form-control"
                                            onchange="FilterSearch()">
                                            <option value="1">All</option>

                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group mb-0">

                                        <label class="Label-00">Residence:</label>
                                        <select multiple name="residence" required="" id="residence"
                                            onchange="FilterSearch()"
                                            class="form-control border h-px-20_custom select2_dropdown w-100">
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group mb-0">
                                        @php
                                            $careerLevel = Helper::get_dropdown('career_level');
                                        @endphp
                                        <label class="Label-00">Career Level:</label>
                                        <select multiple name="CAREER_LEVEL_FINANCE" required="" id="career_level"
                                            onchange="FilterSearch()"
                                            class="form-control border h-px-20_custom select2_dropdown w-100">

                                            @foreach ($careerLevel->options as $careerLevelOptions)
                                                <option value="{{ $careerLevelOptions->option_name }}">
                                                    {{ $careerLevelOptions->option_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group mb-0">
                                        <label class="Label">Start Date (Shifted):</label>
                                        <input type="date" id="Shifted_start" class="w-100 users-input-S-C form-control"
                                            onchange="FilterSearch()" />
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group mb-0">
                                        <label class="Label">End Date Shifted:</label>
                                        <input type="date" id="Shifted_end" class="w-100 users-input-S-C form-control"
                                            onchange="FilterSearch()" />
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-lg-2">
                                    <div class="form-group mb-0">
                                        <label class="Label-00">Category:</label>
                                        <select multiple name="REMARKS_FOR_FINANCE" id="category" onchange="FilterSearch()"
                                            class="select2_dropdown  w-100 form-control border pl-0 arrow-3 h-px-20_custom w-100 font-size-4 d-flex align-items-center w-100">
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group mb-0">
                                        <label class="Label-00">Status:</label>
                                        <Select multiple id="status" onchange="FilterSearch()"
                                            class="form-control border h-px-20_custom select2_dropdown w-100">
                                        </Select>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group mb-0">
                                        <label class="Label-00">Remarks:</label>
                                        <select multiple name="remarks" id="remarks" onchange="FilterSearch()"
                                            class="w-100 form-control select2_dropdown w-100">
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group mb-0">
                                        <label class="Label">Start Date (onbording):</label>
                                        <input type="date" id="ob_start" class="w-100 users-input-S-C form-control"
                                            onchange="FilterSearch()" />
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group mb-0">
                                        <label class="Label">End Date onbording:</label>
                                        <input type="date" id="ob_end" class="w-100 users-input-S-C form-control"
                                            onchange="FilterSearch()" />
                                    </div>
                                </div>

                            </div>
                            <div class="col-lg-2 ml-auto pt-3">
                                <div class="form-group mb-0 text-right">
                                    <label class="Label-00">CIP</label>
                                    <input type="checkbox" id="cip" name="cip" onclick="FilterSearch()">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- ================= -->
                <!-- Datatable code start-->
                <div class="table-responsive border-right pt-3" id="filterResult_div">
                    <div class="">
                        <table id="smTable" class="table">
                            <thead class="bg-light w-100">
                                <tr style="border-bottom: 3px solid white;border-top: 3px solid white; white-space:nowrap">
                                    <th class="ant-table-cell">Recruiter</th>
                                    <th class="ant-table-cell">Candidate</th>
                                    <th class="ant-table-cell">Client</th>
                                    <th class="ant-table-cell">Gender</th>
                                    <th class="ant-table-cell">DOMAIN</th>
                                    <th class="ant-table-cell">Profile</th>
                                    <th class="ant-table-cell">Education Attainment</th>
                                    <th class="ant-table-cell">Salary</th>
                                    <th class="ant-table-cell">Portal</th>
                                    <th class="ant-table-cell">Date Sifted</th>
                                    <th class="ant-table-cell">CL</th>
                                    <th class="ant-table-cell">Status</th>
                                    <th class="ant-table-cell">Endo Date</th>
                                    <th class="ant-table-cell">Remarks</th>
                                    <th class="ant-table-cell">Category</th>
                                    <th class="ant-table-cell">SPR</th>
                                    <th class="ant-table-cell">Date Onboarded</th>
                                    <th class="ant-table-cell">Placement fee</th>
                                    <th class="ant-table-cell">Location</th>
                                    <th class="ant-table-cell ant-table-cell-scrollbar"></th>
                                </tr>
                            </thead>
                            <tbody class="hidetrID" style="height:100px">
                            </tbody>
                        </table>
                    </div>


                </div>
                <!-- Datatable code end-->
                <!-- ================= -->
            </div>
            <div class="col-lg-5" id="summaryDiv">
                <p class="C-Heading pt-3">Summary:</p>
                <div class="card mb-13">
                    <div id="loader1" style="display: block;"></div>
                    <div class="card-body">
                        <form action="">
                            <fieldset>
                                <div class="row mb-1">
                                    <div class="col-lg-4">
                                        <div class="form-group mb-0">
                                            <label class="Label-00">
                                                Average Salary:
                                            </label>
                                            <input readonly type="text" class="form-control users-input-S-C"
                                                placeholder="hires.." />
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group mb-0">
                                            <label class="Label-00">
                                                Total Endorsement:
                                            </label>
                                            <input readonly type="text" class="form-control users-input-S-C"
                                                {{-- value="{{ $Userdata->where('endorsements.app_status', 'To Be Endorsed')->count() }}" --}} placeholder="Rev.." id="endo" />
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group mb-0">
                                            <label class="Label-00">
                                                Total SPR:
                                            </label>
                                            <input readonly type="text" class="form-control users-input-S-C"
                                                placeholder="Rev.." id="spr" />
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group mb-0">
                                            <label class="Label-00">
                                                Number of Accepted:
                                            </label>
                                            <input readonly type="text" class="form-control users-input-S-C" id="accepted"
                                                placeholder="total.." />
                                        </div>
                                    </div>

                                    <!-- <div class="row mb-1"> -->
                                    <div class="col-lg-4">
                                        <div class="form-group mb-0">
                                            <label class="Label-00">
                                                Number of Shifted:
                                            </label>
                                            <input readonly type="text" class="form-control users-input-S-C" id="sifted"
                                                placeholder="hires.." />
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group mb-0">
                                            <label class="Label-00">
                                                Initial Stage.
                                            </label>
                                            <input readonly type="text" class="form-control users-input-S-C" id="initial"
                                                placeholder="Rev.." />
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group mb-0">
                                            <label class="Label-00">
                                                Active SPR:
                                            </label>
                                            <input readonly type="text" class="form-control users-input-S-C"
                                                placeholder="Rev.." />
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group mb-0">
                                            <label class="Label-00">
                                                Number of Failed:
                                            </label>
                                            <input readonly type="text" class="form-control users-input-S-C" id="failed"
                                                placeholder="total.." />
                                        </div>
                                    </div>
                                    <!-- </div> -->
                                    <!-- <div class="row mb-1"> -->
                                    <div class="col-lg-4">
                                        <div class="form-group mb-0">
                                            <label class="Label-00">
                                                Number of Active File:
                                            </label>
                                            <input readonly type="text" class="form-control users-input-S-C" id="active"
                                                {{-- value="{{ $Userdata->where('endorsements.app_status', 'Active File')->count() }}" --}} placeholder="hires.." />
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group mb-0">
                                            <label class="Label-00">
                                                Mid Stage:
                                            </label>
                                            <input readonly type="text" class="form-control users-input-S-C" id="mid"
                                                placeholder="Rev.." />
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group mb-0">
                                            <label class="Label-00">
                                                Number of hires:
                                            </label>
                                            <input readonly type="text" class="form-control users-input-S-C"
                                                placeholder="Rev.." id="onBoarded" />
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group mb-0">
                                            <label class="Label-00">
                                                Number of Withdrew:
                                            </label>
                                            <input readonly type="text" class="form-control users-input-S-C" id="withdrawn"
                                                placeholder="total.." />
                                        </div>
                                    </div>
                                    <!-- </div> -->
                                    <!-- <div class="row mb-1"> -->
                                    <div class="col-lg-4">
                                        <div class="form-group mb-0">
                                            <label class="Label-00">
                                                No of Fallout:
                                            </label>
                                            <input readonly type="text" class="form-control users-input-S-C"
                                                placeholder="hires.." />
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group mb-0">
                                            <label class="Label-00">
                                                Final Stage:
                                            </label>
                                            <input readonly type="text" class="form-control users-input-S-C" id="final"
                                                placeholder="Rev.." />
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group mb-0">
                                            <label class="Label-00">
                                                Total of Revenue.
                                            </label>
                                            <input readonly type="text" class="form-control users-input-S-C"
                                                placeholder="Rev.." />
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group mb-0">
                                            <label class="Label-00">
                                                Number of Rejected:
                                            </label>
                                            <input readonly type="text" class="form-control users-input-S-C" id="rejected"
                                                placeholder="total.." />
                                        </div>
                                    </div>
                                </div>
                                <!-- </div> -->
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div style="height: 30px;"></div>

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
        // document.ready startrs
        $(document).ready(function() {
            // call ajax for values appending 
            summaryAppendAjax(1);
            //call ajax for laod dat atable
            load_datatable()
            //call ajax to append options of dropdown
            appendFilterOptions()
        });
        // close 

        //append  dropdowns
        function appendFilterOptions() {
            $.ajax({
                    type: "GET",
                    url: '{{ url('admin/appendSmartFilters') }}',
                })
                .done(function(res) {
                    for (let i = 0; i < res.domain.length; i++) {
                        $('#domain').append('<option value="' + res.domain[i].domain_name + '">' + res.domain[i]
                            .domain_name +
                            '</option>')
                    }
                    for (let i = 0; i < res.user_recruiter.length; i++) {
                        $('#recruiter').append('<option value="' + res.user_recruiter[i].id + '">' + res.user_recruiter[
                                i]
                            .name + '</option>')
                    }
                    for (let i = 0; i < res.client.options.length; i++) {
                        $('#client').append('<option value="' + res.client.options[i].option_name + '">' + res.client
                            .options[i]
                            .option_name + '</option>')
                    }
                    for (let i = 0; i < res.address.length; i++) {
                        if (res.address[i].address != '') {
                            $('#residence').append('<option value="' + res.address[i].address + '">' + res.address[i]
                                .address + '</option>')
                        }
                    }
                    for (let i = 0; i < res.remarks.options.length; i++) {
                        $('#category').append('<option value="' + res.remarks.options[i].option_name + '">' + res
                            .remarks.options[i].option_name + '</option>')
                    }
                    for (let i = 0; i < res.status.options.length; i++) {
                        $('#status').append('<option value="' + res.status.options[i].option_name + '">' + res
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

        // ajax call for view append
        function summaryAppendAjax(array) {
            array = array;
            // $('#loader1').show();
            $.ajax({
                type: "GET",
                url: '{{ url('admin/summaryAppend') }}',
                data: {
                    _token: token,
                    array: array,
                },

                // Success fucniton of Ajax
                success: function(data) {
                    $('#summaryDiv').html(data);
                    $('#loader1').hide();

                },
            });
        }

        select2Dropdown("select2_dropdown");

        // function for filtering the data according to selected input starts
        function FilterSearch() {

            // get values of selected inputs of users
            domain = $('#domain').val();
            recruiter = $('#recruiter').val();
            client = $('#client').val();
            residence = $('#residence').val();
            career_level = $('#career_level').val();
            category = $('#category').val();
            status = $('#status').val();
            remarks = $('#remarks').val();
            sift_start = $('#Shifted_start').val();
            sift_end = $('#Shifted_end').val();
            ob_start = $('#ob_start').val();
            ob_end = $('#ob_end').val();
            endo_start = $('#endo_start').val();
            endo_end = $('#endo_end').val();
            // $('#searchKeyword').val('');
            if ($('#cip').is(':checked')) {
                cip = 1;
            } else {
                cip = 0;
            }
            var option_table = $('#smTable').DataTable({
                destroy: true,
                processing: true,
                serverSide: false,
                "language": {
                    processing: '<div class="spinner-border mr-3" role="status"> </div><span>Processing ...</span>'
                },

                ajax: {
                    url: "{{ route('filterSearch') }}",
                    type: "GET",
                    data: {
                        _token: token,
                        domain: domain,
                        recruiter: recruiter,
                        client: client,
                        residence: residence,
                        career_level: career_level,
                        cip: cip,
                        category: category,
                        status: status,
                        remarks: remarks,
                        endo_start: endo_start,
                        endo_end: endo_end,
                        ob_start: ob_start,
                        ob_end: ob_end,
                        sift_start: sift_start,
                        sift_end: sift_end,
                        // searchKeyword: searchKeyword,
                    },
                },
                initComplete: function(settings, json) {
                    $('#searchKeyword').trigger('input');
                    summaryAppendAjax(json.array);
                    let tableID = $('#filterResult_div').children().children().attr('id')
                    if (tableID == 'filteredTable_wrapper') {
                        countRecordFilter()
                    }
                    if (tableID == 'smTable_wrapper') {
                        countRecord()
                    }
                },
                columns: [{
                        data: 'recruiter',
                        name: 'recruiter'
                    },
                    {
                        data: 'candidate',
                        name: 'candidate'
                    },

                    {
                        data: 'client',
                        name: 'client'
                    },
                    {
                        data: 'gender',
                        name: 'gender'
                    },
                    {
                        data: 'domain',
                        name: 'domain'
                    },

                    {
                        data: 'candidate_profile',
                        name: 'candidate_profile'
                    },
                    {
                        data: 'educational_attain',
                        name: 'educational_attain'
                    },
                    {
                        data: 'curr_salary',
                        name: 'curr_salary'
                    },
                    {
                        data: 'portal',
                        name: 'portal'
                    },
                    {
                        data: 'date_shifted',
                        name: 'date_shifted'
                    },
                    {
                        data: 'career_endo',
                        name: 'career_endo'
                    },
                    {
                        data: 'app_status',
                        name: 'app_status'
                    },
                    {
                        data: 'endi_date',
                        name: 'endi_date'
                    },
                    {
                        data: 'remarks_for_finance',
                        name: 'remarks_for_finance'
                    },
                    {
                        data: 'category',
                        name: 'category'
                    },
                    {
                        data: 'srp',
                        name: 'srp'
                    },
                    {
                        data: 'onboardnig_date',
                        name: 'onboardnig_date'
                    },
                    {
                        data: 'placement_fee',
                        name: 'placement_fee'
                    },
                    {
                        data: 'address',
                        name: 'address'
                    },


                ]
            });
            $("#loader").hide();
            // call Ajax for returning the data as view

            // summaryAppendAjax()
        }
        // close 

        //start yajra table load 
        function load_datatable() {
            var option_table = $('#smTable').DataTable({
                destroy: true,
                processing: true,
                serverSide: false,
                "language": {
                    processing: '<div class="spinner-border mr-3" role="status"> </div><span>Processing ...</span>'
                },

                ajax: {
                    url: "{{ route('view-smart-search-table') }}",
                    type: "GET",
                },
                initComplete: function(settings, json) {
                    $('#searchKeyword').trigger('input');
                    let tableID = $('#filterResult_div').children().children().attr('id')
                    if (tableID == 'filteredTable_wrapper') {
                        countRecordFilter()
                    }
                    if (tableID == 'smTable_wrapper') {
                        countRecord()
                    }
                },
                columns: [{
                        data: 'recruiter',
                        name: 'recruiter'
                    },
                    {
                        data: 'candidate',
                        name: 'candidate'
                    },

                    {
                        data: 'client',
                        name: 'client'
                    },
                    {
                        data: 'gender',
                        name: 'gender'
                    },
                    {
                        data: 'domain',
                        name: 'domain'
                    },

                    {
                        data: 'candidate_profile',
                        name: 'candidate_profile'
                    },
                    {
                        data: 'educational_attain',
                        name: 'educational_attain'
                    },
                    {
                        data: 'curr_salary',
                        name: 'curr_salary'
                    },
                    {
                        data: 'portal',
                        name: 'portal'
                    },
                    {
                        data: 'date_shifted',
                        name: 'date_shifted'
                    },
                    {
                        data: 'career_endo',
                        name: 'career_endo'
                    },
                    {
                        data: 'app_status',
                        name: 'app_status'
                    },
                    {
                        data: 'endi_date',
                        name: 'endi_date'
                    },
                    {
                        data: 'remarks_for_finance',
                        name: 'remarks_for_finance'
                    },
                    {
                        data: 'category',
                        name: 'category'
                    },
                    {
                        data: 'srp',
                        name: 'srp'
                    },
                    {
                        data: 'onboardnig_date',
                        name: 'onboardnig_date'
                    },
                    {
                        data: 'placement_fee',
                        name: 'placement_fee'
                    },
                    {
                        data: 'address',
                        name: 'address'
                    },


                ]
            });
        }
        // close 

        // setInterval(() => {
        //     let tableID = $('#filterResult_div').children().children().attr('id')
        //     if (tableID == 'filteredTable_wrapper') {
        //         countRecordFilter()
        //     }
        //     if (tableID == 'smTable_wrapper') {
        //         countRecord()
        //     }
        // }, 2000);

        // oninput append value in yajra table 
        $('#searchKeyword').on('input', function() {
            $('#smTable_filter').children().children().val($('#searchKeyword').val());
            $('#smTable_filter').children().children().trigger('input');
            $('#smTable1_filter').children().children().val($('#searchKeyword').val());
            $('#smTable1_filter').children().children().trigger('input');
            // let total_recored = data.split(" ")
            // console.log(total_recored)
            // $('#foundRecord').val(total_recored[3])
            let tableID = $('#filterResult_div').children().children().attr('id')
            if (tableID == 'filteredTable_wrapper') {
                countRecordFilter()
            }
            if (tableID == 'smTable_wrapper') {
                countRecord()
            }
            var data = $(this).val();
            $.ajax({
                type: "post",
                url: '{{ url('admin/searchsummary') }}',
                data: {
                    _token: token,
                    data: data,
                },
                success: function(res) {
                    $('#summaryDiv').html(res);
                    $('#loader1').hide();
                }
                // Success fucniton of Ajax
            });
        });
        // count record on page load 
        function countRecord() {
            var count = $('#smTable_info').text().split(' ');
            $('#foundRecord').val(count[5])
            $('#sifted').val(count[5])
        }
        // close 

        // count record of filtered data
        function countRecordFilter() {
            var count = $('#smTable1_info').text().split(' ');
            $('#foundRecord').val(count[5])
            $('#sifted').val(count[5])
        }
        //close
    </script>

@endsection
