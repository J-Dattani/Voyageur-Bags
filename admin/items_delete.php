<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include('conn.php');

if ($_SERVER['REQUEST_METHOD'] == "GET") {

    if (isset($_GET['items_id'])) {
        $items_id = $_GET['items_id'];

        if (!empty($items_id)) {
            $sql = "DELETE FROM items WHERE id = ?";
            $stmt = $conn->prepare($sql);

            if ($stmt) {
                $stmt->bind_param("i", $items_id);

                if ($stmt->execute()) {
                    $_SESSION['status_code'] = "";
                    $_SESSION['success']="Item Deleted Successfully";
                    header('location: ./items_list.php');
                    exit();
                } else {
                    $_SESSION['status_code'] = "";
                    $_SESSION['error']="Error executing statement: ". $stmt->error;
                    header('location: ./items_list.php');
                    $stmt->close();
                    exit();
                }
            } else {
                $_SESSION['status_code'] = "";
                $_SESSION['error']="Error preparing statement: " . $conn->error;
                header('location: ./items_list.php');
                exit();
            }
        } else {
            $_SESSION['status_code'] = "";
            $_SESSION['error']="Invalid item ID";
            header('location: ./items_list.php');
            exit();
        }
    } 
}


?>
