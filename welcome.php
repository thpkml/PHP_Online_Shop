<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <link href="main.css" rel="stylesheet" />
    <style type="text/css">
        body{ font: 14px sans-serif; text-align: center; }
    </style>
</head>
<body>
<header> 
<h1 class="brand"><span class="logo">CL</span>Creative Limited</h1>
    </header>
<div class="menubar">
  <ul>
      <li><a href="index.html">Home</a></li>
      <li><a href="about-us.html">About Us</a></li>
      <li><a href="products.php">Products</a></li>
      <li><a href="contact.html">Contact</a></li>
      <li><a href="register.php" class="active">Sign Up / Login</a></li>
    </ul>
</div>
    <br><br><br><br><br><br><br><br><br>
    <br><br><br><br><br><br><br><br><br>

    <div class="page-header">
        <h1>Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to our site.</h1>
    </div>
    <div style="display:inline-block text-align:center">
        <a href="reset-password.php" class="btn btn-warning">Reset Your Password</a>
        <a href="logout.php" class="btn btn-danger">Sign Out of Your Account</a>
    </div>
    <br><br><br><br><br><br><br><br><br>
    <br><br><br><br><br><br><br><br><br>
    <br><br><br><br><br><br><br><br><br>

<footer>
  <h5><small>&copy; CL 2018.</small></h5>
</footer>
</body>
</html>
