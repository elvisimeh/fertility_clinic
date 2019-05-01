<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once("controller_lib.php");
$ivfobj = new IVF;

$ivfno = $_GET['ivfno'];
$prn = $_GET['prn'];
$prescriptions    = $ivfobj->prescription($ivfno);
//$drugs = $ivfobj->drugs();
//$sum_drugs          = $ivfobj->sum_drugs($ivfno);
$patient_details = $ivfobj->get_ivf_file($prn);
//var_dump($ivfno);
?>
<table id="prescription" class="table table-bordered" style="color:black; font-size:14px"><thead style="">

<tr style="font-weight: bold" class="bg-primary">
<td>S/N</td><td>Date</td><td>Time</td><td>Injection(s)</td><td>Dosage</td>
<td>Scan Days</td><td>Scan Findings</td><td>Remark</td><td>Posted By</td><td>&nbsp;</td>
</tr>


<?php $sn=0; ?>
<?php foreach ($prescriptions as $prescription){?>

<tr>
<td><?php echo $sn= $sn+1;?></td><td><?php echo $prescription['date'] ?></td><td><?php echo $prescription['time'] ?></td>
<td><?php echo $prescription['inj'] ?></td><td><?php echo $prescription['dosage'] ?></td>
<td><?php echo $prescription['scan_days'] ?></td><td><?php echo $prescription['scan_findings'] ?></td><td><?php echo $prescription['remark'] ?></td><td><?php echo $prescription['staffname'] ?></td>

<td>
<?php  //if($load_drug['status']=="NOT DISPENSED"){?>
    <span onclick="" id="<?php //echo $load_drug['id'] ?>" style="color:#D9534F; font-weight:bold;cursor:pointer;" class="glyphicon glyphicon-edit"></span>&nbsp;
    <?php //}; ?>
</td>
</tr>

<?php } ?>
<tr>
<td></td><td></td><td></td><td></td><td></td>
<td></td><td></td><td></td><td><?php //echo $sum_drugs['sum'] ?></td><td>&nbsp;</td>
</tr>
</table>