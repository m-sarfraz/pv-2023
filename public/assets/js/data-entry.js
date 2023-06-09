
// Js for add data entry page

// on document ready starts
function ready() {
    // select 3 for select option
    select2Dropdown("select2_dropdown");
    // $('#new').prop("disabled", true);
    $('#COURSE').prop("disabled", true);
}
// on document ready ends


// If new record button is clicked empty input fields
function newRecord(elem) {
    // reset form and disable button
    // $(elem).prop("disabled", true);
    // $(elem).closest('form').find(':input').val("");
    // window.location="{{URL::to('home')}}";
    window.location.href = $(elem).data('href');

}





// on remarks for finance change shwo user input fields if choice is according starts
function RemarksChange(elem) {

    // get value of seleted field 
    var value = $(elem).find(":selected").text().trim();
    // enable and disalbe reason for not processing input fields
    if (value.includes('Failed') || value.includes('Withdraw')) {
        $('#rfp').prop("disabled", false);
    } else {
        $('#rfp').prop("disabled", true);
    }

    // enable and disable finance section on selected text of remarks for finance
    if (value.includes('accepted') || value.includes('Onboarded')) {
        SPRCalculator()
        let value = $('#career').val()
        $('#career_finance').append(`<option selected value="${value}">
                                   ${value}
                              </option>`)
        let value2 = $('#client').val();
        $('#client_finance').append(`<option selected value="${value2}">
                                                     ${value2}
                                                </option>`);
        SPRCalculator();
        $('#finance_fieldset').prop("disabled", false);
        $('#off_allowance').prop("disabled", false);
        $('#career_finance').prop("disabled", false);
        $('#srp').prop("disabled", false);
        // $('#remarks_finance').prop("disabled", false);
        $('#remarks_finance').attr("readonly", true);
        $('#invoice_number').prop("disabled", false);
        $('#bilable_amount').prop("disabled", false);
        $('#rate').prop("disabled", false);
        $('#off_allowance_finance').prop("disabled", false);
        $('#placement_fee').prop("disabled", false);
        $('#off_salary_fianance').prop("disabled", false);
        $('#onboard_date').prop("disabled", false);
        // $('#onboard_date').attr("readonly", true);
        $('#off_allowance').prop("disabled", false);
    } else {

        $('#career_finance').val('');
        $('#srp').val('');
        // $('#remarks_finance').val('');
        $('#remarks_finance').attr("readonly", true);
        $('#invoice_number').val('');

        $('#bilable_amount').val('');
        $('#rate').val('');
        $('#off_allowance_finance').val('');
        $('#placement_fee').val('');
        $('#off_salary_fianance').val('');
        $('#onboard_date').val('');
        $('#client_finance').val('');


        // else disable the finance section and disable salray fields
        $('#finance_fieldset').prop("disabled", true);

        // $('#off_allowance').prop("disabled", true);
    }
    if (value.includes('Offer') || value.includes('Reneged') || value.includes('Onboarded')) {
        $('#off_allowance').prop("disabled", false);
        $('#off_salary').prop("disabled", false);
    }
    else {
        $('#off_allowance').prop("disabled", true);
        $('#off_salary').prop("disabled", true);
    }
    // enalbe the interview date if remark include schedule
    if (value.includes('Scheduled')) {
        $('#interview_schedule').prop("disabled", false);
    }
    else {
        $('#interview_schedule').prop("disabled", true);
    }
    if (value.includes('Scheduled') || value.includes('Pending') || value.includes('Withdraw')) {

        // disable fieldset of finance fieldset
        $('#finance_fieldset').prop("disabled", false);

        //disable remaining fields of finance reference
        $('#career_finance').prop("disabled", false);
        $('#srp').prop("disabled", false);
        $('#remarks_finance').prop("disabled", true);
        $('#invoice_number').prop("disabled", true);
        $('#bilable_amount').prop("disabled", true);
        $('#rate').prop("disabled", true);
        $('#off_allowance_finance').prop("disabled", true);
        $('#placement_fee').prop("disabled", true);
        $('#off_salary_fianance').prop("disabled", true);
        $('#onboard_date').prop("disabled", true);
    }

    // enable the standard project revenue if the remark incliudes mid / mid stage
    if (value.includes('Mid')) {
        $('#client_finance').prop("disabled", false);
    }

    // on remarks for finance change shwo user input fields ends

}
// append selected salary and alloeance to finance portion starts
function SalaryAppend(id) {
    var value = $('#remarks_finance').find(":selected").text().trim();
    // if (value == 'Billed') {
        $('#off_allowance').prop("disabled", false);
    // }
    var allowance = $('#off_allowance').val();
    // get vlaues of input field of candidate position
    var salary = $('#off_salary').val();

    // append values to inputs of finance section
    $('#off_allowance_finance').val(allowance)
    $('#off_salary_fianance').val(salary);
}
// append selected salary and alloeance to finance portion ends

