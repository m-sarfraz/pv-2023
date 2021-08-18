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
<div class="px-2 mt-5">
    <div class="dataTables_wrapper ">
    <div class="C-Heading">User</div>
        <table id="example1" class="table border-0  mt-3">
            <thead>
                <tr>
                    <th>Action</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Contact</th>
                    <th>Created At</th>
                </tr>
            </thead>
            <tbody >
                <tr class="bg-transparent">
                    <!-- Table data 1 -->
                    <td>
                        <i style="cursor: pointer;" class="fa fa-edit"></i>
                    </td>
                    <td>
                        Jp
                    </td>
                    <td>
                        Jp@gmail.com
                    </td>
                    <td>
                        Admin
                    </td>
                    <td>
                        03090844077
                    </td>
                    <td>
                        16-8-21 : 5:30pm
                    </td>
                </tr>
                <tr class="bg-transparent">
                    <!-- Table data 1 -->
                    <td>
                        <i style="cursor: pointer;" class="fa fa-edit"></i>
                    </td>
                    <td>
                        Jp
                    </td>
                    <td>
                        Jp@gmail.com
                    </td>
                    <td>
                        Admin
                    </td>
                    <td>
                        03090844077
                    </td>
                    <td>
                        16-8-21 : 5:30pm
                    </td>
                </tr>
                <tr class="bg-transparent">
                    <!-- Table data 1 -->
                    <td>
                        <i style="cursor: pointer;" class="fa fa-edit"></i>
                    </td>
                    <td>
                        Jp
                    </td>
                    <td>
                        Jp@gmail.com
                    </td>
                    <td>
                        Admin
                    </td>
                    <td>
                        03090844077
                    </td>
                    <td>
                        16-8-21 : 5:30pm
                    </td>
                </tr>
            </tbody>
            
        </table>
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
