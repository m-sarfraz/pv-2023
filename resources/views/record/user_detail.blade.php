<p class="C-Heading pt-3">Record Details:</p>
<div class="card mb-13">
    <div class="card-body">
        <form action="" id="user_detail_form">
            <fieldset disabled="" id="recordFieldset">
                <div class="row mb-1">
                    <div class="col-lg-6">
                        <div class="form-group mb-0">
                            <label class="Label">
                                Candidate Name*:
                            </label>
                            <input type="text" class="form-control" placeholder="enter first name" name="first_name"
                                value="{{ $user->last_name }}">
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group mb-0">
                            @php
                                $gender = Helper::get_dropdown('gender');
                            @endphp
                            <label class="Label">Gender:</label>
                            <select class="w-100 form-control" name="gender">
                                <option value="" {{ $user->gender == null ? 'selected' : '' }} disabled>select option
                                </option>
                                @foreach ($gender->options as $genderOptions)
                                    <option value="{{ $genderOptions->option_name }}"
                                        {{ $user->gender == $genderOptions->option_name ? 'selected' : '' }}>
                                        {{ $genderOptions->option_name }}</option>
                                @endforeach
                            </select>
                            <div>
                                <small class="text-danger"></small>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group mb-0">
                            <label class="Label">DOB:</label>
                            <input type="date" class="form-control users-input-S-C" name="dob"
                                value="{{ Carbon\Carbon::parse($user->dob)->format('Y-m-d') }}">
                        </div>
                    </div>
                </div>
                <div class="row mb-1">
                    <div class="col-lg-6">
                        <div class="form-group mb-0">
                            <label class="Label">Email Address:</label>
                            <input type="text" class="form-control users-input-S-C" placeholder="enter email"
                                name="email" value="{{ $user->email }}" />
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
                            <input type="text" class="form-control users-input-S-C" placeholder="enter you cell"
                                name="phone" value="{{ $user->phone }}" />
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
                                Residendce
                            </label>
                            <input type="text" class="form-control users-input-S-C" value="{{ $user->address }}"
                                name="address" />
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
                            <input type="date" class="form-control users-input-S-C" name="date_shifted"
                                value="{{ Carbon\Carbon::parse($user->date_shifted)->format('Y-m-d') }}" />
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
                                <option value="" {{ $user->source == null ? 'selected' : '' }} disabled>Select Option
                                </option>
                                @foreach ($source->options as $sourceOptions)
                                    <option value="{{ $sourceOptions->option_name }}"
                                        {{ $user->source == $sourceOptions->option_name ? 'selected' : '' }}>
                                        {{ $sourceOptions->option_name }}</option>
                                @endforeach
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
                            <label class="Label">Educational Attachment</label>
                            <?php
                            $eduAttainment = Helper::get_dropdown('educational_attainment');
                            ?>

                            <select name="EDUCATIONAL_ATTAINTMENT" onchange="EducationalAttainChange(this)"
                                class=" form-control p-0 EmailInput-F" id="EDUCATIONAL_ATTAINTMENT">
                                <option value="" {{ $user->educational_attain == null ? 'selected' : '' }} disabled>
                                    Select Option</option>
                                @foreach ($eduAttainment->options as $eduAttainmentOptions)
                                    <option value="{{ $eduAttainmentOptions->option_name }}"
                                        {{ $user->educational_attain == $eduAttainmentOptions->option_name ? 'selected' : '' }}>
                                        {{ $eduAttainmentOptions->option_name }}</option>
                                @endforeach
                            </select>
                            <div>
                                <small class="text-danger"></small>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group mb-0">
                            <label class="Label">Date Invited:</label>
                            <input type="date" class="form-control users-input-S-C" name="date_invited"
                                value="{{ Carbon\Carbon::parse($user->date_invited)->format('Y-m-d') }}" />
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
                                <option {{ $user->manner_of_invite == null ? 'selected' : '' }} disabled></option>
                                @foreach ($manner_of_invite->options as $manner_of_inviteOption)
                                    <option value="{{ $manner_of_inviteOption->option_name }}"
                                        {{ $user->manner_of_invite == $manner_of_inviteOption->option_name ? 'selected' : '' }}>
                                        {{ $manner_of_inviteOption->option_name }}
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
                            <?php
                            $course = Helper::get_dropdown('course');
                            ?>
                            <label class="Label">Course:</label>
                            <select name="COURSE" class="form-control p-0 users-input-S-C" id="COURSE">
                                <option {{ $user->course == null ? 'selected' : '' }} disabled>Select Option</option>
                                @foreach ($course->options as $courseOptions)
                                    <option value="{{ $courseOptions->option_name }}" @if ($user->course != null) {
                                        {{ $user->course == $courseOptions->option_name ? 'selected' : '' }}
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
                    <div class="col-lg-3">
                        <div class="form-group mb-0">
                            <label class="Label">
                                Current Salary:
                            </label>
                            <input type="text" class="form-control users-input-S-C" name="curr_salary"
                                value="{{ $user->curr_salary }}" />
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
                            <input type="text" class="form-control users-input-S-C" name="curr_allowance"
                                value="{{ $user->curr_allowance }}" />
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
                                <option {{ $user->domains == null ? 'selected' : '' }} disabled>Select Option
                                </option>
                                @foreach ($domainDrop as $domainOption)
                                    <option value="{{ $domainOption->id }}"
                                        {{ $user->domain == $domainOption->option_name ? 'selected' : '' }}>
                                        {{ $domainOption->domain_name }}</option>
                                @endforeach
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
                            <input type="text" class="form-control users-input-S-C" name="expec_salary"
                                value="{{ $user->exp_salary }}" />
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
                            <input type="text" class="form-control users-input-S-C" name="offered_salary"
                                value="{{ $user->off_salary }}" />
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
                                <option {{ $user->segment == null ? 'selected' : '' }} disabled>Select Option
                                </option>
                                @foreach ($segments->options as $segmentsOptions)
                                    <option value="{{ $segmentsOptions->id }}"
                                        {{ $user->segment == $segmentsOptions->option_name ? 'selected' : '' }}>
                                        {{ $segmentsOptions->option_name }}
                                    </option>
                                @endforeach
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
                                Sub Segment:
                            </label>
                            <select name="sub_segment" id="Domain_sub_segment"
                                class="form-control p-0 users-input-S-C">
                                <option disabled>Select Option</option>
                                @foreach ($sub_segment->options as $sub_segmentOptions)
                                    <option value="{{ $sub_segmentOptions->id }}">
                                        {{ $sub_segmentOptions->option_name }}
                                    </option>
                                @endforeach
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
                            <input type="text" class="form-control users-input-S-C" name="offered_allowance"
                                value="{{ $user->off_allowance }}" />
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
                            <label class="Label">Profile:</label>
                            <select name="CANDIDATES_PROFILE" id="CANDIDATES_PROFILE" class="select2_dropdown w-100"
                                class="form-control p-0 users-input-S-C" onchange="Fetch_profile()">
                                <option {{ $user->candidate_profile == null ? 'selected' : '' }} disabled></option>
                                @foreach ($profile->options as $profileOption)
                                    <option value="{{ $profileOption->option_name }}"
                                        {{ $user->candidate_profile == $profileOption->option_name ? 'selected' : '' }}>
                                        {{ $profileOption->option_name }}
                                    </option>
                                @endforeach
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
                            <input type="date" class="form-control users-input-S-C" name="date_processed"
                                id="date_processed"
                                value="{{ Carbon\Carbon::parse($user->endi_date)->format('Y-m-d') }}" />
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
                                <option {{ $user->app_status == null ? 'selected' : '' }} disabled>Select Option
                                </option>
                                {{-- @dd($user->app_status) --}}
                                @foreach ($status->options as $statusOptions)
                                    <option value="{{ $statusOptions->option_name }}"
                                        {{ $user->app_status == $statusOptions->option_name ? 'selected' : '' }}>
                                        {{ $statusOptions->option_name }}
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
                            <label class="Label">Position Applied:</label>
                            <input type="text" class="form-control users-input-S-C" name="position_applied"
                                value="{{ $user->position_applied }}" />
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
                            <textarea name="notes" rows="3" type="text" class="form-control border E_H h-px-20_custom"
                                value="" placeholder="Enter Interview Notes">{{ $user->interview_note }}</textarea>
                        </div>
                        <div class="pt-3">
                            <div class="form-group mb-0">
                                <label class="d-block font-size-3 mb-0">
                                    Employment History:
                                </label>
                                <textarea name="EMPLOYMENT_HISTORY" rows="3" type="text"
                                    class="form-control border E_H h-px-20_custom"
                                    placeholder="Enter Interview Notes">{{ $user->emp_history }}</textarea>

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
                                <option {{ $user->certification == null ? 'selected' : '' }} disabled></option>
                                @foreach ($certificate->options as $certificateOption)
                                    <option value="{{ $certificateOption->option_name }}"
                                        {{ $user->certification == $certificateOption->option_name ? 'selected' : '' }}>
                                        {{ $certificateOption->option_name }}</option>
                                @endforeach
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
                                                    <select name="ENDORSEMENT_TYPE" id="endo_type"
                                                        class="form-control border pl-0 arrow-3 h-px-20_custom w-100 font-size-4 d-flex align-items-center w-100">
                                                        <option {{ $user->type == null ? 'selected' : '' }} disabled>
                                                            Select Option</option>
                                                        @foreach ($endoType->options as $endoTypeOptions)
                                                            <option value="{{ $endoTypeOptions->option_name }}"
                                                                {{ $user->type == $endoTypeOptions->option_name ? 'selected' : '' }}>
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
                                                <div class="form-group mb-0">
                                                    @php
                                                        $CareerLevel = Helper::get_dropdown('career_level');
                                                    @endphp
                                                    <label class="Label-00">
                                                        Career Level:
                                                    </label>
                                                    <select name="CAREER_LEVEL" id="career"
                                                        class="form-control border pl-0 arrow-3 h-px-20_custom w-100 font-size-4 d-flex align-items-center w-100">
                                                        <option {{ $user->career_endo == null ? 'selected' : '' }}
                                                            disabled>Select Option</option>
                                                        @foreach ($CareerLevel->options as $CareerLevelOptions)
                                                            <option value="{{ $CareerLevelOptions->option_name }}"
                                                                {{ $user->career_endo == $CareerLevelOptions->option_name ? 'selected' : '' }}>
                                                                {{ $CareerLevelOptions->option_name }}
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
                                                @php
                                                    $site = Helper::get_dropdown('site');
                                                @endphp
                                                <div class="form-group mb-0">
                                                    <label class="Label-00">Site</label>
                                                    <select name="SITE" id="site"
                                                        class="form-control border pl-0 arrow-3 h-px-20_custom w-100 font-size-4 d-flex align-items-center w-100">
                                                        <option {{ $user->site == null ? 'selected' : '' }} disabled>
                                                            Select Option</option>
                                                        @foreach ($site->options as $siteOptions)
                                                            <option value="{{ $siteOptions->option_name }}"
                                                                {{ $user->site == $siteOptions->option_name ? 'selected' : '' }}>
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
                                                <div class="form-group mb-0">
                                                    <label class="Label-00 ">
                                                        Remarks (for Finance)
                                                    </label>
                                                    <select name="REMARKS_FOR_FINANCE" disabled=""
                                                        id="remarks_for_finance" onchange="RemarksChange(this)"
                                                        class="form-control select2_dropdown border pl-0 arrow-3 h-px-20_custom w-100 font-size-4 d-flex align-items-center w-100">
                                                        @php
                                                            $remarks = Helper::get_dropdown('remarks_for_finance');
                                                        @endphp
                                                        <option
                                                            {{ $user->remarks_for_finance == null ? 'selected' : '' }}
                                                            disabled>Select Option</option>
                                                        @foreach ($remarks->options as $remarksOptions)
                                                            <option value="{{ $remarksOptions->option_name }}"
                                                                {{ $user->remarks_for_finance == $remarksOptions->option_name ? 'selected' : '' }}>
                                                                {{ $remarksOptions->option_name }}</option>
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

                                                    <label class="Label-00">
                                                        Client
                                                    </label>
                                                    {{-- @dd($user->client) --}}
                                                    <select name="CLIENT_FINANCE"
                                                        class="form-control border h-px-20_custom w-100"
                                                        id="client_finance" disabled="">
                                                        <option {{ $user->client == null ? 'selected' : '' }}
                                                            disabled>Select Option</option>
                                                        @foreach ($client as $clientOptions)
                                                            <option value="{{ $clientOptions->client }}"
                                                                {{ $user->client == $clientOptions->client ? 'selected' : '' }}>
                                                                {{ $clientOptions->client }}
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
                                                        $status = Helper::get_dropdown('status');
                                                    @endphp
                                                    <label class="Label-00">
                                                        Status:
                                                    </label>
                                                    <select name="STATUS" id="status" disabled=""
                                                        class="form-control border pl-0 arrow-3 h-px-20_custom w-100 font-size-4 d-flex align-items-center w-100">
                                                        <option {{ $user->status == null ? 'selected' : '' }}
                                                            disabled>Select Option</option>
                                                        @foreach ($status->options as $statusOptions)
                                                            <option value="{{ $statusOptions->option_name }}"
                                                                {{ $user->status == $statusOptions->option_name ? 'selected' : '' }}>
                                                                {{ $statusOptions->option_name }}
                                                            </option>
                                                        @endforeach
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
                                                        <option {{ $user->position_title == null ? 'selected' : '' }}
                                                            disabled>Select Option</option>
                                                        @foreach ($pos_title as $position_titleOptions)
                                                            <option value="{{ $position_titleOptions->position }}"
                                                                {{ $user->position_title == $position_titleOptions->position ? 'selected' : '' }}>
                                                                {{ $position_titleOptions->position }}
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
                                                        $ReasonForNotP = Helper::get_dropdown('reason_for_not_progressing');
                                                    @endphp
                                                    <label class="Label-00">
                                                        Reason for not progressing:
                                                    </label>
                                                    <select name="REASONS_FOR_NOT_PROGRESSING" id="rfp"
                                                        class="form-control border pl-0 arrow-3 h-px-20_custom w-100 font-size-4 d-flex align-items-center select2_dropdown w-100">
                                                        <option {{ $user->rfp == null ? 'selected' : '' }} disabled>
                                                            Select Option</option>
                                                        @foreach ($ReasonForNotP->options as $ReasonForNotPOptions)
                                                            {{ $user->rfp == $ReasonForNotP->option_name ? 'selected' : '' }}>
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
                                                        <option {{ $user->domain == null ? 'selected' : '' }}
                                                            disabled>Select Option</option>
                                                        @foreach ($domainDrop as $domainOption)
                                                            <option value="{{ $domainOption->id }}"
                                                                {{ $user->domain == $domainOption->option_name ? 'selected' : '' }}>
                                                                {{ $domainOption->domain_name }}</option>
                                                        @endforeach
                                                    </select>
                                                    <div>
                                                        <small class="text-danger"></small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group mb-0">
                                                    <label class="Label">Interview Schedule:</label>
                                                    <input type="date" name="INTERVIEW_SCHEDULE" id="interview_schedule"
                                                        value="{{ Carbon\Carbon::parse($user->interview_date)->format('Y-m-d') }}"
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
                                                        class="w-100 form-control" onchange="changeSegment(this)">
                                                        <option {{ $user->segment == null ? 'selected' : '' }}
                                                            disabled>Select Option</option>
                                                        @foreach ($segments->options as $segmentsOptions)
                                                            <option value="{{ $segmentsOptions->id }}"
                                                                {{ $user->segment == $segmentsOptions->option_name ? 'selected' : '' }}>
                                                                {{ $segmentsOptions->option_name }}
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
                                                    $remarks = Helper::get_dropdown('remarks_from_finance');
                                                @endphp
                                                <div class=" mb-0">
                                                    <label class="Label">Remarks (From
                                                        Recruiter):</label>
                                                    <select name="REMARKS_FROM_FINANCE" id="remarks"
                                                        class="form-control border pl-0 arrow-3 h-px-20_custom w-100 font-size-4 d-flex align-items-center w-100">
                                                        <option {{ $user->remarks == null ? 'selected' : '' }}
                                                            disabled>Select Option</option>
                                                        @foreach ($remarks->options as $remarksOptions)
                                                            <option value="{{ $remarksOptions->option_name }}"
                                                                {{ $user->remarks == $remarksOptions->option_name ? 'selected' : '' }}>
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
                                                    <label class="Label-00 ">
                                                        Sub-Segment:
                                                    </label>
                                                    <select name="endo_sub_segment " id="endo_sub_segment"
                                                        class="w-100  form-control">
                                                        <option {{ $user->sub_segment == null ? 'selected' : '' }}
                                                            disabled>Select Option</option>
                                                        @foreach ($sub_segment->options as $sub_segmentOptions)
                                                            <option value="{{ $sub_segmentOptions->id }}"
                                                                {{ $user->sub_segment == $sub_segmentOptions->option_name ? 'selected' : '' }}>
                                                                {{ $sub_segmentOptions->option_name }}
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
                                                    <label class="Label">Endo Date:</label>
                                                    <input type="date" name="DATE_ENDORSED" id="endo_date"
                                                        value="{{ Carbon\Carbon::parse($user->endi_date)->format('Y-m-d') }}"
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
                                                    <label class="Label-00">
                                                        Date Updated:
                                                    </label>
                                                    <input type="date" name="DATE_UNDATED" id="DATE_UNDATED"
                                                        value="{{ Carbon\Carbon::parse($user->endi_date)->format('Y-m-d') }}"
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
            @if ($user->cv)
                <a class="btn btn-success mt-5 btn-md" type="button" target="blank"
                    href="{{ asset('assets/cv/' . $user->cv) }}" {{-- onclick="downloadCv('{{ $user->cid }}' , '{{ url('admin/download_cv') }}')" --}}>Download CV</a>
            @endif
            @if (Auth::user()->id == $user->saved_by)
                @can('edit-record')

                    <button class="btn btn-primary mt-5 btn-md"
                        onclick="UpdateRecord('{{ $user->cid }}')">Update</button>
                @endcan

            @else
                <a type="button" href="{{ url('admin/data-entry') }}?id={{ $user->cid }}"
                    class="btn btn-primary mt-5 btn-md">Tap</a>
            @endif
        </form>
    </div>
</div>

<script>
    var recruiter = "{{ Auth::user()->id }}";
    var candidate = "{{ $user->saved_by }}";
    if (recruiter == candidate) {
        $('#recordFieldset').prop("disabled", false)
    } else {
        $('#recordFieldset').prop("disabled", true)
    }
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

    function Fetch_profile() {
        $('#Domain_sub_segment').empty()
        $('#segment').empty()
        $('#domain').empty()
        $('#endo_sub_segment').empty()
        $('#Domainsegment').empty()
        $('#domain_endo').empty()



        var c_profile = $('#CANDIDATES_PROFILE').val();
        var position = $('#position').val()
        $.ajax({
            type: 'POST',
            url: '{{ url('admin/traveseDataByClientProfile') }}',
            data: {
                _token: token,
                c_profile: c_profile,
                position: position,

            },

            // Success fucniton of Ajax
            success: function(res) {
                console.log(res)
                $('#Domain_sub_segment').append(`<option> ${res.data.s_segment}</option>`)
                $('#segment').append(`<option>${res.data.segment}</option>`)
                $('#domain').append(`<option>${res.data.domain}</option>`)
                $('#endo_sub_segment').append(`<option> ${res.data.s_segment}</option>`)
                $('#Domainsegment').append(`<option>${res.data.segment}</option>`)
                $('#domain_endo').append(`<option>${res.data.domain}</option>`)
            },
        });

    }
    $("#date_processed").on('input', function() {
        if($('#endo_type').val()=='Endorsed'){$("#endo_date").val(this.value)}
    });
    $("#endo_date").on("input", function() {
        if($('#endo_type').val()=='Endorsed'){$("#date_processed").val(this.value)}
    });
</script>
