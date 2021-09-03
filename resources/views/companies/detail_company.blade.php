@extends('layouts.app')

@section('style')
    <!-- ================= -->
    <!-- Datatable css start-->
    <link rel="stylesheet" href="//cdn.datatables.net/1.11.0/css/jquery.dataTables.min.css" />
    <!-- Datatable css end-->
    <!-- ================= -->
    <style>


    </style>
@endsection


@section('content')
    <div id="__next">
        @if (Session::has('message'))
            <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
        @endif
        @if ($errors->has('message'))
            <li>{{ $errors->first('message') }}</li>
        @endif
        <div data-theme-mode-panel-active="true" data-theme="light">
            <div class="site-wrapper overflow-hidden bg-default-2">
                <div class="container mt-5" id="dashboard-body">
                    <h5 style="color: rgb(0, 176, 116); margin-bottom: 20px;"> <b> {{ $company->company_name }}</b>  
                    </h5>
                    <form method="POST" action="" id="myForm" enctype="multipart"> @csrf
                        <div class="row mb-xl-1 mb-9">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend"><span
                                                class="input-group-text modal-text-bold">Company
                                                Name</span></div>
                                        <input type="text" class="form-control" name="company_name"
                                            value="{{ $company->company_name }}">
                                    </div>

                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text modal-text-bold">Start Date</span>
                                        </div>
                                        <input type="date" class="form-control" name="start_date"
                                            value="{{ $company->start_date }}">
                                    </div>


                                </div>
                            </div>
                        </div>
                        <div class="row mb-xl-1 mb-9">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text modal-text-bold">End Date</span>
                                        </div>
                                        <input type="date" class="form-control" name="end_date"
                                            value="{{ $company->end_date }}">
                                    </div>

                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text modal-text-bold">Candidate Ownership</span>
                                        </div>
                                        <input type="text" class="form-control" name="candidate_ownership"
                                            value="{{ $company->candidate_ownership }}">
                                    </div>


                                </div>
                            </div>
                        </div>
                        <div class="row mb-xl-1 mb-9">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text modal-text-bold">Replacement Gurantee Agent</span>
                                        </div>
                                        <input type="text" class="form-control" name="a_entry_level"
                                            value="{{ $company->a_entry_level }}">
                                    </div>


                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text modal-text-bold">Replacement Gurantee
                                                Non-Agent</span>
                                        </div>
                                        <input type="text" class="form-control" name="executive_level"
                                            value="{{ $company->executive_level }}">
                                    </div>


                                </div>
                            </div>
                        </div>
                        <div class="row mb-xl-1 mb-9">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend"><span
                                                class="input-group-text modal-text-bold">Agent
                                                Entry Level Rates</span></div><input type="text" class="form-control"
                                            name="e_rates" value="{{ $company->e_rates }}">
                                    </div>


                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend"><span
                                                class="input-group-text modal-text-bold ">Agent
                                                entry complex specialized rates</span></div><input type="text"
                                            class="form-control" name="e_c_s_rates"
                                            value="{{ $company->e_c_s_rates }}">
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="row mb-xl-1 mb-9">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend"><span
                                                class="input-group-text modal-text-bold">Agent
                                                seasonal programs project base contractual hires</span></div><input
                                            type="text" class="form-control" name="c_hires"
                                            value="{{ $company->c_hires }}">
                                    </div>

                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend"><span
                                                class="input-group-text modal-text-bold">Agent
                                                complex voice relay programs TSR collections</span></div><input type="text"
                                            class="form-control" name="c_v_r_programs"
                                            value="{{ $company->c_v_r_programs }}">
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="row mb-xl-1 mb-9">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend"><span
                                                class="input-group-text modal-text-bold">Agent
                                                high priority account night shift</span></div><input type="text"
                                            class="form-control" name="night_shift"
                                            value="{{ $company->night_shift }}">
                                    </div>

                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend"><span
                                                class="input-group-text modal-text-bold">Agent
                                                gateway hire set</span></div><input type="text" class="form-control"
                                            name="gateway_hire" value="{{ $company->gateway_hire }}">
                                    </div>


                                </div>
                            </div>
                        </div>
                        <div class="row mb-xl-1 mb-9">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend"><span
                                                class="input-group-text modal-text-bold">Agent
                                                google Non-Agent sales representative</span></div><input type="text"
                                            value="{{ $company->google_sr }}" class="form-control" name="google_sr">
                                    </div>

                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend"><span
                                                class="input-group-text modal-text-bold">Agent
                                                sales CSR TSR airBNB google</span></div><input type="text"
                                            value="{{ $company->csr_tsr }}" class="form-control" name="csr_tsr">
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="row mb-xl-1 mb-9">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend"><span
                                                class="input-group-text modal-text-bold">International account luzon</span>
                                        </div><input type="text" class="form-control" name="in_luzon"
                                            value="{{ $company->in_luzon }}">
                                    </div>

                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend"><span
                                                class="input-group-text modal-text-bold">International account
                                                visayas</span>
                                        </div><input type="text" class="form-control"
                                            value="{{ $company->in_visayas }}" name="in_visayas">
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="row mb-xl-1 mb-9">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend"><span
                                                class="input-group-text modal-text-bold">Local
                                                Account</span></div><input class="form-control" name="local_acccount"
                                            value="{{ $company->local_acccount }}">
                                    </div>


                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend"><span
                                                class="input-group-text modal-text-bold">Archieve academy
                                                international</span>
                                        </div><input type="text" class="form-control" value="{{ $company->aa_intl }}"
                                            name="aa_intl">
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="row mb-xl-1 mb-9">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend"><span
                                                class="input-group-text modal-text-bold">Archieve academy local</span>
                                        </div>
                                        <input type="text" class="form-control" name="aa_local"
                                            value="{{ $company->aa_local }}">
                                    </div>

                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend"><span
                                                class="input-group-text modal-text-bold">Trainee NCR</span></div><input
                                            type="text" class="form-control" name="trainee_ncr"
                                            value="{{ $company->trainee_ncr }}">
                                    </div>


                                </div>
                            </div>
                        </div>
                        <div class="row mb-xl-1 mb-9">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend"><span
                                                class="input-group-text modal-text-bold">Trainee visayas mindanao</span>
                                        </div>
                                        <input type="text" class="form-control" name="trainee_vm"
                                            value="{{ $company->trainee_vm }}">
                                    </div>

                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend"><span
                                                class="input-group-text modal-text-bold">Premium financial services
                                                account</span></div><input type="text" class="form-control"
                                            value="{{ $company->pfsc }}" name="pfsc">
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="row mb-xl-1 mb-9">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend"><span class="input-group-text modal-text-bold">CL
                                                13
                                                voice</span></div><input type="text" class="form-control"
                                            value="{{ $company->cl13_v }}" name="cl13_v">
                                    </div>


                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend"><span class="input-group-text modal-text-bold">CL
                                                13
                                                non voice</span></div><input type="text" class="form-control"
                                            value="{{ $company->cl13_nv }}" name="cl13_nv">
                                    </div>


                                </div>
                            </div>
                        </div>
                        <div class="row mb-xl-1 mb-9">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend"><span class="input-group-text modal-text-bold">CL
                                                12
                                                voice</span></div><input type="text" class="form-control"
                                            value="{{ $company->cl12_v }}" name="cl12_v">
                                    </div>


                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend"><span class="input-group-text modal-text-bold">CL
                                                12
                                                non voice</span></div><input type="text" class="form-control"
                                            value="{{ $company->cl12_nv }}" name="cl12_nv">
                                    </div>


                                </div>
                            </div>
                        </div>
                        <div class="row mb-xl-1 mb-9">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend"><span class="input-group-text modal-text-bold">CL
                                                11</span></div><input type="text" class="form-control" name="cl11"
                                            value="{{ $company->cl11 }}">
                                    </div>

                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend"><span class="input-group-text modal-text-bold">CL
                                                10
                                                SR analyst</span></div><input type="text" class="form-control"
                                            value="{{ $company->cl10_sa }}" name="cl10_sa">
                                    </div>


                                </div>
                            </div>
                        </div>
                        <div class="row mb-xl-1 mb-9">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend"><span class="input-group-text modal-text-bold">CL
                                                10
                                                usrn</span></div><input type="text" class="form-control"
                                            value="{{ $company->cl10_usrn }}" name="cl10_usrn">
                                    </div>


                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend"><span class="input-group-text modal-text-bold">CL
                                                9</span></div><input type="text" class="form-control" name="cl9"
                                            value="{{ $company->cl9 }}">
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="row mb-xl-1 mb-9">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend"><span class="input-group-text modal-text-bold">CL
                                                8</span></div><input type="text" class="form-control" name="cl8"
                                            value="{{ $company->cl8 }}">
                                    </div>

                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend"><span class="input-group-text modal-text-bold">CL
                                                7</span></div><input type="text" class="form-control" name="cl7"
                                            value="{{ $company->cl7 }}">
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="row mb-xl-1 mb-9">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend"><span class="input-group-text modal-text-bold">CL
                                                6</span></div><input type="text" class="form-control" name="cl6"
                                            value="{{ $company->cl6 }}">
                                    </div>

                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend"><span class="input-group-text modal-text-bold">CL
                                                5</span></div><input type="text" class="form-control" name="cl5"
                                            value="{{ $company->cl5 }}">
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="row mb-xl-1 mb-9">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend"><span
                                                class="input-group-text modal-text-bold">Executive</span></div><input
                                            type="text" class="form-control" name="executive"
                                            value="{{ $company->executive }}">
                                    </div>


                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend"><span
                                                class="input-group-text modal-text-bold">MD</span></div><input type="text"
                                            class="form-control" name="md" value="{{ $company->md }}">
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="row mb-xl-1 mb-9">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend"><span
                                                class="input-group-text modal-text-bold">Director</span></div><input
                                            type="text" class="form-control" name="director"
                                            value="{{ $company->director }}">
                                    </div>


                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend"><span
                                                class="input-group-text modal-text-bold">VP</span></div><input type="text"
                                            class="form-control" name="vp" value="{{ $company->vp }}">
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="row mb-xl-1 mb-9">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend"><span
                                                class="input-group-text modal-text-bold">AVP</span></div><input type="text"
                                            class="form-control" name="avp" value="{{ $company->avp }}">
                                    </div>

                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend"><span
                                                class="input-group-text modal-text-bold">Senior
                                                Manager</span></div><input type="text" class="form-control" name="sm"
                                            value="{{ $company->sm }}">
                                    </div>


                                </div>
                            </div>
                        </div>
                        <div class="row mb-xl-1 mb-9">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend"><span
                                                class="input-group-text modal-text-bold">Manager</span></div><input
                                            type="text" class="form-control" name="m" value="{{ $company->m }}">
                                    </div>

                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend"><span
                                                class="input-group-text modal-text-bold">Assistant associated
                                                manager</span>
                                        </div>
                                        <input type="text" class="form-control" name="am" value="{{ $company->am }}">
                                    </div>


                                </div>
                            </div>
                        </div>
                        <div class="row mb-xl-1 mb-9">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend"><span
                                                class="input-group-text modal-text-bold">Team
                                                lead</span></div><input type="text" class="form-control" name="team_lead"
                                            value="{{ $company->team_lead }}">
                                    </div>


                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend"><span
                                                class="input-group-text modal-text-bold">Supervisor</span></div><input
                                            type="text" class="form-control" name="supervisor"
                                            value="{{ $company->supervisor }}">
                                    </div>


                                </div>
                            </div>
                        </div>
                        <div class="row mb-xl-1 mb-9">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend"><span
                                                class="input-group-text modal-text-bold">Level
                                                2 technical non supervisory</span></div><input type="text"
                                            class="form-control" name="non_supervisory"
                                            value="{{ $company->non_supervisory }}">
                                    </div>

                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend"><span
                                                class="input-group-text modal-text-bold">Multilingual</span></div><input
                                            type="text" class="form-control" name="multilingual"
                                            value="{{ $company->multilingual }}">
                                    </div>


                                </div>
                            </div>
                        </div>
                        <div class="row mb-xl-1 mb-9">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend"><span
                                                class="input-group-text modal-text-bold">Bilingual</span></div><input
                                            type="text" class="form-control" name="bilingual"
                                            value="{{ $company->bilingual }}">
                                    </div>


                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend"><span
                                                class="input-group-text modal-text-bold">Healthcare USRN active
                                                licence</span>
                                        </div><input type="text" class="form-control" name="usrn_active_license"
                                            value="{{ $company->usrn_active_license }}">
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="row mb-xl-1 mb-9">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend"><span
                                                class="input-group-text modal-text-bold">Healthcare USRN inactive
                                                license</span></div><input type="text" class="form-control"
                                            name="usrn_inactive_license" value="{{ $company->usrn_inactive_license }}">
                                    </div>

                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend"><span
                                                class="input-group-text modal-text-bold">NCLEX</span></div><input
                                            type="text" class="form-control" name="nclex"
                                            value="{{ $company->nclex }}">
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="row mb-xl-1 mb-9">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend"><span
                                                class="input-group-text modal-text-bold">Entry
                                                non agent level</span></div><input type="text" class="form-control"
                                            name="na_entry_level" value="{{ $company->na_entry_level }}">
                                    </div>

                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend"><span
                                                class="input-group-text modal-text-bold">Specialized Account</span></div>
                                        <input type="text" class="form-control" name="specialized_account"
                                            value="{{ $company->specialized_account }}">
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="row mb-xl-1 mb-9">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend"><span
                                                class="input-group-text modal-text-bold">Specialist</span></div><input
                                            type="text" class="form-control" name="specialist"
                                            value="{{ $company->specialist }}">
                                    </div>


                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend"><span
                                                class="input-group-text modal-text-bold">Associate</span></div><input
                                            type="text" class="form-control" name="associate"
                                            value="{{ $company->associate }}">
                                    </div>


                                </div>
                            </div>
                        </div>
                        <div class="row mb-xl-1 mb-9">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend"><span
                                                class="input-group-text modal-text-bold">Advisor</span></div><input
                                            type="text" class="form-control" name="advisor"
                                            value="{{ $company->advisor }}">
                                    </div>

                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend"><span
                                                class="input-group-text modal-text-bold">Senior
                                                level</span></div><input type="text" class="form-control"
                                            name="senior_level" value="{{ $company->senior_level }}">
                                    </div>


                                </div>
                            </div>
                        </div>
                        <div class="row mb-xl-1 mb-9">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend"><span
                                                class="input-group-text modal-text-bold">Mid
                                                level</span></div><input type="text" class="form-control"
                                            name="mid_level" value="{{ $company->mid_level }}">
                                    </div>


                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend"><span
                                                class="input-group-text modal-text-bold">Junior
                                                level</span></div><input type="text" class="form-control"
                                            name="junior_level" value="{{ $company->junior_level }}">
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="row mb-xl-1 mb-9">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend"><span
                                                class="input-group-text modal-text-bold">Associated Analyst</span></div>
                                        <input type="text" class="form-control" name="assoc_analyst"
                                            value="{{ $company->assoc_analyst }}">
                                    </div>

                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend"><span
                                                class="input-group-text modal-text-bold">Senior
                                                analyst</span></div><input type="text" class="form-control"
                                            name="sen_analyst" value="{{ $company->sen_analyst }}">
                                    </div>


                                </div>
                            </div>
                        </div>
                        <div class="row mb-xl-1 mb-9">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend"><span
                                                class="input-group-text modal-text-bold">Analyst</span></div><input
                                            type="text" class="form-control" name="analyst"
                                            value="{{ $company->analyst }}">
                                    </div>

                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend"><span
                                                class="input-group-text modal-text-bold">GL_24_business_OPS_USRN</span>
                                        </div>
                                        <input type="text" class="form-control" name="gl24_bo_usrn"
                                            value="{{ $company->gl24_bo_usrn }}">
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="row mb-xl-1 mb-9">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend"><span
                                                class="input-group-text modal-text-bold">B6</span></div><input type="text"
                                            class="form-control" name="b6" value="{{ $company->b6 }}">
                                    </div>

                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend"><span
                                                class="input-group-text modal-text-bold">B7</span></div><input type="text"
                                            class="form-control" name="b7" value="{{ $company->b7 }}">
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="row mb-xl-1 mb-9">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend"><span
                                                class="input-group-text modal-text-bold">B8</span></div><input type="text"
                                            class="form-control" name="b8" value="{{ $company->b8 }}">
                                    </div>

                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend"><span
                                                class="input-group-text modal-text-bold">B9</span></div><input type="text"
                                            class="form-control" name="b9" value="{{ $company->b9 }}">
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="row mb-xl-1 mb-9">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend"><span
                                                class="input-group-text modal-text-bold">B10</span></div><input type="text"
                                            class="form-control" name="b10" value="{{ $company->b10 }}">
                                    </div>

                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend"><span
                                                class="input-group-text modal-text-bold">SME
                                                level</span></div><input type="text" class="form-control"
                                            name="sme_level" value="{{ $company->sme_level }}">
                                    </div>


                                </div>
                            </div>
                        </div>
                        <div class="row mb-xl-1 mb-9">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend"><span
                                                class="input-group-text modal-text-bold">Advisor2</span></div><input
                                            type="text" class="form-control" name="advisor_2"
                                            value="{{ $company->advisor_2 }}">
                                    </div>


                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend"><span
                                                class="input-group-text modal-text-bold">Advisor1</span></div><input
                                            type="text" class="form-control" name="advisor_1"
                                            value="{{ $company->advisor_1 }}">
                                    </div>


                                </div>
                            </div>
                        </div>
                        <div class="row mb-xl-1 mb-9">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend"><span class="input-group-text modal-text-bold">GL
                                                23
                                                tech</span></div><input type="text" class="form-control" name="gl23_tech"
                                            value="{{ $company->gl23_tech }}">
                                    </div>


                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend"><span class="input-group-text modal-text-bold">GL
                                                24
                                                tech</span></div><input type="text" class="form-control" name="gl24_tech"
                                            value="{{ $company->gl24_tech }}">
                                    </div>


                                </div>
                            </div>
                        </div>
                        <div class="row mb-xl-1 mb-9">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend"><span class="input-group-text modal-text-bold">GL
                                                25
                                                tech</span></div><input type="text" class="form-control" name="gl25_tech"
                                            value="{{ $company->gl25_tech }}">
                                    </div>


                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend"><span class="input-group-text modal-text-bold">GL
                                                26
                                                tech</span></div><input type="text" class="form-control" name="gl26_tech"
                                            value="{{ $company->gl26_tech }}">
                                    </div>


                                </div>
                            </div>
                        </div>
                        <div class="row mb-xl-1 mb-9">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend"><span class="input-group-text modal-text-bold">GL
                                                27
                                                tech</span></div><input type="text" class="form-control" name="gl27_tech"
                                            value="{{ $company->gl27_tech }}">
                                    </div>


                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend"><span class="input-group-text modal-text-bold">GL
                                                28
                                                tech</span></div><input type="text" class="form-control" name="gl28_tech"
                                            value="{{ $company->gl28_tech }}">
                                    </div>


                                </div>
                            </div>
                        </div>
                        <div class="row mb-xl-1 mb-9">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend"><span class="input-group-text modal-text-bold">GL
                                                29
                                                tech</span></div><input type="text" class="form-control" name="gl29_tech"
                                            value="{{ $company->gl29_tech }}">
                                    </div>


                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend"><span class="input-group-text modal-text-bold">GL
                                                30
                                                tech</span></div><input type="text" class="form-control" name="gl30_tech"
                                            value="{{ $company->gl30_tech }}">
                                    </div>


                                </div>
                            </div>
                        </div>
                        <div class="row mb-xl-1 mb-9">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend"><span class="input-group-text modal-text-bold">GL
                                                22
                                                business OPS</span></div><input type="text" class="form-control"
                                            name="gl22_bo" value="{{ $company->gl22_bo }}">
                                    </div>


                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend"><span class="input-group-text modal-text-bold">GL
                                                23
                                                business OPS</span></div><input type="text" class="form-control"
                                            name="gl23_bo" value="{{ $company->gl23_bo }}">
                                    </div>


                                </div>
                            </div>
                        </div>
                        <div class="row mb-xl-1 mb-9">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend"><span class="input-group-text modal-text-bold">GL
                                                24
                                                business OPS</span></div><input type="text" class="form-control"
                                            name="gl_24_bo" value="{{ $company->gl_24_bo }}">
                                    </div>


                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend"><span class="input-group-text modal-text-bold">GL
                                                25
                                                business OPS</span></div><input type="text" class="form-control"
                                            name="gl_25_bo" value="{{ $company->gl_25_bo }}">
                                    </div>


                                </div>
                            </div>
                        </div>
                        <div class="row mb-xl-1 mb-9">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend"><span class="input-group-text modal-text-bold">GL
                                                26
                                                business OPS</span></div><input type="text" class="form-control"
                                            name="gl_26_bo" value="{{ $company->gl_26_bo }}">
                                    </div>


                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend"><span class="input-group-text modal-text-bold">GL
                                                27
                                                business OPS</span></div><input type="text" class="form-control"
                                            name="gl_27_bo" value="{{ $company->gl_27_bo }}">
                                    </div>


                                </div>
                            </div>
                        </div>
                        <div class="row mb-xl-1 mb-9">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend"><span class="input-group-text modal-text-bold">GL
                                                28
                                                business OPS</span></div><input type="text" class="form-control"
                                            name="gl_28_bo" value="{{ $company->gl_28_bo }}">
                                    </div>


                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend"><span class="input-group-text modal-text-bold">GL
                                                29
                                                business OPS</span></div><input type="text" class="form-control"
                                            name="gl_29_bo" value="{{ $company->gl_29_bo }}">
                                    </div>


                                </div>
                            </div>
                        </div>
                        <div class="row mb-xl-1 mb-9">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend"><span class="input-group-text modal-text-bold">GL
                                                30
                                                business OPS</span></div><input type="text" class="form-control"
                                            name="gl_30_bo" value="{{ $company->gl_30_bo }}">
                                    </div>


                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend"><span class="input-group-text modal-text-bold">GL
                                                22
                                                shared services</span></div><input type="text" class="form-control"
                                            name="gl22_ss" value="{{ $company->gl22_ss }}">
                                    </div>


                                </div>
                            </div>
                        </div>
                        <div class="row mb-xl-1 mb-9">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend"><span class="input-group-text modal-text-bold">GL
                                                23
                                                shared services</span></div><input type="text" class="form-control"
                                            name="gl23_ss" value="{{ $company->gl23_ss }}">
                                    </div>


                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend"><span class="input-group-text modal-text-bold">GL
                                                24
                                                shared services</span></div><input type="text" class="form-control"
                                            name="gl24_ss" value="{{ $company->gl24_ss }}">
                                    </div>


                                </div>
                            </div>
                        </div>
                        <div class="row mb-xl-1 mb-9">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend"><span class="input-group-text modal-text-bold">GL
                                                25
                                                shared services</span></div><input type="text" class="form-control"
                                            name="gl25_ss" value="{{ $company->gl25_ss }}">
                                    </div>


                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend"><span class="input-group-text modal-text-bold">GL
                                                26
                                                shared services</span></div><input type="text" class="form-control"
                                            name="gl26_ss" value="{{ $company->gl26_ss }}">
                                    </div>


                                </div>
                            </div>
                        </div>
                        <div class="row mb-xl-1 mb-9">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend"><span class="input-group-text modal-text-bold">GL
                                                27
                                                shared services</span></div><input type="text" class="form-control"
                                            name="gl27_ss" value="{{ $company->gl27_ss }}">
                                    </div>


                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend"><span class="input-group-text modal-text-bold">GL
                                                28
                                                shared services</span></div><input type="text" class="form-control"
                                            name="gl28_ss" value="{{ $company->gl28_ss }}">
                                    </div>


                                </div>
                            </div>
                        </div>
                        <div class="row mb-xl-1 mb-9">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend"><span class="input-group-text modal-text-bold">GL
                                                29
                                                shared services</span></div><input type="text" class="form-control"
                                            name="gl29_ss" value="{{ $company->gl29_ss }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend"><span class="input-group-text modal-text-bold">GL
                                                30
                                                shared services</span></div><input type="text" class="form-control"
                                            name="gl30_ss" value="{{ $company->gl30_ss }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-xl-1 mb-9">
                            <div class="col-lg-6">
                                <button type="button" class="btn btn-primary" name="button" id="edit">Edit Details</button>
                                <button type="button" class="btn btn-success" id="save">Save</button>
                            </div>
                            <div class="col-lg-6">
                            </div>
                        </div>

                    </form>
                </div>
                <div class="Toastify"></div>
            </div>
        </div>
    </div>
