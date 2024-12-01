<?php
// Database connection (assuming $conn is your database connection)

// Count for categories table
$sql = "SELECT COUNT(category_id) AS count FROM categories";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $categories_count = $row['count'];
} else {
    $categories_count = 0;
}

// Count for users table
$sql = "SELECT COUNT(id) AS count FROM user";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $user_count = $row['count'];
} else {
    $user_count = 0;
}


// Count for items table
$sql = "SELECT COUNT(id) AS count FROM items";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $items_count = $row['count'];
} else {
    $items_count = 0;
}

// Count for items On sale table
$sql = "SELECT COUNT(id) AS count FROM items where on_sale = 1 ";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $items_onsale_count = $row['count'];
} else {
    $items_onsale_count = 0;
}

// Count for users table
$sql = "SELECT COUNT(id) AS count FROM user";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $users_count = $row['count'];
} else {
    $users_count = 0;
}


// Count for Team table
$sql = "SELECT COUNT(id) AS count FROM team";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $members_count = $row['count'];
} else {
    $members_count = 0;
}


// Count for Stores table
$sql = "SELECT COUNT(id) AS count FROM stores";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $stores_count = $row['count'];
} else {
    $stores_count = 0;
}

// Count for Queries table
$sql = "SELECT COUNT(id) AS count FROM queries";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $queries_count = $row['count'];
} else {
    $queries_count = 0;
}

// Count for orders table
$sql = "SELECT COUNT(order_id) AS count FROM orders";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $orders_count = $row['count'];
} else {
    $orders_count = 0;
}

// Total price of all orders
$sql = "SELECT SUM(grand_total) AS total_price FROM orders";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $total_order_price = $row['total_price'];
} else {
    $total_order_price = 0;
}

// Assuming you want to calculate for the current month
$current_month = date('m'); // Get the current month in 'mm' format

$sql = "SELECT SUM(grand_total) AS total_price 
        FROM orders 
        WHERE MONTH(order_date) = $current_month";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $monthly_order_price = $row['total_price'];
} else {
    $monthly_order_price = 0;
}

// Count for orders table
$current_month = date('m'); // Get the current month in 'mm' format

$sql = "SELECT COUNT(order_id) AS count FROM orders WHERE MONTH(order_date) = $current_month";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $Monthly_orders_count = $row['count'];
} else {
    $Monthly_orders_count = 0;
}




// Total items of all orders
$current_month = date('m'); // Get the current month in 'mm' format

$sql = "SELECT SUM(quantity) AS total_items FROM orders WHERE MONTH(order_date) = $current_month";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $Monthly_order_items = $row['total_items'];
} else {
    $Monthly_order_items = 0;
}

// Category to search for
// Classic Backpacks
$classic_backpaks = 'Classic Backpacks';

// Query to count orders for the specified category
$sql = "SELECT COUNT(*) AS classic_backpaks_counts FROM orders WHERE category_name = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $classic_backpaks);
$stmt->execute();
$stmt->bind_result($classic_backpaks_counts);
$stmt->fetch();

// Close statement and connection
$stmt->close();


// Category to search for
// Classic Backpacks
$Suitcases = 'Suitcases';

// Query to count orders for the specified category
$sql = "SELECT COUNT(*) AS Suitcases_counts FROM orders WHERE category_name = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $Suitcases);
$stmt->execute();
$stmt->bind_result($Suitcases_counts);
$stmt->fetch();
// Close statement and connection
$stmt->close();

// Category to search for
// Classic Backpacks
$Tote_Bags = 'Tote Bags';

// Query to count orders for the specified category
$sql = "SELECT COUNT(*) AS Tote_Bags_counts FROM orders WHERE category_name = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $Tote_Bags);
$stmt->execute();
$stmt->bind_result($Tote_Bags_counts);
$stmt->fetch();
// Close statement and connection
$stmt->close();

// Category to search for
// Classic Backpacks
$Duffle_Bags = 'Duffle Bags';

// Query to count orders for the specified category
$sql = "SELECT COUNT(*) AS Duffle_Bags_counts FROM orders WHERE category_name = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $Duffle_Bags);
$stmt->execute();
$stmt->bind_result($Duffle_Bags_counts);
$stmt->fetch();
// Close statement and connection
$stmt->close();


// Category to search for
// Classic Backpacks
$Garment_Bags = 'Garment Bags';

// Query to count orders for the specified category
$sql = "SELECT COUNT(*) AS Garment_Bags_counts FROM orders WHERE category_name = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $Garment_Bags);
$stmt->execute();
$stmt->bind_result($Garment_Bags_counts);
$stmt->fetch();
// Close statement and connection
$stmt->close();


// Category to search for
// Classic Backpacks
$Garment_Bags = 'Garment Bags';

// Query to count orders for the specified category
$sql = "SELECT COUNT(*) AS Garment_Bags_counts FROM orders WHERE category_name = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $Garment_Bags);
$stmt->execute();
$stmt->bind_result($Garment_Bags_counts);
$stmt->fetch();
// Close statement and connection
$stmt->close();


// Category to search for
// Classic Backpacks
$For_Professionals = 'For Professionals';

// Query to count orders for the specified category
$sql = "SELECT COUNT(*) AS For_Professionals_counts FROM orders WHERE category_name = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $For_Professionals);
$stmt->execute();
$stmt->bind_result($For_Professionals_counts);
$stmt->fetch();
// Close statement and connection
$stmt->close();


// Close the connection
$conn->close();
?>
