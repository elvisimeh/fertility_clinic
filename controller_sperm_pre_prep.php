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

    $hs =  $_POST['hs'];
    $ds =  $_POST['ds'];
    $fs =  $_POST['fs'];
    $method_collection = $_POST['method_collection'];
    $abstinence = $_POST['abstinence'];
    $time_produced = $_POST['time_produced'];
    $time_delivered = $_POST['time_delivered'];
    $time_assessed = $_POST['time_assessed'];
    $volume = $_POST['volume'];
    $viscosity = $_POST['viscosity'];
    $liquefaction = $_POST['liquefaction'];
    $conc_count = $_POST['conc_count'];
    $motile_count = $_POST['motile_count'];
    $motility = $_POST['motility'];
    $total_count = $_POST['total_count'];
    $agglutination = $_POST['agglutination'];
    $instrument_used = $_POST['instrument_used'];
    $comment = $_POST['comment'];
    $embryologist = $_POST['embryologist'];
    $ivfno = $_POST['ivfno'];
    $bcode = $_POST['bcode'];
    $ccode = $_POST['ccode'];
    $date = date('Y-m-d');
    $time = date('h:i:sa');


    if(isset($_POST['qq'])){
     $obj->sperm_pre_prep($hs,$ds,$fs,$method_collection,$abstinence,$time_produced,$time_delivered,$time_assessed,
     $volume,$viscosity,$liquefaction,$conc_count,$motile_count,$motility,$total_count,$agglutination,$instrument_used,
     $comment,$embryologist,$ivfno,$bcode,$ccode,$date,$time);
    }

?>