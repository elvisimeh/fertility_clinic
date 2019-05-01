<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once("controller_lib.php");
$ivfobj = new IVF;

$ivfno = $_GET['ivfno'];
$prn = $_GET['prn'];
$load_drugs    = $ivfobj->load_drugs($ivfno);
//$drugs = $ivfobj->drugs();
//$sum_drugs          = $ivfobj->sum_drugs($ivfno);
$patient_details = $ivfobj->get_ivf_file($prn);
//var_dump($ivfno);
?>
<table id="prescribed_drugs" class="table table-bordered" style="color:black; font-size:14px"><thead style="">

<tr style="font-weight: bold" class="bg-primary">
<td>S/N</td><td>Date</td><td>Time</td><td>Drugs</td><td>Dosage</td>
<td>Frq.</td><td>Duration</td><td>Qty</td><td>Amount</td><td>By</td><td>&nbsp;</td>
</tr>


<?php $sn=0; ?>
<?php foreach ($load_drugs as $load_drug){?>

<tr>
<td><?php echo $sn= $sn+1;?></td><td><?php echo $load_drug['pdate']; ?></td><td><?php echo $load_drug['ptime']; ?></td>
<td><?php echo $load_drug['itemname'] ?></td><td><?php echo $load_drug['dosage']; ?></td>
<td><?php echo $load_drug['frequency']; ?></td><td><?php echo $load_drug['duration']; ?></td><td><?php echo $load_drug['totqty']; ?></td><td><?php echo $load_drug['totamt']; ?></td>
<td><?php echo $load_drug['staffname']; ?></td>
<td>
<?php  if($load_drug['status']=="NOT DISPENSED"){?>
    <span onclick="delete_drug(this)" id=<?php echo $load_drug['id'] ?> style="color:#D9534F; font-weight:bold;cursor:pointer;" class="glyphicon glyphicon-remove-circle"></span>&nbsp;
    <?php }; ?>
</td>
</tr>

<?php } ?>
<tr>
<td></td><td></td><td></td><td></td><td></td>
<td></td><td></td><td></td><td><?php //echo $sum_drugs['sum'] ?></td><td>&nbsp;</td>
</tr>
</table>