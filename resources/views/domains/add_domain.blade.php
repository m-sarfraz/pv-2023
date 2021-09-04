@extends('layouts.app')
@section('style')
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
                <div class="col-xl-12 px-lg-5">
                    <p class="C-Heading pt-3">Add Segments</p>
                    <div class="card">
                        <div class="card-body">
                            <form action="/">
                                <fieldset>
                                    <div class="row mb-xl-1 mb-9">
                                        <div class="col-lg-6 col-md-6 col-sm-12 mb-xl-0 mb-7">
                                                <div class="form-group">
                                                    <label for="select3" class="d-block text-black-2 font-size-4 font-weight-semibold mb-2">
                                                        Domains
                                                    </label>
                                                        <select class="select2_dropdown w-100">
                                                            <option value="two" disabled="disabled">Choose options</option>
                                                            <option value="one">CORPORATE FUNCTIONS</option>
                                                            <option value="two">DEVELOPMENT PROJECTS</option>
                                                            <option value="three">CLOUD SYSTEMS</option>
                                                        </select>
                                                        <div class="row">
                                                            <div class="col-sm">
                                                                <button style="background: #dc8627;" onclick="AddOption('domain_name','domain_input_append','domain_save_btn')"  class="btn px-2 mt-2 text-white rounded-0" type="submit">Add Domain +</button>
                                                            </div>
                                                            <div class="col-sm">
                                                                <button style="background: #dc8627;display: none;" onclick="save_options();"  type="button"   class="domain_save_btn  btn px-2 mt-2 text-white rounded-0"  >Save</button>
                                                            </div>
                                                        </div>
                                                    <div class="domain_input_append mb-3" ></div>
                                                </div>
                                        </div>
                                        <div class="col-lg-6 mb-xl-0 mb-7">
                                            <div class="form-group">
                                                <label for="select3" class="d-block text-black-2 font-size-4 font-weight-semibold mb-2">
                                                    Segments
                                                </label>
                                                <div class="">
                                                    <select class="select2_dropdown w-100">
                                                        <option value="two" disabled="disabled">Choose options</option>
                                                        <option value="one">CORPORATE FUNCTIONS</option>
                                                        <option value="two">DEVELOPMENT PROJECTS</option>
                                                        <option value="three">CLOUD SYSTEMS</option>
                                                    </select>
                                                    <button style="background: #dc8627;" class="btn px-2 mt-2 text-white rounded-0" type="submit">Add Segment +</button>
                                                </div>
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
</div>

<div class="container-fluid mt-8 mt-lg-11" id="dashboard-body">
    <div class="">
        <div class="mb-15 mb-lg-23">
            <div class="row">
                <div class="col-xl-12 px-lg-5">
                    <p class="C-Heading pt-3">Add sub Segments</p>
                    <div class="card d-flex justify-content-center">
                        <div class="card-body">

                            <div class="row m-0">
                                    <div class="col-7 d-flex py-3">Sub Segments</div>
                                    <div class="col-5 d-flex text-center py-3">
                                        <div>Action</div>
                                    </div>
                            </div>

                            <div class="row m-0  dropdown_table text-uppercase border rounded">
                                    <div class="col-3 d-flex py-3 bg-light border-bottom">To add sub-segments click here...</div>
                                    <div class="col-9 d-flex justify-content-center text-center bg-light py-3 border-bottom">
                                        <button style="background: #dc8627;" class="btn px-2 mt-2 text-white">ADD SUBSEGMENT</button>
                                    </div>
                                    <div class="col-7 d-flex py-3 border-bottom">Heading is here</div>
                                    <div class="col-5 d-flex text-center py-3 border-bottom">
                                        <button class="bg-transparent text-danger border-0">Delete</button>
                                    </div>
                                    <div class="col-7 d-flex py-3 bg-light border-bottom">Heading is here</div>
                                    <div class="col-5 d-flex text-center bg-light py-3 border-bottom">
                                        <button class="bg-transparent text-danger border-0">Delete</button>
                                    </div>
                                    <div class="col-7 d-flex py-3 border-bottom">Heading is here</div>
                                    <div class="col-5 d-flex text-center py-3 border-bottom">
                                        <button class="bg-transparent text-danger border-0">Delete</button>
                                    </div>
                                    <div class="col-7 d-flex py-3 bg-light border-bottom">Heading is here</div>
                                    <div class="col-5 d-flex text-center py-3 bg-light border-bottom">
                                        <button class="bg-transparent text-danger border-0">Delete</button>
                                    </div>
                                    <div class="col-7 d-flex py-3 border-bottom">Heading is here</div>
                                    <div class="col-5 d-flex text-center py-3 border-bottom">
                                        <button class="bg-transparent text-danger border-0">Delete</button>
                                    </div>
                                    <div class="col-7 d-flex py-3 bg-light border-bottom">Heading is here</div>
                                    <div class="col-5 d-flex text-center bg-light py-3 border-bottom">
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

<div style="height: 50px;"></div>
@endsection
@section('script')
<script>
    select2Dropdown("select2_dropdown");

    function AddOption(appendFieldName,appendClass,appendSaveBtnClass){
        var AppendContent = '<div class="row" >'+
            '<div class="col-md-9 mt-1 mb-1" >'+
            '<input type="text" name="'+appendFieldName+'[]" required class="form-control">'+
            '</div>'+
            '<div class="col-md-2" >'+
            '<button type="button" class="btn btn-danger" style="margin-top: 3px;" onclick="removeOptionField(this)">{{ __('Remove') }}</button>'+
            '</div>'+
            '</div>';
        $('.'+appendClass).append(AppendContent);
        $("."+appendSaveBtnClass).show();


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

    function removeOptionField(obj,appendClass,appendSaveBtnClass){
        $(obj).parent().parent().remove();
        var eleLen  =   $("."+appendClass).children().length;
        if(eleLen == 0){
            $("."+appendSaveBtnClass).hide();
        }

    }

</script>
@endsection
