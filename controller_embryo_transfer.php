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

    $transfer_time =  $_POST['transfer_time'];
    $transfer_day =  $_POST['transfer_day'];
    $embryo_transferred =  $_POST['embryo_transferred'];
    $stylet = $_POST['stylet'];
    $grade_transferred_embryo = $_POST['grade_transferred_embryo'];
    $volume = $_POST['volume'];
    $viscosity = $_POST['viscosity'];
    $liquefaction_time =  $_POST['liquefaction_time'];
    $conc_count =  $_POST['conc_count'];
    $motile_count =  $_POST['motile_count'];
    $motility = $_POST['motility'];
    $total_count = $_POST['total_count'];
    $agglutination = $_POST['agglutination'];
    $instrument_used = $_POST['instrument_used'];
    $comment = $_POST['comment'];
    $embryologist = $_POST['embryologist'];
    
    
    $bcode = $_POST['bcode'];
    $ccode = $_POST['ccode'];
    $ivfno = $_POST['ivfno'];
    
    $date = date('Y-m-d');
    $ptime = date('h:i:sa');
    $posted_by = $_SESSION['id'];


    
    $obj->embryo_transfer($transfer_time,$transfer_day,$embryo_transferred,$stylet,$grade_transferred_embryo,
          $volume,$viscosity,$liquefaction_time,$conc_count,$motile_count,$motility,$total_count,$agglutination,
          $instrument_used,$comment,$embryologist,$bcode,$ccode,$ivfno,$date,$ptime,$posted_by);
    

?>