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
                            <input type="text" class="form-control users-input-S-C" value="{{ $user->p_title }}" />
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group mb-0">
                            <label class="Label">Priority</label>
                            <input type="text" class="form-control users-input-S-C" value="{{ $user->priority }}" />
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group mb-0">
                            <label class="Label"> FTE:</label>
                            <input type="text" class="form-control users-input-S-C" value="{{ $user->t_fte }}" />
                        </div>
                    </div>
                </div>
                <div class="row mb-1">
                    <div class="col-lg-4">
                        <div class="form-group mb-0">
                            <label class="Label">No of Endo:</label>
                            <input type="text" class="form-control users-input-S-C" value={{ $endorsmentCount }} />
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
                            <input type="text" class="form-control users-input-S-C" value="{{ $user->segment }}" />
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
                                value="{{ $user->subsegment }}" />
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
                        <div class="form-group mb-0">
                            <label class="d-block font-size-3 mb-0">
                                Career Level
                            </label>
                            <input type="text" class="form-control users-input-S-C" value="{{ $user->c_level }}" />
                        </div>
                    </div>
                </div>
                <div class="row mb-1">
                    <div class="col-lg-4">
                        <div class="form-group mb-0">
                            <label class="Label">SLL No:</label>
                            <input type="text" class="form-control users-input-S-C" value="{{ $user->sll_no }}" />
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
                                Work Schedule:
                            </label>
                            <input type="text" class="form-control users-input-S-C"
                                value="{{ $user->w_schedule }}" />
                        </div>
                    </div>
                </div>
                <div class="row mb-1">
                    <div class="col-lg-6">
                        <div class="form-group mb-0">
                            <label class="Label">Budget:</label>
                            <input type="text" class="form-control users-input-S-C" value="{{ $user->budget }}" />
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group mb-0">
                            <label class="Label">
                                Educational Background:
                            </label>
                            <input type="text" class="form-control users-input-S-C"
                                value="{{ $user->edu_attainment }}" />
                        </div>
                    </div>
                </div>
                <div class="row mb-1">
                    <div class="col-lg-12">
                        <div class="form-group mb-0">
                            <label class="d-block font-size-3 mb-0">
                                Job Description &amp; Work Experience:
                            </label>
                            <textarea name="EMPLOYMENT_HISTORY" rows="3" type="text" class="form-control border E_H h-px-20_custom"
                                placeholder="Job Description &amp; Work Experience">{{ $user->jd }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="row mb-1">
                    <div class="col-lg-6">
                        <div class="form-group mb-0">
                            <label class="d-block font-size-3 mb-0">
                                Recruitment Process:
                            </label>
                            <textarea name="EMPLOYMENT_HISTORY" rows="3" type="text" class="form-control border E_H h-px-20_custom"
                                placeholder="Recruitment Process">{{ $user->poc }}</textarea>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group mb-0">
                            <label class="d-block font-size-3 mb-0">
                                Notes:
                            </label>
                            <textarea name="EMPLOYMENT_HISTORY" rows="3" type="text" class="form-control border E_H h-px-20_custom"
                                placeholder=" Interview Notes">{{ $user->note }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="row mb-1">
                    <div class="col-lg-6">
                        <div class="form-group mb-0">
                            <label class="d-block font-size-3 mb-0">
                                Assigned Recruiters:
                            </label>
                            <textarea name="EMPLOYMENT_HISTORY" rows="3" type="text" class="form-control border E_H h-px-20_custom"
                                placeholder="">{{ $user->recruiter }}</textarea>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group mb-0">
                            <label class="d-block font-size-3 mb-0">
                                Updated Date:
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
