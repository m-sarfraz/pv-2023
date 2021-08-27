@extends('layouts.app') 

@section('style')
<!-- ================= -->
<!-- Datatable css start-->
<link rel="stylesheet" href="//cdn.datatables.net/1.11.0/css/jquery.dataTables.min.css" />

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
                                    <input type="text" name="REF_CODE" placeholder="search keyword" required="" class="form-control h-px-20_custom border" value="" />
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group mb-0">
                                    <label class="d-block font-size-3 mb-0">
                                        # of Records Found:
                                    </label>
                                    <input type="text" name="REF_CODE" value="" disabled="" required="" class="form-control h-px-20_custom border" />
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
                        <div class="row mb-1">
                            <div class="col-lg-6">
                                <div class="form-group mb-0">
                                    <label class="Label">Recruiter</label>
                                    <select name="" id="" class="w-100" >
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                        <option value="4">Four</option>
                                        <option value="5">Five</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group mb-0">
                                    <label class="d-block font-size-3 mb-0">
                                        Canidate
                                    </label>
                                    <select name="" id="" class="w-100">
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                        <option value="4">Four</option>
                                        <option value="5">Five</option>
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
                                    <select name="" id="" class="w-100">
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
                                        Team
                                    </label>
                                    <select name="" id="" class="w-100">
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
                                    <input type="date" class="w-100">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-1">
                            <div class="col-lg-8">
                                <div class="form-group mb-0">
                                    <label class="d-block font-size-3 mb-0">
                                        Reprocess:
                                    </label>
                                    <select name="" id="" class="w-100">
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
                                        Client:
                                    </label>
                                    <select name="" id="" class="w-100">
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                        <option value="4">Four</option>
                                        <option value="5">Five</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-1">
                            <div class="col-lg-8">
                                <div class="form-group mb-0">
                                    <label class="d-block font-size-3 mb-0">
                                        Process Status:
                                    </label>
                                    <select name="" id="" class="w-100">
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
                                    <input type="date" class="w-100">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- ================= -->
            <!-- Datatable code start-->
            <div class="table-responsive border-right pt-3">
              <div class="">
                <table id="example1" class="table">
                        <thead class="bg-light w-100">
                            <tr style="border-bottom: 3px solid white;border-top: 3px solid white;">
                                <th>Team<span>&nbsp;&nbsp;&nbsp;&nbsp;</span></th>
                                <th>Recruiter</th>
                                <th>Reprocess</th>
                                <th>Canidate</th>
                                <th>Roles<span>&nbsp;&nbsp;&nbsp;&nbsp;</span></th>
                            </tr>
                        </thead>
                        <tbody>
                        <tr class="bg-transparent">
                                <!-- Table data 1 -->
                                <td>no data</td>
                                <td>no data</td>
                                <td>no data</td>
                                <td>no data</td>
                                <td>no data</td>
                            </tr>
                            <tr class="bg-transparent">
                                <!-- Table data 1 -->
                                <td>no data</td>
                                <td>no data</td>
                                <td>no data</td>
                                <td>no data</td>
                                <td>no data</td>
                            </tr>
                            <tr class="bg-transparent">
                                <!-- Table data 1 -->
                                <td>no data</td>
                                <td>no data</td>
                                <td>no data</td>
                                <td>no data</td>
                                <td>no data</td>
                            </tr>
                            <tr class="bg-transparent">
                                <!-- Table data 1 -->
                                <td>no data</td>
                                <td>no data</td>
                                <td>no data</td>
                                <td>no data</td>
                                <td>no data</td>
                            </tr>
                            <tr class="bg-transparent">
                                <!-- Table data 1 -->
                                <td>no data</td>
                                <td>no data</td>
                                <td>no data</td>
                                <td>no data</td>
                                <td>no data</td>
                            </tr>
                            <tr class="bg-transparent">
                                <!-- Table data 1 -->
                                <td>no data</td>
                                <td>no data</td>
                                <td>no data</td>
                                <td>no data</td>
                                <td>no data</td>
                            </tr>
                            <tr class="bg-transparent">
                                <!-- Table data 1 -->
                                <td>no data</td>
                                <td>no data</td>
                                <td>no data</td>
                                <td>no data</td>
                                <td>no data</td>
                            </tr>
                        </tbody>
                    </table>
               </div>
            </div>
            <!-- Datatable code end-->
            <!-- ================= -->


        </div>
        <div class="col-lg-6">
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
                                        <input type="text" class="form-control users-input-S-C" placeholder="hires.." />
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
                                        <input type="text" class="form-control users-input-S-C" placeholder="total.." />
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-1">
                            <div class="col-lg-3">
                                    <div class="form-group mb-0">
                                        <label class="Label">
                                            # of Unbilled:
                                        </label>
                                        <input type="text" class="form-control users-input-S-C" placeholder="hires.." />
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
                                        <input type="text" class="form-control users-input-S-C" placeholder="total.." />
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-1">
                            <div class="col-lg-3">
                                    <div class="form-group mb-0">
                                        <label class="Label">
                                            # of Fallout:
                                        </label>
                                        <input type="text" class="form-control users-input-S-C" placeholder="hires.." />
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
                                        <input type="text" class="form-control users-input-S-C" placeholder="total.." />
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
            <p class="C-Heading pt-3">Endorsement Details:</p>
            <div class="card mb-13">
                <div class="card-body">
                    <form action="">
                        <fieldset disabled="">
                        <div class="row mb-1">
                            <div class="col-lg-4">
                                    <div class="form-group mb-0">
                                        <label class="Label">
                                            Recruiter:
                                        </label>
                                        <input type="text" class="form-control users-input-S-C" placeholder="hires.." />
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group mb-0">
                                        <label class="Label">
                                            Crrnt Level:
                                        </label>
                                        <input type="text" class="form-control users-input-S-C" placeholder="Rev.." />
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group mb-0">
                                        <label class="Label">
                                           Onboarding Date:
                                        </label>
                                        <input type="text" class="form-control users-input-S-C" placeholder="Rev.." />
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-1">
                            <div class="col-lg-4">
                                    <div class="form-group mb-0">
                                        <label class="Label">
                                            Client:
                                        </label>
                                        <input type="text" class="form-control users-input-S-C" placeholder="hires.." />
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group mb-0">
                                        <label class="Label">
                                            Domain:
                                        </label>
                                        <input type="text" class="form-control users-input-S-C" placeholder="Rev.." />
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group mb-0">
                                        <label class="Label">
                                           Remarks (For Finance):
                                        </label>
                                        <input type="text" class="form-control users-input-S-C" placeholder="Rev.." />
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-1">
                            <div class="col-lg-6">
                                    <div class="form-group mb-0">
                                        <label class="Label">
                                            Site:
                                        </label>
                                        <input type="text" class="form-control users-input-S-C" placeholder="hires.." />
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group mb-0">
                                        <label class="Label">
                                            Position Title:
                                        </label>
                                        <input type="text" class="form-control users-input-S-C" placeholder="Rev.." />
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
                                    <select name="" id="" class="w-100">
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
                                        <input type="date" class="w-100 users-input-S-C" />
                                    </div>
                                </div>
                                <div class="col-lg-2 p-1">
                                    <div class="form-group mb-0">
                                        <label class="Label-00">
                                           Trmi date:
                                        </label>
                                        <input type="date" class="w-100 users-input-S-C" />
                                    </div>
                                </div>
                                <div class="col-lg-2 p-1">
                                    <div class="form-group mb-0">
                                        <label class="Label-00">
                                            Code:
                                        </label>
                                        <input type="text" class="form-control users-input-S-C" placeholder="total.." />
                                    </div>
                                </div>
                                <div class="col-lg-3 p-1">
                                    <div class="form-group mb-0">
                                        <label class="Label-00">
                                            Payment terms:
                                        </label>
                                        <input type="text" class="form-control users-input-S-C" placeholder="total.." />
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-1">
                            <div class="col-lg-3 p-1">
                                    <div class="form-group mb-0">
                                        <label class="Label-00">
                                            Offered Salary:
                                        </label>
                                        <input type="text" class="form-control users-input-S-C" placeholder="hires.."  disabled/>
                                    </div>
                                </div>
                                <div class="col-lg-3 p-1">
                                    <div class="form-group mb-0">
                                        <label class="Label-00">
                                            Replmnt For:
                                        </label>
                                        <input type="text" class="form-control users-input-S-C" placeholder="Rev.." />
                                    </div>
                                </div>
                                <div class="col-lg-3 p-1">
                                    <div class="form-group mb-0">
                                        <label class="Label-00">
                                           Date Delvrd:
                                        </label>
                                        <input type="date" class="w-100 users-input-S-C" placeholder="Rev.." />
                                    </div>
                                </div>
                                <div class="col-lg-3 p-1">
                                    <div class="form-group mb-0">
                                        <label class="Label-00">
                                            Process Status:
                                        </label>
                                        <input type="text" class="form-control users-input-S-C" placeholder="total.." />
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-1">
                            <div class="col-lg-3 p-1">
                                    <div class="form-group mb-0">
                                        <label class="Label-00">
                                            Allowance:
                                        </label>
                                        <input type="text" class="form-control users-input-S-C" placeholder="hires.." disabled/>
                                    </div>
                                </div>
                                <div class="col-lg-2 p-1">
                                    <div class="form-group mb-0">
                                        <label class="Label-00">
                                            VAT (%):
                                        </label>
                                        <input type="text" class="form-control users-input-S-C" placeholder="Rev.." />
                                    </div>
                                </div>
                                <div class="col-lg-3 p-1">
                                    <div class="form-group mb-0">
                                        <label class="Label-00">
                                           Credit Memo:
                                        </label>
                                        <input type="text" class="form-control users-input-S-C" placeholder="Rev.." />
                                    </div>
                                </div>
                                <div class="col-lg-2 p-1">
                                    <div class="form-group mb-0">
                                        <label class="Label-00">
                                            Invc No.
                                        </label>
                                        <input type="text" class="form-control users-input-S-C" placeholder="total.." />
                                    </div>
                                </div>
                                <div class="col-lg-2 p-1">
                                    <div class="form-group mb-0">
                                        <label class="Label-00">
                                            Invc date:
                                        </label>
                                        <input type="date" class="w-100 users-input-S-C" placeholder="hires.." />
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-1">
                            <div class="col-lg-3 p-1">
                                    <div class="form-group mb-0">
                                        <label class="Label-00">
                                            Special Compstn:
                                        </label>
                                        <input type="text" class="form-control users-input-S-C" placeholder="hires.." />
                                    </div>
                                </div>
                                <div class="col-lg-2 p-1">
                                    <div class="form-group mb-0">
                                        <label class="Label-00">
                                            Rate (%):
                                        </label>
                                        <input type="text" class="form-control users-input-S-C" placeholder="Rev.." />
                                    </div>
                                </div>
                                <div class="col-lg-3 p-1">
                                    <div class="form-group mb-0">
                                        <label class="Label-00">
                                           Placmnt fee:
                                        </label>
                                        <input type="text" class="form-control users-input-S-C" placeholder="Rev.." disabled/>
                                    </div>
                                </div>
                                <div class="col-lg-2 p-1">
                                    <div class="form-group mb-0">
                                        <label class="Label-00">
                                            OR No.
                                        </label>
                                        <input type="text" class="form-control users-input-S-C" placeholder="total.." />
                                    </div>
                                </div>
                                <div class="col-lg-2 p-1">
                                    <div class="form-group mb-0">
                                        <label class="Label-00">
                                            Date Colctd.
                                        </label>
                                        <input type="date" class="w-100 users-input-S-C"/>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-1">
                            <div class="col-lg-3 p-1">
                                    <div class="form-group mb-0">
                                        <label class="Label-00">
                                            Reprocess:
                                        </label>
                                        <input type="text" class="form-control users-input-S-C" placeholder="hires.." disabled/>
                                    </div>
                                </div>
                                <div class="col-lg-2 p-1">
                                    <div class="form-group mb-0">
                                        <label class="Label-00">
                                            R.Share(%):
                                        </label>
                                        <input type="text" class="form-control users-input-S-C" placeholder="Rev.." />
                                    </div>
                                </div>
                                <div class="col-lg-3 p-1">
                                    <div class="form-group mb-0">
                                        <label class="Label-00">
                                           Reprcs Share Amt.
                                        </label>
                                        <input type="text" class="form-control users-input-S-C" placeholder="Rev.." disabled/>
                                    </div>
                                </div>
                                <div class="col-lg-2 p-1">
                                    <div class="form-group mb-0">
                                        <label class="Label-00">
                                            VCC Share(%):
                                        </label>
                                        <input type="text" class="form-control users-input-S-C" placeholder="total.." />
                                    </div>
                                </div>
                                <div class="col-lg-2 p-1">
                                    <div class="form-group mb-0">
                                        <label class="Label-00">
                                            VSA:
                                        </label>
                                        <input type="text" class="w-100 users-input-S-C"/>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-1">
                            <div class="col-lg-3 p-1">
                                    <div class="form-group mb-0">
                                        <label class="Label-00">
                                            Final Fee:
                                        </label>
                                        <input type="text" class="form-control users-input-S-C" placeholder="hires.." disabled/>
                                    </div>
                                </div>
                                <div class="col-lg-2 p-1">
                                    <div class="form-group mb-0">
                                        <label class="Label-00">
                                            O.Share(%):
                                        </label>
                                        <input type="text" class="form-control users-input-S-C" placeholder="Rev.." disabled/>
                                    </div>
                                </div>
                                <div class="col-lg-3 p-1">
                                    <div class="form-group mb-0">
                                        <label class="Label-00">
                                           Ownr Shr Amnt.
                                        </label>
                                        <input type="text" class="form-control users-input-S-C" placeholder="Rev.." disabled/>
                                    </div>
                                </div>
                                <div class="col-lg-2 p-1">
                                    <div class="form-group mb-0">
                                        <label class="Label-00">
                                            C.Take(%):
                                        </label>
                                        <input type="text" class="form-control users-input-S-C" placeholder="total.." />
                                    </div>
                                </div>
                                <div class="col-lg-2 p-1">
                                    <div class="form-group mb-0">
                                        <label class="Label-00">
                                            C.Take Amnt.
                                        </label>
                                        <input type="text" class="form-control users-input-S-C" disabled/>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-1">
                            <div class="col-lg-3 p-1">
                                    <div class="form-group mb-0">
                                        <label class="Label-00">
                                            Adjustment:
                                        </label>
                                        <input type="text" class="form-control users-input-S-C" placeholder="hires.." />
                                    </div>
                                </div>
                                <div class="col-lg-4 p-1">
                                    <div class="form-group mb-0">
                                        <label class="Label-00">
                                            Individual Revenue:
                                        </label>
                                        <input type="text" class="form-control users-input-S-C" placeholder="Rev.." />
                                    </div>
                                </div>
                                <div class="col-lg-2 p-1">
                                    <div class="form-group mb-0">
                                        <label class="Label-00">
                                            
                                        </label>
                                        <button class="font-size-small w-100 border-0 btn-00 users-input-S-C "><small>Update</small></button>
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
<div style="height: 30px;"></div>

@endsection 


@section('script')
    <!-- ================= -->
    <!-- Datatable js start-->
    <script src="{{ asset('assets/plugins/data-tables/script/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/data-tables/script/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/data-tables/script/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/data-tables/script/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>

    <!-- <script>
        $(function() {
            $("#example1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
        });
    });
    </script> -->
    <!-- Datatable js end-->
    <!-- ================= -->
@endsection
