@extends('layouts.app')
@section('content')
    <style>
        .select2-container {
            width: 100% !important;
        }

    </style>
    <div class="container-fluid mt-8 mt-lg-11" id="dashboard-body">
        <div class="">
            <div class="mb-15 mb-lg-23">
                <div class="row">
                    <div class="col-xl-12 px-lg-5 mt-5 ">
                        <p class="C-Heading">Add dropdowns</p>
                        <div class="card">
                            <div class="card-body">
                                <form id="add_option_form" method="POST">
                                    @csrf
                                    <fieldset>
                                        <div class="row mb-xl-1 mb-9">
                                            <div class="col-lg-8 mb-xl-0 mb-7">
                                                <div class="form-group position-relative">
                                                    <label for="select3"
                                                        class="d-block text-black-2 font-size-4 font-weight-semibold mb-4">
                                                        Dropdowns
                                                    </label>
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <div class="col-md-6">
                                                            <select onchange="get_dropdown_value();" name="drop_down_id"
                                                                class="select2_dropdown h-100">
                                                                <option value="" disabled="disabled">Choose options</option>
                                                                @foreach ($dropdowns as $dropdown)
                                                                    <option data-type="{{ $dropdown->type }}"
                                                                        value="{{ $dropdown->id }}">
                                                                        {{ $dropdown->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        @can('add-dropdown')
                                                            <div class="col-md-3">
                                                                <button onclick="AddOption();" type="button" id="add_option_btn"
                                                                    class="btn btn-warning px-5 text-white">Add</button> &nbsp;
                                                            </div>
                                                            <div class="col-md-3">
                                                                <button
                                                                    onclick="save_form('add_option_form','{{ route('save-options') }}');"
                                                                    type="button" style="display: none;" id="option_save_btn"
                                                                    class="btn btn-warning px-5 text-white">Save</button>
                                                            </div>
                                                        @endcan
                                                    </div>
                                                    <div class="col-md-6">
                                                        <select name="sec_dropdown_id" class="2nd_dropdown_id form-control">
                                                            <option value="" disabled="disabled">Choose options</option>
                                                            <option value="1">Intial Stages</option>
                                                            <option value="2">Mid Stages</option>
                                                            <option value="3">Final Stages</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="option_input_append mb-3"></div>
                                            </div>
                                        </div>
                                    </fieldset>
                                </form>

                                <table id="option_table" class="display">
                                    <thead>
                                        <tr>
                                            <th>Option</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
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
                    <input type="text" name="inputofDropdown" id="inputofDropdown" class="form-control users-input-S-C">
                    <input type="hidden" name="id" id="id_values" class="form-control users-input-S-C">
                    <input type="hidden" name="prevValues" id="prevValues" class="form-control users-input-S-C">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary"
                        onclick="update_data(this,'{{ route('update-option') }}' ,'1')">Rename</button>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('script')
    <script>
        $(document).ready(function() {
            get_dropdown_value();
            select2Dropdown("select2_dropdown");
        });

        function change_status(obj) {
            swal({
                    title: 'Are you sure?',
                    buttons: true,
                    dangerMode: true,
                })
                .then((change_status) => {
                    $("#loader").show();
                    var optionId = $(obj).data('id');
                    var status = $(obj).data('status');
                    $.ajax({
                        url: "{{ Route('change-option-status') }}",
                        data: {
                            '_token': $('meta[name=csrf-token]').attr("content"),
                            'option_id': optionId,
                            'status': status
                        },
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
                });

        }

        function load_datatable(dropdownType) {
            var option_table = $('#option_table').DataTable({
                destroy: true,
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('view-options') }}",
                    type: "POST",
                    data: {
                        'drop_down_type': dropdownType,
                        '_token': $('meta[name=csrf-token]').attr("content")
                    }
                },
                columns: [{
                        data: 'option_name',
                        name: 'option_name'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        searchable: false,
                        orderable: false
                    }
                ]
            });


        }

        function get_dropdown_value() {
            var dropdownType = $("select[name='drop_down_id']").find(":selected").data('type');
            if (dropdownType == 'remarks_for_finance') //Remarks for finance dropdown
                $("select[name='sec_dropdown_id']").prop('hidden', false);
            else
                $("select[name='sec_dropdown_id']").prop('hidden', true);

            $("#loader").show();
            load_datatable(dropdownType);
            $("#loader").hide();
        }

        function removeOptionField(obj) {
            $(obj).parent().parent().remove();
            var eleLen = $(".option_input_append").children().length;
            if (eleLen == 0) {
                $("#option_save_btn").hide();
            }

        }

        function AddOption() {
            var AppendContent = '<div class="row" >' +
                '<div class="col-md-9 mt-1 mb-1" >' +
                '<input type="text" name="option_name[]" required class="form-control">' +
                '</div>' +
                '<div class="col-md-2" >' +
                '<button type="button" class="btn btn-danger" style="margin-top: 3px;" onclick="removeOptionField(this)">{{ __('Remove') }}</button>' +
                '</div>' +
                '</div>';
            $('.option_input_append').append(AppendContent);
            $("#option_save_btn").show();


        }

        function update_data(elem, route, edit) {
            console.log(edit)
            if (edit == 0) {
                values = $(elem).attr('data-id')
                $('#id_values').val(values)
                id = $('#id_values').val()
                $('#exampleModal').modal('show')
                valueofDropdown = $(elem).parent('td').siblings('td').text();
                $('#inputofDropdown').val(valueofDropdown)
                $('#prevValues').val(valueofDropdown)
                // prevValue = $(elem).parent('td').siblings('td').text();
            } else {
                $.ajax({
                    url: route,
                    data: {
                        id: id,
                        prevValue: $('#prevValues').val(),
                        option_name: $('#inputofDropdown').val(),
                        _token: token
                    },
                    type: 'POST',
                    success: function(res) {
                        if (res.success == true) {

                            swal("Success", res.message, 'success');
                            setTimeout(function() {
                                location.reload();
                            }, 1000);
                        } else if (res.success == false) {
                            swal("Warning", res.message, 'error');
                            location.reload();

                        }

                        $("#loader").hide();
                    },
                    error: function() {
                        $("#loader").hide();
                    }
                });
                return false;
            }
        }
    </script>
@endsection
