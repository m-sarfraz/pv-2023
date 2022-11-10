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

                                        <label class="Label-00">Career Level:</label>
                                        <select multiple name="CAREER_LEVEL_FINANCE" required="" id="career_level"
                                            onchange="FilterSearch()"
                                            class="form-control border h-px-20_custom select2_dropdown w-100">

                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group mb-0">
                                        <label class="Label">Start Date (Sifted):</label>
                                        <input type="date" id="Shifted_start" class="w-100 users-input-S-C form-control"
                                            onchange="FilterSearch()" />
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
                                        <select multiple name="status" id="status" onchange="FilterSearch()"
                                            class="w-100 form-control select2_dropdown w-100">
                                        </select>
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
            <div class="col-lg-12">
                <div class="table-responsive border-right pt-3" id="filterResult_div">
                    <div class="tableFixHead">
                        <table id="smTable" class="table">
                            <thead class="bg-light w-100" style="">
                                <tr style="">
                                    <th class="d-none"> sr</th>
                                    <th class="ant-table-cell" onclick="enableFocusOnInput(this)">
                                        <svg title="Click Here For Columnwise Search" data-toggle="tooltip"
                                            data-placement="top" style="color:#dc8627;text-color:red;top:0;bottom:0"
                                            xmlns="http://www.w3.org/2000/svg" onclick="toggleSearchFunc()"
                                            width="22" height="22" fill="currentColor"
                                            class="bi bi-three-dots-vertical" viewBox="0 0 16 16">
                                            <path
                                                d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z" />
                                        </svg>
                                        Sr
                                    </th>

                                    <th class="ant-table-cell" onclick="enableFocusOnInput(this)">Team <input
                                            class="form-control inputTh" data-id="2" type="text"
                                            style="display:block" onchange="individualColomnSearchFunc(this)"
                                            placeholder="Search Team" /></th>
                                    <th class="ant-table-cell" onclick="enableFocusOnInput(this)">Recruiter <input
                                            class="form-control inputTh" data-id="3" type="text"
                                            style="display:block" onchange="individualColomnSearchFunc(this)"
                                            placeholder="Search Recruiter" />
                                    </th>


                                    <th class="ant-table-cell" onclick="enableFocusOnInput(this)">Candidate <input
                                            class="form-control inputTh" data-id="4" type="text"
                                            style="display:block" onchange="individualColomnSearchFunc(this)"
                                            placeholder="Search Team" /></th>
                                    <th class="ant-table-cell" onclick="enableFocusOnInput(this)">Date Sifted <input
                                            class="form-control inputTh" data-id="5" type="text"
                                            style="display:block" onchange="individualColomnSearchFunc(this)"
                                            placeholder="Search Team" /> </th>
                                    <th class="ant-table-cell" onclick="enableFocusOnInput(this)">Candidate’s Profile
                                        <input class="form-control inputTh" data-id="6" type="text"
                                            style="display:block" onchange="individualColomnSearchFunc(this)"
                                            placeholder="Search Team" />
                                    </th>
                                    <th class="ant-table-cell" onclick="enableFocusOnInput(this)">Date Invited <input
                                            class="form-control inputTh" data-id="7" type="text"
                                            style="display:block" onchange="individualColomnSearchFunc(this)"
                                            placeholder="Search Team" /> </th>
                                    <th class="ant-table-cell" onclick="enableFocusOnInput(this)">Gender <input
                                            class="form-control inputTh" data-id="8" type="text"
                                            style="display:block" onchange="individualColomnSearchFunc(this)"
                                            placeholder="Search Team" /> </th>
                                    <th class="ant-table-cell" onclick="enableFocusOnInput(this)">Phone <input
                                            class="form-control inputTh" data-id="9" type="text"
                                            style="display:block" onchange="individualColomnSearchFunc(this)"
                                            placeholder="Search Team" /> </th>

                                    <th class="ant-table-cell" onclick="enableFocusOnInput(this)">Email
                                        <input class="form-control inputTh" data-id="10" type="text"
                                            style="display:block" onchange="individualColomnSearchFunc(this)"
                                            placeholder="Search Team" />
                                    </th>
                                    <th class="ant-table-cell" onclick="enableFocusOnInput(this)">Address <input
                                            class="form-control inputTh" data-id="11" type="text"
                                            style="display:block" onchange="individualColomnSearchFunc(this)"
                                            placeholder="Search Team" /> </th>
                                    <th class="ant-table-cell" onclick="enableFocusOnInput(this)">Course <input
                                            class="form-control inputTh" data-id="12" type="text"
                                            style="display:block" onchange="individualColomnSearchFunc(this)"
                                            placeholder="Search Team" /> </th>

                                    <th class="ant-table-cell" onclick="enableFocusOnInput(this)">Educational Attainment
                                        <input class="form-control inputTh" data-id="13" type="text"
                                            style="display:block" onchange="individualColomnSearchFunc(this)"
                                            placeholder="Search Team" />
                                    </th>
                                    <th class="ant-table-cell" onclick="enableFocusOnInput(this)">Certificate <input
                                            class="form-control inputTh" data-id="14" type="text"
                                            style="display:block" onchange="individualColomnSearchFunc(this)"
                                            placeholder="Search Team" /> </th>
                                    <th class="ant-table-cell" onclick="enableFocusOnInput(this)">Employment History
                                        <input class="form-control inputTh" data-id="15" type="text"
                                            style="display:block" onchange="individualColomnSearchFunc(this)"
                                            placeholder="Search Team" />
                                    </th>
                                    <th class="ant-table-cell" onclick="enableFocusOnInput(this)">Interview Note <input
                                            class="form-control inputTh" data-id="16" type="text"
                                            style="display:block" onchange="individualColomnSearchFunc(this)"
                                            placeholder="Search Team" /> </th>

                                    <th class="ant-table-cell" onclick="enableFocusOnInput(this)">Exp Salary <input
                                            class="form-control inputTh" data-id="17" type="text"
                                            style="display:block" onchange="individualColomnSearchFunc(this)"
                                            placeholder="Search Team" /> </th>
                                    <th class="ant-table-cell" onclick="enableFocusOnInput(this)">Application Status<input
                                            class="form-control inputTh" data-id="18" type="text"
                                            style="display:block" onchange="individualColomnSearchFunc(this)"
                                            placeholder="Search Team" /></th>
                                    <th class="ant-table-cell" onclick="enableFocusOnInput(this)">Type <input
                                            class="form-control inputTh" data-id="19" type="text"
                                            style="display:block" onchange="individualColomnSearchFunc(this)"
                                            placeholder="Search Team" /> </th>
                                    <th class="ant-table-cell" onclick="enableFocusOnInput(this)">Endorsement Date <input
                                            class="form-control inputTh" data-id="20" type="text"
                                            style="display:block" onchange="individualColomnSearchFunc(this)"
                                            placeholder="Search Team" /> </th>

                                    <th class="ant-table-cell" onclick="enableFocusOnInput(this)">Client <input
                                            class="form-control inputTh" data-id="21" type="text"
                                            style="display:block" onchange="individualColomnSearchFunc(this)"
                                            placeholder="Search Team" /> </th>
                                    <th class="ant-table-cell" onclick="enableFocusOnInput(this)">Site <input
                                            class="form-control inputTh" data-id="22" type="text"
                                            style="display:block" onchange="individualColomnSearchFunc(this)"
                                            placeholder="Search Team" /> </th>
                                    <th class="ant-table-cell" onclick="enableFocusOnInput(this)">Position Title <input
                                            class="form-control inputTh" data-id="23" type="text"
                                            style="display:block" onchange="individualColomnSearchFunc(this)"
                                            placeholder="Search Team" /> </th>

                                    <th class="ant-table-cell" onclick="enableFocusOnInput(this)">Career <input
                                            class="form-control inputTh" data-id="24" type="text"
                                            style="display:block" onchange="individualColomnSearchFunc(this)"
                                            placeholder="Search Team" /> </th>
                                    <th class="ant-table-cell" onclick="enableFocusOnInput(this)">Segment <input
                                            class="form-control inputTh" data-id="25" type="text"
                                            style="display:block" onchange="individualColomnSearchFunc(this)"
                                            placeholder="Search Team" /> </th>
                                    <th class="ant-table-cell" onclick="enableFocusOnInput(this)">Sub-Segment <input
                                            class="form-control inputTh" data-id="26" type="text"
                                            style="display:block" onchange="individualColomnSearchFunc(this)"
                                            placeholder="Search Team" /> </th>
                                    <th class="ant-table-cell" onclick="enableFocusOnInput(this)">Endorsement Status
                                        <input class="form-control inputTh" data-id="27" type="text"
                                            style="display:block" onchange="individualColomnSearchFunc(this)"
                                            placeholder="Search Team" />
                                    <th class="ant-table-cell" onclick="enableFocusOnInput(this)">Remarks For Finance
                                        <input class="form-control inputTh" data-id="28" type="text"
                                            style="display:block" onchange="individualColomnSearchFunc(this)"
                                            placeholder="Search Team" />
                                    </th>
                                    <th class="ant-table-cell" onclick="enableFocusOnInput(this)">Remarks <input
                                            class="form-control inputTh" data-id="29" type="text"
                                            style="display:block" onchange="individualColomnSearchFunc(this)"
                                            placeholder="Search Team" /> </th>


                                    </th>

                                    <th class="ant-table-cell" onclick="enableFocusOnInput(this)">Onboarding Date <input
                                            class="form-control inputTh" data-id="30" type="text"
                                            style="display:block" onchange="individualColomnSearchFunc(this)"
                                            placeholder="Search Team" /> </th>

                                    <th class="ant-table-cell" onclick="enableFocusOnInput(this)">Invoice Number <input
                                            class="form-control inputTh" data-id="31" type="text"
                                            style="display:block" onchange="individualColomnSearchFunc(this)"
                                            placeholder="Search Team" /> </th>

                                    <th class="ant-table-cell" onclick="enableFocusOnInput(this)">OR Number <input
                                            class="form-control inputTh" data-id="32" type="text"
                                            style="display:block" onchange="individualColomnSearchFunc(this)"
                                            placeholder="Search Team" /></th>

                                    <th class="ant-table-cell" onclick="enableFocusOnInput(this)">Replacement For <input
                                            class="form-control inputTh" data-id="33" type="text"
                                            style="display:block" onchange="individualColomnSearchFunc(this)"
                                            placeholder="Search Team" /></th>



                                </tr>
                            </thead>
                            <tbody class="hidetrID" style="height:100px">
                            </tbody>
                            <tfoot>
                                <tr style="">
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
                                    <th class="ant-table-cell" onclick="enableFocusOnInput(this)">Remarks </th>
                                    <th class="ant-table-cell" onclick="enableFocusOnInput(this)">Onboarding Date </th>
                                    <th class="ant-table-cell" onclick="enableFocusOnInput(this)">Invoice Number</th>
                                    <th class="ant-table-cell" onclick="enableFocusOnInput(this)">OR Number</th>
                                    <th class="ant-table-cell" onclick="enableFocusOnInput(this)">Replacement For</th>
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
                    for (let i = 0; i < res.career.options.length; i++) {
                        $('#career_level').append('<option value="' + res.career.options[i].option_name + '">' +
                            res.career.options[i].option_name + '</option>')
                    }
                    $('#loader1').hide()
                    if (domain_dp == null) {
                        console.log('error');
                    }
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
        function summaryAppendAjax(array) {
            array = array;
            console.log(array);
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
            console.log('aaaaaa');
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
                ordering: false,
                processing: true,
                serverSide: false,
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

                    divHtml = JSON.parse(localStorage.getItem('divHTML')); 
                    $("div[role='menu']").html()
                    document.querySelector(".dt-button").classList.add('customDivClass');
                    $("#loader").show();
                    $('.customDivClass').click();
                    let test = document.querySelectorAll(".dt-button.buttons-columnVisibility");
                    for (let item of test) {
                        item.classList.add('customClasss')
                        item.addEventListener('click', saveFilter);
                    }
                    setTimeout(() => {
                        $("div[role='menu']").html('');
                        $("div[role='menu']").html(divHtml);
                        $('.customDivClass').click();
                    }, 100);
                    setTimeout(() => {
                        $("#loader").hide();
                    }, 1000);
                    summaryAppendAjax(json.array);
                    // console.log(json.search);
                    if (json.search != null) {
                        $('#searchKeyword').val(json.search)
                        $('#searchKeyword').change()
                    }
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
                        data: 'team',
                        name: 'team',
                        // searchable: false,
                        // orderable: false
                    },
                    {
                        data: 'recruiter',
                        name: 'recruiter'
                    },
                    {
                        data: 'Candidate',
                        name: 'Candidate',
                        // searchable: false,
                        // orderable: false
                    },
                    {
                        data: 'date_shifted',
                        name: 'date_shifted'
                    },



                    {
                        data: 'profile',
                        name: 'profile',
                        // searchable: false,
                        // orderable: false
                    },



                    {
                        data: 'date_invited',
                        name: 'date_invited'
                    },
                    {
                        data: 'gender',
                        name: 'gender'
                    },
                    {
                        data: 'phone',
                        name: 'phone'
                    },
                    {
                        data: 'Email',
                        name: 'Email',
                        // searchable: false,
                        // orderable: false
                    },
                    {
                        data: 'address',
                        name: 'address'
                    },
                    {
                        data: 'course',
                        name: 'course'
                    }, {
                        data: 'educational_attain',
                        name: 'educational_attain'
                    },
                    {
                        data: 'certification',
                        name: 'certification'
                    },
                    {
                        data: 'emp_history',
                        name: 'emp_history'
                    },
                    {
                        data: 'interview_note',
                        name: 'interview_note'
                    },
                    {
                        data: 'exp_salary',
                        name: 'exp_salary'
                    },
                    {
                        data: 'appStatus',
                        name: 'appStatus',
                        // searchable: false,
                        // orderable: false
                    },
                    {
                        data: 'type',
                        name: 'type'
                    },
                    {
                        data: 'endi_date',
                        name: 'endi_date'
                    },
                    {
                        data: 'client',
                        name: 'client'
                    },
                    {
                        data: 'site',
                        name: 'site'
                    },

                    {
                        data: 'position_title',
                        name: 'position_title'
                    },
                    {
                        data: 'career_level',
                        name: 'career_level'
                    },
                    {
                        data: 'segment',
                        name: 'segment'
                    },
                    {
                        data: 'sub_segment',
                        name: 'sub_segment'
                    },
                    {
                        data: 'endostatus',
                        name: 'endostatus'
                    },
                    {
                        data: 'remarks_for_finance',
                        name: 'remarks_for_finance'
                    },

                    {
                        data: 'remarks',
                        name: 'remarks'
                    },


                    {
                        data: 'onboardnig_date',
                        name: 'onboardnig_date'
                    },
                    {
                        data: 'invoice_number',
                        name: 'invoice_number'
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
            $("#loader").hide();
            // call Ajax for returning the data as view

            // summaryAppendAjax()
        }
        // close 
        // $('#smTable tfoot th').each(function() {
        //     for (let index = 0; index < 5; index++) {

        //         var title = $('#example thead th').eq($(this).index()).text();
        //         $(this).html('<input type="text" placeholder="Search ' + index + '" />');
        //     }
        // });

        //start yajra table load 
        function load_datatable() {
            option_table = $('#smTable').DataTable({
                // destroy: false,
                // // search: {
                // //     smart: false
                // // },
                // processing: true,
                // serverSide: true,
                // "language": {
                //     processing: '<div class="spinner-border mr-3" role="status"> </div><span>Processing ...</span>'
                // },
                destroy: true,
                // search: {
                //     smart: false
                // },
                ordering: false,
                processing: true,
                serverSide: false,

                ajax: {
                    url: "{{ route('view-smart-search-table') }}",
                    type: "GET",
                },
                createdRow: function(row, data, dataIndex) {
                    $(row).addClass('id');
                },
                initComplete: function(settings, json) {
                    // Apply the search 
                    setTimeout(() => {
                        $('svg').tooltip('hide');
                    }, 5000);
                    $("#loader").show();
                    document.querySelector(".dt-button").classList.add('customDivClass');
                    $('.customDivClass').click();
                    let test = document.querySelectorAll(".dt-button.buttons-columnVisibility");
                    for (let item of test) {
                        item.classList.add('customClasss')
                        item.addEventListener('click', saveFilter);
                    }
                    setTimeout(() => {
                        $('.customDivClass').click();
                    }, 100);
                    setTimeout(() => {
                        $("#loader").hide();
                    }, 1000);
                    var that = this;
                    option_table.columns().every(function() {
                        var that = this;
                        $('input', this.footer()).on('keyup change', function() {
                            console.log(this.value);
                            option_table.column(9).search('^' + this.value, true, false)
                                .draw();
                            // that.search(this.value).draw();
                        });
                    });
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
                        data: 'team',
                        name: 'team',
                        // searchable: false,
                        // orderable: false
                    },
                    {
                        data: 'recruiter',
                        name: 'recruiter'
                    },
                    {
                        data: 'Candidate',
                        name: 'Candidate',
                        // searchable: false,
                        // orderable: false
                    },
                    {
                        data: 'date_shifted',
                        name: 'date_shifted'
                    },



                    {
                        data: 'profile',
                        name: 'profile',
                        // searchable: false,
                        // orderable: false
                    },



                    {
                        data: 'date_invited',
                        name: 'date_invited'
                    },
                    {
                        data: 'gender',
                        name: 'gender'
                    },
                    {
                        data: 'phone',
                        name: 'phone'
                    },
                    {
                        data: 'Email',
                        name: 'Email',
                        // searchable: false,
                        // orderable: false
                    },
                    {
                        data: 'address',
                        name: 'address'
                    },
                    {
                        data: 'course',
                        name: 'course'
                    }, {
                        data: 'educational_attain',
                        name: 'educational_attain'
                    },
                    {
                        data: 'certification',
                        name: 'certification'
                    },
                    {
                        data: 'emp_history',
                        name: 'emp_history'
                    },
                    {
                        data: 'interview_note',
                        name: 'interview_note'
                    },
                    {
                        data: 'exp_salary',
                        name: 'exp_salary'
                    },
                    {
                        data: 'appStatus',
                        name: 'appStatus',
                        // searchable: false,
                        // orderable: false
                    },
                    {
                        data: 'type',
                        name: 'type'
                    },
                    {
                        data: 'endi_date',
                        name: 'endi_date'
                    },
                    {
                        data: 'client',
                        name: 'client'
                    },
                    {
                        data: 'site',
                        name: 'site'
                    },

                    {
                        data: 'position_title',
                        name: 'position_title'
                    },
                    {
                        data: 'career_level',
                        name: 'career_level'
                    },
                    {
                        data: 'segment',
                        name: 'segment'
                    },
                    {
                        data: 'sub_segment',
                        name: 'sub_segment'
                    },
                    {
                        data: 'endostatus',
                        name: 'endostatus'
                    },
                    {
                        data: 'remarks_for_finance',
                        name: 'remarks_for_finance'
                    },

                    {
                        data: 'remarks',
                        name: 'remarks'
                    },


                    {
                        data: 'onboardnig_date',
                        name: 'onboardnig_date'
                    },
                    {
                        data: 'invoice_number',
                        name: 'invoice_number'
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



                ],
                dom: 'Blfrtip',
                columnDefs: [{
                    targets: 1,
                    className: 'noVis'
                }],

                buttons: [{
                    extend: 'colvis',
                    collectionLayout: 'fixed two-column',
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
            option_table.page.len(-1).draw();
            passIDToSummaryAppend();
            // console.log(obj);
            let test = $('#searchKeyword').val().split(' ');
            for (let index = 0; index < test.length; index++) {
                if (test[index] == 'MALE') {
                    option_table.column(8).search('^' + test[index], true, false).draw();
                    // console.log(test[index]);
                } else if (test[index] == 'FEMALE') {
                    option_table.column(8).search('^' + test[index], true, false).draw();
                    // console.log(test[index]);
                }
                // else {
                //     console.log(test[index]);
                //     option_table.column(22).search("").draw();
                // }
            }
            // return;
            // option_table.column(22).search('^' + $('#searchKeyword').val(), true, false)
            // append summary after passing the curetn candidate array for calculations 

            $('#smTable_filter').children().children().val($('#searchKeyword').val());
            $('#smTable_filter')
                .children().children().trigger('input');
            $('#smTable1_filter').children().children().val($(
                '#searchKeyword').val());
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
        function individualColomnSearchFunc(e) {
            // draw values in option_table instance 
            console.log($(e).val());
            console.log($(e).attr('data-id'));

            option_table.column($(e).attr('data-id')).search('^' + $(e).val(), true, false).draw();
            passIDToSummaryAppend();
            // console.log(obj);
            let test = $('#searchKeyword').val().split(' ');
            for (let index = 0; index < test.length; index++) {
                if (test[index] == 'MALE') {
                    option_table.column(22).search('^' + test[index], true, false).draw();
                    // console.log(test[index]);
                } else if (test[index] == 'FEMALE') {
                    option_table.column(22).search('^' + test[index], true, false).draw();
                    // console.log(test[index]);
                }
                // else {
                //     console.log(test[index]);
                //     option_table.column(22).search("").draw();
                // }
            }
            // return;
            // option_table.column(22).search('^' + $('#searchKeyword').val(), true, false)
            // append summary after passing the curetn candidate array for calculations 

            $('#smTable_filter').children().children().val($('#searchKeyword').val());
            $('#smTable_filter')
                .children().children().trigger('input');
            $('#smTable1_filter').children().children().val($(
                '#searchKeyword').val());
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
        }
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


        function saveFilter() {
            let divHtml = $("div[role='menu']").html();
            localStorage.setItem('divHTML', JSON.stringify(divHtml));
        }
    </script>
@endsection
