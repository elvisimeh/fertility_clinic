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
//$id =  $_GET["id"];           
//$vsn = $_GET["vsn"];
$bcode = $_SESSION["branchcode"]; 
$ccode = $_SESSION["companycode"];  


 $ivfobj = new IVF;
 
 $patient_details = $ivfobj->get_ivf_file($prn);
 
 //var_dump($visit_details);

 $corporate = 'CORPORATE';
 $insurance  = 'INSURANCE';
 $family     = 'FAMILY';
 $private    = 'PRIVATE';
 $spec = 30;
 $lab = 'LABORATORY';
 $rad = 'MEDICAL IMAGING';
 $lab_invs = $ivfobj->lab_services($lab,$bcode,$ccode);
 $rad_invs = $ivfobj->rad_services($bcode,$ccode);
 $fert_services = $ivfobj->fert_services($bcode,$ccode);
 $ivfno = $patient_details['ivf_no'];
 $vsn = $patient_details['vsn'];
 $load_services = $ivfobj->load_service($ivfno);
 $tab_drugs = $ivfobj->tab_drugs($bcode,$ccode);
 $liq_drugs = $ivfobj->liq_drugs($bcode,$ccode);
 $con_drugs = $ivfobj->con_drugs($bcode,$ccode);
 //$dept_id = $_SESSION['id'];
 //var_dump($_SESSION);
 $dept = $_SESSION['unit'];

 $fert_dept = $ivfobj->get_user_dept($dept,$bcode,$ccode)['id'];

 
 //var_dump($lab_invs);
 
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

<link rel="stylesheet" href="../../assets/css/select2.css">
<script>
function show(){
      $('#ph_services').css('display','');
      $('#sdm').attr('onclick','remove()');

  }

  function remove(){
      $('#ph_services').css('display','none');
      $('#sdm').attr('onclick','show()');

  }

  function delete_drug(e){
      var id = e.id;
      var prn = $('#prn').val();
      var ivfno = $('#ivfno').val();
       // alert(id);
      var conf= confirm("Are You Sure You Want To Delete This Drug?" );
   if (conf==true){
      $.post('controller_delete_drug', {
        id : id,
        prn : prn,
        ivfno :ivfno

      },
      function(data){
        if(data == 'success'){
            $('#load_drugs').load('load_drugs?prn='+prn+'&ivfno='+ivfno);
       $('.balance').load('balance?prn='+$('#prn').val());
        }
    });
      
    }
  }

  function load_inv_result(id){
    
    $('#new_result').load('lab_result?id='+id);
}

function load_rad_result(id){
    
    $('#new_result').load('rad_result?id='+id);
}

function delete_service(e){
      var id = e.id;
      var prn = $('#prn').val();
      var ivfno = $('#ivfno').val();
       // alert(id);
      var conf= confirm("Are You Sure You Want To Delete This Service?" );
   if (conf==true){
      $.post('controller_delete_service', {
        id : id,
        prn : prn,
        ivfno :ivfno
      },
      function(){ 
                 
            $('#load_lab_services').load('load_lab_service?prn='+prn+'&ivfno='+ivfno);
       $('.balance').load('balance?prn='+$('#prn').val());
           
    });
      
    }
  }

  function delete_rad_service(e){
      var id = e.id;
      var prn = $('#prn').val();
      var ivfno = $('#ivfno').val();
       // alert(id);
      var conf= confirm("Are You Sure You Want To Delete This Service?" );
   if (conf==true){
      $.post('controller_delete_service', {
        id : id,
        prn : prn,
        ivfno :ivfno
      },
      function(){ 
                 
            $('#load_rad_service').load('load_rad_service?prn='+prn+'&ivfno='+ivfno);
       $('.balance').load('balance?prn='+$('#prn').val());
           
    });
      
    }
}

    function delete_fert_service(e){
      var id = e.id;
      var prn = $('#prn').val();
      var ivfno = $('#ivfno').val();
       // alert(id);
      var conf= confirm("Are You Sure You Want To Delete This Service?" );
   if (conf==true){
      $.post('controller_delete_service', {
        id : id,
        prn : prn,
        ivfno :ivfno
      },
      function(){ 
                 
            $('#load_fert_service').load('load_fert_service?prn='+prn+'&ivfno='+ivfno);
       $('.balance').load('balance?prn='+$('#prn').val());
           
    });
    }
  }

  </script>
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
    cursor: pointer;
}

body {
padding-right: 0px !important;
}


/*@media only screen and (max-width: 760px), (min-width: 768px) and (max-width: 1024px) {*/
    /* ... */
    
</style>

<script>
function existing_fert(){
    $('#router').load('existing_fert_pat');
}
</script>

<body>
<div style="width:100%;">
	<?php include("../_includes/hms-header.php");?>
    <div class="container" style="">
    <ul class="breadcrumb" style="margin-left:0%;">
<li><a href="index">Dashboard</a></li>
<li><a onclick="existing_fert()">Fertility Patients' list</a></li>
<li>Fertility Patient File</li>
</ul></div>
  </div> 

