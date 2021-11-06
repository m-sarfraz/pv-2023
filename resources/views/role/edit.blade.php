@extends('layouts.app')
@section('content')
    <div class="container-fluid mt-5" id="dashboard-body">
        <div class="">
            <div class="mb-15 mb-lg-23">
                <div class="row m-0">
                    <div class="col-xl-12 px-5">
                        <h4 class="font-size-6 font-weight-semibold C-Heading mb-4">Update Role</h4>
                        <div style="border-top: 4px solid red; box-shadow: 0 9px 7px -1px #707070; border-radius: 15px;padding: 70px 40px;"
                            class="contact-form bg-white shadow-8">
                            <form method="post" id="edit_role">
                                @csrf
                                @method('PATCH')
                                <fieldset>
                                    <div class="row mb-xl-1 mb-9">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="aboutTextarea"
                                                    class="d-block text-black-2 font-size-4 font-weight-semibold mb-4">
                                                    Name
                                                </label>
                                                <input type="text" name="name" value="{{ $role->name }}"
                                                    placeholder="Enter Name" class="form-control h-px-48" />
                                            </div>
                                        </div>

                                        <div class="col-lg-12 pl-0 pl-lg-3 pl-md-3 pl-sm-0">
                                                        <div class=" form-group">

                                            <label class="col-md-12"> </label>
                                            <input type="checkbox" name="revenue"
                                                {{ $role->team_revenue == 1 ? ' checked' : '' }}> Team Revenue </input>
                                        </div>
                                    </div>
                                    {{-- <div class="col-lg-12`">
                                                <label for="aboutTextarea" class="d-block text-black-2 font-size-4 font-weight-semibold mb-4">
                                                    Permission
                                                </label>
                                                @foreach ($permission as $value)
                                                    <label class="col-md-4" ><input {{ (in_array($value->id, $rolePermissions) ? "checked" : "")  }} type="checkbox"  {{ (in_array($value->id, $rolePermissions) ? "checked" : "")  }} name="permission[]" value="{{ $value->name  }}" > {{ $value->name  }}</label>
                                                @endforeach
                                            </div> --}}
                                    <h5>Permissions</h5>
                                    <div class="col-lg-12 pl-0 pl-lg-3 pl-md-3 pl-sm-0 mb-xl-1 mb-9">
                                      <div class="row m-0 align-items-end">

                                     
                                        <div class="col-lg-6 col-md-12 col-sm-12 col-12 mb-4">
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
                                                            {{ in_array($value->id, $rolePermissions) ? 'checked' : '' }}
                                                            name="dataEntryPermission[]" value="{{ $value->name }}">
                                                        {{ $value->name }}</label>

                                                @endforeach
                                            </div>
                                        </div>
                                        </div>
                                        <div class="col-lg-6 col-md-12 col-sm-12 col-12 mb-4">
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
                                                            {{ in_array($value->id, $rolePermissions) ? 'checked' : '' }}
                                                            name="jdlPermission[]" value="{{ $value->name }}">
                                                        {{ $value->name }}</label>
                                                @endforeach
                                            </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-12 col-sm-12 col-12 mb-4">
                                        <div class="p-3 shadow rounded">
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
                                                            {{ in_array($value->id, $rolePermissions) ? 'checked' : '' }}
                                                            name="recordPermission[]" value="{{ $value->name }}">
                                                        {{ $value->name }}</label>
                                                @endforeach
                                            </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-12 col-sm-12 col-12 mb-4">
                                        <div class="p-3 shadow rounded">
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
                                                            {{ in_array($value->id, $rolePermissions) ? 'checked' : '' }}
                                                            name="financePermission[]" value="{{ $value->name }}">
                                                        {{ $value->name }}</label>
                                                @endforeach
                                            </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-12 col-sm-12 col-12 mb-4">
                                        <div class="p-3 shadow rounded">

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
                                                            {{ in_array($value->id, $rolePermissions) ? 'checked' : '' }}
                                                            name="jdlPermission[]" value="{{ $value->name }}">
                                                        {{ $value->name }}</label>
                                                @endforeach
                                            </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-12 col-sm-12 col-12 mb-4">
                                        <div class="p-3 shadow rounded">
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
                                                            {{ in_array($value->id, $rolePermissions) ? 'checked' : '' }}
                                                            name="jdlPermission[]" value="{{ $value->name }}">
                                                        {{ $value->name }}</label>
                                                @endforeach
                                            </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-12 col-sm-12 col-12 mb-4">
                                        <div class="p-3 shadow rounded">
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
                                                            {{ in_array($value->id, $rolePermissions) ? 'checked' : '' }}
                                                            name="jdlPermission[]" value="{{ $value->name }}">
                                                        {{ $value->name }}</label>
                                                @endforeach
                                            </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-12 col-sm-12 col-12 mb-4">
                                        <div class="p-3 shadow rounded">
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
                                                            {{ in_array($value->id, $rolePermissions) ? 'checked' : '' }}
                                                            name="jdlPermission[]" value="{{ $value->name }}">
                                                        {{ $value->name }}</label>
                                                @endforeach
                                            </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-12 col-sm-12 col-12 mb-4">
                                        <div class="p-3 shadow rounded">
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
                                                            {{ in_array($value->id, $rolePermissions) ? 'checked' : '' }}
                                                            name="jdlPermission[]" value="{{ $value->name }}">
                                                        {{ $value->name }}</label>
                                                @endforeach
                                            </div>
                                            </div>
                                        </div>
                                        @if (Auth::user()->type == 1)
                                            <div class="col-lg-6 col-md-12 col-sm-12 col-12 mb-4">
                                            <div class="p-3 shadow rounded">
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
                                                                {{ in_array($value->id, $rolePermissions) ? 'checked' : '' }}
                                                                name="jdlPermission[]" value="{{ $value->name }}">
                                                            {{ $value->name }}</label>
                                                    @endforeach
                                                </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-12 col-sm-12 col-12 mb-4">
                                            <div class="p-3 shadow rounded">
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
                                                                {{ in_array($value->id, $rolePermissions) ? 'checked' : '' }}
                                                                name="jdlPermission[]" value="{{ $value->name }}">
                                                            {{ $value->name }}</label>
                                                    @endforeach
                                                </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-12 col-sm-12 col-12 mb-4">
                                        
                                                <div class="col-md-12 text-left">
                                                    <input type="submit" style="background: #dc8627;" value="Update"
                                                        class="btn btn-h-60 text-white px-5 py-2 mt-3 rounded text-uppercase" />
                                                </div>
                                            </div>
                                        @endif
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
        $(document).ready(function() {
            $('#edit_role').submit(function() {
                $("#loader").show();
                var data = new FormData(this);
                console.log(data)
                $.ajax({
                    url: "{{ Route('role.update', $role->id) }}",
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
    </script>
@endsection
