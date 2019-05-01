<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
$staffname = $_SESSION['staffname'];
if(!isset($staffname)){
	header("location:../../index");
	session_destroy();
	exit;
}


require_once("controller_lib.php");

    $object = new IVF();

    $id = $_POST['id'];
    
    
   

   $object->delete_counsel($id);

    
    ?>