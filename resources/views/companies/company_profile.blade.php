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
    <div class="row">
        <div class="col-lg-12">
            <!-- ================= -->
            <!-- Datatable code start-->
            <p class="C-Heading pt-3">Log:</p>
            <div class="table-responsive border">
              <div class="">
                <table id="example1" class="table">
                        <thead class="bg-light w-100">
                            <tr>
                                <th>DETAIL<span>&nbsp;&nbsp;&nbsp;&nbsp;</span></th>
                                <th>COMPANY_NAME<span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></th>
                                <th>CONTRACT_START_DATE</th>
                                <th>CONTRACT_END_DATE</th>
                                <th>CANDIDATE_OWNERSHIP</th>
                                <th>REPALACEMENT GUARENTEE_AGENT/ENTERY_LEVEL</th>
                                <th>AGENT/COMPLEX-VOICE RELAY PROGRAMMS/TSR/COLLECTIONS</th>
                                <th>AGENT/SEASONAL_PROGRAMMS/ PROJECT_BASE_AND_CONTRACTUAL_HIRES</th>
                                <th>AGENT/HIGH_PRIORITY ACCOUNT/NIGHT_SHIFT</th>
                                <th>AGENT/COMPLEX_VOICE RELAY_PROGRAMMS/TSR/COLLECTIONS</th>
                            </tr>
                        </thead>
                        <tbody>
                        <tr class="bg-transparent">
                                <!-- Table data 1 -->
                                <td><i class="fa fa-address-card-o" aria-hidden="true"></i></td>
                                <td>Acenture Inc. (TECH)</td>
                                <td>31-02-2021</td>
                                <td>24-02-2021</td>
                                <td>6 months</td>
                                <td>3 months</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr class="bg-transparent">
                                <!-- Table data 1 -->
                                <td><i class="fa fa-address-card-o" aria-hidden="true"></i></td>
                                <td>Acenture Inc. (TECH)</td>
                                <td>31-02-2021</td>
                                <td>24-02-2021</td>
                                <td>6 months</td>
                                <td>3 months</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr class="bg-transparent">
                                <!-- Table data 1 -->
                                <td><i class="fa fa-address-card-o" aria-hidden="true"></i></td>
                                <td>AIG SHARED SERVICES Inc. (Infrastructure. & developing Company)</td>
                                <td>31-02-2021</td>
                                <td>24-02-2021</td>
                                <td>6 months</td>
                                <td>3 months</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr class="bg-transparent">
                                <!-- Table data 1 -->
                                <td><i class="fa fa-address-card-o" aria-hidden="true"></i></td>
                                <td>Acenture Inc. (TECH)</td>
                                <td>31-02-2021</td>
                                <td>24-02-2021</td>
                                <td>6 months</td>
                                <td>3 months</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr class="bg-transparent">
                                <!-- Table data 1 -->
                                <td><i class="fa fa-address-card-o" aria-hidden="true"></i></td>
                                <td>AJF SOFTWARE CPY PVT LTD Inc. (Infrastructure. & developing Company)</td>
                                <td>31-02-2021</td>
                                <td>24-02-2021</td>
                                <td>6 months</td>
                                <td>3 months</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr class="bg-transparent">
                                <!-- Table data 1 -->
                                <td><i class="fa fa-address-card-o" aria-hidden="true"></i></td>
                                <td>Acenture Inc. (TECH)</td>
                                <td>31-02-2021</td>
                                <td>24-02-2021</td>
                                <td>6 months</td>
                                <td>3 months</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr class="bg-transparent">
                                <!-- Table data 1 -->
                                <td><i class="fa fa-address-card-o" aria-hidden="true"></i></td>
                                <td>Acenture Inc. (TECH)</td>
                                <td>31-02-2021</td>
                                <td>24-02-2021</td>
                                <td>6 months</td>
                                <td>3 months</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr class="bg-transparent">
                                <!-- Table data 1 -->
                                <td><i class="fa fa-address-card-o" aria-hidden="true"></i></td>
                                <td>Acenture Inc. (TECH)</td>
                                <td>31-02-2021</td>
                                <td>24-02-2021</td>
                                <td>6 months</td>
                                <td>3 months</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr class="bg-transparent">
                                <!-- Table data 1 -->
                                <td><i class="fa fa-address-card-o" aria-hidden="true"></i></td>
                                <td>Acenture Inc. (TECH)</td>
                                <td>31-02-2021</td>
                                <td>24-02-2021</td>
                                <td>6 months</td>
                                <td>3 months</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr class="bg-transparent">
                                <!-- Table data 1 -->
                                <td><i class="fa fa-address-card-o" aria-hidden="true"></i></td>
                                <td>Acenture Inc. (TECH)</td>
                                <td>31-02-2021</td>
                                <td>24-02-2021</td>
                                <td>6 months</td>
                                <td>3 months</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr class="bg-transparent">
                                <!-- Table data 1 -->
                                <td><i class="fa fa-address-card-o" aria-hidden="true"></i></td>
                                <td>Acenture Inc. (TECH)</td>
                                <td>31-02-2021</td>
                                <td>24-02-2021</td>
                                <td>6 months</td>
                                <td>3 months</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr class="bg-transparent">
                                <!-- Table data 1 -->
                                <td><i class="fa fa-address-card-o" aria-hidden="true"></i></td>
                                <td>Acenture Inc. (TECH)</td>
                                <td>31-02-2021</td>
                                <td>24-02-2021</td>
                                <td>6 months</td>
                                <td>3 months</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr class="bg-transparent">
                                <!-- Table data 1 -->
                                <td><i class="fa fa-address-card-o" aria-hidden="true"></i></td>
                                <td>Acenture Inc. (TECH)</td>
                                <td>31-02-2021</td>
                                <td>24-02-2021</td>
                                <td>6 months</td>
                                <td>3 months</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr class="bg-transparent">
                                <!-- Table data 1 -->
                                <td><i class="fa fa-address-card-o" aria-hidden="true"></i></td>
                                <td>Acenture Inc. (TECH)</td>
                                <td>31-02-2021</td>
                                <td>24-02-2021</td>
                                <td>6 months</td>
                                <td>3 months</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr class="bg-transparent">
                                <!-- Table data 1 -->
                                <td><i class="fa fa-address-card-o" aria-hidden="true"></i></td>
                                <td>Acenture Inc. (TECH)</td>
                                <td>31-02-2021</td>
                                <td>24-02-2021</td>
                                <td>6 months</td>
                                <td>3 months</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr class="bg-transparent">
                                <!-- Table data 1 -->
                                <td><i class="fa fa-address-card-o" aria-hidden="true"></i></td>
                                <td>Acenture Inc. (TECH)</td>
                                <td>31-02-2021</td>
                                <td>24-02-2021</td>
                                <td>6 months</td>
                                <td>3 months</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr class="bg-transparent">
                                <!-- Table data 1 -->
                                <td><i class="fa fa-address-card-o" aria-hidden="true"></i></td>
                                <td>Acenture Inc. (TECH)</td>
                                <td>31-02-2021</td>
                                <td>24-02-2021</td>
                                <td>6 months</td>
                                <td>3 months</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr class="bg-transparent">
                                <!-- Table data 1 -->
                                <td><i class="fa fa-address-card-o" aria-hidden="true"></i></td>
                                <td>Acenture Inc. (TECH)</td>
                                <td>31-02-2021</td>
                                <td>24-02-2021</td>
                                <td>6 months</td>
                                <td>3 months</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr class="bg-transparent">
                                <!-- Table data 1 -->
                                <td><i class="fa fa-address-card-o" aria-hidden="true"></i></td>
                                <td>Acenture Inc. (TECH)</td>
                                <td>31-02-2021</td>
                                <td>24-02-2021</td>
                                <td>6 months</td>
                                <td>3 months</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
               </div>
            </div>
            <!-- Datatable code end-->
            <!-- ================= -->


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
