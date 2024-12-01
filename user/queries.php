<?php

include('conn.php');

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $message = $_POST['message'];


        // Validating and formatting dates
        if (isset($_POST['query_date'])) {
            $query_date = DateTime::createFromFormat('jS F, Y', $_POST['query_date']);
            if ($query_date !== false) {
                $query_date = $query_date->format('Y-m-d');
            } else {
                $_SESSION['error'] = "Invalid order date format.";
                $_SESSION['status_code'] = "success";
                header("location: ./bags.php");
                exit();
            }
        }


    if (empty($name) || empty($email) || empty($phone) ) {
        $_SESSION['error'] = "Please Fill the details";
        $_SESSION['status_code'] = "success";
        header("location: ./bags.php");
        exit();
    }

    // Prepare and execute the SQL query to insert the data into the database
    $sql = "INSERT INTO queries (name, email, phone, message, query_date) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    // Check if the SQL query was prepared successfully
    if ($stmt === false) {
        
        $_SESSION['error'] = "Error: Unable to prepare SQL statement.";
        $_SESSION['status_code'] = "success";
        header("location: ./bags.php");
        exit();
    }

    // Bind parameters and execute the statement
    $stmt->bind_param("sssss", $name, $email, $phone, $message, $query_date);
    if ($stmt->execute()) {
        $_SESSION['status_code'] = "success";
        $_SESSION['success'] = "Thank you for reaching out! Your query has been successfully submitted.We will get back to you as soon as possible.";
    } else {
        $_SESSION['error'] = "Error: " . $stmt->error;
        $_SESSION['status_code'] = "success";
    }

    header("location: ./bags.php");
    exit();
}

?>
