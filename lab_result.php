<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
$staffname = $_SESSION['staffname'];
if(!isset($staffname)){
	header("location:../../index");
	session_destroy();
	exit;
}

require_once("controller_lib.php");
$ivfobj = new IVF;

$id = $_GET['id'];

$lab_result = $ivfobj->lab_result($id);

$prn = $lab_result['prn'];

$a = $lab_result['investigation'];
?>


<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h4 class="modal-title" style="text-align:center"><?php echo $ivfobj->pat_name_prn($prn)['fullname'] ?></h4>

</div>
<div class="modal-body" style="background-color:white;">

<?php if(empty($lab_result)){
    echo "<p>Result Not Posted Yet!</p>";
}
else { ?>

<div class="row" style="margin-left:5%">
<div class="col-md-4">
Date:<?php echo $lab_result['pdate'] ?>
</div>
<div class="col-md-4">
Inv:<?php echo $ivfobj->get_service($a)['service_name'] ?>
</div>
<div class="col-md-4">
Posted By:<?php echo $lab_result['staffname'] ?>
</div></div>
<div>

<pre style="white-space: pre-wrap;"><?php echo $lab_result['result'] ?></pre>

</div>

<?php } ?>

</div>

<script src="../../assets/js/select2.js"></script>  


  <script>

</script>