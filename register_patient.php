<?php
session_start();
$staffname = $_SESSION['staffname'];
if(!isset($staffname)){
	header("location:../../index");
	session_destroy();
	exit;
}



//require_once("lib.php");
//error_reporting(E_ALL);
//ini_set('display_errors', 1);
require_once("controller_lib.php");

   

   
$prn = $_GET["prn"];
$id =  $_GET["id"];           
//$vsn = $_GET["vsn"];
$bcode = $_SESSION["branchcode"]; 
$ccode = $_SESSION["companycode"];  


 $ivfobj = new IVF;
 
 $visit_details = $ivfobj->get_patient_details($prn);
 
 //var_dump($visit_details);

 $corporate = 'CORPORATE';
 $insurance  = 'INSURANCE';
 $family     = 'FAMILY';
 $private    = 'PRIVATE';
 $drug_spec = 21;
 //$dept_id = $_SESSION['id'];
 
//var_dump($ivfobj->check_ivf_reg($prn)['count'])

 
?>




    <!DOCTYPE html>
    <html lang="en">
    
<head>
<meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>Healthwise | HMS</title>

<link rel="stylesheet" href="../../assets/hms-css/bootstrap.min.css">
<link href="../../assets/css/hms-styles.css" rel="stylesheet" type="text/css">
<!--<link rel="stylesheet" href="assets/css/style.css">-->
<link rel="stylesheet" href="assets/css/physio.css">
<link rel="stylesheet" href="assets/css/select2.css">

</head>
<style>


.tsizelarge{
  display: block;
  height: auto;  
  overflow-y: auto;
}

.remove-control::-webkit-inner-spin-button, 
.remove-control::-webkit-outer-spin-button { 
  -webkit-appearance: none; 
  margin: 0; 
}
input[type=number] {
    -moz-appearance:textfield;
}

.add-button {
    margin-left: -50px;
    height: 25px;
    width: 50px;
    background: blue;
    color: white;
    border: 0;
    -webkit-appearance: none;
}

.load-diagnosis{
    font-size:0.9em;    
}

ul {
    margin-left:3%;
    padding-left: 0;
}​

.autocomplete {
  /*the container must be positioned relative:*/
  position: relative;
  display: inline-block;
  
}

#kl:disabled{
    background-color: black;
    opacity: 1;
}

#fo_kl:disabled{
    background-color: black;
    opacity: 1;
}

#re_kl:disabled{
    background-color: black;
    opacity: 1;
}

.autocomplete-items {
  position: absolute;
  border: 1px solid #d4d4d4;
  border-bottom: none;
  border-top: none;
  z-index: 99;
  /*position the autocomplete items to be the same width as the container:*/
  top: 100%;
  left: 0;
  right: 0;
  color:black;
}
.autocomplete-items div {
  padding: 10px;
  cursor: pointer;
  background-color: #F0E68C; 
  border-bottom: 1px solid #d4d4d4;
  margin-left:3%; 
}
.autocomplete-items div:hover {
  /*when hovering an item:*/
  background-color: #e9e9e9; 
}
.autocomplete-active {
  /*when navigating through the items using the arrow keys:*/
  background-color: DodgerBlue !important; 
  color: #ffffff; 
}

.bs {
    box-shadow:0 2px 4px rgba(0,0,0,0.2);
}

input:hover {
    /*border: solid 0.5px #00C0EF;*/
    background-color: #F6F6F6
}

textarea:hover {
    /*border: solid 0.5px #00C0EF;*/
    background-color: #F6F6F6
}

select:hover {
    /*border: solid 0.5px #00C0EF;*/
    background-color: #F6F6F6
}

a{
    cursor:pointer
}


/*@media only screen and (max-width: 760px), (min-width: 768px) and (max-width: 1024px) {*/
    /* ... */
    
</style>
<script>
 function frontdesk_posting(){
    $('#router').load('fd_posting_ivf');
        }
        </script>

<body>

	<?php include("../_includes/hms-header.php");?>
     

<div class="container">
<ul class="breadcrumb" style="margin-left:0%">
<li><a href="index">Dashboard</a></li>
<li><a onclick="frontdesk_posting()">Patients Posted From Frontdesk</a></li>
<li>Register Fertility Patient</li>
</ul>

