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

    $egg_time =  $_POST['time'];
    $lt_ovary =  $_POST['lt_ovary'];
    $rt_ovary =  $_POST['rt_ovary'];
    $egg = $_POST['egg'];
    $time_of_insemination = $_POST['time_of_insemination'];
    $oocytes = $_POST['oocytes'];
    $oocytes_treated = $_POST['oocytes_treated'];
    $treatment_mode = $_POST['treatment_mode'];
    $stripped_by = $_POST['stripped_by'];
    $ocr_by = $_POST['ocr_by'];
    $inseminated_by = $_POST['inseminated_by'];
    $comment = $_POST['comment'];
    $media_used = $_POST['media_used'];
    
    $bcode = $_POST['bcode'];
    $ccode = $_POST['ccode'];
    $ivfno = $_POST['ivfno'];
    
    $date = date('Y-m-d');
    $ptime = date('h:i:sa');
    $posted_by = $_SESSION['id'];


    
    $obj->egg_details($egg_time,$lt_ovary,$rt_ovary,$egg,$time_of_insemination,$oocytes,$oocytes_treated,
    $treatment_mode,$stripped_by,$ocr_by,$inseminated_by,$comment,$media_used,$bcode,$ccode,$ivfno,$date,$ptime,$posted_by);
    

?>