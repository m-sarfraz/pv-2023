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
                                <fieldset>
                                    <div class="row mb-xl-1 mb-9">
                                        <div class="col-lg-6 col-md-6 col-sm-12 mb-xl-0 mb-7">
                                                <form id="domain_form" method="POST">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label for="select3" class="d-block text-black-2 font-size-4 font-weight-semibold mb-2">
                                                            Domains
                                                        </label>
                                                        <select class="select2_dropdown w-100">
                                                            <option value="two" disabled="disabled">Choose options</option>
                                                            @if(count($data['domains']) > 0)
                                                                @foreach($data['domains'] as $domain)
                                                                    <option value="{{ $domain->id }}" >{{ $domain->domain_name }}</option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                        <div class="row">
                                                            <div class="col-sm">
                                                                <button style="background: #dc8627;" onclick="AddOption('domain_name','domain_input_append','domain_save_btn')"  class="btn px-2 mt-2 text-white rounded-0" type="submit">Add Domain +</button>
                                                            </div>
                                                            <div class="col-sm">
                                                                <button style="background: #dc8627;display: none;" onclick="save_form('domain_form','{{route('add-domains')}}');"  type="button"   class="domain_save_btn  btn px-2 mt-2 text-white rounded-0"  >Save</button>
                                                            </div>
                                                        </div>
                                                        <div class="domain_input_append mb-3" ></div>
                                                    </div>
                                                </form>
                                            </div>

                                            <div class="col-lg-6 mb-xl-0 mb-7">
                                                <form id="segment_form" method="POST">
                                                    @csrf
                                                    <div class="form-group">
                                                    <label for="select3" class="d-block text-black-2 font-size-4 font-weight-semibold mb-2">
                                                        Segments
                                                    </label>
                                                    <div class="">
                                                        <select class="select2_dropdown w-100">
                                                            <option value="" disabled="disabled">Choose options</option>
                                                            @if(count($data['segments']) > 0)
                                                                @foreach($data['segments'] as $segment)
                                                                    <option value="{{ $segment->id }}" >{{ $segment->segment_name }}</option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                        <div class="row">
                                                            <div class="col-sm">
                                                                <button style="background: #dc8627;" onclick="AddOption('segment_name','segment_input_append','segment_save_btn')"  class="btn px-2 mt-2 text-white rounded-0" type="submit">Add Segment +</button>
                                                            </div>
                                                            <div class="col-sm">
                                                                <button style="background: #dc8627;display: none;" onclick="save_form('segment_form','{{ Route('add-segments') }}');"  type="button"   class="segment_save_btn  btn px-2 mt-2 text-white rounded-0"  >Save</button>
                                                            </div>
                                                        </div>
                                                        <div class="segment_input_append mb-3" ></div>
                                                    </div>
                                                </div>
                                                </form>
                                            </div>
                                    </div>
                                </fieldset>

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
                                  <div class="col-md-3">
                                      <button style="background: #dc8627;" onclick="AddOption('sub_segment','sub_segment_input_append','sub_segment_save_btn')"  class="btn px-2 mt-2 text-white rounded-0" type="submit">Add SUBSEGMENT</button>
                                  </div>
                                  <div class="col-md-2">
                                      <button style="background: #dc8627;display: none;" onclick="save_options();"  type="button"   class="sub_segment_save_btn  btn px-2 mt-2 text-white rounded-0"  >Save</button>
                                  </div>
                                <div class="sub_segment_input_append mb-3 col-md-12" ></div>

                                <div class="col-7 d-flex py-3">Sub Segments</div>
                                    <div class="col-5 d-flex text-center py-3">
                                        <div>Action</div>
                                    </div>
                            </div>

                            <div class="row m-0  dropdown_table text-uppercase border rounded">
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
       var AppendContent =
            `<div class="row" >`+
            `<div class="col-md-9 mt-1 mb-1" >`+
            `<input type="text" name='${appendFieldName}[]' required class="form-control">`+
            `</div>`+
            `<div class="col-md-2" >`+
            `<button type="button" class="btn btn-danger" style="margin-top: 3px;" onclick="removeOptionField(this,'${appendClass}','${appendSaveBtnClass}')">{{ __('Remove') }}</button>`+
            `</div>`+
            `</div>`;
        $('.'+appendClass).append(AppendContent);
        $("."+appendSaveBtnClass).show();
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
