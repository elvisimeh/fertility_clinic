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
    $ivf_donors = $ivfobj->ivf_donor_list();
    //var_dump($ivf_donors);
	
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

<script>
 
 function patient_file(e){
     var prn = e.id;
  var id =   document.getElementById(e.id).getAttribute('data-id');
  var ivfno =   document.getElementById(e.id).getAttribute('data-ivfno');
  //alert(re);
    $('#router').load('fert_patient_file?prn='+prn+'&ivfno='+ivfno);
   }   
   
   function register_ivf(prn,id){
    // var prn = e.id;
  //var id =   document.getElementById(e.id).getAttribute('data-ghl');
  //alert(prn);
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

</script>

<body>
	<?php include("../_includes/hms-header.php");?>
    <nav class="breadcrumb">
        <div class="container">
            <a class="breadcrumb-item" href="index">Dashboard ></a>Donor List</div>             
    </nav>
	<div class="container-fluid">
		<div class="row">
		  <div class="col-md-12 col-sm-12 hms-grey-bkg-">
              <p>
                    <div class="row hms-divpadding">
                        <div class="col-md-12 col-sm-12">
                            <p>
                            	<div class="col-md-12 col-sm-12" style="margin-top:15px;margin-bottom:2px;">
                                  <div class="form-group">
                                    <div class="input-group">
                                        <input type="search" class="form-control" name="searchvaccine" id="searchpatient" placeholder="Search By Patient Name">
                                        <div class="input-group-addon"><i class="glyphicon glyphicon-search"></i></div>
                                    </div>
                                  </div>
                            </div>
                            
                            <div class="col-md-12 col-sm-12 hms-white-bkg" style="margin-top:15px;margin-bottom:2px;">
                                <h4 style="color:#006600;">Donor List</h4>
                            </div>
                            <div class="col-md-12 col-sm-12 hms-white-bkg" style="margin-top:2px;margin-bottom:20px;">
                            <br>
                                   <div class="row">
                                        <div class="box-body">
                                            <div class="table-responsive">
                                                <table class="table table-bordered table-hover">
                                                     <thead>
                                                        <tr>
                                                            <th width="4%">SN</th>
                                                            <th width="6%">Date Registered</th>
                                                            <th width="6%">Time Registered</th>
                                                            <th width="6%">PRN</th>
                                                            <th width="11%">Patient Name</th>
                                                            <th width="9%">Category</th>
                                                            <!--<th width="10%">Visiting Unit</th>-->
                                                            <th width="8%">Gender</th>
                                                            <th width="8%"> Status</th>
                                                            <th width="8%">DOB</th>
                                                            <th width="7%">Age</th>
                                                            <th width="11%">Mobile</th>
                                                            <th width="12%">Registered By</th>
                                                            <th></th>
                                                            <th></th>
                                                            
                                                            
                                                           
                                                        </tr>
                                                    </thead>
                                                    <tbody id="tbody">
                                                    <?php
                                                            $sn=0;
                                                        foreach($ivf_donors as $ivf_donor){
                                                          //  if($ivf_waiting_list['specialty'] == 'Physiotherapist'  && ($ivf_waiting_list['payment_status']=='PAY LATER' || $ivf_waiting_list['payment_status']=='PAID')){
                                                            $sn = $sn + 1;
                                                            echo '<tr>';
                                                            echo '<td>'.$sn.'</td>';
                                                            echo '<td>'.$ivf_donor['date'].'</td>';
															echo '<td>'.$ivf_donor['time'].'</td>';
                                                            echo '<td>';
                                                            
                                                          /*  echo "<form action='open_consult.php' method='post' id='open_consult'>
                                                            
                                                            <input name='id' type='hidden' value='$physio_waiting_list[id]'>
                                                            <input name='vsn' type='hidden' value='$physio_waiting_list[visitno]'>
                                                            <input name='prn' type='hidden' value='$physio_waiting_list[prn]'>
                                                            <input name='prn' type='submit' class='btn btn-success' value='$physio_waiting_list[prn]' style='width:9em !important'>

                                                            </form>";
                                                            */
                                                            
                                                            //echo "<a href=\"consultation?prn=$ivf_waiting_list[prn]&id=$ivf_waiting_list[id]&vsn=$ivf_waiting_list[visitno]\">";
                                                           // echo "<a href=\"parse-prn-consultation?prn=$row[prn]&id=$row[id]&vsn=$row[visitno]\">";
                                                           echo $ivf_donor['prn'];
                                                            //echo "</a>";
                                                            echo '</td>';
                                                            echo '<td><element>'.$ivf_donor['fullname'].'</element></td>';
															echo '<td>'.$ivf_donor['category'].'</td>';
															//echo '<td>'.$ivf_donor['specialty'].'</td>';
															echo '<td>'.$ivf_donor['gender'].'</td>';
															echo '<td>'.$ivf_donor['marital_status'].'</td>';
															echo '<td>'.$ivf_donor['dob'].'</td>';
															echo '<td>'.$ivf_donor['age'].'</td>';
															echo '<td>'.$ivf_donor['phoneno'].'</td>';
                                                            echo '<td>'.$ivf_donor['staffname'].'</td>';
                                                            echo '<td>'.'<button onclick="donor_inv(this)" id='.$ivf_donor['prn'].' class="btn btn-warning" data-toggle="modal" data-target="#donor_details">Order Inv</button>'.'</td>';
                                                                                                                        
                                                            echo '<td>'.'<button class="btn btn-success" onclick=\'register_ivf("'.$ivf_donor['prn'].'","'.$ivf_donor['id'].'")\' id='.$ivf_donor['prn'].'>Create File</button>'.'</td>';
                                                                                                                       
                                                       // }
                                                        }
                                                    ?>
                                                    </tbody>
                                                </table>
                                            </div>
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
   
    <div class="modal fade" id="donor_details">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" id="new_donor">
              
            </div>
        </div>
    </div>

    <div class="modal fade" id="lab_results">
        <div class="modal-dialog">
            <div class="modal-content" id="new_results">
              
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
     
<script src="../../assets/js/select2.js"></script>  


  <script>

$('.searchable').select2();
 
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


</script>
  
</body>
</html>