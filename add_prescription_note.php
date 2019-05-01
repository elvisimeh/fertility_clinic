<div class="modal-dialogue" style="width:70% !important; display:block !important; margin:auto !important;margin-top:5% !important">
<div class="modal-content"></div>
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h4 class="modal-title" style="text-align:center">Add Prescription Note</h4>

</div>
<div class="modal-body" style="background-color:white;">

<div id="success_messg_pres" style="display:none;color:green; text-align:center">Prescription Entry Entered successfully</div>
    
 
<form action="controller_add_prescription.php" method="POST" class="" id="add_pres">

<div class="form-row">

<div class="col-md-6">
    <label for="">Name of Injection</label>
    <input type="text" class="form-control" name="noi" id="">
</div>

<div class="col-md-6">
    <label for="">Dosage</label>
    <input type="text" class="form-control" name="dosage" id="">
</div>

</div>

<div class="form-row">

<div class="col-md-6">
    <label for="">Scan Days</label>
    <input type="text" class="form-control" name="scan_days" id="">
</div>

<div class="col-md-6">
    <label for="">Scan Findings</label>
    <input type="text" class="form-control" name="scan_findings" id="">
</div>

</div>

<div class="form-row">

<div class="col-md-12">
    <label for="">Remark</label>
    <textarea name="remark" id="" class="form-control"></textarea>
    
</div>

</div>

<input type="hidden" name="by" value="<?php echo $_SESSION['id'] ?>" id="">
<input type="hidden" name="bcode" value="<?php echo $_SESSION['branchcode'] ?>" id="">
<input type="hidden" name="ccode" value="<?php echo $_SESSION['companycode'] ?>" id="">
<input type="hidden" name="prn" value="<?php echo $prn ?>" id="">
<input type="hidden" name="ivfno" value="<?php echo $ivfno ?>" id="">

<div class="modal-footer">
    <div style="display:block; margin-right:0px;">
    &nbsp;<br/>
<button type="submit" class="btn btn-primary add-prescription_entry" style="" id="">Save</button>
<button class="btn btn-danger" data-dismiss="modal" style="padding-left:5px" type="submit">Close</button>
</div>
</div>
</form>
</div></div>


