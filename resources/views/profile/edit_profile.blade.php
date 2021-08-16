@extends('layouts.app')
@include('layouts.no_menu_navbar')
@section('content')
<div class="container-fluid mt-10">
        <div class="col-lg-12">
            <p class="C-Heading">Edit Profile</p>
            <div class="card mb-13">
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-lg-3 edit_profile_I_P">
                            <ul>
                                <li>
                                    <img style="width: 210px; height: 209px;" src="./assets/image/editProfile/edit_profile-img.png" alt="" />
                                </li>
                                <li class="mt-4"><h4>User Name</h4></li>
                                <li>User Email</li>
                            </ul>
                        </div>
                        <div class="col-lg-9">
                            <form action="" class="p-6">

                                <div class="form-group mb-8">
                                    <label class="Label" style="font-size: 19px;">
                                        Name
                                    </label>
                                    <input type="text" class="w-100 border-top-0 border-right-0 border-left-0" name="name" placeholder="Your name here " required />
                                </div>
                                <div class="form-group mb-8">
                                    <label class="Label" style="font-size: 19px;">
                                        Email
                                    </label>
                                    <input type="email" class="w-100 border-top-0 border-right-0 border-left-0" name="email" placeholder="Your email here" required />
                                </div>
                                <div class="form-group">
                                    <label class="Label" style="font-size: 19px;">
                                        Password
                                    </label>
                                    <input type="password" name="password" placeholder="Enter password" class="w-100 border-top-0 border-right-0 border-left-0" required/>
                                </div>
                                <input type="submit" name=""  />
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

                <div class=" row contact-form bg-white  pl-sm-10 pl-4 pr-sm-11 pr-4 pt-15 pb-13 d-flex justify-content-between">
                    <div class="col-sm-12 col-md-6">
                        <label class="d-block text-black-2 font-size-4 font-weight-semibold mb-2">
                            Click here to Connect Google Sheet
                        </label>
                        <form class="C_To_GS">
                            <div style="padding: 93px;" class="pb-3">
                                <img style="width: 68.75px; cursor: pointer" src="./assets/image/editProfile/sheetImage.png" onclick="showFieldSheet(this)"/>
                            </div>
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
                        </form>
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-6  CLOUD_ICONMAIN">
                        <label class="d-block text-black-2 font-size-4 font-weight-semibold mb-2">
                            Click here to Upload Excel File
                        </label>
                        <form>
                            <div style="padding: 93px;" class="pb-3 Coud_icon">
                                <img style="width: 105px; cursor: pointer" src="./assets/image/editProfile/cloud.png" onclick="showFieldSheet(this)"/>
                            </div>

                            <fieldset class="ml-20 showExcelfield fieldSheet d-none">
                                <div class="row mb-xl-1 mb-9 justify-content-center">
                                    <div class="col-lg-8">
                                        <div class="form-group">
                                            <label class="d-block text-black-2 font-size-4 font-weight-semibold mb-2">
                                                Upload File
                                            </label>
                                            <input type="file" id="sheetFile" accept=".xlsx, .xls, .csv" name="sheetId" required />
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-xl-1 mb-9 justify-content-center">
                                    <div class="col-lg-7 p-0">
                                        <div class="mt-2">
                                            <div class="form-group">
                                                <input type="button" value="Upload" class="btn btn-success btn-h-40 text-white min-width-px-110 rounded-5 text-uppercase" />
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
               <div class=" row contact-form bg-white  pl-sm-10 pl-4 pr-sm-11 pr-4 pt-15 pb-13 d-flex justify-content-between">
                <div class="col-sm-12 col-md-6">
                    <label class="d-block text-black-2 font-size-4 font-weight-semibold mb-2">
                        Click here to Connect Google Sheet
                    </label>
                    <form class="C_To_GS">
                        <div style="padding: 93px;" class="pb-3">
                            <img style="width: 68.75px; cursor: pointer" src="./assets/image/editProfile/sheetImage.png" onclick="showFieldJDL(this)"/>
                        </div>
                        <fieldset class="ml-10 mr-10 fieldJDL d-none">
                            <div class="row mb-xl-1 mb-9 justify-content-center">
                                <div class="col-lg-8">
                                    <div class="form-group">
                                        <label class="d-block text-black-2 font-size-4 font-weight-semibold mb-2">
                                            Sheet Id
                                        </label>
                                        <input type="text" class="form-control h-px-48" id="sheetIdJDL" name="sheetId" placeholder="Enter Sheet ID" required />
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
                    </form>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-6  CLOUD_ICONMAIN">
                    <label class="d-block text-black-2 font-size-4 font-weight-semibold mb-2">
                        Click here to Upload Excel File
                    </label>
                    <form>
                        <div style="padding: 93px;" class="pb-3 Coud_icon">
                            <img style="width: 105px; cursor: pointer" src="./assets/image/editProfile/cloud.png"  onclick="showFieldJDL(this)"/>
                        </div>

                        <fieldset class="ml-20 showExcelfield fieldJDL d-none">
                            <div class="row mb-xl-1 mb-9 justify-content-center">
                                <div class="col-lg-8">
                                    <div class="form-group">
                                        <label class="d-block text-black-2 font-size-4 font-weight-semibold mb-2">
                                            Upload File
                                        </label>
                                        <input type="file" id="sheetFileJDL" accept=".xlsx, .xls, .csv" name="sheetId" required />
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-xl-1 mb-9 justify-content-center">
                                <div class="col-lg-7 p-0">
                                    <div class="mt-2">
                                        <div class="form-group">
                                            <input type="button" value="Upload" class="btn btn-success btn-h-40 text-white min-width-px-110 rounded-5 text-uppercase" />
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
@endsection

@section('script')
<script>
        const showFieldJDL=(e)=>{
            $('.fieldJDL').addClass('d-none')
            $('.fieldJDL').removeClass('d-block')
            if(e.parentNode.nextElementSibling.classList.contains('d-none')){
                e.parentNode.nextElementSibling.classList.remove('d-none')
                e.parentNode.nextElementSibling.classList.add('d-block')
            }else{
                e.parentNode.nextElementSibling.classList.remove('d-block')
                e.parentNode.nextElementSibling.classList.add('d-none')
            }
        }
        const showFieldSheet=(e)=>{
            $('.fieldSheet').addClass('d-none')
            $('.fieldSheet').removeClass('d-block')
            if(e.parentNode.nextElementSibling.classList.contains('d-none')){
                e.parentNode.nextElementSibling.classList.remove('d-none')
                e.parentNode.nextElementSibling.classList.add('d-block')
            }else{
                e.parentNode.nextElementSibling.classList.remove('d-block')
                e.parentNode.nextElementSibling.classList.add('d-none')
            }
        }
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (function () {
        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.querySelectorAll('.needs-validation')

        // Loop over them and prevent submission
        Array.prototype.slice.call(forms)
            .forEach(function (form) {
            form.addEventListener('submit', function (event) {
                if (!form.checkValidity()) {
                event.preventDefault()
                event.stopPropagation()
                }

                form.classList.add('was-validated')
            }, false)
            })
        })()

    </script>
@endsection
