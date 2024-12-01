<?php


include('conn.php'); // Assuming this includes your database connection

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $name = $_POST['name'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $area = $_POST['area'];
    $landmark = $_POST['landmark'];
    $pincode = $_POST['pincode'];
    $city = $_POST['city'];
    $total_price = $_POST['total_price'];
    $gst_amount = $_POST['gst_amount'];

    // Validating and formatting dates
    if (isset($_POST['order_date'])) {
        $order_date = DateTime::createFromFormat('jS F, Y', $_POST['order_date']);
        if ($order_date !== false) {
            $order_date = $order_date->format('Y-m-d');
        } else {
            $_SESSION['error'] = "Invalid order date format.";
            header("location: ../order_summary.php");
            exit();
        }
    }

    if (isset($_POST['delivery_date'])) {
        $delivery_date = DateTime::createFromFormat('jS F, Y', $_POST['delivery_date']);
        if ($delivery_date !== false) {
            $delivery_date = $delivery_date->format('Y-m-d');
        } else {
            $_SESSION['error'] = "Invalid delivery date format.";
            header("location: ../order_summary.php");
            exit();
        }
    }

    $grand_total = $_POST['grand_total'];
    $item = $_POST['item'];
    $category_name = $_POST['category_name'];
    $quantity = $_POST['quantity'];
    $item_id = $_POST['item_id'];
    $customer_id = $_POST['customer_id'];

    if (empty($name) || empty($address) || empty($phone)) {
        $_SESSION['error'] = "Please Fill the details";
        header("location: ../order_summary.php");
        exit();
    }

    // Prepare the SQL query to insert the data into the database
    $sql = "INSERT INTO orders (name, address, phone, area, landmark, pincode, city, total_price, gst_amount, grand_total, delivery_date, item, category_name, quantity, order_date, item_id, customer_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    
    // Check if the SQL query was prepared successfully
    if ($stmt === false) {
        $_SESSION['error'] = "Error: Unable to prepare SQL statement.";
        header("location: ../order_summary.php");
        exit();
    }
    
    // Bind parameters and execute the statement
    $stmt->bind_param("sssssssssdssssssi", $name, $address, $phone, $area, $landmark, $pincode, $city, $total_price, $gst_amount, $grand_total, $delivery_date, $item, $category_name, $quantity, $order_date, $item_id, $customer_id);
    

    if ($stmt->execute()) {
        $_SESSION['status_code'] = "success";
        $_SESSION['success'] = "Order placed successfully!";
    
    } else {
        $_SESSION['error'] = "Error placing order.";
        $_SESSION['status_code'] = "success";
    }

    $stmt->close();

    // Redirect or display SweetAlert after setting session variables
    header("Location: ../bags.php"); // Redirect to refresh the page
    exit;
}



?>
