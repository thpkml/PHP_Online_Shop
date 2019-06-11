<?php
include 'config1.php';
//Set all useful variables for paypal form
$paypalURL = "https://www.sandbox.paypal.com/cgi-bin/webscr";
$paypalID  = "thpkml-facilitator2@gmail.com";
?>
<!DOCTYPE html>
<html>
<head>
    <meta  http-equiv="Content-Type" content="text/html;  charset=iso-8859-1">
    <title>Search  Products</title>
    <link href="main.css" rel="stylesheet" />
</head>
<body align="center">
    <!--HEAD AND NAV FOR ALL PAGES - BEGIN-->
    <header>
        <h1 class="brand"><span class="logo">CL</span>Creative Limited</h1>
    </header>
    <div class="menubar">
        <ul>
            <li><a href="index.html">Home</a></li>
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
    <br><br><br><br><br><br><br>
<div class="row">
  <!-- Search area: search by product name -->
  <div class="column" style="border:1px dotted gray; margin:10px;">
    <h5 style="margin:10px 0px 0px 0px;">Search Products by Name</h5>
    <p style="font-size: 11px; text-align: center; margin: 0px;">enter part/whole of product name</p>
        <form  method="post" action="search.php?go">
          <input  type="text" name="name" style="width:75%;"><br><br>
          <input  type="submit" name="submit" value="Search" style="width:75%; padding:10px 30px;"><br><br>
        </form>
  </div>
  <!-- Search area: search by product price -->
  <div class="column" style="border:1px dotted gray; margin:10px;">
    <h5 style="margin:10px 0px 0px 0px;">Search Products by Price</h5>
    <p style="font-size: 11px; text-align: center; margin: 0px;">price between: </p>
        <form  method="post" action="search.php?go">
          <input  type="text" name="minprice" placeholder="min" style="width:30%;">
          <input  type="text" name="maxprice" placeholder="max" style="width:30%;">
          <br><br>
          <input  type="submit" name="submit" value="Search" style="width:75%; padding:10px 30px;"><br><br>
        </form>
  </div>
  <!-- Search area: search by product category -->
  <div class="column" style="border:1px dotted gray; margin:10px;">
    <h5 style="margin:10px 0px 0px 0px;">Search Products by Category</h5>
    <p style="font-size: 11px; text-align: center; margin: 0px;">e.g. mens, womens, shoes, camping</p>
        <form  method="post" action="search.php?go">
          <input  type="text" name="category" style="width:75%;"><br><br>
          <input  type="submit" name="submit" value="Search" style="width:75%; padding:10px 30px;"><br><br>
        </form>
  </div>
</div>
<?php
// Searching by Product name
if (isset($_POST['submit'])) {
    if (isset($_GET['go'])) {
        if (preg_match("/^[  a-zA-Z]+/", $_POST['name'])) {
            $name = $_POST['name'];

            $sql    = "SELECT * FROM products WHERE name LIKE '%" . $name . "%' ";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $imagelink   = $row["image"];
                    $id          = $row["id"];
                    $productname = $row["name"];
                    $price       = $row["price"];
                    $status = $row["status"];
                    if($status == '1'){
?>
    <div class="product_grid">
        <div class="product_image">
          <a href="<?php echo $imagelink ?>" target="_blank">
            <img src="<?php echo $imagelink ?>">
          </a>
        </div>
        <div class="product_name">
            <?php echo $productname ?>
        </div>
        <div class="price"><?php echo "$" . $price ?></div>
        <div class="product_button">
            <form target="paypal" action="<?php echo $paypalURL; ?>" method="post" class="paypal">

                  <!-- Identify your business so that you can collect the payments. -->
                  <input type="hidden" name="business" value="<?php echo $paypalID; ?>">

                  <!-- Specify a PayPal Shopping Cart Add to Cart button. -->
                  <input type="hidden" name="cmd" value="_xclick">
                  <input type="hidden" name="add" value="1">

                  <!-- Specify details about the item that buyers will purchase. -->
                  <input type="hidden" name="item_name" value="<?php echo $productname ?>">
                  <input type="hidden" name="item_number" value="<?php echo $id ?>">
                  <input type="hidden" name="amount" value="<?php echo $price ?>">
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
    <?php
                  }
                }
            } else {
                echo "<p>Item not available. Please search again or see all our products here: </p>";
                $link = "products.php";
                echo "<a href='$link'> All Products</a>";
            }
        }
    }
}
?>

