@extends('layouts.app')

@section('style')
<link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css')  }}"
<!-- Datatable css start-->
<link href="{{asset('assets/data-tables/css/css1.css')}}"/>
<link href="{{asset('assets/data-tables/css/css2.css')}}"/>
<link href="{{asset('assets/data-tables/css/css3.css')}}"/>
<link href="{{asset('assets/data-tables/css/css4.css')}}"/>
<!-- Datatable css end-->
<!-- ================= -->/>
<style>
    .dropdown_table div.col-12:nth-child(even) {background: #CCC}
.dropdown_table div.col-12:nth-child(odd) {background: #FFF}

</style>
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
                                                    <select name="dropdown_id" class="dropdown_select w-75">
                                                        <option value="" disabled="disabled">Choose options</option>
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
                            <div class="row m-0">
                                    <div class="col-7 d-flex py-3">Options</div>
                                    <div class="col-5 d-flex text-center py-3">
                                        <div>Action</div>
                                    </div>
                            </div>
                            <div class="row m-0 shadow dropdown_table text-uppercase border rounded">


                                 <div class="col-7 d-flex py-3 border-bottom">Heading is here</div>
                                    <div class="col-5 d-flex text-center py-3 border-bottom">
                                        <button class="bg-transparent text-danger border-0">Delete</button>
                                    </div>
                                    <div class="col-7 d-flex py-3 border-bottom">Heading is here</div>
                                    <div class="col-5 d-flex text-center py-3 border-bottom">
                                        <button class="bg-transparent text-danger border-0">Delete</button>
                                    </div>
                                    <div class="col-7 d-flex py-3 border-bottom">Heading is here</div>
                                    <div class="col-5 d-flex text-center py-3 border-bottom">
                                        <button class="bg-transparent text-danger border-0">Delete</button>
                                    </div>
                                    <div class="col-7 d-flex py-3 border-bottom">Heading is here</div>
                                    <div class="col-5 d-flex text-center py-3 border-bottom">
                                        <button class="bg-transparent text-danger border-0">Delete</button>
                                    </div>
                                    <div class="col-7 d-flex py-3 border-bottom">Heading is here</div>
                                    <div class="col-5 d-flex text-center py-3 border-bottom">
                                        <button class="bg-transparent text-danger border-0">Delete</button>
                                    </div>
                                    <div class="col-7 d-flex py-3 border-bottom">Heading is here</div>
                                    <div class="col-5 d-flex text-center py-3 border-bottom">
                                        <button class="bg-transparent text-danger border-0">Delete</button>
                                    </div>
                                    <div class="col-7 d-flex py-3 border-bottom">Heading is here</div>
                                    <div class="col-5 d-flex text-center py-3 border-bottom">
                                        <button class="bg-transparent text-danger border-0">Delete</button>
                                    </div>
                                    <div class="col-7 d-flex py-3 border-bottom">Heading is here</div>
                                    <div class="col-5 d-flex text-center py-3 border-bottom">
                                        <button class="bg-transparent text-danger border-0">Delete</button>
                                    </div>
                            </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection


@section('script')
    <script src="{{ asset('assets/plugins/data-tables/script/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/data-tables/script/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/data-tables/script/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/data-tables/script/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>

    <script src="{{ asset('assets/plugins/select2/js/select2.full.min.js') }}"></script>
<script>
    function save_options(){
        $("#loader").show();
        var form = document.querySelector('#add_option_form'); // You need to use standard javascript object here
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
    $(document).ready(function () {
        var $disabledResults = $(".dropdown_select");
        $disabledResults.select2();
     /*   $('#options_datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('view-options') }}",
            columnDefs: [
                {
                    targets: 5,
                    className: 'text-center'
                }
            ],
            columns: [
                {data: 'option_name', name: 'option_name'},
                {data: 'action', name: 'action', searchable: false, orderable: false}
            ]
        });*/



    });
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
    <!-- ================= -->
</script>
@endsection
