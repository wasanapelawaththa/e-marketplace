<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "vehiclelistingdb";

// Create a connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

//create Database 
$sql="CREATE DATABASE IF NOT EXISTS $dbname";

if($conn->query($sql)){
echo"";
}
else{
echo"Database Error".$conn->error;
}

//select Database
$conn->select_db($dbname);
?>