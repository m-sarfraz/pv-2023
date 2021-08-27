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
        <div class="col-lg-5">
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
                        <p class="mb-0">Filter by:</p>
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
                            <div class="col-lg-6">
                                <div class="form-group mb-0">
                                    <label class="d-block font-size-3 mb-0">
                                        Profile
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
                            <div class="col-lg-6">
                                <div class="form-group mb-0">
                                    <label class="d-block font-size-3 mb-0">
                                        S-Segment
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
                            <div class="col-lg-6">
                                <div class="form-group mb-0">
                                    <label class="d-block font-size-3 mb-0">
                                        Application Status:
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
                            <div class="col-lg-6">
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
                            <div class="col-lg-6">
                                <div class="form-group mb-0">
                                    <label class="d-block font-size-3 mb-0">
                                        Career 1 level:
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
                            <div class="col-lg-6">
                                <div class="form-group mb-0">
                                    <label class="Label">Endo Date:</label>
                                    <input type="date" class="w-100">
                                    <!-- <select name="" id="" class="w-100">
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                        <option value="4">Four</option>
                                        <option value="5">Five</option>
                                    </select> -->
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
                                <th>Canidate</th>
                                <th>Role<span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></th>
                                <th>Canidate</th>
                                <th>Role<span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></th>
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
        <div class="col-lg-7">
            <p class="C-Heading pt-3">Requirement Details:</p>
            <div class="card mb-13">
                <div class="card-body">
                    <form action="">
                        <fieldset disabled="">
                            <div class="row mb-1">
                                <div class="col-lg-6">
                                    <div class="form-group mb-0">
                                        <label class="Label">
                                            * Canidate Name:
                                        </label>
                                        <input type="text" class="form-control" placeholder="enter first name" />
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                <div class="form-group mb-0">
                                    <label class="Label">Gender:</label>
                                    <select class="w-100">
                                        <option value="1" disabled="disabled">Select Gender</option>
                                        <option value="2">Male</option>
                                        <option value="3">Female</option>
                                        <option value="4">Transgender</option>
                                    </select>
                                </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group mb-0">
                                        <label class="Label">DOB:</label>
                                        <input type="text" class="form-control users-input-S-C" />
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-1">
                                <div class="col-lg-6">
                                    <div class="form-group mb-0">
                                        <label class="Label">Email:</label>
                                        <input type="text" class="form-control users-input-S-C" placeholder="enter email" />
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group mb-0">
                                        <label class="d-block font-size-3 mb-0">
                                            Contact:
                                        </label>
                                        <input type="text" class="form-control users-input-S-C" placeholder="enter you cell" />
                                    </div>
                                </div>
                                <!-- <div class="col-lg-4">
                                    <div class="form-group mb-0">
                                        <label class="d-block font-size-3 mb-0">
                                            Segment
                                        </label>
                                        <input type="text" class="form-control users-input-S-C" />
                                    </div>
                                </div> -->
                            </div>
                            <div class="row mb-1">
                                <div class="col-lg-6">
                                    <div class="form-group mb-0">
                                        <label class="d-block font-size-3 mb-0">
                                            Residendce
                                        </label>
                                        <input type="text" class="form-control users-input-S-C" />
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group mb-0">
                                        <label class="d-block font-size-3 mb-0">
                                            Shifted Date:
                                        </label>
                                        <input type="text" class="form-control users-input-S-C" />
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group mb-0">
                                        <label class="d-block font-size-3 mb-0">
                                            Source
                                        </label>
                                        <input type="text" class="form-control users-input-S-C" />
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-1">
                                <div class="col-lg-6">
                                    <div class="form-group mb-0">
                                        <label class="Label">Educational Attachment</label>
                                        <input type="text" class="form-control users-input-S-C" />
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group mb-0">
                                        <label class="Label">Date Invited:</label>
                                        <input type="text" class="form-control users-input-S-C" />
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group mb-0">
                                        <label class="Label">
                                            Manner of Invite:
                                        </label>
                                        <input type="text" class="form-control users-input-S-C" />
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-1">
                                <div class="col-lg-6">
                                    <div class="form-group mb-0">
                                        <label class="Label">Course:</label>
                                        <input type="text" class="form-control users-input-S-C" />
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group mb-0">
                                        <label class="Label">
                                            Current Salary:
                                        </label>
                                        <input type="text" class="form-control users-input-S-C" />
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group mb-0">
                                        <label class="Label">
                                            Current Allowance:
                                        </label>
                                        <input type="text" class="form-control users-input-S-C" />
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-1">
                                <div class="col-lg-6">
                                    <div class="form-group mb-0">
                                        <label class="Label">Domain:</label>
                                        <input type="text" class="form-control users-input-S-C" />
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group mb-0">
                                        <label class="Label">
                                            Expected Salary:
                                        </label>
                                        <input type="text" class="form-control users-input-S-C" />
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group mb-0">
                                        <label class="Label">
                                            Offered Salary:
                                        </label>
                                        <input type="text" class="form-control users-input-S-C" />
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-1">
                                <div class="col-lg-6">
                                    <div class="form-group mb-0">
                                        <label class="Label">Segment:</label>
                                        <input type="text" class="form-control users-input-S-C" />
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group mb-0">
                                        <label class="Label">
                                            Sub Segment:
                                        </label>
                                        <input type="text" class="form-control users-input-S-C" />
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group mb-0">
                                        <label class="Label">
                                            Offered Allowance:
                                        </label>
                                        <input type="text" class="form-control users-input-S-C" />
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-1">
                                <div class="col-lg-6">
                                    <div class="form-group mb-0">
                                        <label class="Label">Profile:</label>
                                        <input type="text" class="form-control users-input-S-C" />
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group mb-0">
                                        <label class="Label">
                                            Date Processed:
                                        </label>
                                        <input type="text" class="form-control users-input-S-C" />
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group mb-0">
                                        <label class="Label">
                                            Application Status:
                                        </label>
                                        <input type="text" class="form-control users-input-S-C" />
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-1">
                                <div class="col-lg-6">
                                    <div class="form-group mb-0">
                                        <label class="Label">Position Applied:</label>
                                        <input type="text" class="form-control users-input-S-C" />
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group mb-0">
                                        <label class="Label">
                                            Shifted By:
                                        </label>
                                        <input type="text" class="form-control users-input-S-C" />
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-1">
                                <div class="col-lg-6">
                                    <div class="form-group mb-0">
                                        <label class="d-block font-size-3 mb-0">
                                            Interview Notes:
                                        </label>
                                        <textarea name="EMPLOYMENT_HISTORY" rows="3" type="text" class="form-control border E_H h-px-20_custom" placeholder="Enter Interview Notes"></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group mb-0">
                                        <label class="d-block font-size-3 mb-0">
                                            Certification:
                                        </label>
                                        <textarea name="EMPLOYMENT_HISTORY" rows="3" type="text" class="form-control E_HI" style="height: 225px" placeholder="Enter Interview Notes"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-1">
                                <div class="col-lg-6">
                                    <div class="form-group mb-0">
                                        <label class="d-block font-size-3 mb-0">
                                            Recruitment Process:
                                        </label>
                                        <textarea name="EMPLOYMENT_HISTORY" rows="3" type="text" class="form-control border E_H h-px-20_custom" placeholder="Enter Interview Notes"></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-6 E_NEG">
                                    <p class="C-Heading pt-3">Endorsement Details:</p>
                                    <div class="card mb-13">
                                        <div class="card-body">
                                            <form action="">
                                                <div class="row mb-4">
                                                    <div class="col-lg-6">
                                                        <div class="form-group mb-0">
                                                            <label class="Label-00">
                                                                Endrsment Type:
                                                            </label>
                                                            <input type="text" name="REF_CODE" placeholder="search keyword" required="" class="form-control h-px-20_custom border" value="" />
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group mb-0">
                                                            <label class="Label-00">
                                                                Career Level:
                                                            </label>
                                                            <input type="text" name="REF_CODE" value="" disabled="" required="" class="form-control h-px-20_custom border" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mb-1">
                                                    <div class="col-lg-6">
                                                        <div class="form-group mb-0">
                                                            <label class="Label-00">Site</label>
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
                                                            <label class="Label-00">
                                                                Remarks (for Finance)
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
                                                    <div class="col-lg-6">
                                                        <div class="form-group mb-0">
                                                            <label class="Label-00">
                                                                Client
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
                                                    <div class="col-lg-6">
                                                        <div class="form-group mb-0">
                                                            <label class="Label-00">
                                                                Status:
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
                                                    <div class="col-lg-6">
                                                        <div class="form-group mb-0">
                                                            <label class="Label-00">
                                                                Position Title:
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
                                                    <div class="col-lg-6">
                                                        <div class="form-group mb-0">
                                                            <label class="Label-00">
                                                                Reason for not progressing:
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
                                                    <div class="col-lg-6">
                                                        <div class="form-group mb-0">
                                                            <label class="Label-00">
                                                                Domain:
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
                                                    <div class="col-lg-6">
                                                        <div class="form-group mb-0">
                                                            <label class="Label">Interview Schedule:</label>
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
                                                    <div class="col-lg-6">
                                                        <div class="form-group mb-0">
                                                            <label class="Label-00">
                                                                Segment:
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
                                                    <div class="col-lg-6">
                                                        <div class="form-group mb-0">
                                                            <label class="Label">Remarks (From Recruiter):</label>
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
                                                    <div class="col-lg-6">
                                                        <div class="form-group mb-0">
                                                            <label class="Label-00">
                                                                sub-segment:
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
                                                    <div class="col-lg-6">
                                                        <div class="form-group mb-0">
                                                            <label class="Label">Endo Date:</label>
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
                                                    <div class="col-lg-6">
                                                        <div class="form-group mb-0">
                                                            <label class="Label-00">
                                                                Date Undated:
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
                                            </form>
                                        </div>
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
