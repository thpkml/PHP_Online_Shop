<?php  
session_start();
// Check if admin is logged in
if(isset($_SESSION['adminlog']) && isset($_SESSION['adminrank'])){
    $user = $_SESSION['adminlog'];
    $rank = $_SESSION['adminrank'];
    $logout = '<a href="admin.php?lgo=logout" title="Log-Out">Log-Out</a>';
}

?>
<!DOCTYPE html>
<html lang="en-gb">

<head>
    <meta charset="utf-8">
    <title>Creative Limited</title>
    <link href="admin.css" rel="stylesheet" />
    <style type="text/css">
    .success {
        display: inline-block;
        margin: 100px auto;
        text-align: center;
        color: #F2994A;
    }

    div a button {
        width: 30%;
        padding: 10px 0px;
        background-color: #F2994A;
        font-size: 12px;
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
            <li><a href="add-products.php" class="active">Add Items</a></li>
            <li><a href="remove-products.php">Remove Items</a></li>
            <li><a href="add-remove-users.php">Add/Remove Users</a></li>
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
    <div class="success">
        <h1>Product successfully added to the database.</h1>
        <a href="add-products.php"><button>Add more products</button></a>
        <a href="remove-products.php"><button>Remove products</button></a>
    </div>
</body>

</html>