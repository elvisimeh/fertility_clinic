
<?php
	session_start();
    
    $staffname = $_SESSION['staffname'];
if(!isset($staffname)){
	header("location:../../index");
	session_destroy();
	exit;
}

    require_once("controller_lib.php");

    $obj = new IVF;
    
$wife_name = $_POST['wife_name'];
$husband_name = $_POST['husband_name'];
$husband_age = $_POST['husband_age'];
$wife_age = $_POST['wife_age'];
$husband_occ = $_POST['husband_occ'];
$wife_occ = $_POST['wife_occ'];
$address = $_POST['address'];
$husband_ph = $_POST['husband_ph'];
$wife_ph = $_POST['wife_ph'];
$ref_hosp = $_POST['ref_hosp'];
$marital_stat = $_POST['marital_stat'];
$infertility_type = $_POST['infertility_type'];
$htn = $_POST['htn'];
$tb = $_POST['tb'];
$dm = $_POST['dm'];
$asth = $_POST['asth'];
$hd = $_POST['hd'];
$med_his = 'TB'. '-' . $tb . "\r\n" . 'HTN' . '-' . $htn . "\r\n" . 'DM' . '-' . $dm . "\r\n" . 'ASTHMA' . '-' . $asth . "\r\n". 'HEART DISEASE' . '-' . $hd; 
$allergy = $_POST['allergy'];
$surg_history = $_POST['surg_history'];
$smoke = $_POST['smoke'];
$alcohol = $_POST['alcohol'];
$veg = $_POST['veg'];
$nonveg = $_POST['nonveg'];
$per_his = 'SMOKING'. '-' . $smoke . "\r\n" . 'ALCOHOL' . '-' . $alcohol . "\r\n" . 'VEGITARIAN' . '-' . $veg . "\r\n" . 'NON-VEGITARIAN' . '-' . $nonveg;
$fam_his = $_POST['fam_his'];
$inv_done = $_POST['inv_done'];
$teh = $_POST['teh'];
$lap = $_POST['lap'];
$hyst = $_POST['hyst'];
$pbi = $_POST['pbi'];
$semen = $_POST['semen'];
$menstrual_con = $_POST['menstrual_con'];
$flow_nat = $_POST['flow_nat'];
$dysm = $_POST['dysm'];
$coital_bleeding = $_POST['coital_bleeding'];
$lmp = $_POST['lmp'];
$aware_fert = $_POST['aware_fert'];
$dyspa = $_POST['dyspa'];
$height = $_POST['height'];
$weight = $_POST['weight'];
$bmi = $_POST['bmi'];
$thyroid = $_POST['thyroid'];
$breast_galact = $_POST['breast_galact'];
$ovul_ind = $_POST['ovul_ind'];
$iui = $_POST['iui'];
$ivf = $_POST['ivf'];
$summary = $_POST['summary'];
$usg_date = $_POST['usg_date'];
$uterus = $_POST['uterus'];
$cavity = $_POST['cavity'];
$lt_ovary = $_POST['lt_ovary'];
$rt_ovary = $_POST['rt_ovary'];
$afc_lt = $_POST['afc_lt'];
$afc_rt = $_POST['afc_rt'];
$findings = $_POST['findings'];
$counsel = $_POST['counsel'];
$by = $_POST['by'];
$note = $_POST['note'];
$saved_by = $_SESSION['id'];
$bcode = $_SESSION['branchcode'];
$ccode = $_SESSION['companycode'];
$prn = $_POST['prn'];
$ivf_no = 'IVF'.'-'. $obj->get_branch_prefix($bcode)['prefix']. $obj->set_ivf_no($prn)['id'];
$date = date('Y-m-d');
$time = date('h:i:sa');
$status = 'OPEN';
$id = $_POST['id'];
$vsn = $_POST['vsn'];
$donor = $_POST['donor'];
$referral = $_POST['referral'];

   
if($obj->check_ivf_reg($prn)['count'] == 0){

	if($donor == 'donor'){
		$obj->create_ivf_file($wife_name,$husband_name,$husband_age,$wife_age,$husband_occ,$wife_occ,$address,$husband_ph,
$wife_ph,$ref_hosp,$marital_stat,$infertility_type,$med_his,$allergy,$surg_history,$per_his,$fam_his,
$inv_done,$teh,$lap,$hyst,$pbi,$semen,$menstrual_con,$flow_nat,$dysm,$coital_bleeding,$lmp,$aware_fert,
$dyspa,$height,$weight,$bmi,$thyroid,$breast_galact,$ovul_ind,$iui,$ivf,$summary,$usg_date,$uterus,$cavity,
$lt_ovary,$rt_ovary,$afc_lt,$afc_rt,$findings,$counsel,$by,$note,$saved_by,$ivf_no,$prn,$date,$time,$bcode,$ccode,$status,$vsn,$donor);

$obj->convert_donor_pat($id);

	}

else{
$obj->create_ivf_file($wife_name,$husband_name,$husband_age,$wife_age,$husband_occ,$wife_occ,$address,$husband_ph,
$wife_ph,$ref_hosp,$marital_stat,$infertility_type,$med_his,$allergy,$surg_history,$per_his,$fam_his,
$inv_done,$teh,$lap,$hyst,$pbi,$semen,$menstrual_con,$flow_nat,$dysm,$coital_bleeding,$lmp,$aware_fert,
$dyspa,$height,$weight,$bmi,$thyroid,$breast_galact,$ovul_ind,$iui,$ivf,$summary,$usg_date,$uterus,$cavity,
$lt_ovary,$rt_ovary,$afc_lt,$afc_rt,$findings,$counsel,$by,$note,$saved_by,$ivf_no,$prn,$date,$time,$bcode,$ccode,$status,$vsn,$donor);

if($referral == 'ref'){
 $obj->accept_referral($id);
}
else {
$obj->remove_registered($id);
}

$data = 1;
echo $data;
}

}

else{
$data = 0;
echo $data;
}
//$obj->ci($prn);