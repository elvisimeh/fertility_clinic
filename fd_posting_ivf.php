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
    $pay_status = 'FER';
    $ivf_waiting_lists = $ivfobj->ivf_waiting($pay_status,$bcode,$ccode);
    //var_dump($ivf_waiting_list);
	
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
    $('#router').load('register_patient?prn='+prn+'&id='+id);
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
            <a class="breadcrumb-item" href="index">Dashboard ></a> Patients Posted From Frontdesk</div>             
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
                                <h4 style="color:#006600;">Patients Waiting List</h4>
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
                                                            <th width="10%">Visiting Unit</th>
                                                            <th width="8%">Gender</th>
                                                            <th width="8%"> Status</th>
                                                            <th width="8%">DOB</th>
                                                            <th width="7%">Age</th>
                                                            <th width="11%">Mobile</th>
                                                            <th width="12%">Posted By</th>
                                                            <th></th>
                                                            <th></th>
                                                            
                                                            
                                                           
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php
                                                            $sn=0;
                                                        foreach($ivf_waiting_lists as $ivf_waiting_list){
                                                            $d1 = date_create(date('Y-m-d')); $d2 = date_create($ivf_waiting_list['dob']); $age = date_diff($d1,$d2);
                                                          //  if($ivf_waiting_list['specialty'] == 'Physiotherapist'  && ($ivf_waiting_list['payment_status']=='PAY LATER' || $ivf_waiting_list['payment_status']=='PAID')){
                                                            $sn = $sn + 1;
                                                            echo '<tr>';
                                                            echo '<td>'.$sn.'</td>';
                                                            echo '<td>'.$ivf_waiting_list['vdate'].'</td>';
															echo '<td>'.$ivf_waiting_list['vtime'].'</td>';
                                                            echo '<td>';
                                                            
                                                          /*  echo "<form action='open_consult.php' method='post' id='open_consult'>
                                                            
                                                            <input name='id' type='hidden' value='$physio_waiting_list[id]'>
                                                            <input name='vsn' type='hidden' value='$physio_waiting_list[visitno]'>
                                                            <input name='prn' type='hidden' value='$physio_waiting_list[prn]'>
                                                            <input name='prn' type='submit' class='btn btn-success' value='$physio_waiting_list[prn]' style='width:9em !important'>

                                                            </form>";
                                                            */
                                                            
                                                            //echo "<a href=\"consultation?prn=$ivf_waiting_list[prn]&id=$ivf_waiting_list[id]&vsn=$ivf_waiting_list[visitno]\">";
                                                            echo "$ivf_waiting_list[prn]";
                                                            // echo "<a href=\"parse-prn-consultation?prn=$row[prn]&id=$row[id]&vsn=$row[visitno]\">";
                                                            //echo "<button class=\"btn btn-success\">" . $ivf_waiting_list['prn'] . "</button>";
                                                            echo "</a>";
                                                            echo '</td>';
                                                            echo '<td>'.$ivf_waiting_list['fullname'].'</td>';
															echo '<td>'.$ivf_waiting_list['category'].'</td>';
                                                            if($ivf_waiting_list['specialty']==30 || $ivf_waiting_list['specialty']==31){$x='FERTILITY CENTER';}else{$x=$ivf_waiting_list['specialty'];} 
                                                            echo '<td>'.$x.'</td>';
															echo '<td>'.$ivf_waiting_list['gender'].'</td>';
															echo '<td>'.$ivf_waiting_list['marital_status'].'</td>';
															echo '<td>'.$ivf_waiting_list['dob'].'</td>';
                                                            echo '<td>'.$age->y.'yr(s)'.$age->m.'mnth'.$age->d.'days'.'</td>';
                                                            echo '<td>'.$ivf_waiting_list['phoneno'].'</td>';
                                                            echo '<td>'.$ivf_waiting_list['staffname'].'</td>';
                                                            echo '<td>'.'<button class="btn btn-warning" onclick="register_donor(this)" id='.$ivf_waiting_list['prn'].' data-id='.$ivf_waiting_list['id'].' data-vsn='.$ivf_waiting_list['visitno'].'>Register As Donor</button>'.'</td>';
                                                            echo '<td>';
                                                            echo '<button type="button" class="btn btn-primary" onclick="register_ivf(this)" id='.$ivf_waiting_list['prn'].' data-id='.$ivf_waiting_list['id'].'>Accept as Patient</button>';
                                                            echo '</td>';
                                                           //$doctor = $ivf_waiting_list['posted_by']; echo '<td>'.$ivf_waiting_obj->doctor_name($doctor)['staffname'].'</td>';
                                                           
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