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

    $ctime =  $_POST['ctime'];
    $cumm_break_down =  $_POST['cumm_break_down'];
    $fertilized =  $_POST['fertilized'];
    $grades = $_POST['grades'];
    $embryologist = $_POST['embryologist'];
   // $posted_by = $_POST['posted_by'];
    $comment = $_POST['comment'];
    
    
    $bcode = $_POST['bcode'];
    $ccode = $_POST['ccode'];
    $ivfno = $_POST['ivfno'];
    
    $date = date('Y-m-d');
    $ptime = date('h:i:sa');
    $posted_by = $_SESSION['id'];


    
    $obj->pn_check($ctime,$cumm_break_down,$fertilized,$grades,$embryologist,$comment,$bcode,$ccode,$ivfno,$date,
          $ptime,$posted_by);
    

?>