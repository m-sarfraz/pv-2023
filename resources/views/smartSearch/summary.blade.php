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
                                {{-- value="{{ $Userdata->where('endorsements.app_status', 'To Be Endorsed')->count() }}" --}} placeholder="Rev.." id="endo" />
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
                            <input readonly type="text" class="form-control users-input-S-C" id="initial"
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
                                {{-- value="{{ $Userdata->where('endorsements.app_status', 'Active File')->count() }}" --}} placeholder="hires.." />
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group mb-0">
                            <label class="Label-00">
                                Mid Stage:
                            </label>
                            <input readonly type="text" class="form-control users-input-S-C" id="mid"
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
                            <input readonly type="text" class="form-control users-input-S-C" id="fallout"
                                placeholder="hires.." />
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group mb-0">
                            <label class="Label-00">
                                Final Stage:
                            </label>
                            <input readonly type="text" class="form-control users-input-S-C" id="final"
                                placeholder="Rev.." />
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group mb-0">
                            <label class="Label-00">
                                Total of Revenue.
                            </label>
                            <input readonly type="text" class="form-control users-input-S-C" id="revenue"
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
<script>
    sifted = {!! $sifted !!}
    endo = {!! $endo !!}    
    active = {!! $active !!}    
    failed = {!! $failed !!}    
    accepted = {!! $accepted !!}    
    onBoarded = {!! $onBoarded !!}    
    rejected = {!! $rejected !!}    
    mid = {!! $mid !!}    
    initial = {!! $initial !!}    
    final = {!! $final !!}    
    withdrawn = {!! $withdrawn !!}    
    fallout = {!! $fallout !!}    
    revenue = {!! $revenue !!}    
    spr = {!! $spr !!}    
    $('#sifted').val(sifted);
    $('#endo').val(endo);
    $('#active').val(active);
    $('#onBoarded').val(onBoarded);
    $('#failed').val(failed);
    $('#accepted').val(accepted);
    $('#rejected').val(rejected);
    $('#mid').val(mid);
    $('#initial').val(initial);
    $('#final').val(final);
    $('#withdrawn').val(withdrawn);
    $('#fallout').val(fallout);
    $('#revenue').val(revenue);
    $('#spr').val(spr);
</script>