<?php
// db settings
$hostname = 'localhost';
$username = 'root';
$password = '';
$database = 'voyageur_bags';

// db connection
$con = mysqli_connect($hostname, $username, $password, $database) or die("Error " . mysqli_error($con));

// fetch records


$sql = "select category_id,image,category_name,description from categories";
$result = mysqli_query($con, $sql);

while($row = mysqli_fetch_assoc($result)) {
    
    $row['action'] = "<a href='./category_edit.php?category_id=".$row['category_id'] ."' class='btn btn-primary' style='margin: 10px;'>Edit</a>&nbsp;<a href='./category_delete.php?id=".$row['category_id'] ."'class='btn btn-danger'>Delete</a>
    ";
    $array[] = $row;

}

$dataset = array(
    "echo" => 1,
    "totalrecords" => count($array),
    "totaldisplayrecords" => count($array),
    "data" => $array
);

echo json_encode($dataset);
?>