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
                    <h5 style="color: rgb(0, 176, 116); margin-bottom: 20px;">Company Data</h5>
                    <form method="POST" action="{{ route('add_company') }}"> @csrf
                        <div class="row mb-xl-1 mb-9">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend"><span
                                                class="input-group-text modal-text-bold">Company
                                                Name</span></div>
                                        <input type="text" class="form-control" name="company"
                                            value="{{ old('company') }}">
                                    </div>
                                    @error('company')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text modal-text-bold">Start Date</span>
                                        </div>
                                        <input type="date" class="form-control" name="startDate"
                                            value="{{ old('startDate') }}">
                                    </div>
                                    @error('startDate')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
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
                                        <input type="date" class="form-control" name="endDate"
                                            value="{{ old('endDate') }}">
                                    </div>
                                    @error('endDate')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text modal-text-bold">Candidate Ownership</span>
                                        </div>
                                        <input type="text" class="form-control" name="candidate_ownership"
                                            value="{{ old('candidate_ownership') }}">
                                    </div>
                                    @error('candidate_ownership')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
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
                                        <input type="text" class="form-control" name="replacement_gurantee_A"
                                            value="{{ old('replacement_gurantee_A') }}">
                                    </div>
                                    @error('replacement_gurantee_A')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text modal-text-bold">Replacement Gurantee
                                                Non-Agent</span>
                                        </div>
                                        <input type="text" class="form-control" name="replacement_gurantee_NA"
                                            value="{{ old('replacement_gurantee_NA') }}">
                                    </div>
                                    @error('replacement_gurantee_NA')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
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
                                            name="A_EL_rates" value="{{ old('A_EL_rates') }}">
                                    </div>
                                    @error('A_EL_rates')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend"><span
                                                class="input-group-text modal-text-bold ">Agent
                                                entry complex specialized rates</span></div><input type="text"
                                            class="form-control" name="A_entry_complex_specialized_rates"
                                            value="{{ old('A_entry_complex_specialized_rates') }}">
                                    </div>
                                    @error('A_entry_complex_specialized_rates')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
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
                                            type="text" class="form-control"
                                            name="A_seasonal_programs_project_base_contractualHires"
                                            value="{{ old('A_seasonal_programs_project_base_contractualHires') }}">
                                    </div>
                                    @error('A_seasonal_programs_project_base_contractualHires')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend"><span
                                                class="input-group-text modal-text-bold">Agent
                                                complex voice relay programs TSR collections</span></div><input type="text"
                                            class="form-control" name="A_complex_voice_relay_programs_TSR_collections"
                                            value="{{ old('A_complex_voice_relay_programs_TSR_collections') }}">
                                    </div>
                                    @error('A_complex_voice_relay_programs_TSR_collections')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
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
                                            class="form-control" name="A_high_priority_account_night_shift"
                                            value="{{ old('A_high_priority_account_night_shift') }}">
                                    </div>
                                    @error('A_high_priority_account_night_shift')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend"><span
                                                class="input-group-text modal-text-bold">Agent
                                                gateway hire set</span></div><input type="text" class="form-control"
                                            value="{{ old('A_gateway_hire_SET') }}" name="A_gateway_hire_SET">
                                    </div>
                                    @error('A_gateway_hire_SET')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
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
                                            value="{{ old('A_google_NA_sales_representative') }}" class="form-control"
                                            name="A_google_NA_sales_representative">
                                    </div>
                                    @error('A_google_NA_sales_representative')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend"><span
                                                class="input-group-text modal-text-bold">Agent
                                                sales CSR TSR airBNB google</span></div><input type="text"
                                            value="{{ old('A_sales_CSR_TSR_airBNB_google') }}" class="form-control"
                                            name="A_sales_CSR_TSR_airBNB_google">
                                    </div>
                                </div>
                                @error('A_sales_CSR_TSR_airBNB_google')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-xl-1 mb-9">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend"><span
                                                class="input-group-text modal-text-bold">International account luzon</span>
                                        </div><input type="text" class="form-control" name="international_account_luzon"
                                            value="{{ old('international_account_luzon') }}">
                                    </div>
                                    @error('international_account_luzon')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend"><span
                                                class="input-group-text modal-text-bold">International account
                                                visayas</span>
                                        </div><input type="text" class="form-control"
                                            value="{{ old('international_account_visayas') }}"
                                            name="international_account_visayas">
                                    </div>
                                    @error('international_account_visayas')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row mb-xl-1 mb-9">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend"><span
                                                class="input-group-text modal-text-bold">Local
                                                Account</span></div><input class="form-control" name="local_account"
                                            value="{{ old('local_account') }}">
                                    </div>
                                    @error('local_account')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend"><span
                                                class="input-group-text modal-text-bold">Archieve academy
                                                international</span>
                                        </div><input type="text" class="form-control"
                                            value="{{ old('archieve_academy_international') }}"
                                            name="archieve_academy_international">
                                    </div>
                                    @error('archieve_academy_international')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
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
                                        <input type="text" class="form-control" name="archieve_academy_local"
                                            value="{{ old('archieve_academy_local') }}">
                                    </div>
                                    @error('archieve_academy_local')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend"><span
                                                class="input-group-text modal-text-bold">Trainee NCR</span></div><input
                                            type="text" class="form-control" name="trainee_NCR"
                                            value="{{ old('trainee_NCR') }}">
                                    </div>
                                    @error('trainee_NCR')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
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
                                        <input type="text" class="form-control" name="trainee_visayas_mindanao"
                                            value="{{ old('trainee_visayas_mindanao') }}">
                                    </div>
                                    @error('trainee_visayas_mindanao')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend"><span
                                                class="input-group-text modal-text-bold">Premium financial services
                                                account</span></div><input type="text" class="form-control"
                                            value="{{ old('premium_financial_services_account') }}"
                                            name="premium_financial_services_account">
                                    </div>
                                    @error('premium_financial_services_account')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
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
                                            value="{{ old('CL_13_voice') }}" name="CL_13_voice">
                                    </div>
                                    @error('CL_13_voice')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend"><span class="input-group-text modal-text-bold">CL
                                                13
                                                non voice</span></div><input type="text" class="form-control"
                                            value="{{ old('CL_13_non_voice') }}" name="CL_13_non_voice">
                                    </div>
                                    @error('CL_13_non_voice')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
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
                                            value="{{ old('CL_12_voice') }}" name="CL_12_voice">
                                    </div>
                                    @error('CL_12_voice')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend"><span class="input-group-text modal-text-bold">CL
                                                12
                                                non voice</span></div><input type="text" class="form-control"
                                            value="{{ old('CL_12_non_voice') }}" name="CL_12_non_voice">
                                    </div>
                                    @error('CL_12_non_voice')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row mb-xl-1 mb-9">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend"><span class="input-group-text modal-text-bold">CL
                                                11</span></div><input type="text" class="form-control" name="CL_11"
                                            value="{{ old('CL_11') }}">
                                    </div>
                                    @error('CL_11')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend"><span class="input-group-text modal-text-bold">CL
                                                10
                                                SR analyst</span></div><input type="text" class="form-control"
                                            value="{{ old('CL_10_SR_analyst') }}" name="CL_10_SR_analyst">
                                    </div>
                                    @error('CL_10_SR_analyst')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
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
                                            value="{{ old('CL_10_usrn') }}" name="CL_10_usrn">
                                    </div>
                                    @error('CL_10_usrn')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend"><span class="input-group-text modal-text-bold">CL
                                                9</span></div><input type="text" class="form-control" name="CL_9"
                                            value="{{ old('CL_9') }}">
                                    </div>
                                    @error('CL_9')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
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
                                    @error('CL_8')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend"><span class="input-group-text modal-text-bold">CL
                                                7</span></div><input type="text" class="form-control" name="CL_7">
                                    </div>
                                    @error('CL_7')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
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
                                    @error('CL_6')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend"><span class="input-group-text modal-text-bold">CL
                                                5</span></div><input type="text" class="form-control" name="CL_5">
                                    </div>
                                    @error('CL_5')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
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
                                    @error('executive')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend"><span
                                                class="input-group-text modal-text-bold">MD</span></div><input type="text"
                                            class="form-control" name="MD">
                                    </div>
                                    @error('MD')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
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
                                    @error('director')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend"><span
                                                class="input-group-text modal-text-bold">VP</span></div><input type="text"
                                            class="form-control" name="VP">
                                    </div>
                                    @error('VP')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
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
                                    @error('AVP')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend"><span
                                                class="input-group-text modal-text-bold">Senior
                                                Manager</span></div><input type="text" class="form-control"
                                            name="senior_manager">
                                    </div>
                                    @error('senior_manager')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row mb-xl-1 mb-9">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend"><span
                                                class="input-group-text modal-text-bold">Manager</span></div><input
                                            type="text" class="form-control" name="manager">
                                    </div>
                                    @error('manager')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend"><span
                                                class="input-group-text modal-text-bold">Assistant associated
                                                manager</span>
                                        </div>
                                        <input type="text" class="form-control" name="asst_assoc_manager">
                                    </div>
                                    @error('asst_assoc_manager')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row mb-xl-1 mb-9">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend"><span
                                                class="input-group-text modal-text-bold">Team
                                                lead</span></div><input type="text" class="form-control"
                                            name="team_lead">
                                    </div>
                                    @error('team_lead')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend"><span
                                                class="input-group-text modal-text-bold">Supervisor</span></div><input
                                            type="text" class="form-control" name="supervisor">
                                    </div>
                                    @error('supervisor')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
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
                                            class="form-control" name="level_2_technical_non_supervisory">
                                    </div>
                                    @error('level_2_technical_non_supervisory')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend"><span
                                                class="input-group-text modal-text-bold">Multilingual</span></div><input
                                            type="text" class="form-control" name="multilingual">
                                    </div>
                                    @error('multilingual')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
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
                                    @error('bilingual')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend"><span
                                                class="input-group-text modal-text-bold">Healthcare USRN active
                                                licence</span>
                                        </div><input type="text" class="form-control"
                                            name="healthcare_USRN_active_licence">
                                    </div>
                                    @error('healthcare_USRN_active_licence')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
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
                                    @error('healthcare_USRN_inactive_license')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend"><span
                                                class="input-group-text modal-text-bold">NCLEX</span></div><input
                                            type="text" class="form-control" name="NCLEX">
                                    </div>
                                    @error('NCLEX')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
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
                                            name="entry_non_agent_level">
                                    </div>
                                    @error('entry_non_agent_level')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend"><span
                                                class="input-group-text modal-text-bold">Specialized Account</span></div>
                                        <input type="text" class="form-control" name="specialized_account">
                                    </div>
                                    @error('specialized_account')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
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
                                    @error('specialist')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend"><span
                                                class="input-group-text modal-text-bold">Associate</span></div><input
                                            type="text" class="form-control" name="associate">
                                    </div>
                                    @error('associate')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row mb-xl-1 mb-9">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend"><span
                                                class="input-group-text modal-text-bold">Advisor</span></div><input
                                            type="text" class="form-control" name="advisor">
                                    </div>
                                    @error('advisor')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend"><span
                                                class="input-group-text modal-text-bold">Senior
                                                level</span></div><input type="text" class="form-control"
                                            name="senior_level">
                                    </div>
                                    @error('senior_level')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
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
                                            name="mid_level">
                                    </div>
                                    @error('mid_level')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend"><span
                                                class="input-group-text modal-text-bold">Junior
                                                level</span></div><input type="text" class="form-control"
                                            name="junior_level">
                                    </div>
                                    @error('junior_level')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row mb-xl-1 mb-9">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend"><span
                                                class="input-group-text modal-text-bold">Associated Analyst</span></div>
                                        <input type="text" class="form-control" name="assoc_analyst">
                                    </div>
                                    @error('assoc_analyst')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend"><span
                                                class="input-group-text modal-text-bold">Senior
                                                analyst</span></div><input type="text" class="form-control"
                                            name="SR_analyst">
                                    </div>
                                    @error('SR_analyst')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row mb-xl-1 mb-9">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend"><span
                                                class="input-group-text modal-text-bold">Analyst</span></div><input
                                            type="text" class="form-control" name="analyst">
                                    </div>
                                    @error('analyst')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend"><span
                                                class="input-group-text modal-text-bold">GL_24_business_OPS_USRN</span>
                                        </div>
                                        <input type="text" class="form-control" name="GL_24_business_OPS_USRN">
                                    </div>
                                    @error('GL_24_business_OPS_USRN')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
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
                                    @error('b6')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend"><span
                                                class="input-group-text modal-text-bold">B7</span></div><input type="text"
                                            class="form-control" name="b7">
                                    </div>
                                    @error('b7')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
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
                                    @error('b8')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend"><span
                                                class="input-group-text modal-text-bold">B9</span></div><input type="text"
                                            class="form-control" name="b9">
                                    </div>
                                    @error('b9')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
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
                                    @error('b10')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend"><span
                                                class="input-group-text modal-text-bold">SME
                                                level</span></div><input type="text" class="form-control"
                                            name="SME_level">
                                    </div>
                                    @error('SME_level')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
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
                                    @error('advisor2')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend"><span
                                                class="input-group-text modal-text-bold">Advisor1</span></div><input
                                            type="text" class="form-control" name="advisor1">
                                    </div>
                                    @error('advisor1')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row mb-xl-1 mb-9">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend"><span class="input-group-text modal-text-bold">GL
                                                23
                                                tech</span></div><input type="text" class="form-control"
                                            name="GL_23_tech">
                                    </div>
                                    @error('GL_23_tech')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend"><span class="input-group-text modal-text-bold">GL
                                                24
                                                tech</span></div><input type="text" class="form-control"
                                            name="GL_24_tech">
                                    </div>
                                    @error('GL_24_tech')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row mb-xl-1 mb-9">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend"><span class="input-group-text modal-text-bold">GL
                                                25
                                                tech</span></div><input type="text" class="form-control"
                                            name="GL_25_tech">
                                    </div>
                                    @error('GL_25_tech')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend"><span class="input-group-text modal-text-bold">GL
                                                26
                                                tech</span></div><input type="text" class="form-control"
                                            name="GL_26_tech">
                                    </div>
                                    @error('GL_26_tech')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row mb-xl-1 mb-9">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend"><span class="input-group-text modal-text-bold">GL
                                                27
                                                tech</span></div><input type="text" class="form-control"
                                            name="GL_27_tech">
                                    </div>
                                    @error('GL_27_tech')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend"><span class="input-group-text modal-text-bold">GL
                                                28
                                                tech</span></div><input type="text" class="form-control"
                                            name="GL_28_tech">
                                    </div>
                                    @error('GL_28_tech')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row mb-xl-1 mb-9">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend"><span class="input-group-text modal-text-bold">GL
                                                29
                                                tech</span></div><input type="text" class="form-control"
                                            name="GL_29_tech">
                                    </div>
                                    @error('GL_29_tech')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend"><span class="input-group-text modal-text-bold">GL
                                                30
                                                tech</span></div><input type="text" class="form-control"
                                            name="GL_30_tech">
                                    </div>
                                    @error('GL_30_tech')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
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
                                            name="GL_22_business_OPS">
                                    </div>
                                    @error('GL_22_business_OPS')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend"><span class="input-group-text modal-text-bold">GL
                                                23
                                                business OPS</span></div><input type="text" class="form-control"
                                            name="GL_23_business_OPS">
                                    </div>
                                    @error('GL_23_business_OPS')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
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
                                            name="GL_24_business_OPS">
                                    </div>
                                    @error('GL_24_business_OPS')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend"><span class="input-group-text modal-text-bold">GL
                                                25
                                                business OPS</span></div><input type="text" class="form-control"
                                            name="GL_25_business_OPS">
                                    </div>
                                    @error('GL_25_business_OPS')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
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
                                            name="GL_26_business_OPS">
                                    </div>
                                    @error('GL_26_business_OPS')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend"><span class="input-group-text modal-text-bold">GL
                                                27
                                                business OPS</span></div><input type="text" class="form-control"
                                            name="GL_27_business_OPS">
                                    </div>
                                    @error('GL_27_business_OPS')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
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
                                            name="GL_28_business_OPS">
                                    </div>
                                    @error('GL_28_business_OPS')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend"><span class="input-group-text modal-text-bold">GL
                                                29
                                                business OPS</span></div><input type="text" class="form-control"
                                            name="GL_29_business_OPS">
                                    </div>
                                    @error('GL_29_business_OPS')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
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
                                            name="GL_30_business_OPS">
                                    </div>
                                    @error('GL_30_business_OPS')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend"><span class="input-group-text modal-text-bold">GL
                                                22
                                                shared services</span></div><input type="text" class="form-control"
                                            name="GL_22_shared_services">
                                    </div>
                                    @error('GL_22_shared_services')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
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
                                            name="GL_23_shared_services">
                                    </div>
                                    @error('GL_23_shared_services')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend"><span class="input-group-text modal-text-bold">GL
                                                24
                                                shared services</span></div><input type="text" class="form-control"
                                            name="GL_24_shared_services">
                                    </div>
                                    @error('GL_24_shared_services')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
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
                                            name="GL_25_shared_services">
                                    </div>
                                    @error('GL_25_shared_services')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend"><span class="input-group-text modal-text-bold">GL
                                                26
                                                shared services</span></div><input type="text" class="form-control"
                                            name="GL_26_shared_services">
                                    </div>
                                    @error('GL_26_shared_services')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
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
                                            name="GL_27_shared_services">
                                    </div>
                                    @error('GL_27_shared_services')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend"><span class="input-group-text modal-text-bold">GL
                                                28
                                                shared services</span></div><input type="text" class="form-control"
                                            name="GL_28_shared_services">
                                    </div>
                                    @error('GL_28_shared_services')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
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
                                            name="GL_29_shared_services">
                                    </div>
                                    @error('GL_29_shared_services')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend"><span class="input-group-text modal-text-bold">GL
                                                30
                                                shared services</span></div><input type="text" class="form-control"
                                            name="GL_30_shared_services">
                                    </div>
                                    @error('GL_30_shared_services')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row mb-xl-1 mb-9">
                            <div class="col-lg-6"><button type="submit">Create Company</button></div>
                            <div class="col-lg-6"></div>
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
