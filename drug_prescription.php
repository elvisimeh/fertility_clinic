<div class="modal-dialogue" style="display:block; overflow-y: auto">
<div class="modal-content"></div>
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h4 class="modal-title" style="text-align:center">Add Pharmacy Item</h4>

</div>

<div class="modal-body" style="background-color:white; overflow-y: auto !important;">


<ul class="nav nav-tabs">
<li id="tab-cap"><a href="#" data-toggle="tab">Tablets/Capsules</a></li>
<li id="liquid"><a href="#liquid" data-toggle="tab">Liquid</a></li>
<li id="consumables"><a href="#" data-toggle="tab">Consumables</a></li>
</ul>
<div id="success_messg" style="display:none;color:green; text-align:center">Drug Added successfully</div>

<?php if($patient_details['donor'] !='donor'){?>
<div style="background-color:#8ED2B1" class="balance"> 
 <?php include('balance.php') ?> 
 </div>
<?php } ?> 
<form action="controller_post_tab.php" method="POST" id="tablets" name="posttab" class="drug_tablet">
<h4 style="color:black"> Tablets/Capsules </h4>

<table class="table tsizelarge"> 
<thead>
<th colspan=6 style="background-color:#0073b7;color:white">Prescription One</th>
</thead>
<tbody style="color:#247">
<tr>
<td width="30%"><label for="">Select Drug:</label>

<select class="searchable getcost1" name="tab1" id="tab1" style="width:240px !important">
    <option value="" selected disabled>Type Drug Name</option>
<?php
foreach ($tab_drugs as $tab_drug) {
?>
<option list="drugs" value="<?php echo $tab_drug['itemname_id'];
?>" data-price="<?php echo floatval(preg_replace('/[^\d\.]+/','', $tab_drug['unitsales'])) ?>"><?php echo $tab_drug['itemname']?></option>
<?php } ?>

</select>
</td>
<td width="7%"><label for="">Dosage:</label>
<input type="number" name="dosage1" id="dosage1" class="form-control remove-control getcost1">
</td>
<td><label for="">Frequency:</label>
<select name="freq1" id="freq1" class="form-control getcost1">
    <option value="" disabled selected>Select</option>
    <option value="1">Alternate days</option>
    <option value="2">Bd</option>
    <option value="1">Dly</option>
    <option value="1">Mane</option>
    <option value="1">Nocte</option>
    <option value="1">STAT</option>
    <option value="3">Tds</option>
    <option value="2">Twice Weekly</option>
</select>

</td>
<td width="7%"><label for="">Duration:</label>
<input type="number" name="dur1" id="dur1" class="form-control remove-control getcost1">
</td>
<td width="9%"><label for="">Qty:</label>
<input type="number" name="qty1" value="" id="qty1" class="form-control remove-control getcost1" readonly>
</td>
<td><label for="">Route:</label>
<select name="route1" id="route1" class="form-control getcost1">
    <option value="" selected disabled>Select</option>
    <option value="ORAL">Oral</option>
    <option value="RECTAL">Rectal</option>
    <option value="VAGINAL">Vaginal</option>
    <option value="OCULAR">Ocular</option>
    <option value="NASAL">Nasal</option>
    <option value="INHALATION">Inhalation</option>
    <option value="TRANSDERMAL">Transdermal</option>
    <option value="IV">IV</option>
    <option value="IM">IM</option>
    <option value="SC">SC</option>
    <option value="INTRATHECAL">INTRATHECAL</option>
    <option value="TOPICAL">TOPICAL</option>
</select>

</td>
</tr>
<tr>
<td colspan="6"><label for="">Doctor's Instruction:</label>
<input type="text" name="physio_instruct1" id="physio_instruct1" class="form-control getcost1">
</td>
</tr>
</tbody>
</table>

<table class="table tsizelarge">
<thead>
<th colspan=6 style="background-color:#0073b7;color:white">Prescription Two</th>
</thead>
<tbody style="color:#247">
<tr>
<td width="30%"><label for="">Select Drug:</label>

<select class="searchable getcost2" name="tab2" id="tab2" style="width:240px !important">
    <option value="" selected disabled>Type Drug Name</option>
<?php
foreach ($tab_drugs as $tab_drug) {
?>
<option list="drugs" value="<?php echo $tab_drug['itemname_id'];?>" data-price="<?php echo floatval(preg_replace('/[^\d\.]+/','', $tab_drug['unitsales'])) ?>">
<?php echo $tab_drug['itemname']?></option>
<?php } ?>

