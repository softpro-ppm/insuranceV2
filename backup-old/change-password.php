<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Change Password | Softpro</title>
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
                                <h4 class="mb-sm-0 font-size-18">CHANGE PASSWORD</h4>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <form autocomplete="off" >
                                        <div class="row">
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Old&nbsp;Password&nbsp;<span style="color:red;" >*</span></label>
                                                <input type="text" name="name" class="form-control " required >
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">New&nbsp;Password&nbsp;<span style="color:red;" >*</span></label>
                                                <input type="text" name="username" class="form-control " required >
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Confirm&nbsp;Password&nbsp;<span style="color:red;" >*</span></label>
                                                <input type="text" class="form-control" >
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
                            <div class="text-sm-end d-none d-sm-block">Design & Develop by Asksoft</div>
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
        $('.js-datepicker').datepicker({
           format: 'dd-mm-yyyy',
           autoclose: true, 
        })
        $('.js-datepicker').on("change", function() {
            $(this).datepicker("hide");
        })
    </script>
    <script type="text/javascript">
        $(function() {
            $('.uppercase').keyup(function() {
                this.value = this.value.toLocaleUpperCase();
            });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#policy_start_date').on("change", function() {
                var newdate=new Date($(this).val().split("-").reverse().join("-"));
                var d = new Date(newdate);
                var nextYear = d.getFullYear() + 1;
                d.setFullYear(nextYear);
                d.setDate(d.getDate() - 1);
                var dateAr = d.toLocaleDateString("fr-FR").split('/');
                var newDatea = dateAr[0] + '-' + dateAr[1] + '-' + dateAr[2];
                $('#policy_end_date').val(newDatea);
            });
        });
    </script>
    <script type="text/javascript">
    function numberOnly(id) {
        // Get element by id which passed as parameter within HTML element event
        var element = document.getElementById(id);
        // This removes any other character but numbers as entered by user
        element.value = element.value.replace(/[^0-9]/gi, "");
    
    }
</script>
<script type="text/javascript">
    function checkdata() {
        var xhttp = new XMLHttpRequest();
            var vehicle_number = document.getElementById("vehicle_number").value;
            xhttp.onreadystatechange=function() {
                if (this.readyState == 4 && this.status == 200) {
                    if(this.responseText == ''){

                    }else{
                        let text = "policy is already existed do you want to renew this ?";
                        if (confirm(text) == true) {
                            window.location.href="edit.php?id=" +this.responseText;
                        } else {
                            return false;
                        }
                    }
                }
            };
          xhttp.open("GET", "include/check-data.php?vehicle_number=" + vehicle_number, true);
          xhttp.send();

    }
</script>
</body>
</html>