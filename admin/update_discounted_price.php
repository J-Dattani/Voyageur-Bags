<?php
// db settings
$hostname = 'localhost';
$username = 'root';
$password = '';
$database = 'voyageur_bags';

// db connection
$con = mysqli_connect($hostname, $username, $password, $database) or die("Error " . mysqli_error($con));

// fetch records
$sql = "SELECT id, price, percentage FROM items";
$result = mysqli_query($con, $sql);

while($row = mysqli_fetch_assoc($result)) {
    // Calculate discounted price
    $discountedPrice = $row['price'] - ($row['price'] * ($row['percentage'] / 100));

    // Update discounted price in the database
    $updateSql = "UPDATE items SET discounted_price = $discountedPrice WHERE id = {$row['id']}";
    mysqli_query($con, $updateSql);
}

// Close connection
mysqli_close($con);

// Return success response
echo json_encode(array('success' => true));
?>
