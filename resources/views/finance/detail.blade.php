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
                                    $name = \App\User::where('id', $detail->saved_by)->first();
                                @endphp
                                <input type="text" class="form-control users-input-S-C"
                                    value="{{ $name != null ? $name->name : '' }}" placeholder="hires.." />
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group mb-0">
                                <label class="Label">
                                    Career Level:
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
                                <input type="date" class="form-control users-input-S-C" placeholder="Rev.."
                                    value="{{ $detail->onboardnig_date }}" />
                            </div>
                        </div>
                    </div>
                    <div class="row mb-1">
                        <div class="col-lg-4">
                            <div class="form-group mb-0">
                                <label class="Label">
                                    Client:
                                </label>
                                <input type="text" class="form-control users-input-S-C" name+
                                    value="{{ $detail->client }}" placeholder="hires.." />
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
                                    value="{{ $detail->remarks_for_finance }}" />
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

            <form action="" id="financeReferenceForm">
                <fieldset>
                    <div class="row mb-1">
                        <div class="col-lg-3 p-1">
                            <div class="form-group mb-0">
                                @php
                                    $remarkss = Helper::get_dropdown('remarks_from_finance');
                                @endphp
                                <label class="Label-00">
                                    Remarks:
                                </label>
                                <select name="remarks" id="remarksFinance" onchange="remarksChange()"
                                    class="w-100 form-control">
                                    <option value="" selected disabled>Select Option</option>
                                    @foreach ($remarkss->options as $remarksOptions)
                                        <option value="{{ $remarksOptions->option_name }}"
                                            {{ strtolower($detail->remarks_recruiter) == strtolower($remarksOptions->option_name) ? 'selected' : '' }}>
                                            {{ $remarksOptions->option_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-2 p-1">
                            <div class="form-group mb-0">
                                <label class="Label-00">
                                    Onboarding Date:
                                </label>
                                <input type="date" class="w-100 form-control users-input-S-C"
                                    value="{{ $detail->onboardnig_date }}" name="onboardnig_date" />
                            </div>
                        </div>
                        <div class="col-lg-2 p-1">
                            <div class="form-group mb-0">
                                <label class="Label-00">
                                    Termination Date:
                                </label>
                                <input type="date" class="w-100 form-control users-input-S-C"
                                    value="{{ $detail->term_date }}" name="term_date" />
                            </div>
                        </div>
                        <div class="col-lg-2 p-1">
                            <div class="form-group mb-0">
                                <label class="Label-00">
                                    Code:
                                </label>
                                <input type="text" class="form-control users-input-S-C" placeholder="total.."
                                    value="{{ $detail->code }}" name="code" />
                            </div>
                        </div>
                        <div class="col-lg-3 p-1">
                            <div class="form-group mb-0">
                                <label class="Label-00">
                                    Payment terms:
                                </label>
                                <input type="text" class="form-control users-input-S-C" placeholder="total.."
                                    oninput="remarksChange()" id="paymentTerm"
                                    value="{{ $detail->payment_term != '' ? $detail->payment_term : 0 }}"
                                    name="payment_term" />
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
                                    placeholder="hires.." value="{{ $off_salary != '' ? $off_salary : 0 }}"
                                    name="offered_salary" />
                            </div>
                        </div>
                        <div class="col-lg-3 p-1">
                            <div class="form-group mb-0">
                                <label class="Label-00">
                                    Replacement For:
                                </label>
                                <input type="text" class="form-control users-input-S-C" placeholder="Rev.."
                                    value="{{ $detail->replacement_for }}" name="replacement_for" />
                            </div>
                        </div>
                        <div class="col-lg-3 p-1">
                            <div class="form-group mb-0">
                                <label class="Label-00">
                                    Date Delivered:
                                </label>
                                <input type="date" class="w-100 users-input-S-C form-control" placeholder="Rev.."
                                    id="dateDlvrd" value="{{ $detail->date_delvrd }}" name="date_delvrd"
                                    oninput="remarksChange()" />
                            </div>
                        </div>
                        <div class="col-lg-3 p-1">
                            <div class="form-group mb-0">
                                <label class="Label-00">
                                    Process Status:
                                </label>
                                <input type="text" class="form-control users-input-S-C" placeholder="total.."
                                    readonly id="processStatus" value="{{ $detail->process_status }}"
                                    name="process_status" />
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
                                    id="allowance" name="allowance"
                                    value="{{ $detail->allowance != '' ? $detail->allowance : 0 }}" />
                            </div>
                        </div>
                        <div class="col-lg-2 p-1">
                            <div class="form-group mb-0">
                                <label class="Label-00">
                                    VAT (%):
                                </label>
                                <input type="text" class="form-control users-input-S-C" placeholder="Rev.."
                                    id="vat" oninput="placementFeeCalculator()"
                                    value="{{ $detail->vat_per != '' ? $detail->vat_per : 0 }}" name="vat_per" />
                            </div>
                        </div>
                        <div class="col-lg-3 p-1">
                            <div class="form-group mb-0">
                                <label class="Label-00">
                                    Credit Memo:
                                </label>
                                <input type="text" class="form-control users-input-S-C" placeholder="Rev.."
                                    id="credit_memo" oninput="placementFeeCalculator()"
                                    value="{{ $detail->credit_memo != '' ? $detail->credit_memo : 0 }}"
                                    name="credit_memo" />
                            </div>
                        </div>
                        <div class="col-lg-2 p-1">
                            <div class="form-group mb-0">
                                <label class="Label-00">
                                    Invoice Number:
                                </label>
                                <input type="text" class="form-control users-input-S-C" placeholder="total.."
                                    value="{{ $detail->invoice_number != '' ? $detail->invoice_number : 0 }}"
                                    name="invoice_number" />
                            </div>
                        </div>
                        <div class="col-lg-2 p-1">
                            <div class="form-group mb-0">
                                <label class="Label-00">
                                    Invoice Date:
                                </label>
                                <input type="date" class="w-100 form-control users-input-S-C"
                                    placeholder="hires.." value="{{ $detail->invoice_date }}"
                                    name="invoice_date" />
                            </div>
                        </div>
                    </div>
                    <div class="row mb-1">
                        <div class="col-lg-3 p-1">
                            <div class="form-group mb-0">
                                <label class="Label-00">
                                    Special Compensation:
                                </label>
                                <input type="text" class="form-control users-input-S-C" placeholder="hires.."
                                    id="compensation" oninput="placementFeeCalculator()" name="compensation"
                                    value="{{ $detail->compensation != '' ? number_format($detail->compensation, 2) : 0 }}" />
                            </div>
                        </div>
                        <div class="col-lg-2 p-1">
                            <div class="form-group mb-0">
                                <label class="Label-00">
                                    Rate (%):
                                </label>
                                <input type="text" class="form-control users-input-S-C" placeholder="Rev.."
                                    oninput="placementFeeCalculator()" id="rate" name="rate_per"
                                    value="{{ $detail->rate_per != '' ? $detail->rate_per : 0 }}" />
                            </div>
                        </div>
                        <div class="col-lg-3 p-1">
                            <div class="form-group mb-0">
                                <label class="Label-00">
                                    Placement Fee:
                                </label>
                                <input type="text" class="form-control users-input-S-C" placeholder="Rev.."
                                    readonly
                                    value="{{ $detail->placement_fee != '' ? number_format($detail->placement_fee, 2) : 0 }}"
                                    name="placement_fee" id="placementfee" />
                            </div>
                        </div>
                        <div class="col-lg-2 p-1">
                            <div class="form-group mb-0">
                                <label class="Label-00">
                                    OR No.
                                </label>
                                <input type="text" class="form-control users-input-S-C" placeholder="total.."
                                    value="{{ $detail->or_number }}" name="or_number" />
                            </div>
                        </div>
                        <div class="col-lg-2 p-1">
                            <div class="form-group mb-0">
                                <label class="Label-00">
                                    Date Collected:
                                </label>
                                <input type="date" class="w-100 form-control users-input-S-C"
                                    value="{{ $detail->date_collected }}" name="date_collected" />
                            </div>
                        </div>
                    </div>
                    <div class="row mb-1">
                        {{-- <div class="col-lg-3 p-1">
                            <div class="form-group mb-0">
                                <label class="Label-00">
                                    Reprocess:
                                </label>
                                <input type="text" class="form-control users-input-S-C" placeholder="hires.." readonly
                                    value="{{ $detail->reprocess_share }}"  value="{{ number_format($detail->reprocess_share, 2) }}" name="reprocess_share" />
                            </div>
                        </div> --}}
                        <div class="col-lg-3 p-1">
                            <div class="form-group mb-0">
                                <label class="Label-00">
                                    R.Share(%):
                                </label>
                                <input type="text" class="form-control users-input-S-C" placeholder="Rev.."
                                    id="reprocessShare" oninput="reprocessAmountCalculate()"
                                    value="{{ $detail->reprocess_share_per != '' ? $detail->reprocess_share_per : 0 }}"
                                    name="reprocess_share_per" />
                            </div>
                        </div>
                        <div class="col-lg-3 p-1">
                            <div class="form-group mb-0">
                                <label class="Label-00">
                                    Reprocess Share Amount:
                                </label>
                                {{-- @dd($detail->reprocess_share) --}}
                                <input type="text" class="form-control users-input-S-C" placeholder="Rev.."
                                    name="reprocess_share"
                                    value="{{ $detail->reprocess_share != '' ? number_format($detail->reprocess_share, 2) : 0 }}"
                                    id="reprocessAmount" readonly />
                            </div>
                        </div>
                        <div class="col-lg-3 p-1">
                            <div class="form-group mb-0">
                                <label class="Label-00">
                                    VCC Share(%):
                                </label>
                                <input type="text" class="form-control users-input-S-C" placeholder="total.."
                                    id="vccShare" oninput="vccShareCalcualte()"
                                    value="{{ $detail->vcc_share_per != '' ? $detail->vcc_share_per : 0 }}"
                                    name="vcc_share_per" />
                            </div>
                        </div>
                        <div class="col-lg-3 p-1">
                            <div class="form-group mb-0">
                                <label class="Label-00">
                                    VCC Share Amount:
                                </label>
                                <input type="text" class="w-100 form-control users-input-S-C" name="VSA"
                                    value="{{ $detail->vcc_amount != '' ? number_format($detail->vcc_amount, 2) : 0 }}"
                                    id="vccAmount" />
                            </div>
                        </div>
                    </div>
                    <div class="row mb-1">

                        <div class="col-lg-3 p-1">
                            <div class="form-group mb-0">
                                <label class="Label-00">
                                    O.Share(%):
                                </label>
                                <input type="text" class="form-control users-input-S-C" placeholder="Rev.."
                                    id="ownerSharePercentage" oninput="ownerShareCalculate()"
                                    value="{{ $detail->owner_share_per != '' ? $detail->owner_share_per : 0 }}"
                                    name="owner_share_per" />
                            </div>
                        </div>
                        <div class="col-lg-3 p-1">
                            <div class="form-group mb-0">
                                <label class="Label-00">
                                    Owner Share Amount:
                                </label>
                                <input type="text" class="form-control users-input-S-C" placeholder="Rev.."
                                    id="ownerAmount" readonly
                                    value="{{ $detail->owner_share != '' ? number_format($detail->owner_share, 2) : 0 }}"
                                    name="owner_share" />
                            </div>
                        </div>
                        <div class="col-lg-3 p-1">
                            <div class="form-group mb-0">
                                <label class="Label-00">
                                    C.Take(%):
                                </label>
                                <input type="text" class="form-control users-input-S-C" placeholder="total.."
                                    oninput="ctakeCalcualte()"
                                    value="{{ $detail->c_take_per != '' ? $detail->c_take_per : 0 }}"
                                    name="c_take_per" id="c_take_per" />
                            </div>
                        </div>
                        <div class="col-lg-3 p-1">
                            <div class="form-group mb-0">
                                <label class="Label-00">
                                    C. Take Amount:
                                </label>
                                <input type="text" class="form-control users-input-S-C" id="cTake"
                                    value="{{ $detail->c_take != '' ? number_format($detail->c_take, 2) : 0 }}"
                                    name="c_take" />
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
                                    id="adjustment" oninput="adjustmentCalculator()" name="adjustment"
                                    value="{{ $detail->adjustment != '' ? $detail->adjustment : 0 }}" />
                            </div>
                        </div>
                        <div class="col-lg-3 p-1">
                            <div class="form-group mb-0">
                                <label class="Label-00">
                                    Final Fee:
                                </label>
                                <input type="text" class="form-control users-input-S-C" placeholder="hires.."
                                    id="finalFee" readonly
                                    value="{{ $detail->finalFee != '' ? number_format($detail->finalFee, 2) : 0 }}"
                                    name="finalFee" />
                            </div>
                        </div>
                        <input type="hidden" id="fid" value="{{ $fid }}" name="fid" />
                        {{-- <div class="col-lg-4 p-1">
                            <div class="form-group mb-0">
                                <label class="Label-00">
                                    Individual Revenue:
                                </label>
                                <input type="text" class="form-control users-input-S-C" placeholder="Rev.."
                                    id="individualRevenue" name="ind_revenue" value="{{ $detail->ind_revenue }}" />
                            </div>
                        </div> --}}
                        <input type="text" class="form-control users-input-S-C d-none" placeholder="Rev.."
                            id="individualRevenue" name="ind_revenue"
                            value="{{ $detail->ind_revenue != '' ? $detail->ind_revenue : 0 }}" />
                        <div class="col-lg-2 p-1">
                            <div class="form-group mb-0">
                                <label class="Label-00">

                                </label>
                                @can('edit-finance-record')
                                    <button type="button" id="update"
                                        class="font-size-small ml-5 w-100 border-0 btn-00 p-0 m-0"><small>Update</small></button>
                                @endcan
                            </div>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</div>
{{-- section script starts --}}
<script src="{{ asset('assets/js/moment.js') }}"></script>

<script>
    var currency = Intl.NumberFormat('ja-JP');
    // section loads on ready start
    $(document).ready(function() {

        // append placement allowance offered_salary value on start          
        var fee = {!! $fee !!};
        // var off_salary = {!! $off_salary !!};
        // var off_allowance = {!! $off_allowance !!};
        $('#placementfee').val(currency.format(fee))
        $('#allowance').val(currency.format($('#allowance').val()))
        $('#offered_salary').val(currency.format($('#offered_salary').val()))
        $('#adjustment').val(currency.format($('#adjustment').val()))
        $('#ownerSharePercentage').val(currency.format($('#ownerSharePercentage').val()))
        $('#rate').val(currency.format($('#rate').val()))
        $('#vat').val(currency.format($('#vat').val()))
        $('#c_take_per').val(currency.format($('#c_take_per').val()))
        $('#reprocessShare').val(currency.format($('#reprocessShare').val()))
        $('#vccShare').val(currency.format($('#vccShare').val()))

        // offered_salary = $('#offered_salary').val(currency.format(off_salary))

        // select default value unbilled if remarks are offer accepted or onboarded 
        var remarks_finance = '<?php echo $remarks_finance; ?>';
        var remarks_recruiter = '<?php echo $remarks_recruiter; ?>';
        remarks = remarks_finance.toLowerCase();
        remarks_r = remarks_recruiter.toLowerCase();
        console.log(remarks_r);

        // if (remarks == 'offer accepted' || remarks == 'onboarded') {
            if (remarks_r == '') {
                ('#processStatus').val('FB')
                $('#remarksFinance option[value=Unbilled').prop('selected', 'selected');
            }
            else if( remarks_r == 'unbilled') {
                ('#processStatus').val('FB')
            }
        // }
        // close 
    });
    // close 

    // calculate DPD for changing the process status of candidate start
    // function DPDCalculate() {
    //     let today = new Date();
    //     let time = today.getDate();
    //     dateDlvrd = new Date($('#dateDlvrd').val()).getDate()
    //     var diff = time - dateDlvrd
    //     return diff;
    // }
    // close 

    // calucate placement fee taking vcc share,credit memo , salry, vat ,compensation starts
    function placementFeeCalculator() {

        // parse values for formula 
        var billAmount = {!! $billAmount !!};

        // get inputs values by removing space or comma in it 
        salray = parseFloat($('#offered_salary').val().replace(/[^0-9.-]+/g, ""));
        credit_memo = parseFloat($('#credit_memo').val().replace(/[^0-9.-]+/g, ""));
        vat = parseFloat($('#vat').val().replace(/[^0-9.-]+/g, ""));
        compensation = parseFloat($('#compensation').val().replace(/[^0-9.-]+/g, ""));
        allowance = parseFloat($('#allowance').val().replace(/[^0-9.-]+/g, ""));
        rate = parseFloat($('#rate').val().replace(/[^0-9.-]+/g, ""));

        // if rate is below zero ccalculate placement fee
        if (rate > 0) {
            fee1 = (billAmount + compensation);
            ratePercentage = fee1 * (rate / 100);
            findVatpercent = (1 + vat / 100)
            multiplyVatandRate = findVatpercent * ratePercentage;
            placementFee = multiplyVatandRate - credit_memo;

            // append value of placement fee  
            (isNaN(placementFee)) ? $('#placementfee').val(0): $('#placementfee').val(currency.format(placementFee));
        } else {

            // if rate value is equal to zero or negative 
            fee1 = (billAmount + compensation);
            ratePercentage = fee1;
            findVatpercent = (1 + vat / 100)
            multiplyVatandRate = findVatpercent * ratePercentage;
            placementFee = multiplyVatandRate - credit_memo;

            // append value if is number 
            (isNaN(placementFee)) ? $('#placementfee').val(0): $('#placementfee').val(currency.format(placementFee));

        }
        // call function for adjustm fee calculator based on current placemnt fee 
        adjustmentCalculator();
    }
    // close 

    // function for adjustment fee calculator starts
    function adjustmentCalculator() {
        adjustment = parseFloat($('#adjustment').val().replace(/[^0-9.-]+/g, ""));
        placement = parseFloat($('#placementfee').val().replace(/[^0-9.-]+/g, ""));
        // console.log(placement)
        finalFee = adjustment + placement;
        // $('#finalFee').val(currency.format(finalFee))
        (isNaN(finalFee)) ? $('#finalFee').val(0): $('#finalFee').val(currency.format(finalFee));

        // call final fee dependent functions 
        vccShareCalcualte()
        ownerShareCalculate()
        reprocessAmountCalculate()
    }
    // close 

    // function for remarks change starts 
    function remarksChange() {
        // DPDCalculate();
        // change process staus according to selected options 
        var value = $('#remarksFinance').val().trim();
        console.log(value);
        if (value.includes('Replaced') || value.includes('For Replacement') || value.includes('Fall out') ||
            value.includes('Collected') || value.includes('Replacement')) {
            $('#processStatus').val("");
            $('#processStatus').val("DONE");
        }
        if (value.includes('Un')) {
            $('#processStatus').val("");
            $('#processStatus').val("FB");
        }
        if (value.includes('Billed')) {
            paymentTerm = $('#paymentTerm').val();
            var dateDlvrd = moment(new Date($('#dateDlvrd').val()), 'DD-MM-YYYY');
            var today = moment();
            var dpd = today.diff(dateDlvrd, 'days');
            if (parseFloat(dpd) > parseFloat(paymentTerm)) {
                $('#processStatus').val("OVERDUE");
            } else if (parseFloat(paymentTerm) - parseFloat(dpd) <= 14) {
                $('#processStatus').val("");
                $('#processStatus').val("FFUP");
            } else if (parseFloat(paymentTerm) - parseFloat(dpd) > 14) {
                $('#processStatus').val("");
                $('#processStatus').val("RCVD");
            }
        }
        individualRevenue();

    }
    // close 

    // vcc share calculator starts 
    function vccShareCalcualte() {
        finalFee = $('#finalFee').val().replace(/[^0-9.-]+/g, "")
        placementfee = $('#placementfee').val().replace(/[^0-9.-]+/g, "")
        vccShare = $('#vccShare').val().replace(/[^0-9.-]+/g, "")
        VCCamount = (finalFee * (vccShare * 1 / 100));
        c_take_per = $('#c_take_per').val().replace(/[^0-9.-]+/g, "")
        cTake = (placementfee * (c_take_per * 1 / 100));
        (isNaN(VCCamount)) ? $('#vccAmount').val(0): $('#vccAmount').val(currency.format(VCCamount));
        // (isNaN(cTake)) ? $('#cTake').val(0): $('#cTake').val(currency.format(cTake));

        // $('#vccAmount').val(currency.format(VCCamount))
        // $('#cTake').val(currency.format(cTake))
        // call individualRevenue accoding to new VCCshare
        individualRevenue()
    }
    // close 
    function ctakeCalcualte() {
        c_take_per = $('#c_take_per').val().replace(/[^0-9.-]+/g, "")
        placementfee = $('#placementfee').val().replace(/[^0-9.-]+/g, "")
        cTake = (placementfee * (c_take_per * 1 / 100));
        (isNaN(cTake)) ? $('#cTake').val(0): $('#cTake').val(currency.format(cTake));

    }
    // owner share calculator funciton starts 
    function ownerShareCalculate() {
        var owsP = $('#ownerSharePercentage').val().replace(/[^0-9.-]+/g, "");
        finalFee = $('#finalFee').val().replace(/[^0-9.-]+/g, "")
        ownerAmount = finalFee * ((owsP * 1) / 100);
        (isNaN(ownerAmount)) ? $('#ownerAmount').val(0): $('#ownerAmount').val(currency.format(ownerAmount));

        // $('#ownerAmount').val(currency.format(ownerAmount))
    }
    // close 

    // reprocess amount calculator 
    function reprocessAmountCalculate() {
        var share = $('#reprocessShare').val().replace(/[^0-9.-]+/g, "");
        // console.log(share)
        // console.log(finalFee)
        finalFee = $('#finalFee').val().replace(/[^0-9.-]+/g, "")
        reprocessAmount = finalFee * ((share * 1) / 100);

        // append value
        (isNaN(reprocessAmount)) ? $('#reprocessAmount').val(0): $('#reprocessAmount').val(currency.format(
            reprocessAmount));

        // $('#reprocessAmount').val(currency.format(reprocessAmount))
    }
    // close 

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
            (isNaN(revenue)) ? $('#individualRevenue').val(0): $('#individualRevenue').val(currency.format(revenue));

            // $('#individualRevenue').val(revenue)
        }
        if (value == "Billed" || value == "Collected" && team[0] == "CONSULTANT") {
            revenue = (placementfee * (vccShare * 1 / 100));
            // console.log('revenue is' + revenue)
            (isNaN(revenue)) ? $('#individualRevenue').val(0): $('#individualRevenue').val(currency.format(
                revenue));
            // $('#individualRevenue').val(revenue)
        } else if (value == "Billed" || value == "Collected" && team[0] != "CONSULTANT") {
            revenue = placementfee;
            (isNaN(revenue)) ? $('#individualRevenue').val(0): $('#individualRevenue').val(currency.format(
                revenue));
            // $('#individualRevenue').val(revenue)
        }
        return;
    }
    // close 

    // form submit function starts 
    $('#update').click(function() {
        // making a variable containg all for data and append token
        var data = new FormData(document.getElementById('financeReferenceForm'));
        data.append("_token", "{{ csrf_token() }}");
        data.append("candidate_id", "{{ $detail->candidate_id }}");
        console.log(data)
        // console.log(data);
        // call ajax for data entry ad validation
        $.ajax({
            url: '{{ url('admin/save_finance-reference') }}',
            data: data,
            contentType: false,
            processData: false,
            type: 'POST',

            // Ajax success function
            success: function(res) {
                // console.log("updated candidate_id", res)
                if (res.success == true) {
                    // show success sweet alert and enable entering new record button
                    swal({
                        icon: "success",
                        text: "{{ __('Updated finance') }}",
                        icon: "success",
                    });
                    location.reload();
                } else if (!res) {
                    $("#loader").hide();

                    //show warning message to change the data
                    swal({
                        icon: "error",
                        text: "{{ __('Error Occured') }}",
                        icon: "error",
                    });
                }
                //hide loader
                $("#loader").hide();
            },

            //if there is error in ajax call
            error: function() {
                $("#loader").hide();
            }
        });
        // return false;
    });
    // $.ajaxSetup({
    //     headers: {
    //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //     }
    // });

    // })
    //close
    $("#financeReferenceForm").on("input", "input[type='text']", function() {
        if ($(this).val() == '') {
            $(this).val(0)
        } 
        // else {

        //     $(this).val(parseFloat($(this).val().replace(/[^0-9.-]+/g, "")));
        //     $(this).val(currency.format($(this).val()))
        // }
    });
</script>
{{-- section script ends --}}
