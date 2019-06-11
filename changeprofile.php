<?php 
session_start();
// Check if admin is logged in
if(isset($_SESSION['adminlog']) && isset($_SESSION['adminrank'])){
    $user = $_SESSION['adminlog'];
    $userrank = $_SESSION['adminrank'];
    $userid = $_SESSION['adminid'];
    $logout = '<a href="admin.php?lgo=logout" title="Log-Out">Log-Out</a>';
}
require_once 'config1.php';
// File upload
$target_dir = "images/admin/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$filename = $_FILES["fileToUpload"]["name"];
$filepath = "images/admin/".$filename;
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    // if($_SERVER["REQUEST_METHOD"] == "POST"){
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
        echo $filename;
        $sql = $conn->query("UPDATE `admin` SET pic = '$filepath' WHERE id = '$userid'");
        // echo $newusername;
        // echo $filepath;
        header("location: profile-changed.php");
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Upload - Admin</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
<link href="admin.css" rel="stylesheet" />
<style>
    #uploadadmin {
        display: inline_block;
        text-align: center;
    }
    #filetoupload{
        margin: 0px;
    }
</style>
</head>
<body>
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
    <br><br><br><br><br>
    <br><br><br><br><br>

    <div id="uploadadmin">
    <form action="" method="post" enctype="multipart/form-data">
    <label>Select image to upload:</label> <br><br>
    <input type="file" name="fileToUpload" id="fileToUpload" style="display: inline-block; border:1px solid grey; padding:10px;"><br><br>
    <input type="submit" value="Upload Image" name="submit" style="width:15em;">
    </form>
    </div>
</body>
</html>