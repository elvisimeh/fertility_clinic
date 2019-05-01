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

    $inj=  $_POST['noi'];
    $dosage=  $_POST['dosage'];
    $scan_days =  $_POST['scan_days'];
    $scan_findings = $_POST['scan_findings'];
    $remark = $_POST['remark'];
    $bcode = $_POST['bcode'];
    $ccode = $_POST['ccode'];
    $by = $_POST['by'];
    $prn = $_POST['prn'];
    $ivfno = $_POST['ivfno'];
    
    
    $date = date('Y-m-d');
    $time = date('h:i:sa');

   
     $obj->submit_prescription_entry($inj,$dosage,$scan_days,$scan_findings,$remark,$bcode,$ccode,$by,
     $prn,$ivfno,$date,$time);
    

?>