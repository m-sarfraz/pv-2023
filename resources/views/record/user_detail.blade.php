<p class="C-Heading pt-3">Requirement Details:</p>
<div class="card mb-13">
    <div class="card-body">
        <form action="" id = "user_detail_form">
            <fieldset disabled="" id="recordFieldset">
                <div class="row mb-1">
                    <div class="col-lg-6">
                        <div class="form-group mb-0">
                            <label class="Label">
                                Canidate Name*:
                            </label>
                            <input type="text" class="form-control" placeholder="enter first name" name = "first_name"
                                value="{{ $user->first_name }}">
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group mb-0">
                            @php
                                $gender = Helper::get_dropdown('gender');
                            @endphp
                            <label class="Label">Gender:</label>
                            <select class="w-100 form-control" name  ="gender">
                                <option value="" selected disabled>select option</option>
                                @foreach ($gender->options as $genderOptions)
                                    <option value="{{ $genderOptions->option_name }}"
                                        {{ $user->gender == $genderOptions->option_name ? 'selected' : '' }}>
                                        {{ $genderOptions->option_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group mb-0">
                            <label class="Label">DOB:</label>
                            <input type="text" class="form-control users-input-S-C" name="dob" value="{{ $user->dob }}">
                        </div>
                    </div>
                </div>
                <div class="row mb-1">
                    <div class="col-lg-6">
                        <div class="form-group mb-0">
                            <label class="Label">Email:</label>
                            <input type="text" class="form-control users-input-S-C" placeholder="enter email" name ="email"
                                value="{{ $user->email }}" />
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group mb-0">
                            <label class="d-block font-size-3 mb-0">
                                Contact:
                            </label>
                            <input type="text" class="form-control users-input-S-C" placeholder="enter you cell" name= "phone"
                                value="{{ $user->phone }}" />
                        </div>
                    </div>
                </div>
                <div class="row mb-1">
                    <div class="col-lg-6">
                        <div class="form-group mb-0">
                            <label class="d-block font-size-3 mb-0">
                                Residendce
                            </label>
                            <input type="text" class="form-control users-input-S-C" value="{{ $user->address }}" name="address" />
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group mb-0">
                            <label class="d-block font-size-3 mb-0">
                                Shifted Date:
                            </label>
                            <input type="text" class="form-control users-input-S-C" name="date_shifted"
                                value="{{ $user->date_shifted }}" />
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group mb-0">
                            <label class="d-block font-size-3 mb-0">
                                Source
                            </label>
                            <input type="text" class="form-control users-input-S-C" name = "source" />
                        </div>
                    </div>
                </div>
                <div class="row mb-1">
                    <div class="col-lg-6">
                        <div class="form-group mb-0">
                            <label class="Label">Educational Attachment</label>
                            <input type="text" class="form-control users-input-S-C" name= "educational_attain" />
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group mb-0">
                            <label class="Label">Date Invited:</label>
                            <input type="text" class="form-control users-input-S-C" name = "date_invited"
                                value="{{ $user->date_invited }}" />
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
                                <option selected disabled></option>
                                @foreach ($manner_of_invite->options as $manner_of_inviteOption)
                                    <option value="{{ $manner_of_inviteOption->option_name }}"
                                        {{ $user->manner_of_invite == $manner_of_inviteOption->option_name ? 'selected' : '' }}>
                                        {{ $manner_of_inviteOption->option_name }}
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
                            $course = Helper::get_dropdown('course');
                            ?>
                            <label class="Label">Course:</label>
                            <select name="COURSE" class="form-control p-0 users-input-S-C" id="COURSE">
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
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group mb-0">
                            <label class="Label">
                                Current Salary:
                            </label>
                            <input type="text" class="form-control users-input-S-C" name = "curr_salary"
                                value="{{ $user->curr_salary }}" />
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group mb-0">
                            <label class="Label">
                                Current Allowance:
                            </label>
                            <input type="text" class="form-control users-input-S-C" name = "curr_allowance"
                                value="{{ $user->curr_allowance }}" />
                        </div>
                    </div>
                </div>
                <div class="row mb-1">
                    <div class="col-lg-6">
                        <div class="form-group mb-0">
                            <label class="Label">Domains</label>
                            <select name="DOMAIN" id="domain" class="form-control p-0 users-input-S-C" onchange = "DomainChange(this)">
                                <option selected disabled>Select Option</option>
                                @foreach ($domainDrop as $domainOption)
                                    <option value="{{ $domainOption->id }}"
                                        {{ $user->domain == $domainOption->option_name ? 'selected' : '' }}>
                                        {{ $domainOption->domain_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group mb-0">
                            <label class="Label">
                                Expected Salary:
                            </label>
                            <input type="text" class="form-control users-input-S-C" name ="expec_salary"
                                value="{{ $user->exp_salary }}" />
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group mb-0">
                            <label class="Label">
                                Offered Salary:
                            </label>
                            <input type="text" class="form-control users-input-S-C" name = "offered_salary"
                                value="{{ $user->off_salary }}" />
                        </div>
                    </div>
                </div>
                <div class="row mb-1">
                    <div class="col-lg-6">
                        <div class="form-group mb-0">
                            <label class="Label">Segment:</label>
                            <select name="segment" id="segment" class="form-control p-0 users-input-S-C" onchange="SegmentChange(this)">
                                <option selected disabled>Select Option</option>

                            </select>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group mb-0">
                            <label class="Label">
                                Sub Segment:
                            </label>
                            <select name="sub_segment" id="Domain_sub_segment" class="form-control p-0 users-input-S-C">
                                <option selected disabled>Select Option</option>

                            </select>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group mb-0">
                            <label class="Label">
                                Offered Allowance:
                            </label>
                            <input type="text" class="form-control users-input-S-C" name= "offered_allowance"
                                value="{{ $user->off_allowance }}" />
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
                            <select name="CANDIDATES_PROFILE" class="select2_dropdown w-100"
                                class="form-control p-0 users-input-S-C">
                                <option selected disabled></option>
                                @foreach ($profile->options as $profileOption)
                                    <option value="{{ $profileOption->option_name }}"
                                        {{ $user->candidate_profile == $profileOption->option_name ? 'selected' : '' }}>
                                        {{ $profileOption->option_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group mb-0">
                            <label class="Label">
                                Date Processed:
                            </label>
                            <input type="text" class="form-control users-input-S-C" nmae = "date_processed" />
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
                                <option value="" selected disabled>Select Option</option>
                                {{-- @dd($user->app_status) --}}
                                @foreach ($status->options as $statusOptions)
                                    <option value="{{ $statusOptions->option_name }}"
                                        {{ $user->app_status == $statusOptions->option_name ? 'selected' : '' }}>
                                        {{ $statusOptions->option_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row mb-1">
                    <div class="col-lg-6">
                        <div class="form-group mb-0">
                            <label class="Label">Position Applied:</label>
                            <input type="text" class="form-control users-input-S-C" name ="position_applied"
                                value="{{ $user->position_applied }}" />
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group mb-0">
                            <label class="Label">
                                Shifted By:
                            </label>
                            <input type="text" class="form-control users-input-S-C" name = "shifted_by"/>
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
                                value="{{ $user->interview_notes }}" placeholder="Enter Interview Notes"></textarea>
                        </div>
                        <div class="pt-3">
                            <div class="form-group mb-0">
                                <label class="d-block font-size-3 mb-0">
                                    Recruitment Process:
                                </label>
                                <textarea name="EMPLOYMENT_HISTORY" rows="3" type="text"
                                    class="form-control border E_H h-px-20_custom"
                                    placeholder="Enter Interview Notes"></textarea>

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
                                <option selected disabled></option>
                                @foreach ($certificate->options as $certificateOption)
                                    <option value="{{ $certificateOption->option_name }}"
                                        {{ $user->certificate == $certificateOption->option_name ? 'selected' : '' }}>
                                        {{ $certificateOption->option_name }}</option>
                                @endforeach
                            </select>
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
                                                        <option value="" disabled selected>Select Option</option>
                                                        @foreach ($endoType->options as $endoTypeOptions)
                                                            <option value="{{ $endoTypeOptions->option_name }}"
                                                                {{ $user->type == $endoTypeOptions->option_name ? 'selected' : '' }}>
                                                                {{ $endoTypeOptions->option_name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
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
                                                    <select name="CAREER_LEVEL" disabled="" id="career"
                                                        class="form-control border pl-0 arrow-3 h-px-20_custom w-100 font-size-4 d-flex align-items-center w-100">
                                                        <option value="" disabled selected>Select Option</option>
                                                        @foreach ($CareerLevel->options as $CareerLevelOptions)
                                                            <option value="{{ $CareerLevelOptions->option_name }}"
                                                                {{ $user->career_endo == $CareerLevelOptions->option_name ? 'selected' : '' }}>
                                                                {{ $CareerLevelOptions->option_name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
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
                                                    <select name="SITE" disabled="" id="site"
                                                        class="form-control border pl-0 arrow-3 h-px-20_custom w-100 font-size-4 d-flex align-items-center w-100">
                                                        <option value="" disabled selected>Select Option</option>
                                                        @foreach ($site->options as $siteOptions)
                                                            <option value="{{ $siteOptions->option_name }}"
                                                                {{ $user->site == $siteOptions->option_name ? 'selected' : '' }}>
                                                                {{ $siteOptions->option_name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
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
                                                        <option value="" disabled selected>Select Option</option>
                                                        @foreach ($remarks->options as $remarksOptions)
                                                            <option value="{{ $remarksOptions->option_name }}"
                                                                {{ $user->remarks_for_finance == $remarksOptions->option_name ? 'selected' : '' }}>
                                                                {{ $remarksOptions->option_name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-1">
                                            <div class="col-lg-6">
                                                <div class="form-group mb-0">
                                                    @php
                                                        $client = Helper::get_dropdown('clients');
                                                    @endphp
                                                    <label class="Label-00">
                                                        Client
                                                    </label>
                                                    <select name="CLIENT_FINANCE"
                                                        class="form-control border h-px-20_custom w-100"
                                                        id="client_finance" disabled="">
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
                                                    @php
                                                        $status = Helper::get_dropdown('status');
                                                    @endphp
                                                    <label class="Label-00">
                                                        Status:
                                                    </label>
                                                    <select name="STATUS" id="status" disabled=""
                                                        class="form-control border pl-0 arrow-3 h-px-20_custom w-100 font-size-4 d-flex align-items-center w-100">
                                                        <option value="" disabled selected>Select Option</option>
                                                        @foreach ($status->options as $statusOptions)
                                                            <option value="{{ $statusOptions->option_name }}"
                                                                {{ $user->status == $statusOptions->option_name ? 'selected' : '' }}>
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
                                                        $position_title = Helper::get_dropdown('position_title');
                                                    @endphp
                                                    <label class="Label-00 ">
                                                        Position Title:
                                                    </label>
                                                    <select name="POSITION_TITLE" disabled="" id="position"
                                                        class="form-control border select2_dropdow pl-0 arrow-3 h-px-20_custom w-100 font-size-4 d-flex align-items-center w-100">
                                                        <option value="" disabled selected>Select Option</option>
                                                        @foreach ($position_title->options as $position_titleOptions)
                                                            <option value="{{ $position_titleOptions->option_name }}"
                                                                {{ $user->site == $siteOptions->option_name ? 'selected' : '' }}>
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
                                                    <label class="Label-00">
                                                        Reason for not progressing:
                                                    </label>
                                                    <select name="REASONS_FOR_NOT_PROGRESSING" disabled="" id="rfp"
                                                        class="form-control border pl-0 arrow-3 h-px-20_custom w-100 font-size-4 d-flex align-items-center select2_dropdown w-100">
                                                        <option value="" disabled selected>Select Option</option>
                                                        @foreach ($ReasonForNotP->options as $ReasonForNotPOptions)
                                                            {{ $user->rfp == $ReasonForNotP->option_name ? 'selected' : '' }}>
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
                                                <div class="form-group mb-0">
                                                    <label class="Label-00">
                                                        Domain:
                                                    </label>
                                                    <select name="DOMAIN_endo" id="domain" onchange="DomainChange(this)"
                                                        class="form-control p-0 users-input-S-C">
                                                        <option selected disabled>Select Option</option>
                                                        @foreach ($domainDrop as $domainOption)
                                                            <option value="{{ $domainOption->id }}"
                                                                {{ $user->domain == $domainOption->option_name ? 'selected' : '' }}>
                                                                {{ $domainOption->domain_name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group mb-0">
                                                    <label class="Label">Interview Schedule:</label>
                                                    <input type="date" name="INTERVIEW_SCHEDULE" id="interview_schedule"
                                                        class="form-control users-input-S-C" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-1">
                                            <div class="col-lg-6">
                                                <div class="form-group mb-0">
                                                    <label class="Label-00">
                                                        Segment:
                                                    </label>
                                                    <select name="endo_segment" id="Domainsegment" class="w-100 form-control" onchange="changeSegment(this)">
                                                        <option value="" disabled selected>Select Option</option>

                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                @php
                                                    $remarks = Helper::get_dropdown('remarks_from_finance');
                                                @endphp
                                                <div class=" mb-0">
                                                    <label class="Label">Remarks (From
                                                        Recruiter):</label>
                                                    <select disabled="" name="REMARKS_FROM_FINANCE" id="remarks"
                                                        class="form-control border pl-0 arrow-3 h-px-20_custom w-100 font-size-4 d-flex align-items-center w-100">
                                                        <option value="" disabled selected>Select Option</option>
                                                        @foreach ($remarks->options as $remarksOptions)
                                                            <option value="{{ $remarksOptions->option_name }}"
                                                                {{ $user->remarks == $remarksOptions->option_name ? 'selected' : '' }}>
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
                                                    <label class="Label-00 ">
                                                        sub-segment:
                                                    </label>
                                                    <select name="endo_sub_segment " id="endo_sub_segment " class="w-100  form-control">
                                                        <option value="" disabled selected>Select Option</option>

                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group mb-0">
                                                    <label class="Label">Endo Date:</label>
                                                    <input type="date" name="DATE_ENDORSED" id="endo_date"
                                                        class="form-control border h-px-20_custom" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-1">
                                            <div class="col-lg-6">
                                                <div class="form-group mb-0">
                                                    <label class="Label-00">
                                                        Date Undated:
                                                    </label>
                                                    <input type="date" name="DATE_UNDATED" id="DATE_UNDATED"
                                                        class="form-control border h-px-20_custom" />
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
            <a class="btn btn-success mt-5 btn-md"  type="button" target="blank" href="{{asset('assets/cv/'.$user->cv)}}"
                
            {{-- onclick="downloadCv('{{ $user->cid }}' , '{{ url('admin/download_cv') }}')" --}}
            >Download CV</a>
            @endif
                @if(Auth::user()->id  == $user->saved_by)
                    <button class="btn btn-primary mt-5 btn-md" onclick="UpdateRecord('{{$user->cid}}')">Update</button>
                
                @else
                    <a type = "button" href= "{{url('admin/data-entry')}}?id={{$user->id}}" class="btn btn-primary mt-5 btn-md">Tap</a>
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
</script>