// Append endorsement data to finance portion starts
function changeOnboardingDate() {
    onboard_date.value = endo_date.value
}
// Append endorsement data to finance portion ends


// Dont show invitation date if selectd manner is Pending starts
function mannerChange(elem) {

    // get the value of selected text
    var value = $(elem).find(":selected").text().trim();
    if (value == 'Pending') {
        $('#date_invited').prop("disabled", true);
    } else {
        // else enable the invitation data
        $('#date_invited').prop("disabled", false);
    }
}
// Dont show invitation date if selectd manner is Pending endss

// find the total bilable amount according to rate and append in SPR starts
function amountFinder(id) {
    amount = $('#bilable_amount').val();
    rate = $('#rate').val();
    rate = rate.replace(" ", "");
    rate = rate.replace("%", "");
    rate = parseFloat(rate)
    // formula for calculating the placement fee in finance section
    placmentFee = ((amount * rate) / 100).toFixed(2);
    // append to SPR input
    $('#placement_fee').val(placmentFee);
}
// find the total bilable amount according to rate and append in SPR ends

// search user data and append in data entry fields starts
function SearchUserData(path, e, div) {
    $('#userDetailInput').removeClass('d-none')
    $('#searchRecord').prop("disabled", true)
    $('#saveRecord').prop("disabled", false)
    $('#saveNewRecord').prop("disabled", false)
    $('#editRecord').prop("disabled", false)
    $("#loader").show();
    var id = $('#user').val();
    $('#mainQRdiv').removeClass('d-none')
    $('#loader5').show()
    $('#QrCode').html('');
    // ajax call for user data fetching starts
    $.ajax({
        type: "GET",
        url: path,
        data: {
            _token: token,
            id: id
        },
        // success function after ajax call starts
        success: function (data) {
            $('#UserData_div').html('');
            $('#UserData_div').html(data);
            $("#loader").hide();
        },
        // success function after ajax call ends

    });
    // ajax call for user data fetching ends

}
// search user data and append in data entry fields starts
function enableSearch(id) {
    $('#userDetailInput').addClass('d-none')
    $(id).prop("disabled", false)
    $('#save').prop("disabled", true)
    $('#saveRecord').prop("disabled", true)
    $('#editRecord').prop("disabled", true)
}
// search user data and append in data entry fields ends

// calculate standard proejct revenue value on career level change starts
function SPRCalculator() {
    var domain = $('#domain_endo').find(":selected").text().trim();
    var CLi = $('#career').find(":selected").text().trim();
    // console.log('hi')
    console.log(domain)
    console.log(CLi)

    // create object of data for technology/CPI and price
    let data = [
        {
            "TECHNOLOGY": [{
                "CL5": '447000',
                "CL6": '447000',
                "CL7": '300000',
                "CL8": '178000',
                "CL9": '134000',
                "CL10": '96000',
                "CL11": '69500',
                "CL12": '15700',
                "CL13": '15000',
                "CL14": '15000',
                "CL15": '15000',
            }],
            "TECHNOLOGY & IS": [{
                "CL5": '447000',
                "CL6": '447000',
                "CL7": '300000',
                "CL8": '178000',
                "CL9": '134000',
                "CL10": '96000',
                "CL11": '69500',
                "CL12": '15700',
                "CL13": '15000',
                "CL14": '15000',
                "CL15": '15000',
            }],
            "CORPORATE FUNCTIONS": [{
                "CL5": '638000',
                "CL6": '638000',
                "CL7": '316000',
                "CL8": '206000',
                "CL9": '117000',
                "CL10": '72000',
                "CL11": '38000',
                "CL12": '14800',
                "CL13": '15000',
                "CL14": '15000',
                "CL15": '15000',
            }],
            "OPERATIONS": [{
                "CL5": '638000',
                "CL6": '638000',
                "CL7": '316000',
                "CL8": '206000',
                "CL9": '117000',
                "CL10": '72000',
                "CL11": '38000',
                "CL12": '14800',
                "CL13": '15000',
                "CL14": '15000',
                "CL15": '15000',
            }],

        },
    ];
    //g getting and appending the value of standard project revenue value
    var revenue = data[0][domain][0][CLi];
    // appending the value of revenue 
    $('#srp').val(revenue)
}


//function for appending endorsement client to finance portion starts
function clientChanged(elem) {
    var selected = $(elem).find(":selected").text().trim();
    // $('#client_finance').html('<option>' + selected + '</option>');
    // SPRCalculator()
    traverse2();
}
//function for appending endorsement client to finance portion ends

