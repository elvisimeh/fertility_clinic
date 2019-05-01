<?php
session_start();
$staffname = $_SESSION['staffname'];
if(!isset($staffname)){
	header("location:../../index");
	session_destroy();
	exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Fertility Centre</title>
    <link rel="stylesheet" href="../../assets/hms-css/bootstrap.min.css">
    <link href="../../assets/css/hms-styles.css" rel="stylesheet" type="text/css">
    <link href="../../assets/css/select2.css" rel="stylesheet" type="text/css">
    <script>

function frontdesk_posting(m){
    $('#router').load('fd_posting_ivf');
        }
        
function existing_fert(){
    $('#router').load('existing_fert_pat');
}

function donor_list(){
    $('#router').load('ivf_donor_list');
}

function referral_list(){
    $('#router').load('referral_list');
}

function check_acc(){
    $('#router').load('check_ivf_acc');
}

function ivf_counsel(){
    $('#router').load('ivf_counselling_list');
}
        
</script>
</head>

<style>
a{
    cursor:pointer;
}

body {
padding-right: 0px !important;
}

</style>

<body id="router">
<?php include("../_includes/hms-header.php");?>
    
<?php include("frontpage.php"); ?>




</body>
 <script src="../../assets/hms-js/jquery-1.11.1.min.js"></script>
  <script src="../../assets/hms-js/bootstrap.min.js"></script>
  <script src="../../assets/hms-js/jquery.backstretch.min.js"></script> 
<script type="text/javascript" src="addjs.js"></script>

<script>

if(typeof(EventSource) !== "undefined") {
  var source = new EventSource("data_existing.php");
 // var source2 = new EventSource("data_fd.php")
  source.onmessage = function(event) {
    document.getElementById("result1").innerHTML = event.data + "<br>";
    document.getElementById("result2").innerHTML = event.data + "<br>";
  };
} else {
  document.getElementById("result1").innerHTML = "Sorry, your browser does not support server-sent events...";
}

var source = new EventSource("data_fd.php");
  source.onmessage = function(event) {
    document.getElementById("result3").innerHTML = event.data + "<br>";
    document.getElementById("result4").innerHTML = event.data + "<br>";
  }

  var source = new EventSource("data_referral.php");
  source.onmessage = function(event) {
    document.getElementById("result5").innerHTML = event.data + "<br>";
    document.getElementById("result6").innerHTML = event.data + "<br>";
  }

  var source = new EventSource("data_donor.php");
  source.onmessage = function(event) {
    document.getElementById("result7").innerHTML = event.data + "<br>";
    document.getElementById("result8").innerHTML = event.data + "<br>";
  }

  // No back
  $(document).ready(function($) {

if (window.history && window.history.pushState) {

  window.history.pushState('forward', null, './#fwd');

  $(window).on('popstate', function() {
    window.location.replace('index.php');
  });

}
});

</script>

</html>