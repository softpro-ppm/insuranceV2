<?php
	require 'session.php';
	require 'config.php';

	$pageno = $_POST['pageno'];

	$sql = mysqli_query($con, "insert into pages (pageno) values ('$pageno')");

	if($sql){
		echo "Page no added";
	}else{
		echo "please try again";
	}
?>