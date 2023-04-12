@extends('layouts.app')

@section('style')
    <style>
        .borderRed {
            border: 1px red solid !important;
        }

        #QrCode svg {
            width: 100% !important;
        }

        .borderRed:focus {
            box-shadow: 0 0 0 0.05rem red !important;
        }

        .labeled {
            padding: 7px;

            display: initial;
            background: rgb(250, 250, 250);
            border: 1px solid black;
            color: black;
            width: 100%;
            border-radius: 5px;
        }

        .text-merge-input {
            margin-right: 10px;
        }

        .demo-css {
            display: none;
        }

        .scroll-left {
            overflow: hidden;
            position: relative;
            background-color: rgb(233 236 239);
        }

        .scroll-left p {
            position: absolute;
            width: 100%;
            height: 100%;
            white-space: nowrap;
            margin: 0;
            text-align: center;
            transform: translateX(100%);
            animation: scroll-left 17s linear infinite;
        }

        @keyframes scroll-left {
            0% {
                transform: translateX(10%);
            }

            100% {
                transform: translateX(-200%);
            }
        }

        #transparentDiv {
            width: 100vw;
            background: rgb(255 255 255 / 40%);
            position: fixed;
            z-index: +88;
            height: 100vh;
            top: 0;
        }
    </style>
@endsection


