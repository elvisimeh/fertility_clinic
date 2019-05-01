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

$rad_result = $ivfobj->rad_result($id);

$prn = $rad_result['prn'];

$a = $rad_result['testname'];
?>


<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h4 class="modal-title" style="text-align:center"><?php echo $ivfobj->pat_name_prn($prn)['fullname'] ?></h4>

</div>
<div class="modal-body" style="background-color:white;">

<?php if(empty($rad_result)){
    echo "<p>Result Not Posted Yet!</p>";
}
else { ?>

<div class="row" style="margin-left:5%">
Date:<?php echo $rad_result['pdate'] ?>&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;Inv:<?php echo $ivfobj->get_service($a)['service_name'] ?>
&nbsp;&nbsp;&nbsp;&nbsp;Posted By:<?php echo $rad_result['staffname'] ?>
</div>
<div>
<pre style="white-space: pre-wrap;"><?php echo $rad_result['body'] ?></pre>
<pre style="white-space: pre-wrap;"><?php echo $rad_result['conclusion'] ?></pre>

</div>

<?php } ?>

</div>

<script src="../../assets/js/select2.js"></script>  


  <script>

</script>