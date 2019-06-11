<?php 
session_start();
// Check if admin is logged in
if(isset($_SESSION['adminlog']) && isset($_SESSION['adminrank'])){
    $user = $_SESSION['adminlog'];
    $userrank = $_SESSION['adminrank'];
    $logout = '<a href="admin.php?lgo=logout" title="Log-Out">Log-Out</a>';
}
include 'config.php';
//  define variables from the form and set to empty values
    $firstname = $lastname = $email = $username = $rank = $pic = $status = $password = $confirm_password = $password_clue = "";
    $firstnameErr = $lastnameErr = $emailErr = $usernameErr = $rankErr = $picErr = $statusErr = $passwordErr = $confirm_passwordErr = $password_clueErr = "";
//    define the test_input function that is used below
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate firstname
    if(empty($_POST["firstname"])){
        $firstnameErr = "FirstName is required";
    } else{
//        check below to see what test_input() function does
        $firstname = test_input($_POST["firstname"]);
//        check if firstname only contains letters, numbers and whitespace
        if(!preg_match('/^[a-zA-Z0-9\s]+$/', $firstname)){
            $firstnameErr = "Only letters, numbers and whitespaces allowed.";
        }
    }
    // Validate lastname
    if(empty($_POST["lastname"])){
        $lastnameErr = "LastName is required";
    } else{
//        check below to see what test_input() function does
        $lastname = test_input($_POST["lastname"]);
//        check if lastname only contains letters, numbers and whitespace
        if(!preg_match('/^[a-zA-Z0-9\s]+$/', $lastname)){
            $lastnameErr = "Only letters, numbers and whitespaces allowed.";
        }
    }
    // Validate email
    if(empty($_POST["email"])){
        $emailErr = "email is required";
    } else{
//        check below to see what test_input() function does
        $email = test_input($_POST["email"]);
//        check if email is proper format
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $emailErr = "Invalid email format.";
        }
    }
    // Validate username
    if(empty($_POST["username"])){
        $usernameErr = "username is required";
    } else{
//         prepare a select statement
        $sql = "SELECT id FROM `admin` WHERE username = ?";
        if($stmt = $mysqli->prepare($sql)){
            // bind variables to the prepared statement as parameters
            $stmt->bind_param("s", $param_username);
            // set parameters
            $param_username = test_input($_POST["username"]);
            // attempt to execute the statement
            if($stmt->execute()){
                // store result
                $stmt->store_result();
                if($stmt->num_rows == 1){
                    $usernameErr = "This username is already taken.";
                } else{
                    $username = test_input($_POST["username"]);
                // while here get the username as a session variable to link with image upload in next page.
                    $_SESSION['newusername'] = $username;
                }
            } else{
                echo "Oops! Something went wrong. Try again later.";
            }
        }
        // close statement
        $stmt->close();
    }
    // Validate image file
    // if(empty($_POST["filetoupload"])){ TODO: TODO: FIXME:
    //     echo "Picture is required.";
    // } else{
    //     include 'upload-admin.php';
    // }
    if(empty($_POST["pic"])){
        // Validate pic
        $picErr = "pic path is required.";
    } else{
        $pic = test_input($_POST["pic"]);
//        check if the filename is proper and filetypes are proper
        if(!preg_match("([^\s]+(\.(?i)(jpg|jpeg|png|gif|bmp))$)", $pic)){
            $picErr = "Invalid filename/extension! Only [letters numbers . - _ jpg jpeg png] allowed.";
        }
    }
    if(empty($_POST["rank"])){
        // Validate rank
        $rankErr = "rank is required.";
    } else {
        $rank = test_input($_POST["rank"]);
//        check if the rank is correct format
        if(!preg_match("/^[0-9]/", $rank)){
            $rankErr = "Only integers allowed.";
        }
    }
    if(empty($_POST["status"])){
        // Validate status
        $statusErr = "Status is required.";
    } else{
        $status = test_input($_POST["status"]);
//        check if the status is an integer
        if(!preg_match("/^[1]/", $status)){
            $statusErr = "Set to 1 (available) by default.";
        }
    }
    if(empty($_POST["password"])){
    // Validate password
        $passwordErr = "password is required.";
    } elseif(strlen(trim($_POST["password"])) < 6){
        $passwordErr = "Password must have at least 6 characters.";
    } else{
        $password = test_input($_POST["password"]);
    }
    if(empty($_POST["confirm_password"])){
    // Validate confirm_password
        $confirm_passwordErr = "Please confirm password.";
    } else{
        $confirm_password = test_input($_POST["confirm_password"]);
        if(empty($passwordErr) && ($password != $confirm_password)){
            $confirm_passwordErr = "Passwords did not match.";
        }
    }
    // Validate password clue
    if(empty($_POST["password_clue"])){
        $password_clueErr = "password_clue is required";
    } else{
//        check below to see what test_input() function does
        $password_clue = test_input($_POST["password_clue"]);
//        check if password_clue only contains letters, numbers and whitespace
        if(!preg_match('/^[a-zA-Z0-9\s]+$/', $password_clue)){
            $password_clueErr = "Only letters, numbers and whitespaces allowed.";
        }
    }
    // Check input errors before inserting into database
    if(empty($firstnameErr) && empty($lastnameErr) && empty($emailErr) && empty($usernameErr) && empty($rankErr) && empty($picErr) && empty($statusErr) && empty($passwordErr) 
        && empty($confirm_passwordErr) && empty($password_clueErr)){
        // Prepare an insert statement
        $sql = "INSERT INTO `admin` (firstname, lastname, email, username, `rank`, pic, `status`, `password_clue`, `password`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        if($stmt = $mysqli->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("sssssssss", $param_firstname, $param_lastname, $param_email, $param_username, $param_rank, $param_pic, $param_status, $param_password_clue, $param_password);
            // Set parameters 
            $param_firstname = $firstname;
            $param_lastname = $lastname;
            $param_email = $email;
            $param_username = $username;
            $param_rank = $rank;
            $param_pic = $pic;
            $param_status = $status;
            $param_password_clue = $password_clue;
            $param_password = password_hash($password, PASSWORD_DEFAULT); //Creates a password hash. NEEDS to be VERIFIED during login !!
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Redirect to add-products page
                header("location: upload-admin.php");
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
        // Close statement
        $stmt->close();
    }
    // Close connection
    $mysqli->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Add Users - Admin</title>
	<link rel="stylesheet" type="text/css" href="admin.css">
    <style type="text/css">
		.contactform {
/*			width:75%;*/
			padding:10px;
			font-size:12px;   
		}
        .contactform fieldset input{
            width:50%;
        }
	</style>
