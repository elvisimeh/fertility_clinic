

<div>
<div id="success_messg_spostp" style="display:none;color:green; text-align:center">Added successfully</div>

<form action="controller_sperm_post_prep.php" method="POST" id="sperm_post_prep">



<div class="form-row">
    <div class="col-md-6">
<label for="">Time Assessed</label>
<input type="text" class="form-control" name="time_assessed" id="" required>
</div>

<div class="col-md-6">
<label for="">Prep. Time</label>
<input type="text" class="form-control" name="prep_time" id="" required>
</div></div>


<div class="form-row">
    <div class="col-md-6">
<label for="">Prep Method</label>
<input type="text" class="form-control" name="prep_method" id="" required>
</div>

<div class="col-md-6">
<label for="">Volume Assessed</label>
<input type="text" class="form-control" name="vol_assessed" id="" required>
</div></div>

<div class="form-row">
    <div class="col-md-6">
<label for="">Motile Count</label>
<input type="text" class="form-control" name="motile_count" id="" required>
</div>

<div class="col-md-6">
<label for="">Motile Rapid</label>
<input type="text" class="form-control" name="motile_rapid" id="" required>
</div></div>

<div class="form-row">
    <div class="col-md-6">
<label for="">Motile Slow</label>
<input type="text" class="form-control" name="motile_slow" id="" required>
</div>

<div class="col-md-6">
<label for="">Embryologist</label>
<input type="text" class="form-control" name="embryologist" value="<?php echo $ivfobj->get_userby_id($_SESSION['id'])['staffname'] ?>" id="" readonly>
</div></div>

<div class="form-row">
    <div class="col-md-12">
<label for="">Comment</label>
<textarea name="comment" class="form-control" id="" required></textarea>

</div>
</div>

<input type="hidden" name="bcode" value="<?php echo $_SESSION['branchcode'] ?>" id="">

<input type="hidden" name="ccode" value="<?php echo $_SESSION['companycode'] ?>" id="">

<input type="hidden" name="ivfno" value="<?php echo $_GET['ivfno'] ?>" id="">


<input type="hidden" name="qm" value="qm" id="">

<input type="submit" class="form-control btn btn-success" value="Save" name="" id="" style="margin-top:2%">

</form>


</div>