<div class="container">

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
<?php echo $patient_details['prn']; ?>
</div>
<div class="col-md-1">
Sponsor:
</div>
<div class="col-md-3" style="word-wrap:break-word">
<?php if($patient_details['category'] == 'PRIVATE'){echo $patient_details['fullname'];}elseif($patient_details['category'] == 'CORPORATE'){echo $patient_details['corporate_name'];}else{echo $patient_details['corporate_name'];}//$category = $visit_details['category']; if($ivfobj->get_cat($category)['category']==$private){ echo $visit_details['sponsor'];} elseif($ivfobj->get_cat($category)['category']==$family){ echo $fam_sponsor['family_name'];} else {$client = $visit_details['sponsor']; echo $ivfobj->get_client_id($client)[0]['corporate_name'];}   ?>
</div>
<div class="col-md-1">
NOK Phone No.: 
</div>
<div class="col-md-3" style="">
<?php echo $patient_details['nok_phone'] ?>
</div>
</div>
<hr>
<div class="row" style="padding:0.1 auto o.1 auto">
<div class="col-md-1">
Patient Name: 
</div>
<div class="col-md-3" style="word-wrap:break-word">
<?php echo $patient_details['fullname'] ?>
</div>
<div class="col-md-1">
Marital Status: 
</div>
<div class="col-md-3" style="">
<?php echo $patient_details['marital_status'] ?>
</div>
<div class="col-md-1">
Gender:
</div>
<div class="col-md-3" style="">
<?php echo $patient_details['gender']; ?>
</div>
</div>
<hr>
<div class="row" style="padding:0.1 auto o.1 auto">

<div class="col-md-1">
Referral<br/>Doctor:
</div>
<div class="col-md-3" style="">
<?php //echo $visit_details['selected_doctor']; ?>
</div>
<div class="col-md-1">
DOB:
</div>
<div class="col-md-3" style="">
<?php echo date('d-m-Y', strtotime($patient_details['dob'])); ?>
</div>
<div class="col-md-1">
Visiting Dept.:
</div>
<div class="col-md-3" style="">
<?php echo 'FERTILITY CENTER'; //$doctorname = $details_now['selected_doctor']; echo $ivfobj->dept_by_docname($doctorname,$bcode)['unitname']; ?>
</div>
</div>
<hr>
<div class="row">

<div class="col-md-1">
Age:
</div>
<div class="col-md-3" style="word-wrap:break-word">
<?php $d1 = date_create(date('Y-m-d')); $d2 = date_create($patient_details['dob']); $age = date_diff($d1,$d2); echo $age->y.'yr(s)'.$age->m.'mnth'.$age->d.'days'; //echo $visit_details['age']; ?>
</div>
<div class="col-md-1">
Mobile:
</div>
<div class="col-md-3" style="">
<?php echo $patient_details['phoneno']; ?>
</div>
<div class="col-md-1">
Patient Category:
</div>
<div class="col-md-3" style="">
<?php echo $patient_details['category'] ?>
</div>
</div>



</div>

<div class="col-md-2">
<img src="../../assets/upload/img/patients/<?php if(!empty($patient_details['pass_path']) && file_exists('../../assets/upload/img/patients/'.$patient_details['pass_path'])){echo $patient_details['pass_path'];} else{ echo 'no_pic_phy.jpg';}//if(!empty($visit_details['pass_path'])){echo $visit_details['pass_path'];} else{ echo 'no_pic_phy.jpg';}; ?>" alt="Patient Pic" height="200" width="150"  style="border-radius:5%">
<p style="margin-top:2em; width:150px;height:40px;font-size:1.2em; text-align:center; background-color:#337AB7"><?php echo $patient_details['ivf_no']; ?></p>
</div></div></div>

</div>
<div class="container">

<div class="panel panel-default" style="background-color:transparent;border:0">
<div class="panel panel-heading bg-orange-active">
<h4 class="panel-title" style="color:#FFF;" id="sdm" data-target="#sdm2" data-toggle="collapse" >
            <a role="button" class="">
            <span class="glyphicon glyphicon-plus-sign"> </span>&nbsp;Services/Drugs Menu</a>
          </h4>

</div>
<!--<div id="ph_services" style="display:none">-->
<div class="collapse" id="sdm2">
<div class="panel panel-body"  style="border: 1px solid grey">

<div class="panel-group">
<div class="panel panel-default">
<div class="panel-heading" style="height:4em">
<a data-target="#labinv" class="btn btn-success" data-toggle="modal" style="float:right">Add Lab Investigations</a>
</div>
<div class="panel-body" id="load_lab_services" style="max-height:10em;overflow-y:scroll">
<?php include 'load_lab_service.php' ?>
</div>
</div>

<div class="panel panel-default">
<div class="panel-heading" style="height:4em">
<a data-target="#drug_order" class="btn btn-success and" data-toggle="modal" style="float:right">Add Pharmacy Item</a>
</div>
<div class="panel-body" id="load_drugs" style="max-height:10em;overflow-y:scroll">
<?php include 'load_drugs.php' ?>
</div>
</div>

