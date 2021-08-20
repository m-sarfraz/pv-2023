@extends('layouts.app')
@section('content')
<div class="container-fluid mt-5" id="dashboard-body">
            <div class="">
                <div class="mb-15 mb-lg-23">
                    <div class="row m-0">
                        <div class="col-xl-12 px-5">
                            <h4 class="font-size-6 font-weight-semibold C-Heading mb-4">Add Team</h4>
                            <div style="border-top: 4px solid red; box-shadow: 0 9px 7px -1px #707070; border-radius: 15px;padding: 70px 40px;" class="contact-form bg-white shadow-8">
                                <form id="add_team" >
                                    @csrf
                                    <fieldset>
                                        <div class="row mb-xl-1 mb-9">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="aboutTextarea" class="d-block text-black-2 font-size-4 font-weight-semibold mb-4">
                                                        Name
                                                    </label>
                                                    <input type="text" name="name" placeholder="Enter Name" class="form-control h-px-48" />
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="aboutTextarea" class="d-block text-black-2 font-size-4 font-weight-semibold mb-4">
                                                        E-mail
                                                    </label>
                                                    <input type="email" name="email" placeholder="Enter email" class="form-control h-px-48" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-xl-1 mb-9">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="aboutTextarea" class="d-block text-black-2 font-size-4 font-weight-semibold mb-4">
                                                        Contact #
                                                    </label>
                                                    <input type="number" name="phone" placeholder="Enter number" class="form-control h-px-48" />
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="aboutTextarea" class="d-block text-black-2 font-size-4 font-weight-semibold mb-4">
                                                        Password
                                                    </label>
                                                    <input type="text" name="password" placeholder="Enter password" class="form-control h-px-48" />
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="aboutTextarea" class="d-block text-black-2 font-size-4 font-weight-semibold mb-4">
                                                        Confirm Password
                                                    </label>
                                                    <input type="text" name="password_confirmation" placeholder="Enter confirm password" class="form-control h-px-48" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <button>Create</button>
                                            {{--    <input style="background: #dc8627;" class="btn btn-h-60 text-white px-5 py-2 mt-3 rounded text-uppercase"  type="submit" value="Create">
                                            --}}
                                            </div>
                                        </div>
                                    </fieldset>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection

@section('script')
    <script>
        $(document).ready(function () {
            $('#add_team').submit(function () {
                $("#loader").show();
                var data = new FormData(this);
                $.ajax({
                    url: "{{Route('team.store')}}",
                    data: data,
                    contentType: false,
                    processData: false,
                    type: 'POST',
                    success: function (res) {
                        if(res.success == true){

                            swal("{{ __('Success') }}", res.message, 'success');
                            setTimeout(function(){
                                location.reload();
                            },1000);
                        }else if(res.success == false){
                            swal("{{ __('Warning') }}", res.message, 'error');
                        }

                        $("#loader").hide();
                    },
                    error: function () {
                        $("#loader").hide();
                    }
                });


                return false;
            })
        });


    </script>
@endsection
