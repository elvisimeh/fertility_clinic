<?php

session_start();

$staffname = $_SESSION['staffname'];
	$bcode = $_SESSION['branchcode'];
	$ccode = $_SESSION['companycode'];
    
    $pay_status = 'FER';
		
    require_once("controller_lib.php");
	
    $ivfobj = new IVF;

    $existing_ivf_pats = $ivfobj->existing_ivf_pat();

header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');

$time = date('r');
$sn=0;

echo "data:".



//. "data:(".$ivfobj->existing_ivf_pat().")\n\n";
//. "data: {$ivfobj->existing_ivf_count()['count']}\n\n";
//. "data2:(".$ivfobj->ivf_waiting_count($pay_status,$bcode,$ccode)['count'].")\n\n";

'<thead>
<tr>
    <th width="4%">SN</th>
    <th width="6%">Date Registered</th>
    <th width="6%">Time Registered</th>
    <th width="6%">PRN</th>
    <th width="11%">Patient Name</th>
    <th width="9%">Category</th>
    <!--<th width="10%">Visiting Unit</th>-->
    <th width="8%">Gender</th>
    <th width="8%"> Status</th>
    <th width="8%">DOB</th>
    <th width="7%">Age</th>
    <th width="11%">Mobile</th>
    <th width="12%">Registered By</th>
    
    
   
</tr>
</thead>
<tbody>'
.
    
foreach($existing_ivf_pats as $existing_ivf_pat){
 $d1 = date_create(date('Y-m-d')); $d2 = date_create($existing_ivf_pat['dob']); $age = date_diff($d1,$d2);
  //  if($ivf_waiting_list['specialty'] == 'Physiotherapist'  && ($ivf_waiting_list['payment_status']=='PAY LATER' || $ivf_waiting_list['payment_status']=='PAID')){
    $sn = $sn + 1;
    . '<tr>'.
    . '<td>'.$sn.'</td>'.
    . '<td>'.$existing_ivf_pat['date'].'</td>'.
    . '<td>'.$existing_ivf_pat['time'].'</td>'.
    . '<td>';
    
  /*  . "<form action='open_consult.php' method='post' id='open_consult'>
    
    <input name='id' type='hidden' value='$physio_waiting_list[id]'>
    <input name='vsn' type='hidden' value='$physio_waiting_list[visitno]'>
    <input name='prn' type='hidden' value='$physio_waiting_list[prn]'>
    <input name='prn' type='submit' class='btn btn-success' value='$physio_waiting_list[prn]' style='width:9em !important'>

    </form>";
    */
    
    //. "<a href=\"consultation?prn=$ivf_waiting_list[prn]&id=$ivf_waiting_list[id]&vsn=$ivf_waiting_list[visitno]\">";
   // . "<a href=\"parse-prn-consultation?prn=$row[prn]&id=$row[id]&vsn=$row[visitno]\">";
   . "<button type='button' class='btn btn-success' onclick='patient_file(this)' id=$existing_ivf_pat[prn] data-id=$existing_ivf_pat[id] data-ivfno=$existing_ivf_pat[ivf_no]>$existing_ivf_pat[prn]</button>".
    //. "</a>";
    . '</td>';
    . '<td>'.$existing_ivf_pat['fullname'].'</td>'.
    . '<td>'.$existing_ivf_pat['category'].'</td>'.
    //. '<td>'.$existing_ivf_pat['specialty'].'</td>';
    . '<td>'.$existing_ivf_pat['gender'].'</td>'.
    . '<td>'.$existing_ivf_pat['marital_status'].'</td>'.
    . '<td>'.$existing_ivf_pat['dob'].'</td>'.
    . '<td>'.$age->y.'yr(s)'.$age->m.'mnth'.$age->d.'days'.'</td>'.
    . '<td>'.$existing_ivf_pat['phoneno'].'</td>'.
    . '<td>'.$existing_ivf_pat['staffname'].'</td>'.
   
    . '</tr>'.
// }
'}

</tbody>'


flush();
?>