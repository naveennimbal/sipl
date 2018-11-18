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
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="../plugins/images/favicon.png">
    <title>SIPL Dashboard</title>
    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url()."assets/layout/"?>bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="<?php echo base_url()."assets/layout/"?>bootstrap/dist/css/bootstrap-datepicker3.standalone.min.css" rel="stylesheet">
    <!-- Menu CSS -->
    <link href="<?php echo base_url()."assets/layout/"?>/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css" rel="stylesheet">
    <!-- toast CSS -->
    <link href="<?php echo base_url()."assets/layout/"?>/plugins/bower_components/toast-master/css/jquery.toast.css" rel="stylesheet">
    <!-- morris CSS -->
    <link href="<?php echo base_url()."assets/layout/"?>/plugins/bower_components/morrisjs/morris.css" rel="stylesheet">
    <!-- chartist CSS -->
    <link href="<?php echo base_url()."assets/layout/"?>/plugins/bower_components/chartist-js/dist/chartist.min.css" rel="stylesheet">
    <link href="<?php echo base_url()."assets/layout/"?>/plugins/bower_components/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.css" rel="stylesheet">
    <!-- animation CSS -->
    <link href="<?php echo base_url()."assets/layout/"?>css/animate.css" rel="stylesheet">
    <link href="<?php echo base_url()."assets/layout/"?>css/icons/linea-icons/linea.css" rel="stylesheet">
    <link href="<?php echo base_url()."assets/layout/"?>css/icons/material-design-iconic-font/css/materialdesignicons.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?php echo base_url()."assets/layout/"?>css/jquery.fancybox.min.css" rel="stylesheet">
    <link href="<?php echo base_url()."assets/layout/"?>css/style.css" rel="stylesheet">

    <!-- color CSS -->
    <link href="<?php echo base_url()."assets/layout/"?>css/colors/default.css" id="theme" rel="stylesheet">
    <script type="application/javascript">
        window.baseurl ="<?php echo base_url()?>";
    </script>


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body class="fix-header">
<!-- ============================================================== -->
<!-- Preloader -->
<!-- ============================================================== -->

