@extends('layouts.app')
@section('content')
    <div class="container-fluid mt-5" id="dashboard-body">
        <div class="">
            <div class="mb-15 mb-lg-23">
                <div class="row m-0">
                    <div class="col-xl-12 px-5">
                        <h4 class="font-size-6 font-weight-semibold C-Heading mb-4">Add Role</h4>
                        <div style="border-top: 4px solid red; box-shadow: 0 9px 7px -1px #707070; border-radius: 15px;padding: 70px 40px;"
                            class="contact-form bg-white shadow-8">
                            <form method="post" id="create_role">
                                @csrf
                                <fieldset>
                                    <div class="row mb-xl-1 mb-9">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="aboutTextarea"
                                                    class="d-block text-black-2 font-size-4 font-weight-semibold mb-4">
                                                    Name
                                                </label>
                                                <input type="text" name="name" placeholder="Enter Name"
                                                    class="form-control h-px-48" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-xl-1 mb-9">

                                        <div class="col-lg-12 pl-0 pl-lg-3 pl-md-3 pl-sm-0">
                                            <div class="form-group">
                                                <label class="col-md-12 "> </label>
                                                <input type="checkbox" id="revenue" name="revenue"> Team Revenue </input>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="targetDiv" class="d-none">
                                        <h5>Target</h5>
                                        <div class="row m-0 align-items-center">
                                            <div class="col-lg-12 col-md-12 mb-4 col-12 col-12  px-4">
                                                <div class="p-3 shadow rounded">
                                                    <div class="row m-0">
                                                        <div class="col-lg-4 ">
                                                            <label for="" class="font-weight-bolder">Quarter 1
                                                                Target</label>
                                                            <input class="w-100 form-control " type="number" name="q1">
                                                        </div>
                                                        <div class="col-lg-4 ">
                                                            <label for="" class="font-weight-bolder">Quarter 2
                                                                Target</label>
                                                            <input class="w-100 form-control " type="number" name="q2">
                                                        </div>
                                                        <div class="col-lg-4 ">
                                                            <label for="" class="font-weight-bolder">Quarter 3
                                                                Target</label>
                                                            <input class="w-100 form-control " type="number" name="q3">
                                                        </div>

                                                    </div>
                                                    <div class="row mt-3 m-0">
                                                        <div class="col-lg-4 ">
                                                            <label for="" class="font-weight-bolder">Quarter 4
                                                                Target</label>
                                                            <input class="w-100 form-control " type="number" name="q4">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <h5>Permissions</h5>
                                    <div class="col-lg-12 pl-0 pl-lg-3 pl-md-3 pl-sm-0 mb-xl-1 mb-9">
                                        <div class="row m-0 align-items-center">
                                            <div class="col-lg-6 col-md-12 mb-4 col-12 col-12">
                                                <div class="p-3 shadow rounded">
                                                    <?php
                                                    $data_entry = Helper::get_permission('data-entry');
                                                    ?>
                                                    <label for="aboutTextarea"
                                                        class="d-block text-black-2 font-size-4 font-weight-bolder font-weight-semibold py-2">
                                                        Data Entry Permissions
                                                    </label>
                                                    <div class="row pl-lg-3 pl-md-3 pl-sm-0 pl-0">
                                                        @foreach ($data_entry as $value)
                                                            <label class="col-md-3"><input type="checkbox"
                                                                    name="dataEntryPermission[]"
                                                                    value="{{ $value->name }}">
                                                                {{ $value->name }}</label>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-12 mb-4 col-12 col-12 ">
                                                <div class="p-3 shadow rounded">
                                                    <?php
                                                    $jdl = Helper::get_permission('jdl');
                                                    ?>
                                                    <label for="aboutTextarea"
                                                        class="d-block text-black-2 font-size-4 font-weight-bolder font-weight-semibold py-2">
                                                        JDL Permissions
                                                    </label>
                                                    <div class="row pl-lg-3 pl-md-3 pl-sm-0 pl-0">

                                                        @foreach ($jdl as $value)
                                                            <label class="col-md-4"><input type="checkbox"
                                                                    name="jdlPermission[]" value="{{ $value->name }}">
                                                                {{ $value->name }}</label>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-12 mb-4 col-12 col-12 ">
                                                <div class="shadow p-3 rounded">
                                                    <?php
                                                    $jdl = Helper::get_permission('view-record');
                                                    ?>
                                                    <label for="aboutTextarea"
                                                        class="d-block text-black-2 font-size-4 font-weight-bolder font-weight-semibold py-2">
                                                        View Record Permissions
                                                    </label>
                                                    <div class="row pl-lg-3 pl-md-3 pl-sm-0 pl-0">

                                                        @foreach ($jdl as $value)
                                                            <label class="col-md-4"><input type="checkbox"
                                                                    name="recordPermission[]" value="{{ $value->name }}">
                                                                {{ $value->name }}</label>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-12 mb-4 col-12 col-12 ">
                                                <div class="shadow p-3 rounded">
                                                    <?php
                                                    $jdl = Helper::get_permission('finance');
                                                    ?>
                                                    <label for="aboutTextarea"
                                                        class="d-block text-black-2 font-size-4 font-weight-bolder font-weight-semibold py-2">
                                                        Finance Permissions
                                                    </label>
                                                    <div class="row pl-lg-3 pl-md-3 pl-sm-0 pl-0">

                                                        @foreach ($jdl as $value)
                                                            <label class="col-md-4"><input type="checkbox"
                                                                    name="financePermission[]" value="{{ $value->name }}">
                                                                {{ $value->name }}</label>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-12 mb-4 col-12 col-12 ">
                                                <div class="shadow p-3 rounded">
                                                    <?php
                                                    $jdl = Helper::get_permission('logs');
                                                    ?>
                                                    <label for="aboutTextarea"
                                                        class="d-block text-black-2 font-size-4 font-weight-bolder font-weight-semibold py-2">
                                                        Logs Permissions
                                                    </label>
                                                    <div class="row pl-lg-3 pl-md-3 pl-sm-0 pl-0">

                                                        @foreach ($jdl as $value)
                                                            <label class="col-md-4"><input type="checkbox"
                                                                    name="jdlPermission[]" value="{{ $value->name }}">
                                                                {{ $value->name }}</label>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-12 mb-4 col-12 col-12 ">
                                                <div class="shadow p-3 rounded">
                                                    <?php
                                                    $jdl = Helper::get_permission('domain');
                                                    ?>
                                                    <label for="aboutTextarea"
                                                        class="d-block text-black-2 font-size-4 font-weight-bolder font-weight-semibold py-2">
                                                        domain Permissions
                                                    </label>
                                                    <div class="row pl-lg-3 pl-md-3 pl-sm-0 pl-0">

                                                        @foreach ($jdl as $value)
                                                            <label class="col-md-4"><input type="checkbox"
                                                                    name="jdlPermission[]" value="{{ $value->name }}">
                                                                {{ $value->name }}</label>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-12 mb-4 col-12 col-12 ">
                                                <div class="shadow p-3 rounded">
                                                    <?php
                                                    $jdl = Helper::get_permission('smart-search');
                                                    ?>
                                                    <label for="aboutTextarea"
                                                        class="d-block text-black-2 font-size-4 font-weight-bolder font-weight-semibold py-2">
                                                        Smart Search Permissions
                                                    </label>
                                                    <div class="row pl-lg-3 pl-md-3 pl-sm-0 pl-0">

                                                        @foreach ($jdl as $value)
                                                            <label class="col-md-4"><input type="checkbox"
                                                                    name="jdlPermission[]" value="{{ $value->name }}">
                                                                {{ $value->name }}</label>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-12 mb-4 col-12 col-12 ">
                                                <div class="shadow p-3 rounded">
                                                    <?php
                                                    $jdl = Helper::get_permission('dropdowns');
                                                    ?>
                                                    <label for="aboutTextarea"
                                                        class="d-block text-black-2 font-size-4 font-weight-bolder font-weight-semibold py-2">
                                                        Dropdowns Permissions
                                                    </label>
                                                    <div class="row pl-lg-3 pl-md-3 pl-sm-0 pl-0">

                                                        @foreach ($jdl as $value)
                                                            <label class="col-md-4"><input type="checkbox"
                                                                    name="jdlPermission[]" value="{{ $value->name }}">
                                                                {{ $value->name }}</label>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-12 mb-4 col-12 col-12 ">
                                                <div class="shadow p-3 rounded">
                                                    <?php
                                                    $jdl = Helper::get_permission('company');
                                                    ?>
                                                    <label for="aboutTextarea"
                                                        class="d-block text-black-2 font-size-4 font-weight-bolder font-weight-semibold py-2">
                                                        Company Permissions
                                                    </label>
                                                    <div class="row pl-lg-3 pl-md-3 pl-sm-0 pl-0">

                                                        @foreach ($jdl as $value)
                                                            <label class="col-md-4"><input type="checkbox"
                                                                    name="jdlPermission[]" value="{{ $value->name }}">
                                                                {{ $value->name }}</label>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                            @if (Auth::user()->type == 1)
                                                <div class="col-lg-6 col-md-12">
                                                    <div class="shadow p-3 rounded">
                                                        <?php
                                                        $jdl = Helper::get_permission('teams');
                                                        ?>
                                                        <label for="aboutTextarea"
                                                            class="d-block text-black-2 font-size-4 font-weight-bolder font-weight-semibold py-2">
                                                            Teams Permissions
                                                        </label>
                                                        <div class="row pl-lg-3 pl-md-3 pl-sm-0 pl-0">

                                                            @foreach ($jdl as $value)
                                                                <label class="col-md-4"><input type="checkbox"
                                                                        name="jdlPermission[]"
                                                                        value="{{ $value->name }}">
                                                                    {{ $value->name }}</label>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-12">
                                                    <div class="shadow p-3 rounded">
                                                        <?php
                                                        $jdl = Helper::get_permission('user');
                                                        ?>
                                                        <label for="aboutTextarea"
                                                            class="d-block text-black-2 font-size-4 font-weight-bolder font-weight-semibold py-2">
                                                            Users Permissions
                                                        </label>
                                                        <div class="row pl-lg-3 pl-md-3 pl-sm-0 pl-0">

                                                            @foreach ($jdl as $value)
                                                                <label class="col-md-4"><input type="checkbox"
                                                                        name="jdlPermission[]"
                                                                        value="{{ $value->name }}">
                                                                    {{ $value->name }}</label>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-12">
                                                    <div class="shadow p-3 rounded">
                                                        <?php
                                                        $extract = Helper::get_permission('extract');
                                                        ?>
                                                        <label for="aboutTextarea"
                                                            class="d-block text-black-2 font-size-4 font-weight-bolder font-weight-semibold py-2">
                                                            Extract Data Permissions
                                                        </label>
                                                        <div class="row pl-lg-3 pl-md-3 pl-sm-0 pl-0">

                                                            @foreach ($extract as $value)
                                                                <label class="col-md-12"><input type="checkbox"
                                                                        name="jdlPermission[]"
                                                                        value="{{ $value->name }}">
                                                                    {{ $value->name }}</label>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-12">
                                                    <div class="col-md-12 text-left">
                                                        <input type="submit" style="background: #dc8627;" value="Save"
                                                            class="btn btn-h-60 text-white px-5 py-2 mt-3 rounded text-uppercase" />
                                                    </div>
                                                </div>
                                            @endif
                                        </div>

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
        // var name = '{{ env('SESSION_LIFETIME') }}';
        // alert(name)
        $(document).ready(function() {
            $('#create_role').submit(function() {
                $("#loader").show();
                var data = new FormData(this);
                $.ajax({
                    url: "{{ Route('role.store') }}",
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
        $('#revenue').on('change', function() {
            if ($('#revenue').is(":checked")) {
                $('#targetDiv').addClass('d-block')
                $('#targetDiv').removeClass('d-none')
            } else {
                $('#targetDiv').removeClass('d-block')
                $('#targetDiv').addClass('d-none')
            }
        });
    </script>
@endsection
