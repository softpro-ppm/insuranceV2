<?php
	date_default_timezone_set("Asia/Calcutta");

	$hostname = "localhost";
	$username = "u820431346_v2insurance";
	$password = "Softpro@123";
	$database = "u820431346_v2insurance";

	$con = new mysqli($hostname,$username , $password , $database);

	if ($con -> connect_errno) {
	  echo "Failed to connect to MySQL: " . $con -> connect_error;
	  exit();
	}
?>