<!-- ============================================================== -->
<!-- Wrapper -->
<!-- ============================================================== -->
<div id="wrapper">
    <!-- ============================================================== -->
    <!-- Topbar header - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <nav class="navbar navbar-default navbar-static-top m-b-0">
        <div class="navbar-header">
            <div class="top-left-part">
                <!-- Logo -->
                <h1 style="color: #170ddf;" align="center">SIPL</h1>
            </div>
            <!-- /Logo -->
            <ul class="nav navbar-top-links navbar-right pull-right">

                <li class="dropdown">
                    <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#"> <b class="hidden-xs"><?php echo ucfirst($userData->name)?></b> <span class="fa fa-angle-double-down"></span> </a>
                    <ul class="dropdown-menu dropdown-user animated flipInY">
                        <li>
                            <div class="dw-user-box">

                                <div class="u-text">
                                    <a href="<?php echo base_url("login/logout")?>" class="btn btn-rounded btn-danger btn-sm" style="padding-right: 3em; padding-left: 3em;margin-left: 3em;">Logout</a></div>
                            </div>
                        </li>

                    </ul>
                </li>
            </ul>
        </div>
        <!-- /.navbar-header -->
        <!-- /.navbar-top-links -->
        <!-- /.navbar-static-side -->
    </nav>
    <!-- End Top Navigation -->
    <!-- ============================================================== -->
    <!-- Left Sidebar - style you can find in sidebar.scss  -->
    <!-- ============================================================== -->
    <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav slimscrollsidebar">
            <div class="sidebar-head">
                <h3><span class="fa-fw open-close"><i class="ti-close ti-menu"></i></span> <span class="hide-menu">Navigation</span></h3>
            </div>
 <ul class="nav" id="side-menu">
                <li style="padding: 70px 0 0;">
                    <a href="<?php echo site_url('main/dashboard')?>" class="waves-effect"><i class="fa fa-clock-o fa-fw" aria-hidden="true"></i>Dashboard</a>
                </li>
                              


                    

                <li>

                    <a href="#" class="waves-effect"> <i class="fa fa-th-list"></i>
                        <span class="hide-menu"> Masters <span class="fa arrow"></span> </span>
                    </a>


                    <ul class="nav nav-second-level collapse"  style="">


		                <li>
		                    <a href="<?php echo site_url('main/company')?>" class="waves-effect"><i class="fa fa-clock-o fa-fw" aria-hidden="true"></i>Company</a>
		                </li>
		                <li>
		                    <a href="<?php echo site_url('main/role')?>" class="waves-effect"><i class="fa fa-user fa-fw" aria-hidden="true"></i>Roles</a>
		                </li>
		                <li>
		                    <a href="<?php echo site_url('main/user')?>" class="waves-effect"><i class="fa fa-table fa-fw" aria-hidden="true"></i>User</a>
		                </li>
		                
		                 <li>
		                    <a href="<?php echo site_url('permissions')?>" class="waves-effect"><i class="fa fa-info-circle fa-fw" aria-hidden="true"></i>Permissions</a>
		                </li>                    
		                                
                <li>
                    <a href="<?php echo site_url('main/uom')?>" class="waves-effect"><i class="fa fa-font fa-fw" aria-hidden="true"></i>Measurement Unit</a>
                </li>
                <li>
                    <a href="<?php echo site_url('main/material')?>" class="waves-effect"><i class="fa fa-globe fa-fw" aria-hidden="true"></i>Material</a>
                </li>
                <li>
                    <a href="<?php echo site_url('main/state')?>" class="waves-effect"><i class="fa fa-columns fa-fw" aria-hidden="true"></i>State</a>
                </li>
                <li>
                    <a href="<?php echo site_url('main/vehiclemaster')?>" class="waves-effect"><i class="fa fa-info-circle fa-fw" aria-hidden="true"></i>Vehicle Master</a>
                </li>
                
                        <li>
                            <a href="<?php echo site_url('main/policies')?>" class="waves-effect"><i class="fa fa-clock-o fa-fw" aria-hidden="true"></i>Vehicle Policies</a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('main/vehicletax')?>" class="waves-effect"><i class="fa fa-user fa-fw" aria-hidden="true"></i>Vehicle Taxation</a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('main/vendor')?>" class="waves-effect"><i class="fa fa-table fa-fw" aria-hidden="true"></i>Vendor Master</a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('main/vendorbank')?>" class="waves-effect"><i class="fa fa-font fa-fw" aria-hidden="true"></i>Vendor Banks</a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('main/project')?>" class="waves-effect"><i class="fa fa-globe fa-fw" aria-hidden="true"></i>Project Master</a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('main/property')?>" class="waves-effect"><i class="fa fa-columns fa-fw" aria-hidden="true"></i>Property Master</a>
                        </li>


                    </ul>

                <li>

                    <a href="#" class="waves-effect"> <i class="fa fa-th-list"></i>
                        <span class="hide-menu"> Transactions <span class="fa arrow"></span> </span>
                    </a>


                    <ul class="nav nav-second-level collapse"  style="">               
                
                <li>
                    <a href="<?php echo site_url('main/purchaseorder')?>" class="waves-effect"><i class="fa fa-globe fa-fw" aria-hidden="true"></i>Purchase Order</a>
                </li>

                        <li>
                            <a href="<?php echo site_url('main/personalexpense')?>" class="waves-effect"><i class="fa fa-info-circle fa-fw" aria-hidden="true"></i>Personal Expense Master</a>
                        </li>
                                                                           
                <li>
                    <a href="<?php echo site_url('main/vehiclemovement')?>" class="waves-effect"><i class="fa fa-info-circle fa-fw" aria-hidden="true"></i>Vehicle Movement</a>
                </li>                

                <li>
                    <a href="<?php echo site_url('main/Quotations')?>" class="waves-effect"><i class="fa fa-info-circle fa-fw" aria-hidden="true"></i>Quotation Item/Req.</a>
                </li>                

                <li>
                    <a href="<?php echo site_url('main/projectdpr')?>" class="waves-effect"><i class="fa fa-info-circle fa-fw" aria-hidden="true"></i>Project DPR</a>
                </li>                                

                <li>
                    <a href="<?php echo site_url('main/machinedpr')?>" class="waves-effect"><i class="fa fa-info-circle fa-fw" aria-hidden="true"></i>Machine DPR</a>
                </li>
                                    
                    </ul>

                 <li style="margin-top: 2em;">
                         <div class="u-text">
                              <a href="<?php echo base_url("login/logout")?>" class="btn btn-rounded btn-danger btn-sm" style="margin-left:1em;color:#FFF;width: 80%;">Logout</a></div>
                         </div>

                  </li>


            </ul>

        </div>

    </div>
    <!-- ============================================================== -->
    <!-- End Left Sidebar -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Page Content -->
    <!-- ============================================================== -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row bg-title">
                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                    <h4 class="page-title">Dashboard</h4> </div>
                <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                    <ol class="breadcrumb">
                        <li><a href="#">Dashboard</a></li>
                    </ol>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <!-- ============================================================== -->
            <!-- Different data widgets -->
            <!-- ============================================================== -->
            <!-- .row -->





            <div class="row">


                            <?php echo $output; ?>


            </div>
            <!-- ============================================================== -->
            <!-- chat-listing & recent comments -->
            <!-- ============================================================== -->

        </div>
        <!-- /.container-fluid -->
        <footer class="footer text-center"> &copy;Copyright Vidhiinfosol </footer>
    </div>
    <!-- ============================================================== -->
    <!-- End Page Content -->
    <!-- ============================================================== -->
