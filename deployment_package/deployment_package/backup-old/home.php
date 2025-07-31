<?php 
    include 'include/session.php';
    include 'include/config.php'; 
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Dashboard | Softpro</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="assets/logo.PNG">
    <link href="assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
    <link href="assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
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
                    <div class="row text-end" >
                        <div class="col-xl-12 " >
                            <a href="add.php" style="float: right;margin-bottom: 15px;" class="btn btn-outline-primary" ><i class="fa fa-plus" ></i>Add Policy</a>
                        </div>
                    </div>
                </div>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="row">
                                <?php  
                                    $sql1 = mysqli_query($con, "select * from policy where month(policy_issue_date) ='".date('m')."' and year(policy_issue_date)='".date('Y')."'  ");
                                    $totalpolicy = mysqli_num_rows($sql1);
                                ?>
                                <div class="col-md-3">
                                    <div class="card mini-stats-wid">
                                        <div class="card-body" style="background-color: #17a2b8 !important;">
                                            <div class="d-flex">
                                                <div class="flex-grow-1">
                                                    <a href="policies.php?latest=latest">     
                                                        <p class="text-muted fw-medium" style="color: white !important;">Policies</p>
                                                        <h4 class="mb-0" style="color:white"><?=$totalpolicy?></h4>
                                                    </a>    
                                                </div>
                                                <div class="flex-shrink-0 align-self-center">
                                                    <div class="mini-stat-icon avatar-sm rounded-circle bg-primary" style="color:white"> <span class="avatar-title">
                                                                <i class="bx bx-copy-alt font-size-24"></i>
                                                            </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php  
                                    $totalpremium = 0;
                                    $sql3 = mysqli_query($con, "select * from policy where month(policy_issue_date) ='".date('m')."' and year(policy_issue_date)='".date('Y')."' ");
                                    while($totalpremiumr = mysqli_fetch_array($sql3)){
                                        $totalpremium +=$totalpremiumr['premium'];
                                    }
                                ?>
                                <div class="col-md-3">
                                    <div class="card mini-stats-wid">
                                        <div class="card-body" style="background-color: #28a745!important;">
                                            <div class="d-flex">
                                                <div class="flex-grow-1">
                                                    <p class="text-muted fw-medium" style="color: white !important;">Premium</p>
                                                    <h4 class="mb-0" style="color: white !important;">&#8377;<?=$totalpremium;?></h4>
                                                </div>
                                                <div class="flex-shrink-0 align-self-center ">
                                                    <div class="avatar-sm rounded-circle bg-primary mini-stat-icon"> <span class="avatar-title rounded-circle bg-primary">
                                                                <i class="bx bx-archive-in font-size-24"></i>
                                                            </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php  
                                     $renewalsql = mysqli_query($con, "select * from policy where month(policy_end_date) ='".date("m")."' and year(policy_end_date)='".date("Y")."' ");
                                     
                                    //  $renewalsql = mysqli_query($con, "select * from policy where month(policy_end_date)='".date('m')."' and year(policy_end_date)='".date('Y')."' ");
                                    
                                  //  $renewalsql = mysqli_query($con, "SELECT * FROM history WHERE MONTH(policy_end_date) >= '".date("m")."' AND YEAR(policy_end_date) = '".date("Y")."'");

                                    
                                    $renewaltotal = mysqli_num_rows($renewalsql);
                                ?>
                                <div class="col-md-3">
                                    <div class="card mini-stats-wid">
                                        <div class="card-body" style="background-color: #ffc107!important;">
                                            <div class="d-flex">
                                                <div class="flex-grow-1">
                                                    <a href="manage-renewal.php?renewal=renewal">
                                                        <p class="text-muted fw-medium" style="color: white !important;">Total Renewal</p>
                                                        <h4 class="mb-0" style="color: white !important;"><?=$renewaltotal;?></h4>
                                                    </a>
                                                </div>
                                                <div class="flex-shrink-0 align-self-center">
                                                    <div class="avatar-sm rounded-circle bg-primary mini-stat-icon"> <span class="avatar-title rounded-circle bg-primary">
                                                                <i class="bx bx-purchase-tag-alt font-size-24"></i>
                                                            </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php  
                                    $pendingrenewalsql = mysqli_query($con, "select * from policy where month(policy_end_date) ='".date("m")."' and year(policy_end_date)='".date("Y")."' ");
                                    $pendingrenewaltotal = mysqli_num_rows($pendingrenewalsql);
                                ?>
                                <div class="col-md-3">
                                    <div class="card mini-stats-wid">
                                        <div class="card-body" style="background-color: #dc3545!important;">
                                            <div class="d-flex">
                                                <div class="flex-grow-1">
                                                    <a href="manage-renewal.php?pending=pending">
                                                        <p class="text-muted fw-medium" style="color: white !important;">Pending Renewal</p>
                                                        <h4 class="mb-0" style="color: white !important;"><?=$pendingrenewaltotal?></h4>
                                                    </a>
                                                </div>
                                                <div class="flex-shrink-0 align-self-center">
                                                    <div class="avatar-sm rounded-circle bg-primary mini-stat-icon"> <span class="avatar-title rounded-circle bg-primary">
                                                                <i class="bx bx-purchase-tag-alt font-size-24"></i>
                                                            </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end row -->
                            
                            <!--Bar chart start-->
                            
                            <div class="card card-success">
                              <div class="card-header">
                                <!--<h3 class="card-title">Bar Chart</h3>-->
                                <div class="ms-auto">
                                            <ul class="nav nav-pills">
                                                <li class="nav-item"> 
                                                    <select class="form-control" id="year" >
                                                        <option>Select</option>
                                                        <?php if($_GET['year'] == '2019'){ ?>
                                                        <option selected value="2019" >2019</option>
                                                        <?php }else{ ?>
                                                        <option value="2019" >2019</option>
                                                        <?php } ?>
                                                        <?php if($_GET['year'] == '2020'){ ?>
                                                        <option selected value="2020" >2020</option>
                                                        <?php }else{ ?>
                                                        <option value="2020" >2020</option>
                                                        <?php } ?>
                                                        <?php if($_GET['year'] == '2021'){ ?>
                                                        <option selected value="2021" >2021</option>
                                                        <?php }else{ ?>
                                                        <option value="2021" >2021</option>
                                                        <?php } ?>
                                                        <?php if($_GET['year'] == '2022'){ ?>
                                                        <option selected value="2022" >2022</option>
                                                        <?php }else{ ?>
                                                        <option value="2022" >2022</option>
                                                        <?php } ?>
                                                        <?php if($_GET['year'] == '2023'){ ?>
                                                        <option selected value="2023" >2023</option>
                                                        <?php }else{ ?>
                                                        <option value="2023" >2023</option>
                                                        <?php } ?>
                                                        <?php if($_GET['year'] == '2024'){ ?>
                                                        <option selected value="2024" >2024</option>
                                                        <?php }else{ ?>
                                                        <option value="2024" >2024</option>
                                                        <?php } ?>
                                                        <?php if($_GET['year'] == '2025'){ ?>
                                                        <option selected value="2025" >2025</option>
                                                        <?php }else{ ?>
                                                        <option value="2025" >2025</option>
                                                        <?php } ?>
                                                        
                                                    </select>
                                                </li>
                                            </ul>
                                        </div>
                
                                <div class="card-tools">
                                
                                </div>
                              </div>
                              <div class="card-body">
                                <div class="chart">
                                  <canvas id="barChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                                </div>
                              </div>
                              <!-- /.card-body -->
                            </div>  
                            
                             <!--Bar chart start-->
            
                            <?php /*
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-sm-flex flex-wrap">
                                        <h4 class="card-title mb-4">Premium</h4>
                                        <div class="ms-auto">
                                            <ul class="nav nav-pills">
                                                <li class="nav-item"> 
                                                    <select class="form-control" id="year" >
                                                        <option>Select</option>
                                                        <?php if($_GET['year'] == '2019'){ ?>
                                                        <option selected value="2019" >2019</option>
                                                        <?php }else{ ?>
                                                        <option value="2019" >2019</option>
                                                        <?php } ?>
                                                        <?php if($_GET['year'] == '2020'){ ?>
                                                        <option selected value="2020" >2020</option>
                                                        <?php }else{ ?>
                                                        <option value="2020" >2020</option>
                                                        <?php } ?>
                                                        <?php if($_GET['year'] == '2021'){ ?>
                                                        <option selected value="2021" >2021</option>
                                                        <?php }else{ ?>
                                                        <option value="2021" >2021</option>
                                                        <?php } ?>
                                                        <?php if($_GET['year'] == '2022'){ ?>
                                                        <option selected value="2022" >2022</option>
                                                        <?php }else{ ?>
                                                        <option value="2022" >2022</option>
                                                        <?php } ?>
                                                        <?php if($_GET['year'] == '2023'){ ?>
                                                        <option selected value="2023" >2023</option>
                                                        <?php }else{ ?>
                                                        <option value="2023" >2023</option>
                                                        <?php } ?>
                                                        <?php if($_GET['year'] == '2024'){ ?>
                                                        <option selected value="2024" >2024</option>
                                                        <?php }else{ ?>
                                                        <option value="2024" >2024</option>
                                                        <?php } ?>
                                                        <?php if($_GET['year'] == '2025'){ ?>
                                                        <option selected value="2025" >2025</option>
                                                        <?php }else{ ?>
                                                        <option value="2025" >2025</option>
                                                        <?php } ?>
                                                        
                                                    </select>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div id="premium-chart" class="apex-charts" dir="ltr"></div>
                                </div>
                            </div>  */ ?>
                            <!--<div class="card">-->
                            <!--    <div class="card-body">-->
                            <!--        <div class="d-sm-flex flex-wrap">-->
                            <!--            <h4 class="card-title mb-4">Policies</h4>-->
                            <!--        </div>-->
                            <!--        <div id="policies-chart" class="apex-charts" dir="ltr"></div>-->
                            <!--    </div>-->
                            <!--</div>-->
                            <!--<div class="card">-->
                            <!--    <div class="card-body">-->
                            <!--        <div class="d-sm-flex flex-wrap">-->
                            <!--            <h4 class="card-title mb-4">Revenue</h4>-->
                            <!--        </div>-->
                            <!--        <div id="revenue-chart" class="apex-charts" dir="ltr"></div>-->
                            <!--    </div>-->
                            <!--</div>-->
                        </div>
                    </div> 
                    <div class="row" >
                        <div class="col-xl-6">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title mb-4">Policy type</h4>
                                    
                                    <div id="policy_type_chart" class="apex-charts" dir="ltr"></div>  
                                </div>
                            </div><!--end card-->
                            
                        </div>
                        <div class="col-xl-6">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title mb-4">Vehicles</h4>
                                    
                                    <div id="vehicle_chart" class="apex-charts" dir="ltr"></div>
                                </div>
                            </div><!--end card-->
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title mb-4">Renewal</h4>
                                    <div class="table-responsive">
                                        <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                                            <thead class="table-light">
                                                <tr>
                                                    <th class="text-center">S.No.</th>
                                                    <th class="text-center">VEHICLE&nbsp;NUMBER</th>
                                                    <th class="text-center">NAME</th>
                                                    <th class="text-center">PHONE</th>
                                                    <th class="text-center">VEHICLE&nbsp;TYPE</th>
                                                    <th class="text-center">POLICY&nbsp;TYPE</th>
                                                    <th class="text-center">INSURANCE&nbsp;COMPANY</th>
                                                    <th class="text-center">POLICY&nbsp;END DATE</th>
                                                    <th class="text-center">ACTIONS</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php  
                                                    $sn=1;
                                                    $renewalsql = mysqli_query($con, "select * from policy where month(policy_end_date)='".date('m')."' and year(policy_end_date)='".date('Y')."' ");
                                                    if(mysqli_num_rows($renewalsql) > 0 ){
                                                    while($renewalr=mysqli_fetch_array($renewalsql)){
                                                ?>
                                                <tr>
                                                    <td class="text-center" ><?=$sn;?></td>
                                                    <td class="text-center" ><a href="javascript: void(0);" class="text-body fw-bold waves-effect waves-light" onclick="viewpolicy(this)" data-id="<?=$renewalr['id']?>" ><?=$renewalr['vehicle_number'];?></a></td>
                                                    <td class="text-center" ><?=$renewalr['name'];?></td>
                                                    <td class="text-center" ><?=$renewalr['phone'];?></td>
                                                    <td class="text-center" ><?=$renewalr['vehicle_type'];?></td>
                                                    <td class="text-center" ><?=$renewalr['policy_type'];?></td>
                                                    <td class="text-center" ><?=$renewalr['insurance_company'];?></td>
                                                    <td class="text-center" ><?=date('d-m-Y', strtotime($renewalr['policy_end_date']));?></td>
                                                    <td class="text-center" >
                                                        <a href="edit.php?id=<?=$renewalr['id'];?>" class="btn btn-outline-primary btn-sm edit" ><i class="fas fa-pencil-alt" ></i></a>
                                                        <!-- <a href="javascript:void(0);" class="btn btn-outline-danger btn-sm edit" ><i class="fas fa-trash-alt" ></i></a> -->
                                                    </td>
                                                </tr>
                                                <?php $sn++; } }else{ ?>

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
    <?php  
        $totaldata = array();
        $totalpremium = array();
        $totalrevenue = array();
        $monthname = array();
        if(!empty($_GET['year'])){
        $monthsql = mysqli_query($con, "SELECT COUNT(*) as total, SUM(premium) as totalpremium, SUM(revenue) as totalrevenue, month(policy_issue_date) as month, policy_issue_date FROM policy where year(policy_issue_date)='".$_GET['year']."' GROUP BY month");
        }else{
        $monthsql = mysqli_query($con, "SELECT COUNT(*) as total, SUM(premium) as totalpremium, SUM(revenue) as totalrevenue, month(policy_issue_date) as month, policy_issue_date FROM policy where year(policy_issue_date)='".date('Y')."' GROUP BY month");
        }
        while ($monthr = mysqli_fetch_array($monthsql)) {
            $totaldata[] = $monthr['total'];
            $totalpremium[] = $monthr['totalpremium'];
            $totalrevenue[] = $monthr['totalrevenue'];
            $monthname[] = date('M y', strtotime($monthr['policy_issue_date']));
        }

    ?>
    <?php  
        $annualdata = array();
        $annualname = array();
        if(!empty($_GET['year'])){
        $annualsql = mysqli_query($con, "SELECT COUNT(*) as total, vehicle_type FROM `policy` where year(policy_issue_date)='".$_GET['year']."' GROUP BY vehicle_type");
        }else{
        $annualsql = mysqli_query($con, "SELECT COUNT(*) as total, vehicle_type FROM `policy` where year(policy_issue_date)='".date('Y')."' GROUP BY vehicle_type");
        }
        while ($annualr = mysqli_fetch_array($annualsql)) {
            $annualdata[] = $annualr['total'];
            $annualname[] = $annualr['vehicle_type'];
        }

    ?>
    <?php  
        $policytypedata = array();
        $policytypename = array();
        if(!empty($_GET['year'])){
        $policytypesql = mysqli_query($con, "SELECT COUNT(*) as total, policy_type FROM `policy` where year(policy_issue_date)='".$_GET['year']."' GROUP BY policy_type");
        }else{
        $policytypesql = mysqli_query($con, "SELECT COUNT(*) as total, policy_type FROM `policy` where year(policy_issue_date)='".date('Y')."' GROUP BY policy_type");
        }
        while ($policytyper = mysqli_fetch_array($policytypesql)) {
            $policytypedata[] = $policytyper['total'];
            $policytypename[] = $policytyper['policy_type'];
        }
        
     //   print_r($policytypedata);
        
        
       

    ?>
    <script src="assets/libs/jquery/jquery.min.js"></script>
    <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/libs/metismenu/metisMenu.min.js"></script>
    <script src="assets/libs/simplebar/simplebar.min.js"></script>
    <script src="assets/libs/node-waves/waves.min.js"></script>
    <script src="assets/libs/apexcharts/apexcharts.min.js"></script>
    <script src="assets/js/pages/dashboard.init.js"></script>
    <script src="assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="assets/js/pages/datatables.init.js"></script>
    <script src="assets/js/app.js"></script>
    
    
    <!--Bar chart script start-->
    
    <!-- ChartJS -->
    <script src="https://adminlte.io/themes/v3/plugins/chart.js/Chart.min.js"></script>
    
    
    <script>
  $(function () {
    /* ChartJS
     * -------
     * Here we will create a few charts using ChartJS
     */


     var areaChartData = {
     // labels  : ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
    //  labels  : ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
      labels  : ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
      datasets: [
        {
          label               : 'Premium',
          backgroundColor     : 'rgba(60,141,188,0.9)',
          borderColor         : 'rgba(60,141,188,0.8)',
          pointRadius          : false,
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(60,141,188,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                : ['<?=$totalpremium[0]?>', '<?=$totalpremium[1]?>', '<?=$totalpremium[2]?>', '<?=$totalpremium[3]?>', '<?=$totalpremium[4]?>', '<?=$totalpremium[5]?>', '<?=$totalpremium[6]?>','<?=$totalpremium[7]?>','<?=$totalpremium[8]?>','<?=$totalpremium[9]?>','<?=$totalpremium[10]?>','<?=$totalpremium[11]?>']
        },
        {
          label               : 'Policies',
          backgroundColor     : '#FF0000',
          borderColor         : '#000',
          pointRadius          : false,
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(60,141,188,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                : ['<?=$totaldata[0]?>', '<?=$totaldata[1]?>', '<?=$totaldata[2]?>', '<?=$totaldata[3]?>', '<?=$totaldata[4]?>', '<?=$totaldata[5]?>', '<?=$totaldata[6]?>','<?=$totaldata[7]?>','<?=$totaldata[8]?>','<?=$totaldata[9]?>','<?=$totaldata[10]?>','<?=$totaldata[11]?>']
        },
        {
          label               : 'Revenue',
          backgroundColor     : 'rgba(210, 214, 222, 1)',
          borderColor         : 'rgba(210, 214, 222, 1)',
          pointRadius         : false,
          pointColor          : 'rgba(210, 214, 222, 1)',
          pointStrokeColor    : '#c1c7d1',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data                : ['<?=$totalrevenue[0]?>', '<?=$totalrevenue[1]?>', '<?=$totalrevenue[2]?>', '<?=$totalrevenue[3]?>', '<?=$totalrevenue[4]?>', '<?=$totalrevenue[5]?>', '<?=$totalrevenue[6]?>','<?=$totalrevenue[7]?>','<?=$totalrevenue[8]?>','<?=$totalrevenue[9]?>','<?=$totalrevenue[10]?>','<?=$totalrevenue[11]?>']
        },
      ]
    }

    //-------------
    //- BAR CHART -
   //- BAR CHART -
    //-------------
    var barChartData = $.extend(true, {}, areaChartData)
    var temp0 = areaChartData.datasets[0]
    var temp1 = areaChartData.datasets[1]
    barChartData.datasets[0] = temp1
    barChartData.datasets[1] = temp0

    var barChartOptions = {
      responsive              : true,
      maintainAspectRatio     : false,
      datasetFill             : false
    }

    //---------------------
    //- STACKED BAR CHART -
    //---------------------
    var stackedBarChartCanvas = $('#barChart').get(0).getContext('2d')
  //  var stackedBarChartCanva1 = $('#stackedBarChart').get(0).getContext('2d')
    var stackedBarChartData = $.extend(true, {}, barChartData)

    var stackedBarChartOptions = {
      responsive              : true,
      maintainAspectRatio     : false,
      scales: {
        xAxes: [{
          stacked: true,
        }],
        yAxes: [{
          stacked: true
        }]
      }
    }

    new Chart(stackedBarChartCanvas, {
      type: 'bar',
      data: stackedBarChartData,
      options: stackedBarChartOptions
    })
  })
</script>
    
    <!--Barchart script end-->
    
    
    
    <script type="text/javascript">
        function viewpolicy(identifier) {
            var id= $(identifier).data("id");
            $('#renewalpolicyview').modal("show");
            $.post("include/view-policy.php",{ id:id }, function(data) {
                $('#viewpolicydata').html(data);
            });
        }
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#year').on("change", function () {
                window.location.href='home.php?year='+$(this).val();
            });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            var options = {
                chart: {
                    height: 300,
                    type: "bar",
                    stacked: !0,
                    toolbar: {
                        show: !1
                    },
                    zoom: {
                        enabled: !0
                    }
                },
                plotOptions: {
                    bar: {
                        horizontal: !1,
                        columnWidth: "15%",
                        endingShape: "rounded"
                    }
                },
                dataLabels: {
                    enabled: !1
                },
                series: [{
                    name: "Premium",
                    data: <?=json_encode($totalpremium,JSON_NUMERIC_CHECK);?>
                }],
                xaxis: {
                    categories: <?=json_encode($monthname,true);?>
                },
                colors: ["#556ee6"],
                legend: {
                    position: "bottom"
                },
                fill: {
                    opacity: 1
                }
            },
            chart = new ApexCharts(document.querySelector("#premium-chart"), options);
            chart.render();
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            var options = {
                chart: {
                    height: 300,
                    type: "bar",
                    stacked: !0,
                    toolbar: {
                        show: !1
                    },
                    zoom: {
                        enabled: !0
                    }
                },
                plotOptions: {
                    bar: {
                        horizontal: !1,
                        columnWidth: "15%",
                        endingShape: "rounded"
                    }
                },
                dataLabels: {
                    enabled: !1
                },
                series: [{
                    name: "Policies",
                    data: <?=json_encode($totaldata,JSON_NUMERIC_CHECK);?>
                }],
                xaxis: {
                    categories: <?=json_encode($monthname,true);?>
                },
                colors: ["#f1b44c"],
                legend: {
                    position: "bottom"
                },
                fill: {
                    opacity: 1
                }
            },
            chart = new ApexCharts(document.querySelector("#policies-chart"), options);
            chart.render();
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            var options = {
                chart: {
                    height: 300,
                    type: "bar",
                    stacked: !0,
                    toolbar: {
                        show: !1
                    },
                    zoom: {
                        enabled: !0
                    }
                },
                plotOptions: {
                    bar: {
                        horizontal: !1,
                        columnWidth: "15%",
                        endingShape: "rounded"
                    }
                },
                dataLabels: {
                    enabled: !1
                },
                series: [{
                    name: "Revenue",
                    data: <?=json_encode($totalrevenue,JSON_NUMERIC_CHECK);?>
                }],
                xaxis: {
                    categories: <?=json_encode($monthname,true);?>
                },
                colors: ["#34c38f"],
                legend: {
                    position: "bottom"
                },
                fill: {
                    opacity: 1
                }
            },
            chart = new ApexCharts(document.querySelector("#revenue-chart"), options);
            chart.render();
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function(){
            options = {
                chart: {
                    height: 350,
                    type: "bar",
                    toolbar: {
                        show: !1
                    }
                },
                plotOptions: {
                    bar: {
                        horizontal: !0
                    }
                },
                dataLabels: {
                    enabled: !1
                },
                series: [{
                    data: <?=json_encode($annualdata,JSON_NUMERIC_CHECK);?>
                }],
                colors: ["#34c38f"],
                grid: {
                    borderColor: "#f1f1f1"
                },
                xaxis: {
                    categories: <?=json_encode($annualname,true);?>
                }
            };
            (chart = new ApexCharts(document.querySelector("#vehicle_chart"), options)).render();
        });
        $(document).ready(function() {
            options = {
                chart: {
                    height: 370,
                    type: "radialBar"
                },
                plotOptions: {
                    radialBar: {
                        dataLabels: {
                            name: {
                                fontSize: "22px"
                            },
                            value: {
                                fontSize: "16px"
                            },
                            total: {
                                show: !0,
                                label: "Total",
                                formatter: function (e) {
                                    return 100
                                }
                            }
                        }
                    }
                },
                series: <?=json_encode($policytypedata,JSON_NUMERIC_CHECK);?>,
                labels: <?=json_encode($policytypename,true);?>,
                colors: ["#556ee6", "#34c38f", "#f46a6a"]
            };
            (chart = new ApexCharts(document.querySelector("#policy_type_chart"), options)).render();
        });
    </script>
</body>

</html>