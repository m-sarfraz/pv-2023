@extends('layouts.app')

@section('style')
    <style>
        #example1_filter label {
            display: flex;
            width: fit-content;
            margin-left: auto;
            align: items-center;
        }

        mark {
            padding: 0;
            background: #f1c40f;
        }

        .hideID:first-child,
        .hidetrID tr td:first-child {
            display: none !important;
        }

        .hidetrID tr:hover {
            background-color: rgb(220 134 39) !important;
            color: white;

        }

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
    </style>
@endsection


@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-5">
                <p class="C-Heading pt-3">Record Finder:</p>
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
                                            {{-- @foreach ($user as $key => $user)
                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach --}}
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group mb-1 pt-1">
                                        <label class="d-block font-size-3 mb-0">
                                            Candidate's Name
                                        </label>
                                        <select multiple name="candidate" id="candidate" class="select2_dropdown  w-100"
                                            onchange="filterUserData()">

                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-1">
                                <div class="col-lg-6">
                                    <div class="form-group mb-1">

                                        <label class="d-block font-size-3 mb-0">
                                            Candidate’s Profile
                                        </label>
                                        <select multiple name="profile" id="profile" class="select2_dropdown  w-100"
                                            onchange="filterUserData()">

                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group mb-1">

                                        <label class="d-block font-size-3 mb-0">
                                            Sub-Segment
                                        </label>
                                        <select multiple name="sub_segment" id="sub_segment" class="select2_dropdown  w-100"
                                            onchange="filterUserData()">

                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-1">
                                <div class="col-lg-6">
                                    <div class="form-group mb-1">

                                        <label class="d-block font-size-3 mb-0">
                                            Application Status:
                                        </label>
                                        <select multiple name="app_status" id="app_status" class="select2_dropdown  w-100"
                                            onchange="filterUserData()">

                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group mb-1">

                                        <label class="d-block font-size-3 mb-0">
                                            Client:
                                        </label>
                                        <select multiple name="client" id="client" class="select2_dropdown  w-100"
                                            onchange="filterUserData()">

                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-1 align-items-center">
                                <div class="col-lg-6">
                                    <div class="form-group mb-1">

                                        <label class="d-block font-size-3 mb-0 pt-lg-1 pt-sm-0 pt-0">
                                            Career Level:
                                        </label>
                                        <select multiple name="career_level" id="career_level"
                                            class="select2_dropdown  w-100" onchange="filterUserData()">

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
                                <tr style="">
                                    <th class="ant-table-cell hideID noVis">id</th>
                                    <th class="ant-table-cell">Sr</th>
                                    <th class="ant-table-cell">Recruiter</th>
                                    <th class="ant-table-cell">Team</th>
                                    <th class="ant-table-cell">Candidate</th>
                                    <th class="ant-table-cell">Application Status</th>
                                    <th class="ant-table-cell">Candidate’s Profile</th>
                                    <th class="ant-table-cell">Career</th>
                                    <th class="ant-table-cell">certificate</th>
                                    <th class="ant-table-cell">client</th>
                                    <th class="ant-table-cell">phone</th>
                                    <th class="ant-table-cell">course</th>
                                    <th class="ant-table-cell">Endorsement Date</th>
                                    <th class="ant-table-cell">date invited</th>
                                    <th class="ant-table-cell">date sifted</th>
                                    <th class="ant-table-cell">educational attainment</th>
                                    <th class="ant-table-cell">emp history</th>
                                    <th class="ant-table-cell">type</th>
                                    <th class="ant-table-cell">exp salary</th>
                                    <th class="ant-table-cell">Gender</th>
                                    <th class="ant-table-cell">interview note</th>
                                    <th class="ant-table-cell">invoice number</th>
                                    <th class="ant-table-cell">onboarding date </th>
                                    <th class="ant-table-cell">position title </th>
                                    <th class="ant-table-cell">remarks </th>
                                    <th class="ant-table-cell">remarks_for_finance </th>
                                    <th class="ant-table-cell">address </th>
                                    <th class="ant-table-cell">segment </th>
                                    <th class="ant-table-cell">site</th>
                                    <th class="ant-table-cell">endostatus</th>
                                    <th class="ant-table-cell">sub_segment</th>
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
                        <form action="" id="user_detail_form">
                            <fieldset disabled="" id="recordFieldset">
                                <div class="row mb-1">
                                    <div class="col-lg-6">
                                        <div class="form-group mb-0">
                                            <label class="Label">
                                                Candidate's Name:
                                            </label>
                                            <input type="text" class="form-control" placeholder="Candidate's Name"
                                                name="first_name">
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group mb-0">
                                            @php
                                                $gender = Helper::get_dropdown('gender');
                                            @endphp
                                            <label class="Label">Gender:</label>
                                            <select class="w-100 form-control" name="gender">
                                                <option selected disabled>Select Option
                                                </option>

                                            </select>
                                            <div>
                                                <small class="text-danger"></small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group mb-0">
                                            <label class="Label">DOB:</label>
                                            <input type="date" class="form-control users-input-S-C" name="dob">
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-1">
                                    <div class="col-lg-6">
                                        <div class="form-group mb-0">
                                            <label class="Label">Email Address:</label>
                                            <input type="text" class="form-control users-input-S-C"
                                                placeholder="Email Address" name="email" />
                                            <div>
                                                <small class="text-danger"></small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group mb-0">
                                            <label class="d-block font-size-3 mb-0">
                                                Contact:
                                            </label>
                                            <input type="text" class="form-control users-input-S-C" placeholder="Contact #"
                                                name="phone" />
                                            <div>
                                                <small class="text-danger"></small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-1">
                                    <div class="col-lg-6">
                                        <div class="form-group mb-0">
                                            <label class="d-block font-size-3 mb-0">
                                                Residence
                                            </label>
                                            <input type="text" class="form-control users-input-S-C" name="address"
                                                placeholder="Residence" />
                                            <div>
                                                <small class="text-danger"></small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group mb-0">
                                            <label class="d-block font-size-3 mb-0">
                                                Date Sifted:
                                            </label>
                                            <input type="date" class="form-control users-input-S-C" name="date_shifted" />
                                            <div>
                                                <small class="text-danger"></small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group mb-0">
                                            <?php
                                            $source = Helper::get_dropdown('source');
                                            ?>
                                            <label class="d-block font-size-3 mb-0">
                                                Source
                                            </label>
                                            <select name="SOURCE" class=" form-control p-0 EmailInput-F" id="SOURCE">
                                                <option selected disabled>Select Option</option>

                                            </select>
                                            <div>
                                                <small class="text-danger"></small>
                                            </div>
                                            <div>
                                                <small class="text-danger"></small>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-1">
                                    <div class="col-lg-6">
                                        <div class="form-group mb-0">
                                            <label class="Label">Educational Attainment</label>
                                            <?php
                                            $eduAttainment = Helper::get_dropdown('educational_attainment');
                                            ?>

                                            <select name="EDUCATIONAL_ATTAINTMENT" onchange="EducationalAttainChange(this)"
                                                class=" form-control p-0 EmailInput-F" id="EDUCATIONAL_ATTAINTMENT">
                                                <option selected disabled>Select Option</option>
                                            </select>
                                            <div>
                                                <small class="text-danger"></small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group mb-0">
                                            <label class="Label">Date Invited:</label>
                                            <input type="date" class="form-control users-input-S-C" name="date_invited" />
                                            <div>
                                                <small class="text-danger"></small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group mb-0">
                                            <?php
                                            $manner_of_invite = Helper::get_dropdown('manner_of_invite');
                                            ?>
                                            <label class="Label">
                                                Manner of Invite:
                                            </label>
                                            <select name="manner_of_invite" id="" class="form-control p-0 users-input-S-C">
                                                <option selected disabled>Select Option</option>

                                            </select>
                                            <div>
                                                <small class="text-danger"></small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-1">
                                    <div class="col-lg-6">
                                        <div class="form-group mb-0">
                                            <?php
                                            $course = Helper::get_dropdown('course');
                                            ?>
                                            <label class="Label">Course:</label>
                                            <select name="COURSE" class="form-control p-0 users-input-S-C" id="COURSE">
                                                <option selected disabled>Select Option</option>

                                            </select>
                                            <div>
                                                <small class="text-danger"></small>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group mb-0">
                                            <label class="Label">
                                                Current Salary:
                                            </label>
                                            <input type="text" class="form-control users-input-S-C" name="curr_salary" />
                                            <div>
                                                <small class="text-danger"></small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group mb-0">
                                            <label class="Label">
                                                Current Allowance:
                                            </label>
                                            <input type="text" class="form-control users-input-S-C"
                                                name="curr_allowance" />
                                            <div>
                                                <small class="text-danger"></small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-1">
                                    <div class="col-lg-6">
                                        <div class="form-group mb-0">
                                            <label class="Label">Domain</label>
                                            <select name="DOMAIN" id="domain" class="form-control p-0 users-input-S-C"
                                                onchange="DomainChange(this)">
                                                <option selected disabled>Select Option</option>

                                            </select>
                                            <div>
                                                <small class="text-danger"></small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group mb-0">
                                            <label class="Label">
                                                Expected Salary:
                                            </label>
                                            <input type="text" class="form-control users-input-S-C" name="expec_salary" />
                                            <div>
                                                <small class="text-danger"></small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group mb-0">
                                            <label class="Label">
                                                Offered Salary:
                                            </label>
                                            <input type="text" class="form-control users-input-S-C"
                                                name="offered_salary" />
                                            <div>
                                                <small class="text-danger"></small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-1">
                                    <div class="col-lg-6">
                                        <div class="form-group mb-0">
                                            @php
                                                $segments = Helper::get_dropdown('segments');
                                            @endphp
                                            <label class="Label">Segment:</label>
                                            <select name="segment" id="segment" class="form-control p-0 users-input-S-C"
                                                onchange="SegmentChange(this)">
                                                <option selected disabled>Select Option</option>

                                            </select>
                                            <div>
                                                <small class="text-danger"></small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group mb-0">
                                            @php
                                                $sub_segment = Helper::get_dropdown('sub_segment');
                                            @endphp
                                            <label class="Label">
                                                Sub-Segment:
                                            </label>
                                            <select name="sub_segment" id="Domain_sub_segment"
                                                class="form-control p-0 users-input-S-C">
                                                <option selected disabled>Select Option</option>

                                            </select>
                                            <div>
                                                <small class="text-danger"></small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group mb-0">
                                            <label class="Label">
                                                Offered Allowance:
                                            </label>
                                            <input type="text" class="form-control users-input-S-C"
                                                name="offered_allowance" />
                                            <div>
                                                <small class="text-danger"></small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-1">
                                    <div class="col-lg-6">
                                        <?php
                                        $profile = Helper::get_dropdown('candidates_profile');
                                        ?>
                                        <div class="form-group mb-0">
                                            <label class="Label">Candidate’s Profile:</label>
                                            <select name="CANDIDATES_PROFILE" id="CANDIDATES_PROFILE"
                                                class="select2_dropdown w-100" class="form-control p-0 users-input-S-C"
                                                onchange="Fetch_profile()">
                                                <option selected disabled>Select Option</option>

                                            </select>
                                            <div>
                                                <small class="text-danger"></small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group mb-0">
                                            <label class="Label">
                                                Date Processed:
                                            </label>
                                            <input type="date" class="form-control users-input-S-C"
                                                nmae="date_processed" />
                                            <div>
                                                <small class="text-danger"></small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group mb-0">
                                            <?php
                                            $status = Helper::get_dropdown('application_status');
                                            ?>
                                            <label class="Label">
                                                Application Status:
                                            </label>
                                            <select name="APPLICATION_STATUS" id="ap_status"
                                                class="form-control border pl-0 arrow-3 h-px-20_custom w-100 font-size-4 d-flex align-items-center w-100">
                                                <option selected disabled>Select Option</option>

                                            </select>
                                            <div>
                                                <small class="text-danger"></small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-1">
                                    <div class="col-lg-6">
                                        <div class="form-group mb-0">
                                            <label class="Label">Position Applied:</label>
                                            <input type="text" class="form-control users-input-S-C"
                                                name="position_applied" />
                                            <div>
                                                <small class="text-danger"></small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group mb-0">
                                            <label class="Label">
                                                Sifted By:
                                            </label>
                                            <input type="text" class="form-control users-input-S-C" name="shifted_by" />
                                            <div>
                                                <small class="text-danger"></small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-1">
                                    <div class="col-lg-6">
                                        <div class="form-group mb-0">
                                            <label class="d-block font-size-3 mb-0">
                                                Interview Notes:
                                            </label>
                                            <textarea name="notes" rows="3" type="text" class="form-control border E_H h-px-20_custom" value=""
                                                placeholder="Enter Interview Notes"> </textarea>
                                        </div>
                                        <div class="pt-3">
                                            <div class="form-group mb-0">
                                                <label class="d-block font-size-3 mb-0">
                                                    Employment History:
                                                </label>
                                                <textarea name="EMPLOYMENT_HISTORY" rows="3" type="text" class="form-control border E_H h-px-20_custom"
                                                    placeholder="Enter Interview Notes"> </textarea>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group mb-0">
                                            <?php
                                            $certificate = Helper::get_dropdown('certifications');
                                            ?>
                                            <label class="d-block font-size-3 mb-0">
                                                Certification:
                                            </label>
                                            <select name="CERTIFICATIONS" class="form-control users-input-S-C">
                                                <option selected disabled>Select Option</option>

                                            </select>
                                            <div>
                                                <small class="text-danger"></small>
                                            </div>
                                        </div>
                                        <div class="E_NEG">
                                            <p class="C-Heading pt-5 mt-4">Endorsement Details:</p>
                                            <div class="card mb-13">
                                                <div class="card-body">
                                                    <form action="">
                                                        <div class="row mb-1">
                                                            <div class="col-lg-6">
                                                                <div class="form-group mb-0">
                                                                    @php
                                                                        $endoType = Helper::get_dropdown('endorsement_type');
                                                                    @endphp
                                                                    <label class="Label-00">
                                                                        Endorsement Type:
                                                                    </label>
                                                                    <select name="ENDORSEMENT_TYPE" id=""
                                                                        class="form-control border pl-0 arrow-3 h-px-20_custom w-100 font-size-4 d-flex align-items-center w-100">
                                                                        <option selected disabled>Select Option</option>

                                                                    </select>
                                                                    <div>
                                                                        <small class="text-danger"></small>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="form-group mb-0">
                                                                    @php
                                                                        $CareerLevel = Helper::get_dropdown('career_level');
                                                                    @endphp
                                                                    <label class="Label-00">
                                                                        Career Level:
                                                                    </label>
                                                                    <select name="CAREER_LEVEL" id="career"
                                                                        class="form-control border pl-0 arrow-3 h-px-20_custom w-100 font-size-4 d-flex align-items-center w-100">
                                                                        <option selected disabled>Select Option</option>

                                                                    </select>
                                                                    <div>
                                                                        <small class="text-danger"></small>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-1">
                                                            <div class="col-lg-6">
                                                                @php
                                                                    $site = Helper::get_dropdown('site');
                                                                @endphp
                                                                <div class="form-group mb-0">
                                                                    <label class="Label-00">Site</label>
                                                                    <select name="SITE" id="site"
                                                                        class="form-control border pl-0 arrow-3 h-px-20_custom w-100 font-size-4 d-flex align-items-center w-100">
                                                                        <option selected disabled>Select Option</option>

                                                                    </select>
                                                                    <div>
                                                                        <small class="text-danger"></small>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="form-group mb-0">
                                                                    <label class="Label-00 ">
                                                                        Remarks (For Finance)
                                                                    </label>
                                                                    <select name="REMARKS_FOR_FINANCE" disabled=""
                                                                        id="remarks_for_finance"
                                                                        onchange="RemarksChange(this)"
                                                                        class="form-control select2_dropdown border pl-0 arrow-3 h-px-20_custom w-100 font-size-4 d-flex align-items-center w-100">
                                                                        @php
                                                                            $remarks = Helper::get_dropdown('remarks_for_finance');
                                                                        @endphp
                                                                        <option selected disabled>Select Option</option>

                                                                    </select>
                                                                    <div>
                                                                        <small class="text-danger"></small>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-1">
                                                            <div class="col-lg-6">
                                                                <div class="form-group mb-0">

                                                                    <label class="Label-00">
                                                                        Client
                                                                    </label>
                                                                    {{-- @dd($user->client) --}}
                                                                    <select name="CLIENT_FINANCE"
                                                                        class="form-control border h-px-20_custom w-100"
                                                                        id="client_finance" disabled="">
                                                                        <option selected disabled>Select Option</option>

                                                                    </select>
                                                                    <div>
                                                                        <small class="text-danger"></small>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="form-group mb-0">
                                                                    @php
                                                                        $status = Helper::get_dropdown('status');
                                                                    @endphp
                                                                    <label class="Label-00">
                                                                        Status:
                                                                    </label>
                                                                    <select name="STATUS" id="status" disabled=""
                                                                        class="form-control border pl-0 arrow-3 h-px-20_custom w-100 font-size-4 d-flex align-items-center w-100">
                                                                        <option selected disabled>Select Option</option>

                                                                        &quot;item&quot;
                                                                        </option>
                                                                    </select>
                                                                    <div>
                                                                        <small class="text-danger"></small>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-1">
                                                            <div class="col-lg-6">
                                                                <div class="form-group mb-0">
                                                                    @php
                                                                        $position_title = Helper::get_dropdown('position_title');
                                                                    @endphp
                                                                    <label class="Label-00 ">
                                                                        Position Title:
                                                                    </label>
                                                                    <select name="POSITION_TITLE" id="position"
                                                                        onchange="Fetch_profile()"
                                                                        class="form-control border select2_dropdow pl-0 arrow-3 h-px-20_custom w-100 font-size-4 d-flex align-items-center w-100">
                                                                        <option selected disabled>Select Option</option>

                                                                    </select>
                                                                    <div>
                                                                        <small class="text-danger"></small>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="form-group mb-0">
                                                                    @php
                                                                        $ReasonForNotP = Helper::get_dropdown('reason_for_not_progressing');
                                                                    @endphp
                                                                    <label class="Label-00">
                                                                        Reason for not progressing:
                                                                    </label>
                                                                    <select name="REASONS_FOR_NOT_PROGRESSING" id="rfp"
                                                                        disabled
                                                                        class="form-control border pl-0 arrow-3 h-px-20_custom w-100 font-size-4 d-flex align-items-center select2_dropdown w-100">
                                                                        <option selected disabled>Select Option</option>

                                                                    </select>
                                                                    <div>
                                                                        <small class="text-danger"></small>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-1">
                                                            <div class="col-lg-6">
                                                                <div class="form-group mb-0">
                                                                    <label class="Label-00">
                                                                        Domain:
                                                                    </label>
                                                                    <select name="DOMAIN_endo" id="domain_endo"
                                                                        onchange="DomainChange(this)"
                                                                        class="form-control p-0 users-input-S-C">
                                                                        <option selected disabled>Select Option</option>

                                                                    </select>
                                                                    <div>
                                                                        <small class="text-danger"></small>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="form-group mb-0">
                                                                    <label class="Label">Interview
                                                                        Schedule:</label>
                                                                    <input type="date" name="INTERVIEW_SCHEDULE"
                                                                        id="interview_schedule"
                                                                        class="form-control users-input-S-C" />
                                                                    <div>
                                                                        <small class="text-danger"></small>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-1">
                                                            <div class="col-lg-6">
                                                                <div class="form-group mb-0">
                                                                    @php
                                                                        $segments = Helper::get_dropdown('segments');
                                                                    @endphp
                                                                    <label class="Label-00">
                                                                        Segment:
                                                                    </label>
                                                                    <select name="endo_segment" id="Domainsegment"
                                                                        class="w-100 form-control"
                                                                        onchange="changeSegment(this)">
                                                                        <option selected disabled>Select Option</option>

                                                                    </select>
                                                                    <div>
                                                                        <small class="text-danger"></small>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            {{-- <div class="col-lg-6 d-none">
                                                                @php
                                                                    $remarks = Helper::get_dropdown('remarks_from_finance');
                                                                @endphp
                                                                <div class=" mb-0">
                                                                    <label class="Label">Remarks (From
                                                                        Recruiter):</label>
                                                                    <select name="REMARKS_FROM_FINANCE" id="remarks"
                                                                        class="form-control border pl-0 arrow-3 h-px-20_custom w-100 font-size-4 d-flex align-items-center w-100">
                                                                        <option selected disabled>Select Option</option>

                                                                    </select>
                                                                    <div>
                                                                        <small class="text-danger"></small>
                                                                    </div>
                                                                </div>
                                                            </div> --}}
                                                            <div class="col-lg-6">
                                                                <div class="form-group mb-0">
                                                                    <label class="Label">Endo Date:</label>
                                                                    <input type="date" name="DATE_ENDORSED" id="endo_date"
                                                                        class="form-control border h-px-20_custom" />
                                                                    <div>
                                                                        <small class="text-danger"></small>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-1">
                                                            <div class="col-lg-6">
                                                                <div class="form-group mb-0">
                                                                    <label class="Label-00 ">
                                                                        Sub-Segment:
                                                                    </label>
                                                                    <select name="endo_sub_segment " id="endo_sub_segment"
                                                                        class="w-100  form-control">
                                                                        <option selected disabled>Select Option</option>

                                                                    </select>
                                                                    <div>
                                                                        <small class="text-danger"></small>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            {{-- </div> --}}
                                                            {{-- <div class="row mb-1"> --}}
                                                            <div class="col-lg-6">
                                                                <div class="form-group mb-0">
                                                                    <label class="Label-00">
                                                                        Date Updated:
                                                                    </label>
                                                                    <input type="date" name="DATE_UNDATED" id="DATE_UNDATED"
                                                                        class="form-control border h-px-20_custom" />
                                                                    <div>
                                                                        <small class="text-danger"></small>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
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
    <script src="{{ asset('assets/js/data-entry.js') }}"></script>
 

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
        // Section for docement ready funciton starts
        $(document).ready(function() {
            var recordExist = {!! $recordExist !!};
            load_datatable()
            select2Dropdown("select2_dropdown");
            // $('#searchKeyword').focus();
            // show and hide loader after time set starts
            $('#loader').show();
            setTimeout(function() {
                $('#loader').hide();
            }, 1000);
            appendFilterOptions()
            setTimeout(() => {
                if (recordExist != 0) {
                    var cid = {!! $cid !!};
                    $('#candidate').val(cid); // Select the option with a value of '1'
                    $('#candidate').trigger('change'); // Notify any JS components that the value changed
                    var findChild = $('#filter_table_div').children().children().children().children()[6];
                    var thisElement = findChild.childNodes[1].childNodes[0];
                    UserDetail(thisElement, cid)
                    setTimeout(() => {
                        $('.hidetrID').children().addClass('hover-primary1');
                    }, 1000);
                }
            }, 2000);
            // show and hide loader after time set ends
            $('#recordTable_filter').hide('div');
        });
        //append all uiser to dropdown for of candidate list 
        function appendFilterOptions() {
            $.ajax({
                    type: "GET",
                    url: '{{ url('admin/appendFilterOptions') }}',
                })
                .done(function(res) {
                    for (let i = 0; i < res.user.length; i++) {
                        if (res.user[i].name != 'null') {

                            $('#recruiter').append('<option value="' + res.user[i].id + '">' + res.user[i].name +
                                '</option>')
                        }
                    }
                    for (let i = 0; i < res.candidates.length; i++) {
                        if (res.candidates[i].name != null || res.candidates[i].name != ' ') {
                            $('#candidate').append('<option value="' + res.candidates[i].id + '">' + res.candidates[i]
                                .name + '</option>')
                        }
                    }
                    for (let i = 0; i < res.candidates_profile.options.length; i++) {
                        $('#profile').append('<option value="' + res.candidates_profile.options[i].option_name + '">' +
                            res.candidates_profile.options[i].option_name + '</option>')
                    }
                    for (let i = 0; i < res.sub_segment.options.length; i++) {
                        $('#sub_segment').append('<option value="' + res.sub_segment.options[i].option_name + '">' + res
                            .sub_segment.options[i].option_name + '</option>')
                    }
                    for (let i = 0; i < res.clients.options.length; i++) {
                        $('#client').append('<option value="' + res.clients.options[i].option_name + '">' + res.clients
                            .options[i].option_name + '</option>')
                    }
                    for (let i = 0; i < res.career_level.options.length; i++) {
                        $('#career_level').append('<option value="' + res.career_level.options[i].option_name + '">' +
                            res.career_level.options[i].option_name + '</option>')
                    }
                    for (let i = 0; i < res.application_status.options.length; i++) {
                        $('#app_status').append('<option value="' + res.application_status.options[i].option_name +
                            '">' + res.application_status.options[i].option_name + '</option>')
                    }
                    $('#loader1').hide()
                })
                .fail(function(err) {
                    console.log(err);
                });
        }
        //close 
        // Append endorsement data to finance portion starts
        // const changeOnboardingDate = () => {
        //     alert('hi')
        //     // date_processed.value = endo_date.value
        // }

        // Append endorsement data to finance portion ends
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

        $.fn.dataTable.ext.search.push(
            function(settings, data, dataIndex) {
                if (settings.oPreviousSearch.sSearch === "")
            return true; // Always return true if search is blank (save processing)

                var search = $.fn.DataTable.util.escapeRegex(settings.oPreviousSearch.sSearch);
                var newFilter = data.slice();

                for (var i = 0; i < settings.aoColumns.length; i++) {
                    if (!settings.aoColumns[i].bVisible) {
                        newFilter.splice(i, 1);
                    }
                }

                var regex = new RegExp("^(?=.*?" + search + ").*$", "i");
                return regex.test(newFilter.join(" "));
            }
        );
        // load main table data on page load using ajax(Yajra datatable) 
        function load_datatable() {
            var option_table = $('#recordTable').DataTable({
                destroy: true,
                pageLength: 10,
                processing: true,
                serverSide: false,
                searchHighlight: true,
                language: {
                    processing: '<div class="spinner-border mr-3" role="status"></div>' +
                        ' <span>Loading Records Please wait </span>' +
                        ' <span>...</span>'
                },

                ajax: {
                    url: "{{ route('view-record-table') }}",
                    type: "GET",
                },
                initComplete: function(settings, json) {
                    $('#searchKeyword').trigger('input');
                    let tableID = $('#filter_table_div').children().children().attr('id')
                    if (tableID == 'filteredTable_wrapper') {
                        countRecordFilter()
                    }
                    if (tableID == 'recordTable_wrapper') {
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
                    }, {
                        data: 'Candidate',
                        name: 'Candidate',
                        // searchable: false,
                        // orderable: false
                    }, {
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
                // dom: 'Bfrtlp',
                // buttons: [
                //     'csv',
                //     // 'pdf'
                // ],
                // lengthMenu: [ [10, 25, 50, -1], [10, 25, 50, "All"] ]
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
                pageLength: 20,
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
                initComplete: function(settings, json) {
                    $('#searchKeyword').trigger('input');
                    let tableID = $('#filter_table_div').children().children().attr('id')
                    if (tableID == 'filteredTable_wrapper') {
                        countRecordFilter()
                    }
                    if (tableID == 'recordTable_wrapper') {
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
                    }, {
                        data: 'Candidate',
                        name: 'Candidate',
                        // searchable: false,
                        // orderable: false
                    }, {
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
                // dom: 'Bfrtlp',
                // buttons: [
                //     'csv',
                //     // 'pdf'
                // ],
                // lengthMenu: [ [10, 25, 50, -1], [10, 25, 50, "All"] ]
            });
        }

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
            // $('#searchKeyword').val('');
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
            console.log(data);

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
                        // swal("success", res.message, "success").then((value) => {});
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: res.message,
                            showConfirmButton: false,
                            timer: 1000
                        })
                        location.reload();
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
            let tableID = $('#filter_table_div').children().children().attr('id')
            if (tableID == 'filteredTable_wrapper') {
                countRecordFilter()
            }
            if (tableID == 'recordTable_wrapper') {
                countRecord()
            }
        });
        // close
    </script>
@endsection
