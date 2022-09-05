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

        .resizer {
            position: absolute;
            top: 0;
            right: -8px;
            bottom: 0;
            left: auto;
            width: 16px;
            cursor: col-resize;
        }

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

        #smTable_filter {
            visibility: hidden;
        }

        #smTable1_filter {
            visibility: hidden;
        }

        .smartSearchHeight {
            height: 87.5%;
        }

        @media only screen and (max-width: 600px) {
            .smartSearchHeight {
                height: auto !important;
            }
        }
        .tableFixHead {
            overflow-y: auto;
            height: 670px;
            
        }

        .tableFixHead thead th {
            position: sticky;
            top: -10px;
        }
        .hidetrID tr td:nth-child(12),
        .hidetrID tr td:nth-child(20),
        .hidetrID tr td:nth-child(24),
        .hidetrID tr td:nth-child(15)
          {
            white-space: nowrap;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            width: 164px !important;
            overflow:  hidden;
        }
    </style>
@endsection


@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-7">
                <p class="C-Heading pt-3">Record Finder:</p>
                <div class="card smartSearchHeight mb-13">
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
                                        <input type="text" name="REF_CODE" value="" disabled="" required=""
                                            id="foundRecord" class="form-control h-px-20_custom border" />
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-lg-2">
                                    <div class="form-group mb-0">
                                        <label class="Label-00">Domain:</label>
                                        <select multiple name="DOMAIN" id="domain" required=""
                                            onchange="FilterSearch()"
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
                                        <label class="Label">Start Date (Endorsement):</label>
                                        <input type="date" id="endo_start" class="w-100 users-input-S-C form-control"
                                            onchange="FilterSearch()" />
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group mb-0">
                                        <label class="Label">End Date (Endorsement):</label>
                                        <input type="date" id="endo_end" class="w-100 users-input-S-C form-control"
                                            onchange="FilterSearch()" />
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-lg-2">
                                    <div class="form-group mb-0">
                                        <label class="Label">Portal</label>
                                        <select multiple name="portal" required="" id="portal"
                                            onchange="FilterSearch()"
                                            class="form-control border h-px-20_custom select2_dropdown w-100">
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
                                        <label class="Label">Start Date (Sifted):</label>
                                        <input type="date" id="Shifted_start"
                                            class="w-100 users-input-S-C form-control" onchange="FilterSearch()" />
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group mb-0">
                                        <label class="Label">End Date (Sifted):</label>
                                        <input type="date" id="Shifted_end" class="w-100 users-input-S-C form-control"
                                            onchange="FilterSearch()" />
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-lg-2">
                                    <div class="form-group mb-0">
                                        <label class="Label-00">Category:</label>
                                        <select multiple name="REMARKS_FOR_FINANCE" id="category"
                                            onchange="FilterSearch()"
                                            class="select2_dropdown  w-100 form-control border pl-0 arrow-3 h-px-20_custom w-100 font-size-4 d-flex align-items-center w-100">
                                            <option value="Active - Initial Stage"> Active - Initial Stage</option>
                                            <option value="Active - Mid Stage">Active - Mid Stage</option>
                                            <option value="Active - Final Stage">Active - Final Stage</option>
                                            <option value="Converted - Final Stage">Converted - Final Stage</option>
                                            <option value="Inactive - Initial Stage">Inactive - Initial Stage</option>
                                            <option value="Inactive - Mid Stage">Inactive - Mid Stage</option>
                                            <option value="Inactive - Final Stage"> Inactive - Final Stage</option>
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
                                        <label class="Label">Start Date (Onboarding):</label>
                                        <input type="date" id="ob_start" class="w-100 users-input-S-C form-control"
                                            onchange="FilterSearch()" />
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group mb-0">
                                        <label class="Label">End Date (Onboarding):</label>
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
            </div>
            <div class="col-lg-5" id="summaryDiv">
                <p class="C-Heading pt-3">Summary:</p>
                <div id="loader3"></div>
                <div class="card mb-13">
                    {{-- <div id="loader1" style="display: block;"></div> --}}
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
                                            <input readonly type="text" class="form-control users-input-S-C"
                                                id="accepted" placeholder="total.." />
                                        </div>
                                    </div>

                                    <!-- <div class="row mb-1"> -->
                                    <div class="col-lg-4">
                                        <div class="form-group mb-0">
                                            <label class="Label-00">
                                                Number of Sifted:
                                            </label>
                                            <input readonly type="text" class="form-control users-input-S-C"
                                                id="sifted" placeholder="hires.." />
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group mb-0">
                                            <label class="Label-00">
                                                Initial Stage.
                                            </label>
                                            <input readonly type="text" class="form-control users-input-S-C"
                                                id="initial" placeholder="Rev.." />
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
                                            <input readonly type="text" class="form-control users-input-S-C"
                                                id="failed" placeholder="total.." />
                                        </div>
                                    </div>
                                    <!-- </div> -->
                                    <!-- <div class="row mb-1"> -->
                                    <div class="col-lg-4">
                                        <div class="form-group mb-0">
                                            <label class="Label-00">
                                                Number of Active File:
                                            </label>
                                            <input readonly type="text" class="form-control users-input-S-C"
                                                id="active" {{-- value="{{ $Userdata->where('endorsements.app_status', 'Active File')->count() }}" --}} placeholder="hires.." />
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group mb-0">
                                            <label class="Label-00">
                                                Mid Stage:
                                            </label>
                                            <input readonly type="text" class="form-control users-input-S-C"
                                                id="mid" placeholder="Rev.." />
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
                                                Number of Withdrawn:
                                            </label>
                                            <input readonly type="text" class="form-control users-input-S-C"
                                                id="withdrawn" placeholder="total.." />
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
                                            <input readonly type="text" class="form-control users-input-S-C"
                                                id="final" placeholder="Rev.." />
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group mb-0">
                                            <label class="Label-00">
                                                Total Revenue.
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
                                            <input readonly type="text" class="form-control users-input-S-C"
                                                id="rejected" placeholder="total.." />
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

        <div class="row">
            <div class="col-lg-12"  >
                <div class="table-responsive border-right pt-3" id="filterResult_div">
                    <div class="tableFixHead" >
                        <table id="smTable" class="table">
                            <thead class="bg-light w-100"  style="">
                                <tr style="">
                                    <th class="ant-table-cell hideID noVis">id</th>
                                    <th class="ant-table-cell">Sr</th>
                                    <th class="ant-table-cell">Recruiter</th>
                                    <th class="ant-table-cell">Team</th>
                                    <th class="ant-table-cell">Candidate</th>
                                    <th class="ant-table-cell">Email</th>
                                    <th class="ant-table-cell">OR Number</th>
                                    <th class="ant-table-cell">Replacement For</th>
                                    <th class="ant-table-cell">Application Status</th>
                                    <th class="ant-table-cell">Candidate’s Profile</th>
                                    <th class="ant-table-cell">Career</th>
                                    <th class="ant-table-cell">Certificate</th>
                                    <th class="ant-table-cell">Client</th>
                                    <th class="ant-table-cell">Phone</th>
                                    <th class="ant-table-cell">Course</th>
                                    <th class="ant-table-cell">Endorsement Date</th>
                                    <th class="ant-table-cell">Date Invited</th>
                                    <th class="ant-table-cell">Date Sifted</th>
                                    <th class="ant-table-cell">Educational Attainment</th>
                                    <th class="ant-table-cell">Employment History</th>
                                    <th class="ant-table-cell">Type</th>
                                    <th class="ant-table-cell">Exp Salary</th>
                                    <th class="ant-table-cell">Gender</th>
                                    <th class="ant-table-cell">Interview Note</th>
                                    <th class="ant-table-cell">Invoice Number</th>
                                    <th class="ant-table-cell">Onboarding Date </th>
                                    <th class="ant-table-cell">Position Title </th>
                                    <th class="ant-table-cell">Remarks </th>
                                    <th class="ant-table-cell">Remarks For Finance </th>
                                    <th class="ant-table-cell">Address </th>
                                    <th class="ant-table-cell">Segment </th>
                                    <th class="ant-table-cell">Site</th>
                                    <th class="ant-table-cell">Endorsement Status</th>
                                    <th class="ant-table-cell">Sub-Segment</th>
                                    <th class="ant-table-cell ant-table-cell-scrollbar"></th>
                                </tr>
                            </thead>
                            <tbody class="hidetrID" style="height:100px">

                            </tbody>
                        </table>
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
    {{-- <script src="{{ asset('assets/plugins/data-tables/script/datatables/jquery.dataTables.min.js') }}"></script> --}}
    <script src="{{ asset('assets/plugins/data-tables/script/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/data-tables/script/datatables-responsive/js/dataTables.responsive.min.js') }}">
    </script>
    <script src="{{ asset('assets/plugins/data-tables/script/datatables-responsive/js/responsive.bootstrap4.min.js') }}">
    </script>

    <script>
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
                    // for (let i = 0; i < res.remarks.options.length; i++) {
                    //     $('#category').append('<option value="' + res.remarks.options[i].option_name + '">' + res
                    //         .remarks.options[i].option_name + '</option>')
                    // }
                    for (let i = 0; i < res.status.options.length; i++) {
                        $('#status').append('<option value="' + res.status.options[i].option_name + '">' + res
                            .status.options[i].option_name + '</option>')
                    }
                    for (let i = 0; i < res.remarks.options.length; i++) {
                        $('#remarks').append('<option value="' + res.remarks.options[i].option_name + '">' + res
                            .remarks.options[i].option_name + '</option>')
                    }
                    for (let i = 0; i < res.portal.options.length; i++) {
                        $('#portal').append('<option value="' + res.portal.options[i].option_name + '">' + res
                            .portal.options[i].option_name + '</option>')
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
            $('#loader3').show();
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
                    $('#loader3').hide();
                    test()
                },
            });
        }

        select2Dropdown("select2_dropdown");
        var option_table = "";

        // function for filtering the data according to selected input starts
        function FilterSearch() {
            // empty search so it can not effect result and summary 
            // $('#searchKeyword').val('')
            // get values of selected inputs of users
            domain = $('#domain').val();
            search = $('#searchKeyword').val();
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
            portal = $('#portal').val();
            // $('#searchKeyword').val('');
            if ($('#cip').is(':checked')) {
                cip = 1;
            } else {
                cip = 0;
            }
            option_table = $('#smTable').DataTable({
                destroy: true,
                // search: {
                //     smart: false
                // },
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
                        portal: portal,
                        search: search,
                        // searchKeyword: searchKeyword,
                    },
                },
                createdRow: function(row, data, dataIndex) {
                    $(row).addClass('id');
                },
                initComplete: function(settings, json) {
                    // console.log(json);
                    summaryAppendAjax(json.array);
                    // console.log(json.search);
                    $('#searchKeyword').val(json.search)
                    $('#searchKeyword').change()
                    let tableID = $('#filterResult_div').children().children().attr('id')
                    if (tableID == 'filteredTable_wrapper') {
                        countRecordFilter()
                    }
                    if (tableID == 'smTable_wrapper') {
                        countRecord()
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
                        data: 'recruiter',
                        name: 'recruiter'
                    },
                    {
                        data: 'team',
                        name: 'team',
                        // searchable: false,
                        // orderable: false
                    },
                    {
                        data: 'Candidate',
                        name: 'Candidate',
                        // searchable: false,
                        // orderable: false
                    },
                    {
                        data: 'Email',
                        name: 'Email',
                        // searchable: false,
                        // orderable: false
                    },
                    {
                        data: 'OR_Number',
                        name: 'OR_Number',
                        // searchable: false,
                        // orderable: false
                    },
                    {
                        data: 'Replacement_For',
                        name: 'Replacement_For',
                        // searchable: false,
                        // orderable: false
                    },

                    {
                        data: 'appStatus',
                        name: 'appStatus',
                        // searchable: false,
                        // orderable: false
                    }, {
                        data: 'profile',
                        name: 'profile',
                        // searchable: false,
                        // orderable: false
                    },
                    {
                        data: 'career_level',
                        name: 'career_level'
                    }, {
                        data: 'certification',
                        name: 'certification'
                    }, {
                        data: 'client',
                        name: 'client'
                    }, {
                        data: 'phone',
                        name: 'phone'
                    }, {
                        data: 'course',
                        name: 'course'
                    }, {
                        data: 'endi_date',
                        name: 'endi_date'
                    }, {
                        data: 'date_invited',
                        name: 'date_invited'
                    }, {
                        data: 'date_shifted',
                        name: 'date_shifted'
                    }, {
                        data: 'educational_attain',
                        name: 'educational_attain'
                    }, {
                        data: 'emp_history',
                        name: 'emp_history'
                    }, {
                        data: 'type',
                        name: 'type'
                    }, {
                        data: 'exp_salary',
                        name: 'exp_salary'
                    }, {
                        data: 'gender',
                        name: 'gender'
                    }, {
                        data: 'interview_note',
                        name: 'interview_note'
                    }, {
                        data: 'invoice_number',
                        name: 'invoice_number'
                    }, {
                        data: 'onboardnig_date',
                        name: 'onboardnig_date'
                    }, {
                        data: 'position_title',
                        name: 'position_title'
                    }, {
                        data: 'remarks',
                        name: 'remarks'
                    }, {
                        data: 'remarks_for_finance',
                        name: 'remarks_for_finance'
                    }, {
                        data: 'address',
                        name: 'address'
                    }, {
                        data: 'segment',
                        name: 'segment'
                    }, {
                        data: 'site',
                        name: 'site'
                    }, {
                        data: 'endostatus',
                        name: 'endostatus'
                    }, {
                        data: 'sub_segment',
                        name: 'sub_segment'
                    },
                ],
                dom: 'Bfrtip',
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
            $("#loader").hide();
            // call Ajax for returning the data as view

            // summaryAppendAjax()
        }
        // close 
        //start yajra table load 
        function load_datatable() {
            option_table = $('#smTable').DataTable({
                destroy: true,
                // search: {
                //     smart: false
                // },
                processing: true,
                serverSide: false,
                "language": {
                    processing: '<div class="spinner-border mr-3" role="status"> </div><span>Processing ...</span>'
                },

                ajax: {
                    url: "{{ route('view-smart-search-table') }}",
                    type: "GET",
                },
                createdRow: function(row, data, dataIndex) {
                    $(row).addClass('id');
                },
                initComplete: function(settings, json) {
                    // $('#searchKeyword').trigger('input');
                    let tableID = $('#filterResult_div').children().children().attr('id')
                    if (tableID == 'filteredTable_wrapper') {
                        countRecordFilter()
                    }
                    if (tableID == 'smTable_wrapper') {
                        countRecord()
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
                        data: 'recruiter',
                        name: 'recruiter'
                    },
                    {
                        data: 'team',
                        name: 'team',
                        // searchable: false,
                        // orderable: false
                    },
                    {
                        data: 'Candidate',
                        name: 'Candidate',
                        // searchable: false,
                        // orderable: false
                    },
                    {
                        data: 'Email',
                        name: 'Email',
                        // searchable: false,
                        // orderable: false
                    },
                    {
                        data: 'OR_Number',
                        name: 'OR_Number',
                        // searchable: false,
                        // orderable: false
                    },
                    {
                        data: 'Replacement_For',
                        name: 'Replacement_For',
                        // searchable: false,
                        // orderable: false
                    },

                    {
                        data: 'appStatus',
                        name: 'appStatus',
                        // searchable: false,
                        // orderable: false
                    }, {
                        data: 'profile',
                        name: 'profile',
                        // searchable: false,
                        // orderable: false
                    },
                    {
                        data: 'career_level',
                        name: 'career_level'
                    }, {
                        data: 'certification',
                        name: 'certification'
                    }, {
                        data: 'client',
                        name: 'client'
                    }, {
                        data: 'phone',
                        name: 'phone'
                    }, {
                        data: 'course',
                        name: 'course'
                    }, {
                        data: 'endi_date',
                        name: 'endi_date'
                    }, {
                        data: 'date_invited',
                        name: 'date_invited'
                    }, {
                        data: 'date_shifted',
                        name: 'date_shifted'
                    }, {
                        data: 'educational_attain',
                        name: 'educational_attain'
                    }, {
                        data: 'emp_history',
                        name: 'emp_history'
                    }, {
                        data: 'type',
                        name: 'type'
                    }, {
                        data: 'exp_salary',
                        name: 'exp_salary'
                    }, {
                        data: 'gender',
                        name: 'gender'
                    }, {
                        data: 'interview_note',
                        name: 'interview_note'
                    }, {
                        data: 'invoice_number',
                        name: 'invoice_number'
                    }, {
                        data: 'onboardnig_date',
                        name: 'onboardnig_date'
                    }, {
                        data: 'position_title',
                        name: 'position_title'
                    }, {
                        data: 'remarks',
                        name: 'remarks'
                    }, {
                        data: 'remarks_for_finance',
                        name: 'remarks_for_finance'
                    }, {
                        data: 'address',
                        name: 'address'
                    }, {
                        data: 'segment',
                        name: 'segment'
                    }, {
                        data: 'site',
                        name: 'site'
                    }, {
                        data: 'endostatus',
                        name: 'endostatus'
                    }, {
                        data: 'sub_segment',
                        name: 'sub_segment'
                    },
                ],
                dom: 'Bfrtip',
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
        function passIDToSummaryAppend() {
            setTimeout(() => {
                test = document.getElementsByClassName('id');
                var obj = {};
                for (let item of test) {
                    var tdValue = item.children[0].innerText;
                    array = tdValue.split("-");
                    value = array[0];
                    key = array[1];
                    obj = {
                        ...obj,
                        [key]: value
                    };
                }
                summaryAppendAjax(obj)
                setTimeout(() => {
                    $('#smTable_length').children().children().val('10');
                    $('#smTable_length').children().children().change();
                    // $('#searchKeyword').trigger('input');
                    $("#loader").hide();

                }, 100);
            }, 1000);
        }
        // oninput append value in yajra table 
        $('#searchKeyword').on('change', function() {
            $('#loader3').show();
            $("#loader").show();

            // console.log(option_table.rows().data().toArray());
            option_table.page.len(-1).draw();
            passIDToSummaryAppend();
            // console.log(obj);

            // append summary after passing the curetn candidate array for calculations 

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
            // $.ajax({
            //     type: "post",
            //     url: '{{ url('admin/searchsummary') }}',
            //     data: {
            //         _token: token,
            //         data: data,
            //     },
            //     success: function(res) {
            //         $('#summaryDiv').html(res);
            //         $('#loader1').hide();
            //     }
            //     // Success fucniton of Ajax
            // });
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
