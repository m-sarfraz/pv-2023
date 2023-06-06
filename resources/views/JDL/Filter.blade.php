<div class="card mb-13">
    <div class="card-body">
        <form action="">
            <fieldset disabled="">
                <div class="row mb-1">
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
                            <label class="Label">
                                Classification
                            </label>
                            <input type="text" class="form-control users-input-S-C" value="{{ $user->p_title }}" />
                        </div>


                    </div>
                    <div class="col-lg-4">

                        <div class="form-group mb-0">
                            <label class="Label">
                                Status
                            </label>
                            <input type="text" class="form-control users-input-S-C" value="{{ $user->p_title }}" />
                        </div>
                    </div>

                </div>
                <div class="row mb-1">
                    <div class="col-lg-4">
                        <div class="form-group mb-0">
                            <label class="Label">
                                Position Title
                            </label>
                            <input type="text" class="form-control users-input-S-C" value="{{ $user->p_title }}" />
                        </div>


                    </div>
                    <div class="col-lg-4">
                        <div class="form-group mb-0">
                            <label class="Label">
                                Requirement Classification
                            </label>
                            <input type="text" class="form-control users-input-S-C" value="{{ $user->p_title }}" />
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group mb-0">
                            <label class="Label">
                                Keyword
                            </label>
                            <input type="text" class="form-control users-input-S-C" value="{{ $user->p_title }}" />
                        </div>
                    </div>
                </div>
                <div class="row mb-1">
                    <div class="col-lg-4">
                        <div class="form-group mb-0">
                            <label class="d-block font-size-3 mb-0">
                                Updated Fte:
                            </label>
                            <input type="text" name="UPDATED_DATE" class="form-control border h-px-20_custom"
                                value="{{ $user->updated_date }}" />
                        </div>


                    </div>
                    <div class="col-lg-4">
                        <div class="form-group mb-0">
                            <label class="Label">
                                # of Active endo
                            </label>
                            <input type="text" class="form-control users-input-S-C" value="{{ $user->p_title }}" />
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group mb-0">
                            <label class="Label">
                                # of Inactive endo
                            </label>
                            <input type="text" class="form-control users-input-S-C" value="{{ $user->p_title }}" />
                        </div>
                    </div>
                </div>

                <div class="row mb-1">
                    <div class="col-lg-4">
                        <div class="form-group mb-0">
                            <label class="d-block font-size-3 mb-0">
                                Career Level
                            </label>
                            <input type="text" class="form-control users-input-S-C" value="{{ $user->c_level }}" />
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group mb-0">
                            <label class="Label">SLL No:</label>
                            <input type="text" class="form-control users-input-S-C" value="{{ $user->sll_no }}" />
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group mb-0">
                            <label class="Label">Requisition ID #</label>
                            <input type="text" class="form-control users-input-S-C" value="{{ $user->sll_no }}" />
                        </div>
                    </div>

                </div>
                <div class="row mb-1">
                    <div class="col-lg-4">
                        <div class="form-group mb-0">
                            <label class="d-block font-size-3 mb-0">
                                Domain
                            </label>
                            <input type="text" class="form-control users-input-S-C" value="{{ $user->segment }}" />
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group mb-0">
                            <label class="d-block font-size-3 mb-0">
                                Segment
                            </label>
                            <input type="text" class="form-control users-input-S-C" value="{{ $user->segment }}" />
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group mb-0">
                            <label class="d-block font-size-3 mb-0">
                                Sub-Segment
                            </label>
                            <input type="text" class="form-control users-input-S-C"
                                value="{{ $user->subsegment }}" />
                        </div>
                    </div>


                </div>
                <div class="row mb-1">
                    <div class="col-lg-4">
                        <div class="form-group mb-0">
                            <label class="Label">Priority</label>
                            <input type="text" class="form-control users-input-S-C" value="{{ $user->priority }}" />
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group mb-0">
                            <label class="Label">Assignment</label>
                            <input type="text" class="form-control users-input-S-C" value="{{ $user->priority }}" />
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group mb-0">
                            <label class="Label">Maturity</label>
                            <input type="text" class="form-control users-input-S-C" value="{{ $user->priority }}" />
                        </div>
                    </div>
                </div>
                <div class="row mb-1">
                    <div class="col-lg-4">
                        <div class="form-group mb-0">
                            <label class="Label">Budget:</label>
                            <input type="text" class="form-control users-input-S-C" value="{{ $user->budget }}" />
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group mb-0">
                            <label class="Label">Location:</label>
                            <input type="text" class="form-control users-input-S-C" value="{{ $user->location }}" />
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group mb-0">
                            <label class="Label">
                                Educational Attainment:
                            </label>
                            <input type="text" class="form-control users-input-S-C"
                                value="{{ $user->edu_attainment }}" />
                        </div>
                    </div>

                </div>
                <div class="row mb-1">
                    <div class="col-lg-4">
                        <div class="form-group mb-0">
                            <label class="Label">
                                Work Schedule:
                            </label>
                            <input type="text" class="form-control users-input-S-C"
                                value="{{ $user->w_schedule }}" />
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group mb-0">
                            <label class="d-block font-size-3 mb-0">
                                Start Date
                            </label>
                            <input type="text" class="form-control users-input-S-C"
                                value="{{ $user->start_date }}" />
                        </div>
                    </div>
                    <div class="col-lg-4">

                    </div>
                </div>
                <div class="row mb-1">
                    <div class="col-lg-12">
                        <div class="form-group mb-0">
                            <label class="d-block font-size-3 mb-0 text-center">
                                Job Description &amp; Work Experience:
                            </label>
                            <textarea name="EMPLOYMENT_HISTORY" rows="3" type="text"
                                class="form-control border E_H h-px-20_custom"
                                placeholder="Job Description &amp; Work Experience">{{ $user->jd }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="row mb-1">
                    <div class="col-lg-4">
                        <div class="form-group mb-0">
                            <label class="d-block font-size-3 mb-0">
                                Recruitment Process:
                            </label>
                            <input name="EMPLOYMENT_HISTORY" type="text"
                                class="form-control border E_H h-px-20_custom" placeholder="Recruitment Process"
                                value="{{ $user->poc }}" />
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group mb-0">
                            <label class="d-block font-size-3 mb-0">
                                Notes:
                            </label>
                            <input name="EMPLOYMENT_HISTORY" rows="3" type="text"
                                class="form-control border E_H h-px-20_custom" placeholder=" Interview Notes"
                                value="{{ $user->note }}" />
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group mb-0">
                            <label class="d-block font-size-3 mb-0">
                                Client Spiel
                            </label>
                            <input name="EMPLOYMENT_HISTORY" rows="3" type="text"
                                class="form-control border E_H h-px-20_custom" placeholder=" Interview Notes"
                                value="{{ $user->note }}" />
                        </div>
                    </div>
                </div>
                <div class="row mb-1">
                    <div class="col-lg-4">
                        <div class="form-group mb-0">
                            <label class="d-block font-size-3 mb-0">
                                Recruiters:
                            </label>
                            <input name="EMPLOYMENT_HISTORY" rows="3" type="text"
                                class="form-control border E_H h-px-20_custom" placeholder=""
                                value="{{ $user->recruiter }}" />
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group mb-0">
                            <label class="d-block font-size-3 mb-0">
                                Date Updated:
                            </label>
                            <input type="text" name="UPDATED_DATE" class="form-control border h-px-20_custom"
                                value="{{ $user->updated_date }}" />
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group mb-0">
                            <label class="d-block font-size-3 mb-0">
                                Turn Around Time
                            </label>
                            <input type="text" name="UPDATED_DATE" class="form-control border h-px-20_custom"
                                value="{{ $user->updated_date }}" />
                        </div>
                    </div>
                </div>
            </fieldset>
        </form>
    </div>
</div>