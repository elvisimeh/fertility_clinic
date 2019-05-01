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

   

   
          
//$vsn = $_GET["vsn"];
$bcode = $_SESSION["branchcode"]; 
$ccode = $_SESSION["companycode"];  


 $ivfobj = new IVF;
 
 //$visit_details = $ivfobj->get_patient_details($prn);
 
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

<body>

	
     

<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h4 class="modal-title" style="text-align:center">Counselling Note Entry Form</h4>

</div>
<div class="modal-body" style="background-color:white;">
<div id="success_messg_first" style="display:none;color:green; text-align:center">Counselling Note Saved successfully</div>

<form action="controller_submit_counsel.php" method='POST' id="ivf_counselling">


<div class="form-row">
    <div class="col-md-6">
<label for="">Client Name</label>
<input type="text" class="form-control" name="name" id="">
</div>

<div class="col-md-6">
<label for="">DOB</label>
<input type="date" class="form-control" name="dob" id="">
</div></div>


<div class="form-row">
    <div class="col-md-6">
<label for="">Address</label>
<input type="text" class="form-control" name="address" id="">
</div>

<div class="col-md-6">
<label for="">Complexion</label>
<input type="text" class="form-control" name="complexion" id="">
</div></div>

<div class="form-row">
    <div class="col-md-6">
<label for="">Antra Follicular Count</label>
<input type="text" class="form-control" name="afc" id="">
</div>

<div class="col-md-6">
<label for="">LMP</label>
<input type="date" class="form-control" name="lmp" id="">
</div></div>

<div class="form-row">
    <div class="col-md-6">
<label for="">Blood Group</label>
<input type="text" class="form-control" name="blood_group" id="">
</div>

<div class="col-md-6">
<label for="">Wife's Phone</label>
<input type="text" class="form-control" name="w_phone" id="">
</div></div>

<div class="form-row">
    <div class="col-md-6">
<label for="">Husband's Phone</label>
<input type="text" class="form-control" name="h_phone" id="">
</div>

<div class="col-md-6">
<label for="">Email</label>
<input type="email" class="form-control" name="email" id="">
</div></div>

<div class="form-row">
    <div class="col-md-6">
<label for="">Referral</label>
<input type="text" class="form-control" name="referral" id="">
</div>

<div class="col-md-6">
<label for="">Client Type</label>
<select name="type" class="form-control" id="">
    <option value="SELF">SELF</option>
    <option value="DONOR">DONOR</option>
    <option value="SURROGATE">SURROGATE</option>
</select>
</div></div>

<div class="form-row">
    <div class="col-md-6">
<label for="">No. of Children</label>
<input type="text" class="form-control" name="noc" id="">
</div>

<div class="col-md-6">
<label for="">Sign</label>
<input type="text" class="form-control" name="sign" id="">
</div></div>



<input type="hidden" name="bcode" value="<?php echo $_SESSION['branchcode'] ?>" id="">

<input type="hidden" name="ccode" value="<?php echo $_SESSION['companycode'] ?>" id="">
<input type="hidden" name="by" value="<?php echo $_SESSION['id'] ?>" id="">


<input type="submit" class="form-control btn btn-success" value="Save" name="save" id="" style="margin-top:2%">

</form>


</div>




    </body>
   

    
  <script src="../../assets/hms-js/jquery-1.11.1.min.js"></script>  
  <script src="../../assets/hms-js/bootstrap.min.js"></script>
  <script src="addjs.js"></script> 
    
  <script src="../../assets/js/select2.js"></script>
  

<script type='text/javascript'>

$( "#ivf_counselling" ).submit(function( event ) {
      event.preventDefault();      
    console.log( $( this ).serialize() );
    var post_url = $('#ivf_counselling').attr('action');
    var form_data = $( this ).serialize();
    $.ajax({
      type: "POST",
      url: post_url,
      data: form_data,
      //dataType: 'html',
      success: function(data){  
              
         $('#success_messg_first').show();
         $('#ivf_counselling').trigger('reset');
         setTimeout(function () { 
         $('#success_messg_first').hide(); 
        }, 5000);   
                  
      }
    });
      //.done(function(data) {
      //    console.log(post_url); 
   //});
    
  });

 </script>
  </html>