<div class="panel panel-default">
<div class="panel-heading" style="height:4em">
<a data-target="#prescription_note" class="btn btn-success and" data-toggle="modal" style="float:right">Add Prescription Note</a>
</div>
<div class="panel-body" id="load_prescription" style="max-height:10em;overflow-y:scroll">
<?php include 'load_prescription.php' ?>
</div>
</div>

<div class="panel panel-default">
<div class="panel-heading" style="height:4em">
<a data-target="#radinv" class="btn btn-success and" data-toggle="modal" style="float:right">Add Radiology Investigation</a>
</div>
<div class="panel-body" id="load_rad_service" style="max-height:10em;overflow-y:scroll">
<?php include 'load_rad_service.php' ?>
</div>
</div></div>

<div class="panel panel-default">
<div class="panel-heading" style="height:4em">
<a data-target="#fert_serv" class="btn btn-success and" data-toggle="modal" style="float:right">Add IVF Service</a>
</div>
<div class="panel-body" id="load_fert_service" style="max-height:10em;overflow-y:scroll">
<?php include 'load_fert_service.php' ?>
</div>
</div></div>

</div></div></div></div>




<div class="panel panel-default" style="background-color:transparent;border:0">
<div class="panel panel-heading bg-orange-active">
<h4 class="panel-title" style="color:#FFF;" data-toggle="collapse" data-target="#jk">
            <a role="button" class="">
            <span class="glyphicon glyphicon-plus-sign"> </span>&nbsp;Other Menu</a>
          </h4>

</div>
<div class="collapse" id="jk">
<div class="panel panel-body" style="border: 1px solid grey">

<div class="panel-group">


<div class="panel panel-default">
<div class="panel panel-heading" style="background-color:rgba(5,55,35,0.5)"><div style="margin-left:85%">
<button data-target="#sperm_pre" data-toggle="modal" style="border-radius:4%;">Sperm Pre-prep</button></div>
</div>
<div class="panel panel-body" id="lspp">
<?php include 'load_spp.php' ?>
</div></div>

<div class="panel panel-default">
<div class="panel panel-heading" style="background-color:rgba(11,75,55,0.5)"><div style="margin-left:85%">
<button data-target="#sperm_post" data-toggle="modal" style="border-radius:4%;">Sperm Post-prep</button></div>
</div>
<div class="panel panel-body" id="lspostp">
<?php include 'load_spostp.php' ?>
</div></div>

<div class="panel panel-default">
<div class="panel panel-heading" style="background-color:rgba(11,102,35,0.5)"><div style="margin-left:85%">
<button data-target="#egg_details" data-toggle="modal" style="border-radius:4%;">Egg Details</button></div>
</div>
<div class="panel panel-body" id="legg">
<?php include 'load_eggd.php' ?>
</div></div>

<div class="panel panel-default">
<div class="panel panel-heading" style="background-color:rgba(55,102,35,0.5)"><div style="margin-left:85%">
<button data-target="#pn_check" data-toggle="modal" style="border-radius:4%;">PN Check</button></div>
</div>
<div class="panel panel-body" id="lpn">
<?php include 'load_pn_check.php' ?>
</div></div>

<div class="panel panel-default">
<div class="panel panel-heading" style="background-color:rgba(55,102,55,0.5)"><div style="margin-left:85%">
<button data-target="#grading" data-toggle="modal" style="border-radius:4%;">Grading</button></div>
</div>
<div class="panel panel-body" id="lg">
<?php include 'load_grading.php' ?>
</div></div>

<div class="panel panel-default">
<div class="panel panel-heading" style="background-color:rgba(65,152,35,0.5)"><div style="margin-left:85%">
<button data-target="#transfer" data-toggle="modal" style="border-radius:4%;">Embryo Transfer</button></div>
</div>
<div class="panel panel-body" id="let">
<?php include 'load_embryo_transfer.php' ?>
</div></div>

<div class="panel panel-default">
<div class="panel panel-heading" style="background-color:rgba(95,112,45,0.5)"><div style="margin-left:85%">
<button data-target="#outcome" data-toggle="modal" style="border-radius:4%;">Treatment Outcome</button></div>
</div>
<div class="panel panel-body" id="lto">
<?php include 'load_treatment_outcome.php' ?>
</div></div>


</div></div></div>



</div>



<div class="modal fade" id="labinv" role="dialog" aria-labelledby="myModalLabel">
        
              <?php include 'add_lab_inv.php'; ?>
            
    </div>

    <div class="modal fade" id="drug_order" role="dialog" aria-labelledby="myModalLabel" style="width:70%;margin:auto">
        
        <?php include 'drug_prescription.php'; ?>
      
</div>

<div class="modal fade" id="prescription_note" role="dialog" aria-labelledby="myModalLabel" style="width:70%;margin:auto">
        
        <?php include 'add_prescription_note.php'; ?>
      
</div>

