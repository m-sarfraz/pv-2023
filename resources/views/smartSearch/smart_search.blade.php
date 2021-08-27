@extends('layouts.app') 

@section('style')
<!-- ================= -->
<!-- Datatable css start-->
<link rel="stylesheet" href="//cdn.datatables.net/1.11.0/css/jquery.dataTables.min.css" />

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
    <div class="row">
        <div class="col-lg-7">
            <p class="C-Heading pt-3">Record Finder:</p>
            <div class="card mb-13">
                <div class="card-body">
                    <form action="">
                        <div class="row mb-4">
                            <div class="col-lg-6 ">
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
                        <div class="row mb-4">
                            <div class="col-lg-2">
                                <div class="form-group mb-0">
                                    <label class="Label-00">Domain:</label>
                                    <input type="text" class="form-control users-input-S-C" placeholder="please select" />
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group mb-0">
                                    <label class="Label-00">Recruiter:</label>
                                    <input type="text" class="form-control users-input-S-C" placeholder="please select" />
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group mb-0">
                                    <label class="Label-00">Client:</label>
                                    <input type="text" class="form-control users-input-S-C" placeholder="please select" />
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group mb-0">
                                   <label class="Label">Date Delvrd:</label>
                                   <input type="date" class="w-100 users-input-S-C"/>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group mb-0">
                                   <label class="Label">Date Delvrd:</label>
                                   <input type="date" class="w-100 users-input-S-C"/>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-lg-2">
                                <div class="form-group mb-0">
                                    <label class="Label">Portal</label>
                                    <select name="" id="" class="w-100">
                                        <option value="1">All</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                        <option value="4">Four</option>
                                        <option value="5">Five</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group mb-0">
                                    <label class="Label-00">Recruiter:</label>
                                    <input type="text" class="form-control users-input-S-C" placeholder="please select" />
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group mb-0">
                                    <label class="Label-00">Client:</label>
                                    <input type="text" class="form-control users-input-S-C" placeholder="please select" />
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group mb-0">
                                   <label class="Label">Date Delvrd:</label>
                                   <input type="date" class="w-100 users-input-S-C"/>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group mb-0">
                                   <label class="Label">Date Delvrd:</label>
                                   <input type="date" class="w-100 users-input-S-C"/>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-lg-2">
                                <div class="form-group mb-0">
                                    <label class="Label-00">Domain:</label>
                                    <input type="text" class="form-control users-input-S-C" placeholder="please select" />
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group mb-0">
                                    <label class="Label-00">Recruiter:</label>
                                    <input type="text" class="form-control users-input-S-C" placeholder="please select" />
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group mb-0">
                                    <label class="Label-00">Client:</label>
                                    <input type="text" class="form-control users-input-S-C" placeholder="please select" />
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group mb-0">
                                   <label class="Label">Date Delvrd:</label>
                                   <input type="date" class="w-100 users-input-S-C"/>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group mb-0">
                                   <label class="Label">Date Delvrd:</label>
                                   <input type="date" class="w-100 users-input-S-C"/>
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
                                <th>Recruiter<span>&nbsp;&nbsp;&nbsp;&nbsp;</span></th>
                                <th>Canidate</th>
                                <th>Gender<span>&nbsp;&nbsp;&nbsp;&nbsp;</span></th>
                                <th>Profile<span>&nbsp;&nbsp;&nbsp;&nbsp;</span></th>
                                <th>Educational<span>&nbsp;&nbsp;&nbsp;&nbsp;</span></th>
                                <th>Educational<span>&nbsp;&nbsp;&nbsp;&nbsp;</span></th>
                                <th>Educational<span>&nbsp;&nbsp;&nbsp;&nbsp;</span></th>
                                <th>Educational<span>&nbsp;&nbsp;&nbsp;&nbsp;</span></th>
                                <th>Educational<span>&nbsp;&nbsp;&nbsp;&nbsp;</span></th>
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
        <div class="col-lg-5">
        <p class="C-Heading pt-3">Summary:</p>
            <div class="card mb-13">
                <div class="card-body">
                    <form action="">
                        <fieldset>
                        <div class="row mb-1">
                            <div class="col-lg-3">
                                    <div class="form-group mb-0">
                                        <label class="Label-00">
                                            Av. Salary:
                                        </label>
                                        <input type="text" class="form-control users-input-S-C" placeholder="hires.." />
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group mb-0">
                                        <label class="Label-00">
                                            Total Endsd:
                                        </label>
                                        <input type="text" class="form-control users-input-S-C" placeholder="Rev.." />
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group mb-0">
                                        <label class="Label-00">
                                           Total SPR:
                                        </label>
                                        <input type="text" class="form-control users-input-S-C" placeholder="Rev.." />
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group mb-0">
                                        <label class="Label-00">
                                            #of Accptd:
                                        </label>
                                        <input type="text" class="form-control users-input-S-C" placeholder="total.." />
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-1">
                            <div class="col-lg-3">
                                    <div class="form-group mb-0">
                                        <label class="Label-00">
                                            #of shiftd:
                                        </label>
                                        <input type="text" class="form-control users-input-S-C" placeholder="hires.." />
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group mb-0">
                                        <label class="Label-00">
                                            Initial Stg.
                                        </label>
                                        <input type="text" class="form-control users-input-S-C" placeholder="Rev.." />
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group mb-0">
                                        <label class="Label-00">
                                           Active SPR:
                                        </label>
                                        <input type="text" class="form-control users-input-S-C" placeholder="Rev.." />
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group mb-0">
                                        <label class="Label-00">
                                            #of Faild:
                                        </label>
                                        <input type="text" class="form-control users-input-S-C" placeholder="total.." />
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-1">
                            <div class="col-lg-3">
                                    <div class="form-group mb-0">
                                        <label class="Label-00">
                                            #of Actv File:
                                        </label>
                                        <input type="text" class="form-control users-input-S-C" placeholder="hires.." />
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group mb-0">
                                        <label class="Label-00">
                                            Mid Stg:
                                        </label>
                                        <input type="text" class="form-control users-input-S-C" placeholder="Rev.." />
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group mb-0">
                                        <label class="Label-00">
                                           #of hires:
                                        </label>
                                        <input type="text" class="form-control users-input-S-C" placeholder="Rev.." />
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group mb-0">
                                        <label class="Label-00">
                                            #of withdrwn:
                                        </label>
                                        <input type="text" class="form-control users-input-S-C" placeholder="total.." />
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-1">
                            <div class="col-lg-3">
                                    <div class="form-group mb-0">
                                        <label class="Label-00">
                                            <!-- # of Fallout: -->
                                        </label>
                                        <!-- <input type="text" class="form-control users-input-S-C" placeholder="hires.." /> -->
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group mb-0">
                                        <label class="Label-00">
                                            Final Stg.
                                        </label>
                                        <input type="text" class="form-control users-input-S-C" placeholder="Rev.." />
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group mb-0">
                                        <label class="Label-00">
                                           Total Rev.
                                        </label>
                                        <input type="text" class="form-control users-input-S-C" placeholder="Rev.." />
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group mb-0">
                                        <label class="Label-00">
                                            #of Rejctd:
                                        </label>
                                        <input type="text" class="form-control users-input-S-C" placeholder="total.." />
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
<div style="height: 30px;"></div>

@endsection 


@section('script')
    <!-- ================= -->
    <!-- Datatable js start-->
    <script src="{{ asset('assets/plugins/data-tables/script/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/data-tables/script/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/data-tables/script/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/data-tables/script/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>

    <script>
        $(function() {
            $("#example1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
        });
    });
    </script>
    <!-- Datatable js end-->
    <!-- ================= -->
@endsection
