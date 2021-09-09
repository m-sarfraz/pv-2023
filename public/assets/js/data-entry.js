
// Seciton loads on document ready ends

// on document ready starts
function ready() {
    // select 3 for select option
    select2Dropdown("select2_dropdown");
    $('#new').prop("disabled", true);
    $('#COURSE').prop("disabled", true);
}
// on document ready ends


// If new record button is clicked empty input fields
function newRecord(elem) {
    // reset form and disable button
    $(elem).prop("disabled", true);
    $(elem).closest('form').find(':input').val("");
}

// On form submit call ajax for data saving
function formSubmit(elem) {
    $("#loader").show();

    // making a variable containg all for data and append token
    var data = new FormData(elem);
    data.append("_token", "{{ csrf_token() }}");

    // call ajax for data entry ad validation
    $.ajax({
        url: "{{ Route('save-data-entry') }}",
        data: data,
        contentType: false,
        processData: false,
        type: 'POST',

        // Ajax success function
        success: function (res) {
            if (res.success == true) {

                // show success sweet alert and enable entering new record button
                $('#new').prop("disabled", false);
                swal("success", res.message, "success").then((value) => { });
            } else if (res.success == false) {

                // show validation error on scree with border color changed and text
                if (res.hasOwnProperty("message")) {
                    var err = "";
                    $("input").parent().siblings('span').remove();
                    $("input").css('border-color', '#ced4da');

                    //function for appending span and changing css color for input
                    $.each(res.message, function (i, e) {
                        $("input[name='" + i + "']").css('border-color',
                            'red');
                        $("input[name='" + i + "']").parent().siblings(
                            'span').remove();
                        $("input[name='" + i + "']").parent().parent()
                            .append(
                                '<span style="color:red;" >' + e + '</span>'
                            );
                    });

                    // show warning message to user if firld is required
                    swal({
                        icon: "error",
                        text: "{{ __('Please fix the highlighted errors!') }}",
                        icon: "error",
                    });
                }

                //if duplicate values are detected in database for use data
            } else if (res.success == 'duplicate') {
                $("#loader").hide();

                //show warning message to change the data
                swal({
                    icon: "error",
                    text: "{{ __('Duplicate data detected') }}",
                    icon: "error",
                });
            }

            //hide loader
            $("#loader").hide();
        },

        //if there is error in ajax call
        error: function () {
            $("#loader").hide();
        }
    });
    return false;
}

// Change course according to the selected education attainment 
function EducationalAttainChange() {

    // enable and disable course fields on selected educational attainment
    var value = $('#EDUCATIONAL_ATTAINTMENT').find(":selected").text().trim();
    if (value == 'GRADUATE') {

        // if selected text is gradute disable course field for user
        $('#COURSE').prop("disabled", true);
    } else {
        //enable course field
        $('#COURSE').prop("disabled", false);

    }
}

//  On application status changed function starts 
function ApplicationStatusChange(elem) {

    // if current and exepcted salary is empty notify user
    var value = $(elem).find(":selected").text().trim();

    // check for selected application status value
    if (value == 'To Be Endorsed') {
        if ($('#current_salary').val() == "" || $('#expec_salary').val() == "") {

            // Show notification message if fields are empty in candidate position fields
            swal({
                icon: "warning",
                text: "{{ __('Dont forget to write Current Salary and Expected Salray') }}",
                icon: "warning",
            });
        }

        // disable and enable input fields for user data in endorsement section
        $('#remarks').prop("disabled", false);
        $('#status').prop("disabled", false);
        $('#site').prop("disabled", false);
        $('#client').prop("disabled", false);
        $('#position').prop("disabled", false);
        $('#domain').prop("disabled", false);
        $('#career').prop("disabled", false);
        $('#segment').prop("disabled", false);
        $('#sub_segment').prop("disabled", false);
        $('#endo_date').prop("disabled", false);
        $('#remarks_for_finance').prop("disabled", false);

    } else {

        //else disalbe the input fields of endorsement section 
        $('#remarks').prop("disabled", true);
        $('#status').prop("disabled", true);
        $('#site').prop("disabled", true);
        $('#client').prop("disabled", true);
        $('#position').prop("disabled", true);
        $('#domain').prop("disabled", true);
        $('#career').prop("disabled", true);
        $('#segment').prop("disabled", true);
        $('#sub_segment').prop("disabled", true);
        $('#endo_date').prop("disabled", true);
        $('#remarks_for_finance').prop("disabled", true);
    }

}
//  On application status changed function ends

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
    if (value == 'Offer accepted' || value == 'Onboarded' || value == 'Hired') {
        $('#finance_fieldset').prop("disabled", false);
        $('#off_salary').prop("disabled", false);
        $('#off_allowance').prop("disabled", false);
    } else {

        // else disable the finance section and disable salray fields
        $('#finance_fieldset').prop("disabled", true);
        $('#off_salary').prop("disabled", true);
        $('#off_allowance').prop("disabled", true);
    }

    // on remarks for finance change shwo user input fields ends

}

// append selected salary and alloeance to finance portion starts
function SalaryAppend() {

    // get vlaues of input field of candidate position
    var allowance = $('#off_allowance').val();
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

    $("#loader").show();
    var id = $(e).val();
    console.log(id);
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
function enableSearch() {
    $('#user').prop("disabled", false)
}
// search user data and append in data entry fields ends

function SPRCalculator(elem) {
    var value = $(elem).find(":selected").text().trim();
    var value1 = $('#domain').find(":selected").text().trim();
    // alert(value1);

}