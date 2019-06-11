<?php 
session_start();
// Check if admin is logged in
if(isset($_SESSION['adminlog']) && isset($_SESSION['adminrank'])){
    $user = $_SESSION['adminlog'];
    $userrank = $_SESSION['adminrank'];
    $logout = '<a href="admin.php?lgo=logout" title="Log-Out">Log-Out</a>';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Profile Changed - Admin</title>
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

    <h1>User profile image changed successfully !</h1>
    <a href="adminhome.php">Admin Home</a>

</body>
</html>