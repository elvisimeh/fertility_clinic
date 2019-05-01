<?php

require_once("controller_lib.php");
$ivfobj = new IVF;

$ivfno = $_GET['ivfno'];

$grade = $ivfobj->load_grade($ivfno);

//var_dump($spp);
?>


<div class="row">
    <div class="col-md-6">
    <p>Day: <?php echo $grade['day'] ?></p>
    </div>
    <div class="col-md-6">
    <p>Time: <?php echo $grade['gtime'] ?></p>
    </div>

</div>

<div class="row">
    <div class="col-md-6">
    <p>No. Of Cleaved Embryo: <?php echo $grade['cleaved'] ?></p>
    </div>
    <div class="col-md-6">
    <p>No. Failed To Cleaved: <?php echo $grade['failed_cleave'] ?></p>
    </div>

</div>

<div class="row">
    <div class="col-md-6">
    <p>Embryo Grade: <?php echo $grade['embryo_grade'] ?></p>
    </div>
    <div class="col-md-6">
    <p>Embryologist: <?php echo $grade['embryologist'] ?></p>
    </div>

</div>

<div class="row">
    <div class="col-md-12">
    <p>comment: <?php echo $grade['comment'] ?></p>
    </div>
    

</div>

