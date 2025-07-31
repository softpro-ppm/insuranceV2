<?php  
	include 'session.php';
    include 'config.php';

    if (isset($_POST['submit'])) {
    	if(!empty($_FILES['file']['tmp_name'])){
	    	$id = $_POST['id'];
	    	$name = $_POST['name'];
	    	$username = $_POST['username'];
	    	$phone = $_POST['phone'];
	    	$email = $_POST['email'];
	    	$password = $_POST['password'];
	    	$photo = $_FILES['file']['name'];
			$target = "../assets/profile/".basename($photo);
    		$sql = mysqli_query($con, "update user set name='".$name."', username = '".$username."', password = '".$password."', phone='".$phone."', email='".$email."', photo='".$photo."' where id='".$id."' ");
    		move_uploaded_file($_FILES['file']['tmp_name'], $target); 
	  	}else{
	  		$id = $_POST['id'];
	    	$name = $_POST['name'];
	    	$username = $_POST['username'];
	    	$phone = $_POST['phone'];
	    	$email = $_POST['email'];
	    	$password = $_POST['password'];
	    	$sql = mysqli_query($con, "update user set name='".$name."', username = '".$username."', password = '".$password."', phone='".$phone."', email='".$email."' where id='".$id."' ");
	  	}
    }
    if($sql){
    echo "<script>alert('Profile Updated')</script>";
    echo "<script>window.location.href='../profile.php'</script>";
	}else{
    echo "<script>alert('Try again')</script>";
    echo "<script>window.location.href='../profile.php'</script>";

	}
?>