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

        .borderRed {
            border: 1px red solid !important;
        }

        .borderRed:focus {
            box-shadow: 0 0 0 0.05rem red !important;
        }

        .btn-dropdown {
            color: #fff;
            background-color: #dc8627;
            border-color: #dc8627;
        }

        .dropdown_table div.col-12:nth-child(odd) {
            background: #FFF
        }


        .tab {
            overflow: hidden;
            border-radius: 6px;
            display: inline-block;
        }

        .tab button {
            cursor: pointer;
            padding: 14px 16px;
            transition: 0.3s;
            font-size: 17px;
            background: transparent;
            border: none;
            outline: none;
            border-bottom: 2px solid #ebebeb;
        }

        .tab button:hover {
            border-bottom: 2px solid #ddd;
        }

        .tab button.active {
            border-bottom: 2px solid #dc8627;
            color: #dc8627;

        }

        /* .tab {
                                                                overflow: hidden;
                                                            }

                                                            .tab button {
                                                                float: left;
                                                                cursor: pointer;
                                                                padding: 14px 16px;
                                                                transition: 0.3s;
                                                                font-size: 17px;
                                                                background: transparent;
                                                                border: 1px solid #dc8627;
                                                                border-radius: 6px 20px;
                                                            }

                                                            .tab button:hover {
                                                                background-color: #ddd;
                                                            }

                                                            .tab button.active {
                                                                background-color: #dc8627;
                                                                color: #fff !important;
                                                                border-radius: 6px 20px;
                                                            } */
    </style>
@endsection



