<?php
require'config.php';
//Create Table
$sql="CREATE TABLE IF NOT EXISTS users(
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP

)";

if($conn->query($sql)){
    echo"";
}
else{
    echo"Table users error".$conn->error."<br>";
}

// Retrieve form data
$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];

// SQL query to insert data into the database
$sql = "INSERT INTO users (username, email, password) VALUES ('$name', '$email', '$password')";

if ($conn->query($sql) === TRUE) {
    echo "
    <script>
        alert('Sign up Success!\\nWelcome ' + '$name');
        window.location.href = window.location.href='../html/index.html';
       
    </script>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the connection
$conn->close();



?>