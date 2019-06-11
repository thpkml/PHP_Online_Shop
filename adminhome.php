<?php  
session_start();
// Check if admin is logged in
if(isset($_SESSION['adminlog']) && isset($_SESSION['adminrank'])) {
    $user = $_SESSION['adminlog'];
    $rank = $_SESSION['adminrank'];
    $adminid = $_SESSION['adminid'];
    $logout = '<a href="admin.php?lgo=logout" title="Log-Out">Log-Out</a>';
} else{
    header("location: admin.php");
    exit;
}
require 'config1.php';
$sql = $conn->query("SELECT * FROM admin WHERE username = '" . $user . "'");
$nrow = $sql->num_rows;
if($nrow > 0){
	while($row = $sql->fetch_assoc()){
		$firstname = $row['firstname'];
		$lastname = $row['lastname'];
		$email = $row['email'];
		$profile = $row['pic'];
        $id = $row['id'];
        $username = $row['username'];
        $hashed_password = $row['password']; 
	}
}
// Resetting the password 
// Define variables and initialize with empty values
$password = $confirm_password = $password_clue = "";
$password_err = $confirm_password_err = $password_clue_err = "";
$p1 = trim($_POST['password']);
// processing form data on submit
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate new password 
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter the new password.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } // elseif(password_verify($p1, $hashed_password)){
    //     $password_err = "Cannot use old password.";
    // }
    else{
        $password = trim($_POST["password"]);
    }
    // Validate confirm password 
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm the password.";
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Passwords did not match.";
        }
    }
    // Validate  password clue
    if(empty(trim($_POST["password_clue"]))){
        $password_clue_err = "Please confirm the password.";
    } else{
        $password_clue = trim($_POST["password_clue"]);
    }
    // Check input errors before updating the database 
    if(empty($password_err) && empty($confirm_password_err) && empty($password_clue_err)){
        // encrypt the password 
        // Execute an update statement
        $password1 = password_hash($password, PASSWORD_DEFAULT);
        $sql = $conn->query("UPDATE admin SET password = '$password1' WHERE id = '$id'");
        $sql = $conn->query("UPDATE admin SET password_clue = '$password_clue' WHERE id = '$id'");
        
        session_destroy();
        header("location: admin.php");
        
    } else{
        echo "Oops! Something went wrong. Please try again later.";
    }
}
?>
<!DOCTYPE html>
<html lang="en-gb">

<head>
    <meta charset="utf-8">
    <title>Admin - Home</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <link href="admin.css" rel="stylesheet" />
    <style type="text/css">
        #messagebtn {
            /* width: 40%; */
            padding: 5px;
            font-size: 12px;
            border: none;
            border-radius: 5px;
            background-color: #F2994A;
            color: black;
            margin: 5px 0px 5px 0px;
        }
        #messagebtn1 {
            margin-left:10px;
            width:40%;
        }
        #messagebtn:hover {
            color:white;
        }
        #message {
            background-color: white;
            width:96%;
            margin:2px auto;
            text-align: left;
            font-size: 12px;
            }
        #date{
            background-color: #F2994A;
            font-size: 10px;
            padding: 5px 0px;
            font-weight: 600;
            text-align: center; 
        }
        #from{
            padding: 5px; 
        }
        #sender{
            font-style: oblique;
        }
        #subject{
            padding: 5px;
        }
        #thesubject{
            border: 1px dotted grey;
            border-radius: 5px;
            font-style: oblique;
            font-weight: 600;
            display: inline-block;
            width:100%;
            padding:3px;
        }
        #content{
            padding: 5px;
        }
        #thecontent{
            border: 1px dotted gray;
            border-radius: 5px;
            display: inline-block;
            width: 100%;
            /*height: 100px;
            overflow: scroll;*/
            padding: 5px;
        }
        #changepassword{
            color: black;
        }
    </style>
</head>
<!--==================== BODY !!!! ==================-->