<div class="modal fade" id="radinv" role="dialog" aria-labelledby="myModalLabel">
        
              <?php include 'add_rad_inv.php'; ?>
            
    </div>

    <div class="modal fade" id="fert_serv" role="dialog" aria-labelledby="myModalLabel">
        
              <?php include 'add_ivf_service.php'; ?>
            
    </div>

    <div class="modal fade" id="sperm_pre" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialogue" style="width:70% !important; display:block !important; margin:auto !important;margin-top:5% !important">
<div class="modal-content"></div>
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h4 class="modal-title" style="text-align:center">SPERM PRE-PREP ASSESSMENT</h4>

</div>
<div class="modal-body" style="background-color:white;">
              <?php include 'sperm_pre_prep.php'; ?>
            
    </div></div></div>

    <div class="modal fade" id="sperm_post" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialogue" style="width:70% !important; display:block !important; margin:auto !important;margin-top:5% !important">
<div class="modal-content"></div>
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h4 class="modal-title" style="text-align:center">SPERM POST-PREP ASSESSMENT</h4>

</div>
<div class="modal-body" style="background-color:white;">
              <?php include 'sperm_post_prep.php'; ?>
            
    </div></div></div>

    <div class="modal fade" id="egg_details" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialogue" style="width:70% !important; display:block !important; margin:auto !important;margin-top:5% !important">
<div class="modal-content"></div>
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h4 class="modal-title" style="text-align:center">DAY 0 (OOCYTES RETRIVAL/TREATMENT)<br/>EGG DETAILS</h4>

</div>
<div class="modal-body" style="background-color:white;">
              <?php include 'egg_details.php'; ?>
            
    </div></div></div>

    <div class="modal fade" id="pn_check" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialogue" style="width:70% !important; display:block !important; margin:auto !important;margin-top:5% !important">
<div class="modal-content"></div>
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h4 class="modal-title" style="text-align:center">DAY 1 (PN Check)</h4>

</div>
<div class="modal-body" style="background-color:white;">
              <?php include 'pn_check.php'; ?>
            
    </div></div></div>

    <div class="modal fade" id="grading" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialogue" style="width:70% !important; display:block !important; margin:auto !important;margin-top:5% !important">
<div class="modal-content"></div>
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h4 class="modal-title" style="text-align:center">DAY (GRADING)</h4>

</div>
<div class="modal-body" style="background-color:white;">
              <?php include 'grading.php'; ?>
            
    </div></div></div>

    <div class="modal fade" id="transfer" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialogue" style="width:70% !important; display:block !important; margin:auto !important;margin-top:5% !important">
<div class="modal-content"></div>
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h4 class="modal-title" style="text-align:center">EMBRYO TRANSFER</h4>

</div>
<div class="modal-body" style="background-color:white;">
              <?php include 'embryo_transfer.php'; ?>
            
    </div></div></div>

    <div class="modal fade" id="outcome" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialogue" style="width:70% !important; display:block !important; margin:auto !important;margin-top:5% !important">
<div class="modal-content"></div>
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h4 class="modal-title" style="text-align:center">TREATMENT OUTCOME</h4>

</div>
<div class="modal-body" style="background-color:white;">
              <?php include 'treatment_outcome.php'; ?>
            
    </div></div></div>

<!-- Add Services modal box -->
<div id="services" class="modal fade" role="dialogue" style="width:60% !important; margin: auto !important">

<?php //include 'add_ivf_service.php' ?>

</div>

<div class="modal fade" id="lab_results">
        <div class="modal-dialog">
            <div class="modal-content" id="new_result">
              
            </div>
        </div>
    </div>

</div>
    <input type="hidden" value="<?php echo $_GET['ivfno'] ?>" name="" id="ivfno">
    <input type="hidden" value="<?php echo $_GET['prn'] ?>" name="" id="prn">
    </body>
   

    
      
  <script src="../../assets/js/select2.js"></script>
  

<script type='text/javascript'>



/*$('.searchable').select2({
  minimumInputLength: 3 // only start searching when the user has input 3 or more characters
});*/

$('.searchable').select2();

$('.add-service').click(function(){
    var service = $('#lab_serv').val();
    var prn = $('#prn').val();
    var age = $('#age').val();
    var category = $('#category').val();
    var sponsor = $('#sponsor').val();
    var plan = $('#plan').val();
    var by = $('#by').val();
    var ivfno = $('#ivfno').val();
    var bcode = $('#bcode').val();
    var ccode = $('#ccode').val();
    var specialty_id = $('#specialty_id').val();
    //alert(service);
    var conf= confirm("Are you sure you want to Post Investigation?" );
   if (conf==true){
    $.post('controller_post_lab_service.php',{
        service : service,
        prn : prn,
        age : age,
        category : category,
        sponsor : sponsor,
        plan : plan,
        by : by,
        ivfno : ivfno,
        bcode : bcode,
        ccode : ccode,
        specialty_id : specialty_id
    },
    function(data){
        if(data=='success'){
            $('#order_lab_inv').trigger('reset');        
         $('#success_messg_lab').show();
         setTimeout(function () { 
         $('#success_messg_lab').hide(); 
        }, 2000); 
        $('#load_lab_services').load('load_lab_service?prn='+prn+'&ivfno='+ivfno);
        
        $('.balance').load('balance?prn='+$('#prn').val());
        
        }
  });
}
});

