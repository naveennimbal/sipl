$(document).ready(function(){
    $(".updateRight").click(function () {
        str = $(this).attr("name");
        //tableName = str[0];
        //userId = str[1];
        //action = str[2];
        value = "No"
        if($(this).is(":checked")){
            value = "Yes";
        }
        //alert(window.baseurl);
        $.ajax({
            method: "POST",
            url: window.baseurl+"index.php/permissions/updateaction",
            data:{"data":str,"choice":value},
            beforeSend: function( xhr ) {
                //xhr.overrideMimeType( "text/plain; charset=x-user-defined" );
                $("#loadingModal").modal('show');
            }
        })
            .done(function( data ) {
                console.log($.parseJSON(data));
                xhr = $.parseJSON(data);
                if(xhr == "SUCCESS"){
                    $("#loadingModal").modal('hide');
                    $('#myModal').modal('show');
                    $('#myModal').delay(3000).modal('show');
                   //window.setTimeout(hideModal('myModal'), 3000);

                } else {
                    $("#loadingModal").modal('hide');
                    $("#errorModal").modal('show');
                    $("#errorModal").delay(3000).modal('show');
                    //window.setTimeout(hideModal('errorModal'), 3000);
                }
            });

    })


       function hideModal(eleID){
           $('#'+eleID).modal('hide')
       }


})