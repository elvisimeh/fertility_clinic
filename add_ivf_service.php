<div class="modal-dialogue" style="width:70% !important; display:block !important; margin:auto !important;margin-top:5% !important">
<div class="modal-content"></div>
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h4 class="modal-title" style="text-align:center">Add Fertility Center Services</h4>

</div>
<div class="modal-body" style="background-color:white;">
<div id="success_messg_serv" style="display:none;color:green; text-align:center">Service Ordered successfully</div>
    <div class="row">
 <div class="col-md-offset-2 col-md-8"> 
 <?php if($patient_details['donor'] !='donor'){?>
 <div style="background-color:#8ED2B1" class="balance"> 
 <?php include 'balance.php' ?> 
 </div> 
 <?php } ?>  
<form action="controller_post_ivf_service.php" method="POST" class="" id="order_ivf_service">
<label for="">Services:</label></div></div>

<div class="row">
    <div class="new_service">

    </div>
<div class="col-md-offset-2 col-md-8 old_service">
<select class="form-control searchable getcost9" name="service" id="serv_inp" style="width:100%" required>
<?php //foreach()?>
<option value="" selected data-price=0 >Type to select service</option>
<?php foreach ($fert_services as $service){?>
<option value="<?php echo $service['id']?>" data-price=<?php echo floatval(preg_replace('/[^\d\.]+/','', $service['agreed_amt']))?>><?php echo $service['service_name'] ?></option>

<?php } ?>
</select>
<label for="" style="margin-top:1%">Price (&#8358;):</label>
<input type="text" class="form-control" name="" id="service_cost" readonly>
</div></div>
<br/>
<input type="hidden" name="prn" value="<?php echo $prn; ?>" id="">
<input type="hidden" name="vsn" value="<?php echo $vsn; ?>" id="">
<input type="hidden" name="date" value="<?php echo date('Y-m-d'); ?>" id="">
<input type="hidden" name="time" value="<?php echo date("h:i:sa"); ?>" id="">
<input type="hidden" name="by" value="<?php echo $_SESSION['id']; ?>" id="">
<input type="hidden" name="age" value="<?php echo $visit_details['age']; ?>" id="">
<input type="hidden" name="category" value="<?php echo $visit_details['category']; ?>" id="">
<input type="hidden" name="sponsor" value="<?php echo $visit_details['sponsor']; ?>" id="">
<input type="hidden" name="plan" value="<?php echo $visit_details['plan_type']; ?>" id="">
<input type="hidden" name="bcode" value="<?php echo $bcode; ?>" id="">
<input type="hidden" name="ccode" value="<?php echo $ccode; ?>" id="">
<input type="hidden" name="specialty_id" value="<?php echo $details_now['specialty']; ?>" id="">


<div class="col-md-offset-2 col-md-8">

</div>

<div class="modal-footer">
    <div style="display:block; margin-right:8%">
<button type="submit" class="btn btn-primary add-ivf-service" style="" id="">Post</button>
<button class="btn btn-danger" data-dismiss="modal" style="padding-left:5px" type="submit">Close</button>
</div>
</div>
</form>
</div></div>

