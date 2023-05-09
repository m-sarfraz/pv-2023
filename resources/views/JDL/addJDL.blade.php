@extends('layouts.app')
@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/jquery.dataTables.min.css') }}" />
    <style>
        .borderRed {
            border: 1px red solid !important;
        }

        .borderRed:focus {
            box-shadow: 0 0 0 0.05rem red !important;
        }
    </style>
@endsection


@section('content')
    @if (Session::has('message'))
        <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
    @endif
    @if ($errors->has('message'))
        <li>{{ $errors->first('message') }}</li>
    @endif
    <div class="container mt-5">
        <div class="card shadow p-4"> 
            <p class="C-Heading">New JDL Entry</p>
            <hr>
            <form method="POST" action="" id="jdl_form">
                @csrf
                <div class="row mb-xl-1 mb-9">
                    <div class="col-lg-6">
                        <label for="" class="Label labelFontSize">Priority</label>
                        <input type="text" class="form-control users-input-S-C" aria-label="Username" name="priority"
                            aria-describedby="basic-addon1">
                    </div>
                    <div class="col-lg-6">
                        <label for="" class="Label labelFontSize">Ref-code</label>
                        <input type="text" class="form-control users-input-S-C" aria-label="Username" name="ref_code"
                            aria-describedby="basic-addon1">
                    </div>
                </div>
                <div class="row mb-xl-1 mb-9">
                    @php
                        $status = Helper::get_dropdown('status');
                        $client = Helper::get_dropdown('clients');
                        $domain = App\Domain::get();
                        $segment = App\Segment::get();
                        $subsegment = App\SubSegment::get();
                        $position_title = Helper::get_dropdown('position_title');
                        $c_level = Helper::get_dropdown('career_level');
                        $edu_attain = Helper::get_dropdown('educational_attainment');
                        $recruiter = App\User::where('type', '3')->get();
                        
                    @endphp
                    <div class="col-lg-6">
                        <label for="" class="Label labelFontSize mt-3">Status</label>
                        <select name="status" id="status" class="select2_dropdown w-100 form-control">
                            @foreach ($status->options as $render_status)
                                <option value="{{ $render_status->option_name }}">
                                    {{ $render_status->option_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-6">

                        <label for="" class="Label labelFontSize mt-3">Req-Date</label>
                        <input type="date" class="form-control border h-px-20_custom w-100" aria-label="Username"
                            aria-describedby="basic-addon1" name="req_date">

                    </div>
                </div>
                <div class="row mb-xl-1 mb-9">
                    <div class="col-lg-6">
                        <label for="" class="Label labelFontSize mt-3">Updated-Date</label>
                        <input type="date" class="form-control border h-px-20_custom" aria-label="Username"
                            aria-describedby="basic-addon1" name="updated_date">
                    </div>
                    <div class="col-lg-6">
                        <label for="" class="Label labelFontSize mt-3">Close-Date</label>
                        <input type="date" class="form-control border h-px-20_custom" aria-label="Username"
                            aria-describedby="basic-addon1" name="closed_date">
                    </div>
                </div>
                <div class="row mb-xl-1 mb-9">
                    <div class="col-lg-6">
                        <label for="" class="Label labelFontSize mt-3">Os-Date</label>
                        <input type="date" class="form-control border h-px-20_custom" aria-label="Username"
                            aria-describedby="basic-addon1" name="os_date">
                    </div>

                    <div class="col-lg-6">
                        <label for="" class="Label labelFontSize mt-3">Client</label>
                        <select class="form-select p-0 users-input-S-C select2_dropdown w-100 select2-hidden-accessible "
                            aria-label="Default select example" name="client">
                            <option value="" class="selectedOption" selected disabled>
                                Select Option
                            </option>
                            @foreach ($client->options as $render_client)
                                <option value="{{ $render_client->option_name }}">
                                    {{ $render_client->option_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row mb-xl-1 mb-9">
                    <div class="col-lg-6">
                        <label for="" class="Label labelFontSize mt-3">Domain</label>
                        <select id="domain" onchange="endoDomainChange(this)" name="domain"
                            class="form-control border pl-0 arrow-3 h-px-20_custom w-100 font-size-4 d-flex align-items-center select2_dropdown w-100">
                            <option value="" class="selectedOption" selected disabled>
                                Select Option
                            </option>
                            @foreach ($domain as $domainOptions)
                                <option value="{{ $domainOptions->id }}">
                                    {{ $domainOptions->domain_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-6">
                        <label for="" class="Label labelFontSize mt-3">Segment</label>
                        <select id="segment" name="segment" onchange="endoSegmentChange('#segment')"
                            class="form-control border pl-0 arrow-3 h-px-20_custom w-100 font-size-4 d-flex align-items-center w-100">
                            <option class="selectedOption" selected disabled>
                                Select Option</option>
                            @foreach ($segment as $segmentsOptions)
                                <option value="{{ $segmentsOptions->id }}">
                                    {{ $segmentsOptions->segment_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row mb-xl-1 mb-9">
                    <div class="col-lg-6">
                        <label for="" class="Label labelFontSize mt-3">Subsegment</label>
                        <select id="subsegment" name="subsegment"
                            class="form-control border pl-0 arrow-3 h-px-20_custom w-100 font-size-4 d-flex align-items-center w-100">
                            <option value="" class="selectedOption" selected disabled>
                                Select Option
                            </option>
                            @foreach ($subsegment as $subSegmentsOptions)
                                <option value="{{ $subSegmentsOptions->sub_segment_name }}">
                                    {{ $subSegmentsOptions->sub_segment_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-6">
                        <label for="" class="Label labelFontSize mt-3">P-title</label>
                        <select id="position" name="p_title"
                            class="form-control select2_dropdown  w-100 border pl-0 arrow-3 h-px-20_custom w-100 font-size-4 d-flex align-items-center w-100">
                            <option value="" class="selectedOption" selected disabled>
                                Select Option
                            </option>
                            @foreach ($position_title->options as $position_titleOptions)
                                <option value="{{ $position_titleOptions->option_name }}">
                                    {{ $position_titleOptions->option_name }}
                                </option>
                            @endforeach
                        </select>
                        </select>
                    </div>
                </div>
                <div class="row mb-xl-1 mb-9">
                    <div class="col-lg-6">
                        <label for="" class="Label labelFontSize mt-3">Career Level</label>
                        <select id="c_level " name="c_level"
                            class="form-control select2_dropdown  w-100 border pl-0 arrow-3 h-px-20_custom w-100 font-size-4 d-flex align-items-center w-100">
                            <option value="" class="selectedOption" selected disabled>
                                Select Option
                            </option>
                            @foreach ($c_level->options as $c_levelOptions)
                                <option value="{{ $c_levelOptions->option_name }}">
                                    {{ $c_levelOptions->option_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-6">
                        <label for="" class="Label labelFontSize mt-3">Sll-no</label>
                        <input type="text" class="form-control users-input-S-C" aria-label="Username" name="sll_no"
                            aria-describedby="basic-addon1">
                    </div>
                </div>

                <div class="row mb-xl-1 mb-9">
                    <div class="col-lg-6">
                        <label for="" class="Label labelFontSize mt-3">T-fte</label>
                        <input type="text" class="form-control users-input-S-C" aria-label="Username"
                            aria-describedby="basic-addon1" name="t_fte">
                    </div>
                    <div class="col-lg-6">
                        <label for="" class="Label labelFontSize mt-3">Updated-fte</label>
                        <input type="text" class="form-control users-input-S-C" aria-label="Username"
                            aria-describedby="basic-addon1" name="updated_fte">
                    </div>
                </div>
                <div class="row mb-xl-1 mb-9">
                    <div class="col-lg-6">
                        <label for="" class="Label labelFontSize mt-3">edu-attainment</label>

                        <select id="edu_attainment" name="edu_attainment"
                            class="form-control select2_dropdown  w-100 border pl-0 arrow-3 h-px-20_custom w-100 font-size-4 d-flex align-items-center w-100">
                            <option value="" class="selectedOption" selected disabled>
                                Select Option
                            </option>
                            @foreach ($edu_attain->options as $edu_attainOptions)
                                <option value="{{ $edu_attainOptions->option_name }}">
                                    {{ $edu_attainOptions->option_name }}
                                </option>
                            @endforeach
                        </select>


                    </div>

                    <div class="col-lg-6">
                        <label for="" class="Label labelFontSize mt-3">Start-Date</label>
                        <input type="date" class="form-control border h-px-20_custom" aria-label="Username"
                            name="start_date" aria-describedby="basic-addon1">
                    </div>
                </div>
                <div class="row mb-xl-1 mb-9">
                    <div class="col-lg-6">

                        <label for="" class="Label labelFontSize">Location</label>
                        <input type="text" class="form-control users-input-S-C" aria-label="Username" name="location"
                            aria-describedby="basic-addon1">
                    </div>
                    <div class="col-lg-6">
                        <label for="" class="Label labelFontSize">w-shedule</label>
                        <input type="text" class="form-control users-input-S-C" aria-label="Username"
                            name="w_schedule" aria-describedby="basic-addon1">
                    </div>
                </div>

                <div class="row mb-xl-1 mb-9">
                    <div class="col-lg-6">
                        <label for="" class="Label labelFontSize">Budget</label>
                        <input type="text" class="form-control users-input-S-C" aria-label="Username" name="budget"
                            aria-describedby="basic-addon1">
                    </div>
                    <div class="col-lg-6">
                        <label for="" class="Label labelFontSize">POC</label>
                        <input type="text" class="form-control users-input-S-C" aria-label="Username" name="poc"
                            aria-describedby="basic-addon1">
                    </div>
                </div>
                <div class="row mb-xl-1 mb-9">
                    <div class="col-lg-6">

                        <label for="" class="Label labelFontSize mt-3">Note</label>
                        <textarea class="form-control users-input-S-C" placeholder="Leave a comment here"
                            style="min-height: 120px !important;" id="" name="note" class="Label labelFontSize"></textarea>
                    </div>
                    <div class="col-lg-6">
                        <label for="" class="Label labelFontSize mt-3">Jd</label>
                        <textarea class="form-control users-input-S-C" placeholder="Write Job Description Here" name="jd"
                            style="min-height: 120px !important;" id="" class="Label labelFontSize"></textarea>

                    </div>
                </div>
                <div class="row mb-xl-1 mb-9">
                    <div class="col-lg-6">
                        <label for="" class="Label labelFontSize">Keyword</label>
                        <input type="text" class="form-control users-input-S-C" aria-label="Username" name="keyword"
                            aria-describedby="basic-addon1">
                    </div>
                    <div class="col-lg-6">
                        <label for="" class="Label labelFontSize">Recruiter</label>
                        <select name="recruiter[]" id="recruiter" multiple
                            class="form-control border select2_dropdown pl-0 arrow-3 h-px-20_custom w-100 font-size-4 d-flex align-items-center w-100">

                            @foreach ($recruiter as $recruiterOptions)
                                <option value="{{ $recruiterOptions->id }}">
                                    {{ $recruiterOptions->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row mb-xl-1 mb-9 mt-3">
                    <div class="col-lg-12 text-center">
                        <label for="" class="Label labelFontSize mt-3"></label>
                        <button onclick="saveJDL()" type="button" class="btn btn-success btn-sm w-75">Save Job</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection


@section('script')
    <script>
        $(document).ready(function() {
            appendJdlOptions()

        })

        select2Dropdown("select2_dropdown");
        // count total number of records coming from data table with interval starts
        // function appendJdlOptions() {
        //     $.ajax({
        //             type: "GET",
        //             url: '{{ url('admin/appendJdlOptions') }}',
        //         })
        //         .done(function(res) {
        //             for (let i = 0; i < res.client.length; i++) {
        //                 if (res.client[i].client != '') {
        //                     $('#client').append('<option value="' + res.client[i].client + '">' +
        //                         res.client[i].client + '</option>')
        //                 }
        //             }
        //             for (let i = 0; i < res.domains.length; i++) {
        //                 if (res.domains[i].domain != '') {
        //                     $('#candidateDomain').append('<option value="' + res.domains[i].domain + '">' + res.domains[
        //                             i]
        //                         .domain +
        //                         '</option>')
        //                 }
        //             }
        //             for (let i = 0; i < res.segment.length; i++) {
        //                 if (res.segment[i].segment != '') {
        //                     $('#segment').append('<option value="' + res.segment[i].segment + '">' + res.segment[i]
        //                         .segment + '</option>')
        //                 }
        //             }
        //             for (let i = 0; i < res.subSegment.length; i++) {
        //                 if (res.subSegment[i].subsegment != '') {

        //                     $('#sub_segment').append('<option value="' + res.subSegment[i].subsegment + '">' +
        //                         res.subSegment[i].subsegment + '</option>')
        //                 }
        //             }
        //             for (let i = 0; i < res.position_title.length; i++) {
        //                 if (res.position_title[i].p_title != '') {
        //                     $('#position_title').append('<option value="' + res.position_title[i].p_title + '">' +
        //                         res.position_title[i].p_title + '</option>')
        //                 }
        //             }
        //             for (let i = 0; i < res.career_level.length; i++) {
        //                 if (res.career_level[i].c_level != '') {
        //                     $('#career_level').append('<option value="' + res.career_level[i].c_level + '">' +
        //                         res.career_level[i].c_level + '</option>')
        //                 }
        //             }
        //             for (let i = 0; i < res.location.length; i++) {
        //                 if (res.location[i].location != '') {
        //                     $('#location').append('<option value="' + res.location[i].location + '">' +
        //                         res.location[i].location + '</option>')
        //                 }
        //             }
        //             $('#loader1').hide()
        //         })
        //         .fail(function(err) {
        //             console.log(err);
        //         });
        // }

        function saveJDL() {
            // making a variable containg all for data and append token
            var data = new FormData(document.getElementById('jdl_form'));


            // call ajax for data entry ad validation
            $.ajax({
                url: "{{ url('admin/add-jdl') }}",
                data: data,
                contentType: false,
                processData: false,
                type: 'POST',

                // Ajax success function
                success: function(res) {
                    if (res.success == true) {
                        $("#loader").hide();

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
                            Swal.fire({
                                position: 'center',
                                icon: 'warning',
                                title: res.message,
                                showConfirmButton: true,
                                timer: 4000
                            })
                            $("#loader").hide();

                        }

                        // show validation error on scree with border color changed and text
                        if (res.hasOwnProperty("message")) {
                            console.log('has meesage');
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
        }
        // ajax call for saving jdl ends 

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
    </script>
@endsection
