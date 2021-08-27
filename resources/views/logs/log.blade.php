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
        <div class="col-lg-12">
            <!-- ================= -->
            <!-- Datatable code start-->
            <p class="C-Heading pt-3">Log:</p>
            <div class="table-responsive border">
              <div class="">
                <table id="example1" class="table">
                        <thead class="bg-light w-100">
                            <tr>
                                <th>ACTION_BY<span>&nbsp;&nbsp;&nbsp;&nbsp;</span></th>
                                <th>ACTION</th>
                                <th>TARGET_ID</th>
                                <th>TIMESTAMP</th>
                            </tr>
                        </thead>
                        <tbody>
                        <tr class="bg-transparent">
                                <!-- Table data 1 -->
                                <td>jp</td>
                                <td>CANDIDATE_EDITED</td>
                                <td>6091181aedd58566252eff78222fasdc11</td>
                                <td>2021-07-06T04:26:28.773Z</td>
                            </tr>
                            <tr class="bg-transparent">
                                <!-- Table data 1 -->
                                <td>jp</td>
                                <td>CANDIDATE_EDITED</td>
                                <td>6091181aedd58566252eff78222fasdc11</td>
                                <td>2021-07-06T04:26:28.773Z</td>
                            </tr>
                            <tr class="bg-transparent">
                                <!-- Table data 1 -->
                                <td>jp</td>
                                <td>CANDIDATE_EDITED</td>
                                <td>6091181aedd58566252eff78222fasdc11</td>
                                <td>2021-07-06T04:26:28.773Z</td>
                            </tr>
                            <tr class="bg-transparent">
                                <!-- Table data 1 -->
                                <td>jp</td>
                                <td>CANDIDATE_EDITED</td>
                                <td>6091181aedd58566252eff78222fasdc11</td>
                                <td>2021-07-06T04:26:28.773Z</td>
                            </tr>
                            <tr class="bg-transparent">
                                <!-- Table data 1 -->
                                <td>jp</td>
                                <td>CANDIDATE_EDITED</td>
                                <td>6091181aedd58566252eff78222fasdc11</td>
                                <td>2021-07-06T04:26:28.773Z</td>
                            </tr>
                            <tr class="bg-transparent">
                                <!-- Table data 1 -->
                                <td>jp</td>
                                <td>CANDIDATE_EDITED</td>
                                <td>6091181aedd58566252eff78222fasdc11</td>
                                <td>2021-07-06T04:26:28.773Z</td>
                            </tr>
                            <tr class="bg-transparent">
                                <!-- Table data 1 -->
                                <td>jp</td>
                                <td>CANDIDATE_EDITED</td>
                                <td>6091181aedd58566252eff78222fasdc11</td>
                                <td>2021-07-06T04:26:28.773Z</td>
                            </tr>
                            <tr class="bg-transparent">
                                <!-- Table data 1 -->
                                <td>jp</td>
                                <td>CANDIDATE_EDITED</td>
                                <td>6091181aedd58566252eff78222fasdc11</td>
                                <td>2021-07-06T04:26:28.773Z</td>
                            </tr>
                            <tr class="bg-transparent">
                                <!-- Table data 1 -->
                                <td>jp</td>
                                <td>CANDIDATE_EDITED</td>
                                <td>6091181aedd58566252eff78222fasdc11</td>
                                <td>2021-07-06T04:26:28.773Z</td>
                            </tr>
                            <tr class="bg-transparent">
                                <!-- Table data 1 -->
                                <td>jp</td>
                                <td>CANDIDATE_EDITED</td>
                                <td>6091181aedd58566252eff78222fasdc11</td>
                                <td>2021-07-06T04:26:28.773Z</td>
                            </tr>
                            <tr class="bg-transparent">
                                <!-- Table data 1 -->
                                <td>jp</td>
                                <td>CANDIDATE_EDITED</td>
                                <td>6091181aedd58566252eff78222fasdc11</td>
                                <td>2021-07-06T04:26:28.773Z</td>
                            </tr>
                            <tr class="bg-transparent">
                                <!-- Table data 1 -->
                                <td>jp</td>
                                <td>CANDIDATE_EDITED</td>
                                <td>6091181aedd58566252eff78222fasdc11</td>
                                <td>2021-07-06T04:26:28.773Z</td>
                            </tr>
                            <tr class="bg-transparent">
                                <!-- Table data 1 -->
                                <td>jp</td>
                                <td>CANDIDATE_EDITED</td>
                                <td>6091181aedd58566252eff78222fasdc11</td>
                                <td>2021-07-06T04:26:28.773Z</td>
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
