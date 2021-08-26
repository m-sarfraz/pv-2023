@extends('layouts.app') 

@section('style')
<!-- ================= -->
<!-- Datatable css start-->
<link href="{{asset('assets/data-tables/css/css1.css')}}"/>
<link href="{{asset('assets/data-tables/css/css2.css')}}"/>
<link href="{{asset('assets/data-tables/css/css3.css')}}"/>
<link href="{{asset('assets/data-tables/css/css4.css')}}"/>
<!-- Datatable css end-->
<!-- ================= -->
<style>
    .row{
        margin: 0px !important;
    }
    #example1_filter label{
        display: flex;
        width: fit-content;
        margin-left: auto;
    }
</style>
@endsection


@section('content')
<div class="container-fluid">
    <div class="row m-0 pt-4">
        <div class="col-lg-6">
            <p class="C-Heading">Requirements Finder:</p>
            <div class="card mb-13">
                <div class="card-body">
                    <form action="">
                        <div class="row mb-4">
                            <div class="col-lg-6">
                                <div class="form-group mb-0">
                                    <label class="d-block font-size-3 mb-0">
                                        Search (keyword):
                                    </label>
                                    <input type="text" name="REF_CODE" placeholder="search keyword" required="" class="form-control h-px-20_custom border" value="" />
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group mb-0">
                                    <label class="d-block font-size-3 mb-0">
                                        # of Records Found:
                                    </label>
                                    <input type="text" name="REF_CODE" value="" disabled="" required="" class="form-control h-px-20_custom border" />
                                </div>
                            </div>
                        </div>
                        <p class="mb-0 pt-2">Filter by:</p>
                        <div class="row mb-1">
                            <div class="col-lg-6">
                                <div class="form-group mb-0">
                                    <label class="Label">Client</label>
                                    <select name="" id="" class="w-100" >
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                        <option value="4">Four</option>
                                        <option value="5">Five</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group mb-0">
                                    <label class="d-block font-size-3 mb-0">
                                        Domain
                                    </label>
                                    <select name="" id="" class="w-100">
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                        <option value="4">Four</option>
                                        <option value="5">Five</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-1">
                            <div class="col-lg-6">
                                <div class="form-group mb-0">
                                    <label class="d-block font-size-3 mb-0">
                                        Segment
                                    </label>
                                    <select name="" id="" class="w-100">
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                        <option value="4">Four</option>
                                        <option value="5">Five</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group mb-0">
                                    <label class="d-block font-size-3 mb-0">
                                        S-Segment
                                    </label>
                                    <select name="" id="" class="w-100">
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                        <option value="4">Four</option>
                                        <option value="5">Five</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-1">
                            <div class="col-lg-6">
                                <div class="form-group mb-0">
                                    <label class="d-block font-size-3 mb-0">
                                        Position Title:
                                    </label>
                                    <select name="" id="" class="w-100">
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                        <option value="4">Four</option>
                                        <option value="5">Five</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group mb-0">
                                    <label class="d-block font-size-3 mb-0">
                                        Career Level:
                                    </label>
                                    <select name="" id="" class="w-100">
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                        <option value="4">Four</option>
                                        <option value="5">Five</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-1">
                            <div class="col-lg-6">
                                <div class="form-group mb-0">
                                    <label class="d-block font-size-3 mb-0">
                                        Status
                                    </label>
                                    <select name="" id="" class="w-100">
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                        <option value="4">Four</option>
                                        <option value="5">Five</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group mb-0">
                                    <label class="Label">Location</label>
                                    <select name="" id="" class="w-100">
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                        <option value="4">Four</option>
                                        <option value="5">Five</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- ================= -->
            <!-- Datatable code start-->
            <div class="table-responsive border-right pt-3">
              <div class="">
                <table id="example1" class="table">
                        <thead class="bg-light w-100">
                            <tr style="border-bottom: 3px solid white;border-top: 3px solid white;">
                                <th>Team<span>&nbsp;&nbsp;&nbsp;&nbsp;</span></th>
                                <th>Recruiter</th>
                                <th>Reprocess</th>
                                <th>Canidate</th>
                                <th>Roles<span>&nbsp;&nbsp;&nbsp;&nbsp;</span></th>
                                <th>Canidate</th>
                                <th>Role<span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></th>
                                <th>Canidate</th>
                                <th>Role<span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></th>
                            </tr>
                        </thead>
                        <tbody>
                        <tr class="bg-transparent">
                                <!-- Table data 1 -->
                                <td>no data</td>
                                <td>no data</td>
                                <td>no data</td>
                                <td>no data</td>
                                <td>no data</td>
                                <td>no data</td>
                                <td>no data</td>
                                <td>no data</td>
                                <td>no data</td>
                            </tr>
                            <tr class="bg-transparent">
                                <!-- Table data 1 -->
                                <td>no data</td>
                                <td>no data</td>
                                <td>no data</td>
                                <td>no data</td>
                                <td>no data</td>
                                <td>no data</td>
                                <td>no data</td>
                                <td>no data</td>
                                <td>no data</td>
                            </tr>
                            <tr class="bg-transparent">
                                <!-- Table data 1 -->
                                <td>no data</td>
                                <td>no data</td>
                                <td>no data</td>
                                <td>no data</td>
                                <td>no data</td>
                                <td>no data</td>
                                <td>no data</td>
                                <td>no data</td>
                                <td>no data</td>
                            </tr>
                            <tr class="bg-transparent">
                                <!-- Table data 1 -->
                                <td>no data</td>
                                <td>no data</td>
                                <td>no data</td>
                                <td>no data</td>
                                <td>no data</td>
                                <td>no data</td>
                                <td>no data</td>
                                <td>no data</td>
                                <td>no data</td>
                            </tr>
                            <tr class="bg-transparent">
                                <!-- Table data 1 -->
                                <td>no data</td>
                                <td>no data</td>
                                <td>no data</td>
                                <td>no data</td>
                                <td>no data</td>
                                <td>no data</td>
                                <td>no data</td>
                                <td>no data</td>
                                <td>no data</td>
                            </tr>
                            <tr class="bg-transparent">
                                <!-- Table data 1 -->
                                <td>no data</td>
                                <td>no data</td>
                                <td>no data</td>
                                <td>no data</td>
                                <td>no data</td>
                                <td>no data</td>
                                <td>no data</td>
                                <td>no data</td>
                                <td>no data</td>
                            </tr>
                            <tr class="bg-transparent">
                                <!-- Table data 1 -->
                                <td>no data</td>
                                <td>no data</td>
                                <td>no data</td>
                                <td>no data</td>
                                <td>no data</td>
                                <td>no data</td>
                                <td>no data</td>
                                <td>no data</td>
                                <td>no data</td>
                            </tr>
                        </tbody>
                    </table>
               </div>
            </div>
            <!-- Datatable code end-->
            <!-- ================= -->


        </div>
        <div class="col-lg-6">
            <p class="C-Heading">Requirement Details:</p>
            <div class="card mb-13">
                <div class="card-body">
                    <form action="">
                        <fieldset disabled="">
                            <div class="row mb-1">
                                <div class="col-lg-4">
                                    <div class="form-group mb-0">
                                        <label class="Label">
                                            Position Title
                                        </label>
                                        <input type="text" class="form-control users-input-S-C" />
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group mb-0">
                                        <label class="Label">Priority</label>
                                        <input type="text" class="form-control users-input-S-C" />
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group mb-0">
                                        <label class="Label">FTE:</label>
                                        <input type="text" class="form-control users-input-S-C" />
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-1">
                                <div class="col-lg-4">
                                    <div class="form-group mb-0">
                                        <label class="Label"># of Endo:</label>
                                        <input type="text" class="form-control users-input-S-C" />
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group mb-0">
                                        <label class="d-block font-size-3 mb-0">
                                            Client:
                                        </label>
                                        <input type="text" class="form-control users-input-S-C" />
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group mb-0">
                                        <label class="d-block font-size-3 mb-0">
                                            Segment
                                        </label>
                                        <input type="text" class="form-control users-input-S-C" />
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-1">
                                <div class="col-lg-4">
                                    <div class="form-group mb-0">
                                        <label class="d-block font-size-3 mb-0">
                                            Sub-Segment
                                        </label>
                                        <input type="text" class="form-control users-input-S-C" />
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group mb-0">
                                        <label class="d-block font-size-3 mb-0">
                                            Start Date
                                        </label>
                                        <input type="text" class="form-control users-input-S-C" />
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group mb-0">
                                        <label class="d-block font-size-3 mb-0">
                                            Carrer Level
                                        </label>
                                        <input type="text" class="form-control users-input-S-C" />
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-1">
                                <div class="col-lg-4">
                                    <div class="form-group mb-0">
                                        <label class="Label">SLL No:</label>
                                        <input type="text" class="form-control users-input-S-C" />
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group mb-0">
                                        <label class="Label">Location:</label>
                                        <input type="text" class="form-control users-input-S-C" />
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group mb-0">
                                        <label class="Label">
                                            Work Schedule:
                                        </label>
                                        <input type="text" class="form-control users-input-S-C" />
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-1">
                                <div class="col-lg-6">
                                    <div class="form-group mb-0">
                                        <label class="Label">Budget:</label>
                                        <input type="text" class="form-control users-input-S-C" />
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group mb-0">
                                        <label class="Label">
                                            Educational Background:
                                        </label>
                                        <input type="text" class="form-control users-input-S-C" />
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-1">
                                <div class="col-lg-12">
                                    <div class="form-group mb-0">
                                        <label class="d-block font-size-3 mb-0">
                                            Job Description &amp; Work Experience:
                                        </label>
                                        <textarea name="EMPLOYMENT_HISTORY" rows="3" type="text" class="form-control border E_H h-px-20_custom" placeholder="Enter Interview Notes"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-1">
                                <div class="col-lg-6">
                                    <div class="form-group mb-0">
                                        <label class="d-block font-size-3 mb-0">
                                            Recruitment Process:
                                        </label>
                                        <textarea name="EMPLOYMENT_HISTORY" rows="3" type="text" class="form-control border E_H h-px-20_custom" placeholder="Enter Interview Notes"></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group mb-0">
                                        <label class="d-block font-size-3 mb-0">
                                            Notes:
                                        </label>
                                        <textarea name="EMPLOYMENT_HISTORY" rows="3" type="text" class="form-control border E_H h-px-20_custom" placeholder="Enter Interview Notes"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-1">
                                <div class="col-lg-6">
                                    <div class="form-group mb-0">
                                        <label class="d-block font-size-3 mb-0">
                                            Assigned Recruiters:
                                        </label>
                                        <textarea name="EMPLOYMENT_HISTORY" rows="3" type="text" class="form-control border E_H h-px-20_custom" placeholder="Enter Interview Notes"></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group mb-0">
                                        <label class="d-block font-size-3 mb-0">
                                            Updated Date:
                                        </label>
                                        <input type="date" name="UPDATED_DATE" class="form-control border h-px-20_custom" />
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


@endsection 


@section('script')
    <!-- ================= -->
    <!-- Datatable js start-->
    <script src="{{ asset('assets/plugins/data-tables/script/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/data-tables/script/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/data-tables/script/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/data-tables/script/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>

    <!-- <script>
        $(function() {
            $("#example1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
        });
            });
  
    </script> -->
    <!-- Datatable js end-->
    <!-- ================= -->
@endsection
