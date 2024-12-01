<?php
include('conn.php');

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $itemId = $_POST['item_id'];

    // Prepare SQL statement
    $sql = "DELETE FROM items WHERE id = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        // Bind parameters
        $stmt->bind_param("i", $itemId);

        // Execute the statement
        if ($stmt->execute()) {
            $_SESSION['success'] = "Item deleted successfully";
        } else {
            $_SESSION['error'] = "Error: " . $stmt->error;
        }
        
        // Close the statement
        $stmt->close();
    } else {
        $_SESSION['error'] = "Error: " . $conn->error;
    }

    // Redirect to the list page
    header("location: categories_list.php");
    exit();
}

// Close the database connection
$conn->close();
?>