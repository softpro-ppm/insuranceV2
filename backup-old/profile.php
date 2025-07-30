<?php 
    include 'include/session.php';
    include 'include/config.php'; 
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>Softpro | Profile</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" href="assets/logo.PNG">
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
					<div class="row">
						<div class="col-12">
							<div class="page-title-box d-sm-flex align-items-center justify-content-between">
								<h4 class="mb-sm-0 font-size-18">Profile</h4>
							</div>
						</div>
					</div>
                    <?php  
                        $sql = mysqli_query($con, "select * from user where username='".$_SESSION['username']."'");
                        $r=mysqli_fetch_array($sql);
                    ?>
					<div class="row" >
						<div class="col-12" >
							<div class="card overflow-hidden">
                                <div class="bg-primary bg-soft">
                                    <div class="row">
                                        <div class="col-7">
                                            <div class="text-primary p-3">
                                                <h5 class="text-primary">Welcome Back !</h5>
                                                <p style="text-transform: uppercase;" ><?=$r['name'];?></p>
                                            </div>
                                        </div>
                                        <div class="col-5 align-self-end">
                                            <img src="assets/images/profile-img.png" alt="" class="img-fluid">
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body pt-0">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="avatar-md profile-user-wid mb-4"  >
                                                <img src="assets/profile/<?=$r['photo'];?>" alt="" class="img-thumbnail rounded-circle">
                                            </div>
                                            <h5 class="font-size-15 text-truncate" style="text-transform:uppercase;" ><?=$r['username'];?></h5>
                                        </div>

                                        <div class="col-sm-8">
                                            <div class="pt-4">
                                                <div class="row">
                                                    <div class="col-4">
                                                        <h5 class="font-size-15">Name</h5>
                                                        <p class="text-muted mb-0"><?=$r['name'];?></p>
                                                    </div>
                                                    <div class="col-4">
                                                        <h5 class="font-size-15">Phone</h5>
                                                        <p class="text-muted mb-0"><?=$r['phone'];?></p>
                                                    </div>
                                                    <div class="col-4">
                                                        <h5 class="font-size-15">Email</h5>
                                                        <p class="text-muted mb-0"><?=$r['email'];?></p>
                                                    </div>
                                                </div>
                                                <div class="mt-4">
                                                    <a data-bs-toggle="modal" data-bs-target=".transaction-detailModal" href="javascript: void(0);" class="btn btn-primary waves-effect waves-light btn-sm">Edit Profile <i class="mdi mdi-arrow-right ms-1"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
						</div>
					</div>
				</div>
			</div>
			<div class="modal fade transaction-detailModal" tabindex="-1" role="dialog" aria-labelledby="transaction-detailModalLabel" aria-hidden="true" style="top:-100px;" >
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="transaction-detailModalLabel">
                                <span class="text-primary"> 
                                    <a href="javascript:void(0);">update Profile</a> </span>
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="include/update-profile.php" class="form-group" autocomplete="off" method="post" enctype="multipart/form-data" >
                                <div class="row">
                                    <input type="hidden" value="<?=$r['id'];?>" name="id">
                                    <div class="col-6" >
                                        <input type="text" value="<?=$r['name'];?>" placeholder="Name" class="form-control" name="name">
                                    </div>
                                    <div class="col-6" >
                                        <input type="text" placeholder="Userame" class="form-control" value="<?=$r['username'];?>" name="username">
                                    </div>
                                </div>
                                <div class="row" style="margin-top: 10px;" >
                                    <div class="col-6" >
                                        <input type="text" placeholder="Phone" class="form-control" value="<?=$r['phone'];?>" name="phone">
                                    </div>
                                    <div class="col-6" >
                                        <input type="text" placeholder="Email" class="form-control" value="<?=$r['email'];?>" name="email">
                                    </div>
                                </div>
                                <div class="row" style="margin-top: 10px;" >
                                    <div class="col-6" >
                                        <input type="text" placeholder="Password" class="form-control" value="<?=$r['password'];?>" name="password">
                                    </div>
                                    <div class="col-6" >
                                        <input type="file" class="form-control" accept="image/png, image/gif, image/jpeg" name="file">
                                    </div>
                                </div>
                                <div class="row" style="margin-top: 10px;" >
                                    <div class="col-12" >
                                        <button type="submit" class="btn btn-primary btn-sm" name="submit" style="float: right;" >Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
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
	<script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
	<script src="assets/libs/metismenu/metisMenu.min.js"></script>
	<script src="assets/libs/simplebar/simplebar.min.js"></script>
	<script src="assets/libs/node-waves/waves.min.js"></script>
	<script src="assets/js/app.js"></script>
</body>
</html>