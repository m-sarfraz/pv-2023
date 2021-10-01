<div id="detailView">
    <p class="C-Heading pt-3">Endorsement Details:</p>
    <div class="card mb-13">
        <div class="card-body">
            <form action="">
                <fieldset disabled="">
                    <div class="row mb-1 ">
                        <div class="col-lg-4">
                            <div class="form-group mb-0">
                                <label class="Label">
                                    Recruiter:
                                </label>
                                @php
                                    $savedBy = \App\CandidateInformation::where('id', $detail->candidate_id)->first();
                                    $name = \App\User::where('id', $savedBy->saved_by)->first();
                                @endphp
                                <input type="text" class="form-control users-input-S-C" value="{{ $name->name }}"
                                    placeholder="hires.." />
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group mb-0">
                                <label class="Label">
                                    Crrnt Level:
                                </label>
                                <input type="text" class="form-control users-input-S-C" placeholder="Rev.."
                                    value="{{ $detail->career_endo }}" />
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group mb-0">
                                <label class="Label">
                                    Onboarding Date:
                                </label>
                                <input type="text" class="form-control users-input-S-C" placeholder="Rev.."
                                    value="{{ $detail->endi_date }}" />
                            </div>
                        </div>
                    </div>
                    <div class="row mb-1">
                        <div class="col-lg-4">
                            <div class="form-group mb-0">
                                <label class="Label">
                                    Client:
                                </label>
                                <input type="text" class="form-control users-input-S-C" value="{{ $detail->client }}"
                                    placeholder="hires.." />
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group mb-0">
                                <label class="Label">
                                    Domain:
                                </label>
                                <input type="text" class="form-control users-input-S-C" placeholder="Rev.."
                                    value="{{ $detail->domain_endo }}" />
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group mb-0">
                                <label class="Label">
                                    Remarks (For Finance):
                                </label>
                                <input type="text" class="form-control users-input-S-C" placeholder="Rev.."
                                    value="{{ $detail->remarks }}" />
                            </div>
                        </div>
                    </div>
                    <div class="row mb-1">
                        <div class="col-lg-6">
                            <div class="form-group mb-0">
                                <label class="Label">
                                    Site:
                                </label>
                                <input type="text" class="form-control users-input-S-C" placeholder="hires.."
                                    value="{{ $detail->site }}" />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-0">
                                <label class="Label">
                                    Position Title:
                                </label>
                                <input type="text" class="form-control users-input-S-C" placeholder="Rev.."
                                    value="{{ $detail->position_title }}" />
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
                                @php
                                    $remarks = Helper::get_dropdown('remarks_from_finance');
                                @endphp
                                <label class="Label-00">
                                    Remarks:
                                </label>
                                <select name="" id="remarksFinance" onchange="remarksChange(this)"
                                    class="w-100 form-control">
                                    <option value="" selected disabled>Select Option</option>
                                    @foreach ($remarks->options as $remarksOptions)
                                        <option value="{{ $remarksOptions->option_name }}"
                                            {{ $detail->remarks_recruiter == $remarksOptions->option_name ? 'selected' : '' }}>
                                            {{ $remarksOptions->option_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-2 p-1">
                            <div class="form-group mb-0">
                                <label class="Label-00">
                                    Onbrd dat:
                                </label>
                                <input type="date" class="w-100 form-control users-input-S-C"
                                    value="{{ $detail->onboardnig_date }}" />
                            </div>
                        </div>
                        <div class="col-lg-2 p-1">
                            <div class="form-group mb-0">
                                <label class="Label-00">
                                    Trmi date:
                                </label>
                                <input type="date" class="w-100 form-control users-input-S-C" />
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
                                <input type="text" class="form-control users-input-S-C" placeholder="total.."
                                    id="paymentTerm" />
                            </div>
                        </div>
                    </div>
                    <div class="row mb-1">
                        <div class="col-lg-3 p-1">
                            <div class="form-group mb-0">
                                <label class="Label-00">
                                    Offered Salary:
                                </label>
                                <input type="text" id="offered_salary" class="form-control users-input-S-C"
                                    placeholder="hires.." value="{{ $detail->offered_salary }}" disabled />
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
                                <input type="date" class="w-100 users-input-S-C form-control" placeholder="Rev.."
                                    id="dateDlvrd" oninput="DPDCalculate()" />
                            </div>
                        </div>
                        <div class="col-lg-3 p-1">
                            <div class="form-group mb-0">
                                <label class="Label-00">
                                    Process Status:
                                </label>
                                <input type="text" class="form-control users-input-S-C" placeholder="total.."
                                    id="processStatus" />
                            </div>
                        </div>
                    </div>
                    <div class="row mb-1">
                        <div class="col-lg-3 p-1">
                            <div class="form-group mb-0">
                                <label class="Label-00">
                                    Allowance:
                                </label>
                                <input type="text" class="form-control users-input-S-C" placeholder="hires.."
                                    id="allowance" value="{{ $detail->allowance }}" disabled />
                            </div>
                        </div>
                        <div class="col-lg-2 p-1">
                            <div class="form-group mb-0">
                                <label class="Label-00">
                                    VAT (%):
                                </label>
                                <input type="text" class="form-control users-input-S-C" placeholder="Rev.." id="vat"
                                    oninput="placementFeeCalculator()" />
                            </div>
                        </div>
                        <div class="col-lg-3 p-1">
                            <div class="form-group mb-0">
                                <label class="Label-00">
                                    Credit Memo:
                                </label>
                                <input type="text" class="form-control users-input-S-C" placeholder="Rev.."
                                    id="credit_memo" oninput="placementFeeCalculator()" />
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
                                <input type="date" class="w-100 form-control users-input-S-C" placeholder="hires.." />
                            </div>
                        </div>
                    </div>
                    <div class="row mb-1">
                        <div class="col-lg-3 p-1">
                            <div class="form-group mb-0">
                                <label class="Label-00">
                                    Special Compstn:
                                </label>
                                <input type="text" class="form-control users-input-S-C" placeholder="hires.."
                                    id="compensation" oninput="placementFeeCalculator()" />
                            </div>
                        </div>
                        <div class="col-lg-2 p-1">
                            <div class="form-group mb-0">
                                <label class="Label-00">
                                    Rate (%):
                                </label>
                                <input type="text" class="form-control users-input-S-C" placeholder="Rev.."
                                    oninput="placementFeeCalculator()" id="rate" />
                            </div>
                        </div>
                        <div class="col-lg-3 p-1">
                            <div class="form-group mb-0">
                                <label class="Label-00">
                                    Placmnt fee:
                                </label>
                                <input type="text" class="form-control users-input-S-C" placeholder="Rev.." disabled
                                    id="placementfee" />
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
                                <input type="date" class="w-100 form-control users-input-S-C" />
                            </div>
                        </div>
                    </div>
                    <div class="row mb-1">
                        <div class="col-lg-3 p-1">
                            <div class="form-group mb-0">
                                <label class="Label-00">
                                    Reprocess:
                                </label>
                                <input type="text" class="form-control users-input-S-C" placeholder="hires.."
                                    disabled />
                            </div>
                        </div>
                        <div class="col-lg-2 p-1">
                            <div class="form-group mb-0">
                                <label class="Label-00">
                                    R.Share(%):
                                </label>
                                <input type="text" class="form-control users-input-S-C" placeholder="Rev.."
                                    id="reprocessShare" oninput="reprocessAmountCalculate()" />
                            </div>
                        </div>
                        <div class="col-lg-3 p-1">
                            <div class="form-group mb-0">
                                <label class="Label-00">
                                    Reprcs Share Amt.
                                </label>
                                <input type="text" class="form-control users-input-S-C" placeholder="Rev.."
                                    id="reprocessAmount" disabled />
                            </div>
                        </div>
                        <div class="col-lg-2 p-1">
                            <div class="form-group mb-0">
                                <label class="Label-00">
                                    VCC Share(%):
                                </label>
                                <input type="text" class="form-control users-input-S-C" placeholder="total.."
                                    id="vccShare" oninput="vccShareCalcualte()" />
                            </div>
                        </div>
                        <div class="col-lg-2 p-1">
                            <div class="form-group mb-0">
                                <label class="Label-00">
                                    VSA:
                                </label>
                                <input type="text" class="w-100 form-control users-input-S-C" id="vccAmount" />
                            </div>
                        </div>
                    </div>
                    <div class="row mb-1">
                        <div class="col-lg-3 p-1">
                            <div class="form-group mb-0">
                                <label class="Label-00">
                                    Final Fee:
                                </label>
                                <input type="text" class="form-control users-input-S-C" placeholder="hires.."
                                    id="finalFee" disabled />
                            </div>
                        </div>
                        <div class="col-lg-2 p-1">
                            <div class="form-group mb-0">
                                <label class="Label-00">
                                    O.Share(%):
                                </label>
                                <input type="text" class="form-control users-input-S-C" placeholder="Rev.."
                                    id="ownerSharePercentage" oninput="ownerShareCalculate()" />
                            </div>
                        </div>
                        <div class="col-lg-3 p-1">
                            <div class="form-group mb-0">
                                <label class="Label-00">
                                    Ownr Shr Amnt.
                                </label>
                                <input type="text" class="form-control users-input-S-C" placeholder="Rev.."
                                    id="ownerAmount" disabled />
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
                                <input type="text" class="form-control users-input-S-C" disabled id="cTake" />
                            </div>
                        </div>
                    </div>
                    <div class="row mb-1">
                        <div class="col-lg-3 p-1">
                            <div class="form-group mb-0">
                                <label class="Label-00">
                                    Adjustment:
                                </label>
                                <input type="text" class="form-control users-input-S-C" placeholder="hires.."
                                    id="adjustment" oninput="adjustmentCalculator()" />
                            </div>
                        </div>
                        <div class="col-lg-4 p-1">
                            <div class="form-group mb-0">
                                <label class="Label-00">
                                    Individual Revenue:
                                </label>
                                <input type="text" class="form-control users-input-S-C" placeholder="Rev.."
                                    id="individualRevenue" />
                            </div>
                        </div>
                        <div class="col-lg-2 p-1">
                            <div class="form-group mb-0">
                                <label class="Label-00">

                                </label>
                                <button
                                    class="font-size-small w-100 border-0 btn-00 users-input-S-C "><small>Update</small></button>
                            </div>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</div>
<script>

    // section loads on ready start
    $(document).ready(function() {
        // individualRevenue()
        var fee = {!! $fee !!};
        placementfee = $('#placementfee').val(fee)
    });
    // close 

    // calculate DPD for changing the process status of candidate start
    function DPDCalculate() {
        let today = new Date();
        let time = today.getDate();
        dateDlvrd = new Date($('#dateDlvrd').val()).getDate()
        var diff = time - dateDlvrd
        return diff;
    }
    // close 

    // calucate placement fee taking vcc share,credit memo , salry, vat ,compensation starts
    function placementFeeCalculator() {

        // parse values for formula 
        salray = parseInt($('#offered_salary').val() || 0);
        credit_memo = parseInt($('#credit_memo').val() || 0);
        vat = parseInt($('#vat').val() || 0);
        compensation = parseInt($('#compensation').val() || 0);
        allowance = parseInt($('#allowance').val() || 0);
        rate = parseInt($('#rate').val() || 0);

        // if rate is below zero ccalculate placement fee
        if (rate > 0) {
            fee1 = ((salray + allowance + compensation) * (1 + (vat * 1 / 100)))
            fee2 = fee1 * (rate * 1 / 100) - credit_memo;
            $('#placementfee').val(fee2);
        } else {
            placementFee = ((salray + allowance + compensation) * (1 + vat)) - credit_memo;
            $('#placementfee').val(placementFee);
        }
        // call function for adjustm fee calculator based on current placemnt fee 
        adjustmentCalculator();
    }
    // close 

    // funciotn for adjustment fee calculator starts
    function adjustmentCalculator() {
        adjustment = parseInt($('#adjustment').val() || 0);
        placement = parseInt($('#placementfee').val() || 0);
        finalFee = adjustment + placement
        $('#finalFee').val(finalFee)
        
        // call final fee dependent functions 
        vccShareCalcualte()
        ownerShareCalculate()
        reprocessAmountCalculate()
    }
    // close 

    // function for remarks change starts 
    function remarksChange(elem) {
        DPDCalculate();
        individualRevenue();

        // change process staus according to selected options 
        var value = $(elem).val().trim();
        if (value.includes('Replaced') || value.includes('For Replacement') || value.includes('fall out') ||
            value.includes('Collected') || value.includes('Replacement')) {
            $('#processStatus').val("");
            $('#processStatus').val("DONE");
        }
        if (value.includes('Unbilled')) {
            $('#processStatus').val("");
            $('#processStatus').val("FB");
        }
        if (value.includes('Billed')) {
            paymentTerm = $('#paymentTerm').val();
            if (diff > paymentTerm) {
                $('#processStatus').val("OVERDUE");
            } else if (paymentTerm - diff <= 14) {
                $('#processStatus').val("");
                $('#processStatus').val("FFUP");
            } else {
                $('#processStatus').val("");
                $('#processStatus').val("RCVD");
            }
        }
    }
    // close 

    // vcc share calculator starts 
    function vccShareCalcualte() {
        finalFee = $('#finalFee').val()
        placementfee = $('#placementfee').val()
        vccShare = $('#vccShare').val()
        VCCamount = (finalFee * (vccShare * 1 / 100));
        cTake = (placementfee * (vccShare * 1 / 100));
        $('#vccAmount').val(VCCamount)
        $('#cTake').val(cTake)
        // call individualRevenue accoding to new VCCshare
        individualRevenue()
    }

    // owner share calculator funciton starts 
    function ownerShareCalculate() {
        var owsP = $('#ownerSharePercentage').val();
        finalFee = $('#finalFee').val()
        ownerAmount = owsP * finalFee;
        $('#ownerAmount').val(ownerAmount)
    }
    // close 

    // reprocess amount calculator 
    function reprocessAmountCalculate() {
        var share = $('#reprocessShare').val();
        finalFee = $('#finalFee').val()
        reprocessAmount = share * finalFee;

        // append value
        $('#reprocessAmount').val(reprocessAmount)
    }

    // calculate individual revenue of team/recruiter 
    function individualRevenue() {
        var value = $("#remarksFinance option:selected").text().trim();
        placementfee = $('#placementfee').val()
        vccShare = $('#vccShare').val()
        var team = {!! $team !!};
        var fee = {!! $fee !!};

        // check selected options and type of team for individual revenue calculator 
        if (value == "Unbilled" || value == "For Replacement" || value == "Replaced") {
            revenue = 0;
            $('#individualRevenue').val(revenue)
        }
        if (value == "Billed" || value == "Collected" && team[0] == "consultant") {
            console.log(placementfee + 'place mnet fee')
            console.log(vccShare + 'vcc share is')
            revenue = (placementfee * (vccShare * 1 / 100));
            console.log('revenue is' + revenue)
            $('#individualRevenue').val(revenue)
        }
        else if(value == "Billed" || value == "Collected" && team[0] != "consultant"){
            revenue = placementfee;
            $('#individualRevenue').val(revenue)
        }
        return;
    }
    // close 
</script>