<?php // if(!empty($physioobj->details_now())){?>

<div class="panel panel-default">
<div class="panel-heading" style="background-color:#001f3f">
<h3 align="center">Patient Information</h3>
</div>

<div class="panel-body bg-aqua" style="box-shadow:0 2px 4px rgba(0,0,0,0.2);">
<div class="col-md-10" style="font-weight:bold; font-size:1.1em">
<div class="row" style="padding-top:0; padding-bottom:0">
<div class="col-md-1">
Patient #:
</div>
<div class="col-md-3" style="">
<?php echo $visit_details['prn']; ?>
</div>
<div class="col-md-1">
Sponsor:
</div>
<div class="col-md-3" style="word-wrap:break-word">
<?php if($visit_details['category']=='PRIVATE'){ echo $visit_details['fullname']; } //$category = $visit_details['category']; if($ivfobj->get_cat($category)['category']==$private){ echo $visit_details['sponsor'];} elseif($ivfobj->get_cat($category)['category']==$family){ echo $fam_sponsor['family_name'];} else {$client = $visit_details['sponsor']; echo $ivfobj->get_client_id($client)[0]['corporate_name'];}   ?>
</div>
<div class="col-md-1">
NOK Phone No.: 
</div>
<div class="col-md-3" style="">
<?php echo $visit_details['nok_phone'] ?>
</div>
</div>
<hr>
<div class="row" style="padding:0.1 auto o.1 auto">
<div class="col-md-1">
Patient Name: 
</div>
<div class="col-md-3" style="word-wrap:break-word">
<?php echo $visit_details['fullname'] ?>
</div>
<div class="col-md-1">
Marital Status: 
</div>
<div class="col-md-3" style="">
<?php echo $visit_details['marital_status'] ?>
</div>
<div class="col-md-1">
Gender:
</div>
<div class="col-md-3" style="">
<?php echo $visit_details['gender']; ?>
</div>
</div>
<hr>
<div class="row" style="padding:0.1 auto o.1 auto">

<div class="col-md-1">
Embry<br/>ologist:
</div>
<div class="col-md-3" style="">
<?php echo $visit_details['selected_doctor']; ?>
</div>
<div class="col-md-1">
DOB:
</div>
<div class="col-md-3" style="">
<?php echo date('d-m-Y', strtotime($visit_details['dob'])); ?>
</div>
<div class="col-md-1">
Visiting Dept.:
</div>
<div class="col-md-3" style="">
<?php //$doctorname = $details_now['selected_doctor']; echo $ivfobj->dept_by_docname($doctorname,$bcode)['unitname']; ?>
</div>
</div>
<hr>
<div class="row">

<div class="col-md-1">
Age:
</div>
<div class="col-md-3" style="word-wrap:break-word">
<?php $d1 = date_create(date('Y-m-d')); $d2 = date_create($visit_details['dob']); $age = date_diff($d1,$d2); echo $age->y.'yr(s)'.$age->m.'mnth'.$age->d.'days'; //echo $visit_details['age']; ?>
</div>
<div class="col-md-1">
Mobile:
</div>
<div class="col-md-3" style="">
<?php echo $visit_details['phoneno']; ?>
</div>
<div class="col-md-1">
Patient Category:
</div>
<div class="col-md-3" style="">
<?php echo $visit_details['category'] ?>
</div>
</div>



</div>

<div class="col-md-2">
<img src="../../assets/upload/img/patients/<?php if(!empty($visit_details['pass_path']) && file_exists('../../assets/upload/img/patients/'.$visit_details['pass_path'])){echo $visit_details['pass_path'];} else{ echo 'no_pic_phy.jpg';}//if(!empty($visit_details['pass_path'])){echo $visit_details['pass_path'];} else{ echo 'no_pic_phy.jpg';}; ?>" alt="Patient Pic" height="200" width="150"  style="border-radius:5%">
<p style="margin-top:2em; width:150px;height:40px;font-size:1.2em; text-align:center; background-color:#337AB7"><?php echo $visit_details['prn']; ?></p>
</div></div></div>

</div>

