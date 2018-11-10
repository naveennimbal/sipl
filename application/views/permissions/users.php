<div class="col-md-12 col-lg-12 col-sm-12">
<div class="white-box">

    <h3 class="box-title"><?php //echo $func ?></h3>
    <div class="table-responsive">

<table class="table">
    <thead>
    <tr>
        <th>#</th>
        <th>Name</th>
        <th>Username</th>
        <th>Mobile</th>
        <th>View/Edit  Permissions</th>

    </tr>
    </thead>
    <tbody>
    <?php
    $x=1;
    foreach ($users as $user) {
        $url = "permissions/userpermission/".$user->id;
        ?>
    <tr>
        <td><?php echo $x?></td>
        <td><?php echo $user->name?></td>
        <td><?php echo $user->user_name?></td>
        <td><?php echo $user->mobile?></td>
        <td><?php echo anchor($url,"View / Edit")?></td>

    </tr>
    <?php $x++; }?>

    </tbody>
</table>

    </div>
</div>
</div>