<body align="center">
    <!--HEAD AND NAV FOR ALL PAGES - BEGIN-->
    <header>
        <h1 class="brand"><span class="logo">CL</span>Creative Limited</h1>
    </header>
    <div class="menubar">
        <ul>
            <li><a href="adminhome.php" class="active">Dashboard</a></li>
            <li><a href="index.html">Main Site</a></li>
            <li><a href="add-products.php">Add Items</a></li>
            <li><a href="remove-products.php">Remove Items</a></li>
            <li><a href="add-remove-users.php">Add/Remove Users</a></li>
            <li class="a"><?php echo $user ." | rank: ". $rank; ?></li>
            <li style="float:right;"><?php echo $logout; ?></li>
        </ul>
    </div>
    <!--HEAD AND NAV FOR ALL PAGES - END-->
        
    <div class="adminchat" style="width:25%; background-color:#2c3e50; float:left; margin:145px 0px; height:100%; overflow: scroll; padding-top:20px;">
        <div style="color:white; font-size: 18px;">
            <span>CL Admins</span><hr>
        </div>
        <?php  
            require 'config1.php';
            $sql1 = $conn->query("SELECT * FROM admin");
            $nrow = $sql1->num_rows;
            if($nrow > 0){
                while($row1 = $sql1->fetch_assoc()){
                    $firstname1 = $row1['firstname'];
                    $lastname1 = $row1['lastname'];
                    $email1 = $row1['email'];
                    $profile1 = $row1['pic'];
                    $id1 = $row1['id'];
                    $username = $row1['username'];
        ?>
        <div class="adminchatprofile" style="width:80%; margin:5px; background-color: white; display: inline-block; text-align: center;">
            <img src="<?php echo $profile1; ?>" style="width:100%; padding:0px;">
        </div>
        <div style="color:white;">
            <?php
            echo "#" . $id1 ." | ". $firstname1 ." ". $lastname1;
            ?>
            <form action="admin-message.php" method="POST">
                <input type="hidden" name="toid" value="<?php echo $id1; ?>">
                <input type="submit" name="submit" value="Message" id="messagebtn" style="width:55%;">
            </form>
        </div>
        <?php
            }
        } else{
            echo "0 results !";
        }
        ?> 

    </div>
    <div class="adminprofile" style="width:50%; float:left; padding-top:20px; height:100%; overflow: scroll; color:white;">
        <span style="font-size: 18px;">Your Profile</span> <hr style="width:50%;">
        <div class="profilepicture" style="width:50%; background-color: white; display:inline-block; text-align: center; margin:5px;">
            <img src="<?php echo $profile ?>" style="width:100%; padding:5px;">
            <a href="changeprofile.php">Change profile picture</a>
        </div>
        <div class="adminname">
        	<?php echo $firstname ." ". $lastname; ?>
        </div>
        <div class="adminemail">
        	Email: <?php echo $email; ?>
        </div>
        <div id="changepassword">
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            	<label>Change Password:</label><br><hr>
            	<label>New Password: <input type="password" name="password"></label><br>
                <span><?php echo $password_err ."<br>"; ?></span>
            	<label>Confirm Password: <input type="password" name="confirm_password"></label><br>
                <span><?php echo $confirm_password_err ."<br>"; ?></span>
            	<label>Password Clue: <input type="text" name="password_clue" maxlength="50"></label><br>
                <span><?php echo $password_clue_err ."<br>"; ?></span>
            	<input type="submit" style="width:25%;padding:10px 20px;"><br><br>
            </form>
        </div>
	</div>
    <div class="adminchat" style="width:25%; background-color:#2c3e50; float:left; margin:145px 0px; padding-top:20px; height: 100%; overflow: scroll;">
        <div style="color:white; font-size: 18px;">
            <span>Your Messages</span><hr>
        </div>
        <?php 
            // Get message details from message table 
            $sql2 = "SELECT * FROM adminmessage WHERE receiverid =" .$adminid;
            $result2 = $conn->query($sql2);
            if($result2->num_rows>0){
                 while($row2 = $result2->fetch_assoc()){;
                 $messageid = $row2['id'];
                 $from = $row2['sender'];
                 $fromid = $row2['senderid'];
                 $to = $row2['receiver'];
                 $subject = $row2['subject'];
                 $message = $row2['message'];
                 $senton = $row2['created_date'];
        ?>
            <div id="message">
                <div id="date"><?php echo $senton; ?></div>
                <div id="from"><span>From: </span><span id="sender"><?php echo $from; ?></span></div>
                <div id="subject"><span>Subject: </span><span id="thesubject"><?php echo $subject; ?></span> </div>
                <div id="content"><span>Message: </span><br> <span id="thecontent"><?php echo $message; ?></span></div><br>
                <!-- This is for the reply button -->
                <div id="messagebtn1">
                <form action="admin-message-reply.php" method="POST" style="padding:0px; margin:0px;">
                <input type="hidden" name="replytoid" value="<?php echo $fromid; ?>">
                <input type="hidden" name="replysubject" value="<?php echo "RE:" .$subject; ?>">
                <input type="submit" name="submit" value="Reply" id="messagebtn" style="">
                </form>
                </div>
                <!-- this is for delete message button -->
                <?php 
                    if($_SERVER["REQUEST_METHOD"] == "POST"){
                        $deleteid = $_POST["deletemessage"];
                    $sql3 = "DELETE FROM adminmessage WHERE id=" .$deleteid;
                    $conn->query($sql3);
                    }
                ?>
                <div id="messagebtn1">
                <form action="" method="POST" style="padding:0px; margin:0px;" id="deletemessage">
                <input type="hidden" name="deletemessage" value="<?php echo $messageid; ?>">
                <input type="submit" name="submit" value="Delete" id="messagebtn" style="">
                </form>
                </div>
                
            </div>    
                <script>
                    document.getElementById("deletemessage").onsubmit = function(){
                    location.reload(true);
                    }
                </script>

        <?php
                }
            } else{ echo "0 result !"; }

        ?>
    </div>
</body>

</html>

















