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
        }

    </style>
@endsection


@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-7">
                <p class="C-Heading pt-3">Record Finder:</p>
                <div class="card mb-13">
                    <div class="card-body">
                        <form action="">
                            <div class="row mb-4">
                                <div class="col-lg-6 ">
                                    <div class="form-group mb-0">
                                        <label class="d-block font-size-3 mb-0">
                                            Search (keyword):
                                        </label>
                                        <input type="text" name="searchKeyword" id="searchKeyword" placeholder="search keyword" required=""
                                            id="search" onchange="FilterSearch()" class="form-control h-px-20_custom border"
                                            value="" />
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group mb-0">
                                        <label class="d-block font-size-3 mb-0">
                                            Number Of Records Found:
                                        </label>
                                        <input type="text" name="REF_CODE" value="" disabled="" required="" id="foundRecord"
                                            class="form-control h-px-20_custom border" />
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-lg-2">
                                    <div class="form-group mb-0">
                                        <label class="Label-00">Domain:</label>
                                        <select multiple name="DOMAIN" id="domain" required="" onchange="FilterSearch()"
                                            class="form-control p-0 users-input-S-C select2_dropdown w-100">

                                            @foreach ($domain as $domainOption)
                                                <option value="{{ $domainOption->domain_name }}">
                                                    {{ $domainOption->domain_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group mb-0">
                                        <label class="Label-00">Recruiter:</label>
                                        <select multiple name="recruiter" id="recruiter" class="select2_dropdown  w-100"
                                            onchange="FilterSearch()" onchange="filterUserData()">

                                            @foreach ($user_recruiter as $key => $user_recruiter)
                                                <option value="{{ $user_recruiter->id }}">{{ $user_recruiter->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group mb-0">
                                        @php
                                            $client = Helper::get_dropdown('clients');
                                        @endphp
                                        <label class="Label-00">Client:</label>
                                        <select multiple name="CLIENT" id="client" onchange="FilterSearch()"
                                            class="form-control border pl-0 arrow-3 h-px-20_custom w-100 font-size-4 d-flex align-items-center select2_dropdown w-100">

                                            @foreach ($client->options as $clientOptions)
                                                <option value="{{ $clientOptions->option_name }}">
                                                    {{ $clientOptions->option_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group mb-0">
                                        <label class="Label">Start Date (endorsement):</label>
                                        <input type="date" id="endo_start" class="w-100 users-input-S-C form-control"
                                            onchange="FilterSearch()" />
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group mb-0">
                                        <label class="Label">End date endorsement:</label>
                                        <input type="date" id="endo_end" class="w-100 users-input-S-C form-control"
                                            onchange="FilterSearch()" />
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-lg-2">
                                    <div class="form-group mb-0">
                                        <label class="Label">Portal</label>
                                        <select name="portal" id="portal" class="w-100 form-control"
                                            onchange="FilterSearch()">
                                            <option value="1">All</option>

                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group mb-0">
                                      
                                        <label class="Label-00">Residence:</label>
                                        <select multiple name="residence" required="" id="residence"
                                            onchange="FilterSearch()"
                                            class="form-control border h-px-20_custom select2_dropdown w-100">

                                            @foreach ($address as $Userdatas)
                                            @if(isset($Userdatas->address))
                                                <option value="{{ $Userdatas->address }}">
                                                    {{  $Userdatas->address }}
                                                </option>
                                            @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group mb-0">
                                        @php
                                            $careerLevel = Helper::get_dropdown('career_level');
                                        @endphp
                                        <label class="Label-00">Career Level:</label>
                                        <select multiple name="CAREER_LEVEL_FINANCE" required="" id="career_level"
                                            onchange="FilterSearch()"
                                            class="form-control border h-px-20_custom select2_dropdown w-100">

                                            @foreach ($careerLevel->options as $careerLevelOptions)
                                                <option value="{{ $careerLevelOptions->option_name }}">
                                                    {{ $careerLevelOptions->option_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group mb-0">
                                        <label class="Label">Start Date (Shifted):</label>
                                        <input type="date" id="Shifted_start" class="w-100 users-input-S-C form-control"
                                            onchange="FilterSearch()" />
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group mb-0">
                                        <label class="Label">End Date Shifted:</label>
                                        <input type="date" id="Shifted_end" class="w-100 users-input-S-C form-control"
                                            onchange="FilterSearch()" />
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-lg-2">
                                    <div class="form-group mb-0">
                                        <label class="Label-00">Category:</label>
                                        <select multiple name="REMARKS_FOR_FINANCE" id="category" onchange="FilterSearch()"
                                            class="select2_dropdown  w-100 form-control border pl-0 arrow-3 h-px-20_custom w-100 font-size-4 d-flex align-items-center w-100">
                                            @php
                                                $remarks = Helper::get_dropdown('remarks_for_finance');
                                            @endphp

                                            @foreach ($remarks->options as $remarksOptions)
                                                <option value="{{ $remarksOptions->option_name }}">
                                                    {{ $remarksOptions->option_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group mb-0">
                                        <label class="Label-00">Status:</label>
                                        <Select multiple id="status" onchange="FilterSearch()"
                                            class="form-control border h-px-20_custom select2_dropdown w-100">

                                            <Option>To Be Endorsed</Option>
                                        </Select>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group mb-0">
                                        @php
                                            $remarks = Helper::get_dropdown('remarks_from_finance');
                                        @endphp
                                        <label class="Label-00">Remarks:</label>
                                        <select multiple name="remarks" id="remarks" onchange="FilterSearch()"
                                            class="w-100 form-control select2_dropdown w-100">

                                            @foreach ($remarks->options as $remarksOptions)
                                                <option value="{{ $remarksOptions->option_name }}">
                                                    {{ $remarksOptions->option_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group mb-0">
                                        <label class="Label">Start Date (onbording):</label>
                                        <input type="date" id="ob_start" class="w-100 users-input-S-C form-control"
                                            onchange="FilterSearch()" />
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group mb-0">
                                        <label class="Label">End Date onbording:</label>
                                        <input type="date" id="ob_end" class="w-100 users-input-S-C form-control"
                                            onchange="FilterSearch()" />
                                    </div>
                                </div>
                              
                            </div>
                            <div class="col-lg-2 ml-auto pt-3">
                                <div class="form-group mb-0 text-right">
                                    <label class="Label-00" >CIP</label>
                                    <input type="checkbox"  id="cip" name="cip" onclick="FilterSearch()">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- ================= -->
                <!-- Datatable code start-->
                <div class="table-responsive border-right pt-3" id="filterResult_div">
                    <div class="">
                        <table id=" example1" class="table">
                            <thead class="bg-light w-100">
                                <tr style="border-bottom: 3px solid white;border-top: 3px solid white; white-space:nowrap">
                                    <th class="ant-table-cell">Recruiter</th>
                                    <th class="ant-table-cell">Candidate</th>
                                    <th class="ant-table-cell">Client</th>
                                    <th class="ant-table-cell">Gender</th>
                                    <th class="ant-table-cell">DOMAIN</th>

                                    <th class="ant-table-cell">Profile</th>
                                    <th class="ant-table-cell">Education Attainment</th>
                                    <th class="ant-table-cell">Salary</th>
                                    <th class="ant-table-cell">Portal</th>
                                    <th class="ant-table-cell">Date Sifted</th>
                                    <th class="ant-table-cell">CL</th>
                                    <th class="ant-table-cell">Endo</th>
                                    <th class="ant-table-cell">Status</th>
                                    <th class="ant-table-cell">Remarks</th>
                                    <th class="ant-table-cell">Category</th>
                                    <th class="ant-table-cell">SPR</th>
                                    <th class="ant-table-cell">Date Onboarded</th>
                                    <th class="ant-table-cell">Placement fee</th>
                                    <th class="ant-table-cell">Location</th>
                                    <th class="ant-table-cell ant-table-cell-scrollbar"></th>
                                </tr>
                            </thead>
                            <tbody>

                                @forelse ( $Userdata as $key=>$value )
                                    <tr class="bg-transparent" >
                                        <!-- Table data 1 -->
                                        @php
                                            $user = \App\User::where('id', $value->saved_by)->first();
                                            $role = $user->roles->pluck('name');
                                        @endphp
                                        {{-- <td> {{ $role[0] }}</td> --}}
                                        @php
                                            $name = \App\User::with('candidate_information')
                                                ->where('id', $value->saved_by)
                                                ->first();
                                        @endphp
                                        <td>{{ $name->name }}</td>
                                        <td>
                                            @if (isset($value->last_name))
                                                {{ $value->last_name }} 

                                            @endif
                                        </td>
                                        <td> {{ $value->client }}</td>
                                        <td> {{ $value->gender }}</td>
                                        <td> {{ $value->domain }}</td>
                                        <td>{{ $value->candidate_profile }}</td>
                                      
                                        <td>{{ $value->educational_attain }}</td>
                                        <td>{{ $value->curr_salary }}</td>
                                        <td></td>
                                        <td>{{ $value->date_shifted }}</td>
                                        <td>{{ $value->career_endo }}</td>
                                        <td>
                                            @if (isset($value->endi_date))
                                                {{ $value->endi_date }}

                                            @endif
                                        </td>
                                        <td>{{ $value->app_status }}</td>
                                        <td>{{ $value->remarks }}</td>
                                        <td>{{ $value->remarks_for_finance }}</td>
                                        <td>{{ $value->srp }}</td>
                                        <td>{{ $value->onboardnig_date }}</td>
                                        <td>
                                            @if (isset($value->placement_fee))
                                                {{ $value->placement_fee }}

                                            @endif
                                        </td>
                                        <td>
                                                {{ $value->address }}

                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td> no data found</td>
                                    </tr>
                                @endforelse

                            </tbody>
                        </table>
                    </div>
                    {{ $Userdata->links() }}

                </div>
                <!-- Datatable code end-->
                <!-- ================= -->
            </div>
            <div class="col-lg-5">
                <p class="C-Heading pt-3">Summary:</p>
                <div class="card mb-13">
                    <div class="card-body">
                        <form action="">
                            <fieldset>
                                <div class="row mb-1">
                                    <div class="col-lg-4">
                                        <div class="form-group mb-0">
                                            <label class="Label-00">
                                                Average Salary:
                                            </label>
                                            <input readonly type="text" class="form-control users-input-S-C"
                                                placeholder="hires.." />
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group mb-0">
                                            <label class="Label-00">
                                                Total Endorsement:
                                            </label>
                                            <input readonly type="text" class="form-control users-input-S-C"
                                                value="{{ $Userdata->where('endorsements.app_status', 'To Be Endorsed')->count() }}"
                                                placeholder="Rev.." id="endo" />
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group mb-0">
                                            <label class="Label-00">
                                                Total SPR:
                                            </label>
                                            <input readonly type="text" class="form-control users-input-S-C"
                                                placeholder="Rev.." id="spr" />
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group mb-0">
                                            <label class="Label-00">
                                                Number of Accepted:
                                            </label>
                                            <input readonly type="text" class="form-control users-input-S-C" id="accepted"
                                                placeholder="total.." />
                                        </div>
                                    </div>

                                    <!-- <div class="row mb-1"> -->
                                    <div class="col-lg-4">
                                        <div class="form-group mb-0">
                                            <label class="Label-00">
                                                Number of Shifted:
                                            </label>
                                            <input readonly type="text" class="form-control users-input-S-C" id="sifted"
                                                placeholder="hires.." />
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group mb-0">
                                            <label class="Label-00">
                                                Initial Stage.
                                            </label>
                                            <input readonly type="text" class="form-control users-input-S-C"
                                                placeholder="Rev.." />
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group mb-0">
                                            <label class="Label-00">
                                                Active SPR:
                                            </label>
                                            <input readonly type="text" class="form-control users-input-S-C"
                                                placeholder="Rev.." />
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group mb-0">
                                            <label class="Label-00">
                                                Number of Failed:
                                            </label>
                                            <input readonly type="text" class="form-control users-input-S-C" id="failed"
                                                placeholder="total.." />
                                        </div>
                                    </div>
                                    <!-- </div> -->
                                    <!-- <div class="row mb-1"> -->
                                    <div class="col-lg-4">
                                        <div class="form-group mb-0">
                                            <label class="Label-00">
                                                Number of Active File:
                                            </label>
                                            <input readonly type="text" class="form-control users-input-S-C" id="active"
                                                value="{{ $Userdata->where('endorsements.app_status', 'Active File')->count() }}"
                                                placeholder="hires.." />
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group mb-0">
                                            <label class="Label-00">
                                                Mid Stage:
                                            </label>
                                            <input readonly type="text" class="form-control users-input-S-C"
                                                placeholder="Rev.." />
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group mb-0">
                                            <label class="Label-00">
                                                Number of hires:
                                            </label>
                                            <input readonly type="text" class="form-control users-input-S-C"
                                                placeholder="Rev.." id="onBoarded" />
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group mb-0">
                                            <label class="Label-00">
                                                Number of Withdrew:
                                            </label>
                                            <input readonly type="text" class="form-control users-input-S-C" id="withdrawn"
                                                placeholder="total.." />
                                        </div>
                                    </div>
                                    <!-- </div> -->
                                    <!-- <div class="row mb-1"> -->
                                    <div class="col-lg-4">
                                        <div class="form-group mb-0">
                                            <label class="Label-00">
                                                No of Fallout:
                                            </label>
                                            <input readonly type="text" class="form-control users-input-S-C"
                                                placeholder="hires.." />
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group mb-0">
                                            <label class="Label-00">
                                                Final Stage:
                                            </label>
                                            <input readonly type="text" class="form-control users-input-S-C"
                                                placeholder="Rev.." />
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group mb-0">
                                            <label class="Label-00">
                                                Total of Revenue.
                                            </label>
                                            <input readonly type="text" class="form-control users-input-S-C"
                                                placeholder="Rev.." />
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group mb-0">
                                            <label class="Label-00">
                                                Number of Rejected:
                                            </label>
                                            <input readonly type="text" class="form-control users-input-S-C" id="rejected"
                                                placeholder="total.." />
                                        </div>
                                    </div>
                                </div>
                                <!-- </div> -->
                            </fieldset>
                        </form>
                    </div>
                </div>
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
        $(document).ready(function() {
            load_datatable()
        });
        $('#sifted').val({!! $sifted !!});
        $('#endo').val({!! $endo !!});
        $('#foundRecord').val({!! $onBoarded !!});
        $('#active').val({!! $active !!});
        $('#spr').val({!! $spr !!});
        $('#onBoarded').val({!! $onBoarded !!});
        $('#accepted').val({!! $accepted !!});
        $('#failed').val({!! $failed !!});
        $('#withdrawn').val({!! $withdrawn !!});
        $('#rejected').val({!! $rejected !!});
        select2Dropdown("select2_dropdown");

        // funciton for filtering the data according to selected input starts
        function FilterSearch() {
            $("#loader").show();

            // get values of selected inputs of users
            domain = $('#domain').val();
            recruiter = $('#recruiter').val();
            client = $('#client').val();
            residence = $('#residence').val();
            career_level = $('#career_level').val();
            category = $('#category').val();
            status = $('#status').val();
            remarks = $('#remarks').val();
            sift_start = $('#Shifted_start').val();
            sift_end = $('#Shifted_end').val();
            ob_start = $('#ob_start').val();
            ob_end = $('#ob_end').val();
            endo_start = $('#endo_start').val();
            endo_end = $('#endo_end').val();
            searchKeyword = $('#searchKeyword').val();
            if ($('#cip').is(':checked')) {
                cip = 1;
            } else {
                cip = 0;
            }
            // call Ajax for returning the data as view
            $.ajax({
                type: "GET",
                url: '{{ url('admin/filter_search') }}',
                data: {
                    _token: token,
                    domain: domain,
                    recruiter: recruiter,
                    client: client,
                    residence: residence,
                    career_level: career_level,
                    cip: cip,
                    category: category,
                    status: status,
                    remarks: remarks,
                    endo_start: endo_start,
                    endo_end: endo_end,
                    ob_start: ob_start,
                    ob_end: ob_end,
                    sift_start: sift_start,
                    sift_end: sift_end,
                    searchKeyword: searchKeyword,
                },

                // Success fucniton of Ajax
                success: function(data) {
                    console.log(data)
                    $('#filterResult_div').html(data);
                    $("#loader").hide();
                },
            });
        }
        // funciton for filtering the data according to selected input ends
    </script>

@endsection
