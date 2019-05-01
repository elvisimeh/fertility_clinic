<?php

require_once("controller_lib.php");
$ivfobj = new IVF;

$ivfno = $_GET['ivfno'];

$spostp = $ivfobj->select_spostp($ivfno);

//var_dump($spp);
?>



<div class="row">
    <div class="col-md-6">
    <p>Time Assessed: <?php echo $spostp['time_assessed'] ?></p>
    </div>
    <div class="col-md-6">
    <p>Prep. Time: <?php echo $spostp['prep_time'] ?></p>
    </div>

</div>

<div class="row">
    <div class="col-md-6">
    <p>Prep. Method: <?php echo $spostp['prep_method'] ?></p>
    </div>
    <div class="col-md-6">
    <p>Volume Assessed: <?php echo $spostp['vol_assessed'] ?></p>
    </div>

</div>

<div class="row">
    <div class="col-md-6">
    <p>Motile Count: <?php echo $spostp['motile_count'] ?></p>
    </div>
    <div class="col-md-6">
    <p>Motile Rapid: <?php echo $spostp['motile_rapid'] ?></p>
    </div>

</div>

<div class="row">
    <div class="col-md-6">
    <p>Motile Slow: <?php echo $spostp['motile_slow'] ?></p>
    </div>
    <div class="col-md-6">
    <p>Embryologist: <?php echo $spostp['embryologist'] ?></p>
    </div>

</div>

<div class="row">
    <div class="col-md-12">
    <p>Comment: <?php echo $spostp['comment'] ?></p>
    </div>
    
</div>

