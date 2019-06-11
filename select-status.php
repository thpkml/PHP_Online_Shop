<?php require 'config1.php'; 

	$status = "";
	if($_SERVER["REQUEST_METHOD"]=="POST"){
    if(isset($_POST['submit'])){
		$status = $_POST["status"];
		$conn->query("UPDATE products SET status='$status' WHERE id='$id'");
		}
  }
?>