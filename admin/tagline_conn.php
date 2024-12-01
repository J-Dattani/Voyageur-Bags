<?php

include('conn.php');

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $tagline = $_POST['tagline'];

    if (empty($tagline)) {
        $_SESSION['error'] = "Please Fill the details";
        header("location: tagline_add.php");
        exit();
    }

    // Prepare and execute the SQL query to insert the data into the database
    $sql = "INSERT INTO tagline (tagline) VALUES (?)";
    $stmt = $conn->prepare($sql);

    // Check if the SQL query was prepared successfully
    if ($stmt === false) {
        $_SESSION['error'] = "Error: Unable to prepare SQL statement.";
        header("location: ./tagline_add.php");
        exit();
    }

    // Bind parameters and execute the statement
    $stmt->bind_param("s", $tagline);
    if ($stmt->execute()) {
        $_SESSION['status_code'] = "";
        $_SESSION['success'] = "Tagline Added successfully";
    } else {
        $_SESSION['error'] = "Error: " . $stmt->error;
    }

    header("location: ./tagline_add.php");
    exit();
}

?>
