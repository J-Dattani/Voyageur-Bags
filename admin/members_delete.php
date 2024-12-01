<?php

include('conn.php');

if ($_SERVER['REQUEST_METHOD'] == "GET") {

    if (isset($_GET['mem_id'])) {
        $mem_id = $_GET['mem_id'];

        if (!empty($mem_id)) {
            $sql = "DELETE FROM team WHERE id = ?";
            $stmt = $conn->prepare($sql);

            if ($stmt) {
                $stmt->bind_param("i", $mem_id);

                if ($stmt->execute()) {
                    $_SESSION['status'] = "";
                    $_SESSION['delete']="Member Deleted Successfully";
                    header('location: ./members_list.php');
                    exit();
                } else {
                    $_SESSION['status_code'] = "";
                    $_SESSION['error']="Error executing statement: ". $stmt->error;
                    header('location: ./members_list.php');
                    $stmt->close();
                    exit();
                }
            } else {
                $_SESSION['status_code'] = "";
                $_SESSION['error']="Error preparing statement: " . $conn->error;
                header('location: ./members_list.php');
                exit();
            }
        } else {
            $_SESSION['status_code'] = "";
            $_SESSION['error']="Invalid item ID";
            header('location: ./members_list.php');
            exit();
        }
    } 
}

 

?>
