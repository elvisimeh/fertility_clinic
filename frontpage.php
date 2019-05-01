<?php
	/*session_start();
	$staffname = $_SESSION['staffname'];
	
	if(!isset($staffname)){
		header("location:../../index");
		unset($_SESSION['dprn'],$_SESSION['dfname'],$_SESSION['ddept'],$_SESSION['dnextduedate']);
		exit;
    }
    */
//error_reporting(E_ALL);
//ini_set('display_errors', 1);


	$staffname = $_SESSION['staffname'];
	$bcode = $_SESSION['branchcode'];
	$ccode = $_SESSION['companycode'];
	
		
    require_once("controller_lib.php");
	
    $ivfobj = new IVF;
    
	//$patientObj = new PATIENT;
    
    
    $corporate = 'CORPORATE';
    $insurance  = 'INSURANCE';
    $family     = 'FAMILY';
    $private    = 'PRIVATE';
    //$physio_spec = 21;
    $date = date('Y-m-d');

	
	//var_dump($private_today);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Healthwise | HMS</title>
<!--<meta http-equiv="Refresh" content="">-->
<link rel="stylesheet" href="../../assets/hms-css/bootstrap.min.css">
<link href="../../assets/css/hms-styles.css" rel="stylesheet" type="text/css">

</head>

<body>
	<?php //include("../_includes/hms-header.php");?>
	<div class="row">
        <div class="col-md-2 col-sm-2 hms-white-bkg" style="padding-left:10px; margin-left:30px; margin-top:10px;">
			<?php include("../_includes/fert-side-bar.php");?>
        </div>
        
        <div class="col-md-9 col-sm-9 hms-white-bkg" style="margin-left:30px; margin-top:15px;margin-bottom:2px;">
        	  <h4 style="color:#006600;">FERTILITY CENTRE(<?php echo $ivfobj->branch($_SESSION['branchcode'])['branchname']; ?>)</h4>
        </div>
        <div class="col-md-9 col-sm-9 hms-white-bkg" style="margin-left:30px; margin-top:2px;margin-bottom:20px;">
        <br>
               <div class="row">
               		<div class="col-md-6  col-sm-6 col-xs-6">
                        <div class="small-box bg-aqua">
                            <div class="inner">
                                <h3 id="result2">&nbsp;<?php echo $ivfobj->existing_ivf_count()['count']; ?></h3>
                                <p><font size="2">Existing Patients</font></p>
                            </div>
                            <div class="icon">
                                <i class="glyphicon glyphicon-user"></i>
                            </div>
                            <a onclick="existing_fert()" class="small-box-footer">
							View List <i class="glyphicon glyphicon-circle-arrow-right"></i></a>
                        </div>
                    </div>
                    <?php// $vxm=$_SESSION['staffname'];  setcookie($vxm) ?>
                    <!--<a href="http://192.168.0.210:7600/study/cbt/index.php/select/survey?vxm=<?php// echo $_SESSION['id'] ?>">Survey</a>-->
                    
               		<div class="col-md-6 col-sm-6 col-xs-6">
                        <div class="small-box bg-green">
                            <div class="inner">
                                <h3 id="result6"><?php// echo count($discharged);?></h3>
                                <p>Referrals</p>
                            </div>
                            <div class="icon">
                                <i class="glyphicon glyphicon-shopping-cart"></i>
                            </div>
                            <a onclick="referral_list()" class="small-box-footer">View List <i class="glyphicon glyphicon-circle-arrow-right"></i></a>
                        </div>
                    </div></div></div>
                    
                    
                    
               		
                    
                    
               		
       
        <div class="col-md-9 col-sm-9 hms-white-bkg" style="margin-left:30px; margin-top:15px;margin-bottom:2px;">
        	   <h4 style="color:#006600;">&nbsp;</h4>
        </div>
        <div class="col-md-9 col-sm-9 hms-white-bkg" style="margin-left:30px; margin-top:2px;margin-bottom:20px;">
        	<br>
               <div class="row">
                	<div class="col-md-6 col-xs-6">
                        <div class="small-box bg-aqua">
                            <div class="inner">
                                <h3 id="result4"><?php echo  $ivfobj->ivf_waiting_count($pay_status,$bcode,$ccode)['count']; ?></h3>
                                <p>Frontdesk Posting</p>
                            </div>
                            <div class="icon">
                                <i class="glyphicon glyphicon-folder-open"></i>
                            </div>
                            <a onclick='frontdesk_posting()' class="small-box-footer">View List <i class="glyphicon glyphicon-circle-arrow-right"></i></a>
                        </div>
                        
                    </div>
                    
                    
                    
               		<div class="col-md-6 col-xs-6">
                        <div class="small-box bg-orange">
                            <div class="inner">
                                <h3 id="result8"><?php// echo count($corporate_today); ?></h3>
                                <p>Donor List</p>
                            </div>
                            <div class="icon">
                                <i class="glyphicon glyphicon-shopping-cart"></i>
                            </div>
                            <a onclick="donor_list()" class="small-box-footer">
							View List <i class="glyphicon glyphicon-circle-arrow-right"></i></a>
                        </div>
                    </div>
                                      
                                 		                   
                    
                    
               				

               </div>
        </div>
        
        
        
       
        
        
        
       
        <!--<div class="col-md-9 hms-white-bkg" style="margin-left:30px; margin-top:15px;margin-bottom:2px;">
        	   <h4 style="color:#006600;">My Partial Consultation List</h4>
        	</div>
         	<div class="col-md-9 hms-white-bkg" style="margin-left:30px; margin-top:2px;margin-bottom:20px;">
        		<br>
               <div class="box-body">
               <div class="row">
            	<div class="table-responsive" id="partiallist">
                    <table class="table table-bordered table-hover">
						<thead>
							<tr>
								<th width="5%">SN</th>
                                <th width="11%">Visit Date</th>
                                <th width="13%">Department</th>
                                <th width="12%">PRN</th>
								<th width="15%">Patient Name</th>
								<th width="7%">Gender</th>
								<th width="11%">Marital Status</th>
                                <th width="8%">Category</th>
                                <th width="18%">Sponsor</th>
							</tr>
						</thead>
						<tbody>
                        <?php
							/*while($partial_rec = $doctor_partial_list->fetch(PDO::FETCH_ASSOC)){
								$sn = $sn + 1;
								echo '<tr>';
								echo '<td>'.$sn.'</td>';
								echo '<td>'.$partial_rec[vdate].'</td>';
								echo '<td>'.$companyObj->getDepartmentNameByDeptID($partial_rec[vdept_id]).'</td>';
								echo '<td>';
								echo "<a href=\"parse-prn-partial-consultation?prn=$partial_rec[prn]&id=$partial_rec[id]&vsn=$partial_rec[visitno]\">";
								echo $partial_rec[prn];
								echo "</a>";
								echo '</td>';
								echo '<td>'.$patientObj->getPatientNameByPRN($partial_rec[prn],$partial_rec[bcode],$partial_rec[ccode]).'</td>';
								echo '<td>'.$patientObj->getGenderByPRN($partial_rec[prn],$partial_rec[bcode],$partial_rec[ccode]).'</td>';
								echo '<td>'.$patientObj->getMaritalStatusByPRN($partial_rec[prn],$partial_rec[bcode],$partial_rec[ccode]).'</td>';
								echo '<td>';
								$patcat = $patientObj->getPatientCategoryByVisit($partial_rec[visitno],$partial_rec[prn],$bcode,$ccode);
								echo $patcatname = $patientObj->getPatientCategoryName($patcat,$bcode,$ccode);
								echo '</td>';
								echo '<td>';
								if($patcatname=='PRIVATE'){
									echo $patientObj->getPatientSponsorByVisit($partial_rec[visitno],$partial_rec[prn],$bcode,$ccode);
								}else{
									$patspon = $patientObj->getPatientSponsorByVisit($partial_rec[visitno],$partial_rec[prn],$bcode,$ccode);
									echo $companyObj->getSponsorNameByID($patspon);
								}
								
								echo '</td>';
								echo '</tr>';
							}*/
						?>
						</tbody>
					</table>
                </div>
                </div>
               </div>
       		</div>
  


