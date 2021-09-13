@extends('layouts.app')

@section('style')

@endsection


@section('content')
    <div class="container-fluid">
        <form id="data_entry" method="post">
            <div class="row d-E-Row mb-6">
                @csrf
                <div class="col-lg-2">
                    <p class="C-Heading">Command</p>
                    <div class="card">
                        <div class="card-body p-0">
                            <div class="form-group">

                                <label class="d-block text-black-2 font-size-3 font-weight-semibold mb-0">
                                    User&#x27;s Name
                                </label>
                                <input type="email" disabled="" class="form-control users-input m-3 mt-0 w-75"
                                    style="padding-left: 12px !important;" aria-describedby="emailHelp"
                                    value="{{ Auth::user()->name }}" placeholder="enter candidate name" />
                            </div>
                            <div class="d-grid gap-2 form-group col-md-12">
                                <button class="btn btn_Group mb-4 btn-sm" type="button" id="new" onclick="newRecord(this)">
                                    New Record
                                </button>
                                <button class="btn btn_Group mb-4 btn-sm" type="button"
                                    onclick="CreateUpdateData('{{ route('save-data-entry') }}')" id="save">
                                    Save Record
                                </button>
                            </div>
                        </div>
                    </div>
                    <p class="C-Heading mt-5">Candidate</p>
                    <div class="card">
                        <div class="card-body" style="display: flex; justify-content: center;">
                            <div class="form-group">
                                {{-- <label class="Label">Candidate:</label> --}}
                            </div>
                            <div class="form-group mb-8"></div>
                            <div class="d-grid gap-2 form-group col-md-12">
                                <Select name="USERS" class="mb-4 select2_dropdown w-100" id="user"
                                    onchange="enableSearch('#searchRecord')">
                                    <option value="" disabled selected></option>
                                    @foreach ($user as $key => $value)
                                        <option value="{{ $value->id }}">
                                            {{ $value->first_name }} {{ $value->last_name }}
                                        </option>
                                    @endforeach
                                </Select>

                                <button class="btn btn_Group mb-4 mt-4 btn-sm" type="button" id="searchRecord"
                                    onclick="SearchUserData(this,'#UserData_div')" disabled="">
                                    Search Record
                                </button>
                                <button disabled="" class="btn btn_Group mb-4 btn-sm" type="button" id="editRecord"
                                    onclick="EnableUserEdit(this)">
                                    Edit Record
                                </button>
                                <button disabled="" class="btn btn_Group mb-4 btn-sm" type="button" id="saveRecord"
                                    onclick="CreateUpdateData('{{ url('admin/update-data-entry') }}')">
                                    Save Edit
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <p class="C-Heading mt-5">QR Code:</p>
                        <a href="" download="">
                            <img style="width: 100%;" class="pl-sm-15" src="" alt="" />
                        </a>
                    </div>
                </div>
                <div class="col-lg-10 col-md-9 col-sm-9 col-9">
                    <div class="row m-0" id="UserData_div">
                        <div class="col-lg-6">
                            <!-- ================== -->
                            <!-- Candidate section start -->
                            <div class="row">

                                <div class="col-lg-12 p-0">
                                    <p class="C-Heading">Sourcing &amp; Demographics</p>
                                    <div class="card">
                                        <div class="card-body pt-4">
                                            <fieldset>
                                                <div class="row mb-2">
                                                    <div class="col-lg-4">
                                                        <div class="form-group mb-0">
                                                            <label class="Label">*Last Name:</label>
                                                            <input type="text" class="form-control users-input-S-C"
                                                                name="LAST_NAME" required="" />
                                                        </div>
                                                        <div><small class="___class_+?36___"></small></div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="form-group mb-0">
                                                            <label class="Label">
                                                                Middle Initial
                                                            </label>
                                                            <input type="text" class="form-control users-input-S-C"
                                                                name="MIDDLE_NAME" />
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="form-group mb-0">
                                                            <label class="Label">*First Name:</label>
                                                            <input type="text" class="form-control users-input-S-C"
                                                                name="FIRST_NAME" required="" />
                                                        </div>
                                                        <div><small class="___class_+?45___"></small></div>
                                                    </div>
                                                </div>
                                                <div class="row mb-2">
                                                    <div class="col-lg-6">
                                                        <div class="form-group mb-0">
                                                            @php
                                                                $gender = Helper::get_dropdown('gender');
                                                            @endphp
                                                            <label class="d-block font-size-3 mb-0">
                                                                Gender
                                                            </label>
                                                            <select name="GENDER"
                                                                class="form-control border pl-0 arrow-3 h-px-20_custom w-100 font-size-4 d-flex align-items-center w-100">
                                                                @foreach ($gender->options as $genderOptions)
                                                                    <option value="{{ $genderOptions->id }}">
                                                                        {{ $genderOptions->option_name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group mb-0">
                                                            <label class="d-block font-size-3 mb-0">
                                                                DOB
                                                            </label>
                                                            <input type="date" name="DATE_OF_BIRTH"
                                                                class="form-control border h-px-20_custom" required />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mb-2">
                                                    <div class="col-lg-6">
                                                        <div class="form-group mb-0">
                                                            <label for="validationDefaultUsername"
                                                                class="mb-0 d-block font-size-3 mb-0">
                                                                Email
                                                            </label>
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text EmailIcon"
                                                                        id="inputGroupPrepend2">
                                                                        <i class="fa fa-envelope-square"></i>
                                                                    </span>
                                                                </div>
                                                                <input type="text" class="form-control EmailInput-F"
                                                                    name="EMAIL_ADDRESS" id="email" required="" />
                                                            </div>
                                                        </div>
                                                        <div><small class="___class_+?64___"></small></div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group mb-0">
                                                            <label for="validationDefaultUsername"
                                                                class="mb-0 d-block font-size-3 mb-0">
                                                                Contact
                                                            </label>
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text EmailIcon"
                                                                        id="inputGroupPrepend2">
                                                                        <i class="fa fa-phone"></i>
                                                                    </span>
                                                                </div>
                                                                <input type="number" class="form-control EmailInput-F"
                                                                    name="CONTACT_NUMBER" required="" />
                                                            </div>
                                                        </div>
                                                        <div><small class="___class_+?73___"></small></div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="form-group mb-0">
                                                            <label class="mb-0 d-block font-size-3 mb-0">
                                                                Residence
                                                            </label>
                                                            {{-- <select name="RESIDENCE" class="form-control p-0 EmailInput-F">
                                                                <option value="item city">
                                                                    item city
                                                                </option>
                                                            </select> --}}
                                                            <input type="text" class="form-control EmailInput-F"
                                                                name="RESIDENCE" required="" />
                                                            <div>
                                                                <small class="text-danger"></small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-7">
                                                        <div class="form-group mb-0">
                                                            <label class="mb-0 d-block font-size-3 mb-0">
                                                                Educational Attainment:
                                                            </label>
                                                            <?php
                                                            $eduAttainment = Helper::get_dropdown('educational_attainment');
                                                            ?>

                                                            <select name="EDUCATIONAL_ATTAINTMENT"
                                                                onchange="EducationalAttainChange(this)"
                                                                class=" form-control p-0 EmailInput-F"
                                                                id="EDUCATIONAL_ATTAINTMENT">
                                                                <option value="" disabled>select option</option>
                                                                @foreach ($eduAttainment->options as $eduAttainmentOptions)
                                                                    <option value="{{ $eduAttainmentOptions->id }}">
                                                                        {{ $eduAttainmentOptions->option_name }}</option>
                                                                @endforeach
                                                            </select>
                                                            <div>
                                                                <small class="text-danger"></small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-5">
                                                        <div class="form-group mb-0">
                                                            <label class="Label">Course</label>
                                                            <?php
                                                            $course = Helper::get_dropdown('course');
                                                            ?>
                                                            <select name="COURSE" class="form-control p-0 users-input-S-C"
                                                                id="COURSE">
                                                                @foreach ($course->options as $courseOptions)
                                                                    <option value="{{ $courseOptions->id }}">
                                                                        {{ $courseOptions->option_name }}</option>
                                                                @endforeach
                                                            </select>
                                                            <div>
                                                                <small class="text-danger"></small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mb-8">
                                                    <div class="col-lg-12">
                                                        <div class="form-group mb-0">
                                                            <?php
                                                            $certificate = Helper::get_dropdown('certifications');
                                                            ?>
                                                            <label class="Label">
                                                                CERTIFICATIONS
                                                            </label>
                                                            <select name="CERTIFICATIONS"
                                                                class="form-control p-0 users-input-S-C select2_dropdown w-100">
                                                                <option selected disabled></option>
                                                                @foreach ($certificate->options as $certificateOption)
                                                                    <option value="{{ $certificateOption->id }}">
                                                                        {{ $certificateOption->option_name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr class="mb-9" />
                                                <div class="row mb-6">
                                                    <div class="col-lg-5">
                                                        <label class="` Label">
                                                            Interview Notes
                                                        </label>
                                                        <textarea name="INTERVIEW_NOTES" rows="3" type="text" id="notes"
                                                            class="form-control border t-HC h-px-20_custom"></textarea>
                                                        <div>
                                                            <small class="text-danger"></small>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-7">
                                                        <div class="row mb-xl-1 mb-9">
                                                            <div class="col-lg-6">
                                                                <label class="Label">
                                                                    Date Sifted:
                                                                </label>
                                                                <input type="date" name="DATE_SIFTED" required=""
                                                                    class="form-control users-input-S-C" />
                                                                <div>
                                                                    <small class="text-danger"></small>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">


                                                                <label class="Label">Domains</label>
                                                                <select name="DOMAIN" id="domain"
                                                                    onchange="DomainChange(this)"
                                                                    class="form-control p-0 users-input-S-C">
                                                                    <option selected disabled>Select Option</option>
                                                                    @foreach ($domainDrop as $domainOption)
                                                                        <option value="{{ $domainOption->id }}">
                                                                            {{ $domainOption->domain_name }}</option>
                                                                    @endforeach
                                                                </select>
                                                                <div>
                                                                    <small class="text-danger"></small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-xl-1 mb-9">
                                                            <div class="col-lg-6">
                                                                <?php
                                                                $segment = Helper::get_dropdown('segments');
                                                                ?>
                                                                <label class="Label">segment</label>
                                                                <select name="SEGMENT" id="Domainsegment"
                                                                    onchange="SegmentChange(this)"
                                                                    class="form-control p-0 users-input-S-C">
                                                                    <option selected disabled>Select Option</option>
                                                                    {{-- @foreach ($segment->options as $segmentOption)
                                                                        <option value="{{ $segmentOption->id }}">
                                                                            {{ $segmentOption->option_name }}</option>
                                                                    @endforeach --}}

                                                                </select>
                                                                <div>
                                                                    <small class="text-danger"></small>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <?php
                                                                $sub_segment = Helper::get_dropdown('sub_segment');
                                                                ?>
                                                                <label class="Label">sub-segment</label>
                                                                <select name="SUB_SEGMENT" id="Domainsub"
                                                                    class="form-control p-0 users-input-S-C">
                                                                    <option selected disabled></option>
                                                                    {{-- @foreach ($sub_segment->options as $sub_segmentOption)
                                                                        <option value="{{ $sub_segmentOption->id }}">
                                                                            {{ $sub_segmentOption->option_name }}
                                                                        </option>
                                                                    @endforeach --}}
                                                                </select>
                                                                <div>
                                                                    <small class="text-danger"></small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-xl-1 mb-9">
                                                            <div class="col-lg-12">
                                                                <label
                                                                    class="text-black-2 font-size-3 font-weight-semibold mb-0">
                                                                    Employement History</label>
                                                                <textarea name="EMPLOYMENT_HISTORY" rows="3" type="text"
                                                                    class="form-control border E_HC h-px-20_custom"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mb-2">
                                                    <div class="col-lg-4">
                                                        <?php
                                                        $profile = Helper::get_dropdown('candidates_profile');
                                                        ?>
                                                        <div class="form-group mb-0">
                                                            <label class="Label">
                                                                candidate profile
                                                            </label>
                                                            <select name="CANDIDATES_PROFILE"
                                                                class="select2_dropdown w-100"
                                                                class="form-control p-0 users-input-S-C">
                                                                <option selected disabled></option>
                                                                @foreach ($profile->options as $profileOption)
                                                                    <option value="{{ $profileOption->id }}">
                                                                        {{ $profileOption->option_name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div>
                                                            <small class="text-danger"></small>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="form-group mb-0">
                                                            <label class="Label">
                                                                position applied
                                                            </label>
                                                            <input type="text" name="POSITION_TITLE_APPLIED"
                                                                class="form-control p-0 users-input-S-C" />
                                                        </div>
                                                        <div>
                                                            <small class="text-danger"></small>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="form-group mb-0">
                                                            <label class=" p-0 users-input-S-C mb-0"> Date Invited</label>
                                                            <input type="date" name="DATE_INVITED" disabled=""
                                                                id="date_invited"
                                                                class="form-control border h-px-20_custom" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mb-2">
                                                    <div class="col-lg-4">
                                                        <div class="form-group mb-0">
                                                            <?php
                                                            $manner_of_invite = Helper::get_dropdown('manner_of_invite');
                                                            ?>
                                                            <label class="Label">
                                                                Manner of invite
                                                            </label>
                                                            <select name="MANNER_OF_INVITE" onchange="mannerChange(this)"
                                                                id="manners" class="form-control p-0 users-input-S-C">
                                                                <option selected disabled></option>
                                                                @foreach ($manner_of_invite->options as $manner_of_inviteOption)
                                                                    <option value="{{ $manner_of_inviteOption->id }}">
                                                                        {{ $manner_of_inviteOption->option_name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div>
                                                            <small class="text-danger"></small>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="form-group mb-0">
                                                            <label class="Label">
                                                                Current Salary:
                                                            </label>
                                                            <input type="number" class="form-control p-0 users-input-S-C`"
                                                                id="current_salary" name="CURRENT_SALARY" />
                                                        </div>
                                                        <div>
                                                            <small class="text-danger"></small>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="form-group mb-0">
                                                            <label class="Label" name="CURRENT_ALLOWANCE">
                                                                Current Allowance:
                                                            </label>
                                                            <input type="number" class="form-control users-input-S-C"
                                                                name="CURRENT_ALLOWANCE" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mb-2">
                                                    <div class="col-lg-4">
                                                        <div class="form-group mb-0">
                                                            <label class="Label">
                                                                Expected Salary:
                                                            </label>
                                                            <input type="text" name="EXPECTED_SALARY" id="expec_salary"
                                                                class="form-control p-0 users-input-S-C" />
                                                        </div>
                                                        <div>
                                                            <small class="text-danger"></small>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="form-group mb-0">
                                                            <label class="Label" name="OFFERED_SALARY">
                                                                Offered Salary:
                                                            </label>
                                                            <input type="number" name="OFFERED_SALARY" id="off_salary"
                                                                disabled="" oninput="SalaryAppend('#remarks')"
                                                                class="form-control users-input-S-C" />
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="form-group mb-0">
                                                            <label class="Label">
                                                                Offered Allowance:
                                                            </label>
                                                            <input type="number" name="OFFERED_ALLOWANCE" id="off_allowance"
                                                                oninput="SalaryAppend('#remarks')" disabled=""
                                                                class="form-control users-input-S-C" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </fieldset>

                                            <div class="row">
                                                <div class="col-lg-6"></div>
                                                <div class="col-lg-6">
                                                    <div
                                                        class="d-flex w-100 flex-wrap gap-2 flex-column form-group col-md-12">
                                                        <div class="w-100"
                                                            style="text-align: end; margin-bottom: 6px;">
                                                            <input type="file" id="sheetFile" name="file" required=""
                                                                accept="application/pdf" class="uploadcv  w-100">
                                                        </div>
                                                        <div class="d-flex justify-flex-end"
                                                            style="justify-content: flex-end;">
                                                            <button type="button" btn_Group href=""
                                                                style=" pointer-events: none; cursor: default;">
                                                                Download Cv
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Candidate section end -->
                            <!-- ================== -->
                        </div>
                        <div class="col-lg-6">
                            <!-- ================== -->
                            <!-- ENDORSMENT section start -->
                            {{-- <fieldset disabled="false"> --}}
                            <p class="C-Heading">Endorsement Details</p>
                            <div class="card mb-10">
                                <div class="card-body pt-4">
                                    <div class="row mb-1">
                                        <div class="col-lg-6">
                                            <?php
                                            $status = Helper::get_dropdown('application_status');
                                            ?>
                                            <label class="d-block font-size-3 mb-0">
                                                Application Status
                                            </label>
                                            <select name="APPLICATION_STATUS" id="ap_status"
                                                onchange="ApplicationStatusChange(this)"
                                                class="form-control border pl-0 arrow-3 h-px-20_custom w-100 font-size-4 d-flex align-items-center w-100">
                                                <option value="" selected disabled>Select Option</option>
                                                @foreach ($status->options as $statusOptions)
                                                    <option value="{{ $statusOptions->id }}">
                                                        {{ $statusOptions->option_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group mb-0">
                                                @php
                                                    $remarks = Helper::get_dropdown('remarks_from_finance');
                                                @endphp
                                                <label class="Label">
                                                    Remarks (From Recruiter):
                                                </label>
                                                <select disabled="" name="REMARKS_FROM_FINANCE" id="remarks"
                                                    class="form-control border pl-0 arrow-3 h-px-20_custom w-100 font-size-4 d-flex align-items-center w-100">
                                                    <option value="" disabled selected>Select Option</option>
                                                    @foreach ($remarks->options as $remarksOptions)
                                                        <option value="{{ $remarksOptions->id }}">
                                                            {{ $remarksOptions->option_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <fieldset>
                                        <div class="row mb-1">
                                            <div class="col-lg-6">
                                                @php
                                                    $client = Helper::get_dropdown('clients');
                                                @endphp
                                                <div class="form-group mb-0">
                                                    <label class="Label">Client</label>
                                                    <select name="CLIENT" disabled="" id="client" onchange="clientChanged(this)"
                                                        class="form-control border pl-0 arrow-3 h-px-20_custom w-100 font-size-4 d-flex align-items-center select2_dropdown w-100">
                                                        <option value="" disabled selected>Select Option</option>
                                                        @foreach ($client->options as $clientOptions)
                                                            <option value="{{ $clientOptions->id }}">
                                                                {{ $clientOptions->option_name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group mb-0">
                                                    @php
                                                        $status = Helper::get_dropdown('status');
                                                    @endphp
                                                    <label class="d-block font-size-3 mb-0">
                                                        Status
                                                    </label>
                                                    <select name="STATUS" id="status" disabled=""
                                                        class="form-control border pl-0 arrow-3 h-px-20_custom w-100 font-size-4 d-flex align-items-center w-100">
                                                        <option value="" disabled selected>Select Option</option>
                                                        @foreach ($status->options as $statusOptions)
                                                            <option value="{{ $statusOptions->id }}">
                                                                {{ $statusOptions->option_name }}
                                                            </option>
                                                        @endforeach
                                                        &quot;item&quot;
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-1">
                                            <div class="col-lg-6">
                                                <div class="form-group mb-0">
                                                    @php
                                                        $endoType = Helper::get_dropdown('endorsement_type');
                                                    @endphp
                                                    <label class="d-block font-size-3 mb-0">
                                                        Endorsement Type:
                                                    </label>
                                                    <select name="ENDORSEMENT_TYPE" id=""
                                                        class="form-control border pl-0 arrow-3 h-px-20_custom w-100 font-size-4 d-flex align-items-center w-100">
                                                        <option value="" disabled selected>Select Option</option>
                                                        @foreach ($endoType->options as $endoTypeOptions)
                                                            <option value="{{ $endoTypeOptions->id }}">
                                                                {{ $endoTypeOptions->option_name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group mb-0">
                                                    @php
                                                        $site = Helper::get_dropdown('site');
                                                    @endphp
                                                    <label class="d-block font-size-3 mb-0">
                                                        Site:
                                                    </label>
                                                    <select name="SITE" disabled="" id="site"
                                                        class="form-control border pl-0 arrow-3 h-px-20_custom w-100 font-size-4 d-flex align-items-center w-100">
                                                        <option value="" disabled selected>Select Option</option>
                                                        @foreach ($site->options as $siteOptions)
                                                            <option value="{{ $siteOptions->id }}">
                                                                {{ $siteOptions->option_name }}
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
                                                        $position_title = Helper::get_dropdown('position_title');
                                                    @endphp
                                                    <label class="d-block font-size-3 mb-0">
                                                        Position Title:
                                                    </label>
                                                    <select name="POSITION_TITLE" disabled="" id="position"
                                                        class="select2_dropdown  w-100"
                                                        class="form-control border pl-0 arrow-3 h-px-20_custom w-100 font-size-4 d-flex align-items-center w-100">
                                                        <option value="" disabled selected>Select Option</option>
                                                        @foreach ($position_title->options as $position_titleOptions)
                                                            <option value="{{ $position_titleOptions->id }}">
                                                                {{ $position_titleOptions->option_name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group mb-0">
                                                    @php
                                                        $ReasonForNotP = Helper::get_dropdown('reason_for_not_progressing');
                                                    @endphp
                                                    <label class="Label">
                                                        Reason for not progressing:
                                                    </label>
                                                    <select name="REASONS_FOR_NOT_PROGRESSING" disabled="" id="rfp"
                                                        class="form-control border pl-0 arrow-3 h-px-20_custom w-100 font-size-4 d-flex align-items-center select2_dropdown w-100">
                                                        <option value="" disabled selected>Select Option</option>
                                                        @foreach ($ReasonForNotP->options as $ReasonForNotPOptions)
                                                            <option value="{{ $ReasonForNotPOptions->id }}">
                                                                {{ $ReasonForNotPOptions->option_name }}
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
                                                        $domain = Helper::get_dropdown('domains');
                                                    @endphp
                                                    <label class="d-block font-size-3 mb-0">
                                                        Domain
                                                    </label>
                                                    <select id="domain_endo" readonly name="DOMAIN_ENDORSEMENT"
                                                        onchange="DomainChange(this)"
                                                        class="form-control border pl-0 arrow-3 h-px-20_custom w-100 font-size-4 d-flex align-items-center w-100">
                                                        <option value="" disabled selected>Select Option</option>
                                                        {{-- @foreach ($domain->options as $domainOptions)
                                                            <option value="{{ $domainOptions->id }}">
                                                                {{ $domainOptions->option_name }}
                                                            </option>
                                                        @endforeach --}}
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group mb-0">
                                                    <label class="Label">Interview :</label>
                                                    <input type="date" name="INTERVIEW_SCHEDULE" disabled=""
                                                        id="interview_schedule" class="form-control users-input-S-C" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-1">
                                            <div class="col-lg-6">
                                                @php
                                                    $segments = Helper::get_dropdown('segments');
                                                @endphp
                                                <div class="form-group mb-0">
                                                    <label class="Label">Segment</label>
                                                    <select disabled="" id="segment" name="SEGMENT"
                                                        class="form-control border pl-0 arrow-3 h-px-20_custom w-100 font-size-4 d-flex align-items-center w-100">
                                                        <option value="" disabled selected>Select Option</option>
                                                        {{-- @foreach ($segments->options as $segmentsOptions)
                                                            <option value="{{ $segmentsOptions->id }}">
                                                                {{ $segmentsOptions->option_name }}
                                                            </option>
                                                        @endforeach --}}
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                @php
                                                    $CareerLevel = Helper::get_dropdown('career_level');
                                                @endphp
                                                <div class="form-group mb-0">
                                                    <label class="d-block font-size-3 mb-0">
                                                        Career Level:
                                                    </label>
                                                    <select name="CAREER_LEVEL" disabled="" id="career"
                                                        class="form-control border pl-0 arrow-3 h-px-20_custom w-100 font-size-4 d-flex align-items-center w-100">
                                                        <option value="" disabled selected>Select Option</option>
                                                        @foreach ($CareerLevel->options as $CareerLevelOptions)
                                                            <option value="{{ $CareerLevelOptions->id }}">
                                                                {{ $CareerLevelOptions->option_name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                @php
                                                    $sub_segment = Helper::get_dropdown('sub_segment');
                                                @endphp
                                                <div class="form-group mb-0">
                                                    <label class="Label">sub-segment</label>
                                                    <select disabled="" id="sub_segment" name="SUB_SEGMENT"
                                                        class="form-control border pl-0 arrow-3 h-px-20_custom w-100 font-size-4 d-flex align-items-center w-100">
                                                        <option value="" disabled selected>Select Option</option>
                                                        {{-- @foreach ($sub_segment->options as $sub_segmentOptions)
                                                            <option value="{{ $sub_segmentOptions->id }}">
                                                                {{ $sub_segmentOptions->option_name }}
                                                            </option>
                                                        @endforeach --}}
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group mb-0">
                                                    <div class="form-group mb-0">
                                                        <label class="d-block font-size-3 mb-0">
                                                            Endo Date:
                                                        </label>
                                                        <input type="date" name="DATE_ENDORSED" disabled="" id="endo_date"
                                                            onchange="setDate()"
                                                            class="form-control border h-px-20_custom" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-1">
                                            <div class="col-lg-6">
                                                <div class="form-group mb-0">
                                                    @php
                                                        $endoType = Helper::get_dropdown('endorsement_type');
                                                    @endphp
                                                    <label class="Label">
                                                        Remarks (For Finance):
                                                    </label>
                                                    <select name="REMARKS_FOR_FINANCE" disabled="" id="remarks_for_finance"
                                                        onchange="RemarksChange(this)" class="select2_dropdown  w-100"
                                                        class="form-control border pl-0 arrow-3 h-px-20_custom w-100 font-size-4 d-flex align-items-center w-100">
                                                        @php
                                                            $remarks = Helper::get_dropdown('remarks_for_finance');
                                                        @endphp
                                                        <option value="" disabled selected>Select Option</option>
                                                        @foreach ($remarks->options as $remarksOptions)
                                                            <option value="{{ $remarksOptions->id }}">
                                                                {{ $remarksOptions->option_name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-6"></div>
                                        </div>
                                    </fieldset>
                                </div>
                            </div>
                            {{-- </fieldset> --}}

                            <!-- ENDORSMENT section end -->
                            <!-- ================== -->

                            <!-- ================== -->
                            <!-- FINANCE section start -->
                            <div class="mt-4">
                                <fieldset id="finance_fieldset" disabled="">
                                    <p class="C-Heading">Finance Reference</p>
                                    <div class="card">
                                        <div class="card-body pt-2">
                                            <fieldset>
                                                <div class="row mb-6">
                                                    <div class="col-lg-6">
                                                        <div class="form-group mb-0">
                                                            @php
                                                                $remarks = Helper::get_dropdown('remarks_from_finance');
                                                            @endphp
                                                            <label class="d-block font-size-3 mb-0">
                                                                Remarks For Recruiter
                                                            </label>
                                                            <select name="REMARKS" id="remarks_finance"
                                                                class="form-control border pl-0 arrow-3 h-px-20_custom w-100 font-size-4 d-flex align-items-center w-100">
                                                                <option value="" disabled selected></option>
                                                                @foreach ($remarks->options as $remarksOptions)
                                                                    <option value="{{ $remarksOptions->id }}">
                                                                        {{ $remarksOptions->option_name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group mb-0">
                                                            <label class="d-block font-size-3 mb-0">
                                                                Onboarding Date
                                                            </label>
                                                            <input type="date" name="ONBOARDING_DATE" id="onboard_date"
                                                                readonly class="form-control border h-px-20_custom" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mb-6">
                                                    <div class="col-lg-6">
                                                        <div class="form-group mb-0">
                                                            <label class="d-block font-size-3 mb-0">
                                                                Standard Project Reveneu
                                                            </label>
                                                            <input type="number" name="STANDARD_PROJECTED_REVENUE" id="srp"
                                                                class="form-control h-px-20_custom" readonly />
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group mb-0">
                                                            <label class="d-block font-size-3 mb-0">
                                                                Invoice Number
                                                            </label>
                                                            <input type="number" name="INVOICE_NUMBER" id="invoice_number"
                                                                class="form-control border h-px-20_custom" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mb-6">
                                                    <div class="col-lg-6">
                                                        <div class="form-group mb-0">
                                                            @php
                                                                $client = Helper::get_dropdown('clients');
                                                            @endphp
                                                            <label class="d-block font-size-3 mb-0">
                                                                client
                                                            </label>
                                                            <select name="CLIENT_FINANCE"
                                                                class="form-control border h-px-20_custom w-100"
                                                                id="client_finance" disabled="">
                                                                <option value="" disabled selected>Select Option</option>
                                                                {{-- @foreach ($client->options as $clientOptions)
                                                                    <option value="{{ $clientOptions->id }}">
                                                                        {{ $clientOptions->option_name }}
                                                                    </option>
                                                                @endforeach --}}
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group mb-0">
                                                            <label class="d-block font-size-3 mb-0">
                                                                Total Bilable Ammount
                                                            </label>
                                                            <input type="number" name="TOTAL_BILLABLE_AMOUNT"
                                                                id="bilable_amount" oninput="amountFinder(this)"
                                                                class="form-control border h-px-20_custom" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mb-6">
                                                    <div class="col-lg-6">
                                                        <div class="form-group mb-0">
                                                            @php
                                                                $careerLevel = Helper::get_dropdown('career_level');
                                                            @endphp
                                                            <label class="d-block font-size-3 mb-0">
                                                                Career level
                                                            </label>
                                                            <select name="CAREER_LEVEL_FINANCE" required=""
                                                                id="career_finance" onchange="SPRCalculator(this)"
                                                                class="form-control border h-px-20_custom">
                                                                <option value="" disabled selected>Select Option</option>
                                                                @foreach ($careerLevel->options as $careerLevelOptions)
                                                                    <option value="{{ $careerLevelOptions->id }}">
                                                                        {{ $careerLevelOptions->option_name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group mb-0">
                                                            <label class="d-block font-size-3 mb-0">
                                                                Rate
                                                            </label>
                                                            <select name="RATE" class="form-control border h-px-20_custom"
                                                                id="rate" id="rate_finance" oninput="amountFinder(this)">
                                                                <option value="10" selected>10%</option>
                                                                <option value="30">30 %</option>
                                                                <option value="40">40 %</option>
                                                                <option value="50">50 %</option>
                                                                <option value="60">60 %</option>
                                                                <option value="70">70 %</option>
                                                                <option value="80">80 %</option>
                                                                <option value="90">90 %</option>
                                                                <option value="100">100 %</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mb-6">
                                                    <div class="col-lg-6">
                                                        <div class="form-group mb-0">
                                                            <label class="d-block font-size-3 mb-0">
                                                                Offered Salary
                                                            </label>
                                                            <input type="number" name="OFFERED_SALARY"
                                                                id="off_salary_fianance" readonly
                                                                class="form-control border h-px-20_custom" />
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group mb-0">
                                                            <label class="d-block font-size-3 mb-0">
                                                                Placement Fee
                                                            </label>
                                                            <input type="number" name="PLACEMENT_FEE" id="placement_fee"
                                                                readonly class="form-control border h-px-20_custom" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mb-9">
                                                    <div class="col-lg-6">
                                                        <div class="form-group mb-0">
                                                            <label class="d-block font-size-3 mb-0">
                                                                Allowance
                                                            </label>
                                                            <input type="number" name="ALLOWANCE" id="off_allowance_finance"
                                                                readonly class="form-control border h-px-20_custom" />
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6"></div>
                                                </div>
                                            </fieldset>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                            <!-- FINANCE section end -->
                            <!-- ================== -->
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

@endsection


@section('script')
    <script src="{{ asset('assets/js/data-entry.js') }}"></script>
    <script>
        // Seciton loads on document ready starts
        // $(document).ready(function() {
        //     ready();
        // });
        $('#segment').empty();
        select2Dropdown("select2_dropdown");
        $('#new').prop("disabled", true);
        $('#COURSE').prop("disabled", true);
        // On form submit call ajax for data saving

        function CreateUpdateData(targetURL) {
            if (targetURL == '{{ url('admin/update-data-entry') }}') {
                id = $('#user').val();
                // targetURL = '{{ url('update-data-entry') }}'
                targetURL = targetURL + '/' + id
            }
            $("#loader").show();

            // making a variable containg all for data and append token
            var data = new FormData(document.getElementById('data_entry'));
            data.append("_token", "{{ csrf_token() }}");

            // call ajax for data entry ad validation
            $.ajax({
                url: targetURL,
                data: data,
                contentType: false,
                processData: false,
                type: 'POST',

                // Ajax success function
                success: function(res) {
                    if (res.success == true) {

                        // show success sweet alert and enable entering new record button
                        $('#new').prop("disabled", false);
                        swal("success", res.message, "success").then((value) => {});
                    } else if (res.success == false) {

                        // show validation error on scree with border color changed and text
                        if (res.hasOwnProperty("message")) {
                            var err = "";
                            $("input").parent().siblings('span').remove();
                            $("input").css('border-color', '#ced4da');

                            //function for appending span and changing css color for input
                            $.each(res.message, function(i, e) {
                                $("input[name='" + i + "']").css('border-color',
                                    'red');
                                $("input[name='" + i + "']").parent().siblings(
                                    'span').remove();
                                $("input[name='" + i + "']").parent().parent()
                                    .append(
                                        '<span style="color:red;" >' + e + '</span>'
                                    );
                            });

                            // show warning message to user if firld is required
                            swal({
                                icon: "error",
                                text: "{{ __('Please fix the highlighted errors!') }}",
                                icon: "error",
                            });
                        }

                        //if duplicate values are detected in database for use data
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
            return false;
        }
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function DownloadCV(elem) {
            id = $('#user').val();
            targetURL = '{{ url('admin/download_cv') }}'
            targetURL = targetURL + '/' + id
            $.ajax({
                url: targetURL,
                data: id,
                contentType: false,
                processData: false,
                type: 'POST',

                // Ajax success function
                success: function(res) {
                    if (res.success == true) {

                        // show success sweet alert and enable entering new record button
                        $('#new').prop("disabled", false);
                        swal("success", res.message, "success").then((value) => {});
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
            return false;
        }

        // function for (if domain is changed append segments acoordingly) starts
        function DomainChange(elem) {
            $('#Domainsub').empty()
            $('#sub_segment').empty()
            $('#Domainsegment').empty()
            $('#segment').empty()
            var selected = $('#domain').find(":selected").text().trim();
            $('#domain_endo').html('<option>' + selected + '</option>');
            var domains = {!! $domainDrop !!};
            var segmentsDropDown = {!! $segmentsDropDown !!};
            var count = 0;
            for (let i = 0; i < segmentsDropDown.length; i++) {
                if ($(elem).val() == segmentsDropDown[i].domain_id) {
                    count++;
                    $('#Domainsegment').append('<option value="' + segmentsDropDown[i].id + '">' + segmentsDropDown[i]
                        .segment_name +
                        '</option>');

                    $('#segment').append('<option value="' + segmentsDropDown[i].id + '">' + segmentsDropDown[i]
                        .segment_name +
                        '</option>');
                }
            }
        }
        // function for (if domain is changed append segments acoordingly) starts

        // function for (if segment is changed append segments acoordingly) starts
        function SegmentChange(elem) {
            $('#Domainsub').empty()
            $('#sub_segment').empty()
            var sub_segmentsDropDown = {!! $sub_segmentsDropDown !!};
            var count = 0;
            for (let i = 0; i < sub_segmentsDropDown.length; i++) {
                if ($(elem).val() == sub_segmentsDropDown[i].segment_id) {
                    count++;
                    $('#Domainsub').append('<option value="' + sub_segmentsDropDown[i].id + '">' + sub_segmentsDropDown[i]
                        .sub_segment_name +
                        '</option>');
                    $('#sub_segment').append('<option value="' + sub_segmentsDropDown[i].id + '">' + sub_segmentsDropDown[i]
                        .sub_segment_name +
                        '</option>');
                }
            }
        }
        // function for (if segment is changed append segments acoordingly) ends

        // apppending endorsements segments starts
        $('#segment').change(function() {
            $('#sub_segment').empty()
            var sub_segmentsDropDown = {!! $sub_segmentsDropDown !!};
            var count = 0;
            for (let i = 0; i < sub_segmentsDropDown.length; i++) {
                if ($(this).val() == sub_segmentsDropDown[i].segment_id) {
                    count++;
                    $('#sub_segment').append('<option value="' + sub_segmentsDropDown[i].id + '">' +
                        sub_segmentsDropDown[i]
                        .sub_segment_name +
                        '</option>');
                }
            }
        });
        // apppending endorsements segments ends
        
    </script>
@endsection
