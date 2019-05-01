<?php
	session_start();
	$staffname = $_SESSION['staffname'];
	
	if(!isset($staffname)){
		header("location:../../index");
		unset($_SESSION['dprn'],$_SESSION['dfname'],$_SESSION['ddept'],$_SESSION['dnextduedate']);
		exit;
    }
    /**Error reporting */
error_reporting(E_ALL);
ini_set('display_errors', 1);
/**End error reporting */
	$staffname = $_SESSION['staffname'];
	$bcode = $_SESSION['branchcode'];
	$ccode = $_SESSION['companycode'];
	
		
	//include("../../controllers/consultation/Doctor.php");
	//include("../../controllers/fd/patient.php");
    //include("../../controllers/admin/Company.php");
    require_once("controller_lib.php");
	
    $ivfobj = new IVF;
    
    
    
    //$doctorObj = new DOCTOR;
	//$patientObj = new PATIENT;
	//$companyObj = new COMPANY;
	
	
    //$op_list = $doctorObj->getOPForConsultation($bcode,$ccode);
    //$pay_status = 'FER';
    $ivf_counsels = $ivfobj->ivf_counselling_list();
    //var_dump($ivf_counsels);
	
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Healthwise | HMS</title>
<!--<meta http-equiv="Refresh" content="20">-->
<link rel="stylesheet" href="../../assets/hms-css/bootstrap.min.css">
<link href="../../assets/css/hms-styles.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="../../assets/css/select2.css">

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

</style>

<script>
 
 function patient_file(e){
     var prn = e.id;
  var id =   document.getElementById(e.id).getAttribute('data-id');
  var ivfno =   document.getElementById(e.id).getAttribute('data-ivfno');
  //alert(re);
    $('#router').load('fert_patient_file?prn='+prn+'&ivfno='+ivfno);
   }   
   
   function register_ivf(e){
     var prn = e.id;
  var id =   document.getElementById(e.id).getAttribute('data-id');
  //alert(re);
    $('#router').load('register_donor?prn='+prn+'&id='+id);
   }   

  function delete_service(e){
      var id = e.id;
      var prn = document.getElementById(id).getAttribute('data-prn');
     // alert(prn);
      var conf= confirm("Are you sure you want to Delete Investigation?" );
   if (conf==true){
      $.post('controller_delete_service',{
          id : id,
          prn : prn
      },
      function(){
        $('#all-inv').load('donor_lab?prn='+prn);
      });

    }
  }

  function donor_inv(e){
    var prn = e.id;
    
    $('#new_donor').load('donor_details?prn='+prn);
}

function load_inv_result(id){
    
    $('#new_results').load('lab_result?id='+id);
}

function edit_counsel(id){
    $('#edit_new').load('edit_counselling_note?id='+id);
}

</script>

<body>
	<?php include("../_includes/hms-header.php");?>
    <nav class="breadcrumb">
        <div class="container">
            <a class="breadcrumb-item" href="index">Dashboard ></a>Counselling List</div>             
    </nav>
	<div class="container-fluid">
		<div class="row">
		  <div class="col-md-12 col-sm-12 hms-grey-bkg-">
              <p>
                    <div class="row hms-divpadding">
                        <div class="col-md-12 col-sm-12">
                            <p>
                            <button class="btn btn-primary" data-target="#counsel_note" data-toggle="modal">Add Counselling Note</button>
                                <div class="col-md-12 col-sm-12" style="margin-top:15px;margin-bottom:2px;">
                                
                                  <div class="form-group">
                                    <div class="input-group">
                                        <input type="search" class="form-control" name="searchvaccine" id="searchpatient" placeholder="Search By Patient Name">
                                        <div class="input-group-addon"><i class="glyphicon glyphicon-search"></i></div>
                                    </div>
                                  </div>
                            </div>
                            
                            <div class="col-md-12 col-sm-12 hms-white-bkg" style="margin-top:15px;margin-bottom:2px;">
                                <h4 style="color:#006600;">Counselling List</h4>
                            </div>
                            <div class="col-md-12 col-sm-12 hms-white-bkg" style="margin-top:2px;margin-bottom:20px;">
                            <br>
                                   <div class="row">
                                        <div class="box-body" id="load_counsel_list">
                                            
                                        <?php include 'ivf_load_counsel_list.php' ?>
                                        
                                        </div>
                                    
                                   </div>
                            </div>
                            </p>
                        </div>
                    </div>
                </p>
            </div>
            
            
            
        
        </div>
    </div>
	



	
	<div class="row">
        
        
       

    </div>
   
    <div class="modal fade" id="counsel_note">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" id="new_donor">
            
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
<input type="text" class="form-control" name="name" id="" required>
</div>

<div class="col-md-6">
<label for="">DOB</label>
<input type="date" class="form-control" name="dob" id="" required>
</div></div>


<div class="form-row">
    <div class="col-md-6">
