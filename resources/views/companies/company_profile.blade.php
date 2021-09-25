@extends('layouts.app')

@section('style')
    <!-- ================= -->
    <!-- Datatable css start-->
    <link rel="stylesheet"   href= "{{ asset('assets/css/jquery.dataTables.min.css') }}" /> 
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
                <div style="width: fit-content; float: right; border-radius: 7px; margin-top: 1.1rem; font-size: 13px;">
                    <input href="{{ route('add_company') }}" type="button"
                        class="btn btn-green text-white rounded-5 text-uppercase" value="Add Data" id="add"
                        style="background-color: rgb(220, 134, 39);" />
                </div>
                <div class="table-responsive border">
                    <div class="___class_+?6___">
                        <table id="example1" class="table">
                            <thead class="bg-light w-100" style="white-space:nowrap">
                                <tr>
                                    <th>DETAIL<span>&nbsp;&nbsp;&nbsp;&nbsp;</span></th>
                                    <th>
                                        COMPANY_NAME<span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                    </th>
                                    <th>CONTRACT_START_DATE</th>
                                    <th>CONTRACT_END_DATE</th>
                                    <th>CANDIDATE_OWNERSHIP</th>
                                    <th>REPALACEMENT GUARENTEE_AGENT/ENTERY_LEVEL</th>
                                    <th>Replacement Guarantee - Non-agent/Executive Level</th>
                                    <th>Agent/ Entry Level Rates</th>
                                    <th>Agent/ Entry/ Complex/specialized Level Rates</th>
                                    <th>Agent/ complex-Voice Relay Programs / TSR/ Collections</th>
                                    <th>AGENT/SEASONAL_PROGRAMMS/ PROJECT_BASE_AND_CONTRACTUAL_HIRES</th>
                                    <th>AGENT/HIGH_PRIORITY ACCOUNT/NIGHT_SHIFT</th>
                                    <th> Agent/Gateway hire / SET</th>
                                    <th> Agent / Google NA Sales Representative</th>
                                    <th>Agent / Sales CSR & TSR (Air BnB & Google)</th>
                                    <th>International Account (Luzon)</th>
                                    <th> International Account (Visayas)</th>
                                    <th>Local Account</th>
                                    <th> Achieve Academy Int'l</th>
                                    <th> Achieve Academy Local</th>
                                    <th> Trainee (NCR)</th>
                                    <th> Trainee (Visayas and Mindanao)</th>
                                    <th> Premium Financial Services Account</th>
                                    <th>CL 13 / VOICE</th>
                                    <th>CL 13 /NON-VOICE</th>
                                    <th>CL 12 / VOICE</th>
                                    <th>CL 12 / NON-VOICE</th>
                                    <th>CL 11</th>
                                    <th>CL 10 / SR. ANALYST</th>
                                    <th>CL 10 / USRN</th>
                                    <th>CL 9</th>
                                    <th>CL 8</th>
                                    <th>CL 7</th>
                                    <th>CL 6</th>
                                    <th>CL 5</th>
                                    <th>Executive</th>
                                    <th>MD</th>
                                    <th>Director</th>
                                    <th>VP</th>
                                    <th>AVP</th>
                                    <th>Senior Manager</th>
                                    <th>Manager</th>
                                    <th>Asst. Manager/Assoc Manager</th>
                                    <th>Team Lead</th>
                                    <th>Supervisor</th>
                                    <th> Level II Technical / Non-Supervisory</th>
                                    <th> Multilingual</th>
                                    <th> Bilingual</th>
                                    <th> Healthcare - USRN w/ active license</th>
                                    <th>Healthcare - USRN inactive license</th>
                                    <th>NCLEX</th>
                                    <th> Entry/Non-Agent Level</th>
                                    <th> Specialized Account</th>
                                    <th> Specialist</th>
                                    <th>Associate</th>
                                    <th>Advisor</th>
                                    <th> Senior Level</th>
                                    <th> Mid Level </th>
                                    <th> Junior Level </th>
                                    <th> Assoc Analyst </th>
                                    <th> Sr. Analyst </th>
                                    <th> Analyst </th>
                                    <th> B6 </th>
                                    <th> B7 </th>
                                    <th> B8 </th>
                                    <th> B9 </th>
                                    <th> B10 </th>
                                    <th> SME Level </th>
                                    <th> Advisors 2 </th>
                                    <th> Advisors 1 </th>
                                    <th>GL 23 TECH</th>
                                    <th>GL 24 TECH</th>
                                    <th>GL 25 TECH</th>
                                    <th>GL 26 TECH</th>
                                    <th>GL 27 TECH</th>
                                    <th>GL 28 TECH</th>
                                    <th>GL 29 TECH</th>
                                    <th>GL 30 TECH</th>
                                    <th>GL 22 BUSINESS OPS</th>
                                    <th>GL 23 BUSINESS OPS</th>
                                    <th>GL 24 BUSINESS OPS</th>
                                    <th> GL 24 BUSINESS OPS USRN</th>
                                    <th>GL 25 BUSINESS OPS</th>
                                    <th>GL 26 BUSINESS OPS</th>
                                    <th>GL 27 BUSINESS OPS</th>
                                    <th>GL 28 BUSINESS OPS</th>
                                    <th>GL 29 BUSINESS OPS</th>
                                    <th>GL 30 BUSINESS OPS</th>
                                    <th>GL 22 SHARED SERVICES</th>
                                    <th>GL 23 SHARED SERVICES</th>
                                    <th>GL 24 SHARED SERVICES</th>
                                    <th>GL 25 SHARED SERVICES</th>
                                    <th>GL 26 SHARED SERVICES</th>
                                    <th>GL 27 SHARED SERVICES</th>
                                    <th>GL 28 SHARED SERVICES</th>
                                    <th>GL 29 SHARED SERVICES</th>
                                    <th>GL 30 SHARED SERVICES</th>
                                </tr>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($company as $key=>$value )
                                    <tr class="bg-transparent">
                                        <!-- Table data 1 -->
                                        <td><a href="{{ url('admin/company-detail/' . $value->company_id) }}"><i
                                                    class="bi bi-person-lines-fill" aria-hidden="true"></i></a></td>
                                        <td> {{ $value->company_name }}</td>
                                        <td>{{ $value->start_date }}</td>
                                        <td>{{ $value->end_date }}</td>
                                        <td>{{ $value->candidate_ownership }}</td>
                                        <td>{{ $value->a_entry_level }}</td>
                                        <td>{{ $value->executive_level }}</td>
                                        <td>{{ $value->e_rates }}</td>
                                        <td>{{ $value->e_c_s_rates }}</td>
                                        <td>{{ $value->c_v_r_programs }}</td>
                                        <td>{{ $value->c_hires }}</td>
                                        <td>{{ $value->night_shift }}</td>
                                        <td>{{ $value->gateway_hire }}</td>
                                        <td>{{ $value->google_sr }}</td>
                                        <td>{{ $value->csr_tsr }}</td>
                                        <td>{{ $value->in_luzon }}</td>
                                        <td>{{ $value->in_visayas }}</td>
                                        <td>{{ $value->local_acccount }}</td>
                                        <td>{{ $value->aa_intl }}</td>
                                        <td>{{ $value->aa_local }}</td>
                                        <td>{{ $value->trainee_ncr }}</td>
                                        <td>{{ $value->trainee_vm }}</td>
                                        <td>{{ $value->pfsc }}</td>
                                        <td>{{ $value->cl13_v }}</td>
                                        <td>{{ $value->cl13_nv }}</td>
                                        <td>{{ $value->cl12_v }}</td>
                                        <td>{{ $value->cl12_nv }}</td>
                                        <td>{{ $value->cl11 }}</td>
                                        <td>{{ $value->cl10_sa }}</td>
                                        <td>{{ $value->cl10_usrn }}</td>
                                        <td>{{ $value->cl9 }}</td>
                                        <td>{{ $value->cl8 }}</td>
                                        <td>{{ $value->cl7 }}</td>
                                        <td>{{ $value->cl6 }}</td>
                                        <td>{{ $value->cl5 }}</td>
                                        <td>{{ $value->executive }}</td>
                                        <td>{{ $value->md }}</td>
                                        <td>{{ $value->director }}</td>
                                        <td>{{ $value->vp }}</td>
                                        <td>{{ $value->avp }}</td>
                                        <td>{{ $value->sm }}</td>
                                        <td>{{ $value->m }}</td>
                                        <td>{{ $value->am }}</td>
                                        <td>{{ $value->team_lead }}</td>
                                        <td>{{ $value->supervisor }}</td>
                                        <td>{{ $value->non_supervisory }}</td>
                                        <td>{{ $value->multilingual }}</td>
                                        <td>{{ $value->bilingual }}</td>
                                        <td>{{ $value->usrn_active_license }}</td>
                                        <td>{{ $value->usrn_inactive_license }}</td>
                                        <td>{{ $value->nclex }}</td>
                                        <td>{{ $value->na_entry_level }}</td>
                                        <td>{{ $value->specialized_account }}</td>
                                        <td>{{ $value->specialist }}</td>
                                        <td>{{ $value->associate }}</td>
                                        <td>{{ $value->advisor }}</td>
                                        <td>{{ $value->senior_level }}</td>
                                        <td>{{ $value->mid_level }}</td>
                                        <td>{{ $value->junior_level }}</td>
                                        <td>{{ $value->assoc_analyst }}</td>
                                        <td>{{ $value->sen_analyst }}</td>
                                        <td>{{ $value->analyst }}</td>
                                        <td>{{ $value->b6 }}</td>
                                        <td>{{ $value->b7 }}</td>
                                        <td>{{ $value->b8 }}</td>
                                        <td>{{ $value->b9 }}</td>
                                        <td>{{ $value->b10 }}</td>
                                        <td>{{ $value->sme_level }}</td>
                                        <td>{{ $value->advisor_2 }}</td>
                                        <td>{{ $value->advisor_1 }}</td>
                                        <td>{{ $value->gl23_tech }}</td>
                                        <td>{{ $value->gl24_tech }}</td>
                                        <td>{{ $value->gl25_tech }}</td>
                                        <td>{{ $value->gl26_tech }}</td>
                                        <td>{{ $value->gl27_tech }}</td>
                                        <td>{{ $value->gl28_tech }}</td>
                                        <td>{{ $value->gl29_tech }}</td>
                                        <td>{{ $value->gl30_tech }}</td>
                                        <td>{{ $value->gl22_bo }}</td>
                                        <td>{{ $value->gl23_bo }}</td>
                                        <td>{{ $value->gl_24_bo }}</td>
                                        <td>{{ $value->gl24_bo_usrn }}</td>
                                        <td>{{ $value->gl_25_bo }}</td>
                                        <td>{{ $value->gl_26_bo }}</td>
                                        <td>{{ $value->gl_27_bo }}</td>
                                        <td>{{ $value->gl_28_bo }}</td>
                                        <td>{{ $value->gl_29_bo }}</td>
                                        <td>{{ $value->gl_30_bo }}</td>
                                        <td>{{ $value->gl22_ss }}</td>
                                        <td>{{ $value->gl23_ss }}</td>
                                        <td>{{ $value->gl24_ss }}</td>
                                        <td>{{ $value->gl25_ss }}</td>
                                        <td>{{ $value->gl26_ss }}</td>
                                        <td>{{ $value->gl27_ss }}</td>
                                        <td>{{ $value->gl28_ss }}</td>
                                        <td>{{ $value->gl29_ss }}</td>
                                        <td>{{ $value->gl30_ss }}</td>
                                    </tr>
                                @empty
                                    {{-- <tr> No Company has been added yet</tr> --}}
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
    <script src= "{{ asset('assets/js/jquery.dataTables.min.js') }}" ></script>

    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
            });
        });
    </script>
    <script>
        $("#add").click(function() {
            window.location = 'add-company'
        });
    </script>
    <!-- Datatable js end-->
    <!-- ================= -->
@endsection
