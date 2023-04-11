<div class="col-lg-6">
    <!-- ================== -->
    <!-- Candidate section start -->
    <div class="row">
        <fieldset class="w-100" disabled="" id="candidateFieldset">
            <div class="col-lg-12 p-0">
                <p class="C-Heading">Sourcing &amp; Demographics</p>
                <div class="card">
                    <div class="card-body pt-4">
                        <fieldset>
                            <div class="row mb-2">
                                <div class="col-lg-4">
                                    <div class="form-group mb-0">
                                        <label class="Label">*Last Name:</label>
                                        <input type="text" class="form-control users-input-S-C" id="last_name"
                                            value="{{ $user->last_name }}" name="LAST_NAME" />
                                        <div>
                                            <small class="text-danger"></small>
                                        </div>
                                    </div>
                                    <div><small class="___class_+?36___"></small></div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group mb-0">
                                        <label class="Label">*First Name:</label>
                                        <input type="text" class="form-control users-input-S-C"
                                            value="{{ $user->first_name }}" name="FIRST_NAME" />
                                        <div>
                                            <small class="text-danger"></small>
                                        </div>
                                    </div>
                                    <div><small class="___class_+?45___"></small></div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group mb-0">
                                        <label class="Label">
                                            Middle Initial
                                        </label>
                                        <input type="text" class="form-control users-input-S-C"
                                            value="{{ $user->middle_name }}" name="MIDDLE_NAME" />
                                        <div>
                                            <small class="text-danger"></small>
                                        </div>
                                    </div>
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
                                            <option value="" {{ $user->gender == null ? 'selected' : '' }}
                                                disabled>
                                                select option</option>
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
                                <div class="col-lg-6">
                                    <div class="form-group mb-0">
                                        <label class="d-block font-size-3 mb-0">
                                            DOB
                                        </label>
                                        <input type="date" name="DATE_OF_BIRTH" value="{{ $user->dob }}"
                                            class="form-control border h-px-20_custom" />
                                        <div>
                                            <small class="text-danger"></small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-lg-6">
                                    <div class="form-group mb-0">
                                        <label for="validationDefaultUsername" class="mb-0 d-block font-size-3 mb-0">
                                            Email
                                        </label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text EmailIcon" id="inputGroupPrepend2">
                                                    <i class="bi bi-envelope"></i>
                                                </span>
                                            </div>
                                            <input type="text" class="form-control EmailInput-F" name="EMAIL_ADDRESS"
                                                value="{{ $user->email }}" id="email" />
                                            <div>
                                                <small class="text-danger"></small>
                                            </div>
                                        </div>
                                    </div>
                                    <div><small class="___class_+?64___"></small></div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group mb-0">
                                        <label for="validationDefaultUsername" class="mb-0 d-block font-size-3 mb-0">
                                            Contact
                                        </label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text EmailIcon" id="inputGroupPrepend2">
                                                    <i class="bi bi-telephone"></i>
                                                </span>
                                            </div>
                                            <input type="text" class="form-control EmailInput-F"
                                                value="{{ $user->phone }}" name="CONTACT_NUMBER" />
                                            <div>
                                                <small class="text-danger"></small>
                                            </div>
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
                                            value="{{ $user->address }}" name="RESIDENCE" />
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

                                        <select name="EDUCATIONAL_ATTAINTMENT" onchange="EducationalAttainChange(this)"
                                            class=" form-control p-0 EmailInput-F" id="EDUCATIONAL_ATTAINTMENT">
                                            <option value="" {{ $user == null ? 'selected' : '' }} disabled>
                                                select
                                                option</option>
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
                                <div class="col-lg-5">
                                    <div class="form-group mb-0">
                                        <label class="Label">Course</label>
                                        <?php
                                        $course = Helper::get_dropdown('course');
                                        ?>


                                        <select name="COURSE"
                                            class="form-control p-0 users-input-S-C select2_dropdown w-100" disabled
                                            id="COURSE">
                                            <option value="" {{ $user->course == null ? 'selected' : '' }}>
                                            </option>
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
                            </div>
                            <div class="row mb-8">
                                <div class="col-lg-12">
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
                                        <div>
                                            <small class="text-danger"></small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="mb-9" />
                            <div class="row mb-6 px-3">
                                <div class="col-lg-6 col-md-6 col-sm-12 col-12 pl-0">
                                    <!-- edr -->
                                    <div class="col-lg-12 p-0">
                                        <label class="Label">
                                            Date Sifted:
                                        </label>
                                        <input type="date" name="DATE_SIFTED" value="{{ $user->date_shifted }}"
                                            class="form-control users-input-S-C" />
                                        <div>
                                            <small class="text-danger"></small>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 p-0">
                                        <label class="Label">Domain</label>
                                        <select name="DOMAIN" id="domain" onchange="DomainChange(this)"
                                            class="form-control p-0 users-input-S-C">
                                            <option {{ $user->domain == null ? 'selected' : '' }} disabled>Select
                                                Option
                                            </option>
                                            @foreach ($domainDrop as $domainOption)
                                                <option value="{{ $domainOption->id }}"
                                                    {{ strtolower($user->domain) == strtolower($domainOption->domain_name) ? 'selected' : '' }}>
                                                    {{ $domainOption->domain_name }}</option>
                                            @endforeach
                                        </select>
                                        <div>
                                            <small class="text-danger"></small>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 p-0">
                                        <?php
                                        $segmentss = App\Segment::all();
                                        ?>
                                        <label class="Label">Segment</label>
                                        <select name="Domainsegment" id="Domainsegment"
                                            onchange="SegmentChange(this)" class="form-control p-0 users-input-S-C">
                                            <option {{ $user->segment == null ? 'selected' : '' }} disabled>Select
                                                Option
                                            </option>
                                            @foreach ($segmentss as $segmentOption)
                                                <option value="{{ $segmentOption->id }}"
                                                    {{ strtolower($user->segment) == strtolower($segmentOption->segment_name) ? 'selected' : '' }}>
                                                    {{ $segmentOption->segment_name }}</option>
                                            @endforeach

                                        </select>
                                        <div>
                                            <small class="text-danger"></small>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 p-0">
                                        <?php
                                        $sub_segment = Helper::get_dropdown('sub_segment');
                                        ?>
                                        <label class="Label">sub-segment</label>
                                        <select name="Domainsub" id="Domainsub"
                                            class="form-control p-0 users-input-S-C">
                                            <option {{ $user->sub_segment == null ? 'selected' : '' }} disabled>
                                                Select Option</option>
                                            @foreach ($sub_segment->options as $sub_segmentOption)
                                                <option value="{{ $sub_segmentOption->id }}"
                                                    {{ strtolower($user->sub_segment) == strtolower($sub_segmentOption->option_name) ? 'selected' : '' }}>
                                                    {{ $sub_segmentOption->option_name }}
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
                                                    {{ $user == null ? 'selected' : '' }}
                                                    disabled>Select Option
                                                </option>
                                                @foreach ($profile as $profileOption)
                                                    <option value="{{ $profileOption->id }}"
                                                        {{ ($user != null ? $user->candidate_profile == $profileOption->c_profile_name : '') ? 'selected' : '' }}>
                                                        {{ $profileOption->c_profile_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <div>
                                                <small class="text-danger"></small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 p-0">
                                        <div class="form-group mb-0">
                                            <label class="Label">
                                                position applied
                                            </label>
                                            <input type="text" name="POSITION_TITLE_APPLIED"
                                                value="{{ $user->position_applied }}"
                                                class="form-control p-0 users-input-S-C" />
                                            <div>
                                                <small class="text-danger"></small>
                                            </div>
                                        </div>
                                        <div>
                                            <small class="text-danger"></small>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 p-0">
                                        <div class="form-group mb-0">
                                            <?php
                                            $manner_of_invite = Helper::get_dropdown('manner_of_invite');
                                            ?>
                                            <label class="Label">
                                                Manner of invite
                                            </label>
                                            <select name="MANNER_OF_INVITE" onchange="mannerChange(this)"
                                                id="manners" class="form-control p-0 users-input-S-C">
                                                <option value=""
                                                    {{ $user->manner_of_invite == null ? 'selected' : '' }} disabled>
                                                    Select Option
                                                </option>
                                                @foreach ($manner_of_invite->options as $manner_of_inviteOption)
                                                    <option value="{{ $manner_of_inviteOption->option_name }}"
                                                        {{ $user->manner_of_invite == $manner_of_inviteOption->option_name ? 'selected' : '' }}>
                                                        {{ $manner_of_inviteOption->option_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div>
                                            <small class="text-danger"></small>
                                        </div>
                                        <div class="form-group mb-0">
                                            <?php
                                            $source = Helper::get_dropdown('source');
                                            ?>
                                            {{-- @dd($user->source) --}}
                                            <label class="Label labelFontSize">
                                                Source
                                            </label>
                                            <select name="SOURCE" id="source"
                                                class="form-control p-0 users-input-S-C">
                                                <option value="" {{ $user->source == null ? 'selected' : '' }}
                                                    disabled>Select Option
                                                </option>
                                                @foreach ($source->options as $sourceOption)
                                                    <option value="{{ $sourceOption->option_name }}"
                                                        {{ ($user->source != null ? $user->source == $sourceOption->option_name : '') ? 'selected' : '' }}>
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
                                        <label class="text-black-2 font-size-3 font-weight-semibold mb-0">
                                            Employement History</label>
                                        <textarea name="EMPLOYMENT_HISTORY" rows="3" type="text" value=""
                                            class="form-control border   E_HCDataEntry">{{ $user->emp_history }}</textarea>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-12 pr-0">
                                    <div class="col-lg-12 p-0">
                                        <label class="` Label">
                                            Interview Notes
                                        </label>
                                        <textarea name="INTERVIEW_NOTES" rows="3" type="text" id="notes" value=""
                                            class="form-control border t-HC h-px-20_custom"> {{ $user->interview_note }}</textarea>
                                        <div>
                                            <small class="text-danger"></small>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 p-0">
                                        <div class="form-group mb-0">
                                            <label class=" p-0 users-input-S-C mb-0 font-size-3"> Date Invited</label>
                                            <input type="date" name="DATE_INVITED" id="date_invited"
                                                value="{{ $user->date_invited }}"
                                                class="form-control border h-px-20_custom" />
                                            <div>
                                                <small class="text-danger"></small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 p-0">
                                        <div class="form-group mb-0">
                                            <label class="Label">
                                                Current Salary:
                                            </label>
                                            <input type="number" class="form-control p-0 users-input-S-C`"
                                                value="{{ $user->curr_salary }}" id="current_salary"
                                                name="CURRENT_SALARY" />
                                            <div>
                                                <small class="text-danger"></small>
                                            </div>
                                        </div>
                                        <div>
                                            <small class="text-danger"></small>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 p-0">
                                        <div class="form-group mb-0">
                                            <label class="Label" name="CURRENT_ALLOWANCE">
                                                Current Allowance:
                                            </label>
                                            <input type="number" class="form-control users-input-S-C"
                                                value="{{ $user->curr_allowance }}" name="CURRENT_ALLOWANCE" />
                                            <div>
                                                <small class="text-danger"></small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 p-0">
                                        <div class="form-group mb-0">
                                            <label class="Label">
                                                Expected Salary:
                                            </label>
                                            <input type="number" name="EXPECTED_SALARY" id="expec_salary"
                                                value="{{ $user->exp_salary }}"
                                                class="form-control p-0 users-input-S-C" />
                                            <div>
                                                <small class="text-danger"></small>
                                            </div>
                                        </div>
                                        <div>
                                            <small class="text-danger"></small>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 p-0">
                                        <div class="form-group mb-0">
                                            <label class="Label" name="OFFERED_SALARY">
                                                Offered Salary:
                                            </label>
                                            <input type="number" name="OFFERED_SALARY" id="off_salary"
                                                disabled="" value="{{ $user->off_salary }}"
                                                oninput="SalaryAppend('#remarks')"
                                                class="form-control users-input-S-C" />
                                            <div>
                                                <small class="text-danger"></small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 p-0">
                                        <div class="form-group mb-0">
                                            <label class="Label">
                                                Offered Allowance:
                                            </label>
                                            <input type="number" name="OFFERED_ALLOWANCE" id="off_allowance"
                                                value="{{ $user->off_allowance }}"
                                                oninput="SalaryAppend('#remarks')" disabled=""
                                                class="form-control users-input-S-C" />
                                            <div>
                                                <small class="text-danger"></small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </fieldset>

                        <div class="row">
                            <div class="col-lg-6"></div>
                            <div class="col-lg-6">
                                <div class="d-flex w-100 flex-wrap gap-2 flex-column form-group col-md-12">
                                    {{-- <div class="w-100 d-none mt-2" style="text-align: end; margin-bottom: 6px; "
                                        id="fileDiv">
                                        <input type="file" id="sheetFile" name="file" oninput="uploadFile(this)"
                                            accept="application/pdf" class="uploadcv  w-100">
                                        <i class="bi bi-x-circle d-none" id="cross" onclick="emptyFileinput()"
                                            style="position: absolute;left: -7px; top:1px;color:red"></i>
                                    </div> --}}
                                    <div class="w-100 d-none mt-2" style="text-align: end; margin-bottom: 6px; "
                                        id="fileDiv">
                                        @if ($user->cv)
                                            <span id="append-cv" class="text-merge-input"></span>
                                        @else
                                            <span id="append-cv" class="text-merge-input">No Uploaded CV</span>
                                        @endif
                                        <label class="labeled"> Upload
                                            <input type="file" id="sheetFile" name="file"
                                                oninput="uploadFile(this)" accept="application/pdf"
                                                class="uploadcv  demo-css  w-100">
                                        </label>


                                        <i class="bi bi-x-circle d-none" id="cross" onclick="emptyFileinput()"
                                            style="position: absolute;left: -7px; top:1px;color:red"></i>
                                    </div>
                                    <div class="d-flex  align-items-center mt-2">
                                        @if ($user->cv)
                                            <span class=" mr-3"><i
                                                    class="bi bi-paperclip"></i>{{ $user->first_name }}'s
                                                Resume</span>
                                            <a class="btn btn-success checkTest" type="button" target="blank"
                                                href="{{ asset('assets/cv/' . $user->cv) }}" {{-- onclick="downloadCv('{{ $user->cid }}' , '{{ url('admin/download_cv') }}' --}}
                                                {{-- )" --}}>Download
                                                CV</a>
                                        @endif

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
<div class="col-lg-6 paddingZero mtSM-4">
    <!-- ================== -->
    <!-- ENDORSMENT section start -->
    {{-- <fieldset disabled="false"> --}}
    <div class="d-flex justify-content-between align-items-center">
        <div class="">
            <p class="C-Heading">Endorsement Details</p>
        </div>
        @if ($user != null)
            <div class="mb-1">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <label class="d-block font-size-3 mb-0 labelFontSize px-2">Select
                            Endorsement #:
                        </label>
                    </div>
                    <div>
                        <select name="endo_number" id="no_endo" onchange="selectEndoDetails(this)"
                            class="form-control border pl-0 arrow-3 h-px-20_custom w-100 font-size-4 d-flex align-items-center w-100">
                            <option value="" disabled>Select Endorsement</option>
                            @foreach ($number_of_endorsements as $value)
                                <option selected value="{{ $value->numberOfEndo }}" {{-- {{ $i == $number ? 'selected' : '' }} --}}>
                                    {{ $value->numberOfEndo }}
                                </option>
                            @endforeach
                            {{-- @for ($i = 1; $i <= $number_of_endorsements; $i++)
                                <option value="{{ $i }}" {{ $i == $number ? 'selected' : '' }}>
                                    {{ $i }}
                                </option>
                            @endfor --}}
                        </select>
                    </div>
                </div>


            </div>
        @endif

    </div>
    <!-- ================== -->
    <!-- ENDORSMENT section start -->
    {{-- <fieldset disabled="false"> --}}
    <fieldset disabled="" id="endoFinanceFieldset">

        {{-- <p class="C-Heading">Endorsement Details</p> --}}
        <div id="endorsements_detail_view">

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
                                <option value="" {{ $user == null ? 'selected' : '' }} disabled>Select Option
                                </option>
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
                        <div class="col-lg-6">
                            <div class="form-group mb-0">
                                @php
                                    $position_title = Helper::get_dropdown('position_title');
                                @endphp
                                <label class="d-block font-size-3 mb-0">
                                    Position Title:
                                </label>
                                <div id="loader2" class="d-none"></div>
                                <select name="POSITION_TITLE" disabled id="position" readonly
                                    class="form-control select2_dropdown  w-100 border pl-0 arrow-3 h-px-20_custom w-100 font-size-4 d-flex align-items-center w-100">
                                    <option value="" {{ $user->position_title == null ? 'selected' : '' }}
                                        disabled>
                                        Select Option</option>
                                    {{-- @foreach ($position_title->options as $position_titleOptions)
                                        <option value="{{ $position_titleOptions->option_name }}"
                                            {{ $user->position_title == $position_titleOptions->option_name ? 'selected' : '' }}>
                                            {{ $position_titleOptions->option_name }}
                                        </option>
                                    @endforeach --}}
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
                                    <option value="" {{ $user->type == null ? 'selected' : '' }} disabled>
                                        Select
                                        Option
                                    </option>
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
                            @php
                                $CareerLevel = Helper::get_dropdown('career_level');
                            @endphp
                            <div class="form-group mb-0">
                                <label class="d-block font-size-3 mb-0">
                                    Career Level:
                                </label>
                                <select name="CAREER_LEVEL" disabled="" id="career"
                                    class="form-control border pl-0 arrow-3 h-px-20_custom w-100 font-size-4 d-flex align-items-center w-100">
                                    <option value="" {{ $user->career_endo == null ? 'selected' : '' }}
                                        disabled>
                                        Select
                                        Option</option>
                                    {{-- @foreach ($CareerLevel->options as $CareerLevelOptions)
                                        <option value="{{ $CareerLevelOptions->option_name }}"
                                            {{ $user->career_endo == $CareerLevelOptions->option_name ? 'selected' : '' }}>
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
                    <div class="row mb-1">
                        <div class="col-lg-6">
                            <div class="form-group mb-0">
                                <div class="form-group mb-0">
                                    <label class="d-block font-size-3 mb-0">
                                        Date Processed:
                                    </label>
                                    <input type="date" name="DATE_ENDORSED" disabled="" id="endo_date"
                                        onchange="changeOnboardingDate()" class="form-control border h-px-20_custom"
                                        value="{{ $user->endi_date }}" />
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
                                    <option value="" {{ $user->status == null ? 'selected' : '' }} disabled>
                                        Select
                                        Option
                                    </option>
                                    @foreach ($status->options as $statusOptions)
                                        <option value="{{ $statusOptions->option_name }}"
                                            {{ $user->status == $statusOptions->option_name ? 'selected' : '' }}>
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
                    <div class="row mb-1">
                        <div class="col-lg-6">
                            @php
                                $client = Helper::get_dropdown('clients');
                            @endphp
                            <div class="form-group mb-0">
                                <label class="Label">Client</label>
                                <select name="CLIENT" disabled="" id="client" onchange="clientChanged(1)"
                                    class="form-control border pl-0 arrow-3 h-px-20_custom font-size-4 d-flex align-items-center select2_dropdown w-100">
                                    <option value="" {{ $user->client == null ? 'selected' : '' }} disabled>
                                        Select
                                        Option
                                    </option>
                                    @foreach ($client->options as $clientOptions)
                                        <option value="{{ $clientOptions->option_name }}"
                                            {{ $user->client == $clientOptions->option_name ? 'selected' : '' }}>
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
                                    <option value=""
                                        {{ $user->remarks_for_finance == null ? 'selected' : '' }} disabled>
                                        Select Option</option>
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
                                    <option value="" {{ $user->site == null ? 'selected' : '' }} disabled>
                                        Select
                                        Option
                                    </option>
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
                        <div class="col-lg-6 d-none">
                            <div class="form-group mb-0">
                                @php
                                    $remarks = Helper::get_dropdown('remarks_from_finance');
                                @endphp
                                <label class="Label">
                                    Remarks (From Recruiter):
                                </label>
                                <select disabled="" name="REMARKS_FROM_FINANCE" id="remarks"
                                    class="form-control border pl-0 arrow-3 h-px-20_custom w-100 font-size-4 d-flex align-items-center w-100">
                                    <option value="" {{ $user->remarks == null ? 'selected' : '' }} disabled>
                                        Select
                                        Option
                                    </option>
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
                                    <option value="" {{ $user->rfp == null ? 'selected' : '' }} disabled>
                                        Select
                                        Option
                                    </option>
                                    @foreach ($ReasonForNotP->options as $ReasonForNotPOptions)
                                        {{ $user->rfp == $ReasonForNotP->option_name ? 'selected' : '' }}>
                                        <option value="{{ $ReasonForNotPOptions->option_name }}"
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
                                    <select id="domain_endo" name="DOMAIN_ENDORSEMENT"
                                        onchange="endoDomainChange(this)" readonly
                                        class="form-control border pl-0 arrow-3 h-px-20_custom w-100 font-size-4 d-flex align-items-center w-100">
                                        <option value="" {{ $user->domain_endo == null ? 'selected' : '' }}
                                            disabled>
                                            Select Option
                                        </option>
                                        @foreach ($domainDrop as $domainOption)
                                            <option value="{{ $domainOption->id }}"
                                                {{ ($user->domain_endo != null ? strtolower($user->domain_endo) == strtolower($domainOption->domain_name) : '') ? 'selected' : '' }}>
                                                {{ $domainOption->domain_name }}</option>
                                        @endforeach
                                    </select>
                                    <div>
                                        <small class="text-danger"></small>
                                    </div>
                                </div>
                            </div>
                            {{-- reason for not progressing --}}
                            <div class="col-lg-6">
                                <div class="form-group mb-0">
                                    <label class="Label">Interview Date:</label>
                                    <input type="date" name="INTERVIEW_SCHEDULE" disabled=""
                                        id="interview_schedule" class="form-control users-input-S-C"
                                        value="{{ $user->interview_date }}" />
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
                                    <select readonly id="segment" name="SEGMENT"
                                        class="form-control border pl-0 arrow-3 h-px-20_custom w-100 font-size-4 d-flex align-items-center w-100"
                                        onchange="endoSegmentChange(this)">
                                        <option value="" {{ $user->segment_endo == null ? 'selected' : '' }}
                                            disabled>
                                            Select Option
                                        </option>
                                        @foreach ($segments->options as $segmentsOptions)
                                            <option value="{{ $segmentsOptions->id }}"
                                                {{ ($user->segment_endo != null ? strtolower($user->segment_endo) == strtolower($segmentsOptions->option_name) : '') ? 'selected' : '' }}>
                                                {{ $segmentsOptions->option_name }}
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
                        <div class="row mb-1">
                            {{-- sub segment --}}
                            <div class="col-lg-6">
                                @php
                                    $sub_segment = Helper::get_dropdown('sub_segment');
                                @endphp
                                <div class="form-group mb-0">
                                    <label class="Label">sub-segment</label>
                                    <select readonly id="sub_segment" name="SUB_SEGMENT"
                                        class="form-control border pl-0 arrow-3 h-px-20_custom w-100 font-size-4 d-flex align-items-center w-100">
                                        <option value=""
                                            {{ $user->sub_segment_endo == null ? 'selected' : '' }} disabled>
                                            Select Option
                                        </option>
                                        @foreach ($sub_segment->options as $sub_segmentOptions)
                                            <option value="{{ $sub_segmentOptions->id }}"
                                                {{ ($user->sub_segment_endo != null ? strtolower($user->sub_segment_endo) == strtolower($sub_segmentOptions->option_name) : '') ? 'selected' : '' }}>
                                                {{ $sub_segmentOptions->option_name }}
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
                                                $remarkss = Helper::get_dropdown('remarks_from_finance');
                                            @endphp
                                            <label class="d-block font-size-3 mb-0">
                                                Remarks (from Finance)
                                            </label>
                                            <select name="REMARKS" id="remarks_finance"
                                                class="form-control border pl-0 arrow-3 h-px-20_custom w-100 font-size-4 d-flex align-items-center w-100">
                                                <option value=""
                                                    {{ $finance_remark == null ? 'selected' : '' }} disabled>
                                                </option>
                                                @foreach ($remarkss->options as $remarksOptions)
                                                    <option value="{{ $remarksOptions->option_name }}"
                                                        {{ strtolower($remarksOptions->option_name) == strtolower($finance_remark) ? 'selected' : '' }}>
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
                                            <input type="date" name="ONBOARDING_DATE" id="onboard_date"
                                                value="{{ $user->onboardnig_date }}"
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
                                                Standard Projected Revenue
                                            </label>
                                            <input type="number" name="STANDARD_PROJECTED_REVENUE" id="srp"
                                                value="{{ $user->srp }}" class="form-control h-px-20_custom"
                                                readonly />
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
                                            <input type="text" name="INVOICE_NUMBER" id="invoice_number" readonly
                                                value="{{ $financeDetail->invoice_number }}"
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
                                            <select name="CLIENT_FINANCE"
                                                class="form-control border h-px-20_custom w-100" id="client_finance"
                                                readonly>
                                                <option value=""
                                                    {{ $user->client_finance == null ? 'selected' : '' }} disabled>
                                                    Select
                                                    Option</option>
                                                @foreach ($client->options as $clientOptions)
                                                    <option value="{{ $clientOptions->option_name }}"
                                                        {{ $user->client_finance == $clientOptions->option_name ? 'selected' : '' }}>
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
                                                value="{{ $user->Total_bilable_ammount }}"
                                                oninput="amountFinder(this)"
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
                                                $careerLevel = Helper::get_dropdown('career_level');
                                            @endphp
                                            <label class="d-block font-size-3 mb-0">
                                                Career level
                                            </label>
                                            <select name="CAREER_LEVEL_FINANCE" id="career_finance" readonly
                                                onchange="SPRCalculator(this)"
                                                class="form-control border h-px-20_custom">
                                                <option value=""
                                                    {{ $user->career_finance == null ? 'selected' : '' }} disabled>
                                                    Select
                                                    Option</option>
                                                @foreach ($careerLevel->options as $careerLevelOptions)
                                                    <option value="{{ $careerLevelOptions->option_name }}"
                                                        {{ $user->career_finance == $careerLevelOptions->option_name ? 'selected' : '' }}>
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
                                            <input type="text" name="RATE" id="rate" maxlength="6"
                                                oninput="amountFinder(this)"
                                                class="form-control border h-px-20_custom"
                                                value="{{ $user->rate ? $user->rate : 0 }}" />
                                            <div>
                                                <small class="   text-danger"></small>
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
                                            <input type="number" name="OFFERED_SALARY_finance"
                                                id="off_salary_fianance" readonly
                                                value="{{ $financeDetail->offered_salary }}"
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
                                                value="{{ $financeDetail->placementFee }}"
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
                                            <input type="number" name="ALLOWANCE" id="off_allowance_finance"
                                                readonly value="{{ $financeDetail->allowance }}"
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


            <!-- FINANCE section end -->
            <!-- ================== -->
    </fieldset>
</div>
<script src="{{ asset('assets/plugins/select2/js/select2.full.min.js') }}"></script>
<script src="{{ asset('assets/js/data-entry.js') }}"></script>
<script src="{{ asset('assets/js/select2.min.js') }}"></script>
<script>
    $("form#data_entry select").each(function() {
        $(this).attr('readonly') ? $(this).css('pointer-events', 'none') : ''
    });
    // select2Dropdown("select2_dropdown");
    $('#saveRecord').prop("disabled", true)
    $('#save').prop("disabled", true)
    // enable save record on input change button 
    $("form :input").on('input', function() {
        $('#saveRecord').prop("disabled", false)
    });
    var title = "<?php echo $user->position_title; ?>";
    var career_endo = "<?php echo $user->career_endo; ?>";
    select2Dropdown("select2_dropdown");
    var globalData = [];
    $(document).ready(function() {
        // $.ajax({
        //     url: '{{ url('admin/traveseDataByClientProfile') }}',
        //     type: 'POST',
        //     data: {
        //         // position: $('#position').val(),
        //         client_dropdown: $('#client').val(),
        //         _token: token
        //     },

        //     // Ajax success function
        //     success: function(res) {
        //         if (res.data.length > 0) {
        //             globalData = res.data;
        //             $('#position').change()
        //         }
        //     }
        // })
        clientChanged(0)
        mask('rate');
        var detailInput = <?php echo json_encode($inputDetail); ?>;
        status = <?php echo json_encode($user->status); ?>;
        if (status.toLowerCase() != 'valid') {
            $('#status').change();
        }
        $('#userDetailInput').html('<p>' + detailInput + '</p>');
        var id = $('#user').val();
        // var endoID = $('#no_endo').val();
        // console.log('id is' + id);
        var t = url + "/admin/QRCode" + '/' + id;

        // console.log(t);
        // ajax call for user data fetching starts
        $.ajax({
            type: "GET",
            // url: url + "/admin/QRCode" + '/' + id,
            url: "{{ url('admin/QRCode') }}" + '/' + id,
            data: {
                _token: token,
                id: id
            },
            // success function after ajax call starts
            success: function(data) {
                // console.log('hi')

                setTimeout(() => {
                    $('#loader5').hide()
                    $('#QrCode').html(data);
                }, 2000);
            },
            // success function after ajax call ends

        });
        // ajax call for user data fetching ends
    });
    // enable and disable course fields on selected educational attainment

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
    select2Dropdown("select2_dropdown");
    $('#certificate').prop('disabled', true)
    $('#detail_candidate').val()
    // on reamrks recruiter change 

    $('#remarks').change(function() {
        value = $(this).val();
        $('#remarks_finance').append(`<option selected value="${value}">
                                       ${value}
                                  </option>`);
    });
    // close 
    // var globalData = [];

    function clientChanged(val) {

        $('#loader2').addClass('d-block')
        if (val == 1) {
            $('#position').prop("disabled", false);
        }
        $('#loader2').removeClass('d-none')
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
                        //  var existval = {!! $title !!};
                        var existval = "<?php echo $title; ?>";
                        if ($('#client').val() == res.data[i].client) {
                            if ($(`#position option[ value="${res.data[i].p_title}"]`).length < 1) {
                                if (res.data[i].p_title == existval) {
                                    $('#position').append(
                                        `<option  selected value="${res.data[i].p_title}">${res.data[i].p_title}</option>`
                                    );
                                } else {
                                    $('#position').append(
                                        `<option   value="${res.data[i].p_title}">${res.data[i].p_title}</option>`
                                    );
                                }
                            }
                        }
                    }

                    // let value = $('#client').val()
                    // $('#client_finance').append(`<option selected  value="${value}">
                    //                    ${value}
                    //               </option>`)
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
        // let value = $('#career').val()
        // $('#career_finance').append(`<option selected value="${value}">
        //                                ${value}
        //                           </option>`)
        DomainSegmentAppend()


    })

    function DomainSegmentAppend() {
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
        const pure = pureValue();
        saveValue(pure);

        if (!pure) {
            elm.value = '';
            return;
        }
        elm.value = pure + suffix;
        focusNumber();
    }
    // append option in remarks for finance on status change 
    $('#status').on('change', function() {
        console.log($(this).val());
        if (($(this).val() !== null) ? ($(this).val().toLowerCase() == 'invalid') : false) {
            $('#remarks_for_finance').empty().trigger('change');
            var option = new Option("In Client's DB/Portal", "In Client's DB/Portal", true, true);
            $('#remarks_for_finance').append(option).trigger('change');
        } else if (($(this).val() !== null) ? ($(this).val().toLowerCase() == 'pending validation') : false) {
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
    traverseData()

</script>
