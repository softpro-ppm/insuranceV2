<?php  
    require 'include/session.php';
    require 'include/config.php';
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Add Policy | Softpro</title>
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
                                <h4 class="mb-sm-0 font-size-18">Add Policy</h4>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <form action="include/add-policies.php" method="post" enctype="multipart/form-data" autocomplete="OFF" >
                                        <div class="row">
                                            <div class="col-md-3 mb-3">
                                                <label class="form-label">Vehicle Number&nbsp;<span style="color:red;" >*</span></label>
                                                <input type="text" name="vehicle_number" id="vehicle_number" onchange="checkdata();" class="form-control uppercase" required >
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <label class="custome-css-label">Phone Number&nbsp;<span style="color:red;" >*</span></label>
                                                <input type="text" name="phone" oninput="numberOnly(this.id);" maxlength="10" id="card_number_validation" class="form-control" required >
                                            </div>
                                            <div class="col-md-3 mb-3" >
                                                <label class="custome-css-label">Full Name&nbsp;<span style="color:red;" >*</span></label>
                                               <input type="text" name="name" class="form-control uppercase" required >
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <label class="form-label">Vehicle Type&nbsp;<span style="color:red;" >*</span></label>
                                                <select name="vehicle_type" id="vehicle_type" class="form-control select2" required >
                                                    <option value="" >Select</option>
                                                    <option value="Auto" >Auto</option>
                                                    <option value="Tractor" >Tractor</option>
                                                    <option value="Two Wheeler" >Two Wheeler</option>
                                                    <option value="Car" >Car</option>
                                                    <option value="Trailer" >Trailer</option>
                                                    <option value="Bolero" >Bolero</option>
                                                    <option value="Lorry" >Lorry</option>
                                                    <option value="JCB" >JCB</option>
                                                    <option value="Bus" >Bus</option>
                                                    <option value="Person" >Person</option>
                                                    <option value="Misc" >Misc</option>
                                                </select>
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <label class="form-label">Insurance&nbsp;Company&nbsp;Name&nbsp;<span style="color:red;" >*</span></label>
                                                <!--<select name="insurance_company" class="form-control select2" required="true" >-->
                                                <!--    <option value="" >Select</option>-->
                                                <!--    <option value="Tata AIG" >Tata AIG</option>-->
                                                <!--    <option value="Magma" >Magma</option>-->
                                                <!--    <option value="ICICI Lombard" >ICICI Lombard</option>-->
                                                <!--    <option value="Future Generali Insurance" >Future Generali Insurance</option>-->
                                                <!--    <option value="Bajaj Allianz" >Bajaj Allianz</option>-->
                                                <!--    <option value="SBI General Insurance" >SBI General Insurance</option>-->
                                                <!--    <option value="HDFC Ergo" >HDFC Ergo</option>-->
                                                <!--    <option value="United India" >United India</option>-->
                                                <!--    <option value="New India Insurance" >New India Insurance</option>-->
                                                <!--    <option value="Cholamandal" >Cholamandal</option>-->
                                                <!--    <option value="Go Digit" >Go Digit</option>-->
                                                <!--    <option value="Royal Sundaram" >Royal Sundaram</option>-->
                                                <!--    <option value="Reliance" >Reliance</option>-->
                                                <!--    <option value="Shriram" >Shriram</option>-->
                                                <!--    <option value="Health Insurance" >Health Insurance</option>-->
                                                <!--</select>-->
                                                
                                                <select name="insurance_company" class="form-control select2" required="true">
                                                    <option value="">Select</option>
                                                    <option value="Tata AIG">Tata AIG</option>
                                                    <option value="Magma">Magma</option>
                                                    <option value="ICICI Lombard">ICICI Lombard</option>
                                                    <option value="Future Generali Insurance">Future Generali Insurance</option>
                                                    <option value="Bajaj Allianz">Bajaj Allianz</option>
                                                    <option value="SBI General Insurance">SBI General Insurance</option>
                                                    <option value="HDFC Ergo">HDFC Ergo</option>
                                                    <option value="United India">United India</option>
                                                    <option value="New India Insurance">New India Insurance</option>
                                                    <option value="Cholamandal">Cholamandal</option>
                                                    <option value="Go Digit">Go Digit</option>
                                                    <option value="Royal Sundaram">Royal Sundaram</option>
                                                    <option value="Reliance">Reliance</option>
                                                    <option value="Shriram">Shriram</option>
                                                    <option value="Health Insurance">Health Insurance</option>
                                                    <option value="Aditya Birla Health Insurance">Aditya Birla Health Insurance</option>
                                                    <option value="Care Health Insurance">Care Health Insurance</option>
                                                    <option value="IFFCO-Tokio General Insurance Co. Ltd.">IFFCO-Tokio General Insurance Co. Ltd.</option>
                                                    <option value="Liberty India General Insurance">Liberty India General Insurance</option>
                                                    <option value="Manipal Cigna Health Insurance">Manipal Cigna Health Insurance</option>
                                                    <option value="National Insurance Co. Ltd.">National Insurance Co. Ltd.</option>
                                                    <option value="Niva Bupa Health Insurance Co. Ltd.">Niva Bupa Health Insurance Co. Ltd.</option>
                                                    <option value="The Oriental Insurance Co. Ltd.">The Oriental Insurance Co. Ltd.</option>
                                                    <option value="Raheja QBE General Insurance Co. Ltd.">Raheja QBE General Insurance Co. Ltd.</option>
                                                    <option value="Star Health and Allied Insurance Co Ltd">Star Health and Allied Insurance Co Ltd</option>
                                                    <option value="Universal Sompo General Insurance Co. Ltd.">Universal Sompo General Insurance Co. Ltd.</option>
                                                    <option value="Zuno General Insurance Ltd.">Zuno General Insurance Ltd.</option>
                                                    <option value="Zurich Kotak General Insurance Co. (India) Ltd.">Zurich Kotak General Insurance Co. (India) Ltd.</option>
                                                    <option value="Life Insurance">Life Insurance</option>
                                                    <option value="Term Insurance">Term Insurance</option>
                                                </select>

                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <label class="form-label">Policy&nbsp;Type&nbsp;Name&nbsp;<span style="color:red;" >*</span></label>
                                                <select name="policy_type" class="form-control select2" required="true" >
                                                    <option value="" >Select</option>
                                                    <option value="Full" >Full</option>
                                                    <option value="Third Party" >Third Party</option>
                                                    <option value="Health" >Health</option>
                                                </select>
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <label class="form-label">Policy&nbsp;Issue&nbsp;Date&nbsp;<span style="color:red;" >*</span></label>
                                                <input type="text" name="policy_issue_date" class="form-control js-datepicker" required >
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <label class="form-label">Policy&nbsp;Start&nbsp;Date&nbsp;<span style="color:red;" >*</span></label>
                                                <input type="text" name="policy_start_date" id="policy_start_date" class="form-control js-datepicker" required >
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <label class="form-label">Policy&nbsp;End&nbsp;Date&nbsp;<span style="color:red;" >*</span></label>
                                                <input type="text" name="policy_end_date" id="policy_end_date" class="form-control js-datepicker" required >
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <label class="form-label">FC&nbsp;Expiry&nbsp;Date</label>
                                                <input type="text"  name="fc_expiry_date" class="form-control js-datepicker">
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <label class="form-label">Permit&nbsp;Expiry&nbsp;Date</label>
                                                <input type="text" name="permit_expiry_date" class="form-control js-datepicker">
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <label class="form-label">Premium&nbsp;<span style="color:red;" >*</span></label>
                                                <input type="text" name="premium" class="form-control" required >
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <label class="form-label">Revenue</label>
                                                <input type="text" name="revenue" class="form-control" >
                                            </div>
                                            
                                            <div class="col-md-3 mb-3">
                                                <label class="form-label">Chassiss&nbsp; No.</label>
                                                <input type="text" name="chassiss" class="form-control" >
                                            </div>
                                            
                                            <div class="col-md-3 mb-3">
                                                <label class="form-label">Document</label>
                                                <input type="file" name="files[]" multiple class="form-control">
                                            </div>
                                            
                                            
                                            <div class="col-md-3 mb-3">
                                                <label class="form-label">RC Copy</label>
                                                <input type="file" name="rc[]" multiple class="form-control">
                                            </div>

                                            
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Add Remark</label>
                                                <textarea class="form-control" name="comments"  ></textarea>
                                            </div>
                                            
                                            
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Add follow up comment</label>
                                                <textarea class="form-control" name="comments"  ></textarea>
                                            </div>
                                            <div class="col-md-12" >
                                                <button class="btn btn-primary btn-sm" style="float: right;" > Add</button>
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