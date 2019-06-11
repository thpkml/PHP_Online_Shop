<!DOCTYPE html>
<html lang="en-gb">

<head>
    <meta charset="utf-8">
    <title>Creative Limited</title>
    <link href="main.css" rel="stylesheet" />
</head>
<!--==================== BODY !!!! ==================-->

<body align="center">
    <!--HEAD AND NAV FOR ALL PAGES - BEGIN-->
    <header>
        <h1 class="brand"><span class="logo">CL</span>Creative Limited</h1>
    </header>
    <div class="menubar">
        <ul>
            <li><a href="index.html">Home</a></li>
            <li><a href="about-us.html">About Us</a></li>
            <li><a href="products.php">Products</a></li>
            <li><a href="contact.html" class="active">Contact</a></li>
            <li><a href="register.php">Sign Up / Login</a></li>
        </ul>
    </div>
    <!--HEAD AND NAV FOR ALL PAGES - END-->
    <br><br><br><br><br><br><br><br><br>
    
	<?php


require('config1.php');


extract($_POST);


$sql = "INSERT into contact (name,email,message,created_date) VALUES('" . $name . "','" . $email . "','" . $message . "','" . date('Y-m-d') . "')";


$success = $conn->query($sql);


if (!$success) {
    die("Couldn't enter data: ".$conn->error);
}


echo "<h1>Thank You For Contacting Us</h1><br><br> ";


$conn->close();


?>

    <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d19858.769349437443!2d-0.27065435!3d51.5252103!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2suk!4v1522345553721" width="65%" height="500" frameborder="0" allowfullscreen> Our Location</iframe>
    <!--FOOTER COMMON TO ALL PAGES -->
    <br><br><br><br><br><br><br><br><br>
    <footer>
        <h5><small>&copy; CL 2018.</small></h5>
    </footer>
</body>

</html>
