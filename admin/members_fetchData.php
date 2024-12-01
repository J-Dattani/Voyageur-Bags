<?php
// db settings
$hostname = 'localhost';
$username = 'root';
$password = '';
$database = 'voyageur_bags';

// db connection
$con = mysqli_connect($hostname, $username, $password, $database) or die("Error " . mysqli_error($con));

// fetch records
$sql = "select * from team";
$result = mysqli_query($con, $sql);

while($row = mysqli_fetch_assoc($result)) {

    $row['action'] = "<a href='./members_edit.php?id=".$row['id'] ."' class='btn btn-primary' style='margin: 10px;'>Edit</a>&nbsp;<a href='./members_delete.php?mem_id=".$row['id'] ."' class='btn btn-danger'>Delete</a>
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