//function for appending endorsement career to finance portion starts
// function careerChanged(elem) {
//     var selected = $(elem).find(":selected").text().trim();
//     $('#career_finance').html('<option>' + selected + '</option>');
//     SPRCalculator()
// }
//function for appending endorsement career to finance portion ends
// function for enabling the edit of searched user starts
function EnableUserEdit(elem, role_id) {

    $('#certificate').prop('disabled', false)
    // enabling th fieldset value
    $('#fileDiv').removeClass('d-none')
    $('#fileDiv').addClass('d-block')
    $('#candidateFieldset').prop('disabled', false)
    $('#endoFinanceFieldset').prop('disabled', false)
    //  On application status changed function starts 
    if ($('#ap_status').find(":selected").text().trim() == 'To Be Endorsed') {
        // disable and enable input fields for user data in endorsement section
        $('#remarks').prop("disabled", false);
        $('#status').prop("disabled", false);
        $('#site').prop("disabled", false);
        $('#client').prop("disabled", false);
        $('#endo_type').prop("disabled", false);
        $('#position').prop("disabled", false);
        $('#position').attr("readonly", true);
        $('#domain_endo').attr("readonly", true);
        $('#career').prop("disabled", false);
        $('#segment').attr("readonly", true);
        $('#sub_segment').attr("readonly", true);
        $('#Domainsegment').attr("readonly", true);
        $('#domain').attr("readonly", true);
        $('#Domainsub').attr("readonly", true);
        $('#endo_date').prop("disabled", false);
        $('#remarks_for_finance').prop("disabled", false);
        // $('#expec_salary').prop("disabled", false);
    }
    var value = $('#remarks_for_finance').find(":selected").text().trim();
    // enable and disalbe reason for not processing input fields
    if (value.includes('Failed') || value.includes('Withdraw')) {
        $('#rfp').prop("disabled", false);
    } else {
        $('#rfp').prop("disabled", true);
    }

    // enable and disable finance section on selected text of remarks for finance
    if (value.includes('accepted') || value.includes('Onboarded')) {
        $('#finance_fieldset').prop("disabled", false);
        $('#off_allowance').prop("disabled", false);
        $('#career_finance').prop("disabled", false);
        $('#srp').prop("disabled", false);
        // $('#remarks_finance').prop("disabled", false);
        // $('#remarks_finance').prop("readonly", true);
        $('#invoice_number').prop("disabled", false);
        $('#bilable_amount').prop("disabled", false);
        $('#rate').prop("disabled", false);
        $('#off_allowance_finance').prop("disabled", false);
        $('#placement_fee').prop("disabled", false);
        // $('#off_salary_fianance').prop("disabled", false);
        $('#onboard_date').prop("disabled", false);
        // $('#onboard_date').attr("readonly", true);
        $('#off_allowance').prop("disabled", false);
    } else {

        // else disable the finance section and disable salray fields
        $('#finance_fieldset').prop("disabled", true);

        // $('#off_allowance').prop("disabled", true);
    }
    if (value.includes('Hire') || value.includes('Reneged') || value.includes('Onboard') || value.includes('Scheduled') || value.includes('Offer accepted')) {
        $('#off_allowance').prop("disabled", false);
        $('#off_salary').prop("disabled", false);
    }
    else {
        $('#off_allowance').prop("disabled", true);
        $('#off_salary').prop("disabled", true);
    }
    // enalbe the interview date if remark include schedule
    if (value.includes('Scheduled')) {
        $('#interview_schedule').prop("disabled", false);
    }
    else {
        $('#interview_schedule').prop("disabled", true);
    }
    if (value.includes('Scheduled') || value.includes('Pending') || value.includes('Withdraw')) {

        // disable fieldset of finance fieldset
        $('#finance_fieldset').prop("disabled", false);

        //disable remaining fields of finance reference
        $('#career_finance').prop("disabled", false);
        $('#srp').prop("disabled", false);
        $('#remarks_finance').prop("disabled", true);
        $('#invoice_number').prop("disabled", true);
        $('#bilable_amount').prop("disabled", true);
        $('#rate').prop("disabled", true);
        $('#off_allowance_finance').prop("disabled", true);
        $('#placement_fee').prop("disabled", true);
        $('#off_salary_fianance').prop("disabled", true);
        $('#onboard_date').prop("disabled", true);
    }
    var edu_attain = $('#EDUCATIONAL_ATTAINTMENT').find(":selected").text().trim();
    console.log(edu_attain);

    if (role_id == 1) {
        if (edu_attain == 'HIGH SCHOOL GRADUATE') {

            // if selected text is gradute disable course field for user
            $('#COURSE').prop("disabled", true);
        } else {
            //enable course field
            $('#COURSE').prop("disabled", false);
            $('#COURSE').children().removeAttr('disabled');

        }
    } else {
        if (edu_attain == 'HIGH SCHOOL GRADUATE' || edu_attain == 'SENIOR HIGH SCHOOL GRADUATE') {

            // if selected text is HIGH SCHOOL GRADUATE disable course field for user
            $('#COURSE').prop("disabled", true);
        } else {
            //enable course field
            $('#COURSE').prop("disabled", false);
            $('#COURSE').children().removeAttr('disabled');

        }

    }
}
        // function for enabling the edit of searched user ends