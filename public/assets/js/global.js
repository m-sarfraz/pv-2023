function select2Dropdown(obj) {
    $("." + obj).select2();
}
function delete_data(obj, route) {
    swal({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        buttons: true,
        dangerMode: true,
    })
        .then((delete_data) => {
            $("#loader").show();
            var id = $(obj).data('id');
            $.ajax({
                url: route,
                data: {
                    '_token': $('meta[name=csrf-token]').attr("content"),
                    'id': id
                },
                type: 'POST',
                success: function (res) {
                    if (res.success == true) {

                        swal("Success", res.message, 'success');
                        setTimeout(function () {
                            location.reload();
                        }, 1000);
                    } else if (res.success == false) {
                        swal("Warning", res.message, 'error');
                    }

                    $("#loader").hide();
                },
                error: function () {
                    $("#loader").hide();
                }
            });
            return false;
        });

}
function save_form(id, route) {
    $("#loader").show();
    var form = document.querySelector("#" + id);
    var data = new FormData(form);
    $.ajax({
        url: route,
        data: data,
        contentType: false,
        processData: false,
        type: 'POST',
        success: function (res) {
            if (res.success == true) {

                swal("Success", res.message, 'success');
                setTimeout(function () {
                    location.reload();
                }, 1000);
            } else if (res.success == false) {
                swal("Warning", res.message, 'error');
            }

            $("#loader").hide();
        },
        error: function () {
            $("#loader").hide();
        }
    });
    return false;

}

//General function for downloading CV of Candidate starts
function downloadCv(id, targetURL) {
    $("#loader").show();

    // call ajax with data to controller 
    $.ajax({
        type: 'POST',
        url: targetURL,
        data: { _token: token, id: id },

        // Ajax success function
        success: function (res) {
            $("#loader").hide();

            if (res.success == true) {
                $("#loader").hide();

                // show success sweet alert and enable entering new record button
                swal("success", res.message, "success").then((value) => { });
            } else if (res.success == false) {
                $("#loader").hide();

                //show warning message if file not found error occured
                swal({
                    icon: "error",
                    text: "no attachment found",
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
//General function for downloading CV of Candidate ends
