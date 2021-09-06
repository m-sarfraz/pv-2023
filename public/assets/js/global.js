function select2Dropdown(obj){
   $("."+obj).select2();
}

function save_form(id,route){
    $("#loader").show();
    var form    = document.querySelector("#"+id);
    var data = new FormData(form);
    $.ajax({
        url: route,
        data: data,
        contentType: false,
        processData: false,
        type: 'POST',
        success: function (res) {
            if(res.success == true){

                swal("Success", res.message, 'success');
                setTimeout(function(){
                    location.reload();
                },1000);
            }else if(res.success == false){
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
