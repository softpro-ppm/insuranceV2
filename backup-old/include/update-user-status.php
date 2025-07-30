<?php
	require 'session.php';
	require 'config.php';

	$id = $_POST['id'];

	if($_POST['status'] == '1'){
		$status = '0';
	}else{
		$status = '1';
	}

	mysqli_query($con, "update user set delete_flag='$status' where id='$id' ");
?>