@endsection


@section('script')
    <!-- ================= -->
    <!-- Datatable js start-->
    <script src="//cdn.datatables.net/1.11.0/js/jquery.dataTables.min.js"></script>
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>

    <script>
        $(document).ready(function() {
            $("#myForm :input[name!='button']").prop("disabled", true);
        });
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
    <script>
        $('#edit').click(function() {
            $(this).prop("disabled", true);
            $("#myForm :input[name!='button']").prop("disabled", false);
        });
        $('#save').click(function(e) {
            // e.preventDefault();
            $("#myForm :input[name!='button']").prop("disabled", false);
            // $(this).prop("disabled", true);
            $('#edit').prop("disabled", true);
            var formData = new FormData(document.getElementById('myForm'));
            formData.append("_token", "{{ csrf_token() }}");
            //Calling Ajax
            $.ajax({
                url: "{{ url('admin/update_company/' . $company->company_id) }}",
                type: "post",
                processData: false,
                contentType: false,
                data: formData,
                success: function(res) {

                    if (res.success == true) {
                        swal("success", res.message, "success").then((value) => {

                            location.reload();
                        });
                    } else {

                        if (res.hasOwnProperty("message")) {
                            var err = "";
                            $("input").parent().siblings('span').remove();
                            $("input").css('border-color', '#ced4da');
                            $.each(res.message, function(i, e) {
                                $("input[name='" + i + "']").css('border-color', 'red');
                                $("input[name='" + i + "']").parent().siblings('span').remove();
                                $("input[name='" + i + "']").parent().parent().append(
                                    '<span style="color:red;" >' + e + '</span>');
                            });

                            // var wrapper = document.createElement("div");

                            // $.each(res.message, function(i, e) {

                            //     err += "<p>" + e + "</p>";
                            // });

                            // wrapper.innerHTML = err;
                            swal({
                                icon: "error",
                                text: "{{ __('Please fix the highlighted errors!') }}",
                                //content: wrapper,
                                icon: "error",
                            });
                        }
                    }
                    $("#loader").hide();
                },
                error: function() {
                    $("#loader").hide();
                }
            });
            //$("#myForm :input[name!='button']").prop("disabled", true);
        });
    </script>
@endsection