<?php
// Searching by Product price
if (isset($_POST['submit'])) {
    if (isset($_GET['go'])) {
        if (preg_match("/^[  0-9]+/", $_POST['minprice']) &&
            preg_match("/^[0-9]+/", $_POST['maxprice'])) {
            $productminprice = $_POST['minprice'];
            $productmaxprice = $_POST['maxprice'];
            $min       = (int) $productminprice;
            $max       = (int) $productmaxprice;
            $sql          = "SELECT * FROM products WHERE price BETWEEN $min AND $max ORDER BY price ASC";
            $result       = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $imagelink   = $row["image"];
                    $id          = $row["id"];
                    $productname = $row["name"];
                    $price       = $row["price"];
                    $status = $row["status"];
                    if($status == '1'){
?>
    <div class="product_grid">
        <div class="product_image">
          <a href="<?php echo $imagelink ?>" target="_blank">
            <img src="<?php echo $imagelink ?>">
          </a>
        </div>
        <div class="product_name">
            <?php echo $productname ?>
        </div>
        <div class="price"><?php echo "$" . $price ?></div>
        <div class="product_button">
            <form target="paypal" action="<?php echo $paypalURL; ?>" method="post" class="paypal">

                  <!-- Identify your business so that you can collect the payments. -->
                  <input type="hidden" name="business" value="<?php echo $paypalID; ?>">

                  <!-- Specify a PayPal Shopping Cart Add to Cart button. -->
                  <input type="hidden" name="cmd" value="_xclick">
                  <!-- <input type="hidden" name="add" value="1"> -->

                  <!-- Specify details about the item that buyers will purchase. -->
                  <input type="hidden" name="item_name" value="<?php echo $productname ?>">
                  <input type="hidden" name="item_number" value="<?php echo $id ?>">
                  <input type="hidden" name="amount" value="<?php echo $price ?>">
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
    <?php
  }
}
            } else {
                echo "<p>Item not available. Please search again or see all our products here: </p>";
                $link = "products.php";
                echo "<a href='$link'> All Products</a>";
            }
        }
    }
}
?>

<?php
// Searching by Product category
if (isset($_POST['submit'])) {
    if (isset($_GET['go'])) {
        if (preg_match("/^[  a-zA-Z]+/", $_POST['category'])) {
            $category = $_POST['category'];
            $sql      = "SELECT * FROM products WHERE category = '" . $category . "'";
            $result   = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $imagelink   = $row["image"];
                    $id          = $row["id"];
                    $productname = $row["name"];
                    $price       = $row["price"];
                    $status = $row["status"];
                    if($status == '1'){
                    ?>
    <div class="product_grid">
        <div class="product_image">
          <a href="<?php echo $imagelink ?>" target="_blank">
            <img src="<?php echo $imagelink ?>">
          </a>
        </div>
        <div class="product_name">
            <?php echo $productname ?>
        </div>
        <div class="price"><?php echo "$" . $price ?></div>
        <div class="product_button">
            <form target="paypal" action="<?php echo $paypalURL; ?>" method="post" class="paypal">

                  <!-- Identify your business so that you can collect the payments. -->
                  <input type="hidden" name="business" value="<?php echo $paypalID; ?>">

                  <!-- Specify a PayPal Shopping Cart Add to Cart button. -->
                  <input type="hidden" name="cmd" value="_xclick">
                  <input type="hidden" name="add" value="1">

                  <!-- Specify details about the item that buyers will purchase. -->
                  <input type="hidden" name="item_name" value="<?php echo $productname ?>">
                  <input type="hidden" name="item_number" value="<?php echo $id ?>">
                  <input type="hidden" name="amount" value="<?php echo $price ?>">
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
    <?php
                }
                }
            } else {
                echo "<p>Item not available. Please search again or see all our products here: </p>";
                $link = "products.php";
                echo "<a href='$link'> All Products</a>";
            }
        }
    }
}
?>
</body>
    </html>