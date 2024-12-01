<?php
$conn = mysqli_connect('localhost', 'root', '');  
if (! $conn) {  
    die("Connection failed" . mysqli_connect_error());  
} else {  
    mysqli_select_db($conn, 'voyageur_bags');  
}

$per_page_record = 6;

if (isset($_GET["page"])) {    
    $page  = $_GET["page"];    
} else {    
    $page=1;    
}    

$start_from = ($page-1) * $per_page_record;     

$category_id = isset($_GET["category"]) ? $_GET["category"] : null;

if ($category_id) {
    $query = "SELECT items.*, categories.category_name
              FROM items
              LEFT JOIN categories
              ON items.category = categories.category_id
              WHERE items.category = $category_id
              LIMIT $start_from, $per_page_record";
} else {
    $query = "SELECT items.*, categories.category_name
              FROM items
              LEFT JOIN categories
              ON items.category = categories.category_id
              LIMIT $start_from, $per_page_record";
}

$rs_result = mysqli_query ($conn, $query);   