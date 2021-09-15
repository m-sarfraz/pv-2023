@extends('layouts.app')

@section('style')

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
                                        <input type="text" name="REF_CODE" placeholder="search keyword" required=""
                                            class="form-control h-px-20_custom border" value="" />
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group mb-0">
                                        <label class="d-block font-size-3 mb-0">
                                            # of Records Found:
                                        </label>
                                        <input type="text" name="REF_CODE" readonly required=""
                                            class="form-control h-px-20_custom border" />
                                    </div>
                                </div>
                            </div>
                            <p class="mb-0 ml-3">Filter by:</p>
                            <div class="row mb-1">
                                <div class="col-lg-6">
                                    <div class="form-group mb-0">
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
                                    <div class="form-group mb-0">
                                        <label class="d-block font-size-3 mb-0">
                                            Canidate
                                        </label>
                                        <select multiple name="candidate" id="candidate" class="select2_dropdown  w-100"
                                            onchange="filterUserData()">
                                            @foreach ($candidates as $key => $candidate)
                                                <option value="{{ $candidate->id }}">{{ $candidate->first_name }}
                                                    {{ $candidate->last_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-1">
                                <div class="col-lg-6">
                                    <div class="form-group mb-0">
                                        <?php
                                        $profile = Helper::get_dropdown('candidates_profile');
                                        ?>
                                        <label class="d-block font-size-3 mb-0">
                                            Profile
                                        </label>
                                        <select multiple name="profile" id="profile" class="select2_dropdown  w-100"
                                            onchange="filterUserData()">
                                            @foreach ($profile->options as $profileOption)
                                                <option value="{{ $profileOption->id }}">
                                                    {{ $profileOption->option_name }}
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
                                            onchange="filterUserData()">
                                            @foreach ($sub_segment->options as $sub_segmentOption)
                                                <option value="{{ $sub_segmentOption->id }}">
                                                    {{ $sub_segmentOption->option_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-1">
                                <div class="col-lg-6">
                                    <div class="form-group mb-0">
                                        <?php
                                        $status = Helper::get_dropdown('application_status');
                                        ?>
                                        <label class="d-block font-size-3 mb-0">
                                            Application Status:
                                        </label>
                                        <select multiple name="app_status" id="app_status" class="select2_dropdown  w-100">
                                            @foreach ($status->options as $statusOptions)
                                                <option value="{{ $statusOptions->id }}" onchange="filterUserData()">
                                                    {{ $statusOptions->option_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group mb-0">
                                        @php
                                            $client = Helper::get_dropdown('clients');
                                        @endphp
                                        <label class="d-block font-size-3 mb-0">
                                            Client:
                                        </label>
                                        <select multiple name="client" id="client" class="select2_dropdown  w-100">
                                            @foreach ($client->options as $clientOptions)
                                                <option value="{{ $clientOptions->id }}" onchange="filterUserData()">
                                                    {{ $clientOptions->option_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-1">
                                <div class="col-lg-6">
                                    <div class="form-group mb-0">
                                        @php
                                            $CareerLevel = Helper::get_dropdown('career_level');
                                        @endphp
                                        <label class="d-block font-size-3 mb-0">
                                            Career 1 level:
                                        </label>
                                        <select multiple name="cl" id="cl" class="select2_dropdown  w-100">
                                            @foreach ($CareerLevel->options as $CareerLevelOptions)
                                                <option value="{{ $CareerLevelOptions->id }}"
                                                    onchange="filterUserData()">
                                                    {{ $CareerLevelOptions->option_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group mb-0">
                                        <label class="Label">Endo Date:</label>
                                        <input type="date" class="w-100" name="date" id="date"
                                            oninput="filterUserData()">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- ================= -->
                <!-- Datatable code start-->
                <div class="table-responsive border-right pt-3" id="filter_table_div">

                </div>
                <!-- Datatable code end-->
                <!-- ================= -->
                <input type="hidden" name="candidate">
            </div>
            <div class="col-lg-7" id="record_detail">
                <p class="C-Heading pt-3">Requirement Details:</p>
                <div class="card mb-13">
                    <div class="card-body">
                        <form action="">
                            <fieldset disabled="">
                                <div class="row mb-1">
                                    <div class="col-lg-6">
                                        <div class="form-group mb-0">
                                            <label class="Label">
                                                * Canidate Name:
                                            </label>
                                            <input type="text" class="form-control" placeholder="enter first name" />
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group mb-0">
                                            <label class="Label">Gender:</label>
                                            <select class="w-100">
                                                <option value="1" disabled="disabled">Select Gender</option>
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
                                                placeholder="enter email" />
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group mb-0">
                                            <label class="d-block font-size-3 mb-0">
                                                Contact:
                                            </label>
                                            <input type="text" class="form-control users-input-S-C"
                                                placeholder="enter you cell" />
                                        </div>
                                    </div>
                                    <!-- <div class="col-lg-4">
                                                                                                                                                                            <div class="form-group mb-0">
                                                                                                                                                                                <label class="d-block font-size-3 mb-0">
                                                                                                                                                                                    Segment
                                                                                                                                                                                </label>
                                                                                                                                                                                <input type="text" class="form-control users-input-S-C" />
                                                                                                                                                                            </div>
                                                                                                                                                                        </div> -->
                                </div>
                                <div class="row mb-1">
                                    <div class="col-lg-6">
                                        <div class="form-group mb-0">
                                            <label class="d-block font-size-3 mb-0">
                                                Residendce
                                            </label>
                                            <input type="text" class="form-control users-input-S-C" />
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group mb-0">
                                            <label class="d-block font-size-3 mb-0">
                                                Shifted Date:
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
                                                Shifted By:
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
                                    <div class="col-lg-3">
                                        <div class="form-group mb-0">
                                            <label class="d-block font-size-3 mb-0">
                                                Certification:
                                            </label>
                                            <textarea name="EMPLOYMENT_HISTORY" rows="3" type="text"
                                                class="form-control E_HI" style="height: 225px"
                                                placeholder="Enter Interview Notes"></textarea>
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
                                                placeholder="Enter Interview Notes"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 E_NEG">
                                        <p class="C-Heading pt-3">Endorsement Details:</p>
                                        <div class="card mb-13">
                                            <div class="card-body">
                                                <form action="">
                                                    <div class="row mb-4">
                                                        <div class="col-lg-6">
                                                            <div class="form-group mb-0">
                                                                <label class="Label-00">
                                                                    Endrsment Type:
                                                                </label>
                                                                <input type="text" name="REF_CODE"
                                                                    placeholder="search keyword" required=""
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
                                                                <select name="" id="" class="w-100">
                                                                    <option value="1">One</option>
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
                                                                <select name="" id="" class="w-100">
                                                                    <option value="1">One</option>
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
                                                                <select name="" id="" class="w-100">
                                                                    <option value="1">One</option>
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
                                                                <select name="" id="" class="w-100">
                                                                    <option value="1">One</option>
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
                                                                <select name="" id="" class="w-100">
                                                                    <option value="1">One</option>
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
                                                                <select name="" id="" class="w-100">
                                                                    <option value="1">One</option>
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
                                                                <select name="" id="" class="w-100">
                                                                    <option value="1">One</option>
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
                                                                <select name="" id="" class="w-100">
                                                                    <option value="1">One</option>
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
                                                                <select name="" id="" class="w-100">
                                                                    <option value="1">One</option>
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
                                                                <select name="" id="" class="w-100">
                                                                    <option value="1">One</option>
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
                                                                    sub-segment:
                                                                </label>
                                                                <select name="" id="" class="w-100">
                                                                    <option value="1">One</option>
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
                                                                <select name="" id="" class="w-100">
                                                                    <option value="1">One</option>
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
                                                                    Date Undated:
                                                                </label>
                                                                <select name="" id="" class="w-100">
                                                                    <option value="1">One</option>
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
        $(document).ready(function() {
            select2Dropdown("select2_dropdown");
            $('#candidate').empty();

        });

        $(function() {
            $("#record").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
            });
        });

        function filterUserData() {
            $("#loader").show();
            user_id = $('#recruiter').val();
            candidate = $('#candidate').val();
            profile = $('#profile').val();
            sub_segmet = $('#sub_segmet').val();
            app_status = $('#app_status').val();
            cl = $('#cl').val();
            date = $('#date').val();

            $.ajax({
                type: "GET",
                url: '{{ url('admin/filter_records') }}',
                data: {
                    _token: token,
                    user_id: user_id,
                    candidate: candidate,
                    profile: profile,
                    sub_segmet: sub_segmet,
                    app_status: app_status,
                    cl: cl,
                    date: date,
                },
                success: function(data) {
                    $('#filter_table_div').html(data);
                    // $('#count').val(data.count);
                    $("#loader").hide();

                },
            });
        }

        function UserDetail() {
            user_id = $('#recruiter').val();
            candidate = $('#candidate').val();
            profile = $('#profile').val();
            sub_segmet = $('#sub_segmet').val();
            app_status = $('#app_status').val();
            cl = $('#cl').val();
            date = $('#date').val();
            $("#loader").show();

            $.ajax({
                type: "GET",
                url: '{{ url('admin/filter_records_detail') }}',
                data: {
                    _token: token,
                    user_id: user_id,
                    candidate: candidate,
                    profile: profile,
                    sub_segmet: sub_segmet,
                    app_status: app_status,
                    cl: cl,
                    date: date,
                },
                success: function(data) {
                    $('#record_detail').html('');
                    $('#record_detail').html(data);
                    // $('#count').val(data.count);
                    $("#loader").hide();

                },
            });
        }
        $('#recruiter').change(function(){
            $('#candidate').empty();
            console.log($(this).val())
            var candidate = {!! $candidates !!};
            var count = 0;
            for (let i = 0; i < candidate.length; i++) {
                if ($(this).val() == candidate[i].saved_by) {
                    count++;
                    $('#candidate').append('<option value="' + candidate[i].id + '">' + candidate[i].first_name +
                        '</option>');
                }
            }
        });
    </script>

@endsection
