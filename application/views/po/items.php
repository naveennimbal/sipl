<!DOCTYPE html>
<html lang="en">
<?php
//echo "<pre>";
$userData = $this->session->userdata("user");
//var_dump($userData->name); exit;

?>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url()."assets/layout/"?>bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">


    <link href="<?php echo base_url()."assets/layout/"?>css/style.css" rel="stylesheet">

    <!-- color CSS -->
    <link href="<?php echo base_url()."assets/layout/"?>css/colors/default.css" id="theme" rel="stylesheet">
    <script type="application/javascript">
        window.baseurl ="<?php echo base_url()?>";
    </script>


</head>

<body class="fix-header">

<div id="wrapper">




    <div class="row">
        <div class="col-md-11">
            <div class="white-box">
                <h3 class="box-title">Items of Purchase Order <span style="color: #ff430d; font-weight: bold"><?php echo $podetail->po_no?></span></h3> </div>


            <div class="form-row">


                <div class="form-group  col-md-10">

                </div>

                <div class="form-group  col-md-2">
                    <button class="btn btn-success" id="addItemBtn"><span class="glyphicon glyphicon-plus-sign"></span> Add Items</button>
                </div>
            </div>


    <form id="itemform" method="post">
            <div id="itemRow">

                <input type="hidden" name="poid" value="<?php echo $podetail->id?>">

                <?php
                if(count($transaction)>0){
                    foreach ($transaction as $trans ) {

                        //var_dump($trans); exit;
                        ?>
                        <div class="form-row" id="materialRow">
                            <div class="form-group col-md-3">

                                <label for="inputAddress">Part Number</label>

                                <input type="text" class="form-control" id="inputAddress" name="part_number[]" value="<?php echo $trans->part_no?>">

                            </div>
                            <div class="form-group  col-md-6">
                                <label for="inputAddress2">Part Name </label>
                                <input type="text" class="form-control" id="inputAddress2" name="part_name[]" value="<?php echo $trans->part_name?>">
                            </div>

                            <div class="form-group  col-md-1">
                                <label for="inputAddress2">Quantity </label>
                                <input type="text" class="form-control" id="inputAddress2" name="quantity[]" value="<?php echo $trans->quantity?>">
                            </div>

                            <div class="form-group  col-md-1">
                                <label for="inputAddress2">Price </label>
                                <input type="text" class="form-control" id="inputAddress2" name="price[]" value="<?php echo $trans->price?>">
                            </div>

                            <div class="form-group  col-md-1">
                                <label for="inputAddress2">&nbsp;Remove </label>
                                <button class="btn btn-danger removeItemBtn"><span class="glyphicon glyphicon-minus-sign"></span> Remove</button>
                            </div>

                        </div>

                        <?php
                    }
                } else{
                    ?>

                    <div class="form-row" id="materialRow" >
                        <div class="form-group col-md-3">

                            <label for="inputAddress">Part Number</label>



                            <select name="part_number[]" class="form-control partSelect" onchange="updateVals(this);">
                                <option value="" selected="selected">Select Item</option>
                                <?php
                                foreach ($materials as $material){

                                    ?>

                                    <option value="<?php echo $material->id?>" data-amount="<?php echo $material->amount?>" data-quantity="<?php echo $material->quantity?>"> <?php echo $material->part_no?> </option>

                                <?php
                                }

                                ?>

                            </select>


                        </div>
                        <div class="form-group  col-md-6">
                            <label for="inputAddress2">Part Name </label>
                            <input type="text" class="form-control partName"  name="part_name[]" value="<?php //echo $trans->part_name?>">
                        </div>

                        <div class="form-group  col-md-1">
                            <label for="inputAddress2">Quantity </label>
                            <input type="text" class="form-control quantity" id="inputAddress2" name="quantity[]" value="<?php //echo $trans->quantity?>">
                        </div>

                        <div class="form-group  col-md-1">
                            <label for="inputAddress2">Price </label>
                            <input type="text" class="form-control price" id="inputAddress2" name="price[]" value="<?php //echo $trans->price?>">
                        </div>

                        <div class="form-group  col-md-1">
                            <label for="inputAddress2">&nbsp;Remove </label>
                            <button class="btn btn-danger removeItemBtn"><span class="glyphicon glyphicon-minus-sign"></span> Remove</button>
                        </div>

                    </div>


                <?php

                }
                ?>

                <!--<div class="form-row">
                    <div class="form-group col-md-3">

                        <label for="inputAddress">Part Number</label>

                        <input type="text" class="form-control" id="inputAddress" name="part_number[]" placeholder="">

                    </div>
                    <div class="form-group  col-md-6">
                        <label for="inputAddress2">Part Name </label>
                        <input type="text" class="form-control" id="inputAddress2" name="part_name[]" placeholder="">
                    </div>

                    <div class="form-group  col-md-1">
                        <label for="inputAddress2">Quantity </label>
                        <input type="text" class="form-control" id="inputAddress2" name="quantity[]" placeholder="">
                    </div>

                    <div class="form-group  col-md-1">
                        <label for="inputAddress2">Price </label>
                        <input type="text" class="form-control" id="inputAddress2" name="price[]" placeholder="">
                    </div>

                    <div class="form-group  col-md-1">
                        <label for="inputAddress2">&nbsp;Remove </label>
                        <button class="btn btn-danger removeItemBtn"><span class="glyphicon glyphicon-minus-sign"></span> Remove</button>
                    </div>

                </div> -->







            </div>

        <div class="form-row">
            <div class="form-group col-md-10"></div>
            <div class="form-group col-md-2">



                <input type="submit" class="btn btn-default" id="submitItemForm" value="Add item to Order">

            </div>
        </div>

            </div>
    </form>


        </div>
    </div>






    <!-- ============================================================== -->
<!-- End Page Content -->
<!-- ============================================================== -->
</div>

<script src="<?php echo base_url()."assets/layout/"?>/plugins/bower_components/jquery/dist/jquery.min.js"></script>

<script src="<?php echo base_url()."assets/layout/"?>js/update.js?<?php echo time(); ?>"></script>

</body>

</html>
