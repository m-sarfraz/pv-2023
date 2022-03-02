
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
    window.location.href = "https://eallaine.com/admin/data-entry";

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
        $('#finance_fieldset').prop("disabled", false);
        $('#off_allowance').prop("disabled", false);
        $('#career_finance').prop("disabled", false);
        $('#srp').prop("disabled", false);
        $('#remarks_finance').prop("disabled", false);
        $('#invoice_number').prop("disabled", false);
        $('#bilable_amount').prop("disabled", false);
        $('#rate').prop("disabled", false);
        $('#off_allowance_finance').prop("disabled", false);
        $('#placement_fee').prop("disabled", false);
        $('#off_salary_fianance').prop("disabled", false);
        $('#onboard_date').prop("disabled", false);
        // $('#off_allowance').prop("disabled", false);
    } else {

        // else disable the finance section and disable salray fields
        $('#finance_fieldset').prop("disabled", true);

        // $('#off_allowance').prop("disabled", true);
    }
    if (value.includes('Hire') || value.includes('Reneged') || value.includes('Onboard')|| value.includes('Scheduled') || value.includes('Offer accepted')) {
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
    //     $('#off_allowance').prop("disabled", false);
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
const setDate = () => {
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
    // formula for calculating the placement fee in finance section
    placmentFee = (amount * rate) / 100;
    // append to SPR input
    $('#placement_fee').val(placmentFee);
}
// find the total bilable amount according to rate and append in SPR ends

// search user data and append in data entry fields starts
function SearchUserData(e, div) {
    $('#userDetailInput').removeClass('d-none')
    $('#searchRecord').prop("disabled", true)
    $('#saveRecord').prop("disabled", false)
    $('#editRecord').prop("disabled", false)
    $("#loader").show();
    var id = $('#user').val();
    // ajax call for user data fetching starts
    $.ajax({
        type: "GET",
        url: url + "/admin/SearchUserData" + '/' + id,
        data: {
            _token: token,
            id: id
        },
        // success function after ajax call starts
        success: function (data) {
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
    var domain = $('#domain').find(":selected").text().trim();
    var CL = $('#career').find(":selected").text().trim();
    console.log(domain)
    console.log(CL)

    // create object of data for technology/CPI and price
    let data = [
        {
            "Technology": [{
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
    var revenue = data[0][domain][0][CL];
    // appending the value of revenue 
    $('#srp').val(revenue)
}


//function for appending endorsement client to finance portion starts
function clientChanged(elem) {
    var selected = $(elem).find(":selected").text().trim();
    $('#client_finance').html('<option>' + selected + '</option>');
    // SPRCalculator()
    traverse2(); 
}
//function for appending endorsement client to finance portion ends

//function for appending endorsement career to finance portion starts
function careerChanged(elem) {
    var selected = $(elem).find(":selected").text().trim();
    $('#career_finance').html('<option>' + selected + '</option>');
    SPRCalculator()
}
//function for appending endorsement career to finance portion ends
// function for enabling the edit of searched user starts
function EnableUserEdit(elem) {

    $('#certificate').prop('disabled',false)
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
                $('#domain_endo').prop("disabled", true);
                $('#career').prop("disabled", false);
                $('#segment').prop("disabled", true);
                $('#sub_segment').prop("disabled", true);
                $('#Domainsegment').prop("disabled", true);
                $('#domain').prop("disabled", true);
                $('#Domainsub').prop("disabled", true);
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
                $('#remarks_finance').prop("disabled", false);
                $('#invoice_number').prop("disabled", false);
                $('#bilable_amount').prop("disabled", false);
                $('#rate').prop("disabled", false);
                $('#off_allowance_finance').prop("disabled", false);
                $('#placement_fee').prop("disabled", false);
                $('#off_salary_fianance').prop("disabled", false);
                $('#onboard_date').prop("disabled", false);
                // $('#off_allowance').prop("disabled", false);
            } else {
        
                // else disable the finance section and disable salray fields
                $('#finance_fieldset').prop("disabled", true);
        
                // $('#off_allowance').prop("disabled", true);
            }
            if (value.includes('Hire') || value.includes('Reneged') || value.includes('Onboard')|| value.includes('Scheduled') || value.includes('Offer accepted')) {
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
}
        // function for enabling the edit of searched user ends