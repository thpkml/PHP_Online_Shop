<?php  
	session_start();

	// connect to database	
	require 'config1.php';
	// declare variables that could be used below
	$firstname = $lastname = $username = $password = $rank = '';
	$err = '';

	// form to log in 
	$form = '<form action="'.basename($_SERVER['PHP_SELF']) .'" method="post" id ="login">
			 <label>Username: <input type="text" name="user" id="user" /></label><br>
			 <label>Password: <input type="password" name="pass" id="pass" /></label>
			 <input type="submit" value="Login" id="submit" />
			 </form>';
	// to logout
	if(isset($_GET['lgo']) && $_GET['lgo'] == 'logout'){
		if(isset($_SESSION['adminlog'])) unset($_SESSION['adminlog']);
		if(isset($_SESSION['adminrank'])) unset($_SESSION['adminrank']);
		if(isset($_SESSION['adminid'])) unset($_SESSION['adminid']);
		if(isset($_SESSION['newusername'])) unset($_SESSION['newusername']);
		// display the 'logged out' message followed by the form
		$form = '<h4>Logged out</h4>' .$form;
	} elseif(isset($_POST['user']) && isset($_POST['pass'])){
		$err = '<h4>Incorrect username or password !</h4>';
		// get admin credentials from database
		$sql = "SELECT * FROM admin";
		$result = $conn->query($sql);
		if($result->num_rows > 0){
			while($row = $result->fetch_assoc()){
				$hashed_password = $row['password'];
				$password = $_POST['pass'];
				$status = $row['status'];
				if($status == '1'){
				if($_POST['user']==$row['username'] && password_verify($password, $hashed_password)){
				$_SESSION['adminlog'] = $row['username'];
				$_SESSION['adminrank'] = $row['rank'];
				$_SESSION['adminid'] = $row['id'];
				$err = '';
				}
			} else{
				$err = '<h4>Your account has been suspended. Please speak to system admin.</h4>';
			}
		}
			// if there is an error, add it to output (including the form)
			if($err!='') $form = $err .$form;
		}
	}
	// Admin logged
	if(isset($_SESSION['adminlog']) && isset($_SESSION['adminrank'])){
		header("location: adminhome.php");
		exit;
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>CL - Admin</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
	<link href="admin.css" rel="stylesheet" />
</head>
<body>
	<header class="adminheader">
        <h1 class="brand"><span class="logo">CL</span>Creative Limited - Admin</h1>
    </header>
    
    <!--HEAD AND NAV FOR ALL PAGES - END-->
    <br><br><br><br><br><br>
    <br><br><br><br><br><br>
    <div style="text-align: center;">
    	<h3>Admin Login</h3>
		<hr style="width:32em;">
		<div id="content">
		<?php echo $form; ?>
	</div>
    </div>
	<hr style="width:32em;">
</body>
</html>