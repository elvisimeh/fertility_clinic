

<div>
<div id="success_messg_outcome" style="display:none;color:green; text-align:center">Added successfully</div>

<form action="controller_treatment_outcome.php" id="treatment_outcome_submit">


<div class="form-row">
    <div class="col-md-6">
<label for="">Date</label>
<input type="date" class="form-control" name="to_date" required>
</div>

<div class="col-md-6">
<label for="">Pregnancy Test</label>
<input type="text" class="form-control" name="pt" id="" required>
</div></div>


<div class="form-row">
    <div class="col-md-6">
<label for="">Test Date</label>
<input type="date" class="form-control" name="test_date" id="" required>
</div>

<div class="col-md-6">
<label for="">Pregnancy Outcome</label>
<input type="text" class="form-control" name="pregnancy_outcome" id="" required>
</div></div>

<div class="form-row">
    <div class="col-md-6">
<label for="">Scan Confirmation</label>
<input type="text" class="form-control" name="scan_confirmation" id="" required>
</div>

<div class="col-md-6">
<label for="">Delivery Date</label>
<input type="date" class="form-control" name="delivery_date" id="" required>
</div></div>

<div class="form-row">
    <div class="col-md-6">
<label for="">Live Birth</label>
<input type="text" class="form-control" name="live_birth" id="" required>
</div>

<div class="col-md-6">
<label for="">Posted By</label>
<input type="text" class="form-control" name="posted_by" id="" required>
</div></div>

<div class="form-row">
    <div class="col-md-12">
<label for="">Comment</label>
<textarea class="form-control" name="comment" id="" required></textarea>
</div>

</div>

<input type="hidden" name="bcode" value="<?php echo $_SESSION['branchcode'] ?>" id="">

<input type="hidden" name="ccode" value="<?php echo $_SESSION['companycode'] ?>" id="">

<input type="hidden" name="ivfno" value="<?php echo $ivfno ?>" id="">

<input type="submit" class="form-control btn btn-success" value="Save" name="" id="" style="margin-top:2%">

</form>


</div>