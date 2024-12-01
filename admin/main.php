<?php
include('conn.php');
// include('items.php)

// Check if 'id' parameter is set in the URL
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];

    $sql = 'SELECT category_id, category_name FROM categories';
    $catRes = $conn->query($sql);
    
    // Prepare and execute the query
    $stmt = $conn->prepare("SELECT * FROM items WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "No record found for the provided ID.";
        exit;
    }
} else {
    echo "Error: 'id' parameter is missing in the URL.";
    exit;
}

// Process form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $category = $_POST['category'];

    // Update query
    $update_query = "UPDATE items SET name=?, description=?, price=?, category=? WHERE id=?";
    $stmt = $conn->prepare($update_query);
    $stmt->bind_param("ssdii", $name, $description, $price, $category, $id);

    if ($stmt->execute()) {
        $_SESSION['success'] = "Item updated successfully!";
        header('Location: ./items_list.php');
        exit();
    } else {
        $_SESSION['error'] = "Error updating item: " . $conn->error;
    }
}
?>