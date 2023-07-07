@extends('layouts.app')
@section('style')
    <!-- ================= -->
    <!-- Datatable css start-->
    <link rel="stylesheet" href="{{ asset('assets/css/jquery.dataTables.min.css') }}" />

    <!-- Datatable css end-->
    <!-- ================= -->
    <style>
        .btn-class {
            /* margin-top: -300px !important; */
        }

        .borderRed {
            border: 1px red solid !important;
        }
    </style>
@endsection


@section('content')
    <div class="card mb-13">
        <div class="card-body">
            <form name="jdlForm" id="jdlForm" action="" enctype="multipart/form-data">
                @csrf
                <fieldset id="mainFieldset" disabled="">
                    <div class="row mb-1">
                        <div class="col-lg-4">
                            <div class="form-group mb-0">
                                @php
                                    $client = Helper::get_dropdown('clients');
                                    $classification = Helper::get_dropdown('classification');
                                    $status = Helper::get_dropdown('status');
                                    $position_title = Helper::get_dropdown('position_title');
                                    $reqClassification = Helper::get_dropdown('reqClassification');
                                    $recruiter = App\User::where('type', '3')->get();
                                @endphp
                                <label class="d-block font-size-3 mb-0">
                                    Client:
                                </label>

                                <select name="client" id="client" onchange="clientChangeAutomateFunc(this)"
                                    class="form-control border pl-0 arrow-3 h-px-20_custom w-100 font-size-4 d-flex align-items-center select2_dropdown w-100 select2-hidden-accessible">
                                    @foreach ($client->options as $clientOptions)
                                        <option value="{{ $clientOptions->option_name }}"
                                            {{ $user->client == $clientOptions->option_name ? 'selected' : '' }}>
                                            {{ $clientOptions->option_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group mb-0">
                                <label class="Label">
                                    Classification
                                </label>
                                <select name="classification" id="classification"
                                    class="form-control border pl-0 arrow-3 h-px-20_custom w-100 font-size-4 d-flex align-items-center select2_dropdown w-100 select2-hidden-accessible">
                                    @foreach ($classification->options as $classificationOptions)
                                        <option value="{{ $classificationOptions->option_name }}"
                                            {{ $user->classification == $classificationOptions->option_name ? 'selected' : '' }}>
                                            {{ $classificationOptions->option_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>


                        </div>
                        <div class="col-lg-4">

                            <div class="form-group mb-0">
                                <label class="Label">
                                    Status
                                </label>
                                <select name="status" id="status"
                                    class="form-control border pl-0 arrow-3 h-px-20_custom w-100 font-size-4 d-flex align-items-center select2_dropdown w-100 select2-hidden-accessible">
                                    @foreach ($status->options as $statusOptions)
                                        <option value="{{ $statusOptions->option_name }}"
                                            {{ $user->status == $statusOptions->option_name ? 'selected' : '' }}>
                                            {{ $statusOptions->option_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                    </div>
                    <div class="row mb-1">
                        <div class="col-lg-4">
                            <div class="form-group mb-0">
                                <label class="Label">
                                    Position Title
                                </label>
                                <select id="position" name="p_title" onchange="appendDomains(this)"
                                    class="form-control select2_dropdown  w-100 border pl-0 arrow-3 h-px-20_custom w-100 font-size-4 d-flex align-items-center w-100">
                                    <option value="" {{ $user->p_title == null ? 'selected' : '' }} disabled>
                                        Select Option</option>
                                    @foreach ($position_title->options as $position_titleOptions)
                                        <option value="{{ $position_titleOptions->option_name }}"
                                            {{ $user->p_title == $position_titleOptions->option_name ? 'selected' : '' }}>
                                            {{ $position_titleOptions->option_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>


                        </div>
                        <div class="col-lg-4">
                            <div class="form-group mb-0">
                                <label class="Label">
                                    Requirement Classification
                                </label>
                                <select id="reqClassification" name="req_classification"
                                    class="form-control select2_dropdown  w-100 border pl-0 arrow-3 h-px-20_custom w-100 font-size-4 d-flex align-items-center w-100">
                                    <option value="" {{ $user->req_classification == null ? 'selected' : '' }}
                                        disabled> Select Option</option>
                                    @foreach ($reqClassification->options as $reqClassificationOptions)
                                        <option value="{{ $reqClassificationOptions->option_name }}"
                                            {{ $user->req_classification == $reqClassificationOptions->option_name ? 'selected' : '' }}>
                                            {{ $reqClassificationOptions->option_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group mb-0">
                                <label class="Label">
                                    Keyword
                                </label>
                                <input type="text" name="keyword" class="form-control users-input-S-C"
                                    value="{{ $user->keyword }}" />
                            </div>
                        </div>
                    </div>
                    <div class="row mb-1">
                        <div class="col-lg-4">
                            <div class="form-group mb-0">
                                <label class="d-block font-size-3 mb-0">
                                    Updated FTE:
                                </label>
                                <input type="text" name="updated_fte" class="form-control border h-px-20_custom"
                                    value="{{ $user->updated_fte }}" />
                            </div>


                        </div>
                        <div class="col-lg-4">
                            <div class="form-group mb-0">
                                <label class="Label">
                                    # of Active endo
                                </label>
                                <input type="text" class="form-control users-input-S-C" value="" readonly <input
                                    type="text" class="form-control users-input-S-C" value="" id="active_endo" />
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group mb-0">
                                <label class="Label">
                                    # of Inactive endo
                                </label>
                                <input type="text" class="form-control users-input-S-C" value="" readonly
                                    id="inactive_endo" />
                            </div>
                        </div>
                    </div>

                    <div class="row mb-1">
                        <div class="col-lg-4">
                            <div class="form-group mb-0">
                                @php
                                    $CareerLevel = Helper::get_dropdown('career_level');
                                @endphp
                                <label class="d-block font-size-3 mb-0">
                                    Career Level
                                </label>
                                {{-- <input type="text" class="form-control users-input-S-C"
                                    value="{{ $user->c_level }}" /> --}}
                                <select name="c_level" id="c_level"
                                    class="form-control border select2_dropdown pl-0 arrow-3 h-px-20_custom w-100 font-size-4 d-flex align-items-center w-100">

                                    @foreach ($CareerLevel->options as $CareerLevelOptions)
                                        <option value="{{ $CareerLevelOptions->option_name }}"
                                            {{ $user->c_level == $CareerLevelOptions->option_name ? 'selected' : '' }}>
                                            {{ $CareerLevelOptions->option_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group mb-0">
                                <label class="Label">SLL No:</label>
                                <input type="text" name="sll_no" class="form-control users-input-S-C"
                                    value="{{ $user->sll_no }}" />
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group mb-0">
                                <label class="Label">Requisition ID #</label>
                                <input type="text" class="form-control users-input-S-C" value="{{ $user->req_id }}"
                                    name="req_id" />
                            </div>
                        </div>

                    </div>
                    <div class="row mb-1">
                        <div class="col-lg-4">
                            <div class="form-group mb-0">
                                @php
                                    $domain = App\Domain::get();
                                @endphp
                                <label class="d-block font-size-3 mb-0">
                                    Domain:
                                </label>

                                <select name="domain" id="domain" onchange="endoDomainChange(this)" readonly
                                    class="form-control border pl-0 arrow-3 h-px-20_custom w-100 font-size-4 d-flex align-items-center   w-100">
                                    <option value="" class="selectedOption" selected disabled>
                                        Select Option
                                    </option>
                                    @foreach ($domain as $domainOptions)
                                        <option value="{{ $domainOptions->id }}"
                                            {{ $user->domain == $domainOptions->domain_name ? 'selected' : '' }}>
                                            {{ $domainOptions->domain_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            @php
                                $segments = App\Segment::get();
                            @endphp
                            <div class="form-group mb-0">
                                <label class="d-block font-size-3 mb-0">
                                    Segment
                                </label>
                                {{-- <input type="text" class="form-control users-input-S-C" value="{{ $user->segment }}" /> --}}
                                <select id="segment" name="segment" onchange="endoSegmentChange('#segment')" readonly
                                    class="form-control border   pl-0 arrow-3 h-px-20_custom w-100 font-size-4 d-flex align-items-center w-100">
                                    <option class="selectedOption" selected disabled>
                                        Select Option</option>
                                    @foreach ($segments as $segmentsOptions)
                                        <option value="{{ $segmentsOptions->id }}"
                                            {{ $user->segment == $segmentsOptions->segment_name ? 'selected' : '' }}>
                                            {{ $segmentsOptions->segment_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            @php
                                $subSegments = App\SubSegment::get();
                                $edu_attain = Helper::get_dropdown('educational_attainment');
                                $priority = Helper::get_dropdown('priority');
                                $assignment = Helper::get_dropdown('assignment');
                                $location = Helper::get_dropdown('location');
                                $work_schedule = Helper::get_dropdown('work_schedule');
                            @endphp
                            <div class="form-group mb-0">
                                <label class="d-block font-size-3 mb-0">
                                    Sub-Segment
                                </label>
                                {{-- <input type="text" class="form-control users-input-S-C"
                                    value="{{ $user->subsegment }}" /> --}}
                                <select id="subsegment" name="subsegment" readonly
                                    class="form-control border   pl-0 arrow-3 h-px-20_custom w-100 font-size-4 d-flex align-items-center w-100">
                                    <option class="selectedOption" selected disabled>
                                        Select Option</option>
                                    @foreach ($subSegments as $subSegmentsOptions)
                                        <option value="{{ $subSegmentsOptions->sub_segment_name }}"
                                            {{ $user->subsegment == $subSegmentsOptions->sub_segment_name ? 'selected' : '' }}>
                                            {{ $subSegmentsOptions->sub_segment_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-1">
                        <div class="col-lg-4">
                            <div class="form-group mb-0">
                                <label class="Label">Priority</label>
                                <select id="priority" name="priority"
                                    class="form-control border select2_dropdown pl-0 arrow-3 h-px-20_custom w-100 font-size-4 d-flex align-items-center w-100">
                                    <option class="selectedOption" selected disabled>
                                        Select Option</option>
                                    @foreach ($priority->options as $priorityOptions)
                                        <option value="{{ $priorityOptions->option_name }}"
                                            {{ $user->priority == $priorityOptions->option_name ? 'selected' : '' }}>
                                            {{ $priorityOptions->option_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group mb-0">
                                <label class="Label">Assignment</label>
                                <select id="assignment" name="assignment"
                                    class="form-control border select2_dropdown pl-0 arrow-3 h-px-20_custom w-100 font-size-4 d-flex align-items-center w-100">
                                    <option class="selectedOption" selected disabled>
                                        Select Option</option>
                                    @foreach ($assignment->options as $assignmentOptions)
                                        <option value="{{ $assignmentOptions->option_name }}"
                                            {{ $user->assignment == $assignmentOptions->option_name ? 'selected' : '' }}>
                                            {{ $assignmentOptions->option_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group mb-0">
                                <label class="Label">Maturity</label>
                                <input type="text" name="maturity" class="form-control users-input-S-C" readonly
                                    value="{{ $user->maturity }}" />
                            </div>
                        </div>
                    </div>
                    <div class="row mb-1">
                        <div class="col-lg-4">
                            <div class="form-group mb-0">
                                <label class="Label">Budget:</label>
                                <input type="text" class="form-control users-input-S-C" name="budget"
                                    value="{{ $user->budget }}" />
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group mb-0">
                                <label class="Label">Location:</label>
                                <select id="location" name="location"
                                    class="form-control border select2_dropdown pl-0 arrow-3 h-px-20_custom w-100 font-size-4 d-flex align-items-center w-100">
                                    <option class="selectedOption" selected disabled>
                                        Select Option</option>
                                    @foreach ($location->options as $locationOptions)
                                        <option value="{{ $locationOptions->option_name }}"
                                            {{ $user->location == $locationOptions->option_name ? 'selected' : '' }}>
                                            {{ $locationOptions->option_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group mb-0">
                                <label class="Label">
                                    Educational Attainment:
                                </label>
                                <input type="text" class="form-control users-input-S-C" name="edu_attainment"
                                    value="{{ $user->edu_attainment }}" />
                            </div>
                        </div>

                    </div>
                    <div class="row mb-1">
                        <div class="col-lg-4">
                            <div class="form-group mb-0">
                                <label class="Label">
                                    Work Schedule:
                                </label>
                                <select id="w_schedule" name="w_schedule"
                                    class="form-control border select2_dropdown pl-0 arrow-3 h-px-20_custom w-100 font-size-4 d-flex align-items-center w-100">
                                    <option class="selectedOption" selected disabled>
                                        Select Option</option>
                                    @foreach ($work_schedule->options as $work_scheduleOptions)
                                        <option value="{{ $work_scheduleOptions->option_name }}"
                                            {{ $user->w_schedule == $work_scheduleOptions->option_name ? 'selected' : '' }}>
                                            {{ $work_scheduleOptions->option_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group mb-0">
                                <label class="d-block font-size-3 mb-0">
                                    Start Date
                                </label>
                                <input type="text" class="form-control users-input-S-C" name="start_date"
                                    value="{{ $user->start_date }}" />
                            </div>
                        </div>
                        <div class="col-lg-4">

                        </div>
                    </div>
                    <div class="row mb-1">
                        <div class="col-lg-12">
                            <div class="form-group mb-0">
                                <label class="d-block font-size-3 mb-0 ">
                                    Job Description &amp; Work Experience:
                                </label>
                                <textarea name="jd" rows="3" type="text" class="form-control border E_H h-px-20_custom"
                                    placeholder="Write Job Description &amp; Work Experience Here">{{ $user->jd }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-1">
                        <div class="col-lg-4">
                            <div class="form-group mb-0">
                                <label class="d-block font-size-3 mb-0">
                                    Recruitment Process:
                                </label>
                                <input name="poc" type="text" class="form-control border"
                                    placeholder="Write Recruitment Process Here" value="{{ $user->poc }}" />
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group mb-0">
                                <label class="d-block font-size-3 mb-0">
                                    Notes:
                                </label>
                                <input name="note" type="text" class="form-control border"
                                    placeholder="Write Interview Notes Here" value="{{ $user->note }}" />
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group mb-0">
                                <label class="d-block font-size-3 mb-0">
                                    Client Spiel
                                </label>
                                <input name="client_spiel" id="client_spiel" type="text" class="form-control border"
                                    placeholder="Write Client Spiel Here" value="{{ $user->client_spiel }}" />
                            </div>
                        </div>
                    </div>
                    <div class="row mb-1">
                        <div class="col-lg-4">
                            <div class="form-group mb-0">
                                <label class="d-block font-size-3 mb-0">
                                    Recruiters:
                                </label>
                                <select name="recruiter" id="recruiter"
                                    class="form-control border select2_dropdown pl-0 arrow-3 h-px-20_custom w-100 font-size-4 d-flex align-items-center w-100">

                                    @foreach ($recruiter as $recruiterOptions)
                                        <option value="{{ $recruiterOptions->id }}"
                                            {{ $user->recruiter == $recruiterOptions->id ? 'selected' : '' }}>
                                            {{ $recruiterOptions->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group mb-0">
                                <label class="d-block font-size-3 mb-0">
                                    Date Updated:
                                </label>
                                <input type="date" name="updated_date" class="form-control border h-px-20_custom"
                                    value="{{ $user->updated_date }}" />
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group mb-0">
                                <label class="d-block font-size-3 mb-0">
                                    Turn Around Time
                                </label>
                                <input type="text" name="turn_around" id="turn_around" readonly
                                    class="form-control border h-px-20_custom" value="{{ $user->turn_around }}" />
                            </div>
                        </div>
                    </div>
                </fieldset>

                <div class="row mb-1">

                    <div class="col-lg-12 text-center">
                        <button class="btn btn-lg btn-primary pt-2 mt-3 ml-3 w-25 btn-class" type="button"
                            id="edit" enabled> <i class="bi bi-pencil-square mr-2"></i>Edit
                            Job</button>
                        <button class="btn btn-lg btn-success pt-2 mt-3 ml-3 w-25 btn-class" type="button"
                            disabled="" id="save"
                            onclick="ajaxCallDataJDL('jdlForm', '{{ route('update-jdl') }} ')"> <i
                                class="bi bi-save mr-2"></i> Save Job</button>
                        <button class="btn btn-lg btn-danger pt-2 mt-3 ml-3 w-25 btn-class" type="button" id="delete"
                            onclick="verifyDeleteRecord('{{ $user->id }}' , '{{ route('delete-jdl') }}') " enabled>
                            <i class="bi bi-trash mr-2"></i>Delete
                            Job</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection


@section('script')
    <script src="{{ asset('assets/js/sweetalert2.all.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            activeEndo = {!! $activeEndorsmentCount !!}
            inActiveEndo = {!! $inActiveEndorsmentCount !!}
            turn_around = {!! $turnAround !!}
            $('#active_endo').val(activeEndo)
            $('#turn_around').val(turn_around)
            $('#inactive_endo').val(inActiveEndo)
            select2Dropdown("select2_dropdown");
        })
        function appendDomains(elem) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            console.log($('#position').val());
            p_title = $(elem).val();
            client = $('#client').val();
            $.ajax({
                type: 'post',
                url: "{{ route('get-positionTtitle-data') }}",
                data: {
                    p_title: p_title,
                    client: client,
                    _token: token
                },

                // Ajax success function
                success: function(res) {
                    console.log(res);
                    $('#domain').append(
                        `<option selected value = ${res.data.dropdown.domain}> ${res.data.dropdown.domain} </option>`
                    )
                    $('#segment').append(
                        `<option selected value = ${res.data.dropdown.segment}> ${res.data.dropdown.segment} </option>`
                    )
                    $('#subsegment').append(
                        `<option selected value = ${res.data.dropdown.subSegment}> ${res.data.dropdown.subSegment} </option>`
                    )
                    if (res.data.recruiter) {
                        for (let index = 0; index < res.data.recruiter.length; index++) {
                            $('#recruiter').append(
                                `<option selected value = ${res.data.recruiter[index]}> ${res.data.recruiter[index]} </option>`
                            )

                        }
                    }
                }
            })
        }
        $('#edit').on('click', function() {
            $('#mainFieldset').attr('disabled', false);
            $('#save').attr('disabled', false);
            $(this).attr('disabled', true);
            $('fieldset:not([disabled]) select').prop('disabled', false).trigger('change');

        })
        $('fieldset[disabled] select').prop('disabled', true).trigger('change');

        // on domain change 
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
        // domain change end

        // on segment change function starts 
        function endoSegmentChange(elem) {
            $('#subsegment').empty()
            var sub_segmentsDropDown = {!! $sub_segmentsDropDown !!};
            console.log($(elem).val());
            var count = 0;
            for (let i = 0; i < sub_segmentsDropDown.length; i++) {
                if ($(elem).val() == sub_segmentsDropDown[i].segment_id) {
                    $('#subsegment').append('<option value="' + sub_segmentsDropDown[i].id + '">' +
                        sub_segmentsDropDown[i].sub_segment_name + '</option>');
                }
            }
        }
        // on segment chagne function ends 

        // get form credentails and AJAX Call
        function ajaxCallDataJDL(form, route) {
            var data = new FormData(document.getElementById(form));
            id = {!! $user->id !!};
            data.append('id', id);
            $.ajax({
                url: route,
                data: data,
                contentType: false,
                processData: false,
                type: 'POST',

                // Ajax success function
                success: function(res) {
                    if (res.success == true) {
                        $("#loader").hide();

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
                                timer: 3500
                            })
                            $("#loader").hide();

                        }

                        // show validation error on scree with border color changed and text
                        if (res.hasOwnProperty("message")) {
                            console.log('errrrrrrrrrrrrrrrror');
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
        };
        // get form credentails and AJAX Call ends

        // delete jdl record after verfiy by sweetalert
        function verifyDeleteRecord(id, route) {
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
                        deleteRecord(id, route);
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
        // deelte the jdl record function 
        function deleteRecord(id, route) {
            console.log('id is ' + id);
            console.log('route is ' + route);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: route,
                data: {
                    id: id
                },
                type: 'POST',

                // Ajax success function
                success: function(res) {
                    if (res.success == true) {
                        $("#loader").hide();
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: res.message,
                            showConfirmButton: false,
                            timer: 1000
                        })
                        setTimeout(() => {
                            window.location.href = '{{ url('admin/jdl') }}';
                        }, 800);
                    } else if (res.success == false) {
                        if (res.status == 1) {
                            Swal.fire({
                                position: 'center',
                                icon: 'warning',
                                title: res.message,
                                showConfirmButton: false,
                                timer: 1000
                            })
                            $("#loader").hide();
                        }

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
        // delte jdl record function ends 

        // on client chagne automate options of classification and spiel 
        function clientChangeAutomateFunc(elem) {
            var clientData = {!! $clientData !!};
            console.log(clientData);

            var clientClassifications = []; // Array to store client classifications

            for (let index = 0; index < clientData.length; index++) {
                if (clientData[index].client == $(elem).val()) {
                    clientClassifications.push(clientData[index]
                    .ClientClassification); // Add client classification to the array
                    console.log(clientData[index]);
                    // console.log(clientData[index].ClientSpiel);
                    $('#client_spiel').val(clientData[index].ClientSpiel);
                }
            }


            // Clear previous options and append new options
            // var selectElement = $('#client_classification');
            // selectElement.val([]).trigger('change');
            $('#classification').empty();
            for (let i = 0; i < clientClassifications.length; i++) {
                $('#classification').append('<option value="' + clientClassifications[i] + '">' +
                    clientClassifications[i] + '</option>');
            }
            $('#classification').trigger('change');
            console.log('-----------------');
            // console.log($('#client_spiel').val());
        }

        // end 
    </script>
@endsection
