<?php

session_start();
	$staffname = $_SESSION['staffname'];
	
	if(!isset($staffname)){
		header("location:../../index");
		unset($_SESSION['dprn'],$_SESSION['dfname'],$_SESSION['ddept'],$_SESSION['dnextduedate']);
		exit;
    }

    require_once("controller_lib.php");
	
    $ivfobj = new IVF;

    $bcode = $_SESSION['branchcode'];
    $ccode = $_SESSION['companycode'];

$prn = $_GET['prn'];

 $lab = 'LABORATORY';
 $lab_invs = $ivfobj->lab_services($lab,$bcode,$ccode);

 $posted_invs = $ivfobj->load_service_prn($prn,$lab);

 $patient_details = $ivfobj->pat_name_prn($prn);

?>



<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h4 class="modal-title" style="text-align:center"><?php echo $ivfobj->pat_name_prn($prn)['fullname'] ?></h4>

</div>
<div class="modal-body" style="background-color:white;">

<div id="success_messg_lab" style="display:none;color:green; text-align:center">Lab Investigation Ordered successfully</div>

    <div class="row">
 <div class="col-md-offset-2 col-md-8">
 <div style="background-color:#8ED2B1" class="balance"> 
 <?php //include('balance.php') ?> 
 </div> 
<form action="controller_post_lab_service.php" method="POST" class="" id="order_lab_inv">

<label for="">Lab Investigations:</label></div></div>

<div class="row">
    <div class="new_service">

    </div>
<div class="col-md-offset-2 col-md-8 old_service">
<select class="form-control searchable getcost7" name="service" id="lab_serv" style="width:100%" required>
<?php //foreach()?>
<option value="" data-price=<?php echo 0 ?> selected >Type to select Investigation</option>
<?php foreach ($lab_invs as $lab_inv){?>
<option value="<?php echo $lab_inv['id']?>" data-price=<?php echo floatval(preg_replace('/[^\d\.]+/','', $lab_inv['agreed_amt']))?>>
<?php echo $lab_inv['service_name'] ?></option>

<?php } ?>
</select>
<?php //var_dump($lab_invs) ?>
</div></div>
<br/>
<input type="hidden" name="prn" value="<?php echo $prn; ?>" id="prn">
<input type="hidden" name="ivfno" value="<?php echo $ivfobj->get_donor_details($prn)['visitno']; ?>" id="ivfno">
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


<div class="col-md-offset-2 col-md-7">

</div>

    <div class="" style="display:block; margin-right:0; margin-bottom:5%">
<button type="submit" class="btn btn-primary add-service" style="" id="">Post</button>
<!--<button class="btn btn-danger" data-dismiss="modal" style="padding-left:5px" type="submit">Close</button>-->

</div>
</form>

<div class="table-responsive" id="all-inv">

<table class="table table-bordered">
<thead class="bg-primary">
    <th>SN</th>
    <th>Date</th>
    <th>Time</th>
    <th>Investigation</th>
    <th>Posted By</th>
    <th>Status</th>
    <th></th>
</thead>
<tbody>
    <?php $sn=1; foreach($posted_invs as $posted_inv){?>
    <tr>
        <td><?php echo $sn++ ?></td>
        <td><?php echo $posted_inv['orderdate'] ?></td>
        <td><?php echo $posted_inv['ordertime'] ?></td>
        <td><?php echo $posted_inv['service_name'] ?></td>
        <td><?php echo $posted_inv['staffname'] ?></td>
        <td><?php echo $posted_inv['status'] ?></td>
        <td>
        <?php  if($posted_inv['status']=="NOT DONE"){?>
    <span onclick="delete_service(this)" id=<?php echo $posted_inv['id'] ?> data-prn="<?php echo $prn ?>" style="color:#D9534F; font-weight:bold;cursor:pointer;" class="glyphicon glyphicon-remove-circle"></span>&nbsp;
    <?php } 
    else { ?>
    <a onclick="load_inv_result(<?php echo $posted_inv['id']?>)" href="lab_result?id=<?php echo $posted_inv['id'] ?>" class="btn btn-success" data-target="#lab_results" data-toggle="modal">View result</a>
   <?php }
    ?>
        </td>
        
    </tr>
    <?php } ?>
</tbody>

</table>


</div>

<script src="../../assets/js/select2.js"></script>  


  <script>

$('.searchable').select2();

$('.add-service').click(function(){
    var service = $('#lab_serv').val();
    var prn = $('#prn').val();
    var age = $('#age').val();
    var category = $('#category').val();
    var sponsor = $('#sponsor').val();
    var plan = $('#plan').val();
    var by = $('#by').val();
    var ivfno = $('#ivfno').val();
    var bcode = $('#bcode').val();
    var ccode = $('#ccode').val();
    var specialty_id = $('#specialty_id').val();
    var donor = 1;
    //alert(service);
    var conf= confirm("Are you sure you want to Post Investigation?" );
   if (conf==true){
    $.post('controller_post_donor_lab.php',{
        service : service,
        prn : prn,
        age : age,
        category : category,
        sponsor : sponsor,
        plan : plan,
        by : by,
        ivfno : ivfno,
        bcode : bcode,
        ccode : ccode,
        specialty_id : specialty_id,
        donor : donor
    },
    function(data){
        if(data=='success'){
            $('#order_lab_inv').trigger('reset');        
         $('#success_messg_lab').show();
         setTimeout(function () { 
         $('#success_messg_lab').hide(); 
        }, 2000); 
        $('#all-inv').load('donor_lab?prn='+prn);
        
        $('.balance').load('balance?prn='+$('#prn').val());
        
        }
        else{
            $('#order_lab_inv').trigger('reset');        
         $('#success_messg_lab').show();
         setTimeout(function () { 
         $('#success_messg_lab').hide(); 
        }, 2000); 
        $('#all-inv').load('donor_lab?prn='+prn);
        }
  });
}
});

</script>

