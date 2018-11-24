

<div class="white-box col-md-12">

    <h3 class="box-title">Add Purchase Order</h3>

        <form method="post" action="<?php base_url('porder/add')?>">
            <div class="form-row">
            
                <div class="form-group col-md-6">
                    <label for="inputPassword4">P.O. Number</label>
                    <input type="text" class="form-control" required id="po_no" name="po_no" placeholder="Order Number" value="SIPL/<?php echo $poid?>" readonly>
                </div>
                            
                <div class="form-group col-md-6">
                    <label for="inputEmail4">P.O. Date</label>
                    <input type="text" class="form-control datepicker" required id="podate" name="po_date" placeholder="Order Date" autocomplete="off">
                </div>

                
            </div>                


            <div class="form-row">

               <div class="form-group col-md-6">
                    <label for="inputCompany">Company</label>
                    <select id="company" class="form-control" name="company">
                        <option selected>Choose...</option>

                        <?php

                        foreach($companies as $company){
                            echo "<option value='".$company->id."'> ".ucfirst($company->name)." </option>";
                        }
                        ?>
                    </select>
                </div>
                
               <div class="form-group col-md-6">
                    <label for="refno">Ref. No</label>
                    <input type="text" class="form-control" id="refno" name="refno">
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
                <div class="form-group col-md-6">
                    <label for="remark">Particulars</label>
                    <input type="text" class="form-control" id="remark" name="remarks" placeholder="Particulars if any">
                </div>

                <div class="form-group col-md-6">
                    <label for="gst">Vendor GST</label>
                    <select id="vendorgst" name="vendor_gst" class="form-control">
                        <option selected>Choose...</option>

                    </select>
                </div>


            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="freight">Frieght</label>
                    <input type="number" step="0.01" pattern="^\d+(?:\.\d{1,2})?$" class="form-control" id="freight" name="freight" placeholder="Freight if any" required="required">
                </div>

                <div class="form-group col-md-6">
                    <label for="inputState">GST Type</label>
                    <select id="gst" name="gst_type" class="form-control">
                        <option selected>Choose...</option>
                        <option value="Same State">Same State</option>
                        <option value="Other State">Other State</option>

                    </select>
                </div>

            </div>
            
            <div class="form-row">
                <div class="form-group col-md-12">
                    <button type="submit" class="btn btn-primary">Add Order</button>
                </div>




            </div>

        </form>


</div>
