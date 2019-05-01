<?php

require_once("controller_lib.php");
	
    $ivfobj = new IVF;

$prn = $_GET['prn'];
$lab ='LABORATORY';
$posted_invs = $ivfobj->load_service_prn($prn,$lab);
?>


<table class="table table-bordered">
<thead class="bg-primary">
    <th>SN</th>
    <th>Date</th>
    <th>Time</th>
    <th>Investigation</th>
    <th>Posted By</th>
    <th>Status</th>
    <th></th>
</thead>
<tbody>
    <?php $sn=1; foreach($posted_invs as $posted_inv){?>
    <tr>
        <td><?php echo $sn++ ?></td>
        <td><?php echo $posted_inv['orderdate'] ?></td>
        <td><?php echo $posted_inv['ordertime'] ?></td>
        <td><?php echo $posted_inv['service_name'] ?></td>
        <td><?php echo $posted_inv['staffname'] ?></td>
        <td><?php echo $posted_inv['status'] ?></td>
        <td>
        <?php  if($posted_inv['status']=="NOT DONE"){?>
    <span onclick="delete_service(this)" id=<?php echo $posted_inv['id'] ?> data-prn="<?php echo $prn ?>" style="color:#D9534F; font-weight:bold;cursor:pointer;" class="glyphicon glyphicon-remove-circle"></span>&nbsp;
    <?php } ?>
        </td>
        
    </tr>
    <?php } ?>
</tbody>

</table>