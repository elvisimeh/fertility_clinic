<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once("controller_lib.php");
$ivfobj = new IVF;


$prn = $_GET['prn'];

//$load_drugs    = $ivfobj->load_drugs($ivfno);
//$drugs = $ivfobj->drugs();
//$sum_drugs          = $ivfobj->sum_drugs($ivfno);
$tran_details = $ivfobj->details_ivf_acc($prn);
//var_dump($ivfno);
?>

<div class="panel panel-default" style="border: solid 1px orange">
    <div class="panel-heading bg-orange">
<p>IVF Account Details For <b><?php echo $tran_details[0]['fullname'] ?></b></p>
</div>
<div class="panel-body">
    <div class="table-responsive">
<table id="" class="table table-bordered" style="color:black; font-size:14px"><thead style="">

<tr style="font-weight: bold" class="bg-primary">
<td>S/N</td><td>PRN</td><td>Date</td><td>Patient Name</td><td>Amt. Deposited</td>
<td>Branch</td>
</tr></thead>

<tbody>

<?php $sn=0; ?>
<?php foreach ($tran_details as $tran_detail){?>

<tr>
<td><?php echo $sn= $sn+1;?></td><td><?php echo $tran_detail['prn']; ?></td><td><?php echo $tran_detail['tdate']; ?></td>
<td><?php echo $tran_detail['fullname'] ?></td><td><?php echo $tran_detail['amt_deposited']; ?></td>
<td><?php echo $tran_detail['branchname']; ?></td>
</tr>

<?php } ?>
<tr>
<td colspan=2><span class="label label-success">Total Amt. Deposited: <?php echo $ivfobj->get_ivf_deposit($prn)['sum'] ?> </span></td>
<td colspan=2><span class="label label-danger">Total Amt. Used: <?php if(empty($ivfobj->get_ivf_spent($prn)['amt_used'])){ echo 0;} else{ echo $ivfobj->get_ivf_spent($prn)['amt_used']; } ?></span> </td>
<td colspan=2><span class="label label-warning">Account Bal.: &#8358;<?php echo number_format(floatval(preg_replace('/[^\d\.]+/','',$ivfobj->get_ivf_deposit($prn)['sum'])) - floatval(preg_replace('/[^\d\.]+/','',$ivfobj->get_ivf_spent($prn)['amt_used'])),2,'.',',') ?></span> </td>
</tr>
</table>
</div>
</div></div>