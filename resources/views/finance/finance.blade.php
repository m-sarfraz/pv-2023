@extends('layouts.app')

@section('style')
    <!-- ================= -->
    <!-- Datatable css start-->
    <link rel="stylesheet" href="{{ asset('assets/css/jquery.dataTables.min.css') }}" />

    <!-- Datatable css end-->
    <!-- ================= -->
    <style>
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
            <div class="col-lg-6">
                <p class="C-Heading pt-3">Record Finder:</p>
                <div class="card mb-13">
                    <div class="card-body">
                        <form action="">
                            <div class="row mb-4">
                                <div class="col-lg-6">
                                    <div class="form-group mb-0">
                                        <label class="d-block font-size-3 mb-0">
                                            Search (keyword):
                                        </label>
                                        <input type="text" name="REF_CODE" placeholder="search keyword" required=""
                                            class="form-control h-px-20_custom border" value="" />
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group mb-0">
                                        <label class="d-block font-size-3 mb-0">
                                            # of Records Found:
                                        </label>
                                        <input type="text" name="REF_CODE" value="" disabled="" required=""
                                            class="form-control h-px-20_custom border" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group mb-0">
                                        <p class="mb-0 mt-2">Filter by:</p>
                                        <!-- <label class="Label">Recruiter</label> -->
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-1 align-items-center">
                                <div class="col-lg-6">
                                    <div class="form-group mb-0">
                                        <label class="Label">Recruiter</label>
                                        <select multiple name="" id="recruiter" class="w-100 form-control select2_dropdown"
                                            onchange="filterUserData()">
                                            <option value="" disabled selected>Select Option</option>
                                            @foreach ($user as $key => $user)
                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group mb-0 pt-0 pt-lg-1 pt-sm-0 ">
                                        <label class="d-block font-size-3 mb-0">
                                            Canidate
                                        </label>
                                        <select multiple name="" id="candidate" class="w-100 form-control select2_dropdown"
                                            onchange="filterUserData()">
                                            <option value="" disabled selected>Select Option</option>
                                            @foreach ($candidates as $key => $candidate)
                                                <option value="{{ $candidate->cid }}">
                                                    {{ $candidate->first_name }}{{ $candidate->last_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-1">
                                <div class="col-lg-4">
                                    <div class="form-group mb-0">
                                        <label class="d-block font-size-3 mb-0">
                                            Remarks
                                        </label>
                                        <select multiple name="" id="remarks" class="w-100 form-control select2_dropdown"
                                            onchange="filterUserData()">
                                            <option value="Offer accepted">Offer Accepted</option>
                                            <option value="Onboarded">Onboarded</option>
                                            <option value="Fallout">fallout</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group mb-0">
                                        <label class="d-block font-size-3 mb-0">
                                            Team
                                        </label>
                                        <select name="" id="team" class="w-100 form-control select2_dropdown" onchange="filterUserData()">
                                            <option value="1">One</option>
                                            <option value="2">Two</option>
                                            <option value="3">Three</option>
                                            <option value="4">Four</option>
                                            <option value="5">Five</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group mb-0">
                                        <label class="d-block font-size-3 mb-0">
                                            From (OB Date:)
                                        </label>
                                        <input type="date" class="w-100 form-control" id="ob_date" onchange="filterUserData()">
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-1">
                                <div class="col-lg-8">
                                    <div class="form-group mb-0">
                                        <label class="d-block font-size-3 mb-0">
                                            Reprocess:
                                        </label>
                                        <select name="" id="process" class="w-100 form-control select2_dropdown" onchange="filterUserData()">
                                            <option value="1">One</option>
                                            <option value="2">Two</option>
                                            <option value="3">Three</option>
                                            <option value="4">Four</option>
                                            <option value="5">Five</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group mb-0">
                                        @php
                                        $client = Helper::get_dropdown('clients');
                                    @endphp
                                        <label class="d-block font-size-3 mb-0">
                                            Client:
                                        </label>
                                        <select multiple name="" id="client" class="w-100 form-control select2_dropdown" onchange="filterUserData()">
                                            <option value="" disabled selected>Select Option</option>
                                            @foreach ($client->options as $clientOptions)
                                                <option value="{{ $clientOptions->option_name }}">
                                                    {{ $clientOptions->option_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-1 align-items-center">
                                <div class="col-lg-8">
                                    <div class="form-group mb-0 pt-lg-1 pt-m-0 pt-0">
                                        <label class="d-block font-size-3 mb-0">
                                            Process Status:
                                        </label>
                                        <select name="" id="status" class="w-100 form-control select2_dropdown" onchange="filterUserData()">
                                            <option value="1">One</option>
                                            <option value="2">Two</option>
                                            <option value="3">Three</option>
                                            <option value="4">Four</option>
                                            <option value="5">Five</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group mb-0">
                                        <label class="Label">To (OB Date:)</label>
                                        <input type="date" class="w-100 form-control" id="to_ob_date" onchange="filterUserData()">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- ================= -->
                <!-- Datatable code start-->
                <div class="table-responsive border-right pt-3" id="filterData_div">
                    <div class="">
                        <table id=" example1" class="table">
                        <thead class="bg-light w-100">
                            <tr style="border-bottom: 3px solid white;border-top: 3px solid white; white-space:nowrap">
                                <th class="ant-table-cell">Team</th>
                                <th class="ant-table-cell">Recruiter</th>
                                <th class="ant-table-cell">Reprocess</th>
                                <th class="ant-table-cell">Candidate</th>
                                <th class="ant-table-cell">Role</th>
                                <th class="ant-table-cell">CL</th>
                                <th class="ant-table-cell">Client</th>
                                <th class="ant-table-cell">OB Date</th>
                                <th class="ant-table-cell">Placement Fee</th>
                                <th class="ant-table-cell">Remarks</th>
                                <th class="ant-table-cell">P.Status</th>
                                <th class="ant-table-cell ant-table-cell-scrollbar"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ( $Userdata as $key=>$value )
                                <tr class="bg-transparent" onclick="teamDetail('{{ $value->C_id }}')">
                                    <!-- Table data 1 -->
                                    @php
                                        $user = \App\User::where('id', $value->saved_by)->first();
                                        $role = $user->roles->pluck('name');
                                    @endphp
                                    <td> {{ $role[0] }}</td>
                                    @php
                                        $name = \App\User::with('candidate_information')
                                            ->where('id', $value->saved_by)
                                            ->first();
                                    @endphp
                                    <td>{{ $name->name }}</td>
                                    <td></td>
                                    <td>
                                        @if (isset($value->first_name))
                                            {{ $value->first_name }} {{ $value->last_name }}

                                        @endif
                                    </td>
                                    <td> {{ $role[0] }}</td>
                                    <td>{{ $value->career_endo }}</td>
                                    <td>{{ $value->client }}</td>
                                    <td>
                                        @if (isset($value->endi_date))
                                            {{ $value->endi_date }}

                                        @endif
                                    </td>
                                    <td>
                                        @if (isset($value->placement_fee))
                                            {{ $value->placement_fee }}

                                        @endif
                                    </td>
                                    <td>
                                        @if (isset($value->remarks))
                                            {{ $value->remarks }}

                                        @endif
                                    </td>
                                    <td>
                                        @if (isset($value->app_status))
                                            {{ $value->app_status }}

                                        @endif
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
            <div class="col-lg-6" id="detail_div">
                <p class="C-Heading pt-3">Summary:</p>
                <div class="card mb-13">
                    <div class="card-body">
                        <form action="">
                            <fieldset disabled="">
                                <div class="row mb-1">
                                    <div class="col-lg-3">
                                        <div class="form-group mb-0">
                                            <label class="Label">
                                                # of Hires:
                                            </label>
                                            <input type="text" class="form-control users-input-S-C" placeholder="hires.." />
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group mb-0">
                                            <label class="Label">
                                                Comp. Revenue:
                                            </label>
                                            <input type="text" class="form-control users-input-S-C" placeholder="Rev.." />
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group mb-0">
                                            <label class="Label">
                                                Rev. in Incentive:
                                            </label>
                                            <input type="text" class="form-control users-input-S-C" placeholder="Rev.." />
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group mb-0">
                                            <label class="Label">
                                                Total Recievables:
                                            </label>
                                            <input type="text" class="form-control users-input-S-C" placeholder="total.." />
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-1">
                                    <div class="col-lg-3">
                                        <div class="form-group mb-0">
                                            <label class="Label">
                                                # of Billed:
                                            </label>
                                            <input type="text" class="form-control users-input-S-C"
                                                placeholder="hires.." />
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group mb-0">
                                            <label class="Label">
                                                Billed Amount:
                                            </label>
                                            <input type="text" class="form-control users-input-S-C" placeholder="Rev.." />
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group mb-0">
                                            <label class="Label">
                                                BOD (less share):
                                            </label>
                                            <input type="text" class="form-control users-input-S-C" placeholder="Rev.." />
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group mb-0">
                                            <label class="Label">
                                                Current Rcvbls:
                                            </label>
                                            <input type="text" class="form-control users-input-S-C"
                                                placeholder="total.." />
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-1">
                                    <div class="col-lg-3">
                                        <div class="form-group mb-0">
                                            <label class="Label">
                                                # of Unbilled:
                                            </label>
                                            <input type="text" class="form-control users-input-S-C"
                                                placeholder="hires.." />
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group mb-0">
                                            <label class="Label">
                                                Unbilled Amnt:
                                            </label>
                                            <input type="text" class="form-control users-input-S-C" placeholder="Rev.." />
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group mb-0">
                                            <label class="Label">
                                                BOD Share:
                                            </label>
                                            <input type="text" class="form-control users-input-S-C" placeholder="Rev.." />
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group mb-0">
                                            <label class="Label">
                                                Overdue Rcvbles:
                                            </label>
                                            <input type="text" class="form-control users-input-S-C"
                                                placeholder="total.." />
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-1">
                                    <div class="col-lg-3">
                                        <div class="form-group mb-0">
                                            <label class="Label">
                                                # of Fallout:
                                            </label>
                                            <input type="text" class="form-control users-input-S-C"
                                                placeholder="hires.." />
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group mb-0">
                                            <label class="Label">
                                                Fallout Amnt:
                                            </label>
                                            <input type="text" class="form-control users-input-S-C" placeholder="Rev.." />
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group mb-0">
                                            <label class="Label">
                                                Cnslts Share:
                                            </label>
                                            <input type="text" class="form-control users-input-S-C" placeholder="Rev.." />
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group mb-0">
                                            <label class="Label">
                                                Cnstls Take:
                                            </label>
                                            <input type="text" class="form-control users-input-S-C"
                                                placeholder="total.." />
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
                <div id="detailView">
                    <p class="C-Heading pt-3">Endorsement Details:</p>
                    <div class="card mb-13">
                        <div class="card-body">
                            <form action="">
                                <fieldset disabled="">
                                    <div class="row mb-1 ">
                                        <div class="col-lg-4">
                                            <div class="form-group mb-0">
                                                <label class="Label">
                                                    Recruiter:
                                                </label>
                                                <input type="text" class="form-control users-input-S-C"
                                                    placeholder="hires.." />
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group mb-0">
                                                <label class="Label">
                                                    Crrnt Level:
                                                </label>
                                                <input type="text" class="form-control users-input-S-C"
                                                    placeholder="Rev.." />
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group mb-0">
                                                <label class="Label">
                                                    Onboarding Date:
                                                </label>
                                                <input type="text" class="form-control users-input-S-C"
                                                    placeholder="Rev.." />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-1">
                                        <div class="col-lg-4">
                                            <div class="form-group mb-0">
                                                <label class="Label">
                                                    Client:
                                                </label>
                                                <input type="text" class="form-control users-input-S-C"
                                                    placeholder="hires.." />
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group mb-0">
                                                <label class="Label">
                                                    Domain:
                                                </label>
                                                <input type="text" class="form-control users-input-S-C"
                                                    placeholder="Rev.." />
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group mb-0">
                                                <label class="Label">
                                                    Remarks (For Finance):
                                                </label>
                                                <input type="text" class="form-control users-input-S-C"
                                                    placeholder="Rev.." />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-1">
                                        <div class="col-lg-6">
                                            <div class="form-group mb-0">
                                                <label class="Label">
                                                    Site:
                                                </label>
                                                <input type="text" class="form-control users-input-S-C"
                                                    placeholder="hires.." />
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group mb-0">
                                                <label class="Label">
                                                    Position Title:
                                                </label>
                                                <input type="text" class="form-control users-input-S-C"
                                                    placeholder="Rev.." />
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                    <p class="C-Heading pt-3">Finance Reference:</p>
                    <div class="card mb-13">
                        <div class="card-body">
                            <form action="">
                                <fieldset>
                                    <div class="row mb-1">
                                        <div class="col-lg-3 p-1">
                                            <div class="form-group mb-0">
                                                <label class="Label-00">
                                                    Remarks:
                                                </label>
                                                <select name="" id="" class="w-100 form-control">
                                                    <option value="1">Billed</option>
                                                    <option value="2">Two</option>
                                                    <option value="3">Three</option>
                                                    <option value="4">Four</option>
                                                    <option value="5">Five</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 p-1">
                                            <div class="form-group mb-0">
                                                <label class="Label-00">
                                                    Onbrd dat:
                                                </label>
                                                <input type="date" class="w-100 form-control users-input-S-C" />
                                            </div>
                                        </div>
                                        <div class="col-lg-2 p-1">
                                            <div class="form-group mb-0">
                                                <label class="Label-00">
                                                    Trmi date:
                                                </label>
                                                <input type="date" class="w-100 form-control users-input-S-C" />
                                            </div>
                                        </div>
                                        <div class="col-lg-2 p-1">
                                            <div class="form-group mb-0">
                                                <label class="Label-00">
                                                    Code:
                                                </label>
                                                <input type="text" class="form-control users-input-S-C"
                                                    placeholder="total.." />
                                            </div>
                                        </div>
                                        <div class="col-lg-3 p-1">
                                            <div class="form-group mb-0">
                                                <label class="Label-00">
                                                    Payment terms:
                                                </label>
                                                <input type="text" class="form-control users-input-S-C"
                                                    placeholder="total.." />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-1">
                                        <div class="col-lg-3 p-1">
                                            <div class="form-group mb-0">
                                                <label class="Label-00">
                                                    Offered Salary:
                                                </label>
                                                <input type="text" class="form-control users-input-S-C"
                                                    placeholder="hires.." disabled />
                                            </div>
                                        </div>
                                        <div class="col-lg-3 p-1">
                                            <div class="form-group mb-0">
                                                <label class="Label-00">
                                                    Replmnt For:
                                                </label>
                                                <input type="text" class="form-control users-input-S-C"
                                                    placeholder="Rev.." />
                                            </div>
                                        </div>
                                        <div class="col-lg-3 p-1">
                                            <div class="form-group mb-0">
                                                <label class="Label-00">
                                                    Date Delvrd:
                                                </label>
                                                <input type="date" class="w-100 users-input-S-C form-control"
                                                    placeholder="Rev.." />
                                            </div>
                                        </div>
                                        <div class="col-lg-3 p-1">
                                            <div class="form-group mb-0">
                                                <label class="Label-00">
                                                    Process Status:
                                                </label>
                                                <input type="text" class="form-control users-input-S-C"
                                                    placeholder="total.." />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-1">
                                        <div class="col-lg-3 p-1">
                                            <div class="form-group mb-0">
                                                <label class="Label-00">
                                                    Allowance:
                                                </label>
                                                <input type="text" class="form-control users-input-S-C"
                                                    placeholder="hires.." disabled />
                                            </div>
                                        </div>
                                        <div class="col-lg-2 p-1">
                                            <div class="form-group mb-0">
                                                <label class="Label-00">
                                                    VAT (%):
                                                </label>
                                                <input type="text" class="form-control users-input-S-C"
                                                    placeholder="Rev.." />
                                            </div>
                                        </div>
                                        <div class="col-lg-3 p-1">
                                            <div class="form-group mb-0">
                                                <label class="Label-00">
                                                    Credit Memo:
                                                </label>
                                                <input type="text" class="form-control users-input-S-C"
                                                    placeholder="Rev.." />
                                            </div>
                                        </div>
                                        <div class="col-lg-2 p-1">
                                            <div class="form-group mb-0">
                                                <label class="Label-00">
                                                    Invc No.
                                                </label>
                                                <input type="text" class="form-control users-input-S-C"
                                                    placeholder="total.." />
                                            </div>
                                        </div>
                                        <div class="col-lg-2 p-1">
                                            <div class="form-group mb-0">
                                                <label class="Label-00">
                                                    Invc date:
                                                </label>
                                                <input type="date" class="w-100 form-control users-input-S-C"
                                                    placeholder="hires.." />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-1">
                                        <div class="col-lg-3 p-1">
                                            <div class="form-group mb-0">
                                                <label class="Label-00">
                                                    Special Compstn:
                                                </label>
                                                <input type="text" class="form-control users-input-S-C"
                                                    placeholder="hires.." />
                                            </div>
                                        </div>
                                        <div class="col-lg-2 p-1">
                                            <div class="form-group mb-0">
                                                <label class="Label-00">
                                                    Rate (%):
                                                </label>
                                                <input type="text" class="form-control users-input-S-C"
                                                    placeholder="Rev.." />
                                            </div>
                                        </div>
                                        <div class="col-lg-3 p-1">
                                            <div class="form-group mb-0">
                                                <label class="Label-00">
                                                    Placmnt fee:
                                                </label>
                                                <input type="text" class="form-control users-input-S-C" placeholder="Rev.."
                                                    disabled />
                                            </div>
                                        </div>
                                        <div class="col-lg-2 p-1">
                                            <div class="form-group mb-0">
                                                <label class="Label-00">
                                                    OR No.
                                                </label>
                                                <input type="text" class="form-control users-input-S-C"
                                                    placeholder="total.." />
                                            </div>
                                        </div>
                                        <div class="col-lg-2 p-1">
                                            <div class="form-group mb-0">
                                                <label class="Label-00">
                                                    Date Colctd.
                                                </label>
                                                <input type="date" class="w-100 form-control users-input-S-C" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-1">
                                        <div class="col-lg-3 p-1">
                                            <div class="form-group mb-0">
                                                <label class="Label-00">
                                                    Reprocess:
                                                </label>
                                                <input type="text" class="form-control users-input-S-C"
                                                    placeholder="hires.." disabled />
                                            </div>
                                        </div>
                                        <div class="col-lg-2 p-1">
                                            <div class="form-group mb-0">
                                                <label class="Label-00">
                                                    R.Share(%):
                                                </label>
                                                <input type="text" class="form-control users-input-S-C"
                                                    placeholder="Rev.." />
                                            </div>
                                        </div>
                                        <div class="col-lg-3 p-1">
                                            <div class="form-group mb-0">
                                                <label class="Label-00">
                                                    Reprcs Share Amt.
                                                </label>
                                                <input type="text" class="form-control users-input-S-C" placeholder="Rev.."
                                                    disabled />
                                            </div>
                                        </div>
                                        <div class="col-lg-2 p-1">
                                            <div class="form-group mb-0">
                                                <label class="Label-00">
                                                    VCC Share(%):
                                                </label>
                                                <input type="text" class="form-control users-input-S-C"
                                                    placeholder="total.." />
                                            </div>
                                        </div>
                                        <div class="col-lg-2 p-1">
                                            <div class="form-group mb-0">
                                                <label class="Label-00">
                                                    VSA:
                                                </label>
                                                <input type="text" class="w-100 form-control users-input-S-C" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-1">
                                        <div class="col-lg-3 p-1">
                                            <div class="form-group mb-0">
                                                <label class="Label-00">
                                                    Final Fee:
                                                </label>
                                                <input type="text" class="form-control users-input-S-C"
                                                    placeholder="hires.." disabled />
                                            </div>
                                        </div>
                                        <div class="col-lg-2 p-1">
                                            <div class="form-group mb-0">
                                                <label class="Label-00">
                                                    O.Share(%):
                                                </label>
                                                <input type="text" class="form-control users-input-S-C" placeholder="Rev.."
                                                    disabled />
                                            </div>
                                        </div>
                                        <div class="col-lg-3 p-1">
                                            <div class="form-group mb-0">
                                                <label class="Label-00">
                                                    Ownr Shr Amnt.
                                                </label>
                                                <input type="text" class="form-control users-input-S-C" placeholder="Rev.."
                                                    disabled />
                                            </div>
                                        </div>
                                        <div class="col-lg-2 p-1">
                                            <div class="form-group mb-0">
                                                <label class="Label-00">
                                                    C.Take(%):
                                                </label>
                                                <input type="text" class="form-control users-input-S-C"
                                                    placeholder="total.." />
                                            </div>
                                        </div>
                                        <div class="col-lg-2 p-1">
                                            <div class="form-group mb-0">
                                                <label class="Label-00">
                                                    C.Take Amnt.
                                                </label>
                                                <input type="text" class="form-control users-input-S-C" disabled />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-1">
                                        <div class="col-lg-3 p-1">
                                            <div class="form-group mb-0">
                                                <label class="Label-00">
                                                    Adjustment:
                                                </label>
                                                <input type="text" class="form-control users-input-S-C"
                                                    placeholder="hires.." />
                                            </div>
                                        </div>
                                        <div class="col-lg-4 p-1">
                                            <div class="form-group mb-0">
                                                <label class="Label-00">
                                                    Individual Revenue:
                                                </label>
                                                <input type="text" class="form-control users-input-S-C"
                                                    placeholder="Rev.." />
                                            </div>
                                        </div>
                                        <div class="col-lg-2 p-1">
                                            <div class="form-group mb-0">
                                                <label class="Label-00">

                                                </label>
                                                <button
                                                    class="font-size-small w-100 border-0 btn-00 users-input-S-C "><small>Update</small></button>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div style="height: 30px;"></div>

@endsection

{{-- script section starts here --}}
@section('script')

    <script>
        // Section for docement ready funciton starts
        $(document).ready(function() {
            select2Dropdown("select2_dropdown");
            // $('#candidate').empty();
            // show and hide loader after time set starts
            $('#loader').show();
            setTimeout(function() {
                $('#loader').hide();
            }, 1000);
            // show and hide loader after time set ends

        });
        // Section for docement ready funciton starts
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
            });
        });

        // funciton for getting detail of user starts 
        function teamDetail(id) {
            // call Ajax whihc will return view of detail data of user
            $.ajax({
                type: "GET",
                url: '{{ url('admin/finance_records_detail') }}',
                data: {
                    _token: token,
                    id: id,
                },

                // Ajax Success funciton
                success: function(data) {
                    // append retured view view to div 
                    $('#detailView').html('');
                    $('#detailView').html(data);

                    // hide loader 
                    $("#loader").hide();
                },
            });
        }
        // function closed 

        // funciton for filtering the data according to selected input starts
        function filterUserData() {
            // $("#loader").show();

            // get values of selected inputs of users
            recruiter = $('#recruiter').val();
            candidate = $('#candidate').val();
            remarks = $('#remarks').val();
            team = $('#team').val();
            status = $('#status').val();
            toDate = $('#to_ob_date').val();
            ob_date = $('#ob_date').val();
            client = $('#client').val();
            process = $('#process').val();

            // call Ajax for returning the data as view
            $.ajax({
                type: "GET",
                url: '{{ url('admin/filter_records_finance') }}',
                data: {
                    _token: token,
                    recruiter: recruiter,
                    candidate: candidate,
                    remarks: remarks,
                    toDate: toDate,
                    team: team,
                    status: status,
                    client: client,
                    ob_date: ob_date,
                    process: process,
                },

                // Success fucniton of Ajax
                success: function(data) {
                    $('#filterData_div').html(data);
                    // $('#count').val(data.count);
                    // $("#loader").hide();
                    // appennd count value coming from hidden input of appended view to count
                    // recordCount = $('#abc').val()
                    // $('#recordNumber').val(recordCount)
                },
            });
        }
        // funciton for filtering the data according to selected input ends
    </script>
@endsection
{{-- script seciton ends here --}}
