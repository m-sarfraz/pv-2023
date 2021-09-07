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
                                <form id="add_dropdown_form" method="POST" >
                                    @csrf
                                    <fieldset>
                                        <div class="row mb-xl-1 mb-9">
                                            <div class="col-lg-8 mb-xl-0 mb-7">
                                                <div class="form-group position-relative">
                                                    <label for="select3" class="d-block text-black-2 font-size-4 font-weight-semibold mb-4">
                                                        Dropdowns
                                                    </label>
                                                    <div class="d-flex justify-content-between">
                                                        <div class="col-md-4" >
                                                            <input  name="name" class="form-control" placeholder="Drop down name" />
                                                        </div>
                                                        <div class="col-md-6" >
                                                            <input  name="type" class="form-control" placeholder="type like: application_status" />
                                                        </div>
                                                        <div class="col-md-2" >
                                                            <button onclick="save_form('add_dropdown_form','{{ route('save-dropdown') }}');"  type="button"  class="btn btn-warning px-5 text-white"  >Save</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                </form>

                                <table id="dropdown_table" class="display">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Type</th>
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
        $(document).ready(function(){
            load_datatable();
        });
         function  load_datatable(){
            var option_table =  $('#dropdown_table').DataTable({
                processing: true,
                serverSide: true,
                ajax : {
                    url : "{{ route('view-dropdown') }}",
                    type : "GET",

                },
                columns: [
                    {data: 'name', name: 'name'},
                    {data: 'type', name: 'type'},
                ]
            });


        }

    </script>
@endsection
