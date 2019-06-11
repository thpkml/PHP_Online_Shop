<?php 
session_start();
// Check if admin is logged in
if(isset($_SESSION['adminlog']) && isset($_SESSION['adminrank'])){
    $user = $_SESSION['adminlog'];
    $rank = $_SESSION['adminrank'];
    $logout = '<a href="admin.php?lgo=logout" title="Log-Out">Log-Out</a>';
}

include 'config.php';
//  define variables from the form and set to empty values
    $name = $image = $price = $status = $category = "";
//same with error variables
    $nameErr = $imageErr = $priceErr = $statusErr = $categoryErr = "";
//    define the test_input function that is used below
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate name
    if(empty($_POST["name"])){
        $nameErr = "Name is required";
    } else{
//        check below to see what test_input() function does
        $name = test_input($_POST["name"]);
//        check if name only contains letters and whitespace
        if(!preg_match('/^[a-zA-Z0-9\s]+$/', $name)){
            $nameErr = "Only letters and whitespaces allowed.";
        }
    }
    if(empty($_POST["image"])){
        // Validate image
        $imageErr = "Image path is required.";
    } else{
        $image = test_input($_POST["image"]);
//        check if the filename is proper and filetypes are proper
        if(!preg_match("([^\s]+(\.(?i)(jpg|jpeg|png|gif|bmp))$)", $image)){
            $imageErr = "Invalid filename/extension! Only [letters numbers . - _ jpg jpeg png] allowed.";
        }
    }
    if(empty($_POST["price"])){
        // Validate price
        $priceErr = "Price is required.";
    } else {
        $price = test_input($_POST["price"]);
//        check if the price is correct format
        if(!preg_match("/^(?!0+$)\d{0,5}(.\d{1,2})?$/", $price)){
            $priceErr = "The price format not valid.";
        }
    }
    if(empty($_POST["status"])){
        // Validate status
        $statusErr = "Status is required.";
    } else{
        $status = test_input($_POST["status"]);
//        check if the status is an integer
        if(!preg_match("/^[1]/", $status)){
            $statusErr = "Set to 1 (available) by default.";
        }
    }
    if(empty($_POST["category"])){
        // Validate category
        $categoryErr = "Category is required.";
    } else{
        $category = test_input($_POST["category"]);
//        check if the category is correct format
        if(!preg_match("/^[a-zA-Z]*$/i", $category)){
            $categoryErr = "Only letters and whitespaces allowed.";
        }
    }
    // Check input errors before inserting into database
    if(empty($nameErr) && empty($imageErr) && empty($priceErr) && empty($statusErr) && empty($categoryErr)){

        // Prepare an insert statement
        $sql = "INSERT INTO products (name, image, price, status, category) VALUES (?, ?, ?, ?, ?)";
        if($stmt = $mysqli->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("sssss", $param_name, $param_image, $param_price, $param_status, $param_category);
            // Set parameters 
            $param_name = $name;
            $param_image = $image;
            $param_price = $price;
            $param_status = $status;
            $param_category = $category;
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Redirect to add-products page
                header("location: product-added.php");
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
        // Close statement
        $stmt->close();
    }
    // Close connection
    $mysqli->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Add Products - Admin</title>
	<link rel="stylesheet" type="text/css" href="admin.css">
    <style type="text/css">
		.contactform {
        /*	width:75%;*/
			padding:10px;
			font-size:12px;   
		}
        .contactform fieldset input{
            width:50%;
        }
	</style>
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
            <li><a href="add-products.php" class="active">Add Items</a></li>
            <li><a href="remove-products.php">Remove Items</a></li>
            <li><a href="add-remove-users.php">Add/Remove Users</a></li>
            <li class="a"><?php echo $user ." | rank: ". $rank; ?></li>
            <li style="float:right;"><?php echo $logout; ?></li>
        </ul>
    </div>
    <!--HEAD AND NAV FOR ALL PAGES - END-->
    <br><br><br><br><br><br><br><br><br>

<!--This is the beginning of the form-->
<container class="contactform">
    	<h3>Add the details of the product here.</h3>
	<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
		<fieldset id="contactform1" style="text-align:left;">
        <legend>Product Details</legend>
	Name: <br><input type="text" name="name" placeholder="name" value="<?php echo $name; ?>">
            <span class="error"> * <?php echo $nameErr ; ?></span><br><br>
	Image: <br><input type="text" name="image" placeholder="imagepath e.g. images/shoes3.jpg" value="<?php echo $image; ?>">
            <span class="error"> * <?php echo $imageErr ; ?></span><br><br>
	Price: <br><input type="text" name="price" placeholder="USD 0.00" value="<?php echo $price; ?>">
            <span class="error"> * <?php echo $priceErr ; ?></span><br><br>
	Status: <br><input type="text" name="status" placeholder="1" value="1">
            <span class="error"> * <?php echo $statusErr ; ?></span><br><br>
	Category: <br><input type="text" name="category" placeholder="mens/womens/camping/shoes etc." value="<?php echo $category; ?>">
            <span class="error"> * <?php echo $categoryErr ; ?></span><br><br>
    <input type="submit" name="submit" value="Add to Database" style="width:inherit; padding: 10px 20px;">
	<input type="reset" name="reset" value="Reset" style="width:auto; padding:10px 20px; font-size:12px;">
	</fieldset>
</form>
</container>


</body>
</html>
