<?php

require_once("controller_lib.php");
$ivfobj = new IVF;

$ivfno = $_GET['ivfno'];

$spp = $ivfobj->select_spp($ivfno);

//var_dump($spp);
?>

<div class="row">
    <div class="col-md-4">
    <p>HS: <?php echo $spp['hs'] ?></p>
    </div>
    <div class="col-md-4">
    <p>DS: <?php echo $spp['ds'] ?></p>
    </div>
    <div class="col-md-4">
    <p>FS: <?php echo $spp['fs'] ?></p>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
    <p>Method of Collection: <?php echo $spp['method_collection'] ?></p>
    </div>
    <div class="col-md-6">
    <p>Abstinence: <?php echo $spp['abstinence'] ?></p>
    </div>

</div>

<div class="row">
    <div class="col-md-6">
    <p>Time Produced: <?php echo $spp['time_produced'] ?></p>
    </div>
    <div class="col-md-6">
    <p>Time Delivered: <?php echo $spp['time_delivered'] ?></p>
    </div>

</div>

<div class="row">
    <div class="col-md-6">
    <p>Time Assessed: <?php echo $spp['time_assessed'] ?></p>
    </div>
    <div class="col-md-6">
    <p>Volume: <?php echo $spp['volume'] ?></p>
    </div>

</div>

<div class="row">
    <div class="col-md-6">
    <p>Viscosity: <?php echo $spp['viscosity'] ?></p>
    </div>
    <div class="col-md-6">
    <p>Liquefaction Time: <?php echo $spp['liquefaction'] ?></p>
    </div>

</div>

<div class="row">
    <div class="col-md-6">
    <p>Conc. Count: <?php echo $spp['conc'] ?></p>
    </div>
    <div class="col-md-6">
    <p>Motile Count: <?php echo $spp['motile'] ?></p>
    </div>

</div>

<div class="row">
    <div class="col-md-6">
    <p>% Motility: <?php echo $spp['motility'] ?></p>
    </div>
    <div class="col-md-6">
    <p>Total Count: <?php echo $spp['total_count'] ?></p>
    </div>

</div>

<div class="row">
    <div class="col-md-6">
    <p>Agglutination: <?php echo $spp['agglutination'] ?></p>
    </div>
    <div class="col-md-6">
    <p>Instrument Used: <?php echo $spp['instrument_used'] ?></p>
    </div>

</div>

<div class="row">
    <div class="col-md-6">
    <p>Comment: <?php echo $spp['comment'] ?></p>
    </div>
    <div class="col-md-6">
    <p>Embryologist: <?php echo $spp['embryologist'] ?></p>
    </div>

</div>