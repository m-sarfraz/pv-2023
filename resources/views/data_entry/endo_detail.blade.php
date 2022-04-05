<div id="loader3" style="display: none;"></div>

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
                    <option value="" {{ $user == null ? 'selected' : '' }} disabled>Select Option</option>
                    @foreach ($status->options as $statusOptions)
                        <option value="{{ $statusOptions->option_name }}"
                            {{ $user != null ? ($user->app_status == $statusOptions->option_name ? 'selected' : '') : '' }}>
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
                    @php
                        $position_title = Helper::get_dropdown('position_title');
                    @endphp
                    <label class="d-block font-size-3 mb-0">
                        Position Title:
                    </label>
                    <div id="loader2" class="d-none"></div>
                    <select name="POSITION_TITLE" disabled="" id="position"
                        class="form-control border pl-0 arrow-3 h-px-20_custom font-size-4 d-flex align-items-center select2_dropdown  w-100">
                        <option value="" {{ $user == null ? 'selected' : '' }} disabled>
                            Select Option</option>
                        @foreach ($position_title->options as $position_titleOptions)
                            <option value="{{ $position_titleOptions->option_name }}"
                                {{ $user != null ? ($user->position_title == $position_titleOptions->option_name ? 'selected' : '') : '' }}>
                                {{ $position_titleOptions->option_name }}
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
                        $endoType = Helper::get_dropdown('endorsement_type');
                    @endphp
                    <label class="d-block font-size-3 mb-0">
                        Endorsement Type:
                    </label>
                    <select name="ENDORSEMENT_TYPE" id="endo_type" disabled=""
                        class="form-control border pl-0 arrow-3 h-px-20_custom w-100 font-size-4 d-flex align-items-center w-100">
                        <option value="" {{ $user == null ? 'selected' : '' }} disabled>Select Option
                        </option>
                        @foreach ($endoType->options as $endoTypeOptions)
                            <option value="{{ $endoTypeOptions->option_name }}"
                                {{ $user != null ? ($user->type == $endoTypeOptions->option_name ? 'selected' : '') : '' }}>
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
                    <label class="d-block font-size-3 mb-0">
                        Career Level:
                    </label>
                    <select name="CAREER_LEVEL" disabled="" id="career"
                        class="form-control border pl-0 arrow-3 h-px-20_custom w-100 font-size-4 d-flex align-items-center w-100">
                        <option value="" {{ $user == null ? 'selected' : '' }} disabled>Select
                            Option</option>
                        @foreach ($CareerLevel->options as $CareerLevelOptions)
                            <option value="{{ $CareerLevelOptions->option_name }}"
                                {{ $user != null ? ($user->career_endo == $CareerLevelOptions->option_name ? 'selected' : '') : '' }}>
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
                <div class="form-group mb-0">
                    <div class="form-group mb-0">
                        <label class="d-block font-size-3 mb-0">
                            Date Processed:
                        </label>
                        <input type="date" name="DATE_ENDORSED" disabled="" id="endo_date" onchange="setDate()"
                            class="form-control border h-px-20_custom"
                            value="{{ $user != null ? $user->endi_date : '' }}" />
                        <div>
                            <small class="text-danger"></small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group mb-0">
                    @php
                        $status = Helper::get_dropdown('data_entry_status');
                    @endphp
                    <label class="d-block font-size-3 mb-0">
                        Status
                    </label>
                    <select name="STATUS" id="status" disabled=""
                        class="form-control border pl-0 arrow-3 h-px-20_custom w-100 font-size-4 d-flex align-items-center w-100">
                        <option value="" {{ $user == null ? 'selected' : '' }} disabled>Select Option
                        </option>
                        @foreach ($status->options as $statusOptions)
                            <option value="{{ $statusOptions->option_name }}"
                                {{ $user != null ? ($user->status == $statusOptions->option_name ? 'selected' : '') : '' }}>
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
                @php
                    $client = Helper::get_dropdown('clients');
                @endphp
                <div class="form-group mb-0">
                    <label class="Label">Client</label>
                    <select name="CLIENT" disabled="" id="client" onchange="clientChanged('position-title',this)"
                        class="form-control border pl-0 arrow-3 h-px-20_custom font-size-4 d-flex align-items-center select2_dropdown w-100">
                        <option value="" {{ $user == null ? 'selected' : '' }} disabled>Select Option
                        </option>
                        @foreach ($client->options as $clientOptions)
                            <option value="{{ $clientOptions->option_name }}"
                                {{ $user != null ? ($user->client == $clientOptions->option_name ? 'selected' : '') : '' }}>
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
                    <label class="Label">
                        Remarks (For Finance):
                    </label>
                    <select name="REMARKS_FOR_FINANCE" disabled="" id="remarks_for_finance"
                        onchange="RemarksChange(this)"
                        class="form-control border select2_dropdown pl-0 arrow-3 h-px-20_custom w-100 font-size-4 d-flex align-items-center w-100">
                        @php
                            $remarks = Helper::get_dropdown('remarks_for_finance');
                        @endphp
                        <option value="" {{ $user == null ? 'selected' : '' }} disabled>
                            Select Option</option>
                        @foreach ($remarks->options as $remarksOptions)
                            <option value="{{ $remarksOptions->option_name }}"
                                {{ $user != null ? ($user->remarks_for_finance == $remarksOptions->option_name ? 'selected' : '') : '' }}>
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

            </div>
        </div>
        <div class="row mb-1">
            <div class="col-lg-6">
                <div class="form-group mb-0">
                    @php
                        $site = Helper::get_dropdown('site');
                    @endphp
                    <label class="d-block font-size-3 mb-0">
                        Site:
                    </label>
                    <select name="SITE" disabled="" id="site"
                        class="form-control border pl-0 arrow-3 h-px-20_custom select2_dropdown w-100 font-size-4 d-flex align-items-center">
                        <option value="" {{ $user == null ? 'selected' : '' }} disabled>Select Option
                        </option>
                        @foreach ($site->options as $siteOptions)
                            <option value="{{ $siteOptions->option_name }}"
                                {{ $user != null ? ($user->site == $siteOptions->option_name ? 'selected' : '') : '' }}>
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
                    @php
                        $remarks = Helper::get_dropdown('remarks_from_finance');
                    @endphp
                    <label class="Label">
                        Remarks (From Recruiter):
                    </label>
                    <select disabled="" name="REMARKS_FROM_FINANCE" id="remarks"
                        class="form-control border pl-0 arrow-3 h-px-20_custom w-100 font-size-4 d-flex align-items-center w-100">
                        <option value="" {{ $user == null ? 'selected' : '' }} disabled>Select
                            Option
                        </option>
                        @foreach ($remarks->options as $remarksOptions)
                            <option value="{{ $remarksOptions->option_name }}"
                                {{ $user != null ? ($user->remarks == $remarksOptions->option_name ? 'selected' : '') : '' }}>
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
        <fieldset>
            <div class="row mb-1">
                <div class="col-lg-6">
                    <div class="form-group mb-0">
                        @php
                            $domain = Helper::get_dropdown('domains');
                        @endphp
                        <label class="d-block font-size-3 mb-0">
                            Domain
                        </label>
                        <select id="domain_endo" name="DOMAIN_ENDORSEMENT" onchange="endoDomainChange(this)" disabled=""
                            class="form-control border pl-0 arrow-3 h-px-20_custom w-100 font-size-4 d-flex align-items-center w-100">
                            <option value="" {{ $user == null ? 'selected' : '' }} disabled>
                                Select Option
                            </option>
                            @foreach ($domainDrop as $domainOption)
                                <option value="{{ $domainOption->id }}"
                                    {{ $user != null? (($user->domain_endo != null? $user->domain_endo == $domainOption->domain_name: '')? 'selected': ''): '' }}>
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
                        @php
                            $ReasonForNotP = Helper::get_dropdown('reason_for_not_progressing');
                        @endphp
                        <label class="Label">
                            Reason for not progressing:
                        </label>
                        <select name="REASONS_FOR_NOT_PROGRESSING" disabled="" id="rfp"
                            class="form-control border pl-0 arrow-3 h-px-20_custom font-size-4 d-flex align-items-center select2_dropdown w-100">
                            <option value="" {{ $user == null ? 'selected' : '' }} disabled>Select
                                Option
                            </option>
                            @foreach ($ReasonForNotP->options as $ReasonForNotPOptions)
                                {{ $user != null ? ($user->rfp == $ReasonForNotP->option_name ? 'selected' : '') : '' }}>
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
                        @php
                            $segments = Helper::get_dropdown('segments');
                        @endphp
                        <label class="Label">Segment</label>
                        <select disabled="" id="segment" name="SEGMENT"
                            class="form-control border pl-0 arrow-3 h-px-20_custom w-100 font-size-4 d-flex align-items-center w-100"
                            onchange="endoSegmentChange(this)">
                            <option value="" {{ $user == null ? 'selected' : '' }} disabled>
                                Select Option
                            </option>
                            @foreach ($segmentsDropDown as $segmentsOptions)
                                <option value="{{ $segmentsOptions->id }}"
                                    {{ $user != null? (($user->segment_endo != null? $user->segment_endo == $segmentsOptions->segment_name: '')? 'selected': ''): '' }}>
                                    {{ $segmentsOptions->segment_name }}
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
                        <label class="Label">Interview :</label>
                        <input type="date" name="INTERVIEW_SCHEDULE" disabled="" id="interview_schedule"
                            class="form-control users-input-S-C"
                            value="{{ $user != null ? $user->interview_date : '' }}" />
                        <div>
                            <small class="text-danger"></small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-1">
                <div class="col-lg-6">
                    @php
                        $sub_segment = Helper::get_dropdown('sub_segment');
                    @endphp
                    <div class="form-group mb-0">
                        <label class="Label">sub-segment</label>
                        <select disabled="" id="sub_segment" name="SUB_SEGMENT"
                            class="form-control border pl-0 arrow-3 h-px-20_custom w-100 font-size-4 d-flex align-items-center w-100">
                            <option value="" {{ $user == null ? 'selected' : '' }} disabled>
                                Select Option
                            </option>
                            @foreach ($sub_segment->options as $sub_segmentOptions)
                                <option value="{{ $sub_segmentOptions->id }}"
                                    {{ $user != null? (($user->sub_segment_endo != null? $user->sub_segment_endo == $sub_segmentOptions->sub_segment_name: '')? 'selected': ''): '' }}>
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
        </fieldset>
    </div>
