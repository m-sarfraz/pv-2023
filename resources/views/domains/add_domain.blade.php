@extends('layouts.app')
@section('style')
    <style>
        .dropdown_table div.col-12:nth-child(even) {
            background: #CCC
        }

        .dropdown_table div.col-12:nth-child(odd) {
            background: #FFF
        }

    </style>
@endsection



@section('content')

    <div class="container-fluid mt-8 mt-lg-11" id="dashboard-body">
        <div class="">
            <div class=" mb-15 mb-lg-23">
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
                                                    <label for="select3"
                                                        class="d-block text-black-2 font-size-4 font-weight-semibold mb-2">
                                                        Domain
                                                    </label>
                                                    <select class="select2_dropdown w-100" onchange="domainChange(this)"
                                                        id="domain">
                                                        <option value="" selected disabled="disabled">Choose options
                                                        </option>
                                                        @if (count($domains) > 0)
                                                            @foreach ($domains as $domain)
                                                                <option value="{{ $domain->id }}">
                                                                    {{ $domain->domain_name }}
                                                                </option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                    <div class="row">
                                                        <div class="col-sm">
                                                            @can('add_domains')
                                                                
                                                            <button style="background: #dc8627;"
                                                                onclick="AddOption('domain_name','domain_input_append','domain_save_btn')"
                                                                class="btn px-2 mt-2 text-white rounded-0" type="submit">Add
                                                                Domain +</button>
                                                            @endcan
                                                        </div>
                                                        <div class="col-sm">
                                                            {{-- <button style="background: #dc8627;"
                                                                onclick="AddCandidate('candidate','candidate_subsegment','domain_input_append','domain_save_btn')"
                                                                class="btn px-2 mt-2 text-white rounded-0" type="button">Add
                                                                Candidate + </button> --}}
                                                        </div>
                                                        <div class="col-sm">
                                                            <button style="background: #dc8627;display: none;"
                                                                onclick="save_form('domain_form','{{ route('add-domains') }}');"
                                                                type="button"
                                                                class="domain_save_btn  btn px-2 mt-2 text-white rounded-0">Save</button>
                                                        </div>

                                                    </div>
                                                    <div class="domain_input_append mb-3"></div>
                                                </div>
                                            </form>
                                        </div>

                                        <div class="col-lg-6 mb-xl-0 mb-7">
                                            <form id="segment_form" method="POST">
                                                @csrf
                                                <div class="form-group">
                                                    <label for="select3"
                                                        class="d-block text-black-2 font-size-4 font-weight-semibold mb-2">
                                                        Segments
                                                    </label>
                                                    <div class="">
                                                        <select
                                                            class="
                                                    select2_dropdown w-100"
                                                            id="segment">
                                                            <option value="" disabled="disabled">Choose options</option>
                                                            @if (count($segments) > 0)
                                                                @foreach ($segments as $segment)
                                                                    <option value="{{ $segment->id }}">
                                                                        {{ $segment->segment_name }}</option>
                                                                @endforeach
                                                            @endif
                                                        </select>

                                                        <div class="row">
                                                            <div class="col-sm">
                                                                @can('add_domains')
                                                                    
                                                                <button style="background: #dc8627;"
                                                                    onclick="AddOption('segment_name','segment_input_append','segment_save_btn')"
                                                                    class="btn px-2 mt-2 text-white rounded-0"
                                                                    type="submit">Add
                                                                    Segment +</button>
                                                                @endcan
                                                            </div>
                                                            <div class="col-sm">
                                                                <button style="background: #dc8627;display: none;"
                                                                    onclick="save_Segments('segment_form','{{ Route('add-segments') }}');"
                                                                    type="button"
                                                                    class="segment_save_btn  btn px-2 mt-2 text-white rounded-0">Save</button>
                                                            </div>
                                                            <input type="hidden" name="domain" id="hiddenInputS">
                                                        </div>
                                                        <div class="segment_input_append mb-3"></div>
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
            <div class=" mb-15 mb-lg-23">
                <div class="row">
                    <div class="col-xl-12 px-lg-5">
                        <p class="C-Heading pt-3">Add sub Segments</p>
                        <div class="card d-flex justify-content-center">
                            <div class="card-body">
                                <form id="sub_segment_form" method="POST">
                                    @csrf
                                    <div class="row m-0">
                                        <div class="col-md-3">
                                            @can('add_domains')
                                                
                                            <button style="background: #dc8627;"
                                                onclick="AddOption('sub_segment_name','sub_segment_input_append','sub_segment_save_btn')"
                                                class="btn px-2 mt-2 text-white rounded-0" type="submit">Add
                                                SUBSEGMENT</button>
                                            @endcan
                                        </div>
                                        <div class="col-md-2">
                                            <button style="background: #dc8627;display: none;"
                                                onclick="save_Segments('sub_segment_form','{{ Route('add-sub-segments') }}');"
                                                type="button"
                                                class="sub_segment_save_btn  btn px-2 mt-2 text-white rounded-0">Save</button>
                                        </div>
                                        <div class="sub_segment_input_append mb-3 col-md-12"></div>
                                    </div>
                                    <input type="hidden" name="domain" id="hiddenInputSub">
                                </form>
                                <table id="sub_segment_table" class="display">
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

    <div style="height: 50px;"></div>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            load_datatable();
            select2Dropdown("select2_dropdown");
            $('#segment').empty();
        });


        function AddOption(appendFieldName, appendClass, appendSaveBtnClass) {
            var AppendContent =
                `<div class="row" >` +
                `<div class="col-md-9 mt-1 mb-1" >` +
                `<input type="text" name='${appendFieldName}[]' required class="form-control">` +
                `</div>` +
                `<div class="col-md-2" >` +
                `<button type="button" class="btn btn-danger" style="margin-top: 3px;" onclick="removeOptionField(this,'${appendClass}','${appendSaveBtnClass}')">{{ __('Remove') }}</button>` +
                `</div>` +
                `</div>`;
            $('.' + appendClass).append(AppendContent);
            $("." + appendSaveBtnClass).show();
        }


        function removeOptionField(obj, appendClass, appendSaveBtnClass) {
            $(obj).parent().parent().remove();
            var eleLen = $("." + appendClass).children().length;
            if (eleLen == 0) {
                $("." + appendSaveBtnClass).hide();
            }

        }

        function AddCandidate(candidate, candidate_subsegment, appendClass, appendSaveBtnClass) {
            
            var AppendContent =
                `<div class="row mt-3" >` +
                `<div class="col-md-9 mt-1 mb-1" >` +
                `<label>Candidate profile</label>`+
                `<div id='showinput'></div> <select id='hideselect' name='c_profile[]' class="form-control">`+
                @php
                foreach ($profile as $key => $value){
                @endphp
                + `<option value='{{ $value->c_profile }}''>{{ $value->c_profile}}</option>`+
                @php  }   @endphp
                `</select>`+
                // `<input type="text" name='${candidate}[]' required class="form-control">` +
                `<label>Subsegment</label>`+
                ` <select name='s_segment[]' class="form-control">`+
                    @php
                    foreach ($subsegment as $key => $value){
                        @endphp
                `<option value='{{ $value->s_segment }}'>{{ $value->s_segment}}</option>`+
                @php  }   @endphp
                ` </select>`+
                `</div>` +
                `<div class="col-md-2 mt-5" >` +
                `<button class='btn btn-success btn-sm' type='button' onclick='ReplaceCandidateinput(id)'>New Candidate</button><button type="button" class="btn btn-danger" style="margin-top: 3px;" onclick="removeOptionField(this,'${appendClass}','${appendSaveBtnClass}')">{{ __('Remove') }}</button>` +
                `</div>` +
                `</div>`;
            $('.' + appendClass).append(AppendContent);
            $("." + appendSaveBtnClass).show();
          
        }
        function ReplaceCandidateinput(id){
            
            $('#hideselect').remove();
            $('#showinput').append(`<input type='text' name='c_profile[]'class='form-control'>`)
            }
        function domainChange(elem) {
            $('#segment').empty();
            var segment = {!! $segments !!};
            var domain = {!! $domains !!};
            var count = 0;
            for (let i = 0; i < segment.length; i++) {
                if ($(elem).val() == segment[i].domain_id) {
                    count++;
                    $('#segment').append('<option value="' + segment[i].id + '">' + segment[i].segment_name +
                        '</option>');
                }
            }
        }

        function load_datatable() {
            var option_table = $('#sub_segment_table').DataTable({
                destroy: true,
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('view-sub-segments') }}",
                    type: "GET",
                },
                columns: [{
                        data: 'sub_segment_name',
                        name: 'sub_segment_name'
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

        function save_Segments(id, route) {
            if (route == '{{ Route('add-sub-segments') }}') {
                url = '{{ Route('add-sub-segments') }}'
                domain = $('#segment').val();
                $('#hiddenInputSub').val(domain);
            } else {
                url = '{{ Route('add-segments') }}'
                domain = $('#domain').val();
                $('#hiddenInputS').val(domain);
            }
            $("#loader").show();
            var form = document.querySelector("#" + id);
            var data = new FormData(form);
            $.ajax({
                url: route,
                data: data,
                domain: domain,
                contentType: false,
                processData: false,
                type: 'POST',
                success: function(res) {
                    if (res.success == true) {

                        swal("Success", res.message, 'success');
                        setTimeout(function() {
                            location.reload();
                        }, 1000);
                    } else if (res.success == false) {
                        swal("Warning", res.message, 'error');
                    }

                    $("#loader").hide();
                },
                error: function() {
                    $("#loader").hide();
                }
            });
            return false;

        }
    </script>
@endsection
