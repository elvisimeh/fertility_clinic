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

    $day =  $_POST['day'];
    $gtime =  $_POST['gtime'];
    $cleaved =  $_POST['cleaved'];
    $failed_cleave = $_POST['failed_cleave'];
    $embryo_grade = $_POST['embryo_grade'];
    $embryologist = $_POST['embryologist'];
    $comment = $_POST['comment'];
    
    
    $bcode = $_POST['bcode'];
    $ccode = $_POST['ccode'];
    $ivfno = $_POST['ivfno'];
    
    $date = date('Y-m-d');
    $ptime = date('h:i:sa');
    $posted_by = $_SESSION['id'];


    
    $obj->grading($day,$gtime,$cleaved,$failed_cleave,$embryo_grade,$embryologist,$comment,
          $bcode,$ccode,$ivfno,$date,$ptime,$posted_by);
    

?>