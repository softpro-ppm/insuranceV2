<?php
		
	include 'session.php';
	include 'config.php';

	$data = '';

	$data .=
		'
			<table class="table align-td-middle table-card"  >
                <thead>
                    <tr>
                        <th>S.&nbsp;No.</th>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Vehicle&nbsp;Number</th>
                        <th>Vehicle&nbsp;Type</th>
                        <th>Company&nbsp;Name</th>
                        <th>Policy&nbsp;Type</th>
                        <th>Policy&nbsp;Issue&nbsp;Date</th>
                        <th>Policy&nbsp;Start&nbsp;Date</th>
                        <th>Policy&nbsp;End&nbsp;Date</th>
                        <th>FC&nbsp;Expiry&nbsp;Date</th>
                        <th>Permit&nbsp;Expiry&nbsp;Date</th>
                        <th>Premium</th>
                        <th>Revenue</th>
                        <th><span style="visibility:hidden;" >Actions</span>Document<span style="visibility:hidden;" >Actions</span></th>
                        <th><span style="visibility:hidden;" >Actions</span>Actions<span style="visibility:hidden;" >Actions</span></th>
                    </tr>
                </thead>
                <tbody>'; 
                        $countsql = "SELECT count(*) as allcount FROM policy where id>'0'";
                            if(!empty($_POST['startdate'])){
                                $startdate = date('Y-m-d', strtotime($_POST['startdate']));
                                $countsql .= " AND created_date >='".$startdate."'";
                            }
                            if(!empty($_POST['enddate'])){
                                $enddate = date('Y-m-d', strtotime($_POST['enddate']));
                                $countsql .= " AND created_date <='".$enddate."'";
                            }
                            if(!empty($_POST['searchval'])){
                                $searchval = $_POST['searchval'];
                                $countsql .= " AND name ='".$searchval."'";
                            }
                            
                        $count_result = mysqli_query($con,$countsql);
                        $count_fetch = mysqli_fetch_array($count_result);
                        $postCount = $count_fetch['allcount'];
                        $limit = 8;    

                        $sn=1;
                        $sql = "SELECT * FROM policy where id >0";
        	                if(!empty($_POST['type'])){
                                if($_POST['type'] == 'Renewal'){
                                    if(!empty($_POST['startdate'])){
                                        $startdate = date('Y-m-d', strtotime($_POST['startdate']));
                                        $sql .= " AND policy_end_date >='".$startdate."'";
                                    }
                                    if(!empty($_POST['enddate'])){
                                        $enddate = date('Y-m-d', strtotime($_POST['enddate']));
                                        $sql .= " AND policy_end_date <='".$enddate."'";
                                    }                                    
                                }elseif($_POST['type'] == 'FC'){
                                    if(!empty($_POST['startdate'])){
                                        $startdate = date('Y-m-d', strtotime($_POST['startdate']));
                                        $sql .= " AND fc_expiry_date >='".$startdate."'";
                                    }
                                    if(!empty($_POST['enddate'])){
                                        $enddate = date('Y-m-d', strtotime($_POST['enddate']));
                                        $sql .= " AND fc_expiry_date <='".$enddate."'";
                                    }   
                                }elseif($_POST['type'] == 'Permit'){
                                    if(!empty($_POST['startdate'])){
                                        $startdate = date('Y-m-d', strtotime($_POST['startdate']));
                                        $sql .= " AND permit_expiry_date >='".$startdate."'";
                                    }
                                    if(!empty($_POST['enddate'])){
                                        $enddate = date('Y-m-d', strtotime($_POST['enddate']));
                                        $sql .= " AND permit_expiry_date <='".$enddate."'";
                                    }
                                }
                            }else{

                                if(!empty($_POST['startdate'])){
                                    $startdate = date('Y-m-d', strtotime($_POST['startdate']));
                                    $sql .= " AND created_date >='".$startdate."'";
                                }
                                if(!empty($_POST['enddate'])){
                                    $enddate = date('Y-m-d', strtotime($_POST['enddate']));
                                    $sql .= " AND created_date <='".$enddate."'";
                                }
                            }
                            if(!empty($_POST['searchval'])){
                                $searchval = $_POST['searchval'];
                                $sql .= " AND name like '%".$searchval."%' or phone like '%".$searchval."%' or  vehicle_number like '%".$searchval."%' or vehicle_type like '%".$searchval."%' or insurance_company like '%".$searchval."%' or policy_type like '%".$searchval."%' or premium like '%".$searchval."%' or revenue like '%".$searchval."%'";
                            }
                        $sql .= "  ORDER BY id DESC limit 0, $limit";
                        $rs = mysqli_query($con, $sql);
                        if(mysqli_num_rows($rs) > 0){
                        while ($r=mysqli_fetch_array($rs)) {

                            if($r['fc_expiry_date'] == '1970-01-01'){
                                $fc_expiry_date = '';
                            }else{
                                $fc_expiry_date = date('d-m-Y',strtotime($r['fc_expiry_date']));
                            }

                            if($r['permit_expiry_date'] == '1970-01-01'){
                                $permit_expiry_date = '';
                            }else{
                                $permit_expiry_date = date('d-m-Y',strtotime($r['permit_expiry_date']));
                            }
                            

                $data .='<tr>
                            <td>'.$sn.'</td>
                            <td>'.$r['name'].'</td>
                            <td>'.$r['phone'].'</td>
                            <td>'.$r['vehicle_number'].'</td>
                            <td>'.$r['vehicle_type'].'</td>
                            <td>'.$r['insurance_company'].'</td>
                            <td>'.$r['policy_type'].'</td>
                            <td>'.date('d-m-Y',strtotime($r['policy_issue_date'])).'</td>
                            <td>'.date('d-m-Y',strtotime($r['policy_start_date'])).'</td>
                            <td>'.date('d-m-Y',strtotime($r['policy_end_date'])).'</td>
                            <td>'.$fc_expiry_date.'</td>
                            <td>'.$permit_expiry_date.'</td>
                            <td>'.$r['premium'].'</td>
                            <td>'.$r['revenue'].'</td>
                            <td>';
                            $sql1 = mysqli_query($con, "select * from files where policy_id='".$r['id']."'");
                            while ($r1=mysqli_fetch_array($sql1)) {
                            
                        $data .='<a href="include/file-download.php?file='.$r1['files'].'" target="_blank" class="btn btn-dark btn-sm" ><i class="mdi mdi-briefcase-download"></i></a>';
                            }
                    $data .='</td>
                            <td>
                                <a href="view.php?id='.$r['id'].'" class="btn btn-dark btn-sm" >View</a>
                                <a href="edit.php?id='.$r['id'].'" class="btn btn-primary btn-sm" >Edit</a>
                                <a href="javascript:void(0);" onclick="deletepolicy(this)" data-id="'.$r['id'].'" class="btn btn-danger btn-sm" >Delete</a>
                            </td>
                        </tr>';
                    	$sn++; } }else{ 
            $data .='<td colspan="10" ></td>';
                    	} 
        $data .='</tbody>
            </table>
        ';

        $sql1 = mysqli_query($con, "SELECT count(*) as totalentries FROM policy");
        $r1 = mysqli_fetch_array($sql1);
        $totalentries = $r1['totalentries'];

	echo $data."split"."Total ".$totalentries ." entries" ;
?>