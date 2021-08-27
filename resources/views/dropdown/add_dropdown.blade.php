@extends('layouts.app')

@section('style')
<link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css')  }}" />
<link rel="stylesheet" href="//cdn.datatables.net/1.11.0/css/jquery.dataTables.min.css" />

@endsection
@section('content')
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
                                                    <select  onchange="get_dropdown_value(this.value);" name="dropdown_id" class="dropdown_select w-75">
                                                        <option value=""  disabled="disabled">Choose options</option>
                                                        @foreach($dropdowns as $dropdown)
                                                            <option value="{{ $dropdown->id  }}">{{ $dropdown->name  }}</option>
                                                        @endforeach
                                                    </select>
                                                    &nbsp;
                                                    @can('add-option')
                                                    <button onclick="AddOption();" type="button" id="add_option_btn" class="btn btn-warning px-5 text-white" >Add</button> &nbsp;
                                                    <button onclick="save_options();"  type="button" style="display: none;" id="option_save_btn" class="btn btn-warning px-5 text-white"  >Save</button>
                                                    @endcan
                                                </div>
                                            </div>
                                            <div class="option_input_append" ></div>
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
    <script src="//cdn.datatables.net/1.11.0/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('assets/plugins/select2/js/select2.full.min.js') }}"></script>
<script>

    $(document).ready(function () {
        dropdownId  =   1
        get_dropdown_value(dropdownId);
        var $disabledResults = $(".dropdown_select");
        $disabledResults.select2();
    });

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
    function  load_datatable(dropdownId){
        var option_table =  $('#option_table').DataTable({
            destroy: true,
            processing: true,
            serverSide: true,
            ajax : {
                url : "{{ route('view-options') }}",
                type : "POST",
                data : {
                    'dropdown_id' : dropdownId,
                    '_token':$('meta[name=csrf-token]').attr("content")
                }
            },
            columns: [
                {data: 'option_name', name: 'option_name'},
                {data: 'action', name: 'action', searchable: false, orderable: false}
            ]
        });


    }
    function get_dropdown_value(dropdownId){
        $("#loader").show();
        load_datatable(dropdownId);
        $("#loader").hide();
    }
    function save_options(){
        $("#loader").show();
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
            //$("#add_option_btn").hide();
            var AppendContent = '<div class="row" >'+
                '<div class="col-md-9 mt-1 mb-1" >'+
                '<input type="text" name="option_name[]" required class="form-control">'+
                '</div>'+
                '<div class="col-md-2" >'+
                '<button type="button" class="btn btn-danger" style="margin-top: 3px;" onclick="removeOptionField(this)">{{ __('Remove') }}</button>'+
                '</div>'+
                '</div>';
            $('.option_input_append').append(AppendContent);
            //$("#add_option_btn").hide();
            $("#option_save_btn").show();


    }
</script>
@endsection
