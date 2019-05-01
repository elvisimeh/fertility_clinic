<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once("controller_lib.php");

$object = new IVF();

$corporate = 'CORPORATE';
 $insurance  = 'INSURANCE';
 $family     = 'FAMILY';
 $private    = 'PRIVATE';

$service = $_POST['service'];
$get_service = $service;
//$object->get_service($a)['service_name'];


$a = $service;
$orderdate =  date('Y-m-d')  ;
$ordertime =  date('h:i:sa')  ;
$prn = $_POST['prn'] ;
$unit = $object->get_service($a)['subunit_id'];
$testname = $service;
$dept = $object->get_service($a)['dept'];
$age = $_POST['age']  ;
$category = $_POST['category'] ;
$sponsor = $_POST['sponsor'] ;
$post_status = 'Y';

if($object->get_cat($category)['category'] == $private){
    $sponsor = 0;
    $pay_status = 'PAID';
    $price1 = $object->get_private_tariff($a)['agreed_amt'];
    $price = floatval(preg_replace('/[^\d\.]+/','',$price1));
    $pacode = '';
    $capitation = '';
    $cost = $object->get_private_tariff($a)['unitcost'];
    $hospital_amt = $object->get_private_tariff($a)['agreed_amt'];
    $agreed_amt = $object->get_private_tariff($a)['agreed_amt'];
}

elseif($object->get_cat($category)['category'] == $family){
    $price1 = $object->get_private_tariff($a)['agreed_amt'];
    $price = floatval(preg_replace('/[^\d\.]+/','',$price1));
    $pacode = '';
    $capitation = '';
    $cost = $object->get_private_tariff($a)['unitcost'];
    $hospital_amt = $object->get_private_tariff($a)['agreed_amt'];
    $agreed_amt = $object->get_private_tariff($a)['agreed_amt'];
    $pay_status = 'PAID';
}

elseif($object->get_cat($category)['category'] == $insurance){
    $pay_status = 'PAY LATER';
    $price1 = $object->get_insurance_tariff($a,$sponsor)['agreed_amt'];
    $price = floatval(preg_replace('/[^\d\.]+/','',$price1)); 
    $pacode = $object->get_insurance_tariff($a,$sponsor)['pacode'];
    $capitation = $object->get_insurance_tariff($a,$sponsor)['captitation'];//leave as spelt error from db
    $cost = $object->get_private_tariff($a,$sponsor)['unitcost'];
    $hospital_amt = $object->get_insurance_tariff($a,$sponsor)['hospital_amt'];
    $agreed_amt = $object->get_insurance_tariff($a,$sponsor)['agreed_amt'];
}
else{
    $price1 = $object->get_corporate_tariff($a,$sponsor)['agrred_amt']; 
    $price = floatval(preg_replace('/[^\d\.]+/','',$price1));
    $cost = $object->get_private_tariff($a)['unitcost'];
    $hospital_amt = $object->get_corporate_tariff($a,$sponsor)['hospital_amt'];
    $agreed_amt = $object->get_corporate_tariff($a,$sponsor)['agrred_amt']; //leave as spelt error from db
    $pacode = '';
    $capitation = '';
    $pay_status = 'PAY LATER';
}
$plan_type = $_POST['plan']   ;
$service_amt = $cost ;
//$pacode =  $get_service[5] ;
$doctorname = $_POST['by']   ;
$status = 'NOT DONE'  ;
$vsn = $_POST['ivfno'] ;

$service_cat_id = number_format($object->get_service($a)['service_category_id']) ;
$cap_status = $capitation;
$pat_type = 2;
$ipno = '';

$bcode = number_format($_POST['bcode']);
$ccode = number_format($_POST['ccode']);
$timestamp = time();
$specialty_id =  number_format($_POST['specialty_id']);

//$object->xxy();

$source = $object->add_service($service,$orderdate,$ordertime,$prn,$unit,$testname,$dept,$age,$category,$sponsor,$plan_type,
$service_amt,$pacode,$doctorname,$status,$vsn,$hospital_amt,$agreed_amt,$service_cat_id,$pat_type,$pay_status,$ipno,$bcode,$ccode);



if($object->get_cat($category)['category'] == $family){
    $trans_status = 'N';
    $post_status = 'Y';
    $payment_status = 'PAID';
    $qty = 1;
    $total = $price ;
    $object->family_transaction($orderdate,$ordertime,$prn,$category,$testname,$hospital_amt,$agreed_amt,$payment_status,
    $trans_status,$doctorname,$bcode,$ccode,$service_cat_id,$unit,$timestamp,$specialty_id,$vsn,$post_status,$total,$sponsor,$qty,$dept,$service_amt,$source);
}

else if($object->get_cat($category)['category'] == $private){
    $trans_status = 'N';
    $post_status = 'Y';
    $payment_status = 'PAID';
    $qty = 1;
    $total = $price ;
   // $object->private_transaction($orderdate,$ordertime,$prn,$category,$testname,$hospital_amt,$agreed_amt,$payment_status,
   // $trans_status,$doctorname,$bcode,$ccode,$service_cat_id,$unit,$timestamp,$specialty_id,$vsn,$post_status,$total,$sponsor,$qty,$dept,$service_amt,$source);
}

else{
    $trans_status = 'N';
    $post_status = 'Y';
    $payment_status = 'false';
    $qty = 1;
    $pl_status = 'true';
    //$agreed_amt =  $get_service[10] ;
    //$hospital_amt = $get_service[9] ;
    //$cost = $get_service[8] ;
    $agreed_amt = floatval(preg_replace('/[^\d\.]+/','',$agreed_amt));
    //$agreed_amt= number_format($agreed_amt1);
    $hospital_amt = floatval(preg_replace('/[^\d\.]+/','',$hospital_amt));;
    $cost = floatval(preg_replace('/[^\d\.]+/','',$cost));;
    $service_amt = $cost;
    $total = $agreed_amt;
    $object->pay_later($orderdate,$ordertime,$prn,$category,$testname,$hospital_amt,$agreed_amt,$cost,$qty,$dept,$trans_status,$doctorname,$bcode,$ccode,
$service_cat_id,$sponsor,$specialty_id,$vsn,$total,$pl_status,$cap_status,$pacode,$unit,$payment_status,$timestamp,$service_amt,$source);
}

echo 'success';
    
    
//echo $service,$orderdate,$ordertime,$prn,$unit,$testname,$dept,$age,$category,$sponsor,$plan_type,
//$service_amt,$pacode,$doctorname,$status,$vsn,$hospital_amt,$agreed_amt,$service_cat_id;
//echo $yy;

?>