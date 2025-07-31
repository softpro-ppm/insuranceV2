<?php
	include 'session.php';
	include 'config.php';
	
     if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['comment'])) {
                            
                           
            $policy_id = mysqli_real_escape_string($con, $_POST['policy_id']);
            $comment = mysqli_real_escape_string($con, $_POST['comment']);
            $createdAt = date("Y-m-d H:i:s");
        
            $insertComment = "INSERT INTO customer_feedback (policy_id, comment, created_at) VALUES ('$policy_id', '$comment', '$createdAt')";
            if (mysqli_query($con, $insertComment)) {
                echo "<span style='color:green'>Comment added successfully.</span>";
            } else {
                echo "<span style='color:red'>Error adding comment.</span>";
            }
        
            //header("Location: manage-renewal.php");
            //exit();
        }

?>


<?php
	
     if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['load'])) {
         
         
         $policyId = $_POST['id'];
            $commentQuery = "SELECT * FROM customer_feedback WHERE policy_id = '$policyId' ORDER BY created_at DESC LIMIT 50";
            $commentsResult = mysqli_query($con, $commentQuery);
        
            if (mysqli_num_rows($commentsResult) > 0) {
                while ($comment = mysqli_fetch_array($commentsResult)) {
                  //  echo '<div class="card p-2">';
                        echo "<div class='comment-box mt-3'>";
                        echo "<p><strong>Comment:</strong> " . htmlspecialchars($comment['comment']) . "</p>";
                        echo "<p><small><em>Posted on: " . date("d-m-Y H:i a", strtotime($comment['created_at'])) . "</em></small></p>";
                        echo "</div>";
                        echo "</hr>";
                  //  echo "</div>";
                }
            } else {
                echo "<p>No comments yet. Be the first to comment!</p>";
            }
                            
                            
    }

?>


<?php
	
     if (isset($_POST['last'])) {
         
         
         $policyId = $_POST['id'];
            $commentQuery = "SELECT * FROM customer_feedback WHERE policy_id = '$policyId' ORDER BY created_at DESC LIMIT 1";
            $commentsResult = mysqli_query($con, $commentQuery);
            if (mysqli_num_rows($commentsResult) > 0) {
                while ($comment = mysqli_fetch_array($commentsResult)) {
                    echo htmlspecialchars($comment['comment']);
                }
            } else {
                echo "<p>No comments yet. Be the first to comment!</p>";
            }
                            
                            
    }

?>