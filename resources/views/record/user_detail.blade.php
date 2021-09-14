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
                            <input type="text" class="form-control" placeholder="enter first name" / value="{{$user->first_name}}">
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
                            <input type="text" class="form-control users-input-S-C" / value="{{$user->dob}}">
                        </div>
                    </div>
                </div>
                <div class="row mb-1">
                    <div class="col-lg-6">
                        <div class="form-group mb-0">
                            <label class="Label">Email:</label>
                            <input type="text" class="form-control users-input-S-C"
                                placeholder="enter email"  value="{{$user->email}}"/>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group mb-0">
                            <label class="d-block font-size-3 mb-0">
                                Contact:
                            </label>
                            <input type="text" class="form-control users-input-S-C"
                                placeholder="enter you cell"  value="{{$user->phone}}"/>
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
                            <input type="text" class="form-control users-input-S-C"  value="{{$user->address}}"/>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group mb-0">
                            <label class="d-block font-size-3 mb-0">
                                Shifted Date:
                            </label>
                            <input type="text" class="form-control users-input-S-C"  value="{{$user->shifted_date}}"/>
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
                            <input type="text" class="form-control users-input-S-C"  value="{{$user->date_invited}}"/>
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
                            <input type="text" class="form-control users-input-S-C"  value="{{$user->curr_salary}}"/>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group mb-0">
                            <label class="Label">
                                Current Allowance:
                            </label>
                            <input type="text" class="form-control users-input-S-C"  value="{{$user->curr_allowance}}" />
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
                            <input type="text" class="form-control users-input-S-C"  value="{{$user->expec_salary}}"/>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group mb-0">
                            <label class="Label">
                                Offered Salary:
                            </label>
                            <input type="text" class="form-control users-input-S-C"  value="{{$user->off_salary}}" />
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
                            <input type="text" class="form-control users-input-S-C"  value="{{$user->off_allowance}}"/>
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
                            <input type="text" class="form-control users-input-S-C"  value="{{$user->position_applied}}" />
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
                            <textarea name="EMPLOYMENT_HISTORY" rows="3" type="text"
                                class="form-control border E_H h-px-20_custom"  value="{{$user->interview_notes}}"
                                placeholder="Enter Interview Notes"></textarea>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group mb-0">
                            <label class="d-block font-size-3 mb-0">
                                Certification:
                            </label>
                            <textarea name="EMPLOYMENT_HISTORY" rows="3" type="text"
                                class="form-control E_HI" style="height: 225px"  value="{{$user->certification}}"
                                placeholder="Enter Interview Notes"></textarea>
                        </div>
                    </div>
                </div>
                <div class="row mb-1">
                    <div class="col-lg-6 mb-5">
                        <div class="form-group mb-0">
                            <label class="d-block font-size-3 mb-0">
                                Recruitment Process:
                            </label>
                            <textarea name="EMPLOYMENT_HISTORY" rows="3" type="text"
                                class="form-control border E_H h-px-20_custom"
                                placeholder="Enter Interview Notes"></textarea>
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
                                                <input type="text" name="REF_CODE"
                                                    placeholder="search keyword" required=""
                                                    class="form-control h-px-20_custom border" value="" />
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group mb-0">
                                                <label class="Label-00">
                                                    Career Level:
                                                </label>
                                                <input type="text" name="REF_CODE" value="" disabled=""
                                                    required=""
                                                    class="form-control h-px-20_custom border" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-1">
                                        <div class="col-lg-6">
                                            <div class="form-group mb-0">
                                                <label class="Label-00">Site</label>
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
                                                <label class="Label">Remarks (From
                                                    Recruiter):</label>
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