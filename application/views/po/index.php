

<div class="white-box col-md-12">



    <h3 class="box-title">Purchase Orders</h3>
   <!-- <p class="text-muted">Add class <code>.table</code></p> -->
    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr>
                <th>Order  No.</th>
                <th>vendor Name</th>
                <th>Order Date</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>


            <?php
            foreach ($orders as $order) :
            ?>
            <tr>
                <td><?php echo $order->po_no;?></td>
                <td><?php echo $order->name;?></td>
                <td><?php echo $order->po_date;?></td>


                <td><a class="addtrans" href="<?php echo base_url('porder/addtransactions')?>/<?php echo $order->id?>">Add Items</a> </td>
            </tr>
           <?php endforeach;?>

            </tbody>
        </table>
    </div>



</div>
