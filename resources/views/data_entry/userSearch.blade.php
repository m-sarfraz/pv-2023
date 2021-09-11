<form id="data_entry" method="post">
    @csrf
    <div class="col-lg-6">
        <!-- ================== -->
        <!-- Candidate section start -->
        <div class="row">
            <fieldset disabled="" id="candidateFieldset">
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
                                                value="{{ $user->last_name }}" name="LAST_NAME" required="" />
                                        </div>
                                        <div><small class="___class_+?36___"></small></div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group mb-0">
                                            <label class="Label">
                                                Middle Initial
                                            </label>
                                            <input type="text" class="form-control users-input-S-C"
                                                value="{{ $user->middle_name }}" name="MIDDLE_NAME" />
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group mb-0">
                                            <label class="Label">*First Name:</label>
                                            <input type="text" class="form-control users-input-S-C"
                                                value="{{ $user->first_name }}" name="FIRST_NAME" required="" />
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
                                                    <option value="{{ $genderOptions->id }}"
                                                        {{ $user->gender == $genderOptions->id ? 'selected' : '' }}>
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
                                            <input type="date" name="DATE_OF_BIRTH" value="{{ $user->dob }}"
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
                                                    <span class="input-group-text EmailIcon" id="inputGroupPrepend2">
                                                        <i class="fa fa-envelope-square"></i>
                                                    </span>
                                                </div>
                                                <input type="text" class="form-control EmailInput-F"
                                                    value="{{ $user->email }}" name="EMAIL_ADDRESS" id="email"
                                                    required="" />
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
                                                    <span class="input-group-text EmailIcon" id="inputGroupPrepend2">
                                                        <i class="fa fa-phone"></i>
                                                    </span>
                                                </div>
                                                <input type="number" class="form-control EmailInput-F"
                                                    value="{{ $user->phone }}" name="CONTACT_NUMBER" required="" />
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
                                                value="{{ $user->address }}" name="RESIDENCE" required="" />
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
                                                class=" form-control p-0 EmailInput-F"
                                                onchange="EducationalAttainChange(this)" id="EDUCATIONAL_ATTAINTMENT">
                                                <option value="" disabled>select option</option>
                                                @foreach ($eduAttainment->options as $eduAttainmentOptions)
                                                    <option
                                                        {{ $user->educational_attain == $eduAttainmentOptions->id ? 'selected' : '' }}
                                                        value="{{ $eduAttainmentOptions->id }}">
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
                                            <select name="COURSE" class="form-control p-0 users-input-S-C" id="COURSE">
                                                @foreach ($course->options as $courseOptions)
                                                    <option value="{{ $courseOptions->id }}" @if ($user->course != null) {
                                                        {{ $user->course == $courseOptions->id ? 'selected' : '' }}
                                                        }
                                                @endif
                                                >
                                                {{ $courseOptions->option_name }}
                                                </option>
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
                                            <label class="Label">
                                                CERTIFICATIONS
                                            </label>
                                            <input type="text" name="CERTIFICATIONS"
                                                value="{{ $user->qualification }}"
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
                                        <textarea name="INTERVIEW_NOTES" rows="3" type="text" id="notes"
                                            value="{{ $user->interview_note }}"
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
                                                    value="{{ $user->date_shifted }}"
                                                    class="form-control users-input-S-C" />
                                                <div>
                                                    <small class="text-danger"></small>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">

                                                <?php
                                                $domain = Helper::get_dropdown('domains');
                                                ?>

                                                <label class="Label">Domains</label>
                                                <select name="DOMAIN" class="form-control p-0 users-input-S-C">
                                                    <option selected disabled></option>
                                                    @foreach ($domain->options as $domainOption)
                                                        <option value="{{ $domainOption->id }}"
                                                            {{ $user->domain == $domainOption->id ? 'selected' : '' }}>
                                                            {{ $domainOption->option_name }}</option>
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
                                                <select name="SEGMENT" class="form-control p-0 users-input-S-C">
                                                    <option selected disabled></option>
                                                    @foreach ($segment->options as $segmentOption)
                                                        <option value="{{ $segmentOption->id }}"
                                                            {{ $user->segment == $segmentOption->id ? 'selected' : '' }}>
                                                            {{ $segmentOption->option_name }}</option>
                                                    @endforeach

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
                                                <select name="SUB_SEGMENT" class="form-control p-0 users-input-S-C">
                                                    <option selected disabled></option>
                                                    @foreach ($sub_segment->options as $sub_segmentOption)
                                                        <option value="{{ $sub_segmentOption->id }}"
                                                            {{ $user->sub_segment == $sub_segmentOption->id ? 'selected' : '' }}>
                                                            {{ $sub_segmentOption->option_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <div>
                                                    <small class="text-danger"></small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-xl-1 mb-9">
                                            <div class="col-lg-12">
                                                <label class="text-black-2 font-size-3 font-weight-semibold mb-0">
                                                    Employement History</label>
                                                <textarea name="EMPLOYMENT_HISTORY" rows="3" type="text"
                                                    value="{{ $user->emp_history }}"
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
                                            <select name="CANDIDATES_PROFILE" class="select2_dropdown w-100"
                                                class="form-control p-0 users-input-S-C">
                                                <option selected disabled></option>
                                                @foreach ($profile->options as $profileOption)
                                                    <option value="{{ $profileOption->id }}"
                                                        {{ $user->candidate_profile == $profileOption->id ? 'selected' : '' }}>
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
                                                value="{{ $user->position_applied }}"
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
                                                value="{{ $user->date_invited }}" id="date_invited"
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
                                            <select name="MANNER_OF_INVITE" onchange="mannerChange(this)" id="manners"
                                                class="form-control p-0 users-input-S-C">
                                                <option selected disabled></option>
                                                @foreach ($manner_of_invite->options as $manner_of_inviteOption)
                                                    <option
                                                        {{ $user->manner_of_invite == $manner_of_inviteOption->id ? 'selected' : '' }}
                                                        value="{{ $manner_of_inviteOption->id }}">
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
                                                value="{{ $user->curr_salary }}" id="current_salary"
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
                                                value="{{ $user->curr_allowance }}" name="CURRENT_ALLOWANCE" />
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
                                                value="{{ $user->exp_salary }}"
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
                                                value="{{ $user->off_salary }}" disabled="" oninput="SalaryAppend()"
                                                class="form-control users-input-S-C" />
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group mb-0">
                                            <label class="Label">
                                                Offered Allowance:
                                            </label>
                                            <input type="number" name="OFFERED_ALLOWANCE" id="off_allowance"
                                                value="{{ $user->off_allowance }}" oninput="SalaryAppend()"
                                                disabled="" class="form-control users-input-S-C" />
                                        </div>
                                    </div>
                                </div>
                            </fieldset>

                            <div class="row">
                                <div class="col-lg-6"></div>
                                <div class="col-lg-6">
                                    <div class="d-flex w-100 flex-wrap gap-2 flex-column form-group col-md-12">
                                        <div class="w-100" style="text-align: end; margin-bottom: 6px;">
                                            <label class="Label"></label>
                                            <input type="file" id="sheetFile" name="file" required=""
                                                value=" " accept="application/pdf"
                                                class="uploadcv  w-100">
                                        </div>
                                        <div class="d-flex justify-flex-end" style="justify-content: flex-end;">
                                            <button type="button" btn_Group href="" download="{{$user->FIRST_NAME}}"  onclick="DownloadCV(this)">
                                                Download Cv
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </fieldset>
        </div>

        <!-- Candidate section end -->
        <!-- ================== -->
    </div>
    <div class="col-lg-6">
        <fieldset disabled="" id="endoFinanceFieldset">

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
                            <select name="APPLICATION_STATUS" id="ap_status" onchange="ApplicationStatusChange(this)"
                                class="form-control border pl-0 arrow-3 h-px-20_custom w-100 font-size-4 d-flex align-items-center w-100">
                                <option value="" selected disabled>Select Option</option>
                                @foreach ($status->options as $statusOptions)
                                    <option value="{{ $statusOptions->id }}"
                                        {{ $user->app_status == $statusOptions->id ? 'selected' : '' }}>
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
                                        <option value="{{ $remarksOptions->id }}"
                                            {{ $user->remarks == $remarksOptions->id ? 'selected' : '' }}>
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
                                    <select name="CLIENT" disabled="" id="client"
                                        class="form-control border pl-0 arrow-3 h-px-20_custom w-100 font-size-4 d-flex align-items-center select2_dropdown w-100">
                                        <option value="" disabled selected>Select Option</option>
                                        @foreach ($client->options as $clientOptions)
                                            <option value="{{ $clientOptions->id }}"
                                                {{ $user->client == $clientOptions->id ? 'selected' : '' }}>
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
                                            <option value="{{ $statusOptions->id }}"
                                                {{ $user->status == $statusOptions->id ? 'selected' : '' }}>
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
                                            <option value="{{ $endoTypeOptions->id }}"
                                                {{ $user->type == $endoTypeOptions->id ? 'selected' : '' }}>
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
                                            <option value="{{ $siteOptions->id }}"
                                                {{ $user->site == $siteOptions->id ? 'selected' : '' }}>
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
                                            <option value="{{ $position_titleOptions->id }}"
                                                {{ $user->site == $siteOptions->id ? 'selected' : '' }}>
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
                                    <select disabled="" id="domain" name="DOMAIN_ENDORSEMENT"
                                        class="form-control border pl-0 arrow-3 h-px-20_custom w-100 font-size-4 d-flex align-items-center w-100">
                                        <option value="" disabled selected>Select Option</option>
                                        @foreach ($domain->options as $domainOptions)
                                            <option value="{{ $domainOptions->id }}"
                                                {{ $user->domain_endo == $domainOptions->id ? 'selected' : '' }}>
                                                {{ $domainOptions->option_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group mb-0">
                                    <label class="Label">Interview :</label>
                                    <input type="date" name="INTERVIEW_SCHEDULE" disabled="" id = "interview_schedule"
                                        class="form-control users-input-S-C" />
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
                                        @foreach ($segments->options as $segmentsOptions)
                                            <option value="{{ $segmentsOptions->id }}"
                                                {{ $user->segment_endo == $siteOptions->id ? 'selected' : '' }}>
                                                {{ $segmentsOptions->option_name }}
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
                                    <label class="d-block font-size-3 mb-0">
                                        Career Level:
                                    </label>
                                    <select name="CAREER_LEVEL" disabled="" id="career"
                                        class="form-control border pl-0 arrow-3 h-px-20_custom w-100 font-size-4 d-flex align-items-center w-100">
                                        <option value="" disabled selected>Select Option</option>
                                        @foreach ($CareerLevel->options as $CareerLevelOptions)
                                            <option value="{{ $CareerLevelOptions->id }}"
                                                {{ $user->career_endo == $CareerLevelOptions->id ? 'selected' : '' }}>
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
                                        @foreach ($sub_segment->options as $sub_segmentOptions)
                                            <option value="{{ $sub_segmentOptions->id }}"
                                                {{ $user->sub_segment_endo == $sub_segmentOptions->id ? 'selected' : '' }}>
                                                {{ $sub_segmentOptions->option_name }}
                                            </option>
                                        @endforeach
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
                                            onchange="setDate()" class="form-control border h-px-20_custom" />
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
                                            <option value="{{ $remarksOptions->id }}"
                                                {{ $user->remarks_for_finance == $remarksOptions->id ? 'selected' : '' }}>
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
                                            <select name="REMARKS" id="remarks"
                                                class="form-control border pl-0 arrow-3 h-px-20_custom w-100 font-size-4 d-flex align-items-center w-100">
                                                <option value="" disabled selected></option>
                                                @foreach ($remarks->options as $remarksOptions)
                                                    <option value="{{ $remarksOptions->id }}"
                                                        {{ $user->remarks_recruiter == $remarksOptions->id ? 'selected' : '' }}>
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
                                            <input type="date" name="ONBOARDING_DATE" id="onboard_date" readonly
                                                value="{{ $user->endo_date }}"
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
                                            <input type="number" name="STANDARD_PROJECTED_REVENUE" id="srp"
                                                value="{{ $user->srp }}" class="form-control h-px-20_custom"
                                                readonly />
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group mb-0">
                                            <label class="d-block font-size-3 mb-0">
                                                Invoice Number
                                            </label>
                                            <input type="number" name="INVOICE_NUMBER" id="invoice_number"
                                                value="{{ $user->invoice_number }}"
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
                                                class="form-control border h-px-20_custom w-100" id="client_finance">
                                                <option value="" disabled selected>Select Option</option>
                                                @foreach ($client->options as $clientOptions)
                                                    <option value="{{ $clientOptions->id }}"
                                                        {{ $user->client_finance == $clientOptions->id ? 'selected' : '' }}>
                                                        {{ $clientOptions->option_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group mb-0">
                                            <label class="d-block font-size-3 mb-0">
                                                Total Bilable Ammount
                                            </label>
                                            <input type="number" name="TOTAL_BILLABLE_AMOUNT" id="bilable_amount"
                                                value="{{ $user->Total_bilable_ammount }}"
                                                oninput="amountFinder(this)"
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
                                            <select name="CAREER_LEVEL_FINANCE" required="" id="career_finance"
                                                class="form-control border h-px-20_custom">
                                                <option value="" disabled selected>Select Option</option>
                                                @foreach ($careerLevel->options as $careerLevelOptions)
                                                    <option value="{{ $careerLevelOptions->id }}"
                                                        {{ $user->career_finance == $careerLevelOptions->id ? 'selected' : '' }}>
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
                                            <select name="RATE" class="form-control border h-px-20_custom" id="rate"
                                                id="rate_finance" oninput="amountFinder(this)">
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
                                            <input type="number" name="OFFERED_SALARY" id="off_salary_fianance" readonly
                                                value="{{ $user->offered_salary }}"
                                                class="form-control border h-px-20_custom" />
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group mb-0">
                                            <label class="d-block font-size-3 mb-0">
                                                Placement Fee
                                            </label>
                                            <input type="number" name="PLACEMENT_FEE" id="placement_fee" readonly
                                                value="{{ $user->placement_fee }}"
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
                                            <input type="number" name="ALLOWANCE" id="off_allowance_finance" readonly
                                                value="{{ $user->allowance }}"
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
        </fieldset>
    </div>
</form>