</div>
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
                                    <option value="" {{ $user == null ? 'selected' : '' }} disabled>
                                    </option>
                                    @foreach ($remarks->options as $remarksOptions)
                                        <option value="{{ $remarksOptions->option_name }}"
                                            {{ $user != null ? ($user->remarks_recruiter == $remarksOptions->option_name ? 'selected' : '') : '' }}>
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
                                <label class="d-block font-size-3 mb-0">
                                    Onboarding Date
                                </label>
                                <input type="date" name="ONBOARDING_DATE" id="onboard_date" readonly
                                    value="{{ $user != null ? $user->onboardnig_date : '' }}"
                                    class="form-control border h-px-20_custom" />
                                <div>
                                    <small class="text-danger"></small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-6">
                        <div class="col-lg-6">
                            <div class="form-group mb-0">
                                <label class="d-block font-size-3 mb-0">
                                    Standard Projected Reveneu
                                </label>
                                <input type="number" name="STANDARD_PROJECTED_REVENUE" id="srp"
                                    value="{{ $user != null ? $user->srp : '' }}"
                                    class="form-control h-px-20_custom" readonly />
                                <div>
                                    <small class="text-danger"></small>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-0">
                                <label class="d-block font-size-3 mb-0">
                                    Invoice Number
                                </label>
                                <input type="number" name="INVOICE_NUMBER" id="invoice_number" readonly
                                    value="{{ $user != null ? $user->invoice_number : '' }}"
                                    class="form-control border h-px-20_custom" />
                                <div>
                                    <small class="text-danger"></small>
                                </div>
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
                                <select name="CLIENT_FINANCE" class="form-control border h-px-20_custom w-100"
                                    id="client_finance" disabled="">
                                    <option value="" {{ $user == null ? 'selected' : '' }} disabled>
                                        Select
                                        Option</option>
                                    @foreach ($client->options as $clientOptions)
                                        <option value="{{ $clientOptions->option_name }}"
                                            {{ $user != null ? ($user->client_finance == $clientOptions->option_name ? 'selected' : '') : '' }}>
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
                                <label class="d-block font-size-3 mb-0">
                                    Total Bilable Amount
                                </label>
                                <input type="number" name="TOTAL_BILLABLE_AMOUNT" id="bilable_amount"
                                    value="{{ $user != null ? $user->Total_bilable_ammount : '' }}"
                                    oninput="amountFinder(this)" class="form-control border h-px-20_custom" />
                                <div>
                                    <small class="text-danger"></small>
                                </div>
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
                                <select name="CAREER_LEVEL_FINANCE" id="career_finance" onchange="SPRCalculator(this)"
                                    class="form-control border h-px-20_custom">
                                    <option value="" {{ $user == null ? 'selected' : '' }} disabled>
                                        Select
                                        Option</option>
                                    @foreach ($careerLevel->options as $careerLevelOptions)
                                        <option value="{{ $careerLevelOptions->option_name }}"
                                            {{ $user != null ? ($user->career_finance == $careerLevelOptions->option_name ? 'selected' : '') : '' }}>
                                            {{ $careerLevelOptions->option_name }}
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
                                <label class="d-block font-size-3 mb-0">
                                    Rate
                                </label>
                                <select name="RATE" class="form-control border h-px-20_custom" id="rate"
                                    id="rate_finance" oninput="amountFinder(this)">
                                    <option Disabled {{ $user != null ? ($user->rate == 0 ? 'selected' : '') : '' }}>
                                        Select Option
                                    </option>

                                    <option value="10"
                                        {{ $user != null ? ($user->rate == 10 ? 'selected' : '') : '' }}>
                                        10%
                                    </option>
                                    <option value="10"
                                        {{ $user != null ? ($user->rate == 20 ? 'selected' : '') : '' }}>
                                        20%
                                    </option>
                                    <option value="10"
                                        {{ $user != null ? ($user->rate == 30 ? 'selected' : '') : '' }}>
                                        30%
                                    </option>
                                    <option value="10"
                                        {{ $user != null ? ($user->rate == 40 ? 'selected' : '') : '' }}>
                                        40%
                                    </option>
                                    <option value="10"
                                        {{ $user != null ? ($user->rate == 50 ? 'selected' : '') : '' }}>
                                        50%
                                    </option>
                                    <option value="10"
                                        {{ $user != null ? ($user->rate == 60 ? 'selected' : '') : '' }}>
                                        60%
                                    </option>
                                    <option value="10"
                                        {{ $user != null ? ($user->rate == 70 ? 'selected' : '') : '' }}>
                                        70%
                                    </option>
                                    <option value="10"
                                        {{ $user != null ? ($user->rate == 80 ? 'selected' : '') : '' }}>
                                        80%
                                    </option>
                                    <option value="10"
                                        {{ $user != null ? ($user->rate == 90 ? 'selected' : '') : '' }}>
                                        90%
                                    </option>
                                    <option value="10"
                                        {{ $user != null ? ($user->rate == 100 ? 'selected' : '') : '' }}>
                                        100%
                                    </option>

                                </select>
                                <div>
                                    <small class="text-danger"></small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-6">
                        <div class="col-lg-6">
                            <div class="form-group mb-0">
                                <label class="d-block font-size-3 mb-0">
                                    Offered Salary
                                </label>
                                <input type="number" name="OFFERED_SALARY_finance" id="off_salary_fianance" readonly
                                    value="{{ $user != null ? $user->offered_salary : '' }}"
                                    class="form-control border h-px-20_custom" />
                                <div>
                                    <small class="text-danger"></small>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-0">
                                <label class="d-block font-size-3 mb-0">
                                    Placement Fee
                                </label>
                                <input type="number" name="PLACEMENT_FEE" id="placement_fee" readonly
                                    value="{{ $user != null ? $user->placement_fee : '' }}"
                                    class="form-control border h-px-20_custom" />
                                <div>
                                    <small class="text-danger"></small>
                                </div>
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
                                    value="{{ $user != null ? $user->allowance : '' }}"
                                    class="form-control border h-px-20_custom" />
                                <div>
                                    <small class="text-danger"></small>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6"></div>
                    </div>
                </fieldset>
            </div>
        </div>
    </fieldset>
