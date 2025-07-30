<?php 
    
    require 'session.php';
    require 'config.php';

    $id = $_POST['id'];
    $path="../assets/uploads/".$_POST['file'];
    
    $sql = mysqli_query($con, "delete from files where id = '".$id."'");

    if($sql){
      unlink($path);
      echo "File Deleted";
    }else{
      echo "Please try again";
    }
?>