</select>
</td>
<td width="7%"><label for="">Dosage:</label>
<input type="number" name="dosage2" id="dosage2" class="form-control remove-control getcost2">
</td>
<td><label for="">Frequency:</label>
<select name="freq2" id="freq2" class="form-control">
    <option value="1" disabled selected>Select</option>
    <option value="2">Alternate days</option>
    <option value="1">Bd</option>
    <option value="1">Dly</option>
    <option value="1">Mane</option>
    <option value="1">Nocte</option>
    <option value="1">STAT</option>
    <option value="3">Tds</option>
    <option value="2">Twice Weekly</option>
</select>
</td>
<td width="7%"><label for="">Duration:</label>
<input type="number" name="dur2" id="dur2" class="form-control remove-control getcost2">
</td>
<td width="9%"><label for="">Qty:</label>
<input type="number" name="qty2" id="qty2" class="form-control remove-control" readonly>
</td>
<td><label for="">Route:</label>
<select name="route2" id="route2" class="form-control getcost2">
    <option value="" selected disabled>Select</option>
    <option value="ORAL">Oral</option>
    <option value="RECTAL">Rectal</option>
    <option value="VAGINAL">Vaginal</option>
    <option value="OCULAR">Ocular</option>
    <option value="NASAL">Nasal</option>
    <option value="INHALATION">Inhalation</option>
    <option value="TRANSDERMAL">Transdermal</option>
    <option value="IV">IV</option>
    <option value="IM">IM</option>
    <option value="SC">SC</option>
    <option value="INTRATHECAL">INTRATHECAL</option>
    <option value="TOPICAL">TOPICAL</option>
</select>

</td>
</tr>
<tr>
<td colspan="6"><label for="">Doctor's Instruction:</label>
<input type="text" name="physio_instruct2" id="physio_instruct2" class="form-control getcost2">
</td>
</tr>

</tbody>

</table>
<input type="hidden" name="prn" value="<?php echo $prn ?>" id="">
<input type="hidden" name="ptdate" value="<?php echo date('Y-m-d'); ?>" id="">
<input type="hidden" name="pttime" value="<?php echo date("h:i:sa"); ?>" id="">
<input type="hidden" name="sponsorid" value="<?php echo $patient_details['sponsor']; ?>" id="">
<input type="hidden" name="bcode" value="<?php echo $bcode ?>" id="">
<input type="hidden" name="ccode" value="<?php echo $ccode ?>" id="">
<input type="hidden" name="type" value="tab" id="">
<input type="hidden" name="pat_cat" value="<?php echo $patient_details['cat'] ?>" id="">
<input type="hidden" name="dept" value="<?php echo $fert_dept ?>" id="">
<input type="hidden" name="specialty_id" value="<?php echo $spec ?>" id="">


<input type="hidden" name="staffname" value="<?php echo $_SESSION['id']; ?>" id="">
<input type="hidden" name="status" value="NOT DISPENSED" id="">
<input type="hidden" name="age" value="<?php echo $patient_details['age']; ?>" id="">


<input type="hidden" name="ivfno" value="<?php echo $ivfno ?>">
<input type="hidden" name="vsn" value="<?php echo $vsn ?>">
<div style="display:block; margin: auto">
<button type="submit" class="btn btn-primary add-drug" style="">Post</button>

<button class="btn btn-danger" data-dismiss="modal" style="margin-left:5%" type="submit">Close</button>
    </div>
</form>




<form action="controller_post_liq.php" method="POST" id="liquid1" class="drug_liquid">
   
<h4 style="color:black"> Liquid </h4>

<table class="table tsizelarge"> 
<thead>
<th colspan=6 style="background-color:#0073b7;color:white">Prescription One</th>
</thead>
<tbody style="color:#247">
<tr>
<td width="30%"><label for="">Select Drug:</label>

<select class="searchable getcost3" name="liq1" id="liq1" style="width:280px !important">
    <option value="" selected disabled>Type Drug Name</option>
<?php
foreach ($liq_drugs as $liq_drug) {
?>
<option list="drugs" value="<?php echo $liq_drug['itemname_id']?>" data-price="<?php echo floatval(preg_replace('/[^\d\.]+/','', $liq_drug['unitsales'])) ?>">
<?php echo $liq_drug['itemname']?></option>
<?php } ?>