<div class="container">
<div class="panel-group">
<div class="panel panel-default" style="border: solid 1px #00C0EF">
<div class="panel-heading bg-orange" style="color:white">
<p>Patient's Details</p>
</div>
<div class="panel-body">


<form autocomplete="off">

<div class="form-row">
<div class="col-md-6">
<label for="">Husband's Name</label>
<input type="text" class="form-control" name="" id="h_n" style="box-shadow:0 2px 4px rgba(0,0,0,0.2);">
</div>

<div class="col-md-6">
<label for="">Wife's Name</label>
<input type="text" class="form-control" name="" id="w_n" style="box-shadow:0 2px 4px rgba(0,0,0,0.2);">
</div></div>
<div class="form-row">
<div class="col-md-6">
<label for="">Husband's Age</label>
<input type="text" class="form-control" name="" id="h_a" style="box-shadow:0 2px 4px rgba(0,0,0,0.2);">
</div>
<div class="col-md-6">
<label for="">Wife's Age</label>
<input type="text" class="form-control" name="" id="w_a" style="box-shadow:0 2px 4px rgba(0,0,0,0.2);">
</div></div>

<div class="form-row">
<div class="col-md-6">
<label for="">Husband's Occupation</label>
<input type="text" class="form-control" name="" id="h_o" style="box-shadow:0 2px 4px rgba(0,0,0,0.2);">
</div>
<div class="col-md-6">
<label for="">Wife's Occupation</label>
<input type="text" class="form-control" name="" id="w_o" style="box-shadow:0 2px 4px rgba(0,0,0,0.2);">
</div></div>
<div class="form-row">
<div class="col-md-12">
<label for="">Address</label>
<textarea name="" id="add" class="form-control" style="box-shadow:0 2px 4px rgba(0,0,0,0.2);"></textarea>
</div>
</div>

<div class="form-row">
<div class="col-md-6">
<label for="">Husband's Phone No.</label>
<input type="text" class="form-control" name="" id="h_ph" style="box-shadow:0 2px 4px rgba(0,0,0,0.2);">
</div>
<div class="col-md-6">
<label for="">Wife's Phone No.</label>
<input type="text" class="form-control" name="" id="w_ph" style="box-shadow:0 2px 4px rgba(0,0,0,0.2);">
</div></div>

<div class="form-row">
<div class="col-md-12">
<label for="">Referral Hospital</label>
<textarea name="" id="ref_hos" class="form-control" style="box-shadow:0 2px 4px rgba(0,0,0,0.2);"></textarea>
</div>
</div>

<div class="col-md-12">
<p class="bg-orange" style="width:100%; color:white; margin:1% 0 1% 0; font-size:1.2em">&nbsp;Present History</p>
</div>

<div class="form-row">
<div class="col-md-6">
<label for="">Marital Status</label>
<input type="text" class="form-control" name="" id="mar_stat" style="box-shadow:0 2px 4px rgba(0,0,0,0.2);">
</div>
<div class="col-md-6">
<label for="">Type of Infertility</label>
<select name="" class="form-control" id="type_infertility" style="box-shadow:0 2px 4px rgba(0,0,0,0.2);">
<option value="" selected>Select Option</option>
<option value="PRIMARY">PRIMARY</option>
<option value="SECONDARY">SECONDARY</option>
<option value="NIL">NIL</option>
</select>

</div></div>

<div class="col-md-12">
<p class="bg-green" style="width:100%; color:white; margin:1% 0 1% 0; font-size:1.2em">&nbsp;Medical History</p>
</div>

<div class="form-row">
<div class="col-md-2">

<input type="checkbox" id="htn"/>
<label for="">HTN</label>
</div>

<div class="col-md-2">

<input type="checkbox" name="" id="tb">
<label for="">TB</label>
</div>

<div class="col-md-2">

<input type="checkbox" name="" id="dm">
<label for="">DM</label>
</div>

<div class="col-md-2">

<input type="checkbox" name="" id="asth">
<label for="">Asthmatic</label>
</div>

<div class="col-md-2">

<input type="checkbox" name="" id="hd">
<label for="">Heart Disease</label>
</div>

<div class="col-md-2">

