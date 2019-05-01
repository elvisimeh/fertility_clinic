<div class="modal-dialogue" style="width:70% !important; display:block !important; margin:auto !important;margin-top:5% !important">
<div class="modal-content"></div>
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h4 class="modal-title" style="text-align:center">Add Radiology Investigations</h4>

</div>
<div class="modal-body" style="background-color:white;">

<div id="success_messg_lab" style="display:none;color:green; text-align:center">Radiology Investigation Ordered successfully</div>
    <div class="row">
 <div class="col-md-offset-2 col-md-8">
 <?php if($patient_details['donor'] !='donor'){?>
 <div style="background-color:#8ED2B1" class="balance"> 
 <?php include 'balance.php' ?> 
 </div>
 <?php } ?> 
<form action="controller_post_lab_service.php" method="POST" class="" id="order_rad_inv">

<label for="">Radiology Investigations:</label></div></div>

<div class="row">
    <div class="new_service">

    </div>
<div class="col-md-offset-2 col-md-8 old_service">
<select class="form-control searchable getcost8" name="rad_service" id="rad_serv" style="width:100%" required>
<?php //foreach()?>
<option value="" data-price=<?php echo 0 ?> selected >Type to select Investigation</option>
<?php foreach ($rad_invs as $rad_inv){?>
<option value="<?php echo $rad_inv['id']?>" data-price=<?php echo floatval(preg_replace('/[^\d\.]+/','', $rad_inv['agreed_amt']))?>>
<?php echo $rad_inv['service_name'] ?></option>

<?php } ?>
</select>
<?php //var_dump($rad_invs) ?>
</div></div>
<br/>
<input type="hidden" name="prn" value="<?php echo $prn; ?>" id="prn">
<input type="hidden" name="ivfno" value="<?php echo $patient_details['ivf_no']; ?>" id="ivfno">
<input type="hidden" name="date" value="<?php echo date('Y-m-d'); ?>" id="">
<input type="hidden" name="time" value="<?php echo date("h:i:sa"); ?>" id="">
<input type="hidden" name="by" value="<?php echo $_SESSION['id']; ?>" id="by">
<input type="hidden" name="age" value="<?php echo $patient_details['age']; ?>" id="age">
<input type="hidden" name="category" value="<?php echo $patient_details['category']; ?>" id="category">
<input type="hidden" name="sponsor" value="<?php echo $patient_details['sponsor']; ?>" id="sponsor">
<input type="hidden" name="plan" value="<?php echo $patient_details['plan_type']; ?>" id="plan">
<input type="hidden" name="bcode" value="<?php echo $bcode; ?>" id="bcode">
<input type="hidden" name="ccode" value="<?php echo $ccode; ?>" id="ccode">
<input type="hidden" name="specialty_id" value="<?php echo $spec; ?>" id="specialty_id">


<div class="col-md-offset-2 col-md-8">

</div>

<div class="modal-footer">
    <div style="display:block; margin-right:0px">
<button type="submit" class="btn btn-primary add-rad-service" style="" id="">Post</button>
<button class="btn btn-danger" data-dismiss="modal" style="padding-left:5px" type="submit">Close</button>
</div>
</div>
</form>
</div></div>


