@extends('layouts.app')

@section('style')

@endsection


@section('content')
    <div class="container-fluid">
        <div id="loader"></div>
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
                    <div class="card position-relative">
                        <div id="loader1"></div>
                        <div class="card-body" style="display: flex; justify-content: center;">
                            <div class="form-group">
                                {{-- <label class="Label">Candidate:</label> --}}
                            </div>
                            <div class="form-group mb-8"></div>
                            <div class="d-grid gap-2 form-group col-md-12 px-0">
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
                                            <fieldset>
                                                <div class="row mb-2">
                                                    <div class="col-lg-4">
                                                        <div class="form-group mb-0">
                                                            <label class="Label labelFontSize">Last Name:<sup class="font-weight-bolder">*</sup></label>
                                                            <input type="text" class="form-control users-input-S-C"
                                                                name="LAST_NAME" required=""
                                                                value="{{ $candidateDetail != null ? $candidateDetail->last_name : '' }}" />
                                                        </div>
                                                        <div><small class="___class_+?36___"></small></div>
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
                                                    <div class="col-lg-4">
                                                        <div class="form-group mb-0">
                                                            <label class="Label labelFontSize">First Name:<sup class="font-weight-bolder">*</sup></label>
                                                            <input type="text" class="form-control users-input-S-C"
                                                                value="{{ $candidateDetail != null ? $candidateDetail->first_name : '' }}"
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
                                                            <label class="d-block font-size-3 mb-0 labelFontSize">
                                                                Gender
                                                            </label>
                                                            <select name="GENDER"
                                                                class="form-control border pl-0 arrow-3 h-px-20_custom w-100 font-size-4 d-flex align-items-center w-100">
                                                                @foreach ($gender->options as $genderOptions)
                                                                    <option value="{{ $genderOptions->option_name }}"
                                                                        {{ ($candidateDetail != null ? $candidateDetail->gender == $genderOptions->option_name : '') ? 'selected' : '' }}>
                                                                        {{ $genderOptions->option_name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group mb-0">
                                                            <label class="d-block font-size-3 mb-0 labelFontSize">
                                                                DOB
                                                            </label>
                                                            <input type="date" name="DATE_OF_BIRTH"
                                                                value="{{ $candidateDetail != null ? $candidateDetail->dob : '' }}"
                                                                class="form-control border h-px-20_custom" required />
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
                                                                    name="EMAIL_ADDRESS" id="email" required="" />
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
                                                                <input type="number" class="form-control EmailInput-F"
                                                                    value="{{ $candidateDetail != null ? $candidateDetail->phone : '' }}"
                                                                    name="CONTACT_NUMBER" required="" />
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
                                                                name="RESIDENCE" required="" />
                                                            <div>
                                                                <small class="text-danger"></small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row align-items-center">
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
                                                                <option value="" selected disabled>Select Option</option>
                                                                @foreach ($eduAttainment->options as $eduAttainmentOptions)
                                                                    <option
                                                                        {{ ($candidateDetail != null ? $candidateDetail->educational_attain == $eduAttainmentOptions->option_name : '') ? 'selected' : '' }}
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
                                                            <select name="COURSE" class="form-control p-0 users-input-S-C"
                                                                value="{{ $candidateDetail != null ? $candidateDetail->course : '' }}"
                                                                id="COURSE">
                                                                <option value="" selected disabled>Select Option</option>
                                                                @foreach ($course->options as $courseOptions)
                                                                    <option value="{{ $courseOptions->option_name }}"
                                                                        {{ ($candidateDetail != null ? $candidateDetail->course == $courseOptions->option_name : '') ? 'selected' : '' }}>
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
                                                            <label class="Label labelFontSize">
                                                                CERTIFICATIONS
                                                            </label>
                                                            <select name="CERTIFICATIONS"
                                                                value="{{ $candidateDetail != null ? $candidateDetail->certification : '' }}"
                                                                class="form-control p-0 users-input-S-C select2_dropdown w-100">
                                                                <option value="" selected disabled>Select Option</option>
                                                                @foreach ($certificate->options as $certificateOption)
                                                                    <option value="{{ $certificateOption->option_name }}"
                                                                        {{ ($candidateDetail != null ? $candidateDetail->certification == $certificateOption->option_name : '') ? 'selected' : '' }}>
                                                                        {{ $certificateOption->option_name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr class="mb-9" />
                                                <div class="row m-0">
                                                    <div class="col-lg-6 col-md-6 col-sm-12 col-12 pl-0">
                                                                <label class="Label labelFontSize">
                                                                    Date Sifted:
                                                                </label>
                                                                <input type="date" name="DATE_SIFTED" required=""
                                                                    value="{{ $candidateDetail != null ? $candidateDetail->date_shifted : '' }}"
                                                                    class="form-control users-input-S-C" />
                                                                <div>
                                                                    <small class="text-danger"></small>
                                                                </div>
                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-12 p-0">
                                                                <label class="Label labelFontSize">Domains</label>
                                                                <select name="DOMAIN" id="domain" required=""
                                                                    onchange="DomainChange(this)"
                                                                    class="form-control p-0 users-input-S-C">
                                                                    <option selected disabled>Select Option</option>
                                                                    @foreach ($domainDrop as $domainOption)
                                                                        <option value="{{ $domainOption->id }}"
                                                                            {{ ($candidateDetail != null ? $candidateDetail->domain == $domainOption->option_name : '') ? 'selected' : '' }}>

                                                                            {{ $domainOption->domain_name }}</option>
                                                                    @endforeach
                                                                </select>
                                                                <div>
                                                                    <small class="text-danger"></small>
                                                                </div>
                                                            </div>    
                                                            <div class="col-lg-12 col-md-12 col-sm-12 col-12  p-0">
                                                                    <?php
                                                                    $sub_segment = Helper::get_dropdown('sub_segment');
                                                                    ?>
                                                                    <label class="Label labelFontSize">sub-segment</label>
                                                                    <select name="SUB_SEGMENT" id="Domainsub"
                                                                        class="form-control p-0 users-input-S-C">
                                                                        <option selected disabled>Select Option</option>
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
                                                                <div class="col-lg-12 col-md-12 col-sm-12 col-12  p-0">
                                                        <?php
                                                        $profile = Helper::get_dropdown('candidates_profile');
                                                        ?>
                                                        <div class="form-group mb-0">
                                                            <label class="Label labelFontSize">
                                                                candidate profile
                                                            </label>
                                                            <select name="CANDIDATES_PROFILE"
                                                                class="select2_dropdown w-100"
                                                                class="form-control p-0 users-input-S-C">
                                                                <option value="" selected disabled>Select Option</option>
                                                                @foreach ($profile->options as $profileOption)
                                                                    <option value="{{ $profileOption->option_name }}"
                                                                        {{ ($candidateDetail != null ? $candidateDetail->candidate_profile == $profileOption->option_name : '') ? 'selected' : '' }}>
                                                                        {{ $profileOption->option_name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div>
                                                            <small class="text-danger"></small>
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
                                                            <select name="MANNER_OF_INVITE" onchange="mannerChange(this)"
                                                                value="{{ $candidateDetail != null ? $candidateDetail->manner_of_invite : '' }}"
                                                                id="manners" class="form-control p-0 users-input-S-C">
                                                                <option value="" selected disabled>Select Option</option>
                                                                @foreach ($manner_of_invite->options as $manner_of_inviteOption)
                                                                    <option
                                                                        value="{{ $manner_of_inviteOption->option_name }}"
                                                                        {{ ($candidateDetail != null ? $candidateDetail->manner_of_invite == $manner_of_inviteOption->option_name : '') ? 'selected' : '' }}>
                                                                        {{ $manner_of_inviteOption->option_name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div>
                                                            <small class="text-danger"></small>
                                                        </div>
                                                    </div> 
                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-12  p-0">
                                                        <div class="form-group mb-0">
                                                            <label class=" p-0  mb-0 labelFontSize"> Date Invited</label>
                                                            <input type="date" name="DATE_INVITED" disabled=""
                                                                value="{{ $candidateDetail != null ? $candidateDetail->date_invited : '' }}"
                                                                id="date_invited"
                                                                class="form-control border h-px-20_custom" />
                                                        </div>
                                                    </div>  
                                                    <div class="col-lg-12 p-0">
                                                                <label
                                                                    class="text-black-2 font-size-3 labelFontSize font-weight-semibold mb-0">
                                                                    Employement History</label>
                                                                <textarea name="EMPLOYMENT_HISTORY" rows="3" type="text"
                                                                    class="form-control border E_HCDataEntry">{{ $candidateDetail != null ? $candidateDetail->emp_history : '' }}"</textarea>
                                                            </div>   
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-12 col-12 plSM-0 pr-15  pr-0">
                                                        <label class="` Label labelFontSize">
                                                            Interview Notes
                                                        </label>
                                                        <textarea name="INTERVIEW_NOTES" rows="3" type="text" id="notes"
                                                            class="form-control border t-HC h-px-20_custom">{{ $candidateDetail != null ? $candidateDetail->interview_note : '' }}</textarea>
                                                        <div>
                                                            <small class="text-danger"></small>
                                                        </div>
                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-12 p-0">
                                                                <?php
                                                                $segment = Helper::get_dropdown('segments');
                                                                ?>
                                                                <label class="Label labelFontSize">segment</label>
                                                                <select name="SEGMENT" id="Domainsegment"
                                                                    onchange="SegmentChange('Domainsegment')"
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
                                                            <div class="form-group mb-0">
                                                                <label class="Label labelFontSize">
                                                                    Expected Salary:
                                                                </label>
                                                                <input type="number" name="EXPECTED_SALARY" id="expec_salary" disabled=""
                                                                    value="{{ $candidateDetail != null ? $candidateDetail->exp_salary : '' }}"
                                                                    class="form-control p-0 users-input-S-C" />
                                                            </div>
                                                    </div>
                                                        
                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-12  p-0">
                                                        <div class="form-group mb-0">
                                                            <label class="Label labelFontSize" name="CURRENT_ALLOWANCE">
                                                                Current Allowance:
                                                            </label>
                                                            <input type="number" class="form-control users-input-S-C"
                                                                value="{{ $candidateDetail != null ? $candidateDetail->curr_allowance : '' }}"
                                                                name="CURRENT_ALLOWANCE" />
                                                        </div>
                                                    </div> 
                                                    
                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-12  p-0">
                                                        <div class="form-group mb-0">
                                                            <label class="Label labelFontSize" name="OFFERED_SALARY">
                                                                Offered Salary:
                                                            </label>
                                                            <input type="number" name="OFFERED_SALARY" id="off_salary"
                                                                value="{{ $candidateDetail != null ? $candidateDetail->off_salary : '' }}"
                                                                disabled="" oninput="SalaryAppend('#remarks')"
                                                                class="form-control users-input-S-C" />
                                                        </div>
                                                    </div> 
                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-12  p-0">
                                                        <div class="form-group mb-0">
                                                            <label class="Label labelFontSize">
                                                                Offered Allowance:
                                                            </label>
                                                            <input type="number" name="OFFERED_ALLOWANCE" id="off_allowance"
                                                                value="{{ $candidateDetail != null ? $candidateDetail->off_allowance : '' }}"
                                                                oninput="SalaryAppend('#remarks')" disabled=""
                                                                class="form-control users-input-S-C" />
                                                        </div>
                                                    </div> 
                                                    </div>
                                                  
                                                    <!-- <div class="row m-0"> -->
                                                
                                                         
                                                       
                                                 
                                                  
                                                    <!-- </div> -->
                                                    <!-- <div class="row m-0"> -->

                                                       
                                                         
                                                 
                                                    <!-- </div> -->
                                                    <!-- <div class="row m-0"> -->
                                                   
                                                 
                                                    <!-- </div> -->
                                                    <!-- <div class="row m-0"> -->
                                                                  
                                                    <!-- </div> -->
                                                    <!-- <div class="row m-0"> -->
                                                                         
                                                    <!-- </div> -->
                                                    <!-- <div class="row m-0"> -->
                                                   
                                                                          
                                                    <!-- </div> -->
                                                    </div>
                                                
                                                          
                                                 
                                                
                                                  
                                                 
                                                 
                                                  
                                                 
                                             
                                            </fieldset>

                                            <div class="row pt-3">
                                                <div class="col-lg-6"></div>
                                                <div class="col-lg-6">
                                                    <div
                                                        class="d-flex w-100 flex-wrap gap-2 flex-column form-group col-md-12">
                                                        <div class="w-100"
                                                            style="text-align: end; margin-bottom: 6px;">
                                                            <input type="file" id="sheetFile" name="file" required=""
                                                                accept="application/pdf" class="uploadcv    w-100">
                                                        </div>
                                                        <div class="d-flex justify-flex-end"
                                                            style="justify-content: flex-end;">
                                                            <button type="button" btn_Group href=""
                                                             class="costumButton"   style="pointer-events: none; cursor: default;">
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
                        <div class="col-lg-6 paddingZero mtSM-4">
                            <!-- ================== -->
                            <!-- ENDORSMENT section start -->
                            {{-- <fieldset disabled="false"> --}}
                            <p class="C-Heading labelFontSize">Endorsement Details</p>
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
                                        </div>
                                        <div class="col-lg-6">
                                                <div class="form-group mb-0">
                                                    @php
                                                        $position_title = Helper::get_dropdown('position_title');
                                                    @endphp
                                                    <label class="d-block font-size-3 mb-0 labelFontSize">
                                                        Position Title:
                                                    </label>
                                                    <select name="POSITION_TITLE" disabled="" id="position"
                                                        class="select2_dropdown  w-100"
                                                        class="form-control border pl-0 arrow-3 h-px-20_custom w-100 font-size-4 d-flex align-items-center w-100">
                                                        <option value="" disabled selected>Select Option</option>
                                                        @foreach ($position_title->options as $position_titleOptions)
                                                            <option value="{{ $position_titleOptions->option_name }}">
                                                                {{ $position_titleOptions->option_name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
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
                                                        Endorsement Type:
                                                    </label>
                                                    <select name="ENDORSEMENT_TYPE" id=""
                                                        class="form-control border pl-0 arrow-3 h-px-20_custom w-100 font-size-4 d-flex align-items-center w-100">
                                                        <option value="" disabled selected>Select Option</option>
                                                        @foreach ($endoType->options as $endoTypeOptions)
                                                            <option value="{{ $endoTypeOptions->option_name }}">
                                                                {{ $endoTypeOptions->option_name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
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
                                                        class="form-control border pl-0 arrow-3 h-px-20_custom w-100 font-size-4 d-flex align-items-center w-100">
                                                        <option value="" disabled selected>Select Option</option>
                                                        @foreach ($CareerLevel->options as $CareerLevelOptions)
                                                            <option value="{{ $CareerLevelOptions->option_name }}">
                                                                {{ $CareerLevelOptions->option_name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
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
                                                        <input type="date" name="DATE_ENDORSED" disabled="" id="endo_date"
                                                            onchange="setDate()"
                                                            class="form-control border h-px-20_custom" />
                                                    </div>
                                                </div>
                                            </div> 
                                            <div class="col-lg-6">
                                                <div class="form-group mb-0">
                                                    @php
                                                        $status = Helper::get_dropdown('status');
                                                    @endphp
                                                    <label class="d-block font-size-3 mb-0 labelFontSize">
                                                        Status
                                                    </label>
                                                    <select name="STATUS" id="status" disabled=""
                                                        class="form-control border pl-0 arrow-3 h-px-20_custom w-100 font-size-4 d-flex align-items-center w-100">
                                                        <option value="" disabled selected>Select Option</option>
                                                        @foreach ($status->options as $statusOptions)
                                                            <option value="{{ $statusOptions->option_name }}">
                                                                {{ $statusOptions->option_name }}
                                                            </option>
                                                        @endforeach
                                                        &quot;item&quot;
                                                        </option>
                                                    </select>
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
                                                        onchange="clientChanged(this)"
                                                        class="form-control border pl-0 arrow-3 h-px-20_custom w-100 font-size-4 d-flex align-items-center select2_dropdown w-100">
                                                        <option value="" disabled selected>Select Option</option>
                                                        @foreach ($client->options as $clientOptions)
                                                            <option value="{{ $clientOptions->option_name }}">
                                                                {{ $clientOptions->option_name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
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
                                                    <select name="REMARKS_FOR_FINANCE" disabled="" id="remarks_for_finance"
                                                        onchange="RemarksChange(this)" class="select2_dropdown  w-100"
                                                        class="form-control border pl-0 arrow-3 h-px-20_custom w-100 font-size-4 d-flex align-items-center w-100">
                                                        @php
                                                            $remarks = Helper::get_dropdown('remarks_for_finance');
                                                        @endphp
                                                        <option value="" disabled selected>Select Option</option>
                                                        @foreach ($remarks->options as $remarksOptions)
                                                            <option value="{{ $remarksOptions->option_name }}">
                                                                {{ $remarksOptions->option_name }}</option>
                                                        @endforeach
                                                    </select>
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
                                                        class="form-control border pl-0 arrow-3 h-px-20_custom w-100 font-size-4 d-flex align-items-center w-100">
                                                        <option value="" disabled selected>Select Option</option>
                                                        @foreach ($site->options as $siteOptions)
                                                            <option value="{{ $siteOptions->option_name }}">
                                                                {{ $siteOptions->option_name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                            <div class="form-group mb-0">
                                                @php
                                                    $remarks = Helper::get_dropdown('remarks_from_finance');
                                                @endphp
                                                <label class="Label labelFontSize">
                                                    Remarks (From Recruiter):
                                                </label>
                                                <select disabled="" name="REMARKS_FROM_FINANCE" id="remarks"
                                                    class="form-control border pl-0 arrow-3 h-px-20_custom w-100 font-size-4 d-flex align-items-center w-100">
                                                    <option value="" disabled selected>Select Option</option>
                                                    @foreach ($remarks->options as $remarksOptions)
                                                        <option value="{{ $remarksOptions->option_name }}">
                                                            {{ $remarksOptions->option_name }}
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
                                                    <label class="d-block font-size-3 mb-0 labelFontSize">
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
                                                <div class="form-group mb-0 selectTwoTopMinus">
                                                    @php
                                                        $ReasonForNotP = Helper::get_dropdown('reason_for_not_progressing');
                                                    @endphp
                                                    <label class="Label labelFontSize">
                                                        Reason for not progressing:
                                                    </label>
                                                    <select name="REASONS_FOR_NOT_PROGRESSING" disabled="" id="rfp"
                                                        class="form-control border pl-0 arrow-3 h-px-20_custom w-100 font-size-4 d-flex align-items-center select2_dropdown w-100">
                                                        <option value="" disabled selected>Select Option</option>
                                                        @foreach ($ReasonForNotP->options as $ReasonForNotPOptions)
                                                            <option value="{{ $ReasonForNotPOptions->option_name }}">
                                                                {{ $ReasonForNotPOptions->option_name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
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
                                                <div class="form-group mb-0 selectTwoTopMinus">
                                                    <label class="Label labelFontSize">Interview :</label>
                                                    <input type="date" name="INTERVIEW_SCHEDULE" disabled=""
                                                        id="interview_schedule" class="form-control users-input-S-C" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                @php
                                                    $sub_segment = Helper::get_dropdown('sub_segment');
                                                @endphp
                                                <div class="form-group mb-0 selectTwoTopMinus">
                                                    <label class="Label labelFontSize">sub-segment</label>
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
                                                            <label class="d-block font-size-3 mb-0 labelFontSize">
                                                                Remarks For Recruiter
                                                            </label>
                                                            <select name="REMARKS" id="remarks_finance"
                                                                class="form-control border pl-0 arrow-3 h-px-20_custom w-100 font-size-4 d-flex align-items-center w-100">
                                                                <option value="" selected disabled>Select Option</option>
                                                                @foreach ($remarks->options as $remarksOptions)
                                                                    <option value="{{ $remarksOptions->option_name }}">
                                                                        {{ $remarksOptions->option_name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group mb-0">
                                                            <label class="d-block labelFontSize font-size-3 mb-0">
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
                                                            <label class="d-block labelFontSize font-size-3 mb-0">
                                                                Standard Projected Revenue
                                                            </label>
                                                            <input type="number" name="STANDARD_PROJECTED_REVENUE" id="srp"
                                                                class="form-control h-px-20_custom" readonly />
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group mb-0">
                                                            <label class="d-block labelFontSize font-size-3 mb-0">
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
                                                            <label class="d-block labelFontSize font-size-3 mb-0">
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
                                                            <label class="d-block labelFontSize font-size-3 mb-0">
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
                                                            <label class="d-block labelFontSize font-size-3 mb-0">
                                                                Career level
                                                            </label>
                                                            <select name="CAREER_LEVEL_FINANCE" required="" disabled=""
                                                                id="career_finance" onchange="SPRCalculator(this)"
                                                                class="form-control border h-px-20_custom">
                                                                <option value="" disabled selected>Select Option</option>
                                                                @foreach ($careerLevel->options as $careerLevelOptions)
                                                                    <option
                                                                        value="{{ $careerLevelOptions->option_name }}">
                                                                        {{ $careerLevelOptions->option_name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group mb-0">
                                                            <label class="d-block font-size-3 mb-0 labelFontSize">
                                                                Rate
                                                            </label>
                                                            <select name="RATE" class="form-control border h-px-20_custom"
                                                                id="rate" id="rate_finance" oninput="amountFinder(this)">
                                                                <option value="" selected disabled>Select Option</option>

                                                                <option value="10">10%</option>
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
                                                            <label class="d-block font-size-3 mb-0 labelFontSize">
                                                                Offered Salary
                                                            </label>
                                                            <input type="number" name="OFFERED_SALARY"
                                                                id="off_salary_fianance" readonly
                                                                class="form-control border h-px-20_custom" />
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group mb-0">
                                                            <label class="d-block font-size-3 mb-0 labelFontSize">
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
                                                            <label class="d-block font-size-3 mb-0 labelFontSize">
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
        $(document).ready(function() {
            // show and hide loader after time set starts
            $('#loader').show();
            setTimeout(function() {
                $('#loader').hide();
                $('#loader1').hide();
            }, 1200);
            // show and hide loader after time set ends
        });

        //empty and disable required fields
        // $('#segment').empty();

        // show searcable select using select 2 dropdown
        select2Dropdown("select2_dropdown");
        // $('#new').prop("disabled", true);
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
                    // disable save data button after data entry success
                    $('#save').prop("disabled", true);
                    
                        // show success sweet alert and enable entering new record button
                        // $('#new').prop("disabled", false);
                        swal("success", res.message, "success").then((value) => {});
                    } else if (res.success == false) {

                        // show validation error on scree with border color changed and text
                        if (res.hasOwnProperty("message")) {
                            var err = "";
                            $("input").parent().siblings('span').remove();
                            $("select").parent().siblings('span').remove();
                            $("input").css('border-color', '#ced4da');
                            $("select").css('border-color', '#ced4da');

                            //function for appending span and changing css color for input
                            $.each(res.message, function(i, e) {
                                $("input[name='" + i + "']").css('border',
                                    '1px solid red');
                                $("input[name='" + i + "']").parent().siblings(
                                    'span').remove();
                                $("input[name='" + i + "']").parent().parent()
                                    .append(
                                        '<span style="color:red;" >' + 'Required' + '</span>'
                                    );
                                    $("select[name='" + i + "']").css('border',
                                    '1px solid red');
                                $("select[name='" + i + "']").parent().siblings(
                                    'span').remove();
                                $("select[name='" + i + "']").parent().parent()
                                    .append(
                                        '<span style="color:red;" >' + 'Required' + '</span>'
                                    );
                            });

                            // show warning message to user if firld is required
                            swal({
                                icon: "error",
                                text: "{{ __('Please fill all required fields!') }}",
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
            SegmentChange("Domainsegment");

        }
        // function for (if domain is changed append segments acoordingly) starts

        // function for (if segment is changed append segments acoordingly) starts
        function SegmentChange(elem) {
            $('#Domainsub').empty()
            $('#sub_segment').empty()
            var sub_segmentsDropDown = {!! $sub_segmentsDropDown !!};
            var count = 0;
            for (let i = 0; i < sub_segmentsDropDown.length; i++) {
                if ($('#Domainsegment').val() == sub_segmentsDropDown[i].segment_id) {
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
    </script>
@endsection
