<?php

include('conn.php');

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $name = $_POST['name'];
    $designation = $_POST['designation'];
    

    
    if (empty($name) || empty($designation) || empty($_FILES['image']['tmp_name'])) {
        $_SESSION['error'] = "Please Fill the details";
        header("location: member_add.php");
        exit();
    }

    // Define folder to store uploaded images
    $targetDir = "uploads_members/";

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
        header("location: ./member_add.php");
        exit();
    }

    // Upload file to server
    if (!move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)) {
        $_SESSION['error'] = "Sorry, there was an error uploading your file.";
        header("location: ./member_add.php");
        exit();
    }

    // Prepare and execute the SQL query to insert the data into the database
    $sql = "INSERT INTO team (member, designation, image) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);

    // Check if the SQL query was prepared successfully
    if ($stmt === false) {
        $_SESSION['error'] = "Error: Unable to prepare SQL statement.";
        header("location: ./member_add.php");
        exit();
    }

    // Bind parameters and execute the statement
    $stmt->bind_param("sss", $name, $designation, $fileName);
    if ($stmt->execute()) {
        $_SESSION['status_code'] = "";
        $_SESSION['success'] = "Member Added successfully";
    } else {
        $_SESSION['error'] = "Error: " . $stmt->error;
    }
    $stmt->close();
    $conn->close();

    header("location: ./member_add.php");
    exit();
}

?>
