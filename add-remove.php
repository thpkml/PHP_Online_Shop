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

    require 'config1.php';
    $message1 = $message2 = $message3 = $message4 = $message5 = "";
    // Search product by PID
    $pid = $status = "";
    if(isset($_POST['submit'])){
        if(isset($_GET['go'])){
            if(preg_match("/^[0-9]+/", $_POST['pid'])){
                $pid1 = $_POST['pid'];
                $pid = (int) $pid1;
                // get status from database
                $sql = "SELECT * FROM products WHERE id = '" . $pid . "'";
                $result = $conn->query($sql);
                // check if there is any result from database with that pid
                if($result->num_rows > 0){
                    $row = $result->fetch_assoc();
                    $status = $row['status'];
                    $image = $row['image'];
                    $productname = $row['name'];
                    if($status == '1'){
                        $sql = $conn->query("UPDATE products SET status = '0' WHERE id ='$pid' ");
                        $message1 = "Product successfully removed <b>(Now Unavailable)</b> from view. Check the product page to make sure.";
                        $availability = "Available";
                    } elseif($status == '0'){
                        $sql = $conn->query("UPDATE products SET status = '1' WHERE id ='$pid' ");
                         $message1 = "Product successfully reinstated <b>(Now Available)</b> to sell. Check the product page to make sure.";
                         $availability = "Not available";
                    } else{
                        $message3 = "<b>Something went wrong. Please try again !</b>";
                    }
                } else{
                    $message4 = "<b>Could not find item with that PID !</b>";
                }
            } else {
                $message5 =  "<b>Enter an Integer as PID !</b>";
            }
        }
    } elseif($rank == '1'){
        // DELETING ITEMS FROM DATABASE
    // Provide access to only rank 1 admins to delete items 
        if(isset($_POST['submit1'])){
            if(isset($_GET['go'])){
                if(!empty($_POST['pid'])){
                    if(preg_match("/^[0-9]+/", $_POST['pid'])){
                        $pid1 = $_POST['pid'];
                        $pid = (int) $pid1;
                        $sql = $conn->query("SELECT * FROM products WHERE id = '" . $pid . "'");
                        if($sql->num_rows > 0){
                            $sql = $conn->query("DELETE FROM products WHERE id = '" . $pid . "'");
                            $message6 = "<b>REMOVED from the database PERMANENTLY !</b>";
                        } else{
                            $message6 = "<b>Couldn't delete the item. Check database.";
                        }
                    } else{
                         $message7 = "<b>Enter an Integer as PID !</b>";
                }
            } else{
                $message7 = "<b>Enter an Integer as PID !</b>";
            }
            }
        }
    } else{
        $message8 = "<b>You are not authorised to delete items. Please check your admin rank.";
    }
?>
<!DOCTYPE html>
<html lang="en-gb">

<head>
    <meta charset="utf-8">
    <title>Add/Remove Products</title>
    <link href="admin.css" rel="stylesheet" />
    <style type="text/css">
    .addnew {
        display: inline-block;
        margin: 10px 0px;
        text-align: center;
        color: #F2994A;
    }

    div a button {
        width: 200px;
        padding: 10px;
        background-color: #F2994A;
        font-size: 14px;
        border-radius: 5px;
    }
    div a button:hover {
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
            <li><a href="remove-products.php" class="active">Remove Items</a></li>
            <li><a href="add-remove-users.php">Add/Remove Users</a></li>
            <li class="a"><?php echo $user ." | rank: ". $rank; ?></li>
            <li style="float:right;"><?php echo $logout; ?></li>
        </ul>
    </div>
    <!--HEAD AND NAV FOR ALL PAGES - END-->
        <br><br><br><br><br><br>
    <br><br>
    <div class="addremove">
        <form method="POST" action="add-remove.php?go">
            <label>Enter PID: </label><br><br>
            <input type="text" name="pid" style="width:94%;"><br><br>
            <input type="submit" name="submit" value="reinstate/remove" style="display: inline-block; text-align: center;"><br><br>
            <input type="submit" name="submit1" value="DELETE FROM DATABASE" style="display: inline-block; text-align: center;"><br><br>
            The product was : <span style="color:#F2994A"><b><?php echo $availability; ?></b></span>
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
        <img src="<?php echo $image; ?>" style="width: 70%; padding:10px;" alt="product image">
        <div style="border-top:1px dotted grey; padding:10px 0px;">item name: <b><?php echo $productname;?></b> | PID: <b><?php echo $pid;?></b></div>
        </div>
        <div class="addnew">
                    <a href="add-products.php"><button>Add New Products</button></a>
        </div>
    </div>
    <br><br><br><br><br><br>
</body>

</html>