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
$on_sale = $_POST['on_sale'];

// Update database
$sql = "UPDATE items SET on_sale = '$on_sale' WHERE id = '$item_id'";

if ($conn->query($sql) === TRUE) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: ". $conn->error;
}

// Fetch the value of on_sale for the specified item_id
$sql_select = "SELECT on_sale FROM items WHERE id = '$item_id'";
$result = $conn->query($sql_select);

if ($result->num_rows > 0) {
    // Output data of each row
    $row = $result->fetch_assoc();
    $on_sale_value = $row["on_sale"];
    // Now you can determine whether the checkbox should be checked or not
    if ($on_sale_value == 1) {
        echo "<script>$('#percentage-checkbox').prop('checked', true);</script>";
    } else {
        echo "<script>$('#percentage-checkbox').prop('checked', false);</script>";
    }
} else {
    echo "0 results";
}

$conn->close();
?>
