<?php
session_start();
$staffname = $_SESSION['staffname'];
if(!isset($staffname)){
	header("location:../../index");
	exit;
}
include("../../controllers/admin/Company.php");
include("../../controllers/admin/Route.php");
include("../../controllers/fd/patient.php");

$companyObj = new COMPANY;
$routeObj = new ROUTE;
$patientObj = new PATIENT;

$today = date("Y-m-d");
$paytime = date("H:i:sa");
$err = '';

$areaArray = $companyObj->loadArea($state);
$stateArray = $companyObj->loadState();
$aboutArray = $companyObj->loadAboutUs();
$patientCategoryArray = $companyObj->loadPatientCategory();
$specialtyArray = $companyObj->loadSpecialty();
$occupationArray = $companyObj->loadOccupation();
$regTypeArray = $companyObj->loadConsultationType();

$ccode = $_SESSION['companycode'];
$bcode = $_SESSION['branchcode'];
$user_department = $_SESSION['dept'];

$visit_number = $patientObj->getPatientVisitNoByVisitDate($today);
$patient_count = $patientObj->getPatientCount();
$branch_prefix = $companyObj->getBranchPrefix($bcode);
$prn =  'PRN-'.$branch_prefix.$patient_count;
if(isset($_POST['submit'])){
    $ptitle = $_POST['ptitle'];$enrollee = $_POST['enrollee'];$surname = strtoupper($_POST['surname']);$firstname = strtoupper($_POST['firstname']);$othername = strtoupper($_POST['othername']);$dob = $_POST['dob'];$mstatus = $_POST['mstatus'];$gender = $_POST['gender'];$occupation = $_POST['occupation'];$religion = $_POST['religion'];    $email = $_POST['email'];$phone = $_POST['phone'];$address = ucwords(strtolower($_POST['address']));$state = $_POST['state'];$area = $_POST['area'];$nkname = strtoupper($_POST['nkname']);$nkphone = $_POST['nkphone'];$specialty = $_POST['specialty'];$consultingdoc = $_POST['consultingdoc'];$howaboutus = $_POST['howaboutus'];$rtype = $_POST['rtype'];$pcat = $_POST['pcatselector'];$dept = $companyObj->getDepartmentBycode($specialty);$patient_status = '';$visit_type = 'FIRST VISIT';$posted_by = $staffname;$date_posted = $today;$age = $patientObj->getPatientAgeByDOB($dob);//$patientCategoryName = $patientObj->getPatientCategoryName($pcat,$bcode,$ccode);

	$patient_existence = $patientObj->verifyPatientNameExistens($firstname,$othername,$surname,$phone,$dob,$bcode,$ccode); 
	if ($patient_existence=='YES') {
		$err = '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="glyphicon glyphicon-ban"></i> Alert!</h4>Patient name already exist.</div>';
	}else{
		if($pcat=='PRIVATE'){
			$sponsorname = $patientObj->getPatientFullname($firstname,$surname,$othername);$employname = '-';$patientrelationship = '-';$patientcoyname = '-';$ptype = '-';
			if($rtype == 'Regular Registration' || $rtype == 'Emergency Registration'){
				 $patient_status = 'NORMAL';
			}elseif($rtype == 'Ante Natal Registration'){
				 $patient_status = 'ANTE NATAL';
			}
			$patient_category_code = $patientObj->getPatientCategoryCode($pcat,$bcode,$ccode); 	
			$patient_file_creation_status = $patientObj->savePatientRecord($prn,$ptitle,$firstname,$surname,$othername,$address,$state,$area,$gender,$mstatus,$dob,$age,$phone,$nkname,$nkphone,$email,$fullname,$religion,$patient_category_code,$pass_path,$sponsorname,$ptype,$enrollee,$patientcoyname,$patient_status,$posted_by,$bcode,$ccode,$howaboutus,$occupation,'-','-');
			if($patient_file_creation_status==1){
				$patientReceivables = 'PATIENT RECEIVABLES';
				$patient_fullname = $firstname.' '.$surname. ' '.$othername;
				$thirdLevelArray = $companyObj->loadAccountThirdLevel($patientReceivables);
				$thirdLevelRec = pg_fetch_assoc($thirdLevelArray);
				$fclassno = $thirdLevelRec[fclassno];
				$sclassno =  $thirdLevelRec[sclassno];
				$tclassname = $thirdLevelRec[tclassname];
				$tclassno = $thirdLevelRec[tclassno];
				
				$ledgerNumber = $companyObj->generateLedgerNo($tclassno);
				
				$insertRec = $companyObj->createLedger($fclassno,$sclassno,$tclassno,$patient_fullname,$ledgerNumber,$prn,$bcode,$ccode);
				$payment_status = 'NOT PAID';
				$opd_status = 'N';
				$daily_visit = $patientObj->saveDailyVisit($visit_number,$prn,$posted_by,$rtype,$visit_type,$specialty,$consultingdoc,$payment_status,$opd_status,$bcode,$ccode,$patient_category_code);
				$private_specialization_details = $patientObj->getPrivateSpecialtyDetails($specialty,$bcode,$ccode);
				$row = $private_specialization_details->fetch(PDO::FETCH_ASSOC);
				$firstvisit_amt = $row['firstvisit_amt'];
				$consultation_period = $row['con_period'];
				$items1 = 'Patient registration fees';
				$next_due_date = date('Y-m-d', strtotime($today ." +$consultation_period day"));
				//$saveConsultationPayment = $patientObj->saveConsultationPayment($today,$paytime,$prn,$specialty,$firstvisit_amt,$consultation_period,$next_due_date,$bcode,$ccode);
				
				$registration_amount = $patientObj->getPrivateRegistrationAmount($patient_category_code,$rtype,$bcode,$ccode);
				$reg_amt_row = $registration_amount->fetch(PDO::FETCH_ASSOC);
		
				$reg_fees = $reg_amt_row['amount'];
				$agreed_amt = $reg_amt_row['amount'];
				$qty = 1;
				$trans_status = '';
				$specialtyname = $companyObj->loadSpecialtyNameCode($specialty);
				$items2 = $specialtyname.' consultation charge.';
		
				$patient_visit = $patientObj->savePatientVisit($visit_number,$prn,$rtype,$visit_type,$specialty,$consultingdoc,$consulting_doctor,$consultation_status,$post_time_fd,$con_start_time,$con_end_time,$posted_by,$bcode,$ccode,$patient_category_code);
		
				$trans_status = 'N';
				$postRegistrationChargeToCash = $patientObj->postPatientRegistrationToCash($prn,$patient_category_code,$items1,$reg_fees,$agreed_amt,$qty,$dept,$payment_status,$trans_status,$posted_by,$bcode,$ccode);
		
				$postConsultationChargeToCash = $patientObj->postPatientRegistrationToCash($prn,$patient_category_code,$items2,$firstvisit_amt,$firstvisit_amt,$qty,$dept,$payment_status,$trans_status,$posted_by,$bcode,$ccode);
				$_SESSION['dprn'] = $prn;
				$_SESSION['dfname'] = $firstname.' '.$surname.' '.$othername;
				$_SESSION['ddept'] = $dept;
				$_SESSION['dnextduedate'] = $next_due_date;
				
				header($routeObj->getPatientRegistrationView());
			}
		}//close of private registration
		
		
		if($pcat=='CORPORATE'){
			$patient_category_code = $patientObj->getPatientCategoryCode($pcat,$bcode,$ccode); 		
			$sponsorname = $_POST['sponsorname'];$employname = $_POST['employname'];$patientrelationship = $_POST['patientrelationship'];$patientcoyname = $_POST['sponsorname'];$ptype = '-';
			if($rtype == 'Regular Registration'){
				 $patient_status = 'NORMAL';
			}elseif($rtype == 'Ante Natal Registration'){
				 $patient_status = 'ANTE NATAL';
			}
			$patient_file_creation_status = $patientObj->savePatientRecord($prn,$ptitle,$firstname,$surname,$othername,$address,$state,$area,$gender,$mstatus,$dob,$age,$phone,$nkname,$nkphone,$email,$fullname,$religion,$patient_category_code,$pass_path,$sponsorname,$ptype,$enrollee,$patientcoyname,$patient_status,$posted_by,$bcode,$ccode,$howaboutus,$occupation,'-','-');
			if($patient_file_creation_status==1){
				$patientReceivables = 'PATIENT RECEIVABLES';
				$patient_fullname = $firstname.' '.$surname. ' '.$othername;
				$thirdLevelArray = $companyObj->loadAccountThirdLevel($patientReceivables);
				$thirdLevelRec = pg_fetch_assoc($thirdLevelArray);
				$fclassno = $thirdLevelRec[fclassno];
				$sclassno =  $thirdLevelRec[sclassno];
				$tclassname = $thirdLevelRec[tclassname];
				$tclassno = $thirdLevelRec[tclassno];
				
				$ledgerNumber = $companyObj->generateLedgerNo($tclassno);
				
				$insertRec = $companyObj->createLedger($fclassno,$sclassno,$tclassno,$patient_fullname,$ledgerNumber,$prn,$bcode,$ccode);
				$payment_status = 'PAY LATER';
				$opd_status = 'N';
				 	
				$daily_visit = $patientObj->saveDailyVisit($visit_number,$prn,$posted_by,$rtype,$visit_type,$specialty,$consultingdoc,$payment_status,$opd_status,$bcode,$ccode,$patient_category_code);
				$corporate_specialization_details = $patientObj->getCorporateHMOSpecialtyDetails($sponsorname,$specialty,$bcode,$ccode);
				$row = $corporate_specialization_details->fetch(PDO::FETCH_ASSOC);
				$firstvisit_amt = $row['firstvisit_amt'];
				$consultation_period = $row['con_period'];
				$items1 = 'Patient registration fees';
				$next_due_date = date('Y-m-d', strtotime($today ." +$consultation_period day"));
				//$saveConsultationPayment = $patientObj->saveConsultationPayment($today,$paytime,$prn,$specialty,$firstvisit_amt,$consultation_period,$next_due_date,$bcode,$ccode);
				
				$registration_amount = $patientObj->getCorporateInsuranceRegistrationAmount($patient_category_code,$rtype,$sponsorname,$bcode,$ccode);
				$reg_amt_row = $registration_amount->fetch(PDO::FETCH_ASSOC);
		
				$reg_fees = $reg_amt_row['amount'];
				$agreed_amt = $reg_amt_row['amount'];
				$qty = 1;
				$trans_status = 'N';
				$specialtyname = $companyObj->loadSpecialtyNameCode($specialty);
				$items2 = $specialtyname.' consultation charge.';
		
				$patient_visit = $patientObj->savePatientVisit($visit_number,$prn,$rtype,$visit_type,$specialty,$consultingdoc,$consulting_doctor,$consultation_status,$post_time_fd,$con_start_time,$con_end_time,$posted_by,$bcode,$ccode,$patient_category_code);
		
				$trans_status = 'N';
				$patient_category_code = $patientObj->getPatientCategoryCode($pcat,$bcode,$ccode);
				$postRegistrationChargeToPaylater = $patientObj->postPatientRegistrationToPayLater($prn,$items1,$reg_fees,$qty,$dept,$trans_status,$posted_by,$bcode,$ccode,$patient_category_code);
	
			$postConsultationChargeToPaylater = $patientObj->postPatientRegistrationToPayLater($prn,$items2,$firstvisit_amt,$qty,$dept,$trans_status,$posted_by,$bcode,$ccode,$patient_category_code);
				$_SESSION['dprn'] = $prn;
				$_SESSION['dfname'] = $firstname.' '.$surname.' '.$othername;
				$_SESSION['ddept'] = $dept;
				$_SESSION['dnextduedate'] = $next_due_date;
				
				header($routeObj->getPatientRegistrationView());
			}
		}//close of corporate registration
		
		
		if($pcat=='INSURANCE'){
			$patient_category_code = $patientObj->getPatientCategoryCode($pcat,$bcode,$ccode); 		
			$sponsorname = $_POST['sponsorname'];$employname = '-';$patientrelationship = '-';$patientcoyname = $_POST['patientcoyname'];$ptype = $_POST['ptype'];
			if($rtype == 'Regular Registration'){
				 $patient_status = 'NORMAL';
			}elseif($rtype == 'Ante Natal Registration'){
				 $patient_status = 'ANTE NATAL';
			}
			$patient_file_creation_status = $patientObj->savePatientRecord($prn,$ptitle,$firstname,$surname,$othername,$address,$state,$area,$gender,$mstatus,$dob,$age,$phone,$nkname,$nkphone,$email,$fullname,$religion,$patient_category_code,$pass_path,$sponsorname,$ptype,$enrollee,$patientcoyname,$patient_status,$posted_by,$bcode,$ccode,$howaboutus,$occupation,'-','-');
			if($patient_file_creation_status==1){
				$patientReceivables = 'PATIENT RECEIVABLES';
				$patient_fullname = $firstname.' '.$surname. ' '.$othername;
				$thirdLevelArray = $companyObj->loadAccountThirdLevel($patientReceivables);
				$thirdLevelRec = pg_fetch_assoc($thirdLevelArray);
				$fclassno = $thirdLevelRec[fclassno];
				$sclassno =  $thirdLevelRec[sclassno];
				$tclassname = $thirdLevelRec[tclassname];
				$tclassno = $thirdLevelRec[tclassno];
				
				$ledgerNumber = $companyObj->generateLedgerNo($tclassno);
				
				$insertRec = $companyObj->createLedger($fclassno,$sclassno,$tclassno,$patient_fullname,$ledgerNumber,$prn,$bcode,$ccode);
				$payment_status = 'PAY LATER';
				$opd_status = 'N';
				 	
				$daily_visit = $patientObj->saveDailyVisit($visit_number,$prn,$posted_by,$rtype,$visit_type,$specialty,$consultingdoc,$payment_status,$opd_status,$bcode,$ccode,$patient_category_code);
				$corporate_specialization_details = $patientObj->getCorporateHMOSpecialtyDetails($sponsorname,$specialty,$bcode,$ccode);
				$row = $corporate_specialization_details->fetch(PDO::FETCH_ASSOC);
				$firstvisit_amt = $row['firstvisit_amt'];
				$consultation_period = $row['con_period'];
				$items1 = 'Patient registration fees';
				$next_due_date = date('Y-m-d', strtotime($today ." +$consultation_period day"));
				//$saveConsultationPayment = $patientObj->saveConsultationPayment($today,$paytime,$prn,$specialty,$firstvisit_amt,$consultation_period,$next_due_date,$bcode,$ccode);
				
				$registration_amount = $patientObj->getCorporateInsuranceRegistrationAmount($patient_category_code,$rtype,$sponsorname,$bcode,$ccode);
				$reg_amt_row = $registration_amount->fetch(PDO::FETCH_ASSOC);
		
				$reg_fees = $reg_amt_row['amount'];
				$agreed_amt = $reg_amt_row['amount'];
				$qty = 1;
				$trans_status = 'N';
				$specialtyname = $companyObj->loadSpecialtyNameCode($specialty);
				$items2 = $specialtyname.' consultation charge.';
		
				$patient_visit = $patientObj->savePatientVisit($visit_number,$prn,$rtype,$visit_type,$specialty,$consultingdoc,$consulting_doctor,$consultation_status,$post_time_fd,$con_start_time,$con_end_time,$posted_by,$bcode,$ccode,$patient_category_code);
		
				$trans_status = 'N';
				
				$postRegistrationChargeToPaylater = $patientObj->postPatientRegistrationToPayLater($prn,$items1,$reg_fees,$qty,$dept,$trans_status,$posted_by,$bcode,$ccode,$patient_category_code);
	
			$postConsultationChargeToPaylater = $patientObj->postPatientRegistrationToPayLater($prn,$items2,$firstvisit_amt,$qty,$dept,$trans_status,$posted_by,$bcode,$ccode,$patient_category_code);
				$_SESSION['dprn'] = $prn;
				$_SESSION['dfname'] = $firstname.' '.$surname.' '.$othername;
				$_SESSION['ddept'] = $dept;
				$_SESSION['dnextduedate'] = $next_due_date;
				
				header($routeObj->getPatientRegistrationView());
			}
		}
	}
		
		
		if($pcat=='FAMILY'){
			$sponsorname = $_POST['sponsorname'];$employname = '-';$patientrelationship = '-';$patientcoyname = '-';$ptype = '-';
			if($rtype == 'Regular Registration'){
				 $patient_status = 'NORMAL';
			}elseif($rtype == 'Ante Natal Registration'){
				 $patient_status = 'ANTE NATAL';
			}
			$patient_category_code = $patientObj->getPatientCategoryCode($pcat,$bcode,$ccode); 	
			echo $patient_file_creation_status = $patientObj->savePatientRecord($prn,$ptitle,$firstname,$surname,$othername,$address,$state,$area,$gender,$mstatus,$dob,$age,$phone,$nkname,$nkphone,$email,$fullname,$religion,$patient_category_code,$pass_path,$sponsorname,$ptype,$enrollee,$patientcoyname,$patient_status,$posted_by,$bcode,$ccode,$howaboutus,$occupation,'-','-');
			if($patient_file_creation_status==1){
				$patientReceivables = 'PATIENT RECEIVABLES';
				$patient_fullname = $firstname.' '.$surname. ' '.$othername;
				$thirdLevelArray = $companyObj->loadAccountThirdLevel($patientReceivables);
				$thirdLevelRec = pg_fetch_assoc($thirdLevelArray);
				$fclassno = $thirdLevelRec[fclassno];
				$sclassno =  $thirdLevelRec[sclassno];
				$tclassname = $thirdLevelRec[tclassname];
				$tclassno = $thirdLevelRec[tclassno];
				
				$ledgerNumber = $companyObj->generateLedgerNo($tclassno);
				
				$insertRec = $companyObj->createLedger($fclassno,$sclassno,$tclassno,$patient_fullname,$ledgerNumber,$prn,$bcode,$ccode);
				$payment_status = 'NOT PAID';
				$opd_status = 'N';
				$daily_visit = $patientObj->saveDailyVisit($visit_number,$prn,$posted_by,$rtype,$visit_type,$specialty,$consultingdoc,$payment_status,$opd_status,$bcode,$ccode,$patient_category_code);
				$private_specialization_details = $patientObj->getPrivateSpecialtyDetails($specialty,$bcode,$ccode);
				$row = $private_specialization_details->fetch(PDO::FETCH_ASSOC);
				$firstvisit_amt = $row['firstvisit_amt'];
				$consultation_period = $row['con_period'];
				$items1 = 'Patient registration fees';
				$next_due_date = date('Y-m-d', strtotime($today ." +$consultation_period day"));
				//$saveConsultationPayment = $patientObj->saveConsultationPayment($today,$paytime,$prn,$specialty,$firstvisit_amt,$consultation_period,$next_due_date,$bcode,$ccode);
				
				//$registration_amount = $patientObj->getPrivateRegistrationAmount($pcat,$rtype,$bcode,$ccode);
				//$reg_amt_row = $registration_amount->fetch(PDO::FETCH_ASSOC);
		
				//$reg_fees = $reg_amt_row['amount'];
				//$agreed_amt = $reg_amt_row['amount'];
				$qty = 1;
				$trans_status = '';
				$specialtyname = $companyObj->loadSpecialtyNameCode($specialty);
				$items2 = $specialtyname.' consultation charge.';
		
				$patient_visit = $patientObj->savePatientVisit($visit_number,$prn,$rtype,$visit_type,$specialty,$consultingdoc,$consulting_doctor,$consultation_status,$post_time_fd,$con_start_time,$con_end_time,$posted_by,$bcode,$ccode,$patient_category_code);
		
				$trans_status = 'N';
				//$postRegistrationChargeToCash = $patientObj->postPatientRegistrationToCash($prn,$pcat,$items1,$reg_fees,$agreed_amt,$qty,$dept,$payment_status,$trans_status,$posted_by,$bcode,$ccode);
		
				$postConsultationChargeToCash = $patientObj->postPatientRegistrationToCash($prn,$patient_category_code,$items2,$firstvisit_amt,$firstvisit_amt,$qty,$dept,$payment_status,$trans_status,$posted_by,$bcode,$ccode);
				$_SESSION['dprn'] = $prn;
				$_SESSION['dfname'] = $firstname.' '.$surname.' '.$othername;
				$_SESSION['ddept'] = $dept;
				$_SESSION['dnextduedate'] = $next_due_date;
				
				header($routeObj->getPatientRegistrationView());
			}
		}
		
		
}//close of first if statement
	
	

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Healthwise | HMS</title>

