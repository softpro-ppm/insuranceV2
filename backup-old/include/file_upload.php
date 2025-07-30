<?php
    require('session.php'); 
    require('config.php');
if(!empty($_FILES)){     
    $upload_dir = "../assets/uploads/";
    $fileName = $_FILES['file']['name'];
    $order_id = $_POST['order_id'];
    
    $file_type = $_POST['file_type'];
        
        if($_POST['file_type'] == '1'){
            $type = 'BOL';
        }elseif ($_POST['file_type'] == '2') {
            $type = 'Return BOL';
        }elseif ($_POST['file_type'] == '3') {
            $type = 'Refund';
        }elseif ($_POST['file_type'] == '4') {
            $type = 'Picture';
        }elseif ($_POST['file_type'] == '5') {
            $type = 'Video';
        }

    $newfile = $type."-".$fileName;

    $uploaded_file = $upload_dir.$newfile;    
    if(move_uploaded_file($_FILES['file']['tmp_name'],$uploaded_file)){
        //insert file information into db table
        $mysql_insert = "INSERT INTO files (file_name, order_id , file_type)VALUES('".$newfile."', '".$order_id."', '".$file_type."')";
        mysqli_query($con, $mysql_insert) or die("database error:". mysqli_error($con));
    }   
}

