

<?php
	//session_start();
    /**Error reporting */
//error_reporting(E_ALL);
//ini_set('display_errors', 1);
/**End error reporting */
			
	
    require_once("controller_lib.php");
	
    $ivfobj = new IVF;
      
    
    
    $ivf_counsels = $ivfobj->ivf_counselling_list();
    //var_dump($ivf_counsels);
	
?>

<div class="panel panel-primary">
                                                <div class="panel panel-heading">
                                                    List of Counselled Patients
                                                </div>
                                                <div class="panel panel-body">
                                            <div class="table-responsive" style="max-height:400px">
                                                <table class="table table-bordered table-hover">
                                                     <thead>
                                                        
                                                        <th width="2%">SN</th>
                                                            <th width="5%">Date</th>
                                                            <th width="5%">Time</th>
                                                            
                                                            <th width="11%">Name</th>
                                                            <th width="6%">Age</th>
                                                            <!--<th width="10%">Visiting Unit</th>-->
                                                            <th width="8%">Address</th>
                                                            <th width="4%">Complexion</th>
                                                            <th width="6%">Antra Follicular Count</th>
                                                            <th width="5%">LMP</th>
                                                            <th width="5%">Blood Group</th>
                                                            <th width="12%">Wife Phone No.</th>
                                                            <th width="12%">Husband Phone No.</th>
                                                            <th width="8%">Email</th>
                                                            <th width="8%">Referral</th>
                                                            <th width="3%">No. Of Children</th>                                                          
                                                           
                                                                                                                        
                                                        
                                                    </thead>
                                                    <tbody id="tbody" style="margin-top:15%">
                                                    <?php
                                                            $sn=0;
                                                        foreach($ivf_counsels as $ivf_counsel){
                                                            if($ivf_counsel['client_type'] == 'SELF'){
                                                                $sn = $sn + 1;
                                                                echo '<tr>';
                                                                echo '<td>'.$sn.'</td>';
                                                                echo '<td>'.$ivf_counsel['date'].'</td>';
                                                                echo '<td>'.$ivf_counsel['time'].'</td>';
                                                                if($ivf_counsel['date'] >= date('Y-m-d')){
                                                                    echo '<td><element><a onClick="edit_counsel(\''.$ivf_counsel['id'].'\')" data-toggle="modal" data-target="#edit">'.$ivf_counsel['name'].'</a></element></td>'; 
                                                                }
                                                                else{
                                                                echo '<td><element>'.$ivf_counsel['name'].'</element></td>';
                                                                }
                                                                echo '<td>';
                                                                $d1 = date_create(date('Y-m-d')); $d2 = date_create($ivf_counsel['dob']); $age = date_diff($d1,$d2); echo $age->y.'yr(s)'.$age->m.'mnth'.$age->d.'days';
                                                                echo '</td>';
                                                                echo '<td>'.$ivf_counsel['address'].'</td>';
                                                                echo '<td>'.$ivf_counsel['complexion'].'</td>';
                                                                echo '<td>'.$ivf_counsel['afc'].'</td>';
                                                                echo '<td>'.$ivf_counsel['lmp'].'</td>';
                                                                echo '<td>'.$ivf_counsel['blood_group'].'</td>';
                                                                echo '<td>'.$ivf_counsel['w_no'].'</td>';
                                                                echo '<td>'.$ivf_counsel['h_no'].'</td>';
                                                                echo '<td>'.$ivf_counsel['email'].'</td>';
                                                                echo '<td>'.$ivf_counsel['referral'].'</td>';
                                                                echo '<td>'.$ivf_counsel['no_of_children'].'</td>';
                                                                
                                                               
                                                                echo '</tr>';
                                                        }
                                                        }
                                                    ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div></div>

                                        <div class="panel panel-primary">
                                                <div class="panel panel-heading">
                                                    List of Counselled Donors
                                                </div>
                                                <div class="panel panel-body">
                                            <div class="table-responsive" style="max-height:400px">
                                                <table class="table table-bordered table-hover">
                                                     <thead>
                                                        <tr>
                                                        <th width="4%">SN</th>
                                                            <th width="6%">Date</th>
                                                            <th width="6%">Time</th>
                                                            
                                                            <th width="11%">Name</th>
                                                            <th width="9%">Age</th>
                                                            <!--<th width="10%">Visiting Unit</th>-->
                                                            <th width="8%">Address</th>
                                                            <th width="8%">Complexion</th>
                                                            <th width="8%">Antra Follicular Count</th>
                                                            <th width="7%">LMP</th>
                                                            <th width="11%">Blood Group</th>
                                                            <th width="12%">Wife Phone No.</th>
                                                            <th width="12%">Husband Phone No.</th>
                                                            <th width="12%">Email</th>
                                                            <th width="12%">Referral</th>
                                                            <th width="12%">No. Of Children</th>                                                          
                                                            
                                                                                                                        
                                                            
                                                           
                                                        </tr>
                                                    </thead>
                                                    <tbody id="tbody">
                                                    <?php
                                                            $sn=0;
                                                        foreach($ivf_counsels as $ivf_counsel){
                                                            if($ivf_counsel['client_type'] == 'DONOR'){
                                                                $sn = $sn + 1;
                                                                echo '<tr>';
                                                                echo '<td>'.$sn.'</td>';
                                                                echo '<td>'.$ivf_counsel['date'].'</td>';
                                                                echo '<td>'.$ivf_counsel['time'].'</td>';
                                                                if($ivf_counsel['date'] >= date('Y-m-d')){
                                                                    echo '<td><element><a onClick="edit_counsel(\''.$ivf_counsel['id'].'\')" data-toggle="modal" data-target="#edit">'.$ivf_counsel['name'].'</a></element></td>'; 
                                                                }
                                                                else{                                                               
                                                                echo '<td><element>'.$ivf_counsel['name'].'</element></td>';
                                                                }
                                                                echo '<td>';
                                                                $d1 = date_create(date('Y-m-d')); $d2 = date_create($ivf_counsel['dob']); $age = date_diff($d1,$d2); echo $age->y.'yr(s)'.$age->m.'mnth'.$age->d.'days';
                                                                echo '</td>';
                                                                echo '<td>'.$ivf_counsel['address'].'</td>';
                                                                echo '<td>'.$ivf_counsel['complexion'].'</td>';
                                                                echo '<td>'.$ivf_counsel['afc'].'</td>';
                                                                echo '<td>'.$ivf_counsel['lmp'].'</td>';
                                                                echo '<td>'.$ivf_counsel['blood_group'].'</td>';
                                                                echo '<td>'.$ivf_counsel['w_no'].'</td>';
                                                                echo '<td>'.$ivf_counsel['h_no'].'</td>';
                                                                echo '<td>'.$ivf_counsel['email'].'</td>';
                                                                echo '<td>'.$ivf_counsel['referral'].'</td>';
                                                                echo '<td>'.$ivf_counsel['no_of_children'].'</td>';
                                                                
                                                               
                                                                echo '</tr>';
                                                        }
                                                        }
                                                    ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div></div>

                                        <div class="panel panel-primary">
                                                <div class="panel panel-heading">
                                                    List of Counselled Surrogates
                                                </div>
                                                <div class="panel panel-body">
                                            <div class="table-responsive" style="max-height:400px">
                                                <table class="table table-bordered table-hover">
                                                     <thead>
                                                        <tr>
                                                            <th width="4%">SN</th>
                                                            <th width="6%">Date</th>
                                                            <th width="6%">Time</th>
                                                            
                                                            <th width="11%">Name</th>
                                                            <th width="9%">Age</th>
                                                            <!--<th width="10%">Visiting Unit</th>-->
                                                            <th width="8%">Address</th>
                                                            <th width="8%">Complexion</th>
                                                            <th width="8%">Antra Follicular Count</th>
                                                            <th width="7%">LMP</th>
                                                            <th width="11%">Blood Group</th>
                                                            <th width="12%">Wife Phone No.</th>
                                                            <th width="12%">Husband Phone No.</th>
                                                            <th width="12%">Email</th>
                                                            <th width="12%">Referral</th>
                                                            <th width="12%">No. Of Children</th>                                                          
                                                            
                                                            
                                                           
                                                        </tr>
                                                    </thead>
                                                    <tbody id="tbody">
                                                    <?php
                                                            $sn=0;
                                                        foreach($ivf_counsels as $ivf_counsel){
                                                            if($ivf_counsel['client_type'] == 'SURROGATE'){
                                                            $sn = $sn + 1;
                                                            echo '<tr>';
                                                            echo '<td>'.$sn.'</td>';
                                                            echo '<td>'.$ivf_counsel['date'].'</td>';
															echo '<td>'.$ivf_counsel['time'].'</td>';
                                                            
                                                            if($ivf_counsel['date'] >= date('Y-m-d')){
                                                                echo '<td><element><a onClick="edit_counsel(\''.$ivf_counsel['id'].'\')" data-toggle="modal" data-target="#edit">'.$ivf_counsel['name'].'</a></element></td>'; 
                                                            }
                                                            else{
                                                            echo '<td><element>'.$ivf_counsel['name'].'</element></td>';
                                                            }
                                                            echo '<td>';
                                                            $d1 = date_create(date('Y-m-d')); $d2 = date_create($ivf_counsel['dob']); $age = date_diff($d1,$d2); echo $age->y.'yr(s)'.$age->m.'mnth'.$age->d.'days';
                                                            echo '</td>';
															echo '<td>'.$ivf_counsel['address'].'</td>';
															echo '<td>'.$ivf_counsel['complexion'].'</td>';
															echo '<td>'.$ivf_counsel['afc'].'</td>';
															echo '<td>'.$ivf_counsel['lmp'].'</td>';
															echo '<td>'.$ivf_counsel['blood_group'].'</td>';
															echo '<td>'.$ivf_counsel['w_no'].'</td>';
															echo '<td>'.$ivf_counsel['h_no'].'</td>';
                                                            echo '<td>'.$ivf_counsel['email'].'</td>';
                                                            echo '<td>'.$ivf_counsel['referral'].'</td>';
                                                            echo '<td>'.$ivf_counsel['no_of_children'].'</td>';
                                                            
                                                           
                                                            echo '</tr>';
                                                        }
                                                        }
                                                    ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div></div>


                                                                                                                           