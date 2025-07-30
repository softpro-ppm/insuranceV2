<?php
	require 'session.php';
	require 'config.php';

	$vehicle_number = $_GET['vehicle_number'];

	$sql = mysqli_query($con, "select * from policy where vehicle_number = '$vehicle_number'");
	if(mysqli_num_rows($sql)> 0 ){
		$r=mysqli_fetch_array($sql);
		echo $r['id'];
	}
?>