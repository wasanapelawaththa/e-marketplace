<?php
session_start();
require 'config.php';

// Enable error reporting to catch all potential issues
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Ensure both fields are filled in
    if (!empty($username) && !empty($password)) {
        // Prepare the SQL query
        $sql = "SELECT * FROM users WHERE username = ?";
        $stmt = mysqli_prepare($conn, $sql);

        if ($stmt === false) {
            die('MySQL prepare statement failed: ' . mysqli_error($conn));
        }

        mysqli_stmt_bind_param($stmt, 's', $username);

        if (!mysqli_stmt_execute($stmt)) {
            die('MySQL execute statement failed: ' . mysqli_error($conn));
        }

        $result = mysqli_stmt_get_result($stmt);
        $user = mysqli_fetch_assoc($result);

        // Fetch and check the user from the database
        if ($user) {
            // Verify the password
            if (password_verify($password, $user['password'])) {
                // Correct credentials, set session variables
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];

                header("Location: indexsignin.html"); // Redirect to a protected page
                exit;
            } else {
                $error = "Incorrect password.";
            }
        } else {
            $error = "User does not exist.";
        }
    } else {
        $error = "Please fill in both fields.";
    }
}

?>
