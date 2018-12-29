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
        <div class="col-md-12">
            <div class="white-box">
                <h3 class="box-title">Purchase Order <span style="color: #ff430d; font-weight: bold"><?php echo $podetail->po_no?></span></h3> </div>



                <!-- <p class="text-muted">Add class <code>.table</code></p> -->
            <div class="white-box">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Part No.</th>
                            <th>Part Name</th>
                            <th>Quantity</th>
                            <th>Price</th>
                        </tr>
                        </thead>
                        <tbody>


                        <?php
                        $total = 0;
                        foreach ($transaction as $trans) :
                           // var_dump($trans); exit;
                            $total = $total + $trans->price;
                            ?>
                            <tr>
                                <td><?php echo $trans->part_no;?></td>
                                <td><?php echo $trans->part_name;?></td>
                                <td><?php echo $trans->quantity;?></td>
                                <td><?php echo $trans->price;?></td>




                            </tr>
                        <?php endforeach;?>
                        <tr>
                            <th colspan="2"> </th>
                            <th> Total </th>
                            <th> <?php echo $total?> </th>

                        </tr>

                        </tbody>
                    </table>
                </div>
            </div>







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
