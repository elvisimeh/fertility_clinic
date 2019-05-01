
<?php

session_start();
$staffname = $_SESSION['staffname'];
if(!isset($staffname)){
	header("location:../../index");
	session_destroy();
	exit;
}

require_once("controller_lib.php");

$ivfobj = new IVF;

$patients = $ivfobj->check_ivf_acc();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

<div style="width:100%;">
	<?php include("../_includes/hms-header.php");?>
    <div class="container" style="">
    <ul class="breadcrumb" style="margin-left:0%;">
<li><a href="index">Dashboard</a></li>

<li>Check Patient Account</li>
</ul></div>
  </div> 

<div class="container">
<div class="panel panel-primary">
    <div class="panel-heading">
        Enter Patient's name
    </div>
    <div class="panel-body">
<select class="searchable" name="" id="prn" style="width:100%">
<option value="" selected disabled>Enter Patient's Name</option>
<?php foreach($patients as $patient){?>
<option value="<?php echo $patient['prn'] ?>">
<?php echo $patient['fullname'] ?>
</option>
<?php } ?>
</select>
<input type="button" class="form-control btn btn-info" value="Get Details" name="" id="get_details" style="margin-top:2%;color:grey;font-weight:bold;font-size:1.2em">
</div></div>

<div id="account_details">


</div>

</body>
</html>




<script src="../../assets/js/select2.js"></script>

<script>

$('.searchable').select2({
  minimumInputLength: 3 // only start searching when the user has input 3 or more characters
  
});

$('#get_details').click(function(){
    var prn = $('#prn').val();
    $('#account_details').load('transaction_details?prn='+prn)
});

</script>