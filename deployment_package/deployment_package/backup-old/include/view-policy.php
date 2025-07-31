<?php  
	include 'session.php';
	include 'config.php';

	$sql = mysqli_query($con, "select * from policy where id='".$_POST['id']."'");
	$r=mysqli_fetch_array($sql);

	if($r['fc_expiry_date'] !=''){
		$fc_expiry_date = date('d-m-Y', strtotime($r['fc_expiry_date']));
	}else{
		$fc_expiry_date = '';
	}

	if($r['permit_expiry_date'] !=''){
		$permit_expiry_date = date('d-m-Y', strtotime($r['permit_expiry_date']));
	}else{
		$permit_expiry_date = '';
	}

	$data = 
		'	<div class="modal-header">
                <h5 class="modal-title" id="transaction-detailModalLabel">
                    <span class="text-primary"> 
                        <a href="edit.php?id='.$r['id'].'">'.$r['vehicle_number'].'</a> </span>
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table align-middle table-nowrap">
                        <thead>
                            <tr>
                                <th scope="col">S.No.</th>
                                <th scope="col">Index</th>
                                <th scope="col">Values</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <h6 class="m-0 text-right">1</h6>
                                </td>
                                <td>VEHICLE NUMBER </td>
                                <td>: '.$r['vehicle_number'].'</td>
                            </tr>
                            <tr>
                                <td>
                                    <h6 class="m-0 text-right">2</h6>
                                </td>
                                <td>NAME</td>
                                <td>: '.$r['name'].'</td>
                            </tr>
                            <tr>
                                <td>
                                    <h6 class="m-0 text-right">3</h6>
                                </td>
                                <td>PHONE NUMBER</td>
                                <td>: '.$r['phone'].'</td>
                            </tr>
                            <tr>
                                <td>
                                    <h6 class="m-0 text-right">4</h6>
                                </td>
                                <td>VEHICLE TYPE</td>
                                <td>: '.$r['vehicle_type'].'</td>
                            </tr>
                            <tr>
                                <td>
                                    <h6 class="m-0 text-right">5</h6>
                                </td>
                                <td>POLICY TYPE</td>
                                <td>: '.$r['policy_type'].'</td>
                            </tr>
                            <tr>
                                <td>
                                    <h6 class="m-0 text-right">6</h6>
                                </td>
                                <td>Chassiss  No.</td>
                                <td>: '.$r['chassiss'].'</td>
                            </tr>
                            <tr>
                                <td>
                                    <h6 class="m-0 text-right">7</h6>
                                </td>
                                <td>PREMIUM</td>
                                <td>: '.$r['premium'].'</td>
                            </tr>
                            <tr>
                                <td>
                                    <h6 class="m-0 text-right">8</h6>
                                </td>
                                <td>REVENUE</td>
                                <td>: '.$r['revenue'].'</td>
                            </tr>
                            <tr>
                                <td>
                                    <h6 class="m-0 text-right">9</h6>
                                </td>
                                <td>POLICY ISSUE DATE</td>
                                <td>: '.date('d-m-Y',strtotime($r['policy_issue_date'])).'</td>
                            </tr>
                            <tr>
                                <td>
                                    <h6 class="m-0 text-right">10</h6>
                                </td>
                                <td>POLICY START DATE</td>
                                <td>: '.date('d-m-Y', strtotime($r['policy_start_date'])).'</td>
                            </tr>
                            <tr>
                                <td>
                                    <h6 class="m-0 text-right">11</h6>
                                </td>
                                <td>POLICY END DATE</td>
                                <td>: '.date('d-m-Y', strtotime($r['policy_end_date'])).'</td>
                            </tr>
                            <tr>
                                <td>
                                    <h6 class="m-0 text-right">12</h6>
                                </td>
                                <td>FC EXPIRY DATE</td>
                                <td>: '.$fc_expiry_date.'</td>
                            </tr>
                            <tr>
                                <td>
                                    <h6 class="m-0 text-right">13</h6>
                                </td>
                                <td>PERMIT EXPIRY DATE</td>
                                <td>: '.$permit_expiry_date.'</td>
                            </tr>
                            <tr>
                                <td>
                                    <h6 class="m-0 text-right">14</h6>
                                </td>
                                <td>DOCUMENT</td>
                                <td>';
                        	$sql1 = mysqli_query($con, "select * from files where policy_id='".$r['id']."'");
                            while ($r1=mysqli_fetch_array($sql1)) {
                        $data .='<a href="assets/uploads/'.$r1['files'].'"  class="btn btn-outline-primary btn-sm edit" download ><i class="fas fa-download" ></i></a>';
                        	}
                        $data .='</td>
                            </tr>
                            
                            <tr>
                                <td>
                                    <h6 class="m-0 text-right">15</h6>
                                </td>
                                <td>RC Copy</td>
                                <td>';
                        	$sql1 = mysqli_query($con, "select * from rc where policy_id='".$r['id']."'");
                            while ($r1=mysqli_fetch_array($sql1)) {
                        $data .='<a href="assets/uploads/'.$r1['files'].'"  class="btn btn-outline-primary btn-sm edit" download ><i class="fas fa-download" ></i></a>';
                        	}
                        $data .='</td>
                            </tr>
                            
                            <tr>
                                <td>
                                    <h6 class="m-0 text-right">16</h6>
                                </td>
                                <td>Comment</td>
                                <td>: ';
                        	$sql1 = mysqli_query($con, "select * from comments where policy_id='".$r['id']."'");
                            while ($r1=mysqli_fetch_array($sql1)) {
                            $data .=$r1['comments'];
                        	}
                        $data .='</td>
                            </tr>
                            
                        </tbody>
                    </table>
                </div>
            </div>
		';

		echo $data;
?>