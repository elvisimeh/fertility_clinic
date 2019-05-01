<?php

require_once("controller_lib.php");

$obj = new IVF;

$id = $_GET['id'];

$counsel = $obj->get_counsel($id);



?>

<div class="modal-header">
<button type="button" class="close" id="cc" data-dismiss="modal">&times;</button>
<h4 class="modal-title" style="text-align:center">Counselling Note Entry Form (Edit)</h4>

</div>
<div class="modal-body" style="background-color:white;">
<div id="success_messg_first" style="display:none;color:green; text-align:center">Counselling Note Saved successfully</div>

<form action="controller_update_counsel.php" method='POST' id="ivf_counselling_update">


<div class="form-row">
    <div class="col-md-6">
<label for="">Client Name</label>
<input type="text" class="form-control" name="name" value="<?php echo $counsel['name'] ?>" id="" required>
</div>

<div class="col-md-6">
<label for="">DOB</label>
<input type="date" class="form-control" name="dob" id="" value="<?php echo $counsel['dob'] ?>" required>
</div></div>


<div class="form-row">
    <div class="col-md-6">
<label for="">Address</label>
<input type="text" class="form-control" name="address" id="" value="<?php echo $counsel['address'] ?>" required>
</div>

<div class="col-md-6">
<label for="">Complexion</label>
<input type="text" class="form-control" name="complexion" id="" value="<?php echo $counsel['complexion'] ?>" required>
</div></div>

<div class="form-row">
    <div class="col-md-6">
<label for="">Antra Follicular Count</label>
<input type="text" class="form-control" name="afc" id="" value="<?php echo $counsel['afc'] ?>" required>
</div>

<div class="col-md-6">
<label for="">LMP</label>
<input type="text" class="form-control" name="lmp" id="" value="<?php echo $counsel['lmp'] ?>" required>
</div></div>

<div class="form-row">
    <div class="col-md-6">
<label for="">Blood Group</label>
<input type="text" class="form-control" name="blood_group" id="" value="<?php echo $counsel['blood_group']; ?>" required>
</div>

<div class="col-md-6">
<label for="">Wife's Phone</label>
<input type="text" class="form-control" name="w_phone" id="" value="<?php echo $counsel['w_no'] ?>" required>
</div></div>

<div class="form-row">
    <div class="col-md-6">
<label for="">Husband's Phone</label>
<input type="text" class="form-control" name="h_phone" id="" value="<?php echo $counsel['h_no'] ?>" required>
</div>

<div class="col-md-6">
<label for="">Email</label>
<input type="email" class="form-control" name="email" id="" value="<?php echo $counsel['email'] ?>" required>
</div></div>

<div class="form-row">
    <div class="col-md-6">
<label for="">Referral</label>
<input type="text" class="form-control" name="referral" id="" value="<?php echo $counsel['referral'] ?>" required>
</div>

<div class="col-md-6">
<label for="">Client Type</label>
<select name="type" class="form-control" id="" required>
    <option value="SELF" <?php echo ($counsel['client_type'] == 'SELF' ? 'selected':'') ?>>SELF</option>
    <option value="DONOR" <?php echo ($counsel['client_type'] == 'DONOR' ? 'selected':'') ?>>DONOR</option>
    <option value="SURROGATE" <?php echo ($counsel['client_type'] == 'SURROGATE' ? 'selected':'') ?>>SURROGATE</option>
</select>
</div></div>

<div class="form-row">
    <div class="col-md-6">
<label for="">No. of Children</label>
<input type="text" class="form-control" name="noc" id="" value="<?php echo $counsel['no_of_children'] ?>" required>
</div>

<div class="col-md-6">
<label for="">Sign</label>
<input type="text" class="form-control" name="sign" value="<?php echo $counsel['sign'] ?>" id="" required>
</div></div>



<input type="hidden" name="bcode" value="<?php echo $_SESSION['branchcode'] ?>" id="">

<input type="hidden" name="ccode" value="<?php echo $_SESSION['companycode'] ?>" id="">
<input type="hidden" name="by" value="<?php echo $_SESSION['id'] ?>" id="">

<input type="hidden" name="id" value="<?php echo $_GET['id'] ?>" id="">


    <input type="button" value="Delete" data-dismiss="modal" class="btn btn-danger" style="margin-top:2%; margin-left:2%" onClick="delete_counsel('<?php echo $_GET['id'] ?>')">


<input type="submit" class="btn btn-success pull-right" value="Save" name="Save" id="save" style="margin-top:2%; margin-right:2%">

</form>


</div>

<script>
$( "#ivf_counselling_update" ).submit(function( event ) {
      event.preventDefault();      
    console.log( $( this ).serialize() );
    var post_url = $('#ivf_counselling_update').attr('action');
    var form_data = $( this ).serialize();
    $.ajax({
      type: "POST",
      url: post_url,
      data: form_data,
      //dataType: 'html',
      success: function(data){  
              
         $('#success_messg_first').show();
         $('#ivf_counselling_update').trigger('reset');
         setTimeout(function () { 
         $('#success_messg_first').hide(); 
        }, 5000);   
         $('#load_counsel_list').load('ivf_load_counsel_list.php');
         $('#edit').attr('data-dismiss','modal');
         $('#edit').click();         
      }
    });
      //.done(function(data) {
      //    console.log(post_url); 
   //});
    
  });

  function delete_counsel(id){
    var conf= confirm("Are you sure you want to Add This Record?" );
   if (conf==true){

      $.post('controller_delete_counsel.php',{
          id : id
      });
      
      setTimeout(function () { 
        $('#load_counsel_list').load('ivf_load_counsel_list.php'); 
        }, 2000);
       
     // $('#router').load('ivf_counselling_list');
    }
  }

</script>