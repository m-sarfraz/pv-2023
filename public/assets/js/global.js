function select2Dropdown(obj){
   $("."+obj).select2();
}
function delete_data(obj,route){
    swal({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        buttons: true,
        dangerMode: true,
    })
        .then((delete_data) => {
            $("#loader").show();
            var id    =   $(obj).data('id');
            $.ajax({
                url: route,
                data: {
                    '_token':$('meta[name=csrf-token]').attr("content"),
                    'id' : id
                },
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
        });

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
