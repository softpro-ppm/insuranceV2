<?php
	require 'session.php';
	require 'config.php';

	$type = $_POST['type'];
	$name = $_POST['name'];
	$username = $_POST['username'];
	$phone = $_POST['phone'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	
	$sql = mysqli_query($con, "insert into user (type, name, username, phone, email, password, delete_flag ) values ('$type', '$name', '$username', '$phone', '$email', '$password', '1')");

	if($sql){
		echo "User Successfully Added";
	}else{
		echo "Failed to add";
	}

		
?>