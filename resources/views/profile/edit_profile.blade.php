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
                                    // $image = 'assets/image/profile/profile.png';
                                    //}
                                    ?>
                                    <img style="width: 210px; height: 209px;" src="{{ url('storage/' . $user->image) }}"
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
                                {{-- @can('save-profile') --}}
                                <button id="submit" type="button" class="costumButton px-3 py-1">Submit</button>
                                {{-- @endcan --}}
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if (\Auth::user()->type == 1)
        <div class="row">
            <div class="container-fluid container_FluidSheets my-5">
                <div class="row">
                    <div class="col-lg-6">
                        <p class="C-Heading">Connect Sheets Standard</p>
                        <div class="card h-100">
                            <div class="card-body">
                                <!-- load sheet start -->
                                <div
                                    class=" row contact-form bg-white  pl-sm-10 pl-4 pr-sm-11 pr-4 pt-15 pb-13 d-flex justify-content-between">
                                    <div class="col-sm-12 col-md-6">
                                        <label class="d-block text-black-2 font-size-4 font-weight-semibold mb-2">
                                            Click here to Connect Google Sheet
                                        </label>
                                        <span style="color:red; font-size:14px">Select sheet with maximum of 6000
                                            records<span style="color:red">*</span> </span>
                                        <div style="height: 50px">


                                            @if (session()->has('message-live'))
                                                <div class="alert alert-success">
                                                    {{ session()->get('message-live') }}
                                                </div>
                                            @endif
                                            @if (session()->has('error-live'))
                                                <div class="alert alert-danger">
                                                    {{ session()->get('error-live') }}
                                                </div>
                                            @endif
                                        </div>
                                        <!-- <    form class="C_To_GS"> -->
                                        {{-- <a href="{{URL('https://docs.google.com/spreadsheets/d/1Fx1cXd0JMkDJ7Y_dV0FFmJP8d1f1ZOqrg6YSvOHBYLA/edit#gid=0')}}"> --}}
                                        <div style="padding: 50px 50px;" class="pb-3">
                                            <img style="width: 68.75px; cursor: pointer" data-toggle="modal"
                                                data-whatever="@getbootstrap" data-target="#exampleModal"
                                                src="{{ asset('assets/image/profile/sheetImage.png') }}" />
                                        </div>

                                        {{-- </a> --}}
                                        <fieldset class="ml-10 mr-10 fieldSheet d-none">
                                            <div class="row mb-xl-1 mb-9 justify-content-center">
                                                <div class="col-lg-8">
                                                    <div class="form-group">
                                                        <label
                                                            class="d-block text-black-2 font-size-4 font-weight-semibold mb-2">
                                                            Sheet Id
                                                        </label>
                                                        <input type="text" class="form-control h-px-48 connectchecker"
                                                            id="sheetId" name="sheetId" placeholder="Enter Sheet ID"
                                                            required />
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
                                        <!-- </form> -->
                                    </div>
                                    <div class="col-sm-6 col-md-6 col-lg-6  CLOUD_ICONMAIN">
                                        <label class="d-block text-black-2 font-size-4 font-weight-semibold mb-2">
                                            Click here to Upload CSV Files
                                        </label>
                                        <span style="color:red; font-size:14px">Select sheet with maximum of 6000
                                            records<span style="color:red">*</span> </span>
                                        <div style="height: 50px">
                                            @if (session()->has('message'))
                                                <div class="alert alert-success">
                                                    {{ session()->get('message') }}
                                                </div>
                                            @endif
                                            @if (session()->has('error-local-sdb'))
                                                <div class="alert alert-danger">
                                                    {{ session()->get('error-local-sdb') }}
                                                </div>
                                            @endif
                                        </div>
                                        <form action="{{ route('save-excel') }}" method="post"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div style="padding: 50px 50px;" class="pb-3 Coud_icon" data-toggle="modal"
                                                data-target="#exampleModal_2">
                                                <img style="width: 105px; cursor: pointer"
                                                    src="{{ asset('assets/image/profile/cloud.png') }}" />
                                            </div>
                                            <fieldset class="ml-20 showExcelfield fieldSheet ">

                                                <!-- Button trigger modal -->


                                                <!-- Modal -->
                                                <div class="modal fade" id="exampleModal_2" tabindex="-1"
                                                    aria-labelledby="exampleModal_2" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">

                                                            <div class="modal-body">
                                                                <div class="row mb-xl-1 mb-9 justify-content-center">
                                                                    <div class="col-lg-12">
                                                                        <h5 class="modal-title" id="exampleModalLabel"><i
                                                                                class="bi bi-file-earmark-spreadsheet-fill"></i>Upload
                                                                            Csv File </h5>
                                                                        <hr>
                                                                        <div class="form-group">
                                                                            <label
                                                                                class="d-block text-black-2 font-size-4 font-weight-semibold mb-2">
                                                                                Upload File
                                                                            </label>
                                                                            <input type="file" id="file"
                                                                                class="form-control connectchecker"
                                                                                accept=".csv" name="file" required />
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row mb-xl-1 mb-9 justify-content-center">
                                                                    <div class="col-lg-10 text-right p-0">
                                                                        <div class="mt-2">
                                                                            <div class="form-group">
                                                                                <input type="submit" value="Upload"
                                                                                    class="btn btn-success btn-h-40 text-white min-width-px-110 rounded-5 text-uppercase" />
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
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
                        <div class="card  h-100" ">
                      <div class="card-body">
                          <div
                              class=" row contact-form bg-white  pl-sm-10 pl-4 pr-sm-11 pr-4 pt-15 pb-13 d-flex justify-content-between">
                              <div class="col-sm-12 col-md-6">
                                  <label class="d-block text-black-2 font-size-4 font-weight-semibold mb-2">
                                      Click here to Connect Google Sheet
                                  </label>
                                  <span style="color:red; font-size:14px">Select sheet with maximum of 6000
                                      records<span style="color:red">*</span> </span>
                                      <div style="height:50px;">
                                           @if (session()->has('JDL_SHEET_IMPORTED'))
                            <div class="alert alert-success">
                                {{ session()->get('JDL_SHEET_IMPORTED') }}
                            </div>
    @endif
    @if (session()->has('error-jdl-sheet'))
        <div class="alert alert-danger">
            {{ session()->get('error-jdl-sheet') }}
        </div>
    @endif
    </div>
    <div style="padding: 50px 50px;" class="pb-3">
        <img style="width: 68.75px; cursor: pointer" src="{{ asset('assets/image/profile/sheetImage.png') }}"
            onclick="showFieldJDL(this)" data-toggle="modal" data-whatever="@getbootstrap" data-target="#jdlModal" />
    </div>
    <div class="modal fade" id="jdlModal" tabindex="-1" aria-labelledby="jdlModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-body">
                    <form action="{{ Route('connect_to_jdl_sheet') }}" method="post">
                        @csrf
                        @method('post')
                        <div class="row mb-xl-1 mb-9 justify-content-center">
                            <div class="col-lg-12">
                                <h5 class="modal-title" id="exampleModalLabel"><i
                                        class="bi bi-file-earmark-spreadsheet-fill"></i>connect
                                    To JDL Sheet </h5>
                                <hr>
                                <div class="form-group">
                                    <label class="d-block text-black-2 font-size-4 font-weight-semibold mb-2">
                                        GoogleSheet ID:
                                    </label>
                                    <input type="text" id="jdl_sheet_id" class="form-control" name="jdl_sheet_id"
                                        required />
                                </div>
                            </div>
                        </div>
                        <div class="row mb-xl-1 mb-9 justify-content-center">
                            <div class="col-lg-10 text-right p-0">
                                <div class="mt-2">
                                    <div class="form-group">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Close</button>

                                        <input type="submit" value="Upload" class="btn btn-primary Connect" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    </div>
    <div class="col-sm-6 col-md-6 col-lg-6  CLOUD_ICONMAIN" data-toggle="modal" data-target="#JDLExcel">
        <label class="d-block text-black-2 font-size-4 font-weight-semibold mb-2">
            Click here to Upload CSV File
        </label>
        <span style="color:red; font-size:14px">Select sheet with maximum of 6000
            records<span style="color:red">*</span> </span>
        <div style="height:50px;">
            @if (session()->has('CSV_FILE_UPLOADED_JDL'))
                <div class="alert alert-success">
                    {{ session()->get('CSV_FILE_UPLOADED_JDL') }}
                </div>
            @endif
            @if (session()->has('error-jdl-sheet-local'))
                <div class="alert alert-danger">
                    {{ session()->get('error-jdl-sheet-local') }}
                </div>
            @endif
        </div>
        <div style="padding: 50px 50px;" class="pb-3 Coud_icon">
            <img style="width: 105px; cursor: pointer" src="{{ asset('assets/image/profile/cloud.png') }}"
                onclick="showFieldJDL(this)" />
        </div>

    </div>
    </div>
    <!-- load sheetJDL end-->
    </div>

    </div>
    </div>
    {{-- @if (session()->has('error-jdl-sheet-local') || session()->has('error-jdl-sheet')) --}}
        <div class="shadow card mt-3" style="margin-top: 59px !important;">
            <section class="mx-3 mt-5 w-100 ">
                @if (session()->has('CSV_FILE_UPLOADED_JDL'))
                    <div class="alert alert-success">
                        {{ session()->get('CSV_FILE_UPLOADED_JDL') }}
                    </div>
                @endif
                @if (session()->has('error-jdl-sheet-local'))
                    <div class="alert alert-danger">
                        {{ session()->get('error-jdl-sheet-local') }}
                    </div>
                @endif
                <div class="mr-4" style="display: flex; justify-content: space-between;">
                    <h3 class="position-sticky" style="align-self: flex-start;">Correct Heading Format for JDL Import</h3>
                    <button class="btn btn-secondary" style="align-self: flex-end;" title="Copy Column"
                        onclick="copyToClipboard()">
                        <span>Click Here To Coopy Correct Column Names</span>
                        <i class="bi bi-clipboard"></i>
                    </button>
                </div>


                <div class="w-100 card1 mt-3">
                    <div class="table-responsive">
                        <table class="table ">

                            <tr id="testIDD" class="" style="white-space:nowrap; background-color: #227447;">
                                <td class="text-white font-weight-lighter"> PRIORITY </td>
                                <td class="text-white font-weight-lighter"> REF. CODE </td>
                                <td class="text-white font-weight-lighter"> STATUS </td>
                                <td class="text-white font-weight-lighter"> REQUIREMENT DATE </td>
                                <td class="text-white font-weight-lighter"> Maturity </td>
                                <td class="text-white font-weight-lighter"> UPDATED DATE </td>
                                <td class="text-white font-weight-lighter"> CLIENT </td>
                                <td class="text-white font-weight-lighter"> DOMAIN </td>
                                <td class="text-white font-weight-lighter"> SEGMENT </td>
                                <td class="text-white font-weight-lighter"> SUBSEGMENT </td>
                                <td class="text-white font-weight-lighter"> POSITION TITLE </td>
                                <td class="text-white font-weight-lighter"> CAREER LEVEL </td>
                                <td class="text-white font-weight-lighter"> SLL NO. </td>
                                <td class="text-white font-weight-lighter"> TOTAL FTE </td>
                                <td class="text-white font-weight-lighter"> UPDATED FTE </td>
                                <td class="text-white font-weight-lighter"> JOB DESCRIPTION </td>
                                <td class="text-white font-weight-lighter"> EDUCATIONAL ATTAINMENT </td>
                                <td class="text-white font-weight-lighter"> LOCATION </td>
                                <td class="text-white font-weight-lighter"> WORK SCHEDUL </td>
                                <td class="text-white font-weight-lighter"> BUDGET </td>
                                <td class="text-white font-weight-lighter"> RECRUITMENT PROCESS/POC </td>
                                <td class="text-white font-weight-lighter"> NOTES </td>
                                <td class="text-white font-weight-lighter"> START DATE </td>
                                <td class="text-white font-weight-lighter"> KEYWORD (overlapping) </td>
                                <td class="text-white font-weight-lighter"> DOMAIN </td>
                                <td class="text-white font-weight-lighter"> Recruiter </td>
                            </tr>

                        </table>
                    </div>
                </div>
            </section>
        </div>
    {{-- @endif --}}
    {{-- @if (session()->has('error-live') || session()->has('error-local-sdb')) --}}
        <div class="shadow card mt-3" style="margin-top: 59px !important;">
            <section class="mx-3 mt-5 w-100 ">
                @if (session()->has('CSV_FILE_UPLOADED_JDL'))
                    <div class="alert alert-success">
                        {{ session()->get('CSV_FILE_UPLOADED_JDL') }}
                    </div>
                @endif
                @if (session()->has('error-jdl-sheet-local'))
                    <div class="alert alert-danger">
                        {{ session()->get('error-jdl-sheet-local') }}
                    </div>
                @endif
                <div class="mr-4" style="display: flex; justify-content: space-between;">
                    <h3 class="position-sticky" style="align-self: flex-start;">Correct Heading Format for SDB Import</h3>
                    <button class="btn btn-secondary" style="align-self: flex-end;" title="Copy Column"
                        onclick="copyToClipboard()">
                        <span>Click Here To Coopy Correct Column Names</span>
                        <i class="bi bi-clipboard"></i>
                    </button>
                </div>


                <div class="w-100 px-4 card1 mt-3">
                    <div class="table-responsive">
                        <table class="table ">

                            <tr id="testIDD" class="" style="white-space:nowrap; background-color: #227447;">
                                <td class="text-white font-weight-lighter"> CATEGORY </td>
                                <td class="text-white font-weight-lighter"> TEAM </td>
                                <td class="text-white font-weight-lighter"> REPROCESS </td>
                                <td class="text-white font-weight-lighter"> ORIGINAL RECRUITER </td>
                                <td class="text-white font-weight-lighter"> DATE SIFTED </td>
                                <td class="text-white font-weight-lighter"> SOURCE </td>
                                <td class="text-white font-weight-lighter"> POSITION TITLE APPLIED </td>
                                <td class="text-white font-weight-lighter"> CANDIDATES PROFILE </td>
                                <td class="text-white font-weight-lighter"> DOMAIN </td>
                                <td class="text-white font-weight-lighter"> SEGMENT </td>
                                <td class="text-white font-weight-lighter"> SUB SEGMENT </td>
                                <td class="text-white font-weight-lighter"> MANNER OF INVITE </td>
                                <td class="text-white font-weight-lighter"> DATE INVITED </td>
                                <td class="text-white font-weight-lighter"> CANDIDATE'S NAME </td>
                                <td class="text-white font-weight-lighter"> First Name </td>
                                <td class="text-white font-weight-lighter"> M.I. </td>
                                <td class="text-white font-weight-lighter"> Last Name </td>
                                <td class="text-white font-weight-lighter"> GENDER </td>
                                <td class="text-white font-weight-lighter"> DATE OF BIRTH </td>
                                <td class="text-white font-weight-lighter"> CONTACT NUMBER </td>
                                <td class="text-white font-weight-lighter"> EMAIL ADDRESS </td>
                                <td class="text-white font-weight-lighter"> RESIDENCE </td>
                                <td class="text-white font-weight-lighter"> COURSE </td>
                                <td class="text-white font-weight-lighter"> EDUCATIONAL ATTAINMENT </td>
                                <td class="text-white font-weight-lighter"> CERTIFICATIONS </td>
                                <td class="text-white font-weight-lighter"> EMPLOYMENT HISTORY </td>
                                <td class="text-white font-weight-lighter"> INTERVIEW NOTES </td>
                                <td class="text-white font-weight-lighter"> CURRENT SALARY </td>
                                <td class="text-white font-weight-lighter"> CURRENT ALLOWANCE </td>
                                <td class="text-white font-weight-lighter"> EXPECTED SALARY </td>
                                <td class="text-white font-weight-lighter"> OFFERED SALARY </td>
                                <td class="text-white font-weight-lighter"> OFFERED ALLOWANCE </td>
                                <td class="text-white font-weight-lighter"> APPLICATION STATUS </td>
                                <td class="text-white font-weight-lighter"> ENDORSEMENT TYPE </td>
                                <td class="text-white font-weight-lighter"> DATE ENDORSED </td>
                                <td class="text-white font-weight-lighter"> CLIENT </td>
                                <td class="text-white font-weight-lighter"> SITE </td>
                                <td class="text-white font-weight-lighter"> POSITION TITLE </td>
                                <td class="text-white font-weight-lighter"> CAREER LEVEL </td>
                                <td class="text-white font-weight-lighter"> DOMAIN </td>
                                <td class="text-white font-weight-lighter"> SEGMENT </td>
                                <td class="text-white font-weight-lighter"> SUBSEGMENT </td>
                                <td class="text-white font-weight-lighter"> STATUS </td>
                                <td class="text-white font-weight-lighter"> REMARKS (For Finance) </td>
                                <td class="text-white font-weight-lighter"> REASONS FOR NOT PROGRESSING </td>
                                <td class="text-white font-weight-lighter"> INTERVIEW SCHEDULE </td>
                                <td class="text-white font-weight-lighter"> CANDIDATE'S SURVEY </td>
                                <td class="text-white font-weight-lighter"> STANDARD PROJECTED REVENUE </td>
                                <td class="text-white font-weight-lighter"> CLIENT </td>
                                <td class="text-white font-weight-lighter"> CAREER LEVEL </td>
                                <td class="text-white font-weight-lighter"> OFFERED SALARY </td>
                                <td class="text-white font-weight-lighter"> ALLOWANCE </td>
                                <td class="text-white font-weight-lighter"> SPECIAL COMPENSATION </td>
                                <td class="text-white font-weight-lighter"> RATE(%) </td>
                                <td class="text-white font-weight-lighter"> VAT(%) </td>
                                <td class="text-white font-weight-lighter"> PLACEMENT FEE </td>
                                <td class="text-white font-weight-lighter"> FINAL FEE </td>
                                <td class="text-white font-weight-lighter"> ADJUSTMENT </td>
                                <td class="text-white font-weight-lighter"> CREDIT MEMO </td>
                                <td class="text-white font-weight-lighter"> ONBOARDING DATE </td>
                                <td class="text-white font-weight-lighter"> INVOICE DATE </td>
                                <td class="text-white font-weight-lighter"> INVOICE NUMBER </td>
                                <td class="text-white font-weight-lighter"> DATE DELIVERED </td>
                                <td class="text-white font-weight-lighter"> DPD </td>
                                <td class="text-white font-weight-lighter"> PAYMENT TERMS </td>
                                <td class="text-white font-weight-lighter"> DATE COLLECTED </td>
                                <td class="text-white font-weight-lighter"> OR NUMBER </td>
                                <td class="text-white font-weight-lighter"> CODE </td>
                                <td class="text-white font-weight-lighter"> TERMINATION DATE </td>
                                <td class="text-white font-weight-lighter"> REPLACEMENT FOR </td>
                                <td class="text-white font-weight-lighter"> REMARKS </td>
                                <td class="text-white font-weight-lighter"> PROCESS STATUS </td>
                                <td class="text-white font-weight-lighter"> VCC SHARE(%) </td>
                                <td class="text-white font-weight-lighter"> VCC SHARE AMOUNT </td>
                                <td class="text-white font-weight-lighter"> CONSULTANTS TAKE (%) </td>
                                <td class="text-white font-weight-lighter"> CONSULTANTS TAKE </td>
                                <td class="text-white font-weight-lighter"> OWNER SHARE(%) </td>
                                <td class="text-white font-weight-lighter"> OWNER SHARE AMOUNT </td>
                                <td class="text-white font-weight-lighter"> REPROCESS SHARE(%) </td>
                                <td class="text-white font-weight-lighter"> REPROCESS SHARE AMOUNT </td>
                                <td class="text-white font-weight-lighter"> INDIVIDUAL REVENUE </td>
                            </tr>

                        </table>
                    </div>

                </div>
            </section>
        </div>
    {{-- @endif --}}

    </div>
    </div>
    </div>
    @endif

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
                <form action="{{ Route('connect-to-sheet') }}" method='post'>
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">GoogleSheet ID:</label>
                            <input type="text" class="form-control " id="sheetID" name="sheetID" required />
                            <div class="small d-none" id="error" style="color:red"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary Connect">Import</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="JDLExcel" tabindex="-1" aria-labelledby="JDLExcel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="JDLExcel"><i class="bi bi-file-earmark-spreadsheet-fill"></i>JDL CSV
                        SHEET</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form action="{{ route('uploadJdlSheet') }}" method="post" enctype="multipart/form-data">
                        @csrf



                        <div class="form-group">
                            <label class="d-block text-black-2 font-size-4 font-weight-semibold mb-2">
                                Upload File
                            </label>
                            <input type="file" class="form-control " id="sheetFileJDL" accept=" .csv"
                                name="sheetFileJDL" required />
                        </div>
                </div>

                <div class="modal-footer">

                    <button type="submit" class="btn btn-success  Connect" onclick="UploadJDlSheet()">Upload</button>
                </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        function copyToClipboard() {
            var tableHeadingRow = document.getElementById('testIDD');
            var tableHeadingValues = [];
            for (var i = 0; i < tableHeadingRow.cells.length; i++) {
                tableHeadingValues.push(tableHeadingRow.cells[i].innerText);
            }
            var clipboardData = tableHeadingValues.join("\t");
            var dummy = document.createElement("textarea");
            document.body.appendChild(dummy);
            dummy.value = clipboardData;
            dummy.select();
            document.execCommand("copy");
            document.body.removeChild(dummy);
            Swal.fire({
                icon: "success",
                text: "Copied! Paste In Excel Row.",
                icon: "success",
                timer: 2000
            });
        }
        $(document).ready(function() {
            $('#submit').click(function() {
                $("#loader").show();
                var data = new FormData(document.getElementById('profileForm'));
                $.ajax({
                    url: "{{ Route('save-profile') }}",
                    data: data,
                    contentType: false,
                    processData: false,
                    type: 'POST',
                    success: function(res) {
                        if (res.success == true) {

                            Swal.fire("{{ __('Success') }}", res.message, 'success');
                            setTimeout(function() {
                                location.reload();
                            }, 1000);
                        } else if (res.success == false) {
                            Swal.fire("{{ __('Warning') }}", res.message, 'error');
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

        $('.Connect').on('click', function() {

            if ($('#sheetID').val()) {

                $("#loader").show();
            }
            if ($('#jdl_sheet_id').val()) {

                $("#loader").show();
            }
            if ($('#sheetFileJDL').val()) {

                $("#loader").show();
            }
            if ($('#file').val()) {

                $("#loader").show();
            }

        })
    </script>
@endsection
