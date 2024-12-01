<?php
session_start();

include('user/user_session.php');

$userId = $_SESSION['id'];

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "voyageur_bags";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// $sql = "SELECT * FROM orders";
// $result = $conn->query($sql);
// Assuming you have a database connection established earlier
$query = "SELECT * FROM orders WHERE customer_id = ?";

// Prepare the statement
$statement = $conn->prepare($query);

if ($statement) {
    // Bind the parameter
    $statement->bind_param('i', $userId);  // 'i' indicates integer type

    // Execute the query
    $statement->execute();

    // Get the results
    $result = $statement->get_result();

    // Check if there are any orders
    if ($result->num_rows > 0) {
        // Loop through each row and display/order/process as needed
    } else {
        // No orders found
        $_SESSION['error'] = "No Orders Found";
        $_SESSION['status_code'] = "";
    }

    // Close the statement
    $statement->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.11.1/dist/sweetalert2.css" rel="stylesheet">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Cactus+Classical+Serif&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/fontawesome.min.css" integrity="sha512-UuQ/zJlbMVAw/UU8vVBhnI4op+/tFOpQZVT+FormmIEhRSCnJWyHiBbEVgM4Uztsht41f3FzVWgLuwzUqOObKw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Titillium+Web:ital,wght@0,200;0,300;0,400;0,600;0,700;0,900;1,200;1,300;1,400;1,600;1,700&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Freeman&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Overlock:ital,wght@0,400;0,700;0,900;1,400;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Signika+Negative:wght@600&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Sedan+SC&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital@1&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,300;1,300&display=swap" rel="stylesheet">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,500;1,500&display=swap" rel="stylesheet">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+SC:wght@100..900&display=swap" rel="stylesheet">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Signika+Negative&display=swap" rel="stylesheet">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
<link href="main.css" rel="stylesheet">
<link rel="stylesheet" href="main.css?v=<?php echo time(); ?>">
<link href="my_orders.css" rel="stylesheet">
<link rel="stylesheet" href="my_orders.css?v=<?php echo time(); ?>">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voyageur Bags</title>
    <link rel="icon" href="img/bags.png" type="image/x-icon">
        
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.11.1/dist/sweetalert2.all.min.js"></script>
</head>

<body onload="loaderFunction()" style="margin: 0">

<div id="loader"></div>
<div id="loading-text">
    <p>Fetching Your Orders, Please Wait..</p>
  </div>
<script>
    function loaderFunction() {
      setTimeout(showPage, 1500); // Simulating a delay of 3 seconds
    }

    function showPage() {
        document.getElementById("loading-text").style.display = "none"; // Hide loading text
      document.getElementById("loader").style.display = "none"; // Hide loader
      document.getElementById("page-content").style.display = "block"; // Show content
    
    <?php if (isset($_SESSION['error'])) { ?>
            swal.fire({
                title: '<?php echo $_SESSION['error'];?>',
                text: '<?php echo $_SESSION['status_code'];?>',
                icon: 'error'
            });
        <?php
            unset($_SESSION['error']);
            unset($_SESSION['status_code']);
        } ?>
    }
  </script>


<div id="page-content">

<div class="name">
    <img src="img/bags.png" class="logo_icon">
        <a style="left:0px; top:-10px; position:relative; font-size:xx-large;" href="./bags.php">Voyageur Bags</a> 
    
    </div>
    <header>
    <div class="navbar" >
        <div class="" style="font-size: xxx-large;">
            <a href="#home"></a>
        </div>
        <ul class="links">
            <li><a href="./bags.php">Home</a></li>
            <li><a href="./pagitation_page.php">Products</a></li>
            <li><a href="bags.php#About">About</a></li>
            <li><a href="bags.php#Locations">Locations</a></li>
            <li><a href="bags.php#Contact">Contact</a></li>
            <li><a href="./my_orders.php">My Orders</a></li>
            <a onclick="noBack()" href="user/user_logout.php">Logout</a>
          
        </ul>
        
        <div class="toggle_button">
            <i class="fa-solid fa-bars"></i>
        </div>
    </div>
    <div class="dropdown">
    <li><a href="./bags.php">Home</a></li>
            <li><a href="./pagitation_page.php">Products</a></li>
            <li><a href="bags.php#About">About</a></li>
            <li><a href="bags.php#Locations">Locations</a></li>
            <li><a href="bags.php#Contact">Contact</a></li>
            <li><a href="./my_orders.php">My Orders</a></li>
        <a onclick="noBack()" href="user/user_logout.php" style="position: relative;
    left: 116px;
    top: 5px;">Logout</a>
        
    </div>
  
</header>

<main>

    <h1 class="main_line">My Orders</h1>

    <hr class="hr18r">

    <div class="main_table">
    <table class="order">
        <thead>
            <tr>
                <th>Sr no.</th>
                <th>Order Id</th>
                <th>Order Date</th>
                <th>Name</th>
                <th>Item</th>
                <th>Qty</th>
                <th>Amount</th>
                <th>Delivery Date(est)</th>
                <th class="shipto">Ship To</th>
                
            </tr>
        </thead>
        <tbody>
        <?php
$count = 1; // Initialize counter for serial number
while ($rows = mysqli_fetch_assoc($result)) {
    ?>
    <tr>
        <td><?php echo $count++; ?></td>
        <td><?php echo $rows['order_id']; ?></td>
        <?php 
        // Format order date
        $order_date = $rows['order_date'];
        $order_formatted_date = date('j F Y', strtotime($order_date));
        ?>
        <td><?php echo $order_formatted_date; ?></td>
        <td><?php echo $rows['name']; ?></td>
        <td><?php echo $rows['item']; ?></td>
        <td><?php echo $rows['quantity']; ?></td>
        <td>₹<?php echo $rows['grand_total']; ?>/-</td>
        <?php 
        // Format delivery date
        $delivery_date = $rows['delivery_date'];
        $formatted_date = date('j F Y', strtotime($delivery_date));
        ?>
        <td><?php echo $formatted_date; ?></td>
        <td class="shipto"><?php echo $rows['address']; ?>,<br><?php echo $rows['area']; ?><br><?php echo $rows['pincode']; ?>,<?php echo $rows['city']; ?></td>
    </tr>
    <?php
}
?>

        </tbody>
    </table>
    
    <?php if (isset($_SESSION['error'])) { ?>
      

      
      </script>
  <?php   unset($_SESSION['error']);
  unset($_SESSION['status_code']);
  } ?> 
    </div>
</main>

<script>
        const tglbtn = document.querySelector('.toggle_button');
        const tglbtnIcon = document.querySelector('.toggle_button i');
        const dropDown = document.querySelector('.dropdown');
    
        tglbtn.onclick = function () {
            dropDown.classList.toggle('open');
            const isOpen = dropDown.classList.contains('open');
    
            tglbtnIcon.className = isOpen
                ? 'fa-solid fa-xmark'
                : 'fa-solid fa-bars';
        };
    </script>


<script>
    // JavaScript to populate serial numbers
    var table = document.querySelector('table');
    var rows = table.rows;

    for (var i = 1; i < rows.length; i++) { // Start from 1 to skip header row
        var cell = rows[i].cells[0];
        cell.textContent = i; // Set the serial number
    }
</script>
</div>
</body>
</html>