</select>
</td>
<td>
</td>
<td>
</td>
<td>
</td>
<td><label for="">Qty:</label>
<input type="number" name="qty_liq1" value="" id="qty_liq1" class="form-control remove-control getcost3">
</td>
<td><label for="">Route:</label>
<select name="route_liq1" id="route_liq1" class="form-control getcost3">
    <option value="" selected disabled>Select</option>
    <option value="ORAL">Oral</option>
    <option value="RECTAL">Rectal</option>
    <option value="VAGINAL">Vaginal</option>
    <option value="OCULAR">Ocular</option>
    <option value="NASAL">Nasal</option>
    <option value="INHALATION">Inhalation</option>
    <option value="TRANSDERMAL">Transdermal</option>
    <option value="IV">IV</option>
    <option value="IM">IM</option>
    <option value="SC">SC</option>
    <option value="INTRATHECAL">INTRATHECAL</option>
    <option value="TOPICAL">TOPICAL</option>
</select>

</td>
</tr>
<tr>
<td colspan="6"><label for="">Doctor's Instruction:</label>
<input type="text" name="physio_instruct_liq1" id="physio_instruct_liq1" class="form-control getcost3">
</td>
</tr>
</tbody>
</table>

<table class="table tsizelarge"> 
<thead>
<th colspan=6 style="background-color:#0073b7;color:white">Prescription Two</th>
</thead>
<tbody style="color:#247">
<tr>
<td width="30%"><label for="">Select Drug:</label>

<select class="searchable getcost4" name="liq2" id="liq2" style="width:280px !important">
    <option value="" selected disabled>Type Drug Name</option>
<?php
foreach ($liq_drugs as $liq_drug) {
?>
<option list="drugs" value="<?php echo $liq_drug['itemname_id']?>" data-price="<?php echo floatval(preg_replace('/[^\d\.]+/','', $liq_drug['unitsales'])) ?>">
<?php echo $liq_drug['itemname']?></option>
<?php } ?>

</select>
</td>
<td>
</td>
<td>
</td>
<td>
</td>
<td><label for="">Qty:</label>
<input type="number" name="qty_liq2" value="" id="qty_liq2" class="form-control remove-control getcost4">
</td>
<td><label for="">Route:</label>
<select name="route_liq2" id="route_liq2" class="form-control getcost4">
    <option value="" selected disabled>Select</option>
    <option value="ORAL">Oral</option>
    <option value="RECTAL">Rectal</option>
    <option value="VAGINAL">Vaginal</option>
    <option value="OCULAR">Ocular</option>
    <option value="NASAL">Nasal</option>
    <option value="INHALATION">Inhalation</option>
    <option value="TRANSDERMAL">Transdermal</option>
    <option value="IV">IV</option>
    <option value="IM">IM</option>
    <option value="SC">SC</option>
    <option value="INTRATHECAL">INTRATHECAL</option>
    <option value="TOPICAL">TOPICAL</option>
</select>

</td>
</tr>
<tr>
<td colspan="6"><label for="">Doctor's Instruction:</label>
<input type="text" name="physio_instruct_liq2" id="physio_instruct_liq2" class="form-control getcost4">
</td>
</tr>
</tbody>
</table>



<input type="hidden" name="prn" value="<?php echo $prn ?>" id="">
<input type="hidden" name="ptdate" value="<?php echo date('Y-m-d'); ?>" id="">
<input type="hidden" name="pttime" value="<?php echo date("h:i:sa"); ?>" id="">
<input type="hidden" name="sponsorid" value="<?php echo $patient_details['sponsor']; ?>" id="">
<input type="hidden" name="bcode" value="<?php echo $bcode ?>" id="">
<input type="hidden" name="ccode" value="<?php echo $ccode ?>" id="">
<input type="hidden" name="type" value="liq" id="">


<input type="hidden" name="staffname" value="<?php echo $_SESSION['id']; ?>" id="">
<input type="hidden" name="status" value="NOT DISPENSED" id="">
<input type="hidden" name="dept" value="<?php echo $fert_dept ?>" id="">
<input type="hidden" name="specialty_id" value="<?php echo $spec ?>" id="">


<input type="hidden" name="ivfno" value="<?php echo $ivfno ?>">
<input type="hidden" name="vsn" value="<?php echo $vsn ?>">
<input type="hidden" name="pat_cat" value="<?php echo $patient_details['cat'] ?>" id="">
<input type="hidden" name="age" value="<?php echo $patient_details['age']; ?>" id="">

