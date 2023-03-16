@extends('layouts.app')
@section('style')
    <style>
        .dropdown_table div.col-12:nth-child(even) {
            background: #CCC
        }

        .loader-text {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 20px;
            font-weight: bold;
            margin-top: 25px;
        }

        .btn-dropdown {
            color: #fff;
            background-color: #dc8627;
            border-color: #dc8627;
        }

        .dropdown_table div.col-12:nth-child(odd) {
            background: #FFF
        }
    </style>
@endsection



@section('content')
    <div class="container-fluid mt-8 mt-lg-11" id="dashboard-body">
        <div class="">
            <div class=" mb-15 mb-lg-23">
                <div class="row">
                    <div class="col-xl-12 px-lg-5">
                        <p class="C-Heading pt-3">Candidate Profile Management</p>
                        <div class="card">
                            <div id="loader1" style="display: none;">
                                <div class="loader-text">Refreshing Filters...</div>
                            </div>
                            <div class="card-body">
                                <fieldset>
                                    <div class="row mb-xl-1 mb-9 align-items-end">
                                        <div class="col-lg-11 col-md-6 col-sm-12 mb-xl-0 mb-7">

                                            <div class="form-group mb-0">
                                                <label for="select3"
                                                    class="d-block text-black-2 font-size-4 font-weight-semibold mb-2">
                                                    Domain
                                                </label>
                                                <select class="select2_dropdown w-100 form-control" name="domain"
                                                    onchange="domainChange(this)" id="domains">
                                                    <option value="" selected disabled="disabled">Choose options
                                                    </option>
                                                </select>
                                            </div>

                                        </div>
                                        <div class="col-lg-1 col-md-2 col-sm-12 mb-xl-0 mb-7">
                                            <button type="button" class="btn ml-2 mr-2 btn-sm btn-danger"
                                                onclick="deleteOption('domains',this)"> <i
                                                    class="bi bi-trash-fill"></i></button>
                                            <button type="button" class="btn btn-success btn-sm"
                                                onclick="addNewOption('Domian','domainForm','{{ Route('add-domains') }}' )">
                                                <i class="bi bi-plus-circle-fill"></i></button>
                                        </div>
                                    </div>
                                    <div class="row mb-xl-1 mb-9 align-items-end">
                                        <div class="col-lg-11 mb-xl-0 mb-7">
                                            <div class="form-group mb-0">
                                                <label for="select3"
                                                    class="d-block text-black-2 font-size-4 font-weight-semibold mb-2">
                                                    Segments
                                                </label>
                                                <div class="">
                                                    <select class="  select2_dropdown w-100 form-control" name="segment"
                                                        onchange="segmentChange(this)" id="segment">
                                                        <option value="" disabled="disabled">Choose options
                                                        </option>

                                                    </select>
                                                    {{-- <div class="domain_input_append mb-3 d-none" id="myModalSegment">
                                                        <form id="segmentForm" method="post" action=""
                                                            enctype="multipart/form-data">
                                                            @csrf
                                                            <div class="modal-body d-flex">
                                                                <div class="form-group mb-0 w-100">
                                                                    <input type="text" name="dataOptionSegment"
                                                                        class="form-control h-100" data-id=""
                                                                        id="inputValueSegment" placeholder="Enter Value">
                                                                </div>

                                                            </div>

                                                        </form>
                                                    </div> --}}

                                                </div>
                                            </div>

                                        </div>
                                        <div class="col-lg-1 col-md-2 col-sm-12 mb-xl-0 mb-7">
                                            <button type="button" class="btn ml-2 mr-2 btn-sm btn-danger"
                                                onclick="deleteOption('segment',this)"> <i
                                                    class="bi bi-trash-fill"></i></button>
                                            <button type="button" class="btn btn-success btn-sm"
                                                onclick="addNewOption('Segment','segmentForm','{{ Route('add-segments') }}' )">
                                                <i class="bi bi-plus-circle-fill"></i></button>
                                        </div>

                                    </div>
                                    <div class="row mb-xl-1 mb-9 align-items-end">
                                        <div class="col-lg-11 col-md-6 col-sm-12 mb-xl-0 mb-7">

                                            <div class="form-group mb-0">
                                                <label for="select3"
                                                    class="d-block text-black-2 font-size-4 font-weight-semibold mb-2">
                                                    Sub-Segment
                                                </label>
                                                <select class="select2_dropdown w-100 form-control" name"sub_segment_id"
                                                    onchange="subsegmentChange(this)" id="subSegments">
                                                    <option value="" selected disabled="disabled">Choose options
                                                    </option>
                                                </select>
                                                {{-- <div class="domain_input_append mb-3 d-none" id="myModalsubSegment">
                                                    <form id="subsegmentForm" method="post" action=""
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="modal-body d-flex">
                                                            <div class="form-group mb-0 w-100">
                                                                <input type="text" name="dataOptionsubSegment"
                                                                    class="form-control h-100" data-id=""
                                                                    id="inputValuesubSegment" placeholder="Enter Value">
                                                            </div>


                                                        </div>

                                                    </form>
                                                </div> --}}
                                                <div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="col-lg-1 col-md-2 col-sm-12 mb-xl-0 mb-7">
                                            <button type="button" class="btn ml-2 mr-2 btn-sm btn-danger"
                                                onclick="deleteOption('subSegments',this)"> <i
                                                    class="bi bi-trash-fill"></i></button>
                                            <button type="button" class="btn btn-success btn-sm"
                                                onclick="addNewOption('Sub Segment','subsegmentForm','{{ Route('add-sub-segments') }}' )">
                                                <i class="bi bi-plus-circle-fill"></i></button>
                                        </div>
                                    </div>
                                    <div class="row mb-xl-1 mb-9 align-items-end">

                                        <div class="col-lg-11 mb-xl-0 mb-7">
                                            <div class="form-group mb-0">
                                                <label for="select3"
                                                    class="d-block text-black-2 font-size-4 font-weight-semibold mb-2">
                                                    Candidate Profile
                                                </label>
                                                <div class="">
                                                    <select class="  select2_dropdown w-100 form-control" onchange=""
                                                        id="profile">
                                                        <option value="" disabled="disabled">Choose options
                                                        </option>

                                                    </select>
                                                    {{-- <div class="domain_input_append mb-3 d-none" id="myModalprofile">
                                                        <form id="profileForm" method="post" action=""
                                                            enctype="multipart/form-data">
                                                            @csrf
                                                            <div class="modal-body d-flex">
                                                                <div class="form-group mb-0 w-100">
                                                                    <input type="text" name="dataOptionprofile"
                                                                        class="form-control h-100" data-id=""
                                                                        id="inputValueprofile" placeholder="Enter Value">
                                                                </div>


                                                            </div>

                                                        </form>
                                                    </div> --}}

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-1 col-md-2 col-sm-12 mb-xl-0 mb-7">
                                            <button type="button" class="btn ml-2 mr-2 btn-sm btn-danger"
                                                onclick="deleteOption('profile',this)"> <i
                                                    class="bi bi-trash-fill"></i></button>
                                            <button type="button" class="btn btn-success btn-sm"
                                                onclick="addNewOption('Candidate Profile','profileForm','{{ Route('add-profiles') }}' )">
                                                <i class="bi bi-plus-circle-fill"></i></button>
                                        </div>

                                    </div>
                                </fieldset>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-3">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Domains</h5>
                                        <p class="card-text" id="domainCount"> </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Segments</h5>
                                        <p class="card-text" id="SegmentCount"> </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Sub Segments</h5>
                                        <p class="card-text" id="subSegmentCount"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Candidate Profiles </h5>
                                        <p class="card-text" id="profileCount"> </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card mt-3 d-none" id="addNewOptionDiv">
                            <div id="loader1" style="display: none;"></div>
                            <h4 class="py-2 mt-2 text-center btn-dropdown">Enter New <span id="title"></span></h4>
                            <div class="card-body w-25 mx-auto">

                                <form id="" class="option-form" method="post" action=""
                                    enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label for="usr">Enter Value:</label>
                                        <input type="text" name="option" class="form-control " id="">
                                    </div>
                                    {{-- <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Segmet:</label>
                                    <select class="select2_dropdown w-100 form-control" onchange="domainChange(this)"
                                        id="domains">
                                        <option value="" selected disabled="disabled">Choose options
                                        </option>
                                    </select>
                                </div> --}}
                                    <span id="alert-div"></span>

                                    <div class="d-flex justify-content-end">
                                        <button class="btn  mx-2 btn-dropdown" type="button"
                                            onclick="saveOptionValue()">Save</button>
                                        <button type="button" class="btn   btn-dropdown"
                                            onclick="hideNewOption()">Close</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div style="height: 50px;"></div>
    @endsection
    @section('script')
        <script>
            // doc ready function 
            $(document).ready(function() {
                select2Dropdown("select2_dropdown");
                appendFilterOptions();
            });
            // function ends 

            // function for appending the values to options
            function appendFilterOptions() {
                $('#loader1').show()

                $.ajax({
                        type: "GET",
                        url: '{{ route('append-filters-domain') }}',
                    })
                    .done(function(res) {
                        console.log(res)
                        $('#domains').empty()
                        $('#profile').empty()
                        for (let i = 0; i < res.domains.length; i++) {
                            if (res.domains[i].domain_name != '') {
                                $('#domains').append('<option value="' + res.domains[i].id + '">' + res.domains[i]
                                    .domain_name +
                                    '</option>')
                            }
                        }
                        // $('#domains').prepend('<option value="add"> Add New Domain +</option>')
                        $('#domains').prepend('<option disabled selected value="">Select Option</option>')

                        $('#loader1').hide()
                        domainChange($('#domains').val())
                    })
                    .fail(function(err) {
                        console.log(err);
                    });
            }
            // function ends 

            function addNewOption(title, form, route) {
                $('#addNewOptionDiv').removeClass('d-none');
                $('.option-form').attr('id', form);
                $('.option-form').attr('action', route);
                $('#title').text(title);
            }

            function hideNewOption() {
                $('#addNewOptionDiv').addClass('d-none');
                $('#title').text('');
            }

            // append the segments on domina change 
            function domainChange(elem) {
                $('#segment').empty();
                $('#subSegments').empty();
                $("#myModal").addClass('d-none');


                $.ajax({
                        type: "GET",
                        url: '{{ route('append-filters-domain') }}',
                    })
                    .done(function(res) {
                        console.log(res.segments);
                        var count = 0;
                        for (let i = 0; i < res.segments.length; i++) {
                            if ($(elem).val() == res.segments[i].domain_id) {
                                count++;
                                $('#segment').append('<option value="' + res.segments[i].id + '">' + res.segments[i]
                                    .segment_name +
                                    '</option>');
                            }
                        }
                        // $('#segment').prepend('<option value="addSegment"> Add New Segment +</option>')
                        $('#segment').prepend('<option disabled selected value="">Select Option</option>')

                    })
                    .fail(function(err) {
                        console.log(err);
                    });


            }
            // function ends 


            // function for appending the sub segments on segment change 
            function segmentChange(elem) {
                if ($(elem).val() == 'addSegment') {
                    // Show the modal
                    modelOpen('segment')
                    $('#subSegments').empty();

                } else {
                    $('#subSegments').empty();
                    $("#myModalSegment").addClass('d-none');
                    $.ajax({
                            type: "GET",
                            url: '{{ route('append-filters-domain') }}',
                        })
                        .done(function(res) {
                            console.log(res.subsegment);
                            var count = 0;
                            for (let i = 0; i < res.subsegment.length; i++) {
                                if ($(elem).val() == res.subsegment[i].segment_id) {
                                    console.log('her we go');
                                    $('#subSegments').append('<option value="' + res.subsegment[i].id + '">' +
                                        res.subsegment[i].sub_segment_name +
                                        '</option>');
                                }
                            }
                            $('#subSegments').prepend('<option disabled selected value="">Select Option</option>')

                        })
                        .fail(function(err) {
                            console.log(err);
                        });
                    // var count = 0;
                    // $('#subSegments').empty()
                    // for (let i = 0; i < subsegment.length; i++) {
                    //     console.log('helooo');
                    //     if ($(elem).val() == subsegment[i].segment_id) {
                    //         count++;
                    //         $('#subSegments').append('<option value="' + subsegment[i].id + '">' + subsegment[i]
                    //             .sub_segment_name +
                    //             '</option>');
                    //     }
                    // }
                }
            }
            //function ends here

            function subsegmentChange(elem) {
                console.log('value is' + $(elem).val());

                $('#profile').empty()
                $.ajax({
                        type: "GET",
                        url: '{{ route('append-filters-domain') }}',
                    })
                    .done(function(res) {
                        var count = 0;
                        for (let i = 0; i < res.cprofile.length; i++) {
                            if ($(elem).val() == res.cprofile[i].sub_segment_id) {
                                $('#profile').append('<option value="' + res.cprofile[i].id + '">' +
                                    res.cprofile[i].c_profile_name +
                                    '</option>');
                            }
                        }
                        $('#profile').prepend('<option disabled selected value="">Select Option</option>')

                    })
                    .fail(function(err) {
                        console.log(err);
                    });

            }


            // save the entered option 
            function saveOptionValue() {
                forms = document.querySelectorAll('form');
                form = forms[1];
                url = form.action;
                formID = form.id;
                data = new FormData(form);
                console.log(url);
                console.log(data);

                // if ($('#domains').val() == 'add') {
                //     console.log('wrong');
                //     alertClass = 'alert-warning';
                //     message = 'Select a Domain first';
                //     var messageHtml = '<div class="alert ' + alertClass + '">' + message + '</div>';
                //     $('#alert-div').append(messageHtml);
                //     setTimeout(function() {
                //         $('.alert').fadeOut('slow', function() {
                //             $(this).remove();
                //         });
                //     }, 2500);
                //     return;
                // }

                if (formID == 'segmentForm') {
                    data.append('domain_id', $('#domains').val() != null ? $('#domains').val() : '')
                }
                if (formID == 'subsegmentForm') {
                    data.append('segment_id', $('#segment').val() != null ? $('#segment').val() : '')

                }
                if (formID == 'profileForm') {
                    console.log($('#subSegments').val());
                    data.append('sub_segment_id', $('#subSegments').val() != null ? $('#subSegments').val() : '');
                }

                $.ajax({
                    url: url,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: data,
                    contentType: false,
                    processData: false,
                    type: 'POST',
                    success: function(res) {
                        $("#loader1").show()
                        var message = res.message;
                        var status = res.status;
                        var alertClass = '';
                        if (res.success == true) {
                            alertClass = 'alert-success';
                            var messageHtml = '<div class="alert ' + alertClass + '">' + message + '</div>';
                            $('#alert-div').append('');
                            $('#alert-div').append(messageHtml);
                            setTimeout(() => {

                                appendFilterOptions()
                            }, 1600);
                            setTimeout(function() {
                                $('.alert').fadeOut('slow', function() {
                                    $(this).remove();
                                    $("#addNewOptionDiv").addClass('d-none');

                                });
                            }, 1500);

                        } else if (res.success == false) {
                            alertClass = 'alert-danger';
                            var messageHtml = '<div class="alert ' + alertClass + '">' + message + '</div>';
                            $('#alert-div').append('');
                            $('#alert-div').append(messageHtml);
                        }

                        setTimeout(function() {
                            $('.alert').fadeOut('slow', function() {
                                $(this).remove();
                            });
                        }, 1500);
                        $("#loader1").hide();
                    },
                    error: function() {
                        $("#loader1").hide();
                    }
                });
            }
            // function ends 

            // Delte an option after checking if dont exist.
            function deleteOption(option, elem) {
                if (!$('#' + option).val()) {
                    return false;
                }
                console.log($('#' + option).val());
                Swal.fire({
                        icon: 'warning',
                        text: "Would you like to Delete this Option?",
                        type: 'warning',
                        showCancelButton: true,
                        showconfirmButton: true,
                        cancelButtonText: 'No',
                        confirmButtonText: 'Yes',
                    })

                    .then((isConfirm) => {
                        if (isConfirm.value) {
                            $.ajax({
                                url: "{{ Route('delete-option') }}",
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                type: 'POST',
                                data: {
                                    optionToDelete: option,
                                    optionValue: $('#' + option).val()
                                },
                                success: function(res) {
                                    if (res.success == true) {
                                        Swal.fire({
                                            position: 'top-end',
                                            icon: 'success',
                                            title: res.message,
                                            showConfirmButton: false,
                                            timer: 1500
                                        })
                                        setTimeout(() => {
                                            appendFilterOptions();
                                        }, 1500);
                                    } else if (res.success == false) {
                                        Swal.fire({
                                            position: 'top-end',
                                            icon: 'warning',
                                            title: res.message,
                                            showConfirmButton: false,
                                            timer: 1500
                                        })
                                    }

                                },
                                error: function() {
                                    $("#loader1").hide();
                                }
                            });
                        }
                        return false;

                    });
            }
        </script>
    @endsection
