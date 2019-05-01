

<div>
<div id="success_messg_egg" style="display:none;color:green; text-align:center">Added successfully</div>

<form action="controller_egg_details.php" method="POST" id="egg_details_submit">


<div class="form-row">
    <div class="col-md-12">
<label for="">Time</label>
<input type="text" class="form-control" name="time" id="" required>
</div>

</div>


<div class="form-row">
    <div class="col-md-6">
<label for="">Lt Ovary</label>
<input type="text" class="form-control" name="lt_ovary" id="" required>
</div>

<div class="col-md-6">
<label for="">Rt Ovary</label>
<input type="text" class="form-control" name="rt_ovary" id="" required>
</div></div>

<div class="form-row">
    <div class="col-md-6">
<label for="">Egg</label>
<input type="text" class="form-control" name="egg" id="" required>
</div>

<div class="col-md-6">
<label for="">Time of Insemination</label>
<input type="text" class="form-control" name="time_of_insemination" id="" required>
</div></div>

<div class="form-row">
    <div class="col-md-6">
<label for="">No. Of Oocytes</label>
<input type="text" class="form-control" name="oocytes" id="" required>
</div>

<div class="col-md-6">
<label for="">No. Of Oocytes Treated</label>
<input type="text" class="form-control" name="oocytes_treated" id="" required>
</div></div>

<div class="form-row">
    <div class="col-md-6">
<label for="">Mode Of Treatment</label>
<input type="text" class="form-control" name="treatment_mode" id="" required>
</div>

<div class="col-md-6">
<label for="">Stripping By</label>
<input type="text" class="form-control" name="stripped_by" id="" required>
</div></div>

<div class="form-row">
    <div class="col-md-6">
<label for="">Ocr By</label>
<input type="text" class="form-control" name="ocr_by" id="" required>
</div>

<div class="col-md-6">
<label for="">Inseminated By</label>
<input type="text" class="form-control" name="inseminated_by" id="" required>
</div></div>

<div class="form-row">
    <div class="col-md-6">
<label for="">Comment</label>
<input type="text" class="form-control" name="comment" id="" required>
</div>

<div class="col-md-6">
<label for="">Media Used</label>
<input type="text" class="form-control" name="media_used" id="" required>
</div></div>

<input type="hidden" name="bcode" value="<?php echo $_SESSION['branchcode'] ?>" id="">

<input type="hidden" name="ccode" value="<?php echo $_SESSION['companycode'] ?>" id="">

<input type="hidden" name="ivfno" value="<?php echo $_GET['ivfno'] ?>" id="">


<input type="submit" class="form-control btn btn-success" value="Save" name="" id="" style="margin-top:2%">

</form>


</div>