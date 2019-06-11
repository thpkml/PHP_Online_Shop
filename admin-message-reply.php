<?php
	session_start();
	// Check if admin is logged in
	if(isset($_SESSION['adminlog']) && isset($_SESSION['adminrank'])){
		$user = $_SESSION['adminlog'];
		$rank = $_SESSION['adminrank'];
		$adminid = $_SESSION['adminid'];
		$logout = '<a href="admin.php?lgo=logout" title="Log-Out">Log-Out</a>';
	} else{
    	header("location: admin.php");
    	exit;
		}
	require 'config1.php';
	// Get required variables
	$fromid = $adminid; //from session above
    $toid = $_POST['replytoid']; //from form on adminhome page
    $replysubject = $_POST['replysubject'];
	// define variables from the form to set empty values 
	$senderid = $from = $receiverid = $to = $subject = $message = "";
	// define the test_input function to aviod malicious form entries 
	function test_input($data){
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
	// Process form input and insert into the database table
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		$senderid = $_POST['senderid'];
		$from = test_input($_POST['from']);
		$receiverid = $_POST['receiverid'];
		$to = test_input($_POST['to']);
		$subject = test_input($_POST['subject']);
		$message = test_input($_POST['message']);
	// Prepare an insert statement 
		if(!empty($senderid) && !empty($from) && !empty($receiverid) && !empty($to) && !empty($subject) && !empty($message)){		
		$sql3 = "INSERT INTO adminmessage (senderid, sender, receiverid, receiver, subject, message) VALUES (?, ?, ?, ?, ?, ?)";
		if($stmt = $conn->prepare($sql3)){
			// Bind variables to the prepared statement as parameters 
			$stmt->bind_param("ssssss", $param_fromid, $param_from, $param_toid, $param_to, $param_subject, $param_message);
			// Set parameters
			$param_fromid = $senderid;
			$param_from = $from;
			$param_toid = $receiverid;
			$param_to = $to;
			$param_subject = $subject;
			$param_message = $message;
			// Attempt to execute the statement 
			if($stmt->execute()){
				// redirect to message sent page
				header("location: message-sent.php");
			} else{
				echo "Something went wrong. Please try again later.";
				}
			}
		}
	}
// Get admin details from database
	$sql = "SELECT * FROM admin WHERE id=" .$fromid;
	$result = $conn->query($sql);
	if($result->num_rows>0){
		$row = $result->fetch_assoc();
		$id = $row['id'];
		$firstname = $row['firstname'];
		$lastname = $row['lastname'];
		$pic = $row['pic'];
		$rank = $row['rank'];
	} 
	// else{echo "0 result !"; }
	// Get details of the sender
	$sql2 = "SELECT * FROM admin WHERE id=" .$toid;
	$result2 = $conn->query($sql2);
	if($result2->num_rows>0){
		$row2 = $result2->fetch_assoc();
		$id2 = $row2['id'];
		$firstname2 = $row2['firstname'];
		$lastname2 = $row2['lastname'];
		$pic2 = $row2['pic'];
		$rank2 = $row2['rank'];
	} 
	// else{echo "0 result !"; }
?>

<!DOCTYPE html>
<html lang="en-gb">

<head>
    <meta charset="utf-8">
    <title>Admin - Home</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <link href="admin.css" rel="stylesheet" />
	<style>
		#adminmessage {
			width:50%;
			text-align:left;
			margin-left: 5%;
			font-size: 12px;
			font-weight:400;
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
	<br><br><br>	<br><br><br>
	<br><br><br>
<div id="adminmessage">
<form action="<?php echo ($_SERVER['PHP_SELF']); ?>" method="POST">
    <input type="hidden" name="senderid" value="<?php echo $fromid; ?>">
	<label>From: <input type="text" name="from" value="<?php echo $firstname ." ".$lastname; ?>"></label>
	<input type="hidden" name="receiverid" value="<?php echo $toid; ?>">
	<label>To: <input type="text" name="to" value="<?php echo $firstname2 ." ".$lastname2; ?>"></label><br>
	<label>Subject: <input type="text" name="subject" maxlength="200" value="<?php echo $replysubject ; ?>"></label><br>
	<label>Message: <br> <textarea name="message"  style="width:50em; height:20em;" maxlength="200" required></textarea></label><br>
	<input type="submit" name="submit" id="message" style="width:100px;">
</form>
</div>





