<input type="checkbox" name="" id="d_allergy">
<label for="">H/O Drug Allergy</label>
</div></div>

<div class="form-row">
<div class="col-md-6" style="margin-top:2%">
<label for="">Surgical History</label>
<textarea class="form-control" name="" id="surg_his" style="box-shadow:0 2px 4px rgba(0,0,0,0.2);"></textarea>
</div>


<div class="col-md-6" style="margin-top:2%">
<label for="">Personal History</label><br/>
<div class="col-md-3">
<input type="checkbox" name="" id="smoke"><b>Smoking</b>
</div>
<div class="col-md-3">
<input type="checkbox" name="" id="alcohol"><b>Alcoholic</b>
</div>
<div class="col-md-3">
<input type="checkbox" name="" id="veg"><b>Veg</b>
</div>
<div class="col-md-3">
<input type="checkbox" name="" id="nonveg"><b>Non Veg</b>
</div>
</div></div>

<div class="form-row">
<div class="col-md-12">
<label for="">Family History</label>
<textarea class="form-control" name="" id="fam_his" style="box-shadow:0 2px 4px rgba(0,0,0,0.2);"></textarea>
</div></div>

<div class="form-row">
<div class="col-md-4">
<label for="">Investigation Done</label>
<select name="" class="form-control" id="inv_done" style="box-shadow:0 2px 4px rgba(0,0,0,0.2);">
<option value="" selected>Select Option</option>
<option value="YES">Yes</option>
<option value="NO">No</option>
</select>
</div>

<div class="col-md-4">
<label for="">Tubal Evaluation HSG</label>
<select name="" class="form-control" id="teh" style="box-shadow:0 2px 4px rgba(0,0,0,0.2);">
<option value="" selected>Select Option</option>
<option value="YES">Yes</option>
<option value="NO">No</option>
</select>
</div>

<div class="col-md-4">
<label for="">Laparoscopy</label>
<select name="" class="form-control" id="lap" style="box-shadow:0 2px 4px rgba(0,0,0,0.2);">
<option value="" selected>Select Option</option>
<option value="YES">Yes</option>
<option value="NO">No</option>
</select>
</div></div>

<div class="form-row">
<div class="col-md-4">
<label for="">Hysteroscopy</label>
<select name="" class="form-control" id="hyst" style="box-shadow:0 2px 4px rgba(0,0,0,0.2);">
<option value="" selected>Select Option</option>
<option value="YES">Yes</option>
<option value="NO">No</option>
</select>
</div>

<div class="col-md-4">
<label for="">Previous Blood Investigations</label>
<select name="" class="form-control" id="pbi" style="box-shadow:0 2px 4px rgba(0,0,0,0.2);">
<option value="" selected>Select Option</option>
<option value="YES">Yes</option>
<option value="NO">No</option>
</select>
</div>

<div class="col-md-4">
<label for="">Outside Semen</label>
<select name="" class="form-control" id="semen" style="box-shadow:0 2px 4px rgba(0,0,0,0.2);">
<option value="" selected>Select Option</option>
<option value="YES">Yes</option>
<option value="NO">No</option>
</select>
</div></div>

<div class="col-md-12">
<p class="bg-aqua-gradient" style="width:100%; color:white; margin:1% 0 1% 0; font-size:1.2em">&nbsp; Menstrual History</p>
</div>

<div class="form-row">
<div class="col-md-4">
<label for="">Menstrual Condition</label>
<select name="" class="form-control" id="menstrual_con" style="box-shadow:0 2px 4px rgba(0,0,0,0.2);">
<option value="" selected>Select Option</option>
<option value="REGULAR">Regular</option>
<option value="IRREGULAR">Irregular</option>
<option value="MENOPAUSAL">Menopausal</option>
</select>
</div>

<div class="col-md-4">
<label for="">Nature Of Flow</label>
<select name="" class="form-control" id="flow_nat" style="box-shadow:0 2px 4px rgba(0,0,0,0.2);">
<option value="" selected>Select Option</option>
<option value="NORMAL">Normal</option>
<option value="MILD">Mild</option>
<option value="SCANTY">Scanty</option>
<option value="EXCESSIVE">Excessive</option>
</select>
</div>

