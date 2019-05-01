

<?php

session_start();

$staffname = $_SESSION['staffname'];
	$bcode = $_SESSION['branchcode'];
	$ccode = $_SESSION['companycode'];
    
    $pay_status = 'FER';
		
    require_once("controller_lib.php");
	
    $ivfobj = new IVF;

header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');

$time = date('r');
echo "data:(".$ivfobj->ivf_donor_count()['count'].")\n\n";
//echo "data: {$ivfobj->existing_ivf_count()['count']}\n\n";
//echo "data2:(".$ivfobj->ivf_waiting_count($pay_status,$bcode,$ccode)['count'].")\n\n";



flush();
?>



