
<?php

session_start();

$staffname = $_SESSION['staffname'];
	$bcode = $_SESSION['branchcode'];
	$ccode = $_SESSION['companycode'];
    
    $status = 'referral';
		
    require_once("controller_lib.php");
	
    $ivfobj = new IVF;

header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');

$time = date('r');
echo "data:(".$ivfobj->referral_list_count($status,$bcode,$ccode)['count'].")\n\n";
//echo "data: {$ivfobj->existing_ivf_count()['count']}\n\n";

flush();
?>



