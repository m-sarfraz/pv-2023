@extends('layouts.app')

@section('style')

@endsection


@section('content')
    <div class="container-fluid">
        <form id="data_entry" method="post">
            <div class="row d-E-Row mb-6">
                @csrf
                <div class="col-lg-7">
                    <!-- ================== -->
                    <!-- Candidate section start -->
                    <div class="row">
                        <div class="col-lg-3">
                            <p class="C-Heading">Command</p>
                            <div class="card">
                                <div class="card-body p-0">
                                    <div class="form-group">
                                        <label class="d-block text-black-2 font-size-3 font-weight-semibold mb-0">
                                            User&#x27;s Name
                                        </label>
                                        <input type="email" disabled="" class="form-control users-input m-3 mt-0 w-75"
                                            style="padding-left: 12px !important;" aria-describedby="emailHelp"
                                            placeholder="enter candidate name" />
                                    </div>
                                    <div class="d-grid gap-2 form-group col-md-12">
                                        <button class="btn btn_Group mb-4 btn-sm" type="button" id="new">
                                            New Record
                                        </button>
                                        <button class="btn btn_Group mb-4 btn-sm" type="submit" id="save">
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
                                        <button class="btn btn_Group mb-4 btn-sm" type="button">
                                            Search Record
                                        </button>
                                        <button class="btn btn_Group mb-4 btn-sm" type="button">
                                            Edit Record
                                        </button>
                                        <button disabled="" class="btn btn_Group mb-4 btn-sm" type="button">
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
                        <div class="col-lg-9">
                            <p class="C-Heading">Sourcing &amp; Demographics</p>
                            <div class="card">
                                <div class="card-body pt-4">
                                    <fieldset>
                                        <div class="row mb-2">
                                            <div class="col-lg-4">
                                                <div class="form-group mb-0">
                                                    <label class="Label">*Last Name:</label>
                                                    <input type="text" class="form-control users-input-S-C" name="LAST_NAME"
                                                        required="" />
                                                </div>
                                                <div><small class="___class_+?36___"></small></div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group mb-0">
                                                    <label class="Label">
                                                        Middle Initial
                                                    </label>
                                                    <input type="text" class="form-control users-input-S-C"
                                                        name="MIDDLE_NAME" required />
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
                                                    <label class="d-block font-size-3 mb-0">
                                                        Gender
                                                    </label>
                                                    <select name="GENDER"
                                                        class="form-control border pl-0 arrow-3 h-px-20_custom w-100 font-size-4 d-flex align-items-center w-100">
                                                        <option>Male</option>
                                                        <option>Female</option>
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
                                                    <input type="text" class="form-control EmailInput-F" name="RESIDENCE"
                                                        required="" />
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
                                                    <select name="EDUCATIONAL_ATTAINTMENT"
                                                        class=" form-control p-0 EmailInput-F" id="EDUCATIONAL_ATTAINTMENT">
                                                        <option value="Associate Course Graduate">Associate Course Graduate
                                                        </option>
                                                        <option value="Doctoriate">Doctoriate</option>
                                                        <option value="Graduate">Graduate</option>
                                                        <option value="High School Graduate">High School Graduate</option>
                                                        <option value="Masters">Masters</option>
                                                        <option value="MBA">MBA</option>
                                                        <option value="Senior High School Graduate">Senior High School
                                                            Graduate</option>
                                                        <option value="Undergraduate">Undergraduate</option>
                                                        <option value="Vocational">Vocational</option>
                                                    </select>
                                                    <div>
                                                        <small class="text-danger"></small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-5">
                                                <div class="form-group mb-0">
                                                    <label class="Label">Course</label>
                                                    <select name="COURSE" class="form-control p-0 users-input-S-C"
                                                        id="COURSE">
                                                        <option value="Humanities">Humanities</option>
                                                        <option value="Natural Sciences">Natural Sciences</option>
                                                        <option value="Social Sciences">Social Sciences</option>
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
                                                    <label class="Label">
                                                        CERTIFICATIONS
                                                    </label>
                                                    <input type="text" name="CERTIFICATIONS"
                                                        class="form-control border h-px-20_custom" required />
                                                </div>
                                            </div>
                                        </div>
                                        <hr class="mb-9" />
                                        <div class="row mb-6">
                                            <div class="col-lg-5">
                                                <label class="` Label">
                                                    Interview Notes
                                                </label>
                                                <textarea name="INTERVIEW_NOTES" rows="3" type="text"
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
                                                        <select name="DOMAIN" class="form-control p-0 users-input-S-C">
                                                            <option value="item">item</option>
                                                        </select>
                                                        <div>
                                                            <small class="text-danger"></small>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mb-xl-1 mb-9">
                                                    <div class="col-lg-6">
                                                        <label class="Label">segment</label>
                                                        <select name="SEGMENT" class="form-control p-0 users-input-S-C">
                                                            <option value="segment">
                                                                segment
                                                            </option>
                                                        </select>
                                                        <div>
                                                            <small class="text-danger"></small>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <label class="Label">sub-segment</label>
                                                        <select name="SUB_SEGMENT"
                                                            class="form-control p-0 users-input-S-C">
                                                            <option value="subSegment ">
                                                                subSegment
                                                            </option>
                                                        </select>
                                                        <div>
                                                            <small class="text-danger"></small>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mb-xl-1 mb-9">
                                                    <div class="col-lg-12">
                                                        <label
                                                            class="text-black-2 font-size-3 font-weight-semibold mb-0"></label>
                                                        <textarea name="EMPLOYMENT_HISTORY" rows="3" type="text"
                                                            class="form-control border E_HC h-px-20_custom"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-lg-4">
                                                <div class="form-group mb-0">
                                                    <label class="Label">
                                                        candidate profile
                                                    </label>
                                                    <select name="CANDIDATES_PROFILE"
                                                        class="form-control p-0 users-input-S-C">
                                                        <option value="1">item</option>
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
                                                    <label class="font-size-3 mb-0"></label>
                                                    <input type="date" name="DATE_INVITED"
                                                        class="form-control border h-px-20_custom" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-lg-4">
                                                <div class="form-group mb-0">
                                                    <label class="Label">
                                                        Manner of invite
                                                    </label>
                                                    <select name="MANNER_OF_INVITE"
                                                        class="form-control p-0 users-input-S-C">
                                                        <option value="1">item</option>
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
                                                        name="CURRENT_SALARY" />
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
                                                    <input type="text" name="EXPECTED_SALARY"
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
                                                    <input type="number" name="OFFERED_SALARY"
                                                        class="form-control users-input-S-C" />
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group mb-0">
                                                    <label class="Label">
                                                        Offered Allowance:
                                                    </label>
                                                    <input type="number" name="OFFERED_ALLOWANCE"
                                                        class="form-control users-input-S-C" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6"></div>
                                            <div class="col-lg-6">
                                                <div
                                                    class="d-flex w-100 flex-wrap gap-2 flex-column form-group mt-5 col-md-12">
                                                    <div style="text-align: end; margin-bottom: 6px;"
                                                        class="w-100"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <button>Download Results</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Candidate section end -->
                    <!-- ================== -->
                </div>
                <div class="col-lg-5">
                    <!-- ================== -->
                    <!-- ENDORSMENT section start -->
                    <fieldset disabled="">
                        <p class="C-Heading">Endorsement Details</p>
                        <div class="card mb-10">
                            <div class="card-body pt-4">
                                <div class="row mb-1">
                                    <div class="col-lg-6">
                                        <label class="d-block font-size-3 mb-0">
                                            Application Status
                                        </label>
                                        <select name="APPLICATION_STATUS"
                                            class="form-control border pl-0 arrow-3 h-px-20_custom w-100 font-size-4 d-flex align-items-center w-100">
                                            <option value="item">item</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group mb-0">
                                            <label class="Label">
                                                Remarks (From Recruiter):
                                            </label>
                                            <select disabled="" name="REMARKS_FROM_FINANCE"
                                                class="form-control border pl-0 arrow-3 h-px-20_custom w-100 font-size-4 d-flex align-items-center w-100">
                                                <option value="item">item</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <fieldset disabled="">
                                    <div class="row mb-1">
                                        <div class="col-lg-6">
                                            <div class="form-group mb-0">
                                                <label class="Label">Client</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group mb-0">
                                                <label class="d-block font-size-3 mb-0">
                                                    Status:
                                                </label>
                                                <select name="STATUS"
                                                    class="form-control border pl-0 arrow-3 h-px-20_custom w-100 font-size-4 d-flex align-items-center w-100">
                                                    <option value="item">
                                                        &quot;item&quot;
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-1">
                                        <div class="col-lg-6">
                                            <div class="form-group mb-0">
                                                <label class="d-block font-size-3 mb-0">
                                                    Endorsement Type:
                                                </label>
                                                <select name="ENDORSEMENT_TYPE"
                                                    class="form-control border pl-0 arrow-3 h-px-20_custom w-100 font-size-4 d-flex align-items-center w-100">
                                                    <option value="item">item</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group mb-0">
                                                <label class="d-block font-size-3 mb-0">
                                                    Site:
                                                </label>
                                                <select name="SITE"
                                                    class="form-control border pl-0 arrow-3 h-px-20_custom w-100 font-size-4 d-flex align-items-center w-100">
                                                    <option value="item">item</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-1">
                                        <div class="col-lg-6">
                                            <div class="form-group mb-0">
                                                <label class="d-block font-size-3 mb-0">
                                                    Position Title:
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group mb-0">
                                                <label class="Label">
                                                    Reason for not progressing:
                                                </label>
                                                <select name="REASONS_FOR_NOT_PROGRESSING" disabled=""
                                                    class="form-control border pl-0 arrow-3 h-px-20_custom w-100 font-size-4 d-flex align-items-center w-100">
                                                    <option value="item">item</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-1">
                                        <div class="col-lg-6">
                                            <div class="form-group mb-0">
                                                <label class="d-block font-size-3 mb-0">
                                                    Domain
                                                </label>
                                                <select
                                                    class="form-control border pl-0 arrow-3 h-px-20_custom w-100 font-size-4 d-flex align-items-center w-100">
                                                    <option value="item">item</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group mb-0">
                                                <label class="Label">Interview :</label>
                                                <input type="date" name="INTERVIEW_SCHEDULE" disabled=""
                                                    class="form-control users-input-S-C" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-1">
                                        <div class="col-lg-6">
                                            <div class="form-group mb-0">
                                                <label class="Label">Segment</label>
                                                <select
                                                    class="form-control border pl-0 arrow-3 h-px-20_custom w-100 font-size-4 d-flex align-items-center w-100">
                                                    <option value="segment">segment</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group mb-0">
                                                <label class="d-block font-size-3 mb-0">
                                                    Career Level:
                                                </label>
                                                <select name="CAREER_LEVEL"
                                                    class="form-control border pl-0 arrow-3 h-px-20_custom w-100 font-size-4 d-flex align-items-center w-100">
                                                    <option value="item">item</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group mb-0">
                                                <label class="Label">sub-segment</label>
                                                <select
                                                    class="form-control border pl-0 arrow-3 h-px-20_custom w-100 font-size-4 d-flex align-items-center w-100">
                                                    <option value="subSegment">
                                                        subSegment
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group mb-0">
                                                <div class="form-group mb-0">
                                                    <label class="d-block font-size-3 mb-0">
                                                        Endo Date:
                                                    </label>
                                                    <input type="date" name="DATE_ENDORSED"
                                                        class="form-control border h-px-20_custom" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-1">
                                        <div class="col-lg-6">
                                            <div class="form-group mb-0">
                                                <label class="Label">
                                                    Remarks (For Finance):
                                                </label>
                                                <select name="REMARKS_FOR_FINANCE"
                                                    class="form-control border pl-0 arrow-3 h-px-20_custom w-100 font-size-4 d-flex align-items-center w-100">
                                                    <option value="item">item</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6"></div>
                                    </div>
                                </fieldset>
                            </div>
                        </div>
                    </fieldset>

                    <!-- ENDORSMENT section end -->
                    <!-- ================== -->

                    <!-- ================== -->
                    <!-- FINANCE section start -->
                    <div class="mt-4">
                        <fieldset disabled="">
                            <p class="C-Heading">Finance Reference</p>
                            <div class="card">
                                <div class="card-body pt-2">
                                    <fieldset disabled="">
                                        <div class="row mb-6">
                                            <div class="col-lg-6">
                                                <div class="form-group mb-0">
                                                    <label class="d-block font-size-3 mb-0">
                                                        Remarks For Recruiter
                                                    </label>
                                                    <select name="REMARKS" disabled=""
                                                        class="form-control border pl-0 arrow-3 h-px-20_custom w-100 font-size-4 d-flex align-items-center w-100">
                                                        <option value="item">item</option>
                                                        ;
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group mb-0">
                                                    <label class="d-block font-size-3 mb-0">
                                                        Onboarding Date
                                                    </label>
                                                    <input type="date" name="ONBOARDING_DATE"
                                                        class="form-control border h-px-20_custom" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-6">
                                            <div class="col-lg-6">
                                                <div class="form-group mb-0">
                                                    <label class="d-block font-size-3 mb-0">
                                                        Standard Project Reveneu
                                                    </label>
                                                    <input type="number" name="STANDARD_PROJECTED_REVENUE" disabled=""
                                                        class="form-control h-px-20_custom" />
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group mb-0">
                                                    <label class="d-block font-size-3 mb-0">
                                                        Invoice Number
                                                    </label>
                                                    <input type="number" name="INVOICE_NUMBER"
                                                        class="form-control border h-px-20_custom" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-6">
                                            <div class="col-lg-6">
                                                <div class="form-group mb-0">
                                                    <label class="d-block font-size-3 mb-0">
                                                        client
                                                    </label>
                                                    <select name="CLIENT" class="form-control border h-px-20_custom">
                                                        <option value="item">item</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group mb-0">
                                                    <label class="d-block font-size-3 mb-0">
                                                        Total Bilable Ammount
                                                    </label>
                                                    <input type="number" name="TOTAL_BILLABLE_AMOUNT"
                                                        class="form-control border h-px-20_custom" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-6">
                                            <div class="col-lg-6">
                                                <div class="form-group mb-0">
                                                    <label class="d-block font-size-3 mb-0">
                                                        Career level
                                                    </label>
                                                    <select name="CAREER_LEVEL" required=""
                                                        class="form-control border h-px-20_custom">
                                                        <option value="itemCode">item</option>

                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group mb-0">
                                                    <label class="d-block font-size-3 mb-0">
                                                        Rate
                                                    </label>
                                                    <select name="RATE" class="form-control border h-px-20_custom">
                                                        <option value="item">item</option>
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
                                                        class="form-control border h-px-20_custom" />
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group mb-0">
                                                    <label class="d-block font-size-3 mb-0">
                                                        Placement Fee
                                                    </label>
                                                    <input type="number" name="PLACEMENT_FEE"
                                                        class="form-control border h-px-20_custom" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-9">
                                            <div class="col-lg-6">
                                                <div class="form-group mb-0">
                                                    <label class="d-block font-size-3 mb-0">
                                                        Allowance
                                                    </label>
                                                    <input type="number" name="ALLOWANCE"
                                                        class="form-control border h-px-20_custom" />
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
        </form>
    </div>

