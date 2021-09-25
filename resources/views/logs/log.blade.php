@extends('layouts.app')

@section('style')
    <!-- ================= -->
    <!-- Datatable css start-->
    <link rel="stylesheet" href="{{ asset('assets/css/jquery.dataTables.min.css') }}" />

    <!-- Datatable css end-->
    <!-- ================= -->
    <style>
        .row {
            margin: 0px !important;
        }

        #example1_filter label {
            display: flex;
            width: fit-content;
            margin-left: auto;
            align:items-center;
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
                <table class=" table" id="log_table">
                        <thead class="bg-light w-100">
                            <tr>
                                <th>ACTION_BY<span>&nbsp;&nbsp;&nbsp;&nbsp;</span></th>
                                <th>ACTION</th>
                                <th>TIMESTAMP</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($logs as $log)
                                <tr class="bg-transparent">
                                    <!-- Table data 1 -->
                                    @php
                                        $userNam = App\User::where('id', $log->action_by)->first();
                                    @endphp
                                    <td>{{ $userNam->name }}</td>
                                    <td>{{ $log->action }}</td>
                                    <td>{{ $log->created_at }}</td>
                                </tr>
                            @empty
                                <td class="text-align-center"> No log Found</td>
                            @endforelse
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
    <script src="{{ asset('assets/plugins/data-tables/script/datatables-bs4/js/dataTables.bootstrap4.min.js') }}">
    </script>
    <script src="{{ asset('assets/plugins/data-tables/script/datatables-responsive/js/dataTables.responsive.min.js') }}">
    </script>
    <script src="{{ asset('assets/plugins/data-tables/script/datatables-responsive/js/responsive.bootstrap4.min.js') }}">
    </script>

    <script>
        $(function() {
            $("#log_table").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
            });
        });
    </script>
    <!-- Datatable js end-->
    <!-- ================= -->
@endsection
