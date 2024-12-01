<?php
session_start();

if(isset($_SESSION['id'])) {
    // User is logged in
    echo "User is logged in. User ID: " . $_SESSION['id'];
} else {

    echo "User is not logged in. Redirecting to login page...";
    header("Location: ./user_login.php"); // Redirect to your login page
    exit(); // Ensure script stops execution after redirect
}
?>
