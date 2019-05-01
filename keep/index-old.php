<?php
session_start();
$staffname = $_SESSION['staffname'];
if(!isset($staffname)){
	header("location:../../index");
	exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("header.php");?>
</head>

<body class="fix-header">
    <!-- ============================================================== -->
    <!-- Preloader -->
    <!-- ============================================================== -->
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10"/>
        </svg>
    </div>
    <!-- ============================================================== -->
    <!-- Wrapper -->
    <!-- ============================================================== -->
    <div id="wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <?php include("header-topbar.php");?>
        <!-- End Top Navigation -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav">
            <div class="sidebar-head">
                <h3><span class="fa-fw open-close"><i class="ti-menu hidden-xs"></i><i class="ti-close visible-xs"></i></span> <span class="hide-menu">Navigation</span></h3> </div>
            <ul class="nav" id="side-menu">
                <li class="user-pro">
                    <a href="javascript:void(0)" class="waves-effect"><img src="../../upload/img/users/photo2.jpg" alt="user-img" class="img-circle"> <span class="hide-menu"> <?php echo $staffname;?><span class="fa arrow"></span></span>
                    </a>
                    <ul class="nav nav-second-level collapse" aria-expanded="false" style="height: 0px;">
                        <li><a href="javascript:void(0)"><i class="ti-user"></i> <span class="hide-menu">My Profile</span></a></li>
                        <li><a href="javascript:void(0)"><i class="ti-wallet"></i> <span class="hide-menu">My Balance</span></a></li>
                        <li><a href="javascript:void(0)"><i class="ti-email"></i> <span class="hide-menu">Inbox</span></a></li>
                        <li><a href="javascript:void(0)"><i class="ti-settings"></i> <span class="hide-menu">Account Setting</span></a></li>
                        <li><a href="../../controllers/user/logout"><i class="fa fa-power-off"></i> <span class="hide-menu">Logout</span></a></li>
                    </ul>
                </li>
                <li class="dashstyle"> <a href="index" class="waves-effect"><i class="mdi mdi-av-timer fa-fw" data-icon="v"></i> 
                    <span class="hide-menu"> Dashboard <!--span class="fa arrow"></span> 
                    <span class="label label-rouded label-inverse pull-right">4</span></span--></a>
                </li>
                <li> <a href="existingpatientpost" class="waves-effect"><i  class="mdi mdi-account-edit fa-fw"></i> 
                        <span class="hide-menu">Existing Patient</span></a> 
                </li>
                <li class="devider"></li>
                <!--li> <a href="newpatientreg" class="waves-effect"><i  class="mdi mdi-account-plus fa-fw"></i> 
                    <span class="hide-menu">Patient Registration</span></a>
                </li-->
                <li><a href="javascript:void(0)" class="waves-effect"><i class="mdi mdi-account-plus fa-fw"></i> 
                        <span class="hide-menu">Patient Registration<span class="fa arrow"></span></span></a>
                    <ul class="nav nav-second-level">
                        <li> <a href="newpatientreg"><span class="hide-menu">New Registration</span></a></li>
                        <li> <a href="patientregonly"><span class="hide-menu">Registration Only</span></a></li>
                    </ul>
                </li>
                <li> <a href="#" class="waves-effect"><i  class="mdi mdi-baby fa-fw"></i> 
                        <span class="hide-menu">Ante Natal</span></a> 
                </li>
                <li><a href="javascript:void(0)" class="waves-effect"><i class="mdi mdi-baby fa-fw"></i> 
                        <span class="hide-menu">Immunization<span class="fa arrow"></span></span></a>
                    <ul class="nav nav-second-level">
                        <li><a href="#"> <span class="hide-menu">New Walk-In Patient</span></a></li>
                        <li><a href="#"><span class="hide-menu">Existing Walk-In Patient</span></a></li>
                    </ul>
                </li>
                <li> <a href="javascript:void(0)" class="waves-effect"><i class="mdi mdi-chart-areaspline fa-fw"></i> 
                <span class="hide-menu">Reportage<span class="fa arrow"></span><span class="label label-rouded label-danger pull-right">9</span></span></a>
                    <ul class="nav nav-second-level">
                        <li><a href="#"></i><span class="hide-menu">Daily Report (FD)</span></a></li>
                        <li><a href="complain"></i><span class="hide-menu">Complain (System)</span></a></li>
                        <li><a href="incidence"></i><span class="hide-menu">Incidence (QA)</span></a></li>
                    </ul>
                </li>
                <li class="devider"></li>
                <li> <a href="javascript:void(0)" class="waves-effect"><i class="mdi mdi-settings fa-fw"></i> 
                <span class="hide-menu">Setup<span class="fa arrow"></span><span class="label label-rouded label-danger pull-right">9</span></span></a>
                    <ul class="nav nav-second-level">
                        <li><a href="familysetup"><span class="hide-menu">New Family</span></a></li>
                        <li><a href="#"><span class="hide-menu">Package Creation</span></a></li>
                    </ul>
                </li>
                </li>
            </ul>
        </div>
    </div>
        <!-- Left navbar-header end -->
        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row bg-title">
                    <!-- .page title -->
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Dashboard</h4> 
                    </div>
                    <!-- /.page title -->
                    <!-- .breadcrumb -->
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12"> 
                        <button class="right-side-toggle waves-effect waves-light btn-info btn-circle pull-right m-l-20">
                            <i class="ti-settings text-white"></i>
                        </button>
                        
                        <ol class="breadcrumb">
                            <li><a href="javascript:void(0)">Lily Hospitals Limited</a></li>
                            <li class="active">Warri</li>
                        </ol>
                    </div>
                    <!-- /.breadcrumb -->
                </div>
                <!-- .row -->
                <div class="row">
                            <div class="col-lg-3 col-sm-6 col-xs-12">
                                <div class="white-box">
                                    <h3 class="box-title">NEW REGISTRATION LIST</h3>
                                    <ul class="list-inline two-part">
                                        <li><i class="icon-people text-info"></i></li>
                                        <li class="text-right"><span class="counter">23</span></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6 col-xs-12">
                                <div class="white-box">
                                    <h3 class="box-title">DAILY PATIENTS VISIT</h3>
                                    <ul class="list-inline two-part">
                                        <li><i class="icon-folder text-purple"></i></li>
                                        <li class="text-right"><span class="counter">169</span></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6 col-xs-12">
                                <div class="white-box">
                                    <h3 class="box-title">Online Appointment</h3>
                                    <ul class="list-inline two-part">
                                        <li><i class="icon-folder-alt text-danger"></i></li>
                                        <li class="text-right"><span class="">58</span></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6 col-xs-12">
                                <div class="white-box">
                                    <h3 class="box-title">Available Doctors</h3>
                                    <ul class="list-inline two-part">
                                        <li><i class="icon-user text-success"></i></li>
                                        <li class="text-right"><span class="">4</span></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                <!-- /.row -->
                
                <!-- .row -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="white-box">
                            <h3 class="box-title">Online Appointment Table List</h3> </div>
                    </div>
                </div>
                <!-- .row -->
                <!-- .row -->
                <div class="row">
                    <div class="col-md-8">
                        <div class="white-box">
                            <h3 class="box-title">New Registration Table List</h3> </div>
                    </div>
                    <div class="col-md-4">
                        <div class="white-box">
                            <h3 class="box-title">Available Doctor Table List</h3> </div>
                    </div>
                </div>
                <!-- .row -->
                <!-- .row -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="white-box">
                            <h3 class="box-title">Blank Starter page</h3> </div>
                    </div>
                </div>
                <!-- .row -->
                <!-- .right-sidebar -->
                <?php include("sidebar-message.php");?>
                <!-- /.right-sidebar -->
            </div>
            <!-- /.container-fluid -->
            <?php include("copyright.php");?>
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->
    <?php include("footer.php");?>
</body>

</html>