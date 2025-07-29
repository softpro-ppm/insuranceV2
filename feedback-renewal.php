<?php 
    include 'include/session.php';
    include 'include/config.php'; 
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>Follow UP | Softpro</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" href="assets/logo.PNG">
	<link href="assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
	<link href="assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
	<link href="assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="assets/libs/%40chenfengyuan/datepicker/datepicker.min.css">
	<link href="assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
	<link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
	<link href="assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
</head>

<body data-sidebar="dark">
	<div id="layout-wrapper">
		<header id="page-topbar">
			<?php require 'include/header.php'; ?>
		</header>
		<div class="vertical-menu">
			<div data-simplebar class="h-100">
				<div id="sidebar-menu">
					<?php require 'include/sidebar.php'; ?>
				</div>
			</div>
		</div>
		<div class="main-content">
			<div class="page-content">
				<div class="container-fluid">
					<!-- start page title -->
					<div class="row">
						<div class="col-12">
							<div class="page-title-box d-sm-flex align-items-center justify-content-between">
								<h4 class="mb-sm-0 font-size-18">Manage Follow UP</h4>
								<div class="page-title-right">
									<ol class="breadcrumb m-0">
										<li class="breadcrumb-item">
											<form action="manage-renewal.php" autocomplete="off" method="post" >
												<div class="row" >
													<div class="col-md-3" >
														<?php if(!empty($_POST['fromdate'])){ ?>
														<input type="text" name="fromdate" class="form-control js-datepicker" value="<?=$_POST['fromdate'];?>" placeholder="From date" >
														<?php }else{ ?>
														<input type="text" name="fromdate" class="form-control js-datepicker" placeholder="From date"  name="">
														<?php } ?>
													</div>
													<div class="col-md-3" >
														<?php if(!empty($_POST['todate'])){ ?>
														<input class="form-control js-datepicker" type="text" value="<?=$_POST['todate'];?>" placeholder="To date" name="todate">
														<?php }else{ ?>
														<input class="form-control js-datepicker" type="text" placeholder="To date" name="todate">
														<?php } ?>
													</div>
													<div class="col-md-3" >
														<select class="form-control" name="type" >
															<?php if(isset($_POST['type']) && $_POST['type'] =='1' ){ ?>
															<option selected value="1" >Policies Renewal</option>
															<?php }else{ ?>
															<option value="1" >Policies Renewal</option>
															<?php } ?>
															<?php if(isset($_POST['type']) && $_POST['type'] =='2' ){ ?>
															<option selected value="2" >Fc Renewal</option>
															<?php }else{ ?>
															<option value="2" >Fc Renewal</option>
															<?php } ?>
															<?php if(isset($_POST['type']) && $_POST['type'] =='3' ){ ?>
															<option selected value="3" >Permit Renewal</option>
															<?php }else{ ?>
															<option value="3" >Permit Renewal</option>
															<?php } ?>
														</select>
													</div>
													<div class="col-md-3" >
														<button name="submit" class="btn btn-outline-primary" >Search</button>
														<a class="btn btn-outline-danger " href="manage-renewal.php">Reset</a>
													</div>
												</div>
											</form>
										</li>
									</ol>
								</div>
							</div>
						</div>
					</div>
					
					
					
						<?php
							 if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['comment'])) {
                                                    
                                                   
                                    $policy_id = mysqli_real_escape_string($con, $_POST['policy_id']);
                                    $comment = mysqli_real_escape_string($con, $_POST['comment']);
                                    $createdAt = date("Y-m-d H:i:s");
                                
                                    $insertComment = "INSERT INTO customer_feedback (policy_id, comment, created_at) VALUES ('$policy_id', '$comment', '$createdAt')";
                                    if (mysqli_query($con, $insertComment)) {
                                        echo "<script>alert('Comment added successfully.');</script>";
                                    } else {
                                        echo "<script>alert('Error adding comment.');</script>";
                                    }
                                
                                    //header("Location: manage-renewal.php");
                                    //exit();
                                }
							
							?>
										
					<div class="row">
						<div class="col-12">
							<div class="card">
								<div class="card-body">
									<div class="table-responsive" >
										<table id="datatable" class="table table-bordered dt-responsive nowrap w-100">
											<thead>
												<tr>
													<th>S.NO.</th>
													<th>Comment</th>
													<th>VEHICLE&nbsp;NUMBER</th>
													<th>NAME</th>
													<th>PHONE</th>
													<th>VEHICLE&nbsp;TYPE</th>
													<th>POLICY&nbsp;TYPE</th>
													<th>RECENT&nbsp;COMMENT</th>
													<th>POLICY&nbsp;END&nbsp;DATE</th>
													
												</tr>
											</thead>
											<tbody>
												<?php  
													$sn=1;
													
													if(isset($_GET['pending'])){
													     $sql = "select * from policy where month(policy_end_date) ='".date("m")."' and year(policy_end_date)='".date("Y")."' ";
													}elseif(isset($_GET['renewal'])){
													     $sql = "select * from history where month(policy_end_date) >='".date("m")."' and year(policy_end_date)='".date("Y")."' GROUP BY vehicle_number ";
													    
													}elseif(isset($_POST['submit'])){
														if($_POST['type'] == '1'){
															$sql = "SELECT * FROM policy where policy_end_date >='".date("Y-m-d", strtotime($_POST['fromdate']))."' and policy_end_date <='".date("Y-m-d", strtotime($_POST['todate']))."' ORDER BY id DESC ";
														}elseif($_POST['type'] == '2'){
															$sql = "SELECT * FROM policy where fc_expiry_date >='".date("Y-m-d", strtotime($_POST['fromdate']))."' and fc_expiry_date <='".date("Y-m-d", strtotime($_POST['todate']))."' ORDER BY id DESC ";
														}elseif($_POST['type'] == '3'){
															$sql = "SELECT * FROM policy where permit_expiry_date >='".date("Y-m-d", strtotime($_POST['fromdate']))."' and permit_expiry_date <='".date("Y-m-d", strtotime($_POST['todate']))."' ORDER BY id DESC ";
														}
													}else{
							                        	$sql = "SELECT * FROM policy where month(policy_end_date) ='".date("m")."' and year(policy_end_date)='".date("Y")."' ORDER BY id DESC ";
							                    	}
							                        $rs = mysqli_query($con, $sql);
							                        if(mysqli_num_rows($rs) > 0){
							                        while ($r=mysqli_fetch_array($rs)) {

						                            if($r['fc_expiry_date'] == ''){
						                                $fc_expiry_date = '';
						                            }else{
						                                $fc_expiry_date = date('d-m-Y',strtotime($r['fc_expiry_date']));
						                            }

						                            if($r['permit_expiry_date'] == ''){
						                                $permit_expiry_date = '';
						                            }else{
						                                $permit_expiry_date = date('d-m-Y',strtotime($r['permit_expiry_date']));
						                            }
						                            
						                            
						                            
						                            $policyId = $r['id'];
                                                    $commentQueryl = "SELECT * FROM customer_feedback WHERE policy_id = '$policyId' ORDER BY created_at DESC LIMIT 1";
                                                    $commentsResultl = mysqli_query($con, $commentQueryl);
                                                    
                                                    if (mysqli_num_rows($commentsResultl) > 0) {
                                                        while ($commentl = mysqli_fetch_array($commentsResultl)) {
                                                            $latest=htmlspecialchars($commentl['comment']);
                                                        }
                                                    } else {
                                                        $latest= "No comments yet.";
                                                    }
                                                            
												?>
												<tr>
													<td><?=$sn;?></td>
													<td class="text-center">
													    
													    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" onclick="viewcomment('<?=$r['id'];?>')" data-id="<?=$r['id'];?>" data-bs-target="#exampleModal"><i class="fa fa-comment" ></i></button>
														
												    </td>
													<td><a href="javascript: void(0);" class="text-body fw-bold waves-effect waves-light" onclick="viewpolicy(this)" data-id="<?=$r['id'];?>"><?=$r['vehicle_number'];?></a></td>
													<td><?=$r['name'];?></td>
													<td><?=$r['phone'];?></td>
													<td><?=$r['vehicle_type'];?></td>
													<td><?=$r['policy_type'];?></td>
													<td class="comment_last_<?=$r['id'];?>"><?=$latest;?></td>
													<td><?=date('d-m-Y',strtotime($r['policy_end_date']));?></td>
													
                                              <!-- Button trigger modal -->
                                               
                                                
													
												</tr>
												
											
												
												
												<?php $sn++; } }else{ ?> 
					                        <tr>
         										<td colspan="10" >No Policy found</td>
					                        </tr>
             								<?php } ?>
											</tbody>
										</table>
										
										
									
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			
			<!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Comments</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                         
                         <!-- Comment Form -->
                        <h5>Leave a Comment</h5>
                        <form action="feedback-renewal-add.php" method="POST" id="submit_comment">
                            <div class="form-group">
                                <input type="hidden" name="policy_id"  value="" id="plicy_id_cmt">
                                <textarea name="comment" class="form-control" id="comment_data" rows="4" placeholder="Write your comment here..." required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary mt-2">Submit</button>
                            <p class="comt_message"></p>
                        </form>
                        
                        <!-- Display Comments -->
                        <h5 class="mt-4">Comments</h5>
                        <div class="comment-section">
                            <?php

                            // $policyId = $r['id'];
                            // $commentQuery = "SELECT * FROM customer_feedback WHERE policy_id = '$policyId' ORDER BY created_at DESC";
                            // $commentsResult = mysqli_query($con, $commentQuery);
                        
                            // if (mysqli_num_rows($commentsResult) > 0) {
                            //     while ($comment = mysqli_fetch_array($commentsResult)) {
                            //       //  echo '<div class="card p-2">';
                            //             echo "<div class='comment-box mt-3'>";
                            //             echo "<p><strong>Comment:</strong> " . htmlspecialchars($comment['comment']) . "</p>";
                            //             echo "<p><small><em>Posted on: " . date("d-m-Y H:i a", strtotime($comment['created_at'])) . "</em></small></p>";
                            //             echo "</div>";
                            //             echo "</hr>";
                            //       //  echo "</div>";
                            //     }
                            // } else {
                            //     echo "<p>No comments yet. Be the first to comment!</p>";
                            // }
                            ?>
                        </div>
                         
                      </div>
                      <!--<div class="modal-footer">-->
                      <!--  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>-->
                      <!--  <button type="button" class="btn btn-primary">Save changes</button>-->
                      <!--</div>-->
                    </div>
                  </div>
                </div>
                
			<div class="modal fade transaction-detailModal" tabindex="-1" role="dialog" aria-labelledby="transaction-detailModalLabel" aria-hidden="true" id="renewalpolicyview" >
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content" id="viewpolicydata" ></div>
                </div>
            </div>
			<footer class="footer">
				<div class="container-fluid">
					<div class="row">
						<div class="col-sm-6">
							<script>
								document.write(new Date().getFullYear())
							</script>© Softpro.</div>
						<div class="col-sm-6">
							<div class="text-sm-end d-none d-sm-block">Design & Develop by Softpro</div>
						</div>
					</div>
				</div>
			</footer>
		</div>
	</div>
	<script src="assets/libs/jquery/jquery.min.js"></script>
	<script src="https://code.jquery.com/ui/1.14.1/jquery-ui.js"></script>
    <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/libs/metismenu/metisMenu.min.js"></script>
    <script src="assets/libs/simplebar/simplebar.min.js"></script>
    <script src="assets/libs/node-waves/waves.min.js"></script>
    <script src="assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
    <script src="assets/libs/spectrum-colorpicker2/spectrum.min.js"></script>
    <script src="assets/libs/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
    <script src="assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
    <script src="assets/libs/bootstrap-maxlength/bootstrap-maxlength.min.js"></script>
    <script src="assets/libs/%40chenfengyuan/datepicker/datepicker.min.js"></script>
    <script src="assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
	<script src="assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
	<script src="assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
	<script src="assets/js/pages/datatables.init.js"></script>
    <script src="assets/js/app.js"></script>
	<script type="text/javascript">
        $('.js-datepicker').datepicker({
           format: 'dd-mm-yyyy',
           autoclose: true, 
        })
        $('.js-datepicker').on("change", function() {
            $(this).datepicker("hide");
        })
    </script>
    <script type="text/javascript">
        function viewpolicy(identifier) {
            var id= $(identifier).data("id");
            $('#renewalpolicyview').modal("show");
            $.post("include/view-policy.php",{ id:id }, function(data) {
                $('#viewpolicydata').html(data);
            });
        }
        
        function viewcomment(id) {
                $('#plicy_id_cmt').val(id);
                
                $('.comment-section').html('');
               // $('.comt_message').html('');
                
                $.ajax({
                url:'include/feedback-renewal-add.php',
                type:'post',
                data:{ id:id ,load:'load'},
                success:function(data){
                    $('.comment-section').html(data);
                    //$('#submit_comment').reset();
                }
            });
        }
        
        
        $('#submit_comment').on('submit',function(e){
            e.preventDefault();
            
            $('.comt_message').html('');
            
            var id= $('#plicy_id_cmt').val();
            var comment_data= $('#comment_data').val();
            
            $.ajax({
                url:'include/feedback-renewal-add.php',
                type:'post',
                data:{ policy_id:id ,comment:comment_data},
                success:function(data){
                    $('.comt_message').html(data);
                    viewcomment($('#plicy_id_cmt').val());
                    $('#submit_comment')[0].reset();
                    
                    $.ajax({
                        url:'include/feedback-renewal-add.php',
                        type:'post',
                        data:{ id:id ,last:'last'},
                        success:function(data){
                            $('.comment_last_'+id).html(data);
                            //$('#submit_comment').reset();
                        }
                    });
            
                    
                }
            });
        });
        
    </script>
</body>
</html>