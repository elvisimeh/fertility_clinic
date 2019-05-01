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

    $to_date = $_POST['to_date'];
    $pt =  $_POST['pt'];
    $test_date =  $_POST['test_date'];
    $pregnancy_outcome =  $_POST['pregnancy_outcome'];
    $scan_confirmation = $_POST['scan_confirmation'];
    $delivery_date = $_POST['delivery_date'];
    $live_birth = $_POST['live_birth'];
    $posted_by = $_SESSION['id'];
    $comment = $_POST['comment'];
    
    $ivfno = $_POST['ivfno'];
    $bcode = $_POST['bcode'];
    $ccode = $_POST['ccode'];
    $date = date('Y-m-d');
    $time = date('h:i:sa');


    
     $obj->treatment_outcome($pt,$test_date,$pregnancy_outcome,$scan_confirmation,$delivery_date,$live_birth,
     $posted_by,$ivfno,$bcode,$ccode,$date,$time,$to_date,$comment);
    

?>