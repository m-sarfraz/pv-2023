    @extends('layouts.app')

    @section('style')
        <!-- ================= -->
        <!-- Datatable css start-->
        <link rel="stylesheet" href="{{ asset('assets/css/jquery.dataTables.min.css') }}" />

        <!-- Datatable css end-->
        <!-- ================= -->
        <style>
            .row {
                margin: 0px !important;
            }

            #example1_filter label {
                display: flex;
                width: fit-content;
                margin-left: auto;
            }

            .card {
                flex-direction: inherit;
            }

        </style>
    @endsection


    @section('content')
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <p class="C-Heading pt-3">Filter By:</p>
                    <div class="row mx-0 card align-items-center">
                        <div class="col-lg-11">
                            <div class=" mb-13 h-100">
                                <div class="card-body px-0">
                                    <div id="loader1" style="display: block;"></div>
                                    <form action="">
                                        <div class="row mx-0">
                                            <div class="col-lg-6">
                                                <div class="row mx-0">
                                                    <div class="col-lg-6">
                                                        <div class="form-group mb-0">
                                                            <label class="Label-00">Domain:</label>
                                                            <select multiple name="domain" id="domain"
                                                                onchange="extractResultFunction()"
                                                                class="form-control p-0 users-input-S-C select2_dropdown w-100">

                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group mb-0">
                                                            <label class="Label-00">Client:</label>
                                                            <select multiple name="client" id="client"
                                                                onchange="extractResultFunction()"
                                                                class="form-control p-0 users-input-S-C select2_dropdown w-100">

                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mx-0 pt-3">
                                                    <div class="col-lg-6">
                                                        <div class="form-group mb-0">
                                                            <label class="Label-00">Category:</label>
                                                            <select multiple name="category" id="category"
                                                                onchange="extractResultFunction()"
                                                                class="form-control p-0 users-input-S-C select2_dropdown w-100">
                                                                <option value="Active - Initial Stage"> Active - Initial
                                                                    Stage</option>
                                                                <option value="Active - Mid Stage">Active - Mid Stage
                                                                </option>
                                                                <option value="Active - Final Stage">Active - Final Stage
                                                                </option>
                                                                <option value="Converted - Final Stage">Converted - Final
                                                                    Stage</option>
                                                                <option value="Inactive - Initial Stage">Inactive - Initial
                                                                    Stage</option>
                                                                <option value="Inactive - Mid Stage">Inactive - Mid Stage
                                                                </option>
                                                                <option value="Inactive - Final Stage"> Inactive - Final
                                                                    Stage</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group mb-0">
                                                            <label class="Label-00">Career Level:</label>
                                                            <select multiple name="career" id="career"
                                                                onchange="extractResultFunction()"
                                                                class="form-control p-0 users-input-S-C select2_dropdown w-100">

                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mx-0 pt-3">
                                                    <div class="col-lg-6">
                                                        <div class="form-group mb-0">
                                                            <label class="Label-00">Application status:</label>
                                                            <select multiple name="app_status" id="app_status"
                                                                onchange="extractResultFunction()"
                                                                class="form-control p-0 users-input-S-C select2_dropdown w-100">

                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group mb-0">
                                                            <label class="Label-00">Remarks:</label>
                                                            <select multiple name="remarks" id="remarks"
                                                                onchange="extractResultFunction()"
                                                                class="form-control p-0 users-input-S-C select2_dropdown w-100">

                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="row mx-0">
                                                    <div class="col-lg-6">
                                                        <div class="form-group mb-0">
                                                            <label class="Label-00">Start Date (Sifted):</label>
                                                            <input type="date" id="sifted_start" name="sifted_start"
                                                                class="w-100 users-input-S-C form-control"
                                                                onchange="extractResultFunction()" />
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group mb-0">
                                                            <label class="Label-00">End Date (Sifted):</label>
                                                            <input type="date" id="sifted_end" name="sifted_end"
                                                                class="w-100 users-input-S-C form-control"
                                                                onchange="extractResultFunction()" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mx-0 pt-3">
                                                    <div class="col-lg-6">
                                                        <div class="form-group mb-0">
                                                            <label class="Label-00">Start Date (Endo):</label>
                                                            <input type="date" id="endo_start" name="endo_start"
                                                                class="w-100 users-input-S-C form-control"
                                                                onchange="extractResultFunction()" />
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group mb-0">
                                                            <label class="Label-00">End Date (Endo):</label>
                                                            <input type="date" id="endo_end" name="endo_end"
                                                                class="w-100 users-input-S-C form-control"
                                                                onchange="extractResultFunction()" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-1"> <button type="buton"
                                class="btn btn-warning text-white w-100">Extract</button></div>
                    </div>

                </div>
            </div>
            <div class="col-lg-12 mt-3">
                <div class="card py-3 justify-content-center align-items-center" style="text-align:center;">
                    <img src="{{ asset('assets/image/global/icon.png') }}" width="77" alt="" srcset=""> <span
                        style="    color: #6b6e6f !important;" class="h1 pl-3">76 Records Found</span>
                </div>
            </div>
        </div>
    @endsection


    @section('script')
        <script>
            select2Dropdown("select2_dropdown");

            $(document).ready(function() {
                appendFilterOptions()
            })
            //append  dropdowns
            function appendFilterOptions() {
                $.ajax({
                        type: "GET",
                        url: '{{ route('append-extract-option') }}',
                    })
                    .done(function(res) {
                        console.log(res.career.options[0].option_name)
                        for (let i = 0; i < res.domain.length; i++) {
                            $('#domain').append('<option value="' + res.domain[i].domain_name + '">' + res.domain[i]
                                .domain_name +
                                '</option>')
                        }
                        for (let i = 0; i < res.client.length; i++) {
                            if (res.client[i].client != '') {

                                $('#client').append('<option value="' + res.client[i].client + '">' + res.client[i].client +
                                    '</option>')
                            }
                        }
                        for (let i = 0; i < res.career.options.length; i++) {
                            $('#career').append('<option value="' + res.career.options[i].option_name + '">' + res
                                .career
                                .options[i]
                                .option_name + '</option>')
                        }
                        for (let i = 0; i < res.status.options.length; i++) {
                            $('#app_status').append('<option value="' + res.status.options[i].option_name + '">' + res
                                .status.options[i].option_name + '</option>')
                        }
                        for (let i = 0; i < res.remarks.options.length; i++) {
                            $('#remarks').append('<option value="' + res.remarks.options[i].option_name + '">' + res
                                .remarks.options[i].option_name + '</option>')
                        }
                        $('#loader1').hide()
                    })
                    .fail(function(err) {
                        console.log(err);
                    });
            }
            //close 

            // extract result function starts 
            function extractResultFunction() {

                // get values of selected inputs of users
                domain = $('#domain').val();
                client = $('#client').val();
                career_level = $('#career').val();
                category = $('#category').val();
                status = $('#status').val();
                remarks = $('#remarks').val();
                sift_start = $('#sifted_start').val();
                sift_end = $('#sifted_end').val();
                endo_start = $('#endo_start').val();
                endo_end = $('#endo_end').val();
                //Calling Ajax
                $.ajax({
                    url: "{{ route('extract-search-filter') }}",
                    type: "GET",
                    data: {
                        _token: token,
                        domain: domain,
                        client: client,
                        career_level: career_level,
                        category: category,
                        status: status,
                        remarks: remarks,
                        endo_start: endo_start,
                        endo_end: endo_end,
                        sift_start: sift_start,
                        sift_end: sift_end,
                        // searchKeyword: searchKeyword,
                    },
                    success: function(res) {

                        $("#loader").hide();
                    },
                    error: function() {
                        $("#loader").hide();
                    }
                });
            }
        </script>
    @endsection
