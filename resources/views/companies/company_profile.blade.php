@extends('layouts.app')

@section('style')
    <!-- ================= -->
    <!-- Datatable css start-->
    <link rel="stylesheet" href="//cdn.datatables.net/1.11.0/css/jquery.dataTables.min.css" />
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
        }

    </style>
@endsection


@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <!-- ================= -->
                <!-- Datatable code start-->
                <p class="C-Heading pt-3">COMPANIES</p>
                @if (Session::has('message'))
                    <p class="alert {{ Session::get('alert-class', 'alert-success') }}">{{ Session::get('message') }}</p>
                @endif
                <div class="table-responsive border">
                    <div class="___class_+?6___">
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
                                    <th>CANDIDATE_OWNERSHIP</th>
                                    <th>REPALACEMENT GUARENTEE_AGENT/ENTERY_LEVEL</th>
                                    <th>AGENT/COMPLEX-VOICE RELAY PROGRAMMS/TSR/COLLECTIONS</th>
                                    <th>AGENT/SEASONAL_PROGRAMMS/ PROJECT_BASE_AND_CONTRACTUAL_HIRES</th>
                                    <th>AGENT/HIGH_PRIORITY ACCOUNT/NIGHT_SHIFT</th>
                                    <th>AGENT/COMPLEX_VOICE RELAY_PROGRAMMS/TSR/COLLECTIONS</th>
                                    <th>REPALACEMENT GUARENTEE_AGENT/ENTERY_LEVEL</th>
                                    <th>AGENT/COMPLEX-VOICE RELAY PROGRAMMS/TSR/COLLECTIONS</th>
                                    <th>AGENT/SEASONAL_PROGRAMMS/ PROJECT_BASE_AND_CONTRACTUAL_HIRES</th>
                                    <th>AGENT/HIGH_PRIORITY ACCOUNT/NIGHT_SHIFT</th>
                                    <th>AGENT/COMPLEX_VOICE RELAY_PROGRAMMS/TSR/COLLECTIONS</th>
                                </tr>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($company as $key=>$value )
                                <tr class="bg-transparent">
                                    <!-- Table data 1 -->
                                    <td><i class="fa fa-address-card-o" aria-hidden="true"></i> {{ $key+1}}</td>
                                    <td> {{$value->company_name}}</td>
                                    <td>{{$value->start_date}}</td>
                                    <td>{{$value->end_date}}</td>
                                    <td>{{$value->candidate_ownership}}</td>
                                    <td>{{$value->a_entry_level}}</td>
                                    <td>{{$value->executive_level}}</td>
                                    <td>{{$value->e_rates}}</td>
                                    <td>{{$value->e_c_s_rates}}</td>
                                    <td>{{$value->c_v_r_programs}}</td>
                                    <td>{{$value->c_hires}}</td>
                                    <td>{{$value->night_shift}}</td>
                                    <td>{{$value->gateway_hire}}</td>
                                    <td>{{$value->google_sr }}</td>
                                    <td>{{$value->csr_tsr}}</td>
                                    <td>{{$value->in_luzon}}</td>
                                    <td>{{$value->in_visayas}}</td>
                                    <td>{{$value->local_acccount}}</td>
                                    <td>{{$value->aa_local}}</td>
                                    <td>{{$value->trainee_ncr}}</td>
                                    <td>3 months</td>
                                </tr>
                                @empty
                                    {{-- <td> No Company has been added yet</td> --}}
                                @endforelse ($company as $key => $value)
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
    <script src="//cdn.datatables.net/1.11.0/js/jquery.dataTables.min.js"></script>

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
