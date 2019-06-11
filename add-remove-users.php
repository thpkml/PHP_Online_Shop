<?php  
session_start();
// Check if admin is logged in
if(isset($_SESSION['adminlog']) && isset($_SESSION['adminrank'])){
    $user = $_SESSION['adminlog'];
    $rank = $_SESSION['adminrank'];
    $logout = '<a href="admin.php?lgo=logout" title="Log-Out">Log-Out</a>';
} else{
    header("location: admin.php");
    exit;
}
if($rank != '1'){
    echo "<br><br>Your are not authorised to use this feature at your access level (rank).<br><br>";
    echo "<a href='adminhome.php'><b>Admin Home</b></a>";
    exit;
}elseif($rank == '1'){      
    require 'config1.php';
    $uid = $status = "";
    if(isset($_POST['submit'])){
        if(isset($_GET['go'])){
            if(preg_match("/^[0-9]+/", $_POST['uid'])){
                $uid1 = $_POST['uid'];
                $uid = (int) $uid1;
                // get user status from the database 
                $sql = "SELECT * FROM admin WHERE id = '" .$uid . "'";
                $result = $conn->query($sql);
                // check if there is any user in the database with that uid 
                if($result->num_rows >0){
                    $row = $result->fetch_assoc();
                    $status = $row['status'];
                    $image = $row['pic'];
                    $firstname = $row['firstname'];
                    $lastname = $row['lasttname'];
                    if($status == '1'){
                        $sql = $conn->query("UPDATE admin SET status = '0' WHERE id='$uid' ");
                        $message1 = "User successfully removed.";
                        $availability = "Active";
                    } elseif($status == '0'){
                        $sql = $conn->query("UPDATE admin SET status = '1' WHERE id='$uid' ");
                        $message1 = "User successfully reinstated.";
                        $availability = "Not Active";
                    } else{
                        $message3 = "<b>Something went wrong. Please try again !</b>";
                    }
                } else{
                    $message4 = "<b>Could not find an User with that User ID !</b>";
                }
            } else{
                $message5 =  "<b>Enter an Integer as User ID !</b>";
            }
        }
    } elseif(isset($_POST['submit1'])){  // DELETING ITEMS FROM DATABASE
        if(isset($_GET['go'])){
            if(!empty($_POST['uid'])){
                if(preg_match("/^[0-9]+/", $_POST['uid'])){
                    $uid1 = $_POST['uid'];
                    $uid = (int) $uid1;
                    $sql = $conn->query("SELECT * FROM admin WHERE id = '" . $uid . "'");
                    if($sql->num_rows > 0){
                        $sql = $conn->query("DELETE FROM admin WHERE id = '" . $uid . "'");
                        $message6 = "<b>REMOVED from the database PERMANENTLY !</b>";
                    } else{
                        $message6 = "<b>Couldn't delete the user. Check database.";
                        }
                } else{
                     $message7 = "<b>Enter an Integer as User ID !</b>";
                    }
        } else{
            $message7 = "<b>Enter an Integer as User ID !</b>";
            }
        }
    }
} else{
    echo "Oops! Something went wrong. Please try again later.";
} 
?>
<!DOCTYPE html>
<html lang="en-gb">

<head>
    <meta charset="utf-8">
    <title>Admin - Home</title>
    <link href="admin.css" rel="stylesheet" />
    <style>
        .addnew a button{
        display: inline-block;
        margin: 10px 0px;
        text-align: center;
        padding: 10px 20px;
        background-color: #F2994A;
        font-size: 14px;
        border-radius: 5px;
    }
        .addnew a button:hover{
            color: white;
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
            <li><a href="adminhome.php">Dashboard</a></li>
            <li><a href="index.html">Main Site</a></li>
            <li><a href="add-products.php">Add Items</a></li>
            <li><a href="remove-products.php">Remove Items</a></li>
            <li><a href="add-remove-users.php" class="active">Add/Remove Users</a></li>
            <li class="a">
                <?php echo $user ." | rank: ". $rank; ?>
            </li>
            <li style="float:right;">
                <?php echo $logout; ?>
            </li>
        </ul>
    </div>
    <!--HEAD AND NAV FOR ALL PAGES - END-->
    <br><br><br><br><br><br>
    <br><br><br><br><br><br>
    <div class="addremove">
        <form method="POST" action="add-remove-users.php?go">
            <label>Enter User User ID: </label><br><br>
            <input type="text" name="uid" style="width:94%;"><br><br>
            <input type="submit" name="submit" value="reinstate/remove" style="display: inline-block; text-align: center;"><br><br>
            <input type="submit" name="submit1" value="DELETE FROM DATABASE" style="display: inline-block; text-align: center;"><br><br>
            The user was : <span style="color:#F2994A"><b><?php echo $availability; ?></b></span>
        </form><br><br>
        <?php echo $message1 ?>
        <?php echo $message2 ?>
        <?php echo $message3 ?>
        <?php echo $message4 ?>
        <?php echo $message5 ?>
        <?php echo $message6 ?>
        <?php echo $message7 ?>
        <?php echo $message8 ?>

        <div style="border:1px dotted grey; margin-top: 15px;">
        <img src="<?php echo $image; ?>" style="width: 70%; padding:10px;" alt="user image">
        <div style="border-top:1px dotted grey; padding:10px 0px;">user name: <b><?php echo $firstname." ".$lastname;?></b> | User ID: <b><?php echo $uid;?></b></div>
        </div>
        <div class="addnew">
                    <a href="add-users.php"><button>Add New Users</button></a>
        </div>
    </div>

</body>

</html>