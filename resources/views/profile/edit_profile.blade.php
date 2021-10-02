@extends('layouts.app')
@section('content')
    <div class="container-fluid mt-5 px-5">
        <div class="col-lg-12">
            <p class="C-Heading mb-4">Edit Profile</p>
            <div class="card mb-13">
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-lg-3 edit_profile_I_P">
                            <ul>
                                <li>

                                    <?php
                                    
                                    $user = Auth::user();
                                    /*if($user->image != ""){
                                                                                                                                                                                                                                                                                                                                        $image  =   $user->image;
                                                                                                                                                                                                                                                                                                                                    }else{*/
                                    $image = 'assets/image/profile/profile.png';
                                    //}
                                    ?>
                                    <img style="width: 210px; height: 209px;" src="{{ asset('storage/' . $image) }}"
                                        alt="" />
                                </li>
                            </ul>
                        </div>
                        <div class="col-lg-9">
                            <form method="post" id="profileForm" class="p-6" enctype="multipart/form-data">
                                @csrf
                                <input name="user_id" type="hidden" value="{{ $user->id }}" />
                                <div class="form-group mb-8">
                                    <label class="Label" style="font-size: 19px;">
                                        Name
                                    </label>
                                    <input type="text" value="{{ $user->name }}"
                                        class="w-100 border-top-0 border-right-0 border-left-0" name="name"
                                        placeholder="Your name here " required />
                                </div>
                                <div class="form-group mb-8">
                                    <label class="Label" style="font-size: 19px;">
                                        Email
                                    </label>
                                    <input type="email" value="{{ $user->email }} "
                                        class="w-100 border-top-0 border-right-0 border-left-0" name="email"
                                        placeholder="Your email here" required />
                                </div>

                                <div class="form-group">
                                    <label class="Label" style="font-size: 19px;">
                                        Profile Picture
                                    </label>
                                    <input type="file" class="w-100 border-top-0 border-right-0 border-left-0"
                                        name="profile">
                                    <input type="hidden" name="image_type" value="profile">
                                </div>
                                <div class="form-group">
                                    <label class="Label" style="font-size: 19px;">
                                        Password
                                    </label>
                                    <input type="password" name="password" placeholder="Enter password"
                                        class="w-100 border-top-0 border-right-0 border-left-0" />
                                </div>
                                @can('save-profile')
                                    <button class="costumButton px-3 py-1">Submit</button>
                                @endcan
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid container_FluidSheets my-5">
        <div class="row">
            <div class="col-lg-6">
                <p class="C-Heading">Connect Sheets Standard</p>
                <div class="card">
                    <div class="card-body">
                        <!-- load sheet start -->
                        <div
                            class=" row contact-form bg-white  pl-sm-10 pl-4 pr-sm-11 pr-4 pt-15 pb-13 d-flex justify-content-between">
                            <div class="col-sm-12 col-md-6">
                                <label class="d-block text-black-2 font-size-4 font-weight-semibold mb-2">
                                    Click here to Connect Google Sheet
                                </label>
                                <span style="color:red; font-size:14px">Select sheet with maximum of 1000 records<span style="color:red">*</span> </span>
                                <!-- <form class="C_To_GS"> -->
                                {{-- <a href="{{URL('https://docs.google.com/spreadsheets/d/1Fx1cXd0JMkDJ7Y_dV0FFmJP8d1f1ZOqrg6YSvOHBYLA/edit#gid=0')}}"> --}}
                                <div style="padding: 93px;" class="pb-3">
                                    <img style="width: 68.75px; cursor: pointer" data-toggle="modal"
                                        data-whatever="@getbootstrap" data-target="#exampleModal"
                                        src="{{ asset('assets/image/profile/sheetImage.png') }}" />
                                </div>

                                {{-- </a> --}}
                                <fieldset class="ml-10 mr-10 fieldSheet d-none">
                                                                        <div class="row mb-xl-1 mb-9 justify-content-center">
                                                                            <div class="col-lg-8">
                                                                                <div class="form-group">
                                                                                    <label class="d-block text-black-2 font-size-4 font-weight-semibold mb-2">
                                                                                        Sheet Id
                                                                                    </label>
                                                                                    <input type="text" class="form-control h-px-48" id="sheetId" name="sheetId" placeholder="Enter Sheet ID" required />
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="row mb-xl-1 mb-9 justify-content-center">
                                                                            <div class="col-lg-8">
                                                                                <div class="mt-2">
                                                                                    <div class="form-group">
                                                                                        <input type="button" value="Connect" class="btn btn-success btn-h-40 text-white min-width-px-110 rounded-5 text-uppercase" type="submit" />
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </fieldset> 
                                <!-- </form> -->
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-6  CLOUD_ICONMAIN">
                                <label class="d-block text-black-2 font-size-4 font-weight-semibold mb-2">
                                    Click here to Upload Excel Files
                                </label>
                                <span style="color:red; font-size:14px">Select sheet with maximum of 1000 records<span style="color:red">*</span> </span>

                                <form action="{{ route('save-excel') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div style="padding: 93px;" class="pb-3 Coud_icon">
                                        <img style="width: 105px; cursor: pointer"
                                            src="{{ asset('assets/image/profile/cloud.png') }}" />
                                    </div>
                                    <fieldset class="ml-20 showExcelfield fieldSheet ">
                                    <div class="row mb-xl-1 mb-9 justify-content-center">
                                        <div class="col-lg-8">
                                            <div class="form-group">
                                                <label class="d-block text-black-2 font-size-4 font-weight-semibold mb-2">
                                                    Upload File
                                                </label>
                                                <input type="file" id="file" accept=".xlsx, .xls, .csv" name="file" required />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-xl-1 mb-9 justify-content-center">
                                        <div class="col-lg-7 p-0">
                                            <div class="mt-2">
                                                <div class="form-group">
                                                    <input type="submit" value="Upload" class="btn btn-success btn-h-40 text-white min-width-px-110 rounded-5 text-uppercase" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                                </form>
                            </div>
                        </div>

                        <!-- load sheet end-->

                        <LOADSHEET />
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <p class="C-Heading">Connect Sheets JDL</p>
                <div class="card">
                    <div class="card-body">

                        <!-- load sheetJDL start-->
                        <div
                            class=" row contact-form bg-white  pl-sm-10 pl-4 pr-sm-11 pr-4 pt-15 pb-13 d-flex justify-content-between">
                            <div class="col-sm-12 col-md-6">
                                <label class="d-block text-black-2 font-size-4 font-weight-semibold mb-2">
                                    Click here to Connect Google Sheet
                                </label>
                                <span style="color:red; font-size:14px">Select sheet with maximum of 1000 records<span style="color:red">*</span> </span>

                                <form class="C_To_GS">
                                    <div style="padding: 93px;" class="pb-3">
                                        <img style="width: 68.75px; cursor: pointer"
                                            src="{{ asset('assets/image/profile/sheetImage.png') }}"
                                            onclick="showFieldJDL(this)" />
                                    </div>
                                    <fieldset class="ml-10 mr-10 fieldJDL d-none">
                                        <div class="row mb-xl-1 mb-9 justify-content-center">
                                            <div class="col-lg-8">
                                                <div class="form-group">
                                                    <label
                                                        class="d-block text-black-2 font-size-4 font-weight-semibold mb-2">
                                                        Sheet Id
                                                    </label>
                                                    <input type="text" class="form-control h-px-48" id="sheetIdJDL"
                                                        name="sheetId" placeholder="Enter Sheet ID" required />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mb-xl-1 mb-9 justify-content-center">
                                            <div class="col-lg-8">
                                                <div class="mt-2">
                                                    <div class="form-group">
                                                        <input type="button" value="Connect"
                                                            class="btn btn-success btn-h-40 text-white min-width-px-110 rounded-5 text-uppercase"
                                                            type="submit" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                </form>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-6  CLOUD_ICONMAIN">
                                <label class="d-block text-black-2 font-size-4 font-weight-semibold mb-2">
                                    Click here to Upload Excel File
                                </label>
                                <span style="color:red; font-size:14px">Select sheet with maximum of 1000 records<span style="color:red">*</span> </span>

                                <form>
                                    <div style="padding: 93px;" class="pb-3 Coud_icon">
                                        <img style="width: 105px; cursor: pointer"
                                            src="{{ asset('assets/image/profile/cloud.png') }}"
                                            onclick="showFieldJDL(this)" />
                                    </div>

                                    <fieldset class="ml-20 showExcelfield fieldJDL d-none">
                                        <div class="row mb-xl-1 mb-9 justify-content-center">
                                            <div class="col-lg-8">
                                                <div class="form-group">
                                                    <label
                                                        class="d-block text-black-2 font-size-4 font-weight-semibold mb-2">
                                                        Upload File
                                                    </label>
                                                    <input type="file" id="sheetFileJDL" accept=".xlsx, .xls, .csv"
                                                        name="sheetId" required />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-xl-1 mb-9 justify-content-center">
                                            <div class="col-lg-7 p-0">
                                                <div class="mt-2">
                                                    <div class="form-group">
                                                        <input type="button" value="Upload"
                                                            class="btn btn-success btn-h-40 text-white min-width-px-110 rounded-5 text-uppercase" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </fieldset>
                                </form>
                            </div>
                        </div>
                        <!-- load sheetJDL end-->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><i
                            class="bi bi-file-earmark-spreadsheet-fill"></i>Google Sheet Information</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">GoogleSheet ID:</label>
                        <input type="text" class="form-control" id="sheetID" name="sheetID">
                        <div class="small d-none" id="error" style="color:red"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="uploadSheet()">Import</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('#profileForm').submit(function() {
                $("#loader").show();
                var data = new FormData(this);
                $.ajax({
                    url: "{{ Route('save-profile') }}",
                    data: data,
                    contentType: false,
                    processData: false,
                    type: 'POST',
                    success: function(res) {
                        if (res.success == true) {

                            swal("{{ __('Success') }}", res.message, 'success');
                            setTimeout(function() {
                                location.reload();
                            }, 1000);
                        } else if (res.success == false) {
                            swal("{{ __('Warning') }}", res.message, 'error');
                        }

                        $("#loader").hide();
                    },
                    error: function() {
                        $("#loader").hide();
                    }
                });
                return false;
            })
        });

        function uploadSheet(elem) {
            $("#loader").show();
            if (!$('#sheetID').val()) {
                $('#error').html('');
                $('#error').append('Please provide Sheet ID');
                $('#error').removeClass('d-none');
                $('#error').addClass('d-block');
                $("#loader").hide();

            } else {
                $('#error').html('');
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                sheetID = $('#sheetID').val();
                $.ajax({
                    url: "{{ Route('connect-to-sheet') }}",
                    type: 'POST',
                    data: {
                        sheetID: sheetID
                    },
                    success: function(res) {
                        if (res.success == true) {

                            swal({
                                icon: "success",
                                text: "{{ __('imported Successfully') }}",
                                icon: "success",
                            });
                            setTimeout(function() {
                                location.reload();
                            }, 1000);
                        } else if (res.success == false) {
                            swal("{{ __('error') }}", res.message, 'error');
                        }

                        $("#loader").hide();
                    },
                    error: function() {
                        $("#loader").hide();
                        swal({
                                icon: "error",
                                text: "{{ __('Some Error occured, Try again') }}",
                                icon: "error",
                            });
                    }
                });
                return false;
            }
        }
    </script>
@endsection
