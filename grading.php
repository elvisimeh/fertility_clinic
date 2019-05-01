

<div>
<div id="success_messg_grading" style="display:none;color:green; text-align:center">Added successfully</div>

<form action="controller_grading.php" method="POST" id="grading_submit">


<div class="form-row">
    <div class="col-md-6">
<label for="">Day</label>
<input type="text" class="form-control" name="day" id="" required>
</div>

<div class="col-md-6">
<label for="">Time</label>
<input type="text" class="form-control" name="gtime" id="" required>
</div></div>


<div class="form-row">
    <div class="col-md-6">
<label for="">No. Of Cleaved Embryo</label>
<input type="text" class="form-control" name="cleaved" id="" required>
</div>

<div class="col-md-6">
<label for="">No. Failed To Cleave</label>
<input type="text" class="form-control" name="failed_cleave" id="" required>
</div></div>

<div class="form-row">
    <div class="col-md-6">
<label for="">Embryo Grade</label>
<input type="text" class="form-control" name="embryo_grade" id="" required>
</div>

<div class="col-md-6">
<label for="">Embryologist</label>
<input type="text" class="form-control" name="embryologist" id="" required>
</div></div>

<div class="form-row">
    <div class="col-md-12">
<label for="">Comment</label>
<textarea type="text" class="form-control" name="comment" id="" required></textarea>
</div>

</div>

<input type="hidden" name="bcode" value="<?php echo $_SESSION['branchcode'] ?>" id="">

<input type="hidden" name="ccode" value="<?php echo $_SESSION['companycode'] ?>" id="">

<input type="hidden" name="ivfno" value="<?php echo $_GET['ivfno'] ?>" id="">

<input type="submit" class="form-control btn btn-success" value="Save" name="" id="" style="margin-top:2%">

</form>


</div>