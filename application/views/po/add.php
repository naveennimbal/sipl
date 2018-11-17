

<div class="white-box col-md-12">

    <h3 class="box-title">Add Purchase Order</h3>

        <form method="post" action="<?php base_url('porder/add')?>">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputEmail4">Order Date</label>
                    <input type="text" class="form-control datepicker" required id="podate" name="po_date" placeholder="Order Date">
                </div>
                <div class="form-group col-md-6">
                    <label for="inputPassword4">Order Number</label>
                    <input type="text" class="form-control" required id="po_no" name="po_no" placeholder="Order Number">
                </div>
            </div>

            <div class="form-row">
            <div class="form-group col-md-6">

                <label for="inputAddress">Site Address</label>

                <input type="text" class="form-control" id="inputAddress" name="site_address" placeholder="1234 Main St">

            </div>
            <div class="form-group  col-md-6">
                <label for="inputAddress2">Shipping Address </label>
                <input type="text" class="form-control" id="inputAddress2" name="shipping_address" placeholder="Apartment, studio, or floor">
            </div>
            </div>


            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputCity">Vendor</label>
                    <select id="vendor" class="form-control" name="vendor">
                        <option selected>Choose...</option>

                        <?php

                        foreach($vendors as $vendor){
                            echo "<option value='".$vendor->id."'> ".ucfirst($vendor->name)." </option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="form-group col-md-6">
                    <label for="inputState">Vendor Bank</label>
                    <select id="vendorbank" name="vendor_bank" class="form-control">
                        <option selected>Choose...</option>

                    </select>
                </div>


            </div>



            <!--<div class="form-row">


                <div class="form-group  col-md-10">

                </div>

                <div class="form-group  col-md-2">
                    <button class="btn btn-success"><span class="glyphicon glyphicon-plus-sign"></span> Add more Items</button>
                </div>
            </div>


            <div id="itemRow">
            <div class="form-row">
                <div class="form-group col-md-3">

                    <label for="inputAddress">Part Number</label>

                    <input type="text" class="form-control" id="inputAddress" name="site_address" placeholder="1234 Main St">

                </div>
                <div class="form-group  col-md-3">
                    <label for="inputAddress2">Part Name </label>
                    <input type="text" class="form-control" id="inputAddress2" name="shipping_address" placeholder="Apartment, studio, or floor">
                </div>

                <div class="form-group  col-md-2">
                    <label for="inputAddress2">Quantity </label>
                    <input type="text" class="form-control" id="inputAddress2" name="shipping_address" placeholder="Apartment, studio, or floor">
                </div>

                <div class="form-group  col-md-3">
                    <label for="inputAddress2">Amount </label>
                    <input type="text" class="form-control" id="inputAddress2" name="shipping_address" placeholder="Apartment, studio, or floor">
                </div>

                <div class="form-group  col-md-1">
                    <label for="inputAddress2">&nbsp; </label>
                    <button class="btn btn-danger"><span class="glyphicon glyphicon-plus-sign"></span>Remove</button>
                </div>

            </div>

            </div> -->



            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="remark">Remarks</label>
                    <input type="text" class="form-control" id="remark" name="remarks" placeholder="Remarks if any">
                </div>




            </div>

            <div class="form-row">
                <div class="form-group col-md-12">
                    <button type="submit" class="btn btn-primary">Add Order</button>
                </div>




            </div>

        </form>


</div>
