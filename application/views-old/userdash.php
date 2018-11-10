
<?php //var_dump($output); exit;

foreach ($output as $table => $count)
{
   // echo $table."---".$count;
    //var_dump($count); exit;
    ?>


    <div class="col-lg-3 col-sm-6 col-xs-12">
        <a href="<?php echo base_url().$count['link']?>">
                    <div class="white-box analytics-info">
                        <h3 class="box-title"><?php echo $table?></h3>
                        <ul class="list-inline two-part">
                            <li><i class="fa <?php echo $count['class']?>" style="margin-left: 0.5em; font-size: 3em; color: <?php echo $count['color']?>"></i></li>
                            <li class="text-right"><span class="counter" style="color: <?php echo $count['color']?>"><?php echo $count['count']?></span></li>
                        </ul>
                    </div>
        </a>
                </div>

<?php } ?>
