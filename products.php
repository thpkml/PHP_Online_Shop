<?php 
// Connect to the database
 include 'config1.php';
 //Set all useful variables for paypal form 
$paypalURL = "https://www.sandbox.paypal.com/cgi-bin/webscr"; 
$paypalID = "thpkml-facilitator2@gmail.com";
?>

<!DOCTYPE html>
<html lang="en-gb">
<head>
    <meta charset="utf-8">
<title>Creative Limited</title>
<link href = "main.css" rel = "stylesheet" />
</head>
<!--==================== BODY !!!! ==================-->

<body align="center">

<!--HEAD AND NAV FOR ALL PAGES - BEGIN-->

<header> 
<h1 class="brand"><span class="logo">CL</span>Creative Limited</h1>
    </header>
<div class="menubar">
  <ul>
      <li><a href="index.html" >Home</a></li>
      <li><a href="about-us.html">About Us</a></li>
      <li><a href="products.php" class="active">Products</a></li>
      <li><a href="contact.html">Contact</a></li>
      <li><a href="register.php">Sign Up / Login</a></li>
      <li>
                <form method="post" action="search.php?go" style="float:right;">
                    <input type="text" name="name" style="width:150px; margin: 2px 5px 2px 0px;">
                    <input type="submit" name="submit" value="Search" style="width:100px; padding:5px 0px; margin: 2px 5px 2px 0px;">
                </form>
            </li>
    </ul>
</div>

<!--HEAD AND NAV FOR ALL PAGES - END-->
<br><br><br><br><br><br>
<div class="row">
  <div class="column">
    <a href="womens.php"><img src="images/product1.jpg" alt="product1" style="width:100%"></a>
    <a style="text-decoration:none;" href="womens.php"><div class="image-quote"><h1>Womens</h1></div></a>
  </div>
  <div class="column">
    <a href="shoes.php"><img src="images/product2.jpg" alt="product2" style="width:100%"></a>
    <a  style="text-decoration:none;" href="shoes.php"><div class="image-quote"><h1>Shoes</h1></div></a>
  </div>
  <div class="column">
    <a href="camping.php"><img src="images/product3.jpg" alt="product3" style="width:100%"></a>
    <a  style="text-decoration:none;" href="camping.php"><div class="image-quote"><h1>Camping</h1></div></a>
  </div>
  <div class="column">
    <a href="mens.php"><img src="images/product4.jpg" alt="product4" style="width:100%"></a>
    <a  style="text-decoration:none;" href="mens.php"><div class="image-quote"><h1>Mens</h1></div></a>
  </div>
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
            $status = $row["status"];
            if($status == '1'){
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
        <!-- <div style="float:right; margin-right:15px; border-left: 1px dotted gray;  padding-left: 15px;"><?php echo "PID - ".$id; ?></div> -->
        </div>
        <div class="price"><?php echo "$".$price; ?></div>
        <div class="product_button">
            <form target="paypal" action="<?php echo $paypalURL;?>" method="post" class="paypal">

                  <!-- Identify your business so that you can collect the payments. -->
                  <input type="hidden" name="business" value="<?php echo $paypalID; ?>">

                  <!-- Specify a PayPal Shopping Cart Add to Cart button. -->
                  <input type="hidden" name="cmd" value="_xclick">
                  <!-- <input type="hidden" name="add" value="1"> -->

                  <!-- Specify details about the item that buyers will purchase. -->
                  <input type="hidden" name="item_name" value="<?php echo $productname;?>">
                  <input type="hidden" name="item_number" value="<?php echo $id;?>">
                  <input type="hidden" name="amount" value="<?php echo $price;?>">
                  <input type="hidden" name="currency_code" value="USD">

                  <!-- Display the payment button. -->
                  <input type="image" name="submit"
                    src="https://www.paypalobjects.com/en_US/i/btn/btn_buynow_LG.gif"
                    alt="Paypal - The safer, easier way to pay online.">
                  <img alt="" width="1" height="1"
                    src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif">

                    <!-- Specify the URLs -->
                    <input type='hidden' name='cancel_return' value='http://localhost/kamal-dev/cl/cancel.php'>
        <input type='hidden' name='return' value='http://localhost/kamal-dev/cl/success.php'>
            </form>
        </div>
    </div>

<!--and we pick up with the unfinished php code here-->
    <?php
            }
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