</div>

<script>
    select2Dropdown("select2_dropdown");

    var globalData = [];
    //  On endorsement detail laods finds the selected option and enable disable fields 
    if ($('#ap_status').find(":selected").text().trim() == 'To Be Endorsed') {
        // disable and enable input fields for user data in endorsement section
        $('#remarks').prop("disabled", false);
        $('#status').prop("disabled", false);
        $('#site').prop("disabled", false);
        $('#client').prop("disabled", false);
        $('#position').prop("disabled", false);
        $('#domain_endo').prop("disabled", false);
        $('#career').prop("disabled", false);
        $('#segment').prop("disabled", false);
        $('#sub_segment').prop("disabled", false);
        $('#endo_date').prop("disabled", false);
        $('#remarks_for_finance').prop("disabled", false);
        // $('#expec_salary').prop("disabled", false);
        $('#endo_type').prop("disabled", false);
    }
    // close 

    // on finance load enable disable fields according to finance remarks 
    // get value of seleted field 
    var value = $('#remarks_for_finance').find(":selected").text().trim();

    // enable and disalbe reason for not processing input fields
    if (value.includes('Failed') || value.includes('Withdraw')) {
        $('#rfp').prop("disabled", false);
    } else {
        $('#rfp').prop("disabled", true);
    }

    // enable and disable finance section on selected text of remarks for finance
    if (value.includes('accepted') || value.includes('Onboarded')) {
        $('#finance_fieldset').prop("disabled", false);
        $('#off_allowance').prop("disabled", false);
        $('#career_finance').prop("disabled", false);
        $('#srp').prop("disabled", false);
        $('#remarks_finance').prop("disabled", false);
        $('#invoice_number').prop("disabled", false);
        $('#bilable_amount').prop("disabled", false);
        $('#rate').prop("disabled", false);
        $('#off_allowance_finance').prop("disabled", false);
        $('#placement_fee').prop("disabled", false);
        $('#off_salary_fianance').prop("disabled", false);
        $('#onboard_date').prop("disabled", false);
        // $('#off_allowance').prop("disabled", false);
    } else {

        // else disable the finance section and disable salray fields
        $('#finance_fieldset').prop("disabled", true);

        // $('#off_allowance').prop("disabled", true);
    }
    if (value.includes('Hire') || value.includes('Reneged') || value.includes('Onboard') || value.includes(
            'Scheduled') || value.includes('Offer accepted')) {
        $('#off_allowance').prop("disabled", false);
        $('#off_salary').prop("disabled", false);
    } else {
        $('#off_allowance').prop("disabled", true);
        $('#off_salary').prop("disabled", true);
    }
    // enalbe the interview date if remark include schedule
    if (value.includes('Scheduled')) {
        $('#interview_schedule').prop("disabled", false);
    } else {
        $('#interview_schedule').prop("disabled", true);
    }
    if (value.includes('Scheduled') || value.includes('Pending') || value.includes('Withdraw')) {

        // disable fieldset of finance fieldset
        $('#finance_fieldset').prop("disabled", false);

        //disable remaining fields of finance reference
        $('#career_finance').prop("disabled", false);
        $('#srp').prop("disabled", false);
        $('#remarks_finance').prop("disabled", true);
        $('#invoice_number').prop("disabled", true);
        $('#bilable_amount').prop("disabled", true);
        $('#rate').prop("disabled", true);
        $('#off_allowance_finance').prop("disabled", true);
        $('#placement_fee').prop("disabled", true);
        $('#off_salary_fianance').prop("disabled", true);
        $('#onboard_date').prop("disabled", true);
    }

    // enable the standard project revenue if the remark incliudes mid / mid stage
    if (value.includes('Mid')) {
        $('#client_finance').prop("disabled", false);
    }

    // on remarks for finance change shwo user input fields ends

    // close 
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
                                    `<option selected value="${res.data[i].p_title}">${res.data[i].p_title}</option>`
                                );
                            }
                        }
                    }
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
        console.log('position changed');
        $('#career').empty();
        for (let i = 0; i < globalData.length; i++) {
            if ($('#position').val() == globalData[i].p_title) {
                $('#career').append(
                    `<option selected value="${globalData[i].c_level}">${globalData[i].c_level}</option>`
                );
            }
        }
        DomainSegmentAppend()
    })
</script>
