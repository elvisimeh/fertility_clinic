<?php

require_once("controller_lib.php");
$ivfobj = new IVF;

$ivfno = $_GET['ivfno'];

$pn = $ivfobj->select_pncheck($ivfno);

//var_dump($spp);
?>



<div class="row">
    <div class="col-md-6">
    <p>Time: <?php echo $pn['ctime'] ?></p>
    </div>
    <div class="col-md-6">
    <p>Cumm. Break Down: <?php echo $pn['cumm_break_down'] ?></p>
    </div>

</div>

<div class="row">
    <div class="col-md-6">
    <p>No. Fertilized: <?php echo $pn['fertilized'] ?></p>
    </div>
    <div class="col-md-6">
    <p>Grades: <?php echo $pn['grades'] ?></p>
    </div>

</div>

<div class="row">
    <div class="col-md-6">
    <p>Embryologist: <?php echo $pn['embryologist'] ?></p>
    </div>
    <div class="col-md-6">
    <p>Comment: <?php echo $pn['comment'] ?></p>
    </div>

</div>

