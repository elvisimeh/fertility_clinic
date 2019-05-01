<?php
	session_start();
	$staffname = $_SESSION['staffname'];
	
	if(!isset($staffname)){
		header("location:../../index");
		unset($_SESSION['dprn'],$_SESSION['dfname'],$_SESSION['ddept'],$_SESSION['dnextduedate']);
		exit;
    }
    /**Error reporting */
//error_reporting(E_ALL);
//ini_set('display_errors', 1);
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
    $status = 'referral';
    $referral_lists = $ivfobj->referral_list($status,$bcode,$ccode);
    //var_dump($referral_lists);
	
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Healthwise | HMS</title>
<!--<meta http-equiv="Refresh" content="20">-->
<link rel="stylesheet" href="../../assets/hms-css/bootstrap.min.css">
<link href="../../assets/css/hms-styles.css" rel="stylesheet" type="text/css">

<script>
 
 function register_ivf(e){
     var prn = e.id;
  var id =   document.getElementById(e.id).getAttribute('data-id');
  //alert(re);
    $('#router').load('register_referred_pat?prn='+prn+'&id='+id);
   }    

function register_donor(e){
    var prn = e.id;
    var id =   document.getElementById(e.id).getAttribute('data-id');
    var vsn =   document.getElementById(e.id).getAttribute('data-vsn');
 //alert(id);
    var conf= confirm("Are You Sure You Want To Register Patient as Donor?" );
   if (conf==true){
    $.post('controller_register_donor',{
        prn : prn,
        id : id,
        vsn : vsn
    },
    function(data){
        if(data== 1){
            alert ('Successful');
            $('#router').load('ivf_donor_list');
        }
        else{
            alert ('Patient Already Has a Donor File');
        }
    }
    
    );
   }
}
  

</script>

</head>

<body>
	<?php include("../_includes/hms-header.php");?>
    <nav class="breadcrumb">
        <div class="container">
            <a class="breadcrumb-item" href="index">Dashboard ></a> Patients Referred By Doctor</div>             
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
                                        <input type="search" class="form-control" name="searchvaccine" id="searchvaccine" placeholder="Search By Patient Name">
                                        <div class="input-group-addon"><i class="glyphicon glyphicon-search"></i></div>
                                    </div>
                                  </div>
                            </div>
                            
                            <div class="col-md-12 col-sm-12 hms-white-bkg" style="margin-top:15px;margin-bottom:2px;">
                                <h4 style="color:#006600;">Patients Referred By Doctor</h4>
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
                                                            <th width="6%">Date</th>
                                                            <th width="6%">Time</th>
                                                            <th width="6%">PRN</th>
                                                            <th width="11%">Patient Name</th>
                                                            <th width="9%">Category</th>
                                                            
                                                            <th width="8%">Gender</th>
                                                            <th width="8%"> Status</th>
                                                            <th width="8%">DOB</th>
                                                            <th width="7%">Age</th>
                                                            <th width="11%">Mobile</th>
                                                            <th width="12%">Referred By</th>
                                                            
                                                            <th></th>
                                                            
                                                            
                                                           
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php
                                                            $sn=0;
                                                        foreach($referral_lists as $referral_list){
                                                          //  if($referral_list['specialty'] == 'Physiotherapist'  && ($referral_list['payment_status']=='PAY LATER' || $referral_list['payment_status']=='PAID')){
                                                            $d1 = date_create(date('Y-m-d')); $d2 = date_create($referral_list['dob']); $age = date_diff($d1,$d2);
                                                            $sn = $sn + 1;
                                                            echo '<tr>';
                                                            echo '<td>'.$sn.'</td>';
                                                            echo '<td>'.$referral_list['date'].'</td>';
															echo '<td>'.$referral_list['time'].'</td>';
                                                            echo '<td>';
                                                            
                                                          /*  echo "<form action='open_consult.php' method='post' id='open_consult'>
                                                            
                                                            <input name='id' type='hidden' value='$physio_waiting_list[id]'>
                                                            <input name='vsn' type='hidden' value='$physio_waiting_list[visitno]'>
                                                            <input name='prn' type='hidden' value='$physio_waiting_list[prn]'>
                                                            <input name='prn' type='submit' class='btn btn-success' value='$physio_waiting_list[prn]' style='width:9em !important'>

                                                            </form>";
                                                            */
                                                            
                                                            //echo "<a href=\"consultation?prn=$referral_list[prn]&id=$referral_list[id]&vsn=$referral_list[visitno]\">";
                                                            echo "$referral_list[prn]";
                                                            // echo "<a href=\"parse-prn-consultation?prn=$row[prn]&id=$row[id]&vsn=$row[visitno]\">";
                                                            //echo "<button class=\"btn btn-success\">" . $referral_list['prn'] . "</button>";
                                                            echo "</a>";
                                                            echo '</td>';
                                                            echo '<td>'.$referral_list['fullname'].'</td>';
															echo '<td>'.$referral_list['category'].'</td>';
                                                            
															echo '<td>'.$referral_list['gender'].'</td>';
															echo '<td>'.$referral_list['marital_status'].'</td>';
															echo '<td>'.$referral_list['dob'].'</td>';
                                                            echo '<td>'.$age->y.'yr(s)'.$age->m.'mnth'.$age->d.'days'.'</td>';
                                                            echo '<td>'.$referral_list['phoneno'].'</td>';
                                                            echo '<td>'.$referral_list['staffname'].'</td>';
                                                            
                                                            echo '<td>';
                                                            echo '<button type="button" class="btn btn-primary" onclick="register_ivf(this)" id='.$referral_list['prn'].' data-id='.$referral_list['id'].'>Accept as Patient</button>';
                                                            echo '</td>';
                                                           //$doctor = $referral_list['posted_by']; echo '<td>'.$ivf_waiting_obj->doctor_name($doctor)['staffname'].'</td>';
                                                           
                                                            echo '</tr>';
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
   
    <div class="modal fade" id="setupcorporate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
              
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
     
      
  
</body>

 
  
    



  

</html>