<div class="col-md-9 hms-white-bkg" style="margin-left:30px; margin-top:15px;margin-bottom:2px;">
   <h4 style="color:#006600;">My Admission Waiting List</h4>
</div>
<div class="col-md-9 hms-white-bkg" style="margin-left:30px; margin-top:2px;margin-bottom:20px;">
<br>
<div class="box-body">
<div class="row">
<div class="table-responsive" id="partiallist">
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th width="4%">SN</th>
                <th width="9%">PRN</th>
                <th width="16%">Patient Name</th>
                <th width="9%">Gender</th>
                <th width="12%">Age</th>
            </tr>
        </thead>
        <tbody>
        <?php
           /* while($adm_rec = $doc_adm_waiting_list->fetch(PDO::FETCH_ASSOC)){
                $sna = $sna + 1;
                echo '<tr>';
                echo '<td>'.$sna.'</td>';
                echo '<td>'.$adm_rec[prn].'</td>';
                echo '<td>'.$patientObj->getPatientNameByPRN($adm_rec[prn],$adm_rec[bcode],$adm_rec[ccode]).'</td>';
                echo '<td>'.$patientObj->getGenderByPRN($adm_rec[prn],$adm_rec[bcode],$adm_rec[ccode]).'</td>';
                echo '<td>'.$adm_rec[age].'</td>';
                echo '</tr>';
            }*/
        ?>
        </tbody>
    </table>
</div>
</div>
</div>
</div>
        
        
    </div>-->
   
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
     <a href="../qty/compliant" data-target="#complain" data-toggle="modal">
    C<br>
    O<br>
    M<br>
    P<br>
    L<br>
    A<br>
    I<br>
    N<br>
     T</a></div>
     
      
  
</body>
</html>