@endsection


@section('script')

    <script>
        $(document).ready(function() {
            $('#new').prop("disabled", true);
            $('#COURSE').prop("disabled", true);
            $('#new').click(function() {
                $(this).closest('form').find(':input').val("");
            });
            $('#data_entry').submit(function() {
                $("#loader").show();
                var data = new FormData(this);
                data.append("_token", "{{ csrf_token() }}");
                $.ajax({
                    url: "{{ Route('save-data-entry') }}",
                    data: data,
                    contentType: false,
                    processData: false,
                    type: 'POST',
                    success: function(res) {
                        console.log(res)
                        if (res.success == true) {
                            $('#new').prop("disabled", false);
                            swal("success", res.message, "success").then((value) => {
                                // location.reload();
                            });
                        } else {

                            if (res.hasOwnProperty("message")) {
                                var err = "";
                                $("input").parent().siblings('span').remove();
                                $("input").css('border-color', '#ced4da');
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
                                // var wrapper = document.createElement("div");
                                // $.each(res.message, function(i, e) {
                                //     err += "<p>" + e + "</p>";
                                // });
                                // wrapper.innerHTML = err;
                                swal({
                                    icon: "error",
                                    text: "{{ __('Please fix the highlighted errors!') }}",
                                    //content: wrapper,
                                    icon: "error",
                                });
                            }
                        }
                        $("#loader").hide();
                    },
                    error: function() {
                        $("#loader").hide();
                    }
                });
                return false;
            })
        });

        // Change course according to the selected education attainment 
        $('#EDUCATIONAL_ATTAINTMENT').change(function() {

            var value = $('#EDUCATIONAL_ATTAINTMENT').find(":selected").text();
            console.log(value);
            if (value == 'Graduate') {
                $('#COURSE').prop("disabled", true);
            } else {
                $('#COURSE').prop("disabled", false);

            }
        });
    </script>

@endsection
