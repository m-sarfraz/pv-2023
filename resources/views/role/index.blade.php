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
<div class="px-2 container mt-5">
        @can('role-create')
            <a href="{{ route('role.create') }}" ><button class="mt-3 mb-3 costumButton">Create New</button></a>
        @endcan
            <table id="role_table" class="table border-0  ">
                <thead>
                <tr>
                    <th>Action</th>
                    <th>Name</th>
                    <th>Created At</th>
                </tr>
                </thead>
                <tbody >

                @foreach ($roles  as $key => $role)
                    <tr class="bg-transparent">
                        <td>
                            @can('role-edit')
                                <a href="{{ route('role.edit',$role->id) }}" >
                                    <i style="cursor: pointer;" class="bi bi-pencil-square"></i>
                                </a>
                            @endcan
                        <td>{{ $role->name }}</td>
                        <td>{{ date('Y-m-d',strtotime($role->created_at)) }}</td>
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>
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
            $("#role_table").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
        });
            });

    </script>
    <!-- Datatable js end-->
    <!-- ================= -->
@endsection
