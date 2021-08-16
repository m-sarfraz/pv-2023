@extends('layouts.app')
@section('content')
<div class="container-fluid mt-5" id="dashboard-body">
            <div class="">
                <div class="mb-15 mb-lg-23">
                    <div class="row m-0">
                        <div class="col-xl-12 px-5">
                            <h4 class="font-size-6 font-weight-semibold C-Heading mb-4">Add User</h4>
                            <div style="border-top: 4px solid red; box-shadow: 0 9px 7px -1px #707070; border-radius: 15px;padding: 70px 40px;" class="contact-form bg-white shadow-8">
                                <form action="">
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
                                                    <input type="number" name="number" placeholder="Enter number" class="form-control h-px-48" />
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
                                        </div>
                                        <div class="row mb-xl-1 mb-9">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="aboutTextarea" class="d-block text-black-2 font-size-4 font-weight-semibold mb-4">
                                                        Team
                                                    </label>
                                                    <select name="role" required="" class="form-control pl-0 arrow-3 w-100 font-size-4 d-flex align-items-center w-100">
                                                        <option value="ADMIN">ADMIN</option>
                                                        <option value="TAT">TAT</option>
                                                        <option value="EHT">EHT</option>
                                                        <option value="Agent">Agent</option>
                                                        <option value="BOD">BOD</option>
                                                        <option value="Consultant">Consultant</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <label for="aboutTextarea" class="d-block text-black-2 font-size-4 font-weight-semibold mb-4">
                                            Permissions
                                        </label>

                                        <div class="row">
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label for="aboutTextarea" class="d-block text-black-2 font-size-3 font-weight-semibold mb-4">JDL</label><input type="checkbox" name="JDL" id="setval" value="view" /> &nbsp;
                                                    <span class="text-black-2 font-size-2">VIEW</span><br />
                                                    <input type="checkbox" name="JDL" id="setval" value="edit" /> &nbsp;<span class="text-black-2 font-size-2">EDIT</span><br />
                                                    <input type="checkbox" name="JDL" id="setval" value="create" /> &nbsp;<span class="text-black-2 font-size-2">CREATE</span><br />
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label for="aboutTextarea" class="d-block text-black-2 font-size-3 font-weight-semibold mb-4">FINANCE</label><input type="checkbox" name="FINANCE" id="setval" value="view" /> &nbsp;
                                                    <span class="text-black-2 font-size-2">VIEW</span><br />
                                                    <input type="checkbox" name="FINANCE" id="setval" value="edit" /> &nbsp;<span class="text-black-2 font-size-2">EDIT</span><br />
                                                    <input type="checkbox" name="FINANCE" id="setval" value="create" /> &nbsp;<span class="text-black-2 font-size-2">CREATE</span><br />
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label for="aboutTextarea" class="d-block text-black-2 font-size-3 font-weight-semibold mb-4">CANDIDATE</label><input type="checkbox" name="CANDIDATE" id="setval" value="view" /> &nbsp;
                                                    <span class="text-black-2 font-size-2">VIEW</span><br />
                                                    <input type="checkbox" name="CANDIDATE" id="setval" value="edit" /> &nbsp;<span class="text-black-2 font-size-2">EDIT</span><br />
                                                    <input type="checkbox" name="CANDIDATE" id="setval" value="create" /> &nbsp;<span class="text-black-2 font-size-2">CREATE</span><br />
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label for="aboutTextarea" class="d-block text-black-2 font-size-3 font-weight-semibold mb-4">ENDORSEMENT</label>
                                                    <input type="checkbox" name="ENDORSEMENT" id="setval" value="view" /> &nbsp;<span class="text-black-2 font-size-2">VIEW</span><br />
                                                    <input type="checkbox" name="ENDORSEMENT" id="setval" value="edit" /> &nbsp;<span class="text-black-2 font-size-2">EDIT</span><br />
                                                    <input type="checkbox" name="ENDORSEMENT" id="setval" value="create" /> &nbsp;<span class="text-black-2 font-size-2">CREATE</span><br />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <input type="submit" style="background: #dc8627;" value="Create" class="btn btn-h-60 text-white px-5 py-2 mt-3 rounded text-uppercase" />
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
    
@endsection
