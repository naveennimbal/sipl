
<style>
    .switch {
        position: relative;
        display: inline-block;
        width: 40px;
        height: 24px;
    }

    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        -webkit-transition: .4s;
        transition: .4s;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 16px;
        width: 16px;
        left: 4px;
        bottom: 4px;
        background-color: white;
        -webkit-transition: .4s;
        transition: .4s;
    }

    input:checked + .slider {
        background-color: #2196F3;
    }

    input:focus + .slider {
        box-shadow: 0 0 1px #2196F3;
    }

    input:checked + .slider:before {
        -webkit-transform: translateX(16px);
        -ms-transform: translateX(16px);
        transform: translateX(16px);
    }

    /* Rounded sliders */
    .slider.round {
        border-radius: 34px;
    }

    .slider.round:before {
        border-radius: 50%;
    }
</style>


<table class="table">
    <thead>
    <tr>
        <th>#</th>
        <th>Action </th>
        <th>Username</th>
        <th>View</th>
        <th>Add</th>
        <th>Edit</th>
        <th>Delete</th>

    </tr>
    </thead>
    <tbody>
    <?php


    $x=1;
    foreach ($rights as $right) {
        //var_dump($right); exit;
        $url = "permissions/userpermission/".$right->user_id;
        ?>
    <tr>
        <td><?php echo $x?></td>
        <td><?php echo $right->table_reference?></td>
        <td><?php echo $right->user_name?></td>
        <?php $checked = "";
            if($right->is_list=="Yes"){
                $checked = "checked";
            }
        ?>
        <td>
            <label class="switch">
            <input class="updateRight" type="checkbox" name="<?php echo $right->table_name?>###<?php echo $right->user_id?>###is_list" value="Yes" <?php echo $checked ?>>
                <span class="slider round"></span>
            </label>
        </td>
        <?php $checked = "";
        if($right->is_add=="Yes"){
            $checked = "checked";
        }
        ?>
        <td>
            <label class="switch">
            <input class="updateRight"  type="checkbox" name="<?php echo $right->table_name?>###<?php echo $right->user_id?>###is_add" value="Yes" <?php echo $checked ?>>
                <span class="slider round"></span>
            </label>
        </td>
        <?php $checked = "";
        if($right->is_edit=="Yes"){
            $checked = "checked";
        }
        ?>
        <td>
            <label class="switch">
            <input class="updateRight"  type="checkbox" name="<?php echo $right->table_name?>###<?php echo $right->user_id?>###is_edit" value="Yes" <?php echo $checked ?>>
                <span class="slider round"></span>
            </label>
        </td>
        <?php $checked = "";
        if($right->is_delete=="Yes"){
            $checked = "checked";
        }
        ?>
        <td>
            <label class="switch">
            <input class="updateRight"  type="checkbox" name="<?php echo $right->table_name?>###<?php echo $right->user_id?>###is_delete" value="Yes" <?php echo $checked ?>>
                <span class="slider round"></span>
            </label>
        </td>
        <td><?php //echo anchor($url,"View / Edit")?></td>

    </tr>
    <?php $x++; }?>

    </tbody>
</table>

<!-- Trigger the modal with a button -->


<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content" style="padding: 0px;">


                <div class="alert alert-success" style="margin-bottom:0px !important;">
                    <strong>Sucess</strong> You have sucessfuly updated the user right. <a href="#" data-dismiss="modal" style="font-size: 1.2em; float: right; margin-right: 15px; margin-bottom: 15px;color: #FFF "> X </a>
                </div>


        </div>

    </div>
</div>

<div id="loadingModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content" style="padding: 0px;">


            <div class="alert alert-info" style="margin-bottom:0px !important;">
                <strong>Updating Please Wait</strong>
            </div>


        </div>

    </div>
</div>

<div id="errorModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content" style="padding: 0px;">


            <div class="alert alert-danger" style="margin-bottom:0px !important;">
                <strong>Some went wrong , </strong> Please try again  <a href="#" data-dismiss="modal" style="font-size: 1.2em; float: right; margin-right: 15px; margin-bottom: 15px;color: #FFF "> X </a>
            </div>


        </div>

    </div>
</div>