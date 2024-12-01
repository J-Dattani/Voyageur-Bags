<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include('conn.php');

if ($_SERVER['REQUEST_METHOD'] == "GET") {

    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        if (!empty($id)) {
            $sql = "DELETE FROM tagline WHERE id = ?";
            $stmt = $conn->prepare($sql);

            if ($stmt) {
                $stmt->bind_param("i", $id);

                if ($stmt->execute()) {
                    $_SESSION['status_code'] = "";
                    $_SESSION['success']="Tagline Deleted Successfully";
                    header('location: ./tagline.php');
                    exit();
                } else {
                    $_SESSION['error']="Error executing statement: ". $stmt->error;
                    header('location: ./tagline.php');
                    $stmt->close();
                    exit();
                }
            } else {
                $_SESSION['error']="Error preparing statement: " . $conn->error;
                header('location: ./tagline.php');
                exit();
            }
        } else {
            $_SESSION['error']="Invalid item ID";
            header('location: ./tagline.php');
            exit();
        }
    }
}

?>
