<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include('conn.php');

if ($_SERVER['REQUEST_METHOD'] == "GET") {

    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        if (!empty($id)) {
            $sql = "DELETE FROM queries WHERE id = ?";
            $stmt = $conn->prepare($sql);

            if ($stmt) {
                $stmt->bind_param("i", $id);

                if ($stmt->execute()) {
                    $_SESSION['status_code'] = "";
                    $_SESSION['success']="Query Deleted Successfully";
                    header('location: ./customer_queries.php');
                    exit();
                } else {
                    $_SESSION['error']="Error executing statement: ". $stmt->error;
                    header('location: ./customer_queries.php');
                    $stmt->close();
                    exit();
                }
            } else {
                $_SESSION['error']="Error preparing statement: " . $conn->error;
                header('location: ./customer_queries.php');
                exit();
            }
        } else {
            $_SESSION['error']="Invalid item ID";
            header('location: ./customer_queries.php');
            exit();
        }
    } 
}

?>
