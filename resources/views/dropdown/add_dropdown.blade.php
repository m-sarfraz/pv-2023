@extends('layouts.app')
@section('content')
    <style>
        .select2-container{
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
                                <form id="add_option_form" method="POST" >
                                    @csrf
                                    <fieldset>
                                        <div class="row mb-xl-1 mb-9">
                                            <div class="col-lg-8 mb-xl-0 mb-7">
                                                <div class="form-group position-relative">
                                                    <label for="select3" class="d-block text-black-2 font-size-4 font-weight-semibold mb-4">
                                                        Dropdowns
                                                    </label>
                                                    <div class="d-flex justify-content-between">
                                                        <div class="col-md-6" >
                                                            <select  onchange="get_dropdown_value();" name="drop_down_id" class="dropdown_select">
                                                                <option value=""  disabled="disabled">Choose options</option>
                                                                @foreach($dropdowns as $dropdown)
                                                                    <option data-type="{{ $dropdown->type  }}" value="{{ $dropdown->id  }}">{{ $dropdown->name  }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        @can('add-option')
                                                            <div class="col-md-3" >
                                                                <button onclick="AddOption();" type="button" id="add_option_btn" class="btn btn-warning px-5 text-white" >Add</button> &nbsp;
                                                            </div>
                                                            <div class="col-md-3" >
                                                                <button onclick="save_options();"  type="button" style="display: none;" id="option_save_btn" class="btn btn-warning px-5 text-white"  >Save</button>
                                                            </div>
                                                        @endcan
                                                    </div>
                                                    <div class="col-md-6" >
                                                        <select name="sec_dropdown_id" class="2nd_dropdown_id form-control">
                                                            <option value=""  disabled="disabled">Choose options</option>
                                                            <option value="1">Intial Stages</option>
                                                            <option value="2">Mid Stages</option>
                                                            <option value="3">Final Stages</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="option_input_append mb-3" ></div>
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


@endsection


@section('script')
    <script>

        $(document).ready(function () {
            get_dropdown_value();
            var $disabledResults = $(".dropdown_select");
            $disabledResults.select2();
        });

        function change_status(obj){
            swal({
                title: 'Are you sure?',
                buttons: true,
                dangerMode: true,
            })
                .then((change_status) => {
                    $("#loader").show();
                    var optionId    =   $(obj).data('id');
                    var status    =   $(obj).data('status');
                    $.ajax({
                        url: "{{Route('change-option-status')}}",
                        data: {
                            '_token':$('meta[name=csrf-token]').attr("content"),
                            'option_id' : optionId,
                            'status' : status
                        },
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
                });

        }

        function delete_option(obj){
            swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                buttons: true,
                dangerMode: true,
            })
                .then((delete_option) => {
                    $("#loader").show();
                    var optionId    =   $(obj).data('id');
                    $.ajax({
                        url: "{{Route('delete-option')}}",
                        data: {
                            '_token':$('meta[name=csrf-token]').attr("content"),
                            'option_id' : optionId
                        },
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
                });

        }
        function  load_datatable(dropdownType){
            var option_table =  $('#option_table').DataTable({
                destroy: true,
                processing: true,
                serverSide: true,
                ajax : {
                    url : "{{ route('view-options') }}",
                    type : "POST",
                    data : {
                        'drop_down_type' : dropdownType,
                        '_token':$('meta[name=csrf-token]').attr("content")
                    }
                },
                columns: [
                    {data: 'option_name', name: 'option_name'},
                    {data: 'action', name: 'action', searchable: false, orderable: false}
                ]
            });


        }
        function get_dropdown_value(){
           var dropdownType =    $("select[name='drop_down_id']").find(":selected").data('type');
            if(dropdownType == 'remarks_for_finance') //Remarks for finance dropdown
                $("select[name='sec_dropdown_id']").prop('hidden',false);
            else
                $("select[name='sec_dropdown_id']").prop('hidden',true);

            $("#loader").show();
            load_datatable(dropdownType);
            $("#loader").hide();
        }
        function save_options(){
            $("#loader").show();
            var form    = document.querySelector('#add_option_form');
            var data = new FormData(form);
            $.ajax({
                url: "{{Route('save-options')}}",
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

        }
        function removeOptionField(obj){
            $(obj).parent().parent().remove();
            var eleLen  =   $(".option_input_append").children().length;
            if(eleLen == 0){
                $("#option_save_btn").hide();
            }

        }
        function AddOption(){
            var AppendContent = '<div class="row" >'+
                '<div class="col-md-9 mt-1 mb-1" >'+
                '<input type="text" name="option_name[]" required class="form-control">'+
                '</div>'+
                '<div class="col-md-2" >'+
                '<button type="button" class="btn btn-danger" style="margin-top: 3px;" onclick="removeOptionField(this)">{{ __('Remove') }}</button>'+
                '</div>'+
                '</div>';
            $('.option_input_append').append(AppendContent);
            $("#option_save_btn").show();


        }
    </script>
@endsection