@section('content')
    <div class="container-fluid mt-4" id="dashboard-body">

        <div class="tab px-5">
            <button class="tablinks active" onclick="openTab(event, 'cprofile')">Candidate Profile Management</button>
            <button class="tablinks ml-3" onclick="openTab(event, 'client')">Client Dropdown Management</button>
        </div>
        <div style="display: block;" id="cprofile" class="tabcontent">
            <div class=" mb-15 mb-lg-23">
                <div class="row">

                    <div class="col-xl-12 px-lg-5">
                        <p class="C-Heading pt-3"></p>
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
                                    <span id="alert-div"></span>

                                    <div class="d-flex justify-content-end">
                                        <button class="btn  mx-2 btn-dropdown" type="button"
                                            onclick="saveOptionValue()">Save</button>
                                        <button type="button" class="btn   btn-dropdown"
                                            onclick="hideNewOption('addNewOptionDiv','title')">Close</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="client" style="display: none;" class="tabcontent">
            <div class=" mb-15 mb-lg-23">
                <div class="row">
                    <div class="col-xl-12 px-lg-5">
                        <p class="C-Heading pt-3"></p>
                        <div class="card">
                            <div id="loader2" style="display: none;">
                                <div class="loader-text">Refreshing Filters...</div>
                            </div>
                            <div class="card-body">
                                <form id="clientForm" action="" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row mb-xl-1 mb-9 align-items-end">
                                        <div class="col-lg-11 col-md-6 col-sm-12 mb-xl-0 mb-7">
                                            <div class="form-group mb-0">
                                                <label for="select3"
                                                    class="d-block text-black-2 font-size-4 font-weight-semibold mb-2">
                                                    Client
                                                </label>
                                                <select class="select2_dropdown w-100 form-control clients" name="clients"
                                                    id="clients">

                                                </select>
                                            </div>

                                        </div>
                                        <div class="col-lg-1 col-md-2 col-sm-12 mb-xl-0 mb-7">
                                            <button type="button" class="btn ml-2 mr-2 btn-sm btn-danger"
                                                onclick="deleteOption('clients',this)"> <i
                                                    class="bi bi-trash-fill"></i></button>
                                            <button type="button" class="btn btn-success btn-sm"
                                                onclick="addNewOptionClient('Client','client','{{ Route('add-client') }}' )">
                                                <i class="bi bi-plus-circle-fill"></i></button>
                                        </div>
                                    </div>
                                    <div class="row mb-xl-1 mb-9 align-items-end">
                                        <div class="col-lg-11 mb-xl-0 mb-7">
                                            <div class="form-group mb-0">
                                                <label for="select3"
                                                    class="d-block text-black-2 font-size-4 font-weight-semibold mb-2">
                                                    Client Classification
                                                </label>
                                                <select class="select2_dropdown w-100 form-control clientClassification"
                                                    name="clientClassification" id="clientClassification">

                                                </select>

                                            </div>
                                        </div>
                                        <div class="col-lg-1 col-md-2 col-sm-12 mb-xl-0 mb-7">
                                            <button type="button" class="btn ml-2 mr-2 btn-sm btn-danger"
                                                onclick="deleteOption('clientClassification',this)"> <i
                                                    class="bi bi-trash-fill"></i></button>
                                            <button type="button" class="btn btn-success btn-sm"
                                                onclick="addNewOptionClient('Client Classification','classification','{{ Route('add-classification') }}' )">
                                                <i class="bi bi-plus-circle-fill"></i></button>
                                        </div>
                                    </div>
                                    <div class="row mb-xl-1 mb-9 align-items-end">
                                        <div class="col-lg-11 col-md-6 col-sm-12 mb-xl-0 mb-7">
                                            <div class="form-group mb-0">
                                                <label for="select3"
                                                    class="d-block text-black-2 font-size-4 font-weight-semibold mb-2">
                                                    Client Spiel
                                                </label>
                                                <input type="text" class="w-100 form-control" id="clientSpiel"
                                                    name="clientSpiel">
                                            </div>
                                        </div>
                                    </div>
                            </div>
                            <div class="d-flex justify-content-end mt-2 mb-2 mr-5">
                                <button class="btn   mx-2 btn-dropdown" type="button"
                                    onclick="saveOptionValueClientDropdown()">Save</button>
                            </div>
                            </form>
                        </div>
                        <div class="card mt-3 d-none" id="addNewOptionDivClient">
                            <div id="loader1" style="display: none;"></div>
                            <h4 class="py-2 mt-2 text-center btn-dropdown">Enter New <span id="titleClient"></span>
                            </h4>
                            <div class="card-body w-25 mx-auto">

                                <form id="" class="option-form-client" method="post" action=""
                                    enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label for="usr">Enter Value:</label>
                                        <input type="text" name="optionClient" class="form-control " id="">
                                    </div>
                                    <span id="alert-div-client"></span>

                                    <div class="d-flex justify-content-end">
                                        <button class="btn  mx-2 btn-dropdown" type="button"
                                            onclick="saveOptionValueClient()">Save</button>
                                        <button type="button" class="btn   btn-dropdown"
                                            onclick="hideNewOption('addNewOptionDivClient', 'titleClient')">Close</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        {{-- <div class="card cardBorderColor mt-5">
                                <div class="table-responsive tableFixHead">
                                    <table id="tableClient" class="table header-fixed table-striped w-100">
                                        <thead>
                                            <tr>
                                                <th>Sr</th>
                                                <th>Client</th>
                                                <th>Client Classification</th>
                                                <th>Client Spiel </th>
                                                <th>Action </th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>

                                </div>
                            </div> --}}
                    </div>
                </div>
            </div>
        </div>

    </div>
    </div>
    <div class="modal" tabindex="-1" id="exampleModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Drop Down Option</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" id="modalForm" method="post" enctype="multipart/form-data""> @csrf
                        <div class="row col-lg-12 mt-2">
                            <label for="select3" class="d-block text-black-2 font-size-4 font-weight-semibold mb-2">
                                Client
                            </label>
                            <select class="select2_dropdown w-100 form-control clients" name="modalClient"
                                id="modalClient">
                                <option value="" selected disabled="disabled">Choose options
                                </option>
                            </select>
                        </div>
                        <div class="row col-lg-12 mt-2">
                            <label for="select3" class="d-block text-black-2 font-size-4 font-weight-semibold mb-2">
                                Client Classification
                            </label>
                            <select class="  select2_dropdown w-100 form-control clientClassification"
                                name="clientClassificationModal" id="clientClassificationModal">
                                <option value="" selected disabled="disabled">Choose options
                                </option>
                            </select>
                        </div>
                        <div class="row col-lg-12 mt-2">
                            <label for="select3" class="d-block text-black-2 font-size-4 font-weight-semibold mb-2">
                                Client Spiel
                            </label>
                            <input type="text" name="clientSpielModal" id="clientSpielModal"
                                class="form-control users-input-S-C">
                        </div>

                        <input type="hidden" name="id" id="id_values" class="form-control users-input-S-C">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success"
                        onclick="update_data(this,'{{ route('edit-client-spiel') }}')">Save Edit</button>
                </div>
            </div>
        </div>
    </div>

    <div style="height: 50px;"></div>
