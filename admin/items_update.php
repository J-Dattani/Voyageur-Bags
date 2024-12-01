<?php
include('conn.php');
include('items.php');

// Check if form data is set
if(isset($_POST['name'], $_POST['description'], $_POST['price'], $_POST['category'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $category = $_POST['category'];
    $caption = $_POST['caption'];
    $percentage = $_POST['percentage'];

    mysqli_query($conn, "INSERT INTO items (name, description, price, category, caption, percentage) VALUES ('$name', '$description', '$price', '$category', '$caption', '$percentage')");
    $_SESSION['status_code'] = "";
    $_SESSION['success']="Item Updated Successfully";
    header('location: ./items_list.php');
    exit(); // Terminate script execution after redirection
} else {
    $_SESSION['status_code'] = "";
    $_SESSION['error']="Error: One or more required form fields are missing.";
    
}
?>