<style>
    select[readonly] {
        background: rgb(134, 52, 52);
        pointer-events: none;
        touch-action: none;
    }
</style>
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
                            <input type="text" class="form-control" placeholder="enter first name" name="first_name"
                                value="{{ $user->first_name . ' ' . $user->middle_name . ' ' . $user->last_name }}"
                                readonly>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group mb-0">
                            @php
                                $gender = Helper::get_dropdown('gender');
                            @endphp
                            <label class="Label">Gender:</label>
                            <select class="w-100 form-control" name="gender">
                                <option value="" {{ $user->gender == null ? 'selected' : '' }} disabled>select
                                    option
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
                                value="{{ $user->dob != null  ? Carbon\Carbon::parse($user->dob)->format('Y-m-d') : '' }}">
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
                            <input type="number" class="form-control users-input-S-C" placeholder="enter you cell" min="0"
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
                                Residence
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
                                value="{{$user->date_shifted != null  ? Carbon\Carbon::parse($user->date_shifted)->format('Y-m-d') : '' }}" />
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
                                <option value="" {{ $user->source == null ? 'selected' : '' }} disabled>Select
                                    Option
                                </option>
                                @foreach ($source->options as $sourceOptions)
                                    <option value="{{ $sourceOptions->option_name }}"
                                        {{ strtolower($user->source) == strtolower($sourceOptions->option_name) ? 'selected' : '' }}>
                                        {{ $sourceOptions->option_name }}</option>
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
                            <label class="Label">Educational Attainment</label>
                            <?php
                            $eduAttainment = Helper::get_dropdown('educational_attainment');
                            ?>

                            <select name="EDUCATIONAL_ATTAINTMENT" onchange="EducationalAttainChange(this)"
                                class=" form-control p-0 EmailInput-F" id="EDUCATIONAL_ATTAINTMENT">
                                <option value="" {{ $user->educational_attain == null ? 'selected' : '' }}
                                    disabled>
                                    Select Option</option>
                                @foreach ($eduAttainment->options as $eduAttainmentOptions)
                                    <option value="{{ $eduAttainmentOptions->option_name }}"
                                        {{ strtolower($user->educational_attain) == strtolower($eduAttainmentOptions->option_name) ? 'selected' : '' }}>
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
                                value="{{ $user->date_invited != null  ? Carbon\Carbon::parse($user->date_invited)->format('Y-m-d') : '' }}" />
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
                                        {{ strtolower($user->manner_of_invite) == strtolower($manner_of_inviteOption->option_name) ? 'selected' : '' }}>
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
                                    <option value="{{ strtoupper($courseOptions->option_name) }}"
                                        @if ($user->course != null) {{ strtoupper($courseOptions->option_name) == strtoupper($user->course) ? 'selected' : '' }} @endif>
                                        {{ strtoupper($courseOptions->option_name) }}
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
                            <input type="number" class="form-control users-input-S-C" name="curr_salary"
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
                            <input type="number" class="form-control users-input-S-C" name="curr_allowance"
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

                            <select name="DOMAIN" id="domain" class="form-control p-0 users-input-S-C" readonly
                                {{-- onchange="DomainChange(this)" --}}>
                                <option {{ $user->domain == null ? 'selected' : '' }} disabled>Select Option
                                </option>
                                @foreach ($domainDrop as $domainOption)
                                    <option value="{{ $domainOption->domain_name }}"
                                        {{ strtolower($user->domain) == strtolower($domainOption->domain_name) ? 'selected' : '' }}>
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
                            <input type="number" class="form-control users-input-S-C" name="expec_salary"
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
                            <input type="number" class="form-control users-input-S-C" name="offered_salary"
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
                                $segments = App\Segment::get();
                            @endphp
                            <label class="Label">Segment:</label>
                            <select name="segment" id="segment" class="form-control p-0 users-input-S-C" readonly
                                {{-- onchange="SegmentChange(this) --}} ">
                                <option {{ $user->segment == null ? 'selected' : '' }} disabled>Select Option
                                </option>
                                 @foreach ($segments as $segmentsOptions)
                                <option value="{{ $segmentsOptions->segment_name }}"
                                    {{ strtolower($user->segment) == strtolower($segmentsOptions->segment_name) ? 'selected' : '' }}>
                                    {{ $segmentsOptions->segment_name }}
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
                                $sub_segments = App\SubSegment::get();
                            @endphp
                            <label class="Label">
                                Sub-Segment:
                            </label>
                            <select name="sub_segment" id="Domain_sub_segment" readonly
                                class="form-control p-0 users-input-S-C">
                                <option {{ $user->sub_segment == null ? 'selected' : '' }} disabled>Select Option
                                </option>

                                @foreach ($sub_segments as $Options)
                                    <option value="{{ $Options->sub_segment_name }}"
                                        {{ str_replace(' ', '', strtolower($user->sub_segment)) == str_replace(' ', '', strtolower($Options->sub_segment_name)) ? 'selected' : '' }}>
                                        {{ $Options->sub_segment_name }}
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
                            <input type="number" class="form-control users-input-S-C" name="offered_allowance"
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
                        $profile = App\CandidateProfile_Dropdown::select('c_profile')->get();

                        ?>
                        <div class="form-group mb-0">
                            <label class="Label">Candidate’s Profile:</label>
                            <select name="CANDIDATES_PROFILE" id="CANDIDATES_PROFILE" class="select2_dropdown w-100"
                                class="form-control p-0 users-input-S-C" onchange="Fetch_profile()">
                                <option {{ $user->candidate_profile == null ? 'selected' : '' }} disabled></option>
                                @foreach ($profile as $profileOption)
                                    <option value="{{ $profileOption->c_profile }}"
                                        {{ strtolower($user->candidate_profile) == strtolower($profileOption->c_profile) ? 'selected' : '' }}>
                                        {{ $profileOption->c_profile }}
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
                                value="{{ $user->endi_date != null  ? Carbon\Carbon::parse($user->endi_date)->format('Y-m-d') : ''}}" />
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
                            <select name="APPLICATION_STATUS" id="ap_status" onchange="ApplicationStatusChange(this)"
                                class="form-control border pl-0 arrow-3 h-px-20_custom w-100 font-size-4 d-flex align-items-center w-100">
                                <option {{ $user->app_status == null ? 'selected' : '' }} disabled>Select Option
                                </option>
                                {{-- @dd($user->app_status) --}}
                                @foreach ($status->options as $statusOptions)
                                    <option value="{{ $statusOptions->option_name }}"
                                        {{ strtolower($user->app_status) == strtolower($statusOptions->option_name) ? 'selected' : '' }}>
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
                    <?php
                    $recruiter = App\User::where('id', $user->recruiter_id)->first();
                    ?>
                    <div class="col-lg-6">
                        <div class="form-group mb-0">
                            <label class="Label">
                                Sifted By:
                            </label>
                            <input readonly type="text" class="form-control users-input-S-C"
                                value="{{ $recruiter->name }}" name="shifted_by" />
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
                                <textarea name="EMPLOYMENT_HISTORY" rows="3" type="text" class="form-control border E_H h-px-20_custom"
                                    placeholder="Enter Interview Notes">{{ $user->emp_history }}</textarea>

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group mb-0">
                            <?php
                            $certificate = Helper::get_dropdown('certifications');
                            $arr = explode(',', $user->certification);
                            ?>

                            <label class="Label">
                                CERTIFICATIONS
                            </label>
                            {{-- @dd( $arr ) --}}
                            <select multiple name="CERTIFICATIONS[]" id="certificate"
                                class="form-control p-0 users-input-S-C select2_dropdown w-100">
                                <option disabled></option>
                                @foreach ($certificate->options as $certificateOption)
                                    <option value="{{ $certificateOption->option_name }}"
                                        {{ in_array($certificateOption->option_name, $arr) ? 'selected' : '' }}>
                                        {{ $certificateOption->option_name }}</option>
                                @endforeach
                            </select>
                            {{-- <select name="CERTIFICATIONS" class="form-control users-input-S-C">
                                <option {{ $user->certification == null ? 'selected' : '' }} disabled></option>
                                @foreach ($certificate->options as $certificateOption)
                                    <option value="{{ $certificateOption->option_name }}"
                                        {{ $user->certification == $certificateOption->option_name ? 'selected' : '' }}>
                                        {{ $certificateOption->option_name }}</option>
                                @endforeach
                            </select> --}}
                            <div>
                                <small class="text-danger"></small>
                            </div>
                        </div>
                        <div class="E_NEG">
                            <p class="C-Heading pt-5 mt-4">Endorsement Details:</p>
                            <div class="card mb-13">
                                <div class="card-body">
                                    <fieldset id="fieldset_endorsement" disabled="">
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
                                                            <option {{ $user->type == null ? 'selected' : '' }}
                                                                disabled>
                                                                Select Option</option>
                                                            @foreach ($endoType->options as $endoTypeOptions)
                                                                <option value="{{ $endoTypeOptions->option_name }}"
                                                                    {{ strtolower($user->type) == strtolower($endoTypeOptions->option_name) ? 'selected' : '' }}>
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
                                                            {{-- onchange="DomainSegmentAppend()" --}}
                                                            class="form-control border pl-0 arrow-3 h-px-20_custom w-100 font-size-4 d-flex align-items-center w-100">
                                                            <option {{ $user->career_endo == null ? 'selected' : '' }}
                                                                disabled>Select Option</option>
                                                            @foreach ($CareerLevel->options as $CareerLevelOptions)
                                                                <option value="{{ $CareerLevelOptions->option_name }}"
                                                                    {{ strtolower($user->career_endo) == strtolower($CareerLevelOptions->option_name) ? 'selected' : '' }}>
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
                                                            <option {{ $user->site == null ? 'selected' : '' }}
                                                                disabled>
                                                                Select Option</option>
                                                            @foreach ($site->options as $siteOptions)
                                                                <option value="{{ $siteOptions->option_name }}"
                                                                    {{ strtolower($user->site) == strtolower($siteOptions->option_name) ? 'selected' : '' }}>
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
                                                            Remarks (For Finance)
                                                        </label>
                                                        <select name="REMARKS_FOR_FINANCE" id="remarks_for_finance"
                                                            disabled="" onchange="RemarksChanges(this)"
                                                            class="form-control select2_dropdown border pl-0 arrow-3 h-px-20_custom w-100 font-size-4 d-flex align-items-center w-100">
                                                            @php
                                                                $remarks = Helper::get_dropdown('remarks_for_finance');
                                                            @endphp
                                                            <option
                                                                {{ $user->remarks_for_finance == null ? 'selected' : '' }}
                                                                disabled>Select Option</option>
                                                            @foreach ($remarks->options as $remarksOptions)
                                                                <option value="{{ $remarksOptions->option_name }}"
                                                                    {{ strtolower($user->remarks_for_finance) == strtolower($remarksOptions->option_name) ? 'selected' : '' }}>
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
                                                    @php
                                                        $client = Helper::get_dropdown('clients');
                                                    @endphp
                                                    <div class="form-group mb-0">

                                                        <label class="Label-00">
                                                            Client
                                                        </label>
                                                        {{-- @dd($user->client) --}}
                                                        <select name="CLIENT_FINANCE" disabled=""
                                                            onchange="clientChanged('position-title',this)"
                                                            class="form-control border h-px-20_custom select2_dropdown w-100"
                                                            id="client_finance">
                                                            <option {{ $user->client == null ? 'selected' : '' }}
                                                                disabled>Select Option</option>
                                                            @foreach ($client->options as $clientOptions)
                                                                <option value="{{ $clientOptions->option_name }}"
                                                                    {{ strtolower($user->client) == strtolower($clientOptions->option_name) ? 'selected' : '' }}>
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
                                                            $status = Helper::get_dropdown('data_entry_status');
                                                        @endphp
                                                        <label class="Label-00">
                                                            Status:
                                                        </label>

                                                        <select name="STATUS" id="status"
                                                            class="form-control border pl-0 arrow-3 h-px-20_custom w-100 font-size-4 d-flex align-items-center w-100">
                                                            <option {{ $user->endostatus == null ? 'selected' : '' }}
                                                                disabled>Select Option</option>
                                                            @foreach ($status->options as $statusOptions)
                                                                <option value="{{ $statusOptions->option_name }}"
                                                                    {{ strtolower($user->endostatus) == strtolower($statusOptions->option_name) ? 'selected' : '' }}>
                                                                    {{ $statusOptions->option_name }}
                                                                </option>
                                                            @endforeach

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
                                                        <div id="loader2" class="d-none"></div>

                                                        <select name="POSITION_TITLE" id="position"
                                                            {{-- onchange="Fetch_profile()" --}}
                                                            class="form-control border pl-0 arrow-3 h-px-20_custom w-100 font-size-4 d-flex align-items-center select2_dropdown w-100">
                                                            <option
                                                                {{ $user->position_title == null ? 'selected' : '' }}
                                                                disabled>Select Option</option>
                                                            @foreach ($pos_title as $position_titleOptions)
                                                                <option value="{{ $position_titleOptions->position }}"
                                                                    {{ strtolower($user->position_title) == strtolower($position_titleOptions->position) ? 'selected' : '' }}>
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
                                                            disabled=""
                                                            class="form-control border pl-0 arrow-3 h-px-20_custom w-100 font-size-4 d-flex align-items-center select2_dropdown w-100">
                                                            <option {{ $user->rfp == null ? 'selected' : '' }}
                                                                disabled>
                                                                Select Option</option>
                                                            @foreach ($ReasonForNotP->options as $ReasonForNotPOptions)
                                                                {{ $user->rfp == $ReasonForNotP->option_name ? 'selected' : '' }}>
                                                                <option
                                                                    value="{{ $ReasonForNotPOptions->option_name }}"
                                                                    {{ $user != null ? ($user->rfp != null ? (strtolower($user->rfp) == strtolower($ReasonForNotPOptions->option_name) ? 'selected' : '') : ''):'' }}>
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
                                                        {{-- @dd($user->domain_endo) --}}
                                                        <select name="DOMAIN_endo" id="domain_endo" readonly
                                                            {{-- onchange="DomainChange(this)" --}}
                                                            class="form-control p-0 users-input-S-C">
                                                            <option {{ $user->domain == null ? 'selected' : '' }}
                                                                disabled>Select Option</option>
                                                            @foreach ($domainDrop as $domainOption)
                                                                <option value="{{ $domainOption->domain_name }}"
                                                                    {{ strtolower($user->domain_endo) == strtolower($domainOption->domain_name) ? 'selected' : '' }}>
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
                                                        <input type="date" name="INTERVIEW_SCHEDULE"
                                                            id="interview_schedule"
                                                            value="{{ $user->interview_date != null ? Carbon\Carbon::parse($user->interview_date)->format('Y-m-d') : '' }}"
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

                                                        <label class="Label">Segment:</label>
                                                        <select name="endo_segment" id="Domainsegment" readonly
                                                            class="form-control p-0 users-input-S-C"
                                                            {{-- onchange="SegmentChange(this)" --}}>
                                                            <option {{ $user->segment == null ? 'selected' : '' }}
                                                                disabled>Select Option
                                                            </option>
                                                            @foreach ($segments->options as $segmentsOptions)
                                                                <option value="{{ $segmentsOptions->segment_name }}"
                                                                    {{ strtolower($user->segment_endo) == strtolower($segmentsOptions->option_name) ? 'selected' : '' }}>
                                                                    {{ $segmentsOptions->option_name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        <div>
                                                            <small class="text-danger"></small>
                                                        </div>
                                                    </div>
                                                </div>
                                                {{-- <div class="col-lg-6">
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
                                                                    {{ strtolower($user->remarks) == strtolower($remarksOptions->option_name) ? 'selected' : '' }}>
                                                                    {{ $remarksOptions->option_name }}
                                                                </option>
                                                            @endforeach
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
                                                            value="{{ $user->endi_date != null ? Carbon\Carbon::parse($user->endi_date)->format('Y-m-d') : '' }}"
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
                                                        @php
                                                            $sub_segments = Helper::get_dropdown('sub_segment');
                                                        @endphp
                                                        <label class="Label-00 ">
                                                            Sub-Segment:
                                                        </label>
                                                        <select name="endo_sub_segment" id="endo_sub_segment" readonly
                                                            class="w-100  form-control">
                                                            <option {{ $user->sub_segment == null ? 'selected' : '' }}
                                                                disabled>Select Option</option>
                                                            @foreach ($sub_segments->options as $Options)
                                                                <option value="{{ $Options->sub_segment_name }}"
                                                                    {{ str_replace(' ', '', strtolower($user->sub_segment_endo)) == str_replace(' ', '', strtolower($Options->option_name)) ? 'selected' : '' }}>
                                                                    {{ $Options->option_name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        <div>
                                                            <small class="text-danger"></small>
                                                        </div>
                                                    </div>
                                                </div>

                                                {{-- <div class="row mb-1"> --}}
                                                <div class="col-lg-6">
                                                    <div class="form-group mb-0">
                                                        <label class="Label-00">
                                                            Date Updated:
                                                        </label>

                                                        <input type="date" name="DATE_UNDATED" id="DATE_UNDATED"
                                                            value="{{ $user->updated_at != null ? Carbon\Carbon::parse($user->updated_at)->format('Y-m-d') : '' }}"
                                                            class="form-control border h-px-20_custom" />
                                                        <div>
                                                            <small class="text-danger"></small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                </div>
        </form>
        </fieldset>
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
@if (Auth::user()->id == $user->recruiter_id)
    @can('edit-record')
        <button class="btn btn-primary mt-5 btn-md"
            onclick="UpdateRecord('{{ $user->id . '-' . $user->numberOfEndo }}')">Update</button>
    @endcan
@else
    <a type="button" href="{{ url('admin/data-entry') }}?id={{ $user->id }}"
        class="btn btn-primary mt-5 btn-md">Tap</a>
@endif
@if (Auth::user()->type == 1)
    <button class="btn btn-danger mt-5 btn-md"
        onclick="verifyDeleteRecord('{{ $user->id . '-' . $user->numberOfEndo . '-' . $user->recruiter_id }}')">Delete
        Record</button>
@endif

</form>
</div>
</div>
<script src="{{ asset('assets/js/data-entry.js') }}"></script>
<script src="{{ asset('assets/js/sweetalert2.all.min.js') }}"></script>

<script>
    var apendtoOption = '';
    $(document).ready(function() {
        apendtoOption = <?php echo json_encode($user->remarks_for_finance); ?>;
        appendRemarksForFinance(1)
        $('#status').change();
    });

    function verifyDeleteRecord(id) {
        Swal.fire({
                icon: 'warning',
                text: "Would you like to Delete this record?",
                type: 'warning',
                showCancelButton: true,
                showconfirmButton: true,
                cancelButtonText: 'No',
                confirmButtonText: 'Yes',
            })

            .then((isConfirm) => {
                if (isConfirm.value) {
                    DeleteRecord(id);
                } else if (isConfirm.dismiss == 'cancel') {
                    Swal.fire({
                        position: 'center',
                        icon: 'error',
                        title: 'Record has not been Deleted!',
                        showConfirmButton: false,
                        timer: 1000
                    })
                }
            })
    }
    $('#client_finance').change();

    function DeleteRecord(id) {
        $.ajax({
            type: 'POST',
            url: '{{ url('admin/deleteCandidateData') }}',
            data: {
                _token: token,
                id: id,

            },

            // Success fucniton of Ajax
            success: function(res) {
                if (res.success == true) {
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: res.message,
                        showConfirmButton: false,
                        timer: 4000
                    })
                    location.reload();
                } else if (res.success == false) {
                    Swal.fire({
                        position: 'center',
                        icon: 'warning',
                        title: res.message,
                        showConfirmButton: false,
                        timer: 4000
                    })

                }
            }
        });
    }

    function ApplicationStatusChange(elem) {
        if ($(elem).val().toLowerCase() == 'to be endorsed') {
            $('#fieldset_endorsement').prop("disabled", false);
            $('#client_finance').prop("disabled", false);
            $('#remarks_for_finance').prop("disabled", false);
            // $('#rfp').prop("disabled", false);
        } else {
            $('#fieldset_endorsement').prop("disabled", true);
            $('#client_finance').prop("disabled", true);
            $('#remarks_for_finance').prop("disabled", true);
            $('#rfp').prop("disabled", true);
        }
    }
    if ($('#ap_status').val().toLowerCase() == 'to be endorsed') {
        $('#fieldset_endorsement').prop("disabled", false);
        $('#client_finance').prop("disabled", false);
        $('#remarks_for_finance').prop("disabled", false);
        // $('#rfp').prop("disabled", false);
    }
    // show searcable select using select 2 dropdown
    select2Dropdown("select2_dropdown");
    var recruiter = "{{ Auth::user()->id }}";
    var candidate = "{{ $user->recruiter_id }}";
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
        // $('#endo_sub_segment').empty()
        // $('#Domainsegment').empty()
        // $('#domain_endo').empty()



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
                // console.log(res)
                $('#Domain_sub_segment').append(`<option> ${res.data.s_segment}</option>`)
                $('#segment').append(`<option>${res.data.segment}</option>`)
                $('#domain').append(`<option>${res.data.domain}</option>`)
                // $('#endo_sub_segment').append(`<option> ${res.data.s_segment}</option>`)
                // $('#Domainsegment').append(`<option>${res.data.segment}</option>`)
                // $('#domain_endo').append(`<option>${res.data.domain}</option>`)
            },
        });

    }
    $("#date_processed").on('input', function() {
        if ($('#endo_type').val() == 'Endorsed') {
            $("#endo_date").val(this.value)
        }
    });
    $("#endo_date").on("input", function() {
        if ($('#endo_type').val() == 'Endorsed') {
            $("#date_processed").val(this.value)
        }
    });

    // $('#position').prop("disabled", true);
    $('#career').prop("disabled", true);
    $('#domain_endo').prop(
        "readonly", true);
    $('#Domainsegment').prop("readonly", true);
    $('#endo_sub_segment').prop(
        "readonly", true);
    var globalData = [];
    var title = "<?php echo $user->position_title; ?>";

    var career_endo = "<?php echo $user->career_endo; ?>";

    function clientChanged(dropDown, elem) {


        $('#loader2').addClass('d-block')
        $('#loader2').removeClass('d-none')
        $('#position').prop("disabled", false);
        $('#career').prop("disabled", false);
        $.ajax({
            url: '{{ url('admin/traveseDataByClientProfile') }}',
            type: 'POST',
            data: {
                // position: $('#position').val(),
                client_dropdown: $('#client_finance').val(),
                _token: token
            },
            // Ajax success function
            success: function(res) {
                if (res.data.length > 0) {
                    $('#loader2').addClass('d-none')
                    $('#loader2').removeClass('d-block')
                    globalData = res.data;
                    $('#domain_endo').empty();
                    $('#Domainsegment').empty();
                    $('#endo_sub_segment').empty();
                    $('#career').empty();
                    // $('#client').empty();
                    $('#position').empty();
                    for (let i = 0; i < res.data.length; i++) {
                        if ($(elem).val() == res.data[i].client) {
                            if ($(`#position option[ value="${res.data[i].p_title}"]`)
                                .length < 1) {
                                if (title == res.data[i].p_title) {
                                    $('#position').append(
                                        `<option selected  value="${res.data[i].p_title}">${res.data[i].p_title}</option>`
                                    );
                                } else {

                                    $('#position').append(
                                        `<option  value="${res.data[i].p_title}">${res.data[i].p_title}</option>`
                                    );
                                }
                            }
                        }
                    }

                    $('#position').change();
                    // $('#client_finance').attr('readonly', true);
                    $('#domain_endo').attr('readonly', true);
                    $('#Domainsegment').attr('readonly', true);
                    $('#endo_sub_segment').attr('readonly', true);

                } else {
                    $('#domain_endo').empty();
                    $('#Domainsegment').empty();
                    $('#endo_sub_segment').empty();
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
                if (career_endo == globalData[i].c_level) {
                    $('#career').append(
                        `<option selected value="${globalData[i].c_level}">${globalData[i].c_level}</option>`
                    );
                } else {

                    $('#career').append(
                        `<option   value="${globalData[i].c_level}">${globalData[i].c_level}</option>`
                    );
                }
            }
        }
        DomainSegmentAppend()
    })

    function DomainSegmentAppend() {
        for (let i = 0; i < globalData.length; i++) {
            if ($('#position').val() == globalData[i].p_title && $('#career').val() == globalData[i]
                .c_level &&
                $('#client_finance').val() == globalData[i].client) {
                $('#domain_endo').append(
                    `<option selected value="${globalData[i].domain}">${globalData[i].domain}</option>`
                );
                $('#Domainsegment').append(
                    `<option selected value="${globalData[i].segment}">${globalData[i].segment}</option>`
                );
                $('#endo_sub_segment').append(
                    `<option selected value="${globalData[i].subsegment}">${globalData[i].subsegment}</option>`
                );
            }
        }
    }

    function RemarksChanges(elem) {
        // get value of seleted field 
        var value = $(elem).find(":selected").text().trim();
        // enable and disalbe reason for not processing input fields
        if (value.includes('Failed') || value.includes('Withdraw')) {
            $('#rfp').prop("disabled", false);
        } else {
            $('#rfp').prop("disabled", true);
        }
        if (value.includes('Scheduled')) {
            $('#interview_schedule').prop("disabled", false);
        } else {
            $('#interview_schedule').prop("disabled", true);
        }
    }

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
    $('#status').on('change', function() {
        console.log('hello');
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
    // ajax to append remarks for finance options 
    function appendRemarksForFinance(bol) {
        console.log('remarks are' + apendtoOption);

        $.ajax({
            url: "{{ route('get_remarksForFinance_options') }}",
            type: 'get',
            success: function(res) {
                if (bol == 0) {
                    $('#remarks_for_finance').empty().trigger('change');
                }
                console.log('status is ' + $('#status').val().toLowerCase());
                if ($('#status').val().toLowerCase() != 'invalid' &&
                    $('#status').val().toLowerCase() != 'pending validation') {
                    console.log('no');
                    optionArray = ["pending db validation", "in client's db/portal"];
                    for (var i = 0; i < res.options.length; i++) {
                        if (!optionArray.includes(res.options[i].option_name.toLowerCase())) {
                            var option = new Option(res.options[i].option_name, res.options[i].option_name,
                                true, false);
                            $('#remarks_for_finance').append(option).trigger('change');
                            $('#remarks_for_finance').val(apendtoOption).trigger('change');

                        }
                    }

                }
            }
        });
    }

    // close
</script>
