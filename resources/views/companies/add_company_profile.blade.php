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
        <div data-theme-mode-panel-active="true" data-theme="light">
            <div class="site-wrapper overflow-hidden bg-default-2">
                <div class="container mt-5" id="dashboard-body">
                    <h5 style="color: rgb(0, 176, 116); margin-bottom: 20px;">Company Data</h5>
                    <div class="row mb-xl-1 mb-9">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend"><span class="input-group-text modal-text-bold">Company
                                            Name</span></div>
                                    <input type="text" class="form-control" name="company">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text modal-text-bold">Start Date</span>
                                    </div>
                                    <input type="date" class="form-control" name="startDate">
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
                                    <input type="date" class="form-control" name="endDate">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text modal-text-bold">Candidate Ownership</span>
                                    </div>
                                    <input type="text" class="form-control" name="candidate_ownership">
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
                                    <input type="text" class="form-control" name="replacement_gurantee_A">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text modal-text-bold">Replacement Gurantee Non-Agent</span>
                                    </div>
                                    <input type="text" class="form-control" name="replacement_gurantee_NA">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-xl-1 mb-9">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend"><span class="input-group-text modal-text-bold">Agent
                                            Entry Level Rates</span></div><input type="text" class="form-control"
                                        name="A_EL_rates">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend"><span class="input-group-text modal-text-bold ">Agent
                                            entry complex specialized rates</span></div><input type="text"
                                        class="form-control" name="A_entry_complex_specialized_rates">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-xl-1 mb-9">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend"><span class="input-group-text modal-text-bold">Agent
                                            seasonal programs project base contractual hires</span></div><input type="text"
                                        class="form-control" name="A_seasonal_programs_project_base_contractualHires">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend"><span class="input-group-text modal-text-bold">Agent
                                            complex voice relay programs TSR collections</span></div><input type="text"
                                        class="form-control" name="A_complex_voice_relay_programs_TSR_collections">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-xl-1 mb-9">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend"><span class="input-group-text modal-text-bold">Agent
                                            high priority account night shift</span></div><input type="text"
                                        class="form-control" name="A_high_priority_account_night_shift">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend"><span class="input-group-text modal-text-bold">Agent
                                            gateway hire set</span></div><input type="text" class="form-control"
                                        name="A_gateway_hire_SET">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-xl-1 mb-9">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend"><span class="input-group-text modal-text-bold">Agent
                                            google Non-Agent sales representative</span></div><input type="text"
                                        class="form-control" name="A_google_NA_sales_representative">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend"><span class="input-group-text modal-text-bold">Agent
                                            sales CSR TSR airBNB google</span></div><input type="text"
                                        class="form-control" name="A_sales_CSR_TSR_airBNB_google">
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
                                    </div><input type="text" class="form-control" name="international_account_luzon">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend"><span
                                            class="input-group-text modal-text-bold">International account visayas</span>
                                    </div><input type="text" class="form-control" name="international_account_visayas">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-xl-1 mb-9">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend"><span class="input-group-text modal-text-bold">Local
                                            Account</span></div><input class="form-control" name="local_account">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend"><span
                                            class="input-group-text modal-text-bold">Archieve academy international</span>
                                    </div><input type="text" class="form-control" name="archieve_academy_international">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-xl-1 mb-9">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend"><span
                                            class="input-group-text modal-text-bold">Archieve academy local</span></div>
                                    <input type="text" class="form-control" name="archieve_academy_local">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend"><span
                                            class="input-group-text modal-text-bold">Trainee NCR</span></div><input
                                        type="text" class="form-control" name="trainee_NCR">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-xl-1 mb-9">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend"><span
                                            class="input-group-text modal-text-bold">Trainee visayas mindanao</span></div>
                                    <input type="text" class="form-control" name="trainee_visayas_mindanao">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend"><span
                                            class="input-group-text modal-text-bold">Premium financial services
                                            account</span></div><input type="text" class="form-control"
                                        name="premium_financial_services_account">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-xl-1 mb-9">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend"><span class="input-group-text modal-text-bold">CL 13
                                            voice</span></div><input type="text" class="form-control" name="CL_13_voice">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend"><span class="input-group-text modal-text-bold">CL 13
                                            non voice</span></div><input type="text" class="form-control"
                                        name="CL_13_non_voice">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-xl-1 mb-9">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend"><span class="input-group-text modal-text-bold">CL 12
                                            voice</span></div><input type="text" class="form-control" name="CL_12_voice">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend"><span class="input-group-text modal-text-bold">CL 12
                                            non voice</span></div><input type="text" class="form-control"
                                        name="CL_12_non_voice">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-xl-1 mb-9">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend"><span class="input-group-text modal-text-bold">CL
                                            11</span></div><input type="text" class="form-control" name="CL_11">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend"><span class="input-group-text modal-text-bold">CL 10
                                            SR analyst</span></div><input type="text" class="form-control"
                                        name="CL_10_SR_analyst">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-xl-1 mb-9">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend"><span class="input-group-text modal-text-bold">CL 10
                                            usrn</span></div><input type="text" class="form-control" name="CL_10_usrn">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend"><span class="input-group-text modal-text-bold">CL
                                            9</span></div><input type="text" class="form-control" name="CL_9">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-xl-1 mb-9">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend"><span class="input-group-text modal-text-bold">CL
                                            8</span></div><input type="text" class="form-control" name="CL_8">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend"><span class="input-group-text modal-text-bold">CL
                                            7</span></div><input type="text" class="form-control" name="CL_7">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-xl-1 mb-9">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend"><span class="input-group-text modal-text-bold">CL
                                            6</span></div><input type="text" class="form-control" name="CL_6">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend"><span class="input-group-text modal-text-bold">CL
                                            5</span></div><input type="text" class="form-control" name="CL_5">
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
                                        type="text" class="form-control" name="executive">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend"><span
                                            class="input-group-text modal-text-bold">MD</span></div><input type="text"
                                        class="form-control" name="MD">
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
                                        type="text" class="form-control" name="director">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend"><span
                                            class="input-group-text modal-text-bold">VP</span></div><input type="text"
                                        class="form-control" name="VP">
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
                                        class="form-control" name="AVP">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend"><span class="input-group-text modal-text-bold">Senior
                                            Manager</span></div><input type="text" class="form-control"
                                        name="senior_manager">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-xl-1 mb-9">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend"><span
                                            class="input-group-text modal-text-bold">Manager</span></div><input type="text"
                                        class="form-control" name="manager">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend"><span
                                            class="input-group-text modal-text-bold">Assistant associated manager</span>
                                    </div><input type="text" class="form-control" name="asst_assoc_manager">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-xl-1 mb-9">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend"><span class="input-group-text modal-text-bold">Team
                                            lead</span></div><input type="text" class="form-control" name="team_lead">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend"><span
                                            class="input-group-text modal-text-bold">Supervisor</span></div><input
                                        type="text" class="form-control" name="supervisor">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-xl-1 mb-9">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend"><span class="input-group-text modal-text-bold">Level
                                            2 technical non supervisory</span></div><input type="text"
                                        class="form-control" name="level_2_technical_non_supervisory">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend"><span
                                            class="input-group-text modal-text-bold">Multilingual</span></div><input
                                        type="text" class="form-control" name="multilingual">
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
                                        type="text" class="form-control" name="bilingual">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend"><span
                                            class="input-group-text modal-text-bold">Healthcare USRN active licence</span>
                                    </div><input type="text" class="form-control" name="healthcare_USRN_active_licence">
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
                                        name="healthcare_USRN_inactive_license">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend"><span
                                            class="input-group-text modal-text-bold">NCLEX</span></div><input type="text"
                                        class="form-control" name="NCLEX">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-xl-1 mb-9">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend"><span class="input-group-text modal-text-bold">Entry
                                            non agent level</span></div><input type="text" class="form-control"
                                        name="entry_non_agent_level">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend"><span
                                            class="input-group-text modal-text-bold">Specialized Account</span></div><input
                                        type="text" class="form-control" name="specialized_account">
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
                                        type="text" class="form-control" name="specialist">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend"><span
                                            class="input-group-text modal-text-bold">Associate</span></div><input
                                        type="text" class="form-control" name="associate">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-xl-1 mb-9">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend"><span
                                            class="input-group-text modal-text-bold">Advisor</span></div><input type="text"
                                        class="form-control" name="advisor">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend"><span class="input-group-text modal-text-bold">Senior
                                            level</span></div><input type="text" class="form-control"
                                        name="senior_level">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-xl-1 mb-9">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend"><span class="input-group-text modal-text-bold">Mid
                                            level</span></div><input type="text" class="form-control" name="mid_level">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend"><span class="input-group-text modal-text-bold">Junior
                                            level</span></div><input type="text" class="form-control"
                                        name="junior_level">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-xl-1 mb-9">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend"><span
                                            class="input-group-text modal-text-bold">Associated Analyst</span></div><input
                                        type="text" class="form-control" name="assoc_analyst">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend"><span class="input-group-text modal-text-bold">Senior
                                            analyst</span></div><input type="text" class="form-control"
                                        name="SR_analyst">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-xl-1 mb-9">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend"><span
                                            class="input-group-text modal-text-bold">Analyst</span></div><input type="text"
                                        class="form-control" name="analyst">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend"><span
                                            class="input-group-text modal-text-bold">GL_24_business_OPS_USRN</span></div>
                                    <input type="text" class="form-control" name="GL_24_business_OPS_USRN">
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
                                        class="form-control" name="b6">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend"><span
                                            class="input-group-text modal-text-bold">B7</span></div><input type="text"
                                        class="form-control" name="b7">
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
                                        class="form-control" name="b8">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend"><span
                                            class="input-group-text modal-text-bold">B9</span></div><input type="text"
                                        class="form-control" name="b9">
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
                                        class="form-control" name="b10">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend"><span class="input-group-text modal-text-bold">SME
                                            level</span></div><input type="text" class="form-control" name="SME_level">
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
                                        type="text" class="form-control" name="advisor2">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend"><span
                                            class="input-group-text modal-text-bold">Advisor1</span></div><input
                                        type="text" class="form-control" name="advisor1">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-xl-1 mb-9">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend"><span class="input-group-text modal-text-bold">GL 23
                                            tech</span></div><input type="text" class="form-control" name="GL_23_tech">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend"><span class="input-group-text modal-text-bold">GL 24
                                            tech</span></div><input type="text" class="form-control" name="GL_24_tech">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-xl-1 mb-9">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend"><span class="input-group-text modal-text-bold">GL 25
                                            tech</span></div><input type="text" class="form-control" name="GL_25_tech">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend"><span class="input-group-text modal-text-bold">GL 26
                                            tech</span></div><input type="text" class="form-control" name="GL_26_tech">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-xl-1 mb-9">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend"><span class="input-group-text modal-text-bold">GL 27
                                            tech</span></div><input type="text" class="form-control" name="GL_27_tech">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend"><span class="input-group-text modal-text-bold">GL 28
                                            tech</span></div><input type="text" class="form-control" name="GL_28_tech">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-xl-1 mb-9">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend"><span class="input-group-text modal-text-bold">GL 29
                                            tech</span></div><input type="text" class="form-control" name="GL_29_tech">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend"><span class="input-group-text modal-text-bold">GL 30
                                            tech</span></div><input type="text" class="form-control" name="GL_30_tech">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-xl-1 mb-9">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend"><span class="input-group-text modal-text-bold">GL 22
                                            business OPS</span></div><input type="text" class="form-control"
                                        name="GL_22_business_OPS">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend"><span class="input-group-text modal-text-bold">GL 23
                                            business OPS</span></div><input type="text" class="form-control"
                                        name="GL_23_business_OPS">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-xl-1 mb-9">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend"><span class="input-group-text modal-text-bold">GL 24
                                            business OPS</span></div><input type="text" class="form-control"
                                        name="GL_24_business_OPS">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend"><span class="input-group-text modal-text-bold">GL 25
                                            business OPS</span></div><input type="text" class="form-control"
                                        name="GL_25_business_OPS">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-xl-1 mb-9">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend"><span class="input-group-text modal-text-bold">GL 26
                                            business OPS</span></div><input type="text" class="form-control"
                                        name="GL_26_business_OPS">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend"><span class="input-group-text modal-text-bold">GL 27
                                            business OPS</span></div><input type="text" class="form-control"
                                        name="GL_27_business_OPS">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-xl-1 mb-9">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend"><span class="input-group-text modal-text-bold">GL 28
                                            business OPS</span></div><input type="text" class="form-control"
                                        name="GL_28_business_OPS">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend"><span class="input-group-text modal-text-bold">GL 29
                                            business OPS</span></div><input type="text" class="form-control"
                                        name="GL_29_business_OPS">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-xl-1 mb-9">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend"><span class="input-group-text modal-text-bold">GL 30
                                            business OPS</span></div><input type="text" class="form-control"
                                        name="GL_30_business_OPS">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend"><span class="input-group-text modal-text-bold">GL 22
                                            shared services</span></div><input type="text" class="form-control"
                                        name="GL_22_shared_services">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-xl-1 mb-9">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend"><span class="input-group-text modal-text-bold">GL 23
                                            shared services</span></div><input type="text" class="form-control"
                                        name="GL_23_shared_services">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend"><span class="input-group-text modal-text-bold">GL 24
                                            shared services</span></div><input type="text" class="form-control"
                                        name="GL_24_shared_services">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-xl-1 mb-9">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend"><span class="input-group-text modal-text-bold">GL 25
                                            shared services</span></div><input type="text" class="form-control"
                                        name="GL_25_shared_services">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend"><span class="input-group-text modal-text-bold">GL 26
                                            shared services</span></div><input type="text" class="form-control"
                                        name="GL_26_shared_services">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-xl-1 mb-9">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend"><span class="input-group-text modal-text-bold">GL 27
                                            shared services</span></div><input type="text" class="form-control"
                                        name="GL_27_shared_services">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend"><span class="input-group-text modal-text-bold">GL 28
                                            shared services</span></div><input type="text" class="form-control"
                                        name="GL_28_shared_services">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-xl-1 mb-9">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend"><span class="input-group-text modal-text-bold">GL 29
                                            shared services</span></div><input type="text" class="form-control"
                                        name="GL_29_shared_services">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend"><span class="input-group-text modal-text-bold">GL 30
                                            shared services</span></div><input type="text" class="form-control"
                                        name="GL_30_shared_services">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-xl-1 mb-9">
                        <div class="col-lg-6"><button type="submit">Create</button></div>
                        <div class="col-lg-6"></div>
                    </div>
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