$('.add-rad-service').click(function(){
    var service = $('#rad_serv').val();
    var prn = $('#prn').val();
    var age = $('#age').val();
    var category = $('#category').val();
    var sponsor = $('#sponsor').val();
    var plan = $('#plan').val();
    var by = $('#by').val();
    var ivfno = $('#ivfno').val();
    var bcode = $('#bcode').val();
    var ccode = $('#ccode').val();
    var specialty_id = $('#specialty_id').val();
    //alert(service);
    var conf= confirm("Are you sure you want to Post Investigation?" );
   if (conf==true){
    $.post('controller_post_lab_service.php',{
        service : service,
        prn : prn,
        age : age,
        category : category,
        sponsor : sponsor,
        plan : plan,
        by : by,
        ivfno : ivfno,
        bcode : bcode,
        ccode : ccode,
        specialty_id : specialty_id
    },
    function(data){
        if(data=='success'){
            $('#order_lab_inv').trigger('reset');        
         $('#success_messg_lab').show();
         setTimeout(function () { 
         $('#success_messg_lab').hide(); 
        }, 2000); 
        $('#load_rad_service').load('load_rad_service?prn='+prn+'&ivfno='+ivfno);
        
        $('.balance').load('balance?prn='+$('#prn').val());
        
        }
  });
}
});

$('.add-ivf-service').click(function(){
    var service = $('#serv_inp').val();
    var prn = $('#prn').val();
    var age = $('#age').val();
    var category = $('#category').val();
    var sponsor = $('#sponsor').val();
    var plan = $('#plan').val();
    var by = $('#by').val();
    var ivfno = $('#ivfno').val();
    var bcode = $('#bcode').val();
    var ccode = $('#ccode').val();
    var specialty_id = $('#specialty_id').val();
    //alert(service);
    var conf= confirm("Are you sure you want to Post Investigation?" );
   if (conf==true){
    $.post('controller_post_ivf_service.php',{
        service : service,
        prn : prn,
        age : age,
        category : category,
        sponsor : sponsor,
        plan : plan,
        by : by,
        ivfno : ivfno,
        bcode : bcode,
        ccode : ccode,
        specialty_id : specialty_id
    },
    function(data){
        if(data=='success'){
            $('#order_ivf_service').trigger('reset');        
         $('#success_messg_lab').show();
         setTimeout(function () { 
         $('#success_messg_lab').hide(); 
        }, 2000); 
        $('#load_fert_service').load('load_ivf_service?prn='+prn+'&ivfno='+ivfno);
        
        $('.balance').load('balance?prn='+$('#prn').val());
        
        }
  });
}
});

/*$( "#order_lab_inv" ).submit(function( event ) {
      event.preventDefault();      
    console.log( $( this ).serialize() );
    var post_url = $('#order_lab_inv').attr('action');
    var form_data = $( this ).serialize();
    $.ajax({
      type: "POST",
      url: post_url,
      data: form_data,
      //dataType: 'html',
      success: function(data){ 
          $('#order_lab_inv').trigger('reset');        
         $('#success_messg_lab').show();
         setTimeout(function () { 
         $('#success_messg_lab').hide(); 
        }, 2000); 
        $('#load_lab_services').load('load_lab_service?prn='+prn+'&ivfno='+ivfno);        
      }
    });
      //.done(function(data) {
      //    console.log(post_url); 
   //});
    
  });*/

  $('#liquid').click(function(){
    $('#liquid1').show();
    $('#tablets').hide();
    $('#consumables1').hide();
});

$('#tab-cap').click(function(){
    $('#liquid1').hide();
    $('#tablets').show();
    $('#consumables1').hide();
});

$('.and').click(function(){
    $('#liquid1').hide();
    $('#tablets').show();
    $('#consumables1').hide();
    $('#tab-cap').addClass('active');
    $('#liquid').removeClass('active');
    $('#consumables').removeClass('active');
});

$('#consumables').click(function(){
    $('#liquid1').hide();
    $('#tablets').hide();
    $('#consumables1').show();
});

$('#dur1').keyup(function(){
       var a= $('#dosage1').val();
       var b= $('#freq1').val();
       var c= $('#dur1').val();
       var qty = a * b * c ;
       $('#qty1').val(qty);
       //alert(qty);

});

$('#dosage1').keyup(function(){
       var a= $('#dosage1').val();
       var b= $('#freq1').val();
       var c= $('#dur1').val();
       var qty = a * b * c ;
       $('#qty1').val(qty);
       //alert(qty);

});

$('#freq1').keyup(function(){
       var a= $('#dosage1').val();
       var b= $('#freq1').val();
       var c= $('#dur1').val();
       var qty = a * b * c ;
       $('#qty1').val(qty);
       //alert(qty);

});