<div class="col-md-4">
<label for="">Dysmenorrhoea</label>
<select name="" class="form-control" id="dysm" style="box-shadow:0 2px 4px rgba(0,0,0,0.2);">
<option value="" selected>Select Option</option>
<option value="NO">No</option>
<option value="MILD">Mild</option>
<option value="EXCESSIVE">Excessive</option>
</select>
</div></div>

<div class="form-row">
<div class="col-md-6">
<label for="">Inter Menstrual/Post Coital Bleeding</label>
<select name="" class="form-control" id="coital_bleeding" style="box-shadow:0 2px 4px rgba(0,0,0,0.2);">
<option value="">Select Option</option>
<option value="">Yes</option>
<option value="">No</option>
</select>
</div>

<div class="col-md-6">
<label for="">LMP</label>
<input type="date" class="form-control" name="" id="lmp">
</div></div>

<div class="col-md-12">
<p class="bg-maroon-gradient" style="width:100%; color:white; margin:1% 0 1% 0; font-size:1.2em">&nbsp;Coital History</p>
</div>

<div class="form-row">
<div class="col-md-6">
<label for="">Awareness Of Fertile Period</label>
<select name="" class="form-control" id="aware_fert" style="box-shadow:0 2px 4px rgba(0,0,0,0.2);">
<option value="">Select Option</option>
<option value="">Yes</option>
<option value="">No</option>
</select>
</div>

<div class="col-md-6">
<label for="">Dyspareunia</label>
<select name="" class="form-control" id="dyspa" style="box-shadow:0 2px 4px rgba(0,0,0,0.2);">
<option value="">Select Option</option>
<option value="">Yes</option>
<option value="">No</option>
</select>
</div></div>

<div class="col-md-12">
<p class="bg-olive-active" style="width:100%; color:white; margin:1% 0 1% 0; font-size:1.2em">&nbsp;Examination</p>
</div>

<div class="form-row">
<div class="col-md-3">
<label for="">Height</label>
<input type="text" class="form-control" name="" id="height" style="box-shadow:0 2px 4px rgba(0,0,0,0.2);">
</div>

<div class="col-md-3">
<label for="">Weight</label>
<input type="text" class="form-control" name="" id="weight" style="box-shadow:0 2px 4px rgba(0,0,0,0.2);">
</div>

<div class="col-md-3">
<label for="">BMI</label>
<input type="text" class="form-control" name="" id="bmi" style="box-shadow:0 2px 4px rgba(0,0,0,0.2);">
</div>

<div class="col-md-3">
<label for="">Thyroid</label>
<input type="text" class="form-control" name="" id="thyroid" style="box-shadow:0 2px 4px rgba(0,0,0,0.2);">
</div></div>

<div class="form-row">
<div class="col-md-6">
<label for="">Breast Galactorrhoes</label>
<select name="" class="form-control" id="breast_galact" style="box-shadow:0 2px 4px rgba(0,0,0,0.2);">
<option value="">Select Option</option>
<option value="">Yes</option>
<option value="">No</option>
</select>
</div>

<div class="col-md-6">
<label for="">Ovulation Induction</label>
<input type="text" class="form-control" name="" id="ovul_ind" style="box-shadow:0 2px 4px rgba(0,0,0,0.2);">
</div></div>

<div class="col-md-12">
<p class="bg-green-gradient" style="width:100%; color:white; margin:1% 0 1% 0; font-size:1.2em">&nbsp;Treatment History</p>
</div>

<div class="form-row">
<div class="col-md-6">
<label for="">IUI</label>
<input type="text" class="form-control" name="" id="iui" style="box-shadow:0 2px 4px rgba(0,0,0,0.2);">
</div>

<div class="col-md-6">
<label for="">IVF/ICSI</label>
<input type="text" class="form-control" name="" id="ivf" style="box-shadow:0 2px 4px rgba(0,0,0,0.2);">
</div></div>

<div class="col-md-12">
<p class="bg-aqua" style="width:100%; color:white; margin:1% 0 1% 0; font-size:1.2em">&nbsp;Observation</p>
</div>

