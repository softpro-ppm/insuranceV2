<?php
	require 'session.php';
	require 'config.php';

	$id = $_POST['id'];
	$type = $_POST['type'];
	$name = $_POST['name'];
	$username = $_POST['username'];
	$phone = $_POST['phone'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	
	$sql = mysqli_query($con, "update user set type='$type', name='$name', username='$username', phone='$phone', email='$email', password='$password' where id='$id'");


	if($sql){
		echo "User Successfully Updated";
	}else{
		echo "please try again";
	}

		
?>