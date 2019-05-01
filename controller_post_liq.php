<?php

//if (isset($_POST['posttab'])) {
   error_reporting(E_ALL);
  ini_set('display_errors', 1);
    require_once("controller_lib.php");

    $object = new IVF();

    $corporate = 'CORPORATE';
 $insurance  = 'INSURANCE';
 $family     = 'FAMILY';
 $private    = 'PRIVATE';


    $prn_drug = $_POST['prn'];
    $pt_date = date('Y-m-d');
    $pt_time = date('h:i:sa');
    $staffname = $_POST['staffname'];
    $ivfno = $_POST['ivfno'];
    $vsn = $_POST['vsn'];
    $status = 'NOT DISPENSED';
    $qty_dis = number_format(0);
    $sponsorid = $_POST['sponsorid'];
    $pat_cat = number_format($_POST['pat_cat']);
    $category = $pat_cat;
    $pat_type = $object->ivf_pattype()['id'];
    $ipno = '';
    $age = $_POST['age'];

    if(isset($_POST['liq1']) && $_POST['liq1'] != ''){
$drug_liq1 = $_POST['liq1'];
$d = $drug_liq1;
    //$con_ar = explode('|', $con_rr);
    

    


    $liq1 = $object->get_drug($d)['itemname'];
    $drug_group_id = $object->get_drug($d)['itemgroup_id'];
    $d_sg_id = $object->get_drug($d)['item_subgroup_id'];
    $drug_id = $object->get_drug($d)['itemname_id'];
    $cost1 = $object->get_drug($d)['unitcost'];
    $cost = floatval(preg_replace('/[^\d\.]+/','',$cost1));
    //$sales = $con_ar[5];
    
    $qty1 = number_format($_POST['qty_liq1']);
    $pres_bal1 = number_format($_POST['qty_liq1']);
    $qty_ind1 = number_format($_POST['qty_liq1']);
    $ind_bal1 = number_format($_POST['qty_liq1']);
    
    $route1 = $_POST['route_liq1'];
    $physio_instruct_liq1 = $_POST['physio_instruct_liq1'];
    
    
    if($object->get_cat($category)['category']==$private){
      $payment_status = 'PAID';
      $sales1 = $object->get_private_drug($d)['agreed_amt'];
      $sales = floatval(preg_replace('/[^\d\.]+/','',$sales1));
      $sponsorid = 0;
      $pacode = '';
      $cap_status = '';
    }
    elseif($object->get_cat($category)['category']==$family){
        $payment_status = 'PAID';
      $sales1 = $object->get_private_drug($d)['agreed_amt'];
      $sales = floatval(preg_replace('/[^\d\.]+/','',$sales1));
      $pacode = '';
      $cap_status = '';
    }
    elseif($object->get_cat($category)['category']==$insurance){
      $payment_status = 'PAID';
      $sales1 = $object->get_private_drug($d)['agreed_amt'];
      $sales = floatval(preg_replace('/[^\d\.]+/','',$sales1));
      //$sales1 = $object->get_insurance_drug($d,$sponsorid)['agreed_amt'];
      //$sales = floatval(preg_replace('/[^\d\.]+/','',$sales1));
      $pacode = $object->get_insurance_drug($d,$sponsorid)['pacode'];
      $cap_status = $object->get_insurance_drug($d,$sponsorid)['capitation_status'];
    }
    else{
        $payment_status = 'PAID';
        $sales1 = $object->get_private_drug($d)['agreed_amt'];
        $sales = floatval(preg_replace('/[^\d\.]+/','',$sales1));
       // $sales1 = $object->get_corporate_drug($d,$sponsorid)['agreed_amt'];
       // $sales = floatval(preg_replace('/[^\d\.]+/','',$sales1));
        $pacode = '';
        $cap_status = '';
    }
    
    
    $totamt1 = floatval(preg_replace('/[^\d\.]+/','',$sales)) * $qty1;
    

    $trans_status = 'N';
    $post_status = 'Y';
    $service_category_id = number_format($object->get_drug($d)['service_category_id']);
    $subunit_id = number_format($_POST['dept']);
    $timestamp = time();
    $dept = $_POST['dept'];
    $specialty_id = $_POST['specialty_id'];
    

    $bcode = $_POST['bcode'];
    $ccode = $_POST['ccode'];

    if($object->get_ivf_file($prn_drug)['donor'] == 'donor'){
        $source1 = $object->Create_liq1($liq1,$drug_group_id,$d_sg_id,$drug_id,$cost,$sales,$prn_drug,$pt_date,$pt_time,$staffname,$ivfno,$status,
    $qty1,$route1,$physio_instruct_liq1,$payment_status,$sponsorid,$bcode,$ccode,$totamt1,$pres_bal1,$qty_ind1,$ind_bal1,$qty_dis,$age,$pat_cat,$pat_type,$ipno,$post_status,$vsn);

    // $object->Create_liq1($liq1,$drug_group_id,$d_sg_id,$drug_id,$cost,$sales,$prn_drug,$pt_date,$pt_time,$staffname,$ivfno,$status,
    //$qty1,$physio_instruct_liq1,$payment_status,$sponsorid,$bcode,$ccode,$totamt1,$pres_bal1,$qty_ind1,$ind_bal1,$qty_dis,$age,$pat_cat);

    if ($object->get_cat($category)['category'] == $family){
        $post_status = 'N';
        $object->family_drug1($pt_date,$pt_time,$prn_drug,$pat_cat,$drug_id,$cost,$sales,$qty1,$dept,$payment_status,$trans_status,$staffname,$bcode,
        $ccode,$service_category_id,$subunit_id,$timestamp,$specialty_id,$vsn,$post_status,$totamt1,$sponsorid,$source1);
    }
    elseif ($object->get_cat($category)['category'] == $private){
        $post_status = 'Y';
          //  $object->private_drug1($pt_date,$pt_time,$prn_drug,$pat_cat,$drug_id,$cost,$sales,$qty1,$dept,$payment_status,$trans_status,$staffname,$bcode,
      //  $ccode,$service_category_id,$subunit_id,$timestamp,$specialty_id,$ivfno,$post_status,$totamt1,$source1);
    }
    else{
        $agreed_amt1 = $sales;
       // $agreed_amt2 = $sales2;
        $status = 'true';
        $cap_status = 'false';
        $payment_status = 'false';
       $object->paylater_drug1($pt_date,$pt_time,$prn_drug,$drug_id,$cost,$sales,$agreed_amt1,$qty1,$dept,$trans_status,$staffname,$bcode,$ccode,
       $pat_cat,$service_category_id,$sponsorid,$specialty_id,$vsn,$totamt1,$status,$cap_status,$payment_status,$subunit_id,$pacode,$source1);
    }
}

    $deduct = floatval(preg_replace('/[^\d\.]+/','',$object->get_ivf_spent($prn_drug)['amt_used'])) + $totamt1;
    if($deduct <= floatval(preg_replace('/[^\d\.]+/','',$object->get_ivf_deposit($prn_drug)['sum']))){
    $object->put_spent($prn_drug,$deduct);

    $source1 = $object->Create_liq1($liq1,$drug_group_id,$d_sg_id,$drug_id,$cost,$sales,$prn_drug,$pt_date,$pt_time,$staffname,$ivfno,$status,
    $qty1,$route1,$physio_instruct_liq1,$payment_status,$sponsorid,$bcode,$ccode,$totamt1,$pres_bal1,$qty_ind1,$ind_bal1,$qty_dis,$age,$pat_cat,$pat_type,$ipno,$post_status,$vsn);

    // $object->Create_liq1($liq1,$drug_group_id,$d_sg_id,$drug_id,$cost,$sales,$prn_drug,$pt_date,$pt_time,$staffname,$ivfno,$status,
    //$qty1,$physio_instruct_liq1,$payment_status,$sponsorid,$bcode,$ccode,$totamt1,$pres_bal1,$qty_ind1,$ind_bal1,$qty_dis,$age,$pat_cat);

    if ($object->get_cat($category)['category'] == $family){
        $post_status = 'N';
        $object->family_drug1($pt_date,$pt_time,$prn_drug,$pat_cat,$drug_id,$cost,$sales,$qty1,$dept,$payment_status,$trans_status,$staffname,$bcode,
        $ccode,$service_category_id,$subunit_id,$timestamp,$specialty_id,$vsn,$post_status,$totamt1,$sponsorid,$source1);
    }
    elseif ($object->get_cat($category)['category'] == $private){
        $post_status = 'Y';
          //  $object->private_drug1($pt_date,$pt_time,$prn_drug,$pat_cat,$drug_id,$cost,$sales,$qty1,$dept,$payment_status,$trans_status,$staffname,$bcode,
      //  $ccode,$service_category_id,$subunit_id,$timestamp,$specialty_id,$ivfno,$post_status,$totamt1,$source1);
    }
    else{
        $agreed_amt1 = $sales;
       // $agreed_amt2 = $sales2;
        $status = 'true';
        $cap_status = 'false';
        $payment_status = 'false';
       $object->paylater_drug1($pt_date,$pt_time,$prn_drug,$drug_id,$cost,$sales,$agreed_amt1,$qty1,$dept,$trans_status,$staffname,$bcode,$ccode,
       $pat_cat,$service_category_id,$sponsorid,$specialty_id,$vsn,$totamt1,$status,$cap_status,$payment_status,$subunit_id,$pacode,$source1);
    }
}
}


