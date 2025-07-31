<?php session_start();
		 
    require('config.php');

	$username = ucfirst($_POST['username']);
	$password = $_POST['password'];

	$sql = mysqli_query($con, "select * from user where username = '".$username."' and password = '".$password."' and delete_flag='1' limit 1 ");

	if(mysqli_num_rows($sql) > 0){
		$r=mysqli_fetch_array($sql);
		$user_type = $r['type'];
		$_SESSION['username'] = ucfirst($_POST['username']);
		$login = '1';
	}else{
		$login = "0";
	}

	echo $login;

?>