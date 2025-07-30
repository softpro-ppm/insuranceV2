<?php
	require 'session.php';
	require 'config.php';

	$id = $_POST['id'];
	$name = $_POST['name'];
	$phone = $_POST['phone'];
	$vehicle_number = $_POST['vehicle_number'];
	$vehicle_type = $_POST['vehicle_type'];
	$insurance_company = $_POST['insurance_company'];
	$policy_type = $_POST['policy_type'];
	$policy_issue_date = date('Y-m-d',strtotime($_POST['policy_issue_date']));
	$policy_start_date = date('Y-m-d',strtotime($_POST['policy_start_date']));
	$policy_end_date = date('Y-m-d',strtotime($_POST['policy_end_date']));
	if(!empty($_POST['fc_expiry_date'])){
		$fc_expiry_date = date('Y-m-d',strtotime($_POST['fc_expiry_date']));
	}else{
		$fc_expiry_date = '';
	}
	if(!empty($_POST['permit_expiry_date'])){
	$permit_expiry_date = date('Y-m-d',strtotime($_POST['permit_expiry_date']));
	}else{
	$permit_expiry_date = '';
	}
	$premium = $_POST['premium'];
	$revenue = $_POST['revenue'];
	
	$chassiss = $_POST['chassiss'];
		$sql = mysqli_query($con, "update policy set name='$name', phone='$phone', vehicle_number='$vehicle_number', vehicle_type='$vehicle_type', insurance_company='$insurance_company', policy_type='$policy_type', policy_issue_date='$policy_issue_date', policy_start_date='$policy_start_date', policy_end_date='$policy_end_date', fc_expiry_date='$fc_expiry_date', permit_expiry_date='$permit_expiry_date', premium='$premium', revenue='$revenue', chassiss='$chassiss' where id='".$id."' ");
		
		
            // income section is start	
            
            // Include your database connection
            include 'account.php'; // This provides $acc
            
            // Sample or dynamic input values
            $date = date('Y-m-d');
            $description = 'Insurance';
            $category = 'Insurance';
            $subcategory = 'Insurance';
            $amount = $revenue;       // Example: 10000.00
            $received = $revenue;     // Example: 10000.00
            $balance = 0;
            $insurance_id = $id; //$policy_id; // Must be defined before
            //$name = '';   // optional
            //$phone = '';  // optional
            
            // Step 1: Check if this insurance_id exists
            $check = $acc->prepare("SELECT id FROM income WHERE insurance_id = ?");
            $check->bind_param("s", $insurance_id);
            $check->execute();
            $check->store_result();
            
            if ($check->num_rows > 0) {
                // Record exists – perform UPDATE
                $check->bind_result($id);
                $check->fetch();
                
                $update = $acc->prepare("UPDATE income SET 
                    date = ?, name = ?, phone = ?, description = ?, category = ?, subcategory = ?,
                    amount = ?, received = ?, balance = ?, updated_at = NOW() 
                    WHERE insurance_id = ?");
            
                $update->bind_param(
                    "ssssssddds",
                    $date, $name, $phone, $description,
                    $category, $subcategory, $amount, $received, $balance, $insurance_id
                );
            
                if ($update->execute()) {
                    echo "✅ Income record updated for insurance ID: $insurance_id";
                } else {
                    echo "❌ Update error: " . $update->error;
                }
            
                $update->close();
            
            } else {
                // No record – perform INSERT
                $insert = $acc->prepare("INSERT INTO income (
                    date, name, phone, description, category, subcategory,
                    amount, received, balance, created_at, updated_at, insurance_id
                ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), NOW(), ?)");
            
                $insert->bind_param(
                    "ssssssddds",
                    $date, $name, $phone, $description,
                    $category, $subcategory, $amount, $received, $balance, $insurance_id
                );
            
                if ($insert->execute()) {
                    echo "✅ New income record inserted for insurance ID: $insurance_id";
                } else {
                    echo "❌ Insert error: " . $insert->error;
                }
            
                $insert->close();
            }
            
            $check->close();
            $acc->close();
             // income section is end	

            
            if(isset($_POST['policy_end_date']) ){
				mysqli_query($con, "insert into history (name, phone, vehicle_number, vehicle_type, insurance_company, policy_type, policy_issue_date, policy_start_date, policy_end_date, fc_expiry_date, permit_expiry_date, premium, revenue, created_date) values ('$name', '$phone', '$vehicle_number', '$vehicle_type', '$insurance_company', '$policy_type', '$policy_issue_date', '$policy_start_date', '$policy_end_date', '$fc_expiry_date', '$permit_expiry_date', '$premium', '$revenue', now())");
				
			}
			
            
		$docx =  array();
		foreach(array_filter($_FILES['files']['name']) as $d => $document){
			$file_name = mysqli_real_escape_string($con,$_FILES['files']['name'][$d]);
			$files = time().$file_name;
			$upload_dir = "../assets/uploads/";
			$uploaded_file = $upload_dir.$files;
				
				move_uploaded_file($_FILES['files']['tmp_name'][$d],$uploaded_file);

			$docx[]="('".$id."', '".$files."')";
		}

		if(count($docx)){
			$docx_sql = "insert into files (policy_id, files)
					values".implode(',',$docx);				
			
			mysqli_query($con,$docx_sql);
			
		}
		
		
		$rcs =  array();
		foreach(array_filter($_FILES['rc']['name']) as $d => $document){
			$file_name = mysqli_real_escape_string($con,$_FILES['rc']['name'][$d]);
			$rc = time().$file_name;
			$upload_dir = "../assets/uploads/";
			$uploaded_file = $upload_dir.$rc;
				
				move_uploaded_file($_FILES['rc']['tmp_name'][$d],$uploaded_file);

			$rcs[]="('".$policy_id."', '".$rc."')";
		}

		if(count($rcs)){
			$docx_sql = "insert into rc (policy_id, files)
					values".implode(',',$rcs);				
			
			mysqli_query($con,$docx_sql);
			
		}
		
		

		if(!empty($_POST["comments"])){
			date_default_timezone_set("Asia/Calcutta");
		    $time = date('Y-m-d H:i:s');
			$c_comment=mysqli_query($con, "insert into comments (policy_id,user,  comments, date) values ('".$id."', '".$_SESSION['username']."','".$_POST["comments"]."', '".$time."')");
		}

		if($sql){
			echo "<script>alert('Policy Updated successfully')</script>";
			echo "<script>window.location.href='../policies.php';</script>";
		}else{
			echo "<script>alert('Please try again')</script>";
			echo "<script>window.location.href='../add.php';</script>";
		}

?>