<?php  
    require 'include/session.php';
    require 'include/config.php';
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Edit Users | Softpro</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="assets/logo.PNG">
    <link href="assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css">
    <link href="assets/libs/spectrum-colorpicker2/spectrum.min.css" rel="stylesheet" type="text/css">
    <link href="assets/libs/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" type="text/css">
    <link href="assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet" type="text/css" />
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
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                <h4 class="mb-sm-0 font-size-18">Edit USERS</h4>
                            </div>
                        </div>
                    </div>
                    <?php  
                        $id = $_GET['id'];
                        $sql = mysqli_query($con, "select * from user where id='$id'");
                        $r=mysqli_fetch_array($sql);
                    ?>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <form id="formdata" method="post" autocomplete="off" >
                                        <div class="row">
                                            <input type="hidden" value="<?=$id?>" name="id">
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">User&nbsp;Type&nbsp;<span style="color:red;" >*</span></label>
                                                <select name="type" class="form-control select2" >
                                                    <?php if($r['type'] == '1'){ ?>
                                                    <option selected value="1" >Admin</option>
                                                    <?php }else{ ?>
                                                    <option value="1" >Admin</option>
                                                    <?php } ?>
                                                    <?php if($r['type'] == '2'){ ?>
                                                    <option selected value="2" >Employee</option>
                                                    <?php }else{ ?>
                                                    <option value="2" >Employee</option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Name&nbsp;<span style="color:red;" >*</span></label>
                                                <input type="text" value="<?=$r['name'];?>" name="name" class="form-control" >
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Username&nbsp;<span style="color:red;" >*</span></label>
                                                <input type="text" value="<?=$r['username'];?>" name="username" class="form-control" >
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Phone&nbsp;<span style="color:red;" >*</span></label>
                                                <input type="text" value="<?=$r['phone'];?>" name="phone" oninput="numberOnly(this.id);" maxlength="16" id="phone_number_validation" class="form-control">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="custome-css-label">Email&nbsp;<span style="color:red;" >*</span></label>
                                                <input type="email" value="<?=$r['email'];?>" name="email" class="form-control">
                                            </div>
                                            <div class="col-md-4 mb-3" >
                                                <label class="custome-css-label">Password&nbsp;<span style="color:red;" >*</span></label>
                                               <input type="password" value="<?=$r['password'];?>" name="password" class="form-control">
                                            </div>
                                            <div class="col-md-12" >
                                                <button class="btn btn-primary btn-sm" style="float: right;" > Update</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
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
    <script src="assets/libs/select2/js/select2.min.js"></script>
    <script src="assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
    <script src="assets/libs/spectrum-colorpicker2/spectrum.min.js"></script>
    <script src="assets/libs/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
    <script src="assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
    <script src="assets/libs/bootstrap-maxlength/bootstrap-maxlength.min.js"></script>
    <script src="assets/libs/%40chenfengyuan/datepicker/datepicker.min.js"></script>
    <script src="assets/js/pages/form-advanced.init.js"></script>
    <script src="assets/js/app.js"></script>
    <script type="text/javascript">
    // form submittion script
    $(document).ready(function (e) {
        $("#formdata").on('submit',(function(e) {
            e.preventDefault();
            $.ajax({
                url: "include/edit-user.php",
                type: "POST",
                data:  new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                success: function(data){
                alert(data);
                window.location.href = 'users.php';
                },
                error: function(){}             
           });
        }));
    });


    
    // card validation script
    function numberOnly(id) {
        // Get element by id which passed as parameter within HTML element event
        var element = document.getElementById(id);
        // This removes any other character but numbers as entered by user
        element.value = element.value.replace(/[^0-9]/gi, "");
    }
</script>
</body>
</html>