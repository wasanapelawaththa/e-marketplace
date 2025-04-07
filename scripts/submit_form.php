<?php
require'config.php';


//Create Table
$sql="CREATE TABLE IF NOT EXISTS contact_messages( message_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    message TEXT NOT NULL,
    sent_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if($conn->query($sql)){
    echo"";
}
else{
    echo"Table contact_messages error".$conn->error."<br>";
}
// Retrieve form data
$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];

// SQL query to insert data into the database
$sql = "INSERT INTO contact_messages (name, email, message) VALUES ('$name', '$email', '$message')";

if ($conn->query($sql) === TRUE) {
    echo "
    <script>
       
        setTimeout(function() {
            window.location.href='../html/contact.html';
        }, 1000); // 1 seconds delay before redirecting to the same page
    </script>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}


// Close the connection
$conn->close();
?>