<button type="submit" class="btn btn-primary add-drug">Post</button>

<button class="btn btn-danger" data-dismiss="modal" style="margin-left:5%">Close</button>


</form>
    


<form action="controller_post_con.php" method="POST" id="consumables1" class="drug_consumables">
<h4 style="color:black"> Consumables </h4>

<table class="table tsizelarge"> 
<thead>
<th colspan=6 style="background-color:#0073b7;color:white">Prescription One</th>
</thead>
<tbody style="color:#247">
<tr>
<td width="30%"><label for="">Select Drug:</label>

<select class="searchable getcost5" name="con1" id="con1" style="width:300px !important">
    <option value="" selected disabled>Type Drug Name</option>
<?php
foreach ($con_drugs as $con_drug) {
?>
<option list="drugs" value="<?php echo $con_drug['itemname_id'];?>" data-price="<?php echo floatval(preg_replace('/[^\d\.]+/','', $con_drug['unitsales'])) ?>">
<?php echo $con_drug['itemname']?></option>
<?php } ?>

</select>
</td>
<td></td>
<td>
</td>
<td>
</td>
<td><label for="">Qty:</label>
<input type="number" name="qty_con1" value="" id="qty_con1" class="form-control remove-control getcost5">
</td>
<td>
</td>
</tr>
<tr>
<td colspan="6"><label for="">Doctor's Instruction:</label>
<input type="text" name="physio_instruct_con1" id="physio_instruct_con1" class="form-control getcost5">
</td>
</tr>
</tbody>
</table>

<table class="table tsizelarge"> 
<thead>
<th colspan=6 style="background-color:#0073b7;color:white">Prescription Two</th>
</thead>
<tbody style="color:#247">
<tr>
<td width="30%"><label for="">Select Drug:</label>

<select class="searchable getcost6" name="con2" id="con2" style="width:300px !important">
    <option value="" selected disabled>Type Drug Name</option>
<?php
foreach ($con_drugs as $con_drug) {
?>
<option list="drugs" value="<?php echo $con_drug['itemname_id']?>" data-price="<?php echo floatval(preg_replace('/[^\d\.]+/','', $con_drug['unitsales'])) ?>">
<?php echo $con_drug['itemname']?></option>
<?php } ?>

</select>
</td>
<td></td>
<td>
</td>
<td>
</td>
<td><label for="">Qty:</label>
<input type="number" name="qty_con2" value="" id="qty_con2" class="form-control remove-control getcost6">
</td>
<td>
</td>
</tr>
<tr>
<td colspan="6"><label for="">Doctor's Instruction:</label>
<input type="text" name="physio_instruct_con2" id="physio_instruct_con2" class="form-control getcost6">
</td>
</tr>
</tbody>
</table>




<input type="hidden" name="prn" value="<?php echo $prn ?>" id="">
<input type="hidden" name="ptdate" value="<?php echo date('Y-m-d'); ?>" id="">
<input type="hidden" name="pttime" value="<?php echo date("h:i:sa"); ?>" id="">
<input type="hidden" name="sponsorid" value="<?php echo $patient_details['sponsor']; ?>" id="">
<input type="hidden" name="bcode" value="<?php echo $bcode ?>" id="">
<input type="hidden" name="ccode" value="<?php echo $ccode ?>" id="">
<input type="hidden" name="type" value="liq" id="">


<input type="hidden" name="staffname" value="<?php echo $_SESSION['id']; ?>" id="">
<input type="hidden" name="status" value="NOT DISPENSED" id="">


<input type="hidden" name="ivfno" value="<?php echo $ivfno ?>">
<input type="hidden" name="vsn" value="<?php echo $vsn ?>">
<input type="hidden" name="pat_cat" value="<?php echo $patient_details['cat'] ?>" id="">
<input type="hidden" name="age" value="<?php echo $patient_details['age']; ?>" id="">
<input type="hidden" name="dept" value="<?php echo $fert_dept ?>" id="">
<input type="hidden" name="specialty_id" value="<?php echo $spec ?>" id="">


<button type="submit" class="btn btn-primary add-drug">Post</button>

<button class="btn btn-danger" data-dismiss="modal" style="margin-left:5%">Close</button>
 
</form>

</div>
</div>

