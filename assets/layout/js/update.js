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

                $.each(xhr.banks, function(k, v) {
                   // console.log(k,"this is key")
                   // console.log(v,"this is val")
                   $("#vendorbank").append("<option value='"+v.id+"'>"+v.bank_name+"</option>")
                });

                $.each(xhr.gst, function(k, v) {
                    // console.log(k,"this is key")
                     //console.log(v,"this is val")
                    $("#vendorgst").append("<option value='"+v.id+"'>"+v.gst+"  ("+v.state+")</option>")
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

                itemHtml = $("#materialRow").html();




            $("#itemRow").append(itemHtml);

        };
    })( jQuery );


    (function( $ ){
        $.fn.removeItem = function(ele) {
            con = confirm("Are you sure ?")
            if(con ){
                // make the finction to delete from server

                select = $(ele).parent('div').prev('div').prev('div').prev('div').prev('div').children('select');
                parentDiv = $(ele).parent('div');
                partSelect = $(parentDiv).prev().prev().prev().prev().prev().children('select');

                itemID = $(partSelect).children("option:selected").val();
               // console.log(itemId);
                //$('.fancybox-iframe')[0].contentWindow.location.reload(true);
               // document.getElementsByClassName('fancybox-iframe').location.reload(true);
               //document.getElementsByClassName('fancybox-iframe').location.reload(true);
                $('fancybox-iframe').each(function() {
                    this.contentWindow.location.reload(true);
                });

                poID = $("#poid").val();
                console.log(poID,"poid");
                console.log(itemID,"itemid");

                $.ajax({
                    type: 'post',
                    url: window.baseurl+'porder/deleteitem',
                    data: {poid:poID,itemId:itemID},
                    success: function (xhr) {
                         console.log(xhr);
                        data = $.parseJSON(xhr)
                        if (data==="SUCCESS"){
                            alert("Item deleted  successfully");
                            $(ele).parent().parent().remove();
                           // $.fancybox.close();
                        }
                        if (data==="FAIL"){
                            alert("Something went wrong");
                           // $.fancybox.close();
                        }
                    }
                });


                return false;




                // selVal = $("select").val($(parentDiv).prev().prev().html());
                //alert(selVal);

                //$(ele).parent().parent().remove();

            }
            //alert("dfds");
            //event.stopPropagation();
            //console.log($(ele).html())


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
        return false;
    })

    $(document).on("click", '#submitItemForm', function(eve){

        $.ajax({
            type: 'post',
            url: 'porder/additems',
            data: $('form').serialize(),
            success: function (xhr) {
                console.log(xhr);
                data = $.parseJSON(xhr)
                if (data.result=="SUCCESS"){
                    alert("Item added successfully");
                    $.fancybox.close();
                }
                if (data.result=="DELETESUCCESS"){
                    alert("Item removed successfully");
                    $.fancybox.close();
                }
            }
        });

            return false;

    });


})


function updateVals(select){
    //console.log($(select).find(":selected").data('amount'));
    //$(select).next('div.form-group').html("dsjkfhksd");

    var selectParentDiv;

    selectParentDiv = $(select).parent('div');
    console.log(selectParentDiv.next('div').children('input').val("dfhdksj"));
    // This is for part name
    selectParentDiv.next('div').children('input').val("part name");
    // this is for qunatity

    selectParentDiv.next('div').next('div').children('input').val($(select).find(":selected").data('quantity'));
    selectParentDiv.next('div').next('div').next('div').children('input').val($(select).find(":selected").data('amount'));

    // setting the amount

    var qty = $(select).find(":selected").data('quantity');
    var price = $(select).find(":selected").data('amount');

    total = qty * price;

    selectParentDiv.next('div').next('div').next('div').next('div').children('input').val(total);

    //var x = document.getElementsByClassName("partSelect").next

    //console.log(x);
    $(select).next("input[name='quantity[]']").val($(select).find(":selected").data('quantity'))
    $(select).next("input[name='price[]']").val($(select).find(":selected").data('amount'))

    // seting the amount


}


function updateQty (qty) {

    var qtyVal = $(qty).val();

    parentDiv = $(qty).parent('div');
    rate = parentDiv.next('div').children('input').val();

    total = qtyVal * rate;
    parentDiv.next('div').next('div').children('input').val(total);



}

function updatePrice (price) {

    var priceVal = $(price).val();

    parentDiv = $(price).parent('div');

    qty = parentDiv.prev('div').children('input').val()

    //rate = parentDiv.next('div').children('input').val();

    total = priceVal * qty;

    parentDiv.next('div').children('input').val(total);



}


/*var element;

function aaa(ele){


    element = ele;
   // $('.removeItemBtn').preventDefault();
    //alert($(ele).parent('div.form-row'));
    $(ele).parent().parent()
    console.log($(ele).parent().parent());
}
*/