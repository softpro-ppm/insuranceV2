<?php
	
	require 'session.php';
	require 'config.php';

	$id = $_POST['id'];

	$sql = mysqli_query($con, "delete from policy where id='".$id."'");
	if($sql){
		echo "Policy delete successfully";
	}else{
		echo "please try again";
	}
	

// Include database connection
include 'account.php'; // This provides the $acc connection

// Get the insurance_id to delete — you can also use $_POST or $_GET
$insurance_id = $id; //$policy_id; // Make sure this variable is set

// Prepare DELETE query
$stmt = $acc->prepare("DELETE FROM income WHERE insurance_id = ?");
$stmt->bind_param("s", $insurance_id);

// Execute
if ($stmt->execute()) {
    if ($stmt->affected_rows > 0) {
        echo "✅ Record with insurance ID $insurance_id deleted successfully.";
    } else {
        echo "⚠️ No record found with insurance ID $insurance_id.";
    }
} else {
    echo "❌ Delete error: " . $stmt->error;
}

// Close
$stmt->close();
$acc->close();


?>