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

    $name =  $_POST['name'];
    $dob =  $_POST['dob'];
    $address =  $_POST['address'];
    $complexion = $_POST['complexion'];
    $afc = $_POST['afc'];
    $lmp = $_POST['lmp'];
    $blood_group = $_POST['blood_group'];
    $w_phone = $_POST['w_phone'];
    $h_phone = $_POST['h_phone'];
    $email = $_POST['email'];
    $referral = $_POST['referral'];
    $type = $_POST['type'];
    $noc = $_POST['noc'];
    $sign = $_POST['sign'];
    $bcode = $_POST['bcode'];
    $ccode = $_POST['ccode'];
    $by = $_POST['by'];
    
    $date = date('Y-m-d');
    $time = date('h:i:sa');


    if(isset($_POST['name']) && !empty($_POST['name'])){
     $obj->submit_counsel($name,$dob,$address,$complexion,$afc,$lmp,$blood_group,$w_phone,$h_phone,$email,
     $referral,$type,$noc,$sign,$by,$bcode,$ccode,$date,$time);
    }

?>