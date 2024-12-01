<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "voyageur_bags";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: ". $conn->connect_error);
}

// Get data from AJAX request
$item_id = $_POST['id'];
$home_items = $_POST['home_items'];

// Update database
$sql = "UPDATE items SET home_items = '$home_items' WHERE id = '$item_id'";

if ($conn->query($sql) === TRUE) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: ". $conn->error;
}

// Fetch the value of home_items for the specified item_id
$sql_select = "SELECT home_items FROM items WHERE id = '$item_id'";
$result = $conn->query($sql_select);

if ($result->num_rows > 0) {
    // Output data of each row
    $row = $result->fetch_assoc();
    $home_items_value = $row["home_items"];
    // Now you can determine whether the checkbox should be checked or not
    if ($home_items_value == 1) {
        echo "<script>$('#home-items-checkbox').prop('checked', true);</script>";
    } else {
        echo "<script>$('#home-items-checkbox').prop('checked', false);</script>";
    }
} else {
    echo "0 results";
}

$conn->close();
?>
