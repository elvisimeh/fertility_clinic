

<div>
<div id="success_messg_pn" style="display:none;color:green; text-align:center">Added successfully</div>

<form action="controller_pn_check.php" method="POST" id="pn_check_submit">


<div class="form-row">
    <div class="col-md-6">
<label for="">Time</label>
<input type="text" class="form-control" name="ctime" id="" required>
</div>

<div class="col-md-6">
<label for="">Cumm. Break Down</label>
<input type="text" class="form-control" name="cumm_break_down" id="" required>
</div></div>


<div class="form-row">
    <div class="col-md-6">
<label for="">No. Fertilized</label>
<input type="text" class="form-control" name="fertilized" id="" required>
</div>

<div class="col-md-6">
<label for="">Grades</label>
<input type="text" class="form-control" name="grades" id="" required>
</div></div>

<div class="form-row">
    <div class="col-md-6">
<label for="">Embryologist</label>
<input type="text" class="form-control" name="embryologist" id="" required>
</div>

<div class="col-md-6">

<input type="hidden" class="form-control" value="<?php echo $_SESSION['id'] ?>" name="posted_by" id="">
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