
<?php
session_start();
$bcode = $_SESSION['branchcode'];
$ccode = $_SESSION['companycode'];

require_once("controller_lib.php");

$obj = new IVF;

$fer = $obj->ivf_pattype()['id'];

$pharm_lists = $obj->pharmacy_items_for_ivf($bcode,$ccode,$fer);

//var_dump($pharm_lists);
?>

<table class="table table-hover table-bordered table-condensed" style="font-size:12px;">
                                    <thead>
                                        <tr>
                                            <th>SN</th>
                                            <th>Date</th>
                                            <th>PRN</th>
                                            <th>Patient Name</th>
                                            <!--<th>Category</th>-->
											<!--<th>QMS No.</th>-->
                                            <!--<th>Sponsor</th>-->
                                            <th>Posted By</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
										$snop = 0;
                                            foreach($pharm_lists as $pharm_list){
                                                echo '<tr>';
                                                $snop = $snop + 1;
                                                echo '<td>'.$snop.'</td>';
                                                echo '<td>'.$pharm_list['pdate'].'</td>';
                                                echo '<td align="center">';
												echo "<a href=\"parse-fert-cons-info?vsn=".$pharm_list['visit_number']."&prn=".$pharm_list['prn']."&wtr=".$pharm_list['wtrack']."\" class='btn bg-green-gradient'>";
												echo $pharm_list['prn'];
												echo '</td>';
                                                echo '<td>'.$pharm_list['fullname'].'</td>';
												//echo '<td>'.$pharm_list['category'].'</td>';
												
												//echo '<td style="font-weight:bold">';
												//$patientObj->qms($row['visit_number'])->fetch(PDO::FETCH_ASSOC)['qms'];
												//echo '</td>';
												/*
												echo '<td>';
												if($pharm_list['sponsorid']=='0'){
													echo $pharm_list['fullname'];
												}else{
													echo $pharm_list['corporate_name'];
												}
												echo '</td>';
                                            	*/
                                                echo '<td>'.$pharm_list['staffname'].'</td>';
                                               
                                               
                                                
                                                echo '</tr>';
                                            }
                                        ?>
                                        
                                    </tbody>
                                </table>