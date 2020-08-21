<?php
    $servername="localhost";
    $username="root";
    $password="Use_Your_Password";
    $dbname="CL";
//connect to the database
//1. create connection
$conn = new mysqli($servername, $username, $password, $dbname);
//2. check connection
if ($conn->connect_error){
    die("Failed to connect". $conn->connect_error);
}

//$conn->close();
?>
