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
            <li><a href="products.php" class="active">Products</a></li>
            <li><a href="contact.html">Contact</a></li>
            <li><a href="register.php">Sign Up / Login</a></li>
        </ul>
    </div>
    <br><br><br><br><br><br><br><br><br>
    <br><br><br><br><br><br><br><br><br>
<?php
include 'config1.php';

//Get payment information from PayPal
$item_number = $_GET['item_number']; 
$txn_id = $_GET['tx'];
$payment_gross = $_GET['amt'];
$currency_code = $_GET['cc'];
$payment_status = $_GET['st'];

//Get product price from database
$productResult = $conn->query("SELECT price FROM products WHERE id = ".$item_number);
 
$productRow = $productResult->fetch_assoc();
$productPrice = $productRow['price'];

// Get product name from database for the success message line
$nameResult = $conn->query("SELECT name FROM products WHERE id = ".$item_number);
$nameRow = $nameResult->fetch_assoc();
$name = $nameRow['name'];

if(!empty($txn_id) && $payment_gross == $productPrice){
    //Check if payment data exists with the same TXN ID.
    $prevPaymentResult = $conn->query("SELECT payment_id FROM payments WHERE txn_id = '".$txn_id."'");

    if($prevPaymentResult->num_rows > 0){
        $paymentRow = $prevPaymentResult->fetch_assoc();
        $last_insert_id = $paymentRow['payment_id'];
    }else{
        //Insert tansaction data into the database
        $insert = $conn->query("INSERT INTO payments(item_number,txn_id,payment_gross,currency_code,payment_status) VALUES('".$item_number."','".$txn_id."','".$payment_gross."','".$currency_code."','".$payment_status."')");
        $last_insert_id = $conn->insert_id;
    }
?>

    <h2>Hello there! Your payment for <span style="color:#F2994A"><?php echo $name; ?></span> has been successful.</h2>
    <h1>Your Payment ID - <span style="color:#F2994A; font-size: 2em;"><?php echo $last_insert_id; ?></span></h1>
<?php }else{ ?>
    <h1>Your payment has failed.</h1>
<?php } ?>



<!--FOOTER: USE IN ALL PAGES -->
    <br><br><br><br><br><br><br><br><br>
    <br><br><br><br><br><br><br><br><br>
    
    <footer>
        <h5><small>&copy; CL 2018.</small></h5>
    </footer>
</body>

</html>