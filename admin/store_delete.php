<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include('conn.php');

if ($_SERVER['REQUEST_METHOD'] == "GET") {

    if (isset($_GET['st_id'])) {
        $st_id = $_GET['st_id'];

        if (!empty($st_id)) {
            $sql = "DELETE FROM stores WHERE id = ?";
            $stmt = $conn->prepare($sql);

            if ($stmt) {
                $stmt->bind_param("i", $st_id);

                if ($stmt->execute()) {
                    $_SESSION['status_code'] = "";
                    $_SESSION['success']="Store Removed Successfully";
                    header('location: ./stores_list.php');
                    exit();
                } else {
                    $_SESSION['status_code'] = "";
                    $_SESSION['error']="Error executing statement: ". $stmt->error;
                    header('location: ./stores_list.php');
                    $stmt->close();
                    exit();
                }
            } else {
                $_SESSION['status_code'] = "";
                $_SESSION['error']="Error preparing statement: " . $conn->error;
                header('location: ./stores_list.php');
                exit();
            }
        } else {
            $_SESSION['status_code'] = "";
            $_SESSION['error']="Invalid item ID";
            header('location: ./stores_list.php');
            exit();
        }
    }
}

?>
