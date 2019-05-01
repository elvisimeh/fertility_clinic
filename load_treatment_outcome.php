<?php

require_once("controller_lib.php");
$ivfobj = new IVF;

$ivfno = $_GET['ivfno'];

$outcome = $ivfobj->select_outcome($ivfno);

//var_dump($outcome);
?>


<div class="row">
    <div class="col-md-6">
    <p>Date: <?php echo $outcome['date'] ?></p>
    </div>
    <div class="col-md-6">
    <p>Pregnancy Test: <?php echo $outcome['pt'] ?></p>
    </div>

</div>

<div class="row">
    <div class="col-md-6">
    <p>Test Date: <?php echo $outcome['test_date'] ?></p>
    </div>
    <div class="col-md-6">
    <p>Pregnancy Outcome: <?php echo $outcome['pregnancy_outcome'] ?></p>
    </div>

</div>

<div class="row">
    <div class="col-md-6">
    <p>Scan Confirmation: <?php echo $outcome['scan_confirmation'] ?></p>
    </div>
    <div class="col-md-6">
    <p>Delivery Date: <?php echo $outcome['del_date'] ?></p>
    </div>

</div>

<div class="row">
    <div class="col-md-6">
    <p>Live Birth: <?php echo $outcome['live_birth'] ?></p>
    </div>
    <div class="col-md-6">
    <p>Posted By: <?php echo $outcome['posted_by'] ?></p>
    </div>

</div>

<div class="row">
    <div class="col-md-12">
    <p>Comment: <?php echo $outcome['comment'] ?></p>
    </div>
    
</div>

