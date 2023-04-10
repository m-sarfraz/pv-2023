function select2Dropdown(obj) {
    $("." + obj).select2();
}
function delete_data(obj, route) {
    Swal.fire({
        title: "Are you sure?",
        text: "You will not be able to revert this Change!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
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

                          Swal.fire("Success", res.message, 'success');
                          setTimeout(function () {
                              location.reload();
                          }, 1000);
                      } else if (res.success == false) {
                          Swal.fire("Warning", res.message, 'error');
                      }

                      $("#loader").hide();
                  },
                  error: function () {
                      $("#loader").hide();
                  }
              });
          }
          else {
              
              return false;
          }
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

                Swal.fire("Success", res.message, 'success');
                setTimeout(function () {
                    location.reload();
                }, 1000);
            } else if (res.success == false) {
                Swal.fire("Warning", res.message, 'error');
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
                Swal.fire("success", res.message, "success").then((value) => { });
            } else if (res.success == false) {
                $("#loader").hide();

                //show warning message if file not found error occured
                Swal.fire({
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
