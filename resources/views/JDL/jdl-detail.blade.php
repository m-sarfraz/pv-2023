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
                                    $position_title = Helper::get_dropdown('position_title');
                                    $status = Helper::get_dropdown('status');
                                @endphp
                                <label class="Label">
                                    Position Title
                                </label>
                                {{-- <input type="text" class="form-control users-input-S-C" value="{{ $user->p_title }}" /> --}}
                                <select id="position" name="p_title"
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
                                <label class="Label">Priority</label>
                                <input type="text" name="priority" class="form-control users-input-S-C"
                                    value="{{ $user->priority }}" />
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group mb-0">
                                <label class="Label"> FTE:</label>
                                <input type="text" name="t_fte" class="form-control users-input-S-C"
                                    value="{{ $user->t_fte }}" />
                            </div>
                        </div>
                    </div>
                    <div class="row mb-1">
                        <div class="col-lg-4">
                            <div class="form-group mb-0">
                                <label class="Label">
                                    Updated FTE
                                </label>
                                <input type="text" class="form-control users-input-S-C" name="updated_fte"
                                    value="{{ $user->updated_fte }}" />

                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group mb-0">
                                <label class="Label">Ref-Code</label>
                                <input type="text" class="form-control users-input-S-C" name="ref_code"
                                    value="{{ $user->ref_code }}" />
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group mb-0">
                                <label for="" class="Label labelFontSize mt-3">Status</label>
                                <select name="status" id="status" class="select2_dropdown w-100 form-control">
                                    @foreach ($status->options as $render_status)
                                        <option value="{{ $render_status->option_name }}"
                                            {{ $user->status == $render_status->option_name ? 'selected' : '' }}>
                                            {{ $render_status->option_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-1">
                        <div class="col-lg-4">
                            <div class="form-group mb-0">
                                <label class="Label">No of Endo:</label>
                                <input type="text" class="form-control users-input-S-C" disabled
                                    value={{ $endorsmentCount }} />
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group mb-0">
                                @php
                                    $client = Helper::get_dropdown('clients');
                                @endphp
                                <label class="d-block font-size-3 mb-0">
                                    Client:
                                </label>

                                <select name="client" id="client"
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
                                <label class="Label">SLL No:</label>
                                <input type="text" class="form-control users-input-S-C" name="sll_no"
                                    value="{{ $user->sll_no }}" />
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

                                <select name="domain" id="domain" onchange="endoDomainChange(this)"
                                    class="form-control border pl-0 arrow-3 h-px-20_custom w-100 font-size-4 d-flex align-items-center select2_dropdown w-100">
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
                                <select id="segment" name="segment" onchange="endoSegmentChange('#segment')"
                                    class="form-control border pl-0 arrow-3 h-px-20_custom w-100 font-size-4 d-flex align-items-center w-100">
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
                                
                            @endphp
                            <div class="form-group mb-0">
                                <label class="d-block font-size-3 mb-0">
                                    Sub-Segment
                                </label>
                                {{-- <input type="text" class="form-control users-input-S-C"
                                    value="{{ $user->subsegment }}" /> --}}
                                <select id="subsegment" name="subsegment"
                                    class="form-control border pl-0 arrow-3 h-px-20_custom w-100 font-size-4 d-flex align-items-center w-100">
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
                                <label class="d-block font-size-3 mb-0">
                                    Keyword
                                </label>
                                <input type="text" class="form-control users-input-S-C" name="keyword"
                                    value="{{ $user->keyword }}" />
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group mb-0">
                                <label class="d-block font-size-3 mb-0">
                                    Start Date
                                </label>
                                <input type="date" class="form-control users-input-S-C" name="start_date"
                                    value="{{ $user->start_date ? date('Y-m-d', strtotime($user->start_date)) : '' }}" />
                            </div>
                        </div>
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
                                    class="form-control border pl-0 arrow-3 h-px-20_custom w-100 font-size-4 d-flex align-items-center w-100">

                                    @foreach ($CareerLevel->options as $CareerLevelOptions)
                                        <option value="{{ $CareerLevelOptions->option_name }}"
                                            {{ $user->c_level == $CareerLevelOptions->option_name ? 'selected' : '' }}>
                                            {{ $CareerLevelOptions->option_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-1">
                        <div class="col-lg-4">
                            <div class="form-group mb-0">
                                <label class="d-block font-size-3 mb-0">
                                    Requirement Date
                                </label>
                                <input type="date" class="form-control users-input-S-C" name="req_date"
                                    value="{{ $user->req_date ? date('Y-m-d', strtotime($user->req_date)) : '' }}" />
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group mb-0">
                                <label class="d-block font-size-3 mb-0">
                                    Close Date
                                </label>
                                <input type="date" class="form-control users-input-S-C" name="closed_date"
                                    value="{{ $user->closed_date ? date('Y-m-d', strtotime($user->closed_date)) : '' }}" />
                            </div>
                        </div>
                        <div class="col-lg-4">

                            <div class="form-group mb-0">
                                <label class="d-block font-size-3 mb-0">
                                    OS Date
                                </label>
                                <input type="date" class="form-control users-input-S-C" name="os_date"
                                    value="{{ $user->os_date ? date('Y-m-d', strtotime($user->os_date)) : '' }}" />

                            </div>
                        </div>
                    </div>
                    <div class="row mb-1">

                        <div class="col-lg-6">
                            <div class="form-group mb-0">
                                <label class="Label">Location:</label>
                                <input type="text" class="form-control users-input-S-C" name="location"
                                    value="{{ $user->location }}" />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-0">
                                <label class="Label">
                                    Work Schedule:
                                </label>
                                <input type="text" class="form-control users-input-S-C" name="w_schedule"
                                    value="{{ $user->w_schedule }}" />
                            </div>
                        </div>
                    </div>
                    <div class="row mb-1">
                        <div class="col-lg-6">
                            <div class="form-group mb-0">
                                <label class="Label">Budget:</label>
                                <input type="text" class="form-control users-input-S-C" name="budget"
                                    value="{{ $user->budget }}" />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-0">
                                <label class="Label">
                                    Educational Background:
                                </label>

                                <select id="edu_attainment" name="edu_attainment"
                                    class="form-control select2_dropdown  w-100 border pl-0 arrow-3 h-px-20_custom w-100 font-size-4 d-flex align-items-center w-100">
                                    <option value="" class="selectedOption" selected disabled>
                                        Select Option
                                    </option>
                                    @foreach ($edu_attain->options as $edu_attainOptions)
                                        <option value="{{ $edu_attainOptions->option_name }}"
                                            {{ $user->edu_attainment == $edu_attainOptions->option_name ? 'selected' : '' }}>
                                            {{ $edu_attainOptions->option_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-1">
                        <div class="col-lg-12">
                            <div class="form-group mb-0">
                                <label class="d-block font-size-3 mb-0">
                                    Job Description &amp; Work Experience:
                                </label>
                                <textarea name="jd" rows="3" type="text" class="form-control border E_H h-px-20_custom"
                                    placeholder="Job Description &amp; Work Experience">{{ $user->jd }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-1">
                        <div class="col-lg-6">
                            <div class="form-group mb-0">
                                <label class="d-block font-size-3 mb-0">
                                    Recruitment Process:
                                </label>
                                <textarea name="poc" rows="3" type="text" class="form-control border E_H h-px-20_custom"
                                    placeholder="Recruitment Process">{{ $user->poc }}</textarea>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-0">
                                <label class="d-block font-size-3 mb-0">
                                    Notes:
                                </label>
                                <textarea name="note" rows="3" type="text" class="form-control border E_H h-px-20_custom"
                                    placeholder=" Interview Notes">{{ $user->note }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-1">
                        @php
                            $recruiters = explode(',', $user->recruiter);
                            $recruiter = App\User::where('type', '3')->get();
                            
                        @endphp
                        <div class="col-lg-6">
                            <div class="form-group mb-0">
                                <label class="d-block font-size-3 mb-0">
                                    Assigned Recruiters:
                                </label>
                                <select name="recruiter[]" id="recruiter" multiple
                                    class="form-control border select2_dropdown pl-0 arrow-3 h-px-20_custom w-100 font-size-4 d-flex align-items-center w-100">

                                    @foreach ($recruiter as $recruiterOptions)
                                        <option value="{{ $recruiterOptions->id }}"
                                            @foreach ($recruiters as $key => $value)  
                                                {{ $recruiterOptions->id == $value ? 'selected' : '' }} @endforeach>
                                            {{ $recruiterOptions->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-0">
                                <label class="d-block font-size-3 mb-0">
                                    Updated Date:
                                </label>
                                <input type="date" name="updated_date" class="form-control border h-px-20_custom"
                                    value="{{ $user->updated_date ? date('Y-m-d', strtotime($user->updated_date)) : '' }}" />
                            </div>
                        </div>
                    </div>
                </fieldset>

                <div class="row mb-1">

                    <div class="col-lg-12 text-center">
                        <button class="btn btn-lg btn-primary pt-2 mt-3 ml-3 w-25 btn-class" type="button"
                            id="edit" enabled> <i class="bi bi-pencil-square mr-2"></i>Edit
                            Job</button>
                        <button class="btn btn-lg btn-success pt-2 mt-3 ml-3 w-25 btn-class" type="button" disabled=""
                            id="save" onclick="ajaxCallDataJDL('jdlForm', '{{ route('update-jdl') }} ')"> <i
                                class="bi bi-save mr-2"></i> Save  Job</button>
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
            select2Dropdown("select2_dropdown");
        })
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
    </script>
@endsection
