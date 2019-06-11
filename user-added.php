<?php 
session_start();
// Check if admin is logged in
if(isset($_SESSION['adminlog']) && isset($_SESSION['adminrank'])){
    $user = $_SESSION['adminlog'];
    $userrank = $_SESSION['adminrank'];
    $newusername = $_SESSION['newusername']; //check add-users.php page to see the session variable in detail
    $logout = '<a href="admin.php?lgo=logout" title="Log-Out">Log-Out</a>';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>User Added - Admin</title>
	<link rel="stylesheet" type="text/css" href="admin.css">
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
<?php 
    if(isset($_SESSION["newusername"])){
?>
    <h1>User <span style="color:grey"><?php echo $newusername." ";?></span>added successfully !</h1>
    <a href="add-users.php">Add More Users</a>
    <?php unset($_SESSION["newusername"]); 
    // echo "new username is". $_SESSION["newusername"];
    ?>
<?php
    } else {
?>
        <h1>Cannot add users image without user details !</h1>
        <a href="add-users.php">Add User Details</a>  
<?php
    }
?>


</body>
</html>