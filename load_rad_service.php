<?php

//error_reporting(E_ALL);
ini_set('display_errors', 0);

session_start();
require_once("controller_lib.php");
$ivfobj = new IVF;

$ivfno = $_GET['ivfno'];
$prn = $_GET['prn'];
$rad = 'MEDICAL IMAGING';
//if($ivfno===null){
$load_services = $ivfobj->load_service_prn($prn,$rad);
/*}
else{
$load_services = $ivfobj->load_service($ivfno);
}*/

?>
<div class="table-responsive">
<table class="table table-bordered" style="color:black; font-size:1em;">
<tr style="font-weight: bold" class="bg-primary">
<td>S/N</td><td>Date</td><td>Time</td><td>Investigation</td><td>Dept</td>
<td>Amount</td><td>Ordered By</td><td>Status</td><td>&nbsp;</td>
</tr>
<?php
        $sn=0;
      foreach($load_services as $load_service){
          if($load_service['unitname'] == 'MEDICAL IMAGING'){ ?>
                
<tr>
    <td>
        <?php echo $sn= $sn+1; ?>
    </td>
    <td>
        <?php echo $load_service['orderdate'] ?>
    </td>
    <td>
    <?php echo $load_service['ordertime'] ?>
    </td>
    <td>
    <?php echo $load_service['service_name']; //echo $counselobj->get_service($a)['service_name'];?>
    </td>
    <td>
    <?php echo $load_service['unitname']; //echo $counselobj->get_dept_by_id($d)['unitname']; ?>
    </td>
    
    <td>
    &#8358;<?php echo $load_service['service_amt'] ?>
    </td>
    <td>
    <?php echo $load_service['staffname']; //echo $counselobj->doctor_name($doctor)['staffname']; ?>
    </td>
    <td>
    <?php echo $load_service['status']; ?>
    </td>
    
    <td>
    <?php  if($load_service['status']=="NOT DONE" && $load_service['doctorname'] == $_SESSION['id']){?>
    <span onclick="delete_rad_service(this)" id=<?php echo $load_service['id'] ?> data-prn="<?php echo $prn ?>" style="color:#D9534F; font-weight:bold;cursor:pointer;" class="glyphicon glyphicon-remove-circle"></span>&nbsp;
    <?php } 
    else { ?>
    <a onclick="load_rad_result(<?php echo $load_service['id']?>)" href="rad_result?id=<?php echo $load_service['id'] ?>" class="btn btn-success" data-target="#lab_results" data-toggle="modal">View result</a>
   <?php }
    ?>
</td>
</tr>
      <?php } } ?>

<tr>
<td></td><td></td><td></td><td></td><td></td>
<td></td><td></td><td></td><td>&nbsp;</td>
</tr>

</table>