<p class="C-Heading pt-3">Summary:</p>
<div class="card mb-13">
    <div id="loader3"></div>

    <div class="card-body">
        <form action="">
            <fieldset>
                <div class="row mb-1">
                    <div class="col-lg-4">
                        <div class="form-group mb-0">
                            <label class="Label-00">
                                Average Salary:
                            </label>
                            <input readonly type="text" class="form-control users-input-S-C" id="avgsalary"
                                placeholder="hires.." />
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group mb-0">
                            <label class="Label-00">
                                Total Endorsement:
                            </label>
                            <input readonly type="text" class="form-control users-input-S-C" {{-- value="{{ $Userdata->where('endorsements.app_status', 'To Be Endorsed')->count() }}" --}}
                                placeholder="Rev.." id="endo" />
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group mb-0">
                            <label class="Label-00">
                                Total SPR:
                            </label>
                            <input readonly type="text" class="form-control users-input-S-C" placeholder="Rev.."
                                id="spr" />
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
                                Number of Sifted:
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
                            <input readonly type="text" class="form-control users-input-S-C" id="activeSPR"
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
                            <input readonly type="text" class="form-control users-input-S-C" placeholder="Rev.."
                                id="onBoarded" />
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group mb-0">
                            <label class="Label-00">
                                Number of Withdrawn:
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
                                Total Revenue.
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
    activeSPR = {!! $activeSPR !!}
    salary = {!! $salary !!}
    spr = {!! $spr !!}
    total = {!! $total !!}
    var currency = Intl.NumberFormat('ja-JP');

    function test() {
        $('#sifted').val($('#foundRecord').val());
        avgSalary = parseInt(salary / $('#foundRecord').val().replace(/[^0-9.-]+/g, ""));
        $('#avgsalary').val(isNaN(avgSalary) ? 0 : avgSalary);
    }
    $('#endo').val(currency.format(endo));
    $('#active').val(currency.format(active));
    $('#onBoarded').val(currency.format(onBoarded));
    $('#failed').val(currency.format(failed));
    $('#accepted').val(currency.format(accepted));
    $('#rejected').val(currency.format(rejected));
    $('#mid').val(currency.format(mid));
    $('#initial').val(currency.format(initial));
    $('#final').val(currency.format(final));
    $('#withdrawn').val(currency.format(withdrawn));
    $('#fallout').val(currency.format(fallout));
    $('#revenue').val(currency.format(revenue));
    $('#spr').val(currency.format(spr));
    $('#activeSPR').val(currency.format(activeSPR));
</script>
