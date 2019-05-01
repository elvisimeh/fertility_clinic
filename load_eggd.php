<?php

require_once("controller_lib.php");
$ivfobj = new IVF;

$ivfno = $_GET['ivfno'];

$egg_detail = $ivfobj->select_eggd($ivfno);

//var_dump($spp);
?>


<div class="row">
    <div class="col-md-6">
    <p>Time: <?php echo $spp['method_collection'] ?></p>
    </div>
    <div class="col-md-6">
    <p>Lt Ovary: <?php echo $spp['abstinence'] ?></p>
    </div>

</div>

<div class="row">
    <div class="col-md-6">
    <p>Rt Ovary: <?php echo $spp['time_produced'] ?></p>
    </div>
    <div class="col-md-6">
    <p>Egg: <?php echo $spp['time_delivered'] ?></p>
    </div>

</div>

<div class="row">
    <div class="col-md-6">
    <p>Time Of Insemination: <?php echo $spp['time_assessed'] ?></p>
    </div>
    <div class="col-md-6">
    <p>No. of Oocytes: <?php echo $spp['volume'] ?></p>
    </div>

</div>

<div class="row">
    <div class="col-md-6">
    <p>No. of Oocytes Treated: <?php echo $spp['viscosity'] ?></p>
    </div>
    <div class="col-md-6">
    <p>Mode Of Treatment: <?php echo $spp['liquefaction'] ?></p>
    </div>

</div>

<div class="row">
    <div class="col-md-6">
    <p>Stripping By: <?php echo $spp['conc'] ?></p>
    </div>
    <div class="col-md-6">
    <p>Ocr By: <?php echo $spp['motile'] ?></p>
    </div>

</div>

<div class="row">
    <div class="col-md-6">
    <p>Inseminated By: <?php echo $spp['motility'] ?></p>
    </div>
    <div class="col-md-6">
    <p>Comment: <?php echo $spp['total_count'] ?></p>
    </div>

</div>

<div class="row">
    <div class="col-md-12">
    <p>Media Used: <?php echo $spp['agglutination'] ?></p>
    </div>
    
</div>
