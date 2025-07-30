<?php
	
	require 'session.php';
	require 'config.php';

	$id = $_POST['id'];

	$sql = mysqli_query($con, "delete from pages where id='$id'");
	if($sql){
		echo "page number Deleted Succesfully...";
	}else{
		echo "Please try again";
	}
?>