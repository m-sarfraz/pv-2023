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

        .hideID:first-child,
        .hidetrID tr td:first-child {
            display: none !important;
        }

        .hidetrID tr:hover {
            background-color: rgb(159, 165, 243);
        }

        #fmtable_filter {
            visibility: hidden;
        }

        #fmtable1_filter {
            visibility: hidden;
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
                                        <input type="text" name="searchKeyword" id="searchKeyword"
                                            placeholder="search keyword" required=""
                                            class="form-control h-px-20_custom border" />
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group mb-0">
                                        <label class="d-block font-size-3 mb-0">
                                            Number Of Records Found:
                                        </label>
                                        <input type="text" name="REF_CODE" value="" disabled="" required="" id="record"
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
                                        <select multiple name="recruiter" id="recruiter"
                                            class="w-100 form-control select2_dropdown" onchange="filterUserData()">
                                            @foreach ($recruiter as $key => $user)
                                                <option value="{{ $user->id }}">
                                                    {{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group mb-0 pt-0 pt-lg-1 pt-sm-0 ">
                                        <label class="d-block font-size-3 mb-0">
                                            Candidate List:
                                        </label>
                                        <select multiple name="" id="candidate" class="w-100 form-control select2_dropdown"
                                            onchange="filterUserData()">
                                            @foreach ($candidates as $key => $candidate)
                                                <option value="{{ $candidate->cid }}">
                                                    {{ $candidate->last_name }}</option>
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
                                        <select multiple name="remarks" id="remarks"
                                            class="w-100 form-control select2_dropdown" onchange="filterUserData()">
                                            <option disabled>Select Option</option>
                                            @foreach ($remarks_finance as $remarks)
                                                <option value="{{ $remarks->remarks_for_finance }}">
                                                    {{ $remarks->remarks_for_finance }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group mb-0">
                                        <label class="d-block font-size-3 mb-0">
                                            Team
                                        </label>
                                        <select multiple name="team_id" id="team_id"
                                            class="w-100 form-control select2_dropdown" onchange="filterUserData()">
                                            <option disabaled> select option </option>
                                            @foreach ($teams as $team)
                                                <option value="{{ $team->name }}">{{ $team->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group mb-0">
                                        <label class="d-block font-size-3 mb-0">
                                            From (OB Date:)
                                        </label>
                                        <input type="date" class="w-100 form-control" id="ob_date"
                                            onchange="filterUserData()">
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-1">
                                <div class="col-lg-4">
                                    <div class="form-group mb-0">
                                        <label class="d-block font-size-3 mb-0">
                                            Reprocess:
                                        </label>
                                        <select multiple name="process" id="process"
                                            class="w-100 form-control select2_dropdown" onchange="filterUserData()">
                                            <option disabaled> select option </option>
                                            @foreach ($candidates as $reprocess)
                                                <option value="{{ $reprocess->reprocess }}">
                                                    {{ $reprocess->reprocess }}
                                                </option>
                                            @endforeach
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
                                        <select multiple name="" id="client" class="w-100 form-control select2_dropdown"
                                            onchange="filterUserData()">
                                            <option value="" disabled>Select Option</option>
                                            @foreach ($client->options as $clientOptions)
                                                <option value="{{ $clientOptions->option_name }}">
                                                    {{ $clientOptions->option_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group mb-0">
                                        <label class="Label">To (OB Date:)</label>
                                        <input type="date" class="w-100 form-control" id="to_ob_date"
                                            onchange="filterUserData()">
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-1 align-items-center">
                                <div class="col-lg-8">
                                    <div class="form-group mb-0 pt-lg-1 pt-m-0 pt-0">
                                        <label class="d-block font-size-3 mb-0">
                                            Process Status:
                                        </label>
                                        <select multiple name="appstatus" id="appstatus"
                                            class="w-100 form-control select2_dropdown" onchange="filterUserData()">
                                            <option disabaled> select option </option>
                                            @foreach ($appstatus as $appstatuss)
                                                <option value="{{ $appstatuss->app_status }}">
                                                    {{ $appstatuss->app_status }}</option>
                                            @endforeach

                                        </select>
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
                        <table id="fmtable" class="table">
                            <thead class="bg-light w-100">
                                <tr style="border-bottom: 3px solid white;border-top: 3px solid white; white-space:nowrap">
                                    <th class="ant-table-cell hideID">id</th>
                                    <th class="ant-table-cell">Team</th>
                                    <th class="ant-table-cell">Recruiter</th>
                                    <th class="ant-table-cell">Client</th>
                                    <th class="ant-table-cell">Reprocess</th>
                                    <th class="ant-table-cell">Candidate</th>
                                    <th class="ant-table-cell">CL</th>
                                    <th class="ant-table-cell">OB Date</th>
                                    <th class="ant-table-cell">Placement Fee</th>
                                    <th class="ant-table-cell">Remarks</th>
                                    <th class="ant-table-cell">P.Status</th>
                                    <th class="ant-table-cell ant-table-cell-scrollbar"></th>
                                </tr>
                            </thead>
                            <tbody class="hidetrID" style="height:100px"> </tbody>
                        </table>
                    </div>


                </div>
                <!-- Datatable code end-->
                <!-- ================= -->


            </div>
            <div class="col-lg-6" id="detail_div">
                <p class="C-Heading pt-3">Summary:</p>
                <div class="card mb-13" id="summaryDiv">
                    <div class="card-body">
                        <form action="">
                            <fieldset disabled="">
                                <div class="row mb-1">
                                    <div class="col-lg-3">
                                        <div class="form-group mb-0">
                                            <label class="Label">
                                                Number of Hires:
                                            </label>
                                            <input type="text" class="form-control users-input-S-C" placeholder="hires.."
                                                id="hires" />
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group mb-0">
                                            <label class="Label">
                                                Computed Revenue:
                                            </label>
                                            <input type="text" class="form-control users-input-S-C" placeholder="Rev.."
                                                id="revenue" />
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group mb-0">
                                            <label class="Label">
                                                Revenue In Incentive:
                                            </label>
                                            <input type="text" id="Revenue_In_Incentive"
                                                class="form-control users-input-S-C" placeholder="Rev.." />
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group mb-0">
                                            <label class="Label">
                                                Total Receivables:
                                            </label>
                                            <input type="text" class="form-control users-input-S-C" placeholder="total.." />
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-1">
                                    <div class="col-lg-3">
                                        <div class="form-group mb-0">
                                            <label class="Label">
                                                Number Of Billed:
                                            </label>
                                            <input type="text" class="form-control users-input-S-C" id="billed"
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
                                            <input type="text" id="vcc_share" class="form-control users-input-S-C"
                                                placeholder="Rev.." />
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group mb-0">
                                            <label class="Label">
                                                Current Receivables:
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
                                                Number Of Unbilled:
                                            </label>
                                            <input type="text" class="form-control users-input-S-C" id="unbilled"
                                                placeholder="hires.." />
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group mb-0">
                                            <label class="Label">
                                                Unbilled Amount:
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
                                                Overdue Receivables:
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
                                                Number of Fallout:
                                            </label>
                                            <input type="text" class="form-control users-input-S-C" id="fallout"
                                                placeholder="hires.." />
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group mb-0">
                                            <label class="Label">
                                                Fallout Amount:
                                            </label>
                                            <input type="text" class="form-control users-input-S-C" placeholder="Rev.." />
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group mb-0">
                                            <label class="Label">
                                                Consultants Share:
                                            </label>
                                            <input type="text" id="c_take" class="form-control users-input-S-C"
                                                placeholder="Rev.." />
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group mb-0">
                                            <label class="Label">
                                                Consultants Take:
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
                                                    Current Level:
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
                                                    Onboarding Date:
                                                </label>
                                                <input type="date" class="w-100 form-control users-input-S-C" />
                                            </div>
                                        </div>
                                        <div class="col-lg-2 p-1">
                                            <div class="form-group mb-0">
                                                <label class="Label-00">
                                                    Training date:
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
                                                    Replacement Date:
                                                </label>
                                                <input type="text" class="form-control users-input-S-C"
                                                    placeholder="Rev.." />
                                            </div>
                                        </div>
                                        <div class="col-lg-3 p-1">
                                            <div class="form-group mb-0">
                                                <label class="Label-00">
                                                    Date Delivered:
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
                                                    Invoice Number:
                                                </label>
                                                <input type="text" class="form-control users-input-S-C"
                                                    placeholder="total.." />
                                            </div>
                                        </div>
                                        <div class="col-lg-2 p-1">
                                            <div class="form-group mb-0">
                                                <label class="Label-00">
                                                    Invoice Date:
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
                                                    Special consumption:
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
                                                    Placement Fee:
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
                                                    Date Collected:
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
                                                    Reprocess Share Amount:
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
                                                    Owner Share Amount:
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
                                                    C. Take Amount:
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
            load_datatable()
            select2Dropdown("select2_dropdown");
            // show and hide loader after time set starts
            $('#loader').show();
            setTimeout(function() {
                $('#loader').hide();
            }, 1000);
            // show and hide loader after time set ends
            // call for summary append 
            appendSummary()
            // close 
        });
        // close 

        // ajax call for sumary append on documnet ready 
        function appendSummary() {
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
                url: '{{ url('admin/summaryAppend_finance') }}',
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
                    $('#summaryDiv').html('');
                    $('#summaryDiv').html(data);
                }
            });
        }
        //close
        // show detail of record on click a row in data table 
        $('#fmtable').on('click', 'tbody tr', function() {
            // $(this).css('background-color','red')
            $('tr').removeClass('hover-primary1');
            $(this).addClass('hover-primary1');
            let tdVal = $(this).children()[0];
            var id = tdVal.innerHTML
            console.log('id is ' + id)
            userDetail(this, id)
        })
        // close 

        // function for loading data in yajra on page load 
        function load_datatable() {
            var option_table = $('#fmtable').DataTable({
                destroy: true,
                processing: true,
                serverSide: true,
                "language": {
                    processing: '<div class="spinner-border mr-3" role="status"> </div><span>Processing ...</span>'
                },

                ajax: {
                    url: "{{ route('view-finance-search-table') }}",
                    type: "GET",
                },
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'team',
                        name: 'team'
                    },
                    {
                        data: 'recruiter',
                        name: 'recruiter'
                    },
                    {
                        data: 'client',
                        name: 'client'
                    },
                    {
                        data: 'reprocess',
                        name: 'reprocess'
                    },
                    {
                        data: 'last_name',
                        name: 'last_name'
                    },


                    {
                        data: 'career_endo',
                        name: 'career_endo'
                    },
                    {
                        data: 'onboardnig_date',
                        name: 'onboardnig_date'
                    },
                    {
                        data: 'placement_fee',
                        name: 'placement_fee'
                    },
                    {
                        data: 'remarks_for_finance',
                        name: 'remarks_for_finance'
                    },

                    {
                        data: 'app_status',
                        name: 'app_status'
                    },



                ]
            });
        }
        // close 
        function load_datatable1() {
            // get values of selected inputs of users
            searchKeyword = $('#searchKeyword').val();
            recruiter = $('#recruiter').val();
            appstatus = $('#appstatus').val();
            team_id = $('#team_id').val();
            candidate = $('#candidate').val();
            remarks = $('#remarks').val();
            team = $('#team').val();
            // status = $('#status').val();
            toDate = $('#to_ob_date').val();
            ob_date = $('#ob_date').val();
            client = $('#client').val();
            process = $('#process').val();
            ob_date = $('#ob_date').val();
            var option_table = $('#fmtable1').DataTable({
                destroy: true,
                processing: true,
                serverSide: true,
                "language": {
                    processing: '<div class="spinner-border mr-3" role="status"> </div><span>Processing ...</span>'
                },

                ajax: {
                    url: "{{ route('financeRecordFilter') }}",
                    type: "POST",
                    data: {
                        _token: token,
                        // searchKeyword: searchKeyword,
                        recruiter: recruiter,
                        candidate: candidate,
                        remarks: remarks,
                        toDate: toDate,
                        ob_date: ob_date,
                        team: team,
                        status: status,
                        client: client,
                        appstatus: appstatus,
                        team_id: team_id,
                        process: process,
                    },
                },
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'team',
                        name: 'team'
                    },
                    {
                        data: 'recruiter',
                        name: 'recruiter'
                    },
                    {
                        data: 'client',
                        name: 'client'
                    },
                    {
                        data: 'reprocess',
                        name: 'reprocess'
                    },
                    {
                        data: 'last_name',
                        name: 'last_name'
                    },


                    {
                        data: 'career_endo',
                        name: 'career_endo'
                    },
                    {
                        data: 'onboardnig_date',
                        name: 'onboardnig_date'
                    },
                    {
                        data: 'placement_fee',
                        name: 'placement_fee'
                    },
                    {
                        data: 'remarks_for_finance',
                        name: 'remarks_for_finance'
                    },

                    {
                        data: 'app_status',
                        name: 'app_status'
                    },


                ]
            });
        }
        // function for getting detail of user starts 
        function userDetail(elem, id) {
            $('#loader').show();
            $('.common-tr').removeClass('hover-primary1');
            $(elem).addClass('hover-primary1');
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
        // close

        // function for filtering the data according to selected input starts
        function filterUserData() {
            $("#loader").show();
            // call Ajax for returning the data as view
            $.ajax({
                type: "GET",
                url: '{{ url('admin/filterView') }}',
                success: function(data) {
                    $('#filterData_div').html(data);
                    $("#loader").hide();
                    // load_datatable1();
                },
            });
        }
        // close
        // oninput append value in yajra table 
        $('#searchKeyword').on('input', function() {
            $('#fmtable_filter').children().children().val($('#searchKeyword').val());
            $('#fmtable_filter').children().children().trigger('input');
            $('#fmtable1_filter').children().children().val($('#searchKeyword').val());
            $('#fmtable1_filter').children().children().trigger('input');


        });
        setInterval(function() {
            let tableID = $('#filterData_div').children().children().attr('id')

            if (tableID == 'fmtable_wrapper') {
                countRecord()
            }
            if (tableID == 'fmtable1_wrapper') {
                countRecordFilter()
            }
        }, 3000);

        // count record on page load 
        function countRecord() {
            var count = $('#fmtable_info').text().split(' ');

            $('#record').val(count[5])
        }
        // close 

        // count record of filtered data
        function countRecordFilter() {
            var count = $('#fmtable1_info').text().split(' ');
            $('#record').val(count[5])
        }
    </script>
@endsection
{{-- script seciton ends here --}}