<link rel="stylesheet" href="../../assets/hms-css/bootstrap.min.css">
<link href="../../assets/css/hms-styles.css" rel="stylesheet" type="text/css">

<script src="../../assets/hms-js/jquery-1.10.2.js"></script>
<script src="../../assets/hms-js/jquery-ui.js"></script>
<link href="../../assets/hms-js/jquery-ui.css" rel="stylesheet" type="text/css">

  <script src="../../assets/hms-js/bootstrap.min.js"></script>
  <script src="../../assets/hms-js/jquery.backstretch.min.js"></script>
  <script src="../../assets/hms-js/custom-js.js"></script>
  <script>
	$(function() {
		var availableTags = <?php include('autocomplete.php'); ?>;
		$("#searchpatient").autocomplete({
			source: availableTags,
			autoFocus:true
		});	
	});
</script>
</head>

<body>
    <?php include("../_includes/hms-header2.php");?>
    <div class="row">
    	<nav class="breadcrumb">
        	<div class="container">
          		<a class="breadcrumb-item" href="index">Dashboard ></a>Patient Registration<span class="breadcrumb-item active"></span>
          	</div>             
        </nav>
        <div class="col-lg-10 col-lg-offset-1 hms-white-bkg">
            	<?php echo $err; ?>
                <fieldset style="min-height:100px;">
                	<legend>Search Patient Information By Name </legend>
                    
                    

	<div class="row">
		

        <div class="nav nav-justified navbar-nav">
 			<div class="col-md-8 col-xs-offset-2">
            <form role="search">
                <div class="input-group">
        
                    <input type="text" class="form-control" name="searchpatient" id="searchpatient" placeholder="Search By Patient Name">
                	
                  <div class="input-group-btn">
                        <button type="button" class="btn btn-search btn-default">
                        GO
                        </button>
                         
                         
                    </div>
                </div>  
            </form>   
         </div>
        </div>
	</div>                
		  </fieldset>
		</div>
	</div>
    
    
    <div class="divider">&nbsp;</div>
    
    
   <div class="row">
   		 <div class="col-lg-10 col-lg-offset-1 hms-white-bkg">
            	<?php echo $err; ?>
                <fieldset style="min-height:100px;">
                	<legend>Search Patient Information By Mobile Number </legend>

	<div class="row">
		
        <div class="nav nav-justified navbar-nav">
 			<div class="col-md-8 col-xs-offset-2">
            <form role="search">
                <div class="input-group">
        
                    <input type="text" class="form-control" name="searchpatientbymobile" id="searchpatientbymobile" placeholder="Search By Patient Mobile">
                	
                  <div class="input-group-btn">
                        <button type="button" class="btn btn-search btn-default">
                        GO
                        </button>
                         
                         
                    </div>
                </div>  
            </form>   
         </div>
        </div>
	</div>                
		  </fieldset>
		</div>
	</div>
   </div>
    
    
    
   <div class="divider">&nbsp;</div>
    
    
   <div class="row">
   		 <div class="col-lg-10 col-lg-offset-1 hms-white-bkg">
            	<?php echo $err; ?>
                <fieldset style="min-height:100px;">
                	<legend>Search Patient Information By Visit Date</legend>

	<div class="row">
		
        <div class="nav nav-justified navbar-nav">
 			<div class="col-md-8 col-xs-offset-2">
            <form role="search">
                <div class="input-group">
        
                    <input type="text" class="form-control" name="searchpatientbymobile" id="searchpatientbymobile" placeholder="Search By Patient Mobile">
                	
                  <div class="input-group-btn">
                        <button type="button" class="btn btn-search btn-default">
                        GO
                        </button>
                         
                         
                    </div>
                </div>  
            </form>   
         </div>
        </div>
	</div>                
		  </fieldset>
		</div>
	</div>
   </div>
   
   <div class="divider">&nbsp;</div>
    
    
	<div class="row">
        <div class="col-lg-10 col-lg-offset-1 hms-white-bkg">
            <?php echo $err; ?>
            <fieldset style="min-height:100px;">
                <legend>Patient Information</legend>
        
                <div class="row" id="patientinfo">
                    <div class="col-md-12">
                     <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <th>SN</th>
                                <th>PRN</th>
                                <th>NAME</th>
                                <th>CATEGORY</th>
                                <th>GENDER</th>
                                <th>DATE OF BIRTH</th>
                                <th>AGE</th>
                                <th>MOBILE</th>
                            </thead>
                            <tbody>
                                
                            </tbody>
                        </table>
                     </div>
                    </div>
                </div>
                                
            </fieldset>
        </div>
	</div>
    
    
    
 </div>
  
    
  
    <footer style="bottom:0; position:absolute">
        <?php include("../_includes/hms-footer.php");?>
    </footer>
    

</body>
</html>