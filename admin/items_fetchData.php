<?php
// Database connection settings
$hostname = 'localhost';
$username = 'root';
$password = '';
$database = 'voyageur_bags';

// Establish database connection
$con = mysqli_connect($hostname, $username, $password, $database) or die("Error " . mysqli_error($con));

// Fetch records with necessary JOIN and fields
$sql = "SELECT items.*, categories.category_name FROM items LEFT  JOIN categories ON items.category = categories.category_id";
$result = mysqli_query($con, $sql);

// Array to hold processed data
$array = array();

// Loop through each row fetched from the database
while ($row = mysqli_fetch_assoc($result)) {
    // Calculate discounted price
    $discountedPrice = $row['price'] - ($row['price'] * ($row['percentage'] / 100));

    // Update discounted price in the database
    $updateSql = "UPDATE items SET discounted_price = $discountedPrice WHERE id = {$row['id']}";
    mysqli_query($con, $updateSql);

    // Append action buttons to each row
    $row['action'] = "<a href='./items_edit.php?id=" . $row['id'] . "' class='btn btn-primary' style='margin: 10px;'>Edit</a><a href='./items_delete.php?items_id=" . $row['id'] . "' class='btn btn-danger'>Delete</a>";

    // Cast on_sale to integer (0 or 1)
    $row['on_sale'] = (int)$row['on_sale'];

    // Cast home_items to integer (0 or 1)
    $row['home_items'] = (int)$row['home_items'];

    // Append the modified row to the array
    $array[] = $row;
}

// Close database connection
mysqli_close($con);

// Prepare dataset for DataTables
$dataset = array(
    "draw" => 1, // Increment this for each request in DataTables
    "recordsTotal" => count($array), // Total number of records (not filtered)
    "recordsFiltered" => count($array), // Total number of records after filtering (if applied)
    "data" => $array // The actual data to be displayed
);

// Encode dataset as JSON and output
echo json_encode($dataset);
?>
