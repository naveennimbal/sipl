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


    //$('#podate').datepicker();

    $("#vendor").change(function(){
            vendorId =$(this).val();
        $.ajax({
            method: "POST",
            url: window.baseurl+"porder/vendorbank",
            data:{"vendorID":vendorId},
            beforeSend: function( xhr ) {
                //xhr.overrideMimeType( "text/plain; charset=x-user-defined" );
               // $("#loadingModal").modal('show');
            }
        })
            .done(function( data ) {
                console.log($.parseJSON(data));
                xhr = $.parseJSON(data);
               /*for(a in xhr ){
                    console.log(xhr.a[id]);
                } */
                var result = "";

                $.each(xhr, function(k, v) {
                   // console.log(k,"this is key")
                   // console.log(v,"this is val")
                   $("#vendorbank").append("<option value='"+v.id+"'>"+v.bank_name+"</option>")
                });

            });
    });



    (function( $ ){
        $.fn.addItem = function() {


                itemHtml= '<div class="form-row">\n' +
                    '                    <div class="form-group col-md-3">\n' +
                    '\n' +
                    '                        <label for="inputAddress">Part Number</label>\n' +
                    '\n' +
                    '                        <input type="text" class="form-control" id="inputAddress" name="part_number[]" placeholder="">\n' +
                    '\n' +
                    '                    </div>\n' +
                    '                    <div class="form-group  col-md-6">\n' +
                    '                        <label for="inputAddress2">Part Name </label>\n' +
                    '                        <input type="text" class="form-control" id="inputAddress2" name="part_name[]" placeholder="">\n' +
                    '                    </div>\n' +
                    '\n' +
                    '                    <div class="form-group  col-md-1">\n' +
                    '                        <label for="inputAddress2">Quantity </label>\n' +
                    '                        <input type="text" class="form-control" id="inputAddress2" name="quantity[]" placeholder="">\n' +
                    '                    </div>\n' +
                    '\n' +
                    '                    <div class="form-group  col-md-1">\n' +
                    '                        <label for="inputAddress2">Price </label>\n' +
                    '                        <input type="text" class="form-control" id="inputAddress2" name="price[]" placeholder="">\n' +
                    '                    </div>\n' +
                    '\n' +
                    '                    <div class="form-group  col-md-1">\n' +
                    '                        <label for="inputAddress2">&nbsp;Remove </label>\n' +
                    '                        <a class="btn btn-danger removeItemBtn" ><span class="glyphicon glyphicon-minus-sign"></span> Remove</a>\n' +
                    '                    </div>\n' +
                    '\n' +
                    '                </div>';




            $("#itemRow").append(itemHtml);

        };
    })( jQuery );


    (function( $ ){
        $.fn.removeItem = function(ele) {
            //alert("dfds");
            //event.stopPropagation();
            //console.log($(ele).html())
            $(ele).parent().parent().remove();

        };
    })( jQuery );




    $("#addItemBtn").click(function () {
        $.fn.addItem();
    });

    //$("a").click(function () {
    //    console.log(this)
    //})

    $(document).on("click", 'a.removeItemBtn', function(){
       // alert("sdsad");
        $.fn.removeItem(this);
    })

    $(document).on("click", '#submitItemForm', function(eve){

        $.ajax({
            type: 'post',
            url: 'porder/additems',
            data: $('form').serialize(),
            success: function (xhr) {
                alert('form was submitted');
                console.log(xhr);
            }
        });

            return false;

    })


})

/*var element;

function aaa(ele){


    element = ele;
   // $('.removeItemBtn').preventDefault();
    //alert($(ele).parent('div.form-row'));
    $(ele).parent().parent()
    console.log($(ele).parent().parent());
}
*/