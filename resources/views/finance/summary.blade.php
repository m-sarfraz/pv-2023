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
<script>
    hires = {!! $hires !!}
    fallout = {!! $fallout !!}
    billed = {!! $billed !!}
    unbilled = {!! $unbilled !!}
    $('#hires').val(hires);
    $('#fallout').val(fallout);
    $('#billed').val(billed);
    $('#unbilled').val(unbilled);
    $('#revenue').val(billed+unbilled)
</script>