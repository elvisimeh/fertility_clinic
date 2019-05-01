

<div>
<div id="success_messg_spp" style="display:none;color:green; text-align:center">Added successfully</div>
<form action="controller_sperm_pre_prep.php" method='POST' id="sperm_pre_prep">

<div class="row">
<div class="col-md-2">
<input type="checkbox" name="hs" value="hs" id=""> HS
</div>
<div class="col-md-2">
<input type="checkbox" name="ds" value="ds" id=""> DS
</div>
<div class="col-md-2">
<input type="checkbox" name="fs" value="fs" id=""> FS
</div></div>

<div class="form-row">
    <div class="col-md-6">
<label for="">Method of Collection</label>
<input type="text" class="form-control" name="method_collection" id="" required>
</div>

<div class="col-md-6">
<label for="">Abstinence</label>
<input type="text" class="form-control" name="abstinence" id="" required>
</div></div>


<div class="form-row">
    <div class="col-md-6">
<label for="">Time Produced</label>
<input type="text" class="form-control" name="time_produced" id="" required>
</div>

<div class="col-md-6">
<label for="">Time Delivered</label>
<input type="text" class="form-control" name="time_delivered" id="" required>
</div></div>

<div class="form-row">
    <div class="col-md-6">
<label for="">Time Assessed</label>
<input type="text" class="form-control" name="time_assessed" id="" required>
</div>

<div class="col-md-6">
<label for="">Volume</label>
<input type="text" class="form-control" name="volume" id="" required>
</div></div>

<div class="form-row">
    <div class="col-md-6">
<label for="">Viscosity</label>
<input type="text" class="form-control" name="viscosity" id="" required>
</div>

<div class="col-md-6">
<label for="">Liquefaction Time</label>
<input type="text" class="form-control" name="liquefaction" id="" required>
</div></div>

<div class="form-row">
    <div class="col-md-6">
<label for="">Conc. Count</label>
<input type="text" class="form-control" name="conc_count" id="" required>
</div>

<div class="col-md-6">
<label for="">Motile Count</label>
<input type="text" class="form-control" name="motile_count" id="" required>
</div></div>

<div class="form-row">
    <div class="col-md-6">
<label for="">% Motility</label>
<input type="text" class="form-control" name="motility" id="" required>
</div>

<div class="col-md-6">
<label for="">Total Count</label>
<input type="text" class="form-control" name="total_count" id="" required>
</div></div>

<div class="form-row">
    <div class="col-md-6">
<label for="">Agglutination</label>
<input type="text" class="form-control" name="agglutination" id="" required>
</div>

<div class="col-md-6">
<label for="">Instrument Used</label>
<input type="text" class="form-control" name="instrument_used" id="" required>
</div></div>

<div class="form-row">
    <div class="col-md-6">
<label for="">Comment</label>
<input type="text" class="form-control" name="comment" id="" required>
</div>

<div class="col-md-6">
<label for="">Embryologist</label>
<input type="text" class="form-control" name="" value="<?php echo $ivfobj->get_userby_id($_SESSION['id'])['staffname'] ?>" id="embryologist" readonly>
</div></div>

<input type="hidden" name="bcode" value="<?php echo $_SESSION['branchcode'] ?>" id="">

<input type="hidden" name="ccode" value="<?php echo $_SESSION['companycode'] ?>" id="">

<input type="hidden" name="ivfno" value="<?php echo $ivfno ?>" id="">
<input type="hidden" name="qq" value="qq" id="">

<input type="submit" class="form-control btn btn-success" value="Save" name="save" id="" style="margin-top:2%">

</form>


</div>