if(isset($_POST['liq2']) && $_POST['liq2'] != ''){

    $drug_liq2 = $_POST['liq2'];
    $d = $drug_liq2;
    

    $liq2 = $object->get_drug($d)['itemname'];
    $drug_group_id2 = $object->get_drug($d)['itemgroup_id'];
    $d_sg_id2 = $object->get_drug($d)['item_subgroup_id'];
    $drug_id2 = $object->get_drug($d)['itemname_id'];
    $cost21 = $object->get_drug($d)['unitcost'];
    $cost2 = floatval(preg_replace('/[^\d\.]+/','',$cost21)) * $qty2;
    //$sales2 = $con_ar2[5];
    $qty2 = number_format($_POST['qty_liq2']);
    $pres_bal2 = number_format($_POST['qty_liq2']);
    $qty_ind2 = number_format($_POST['qty_liq2']);
    $ind_bal2 = number_format($_POST['qty_liq2']);
    $physio_instruct_liq2 = $_POST['physio_instruct_liq2'];
    $age = $_POST['age'];
    
    $route2 = $_POST['route_liq2'];
    

    if($object->get_cat($category)['category']==$private){
        $payment_status = 'PAID';
        $sales21 = $object->get_private_drug($d)['agreed_amt'];
        $sales2 = floatval(preg_replace('/[^\d\.]+/','',$sales21));
        $sponsorid = 0;
        $pacode = '';
        $cap_status = '';
      }
      elseif($object->get_cat($category)['category']==$family){
          $payment_status = 'PAID';
        $sales21 = $object->get_private_drug($d)['agreed_amt'];
        $sales2 = floatval(preg_replace('/[^\d\.]+/','',$sales21));
        $pacode = '';
        $cap_status = '';
      }
      elseif($object->get_cat($category)['category']==$insurance){
        $payment_status = 'PAID';
        $sales21 = $object->get_private_drug($d)['agreed_amt'];
        $sales2 = floatval(preg_replace('/[^\d\.]+/','',$sales21));
       // $sales21 = $object->get_insurance_drug($d,$sponsorid)['agreed_amt'];
        //$sales2 = floatval(preg_replace('/[^\d\.]+/','',$sales21));
        $pacode = $object->get_insurance_drug($d,$sponsorid)['pacode'];
        $cap_status = $object->get_insurance_drug($d,$sponsorid)['capitation_status'];
      }
      else{
          $payment_status = 'PAID';
          $sales21 = $object->get_private_drug($d)['agreed_amt'];
        $sales2 = floatval(preg_replace('/[^\d\.]+/','',$sales21));
         // $sales21 = $object->get_corporate_drug($d,$sponsorid)['agreed_amt'];
         // $sales2 = floatval(preg_replace('/[^\d\.]+/','',$sales21));
          $pacode = '';
          $cap_status = '';
      }

      $totamt2 = floatval(preg_replace('/[^\d\.]+/','',$sales2)) * $qty2;
      

    $trans_status = 'N';
    $post_status = 'Y';
    $service_category_id = number_format($object->get_drug($d)['service_category_id']);
    $subunit_id = number_format(0);
    $timestamp = time();
    $dept = $_POST['dept'];
    $specialty_id = $_POST['specialty_id'];

    $bcode = $_POST['bcode'];
    $ccode = $_POST['ccode'];

    if($object->get_ivf_file($prn_drug)['donor'] == 'donor'){
        $source2 = $object->Create_liq2($liq2,$drug_group_id2,$d_sg_id2,$drug_id2,$cost2,$sales2,$prn_drug,$pt_date,$pt_time,$staffname,$ivfno,$status,
    $qty2,$route2,$physio_instruct_liq2,$payment_status,$sponsorid,$bcode,$ccode,$totamt2,$pres_bal2,$qty_ind2,$ind_bal2,$qty_dis,$age,$pat_cat,$pat_type,$ipno,$post_status,$vsn);

    if ($object->get_cat($category)['category'] == $family){
        $post_status = 'N';
        $object->family_drug2($pt_date,$pt_time,$prn_drug,$pat_cat,$drug_id2,$cost2,$sales2,$qty2,$dept,$payment_status,$trans_status,$staffname,$bcode,
        $ccode,$service_category_id,$subunit_id,$timestamp,$specialty_id,$vsn,$post_status,$totamt2,$sponsorid,$source2);
     }
     elseif ($object->get_cat($category)['category'] == $private){
        $post_status = 'N';
       // $object->private_drug2($pt_date,$pt_time,$prn_drug,$pat_cat,$drug_id2,$cost2,$sales2,$qty2,$dept,$payment_status,$trans_status,$staffname,$bcode,
       // $ccode,$service_category_id,$subunit_id,$timestamp,$specialty_id,$ivfno,$post_status,$totamt2,$source2);
     }
     else{
        $agreed_amt1 = $sales;
        $agreed_amt2 = $sales2;
        $status = 'true';
        $cap_status = 'false';
        $payment_status = 'false';
        $object->paylater_drug2($pt_date,$pt_time,$prn_drug,$drug_id2,$cost2,$sales2,$agreed_amt2,$qty2,$dept,$trans_status,$staffname,$bcode,$ccode,
        $pat_cat,$service_category_id,$sponsorid,$specialty_id,$vsn,$totamt2,$status,$cap_status,$payment_status,$subunit_id,$pacode2,$source2);
     }
    }

    $deduct = floatval(preg_replace('/[^\d\.]+/','',$object->get_ivf_spent($prn_drug)['amt_used'])) + $totamt2;
    if($deduct <= floatval(preg_replace('/[^\d\.]+/','',$object->get_ivf_deposit($prn_drug)['sum']))){
    $object->put_spent($prn_drug,$deduct);

    $source2 = $object->Create_liq2($liq2,$drug_group_id2,$d_sg_id2,$drug_id2,$cost2,$sales2,$prn_drug,$pt_date,$pt_time,$staffname,$ivfno,$status,
    $qty2,$route2,$physio_instruct_liq2,$payment_status,$sponsorid,$bcode,$ccode,$totamt2,$pres_bal2,$qty_ind2,$ind_bal2,$qty_dis,$age,$pat_cat,$pat_type,$ipno,$post_status,$vsn);

    if ($object->get_cat($category)['category'] == $family){
        $post_status = 'N';
        $object->family_drug2($pt_date,$pt_time,$prn_drug,$pat_cat,$drug_id2,$cost2,$sales2,$qty2,$dept,$payment_status,$trans_status,$staffname,$bcode,
        $ccode,$service_category_id,$subunit_id,$timestamp,$specialty_id,$vsn,$post_status,$totamt2,$sponsorid,$source2);
     }
     elseif ($object->get_cat($category)['category'] == $private){
        $post_status = 'N';
       // $object->private_drug2($pt_date,$pt_time,$prn_drug,$pat_cat,$drug_id2,$cost2,$sales2,$qty2,$dept,$payment_status,$trans_status,$staffname,$bcode,
       // $ccode,$service_category_id,$subunit_id,$timestamp,$specialty_id,$ivfno,$post_status,$totamt2,$source2);
     }
     else{
        $agreed_amt1 = $sales;
        $agreed_amt2 = $sales2;
        $status = 'true';
        $cap_status = 'false';
        $payment_status = 'false';
        $object->paylater_drug2($pt_date,$pt_time,$prn_drug,$drug_id2,$cost2,$sales2,$agreed_amt2,$qty2,$dept,$trans_status,$staffname,$bcode,$ccode,
        $pat_cat,$service_category_id,$sponsorid,$specialty_id,$vsn,$totamt2,$status,$cap_status,$payment_status,$subunit_id,$pacode2,$source2);
     }
    }
}

    

    

    
    
        
     
        
     
        


    return "success";

//}
    ?>