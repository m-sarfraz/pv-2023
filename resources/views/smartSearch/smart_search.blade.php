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

        #smTable1 td {
            text-align: center;
            max-width: 40ch;
            text-overflow: ellipsis;
            white-space: nowrap;
            overflow: hidden;
        }

        #smTable td {
            text-align: center;
            max-width: 40ch;
            text-overflow: ellipsis;
            white-space: nowrap;
            overflow: hidden;
        }

        th {
            padding: 8px;
            border: 1px solid silver;
        }

        .hidetrIDSmartSearch tr:hover {
            background-color: #dc8627
        }

        .hidetrIDSmartSearch tr:hover * {
            color: #FFF
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
            height: 100%;

        }

        .tableFixHead thead th {
            position: sticky;
            top: -10px;
        }

        .hidetrID tr td:nth-child(13),
        .hidetrID tr td:nth-child(15),
        .hidetrID tr td:nth-child(16),
        .hidetrID tr td:nth-child(17) {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 30ch;
        }

        /* option_table.sl-text-trim td {
                                                                                                                                                                                overflow: hidden;
                                                                                                                                                                                text-overflow: ellipsis;
                                                                                                                                                                                white-space: nowrap;
                                                                                                                                                                                } */
    </style>
@endsection


@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-7">
                <p class="C-Heading pt-3">Record Finder</p>
                <div class="card smartSearchHeight mb-13">
                    <div class="card-body">
                        <div id="loader1" style="display: block;"></div>
                        <form action="">

                            <div class="row">
                                <div class="col-lg-3">
                                    <div class="form-group mb-0">
                                        <label class="d-block font-size-3 mb-0">
                                            Search (keyword):
                                        </label>
                                        <input type="text" name="searchKeyword" id="searchKeyword"
                                            placeholder="search keyword" required=""
                                            class="form-control h-px-20_custom border" value="" />
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group mb-0">
                                        <label class="d-block font-size-3 mb-0">
                                            Number Of Records Found:
                                        </label>
                                        <input type="text" name="REF_CODE" value="" disabled="" required=""
                                            id="foundRecord" class="form-control h-px-20_custom border" />
                                    </div>
                                </div>


                                <div class="col-lg-3">
                                    <div class="form-group mb-0">
                                        <label class="Label">Start Date (Sifted)</label>
                                        <input type="date" id="Shifted_start" class="w-100 users-input-S-C form-control"
                                            onchange="FilterSearch()" />
                                    </div>

                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group mb-0">
                                        <label class="Label">End Date (Sifted)</label>
                                        <input type="date" id="Shifted_end" class="w-100 users-input-S-C form-control"
                                            onchange="FilterSearch()" />
                                    </div>

                                </div>

                            </div>
                            <div class="row">
                                <div class="col-lg-3">
                                    <div class="form-group mb-0">
                                        <label class="Label-00">Client</label>
                                        <select multiple name="CLIENT" id="client" onchange="FilterSearch()"
                                            class="form-control border pl-0 arrow-3 h-px-20_custom w-100 font-size-4 d-flex align-items-center select2_dropdown w-100">
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group mb-0">
                                        <label class="Label">Portal</label>
                                        <select multiple name="portal" required="" id="portal"
                                            onchange="FilterSearch()"
                                            class="form-control border h-px-20_custom select2_dropdown w-100">
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="form-group mb-0">
                                        <label class="Label">Start Date (Onboarding)</label>
                                        <input type="date" id="ob_start" class="w-100 users-input-S-C form-control"
                                            onchange="FilterSearch()" />
                                    </div>

                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group mb-0">
                                        <label class="Label">End Date (Onboarding)</label>
                                        <input type="date" id="ob_end" class="w-100 users-input-S-C form-control"
                                            onchange="FilterSearch()" />
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-lg-3">
                                    <div class="form-group mb-0">
                                        <label class="Label-00">Category</label>
                                        <select multiple name="REMARKS_FOR_FINANCE" id="category" onchange="FilterSearch()"
                                            class="select2_dropdown  w-100 form-control border pl-0 arrow-3 h-px-20_custom w-100 font-size-4 d-flex align-items-center w-100">
                                            <option value="Active - Initial Stage"> Active - Initial Stage</option>
                                            <option value="Active - Mid Stage">Active - Mid Stage</option>
                                            <option value="Active - Final Stage">Active - Final Stage</option>
                                            <option value="Converted - Final Stage">Converted - Final Stage</option>
                                            <option value="Inactive - Initial Stage">Inactive - Initial Stage
                                            </option>
                                            <option value="Inactive - Mid Stage">Inactive - Mid Stage</option>
                                            <option value="Inactive - Final Stage"> Inactive - Final Stage</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group mb-0">
                                        <label class="Label-00">Status</label>
                                        <select multiple name="status" id="status" onchange="FilterSearch()"
                                            class="w-100 form-control select2_dropdown w-100">
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group mb-0">
                                        <label class="Label">Start Date (Endorsement)</label>
                                        <input type="date" id="endo_start" class="w-100 users-input-S-C form-control"
                                            onchange="FilterSearch()" />
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="form-group mb-0">
                                        <label class="Label">End Date (Endorsement)</label>
                                        <input type="date" id="endo_end" class="w-100 users-input-S-C form-control"
                                            onchange="FilterSearch()" />
                                    </div>

                                </div>

                            </div>
                            <div class="row">
                                <div class="col-lg-3">
                                    <div class="form-group ">
                                        <label class="Label-00">Candidate's profile</label>
                                        <select multiple name="profile" id="profile" onchange="FilterSearch()"
                                            class="w-100 form-control select2_dropdown w-100">
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group mb-0">
                                        <label class="Label-00">Domain</label>
                                        <select multiple name="DOMAIN" id="domain" required=""
                                            onchange="FilterSearch()"
                                            class="form-control p-0 users-input-S-C select2_dropdown w-100">
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="form-group mb-0">
                                        <label class="Label-00">Application Status</label>
                                        <select multiple name="appStatus" id="appStatus" onchange="FilterSearch()"
                                            class="w-100 form-control select2_dropdown w-100">
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group mb-0">
                                        <label class="Label-00">Remarks</label>
                                        <select multiple name="remarks" id="remarks" onchange="FilterSearch()"
                                            class="w-100 form-control select2_dropdown w-100">
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">

                                <div class="col-lg-3">
                                    <div class="form-group mb-0">
                                        <label class="Label-00">Candidate's Name</label>
                                        <select multiple name="candidate" id="candidate" onchange="FilterSearch()"
                                            class="w-100 form-control select2_dropdown w-100">
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group mb-0">

                                        <label class="Label-00">Segment</label>
                                        <select multiple name="segment" id="segment" required=""
                                            onchange="FilterSearch()"
                                            class="form-control border h-px-20_custom select2_dropdown w-100">

                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group mb-0">
                                        <label class="Label-00">Recruiter</label>
                                        <select multiple name="recruiter" id="recruiter" class="select2_dropdown  w-100"
                                            onchange="FilterSearch()" onchange="filterUserData()">
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group mb-0">

                                        <label class="Label-00">Residence</label>
                                        <select multiple name="residence" required="" id="residence"
                                            onchange="FilterSearch()"
                                            class="form-control border h-px-20_custom select2_dropdown w-100">
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3">
                                    <div class="form-group mb-0">

                                        <label class="Label-00">Career Level</label>
                                        <select multiple name="CAREER_LEVEL_FINANCE" required="" id="career_level"
                                            onchange="FilterSearch()"
                                            class="form-control border h-px-20_custom select2_dropdown w-100">

                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group mb-0">
                                        <label class="Label-00">Sub-Segment </label>
                                        <select multiple name="subSegment" id="subSegment" onchange="FilterSearch()"
                                            class="w-100 form-control select2_dropdown w-100">
                                        </select>
                                    </div>
                                </div>


                                <div class="col-lg-3">
                                    <div class="form-group mb-0">

                                        <label class="Label-00">Courses</label>
                                        <select multiple id="course" name="course" required=""
                                            onchange="FilterSearch()"
                                            class="form-control border h-px-20_custom select2_dropdown w-100">
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group mb-0">

                                        <label class="Label-00">Certification</label>
                                        <select multiple name="certification" id="certification" required=""
                                            onchange="FilterSearch()"
                                            class="form-control border h-px-20_custom select2_dropdown w-100">

                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row justify-content-end">
                                <div class="col-lg-3">
                                    <div class="form-group mb-0">
                                        <label class="Label-00">Team</label>
                                        <select multiple name="team" id="team" required=""
                                            onchange="FilterSearch()"
                                            class="form-control border h-px-20_custom select2_dropdown w-100">
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group mb-0">
                                        <label class="Label-00">Position Title</label>
                                        <select multiple name="p_title" id="p_title" required=""
                                            onchange="FilterSearch()"
                                            class="form-control border h-px-20_custom select2_dropdown w-100">
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <label class="Label">Min. Salary</label>
                                    <input type="number" id="min_salary" min="0"
                                        class="w-100 users-input-S-C form-control" style="height: 34px !important;"
                                        onchange="FilterSearch()" />
                                </div>
                                <div class="col-lg-3">
                                    <label class="Label">Max. Salary</label>
                                    <input type="number" id="max_salary" min="0"
                                        class="w-100 users-input-S-C form-control" style="height: 34px !important;"
                                        onchange="FilterSearch()" />
                                </div>
                                <div class="col-lg-3 mt-3">
                                    <div class="form-group mb-0 text-right">
                                        <label class="Label-00">CIP</label>
                                        <input type="checkbox" id="cip" name="cip" onclick="FilterSearch()">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-5" id="summaryDiv">
                <p class="C-Heading pt-3">Summary</p>
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
                                    <div class="col-lg-4">
                                        <div class="form-group mb-0">
                                            <label class="Label-00">
                                                Number of Unique Records:
                                            </label>
                                            <input readonly type="text" class="form-control users-input-S-C"
                                                id="unique" placeholder="total.." />
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
            <div class="col-lg-12">
                <div class="table-responsive border-right pt-3" id="filterResult_div">
                    <div class="tableFixHead">
                        <table id="smTable" class="table">
                            <thead class="bg-light w-100" style="">
                                <tr style="text-align: center;">
                                    <th class="d-none"> sr</th>
                                    <th class="ant-table-cell">
                                        {{-- <svg title="Click Here For Columnwise Search" data-toggle="tooltip"
                                            data-placement="top" style="color:#dc8627;text-color:red;top:0;bottom:0"
                                            xmlns="http://www.w3.org/2000/svg" onclick="toggleSearchFunc()"
                                            width="22" height="22" fill="currentColor"
                                            class="bi bi-three-dots-vertical" viewBox="0 0 16 16">
                                            <path
                                                d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z" />
                                        </svg> --}}
                                        Sr
                                    </th>

                                    <th class="ant-table-cell">Team </th>
                                    <th class="ant-table-cell">Recruiter </th>
                                    <th class="ant-table-cell">Date Sifted </th>
                                    <th class="ant-table-cell">Candidate’s Profile </th>
                                    <th class="ant-table-cell">Date Invited </th>
                                    <th class="ant-table-cell">Candidate </th>
                                    <th class="ant-table-cell">Gender </th>
                                    <th class="ant-table-cell">Phone </th>
                                    <th class="ant-table-cell">Email </th>
                                    <th class="ant-table-cell">Address </th>
                                    <th class="ant-table-cell">Course </th>
                                    <th class="ant-table-cell">Educational Attainment </th>
                                    <th class="ant-table-cell">Certificate </th>
                                    <th class="ant-table-cell">Employment History </th>
                                    <th class="ant-table-cell">Interview Note </th>
                                    <th class="ant-table-cell">Exp Salary </th>
                                    <th class="ant-table-cell">Application Status </th>
                                    <th class="ant-table-cell">Type </th>
                                    <th class="ant-table-cell">Endorsement Date </th>
                                    <th class="ant-table-cell">Client </th>
                                    <th class="ant-table-cell">Site </th>
                                    <th class="ant-table-cell">Position Title </th>
                                    <th class="ant-table-cell">Career </th>
                                    <th class="ant-table-cell">Segment </th>
                                    <th class="ant-table-cell">Sub-Segment </th>
                                    <th class="ant-table-cell">Endorsement Status </th>
                                    <th class="ant-table-cell">Remarks For Finance </th>
                                    <th class="ant-table-cell">Onboarding Date </th>




                                </tr>
                            </thead>
                            <tbody class="hidetrID hidetrIDSmartSearch" style="height:100px">
                            </tbody>
                            <tfoot>
                                <tr style="text-align: center;">
                                    <th class="ant-table-cell" onclick="enableFocusOnInput(this)">Sr</th>
                                    <th class="ant-table-cell" onclick="enableFocusOnInput(this)">Team</th>
                                    <th class="ant-table-cell" onclick="enableFocusOnInput(this)">Recruiter</th>
                                    <th class="ant-table-cell" onclick="enableFocusOnInput(this)">Candidate</th>
                                    <th class="ant-table-cell" onclick="enableFocusOnInput(this)">Date Sifted</th>
                                    <th class="ant-table-cell" onclick="enableFocusOnInput(this)">Candidate’s Profile</th>
                                    <th class="ant-table-cell" onclick="enableFocusOnInput(this)">Date Invited</th>
                                    <th class="ant-table-cell" onclick="enableFocusOnInput(this)">Gender</th>
                                    <th class="ant-table-cell" onclick="enableFocusOnInput(this)">Phone</th>
                                    <th class="ant-table-cell" onclick="enableFocusOnInput(this)">Email</th>
                                    <th class="ant-table-cell" onclick="enableFocusOnInput(this)">Address </th>
                                    <th class="ant-table-cell" onclick="enableFocusOnInput(this)">Course</th>
                                    <th class="ant-table-cell" onclick="enableFocusOnInput(this)">Educational Attainment
                                    </th>
                                    <th class="ant-table-cell" onclick="enableFocusOnInput(this)">Certificate</th>
                                    <th class="ant-table-cell" onclick="enableFocusOnInput(this)">Employment History</th>
                                    <th class="ant-table-cell" onclick="enableFocusOnInput(this)">Interview Note</th>
                                    <th class="ant-table-cell" onclick="enableFocusOnInput(this)">Exp Salary</th>
                                    <th class="ant-table-cell" onclick="enableFocusOnInput(this)">Application Status</th>
                                    <th class="ant-table-cell" onclick="enableFocusOnInput(this)">Type</th>
                                    <th class="ant-table-cell" onclick="enableFocusOnInput(this)">Endorsement Date</th>
                                    <th class="ant-table-cell" onclick="enableFocusOnInput(this)">Client</th>
                                    <th class="ant-table-cell" onclick="enableFocusOnInput(this)">Site</th>
                                    <th class="ant-table-cell" onclick="enableFocusOnInput(this)">Position Title </th>
                                    <th class="ant-table-cell" onclick="enableFocusOnInput(this)">Career</th>
                                    <th class="ant-table-cell" onclick="enableFocusOnInput(this)">Segment </th>
                                    <th class="ant-table-cell" onclick="enableFocusOnInput(this)">Sub-Segment</th>
                                    <th class="ant-table-cell" onclick="enableFocusOnInput(this)">Endorsement Status</th>
                                    <th class="ant-table-cell" onclick="enableFocusOnInput(this)">Remarks For Finance
                                    </th>
                                    <th class="ant-table-cell" onclick="enableFocusOnInput(this)">Onboarding Date </th>

                                    <th class="ant-table-cell ant-table-cell-scrollbar"></th>
                                </tr>
                            </tfoot>
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
            toggleSearchFunc()
            // call ajax for values appending 
            summaryAppendAjax(1);
            //call ajax for laod dat atable
            load_datatable()
            //call ajax to append options of dropdown
            appendFilterOptions()
        });
        // close 
        $(document).ready(function() {
            console.log('read')
            $('#candidate').select2({
                minimumInputLength: 1,
                data: function(params) {
                    return {
                        term: params.term,
                        _type: 'query',
                        q: params.q,
                        finance: false // set the flag value to true or false as needed
                    };
                },
                ajax: {
                    url: '{{ url('admin/showCandidateDropDown') }}',
                    dataType: 'json',
                    processResults: function(data) {
                        return {
                            results: $.map(data, function(item) {
                                return {
                                    text: item.fullName,
                                    id: item.id
                                }
                            })
                        };
                    },
                },
            })
        })
        //append  dropdowns
        function appendFilterOptions() {
            $.ajax({
                    type: "GET",
                    url: '{{ url('admin/appendSmartFilters') }}',
                })
                .done(function(res) {
                    domain_dp = JSON.parse(localStorage.getItem('domain'));
                    recruiter_dp = JSON.parse(localStorage.getItem('recruiter'));
                    client_dp = JSON.parse(localStorage.getItem('client'));
                    portal_dp = JSON.parse(localStorage.getItem('portal'));
                    resd_dp = JSON.parse(localStorage.getItem('resd'));
                    career_dp = JSON.parse(localStorage.getItem('career'));
                    status_dp = JSON.parse(localStorage.getItem('status'));
                    category_dp = JSON.parse(localStorage.getItem('category'));
                    remarks_dp = JSON.parse(localStorage.getItem('remarks'));
                    endo_start_dp = JSON.parse(localStorage.getItem('endo_start'));
                    endo_end_dp = JSON.parse(localStorage.getItem('endo_end'));
                    Shifted_start_dp = JSON.parse(localStorage.getItem('Shifted_start'));
                    Shifted_end_dp = JSON.parse(localStorage.getItem('Shifted_end'));
                    ob_start_dp = JSON.parse(localStorage.getItem('ob_start'));
                    ob_end_dp = JSON.parse(localStorage.getItem('ob_end'));
                    for (let i = 0; i < res.domain.length; i++) {
                        $('#domain').append('<option value="' + res.domain[i].domain_name + '">' + res.domain[i]
                            .domain_name +
                            '</option>')
                    }
                    for (let i = 0; i < res.segment.length; i++) {
                        $('#segment').append('<option value="' + res.segment[i].segment_name + '">' +
                            res.segment[i].segment_name + '</option>')
                    }
                    for (let i = 0; i < res.p_title.length; i++) {
                        $('#p_title').append('<option value="' + res.p_title[i].p_title + '">' +
                            res.p_title[i].p_title + '</option>')
                    }
                    for (let i = 0; i < res.subSegment.length; i++) {
                        $('#subSegment').append('<option value="' + res.subSegment[i].sub_segment_name + '">' +
                            res.subSegment[i].sub_segment_name + '</option>')
                    }
                    for (let i = 0; i < res.team.length; i++) {
                        $('#team').append('<option value="' + res.team[i].name + '">' +
                            res.team[i].name + '</option>')
                    }
                    for (let i = 0; i < res.profile.length; i++) {
                        $('#profile').append('<option value="' + res.profile[i].c_profile_name + '">' +
                            res.profile[i].c_profile_name + '</option>')
                    }
                    for (let i = 0; i < res.user_recruiter.length; i++) {
                        $('#recruiter').append('<option value="' + res.user_recruiter[i].id + '">' +
                            res.user_recruiter[i].name + '</option>')
                    }
                    for (let i = 0; i < res.client.options.length; i++) {
                        $('#client').append('<option value="' + res.client.options[i].option_name + '">' +
                            res.client.options[i].option_name + '</option>')
                    }
                    for (let i = 0; i < res.address.length; i++) {
                        if (res.address[i].address != '') {
                            $('#residence').append('<option value="' + res.address[i].address + '">' +
                                res.address[i].address + '</option>')
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
                    for (let i = 0; i < res.career.options.length; i++) {
                        $('#career_level').append('<option value="' + res.career.options[i].option_name + '">' +
                            res.career.options[i].option_name + '</option>')
                    }
                    for (let i = 0; i < res.appStatus.options.length; i++) {
                        $('#appStatus').append('<option value="' + res.appStatus.options[i].option_name + '">' +
                            res.appStatus.options[i].option_name + '</option>')
                    }
                    for (let i = 0; i < res.course.options.length; i++) {
                        $('#course').append('<option value="' + res.course.options[i].option_name + '">' +
                            res.course.options[i].option_name + '</option>')
                    }
                    for (let i = 0; i < res.certification.options.length; i++) {
                        $('#certification').append('<option value="' + res.certification.options[i].option_name + '">' +
                            res.certification.options[i].option_name + '</option>')
                    }
                    $('#loader1').hide()
                    console.log(domain_dp);
                    if (domain_dp != null || recruiter_dp != null || client_dp != null || portal_dp != null ||
                        resd_dp != null || career_dp != null || status_dp != null || category_dp != null ||
                        remarks_dp != null || endo_start_dp != null || endo_end_dp != null || Shifted_start_dp !=
                        null || Shifted_end_dp != null || ob_start_dp != null || ob_end_dp != null) {
                        $('#domain').val(domain_dp);
                        console.log('idr a rha');
                        $('#recruiter').val(recruiter_dp);
                        $('#client').val(client_dp);
                        $('#portal').val(portal_dp);
                        $('#residence').val(resd_dp);
                        $('#career_level').val(career_dp);
                        $('#status').val(status_dp);
                        $('#category').val(category_dp);
                        $('#remarks').val(remarks_dp);
                        $('#endo_start').val(endo_start_dp);
                        $('#endo_end').val(endo_end_dp);
                        $('#Shifted_start').val(Shifted_start_dp);
                        $('#Shifted_end').val(Shifted_end_dp);
                        $('#ob_start').val(ob_start_dp);
                        $('#ob_end').val(ob_end_dp);
                        $('#category').trigger('change');
                    }
                })
                .fail(function(err) {
                    console.log(err);
                });
        }
        //close 
        $('svg').tooltip('show');
        // ajax call for view append
        var ajaxReq = 'ToCancelPrevReq'; // you can have its value anything you like

        function summaryAppendAjax(array) {
            array = array;
            console.log(array);
            $('#loader3').show();
            ajaxReq = $.ajax({
                type: "POST",
                url: '{{ url('admin/summaryAppend') }}',
                data: {
                    _token: token,
                    array: array,
                },
                beforeSend: function() {
                    if (ajaxReq != 'ToCancelPrevReq' && ajaxReq.readyState < 4) {
                        ajaxReq.abort();
                    }
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
        var option_tableFilter = "";

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

            p_title = $('#p_title').val();
            profile = $('#profile').val();
            segment = $('#segment').val();
            subSegment = $('#subSegment').val();
            course = $('#course').val();
            certification = $('#certification').val();
            team = $('#team').val();
            appStatus = $('#appStatus').val();
            cname = $('#candidate').val();
            min_salary = $('#min_salary').val();
            max_salary = $('#max_salary').val();
            console.log(search);
            // $('#searchKeyword').val('');
            if ($('#cip').is(':checked')) {
                cip = 1;
            } else {
                cip = 0;
            }
            var globalSearchKeyword = $('#searchKeyword').val();

            // option_table.settings()[0].jqXHR.abort();
            option_tableFilter = $('#smTable').DataTable({
                destroy: true,
                processing: true,
                serverSide: true,
                ordering: false,
                ajax: {
                    url: "{{ route('filterSearch') }}",
                    type: "GET",
                    data: {
                        _token: token,
                        min_salary: min_salary,
                        max_salary: max_salary,
                        domain: domain,
                        p_title: p_title,
                        segment: segment,
                        subSegment: subSegment,
                        course: course,
                        certification: certification,
                        team: team,
                        cname: cname,
                        appStatus: appStatus,
                        profile: profile,
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
                        // search: search,
                        // searchKeyword: searchKeyword,
                    },
                },
                drawCallback: function(settings) {
                    $('.hidetrIDSmartSearch').find('tr').each(function() {
                        $(this).dblclick(function() {
                            window.open($(this).attr('data-href'), '_blank');
                        });
                    });
                },
                createdRow: function(row, data, dataIndex) {
                    $(row).addClass('id');
                    let id = $(row).find('td:first').text().trim();
                    $(row).attr('data-href', `{{ url('admin/details/${id}') }}`);


                },
                initComplete: function(settings, json) {

                    $('#smTable_length').hide();

                    $('#foundRecord').val(json.recordsTotal)
                    $('#sifted').val(json.recordsTotal)
                    setTimeout(() => {
                        $("#loader").hide();
                    }, 1000);

                    // summaryAppendAjax(json.array);
                    // console.log(json.search);
                    // if (json.search != null) {
                    // $('#searchKeyword').val(json.search)
                    $('#searchKeyword').change()
                    // }
                    $('#filterResult_div').find('.dt-buttons').append(
                        '<button type=checkbox onclick="showAllColumnFunc()" class="customColumnBtn  btn btn-sm" id="selectAll">&nbsp; Show All Columns</button>'
                    )
                    $('#filterResult_div').find('.dt-buttons').append(
                        '<button type=checkbox onclick="showNoColumnFunc()" class="customColumnBtn ml-2 btn btn-sm" id="selectAll">&nbsp;  Hide All Columns</button>'
                    )
                    this.api().columns().every(function() {
                        var column = this;
                        var columnIndex = column.index();
                        var header = $(column.header());
                        // Remove previous input
                        header.find('.column-search').remove();
                        var input = $(
                                '<input type="text"  class="form-control form-control-sm column-search" placeholder="Search" />'
                            )
                            .appendTo(header)
                            .on('keyup change', function() {
                               
                                    column.search(this.value).draw();
                                
                            });

                        input.data('column-index', columnIndex);

                    });
                    // $('#smTable').on('draw.dt', function() {
                    //     if (settings.oFeatures.bServerSide === true && !settings.oFeatures.bSort) {
                    //         console.log('should be appended');
                    //         console.log('=======');
                    //         console.log(settings.json.array);
                    //         console.log('=======');
                    //         // This condition ensures that the callback is only executed for client-side processing
                    //         console.log(settings.json.totalCount);
                    //         summaryAppendAjax(settings.json.array);
                    //         $('#foundRecord').val(settings.json.totalCount);
                    //     }
                    // });
                },
                columns: [{
                        data: 'id',
                        name: 'id',
                        ordering: false, // Enable sorting

                        searchable: false
                    },
                    {
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        searchable: false,
                        ordering: false, // Enable sorting
                    },
                    {
                        data: 'team_name',
                        name: 'team_name',
                        // searchable: false,
                        orderable: true,
                        ordering: false, // Enable sorting
                    },
                    {
                        data: 'recruiter_name',
                        name: 'recruiter_name',
                        ordering: false, // Enable sorting
                    },
                    {
                        data: 'date_shifted',
                        name: 'date_shifted',
                        ordering: false, // Enable sorting
                    },

                    {
                        data: 'candidate_profile',
                        name: 'candidate_profile',
                        // searchable: false,
                        // orderable: ,false
                        ordering: false, // Enable sorting
                    },

                    {
                        data: 'date_invited',
                        name: 'date_invited',
                        ordering: false, // Enable sorting
                    },

                    {
                        data: 'fullName',
                        name: 'fullName',
                        // searchable: false,
                        // orderable: ,false
                        ordering: false, // Enable sorting
                    },

                    {
                        data: 'gender',
                        name: 'gender',
                        ordering: false, // Enable sorting
                    },

                    {
                        data: 'phone',
                        name: 'phone',
                        ordering: false, // Enable sorting
                    },

                    {
                        data: 'Email',
                        name: 'Email',
                        // searchable: false,
                        // orderable: ,false
                        ordering: false, // Enable sorting
                    },

                    {
                        data: 'address',
                        name: 'address',
                        ordering: false, // Enable sorting
                    },

                    {
                        data: 'course',
                        name: 'course',
                        ordering: false, // Enable sorting
                    },
                    {
                        data: 'educational_attain',
                        name: 'educational_attain',
                        ordering: false, // Enable sorting
                    },

                    {
                        data: 'certification',
                        name: 'certification',
                        ordering: false, // Enable sorting
                    },

                    {
                        data: 'emp_history',
                        name: 'emp_history',
                        ordering: false, // Enable sorting
                    },

                    {
                        data: 'interview_note',
                        name: 'interview_note',
                        ordering: false, // Enable sorting
                    },

                    {
                        data: 'exp_salary',
                        name: 'exp_salary',
                        ordering: false, // Enable sorting
                    },

                    {
                        data: 'app_status',
                        name: 'app_status',
                        // searchable: false,
                        // orderable: ,false
                        ordering: false, // Enable sorting
                    },

                    {
                        data: 'type',
                        name: 'type',
                        ordering: false, // Enable sorting
                    },

                    {
                        data: 'endi_date',
                        name: 'endi_date',
                        ordering: false, // Enable sorting
                    },

                    {
                        data: 'client',
                        name: 'client',
                        ordering: false, // Enable sorting
                    },

                    {
                        data: 'site',
                        name: 'site',
                        ordering: false, // Enable sorting
                    },


                    {
                        data: 'position_title',
                        name: 'position_title',
                        ordering: false, // Enable sorting
                    },

                    {
                        data: 'career_endo',
                        name: 'career_endo',
                        ordering: false, // Enable sorting
                    },

                    {
                        data: 'segment',
                        name: 'segment',
                        ordering: false, // Enable sorting
                    },

                    {
                        data: 'sub_segment',
                        name: 'sub_segment',
                        ordering: false, // Enable sorting
                    },

                    {
                        data: 'endostatus',
                        name: 'endostatus',
                        ordering: false, // Enable sorting
                    },

                    {
                        data: 'remarks_for_finance',
                        name: 'remarks_for_finance',
                        ordering: false, // Enable sorting
                    },

                    {
                        data: 'onboardnig_date',
                        name: 'onboardnig_date',
                        ordering: false, // Enable sorting
                    },

                ],
                dom: 'Blfrtip',
                columnDefs: [{
                    targets: 1,
                    className: 'noVis'
                }],
                bInfo: true,

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
                processing: false,
                ordering: false,
                serverSide: true,

                ajax: {
                    url: "{{ route('view-smart-search-table') }}",
                    type: "GET",
                },

                drawCallback: function(settings) {
                    $('.hidetrIDSmartSearch').find('tr').each(function() {
                        $(this).dblclick(function() {
                            window.open($(this).attr('data-href'), '_blank');
                        });
                    });
                },
                createdRow: function(row, data, dataIndex) {
                    $(row).addClass('id');
                    let id = $(row).find('td:first').text().trim();
                    $(row).attr('data-href', `{{ url('admin/details/${id}') }}`);


                },
                initComplete: function(settings, json) {
                    console.log('this is main table initcomplete');
                    // Apply the search 
                    $('#foundRecord').val(json.recordsTotal);
                    $('#sifted').val(json.recordsTotal);
                    $('#foundRecord').val(settings.json.recordsTotal);
                    $('#sifted').val(settings.json.recordsTotal);

                    $('#smTable').on('draw.dt', function() {
                        // if (settings.oFeatures.bServerSide === true && !settings.oFeatures.bSort) {
                        // console.log('should be appendedssss');
                        // console.log('=======');
                        // This condition ensures that the callback is only executed for client-side processing
                        // console.log(settings.json.array);
                        // summaryAppendAjax(settings.json.array);
                        $('#foundRecord').val(settings.json.totalCount);
                        // }
                    });

                    setTimeout(() => {
                        $('svg').tooltip('hide');
                    }, 5000);

                    $("#loader").hide();
                    $('#smTable_length').hide();
                    $('#filterResult_div').find('.dt-buttons').append(
                        '<button type=checkbox onclick="showAllColumnFunc()" class="customColumnBtn  btn btn-sm" id="selectAll">&nbsp; Show All Columns</button>'
                    );
                    $('#filterResult_div').find('.dt-buttons').append(
                        '<button type=checkbox onclick="showNoColumnFunc()" class="customColumnBtn ml-2 btn btn-sm" id="selectAll">&nbsp; Hide All Columns</button>'
                    );

                    this.api().columns().every(function() {
                        console.log('wrong');

                        var column = this;
                        var columnIndex = column.index();
                        var header = $(column.header());
                        // Clone the header contents
                        var headerContents = header.contents().clone();
                        header.empty();
                        headerContents.appendTo(header);
                        var input = $(
                                '<input type="text" class="form-control form-control-sm column-search" placeholder="Search here" />'
                            )
                            .appendTo(header)
                            .on('keyup change', function() {
                              
                                    column.search(this.value).draw();
                                 
                            });
                        input.data('column-index', columnIndex);
                    });

                    // Focus column search input on click
                    $('thead').on('click', 'th', function() {
                        var columnIndex = option_table.column(this).index();
                        var input = $(this).find('.column-search');

                        if (input.length > 0) {
                            input.focus();
                        }
                    });


                },

                columns: [{
                        data: 'id',
                        name: 'id',
                        ordering: false, // Enable sorting 
                        searchable: false
                    },
                    {
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        searchable: false,
                        ordering: false, // Enable sorting
                    },
                    {
                        data: 'team_name',
                        name: 'team_name',
                        // searchable: false,
                        orderable: true,
                        ordering: false, // Enable sorting
                    },
                    {
                        data: 'recruiter_name',
                        name: 'recruiter_name',
                        ordering: false, // Enable sorting 
                    },
                    {
                        data: 'date_shifted',
                        name: 'date_shifted',
                        ordering: false, // Enable sorting
                    },

                    {
                        data: 'candidate_profile',
                        name: 'candidate_profile',
                        // searchable: false,
                        // orderable: false
                        ordering: false, // Enable sorting
                    },




                    {
                        data: 'date_invited',
                        name: 'date_invited',
                        ordering: false, // Enable sorting
                    },

                    {
                        data: 'fullName',
                        name: 'fullName',
                        // searchable: false,
                        // orderable: false
                        ordering: false, // Enable sorting
                    },

                    {
                        data: 'gender',
                        name: 'gender',
                        ordering: false, // Enable sorting
                    },

                    {
                        data: 'phone',
                        name: 'phone',
                        ordering: false, // Enable sorting
                    },

                    {
                        data: 'Email',
                        name: 'Email',
                        // searchable: false,
                        // orderable: false
                        ordering: false, // Enable sorting
                    },

                    {
                        data: 'address',
                        name: 'address',
                        ordering: false, // Enable sorting
                    },

                    {
                        data: 'course',
                        name: 'course',
                        ordering: false, // Enable sorting
                    },
                    {
                        data: 'educational_attain',
                        name: 'educational_attain',
                        ordering: false, // Enable sorting
                    },

                    {
                        data: 'certification',
                        name: 'certification',
                        ordering: false, // Enable sorting
                    },

                    {
                        data: 'emp_history',
                        name: 'emp_history',
                        ordering: false, // Enable sorting
                    },

                    {
                        data: 'interview_note',
                        name: 'interview_note',
                        ordering: false, // Enable sorting
                    },

                    {
                        data: 'exp_salary',
                        name: 'exp_salary',
                        ordering: false, // Enable sorting
                    },

                    {
                        data: 'app_status',
                        name: 'app_status',
                        // searchable: false,
                        // orderable: false
                        ordering: false, // Enable sorting
                    },

                    {
                        data: 'type',
                        name: 'type',
                        ordering: false, // Enable sorting
                    },

                    {
                        data: 'endi_date',
                        name: 'endi_date',
                        ordering: false, // Enable sorting
                    },

                    {
                        data: 'client',
                        name: 'client',
                        ordering: false, // Enable sorting
                    },

                    {
                        data: 'site',
                        name: 'site',
                        ordering: false, // Enable sorting
                    },


                    {
                        data: 'position_title',
                        name: 'position_title',
                        ordering: false, // Enable sorting
                    },

                    {
                        data: 'career_endo',
                        name: 'career_endo',
                        ordering: false, // Enable sorting
                    },

                    {
                        data: 'segment',
                        name: 'segment',
                        ordering: false, // Enable sorting
                    },

                    {
                        data: 'sub_segment',
                        name: 'sub_segment',
                        ordering: false, // Enable sorting
                    },

                    {
                        data: 'endostatus',
                        name: 'endostatus',
                        ordering: false, // Enable sorting
                    },

                    {
                        data: 'remarks_for_finance',
                        name: 'remarks_for_finance',
                        ordering: false, // Enable sorting
                    },


                    // {
                    //     data: 'remarks',
                    //     name: 'remarks'
                    // ordering: false, // Enable sorting
                    // },



                    {
                        data: 'onboardnig_date',
                        name: 'onboardnig_date',
                        ordering: false, // Enable sorting
                    },

                    // {
                    //     data: 'invoice_number',
                    //     name: 'invoice_number'
                    // ordering: false, // Enable sorting
                    // },

                    // {
                    //     data: 'OR_Number',
                    //     name: 'OR_Number',
                    //     // searchable: false,
                    //     // orderable: false
                    // ordering: false, // Enable sorting
                    // },

                    // {
                    //     data: 'Replacement_For',
                    //     name: 'Replacement_For',
                    //     // searchable: false,
                    //     // orderable: false
                    // ordering: false, // Enable sorting
                    // },




                ],
                dom: 'Blfrtip',
                columnDefs: [{
                    targets: 1,
                    className: 'noVis'
                }],
                bInfo: true,

                buttons: [{
                    extend: 'colvis',
                    collectionLayout: 'fixed two-column',
                    text: 'List of Visible Coloumn Names in Current Table(Click to Deselect a Coloumn)',
                    columns: ':not(.noVis)'
                }]
            });
        }
        // close 
        $('#smTable').on('click', 'tbody tr', function() {
            $('tr').removeClass('hover-primary1');
            $(this).addClass('hover-primary1');
        })

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
                // option_table.page.len(20).draw();
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
            // option_table.page.len(-1).draw();
            // passIDToSummaryAppend();
            // // console.log(obj);
            // let test = $('#searchKeyword').val().split(' ');
            // for (let index = 0; index < test.length; index++) {
            //     if (test[index] == 'MALE') {
            //         option_table.column(8).search('^' + test[index], true, false).draw();
            //         // console.log(test[index]);
            //     } else if (test[index] == 'FEMALE') {
            //         option_table.column(8).search('^' + test[index], true, false).draw();
            //         // console.log(test[index]);
            //     }
            // else {
            //     console.log(test[index]);
            //     option_table.column(22).search("").draw();
            // }
            // }
            // return;
            // option_table.column(22).search('^' + $('#searchKeyword').val(), true, false)
            // append summary after passing the curetn candidate array for calculations 
            console.log(($('#smTable_filter').children().children()));
            $('#smTable_filter').children().children().val($('#searchKeyword').val());
            $('#smTable_filter').children().children().trigger('input');
            $('#smTable1_filter').children().children().val($('#searchKeyword').val());
            $('#smTable1_filter').children().children().trigger('input');
            // option_tableFilter.draw();
            // let total_recored = data.split(" ")
            // console.log(total_recored)
            // $('#foundRecord').val(total_recored[3])
            // let tableID = $('#filterResult_div').children().children().attr('id')
            // console.log('table id is ' + tableID);
            // if (tableID == 'filteredTable_wrapper') {
            //     countRecordFilter()
            // }
            // if (tableID == 'smTable_wrapper') {
            //     countRecord()
            // }
            // var data = $(this).val();
            // option_table.draw();
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

        // enable focus on added input in th starts
        function enableFocusOnInput(e) {
            $(e).find('input').focus();
        }
        // ends

        // Custom coloumnwise search  starts here
        // function individualColomnSearchFunc(e) {
        //     // draw values in option_table instance 
        //     console.log($(e).val());
        //     console.log($(e).attr('data-id'));
        //     let data_id = $(e).attr('data-id');
        //     if (data_id == 15 || data_id == 16) {
        //         option_table.column($(e).attr('data-id')).search($(e).val(), true, false).draw();
        //     } else {
        //         option_table.column($(e).attr('data-id')).search('^' + $(e).val(), true, false).draw();
        //     }
        //     passIDToSummaryAppend();
        //     // console.log(obj);
        //     let test = $('#searchKeyword').val().split(' ');
        //     for (let index = 0; index < test.length; index++) {
        //         if (test[index] == 'MALE') {
        //             option_table.column(22).search('^' + test[index], true, false).draw();
        //             // console.log(test[index]);
        //         } else if (test[index] == 'FEMALE') {
        //             option_table.column(22).search('^' + test[index], true, false).draw();
        //             // console.log(test[index]);
        //         }
        //         // else {
        //         //     console.log(test[index]);
        //         //     option_table.column(22).search("").draw();
        //         // }
        //     }
        //     // return;
        //     // option_table.column(22).search('^' + $('#searchKeyword').val(), true, false)
        //     // append summary after passing the curetn candidate array for calculations 

        //     // $('#smTable_filter').children().children().val($('#searchKeyword').val());
        //     // $('#smTable_filter')
        //     //     .children().children().trigger('input');
        //     // $('#smTable1_filter').children().children().val($(
        //     //     '#searchKeyword').val());
        //     // $('#smTable1_filter').children().children().trigger('input');
        //     // // let total_recored = data.split(" ")
        //     // // console.log(total_recored)
        //     // // $('#foundRecord').val(total_recored[3])
        //     // let tableID = $('#filterResult_div').children().children().attr('id')
        //     // if (tableID == 'filteredTable_wrapper') {
        //     //     countRecordFilter()
        //     // }
        //     // if (tableID == 'smTable_wrapper') {
        //     //     countRecord()
        //     // }
        // }
        // ends

        function toggleSearchFunc() {
            for (let items of document.querySelectorAll('.inputTh')) {
                items.style.display == 'block' ? items.style.display = 'none' : items.style.display = 'block'
            }

        }

        window.onbeforeunload = function(event) {
            // get destined url and save or not save selected dropdosn according to conditions 
            url = document.activeElement.href;
            currentURL = window.location.href;
            let bfrLifeStr = currentURL.split("admin/").pop();
            let afterLifeStr = url.split("admin/").pop();
            if (afterLifeStr == bfrLifeStr) {
                localStorage.clear();
                return;
            }
            if (afterLifeStr == 'record' || afterLifeStr == 'search' || afterLifeStr == 'finance') {

                var domain = $('#domain').val();
                var recruiter = $('#recruiter').val();
                var client = $('#client').val();
                var portal = $('#portal').val();
                var resd = $('#residence').val();
                var career = $('#career_level').val();
                var status = $('#status').val();
                var category = $('#category').val();
                var remarks = $('#remarks').val();
                var endo_start = $('#endo_start').val() != 'undefined' ? $('#endo_start').val() : '';
                var endo_end = $('#endo_end').val() != 'undefined' ? $('#endo_end').val() : '';
                var Shifted_start = $('#Shifted_start').val() != 'undefined' ? $('#Shifted_start').val() : '';
                var Shifted_end = $('#Shifted_end').val() != 'undefined' ? $('#Shifted_end').val() : '';
                var ob_start = $('#ob_start').val() != 'undefined' ? $('#ob_start').val() : '';
                var ob_end = $('#ob_end').val() != 'undefined' ? $('#ob_end').val() : '';

                localStorage.setItem('domain', JSON.stringify(domain));
                localStorage.setItem('recruiter', JSON.stringify(recruiter));
                localStorage.setItem('client', JSON.stringify(client));
                localStorage.setItem('portal', JSON.stringify(portal));
                localStorage.setItem('resd', JSON.stringify(resd));
                localStorage.setItem('career', JSON.stringify(career));
                localStorage.setItem('status', JSON.stringify(status));
                localStorage.setItem('category', JSON.stringify(category));
                localStorage.setItem('remarks', JSON.stringify(remarks));
                localStorage.setItem('endo_start', JSON.stringify(endo_start));
                localStorage.setItem('endo_end', JSON.stringify(endo_end));
                localStorage.setItem('Shifted_start', JSON.stringify(Shifted_start));
                localStorage.setItem('Shifted_end', JSON.stringify(Shifted_end));
                localStorage.setItem('ob_start', JSON.stringify(ob_start));
                localStorage.setItem('ob_end', JSON.stringify(ob_end));

            } else {
                localStorage.clear();

            }
        };
        // setTimeout(() => {
        // $('.dt-button').click();
        // let test = document.querySelectorAll(".dt-button.buttons-columnVisibility");
        // for (let item of test) {
        //     item.classList.add('customClasss')
        //     item.addEventListener('click', (e) => {
        //         let divHtml = $("div[role='menu']").html();
        //     localStorage.setItem('divHTML', JSON.stringify(divHtml));
        //     })
        // }
        // }, 4000);


        // function saveFilter() {
        //     let divHtml = $("div[role='menu']").html();
        //     localStorage.setItem('divHTML', JSON.stringify(divHtml));
        // }
    </script>
@endsection
