<?php  
    require 'include/session.php';
    require 'include/config.php';
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Update Policy | Softpro</title>
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
                                <h4 class="mb-sm-0 font-size-18">Update Policy</h4>
                            </div>
                        </div>
                    </div>
                    <?php  
                        $id = $_GET['id'];
                        $sql = mysqli_query($con, "select * from policy where id='".$id."'");
                        $r = mysqli_fetch_array($sql);
                    ?>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <form action="include/edit-policies.php" method="post" enctype="multipart/form-data" autocomplete="OFF" >
                                        <div class="row">
                                            <input type="hidden" value="<?=$id;?>" name="id">
                                            <div class="col-md-3 mb-3">
                                                <label class="form-label">Vehicle Number&nbsp;<span style="color:red;" >*</span></label>
                                                <input type="text" name="vehicle_number" value="<?=$r['vehicle_number']?>" class="form-control uppercase" required >
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <label class="custome-css-label">Phone Number&nbsp;<span style="color:red;" >*</span></label>
                                                <input type="text" name="phone" value="<?=$r['phone']?>" oninput="numberOnly(this.id);" maxlength="10" id="card_number_validation" class="form-control" required >
                                            </div>
                                            <div class="col-md-3 mb-3" >
                                                <label class="custome-css-label">Full Name&nbsp;<span style="color:red;" >*</span></label>
                                               <input type="text" value="<?=$r['name']?>" name="name" class="form-control uppercase" required >
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <label class="form-label">Vehicle Type&nbsp;<span style="color:red;" >*</span></label>
                                                <select name="vehicle_type" id="vehicle_type" class="form-control select2" required >
                                                    <option value="" >Select</option>
                                                    <?php if($r['vehicle_type'] == 'Auto'){ ?>
                                                    <option selected value="Auto" >Auto</option>
                                                    <?php }else{ ?>
                                                    <option value="Auto" >Auto</option>
                                                    <?php } ?>
                                                    <?php if($r['vehicle_type'] == 'Tractor'){ ?>
                                                    <option selected value="Tractor" >Tractor</option>
                                                    <?php }else{ ?>
                                                    <option value="Tractor" >Tractor</option>
                                                    <?php } ?>
                                                    <?php if($r['vehicle_type'] == 'Two Wheeler'){ ?>
                                                    <option selected value="Two Wheeler" >Two Wheeler</option>
                                                    <?php }else{ ?>
                                                    <option value="Two Wheeler" >Two Wheeler</option>
                                                    <?php } ?>
                                                    <?php if($r['vehicle_type'] == 'Car'){ ?>
                                                    <option selected value="Car" >Car</option>
                                                    <?php }else{ ?>
                                                    <option value="Car" >Car</option>
                                                    <?php } ?>
                                                    <?php if($r['vehicle_type'] == 'Trailer'){ ?>
                                                    <option selected value="Trailer" >Trailer</option>
                                                    <?php }else{ ?>
                                                    <option value="Trailer" >Trailer</option>
                                                    <?php } ?>
                                                    <?php if($r['vehicle_type'] == 'Bolero'){ ?>
                                                    <option selected value="Bolero" >Bolero</option>
                                                    <?php }else{ ?>
                                                    <option value="Bolero" >Bolero</option>
                                                    <?php } ?>
                                                    <?php if($r['vehicle_type'] == 'Lorry'){ ?>
                                                    <option selected value="Lorry" >Lorry</option>
                                                    <?php }else{ ?>
                                                    <option value="Lorry" >Lorry</option>
                                                    <?php } ?>
                                                    <?php if($r['vehicle_type'] == 'JCB'){ ?>
                                                    <option selected value="JCB" >JCB</option>
                                                    <?php }else{ ?>
                                                    <option value="JCB" >JCB</option>
                                                    <?php } ?>
                                                    <?php if($r['vehicle_type'] == 'Bus'){ ?>
                                                    <option selected value="Bus" >Bus</option>
                                                    <?php }else{ ?>
                                                    <option value="Bus" >Bus</option>
                                                    <?php } ?>
                                                    <?php if($r['vehicle_type'] == 'Person'){ ?>
                                                    <option selected value="Person" >Person</option>
                                                    <?php }else{ ?>
                                                    <option value="Person" >Person</option>
                                                    <?php } ?>
                                                    <?php if($r['vehicle_type'] == 'Misc'){ ?>
                                                    <option selected value="Misc" >Misc</option>
                                                    <?php }else{ ?>
                                                    <option value="Misc" >Misc</option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <label class="form-label">Insurance&nbsp;Company&nbsp;Name&nbsp;<span style="color:red;" >*</span></label>
                                                <!--<select name="insurance_company" class="form-control select2" required="true" >-->
                                                <!--    <option value="" >Select</option>-->
                                                <!--    <?php if($r['insurance_company'] == 'Tata AIG'){ ?>-->
                                                <!--    <option selected value="Tata AIG" >Tata AIG</option>-->
                                                <!--    <?php }else{ ?>-->
                                                <!--    <option value="Tata AIG" >Tata AIG</option>-->
                                                <!--    <?php } ?>-->
                                                <!--    <?php if($r['insurance_company'] == 'Magma'){ ?>-->
                                                <!--    <option selected value="Magma" >Magma</option>-->
                                                <!--    <?php }else{ ?>-->
                                                <!--    <option value="Magma" >Magma</option>-->
                                                <!--    <?php } ?>-->
                                                <!--    <?php if($r['insurance_company'] == 'ICICI Lombard'){ ?>-->
                                                <!--    <option selected value="ICICI Lombard" >ICICI Lombard</option>-->
                                                <!--    <?php }else{ ?>-->
                                                <!--    <option value="ICICI Lombard" >ICICI Lombard</option>-->
                                                <!--    <?php } ?>-->
                                                <!--    <?php if($r['insurance_company'] == 'Future Generali Insurance'){ ?>-->
                                                <!--    <option selected value="Future Generali Insurance" >Future Generali insurance</option>-->
                                                <!--    <?php }else{ ?>-->
                                                <!--    <option value="Future Generali Insurance" >Future Generali Insurance</option>-->
                                                <!--    <?php } ?>-->
                                                <!--    <?php if($r['insurance_company'] == 'Bajaj Allianz'){ ?>-->
                                                <!--    <option selected value="Bajaj Allianz" >Bajaj Allianz</option>-->
                                                <!--    <?php }else{ ?>-->
                                                <!--    <option value="Bajaj Allianz" >Bajaj Allianz</option>-->
                                                <!--    <?php } ?>-->
                                                <!--    <?php if($r['insurance_company'] == 'SBI General Insurance'){ ?>-->
                                                <!--    <option selected value="SBI General Insurance" >SBI General Insurance</option>-->
                                                <!--    <?php }else{ ?>-->
                                                <!--    <option value="SBI General Insurance" >SBI General Insurance</option>-->
                                                <!--    <?php } ?>-->
                                                <!--    <?php if($r['insurance_company'] == 'HDFC Ergo'){ ?>-->
                                                <!--    <option selected value="HDFC Ergo" >HDFC Ergo</option>-->
                                                <!--    <?php }else{ ?>-->
                                                <!--    <option value="HDFC Ergo" >HDFC Ergo</option>-->
                                                <!--    <?php } ?>-->
                                                <!--    <?php if($r['insurance_company'] == 'United India'){ ?>-->
                                                <!--    <option selected value="United India" >United India</option>-->
                                                <!--    <?php }else{ ?>-->
                                                <!--    <option value="United India" >United India</option>-->
                                                <!--    <?php } ?>-->
                                                <!--    <?php if($r['insurance_company'] == 'Cholamandal'){ ?>-->
                                                <!--    <option selected value="Cholamandal" >Cholamandal</option>-->
                                                <!--    <?php }else{ ?>-->
                                                <!--    <option  value="Cholamandal" >Cholamandal</option>-->
                                                <!--    <?php } ?>-->
                                                <!--    <?php if($r['insurance_company'] == 'Go Digit'){ ?>-->
                                                <!--    <option selected value="Go Digit" >Go Digit</option>-->
                                                <!--    <?php }else{ ?>-->
                                                <!--    <option value="Go Digit" >Go Digit</option>-->
                                                <!--    <?php } ?>-->
                                                <!--    <?php if($r['insurance_company'] == 'Royal Sundaram'){ ?>-->
                                                <!--    <option selected value="Royal Sundaram" >Royal Sundaram</option>-->
                                                <!--    <?php }else{ ?>-->
                                                <!--    <option value="Royal Sundaram" >Royal Sundaram</option>-->
                                                <!--    <?php } ?>-->
                                                <!--    <?php if($r['insurance_company'] == 'Reliance'){ ?>-->
                                                <!--    <option selected value="Reliance" >Reliance</option>-->
                                                <!--    <?php }else{ ?>-->
                                                <!--    <option value="Reliance" >Reliance</option>-->
                                                <!--    <?php } ?>-->
                                                <!--    <?php if($r['insurance_company'] == 'Shriram'){ ?>-->
                                                <!--    <option selected value="Shriram" >Shriram</option>-->
                                                <!--    <?php }else{ ?>-->
                                                <!--    <option value="Shriram" >Shriram</option>-->
                                                <!--    <?php } ?>-->
                                                <!--    <?php if($r['insurance_company'] == 'Health Insurance'){ ?>-->
                                                <!--    <option selected value="Health Insurance" >Health Insurance</option>-->
                                                <!--    <?php }else{ ?>-->
                                                <!--    <option value="Health Insurance" >Health Insurance</option>-->
                                                <!--    <?php } ?>-->
                                                <!--</select>-->
                                                
                                                
                                                <select name="insurance_company" class="form-control select2" required="true" >
                                                <option value="">Select</option>
                                                <?php if($r['insurance_company'] == 'Tata AIG'){ ?>
                                                <option selected value="Tata AIG">Tata AIG</option>
                                                <?php }else{ ?>
                                                <option value="Tata AIG">Tata AIG</option>
                                                <?php } ?>
                                            
                                                <?php if($r['insurance_company'] == 'Magma'){ ?>
                                                <option selected value="Magma">Magma</option>
                                                <?php }else{ ?>
                                                <option value="Magma">Magma</option>
                                                <?php } ?>
                                            
                                                <?php if($r['insurance_company'] == 'ICICI Lombard'){ ?>
                                                <option selected value="ICICI Lombard">ICICI Lombard</option>
                                                <?php }else{ ?>
                                                <option value="ICICI Lombard">ICICI Lombard</option>
                                                <?php } ?>
                                            
                                                <?php if($r['insurance_company'] == 'Future Generali Insurance'){ ?>
                                                <option selected value="Future Generali Insurance">Future Generali Insurance</option>
                                                <?php }else{ ?>
                                                <option value="Future Generali Insurance">Future Generali Insurance</option>
                                                <?php } ?>
                                            
                                                <?php if($r['insurance_company'] == 'Bajaj Allianz'){ ?>
                                                <option selected value="Bajaj Allianz">Bajaj Allianz</option>
                                                <?php }else{ ?>
                                                <option value="Bajaj Allianz">Bajaj Allianz</option>
                                                <?php } ?>
                                            
                                                <?php if($r['insurance_company'] == 'SBI General Insurance'){ ?>
                                                <option selected value="SBI General Insurance">SBI General Insurance</option>
                                                <?php }else{ ?>
                                                <option value="SBI General Insurance">SBI General Insurance</option>
                                                <?php } ?>
                                            
                                                <?php if($r['insurance_company'] == 'HDFC Ergo'){ ?>
                                                <option selected value="HDFC Ergo">HDFC Ergo</option>
                                                <?php }else{ ?>
                                                <option value="HDFC Ergo">HDFC Ergo</option>
                                                <?php } ?>
                                            
                                                <?php if($r['insurance_company'] == 'United India'){ ?>
                                                <option selected value="United India">United India</option>
                                                <?php }else{ ?>
                                                <option value="United India">United India</option>
                                                <?php } ?>
                                            
                                                <?php if($r['insurance_company'] == 'New India Insurance'){ ?>
                                                <option selected value="New India Insurance">New India Insurance</option>
                                                <?php }else{ ?>
                                                <option value="New India Insurance">New India Insurance</option>
                                                <?php } ?>
                                            
                                                <?php if($r['insurance_company'] == 'Cholamandal'){ ?>
                                                <option selected value="Cholamandal">Cholamandal</option>
                                                <?php }else{ ?>
                                                <option value="Cholamandal">Cholamandal</option>
                                                <?php } ?>
                                            
                                                <?php if($r['insurance_company'] == 'Go Digit'){ ?>
                                                <option selected value="Go Digit">Go Digit</option>
                                                <?php }else{ ?>
                                                <option value="Go Digit">Go Digit</option>
                                                <?php } ?>
                                            
                                                <?php if($r['insurance_company'] == 'Royal Sundaram'){ ?>
                                                <option selected value="Royal Sundaram">Royal Sundaram</option>
                                                <?php }else{ ?>
                                                <option value="Royal Sundaram">Royal Sundaram</option>
                                                <?php } ?>
                                            
                                                <?php if($r['insurance_company'] == 'Reliance'){ ?>
                                                <option selected value="Reliance">Reliance</option>
                                                <?php }else{ ?>
                                                <option value="Reliance">Reliance</option>
                                                <?php } ?>
                                            
                                                <?php if($r['insurance_company'] == 'Shriram'){ ?>
                                                <option selected value="Shriram">Shriram</option>
                                                <?php }else{ ?>
                                                <option value="Shriram">Shriram</option>
                                                <?php } ?>
                                            
                                                <?php if($r['insurance_company'] == 'Health Insurance'){ ?>
                                                <option selected value="Health Insurance">Health Insurance</option>
                                                <?php }else{ ?>
                                                <option value="Health Insurance">Health Insurance</option>
                                                <?php } ?>
                                            
                                                <?php if($r['insurance_company'] == 'Aditya Birla Health Insurance'){ ?>
                                                <option selected value="Aditya Birla Health Insurance">Aditya Birla Health Insurance</option>
                                                <?php }else{ ?>
                                                <option value="Aditya Birla Health Insurance">Aditya Birla Health Insurance</option>
                                                <?php } ?>
                                            
                                                <?php if($r['insurance_company'] == 'Care Health Insurance'){ ?>
                                                <option selected value="Care Health Insurance">Care Health Insurance</option>
                                                <?php }else{ ?>
                                                <option value="Care Health Insurance">Care Health Insurance</option>
                                                <?php } ?>
                                            
                                                <?php if($r['insurance_company'] == 'IFFCO-Tokio General Insurance Co. Ltd.'){ ?>
                                                <option selected value="IFFCO-Tokio General Insurance Co. Ltd.">IFFCO-Tokio General Insurance Co. Ltd.</option>
                                                <?php }else{ ?>
                                                <option value="IFFCO-Tokio General Insurance Co. Ltd.">IFFCO-Tokio General Insurance Co. Ltd.</option>
                                                <?php } ?>
                                            
                                                <?php if($r['insurance_company'] == 'Liberty India General Insurance'){ ?>
                                                <option selected value="Liberty India General Insurance">Liberty India General Insurance</option>
                                                <?php }else{ ?>
                                                <option value="Liberty India General Insurance">Liberty India General Insurance</option>
                                                <?php } ?>
                                            
                                                <?php if($r['insurance_company'] == 'Manipal Cigna Health Insurance'){ ?>
                                                <option selected value="Manipal Cigna Health Insurance">Manipal Cigna Health Insurance</option>
                                                <?php }else{ ?>
                                                <option value="Manipal Cigna Health Insurance">Manipal Cigna Health Insurance</option>
                                                <?php } ?>
                                            
                                                <?php if($r['insurance_company'] == 'National Insurance Co. Ltd.'){ ?>
                                                <option selected value="National Insurance Co. Ltd.">National Insurance Co. Ltd.</option>
                                                <?php }else{ ?>
                                                <option value="National Insurance Co. Ltd.">National Insurance Co. Ltd.</option>
                                                <?php } ?>
                                            
                                                <?php if($r['insurance_company'] == 'Niva Bupa Health Insurance Co. Ltd.'){ ?>
                                                <option selected value="Niva Bupa Health Insurance Co. Ltd.">Niva Bupa Health Insurance Co. Ltd.</option>
                                                <?php }else{ ?>
                                                <option value="Niva Bupa Health Insurance Co. Ltd.">Niva Bupa Health Insurance Co. Ltd.</option>
                                                <?php } ?>
                                            
                                                <?php if($r['insurance_company'] == 'The Oriental Insurance Co. Ltd.'){ ?>
                                                <option selected value="The Oriental Insurance Co. Ltd.">The Oriental Insurance Co. Ltd.</option>
                                                <?php }else{ ?>
                                                <option value="The Oriental Insurance Co. Ltd.">The Oriental Insurance Co. Ltd.</option>
                                                <?php } ?>
                                            
                                                <?php if($r['insurance_company'] == 'Raheja QBE General Insurance Co. Ltd.'){ ?>
                                                <option selected value="Raheja QBE General Insurance Co. Ltd.">Raheja QBE General Insurance Co. Ltd.</option>
                                                <?php }else{ ?>
                                                <option value="Raheja QBE General Insurance Co. Ltd.">Raheja QBE General Insurance Co. Ltd.</option>
                                                <?php } ?>
                                            
                                                <?php if($r['insurance_company'] == 'Star Health and Allied Insurance Co Ltd'){ ?>
                                                <option selected value="Star Health and Allied Insurance Co Ltd">Star Health and Allied Insurance Co Ltd</option>
                                                <?php }else{ ?>
                                                <option value="Star Health and Allied Insurance Co Ltd">Star Health and Allied Insurance Co Ltd</option>
                                                <?php } ?>
                                            
                                                <?php if($r['insurance_company'] == 'Universal Sompo General Insurance Co. Ltd.'){ ?>
                                                <option selected value="Universal Sompo General Insurance Co. Ltd.">Universal Sompo General Insurance Co. Ltd.</option>
                                                <?php }else{ ?>
                                                <option value="Universal Sompo General Insurance Co. Ltd.">Universal Sompo General Insurance Co. Ltd.</option>
                                                <?php } ?>
                                            
                                                <?php if($r['insurance_company'] == 'Zuno General Insurance Ltd.'){ ?>
                                                <option selected value="Zuno General Insurance Ltd.">Zuno General Insurance Ltd.</option>
                                                <?php }else{ ?>
                                                <option value="Zuno General Insurance Ltd.">Zuno General Insurance Ltd.</option>
                                                <?php } ?>
                                            
                                                <?php if($r['insurance_company'] == 'Zurich Kotak General Insurance Co. (India) Ltd.'){ ?>
                                                <option selected value="Zurich Kotak General Insurance Co. (India) Ltd.">Zurich Kotak General Insurance Co. (India) Ltd.</option>
                                                <?php }else{ ?>
                                                <option value="Zurich Kotak General Insurance Co. (India) Ltd.">Zurich Kotak General Insurance Co. (India) Ltd.</option>
                                                <?php } ?>
                                            
                                                <?php if($r['insurance_company'] == 'Life Insurance'){ ?>
                                                <option selected value="Life Insurance">Life Insurance</option>
                                                <?php }else{ ?>
                                                <option value="Life Insurance">Life Insurance</option>
                                                <?php } ?>
                                                
                                                <?php if($r['insurance_company'] == 'Term Insurance'){ ?>
                                                <option selected value="Term Insurance">Term Insurance</option>
                                                <?php }else{ ?>
                                                <option value="Term Insurance">Term Insurance</option>
                                                <?php } ?>
                                            </select>

                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <label class="form-label">Policy&nbsp;Type&nbsp;Name&nbsp;<span style="color:red;" >*</span></label>
                                                <select name="policy_type" class="form-control select2" required="true" >
                                                    <option value="" >Select</option>
                                                    <?php if($r['policy_type'] == 'Full'){ ?>
                                                    <option selected value="Full" >Full</option>
                                                    <?php }else{ ?>
                                                    <option value="Full" >Full</option>
                                                    <?php } ?>
                                                    <?php if($r['policy_type'] == 'Third Party'){ ?>
                                                    <option selected value="Third Party" >Third Party</option>
                                                    <?php }else{ ?>
                                                    <option value="Third Party" >Third Party</option>
                                                    <?php } ?>
                                                    <?php if($r['policy_type'] == 'Health'){ ?>
                                                    <option selected value="Health" >Health</option>
                                                    <?php }else{ ?>
                                                    <option value="Health" >Health</option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <label class="form-label">Policy&nbsp;Issue&nbsp;Date&nbsp;<span style="color:red;" >*</span></label>
                                                <input type="text" value="<?=date('d-m-Y', strtotime($r['policy_issue_date']));?>" name="policy_issue_date" class="form-control js-datepicker" required >
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <label class="form-label">Policy&nbsp;Start&nbsp;Date&nbsp;<span style="color:red;" >*</span></label>
                                                <input type="text" value="<?=date('d-m-Y', strtotime($r['policy_start_date']));?>" name="policy_start_date" id="policy_start_date" class="form-control js-datepicker" required >
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <label class="form-label">Policy&nbsp;End&nbsp;Date&nbsp;<span style="color:red;" >*</span></label>
                                                <input type="text" value="<?=date('d-m-Y', strtotime($r['policy_end_date']));?>" name="policy_end_date" id="policy_end_date" class="form-control js-datepicker" required >
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <label class="form-label">FC&nbsp;Expiry&nbsp;Date</label>
                                                <?php  
                                                if($r['fc_expiry_date'] ==''){
                                                    $fc_expiry_date = '';
                                                }else{
                                                    $fc_expiry_date = date('d-m-Y', strtotime($r['fc_expiry_date']));
                                                }
                                            ?>
                                                <input type="text" value="<?=$fc_expiry_date;?>" name="fc_expiry_date" class="form-control js-datepicker">
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <label class="form-label">Permit&nbsp;Expiry&nbsp;Date</label>
                                                <?php  
                                                    if($r['permit_expiry_date'] ==''){
                                                        $permit_expiry_date = '';
                                                    }else{
                                                        $permit_expiry_date = date('d-m-Y', strtotime($r['permit_expiry_date']));
                                                    }
                                                ?>
                                                <input type="text" value="<?=$permit_expiry_date;?>" name="permit_expiry_date" class="form-control js-datepicker">
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <label class="form-label">Premium&nbsp;<span style="color:red;" >*</span></label>
                                                <input type="text" value="<?=$r['premium'];?>" name="premium" class="form-control" required >
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <label class="form-label">Revenue</label>
                                                <input type="text" value="<?=$r['revenue'];?>" name="revenue" class="form-control" >
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
                                                <button class="btn btn-primary btn-sm" style="float: right;" > Update</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="col-xl-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <h4 class="card-title mb-5">Follow up activity</h4>
                                                <ul class="verti-timeline list-unstyled">
                                                    <?php  
                                                        $comments_sql = mysqli_query($con, "select *, u.photo as photo from comments c left join user u on u.username = c.user where c.policy_id = '".$id."' order by c.id desc ");
                                                        while($comments_r = mysqli_fetch_array($comments_sql)){
                                                    ?>
                                                    <li class="event-list">
                                                        <div class="event-timeline-dot" style="margin-top: -10px;left:-20px" >
                                                            <img class="rounded-circle header-profile-user" src="assets/profile/<?=$comments_r['photo'];?>" alt="Header Avatar">
                                                        </div>
                                                        <div class="d-flex">
                                                            <div class="flex-shrink-0 me-3">
                                                                <h5 class="font-size-14"> <?=$comments_r['user'];?> <i class="bx bx-right-arrow-alt font-size-16 text-primary align-middle ms-2"></i><?=date('d-m-Y h:s',strtotime($comments_r['date']));?><i class="bx bx-right-arrow-alt font-size-16 text-primary align-middle ms-2"></i></h5>
                                                            </div>
                                                            <div class="flex-grow-1">
                                                                <div>
                                                                    <?=$comments_r['comments'];?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <?php } ?>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
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