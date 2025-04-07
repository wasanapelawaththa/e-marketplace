<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the user inputs
    $make = $_POST['Make'];
    $model = $_POST['model'];
    $millege = $_POST['millege'];

    // Directory where the uploaded files will be stored
    $targetDir = "../uploads/";
    
    // Ensure the 'uploads' directory exists
    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0777, true);
    }

    // Get the file name and set the target file path
    $targetFile = $targetDir . basename($_FILES["image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Check if the file is an actual image
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    // Check if file already exists
    if (file_exists($targetFile)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // Limit file size (e.g., 5MB limit)
    if ($_FILES["image"]["size"] > 5000000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        // If everything is okay, try to move the uploaded file to the server
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
            echo "The file " . htmlspecialchars(basename($_FILES["image"]["name"])) . " has been uploaded."."<br>";

            // Store the user input and file path in the database
            // Connect to the database
                require'config.php';

            // Create database 
            $sql="CREATE TABLE IF NOT EXISTS vehicles( vehicle_id INT PRIMARY KEY AUTO_INCREMENT,
            make VARCHAR(50) NOT NULL,
            model VARCHAR(50) NOT NULL,
            millege INT NOT NULL,
            image_path VARCHAR(50) NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )";

            if($conn->query($sql)){
            echo"";
            }
            else{
            echo"Table vehicles error".$conn->error."<br>";
            }

            // Insert the data into the database
            $sql = "INSERT INTO vehicles (make, model, millege, image_path)
                    VALUES ('$make', '$model', '$millege', '$targetFile')";

            if ($conn->query($sql) === TRUE) {
            
                echo "
                <script>
                 window.location.href = '../html/success.html';
                </script>";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }

            // Close the database connection
            $conn->close();
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}
?>
