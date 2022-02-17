<div class="card-body">
    <form action="">
        {{-- <fieldset disabled=""> --}}
        <div class="row mb-1">
            <div class="col-lg-3">
                <div class="form-group mb-0">
                    <label class="Label">
                        Number of Hires:
                    </label>
                    <input type="text" class="form-control users-input-S-C" placeholder="hires.." id="hires" readonly />
                </div>
            </div>
            <div class="col-lg-3">
                <div class="form-group mb-0">
                    <label class="Label">
                        Company Revenue:
                    </label>
                    <input type="text" class="form-control users-input-S-C" placeholder="Rev.." id="revenue" readonly />
                </div>
            </div>
            <div class="col-lg-3">
                <div class="form-group mb-0">
                    <label class="Label">
                        Incentive Based Revenue:
                    </label>
                    <input type="text" id="Revenue_In_Incentive" class="form-control users-input-S-C"
                        placeholder="Rev.." readonly />
                </div>
            </div>
            <div class="col-lg-3">
                <div class="form-group mb-0">
                    <label class="Label">
                        Total Receivables:
                    </label>
                    <input type="text" id="receivablesAmount" class="form-control users-input-S-C" placeholder="total.."
                        readonly />
                </div>
            </div>
        </div>
        <div class="row mb-1">
            <div class="col-lg-3">
                <div class="form-group mb-0">
                    <label class="Label">
                        Number Of Billed:
                    </label>
                    <input type="text" class="form-control users-input-S-C" id="billed" placeholder="hires.."
                        readonly />
                </div>
            </div>
            <div class="col-lg-3">
                <div class="form-group mb-0">
                    <label class="Label">
                        Billed Amount:
                    </label>
                    <input type="text" class="form-control users-input-S-C" id="billedAmount" placeholder="Rev.."
                        readonly />
                </div>
            </div>
            <div class="col-lg-3">
                <div class="form-group mb-0">
                    <label class="Label">
                        BOD (less share):
                    </label>
                    <input type="text" id="vcc_share" class="form-control users-input-S-C" placeholder="Rev.."
                        readonly />
                </div>
            </div>
            <div class="col-lg-3">
                <div class="form-group mb-0">
                    <label class="Label">
                        Current Receivables:
                    </label>
                    <input type="text" class="form-control users-input-S-C" id="Current_receivablesAmount"
                        placeholder="total.." readonly />
                </div>
            </div>
        </div>
        <div class="row mb-1">
            <div class="col-lg-3">
                <div class="form-group mb-0">
                    <label class="Label">
                        Number Of Unbilled:
                    </label>
                    <input type="text" class="form-control users-input-S-C" id="unbilled" placeholder="hires.."
                        readonly />
                </div>
            </div>
            <div class="col-lg-3">
                <div class="form-group mb-0">
                    <label class="Label">
                        Unbilled Amount:
                    </label>
                    <input type="text" class="form-control users-input-S-C" id="unbilledAmount" placeholder="Rev.."
                        readonly />
                </div>
            </div>
            <div class="col-lg-3">
                <div class="form-group mb-0">
                    <label class="Label">
                        BOD Share:
                    </label>
                    <input type="text" id="BOD_share" class="form-control users-input-S-C" placeholder="Rev.."
                        oninput="bodChange(this)" />
                </div>
            </div>
            <div class="col-lg-3">
                <div class="form-group mb-0">
                    <label class="Label">
                        Overdue Receivables:
                    </label>
                    <input type="text" class="form-control users-input-S-C" id="overDue_receivablesAmount"
                        placeholder="total.." readonly />
                </div>
            </div>
        </div>
        <div class="row mb-1">
            <div class="col-lg-3">
                <div class="form-group mb-0">
                    <label class="Label">
                        Number of Fallout:
                    </label>
                    <input type="text" class="form-control users-input-S-C" id="fallout" placeholder="hires.."
                        readonly />
                </div>
            </div>
            <div class="col-lg-3">
                <div class="form-group mb-0">
                    <label class="Label">
                        Fallout Amount:
                    </label>
                    <input type="text" class="form-control users-input-S-C" id="falloutAmount" placeholder="Rev.."
                        readonly />
                </div>
            </div>
            <div class="col-lg-3">
                <div class="form-group mb-0">
                    <label class="Label">
                        Consultants Share:
                    </label>
                    <input type="text" id="c_take" class="form-control users-input-S-C" placeholder="Rev.." readonly />
                </div>
            </div>
            <div class="col-lg-3">
                <div class="form-group mb-0">
                    <label class="Label">
                        Consultants Take:
                    </label>
                    <input type="text" class="form-control users-input-S-C" id="ctakeAmount" placeholder="total.."
                        readonly />
                </div>
            </div>
        </div>
        {{-- </fieldset> --}}
    </form>
</div>
<script>
    function bodChange(elem) {
        bod = parseInt($(elem).val());
        c_share = parseInt(sql_c_share);
        $('#Revenue_In_Incentive').val(bod + c_share)
    }
    fallout = {!! $fallout !!}
    billed = {!! $billed !!}
    unbilled = {!! $unbilled !!}
    billedAmount = {!! $billedAmount !!}
    unbilledAmount = {!! $unbilledAmount !!}
    falloutAmount = {!! $falloutAmount !!}
    hires = {!! $hires !!}
    receivablesAmount = {!! $receivablesAmount !!}
    Current_receivablesAmount = {!! $Current_receivablesAmount !!}
    overDue_receivablesAmount = {!! $overDue_receivablesAmount !!}
    ctakeAmount = {!! $ctakeAmount !!}
    sql_c_share = {!! $sql_c_share !!}
    vcc_amount_sum = {!! $vcc_amount_sum !!}
    teamRevenueAmount = {!! $teamRevenueAmount !!}
    $('#hires').val(hires);
    $('#fallout').val(fallout);
    $('#billed').val(billed);
    $('#unbilled').val(unbilled);
    $('#revenue').val(billedAmount + unbilledAmount)
    $('#billedAmount').val(billedAmount);
    $('#unbilledAmount').val(unbilledAmount);
    $('#falloutAmount').val(falloutAmount);
    $('#receivablesAmount').val(receivablesAmount);
    $('#Current_receivablesAmount').val(Current_receivablesAmount);
    $('#overDue_receivablesAmount').val(overDue_receivablesAmount);
    $('#ctakeAmount').val(ctakeAmount);
    $('#c_take').val(sql_c_share);
    $('#vcc_share').val(vcc_amount_sum);
    $('#BOD_share').val(sql_c_share);
    $('#Revenue_In_Incentive').val(teamRevenueAmount)
</script>
