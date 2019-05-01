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
    $ivfno = $_POST['ivfno'];
    $prn = $_POST['prn'];

    
   $old_amt = floatval(preg_replace('/[^\d\.]+/','',$object->get_ivf_spent($prn)['amt_used']));

   $deduct_amt = floatval(preg_replace('/[^\d\.]+/','',$object->drug_cost_deduct($id)['totamt']));

   $new_amt = $old_amt - $deduct_amt;

   $object->delete_drug($id);

    $object->revert_toacc($prn,$new_amt);

    echo 'success';
    ?>