</div>
<!-- ============================================================== -->
<!-- End Wrapper -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- All Jquery -->
<!-- ============================================================== -->
<script src="<?php echo base_url()."assets/layout/"?>/plugins/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap Core JavaScript -->
<script src="<?php echo base_url()."assets/layout/"?>bootstrap/dist/js/bootstrap.min.js"></script>
<script src="<?php echo base_url()."assets/layout/"?>bootstrap/dist/js/bootstrap-datepicker.min.js"></script>
<!-- Menu Plugin JavaScript -->
<script src="<?php echo base_url()."assets/layout/"?>/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js"></script>
<!--slimscroll JavaScript -->
<script src="<?php echo base_url()."assets/layout/"?>js/jquery.slimscroll.js"></script>
<!--Wave Effects -->
<script src="<?php echo base_url()."assets/layout/"?>js/waves.js"></script>

<!--Counter js -->
<script src="<?php echo base_url()."assets/layout/"?>/plugins/bower_components/waypoints/lib/jquery.waypoints.js"></script>
<script src="<?php echo base_url()."assets/layout/"?>/plugins/bower_components/counterup/jquery.counterup.min.js"></script>
<!-- chartist chart -->
<script src="<?php echo base_url()."assets/layout/"?>/plugins/bower_components/chartist-js/dist/chartist.min.js"></script>
<script src="<?php echo base_url()."assets/layout/"?>/plugins/bower_components/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.min.js"></script>
<!-- Sparkline chart JavaScript -->

<script src="<?php echo base_url()."assets/layout/"?>/plugins/bower_components/jquery-sparkline/jquery.sparkline.min.js"></script>
<script src="<?php echo base_url()."assets/layout/"?>/js/jquery.fancybox.min.js"></script>
<!-- Custom Theme JavaScript -->
<script src="<?php echo base_url()."assets/layout/"?>js/custom.min.js?<?php echo time(); ?>"></script>
<script src="<?php echo base_url()."assets/layout/"?>js/update.js?<?php echo time(); ?>"></script>

</body>

</html>
