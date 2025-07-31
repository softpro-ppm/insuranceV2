<?php
include 'include/config.php';

$filename = "Policies.xls"; 
header("Content-Disposition: attachment; filename=\"$filename\"");
header("Content-Type: application/vnd.ms-excel");
$sql = mysqli_query($con, "SELECT name,phone,vehicle_number,vehicle_type,insurance_company,policy_type,policy_issue_date,policy_start_date,policy_end_date,fc_expiry_date,permit_expiry_date,premium,revenue FROM policy ORDER BY id DESC");

$flag = false;
while ($row = mysqli_fetch_assoc($sql)) {
    if (!$flag) {
        echo implode("\t", array_keys($row)) . "\r\n";
        $flag = true;
    }
    echo implode("\t", array_values($row)) . "\r\n";
}
?>