@section('content')
    <div class="container-fluid">
        <div id="loader"></div>
        <div id="transparentDiv"></div>
        <form id="data_entry" method="post">
            <div class="row d-E-Row mb-6">
                @csrf
                <div class="col-lg-2">
                    <p class="C-Heading">Command</p>
                    <div class="card">
                        <div class="card-body p-0">
                            <div class="form-group">

                                <label class="d-block text-black-2 font-size-3 font-weight-semibold mb-0 pl-3 pt-2">
                                    User&#x27;s Name
                                </label>
                                <input type="email" disabled="" class="form-control users-input m-3 mt-0 w-75"
                                    style="padding-left: 12px !important;" aria-describedby="emailHelp"
                                    value="{{ Auth::user()->name }}" placeholder="enter candidate name" />
                            </div>
                            <div class="d-grid gap-2 form-group col-md-12 ">
                                <button class="btn btn_Group mb-4 btn-sm" data-href="{{ url('/admin/data-entry') }}"
                                    type="button" id="new" onclick="newRecord(this)">
                                    New Record
                                </button>
                                @can('add-data')
                                    <button class="btn btn_Group mb-4 btn-sm" type="submit" id="save">
                                        Save Record
                                    </button>
                                @endcan
                            </div>
                        </div>
                    </div>
                    <p class="C-Heading mt-5">Candidate</p>
                    <div class="card position-relative">
                        <div id="loader1"></div>
                        <div class="card-body" style="display: flex; justify-content: center;">
                            <div class="form-group">
                                {{-- <label class="Label">Candidate:</label> --}}
                            </div>
                            <div class="form-group mb-8"></div>
                            <div class="d-grid gap-2 mb-4  form-group col-md-12 px-0">
                                <Select name="USERS" class="mb-4 select2_dropdown w-100" id="user"
                                    onchange="enableSearch('#searchRecord')">
                                    <option value="" {{ $candidateDetail == null ? 'selected' : '' }} disabled
                                        selected>
                                    </option>
                                    {{-- @foreach ($user as $key => $value)
                                        <option value="{{ $value->id }}">
                                            {{ $value->last_name }}
                                        </option>
                                    @endforeach --}}
                                </Select>
                                <div class="scroll-left form-control users-input mt-3 mb-4 w-100 text-center align-items-center"
                                    style="padding-left: 0px !important;padding-right: 0px !important;font-size:18px !important;line-height:0;"
                                    id="userDetailInput">
                                </div>
                                @can('search-data')
                                    <button class="btn btn_Group mb-4 mt-1 btn-sm" type="button" id="searchRecord"
                                        onclick="SearchUserData('{{ url('admin/SearchUserData') }}' , this,'#UserData_div')"
                                        disabled="">
                                        Search Record
                                    </button>
                                @endcan

                                @can('edit-data')
                                    <button disabled="" class="btn btn_Group mb-4 btn-sm" type="button" id="editRecord"
                                        onclick="EnableUserEdit(this,'{{ Auth::user()->agent }}')">
                                        Edit Record
                                    </button>
                                    <button disabled="" class="btn btn_Group mb-4 btn-sm" type="submit" id="saveRecord">Save
                                        Edit</button>
                                    <button disabled="" type="button"
                                        onclick="saveAsNewRecord('{{ url('admin/save-data-entry') }}')"
                                        class="btn btn_Group mb-1 btn-sm" type="submit" id="saveNewRecord">Save
                                        as New Record</button>
                                @endcan
                            </div>
                        </div>
                    </div>
                    <div class="form-group position-relative d-none" id="mainQRdiv">
                        <div id="loader5"></div>
                        <p class="C-Heading mt-5">QR Code:</p>

                        <a href="" class="position-relative" download="user" id=QrCode>
                            <img style=" " class="pl-sm-15" alt="" />
                        </a>
                    </div>
                </div>
                <div class="col-lg-10 col-md-9 col-sm-12 col-12">
                    <div class="row m-0" id="UserData_div">
                        <div class="col-lg-6">
                            <!-- ================== -->
                            <!-- Candidate section start -->
                            <div class="row">

                                <div class="col-lg-12 p-0">
                                    <p class="C-Heading">Sourcing &amp; Demographics</p>
                                    <div class="card">
                                        <div class="card-body pt-4">
                                            <fieldset class="w-100">
                                                <div class="row mb-2">
                                                    <div class="col-lg-4">
                                                        <div class="form-group mb-0">
                                                            <label class="Label labelFontSize">Last Name:<sup
                                                                    class="font-weight-bolder">*</sup></label>
                                                            <input type="text" class="form-control users-input-S-C"
                                                                name="LAST_NAME" id="last_name"
                                                                value="{{ $candidateDetail != null ? $candidateDetail->last_name : '' }}" />
                                                        </div>
                                                        <div><small class="___class_+?36___"></small></div>
                                                    </div>

                                                    <div class="col-lg-4">
                                                        <div class="form-group mb-0">
                                                            <label class="Label labelFontSize">First Name:<sup
                                                                    class="font-weight-bolder">*</sup></label>
                                                            <input type="text" class="form-control users-input-S-C"
                                                                value="{{ $candidateDetail != null ? $candidateDetail->first_name : '' }}"
                                                                name="FIRST_NAME" />
                                                        </div>
                                                        <div><small class="___class_+?45___"></small></div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="form-group mb-0">
                                                            <label class="Label labelFontSize">
                                                                Middle Initial
                                                            </label>
                                                            <input type="text" class="form-control users-input-S-C"
                                                                value="{{ $candidateDetail != null ? $candidateDetail->middle_name : '' }}"
                                                                name="MIDDLE_NAME" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mb-2">
                                                    <div class="col-lg-6">
                                                        <div class="form-group mb-0">
                                                            @php
                                                                $gender = Helper::get_dropdown('gender');
                                                            @endphp
                                                            <label class="d-block font-size-3 mb-0 labelFontSize">
                                                                Gender
                                                            </label>
                                                            <select name="GENDER"
                                                                class="form-control border pl-0 arrow-3 h-px-20_custom w-100 font-size-4 d-flex align-items-center w-100">
                                                                <option value=""
                                                                    {{ $candidateDetail == null ? 'selected' : '' }}
                                                                    {{ $candidateDetail == null ? 'selected' : '' }}
                                                                    disabled>Select Option</option>
                                                                @foreach ($gender->options as $genderOptions)
                                                                    <option value="{{ $genderOptions->option_name }}"
                                                                        {{ ($candidateDetail != null ? $candidateDetail->gender == $genderOptions->option_name : '') ? 'selected' : '' }}>
                                                                        {{ $genderOptions->option_name }}</option>
                                                                @endforeach
                                                            </select>
                                                            <div>
                                                                <small class="text-danger"></small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group mb-0">
                                                            <label class="d-block font-size-3 mb-0 labelFontSize">
                                                                DOB
                                                            </label>
                                                            <input type="date" name="DATE_OF_BIRTH"
                                                                placeholder="mm-dd-yyyy"
                                                                value="{{ $candidateDetail != null ? $candidateDetail->dob : '' }}"
                                                                class="form-control border h-px-20_custom" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mb-2">
                                                    <div class="col-lg-6">
                                                        <div class="form-group mb-0">
                                                            <label for="validationDefaultUsername "
                                                                class="mb-0 d-block font-size-3 mb-0 labelFontSize">
                                                                Email
                                                            </label>
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text EmailIcon"
                                                                        id="inputGroupPrepend2">
                                                                        <i class="bi bi-envelope"></i>
                                                                    </span>
                                                                </div>
                                                                <input type="text" class="form-control EmailInput-F"
                                                                    value="{{ $candidateDetail != null ? $candidateDetail->email : '' }}"
                                                                    name="EMAIL_ADDRESS" id="email" />
                                                            </div>
                                                        </div>
                                                        <div><small class="___class_+?64___"></small></div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group mb-0">
                                                            <label for="validationDefaultUsername"
                                                                class="mb-0 d-block font-size-3 mb-0 labelFontSize">
                                                                Contact
                                                            </label>
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text EmailIcon"
                                                                        id="inputGroupPrepend2">
                                                                        <i class="bi bi-telephone"></i>
                                                                    </span>
                                                                </div>
                                                                <input type="text" class="form-control EmailInput-F"
                                                                    value="{{ $candidateDetail != null ? $candidateDetail->phone : '' }}"
                                                                    name="CONTACT_NUMBER" />
                                                            </div>
                                                        </div>
                                                        <div><small class="___class_+?73___"></small></div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="form-group mb-0">
                                                            <label class="mb-0 d-block font-size-3 mb-0 labelFontSize">
                                                                Residence
                                                            </label>
                                                            {{-- <select name="RESIDENCE" class="form-control p-0 EmailInput-F">
                                                                <option value="item city">
                                                                    item city
                                                                </option>
                                                            </select> --}}
                                                            <input type="text" class="form-control EmailInput-F"
                                                                value="{{ $candidateDetail != null ? $candidateDetail->address : '' }}"
                                                                name="RESIDENCE" />
                                                            <div>
                                                                <small class="text-danger"></small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-7">
                                                        <div class="form-group pt-1 mb-0">
                                                            <label class="mb-0 d-block font-size-3 mb-0 labelFontSize">
                                                                Educational Attainment:
                                                            </label>
                                                            <?php
                                                            $eduAttainment = Helper::get_dropdown('educational_attainment');
                                                            ?>

                                                            <select name="EDUCATIONAL_ATTAINTMENT"
                                                                onchange="EducationalAttainChange(this)"
                                                                class=" form-control p-0 EmailInput-F"
                                                                id="EDUCATIONAL_ATTAINTMENT">
                                                                <option value=""
                                                                    {{ $candidateDetail == null ? 'selected' : '' }}
                                                                    disabled>Select Option</option>
                                                                @foreach ($eduAttainment->options as $eduAttainmentOptions)
                                                                    <option
                                                                        {{ ($candidateDetail != null ? strtolower($candidateDetail->educational_attain) == strtolower($eduAttainmentOptions->option_name) : '') ? 'selected' : '' }}
                                                                        value="{{ $eduAttainmentOptions->option_name }}">
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
                                                            <label class="Label labelFontSize">Course</label>
                                                            <?php
                                                            $course = Helper::get_dropdown('course');
                                                            ?>
                                                            <select name="COURSE"
                                                                class="form-control p-0 users-input-S-C select2_dropdown w-100"
                                                                value="{{ $candidateDetail != null ? $candidateDetail->course : '' }}"
                                                                id="COURSE">
                                                                <option value=""
                                                                    {{ $candidateDetail == null ? 'selected' : '' }}
                                                                    selected>Select Option</option>
                                                                @foreach ($course->options as $courseOptions)
                                                                    <option value="{{ $courseOptions->option_name }}"
                                                                        {{ ($candidateDetail != null ? strtolower($candidateDetail->course) == strtolower($courseOptions->option_name) : '') ? 'selected' : '' }}
                                                                        {{ ($candidateDetail != null ? strtolower($candidateDetail->educational_attain) == 'high school graduate' : '') ? 'disabled' : '' }}>
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
                                                            if ($candidateDetail != null) {
                                                                $arr = explode(',', $candidateDetail->certification);
                                                            }
                                                            ?>
                                                            <label class="Label labelFontSize">
                                                                Certifications
                                                            </label>
                                                            <select multiple name="CERTIFICATIONS[]"
                                                                class="form-control p-0 users-input-S-C select2_dropdown w-100"
                                                                value="{{ $candidateDetail != null ? $candidateDetail->certification : '' }}">
                                                                {{-- <option value="" {{ $candidateDetail == null ? 'selected' : ''}} selected disabled>Select Option</option> --}}
                                                                @foreach ($certificate->options as $certificateOption)
                                                                    <option value="{{ $certificateOption->option_name }}"
                                                                        @if ($candidateDetail != null) {{ in_array($certificateOption->option_name, $arr) ? 'selected' : '' }} @endif>
                                                                        {{ $certificateOption->option_name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr class="mb-9" />
                                                <div class="row m-0">
                                                    <div class="col-lg-6 col-md-6 col-sm-12 col-12 pl-0">
                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-12 p-0">
                                                            <div>
                                                                <label class="Label labelFontSize">
                                                                    Date Sifted:
                                                                </label>
                                                                <input type="date" name="DATE_SIFTED"
                                                                    placeholder="mm-dd-yyyy"
                                                                    value="{{ $candidateDetail != null ? $candidateDetail->date_shifted : '' }}"
                                                                    class="form-control users-input-S-C" />
                                                            </div>
                                                        </div>
                                                        {{-- <div>
                                                            <small class="text-danger"></small>
                                                        </div> --}}
                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-12 p-0">
                                                            <label class="Label labelFontSize">Domain</label>
                                                            <select name="DOMAIN" id="domain" disabled
                                                                onchange="DomainChange(this)"
                                                                class="form-control p-0 users-input-S-C">
                                                                <option value=""
                                                                    {{ $candidateDetail == null ? 'selected' : '' }}
                                                                    disabled>Select Option</option>
                                                                @foreach ($domainDrop as $domainOption)
                                                                    <option value="{{ $domainOption->domain_name }}"
                                                                        {{ ($candidateDetail != null ? $candidateDetail->domain == $domainOption->domain_name : '') ? 'selected' : '' }}>
                                                                        {{ $domainOption->domain_name }}</option>
                                                                @endforeach
                                                            </select>
                                                            <div>
                                                                <small class="text-danger"></small>
                                                            </div>
                                                            {{-- @dd($candidateDetail->segment) --}}

                                                        </div>
                                                        @php
                                                            $segments = App\Segment::get();
                                                        @endphp
                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-12 p-0">
                                                            <label class="Label labelFontSize">segment</label>
                                                            <select name="Domainsegment" id="Domainsegment"
                                                                onchange="SegmentChange('Domainsegment')" disabled
                                                                class="form-control p-0 users-input-S-C">
                                                                <option value=""
                                                                    {{ $candidateDetail == null ? 'selected' : '' }}
                                                                    disabled>Select Option</option>
                                                                @foreach ($segments as $segmentOption)
                                                                    <option value="{{ $segmentOption->segment_name }}"
                                                                        {{ $candidateDetail != null ? ($candidateDetail->segment == $segmentOption->segment_name ? 'selected' : '') : '' }}>
                                                                        {{ $segmentOption->segment_name }}</option>
                                                                @endforeach

                                                            </select>
                                                            <div>
                                                                <small class="text-danger"></small>
                                                            </div>
                                                        </div>
                                                        @php
                                                            $sub_segment = App\SubSegment::get();
                                                        @endphp
                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-12  p-0">

                                                            <label class="Label labelFontSize">sub-segment</label>
                                                            <select name="Domainsub" id="Domainsub" disabled
                                                                class="form-control p-0 users-input-S-C">
                                                                <option value=""
                                                                    {{ $candidateDetail == null ? 'selected' : '' }}
                                                                    disabled>Select Option</option>
                                                                @foreach ($sub_segment as $sub_segmentOption)
                                                                    <option
                                                                        value="{{ $sub_segmentOption->sub_segment_name }}"
                                                                        {{ $candidateDetail != null ? (str_replace(' ', '', strtolower($candidateDetail->sub_segment)) == str_replace(' ', '', strtolower($sub_segmentOption->sub_segment_name)) ? 'selected' : '') : '' }}>
                                                                        {{ $sub_segmentOption->sub_segment_name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            <div>
                                                                <small class="text-danger"></small>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-12  p-0">
                                                            <?php
                                                            // $profile = Helper::get_dropdown('candidates_profile');
                                                            $profile = App\Profile::select('c_profile_name', 'id')->get();
                                                            ?>
                                                            <div class="form-group mb-0">
                                                                <label class="Label labelFontSize">
                                                                    Candidate’s Profile
                                                                </label>
                                                                <select name="CANDIDATES_PROFILE" id="candidate_profile"
                                                                    onchange="traverseData()"
                                                                    class="select2_dropdown w-100"
                                                                    class="form-control p-0 users-input-S-C">
                                                                    <option value=""
                                                                        {{ $candidateDetail == null ? 'selected' : '' }}
                                                                        disabled>Select Option
                                                                    </option>
                                                                    @foreach ($profile as $profileOption)
                                                                        <option value="{{ $profileOption->id }}"
                                                                            {{ ($candidateDetail != null ? $candidateDetail->candidate_profile == $profileOption->c_profile_name : '') ? 'selected' : '' }}>
                                                                            {{ $profileOption->c_profile_name }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                                <div>
                                                                    <small class="text-danger"></small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-12  p-0">
                                                            <div class="form-group mb-0">
                                                                <label class="Label labelFontSize">
                                                                    position applied
                                                                </label>
                                                                <input type="text" name="POSITION_TITLE_APPLIED"
                                                                    value="{{ $candidateDetail != null ? $candidateDetail->position_applied : '' }}"
                                                                    class="form-control p-0 users-input-S-C" />
                                                            </div>
                                                            <div>
                                                                <small class="text-danger"></small>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-12  p-0">
                                                            <div class="form-group mb-0">
                                                                <?php
                                                                $manner_of_invite = Helper::get_dropdown('manner_of_invite');
                                                                ?>
                                                                <label class="Label labelFontSize">
                                                                    Manner of invite
                                                                </label>
                                                                <select name="MANNER_OF_INVITE"
                                                                    onchange="mannerChange(this)"
                                                                    value="{{ $candidateDetail != null ? $candidateDetail->manner_of_invite : '' }}"
                                                                    id="manners"
                                                                    class="form-control p-0 users-input-S-C">
                                                                    <option value=""
                                                                        {{ $candidateDetail == null ? 'selected' : '' }}
                                                                        disabled>Select Option
                                                                    </option>
                                                                    @foreach ($manner_of_invite->options as $manner_of_inviteOption)
                                                                        <option
                                                                            value="{{ $manner_of_inviteOption->option_name }}"
                                                                            {{ ($candidateDetail != null ? $candidateDetail->manner_of_invite == $manner_of_inviteOption->option_name : '') ? 'selected' : '' }}>
                                                                            {{ $manner_of_inviteOption->option_name }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                                <div>
                                                                    <small class="text-danger"></small>
                                                                </div>
                                                            </div>
                                                            <div class="form-group mb-0">
                                                                <?php
                                                                $source = Helper::get_dropdown('source');
                                                                ?>
                                                                <label class="Label labelFontSize">
                                                                    Source
                                                                </label>
                                                                <select name="SOURCE"
                                                                    value="{{ $candidateDetail != null ? $candidateDetail->source : '' }}"
                                                                    id="source"
                                                                    class="form-control p-0 users-input-S-C select2_dropdown w-100">
                                                                    <option value=""
                                                                        {{ $candidateDetail == null ? 'selected' : '' }}
                                                                        disabled>Select Option
                                                                    </option>
                                                                    @foreach ($source->options as $sourceOption)
                                                                        <option value="{{ $sourceOption->option_name }}"
                                                                            {{ ($candidateDetail != null ? $candidateDetail->source == $sourceOption->option_name : '') ? 'selected' : '' }}>
                                                                            {{ $sourceOption->option_name }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                                <div>
                                                                    <small class="text-danger"></small>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-12 p-0">
                                                            <label
                                                                class="text-black-2 font-size-3 labelFontSize font-weight-semibold mb-0">
                                                                Employment History</label>
                                                            <textarea name="EMPLOYMENT_HISTORY" rows="3" type="text" class="form-control border E_HCDataEntry">{{ $candidateDetail != null ? $candidateDetail->emp_history : '' }}</textarea>
                                                            <div></div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-12 col-12 plSM-0 pr-15  pr-0">
                                                        <label class="` Label labelFontSize">
                                                            Interview Notes
                                                        </label>
                                                        <textarea name="INTERVIEW_NOTES" rows="3" type="text" id="notes"
                                                            class="form-control border t-HC h-px-20_custom">{{ $candidateDetail != null ? $candidateDetail->interview_note : '' }}</textarea>
                                                        <div></div>
                                                        <div>
                                                        </div>
                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-12  p-0">
                                                            <div class="form-group mb-0">
                                                                <label class=" p-0  mb-0 labelFontSize"> Date
                                                                    Invited</label>
                                                                <input type="date" name="DATE_INVITED" disabled=""
                                                                    placeholder="mm-dd-yyyy"
                                                                    value="{{ $candidateDetail != null ? $candidateDetail->date_invited : '' }}"
                                                                    id="date_invited"
                                                                    class="form-control border h-px-20_custom" />
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-12 p-0">
                                                            <div class="form-group mb-0">
                                                                <label class="Label labelFontSize">
                                                                    Current Salary:
                                                                </label>
                                                                <input type="number" class="form-control users-input-S-C"
                                                                    value="{{ $candidateDetail != null ? $candidateDetail->curr_salary : '' }}"
                                                                    id="current_salary" name="CURRENT_SALARY" />
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-12  p-0">
                                                            <div class="col-lg-12 col-md-12 col-sm-12 col-12  p-0">
                                                                <div class="form-group mb-0">
                                                                    <label class="Label labelFontSize"
                                                                        name="CURRENT_ALLOWANCE">
                                                                        Current Allowance:
                                                                    </label>
                                                                    <input type="number"
                                                                        class="form-control users-input-S-C"
                                                                        value="{{ $candidateDetail != null ? $candidateDetail->curr_allowance : '' }}"
                                                                        name="CURRENT_ALLOWANCE" />
                                                                </div>
                                                            </div>
                                                            <div class="form-group mb-0">
                                                                <label class="Label labelFontSize">
                                                                    Expected Salary:
                                                                </label>
                                                                <input type="number" name="EXPECTED_SALARY"
                                                                    id="expec_salary"
                                                                    value="{{ $candidateDetail != null ? $candidateDetail->exp_salary : '' }}"
                                                                    class="form-control p-0 users-input-S-C" />
                                                            </div>
                                                        </div>


                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-12  p-0">
                                                            <div class="form-group mb-0">
                                                                <label class="Label labelFontSize" name="OFFERED_SALARY">
                                                                    Offered Salary:
                                                                </label>
                                                                <input type="number" name="OFFERED_SALARY" disabled
                                                                    id="off_salary"
                                                                    value="{{ $candidateDetail != null ? $candidateDetail->off_salary : '' }}"
                                                                     oninput="SalaryAppend('#remarks')"
                                                                    class="form-control users-input-S-C" />
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-12  p-0">
                                                            <div class="form-group mb-0">
                                                                <label class="Label labelFontSize">
                                                                    Offered Allowance:
                                                                </label>
                                                                <input type="number" name="OFFERED_ALLOWANCE" disabled
                                                                    id="off_allowance"
                                                                    value="{{ $candidateDetail != null ? $candidateDetail->off_allowance : '' }}"
                                                                    oninput="SalaryAppend('#remarks')"
                                                                    class="form-control users-input-S-C" />
                                                            </div>
                                                        </div>
                                                        <div class="row pt-4">

                                                            <div class="col-lg-12">
                                                                <div
                                                                    class="d-flex w-100 flex-wrap gap-2 flex-column form-group col-md-12">
                                                                    <div class="w-100"
                                                                        style="text-align: end; margin-bottom: 6px;">
                                                                        <span id="append-cv" class="text-merge-input">No
                                                                            Uploaded CV</span>
                                                                        <label class="labeled"> Upload
                                                                            <input type="file" id="sheetFile"
                                                                                name="file" oninput="uploadFile(this)"
                                                                                accept="application/pdf"
                                                                                class="uploadcv  demo-css  w-100">
                                                                        </label>


                                                                        <i class="bi bi-x-circle d-none" id="cross"
                                                                            onclick="emptyFileinput()"
                                                                            style="position: absolute;left: -7px; top:1px;color:red"></i>
                                                                    </div>
                                                                    @if ($candidateDetail != null && $candidateDetail->cv != null)
                                                                        <div class="d-flex justify-flex-end"
                                                                            style="justify-content: flex-end;">
                                                                            <i
                                                                                class="bi bi-paperclip d-flex align-items-center"></i>
                                                                            <span class="d-flex align-items-center">
                                                                                @if ($candidateDetail != null)
                                                                                    {{ $candidateDetail->first_name }}'s
                                                                                    Resume
                                                                                @endif
                                                                            </span>
                                                                            <a class="mt-2 ml-2 btn btn-success"
                                                                                type="button"
                                                                                style="border-color:#dc8627;border-radius:6%;background-color:#dc8627 !important"
                                                                                target="blank"
                                                                                href="{{ asset('assets/cv/' . $candidateDetail->cv) }}"
                                                                                {{-- onclick="downloadCv('{{ $user->cid }}' , '{{ url('admin/download_cv') }}' --}} )">Download
                                                                                CV</a>

                                                                        </div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </fieldset>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Candidate section end -->
                            <!-- ================== -->
                        </div>
                        <div class="col-lg-6 paddingZero mtSM-4">
                            <!-- ================== -->
                            <!-- ENDORSMENT section start -->
                            {{-- <fieldset disabled="false"> --}}
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="">
                                    <p class="C-Heading">Endorsement Details</p>
                                </div>
                                @if ($candidateDetail != null)
                                    <div class="mb-1">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <label class="d-block font-size-3 mb-0 labelFontSize px-2">Select
                                                    Endorsement #:
                                                </label>
                                            </div>
                                            <div>
                                                <select name="endo_number" id="no_endo"
                                                    onchange="selectEndoDetails(this)"
                                                    class="form-control border pl-0 arrow-3 h-px-20_custom w-100 font-size-4 d-flex align-items-center w-100">
                                                    @foreach ($number_of_endorsements as $value)
                                                        <option value="{{ $value->numberOfEndo }}" selected
                                                            {{-- {{ $i == $number ? 'selected' : '' }} --}}>
                                                            {{ $value->numberOfEndo }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>


                                    </div>
                                @endif

                            </div>
                            <div id="endorsements_detail_view">

                                <div id="loader3" style="display: none;"></div>
                                <div class="card mb-10">
                                    <div class="card-body pt-4">
                                        <div class="row mb-1">
                                            <div class="col-lg-6 ">
                                                <?php
                                                $status = Helper::get_dropdown('application_status');
                                                ?>
                                                <label class="d-block font-size-3 mb-0 labelFontSize">
                                                    Application Status
                                                </label>
                                                <select name="APPLICATION_STATUS" id="ap_status"
                                                    onchange="ApplicationStatusChange(this)"
                                                    class="form-control border pl-0 arrow-3 h-px-20_custom w-100 font-size-4 d-flex align-items-center w-100">
                                                    <option value="" selected disabled>Select Option</option>
                                                    @foreach ($status->options as $statusOptions)
                                                        <option value="{{ $statusOptions->option_name }}">
                                                            {{ $statusOptions->option_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <div>
                                                    <small class="text-danger"></small>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group mb-0">

                                                    <label class="d-block font-size-3 mb-0 labelFontSize">
                                                        Position Title:
                                                    </label>
                                                    <div id="loader2" class="d-none"></div>
                                                    <select name="POSITION_TITLE" disabled id="position" readonly
                                                        class="form-control border select2_dropdown  w-100 pl-0 arrow-3 h-px-20_custom w-100 font-size-4 d-flex align-items-center w-100">
                                                        {{-- <option value="" class="selectedOption" selected  disabled> Select Option
                                                        </option> --}}
                                                        <option value="" style="color:red !important" selected
                                                            disabled>
                                                            Select a Client First
                                                        </option>

                                                    </select>
                                                    <div>
                                                        <small class="text-danger"></small>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <!-- <fieldset> -->
                                        <div class="row  mb-1">
                                            <div class="col-lg-6">
                                                <div class="form-group mb-0">
                                                    @php
                                                        $endoType = Helper::get_dropdown('endorsement_type');
                                                    @endphp
                                                    <label class="d-block font-size-3 mb-0 labelFontSize">
                                                        Endorsement Type :
                                                    </label>
                                                    <select name="ENDORSEMENT_TYPE" id="endo_type" disabled=""
                                                        class="form-control border pl-0 arrow-3 h-px-20_custom w-100 font-size-4 d-flex align-items-center w-100">
                                                        <option value="" class="selectedOption" selected disabled>
                                                            Select
                                                            Option
                                                        </option>
                                                        @foreach ($endoType->options as $endoTypeOptions)
                                                            <option value="{{ $endoTypeOptions->option_name }}">
                                                                {{ $endoTypeOptions->option_name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <div>
                                                        <small class="text-danger"></small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                @php
                                                    $CareerLevel = Helper::get_dropdown('career_level');
                                                @endphp
                                                <div class="form-group mb-0">
                                                    <label class="d-block font-size-3 mb-0 labelFontSize">
                                                        Career Level:
                                                    </label>
                                                    <select name="CAREER_LEVEL" disabled="" id="career"
                                                        onchange="DomainSegmentAppend()"
                                                        class="form-control border pl-0 arrow-3 h-px-20_custom w-100 font-size-4 d-flex align-items-center w-100">
                                                        <option value="" style="color:red !important" selected
                                                            disabled>
                                                            Select a Position Title First
                                                        </option>
                                                        {{-- @foreach ($CareerLevel->options as $CareerLevelOptions)
                                                        <option value="{{ $CareerLevelOptions->option_name }}">

                                                            {{ $CareerLevelOptions->option_name }}
                                                        </option>
                                                    @endforeach --}}
                                                    </select>
                                                    <div>
                                                        <small class="text-danger"></small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row  mb-1">
                                            <div class="col-lg-6">
                                                <div class="form-group mb-0">
                                                    <div class="form-group mb-0">
                                                        <label class="d-block font-size-3 mb-0 labelFontSize">
                                                            Date Processed:
                                                        </label>
                                                        <input type="date" name="DATE_ENDORSED" disabled=""
                                                            id="endo_date" placeholder="mm-dd-yyyy"
                                                            onchange="changeOnboardingDate()"
                                                            class="form-control border h-px-20_custom" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group mb-0">
                                                    @php
                                                        $status = Helper::get_dropdown('data_entry_status');
                                                    @endphp
                                                    <label class="d-block font-size-3 mb-0 labelFontSize">
                                                        Status
                                                    </label>
                                                    <select name="STATUS" id="status" disabled=""
                                                        class="form-control border pl-0 arrow-3 h-px-20_custom w-100 font-size-4 d-flex align-items-center w-100">
                                                        <option class="selectedOption" selected disabled>Select Option
                                                        </option>
                                                        @foreach ($status->options as $statusOptions)
                                                            <option value="{{ $statusOptions->option_name }}">
                                                                {{ $statusOptions->option_name }}
                                                            </option>
                                                        @endforeach
                                                        &quot;item&quot;

                                                    </select>
                                                    <div>
                                                        <small class="text-danger"></small>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="row mb-1 align-items-center">
                                            <div class="col-lg-6">
                                                @php
                                                    $client = Helper::get_dropdown('clients');
                                                @endphp
                                                <div class="form-group mb-0 pt-1 selectTwoTopMinus">
                                                    <label class="Label labelFontSize">Client</label>
                                                    <select name="CLIENT" disabled="" id="client"
                                                        onchange="clientChanged('position-title',this)"
                                                        class="form-control border pl-0 arrow-3 h-px-20_custom w-100 font-size-4 d-flex align-items-center select2_dropdown w-100">
                                                        <option value="" class="selectedOption" selected disabled>
                                                            Select
                                                            Option
                                                        </option>
                                                        @foreach ($client->options as $clientOptions)
                                                            <option value="{{ $clientOptions->option_name }}">
                                                                {{ $clientOptions->option_name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <div>
                                                        <small class="text-danger"></small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group mb-0">
                                                    @php
                                                        $endoType = Helper::get_dropdown('endorsement_type');
                                                    @endphp
                                                    <label class="Label labelFontSize">
                                                        Remarks (For Finance):
                                                    </label>
                                                    <select name="REMARKS_FOR_FINANCE" disabled=""
                                                        id="remarks_for_finance" onchange="RemarksChange(this)"
                                                        class="form-control border pl-0 select2_dropdown  w-100 arrow-3 h-px-20_custom w-100 font-size-4 d-flex align-items-center w-100">

                                                        <option value="" selected id="selectedOption" disabled>
                                                            Select Option
                                                        </option>
                                                        {{-- @foreach ($remarks->options as $remarksOptions)
                                                            <option value="{{ $remarksOptions->option_name }}">

                                                                {{ $remarksOptions->option_name }}</option>
                                                        @endforeach --}}
                                                    </select>
                                                    <div>
                                                        <small class="text-danger"></small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-1 align-items-center">
                                            <div class="col-lg-6">
                                                <div class="form-group mb-0 pt-1">
                                                    @php
                                                        $site = Helper::get_dropdown('site');
                                                    @endphp
                                                    <label class="d-block font-size-3 mb-0 labelFontSize">
                                                        Site:
                                                    </label>
                                                    <select name="SITE" disabled="" id="site"
                                                        class="form-control border pl-0 arrow-3 h-px-20_custom   font-size-4 d-flex align-items-center select2_dropdown w-100">
                                                        <option value="" class="selectedOption" selected disabled>
                                                            Select
                                                            Option
                                                        </option>
                                                        @foreach ($site->options as $siteOptions)
                                                            <option value="{{ $siteOptions->option_name }}">

                                                                {{ $siteOptions->option_name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <div>
                                                        <small class="text-danger"></small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group mb-0 selectTwoTopMinus">
                                                    @php
                                                        $ReasonForNotP = Helper::get_dropdown('reason_for_not_progressing');
                                                    @endphp
                                                    <label class="Label labelFontSize">
                                                        Reason for not progressing:
                                                    </label>
                                                    <select name="REASONS_FOR_NOT_PROGRESSING" disabled=""
                                                        id="rfp"
                                                        class="form-control border pl-0 arrow-3 h-px-20_custom w-100 font-size-4 d-flex align-items-center select2_dropdown w-100">
                                                        <option value="" class="selectedOption" selected disabled>
                                                            Select
                                                            Option
                                                        </option>
                                                        @foreach ($ReasonForNotP->options as $ReasonForNotPOptions)
                                                            <option value="{{ $ReasonForNotPOptions->option_name }}">
                                                                {{ $ReasonForNotPOptions->option_name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <div>
                                                        <small class="text-danger"></small>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-6 d-none">
                                                <div class="form-group mb-0">
                                                    @php
                                                        $remarks = Helper::get_dropdown('remarks_from_finance');
                                                    @endphp
                                                    <label class="Label labelFontSize">
                                                        Remarks (From Recruiter):
                                                    </label>
                                                    <select disabled="" name="REMARKS_FROM_FINANCE" id="remarks"
                                                        class="form-control border pl-0 arrow-3 h-px-20_custom w-100 font-size-4 d-flex align-items-center w-100">
                                                        <option value="" class="selectedOption" selected disabled>
                                                            Select
                                                            Option
                                                        </option>
                                                        @foreach ($remarks->options as $remarksOptions)
                                                            <option value="{{ $remarksOptions->option_name }}">

                                                                {{ $remarksOptions->option_name }}
                                                            </option>
                                                        @endforeach
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
                                                        $domain = Helper::get_dropdown('domains');
                                                    @endphp
                                                    <label class="d-block font-size-3 mb-0 labelFontSize">
                                                        Domain
                                                    </label>
                                                    <select id="domain_endo" name="DOMAIN_ENDORSEMENT" readonly
                                                        onchange="endoDomainChange(this)"
                                                        class="form-control border pl-0 arrow-3 h-px-20_custom w-100 font-size-4 d-flex align-items-center w-100">
                                                        <option class="selectedOption" selected disabled>
                                                            Select Option</option>
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
                                            {{-- reason for not processing --}}
                                            <div class="col-lg-6">
                                                <div class="form-group mb-0 selectTwoTopMinus">
                                                    <label class="Label labelFontSize">Interview Date:</label>
                                                    <input type="date" name="INTERVIEW_SCHEDULE" disabled=""
                                                        placeholder="mm-dd-yyyy" id="interview_schedule"
                                                        class="form-control users-input-S-C" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-1">
                                            <div class="col-lg-6">
                                                @php
                                                    $segments = Helper::get_dropdown('segments');
                                                @endphp
                                                <div class="form-group mb-0 selectTwoTopMinus">
                                                    <label class="Label labelFontSize">Segment</label>
                                                    <select readonly id="segment" name="endo_SEGMENT"
                                                        onchange="endoSegmentChange(this)"
                                                        class="form-control border pl-0 arrow-3 h-px-20_custom w-100 font-size-4 d-flex align-items-center w-100">
                                                        <option class="selectedOption" selected disabled>
                                                            Select Option</option>
                                                        @foreach ($segmentsDropDown as $segmentsOptions)
                                                            <option value="{{ $segmentsOptions->id }}">
                                                                {{ $segmentsOptions->segment_name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <div>
                                                        <small class="text-danger"></small>
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- interview date --}}
                                        </div>

                                        <div class="row">
                                            {{-- sub segment --}}
                                            <div class="col-lg-6">
                                                @php
                                                    $sub_segment = Helper::get_dropdown('sub_segment');
                                                @endphp
                                                <div class="form-group mb-0 selectTwoTopMinus">
                                                    <label class="Label labelFontSize">sub-segment</label>
                                                    <select readonly id="sub_segment" name="Endo_SUB_SEGMENT"
                                                        class="form-control border pl-0 arrow-3 h-px-20_custom w-100 font-size-4 d-flex align-items-center w-100">
                                                        <option value="" class="selectedOption" selected disabled>
                                                            Select
                                                            Option
                                                        </option>
                                                        @foreach ($sub_segment->options as $sub_segmentOptions)
                                                            <option value="{{ $sub_segmentOptions->id }}">
                                                                {{ $sub_segmentOptions->sub_segment_name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <div>
                                                        <small class="text-danger"></small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>


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
                                                                <label class="d-block font-size-3 mb-0 labelFontSize">
                                                                    Remarks (from Finance)
                                                                </label>
                                                                <select name="REMARKS" id="remarks_finance"
                                                                    class="form-control border pl-0 arrow-3 h-px-20_custom w-100 font-size-4 d-flex align-items-center w-100">
                                                                    <option value="" class="selectedOption" selected
                                                                        disabled>
                                                                        Select Option</option>
                                                                    @foreach ($remarks->options as $remarksOptions)
                                                                        <option
                                                                            value="{{ $remarksOptions->option_name }}">
                                                                            {{ $remarksOptions->option_name }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                                <div>
                                                                    <small class="text-danger"></small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group mb-0">
                                                                <label class="d-block labelFontSize font-size-3 mb-0">
                                                                    Onboarding Date
                                                                </label>
                                                                <input type="date" name="ONBOARDING_DATE"
                                                                    id="onboard_date" placeholder="mm-dd-yyyy"
                                                                    class="form-control border h-px-20_custom" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-6">
                                                        <div class="col-lg-6">
                                                            <div class="form-group mb-0">
                                                                <label class="d-block labelFontSize font-size-3 mb-0">
                                                                    Standard Projected Revenue
                                                                </label>
                                                                <input type="number" name="STANDARD_PROJECTED_REVENUE"
                                                                    id="srp" class="form-control h-px-20_custom"
                                                                    readonly />
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group mb-0">
                                                                <label class="d-block labelFontSize font-size-3 mb-0">
                                                                    Invoice Number
                                                                </label>
                                                                <input type="number" name="INVOICE_NUMBER"
                                                                    id="invoice_number" readonly
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
                                                                <label class="d-block labelFontSize font-size-3 mb-0">
                                                                    client
                                                                </label>
                                                                <select name="CLIENT_FINANCE"
                                                                    class="form-control border h-px-20_custom w-100"
                                                                    id="client_finance" readonly>
                                                                    <option value="" class="selectedOption" selected
                                                                        disabled>
                                                                        Select Option</option>
                                                                    @foreach ($client->options as $clientOptions)
                                                                        <option value="{{ $clientOptions->option_name }}">
                                                                            {{ $clientOptions->option_name }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                                <div>
                                                                    <small class="text-danger"></small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group mb-0">
                                                                <label class="d-block labelFontSize font-size-3 mb-0">
                                                                    Total Billable Amount
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
                                                                <label class="d-block labelFontSize font-size-3 mb-0">
                                                                    Career level
                                                                </label>
                                                                <select name="CAREER_LEVEL_FINANCE" disabled=""
                                                                    readonly id="career_finance"
                                                                    onchange="SPRCalculator(this)"
                                                                    class="form-control border h-px-20_custom">
                                                                    <option value="" class="selectedOption" selected
                                                                        disabled>
                                                                        Select Option
                                                                    </option>
                                                                    @foreach ($CareerLevel->options as $CareerLevelOptions)
                                                                        <option
                                                                            value="{{ $CareerLevelOptions->option_name }}">

                                                                            {{ $CareerLevelOptions->option_name }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                                <div>
                                                                    <small class="text-danger"></small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group mb-0">
                                                                <label class="d-block font-size-3 mb-0 labelFontSize">
                                                                    Rate
                                                                </label>
                                                                <input type="text" name="RATE" id="rate"
                                                                    maxlength="6" oninput="amountFinder(this)"
                                                                    class="form-control border h-px-20_custom" />
                                                                {{-- <select name="RATE"
                                                                    class="form-control border h-px-20_custom" id="rate"
                                                                     oninput="amountFinder(this)">
                                                                    <option value="" class="selectedOption" selected
                                                                        disabled>
                                                                        Select Option</option>

                                                                    <option value="10">10%</option>
                                                                    <option value="20">20 %</option>
                                                                    <option value="30">30 %</option>
                                                                    <option value="40">40 %</option>
                                                                    <option value="50">50 %</option>
                                                                    <option value="60">60 %</option>
                                                                    <option value="70">70 %</option>
                                                                    <option value="80">80 %</option>
                                                                    <option value="90">90 %</option>
                                                                    <option value="100">100 %</option>
                                                                </select> --}}
                                                                <div>
                                                                    <small class="text-danger"></small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-6">
                                                        <div class="col-lg-6">
                                                            <div class="form-group mb-0">
                                                                <label class="d-block font-size-3 mb-0 labelFontSize">
                                                                    Offered Salary
                                                                </label>
                                                                <input type="number" name="OFFERED_SALARY_finance"
                                                                    id="off_salary_fianance" readonly
                                                                    class="form-control border h-px-20_custom" />
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group mb-0">
                                                                <label class="d-block font-size-3 mb-0 labelFontSize">
                                                                    Placement Fee
                                                                </label>
                                                                <input type="text" name="PLACEMENT_FEE"
                                                                    id="placement_fee"
                                                                    class="form-control border h-px-20_custom" readonly />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-9">
                                                        <div class="col-lg-6">
                                                            <div class="form-group mb-0">
                                                                <label class="d-block font-size-3 mb-0 labelFontSize">
                                                                    Allowance
                                                                </label>
                                                                <input type="number" name="ALLOWANCE"
                                                                    id="off_allowance_finance" readonly
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
                    </div>
                </div>
            </div>
        </form>
    </div>

@endsection


@section('script')
    <script src="{{ asset('assets/js/data-entry.js') }}"></script>
    <script src="{{ asset('assets/js/sweetalert2.all.min.js') }}"></script>
    <script src="https://unpkg.com/imask"></script>




    <script>
        function mask(id) {
            const elm = document.getElementById(id);
            const suffix = '%';
            const bypass = [9, 16, 17, 18, 36, 37, 38, 39, 40, 91, 92, 93];

            const saveValue = (data) => {
                elm.dataset.value = data;
            };

            const pureValue = () => {
                let value = elm.value.replace(/[^\d.-]/g, '');
                // value = parseFloat(value)
                console.log(value)
                return value || '';
            };

            const focusNumber = () => {
                elm.setSelectionRange(elm.dataset.value.length, elm.dataset.value.length);
            };

            elm.addEventListener('keyup', (e) => {
                if (bypass.indexOf(e.keyCode) !== -1) return;
                const pure = pureValue();
                saveValue(pure);

                if (!pure) {
                    elm.value = '';
                    return;
                }
                elm.value = pure + suffix;
                focusNumber();
            });
        }
        mask('rate');
        $("form#data_entry select").each(function() {
            $(this).attr('readonly') ? $(this).css('pointer-events', 'none') : ''
        });
        $(window).on('load', function() {

            {{ Artisan::call('optimize:clear') }}
            $('#loader').show();
            $('#no_endo').change();
            $('#saveRecord').prop("disabled", true)
            $('#userDetailInput').addClass('d-none')
            // enable / disable save edit button for record 
            if (window.location.href.indexOf("id") != -1) {
                if (($('#no_endo option').length) > 1) {
                    // $('#saveRecord').prop("disabled", false)
                } else {
                    $('#save').prop("disabled", true)
                }
                $('#saveNewRecord').prop("disabled", false)
            }
            // show trasnaprent div to avoid click 
            setTimeout(function() {
                $('#loader').hide();
                $('#transparentDiv').hide();
                // $('#loader1').hide();
            }, 10);
            getCandidateList();
            if (!$('#last_name').val()) {
                $("#date_invited").prop('disabled', true)
            } else {
                if ($('#manners').val() == 'Pending')
                    $("#date_invited").prop('disabled', true)
                else {
                    $("#date_invited").prop('disabled', false)
                }
            }
            // disable save button
            $('#save').prop('disabled', true);
            // show and hide loader after time set starts
            // show and hide loader after time set ends
            // check logged in user id and disable/enable fileds 
            var team_id = {!! Auth::user()->agent !!};
            if (team_id == 1) {
                $('#domain').prop('readonly', true)
                $('#Domainsegment').prop('readonly', true)
                $('#Domainsub').prop('readonly', true)
                // $('#candidate_profile').prop('disabled', true)
            }
            // close
        });

        //append all uiser to dropdown for of candidate list 
        function getCandidateList() {
            $.ajax({
                    type: "GET",
                    url: '{{ url('admin/get_candidateList') }}',
                })
                .done(function(res) {
                    // console.log(res)
                    for (let i = 0; i < res.length; i++) {
                        $('#user').append('<option value="' + res[i].id + '-' + res[i].number +
                            '">' + res[i].first_name + ' ' + res[i].last_name + '+' +
                            res[i].candidate_profile + '-' +
                            res[i].client + '-' +
                            res[i].position_title + '-' +
                            res[i].endi_date + '</option>')

                    }
                    // candidateRecruiter = "<?php echo isset($candidateDetail->origionalRecruiter) ? $candidateDetail->origionalRecruiter : ''; ?>";
                    // endoID = "<?php echo isset($candidateDetail->numberOfEndo) ? $candidateDetail->numberOfEndo : ''; ?>";
                    // loggedInRecruiter = "<?php echo Auth()->user()->id; ?>";
                    // // Get the URL search parameters
                    // var searchParams = new URLSearchParams(window.location.search);
                    // var idParam = searchParams.get('id');
                    // console.log('candidateRecruiter' + candidateRecruiter);
                    // console.log('loggedInRecruiter' + loggedInRecruiter);
                    // if (loggedInRecruiter == candidateRecruiter) {
                    //     candidateIDtoSelect = idParam + '-' + endoID;
                    //     console.log('candidateIDtoSelect' + candidateIDtoSelect);
                    //     $('#user').val(candidateIDtoSelect).trigger('change');
                    //     $('#searchRecord').click(); 
                    // } 
                    $('#loader1').hide()
                })
                .fail(function(err) {
                    console.log(err);
                });
        }
        //close 
        // on form submit  
        $("form :input").on('input', function() {
            if (window.location.href.indexOf("id") != -1) {
                $('#save').prop('disabled', true)
            } else {
                $('#save').prop('disabled', false)

            }
        });
        // show searcable select using select 2 dropdown
        select2Dropdown("select2_dropdown");
        // $('#new').prop("disabled", true);
        // $('#COURSE').prop("disabled", true);
        $("form :input").on('input', function() {
            $(this).removeClass('borderRed')
            // $(this).parent().siblings('span').remove();
        });
        $('select').on('change', function() {
            $(this).removeClass('borderRed')
            // $(this).siblings('div').children().remove();
        });
        $('textarea').on('input', function() {
            $(this).removeClass('borderRed')
            // $(this).next('div').children().remove();
        });
        // On form submit call ajax for data saving
        $('#data_entry').submit(function() {
            if ($("#save").is(":disabled")) {
                targetURL = '{{ url('admin/update-data-entry') }}';
                console.log(targetURL);
                id = $('#user').val();
                targetURL = targetURL + '/' + id
                CreateUpdateData(targetURL)

            } else {
                targetURL = '{{ url('admin/save-data-entry') }}';
                console.log(targetURL);
                CreateUpdateData(targetURL)
            }
        });


        function saveAsNewRecord(targetURL) {
            if ($('#last_name').is(":disabled")) {
                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: `Please Click 'Save Edit' Button to Enable Fields`,
                    showConfirmButton: false,
                    timer: 1000
                })
                return false;
            } else {

                Swal.fire({
                        icon: 'warning',
                        text: "Would you like to save a new endorsement record?",
                        type: 'warning',
                        showCancelButton: true,
                        showconfirmButton: true,
                        cancelButtonText: 'No',
                        confirmButtonText: 'Yes',
                    })

                    .then((isConfirm) => {
                        if (isConfirm.value) {
                            CreateUpdateData(targetURL);
                        } else if (isConfirm.dismiss == 'cancel') {
                            Swal.fire({
                                position: 'center',
                                icon: 'error',
                                title: 'Record has not been Saved!',
                                showConfirmButton: false,
                                timer: 1000
                            })
                        } else if (isConfirm.dismiss == 'esc') {
                            Swal.fire({
                                position: 'center',
                                icon: 'error',
                                title: 'Record has not been Saved!',
                                showConfirmButton: false,
                                timer: 1000
                            })
                        }

                    });
            }

        }

        function CreateUpdateData(targetURL) {
            event.preventDefault()
            let cid = 0;
            url = window.location.href;
            queryStr = url.split('?');
            if (window.location.href.indexOf("id") != -1) {
                url = window.location.href;
                queryStr = url.split('?');
                // console.log(queryStr[1])
                tap = 1;
                cid = queryStr[1]
            }
            if ($('#user').val() == null) { 
                cid = $('#user').val();
                tap = 0;
            }
            // if ($('#data_entry')[0].checkValidity() === false){
            //     alert('no')
            // }

            // if ($('#current_salary').val() == "" || $('#expec_salary').val() == "" || $('#notes').val() == "") {

            //     // Show notification message if fields are empty in candidate position fields
            //     swal({
            //         icon: "warning",
            //         text: " Please provide Current Salary/Expected Salray and Interview Notes ",
            //         icon: "warning",
            //     });
            // } else {

            // if (targetURL == '{{ url('admin/update-data-entry') }}') {
            //     id = $('#user').val();
            //     // targetURL = '{{ url('update-data-entry') }}'
            //     targetURL = targetURL + '/' + id
            // }
            $("#loader").show();
            if ($('#save').is(':disabled')) {
                checkDuplicate = 0;
            } else {
                checkDuplicate = 1;
            }
            if ($('#off_salary').is(':disabled')) {
                $salary_field = 0;
            } else {
                $salary_field = 1;
            }
            if ($('#rfp').is(':disabled')) {
                $rfp = 0;
            } else {
                $rfp = 1;
            }
            if ($('#interview_schedule').is(':disabled')) {
                $interview_schedule = 0;
            } else {
                $interview_schedule = 1;
            }
            if ($('#bilable_amount').is(':disabled')) {
                $finance_field = 0;
            } else {
                $finance_field = 1;
            }
            if ($('#ap_status').val() == null) {
                $endorsement = 'inactive'

            } else {
                $application_status = $('#ap_status').val().toLowerCase();
                if ($application_status == 'to be endorsed') {
                    $endorsement = 'active';
                } else {
                    $endorsement = 'inactive'
                }
            }
            // making a variable containg all for data and append token
            var data = new FormData(document.getElementById('data_entry'));
            // data.append("_token", "{{ csrf_token() }}");
            data.append("salary_field", $salary_field);
            data.append("endorsement_field", $endorsement);
            data.append("finance_field", $finance_field);
            data.append("rfp", $rfp);
            data.append("interview_schedule", $interview_schedule);
            data.append("candidate_id", cid);
            data.append("tap", tap);
            data.append("checkDuplicate", checkDuplicate);

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
                        $("#loader").hide();
                        // disable save data button after data entry success
                        $('#save').prop("disabled", true);
                        $('#saveRecord').prop("disabled", true);
                        $("input").parent().siblings('span').remove();
                        $("select").parent().siblings('span').remove();
                        $("input").css('border-color', '#ced4da');
                        $("select").css('border-color', '#ced4da');

                        // $("#user").append(`<option value='${res.last_data_save.id}' >
                    //     ${res.last_data_save.first_name}   ${res.last_data_save.last_name}
                    //                 </option>`);
                        // show success sweet alert and enable entering new record button
                        // $('#new').prop("disabled", false);

                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: res.message,
                            showConfirmButton: false,
                            timer: 1000
                        })
                        // $('#new').click()
                        location.reload();
                    } else if (res.success == false) {
                        if (res.status == 1) {
                            // swal({
                            //     icon: "warning",
                            //     text: res.message,
                            //     icon: "warning",
                            // });
                            Swal.fire({
                                position: 'center',
                                icon: 'warning',
                                title: res.message,
                                showConfirmButton: false,
                                timer: 1000
                            })
                            $("#loader").hide();

                        }

                        // show validation error on scree with border color changed and text
                        if (res.hasOwnProperty("message")) {
                            var err = "";
                            // $("input").parent().siblings('span').remove();
                            // $("select").siblings('div').children().remove();
                            // $("textarea").next('div').children().remove();
                            $("input").removeClass('borderRed')
                            $("select").removeClass('borderRed')
                            $("textarea").removeClass('borderRed')
                            $("select").next().children().children().removeClass('borderRed');

                            //function for appending span and changing css color for input
                            $.each(res.message, function(i, e) {
                                // $("input[name='" + i + "']").prop('required', true)
                                // $("input[name='" + i + "']").parent().siblings(
                                //     'span').remove();
                                $("input[name='" + i + "']").addClass('borderRed')

                                // $("input[name='" + i + "']").parent().parent()
                                //     .append(
                                //         '<span style="color:red;" >' + 'Required' + '</span>'
                                //     );
                                // console.log($("select[name='" + i + "']"));
                                // $("select[name='" + i + "']").prop('required', true)
                                $("select[name='" + i + "']").addClass('borderRed')
                                $("select[name='" + i + "']").next().children().children().addClass(
                                    'borderRed');
                                // $("select[name='" + i + "']").siblings(
                                //     'div').children().remove();
                                // $("select[name='" + i + "']").siblings('div')
                                //     .append(
                                //         '<span style="color:red;" >' + 'Required' + '</span>'
                                //     );
                                // $("textarea[name='" + i + "']").prop('required', true)
                                $("textarea[name='" + i + "']").addClass('borderRed')

                                // $("textarea[name='" + i + "']").next('div').children().remove();
                                // $("textarea[name='" + i + "']").next('div').append(
                                //     '<span style="color:red;" >' + 'Required' + '</span>'
                                // );
                            });

                            // // show warning message to user if firld is required
                            // swal({
                            //     icon: "error",
                            //     text: "{{ __('Please fill all required fields!') }}",
                            //     icon: "error",
                            // });
                        }

                        //if duplicate values are detected in database for use data
                    } else if (res.success == 'duplicate') {
                        $("#loader").hide();

                        //show warning message to change the data
                        Swal.fire({
                            icon: "error",
                            text: "{{ __('Duplicate data detected') }}",
                            icon: "error",
                        });
                    } else if (res.success == 'required') {
                        $("#loader").hide();

                        //show warning message to change the data
                        Swal.fire({
                            icon: "error",
                            text: "{{ __('Please fill expected salary/c') }}",
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
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            // }
        }


        // function for (if domain is changed append segments acoordingly) starts
        function endoDomainChange(elem) {
            $('#segment').empty()
            var segmentsDropDown = {!! $segmentsDropDown !!};
            var count = 0;
            for (let i = 0; i < segmentsDropDown.length; i++) {
                if ($(elem).val() == segmentsDropDown[i].domain_id) {
                    count++;
                    $('#segment').append('<option value="' + segmentsDropDown[i].id + '">' + segmentsDropDown[i]
                        .segment_name +
                        '</option>');
                }
            }
            endoSegmentChange('#segment')
        }


        function DomainChange(elem) {
            $('#Domainsub').empty()
            $('#sub_segment').empty()
            $('#Domainsegment').empty()
            $('#segment').empty()
            // var selected = $('#domain').find(":selected").text().trim();
            // $('#domain_endo').html('<option>' + selected + '</option>');
            var domains = {!! $domainDrop !!};
            var segmentsDropDown = {!! $segmentsDropDown !!};
            var count = 0;
            for (let i = 0; i < segmentsDropDown.length; i++) {
                if ($(elem).val() == segmentsDropDown[i].domain_id) {
                    count++;
                    $('#Domainsegment').append('<option value="' + segmentsDropDown[i].id + '">' + segmentsDropDown[
                            i]
                        .segment_name +
                        '</option>');

                    // $('#segment').append('<option value="' + segmentsDropDown[i].id + '">' + segmentsDropDown[i]
                    //     .segment_name +
                    //     '</option>');
                }

            }
            SegmentChange("Domainsegment");
            // SPRCalculator()


        }
        // function for (if domain is changed append segments acoordingly) starts

        function endoSegmentChange(elem) {
            $('#sub_segment').empty()
            var sub_segmentsDropDown = {!! $sub_segmentsDropDown !!};
            var count = 0;
            for (let i = 0; i < sub_segmentsDropDown.length; i++) {
                if ($(elem).val() == sub_segmentsDropDown[i].segment_id) {
                    $('#sub_segment').append('<option value="' + sub_segmentsDropDown[i].id + '">' +
                        sub_segmentsDropDown[i]
                        .sub_segment_name +
                        '</option>');
                }
            }
        }

        // function for (if segment is changed append segments acoordingly) starts
        function SegmentChange(elem) {
            $('#Domainsub').empty()
            // $('#sub_segment').empty()
            var sub_segmentsDropDown = {!! $sub_segmentsDropDown !!};
            var count = 0;
            for (let i = 0; i < sub_segmentsDropDown.length; i++) {
                if ($('#Domainsegment').val() == sub_segmentsDropDown[i].segment_id) {
                    count++;
                    $('#Domainsub').append('<option value="' + sub_segmentsDropDown[i].id + '">' +
                        sub_segmentsDropDown[i]
                        .sub_segment_name +
                        '</option>');
                    // $('#sub_segment').append('<option value="' + sub_segmentsDropDown[i].id + '">' +
                    //     sub_segmentsDropDown[i]
                    //     .sub_segment_name +
                    //     '</option>');
                }
            }
        }
        // function for (if segment is changed append segments acoordingly) ends

        // apppending endorsements segments starts
        function changeSegment(elem) {
            $('#sub_segment').empty()
            var sub_segmentsDropDown = {!! $sub_segmentsDropDown !!};
            var count = 0;
            for (let i = 0; i < sub_segmentsDropDown.length; i++) {
                if ($('#' + elem).val() == sub_segmentsDropDown[i].segment_id) {
                    count++;
                    $('#sub_segment').append('<option value="' + sub_segmentsDropDown[i].id + '">' +
                        sub_segmentsDropDown[i]
                        .sub_segment_name +
                        '</option>');
                }
            }
        }
        // apppending endorsements segments ends

        //empty file input on cross click
        function emptyFileinput() {
            $('#sheetFile').val('');
            $('#append-cv').html('No Uploaded CV')
            $('#cross').removeClass('d-block')
            $('#cross').addClass('d-none')
        }
        //check file extension on selected file starts 
        function uploadFile(elem) {
            if ($(elem).val().split('.').pop() == 'pdf') {
                $('#cross').removeClass('d-none')
                $('#cross').addClass('d-block')
                var cvvcontent = $('#sheetFile').val();
                if (cvvcontent) {
                    $('#append-cv').html(` `)
                    $('#append-cv').append(cvvcontent)
                }

            } else if ($(elem).val().split('.').pop() == '') {
                $('#sheetFile').val();
                $('#cross').removeClass('d-block')
                $('#cross').addClass('d-none')
            } else {
                Swal.fire({
                    icon: "error",
                    text: "{{ __('Allowed formats is pdf') }}",
                    icon: "error",
                });
                $('#sheetFile').val('');

            }
        }

        // // get value of seleted field 
        // var value = $('#remarks_for_finance').find(":selected").text().trim();

        // // enable and disalbe reason for not processing input fields
        // if (value.includes('Failed') || value.includes('Withdraw')) {
        //     $('#rfp').prop("disabled", false);
        // } else {
        //     $('#rfp').prop("disabled", true);
        // }

        // // enable and disable finance section on selected text of remarks for finance
        // if (value.includes('accepted') || value.includes('Onboarded')) {
        //     $('#finance_fieldset').prop("disabled", false);
        //     $('#off_allowance').prop("disabled", false);
        //     $('#career_finance').prop("disabled", false);
        //     $('#srp').prop("disabled", false);
        //     $('#remarks_finance').prop("disabled", false);
        //     $('#invoice_number').prop("disabled", false);
        //     $('#bilable_amount').prop("disabled", false);
        //     $('#rate').prop("disabled", false);
        //     $('#off_allowance_finance').prop("disabled", false);
        //     $('#placement_fee').prop("disabled", false);
        //     $('#off_salary_fianance').prop("disabled", false);
        //     $('#onboard_date').prop("disabled", false);
        // $('#off_allowance').prop("disabled", false);
        // } else {

        //     // else disable the finance section and disable salray fields
        //     $('#finance_fieldset').prop("disabled", true);

        //     // $('#off_allowance').prop("disabled", true);
        // }
        // if (value.includes('Hire') || value.includes('Reneged') || value.includes('Onboard') || value.includes(
        //         'Scheduled') || value.includes('Offer accepted')) {
        // $('#off_allowance').prop("disabled", false);
        //     $('#off_salary').prop("disabled", false);
        // } else {
        //     $('#off_allowance').prop("disabled", true);
        //     $('#off_salary').prop("disabled", true);
        // }
        // // enalbe the interview date if remark include schedule
        // if (value.includes('Scheduled')) {
        //     $('#interview_schedule').prop("disabled", false);
        // } else {
        //     $('#interview_schedule').prop("disabled", true);
        // }
        // if (value.includes('Scheduled') || value.includes('Pending') || value.includes('Withdraw')) {

        //     // disable fieldset of finance fieldset
        //     $('#finance_fieldset').prop("disabled", false);

        //     //disable remaining fields of finance reference
        //     $('#career_finance').prop("disabled", false);
        //     $('#srp').prop("disabled", false);
        //     $('#remarks_finance').prop("disabled", true);
        //     $('#invoice_number').prop("disabled", true);
        //     $('#bilable_amount').prop("disabled", true);
        //     $('#rate').prop("disabled", true);
        //     $('#off_allowance_finance').prop("disabled", true);
        //     $('#placement_fee').prop("disabled", true);
        //     $('#off_salary_fianance').prop("disabled", true);
        //     $('#onboard_date').prop("disabled", true);
        // }

        // // enable the standard project revenue if the remark incliudes mid / mid stage
        // if (value.includes('Mid')) {
        //     $('#client_finance').prop("disabled", false);
        // }

        // // on remarks for finance change shwo user input fields ends

        // // close 

        // Change course according to the selected education attainment 
        function EducationalAttainChange() {

            // enable and disable course fields on selected educational attainment
            var value = $('#EDUCATIONAL_ATTAINTMENT').find(":selected").text().trim();
            var role_id = {!! Auth::user()->agent !!}
            if (role_id == 1) {
                if (value == 'HIGH SCHOOL GRADUATE') {

                    // if selected text is gradute disable course field for user
                    $('#COURSE').prop("disabled", true);
                } else {
                    //enable course field
                    $('#COURSE').prop("disabled", false);
                    $('#COURSE').children().removeAttr('disabled');

                }
            } else {
                if (value == 'HIGH SCHOOL GRADUATE' || value == 'SENIOR HIGH SCHOOL GRADUATE') {

                    // if selected text is HIGH SCHOOL GRADUATE disable course field for user
                    $('#COURSE').prop("disabled", true);
                } else {
                    //enable course field
                    $('#COURSE').prop("disabled", false);
                    $('#COURSE').children().removeAttr('disabled');

                }

            }
        }

        //open script for coming update id page and tap data starts

        // enable and disable course fields on selected educational attainment
        var value = $('#EDUCATIONAL_ATTAINTMENT').find(":selected").text().trim();
        var role_id = {!! Auth::user()->agent !!}
        if (role_id == 1) {
            if (value == 'HIGH SCHOOL GRADUATE') {

                // if selected text is gradute disable course field for user
                $('#COURSE').prop("disabled", true);
            } else {
                //enable course field
                $('#COURSE').prop("disabled", false);
                $('#COURSE').children().removeAttr('disabled');

            }
        } else {
            if (value == 'HIGH SCHOOL GRADUATE' || value == 'SENIOR HIGH SCHOOL GRADUATE') {

                // if selected text is HIGH SCHOOL GRADUATE disable course field for user
                $('#COURSE').prop("disabled", true);
            } else {
                //enable course field
                $('#COURSE').prop("disabled", false);
                $('#COURSE').children().removeAttr('disabled');

            }

        }
        // //  On application status changed function starts 
        // if ($('#ap_status').find(":selected").text().trim() == 'To Be Endorsed') {
        //     // disable and enable input fields for user data in endorsement section
        //     $('#remarks').prop("disabled", false);
        //     $('#status').prop("disabled", false);
        //     $('#site').prop("disabled", false);
        //     $('#client').prop("disabled", false);
        //     $('#position').prop("disabled", false);
        //     $('#domain_endo').prop("disabled", false);
        //     $('#career').prop("disabled", false);
        //     $('#segment').prop("disabled", false);
        //     $('#sub_segment').prop("disabled", false);
        //     $('#endo_date').prop("disabled", false);
        //     $('#remarks_for_finance').prop("disabled", false);
        //     // $('#expec_salary').prop("disabled", false);
        //     $('#endo_type').prop("disabled", false);
        // }
        // get the value of selected text
        var value = $('#manners').find(":selected").text().trim();
        if (value == 'Pending') {
            $('#date_invited').prop("disabled", true);
        } else {
            // else enable the invitation data
            $('#date_invited').prop("disabled", false);
        }
        //open script for coming update id page and tap data ends

        function ApplicationStatusChange(elem) {

            // if current and exepcted salary is empty notify user
            var value = $(elem).find(":selected").text().trim();

            // check for selected application status value
            if (value.includes('To') || value.includes('Active')) {
                var role_id = {!! Auth::user()->agent !!}
                if (role_id == 1) {
                    $('#domain').prop('disabled', false)
                    $('#Domainsegment').attr('readonly', false)
                    $('#Domainsub').attr('readonly', false)
                    // $('#candidate_profile').prop('disabled', false)
                }

                if (value.includes('To')) {
                    // disable and enable input fields for user data in endorsement section
                    $('#remarks').prop("disabled", false);
                    $('#status').prop("disabled", false);
                    $('#site').prop("disabled", false);
                    $('#client').prop("disabled", false);
                    $('#domain_endo').prop("disabled", false);
                    $('#segment').prop("disabled", false);
                    $('#sub_segment').prop("disabled", false);
                    $('#endo_date').prop("disabled", false);
                    $('#remarks_for_finance').prop("disabled", false);
                    $('#endo_type').prop("disabled", false);
                    $('#position').prop("disabled", false);
                    // $('#position').prop("disabled", false);
                    // $('#position').attr("readonly", true);
                    // $('#career').attr("readonly", true);
                    $('#career').prop("disabled", false);
                    // $('#expec_salary').prop("disabled", false);


                } else {

                    //else disalbe the input fields of endorsement section 
                    $('#remarks').prop("disabled", true);
                    $('#status').prop("disabled", true);
                    $('.selectedOption').prop("selected", true)
                    $('#selectedOption').prop("selected", true)

                    $('#site').prop("disabled", true);
                    $('#client').prop("disabled", true);
                    $('#position').prop("disabled", true);
                    $('#domain_endo').prop("disabled", true);
                    $('#career').prop("disabled", true);
                    $('#endo_type').prop("disabled", true);
                    $('#segment').prop("disabled", true);
                    $('#sub_segment').prop("disabled", true);
                    $('#endo_date').prop("disabled", true);
                    // $('#expec_salary').prop("disabled", true);
                    $('#remarks_for_finance').prop("disabled", true);
                    $('#off_allowance').prop("disabled", true);
                    $('#career_finance').prop("disabled", true);
                    $('#srp').prop("disabled", true);
                    $('#remarks_finance').prop("disabled", true);
                    $('#invoice_number').prop("disabled", true);
                    $('#bilable_amount').prop("disabled", true);
                    $('#rate').prop("disabled", true);
                    $('#off_allowance_finance').prop("disabled", true);
                    $('#placement_fee').prop("disabled", true);
                    $('#off_salary_fianance').prop("disabled", true);
                    $('#onboard_date').attr("readonly", true);
                    $('#off_salary').prop("disabled", true);
                    var $newOption = $("<option disabled selected='selected'></option>").val("TheID").text(
                        "Select Option")
                    $("#remarks_for_finance").append($newOption).trigger('change');
                }


            } else {

                //else disable domain segment and and candidate profile
                $('#domain').attr('readonly', true)
                $('#Domainsegment').attr('readonly', true)
                $('#Domainsub').attr('readonly', true)
                // $('#candidate_profile').prop('disabled', true)
                //else disalbe the input fields of endorsement section 
                $('#remarks').prop("disabled", true);
                $('#status').prop("disabled", true);
                var $newOption = $("<option selected='selected'></option>").val("TheID").text("Select Option")
                $("#remarks_for_finance").append($newOption).trigger('change');
                $('#site').prop("disabled", true);
                $('#client').prop("disabled", true);
                $('#position').prop("disabled", true);
                $('#domain_endo').prop("disabled", true);
                $('#career').prop("disabled", true);
                $('#segment').prop("disabled", true);
                $('#sub_segment').prop("disabled", true);
                $('#endo_date').prop("disabled", true);
                //  $('#expec_salary').prop("disabled", true);
                $('#remarks_for_finance').prop("disabled", true);
                $('#finance_fieldset').prop("disabled", false);
                $('#off_allowance').prop("disabled", true);
                $('#career_finance').prop("disabled", true);
                $('#srp').prop("disabled", true);
                $('#remarks_finance').prop("disabled", true);
                $('#invoice_number').prop("disabled", true);
                $('#bilable_amount').prop("disabled", true);
                $('#rate').prop("disabled", true);
                $('#off_allowance_finance').prop("disabled", true);
                $('#placement_fee').prop("disabled", true);
                $('#off_salary_fianance').prop("disabled", true);
                $('#onboard_date').attr("readonly", true);
                // $('#onboard_date').prop("disabled", true);
                $('#off_salary').prop("disabled", true);

            }

        }
        // on reamrks recruiter change 
        $('#remarks_finance').change(function() {
            value = $(this).val();
            $('#remarks').append(`<option selected value="${value}">
                                        ${value}
                                    </option>`);
        });
        // close 
        //  On application status changed function ends
        // client change and get domain segment and subsegment
        function traverseData() {
            $('#domain').empty();
            $('#Domainsub').empty();
            $('#Domainsegment').empty();

            $.ajax({
                url: '{{ url('admin/traveseDataByClientProfile') }}',
                type: 'POST',
                data: {
                    c_profile: $('#candidate_profile').val(),
                    _token: token
                },

                // Ajax success function
                success: function(res) {
                    if (res.data.id) {

                        $('#domain').append(
                            `<option selected value="${res.data.domainName}">${res.data.domainName}</option>`
                            );
                        $('#Domainsegment').append(
                            `<option selected value="${res.data.segmentName}">${res.data.segmentName}</option>`
                            );
                        $('#Domainsub').append(
                            `<option selected value="${res.data.subSegmentName}">${res.data.subSegmentName}</option>`
                            );


                        // $('#domain_endo').append(
                        //     `<option selected  value="${res.data.domain}">${res.data.domain}</option>`);
                        // $('#segment').append(
                        //     `<option selected value="${res.data.segment}">${res.data.segment}</option>`);
                        // $('#sub_segment').append(
                        //     `<option selected value="${res.data.s_segment}">${res.data.s_segment}</option>`);



                        $('#domain').attr('readonly', true);
                        $('#Domainsegment').attr('readonly', true);
                        $('#Domainsub').attr('readonly', true);

                    } else {
                        $('#domain').append(`<option >Select Option</option>`);
                        $('#Domainsegment').append(
                            `<option >Select Option</option>`);
                        $('#Domainsub').append(
                            `<option >Select Option</option>`);

                    }
                }
            })


        }


        var globalData = [];

        function clientChanged(dropDown, elem) {
            $('#loader2').addClass('d-block')
            $('#loader2').removeClass('d-none')
            $('#position').prop("disabled", false);
            $('#career').prop("disabled", false);
            $('#career').prop("readonly", false);
            $.ajax({
                url: '{{ url('admin/traveseDataByClientProfile') }}',
                type: 'POST',
                data: {
                    // position: $('#position').val(),
                    client_dropdown: $('#client').val(),
                    _token: token
                },

                // Ajax success function
                success: function(res) {
                    if (res.data.length > 0) {
                        $('#loader2').addClass('d-none')
                        $('#loader2').removeClass('d-block')
                        globalData = res.data;
                        $('#domain_endo').empty();
                        $('#segment').empty();
                        $('#sub_segment').empty();
                        $('#career').empty();
                        // $('#client').empty();
                        $('#position').empty();
                        for (let i = 0; i < res.data.length; i++) {
                            if ($(elem).val() == res.data[i].client) {
                                if ($(`#position option[ value="${res.data[i].p_title}"]`).length < 1) {
                                    $('#position').append(
                                        `<option value="${res.data[i].p_title}">${res.data[i].p_title}</option>`
                                    );
                                }
                            }
                        }

                        // let value = $('#client').val()
                        // $('#client_finance').append(`<option selected value="${value}">
                    //                ${value}
                    //           </option>`)
                        $('#position').change();
                        $('#client').attr('readonly', true);
                        $('#domain_endo').attr('readonly', true);
                        $('#segment').attr('readonly', true);
                        $('#sub_segment').attr('readonly', true);

                    } else {
                        $('#domain_endo').empty();
                        $('#segment').empty();
                        $('#sub_segment').empty();
                        $('#career').empty();
                        $('#loader2').addClass('d-none')
                        $('#loader2').removeClass('d-block')
                        $('#position').empty();
                    }

                }
            })

        }

        $('#position').change(function() {
            $('#career').empty();
            for (let i = 0; i < globalData.length; i++) {
                if ($('#position').val().toLowerCase() == globalData[i].p_title.toLowerCase()) {
                    $('#career').append(
                        `<option value="${globalData[i].c_level}">${globalData[i].c_level}</option>`
                    );
                }
            }

            DomainSegmentAppend()

        })

        function DomainSegmentAppend() {

            var value = $("#remarks_for_finance").find(":selected").text().trim();
            // enable and disable finance section on selected text of remarks for finance
            if (value.includes('accepted') || value.includes('Onboarded')) {

                // SPRCalculator()
                let value = $('#career').val();
                let value2 = $('#client').val(); 
                $('#client_finance').append(`<option selected value="${value2}">
                                       ${value2}
                                  </option>`);
                $('#career_finance').append(`<option selected value="${value}">
                                   ${value}
                              </option>`);
            }
            for (let i = 0; i < globalData.length; i++) {
                if ($('#position').val() == globalData[i].p_title && $('#career').val() == globalData[i].c_level &&
                    $('#client').val() == globalData[i].client) {
                    $('#domain_endo').append(
                        `<option selected value="${globalData[i].domain}">${globalData[i].domain}</option>`
                    );
                    $('#segment').append(
                        `<option selected value="${globalData[i].segment}">${globalData[i].segment}</option>`
                    );
                    $('#sub_segment').append(
                        `<option selected value="${globalData[i].subsegment}">${globalData[i].subsegment}</option>`
                    );
                }
            }
            // SPRCalculator();
        }
        $(document).ready(function() {
            appendRemarksForFinance(1)

            // $.ajax({
            //     url: "{{ route('Get_Position_title') }}",
            //     type: 'get',
            //     success: function(res) {
            //         console.info(res)
            //         for (var i = 0; i < res.length; i++) {
            //             $('#position').append(
            //                 `<option value="${res[i].p_title}">${res[i].p_title} </option>`)
            //         }
            //     }
            // });


        });
        //select endorsements details by ajax call 
        function selectEndoDetails(elem) {
            $('#loader3').show()
            id = $(elem).val();
            if ($('#user').val() == null) {
                url = window.location.href;
                queryStr = url.split('=');
                user = queryStr[1] + '-' + id;
                console.log(user)

            } else {
                user = $('#user').val()
            }
            $.ajax({
                url: "{{ route('endorsements_detail_view') }}",
                type: 'post',
                data: {
                    id: id,
                    user: user,
                    _token: token
                },
                success: function(res) {
                    $('#loader3').hide()
                    if ($('#no_endo option').length > 1) {
                        $('#saveRecord').prop("disabled", false)
                    }
                    $('#endorsements_detail_view').html(res);
                    // for (var i = 0; i < res.length; i++) {
                    //     $('#position').append(
                    //         `<option value="${res[i].p_title}">${res[i].p_title} </option>`)
                    // }

                }
            });
        }
        // close

        // append option in remarks for finance on status change 
        $('#status').on('change', function() {
            if ($(this).val().toLowerCase() == 'invalid') {
                $('#remarks_for_finance').empty().trigger('change');
                var option = new Option("In Client's DB/Portal", "In Client's DB/Portal", true, true);
                $('#remarks_for_finance').append(option).trigger('change');
            } else if ($(this).val().toLowerCase() == 'pending validation') {
                $('#remarks_for_finance').empty().trigger('change');
                var option = new Option("Pending DB Validation", "Pending DB Validation", true, true);
                $('#remarks_for_finance').append(option).trigger('change');
            } else {
                appendRemarksForFinance(0)
            }

        });
        // close

        // ajax to append remarks for finance options 
        function appendRemarksForFinance(bol) {
            $.ajax({
                url: "{{ route('get_remarksForFinance_options') }}",
                type: 'get',
                success: function(res) {
                    if (bol == 0) {
                        $('#remarks_for_finance').empty().trigger('change');
                    }
                    optionArray = ["pending db validation", "in client's db/portal"];
                    for (var i = 0; i < res.options.length; i++) {
                        if (!optionArray.includes(res.options[i].option_name.toLowerCase())) {
                            var option = new Option(res.options[i].option_name, res.options[i].option_name,
                                true, false);
                            $('#remarks_for_finance').append(option).trigger('change');
                        }
                    }

                }
            });
        }

        // close
    </script>
@endsection
