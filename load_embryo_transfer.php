<?php

require_once("controller_lib.php");
$ivfobj = new IVF;

$ivfno = $_GET['ivfno'];

$embryo = $ivfobj->load_embryo_transfer($ivfno);

//var_dump($embryo);
?>


<div class="row">
    <div class="col-md-6">
    <p>Time: <?php echo $embryo['transfer_time'] ?></p>
    </div>
    <div class="col-md-6">
    <p>Day Of Transfer: <?php echo $embryo['transfer_day'] ?></p>
    </div>

</div>

<div class="row">
    <div class="col-md-6">
    <p>No. Of Embryo Transferred: <?php echo $embryo['embryo_transferred'] ?></p>
    </div>
    <div class="col-md-6">
    <p>Stylet Used: <?php echo $embryo['stylet'] ?></p>
    </div>

</div>

<div class="row">
    <div class="col-md-6">
    <p>Grade Of Transferred Embryo: <?php echo $embryo['grade_transferred_embryo'] ?></p>
    </div>
    <div class="col-md-6">
    <p>Volume: <?php echo $embryo['volume'] ?></p>
    </div>

</div>

<div class="row">
    <div class="col-md-6">
    <p>Viscosity: <?php echo $embryo['viscosity'] ?></p>
    </div>
    <div class="col-md-6">
    <p>Liquefaction Time: <?php echo $embryo['liquefaction_time'] ?></p>
    </div>

</div>

<div class="row">
    <div class="col-md-6">
    <p>Conc. Count: <?php echo $embryo['conc_count'] ?></p>
    </div>
    <div class="col-md-6">
    <p>Motile Count: <?php echo $embryo['motile_count'] ?></p>
    </div>

</div>

<div class="row">
    <div class="col-md-6">
    <p>% Motility: <?php echo $embryo['motility'] ?></p>
    </div>
    <div class="col-md-6">
    <p>Total Count: <?php echo $embryo['total_count'] ?></p>
    </div>

</div>

<div class="row">
    <div class="col-md-6">
    <p>Agglutination: <?php echo $embryo['agglutination'] ?></p>
    </div>
    <div class="col-md-6">
    <p>Instrument Used: <?php echo $embryo['instrument_used'] ?></p>
    </div>

</div>

<div class="row">
    <div class="col-md-6">
    <p>Comment: <?php echo $embryo['comment'] ?></p>
    </div>
    <div class="col-md-6">
    <p>Embryologist: <?php echo $embryo['embryologist'] ?></p>
    </div>

</div>