@endsection
@section('script')
    <script>
        // function for deleting the client sopiel 
        function delete_client_spiel(elem, route) {
            id = $(elem).attr('data-id')
            console.log(id);
            ajaxFunction(route)
        }

        // function for edit client spiel 
        function edit_client_spiel(elem, route) {
            id = $(elem).attr('data-id')
            data = JSON.parse($(elem).attr('data-objct'))
            classification = data.ClientClassification;
            client = data.client;
            spiel = data.ClientSpiel;
            $('#modalClient').val(client).trigger('change')
            $('#clientClassificationModal').val(classification).trigger('change')
            $('#clientSpielModal').val(spiel)
            $('#id_values').val(id)
            $('#exampleModal').modal('show')
        }
        // ends

        // function for updating the client spiel data 
        function update_data(elem, route) {
            var data = new FormData(document.getElementById('modalForm'));
            $.ajax({
                url: route,
                data: data,
                contentType: false,
                processData: false,
                type: 'POST',
                success: function(res) {

                    if (res.success == true) {
                        Swal.fire("success", res.message, "success").then((value) => {
                            location.reload();
                        });
                    }
                    if (res.success == 'error' && res.hasOwnProperty("message")) {
                        console.log('has meesage');
                        var err = "";

                        $("input").removeClass('borderRed')
                        $("select").removeClass('borderRed')
                        $("textarea").removeClass('borderRed')
                        $("select").next().children().children().removeClass('borderRed');

                        //function for appending span and changing css color for input
                        $.each(res.message, function(i, e) {
                            $("input[name='" + i + "']").addClass('borderRed')
                            $("select[name='" + i + "']").addClass('borderRed')
                            $("select[name='" + i + "']").next().children().children().addClass(
                                'borderRed');
                            $("textarea[name='" + i + "']").addClass('borderRed')

                        });

                    }
                    if (res.success == false) {
                        Swal.fire("warning", res.message, "warning").then((value) => {

                        })
                    }
                    if (res.success == 'duplicate') {
                        Swal.fire("warning", res.message, "warning").then((value) => {

                        })
                    }
                    // Swal.fire("warning", res.message, "warning").then((value) => {

                    // })
                }

            })
        }

        // ends
        // commom ajax function
        function ajaxFunction(route) {
            $.ajax({
                url: route,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "post",
                data: {
                    id: id
                },
                success: function(res) {

                    if (res.success == true) {
                        Swal.fire("success", res.message, "success").then((value) => {
                            location.reload();
                        });
                    } else {
                        Swal.fire("warning", res.message, "warning").then((value) => {

                        })
                    }
                }
            })


        }
        // functions ends

        // open client and candidat profiles tab on click with js 
        function openTab(evt, tabName) {
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("tablinks");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }
            document.getElementById(tabName).style.display = "block";
            evt.currentTarget.className += " active";
        }
        // function ends 

        // function for saving the client spiel 
        function saveOptionValueClientDropdown() {
            var data = new FormData(document.getElementById('clientForm'));
            console.log(data)
            $.ajax({
                url: '{{ route('add-client-spiel') }}',
                data: data,
                contentType: false,
                processData: false,
                type: 'POST',

                // Ajax success function
                success: function(res) {
                    if (res.success == true) {
                        Swal.fire({
                            icon: "success",
                            text: "Data has been inserted successfully",
                            icon: "success",
                        });
                        // location.reload();

                    } else if (res.success == false) {
                        Swal.fire({
                            icon: "warning",
                            text: res.message,
                            icon: "warning",
                        });

                    } else if (res.success == 'duplicate') {
                        Swal.fire({
                            icon: "warning",
                            text: 'Data Already Exists',
                            icon: "warning",
                        });
                    }
                }
            })
        }
        // function ends 

        // make data table to load 
        function load_datatable() {
            option_table = $('#tableClient').DataTable({
                destroy: true,
                ordering: false,
                processing: true,
                serverSide: false,

                ajax: {
                    url: "{{ route('load-client-table') }}",
                    type: "GET",
                },
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'client',
                        name: 'client'
                    },
                    {
                        data: 'ClientClassification',
                        name: 'ClientClassification'
                    },
                    {
                        data: 'ClientSpiel',
                        name: 'ClientSpiel'
                    },
                    {
                        data: 'action',
                        name: 'action'
                    },
                ],

            })
        }
        // function ends 

        // doc ready function 
        $(document).ready(function() {
            select2Dropdown("select2_dropdown");
            appendFilterOptions();
            // load_datatable()
        });
        // function ends 

        // function for appending the values to options
        function appendFilterOptions() {
            $('#loader2').show()

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
                            $('#domains').append('<option value="' + res.domains[i].id + '">' + res
                                .domains[i]
                                .domain_name +
                                '</option>')
                        }
                    }
                    for (let i = 0; i < res.client.options.length; i++) {
                        $('.clients').append('<option value="' + res.client.options[i].option_name +
                            '">' + res.client
                            .options[i].option_name +
                            '</option>')

                    }
                    for (let i = 0; i < res.clientClassification.options.length; i++) {
                        $('.clientClassification').append('<option value="' + res.clientClassification
                            .options[i].option_name + '">' + res.clientClassification.options[i].option_name +
                            '</option>')

                    }
                    // $('#domains').prepend('<option value="add"> Add New Domain +</option>')
                    $('#domains').prepend('<option disabled selected value="">Select Option</option>')
                    $('.clients').prepend('<option disabled selected value="">Select Option</option>')
                    $('.clientClassification').prepend('<option disabled selected value="">Select Option</option>')

                    $('#loader2').hide()
                    domainChange($('#domains').val())
                })
                .fail(function(err) {
                    console.log(err);
                });
        }
        // function ends 

        function addNewOption( title, form, route) {
            $('#addNewOptionDiv').removeClass('d-none');
            $('.option-form').attr('id', form);
            $('.option-form').attr('action', route);
            $('#title').text(title);
        }
        // function ends 
        function addNewOptionClient(title, form, route) {
            $('#addNewOptionDivClient').removeClass('d-none');
            $('.option-form-client').attr('id', 'client-' + form);
            $('.option-form-client').attr('action', route);
            $('#titleClient').text(title);
        }
        // function ends 

        function hideNewOption(div, title) {
            $('#' + div).addClass('d-none');
            $('#' + title).text('');
        }
        // function ends 

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
                            $('#segment').append('<option value="' + res.segments[i].id + '">' + res
                                .segments[i]
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
                                $('#subSegments').append('<option value="' + res.subsegment[i].id +
                                    '">' +
                                    res.subsegment[i].sub_segment_name +
                                    '</option>');
                            }
                        }
                        $('#subSegments').prepend(
                            '<option disabled selected value="">Select Option</option>')

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
        // function ends  

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
        // function ends 


        // save the entered option 
        function saveOptionValue() {
            forms = document.querySelectorAll('form');
            form = forms[1];
            url = form.action;
            formID = form.id;
            data = new FormData(form);
            console.log(url);
            console.log(data);

            if (formID == 'segmentForm') {
                data.append('domain_id', $('#domains').val() != null ? $('#domains').val() : '')
            }
            if (formID == 'subsegmentForm') {
                data.append('segment_id', $('#segment').val() != null ? $('#segment').val() : '')

            }
            if (formID == 'profileForm') {
                console.log($('#subSegments').val());
                data.append('sub_segment_id', $('#subSegments').val() != null ? $('#subSegments').val() :
                    '');
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
                        var messageHtml = '<div class="alert ' + alertClass + '">' + message +
                            '</div>';
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
                        var messageHtml = '<div class="alert ' + alertClass + '">' + message +
                            '</div>';
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

        // save the entered option 
        function saveOptionValueClient() {
            form = document.querySelector('form[id^="client-"]');
            console.log(form);
            url = form.action;
            formID = form.id;
            data = new FormData(form);
            console.log(url);
            console.log(data);

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
                        console.log(res.data);
                        alertClass = 'alert-success';
                        var messageHtml = '<div class="alert ' + alertClass + '">' + message + '</div>';
                        $('#alert-div-client').html('');
                        $('#alert-div-client').html(messageHtml);
                        setTimeout(() => {
                            appendFilterOptions()
                        }, 500);
                        // if ($('#titleClient').text().trim() != 'Client') {
                        //     saveOptionValueClientDropdown()
                        // }
                        // setTimeout(() => {

                        //     appendFilterOptions()
                        // }, 1600);
                        // setTimeout(function() {
                        //     $('.alert').fadeOut('slow', function() {
                        //         $(this).remove();
                        //         $("#addNewOptionDiv").addClass('d-none');

                        //     });
                        // }, 1500);


                    } else if (res.success == false) {
                        alertClass = 'alert-danger';
                        var messageHtml = '<div class="alert ' + alertClass + '">' + message +
                            '</div>';
                        $('#alert-div-client').html('');
                        $('#alert-div-client').html(messageHtml);
                    }

                    // setTimeout(function() {
                    //     $('.alert').fadeOut('slow', function() {
                    //         $(this).remove();
                    //     });
                    // }, 1500);
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
                console.log('pppppppppppppppppppppppppppppp');
                return false;
            }
            console.log('111111111111111111111111111');

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
                            url: "{{ Route('delete-option-domain') }}",
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
        // function ends 
    </script>
@endsection
