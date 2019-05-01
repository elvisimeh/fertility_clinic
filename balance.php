<?php
require_once("controller_lib.php");

$ivfobj = new IVF;

$prn = $_GET['prn'];

$acc_balance = floatval(preg_replace('/[^\d\.]+/','', $ivfobj->get_ivf_deposit($prn)['sum'])) - floatval(preg_replace('/[^\d\.]+/','', $ivfobj->get_ivf_spent($prn)['amt_used']));


?>



Account Balance:&nbsp;&#x20a6;<element style="background-color:white; color:black" class="touse"><?php echo $acc_balance ?></element>
<input type="hidden" value="<?php echo $acc_balance ?>" name="" id="getbalance">
