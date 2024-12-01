<?php
session_start(); // Start the session

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "voyageur_bags";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $name = (string)trim($_POST['name']);
    $category = (string)trim($_POST['category']);
    $description = (string)trim($_POST['description']);
    $price = (float)trim($_POST['price']);
    $percentage = (int)trim($_POST['percentage']);
    $caption = (string)trim($_POST['caption']);
    $about_this_product = (string)trim($_POST['about_this_product']);
    $item_weight = (float)trim($_POST['item_weight']);
    $generic_name = (string)trim($_POST['generic_name']);

    if (empty($name) || empty($description) || empty($_FILES['image']['tmp_name'])) {
        $_SESSION['error'] = "Please fill in all the required details.";
        header("location: items_add.php");
        exit();
    }

    // Define folder to store uploaded images
    $targetDir = "uploads_items/";

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
        header("location: ./items_add.php");
        exit();
    }

    // Upload file to server
    if (!move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)) {
        $_SESSION['error'] = "Sorry, there was an error uploading your file.";
        header("location: ./items_add.php");
        exit();
    }

    // Prepare and execute the SQL query to insert the data into the database
    $sql = "INSERT INTO items (name, category, description, price, caption, generic_name, item_weight, about_this_product, percentage, image) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    // Check if the SQL query was prepared successfully
    if ($stmt === false) {
        $_SESSION['error'] = "Error: Unable to prepare SQL statement.";
        header("location: ./items_add.php");
        exit();
    }


    // Bind parameters and execute the statement
    $stmt->bind_param("ssssssssss", $name, $category, $description, $price, $caption, $generic_name, $item_weight, $about_this_product, $percentage, $fileName);
    if ($stmt->execute()) {
        $_SESSION['status_code'] = "";
        $_SESSION['success'] = "Item added successfully.";
    } else {
        $_SESSION['error'] = "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();

    header("location: ./items_add.php");
    exit();
}
?>
