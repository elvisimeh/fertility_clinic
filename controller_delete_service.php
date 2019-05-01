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

$corporate = 'CORPORATE';
$insurance = 'INSURANCE';

require_once("controller_lib.php");

    $object = new IVF();

    $id = $_POST['id'];

    $prn = $_POST['prn'];


    

    if($object->get_cat($category)['category'] == $corporate && $object->get_ivf_file($prn)=='donor'){

    $object->delete_service($id);    

    $object->delete_service_trans($id);

    }

    else{

    $old_amt = floatval(preg_replace('/[^\d\.]+/','',$object->get_ivf_spent($prn)['amt_used']));

   $deduct_amt = floatval(preg_replace('/[^\d\.]+/','',$object->service_cost_deduct($id)['agreed_amt']));

   $new_amt = $old_amt - $deduct_amt;

        $object->delete_service($id);

        $object->revert_toacc($prn,$new_amt);

    }

?>