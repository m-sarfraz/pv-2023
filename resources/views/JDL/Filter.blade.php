<div class="col-lg-12" id="record_detail" style="width:100%">

 
    <p class="C-Heading">Requirement Details:</p>
    <div class="card mb-13">
        <div class="card-body">
            <form action="">
                <fieldset disabled="">
                    <div class="row mb-1">
                        <div class="col-lg-4">
                            <div class="form-group mb-0">
                                <label class="Label">
                                    Position Title
                                </label>
                                <input type="text" class="form-control users-input-S-C"
                                    value="{{ $user->position_title }}" />
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group mb-0">
                                <label class="Label">Priority</label>
                                <input type="text" class="form-control users-input-S-C" />
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group mb-0">
                                <label class="Label">FTE:</label>
                                <input type="text" class="form-control users-input-S-C" />
                            </div>
                        </div>
                    </div>
                    <div class="row mb-1">
                        <div class="col-lg-4">
                            <div class="form-group mb-0">
                                <label class="Label">No of Endo:</label>
                                <input type="text" class="form-control users-input-S-C" />
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group mb-0">
                                <label class="d-block font-size-3 mb-0">
                                    Client:
                                </label>
                                <input type="text" class="form-control users-input-S-C" value="{{ $user->client }}" />
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group mb-0">
                                <label class="d-block font-size-3 mb-0">
                                    Segment
                                </label>
                                <input type="text" class="form-control users-input-S-C"
                                    value="{{ $user->segment }}" />
                            </div>
                        </div>
                    </div>
                    <div class="row mb-1">
                        <div class="col-lg-4">
                            <div class="form-group mb-0">
                                <label class="d-block font-size-3 mb-0">
                                    Sub-Segment
                                </label>
                                <input type="text" class="form-control users-input-S-C"
                                    value="{{ $user->sub_segment }}" />
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group mb-0">
                                <label class="d-block font-size-3 mb-0">
                                    Start Date
                                </label>
                                <input type="text" class="form-control users-input-S-C" />
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group mb-0">
                                <label class="d-block font-size-3 mb-0">
                                Career Level
                                </label>
                                <input type="text" class="form-control users-input-S-C"
                                    value="{{ $user->career_endo }}" />
                            </div>
                        </div>
                    </div>
                    <div class="row mb-1">
                        <div class="col-lg-4">
                            <div class="form-group mb-0">
                                <label class="Label">SLL No:</label>
                                <input type="text" class="form-control users-input-S-C" />
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group mb-0">
                                <label class="Label">Location:</label>
                                <input type="text" class="form-control users-input-S-C"
                                    value="{{ $user->address }}" />
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group mb-0">
                                <label class="Label">
                                    Work Schedule:
                                </label>
                                <input type="text" class="form-control users-input-S-C" />
                            </div>
                        </div>
                    </div>
                    <div class="row mb-1">
                        <div class="col-lg-6">
                            <div class="form-group mb-0">
                                <label class="Label">Budget:</label>
                                <input type="text" class="form-control users-input-S-C" />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-0">
                                <label class="Label">
                                    Educational Background:
                                </label>
                                <input type="text" class="form-control users-input-S-C" />
                            </div>
                        </div>
                    </div>
                    <div class="row mb-1">
                        <div class="col-lg-12">
                            <div class="form-group mb-0">
                                <label class="d-block font-size-3 mb-0">
                                    Job Description &amp; Work Experience:
                                </label>
                                <textarea name="EMPLOYMENT_HISTORY" rows="3" type="text"
                                    class="form-control border E_H h-px-20_custom"
                                    placeholder="Enter Interview Notes"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-1">
                        <div class="col-lg-6">
                            <div class="form-group mb-0">
                                <label class="d-block font-size-3 mb-0">
                                    Recruitment Process:
                                </label>
                                <textarea name="EMPLOYMENT_HISTORY" rows="3" type="text"
                                    class="form-control border E_H h-px-20_custom"
                                    placeholder="Enter Interview Notes"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-0">
                                <label class="d-block font-size-3 mb-0">
                                    Notes:
                                </label>
                                <textarea name="EMPLOYMENT_HISTORY" rows="3" type="text"
                                    class="form-control border E_H h-px-20_custom"
                                    placeholder="Enter Interview Notes">{{ $user->interview_note }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-1">
                        <div class="col-lg-6">
                            <div class="form-group mb-0">
                                <label class="d-block font-size-3 mb-0">
                                    Assigned Recruiters:
                                </label>
                                <textarea name="EMPLOYMENT_HISTORY" rows="3" type="text"
                                    class="form-control border E_H h-px-20_custom"
                                    placeholder="Enter Interview Notes"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-0">
                                <label class="d-block font-size-3 mb-0">
                                    Updated Date:
                                </label>
                                <input type="date" name="UPDATED_DATE" class="form-control border h-px-20_custom"
                                    value="{{ $user->updated_at }}" />
                            </div>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</div>