</head>
<body align="center">
    <!--HEAD AND NAV FOR ALL PAGES - BEGIN-->
    <header>
        <h1 class="brand"><span class="logo">CL</span>Creative Limited</h1>
    </header>
    <div class="menubar">
        <ul>
            <li><a href="adminhome.php">Dashboard</a></li>
            <li><a href="index.html">Main Site</a></li>
            <li><a href="add-products.php">Add Items</a></li>
            <li><a href="remove-products.php">Remove Items</a></li>
            <li><a href="add-remove-users.php" class="active">Add/Remove Users</a></li>
            <li class="a"><?php echo $user ." | rank: ". $userrank; ?></li>
            <li style="float:right;"><?php echo $logout; ?></li>
        </ul>
    </div>
    <!--HEAD AND NAV FOR ALL PAGES - END-->
    <br><br><br><br><br><br><br><br><br>

<!--This is the beginning of the form-->
<container class="contactform">
    	<h3>Add the details of the new user(admin) here.</h3>
	<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
		<fieldset id="contactform1" style="text-align:left;">
        <legend>User Details</legend>
	FirstName: <br><input type="text" name="firstname" placeholder="e.g.John" value="<?php echo $firstname; ?>">
            <span class="error"> * <?php echo $firstnameErr ; ?></span><br><br>
	LastName: <br><input type="text" name="lastname" placeholder="e.g.Cleese" value="<?php echo $lastname; ?>">
            <span class="error"> * <?php echo $lastnameErr ; ?></span><br><br>
	Email: <br><input type="text" name="email" placeholder="e.g.johncleese@email.com" value="<?php echo $email; ?>">
            <span class="error"> * <?php echo $emailErr ; ?></span><br><br>
	Username: <br><input type="text" name="username" placeholder="e.g.JohnCleese" value="<?php echo $username; ?>">
            <span class="error"> * <?php echo $usernameErr ; ?></span><br><br>
	Rank: <br><input type="text" name="rank" placeholder="e.g. 2" value="<?php echo $rank; ?>">
            <span class="error"> * <?php echo $rankErr ; ?></span><br><br>
	Image: <br><input type="text" name="pic" placeholder="imagepath e.g. images/admin3.jpg" value="<?php echo $pic; ?>">
            <span class="error"> * <?php echo $picErr ; ?></span><br><br>
	Status: <br><input type="text" name="status" placeholder="1" value="1">
            <span class="error"> * <?php echo $statusErr ; ?></span><br><br>
	Password: <br><input type="password" name="password" value="<?php echo $password; ?>">
            <span class="error"> * <?php echo $passwordErr ; ?></span><br><br>
	Confirm Password: <br><input type="password" name="confirm_password" value="<?php echo $confirm_password; ?>">
            <span class="error"> * <?php echo $confirm_passwordErr ; ?></span><br><br>
	Password Clue: <br><input type="text" name="password_clue" value="<?php echo $password_clue; ?>">
            <span class="error"> * <?php echo $password_clueErr ; ?></span><br><br>
    <input type="submit" name="submit" value="Add to Database" style="width:inherit; padding: 10px 20px;">
	<input type="reset" name="reset" value="Reset" style="width:auto; padding:10px 20px; font-size:12px;">
	</fieldset>
</form>
</container>

</body>
</html>
