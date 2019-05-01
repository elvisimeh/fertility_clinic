<?php

	session_start();
    
    $staffname = $_SESSION['staffname'];
if(!isset($staffname)){
	header("location:../../index");
	session_destroy();
	exit;
}

    require_once("controller_lib.php");

    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    $obj = new IVF;

    $time_assessed =  $_POST['time_assessed'];
    $prep_time =  $_POST['prep_time'];
    $prep_method =  $_POST['prep_method'];
    $vol_assessed = $_POST['vol_assessed'];
    $motile_count = $_POST['motile_count'];
    $motile_rapid = $_POST['motile_rapid'];
    $motile_slow = $_POST['motile_slow'];
    $embryologist = $_POST['embryologist'];
    $comment = $_POST['comment'];
    $bcode = $_POST['bcode'];
    $ccode = $_POST['ccode'];
    $ivfno = $_POST['ivfno'];
    
    $date = date('Y-m-d');
    $time = date('h:i:sa');


    if(isset($_POST['qm'])){
     $obj->sperm_post_prep($time_assessed,$prep_time,$prep_method,$vol_assessed,$motile_count,$motile_rapid,
     $motile_slow,$comment,$embryologist,$ivfno,$bcode,$ccode,$date,$time);
    }

?>