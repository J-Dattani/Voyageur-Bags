<?php
    session_start();
    define('DB_SERVER', 'localhost');
    define('DB_USERNAME', 'root');
    define('DB_password', '');
    define('DB_NAME', 'voyageur_bags');

    $conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_password, DB_NAME);

    if ($conn === false){
        die("Error: Could not connect. " . mysqli_connect_error());
    }
?>