<label for="">Address</label>
<input type="text" class="form-control" name="address" id="" required>
</div>

<div class="col-md-6">
<label for="">Complexion</label>
<input type="text" class="form-control" name="complexion" id="" required>
</div></div>

<div class="form-row">
    <div class="col-md-6">
<label for="">Antra Follicular Count</label>
<input type="text" class="form-control" name="afc" id="" required>
</div>

<div class="col-md-6">
<label for="">LMP</label>
<input type="text" class="form-control" name="lmp" id="" required>
</div></div>

<div class="form-row">
    <div class="col-md-6">
<label for="">Blood Group</label>
<input type="text" class="form-control" name="blood_group" id="" required>
</div>

<div class="col-md-6">
<label for="">Wife's Phone</label>
<input type="text" class="form-control" name="w_phone" id="" required>
</div></div>

<div class="form-row">
    <div class="col-md-6">
<label for="">Husband's Phone</label>
<input type="text" class="form-control" name="h_phone" id="" required>
</div>

<div class="col-md-6">
<label for="">Email</label>
<input type="email" class="form-control" name="email" id="" required>
</div></div>

<div class="form-row">
    <div class="col-md-6">
<label for="">Referral</label>
<input type="text" class="form-control" name="referral" id="" required>
</div>

<div class="col-md-6">
<label for="">Client Type</label>
<select name="type" class="form-control" id="" required>
    <option value="SELF">SELF</option>
    <option value="DONOR">DONOR</option>
    <option value="SURROGATE">SURROGATE</option>
</select>
</div></div>

<div class="form-row">
    <div class="col-md-6">
<label for="">No. of Children</label>
<input type="text" class="form-control" name="noc" id="" required>
</div>

<div class="col-md-6">
<label for="">Sign</label>
<input type="text" class="form-control" name="sign" id="" required>
</div></div>



<input type="hidden" name="bcode" value="<?php echo $_SESSION['branchcode'] ?>" id="">

<input type="hidden" name="ccode" value="<?php echo $_SESSION['companycode'] ?>" id="">
<input type="hidden" name="by" value="<?php echo $_SESSION['id'] ?>" id="">


<input type="submit" class="form-control btn btn-success" value="Save" name="save" id="" style="margin-top:2%">

</form>


</div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="lab_results">
        <div class="modal-dialog">
            <div class="modal-content" id="new_results">
              
            </div>
        </div>
    </div>

    <div class="modal fade" id="edit">
        <div class="modal-dialog modal-lg" id="">
            <div class="modal-content" id="edit_new">

            </div>
        </div>
    </div>
   
    <div class="fixed2">
     <a href="#">
    I<br>
    N<br>
    C<br>
    I<br>
    D<br>
    E<br>
    N<br>
    T<br>
     </a>
    </div>
    
    <div class="fixed">
     <a href="../qty/compliant" data-toggle='modal' data-target="#complain">
    C<br>
    O<br>
    M<br>
    P<br>
    L<br>
    A<br>
    I<br>
    N<br>
     T</a></div>

     <div class="modal fade" id="complain" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        
        </div>
    </div>
</div>
     

<script src="../../assets/hms-js/jquery-1.11.1.min.js"></script>
<!--<script src="../../assets/hms-js/bootstrap.min.js"></script>-->

  <script>


 
 $(document).ready(function() {

// process the form
$( "#open_consult" ).submit(function( event ) {
    event.preventDefault();
  
  //console.log( $( this ).serialize() );
  var post_url = $('#open_consult').attr('action');
  var form_data = $( this ).serialize();
  
  $.ajax({
    type: "POST",
    url: post_url,
    data: form_data,
    //dataType: 'html',
    success: function(data){
      //  alert('Thank you! we will get back to you within 24 hours. Please check your junk / spam folder if you do not receive a response within that time.');
    console.log(data);
    }
  });
    //.done(function(data) {
    //    console.log(post_url); 
 //});view
 window.location.href = "http://dev.healthwise.sw/views/physiotherapy/consultation";
});


});

function noreload(){
   // e.preventDefault();
    return 'y';
}

/*$('#complain').click(function(){
 $('body').attr('onbeforeunload','return noreload()')
});*/

$('#searchpatient').keyup(function(){
var patientname = $('#searchpatient').val().toUpperCase();
var tbody = document.getElementById('tbody');
var tr = tbody.getElementsByTagName('tr');

for(var i= 0; i < tr.length; i++){
    var a = tr[i].getElementsByTagName("element")[0];
    var search = a.innerText || a.innerContent;
    if (search.toUpperCase().indexOf(patientname) > -1) {
      tr[i].style.display = "";
    } else {
      tr[i].style.display = "none";
    }
}

});


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
         $('#load_counsel_list').load('ivf_load_counsel_list.php');         
      }
    });
      //.done(function(data) {
      //    console.log(post_url); 
   //});
    
  });


</script>
  
</body>
</html>