$('#dur2').keyup(function(){
       var d= $('#dosage2').val();
       var e= $('#freq2').val();
       var f= $('#dur2').val();
       var qtytwo = d * e * f ;
       $('#qty2').val(qtytwo);
       //alert(qty);

});

$('#dosage2').keyup(function(){
       var d= $('#dosage2').val();
       var e= $('#freq2').val();
       var f= $('#dur2').val();
       var qtytwo = d * e * f ;
       $('#qty2').val(qtytwo);
       //alert(qty);

});

$('#freq2').keyup(function(){
       var d= $('#dosage2').val();
       var e= $('#freq2').val();
       var f= $('#dur2').val();
       var qtytwo = d * e * f ;
       $('#qty2').val(qtytwo);
       //alert(qty);

});

$( "#tablets" ).submit(function( event ) {
      event.preventDefault();          
    console.log( $( this ).serialize() );
    var post_url = $('#tablets').attr('action');
    var form_data = $( this ).serialize();
    var prn = $('#prn').val();
    var ivfno = $('#ivfno').val();
    
      $.ajax({
      type: "POST",
      url: post_url,
      data: form_data,
      //dataType: 'html',      
      success: function(data){
        if($('#tab1').val()!=null || $('#tab2').val()!=null ){
        $('#success_messg').show();
        $('#tablets').trigger('reset');
        setTimeout(function () { 
         $('#success_messg').hide(); 
        }, 5000); 
       //  
       $('#load_drugs').load('load_drugs?prn='+prn+'&ivfno='+ivfno);
       $('.balance').load('balance?prn='+$('#prn').val());      
      }
    }
    });
      //.done(function(data) {
      //    console.log(post_url); 
   //});
    
  }); 

   $( "#liquid1" ).submit(function( event ) {
      event.preventDefault();          
    console.log( $( this ).serialize() );
    var post_url = $('#liquid1').attr('action');
    var form_data = $( this ).serialize();
    var prn = $('#prn').val();
    var ivfno = $('#ivfno').val();
    $.ajax({
      type: "POST",
      url: post_url,
      data: form_data,
      //dataType: 'html',
      success: function(data){
        if($('#liq1').val()!=null || $('#liq2').val()!=null ){
        $('#success_messg').show();
        $('#liquid1').trigger('reset');
        setTimeout(function () { 
         $('#success_messg').hide(); 
        }, 5000); 
       //        
       $('#load_drugs').load('load_drugs?prn='+prn+'&ivfno='+ivfno);
       $('.balance').load('balance?prn='+$('#prn').val());
      }
    }
    });
          
  });

  $( "#consumables1" ).submit(function( event ) {
      event.preventDefault();          
    console.log( $( this ).serialize() );
    var post_url = $('#consumables1').attr('action');
    var form_data = $( this ).serialize();
    var prn = $('#prn').val();
    var ivfno = $('#ivfno').val();
    $.ajax({
      type: "POST",
      url: post_url,
      data: form_data,
      //dataType: 'html',
      success: function(data){
        if($('#con1').val()!=null || $('#con2').val()!=null ){
        $('#success_messg').show();
        $('#consumables1').trigger('reset');
        setTimeout(function () { 
         $('#success_messg').hide(); 
        }, 5000); 
       // 
       $('#load_drugs').load('load_drugs?prn='+prn+'&ivfno='+ivfno);
       $('.balance').load('balance?prn='+$('#prn').val());
      }
    }
    });
          
  });

  

  $('.getcost1').change(function(){
    var price =   $('#tab1').find(':selected').attr('data-price');
    var qty = Number($('#qty1').val());
    window.drugcost1 = price * qty ;
    var alldrugcost =   window.drugcost1 + window.drugcost2;
    //var mm = $(this).find(':selected').attr('data-price')
    //alert(price);
    if(qty != 0){
        //var balance = Number($('.touse').html());
        var balance = Number($('#getbalance').val());
    $('.touse').html(balance-drugcost1);
    if(Number($('.touse').html()) < 0){
        $('.touse').css('color','red')
    }
    else{
        $('.touse').css('color','black')
    }
    }
  });

  $('.getcost2').change(function(){
    var price =   $('#tab2').find(':selected').attr('data-price');
    var qty = Number($('#qty2').val());
    var drugcost2 = price * qty ;
    var alldrugcost =   window.drugcost1 + drugcost2;
    //var mm = $(this).find(':selected').attr('data-price')
    //alert(price);
    if(qty != 0){
       // var balance = Number($('.touse').html());
       var balance = Number($('#getbalance').val());
    $('.touse').html(balance-alldrugcost);
    if(Number($('.touse').html()) < 0){
        $('.touse').css('color','red')
    }
    else{
        $('.touse').css('color','black')
    }
    }
  });

  $('.getcost3').change(function(){
    var price =   $('#liq1').find(':selected').attr('data-price');
    var qty = Number($('#qty_liq1').val());
    window.drugcost3 = price * qty ;
    //var alldrugcost =   window.drugcost1 + window.drugcost2;
    //var mm = $(this).find(':selected').attr('data-price')
    //alert(price);
    if(qty != 0){
        //var balance = Number($('.touse').html());
        var balance = Number($('#getbalance').val());
    $('.touse').html(balance-drugcost3);
    if(Number($('.touse').html()) < 0){
        $('.touse').css('color','red')
    }
    else{
        $('.touse').css('color','black')
    }
    }
  });

  $('.getcost4').change(function(){
    var price =   $('#liq2').find(':selected').attr('data-price');
    var qty = Number($('#qty_liq2').val());
    var drugcost4 = price * qty ;
    var alldrugcost =   window.drugcost3 + drugcost4;
    //var mm = $(this).find(':selected').attr('data-price')
    //alert(price);
    if(qty != 0){
       // var balance = Number($('.touse').html());
       var balance = Number($('#getbalance').val());
    $('.touse').html(balance-alldrugcost);
    if(Number($('.touse').html()) < 0){
        $('.touse').css('color','red')
    }
    else{
        $('.touse').css('color','black')
    }
    }
  });

  $('.getcost5').change(function(){
    var price =   $('#con1').find(':selected').attr('data-price');
    var qty = Number($('#qty_con1').val());
    window.drugcost5 = price * qty ;
    //var alldrugcost =   window.drugcost1 + window.drugcost2;
    //var mm = $(this).find(':selected').attr('data-price')
    //alert(price);
    if(qty != 0){
        //var balance = Number($('.touse').html());
        var balance = Number($('#getbalance').val());
    $('.touse').html(balance-drugcost5);
    if(Number($('.touse').html()) < 0){
        $('.touse').css('color','red')
    }
    else{
        $('.touse').css('color','black')
    }
    }
  });

  $('.getcost6').change(function(){
    var price =   $('#con2').find(':selected').attr('data-price');
    var qty = Number($('#qty_con2').val());
    var drugcost6 = price * qty ;
    var alldrugcost =   window.drugcost5 + drugcost6;
    //var mm = $(this).find(':selected').attr('data-price')
    //alert(price);
    if(qty != 0){
       // var balance = Number($('.touse').html());
       var balance = Number($('#getbalance').val());
    $('.touse').html(balance-alldrugcost);
    if(Number($('.touse').html()) < 0){
        $('.touse').css('color','red')
    }
    else{
        $('.touse').css('color','black')
    }
    }
  });

  $('.getcost7').change(function(){
    var price =   $('#lab_serv').find(':selected').attr('data-price');
    //var qty = Number($('#qty_con2').val());
    var lab_serv_cost = Number(price) ;
    //alert(price);
    var balance = Number($('#getbalance').val());
    $('.touse').html(balance-lab_serv_cost);
    if(Number($('.touse').html()) < 0){
        $('.touse').css('color','red')
    }
    else{
        $('.touse').css('color','black')
    }
    
  });

  $('.getcost8').change(function(){
    var price =   $('#rad_serv').find(':selected').attr('data-price');
    //var qty = Number($('#qty_con2').val());
    var lab_serv_cost = Number(price) ;
    //alert(price);
    var balance = Number($('#getbalance').val());
    $('.touse').html(balance-lab_serv_cost);
    if(Number($('.touse').html()) < 0){
        $('.touse').css('color','red')
    }
    else{
        $('.touse').css('color','black')
    }
    
  });

  $('.getcost9').change(function(){
    var price =   $('#serv_inp').find(':selected').attr('data-price');
    //var qty = Number($('#qty_con2').val());
    var lab_serv_cost = Number(price) ;
    //alert(price);
    $('#service_cost').val(lab_serv_cost.toLocaleString());
    var balance = Number($('#getbalance').val());
    $('.touse').html(balance-lab_serv_cost);
    if(Number($('.touse').html()) < 0){
        $('.touse').css('color','red')
    }
    else{
        $('.touse').css('color','black')
    }
    
  });