<div class="row" style="margin-left:0.1%;margin-right:0.1%">
<div class="col-md-6">
<label for="">Summary</label>
<textarea name="" id="summary" class="form-control" style="box-shadow:0 2px 4px rgba(0,0,0,0.2);"></textarea>
</div>

<div class="col-md-6">
<label for="">USG Date</label>
<input type="text" class="form-control" name="" id="usg_date" style="box-shadow:0 2px 4px rgba(0,0,0,0.2);">
</div></div>

<div class="row" style="margin-left:0.1%;margin-right:0.1%">
<div class="col-md-6">
<label for="">Uterus</label>
<textarea name="" class="form-control" id="uterus" style="box-shadow:0 2px 4px rgba(0,0,0,0.2);"></textarea>
</div>

<div class="col-md-6">
<label for="">Cavity</label>
<input type="text" class="form-control" name="" id="cavity" style="box-shadow:0 2px 4px rgba(0,0,0,0.2);">
</div></div>

<div class="row" style="margin-left:0.1%;margin-right:0.1%">
<div class="col-md-6">
<label for="">Lt. Ovary</label>
<textarea name="" id="lt_ovary" class="form-control" style="box-shadow:0 2px 4px rgba(0,0,0,0.2);"></textarea>
</div>

<div class="col-md-6">
<label for="">Rt. Ovary</label>
<textarea name="rt_ovary" class="form-control" style="box-shadow:0 2px 4px rgba(0,0,0,0.2);"></textarea>
</div></div>

<div class="row" style="margin-left:0.1%;margin-right:0.1%">
<div class="col-md-6">
<label for="">AFC Lt.</label>
<textarea name="" id="afc_lt" class="form-control" style="box-shadow:0 2px 4px rgba(0,0,0,0.2);"></textarea>
</div>

<div class="col-md-6">
<label for="">AFC Rt.</label>
<textarea name="" id="afc_rt" class="form-control" style="box-shadow:0 2px 4px rgba(0,0,0,0.2);"></textarea>
</div></div>

<div class="row" style="margin-left:0.1%; margin-right:0.1%">
<div class="col-md-12">
<label for="">Any Abnormal Findings</label>
<textarea name="" id="findings" class="form-control" style="box-shadow:0 2px 4px rgba(0,0,0,0.2);"></textarea>
</div></div>

<div class="form-row">
<div class="col-md-6">
<label for="">Counselling Done?</label>
<select name="" class="form-control" id="counsel" style="box-shadow:0 2px 4px rgba(0,0,0,0.2);">
<option value="" selected>Select Option</option>
<option value="">Yes</option>
<option value="">No</option>
</select>
</div>

<div class="col-md-6">
<label for="">Done By</label>
<input type="text" class="form-control" name="" id="by" style="box-shadow:0 2px 4px rgba(0,0,0,0.2);">
</div></div>

<div class="row" style="margin-left:0.1%;margin-right:0.1%">
<div class="col-md-12">
<label for="">Note</label>
<textarea name="" class="form-control" id="note" style="box-shadow:0 2px 4px rgba(0,0,0,0.2);"></textarea>
</div></div>
<input type="hidden" value="<?php echo $_SESSION['id']; ?>" name="" id="saved_by">
<input type="hidden" value="<?php echo $_GET['prn'] ?>" name="" id="prn">
<input type="hidden" value="<?php echo $_GET['id'] ?>" name="" id="id">
<input type="hidden" value="<?php echo $visit_details['visitno'] ?>" name="" id="vsn">
<input type="hidden" value="0" name="" id="donor">
<input type="hidden" value="0" name="" id="referral">

<div class="row" style="margin-left:5%;margin-right:5%; margin-top:2%">
<div class="col-md-12">
<input type="button" class="btn-success form-control" value="Submit" name="" id="submit" style="font-size:1.2em;font-weight:bold">
</div></div>


</div>

</div>

</div></div>


    </body>
   

    
  <script src="../../assets/hms-js/jquery-1.11.1.min.js"></script>  
  <script src="../../assets/hms-js/bootstrap.min.js"></script>
  <script src="addjs.js"></script> 
    
  <script src="../../assets/js/select2.js"></script>
  

<script type='text/javascript'>



 </script>
  </html>