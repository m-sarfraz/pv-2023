@extends('layouts.app')

@section('style')

    <style>
        #example1_filter label {
            display: flex;
            width: fit-content;
            margin-left: auto;
            align: items-center;
        }

        .hideID:first-child,
        .hidetrID tr td:first-child {
            display: none !important;
        }

        .hidetrID tr:hover {
            background-color: rgb(159, 165, 243);
        }

    </style>
@endsection


@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-5">
                <p class="C-Heading pt-3">Record Finder:</p>
                <div class="card mb-13">
                    <div class="card-body">
                        <form action="">
                            <div class="row mb-4">
                                <div class="col-lg-6">
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
                                        <input type="text" name="REF_CODE" readonly required="" id="recordNumber"
                                            class="form-control h-px-20_custom border" />
                                    </div>
                                </div>
                            </div>
                            <p class="mb-0 ml-3">Filter by:</p>
                            <div class="row mb-1 align-items-center">
                                <div class="col-lg-6">
                                    <div class="form-group mb-1">
                                        <label class="Label">Recruiter</label>
                                        <select multiple name="recruiter" id="recruiter" class="select2_dropdown  w-100"
                                            onchange="filterUserData()">
                                            @foreach ($user as $key => $user)
                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group mb-1 pt-1">
                                        <label class="d-block font-size-3 mb-0">
                                            Candidate
                                        </label>
                                        <select multiple name="candidate" id="candidate" class="select2_dropdown  w-100"
                                            onchange="filterUserData()">
                                            @foreach ($candidates as $key => $candidate)
                                                <option value="{{ $candidate->id }}">
                                                    {{ $candidate->last_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-1">
                                <div class="col-lg-6">
                                    <div class="form-group mb-1">
                                        <?php
                                        $profile = Helper::get_dropdown('candidates_profile');
                                        ?>
                                        <label class="d-block font-size-3 mb-0">
                                            Profile
                                        </label>
                                        <select multiple name="profile" id="profile" class="select2_dropdown  w-100"
                                            onchange="filterUserData()">
                                            @foreach ($profile->options as $profileOption)
                                                <option value="{{ $profileOption->option_name }}">
                                                    {{ $profileOption->option_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group mb-1">
                                        <?php
                                        $sub_segment = DB::table('six_table_view')
                                            ->distinct()
                                            ->pluck('sub_segment');
                                        ?>

                                        <label class="d-block font-size-3 mb-0">
                                            Sub Segment
                                        </label>
                                        <select multiple name="sub_segment" id="sub_segment" class="select2_dropdown  w-100"
                                            onchange="filterUserData()">
                                            @foreach ($sub_segment as $sub_segmentOption)
                                                <option value="{{ $sub_segmentOption }}">
                                                    {{ $sub_segmentOption }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-1">
                                <div class="col-lg-6">
                                    <div class="form-group mb-1">
                                        <?php
                                        $status = Helper::get_dropdown('application_status');
                                        ?>
                                        <label class="d-block font-size-3 mb-0">
                                            Application Status:
                                        </label>
                                        <select multiple name="app_status" id="app_status" class="select2_dropdown  w-100"
                                            onchange="filterUserData()">
                                            @foreach ($status->options as $statusOptions)
                                                <option value="{{ $statusOptions->option_name }}">
                                                    {{ $statusOptions->option_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group mb-1">
                                        @php
                                            $client = Helper::get_dropdown('clients');
                                        @endphp
                                        <label class="d-block font-size-3 mb-0">
                                            Client:
                                        </label>
                                        <select multiple name="client" id="client" class="select2_dropdown  w-100"
                                            onchange="filterUserData()">
                                            @foreach ($client->options as $clientOptions)
                                                <option value="{{ $clientOptions->option_name }}">
                                                    {{ $clientOptions->option_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-1 align-items-center">
                                <div class="col-lg-6">
                                    <div class="form-group mb-1">
                                        @php
                                            $CareerLevel = Helper::get_dropdown('career_level');
                                        @endphp
                                        <label class="d-block font-size-3 mb-0 pt-lg-1 pt-sm-0 pt-0">
                                            Career Level:
                                        </label>
                                        <select multiple name="career_level" id="career_level"
                                            class="select2_dropdown  w-100" onchange="filterUserData()">
                                            @foreach ($CareerLevel->options as $CareerLevelOptions)
                                                <option value="{{ $CareerLevelOptions->option_name }}">
                                                    {{ $CareerLevelOptions->option_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group mb-1">
                                        <label class="Label">Endo Date:</label>
                                        <div class="d-flex align-items-center"> <input type="date"
                                                class="w-100 form-control" name="date" id="date" oninput="filterUserData()">
                                            <span class="pl-2" id="reset"> <i class="bi bi-arrow-repeat"></i>
                                            </span>
                                        </div>

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
                        <table id="recordTable" class="table">
                            <thead class="bg-light w-100">
                                <tr style="border-bottom: 3px solid white;border-top: 3px solid white; white-space:nowrap">
                                    <th class="ant-table-cell hideID">id</th>
                                    <th class="ant-table-cell">Sr</th>
                                    <th class="ant-table-cell">Recruiter</th>
                                    <th class="ant-table-cell">Candidate</th>
                                    <th class="ant-table-cell">Profile</th>
                                    <th class="ant-table-cell">S segment</th>
                                    <th class="ant-table-cell">CSalary</th>
                                    <th class="ant-table-cell">E.Salary</th>
                                    <th class="ant-table-cell">App.Status</th>
                                    <th class="ant-table-cell">Client</th>
                                    <th class="ant-table-cell">CL</th>
                                    <th class="ant-table-cell">Endorsement Date</th>
                                    <th class="ant-table-cell ant-table-cell-scrollbar"></th>
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
                <input type="hidden" name="candidate">
            </div>
            <div class="col-lg-7" id="record_detail">
                <p class="C-Heading pt-3">Record Details:</p>
                <div class="card mb-13">
                    <div class="card-body">
                        <form action="">
                            <fieldset disabled="">
                                <div class="row mb-1">
                                    <div class="col-lg-6">
                                        <div class="form-group mb-0">
                                            <label class="Label">
                                                Candidate Name:*
                                            </label>
                                            <input type="text" class="form-control" placeholder="Enter Name" />
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group mb-0">
                                            <label class="Label">Gender:</label>
                                            <select class="w-100 form-control">
                                                <option value="1" selected disabled="disabled">Select Gender</option>
                                                <option value="2">Male</option>
                                                <option value="3">Female</option>
                                                <option value="4">Transgender</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group mb-0">
                                            <label class="Label">DOB:</label>
                                            <input type="text" class="form-control users-input-S-C" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-1">
                                    <div class="col-lg-6">
                                        <div class="form-group mb-0">
                                            <label class="Label">Email:</label>
                                            <input type="text" class="form-control users-input-S-C"
                                                placeholder="Enter Email" />
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group mb-0">
                                            <label class="d-block font-size-3 mb-0">
                                                Contact:
                                            </label>
                                            <input type="text" class="form-control users-input-S-C"
                                                placeholder="Enter Phone Number" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-1">
                                    <div class="col-lg-6">
                                        <div class="form-group mb-0">
                                            <label class="d-block font-size-3 mb-0">
                                                Residence
                                            </label>
                                            <input type="text" class="form-control users-input-S-C" />
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group mb-0">
                                            <label class="d-block font-size-3 mb-0">
                                                Date Sifted:
                                            </label>
                                            <input type="text" class="form-control users-input-S-C" />
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group mb-0">
                                            <label class="d-block font-size-3 mb-0">
                                                Source
                                            </label>
                                            <input type="text" class="form-control users-input-S-C" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-1">
                                    <div class="col-lg-6">
                                        <div class="form-group mb-0">
                                            <label class="Label">Educational Attachment</label>
                                            <input type="text" class="form-control users-input-S-C" />
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group mb-0">
                                            <label class="Label">Date Invited:</label>
                                            <input type="text" class="form-control users-input-S-C" />
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group mb-0">
                                            <label class="Label">
                                                Manner of Invite:
                                            </label>
                                            <input type="text" class="form-control users-input-S-C" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-1">
                                    <div class="col-lg-6">
                                        <div class="form-group mb-0">
                                            <label class="Label">Course:</label>
                                            <input type="text" class="form-control users-input-S-C" />
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group mb-0">
                                            <label class="Label">
                                                Current Salary:
                                            </label>
                                            <input type="text" class="form-control users-input-S-C" />
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group mb-0">
                                            <label class="Label">
                                                Current Allowance:
                                            </label>
                                            <input type="text" class="form-control users-input-S-C" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-1">
                                    <div class="col-lg-6">
                                        <div class="form-group mb-0">
                                            <label class="Label">Domain:</label>
                                            <input type="text" class="form-control users-input-S-C" />
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group mb-0">
                                            <label class="Label">
                                                Expected Salary:
                                            </label>
                                            <input type="text" class="form-control users-input-S-C" />
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group mb-0">
                                            <label class="Label">
                                                Offered Salary:
                                            </label>
                                            <input type="text" class="form-control users-input-S-C" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-1">
                                    <div class="col-lg-6">
                                        <div class="form-group mb-0">
                                            <label class="Label">Segment:</label>
                                            <input type="text" class="form-control users-input-S-C" />
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group mb-0">
                                            <label class="Label">
                                                Sub Segment:
                                            </label>
                                            <input type="text" class="form-control users-input-S-C" />
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group mb-0">
                                            <label class="Label">
                                                Offered Allowance:
                                            </label>
                                            <input type="text" class="form-control users-input-S-C" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-1">
                                    <div class="col-lg-6">
                                        <div class="form-group mb-0">
                                            <label class="Label">Profile:</label>
                                            <input type="text" class="form-control users-input-S-C" />
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group mb-0">
                                            <label class="Label">
                                                Date Processed:
                                            </label>
                                            <input type="text" class="form-control users-input-S-C" />
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group mb-0">
                                            <label class="Label">
                                                Application Status:
                                            </label>
                                            <input type="text" class="form-control users-input-S-C" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-1">
                                    <div class="col-lg-6">
                                        <div class="form-group mb-0">
                                            <label class="Label">Position Applied:</label>
                                            <input type="text" class="form-control users-input-S-C" />
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group mb-0">
                                            <label class="Label">
                                                Sifted By:
                                            </label>
                                            <input type="text" class="form-control users-input-S-C" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-1">
                                    <div class="col-lg-6">
                                        <div class="form-group mb-0">
                                            <label class="d-block font-size-3 mb-0">
                                                Interview Notes:
                                            </label>
                                            <textarea name="EMPLOYMENT_HISTORY" rows="3" type="text"
                                                class="form-control border E_H h-px-20_custom"
                                                placeholder="Enter Interview Notes"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group mb-0">
                                            <label class="d-block font-size-3 mb-0">
                                                Employment History:
                                            </label>
                                            <textarea name="EMPLOYMENT_HISTORY" rows="3" type="text"
                                                class="form-control E_HI" style="height: 225px"
                                                placeholder="Enter  Employment History"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-1">
                                    <div class="col-lg-6 mb-5">
                                        <div class="form-group mb-0">
                                            <label class="d-block font-size-3 mb-0">
                                                Recruitment Process:
                                            </label>
                                            <textarea name="EMPLOYMENT_HISTORY" rows="3" type="text"
                                                class="form-control border E_H h-px-20_custom"
                                                placeholder="Enter Recruitment Process"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 E_NEG">
                                        <p class="C-Heading pt-3">Endorsement Details:</p>
                                        <div class="card mb-13">
                                            <div class="card-body">
                                                <form action="">
                                                    <div class="row mb-1">
                                                        <div class="col-lg-6">
                                                            <div class="form-group mb-0">
                                                                <label class="Label-00">
                                                                    Endorsement Type:
                                                                </label>
                                                                <input type="text" name="REF_CODE"
                                                                    placeholder="Select Option" required=""
                                                                    class="form-control h-px-20_custom border" value="" />
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group mb-0">
                                                                <label class="Label-00">
                                                                    Career Level:
                                                                </label>
                                                                <input type="text" name="REF_CODE" value="" disabled=""
                                                                    required=""
                                                                    class="form-control h-px-20_custom border" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-1">
                                                        <div class="col-lg-6">
                                                            <div class="form-group mb-0">
                                                                <label class="Label-00">Site</label>
                                                                <select name="" id="" class="w-100 form-control">
                                                                    <option value="1">Select Option</option>
                                                                    <option value="2">Two</option>
                                                                    <option value="3">Three</option>
                                                                    <option value="4">Four</option>
                                                                    <option value="5">Five</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group mb-0">
                                                                <label class="Label-00">
                                                                    Remarks (for Finance)
                                                                </label>
                                                                <select name="" id="" class="w-100 form-control">
                                                                    <option value="1">Select Option</option>
                                                                    <option value="2">Two</option>
                                                                    <option value="3">Three</option>
                                                                    <option value="4">Four</option>
                                                                    <option value="5">Five</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-1">
                                                        <div class="col-lg-6">
                                                            <div class="form-group mb-0">
                                                                <label class="Label-00">
                                                                    Client
                                                                </label>
                                                                <select name="" id="" class="w-100 form-control">
                                                                    <option value="1">Select Option</option>
                                                                    <option value="2">Two</option>
                                                                    <option value="3">Three</option>
                                                                    <option value="4">Four</option>
                                                                    <option value="5">Five</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group mb-0">
                                                                <label class="Label-00">
                                                                    Status:
                                                                </label>
                                                                <select name="" id="" class="w-100 form-control">
                                                                    <option value="1">Select Option</option>
                                                                    <option value="2">Two</option>
                                                                    <option value="3">Three</option>
                                                                    <option value="4">Four</option>
                                                                    <option value="5">Five</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-1">
                                                        <div class="col-lg-6">
                                                            <div class="form-group mb-0">
                                                                <label class="Label-00">
                                                                    Position Title:
                                                                </label>
                                                                <select name="" id="" class="w-100 form-control">
                                                                    <option value="1">Select Option</option>
                                                                    <option value="2">Two</option>
                                                                    <option value="3">Three</option>
                                                                    <option value="4">Four</option>
                                                                    <option value="5">Five</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group mb-0">
                                                                <label class="Label-00">
                                                                    Reason for not progressing:
                                                                </label>
                                                                <select name="" id="" class="w-100 form-control">
                                                                    <option value="1">Select Option</option>
                                                                    <option value="2">Two</option>
                                                                    <option value="3">Three</option>
                                                                    <option value="4">Four</option>
                                                                    <option value="5">Five</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-1">
                                                        <div class="col-lg-6">
                                                            <div class="form-group mb-0">
                                                                <label class="Label-00">
                                                                    Domain:
                                                                </label>
                                                                <select name="" id="" class="w-100 form-control">
                                                                    <option value="1">Select Option</option>
                                                                    <option value="2">Two</option>
                                                                    <option value="3">Three</option>
                                                                    <option value="4">Four</option>
                                                                    <option value="5">Five</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group mb-0">
                                                                <label class="Label">Interview Schedule:</label>
                                                                <select name="" id="" class="w-100 form-control">
                                                                    <option value="1">Select Option</option>
                                                                    <option value="2">Two</option>
                                                                    <option value="3">Three</option>
                                                                    <option value="4">Four</option>
                                                                    <option value="5">Five</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-1">
                                                        <div class="col-lg-6">
                                                            <div class="form-group mb-0">
                                                                <label class="Label-00">
                                                                    Segment:
                                                                </label>
                                                                <select name="" id="" class="w-100 form-control">
                                                                    <option value="1">Select Option</option>
                                                                    <option value="2">Two</option>
                                                                    <option value="3">Three</option>
                                                                    <option value="4">Four</option>
                                                                    <option value="5">Five</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group mb-0">
                                                                <label class="Label">Remarks (From
                                                                    Recruiter):</label>
                                                                <select name="" id="" class="w-100 form-control">
                                                                    <option value="1">Select Option</option>
                                                                    <option value="2">Two</option>
                                                                    <option value="3">Three</option>
                                                                    <option value="4">Four</option>
                                                                    <option value="5">Five</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-1">
                                                        <div class="col-lg-6">
                                                            <div class="form-group mb-0">
                                                                <label class="Label-00">
                                                                    Sub-Segment:
                                                                </label>
                                                                <select name="" id="" class="w-100 form-control">
                                                                    <option value="1">Select Option</option>
                                                                    <option value="2">Two</option>
                                                                    <option value="3">Three</option>
                                                                    <option value="4">Four</option>
                                                                    <option value="5">Five</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group mb-0">
                                                                <label class="Label">Endo Date:</label>
                                                                <select name="" id="" class="w-100 form-control">
                                                                    <option value="1">Select Option</option>
                                                                    <option value="2">Two</option>
                                                                    <option value="3">Three</option>
                                                                    <option value="4">Four</option>
                                                                    <option value="5">Five</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-1">
                                                        <div class="col-lg-6">
                                                            <div class="form-group mb-0">
                                                                <label class="Label-00">
                                                                    Date Updated:
                                                                </label>
                                                                <select name="" id="" class="w-100 form-control">
                                                                    <option value="1">Select Option</option>
                                                                    <option value="2">Two</option>
                                                                    <option value="3">Three</option>
                                                                    <option value="4">Four</option>
                                                                    <option value="5">Five</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
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
    <div style="height: 30px;"></div>

@endsection



@section('script')
    <script>
        
        // Section for docement ready funciton starts
        $(document).ready(function() {
            select2Dropdown("select2_dropdown");
            // $('#candidate').empty();
            // show and hide loader after time set starts
            $('#loader').show();
            setTimeout(function() {
                $('#loader').hide();
            }, 1000);
            load_datatable()
            // show and hide loader after time set ends
            $('#recordTable_filter').hide('div');

        });

        // show detail of record on click in data table 
        $('#recordTable').on('click', 'tbody tr', function() {
            // $(this).css('background-color','red')
            $('tr').removeClass('hover-primary1');
            $(this).addClass('hover-primary1');
            let tdVal = $(this).children()[0];
            var id = tdVal.innerHTML
            UserDetail(this, id)
        })
        // close 


        // load main table data on page load using ajax(Yajra datatable) 
        function load_datatable() {
            var option_table = $('#recordTable').DataTable({
                destroy: true,
                processing: true,
                serverSide: false,
                "language": {
                    processing: '<div class="spinner-border mr-3" role="status"> </div><span>Processing ...</span>'
                },

                ajax: {
                    url: "{{ route('view-record-table') }}",
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
                        data: 'recruiter',
                        name: 'recruiter'
                    },
                    {
                        data: 'last_name',
                        name: 'last_name',
                        // searchable: false,
                        // orderable: false
                    },
                    {
                        data: 'profile',
                        name: 'profile'
                    },
                    {
                        data: 'subSegment',
                        name: 'subSegment'
                    },
                    {
                        data: 'cSalary',
                        name: 'cSalary'
                    },
                    {
                        data: 'eSalary',
                        name: 'eSalary'
                    },
                    {
                        data: 'appStatus',
                        name: 'appStatus'
                    },
                    {
                        data: 'client',
                        name: 'client'
                    },
                    {
                        data: 'career_level',
                        name: 'career_level'
                    },
                    {
                        data: 'endi_date',
                        name: 'endi_date'
                    },
                ]
            });

        }
        // close 

        // load filtered record data table (Yajra DataTable) 
        function load_datatable1() {
            searchKeyword = $('#searchKeyword').val();
            search = $('#search').val();
            user_id = $('#recruiter').val();
            candidate = $('#candidate').val();
            profile = $('#profile').val();
            sub_segment = $('#sub_segment').val();
            app_status = $('#app_status').val();
            career_level = $('#career_level').val();
            client = $('#client').val();
            date = $('#date').val();
            var option_table = $('#filteredTable').DataTable({
                destroy: true,
                processing: true,
                serverSide: false,
                "language": {
                    processing: '<div class="spinner-border mr-3" role="status"> </div><span>Processing ...</span>'
                },

                ajax: {
                    url: "{{ route('view-record-filter-table') }}",
                    type: "GET",
                    data: {
                        _token: token,
                        // searchKeyword: searchKeyword,
                        user_id: user_id,
                        candidate: candidate,
                        profile: profile,
                        sub_segment: sub_segment,
                        app_status: app_status,
                        career_level: career_level,
                        client: client,
                        date: date,
                        search: search,
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
                        data: 'recruiter',
                        name: 'recruiter'
                    },
                    {
                        data: 'last_name',
                        name: 'last_name',
                        // searchable: false,
                        // orderable: false
                    },
                    {
                        data: 'profile',
                        name: 'profile'
                    },
                    {
                        data: 'subSegment',
                        name: 'subSegment'
                    },
                    {
                        data: 'cSalary',
                        name: 'cSalary'
                    },
                    {
                        data: 'eSalary',
                        name: 'eSalary'
                    },
                    {
                        data: 'appStatus',
                        name: 'appStatus'
                    },
                    {
                        data: 'client',
                        name: 'client'
                    },
                    {
                        data: 'career_level',
                        name: 'career_level'
                    },
                    {
                        data: 'endi_date',
                        name: 'endi_date'
                    },
                ]


            });
        }

        // count total number of records coming from data table with interval starts
        setInterval(function() {
            let tableID = $('#filter_table_div').children().children().attr('id')
            if (tableID == 'filteredTable_wrapper') {
                countRecordFilter()
            }
            if (tableID == 'recordTable_wrapper') {
                countRecord()
            }
        }, 2000);

        // count record on page load 
        function countRecord() {
            var count = $('#recordTable_info').text().split(' ');
            $('#recordNumber').val(count[5])
        }
        // close 

        // count record of filtered data
        function countRecordFilter() {
            var count = $('#filteredTable_info').text().split(' ');
            $('#recordNumber').val(count[5])
        }
        // close 

        // funciton for filtering the data according to selected input starts
        function filterUserData() {
            $("#loader").show();
            // get values of selected inputs of users
            $('#searchKeyword').val('');
            search = $('#search').val();
            user_id = $('#recruiter').val();
            candidate = $('#candidate').val();
            profile = $('#profile').val();
            sub_segment = $('#sub_segment').val();
            app_status = $('#app_status').val();
            career_level = $('#career_level').val();
            client = $('#client').val();
            date = $('#date').val();

            // call Ajax for returning the data as view
            $.ajax({
                type: "GET",
                url: '{{ url('admin/filter_records') }}',
                data: {
                    _token: token,
                    // searchKeyword: searchKeyword,
                    user_id: user_id,
                    candidate: candidate,
                    profile: profile,
                    sub_segment: sub_segment,
                    app_status: app_status,
                    career_level: career_level,
                    client: client,
                    date: date,
                    search: search,
                },

                // Success fucniton of Ajax
                success: function(data) {
                    $('#filter_table_div').html(data);
                    // $('#count').val(data.count);
                    // appennd count value coming from hidden input of appended view to count
                    recordCount = $('#abc').val()
                    $('#recordNumber').val(recordCount)
                    $("#loader").hide();
                },
            });
        }
        // close 

        // function for selected candidate of table to show detail data on right starts
        function UserDetail(elem, id) {
            $('.common-tr').removeClass('hover-primary1');
            $(elem).addClass('hover-primary1');

            // $(e).children().removeClass('fade');
            // show loader for waiting
            $("#loader").show();

            // call Ajax whihc will return view of detail data of user
            $.ajax({
                type: "GET",
                url: '{{ url('admin/filter_records_detail') }}',
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
        //close 

        // function for selected candidate of table to show detail data on right starts

        // On recruiter change append the candidates of selected recruiter
        // $('#recruiter').change(function() {
        //     $('#candidate').empty();
        //     var candidate = {!! $candidates !!};
        //     var count = 0;

        //     // append data for each recruiter to candidate field
        //     $.each($(this).val(), function(i, v) {
        //         for (let i = 0; i < candidate.length; i++) {
        //             if (v == candidate[i].saved_by) {
        //                 count++;
        //                 // append resulting options to select field 
        //                 $('#candidate').append('<option value="' + candidate[i].id + '">' + candidate[i]
        //                     .first_name +
        //                     '</option>');
        //             }
        //         }
        //     })
        // });
        // on candidate change append the dependent dropdowns 
        // $('#candidate').change(function() {
        //     $('#profile').empty();
        //     $('#sub_segment').empty();
        //     $('#date').empty();
        //     $('#client').empty();
        //     $('#career_level').empty();
        //     $('#app_status').empty();
        //     var profile = {!! $candidateprofile !!};
        //     console.log(profile)
        //     var segment = {!! $candidateDomain !!};
        //     var status = {!! $endorsement !!};
        //     var client = {!! $endorsement !!};
        //     var career = {!! $endorsement !!};
        //     var count = 0;
        //     $.each($(this).val(), function(i, v) {
        //         for (let i = 0; i < profile.length; i++) {
        //             console.log(v)
        //             if (v == profile[i].candidate_id) {
        //                 count++;
        //                 if (profile[i].candidate_profile != "") {

        //                     $('#profile').append('<option  selected  value="' + profile[i]
        //                         .candidate_profile +
        //                         '">' +
        //                         profile[i].candidate_profile +
        //                         '</option>');
        //                 }
        //                 console.log(segment[i], i);
        //                 if (segment[i].sub_segment != '') {
        //                     if (v == segment[i].candidate_id) {
        //                         $('#sub_segment').append('<option selected  value="' + segment[i]
        //                             .sub_segment +
        //                             '">' +
        //                             segment[i].sub_segment +
        //                             '</option>');
        //                     }
        //                 }
        //             }
        //             if (v == status[i].candidate_id) {
        //                 count++;
        //                 if (status[i].app_status != null) {
        //                     $('#app_status').append('<option selected  value="' + status[i].app_status +
        //                         '">' +
        //                         status[i]
        //                         .app_status +
        //                         '</option>');
        //                 }
        //                 if (client[i].client != null) {
        //                     $('#client').append('<option  selected value="' + client[i].client + '">' +
        //                         client[
        //                             i]
        //                         .client +
        //                         '</option>');
        //                 }
        //                 if (career[i].career_endo != null) {
        //                     $('#career_level').append('<option selected  value="' + career[i].career_endo +
        //                         '">' + status[
        //                             i]
        //                         .career_endo +
        //                         '</option>');
        //                 }
        //             }
        //         }
        //     })
        // });
        // close 

        // reset date on click and call ajax for filter
        $("#reset").click(function() {
            $('#date').val("")
            filterUserData();
        })
        // close 


        // update the selected records if it belongs to the user starts
        function UpdateRecord(id) {
            // show loader for waiting
            $("#loader").show();
            // making a variable containg all for data and append token
            var data = new FormData(document.getElementById('user_detail_form'));
            data.append("_token", "{{ csrf_token() }}");
            data.append("id", id);

            // call Ajax whihc will return view of detail data of user
            $.ajax({
                type: "POST",
                url: '{{ url('admin/update_records_detail') }}',
                data: data,
                contentType: false,
                processData: false,
                _token: token,
                id: id,


                // Ajax Success funciton
                success: function(res) {
                    if (res.success == true) {

                        // show success sweet alert and enable entering new record button
                        // $('#new').prop("disabled", false);
                        swal("success", res.message, "success").then((value) => {});
                    } else if (res.success == false) {

                        // show validation error on scree with border color changed and text
                        if (res.hasOwnProperty("message")) {
                            var err = "";
                            $("input").parent().siblings('span').remove();
                            $("select").siblings('div').children().remove();
                            $("textarea").next('div').children().remove();
                            $("input").css('border-color', '#ced4da');
                            $("select").css('border-color', '#ced4da');
                            $("textarea").css('border-color', '#ced4da');

                            //function for appending span and changing css color for input
                            $.each(res.message, function(i, e) {
                                $("input[name='" + i + "']").prop('required', true)
                                $("input[name='" + i + "']").parent().siblings(
                                    'span').remove();
                                $("input[name='" + i + "']").parent().parent()
                                    .append(
                                        '<span style="color:red;" >' + 'Required' + '</span>'
                                    );
                                console.log($("select[name='" + i + "']"));
                                $("select[name='" + i + "']").prop('required', true)
                                $("select[name='" + i + "']").siblings(
                                    'div').children().remove();
                                $("select[name='" + i + "']").siblings('div')
                                    .append(
                                        '<span style="color:red;" >' + 'Required' + '</span>'
                                    );
                                $("textarea[name='" + i + "']").prop('required', true)
                                $("textarea[name='" + i + "']").next('div').children().remove();
                                $("textarea[name='" + i + "']").next('div').append(
                                    '<span style="color:red;" >' + 'Required' + '</span>'
                                );
                            });

                            // // show warning message to user if firld is required
                            // swal({
                            //     icon: "error",
                            //     text: "{{ __('Please fill all required fields!') }}",
                            //     icon: "error",
                            // });
                        }
                    } else if (res.success == 'duplicate') {
                        $("#loader").hide();

                        //show warning message to change the data
                        swal({
                            icon: "error",
                            text: "{{ __('Duplicate data detected') }}",
                            icon: "error",
                        });
                    }

                    //hide loader
                    $("#loader").hide();

                },
                //if there is error in ajax call
                error: function() {
                    $("#loader").hide();
                }
            });
        }
        // close 

        // make custom search data table search starts
        $('#searchKeyword').on("input", function() {
            $('#recordTable_filter').children().children().val($('#searchKeyword').val());
            $('#filteredTable_filter').children().children().val($('#searchKeyword').val());
            $('#recordTable_filter').children().children().focus();
            $('#filteredTable_filter').children().children().focus();
            $('#searchKeyword').focus();
            $('#recordTable_filter').children().children().trigger('input');
            $('#filteredTable_filter').children().children().trigger('input');
            $('#recordTable_filter').hide('div');
            $('#filteredTable_filter').hide('div');
        });
        // close 

        // function for (if domain is changed append segments acoordingly) starts
        // function DomainChange(elem) {
        //     $('#segment').empty()
        //     $('#Domainsegment').empty()
        //     var segmentsDropDown = {!! $segmentsDropDown !!};
        //     var count = 0;
        //     for (let i = 0; i < segmentsDropDown.length; i++) {
        //         if ($(elem).val() == segmentsDropDown[i].domain_id) {
        //             count++;
        //             $('#segment').append('<option value="' + segmentsDropDown[i].id + '">' + segmentsDropDown[i]
        //                 .segment_name +
        //                 '</option>');
        //             $('#Domainsegment').append('<option value="' + segmentsDropDown[i].id + '">' + segmentsDropDown[i]
        //                 .segment_name +
        //                 '</option>');
        //         }

        //     }
        //     SegmentChange("segment");

        // }
        // close 

        // function for (if segment is changed append subsegments acoordingly) starts
        // function SegmentChange(elem) {
        //     $('#Domain_sub_segment').empty()
        //     $('#endo_sub_segment').empty()
        //     var sub_segmentsDropDown = {!! $sub_segmentsDropDown !!};
        //     var count = 0;
        //     for (let i = 0; i < sub_segmentsDropDown.length; i++) {
        //         console.log(sub_segmentsDropDown)
        //         if ($('#segment').val() == sub_segmentsDropDown[i].segment_id) {
        //             count++;
        //             $('#Domain_sub_segment').append('<option value="' + sub_segmentsDropDown[i].sub_segment_name + '">' +
        //                 sub_segmentsDropDown[i]
        //                 .sub_segment_name +
        //                 '</option>');
        //             $('#endo_sub_segment').append('<option value="' + sub_segmentsDropDown[i].sub_segment_name + '">' +
        //                 sub_segmentsDropDown[i]
        //                 .sub_segment_name +
        //                 '</option>');
        //         }
        //     }
        // }
        // close 
    </script>

@endsection
