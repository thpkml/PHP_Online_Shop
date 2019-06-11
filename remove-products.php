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
require_once 'config1.php'; 
?>
<!DOCTYPE html>
<html lang="en-gb">
<head>
    <meta charset="utf-8">
<title>Creative Limited</title>
<link href = "admin.css" rel = "stylesheet" />
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
<br><br><br><br><br><br><br><br>
<h4>Remove products:</h4>
<p class="paragraphborder" style="font-size: 12px;">Make products unavailable to customers by removing them. Reinstate the products if they are available to sell again. Use the corresponding buttons. </p>
<div class="paragraphborder" style="font-size: 12px; text-align: left; width: 450px; padding:20px;">
  <li>Check Status first: <b>0 - </b> not available, and <b>1 - </b>available</li>
  <li>Check the items <b>PID: </b> enter the PID in the next window.</li>
</div>
<?php
    $sql = "SELECT * FROM products";    
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0){
        while ($row = $result->fetch_assoc()){
            $imagelink = $row["image"];
            $id = $row["id"];
            $productname = $row["name"];
            $price = $row["price"];
            $productstatus = $row["status"];
?>
<!--we end this php code here, to do some html          -->
		    <div class="product_grid">
		        <div class="product_image">
		          <a href="<?php echo $imagelink ?>" target="_blank">
		            <img src="<?php echo $imagelink ?>">
		          </a>
		        </div>
		        <div class="product_name">
		            <?php echo $productname; ?>
		        <div style="float:right; margin-right:15px; border-left: 1px dotted gray;  padding-left: 15px;"><?php echo "PID - ".$id; ?></div>
		        </div>
		        <div class="price"><?php echo "$".$price; ?></div> 
		        <div class="product_status" style="float:right;">
		        	<div style="font-size: 12px;">Status:<?php echo $productstatus; ?></div>
		        	<!-- <form method="POST" action="<?php echo ($_SERVER["PHP_SELF"]); ?>">
		        		<label style="font-size: 12px">Change: </label>
		        		<select name="status">
		        			<option name="" value="1" >1</option>
		        			<option name="" value="0" >0</option>
		        		</select>
		        		<input type="submit" name="submit" value="submit" style="width:auto; padding:2px 5px; font-size: 12px; margin:0px 10px 10px 0px;">
		        	</form> -->
              <a href="add-remove.php"><button style="float:left; margin: 5px; background-color: #F2994A; border-radius: 5px;">reinstate | remove</button></a>
		        </div>
  
		    </div>
                <?php include 'select-status.php'; ?>

<!--and we pick up with the unfinished php code here-->
<?php
        }
    }else{
        	echo "0 results";
    	 }
?>
 
    
<!--FOOTER: USE IN ALL PAGES -->
        <br><br><br><br><br><br><br><br><br>
<!--
<footer>
  <h5><small>&copy; CL 2018.</small></h5>
</footer>
-->
</body>
</html>