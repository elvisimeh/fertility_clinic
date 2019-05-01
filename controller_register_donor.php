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

$bcode = $_SESSION['branchcode'];
$ccode = $_SESSION['companycode'];
$status = 'OPEN';
$date = date('Y-m-d');
$time = date('h:i:sa');
$prn = $_POST['prn'];
$by = $_SESSION['id'];
$id = $_POST['id'];
$vsn = $_POST['vsn'];

if($object->check_donor($prn)['count'] == 0){

$object->reg_donor($prn,$bcode,$ccode,$status,$date,$time,$by,$vsn);

$object->remove_registered($id);

$data = 1;
echo $data;
}

else{
    echo 'fail';
}
