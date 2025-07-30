<?php
	require 'session.php';
	require 'config.php';

	$username = $_POST['username'];
	$password = $_POST['newpassword'];

	$sql = mysqli_query($con, "update user set password = '$password' where username='$username'");

	if($sql){
		echo "Password change successfully";
	}else{
		echo "Please try again";
	}
?>