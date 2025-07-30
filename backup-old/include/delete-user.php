<?php
	
	require 'session.php';
	require 'config.php';

	$id = $_POST['id'];

	$sql = mysqli_query($con, "delete from user where id  = '$id'");

	if($sql){
		echo "User Deleted Successfully";
	}else{
		echo "Please try again";
	}
?>