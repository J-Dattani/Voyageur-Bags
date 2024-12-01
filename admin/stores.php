<?php
include('conn.php');

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Get form data
    $location = $_POST['location'];
    $phone = $_POST['phone'];
    
    // Check if any required field is empty
    if (empty($location) || empty($phone) || empty($_FILES['image']['tmp_name'])) {
        $_SESSION['error'] = "Please fill all the details";
        header("location: ./stores_add.php");
        exit();
    }

    // Define folder to store uploaded images
    $targetDir = "uploads_stores/";

    // Get the file name
    $fileName = basename($_FILES["image"]["name"]);

    // Define file path
    $targetFilePath = $targetDir . $fileName;

    // Get file extension
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

    // Allow certain file formats
    $allowTypes = array('jpg', 'png', 'jpeg', 'gif');
    if (!in_array($fileType, $allowTypes)) {
        $_SESSION['error'] = "Sorry, only JPG, JPEG, PNG, GIF files are allowed to upload.";
        header("location: ./stores_add.php");
        exit();
    }

    // Upload file to server
    if (!move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)) {
        $_SESSION['error'] = "Sorry, there was an error uploading your file.";
        header("location: ./stores_add.php");
        exit();
    }

    // Prepare and execute the SQL query to insert the data into the database
    $sql = "INSERT INTO stores (location, phone, image) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);

    // Check if the SQL query was prepared successfully
    if ($stmt === false) {
        $_SESSION['error'] = "Error: Unable to prepare SQL statement.";
        header("location: ./stores_add.php");
        exit();
    }

    // Bind parameters and execute the statement
    $stmt->bind_param("sss", $location, $phone, $fileName);
    if ($stmt->execute()) {
        $_SESSION['status_code'] = "";
        $_SESSION['success'] = "Stores Added successfully";
    } else {
        $_SESSION['error'] = "Error: " . $stmt->error;
    }


    header("location: ./stores_add.php");
    exit();
}

?>