$( "#re_kl" ).click(function( event ) {
      //event.preventDefault(); 
      
      var diagnosis = $('#re_diagnosis').val();
      var prn = $('#re_xprn').val();
      var vsn = $('#re_xvsn').val();
      var dept = $('#re_xdept').val();     

    var conf= confirm("Are you sure you want to Add Diagnosis?" );
   if (conf==true){

      $.post('../../controllers/physiotherapy/add-diagnosis.php',{
          diagnosis : diagnosis,
          prn : prn,
          vsn : vsn,
          dept : dept
      });
      $('#re_diagnosis').val('');
      $('#re_kl').attr('disabled','on');

      setTimeout(function () {
    $('.load-diagnosis').load('diagnosis.php?vsn='+vsn+'&dept='+dept);
      }, 1500);
    }
  });


  $( "#sperm_pre_prep" ).submit(function( event ) {
      event.preventDefault();      
    console.log( $( this ).serialize() );
    var post_url = $('#sperm_pre_prep').attr('action');
    var form_data = $( this ).serialize();
    $.ajax({
      type: "POST",
      url: post_url,
      data: form_data,
      //dataType: 'html',
      success: function(data){  
        var ivfno = $('#ivfno').val();     
         $('#success_messg_spp').show();
         $('#sperm_pre_prep').trigger('reset'); 
         $('#lspp').load('load_spp.php?ivfno='+ivfno); 
                  
      }
    });
      //.done(function(data) {
      //    console.log(post_url); 
   //});
    
  });

  $( "#sperm_post_prep" ).submit(function( event ) {
      event.preventDefault();      
    console.log( $( this ).serialize() );
    var post_url = $('#sperm_post_prep').attr('action');
    var form_data = $( this ).serialize();
    $.ajax({
      type: "POST",
      url: post_url,
      data: form_data,
      //dataType: 'html',
      success: function(data){  
        var ivfno = $('#ivfno').val();     
         $('#success_messg_spostp').show();     
         
         $('#sperm_post_prep').trigger('reset');  
         $('#lspostp').load('load_spostp.php?ivfno='+ivfno);         
      }
    });
      //.done(function(data) {
      //    console.log(post_url); 
   //});
    
  });

  $( "#egg_details_submit" ).submit(function( event ) {
      event.preventDefault();      
    console.log( $( this ).serialize() );
    var post_url = $('#egg_details_submit').attr('action');
    var form_data = $( this ).serialize();
    $.ajax({
      type: "POST",
      url: post_url,
      data: form_data,
      //dataType: 'html',
      success: function(data){  
        var ivfno = $('#ivfno').val();     
         $('#success_messg_egg').show(); 
         $('#egg_details_submit').trigger('reset');
         $('#legg').load('load_eggd.php?ivfno='+ivfno);     
                  
      }
    });
      //.done(function(data) {
      //    console.log(post_url); 
   //});
    
  });

  $( "#pn_check_submit" ).submit(function( event ) {
      event.preventDefault();      
    console.log( $( this ).serialize() );
    var post_url = $('#pn_check_submit').attr('action');
    var form_data = $( this ).serialize();
    $.ajax({
      type: "POST",
      url: post_url,
      data: form_data,
      //dataType: 'html',
      success: function(data){  
        var ivfno = $('#ivfno').val();     
         $('#success_messg_pn').show(); 
         $('#pn_check_submit').trigger('reset');
         $('#lpn').load('load_pn_check.php?ivfno='+ivfno);  
                  
      }
    });
      //.done(function(data) {
      //    console.log(post_url); 
   //});
    
  });

  $( "#grading_submit" ).submit(function( event ) {
      event.preventDefault();      
    console.log( $( this ).serialize() );
    var post_url = $('#grading_submit').attr('action');
    var form_data = $( this ).serialize();
    $.ajax({
      type: "POST",
      url: post_url,
      data: form_data,
      //dataType: 'html',
      success: function(data){  
              
        var ivfno = $('#ivfno').val();     
         $('#success_messg_grading').show(); 
         $('#grading_submit').trigger('reset'); 
         $('#lg').load('load_grading.php?ivfno='+ivfno); 
                  
      }
    });
      //.done(function(data) {
      //    console.log(post_url); 
   //});
    
  });

  $( "#embryo_transfer_submit" ).submit(function( event ) {
      event.preventDefault();      
    console.log( $( this ).serialize() );
    var post_url = $('#embryo_transfer_submit').attr('action');
    var form_data = $( this ).serialize();
    $.ajax({
      type: "POST",
      url: post_url,
      data: form_data,
      //dataType: 'html',
      success: function(data){  
        var ivfno = $('#ivfno').val();     
         $('#success_messg_embryo').show(); 
         $('#embryo_transfer_submit').trigger('reset');  
         $('#let').load('load_embryo_transfer.php?ivfno='+ivfno);         
      }
    });
      //.done(function(data) {
      //    console.log(post_url); 
   //});
    
  });

  $( "#treatment_outcome_submit" ).submit(function( event ) {
      event.preventDefault();      
    console.log( $( this ).serialize() );
    var post_url = $('#treatment_outcome_submit').attr('action');
    var form_data = $( this ).serialize();
    $.ajax({
      type: "POST",
      url: post_url,
      data: form_data,
      //dataType: 'html',
      success: function(data){  
        var ivfno = $('#ivfno').val();     
         $('#success_messg_outcome').show(); 
         $('#treatment_outcome_submit').trigger('reset');  
         $('#lto').load('load_treatment_outcome.php?ivfno='+ivfno);         
      }
    });
      //.done(function(data) {
      //    console.log(post_url); 
   //});
    
  });

  $('#add_pres').submit(function(){
    event.preventDefault();      
    console.log( $( this ).serializeArray() );
    var post_url = $('#add_pres').attr('action');
    var form_data = $( this ).serialize();
    $.ajax({
      type: "POST",
      url: post_url,
      data: form_data,
      //dataType: 'html',
      success: function(data){  
        var prn = $('#prn').val();
        var ivfno = $('#ivfno').val();   
         $('#success_messg_pres').show();
         $('#add_pres').trigger('reset');
         $('#load_prescription').load('load_prescription?prn='+prn+'&ivfno='+ivfno);  
                  
      }
});
  });

  
  //window.location.replace('../../ivf/index.php')
 </script>
  </html>