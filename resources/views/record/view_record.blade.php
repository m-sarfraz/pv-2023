@extends('layouts.app')

@section('style')

    <style>
        /* .row {
                                                                    margin: 0px !important;
                                                                } */

        #example1_filter label {
            display: flex;
            width: fit-content;
            margin-left: auto;
            align: items-center;
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
                                            placeholder="search keyword" required="" id="search" oninput="filterUserData()"
                                            class="form-control h-px-20_custom border" value="" />
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group mb-0">
                                        <label class="d-block font-size-3 mb-0">
                                            Number Of Records Found:
                                        </label>
                                        <input type="text" name="REF_CODE" readonly required="" id="recordNumber"
                                            class="form-control h-px-20_custom border" value="{{ $AllData }}" />
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
                                        $sub_segment = Helper::get_dropdown('sub_segment');
                                        ?>
                                        <label class="d-block font-size-3 mb-0">
                                            Sub Segment
                                        </label>
                                        <select multiple name="sub_segment" id="sub_segment" class="select2_dropdown  w-100"
                                            onchange="filterUserData()">
                                            @foreach ($sub_segment->options as $sub_segmentOption)
                                                <option value="{{ $sub_segmentOption->option_name }}">
                                                    {{ $sub_segmentOption->option_name }}
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
                        <table id=" record" class="table">
                            <thead class="bg-light w-100">
                                <tr style="border-bottom: 3px solid white;border-top: 3px solid white; white-space:nowrap">
                                    <th class="ant-table-cell">Sr#</th>
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
                            <tbody>
                                @forelse ( $Userdata as $key=>$value )
                                    @if ($value->saved_by == Auth::user()->id)
                                        <tr class="bg-transparent common-tr hover-primary"
                                            onclick="UserDetail(this, '{{ $value->cid }}')">
                                            <!-- Table data 1 -->
                                            <td>{{ $key + 1 }}</td>
                                            {{-- @php
                                        $name = \App\User::with('candidate_information')
                                            ->where('id', $value->saved_by)
                                            ->first();
                                    @endphp --}}
                                            <td>
                                                @if (isset($value->recruiter))
                                                    {{ $value->recruiter }}
                                                @endif
                                            </td>
                                            <td>
                                                @if (isset($value->first_name))
                                                    {{ $value->first_name }}

                                                @endif
                                            </td>
                                            <td>{{ $value->candidate_profile }}
                                            </td>
                                            <td>{{ $value->sub_segment }}</td>
                                            <td>
                                                @if (isset($value->curr_salary))
                                                    {{ $value->curr_salary }}

                                                @endif
                                            </td>
                                            <td>
                                                @if (isset($value->exp_salary))
                                                    {{ $value->exp_salary }}

                                                @endif
                                            </td>
                                            <td>{{ $value->app_status }}</td>
                                            <td>{{ $value->client }}</td>
                                            <td>{{ $value->career_endo }}</td>
                                            <td>
                                                @if (isset($value->endi_date))
                                                    {{ $value->endi_date }}

                                                @endif
                                            </td>
                                            <td></td>
                                        </tr>
                                    @else
                                        <tr class="hover-primary common-tr" style="background-color: #e9ecef;"
                                            onclick="UserDetail(this, '{{ $value->cid }}')">
                                            <!-- Table data 1 -->
                                            <td>{{ $key + 1 }}</td>
                                            {{-- @php
                                            $name = \App\User::with('candidate_information')
                                                ->where('id', $value->saved_by)
                                                ->first();
                                        @endphp --}}
                                            <td>
                                                @if (isset($value->recruiter))
                                                    {{ $value->recruiter }}
                                                @endif
                                            </td>
                                            <td>
                                                @if (isset($value->first_name))
                                                    {{ $value->first_name }} {{ $value->last_name }}

                                                @endif
                                            </td>
                                            <td>{{ $value->candidate_profile }}
                                            </td>
                                            <td>{{ $value->sub_segment }}</td>
                                            <td>
                                                @if (isset($value->curr_salary))
                                                    {{ $value->curr_salary }}

                                                @endif
                                            </td>
                                            <td>
                                                @if (isset($value->exp_salary))
                                                    {{ $value->exp_salary }}

                                                @endif
                                            </td>
                                            <td>{{ $value->app_status }}</td>
                                            <td>{{ $value->client }}</td>
                                            <td>{{ $value->career_endo }}</td>
                                            <td>
                                                @if (isset($value->endi_date))
                                                    {{ $value->endi_date }}

                                                @endif
                                            </td>
                                            <td></td>
                                        </tr>
                                    @endif

                                @empty
                                    <tr>

                                        <td> no data found</td>
                                    </tr>
                                @endforelse

                            </tbody>
                        </table>
                    </div>
                    {{ $Userdata->links() }}



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
                                                                    sub-segment:
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
                                                                    Date Undated:
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
            // show and hide loader after time set ends

        });
        // Section for docement ready funciton starts

        // funciton for channging the data to Dat Table starts
        $(function() {
            $("#record").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
            });
        });
        // funciton for changing data to data tabl ends

        // funciton for filtering the data according to selected input starts
        function filterUserData() {
            $("#loader").show();

            // get values of selected inputs of users
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

            // call Ajax for returning the data as view
            $.ajax({
                type: "GET",
                url: '{{ url('admin/filter_records') }}',
                data: {
                    _token: token,
                    searchKeyword: searchKeyword,
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
                    $("#loader").hide();
                    // appennd count value coming from hidden input of appended view to count
                    recordCount = $('#abc').val()
                    $('#recordNumber').val(recordCount)
                },
            });
        }
        // funciton for filtering the data according to selected input ends

        // function for selected candidate of table to show detail data on right starts
        function UserDetail(elem, id) {
            $('.common-tr').removeClass('hover-primary1');
            $(elem).addClass('hover-primary1');
         
            // $(e).children().removeClass('fade');
            // show loader for waiting
            // $("#loader").show();

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
        $('#candidate').change(function() {
            $('#profile').empty();
            $('#sub_segment').empty();
            $('#date').empty();
            $('#client').empty();
            $('#career_level').empty();
            $('#app_status').empty();
            var profile = {!! $candidateprofile !!};
            var segment = {!! $candidateDomain !!};
            var status = {!! $endorsement !!};
            var client = {!! $endorsement !!};
            var career = {!! $endorsement !!};
            var count = 0;
            $.each($(this).val(), function(i, v) {
                for (let i = 0; i < profile.length; i++) {
                    if (v == profile[i].candidate_id) {
                        count++;
                        if (profile[i].candidate_profile != "") {

                            $('#profile').append('<option  selected  value="' + profile[i]
                                .candidate_profile +
                                '">' +
                                profile[i].candidate_profile +
                                '</option>');
                        }
                        if (segment[i].sub_segment != "") {

                            $('#sub_segment').append('<option selected  value="' + segment[i].sub_segment +
                                '">' +
                                segment[i].sub_segment +
                                '</option>');
                        }
                    }
                    if (v == status[i].candidate_id) {
                        count++;
                        if (status[i].app_status != null) {
                        $('#app_status').append('<option selected  value="' + status[i].app_status + '">' +
                            status[i]
                            .app_status +
                            '</option>');
                        }
                        if (client[i].client != null) {
                            $('#client').append('<option  selected value="' + client[i].client + '">' +
                                client[
                                    i]
                                .client +
                                '</option>');
                        }
                        if (career[i].career_endo != null) {
                        $('#career_level').append('<option selected  value="' + career[i].career_endo +
                            '">' + status[
                                i]
                            .career_endo +
                            '</option>');
                        }
                    }
                }
            })
        });

        function AppendSelect(elem) {
            console.log($(this).val);
        }
        $("#reset").click(function() {
            $('#date').val("")
            filterUserData();
        })

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
                        }
                         else if (res.success == 'duplicate') {
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

        // function for (if domain is changed append segments acoordingly) starts
        function DomainChange(elem) {
            $('#segment').empty()
            $('#Domainsegment').empty()
            var segmentsDropDown = {!! $segmentsDropDown !!};
            var count = 0;
            for (let i = 0; i < segmentsDropDown.length; i++) {
                if ($(elem).val() == segmentsDropDown[i].domain_id) {
                    count++;
                    $('#segment').append('<option value="' + segmentsDropDown[i].id + '">' + segmentsDropDown[i]
                        .segment_name +
                        '</option>');
                    $('#Domainsegment').append('<option value="' + segmentsDropDown[i].id + '">' + segmentsDropDown[i]
                        .segment_name +
                        '</option>');
                }

            }
            SegmentChange("segment");

        }
        // function for (if domain is changed append segments acoordingly) starts

        // function for (if segment is changed append segments acoordingly) starts
        function SegmentChange(elem) {
            $('#Domain_sub_segment').empty()
            $('#endo_sub_segment').empty()
            var sub_segmentsDropDown = {!! $sub_segmentsDropDown !!};
            var count = 0;
            for (let i = 0; i < sub_segmentsDropDown.length; i++) {
                console.log(sub_segmentsDropDown)
                if ($('#segment').val() == sub_segmentsDropDown[i].segment_id) {
                    count++;
                    $('#Domain_sub_segment').append('<option value="' + sub_segmentsDropDown[i].sub_segment_name + '">' +
                        sub_segmentsDropDown[i]
                        .sub_segment_name +
                        '</option>');
                    $('#endo_sub_segment').append('<option value="' + sub_segmentsDropDown[i].sub_segment_name + '">' +
                        sub_segmentsDropDown[i]
                        .sub_segment_name +
                        '</option>');
                }
            }
        }
        // function for (if segment is changed append segments acoordingly) ends

        // apppending endorsements segments starts
        // function changeSegment(elem) {
        //     $('#endo_sub_segment').empty()
        //     var sub_segmentsDropDown = {!! $sub_segmentsDropDown !!};
        //     var count = 0;
        //     for (let i = 0; i < sub_segmentsDropDown.length; i++) {
        //         if ($('#Domainsegment').val() == sub_segmentsDropDown[i].segment_id) {
        //             count++;
        //             $('#endo_sub_segment').append('<option value="' + sub_segmentsDropDown[i].id + '">' +
        //                 sub_segmentsDropDown[i]
        //                 .sub_segment_name +
        //                 '</option>');
        //         }
        //     }
        // }
        // apppending endorsements segments ends
    </script>

@endsection
