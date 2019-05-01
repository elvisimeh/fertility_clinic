

<div>
<div id="success_messg_embryo" style="display:none;color:green; text-align:center">Added successfully</div>

<form action="controller_embryo_transfer.php" method="POST" id="embryo_transfer_submit">


<div class="form-row">
    <div class="col-md-6">
<label for="">Time</label>
<input type="text" class="form-control" name="transfer_time" id="" required>
</div>

<div class="col-md-6">
<label for="">Day Of Transfer</label>
<input type="text" class="form-control" name="transfer_day" id="" required>
</div></div>


<div class="form-row">
    <div class="col-md-6">
<label for="">No. Of Embryo Transferred</label>
<input type="text" class="form-control" name="embryo_transferred" id="" required>
</div>

<div class="col-md-6">
<label for="">Stylet Used</label>
<input type="text" class="form-control" name="stylet" id="" required>
</div></div>

<div class="form-row">
    <div class="col-md-6">
<label for="">Grade Of Transferred Embryo</label>
<input type="text" class="form-control" name="grade_transferred_embryo" id="" required>
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
<input type="text" class="form-control" name="liquefaction_time" id="" required>
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
<input type="text" class="form-control" name="embryologist" id="" readonly>
</div></div>

<input type="hidden" name="ivfno" value="<?php echo $_GET['ivfno'] ?>" id="">

<input type="hidden" name="bcode" value="<?php echo $_SESSION['branchcode'] ?>" id="">

<input type="hidden" name="ccode" value="<?php echo $_SESSION['companycode'] ?>" id="">

<input type="submit" class="form-control btn btn-success" value="Save" name="" id="" style="margin-top:2%">

</form>


</div>