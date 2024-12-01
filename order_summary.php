<?php
session_start();
include('user/user_session.php');


// db settings
$hostname = 'localhost';
$username = 'root';
$password = '';
$database = 'voyageur_bags';

// db connection
$con = mysqli_connect($hostname, $username, $password, $database) or die("Error " . mysqli_error($con));


// Check if 'id' parameter is set in the URL
if (isset($_GET['product_id']) && !empty($_GET['product_id'])) {
    $id = $_GET['product_id'];



// Fetch categories for dropdown
$sql = 'SELECT category_id, category_name FROM categories';
$res = $con->query($sql);


    // Prepare and execute the query
    $stmt = $con->prepare("SELECT items.*, categories.category_name
    FROM items
    LEFT JOIN categories
    ON items.category = categories.category_id WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "No record found for the provided ID.";
        exit;
    }
} else {
    echo "Error: 'id' parameter is missing in the URL.";
    exit;
}

// Check if 'quantity' parameter is set and not empty
if (isset($_POST['quantity']) && !empty($_POST['quantity'])) {
    $quantity = intval($_POST['quantity']);
} else {
    $quantity = 1; // Default quantity if not provided
}

$sqlcustomer='SELECT * FROM user';
$rescustomer=$con->query($sqlcustomer);

if ($rescustomer->num_rows > 0) {
    $rows = $rescustomer->fetch_assoc();
} else {
    echo "No record found for the provided ID.";
    exit;
}

$customer_id = $_SESSION['id'];
$total_price = $row['discounted_price'] * $quantity;
$gst_rate=18;
$gst_amount = ($total_price * $gst_rate) / 100;
$grand_total = $total_price + $gst_amount;
$delivery_date = date('jS F, Y', strtotime('+7 days'));
$order_date = date('jS F, Y'); 
$item = $row['name'];
$category_name=$row['category_name'];
$item_id = $row['id'];

?>


<!DOCTYPE html>
<html lang="en" style="height: 50%;
    padding: 0;
    margin: 0;">
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
<link href="order_summary.css" rel="stylesheet">
<link rel="stylesheet" href="order_summary.css?v=<?php echo time(); ?>">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voyageur Bags</title>
    <link rel="icon" href="img/bags.png" type="image/x-icon">
    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.11.1/dist/sweetalert2.all.min.js"></script>
</head>
<body onload="loaderFunction()" style="margin: 0">

<div id="loader"></div>
<div id="loading-text">
    <p>Processing Your Order Summary, Please Wait...</p>
  </div>
<script>
    function loaderFunction() {
      setTimeout(showPage, 5000); // Simulating a delay of 3 seconds
      document.getElementById("main_footer").style.display = "none"; // Show footer     
    }

    function showPage() {
      document.getElementById("loader").style.display = "none"; // Hide loader
      document.getElementById("loading-text").style.display = "none"; // Hide loading text
      document.getElementById("page-content").style.display = "block"; // Show content
      document.getElementById("page-content").style.opacity = 1; // Ensure content opacity is 1
      document.getElementById("main_footer").style.display = "block"; // Show footer
      document.getElementById("main_footer").style.opacity = 1; // Ensure footer opacity is 1

    }
  </script>
    
    <div id="page-content">


    <div class="name">
    <img src="img/bags.png" class="logo_icon">
        <a style="    left: 0;
    top: -12px; position:relative; font-size:xx-large">Voyageur Bags</a> 
    
    </div>
    <header>
    <div class="navbar" >
        <div class="" style="font-size: xxx-large;">
            <a href="#home"></a>
        </div>
        <ul class="links">
            <li><a href="./bags.php">Home</a></li>
            <li><a href="./pagitation_page.php">Products</a></li>
            <li><a href="#About">About</a></li>
            <li><a href="#Locations">Locations</a></li>
            <li><a href="#Contact">Contact</a></li>
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
        <li><a href="#About">About</a></li>
        <li><a href="#Locations">Locations</a></li>
        <li><a href="#Contact">Contact</a></li>
        <li><a href="./my_orders.php">My Orders</a></li>
        <a onclick="noBack()" href="user/user_logout.php" style="position: relative;
    left: 109px;
    top: 5px;">Logout</a>
        
    </div>
    </header>


<h1 class="Summary">Order Summary</h1>

<div class="summary_container">

    <div class="main_summary">
        <div class="items_list">
            <table>
                <tr>
                    <th class="itm">Items</th>
                    <th class="cat">Category</th>
                    <th class="qut">Quantity</th>
                    <th class="price">Price</th>
                </tr>
                <tr>
                    <td class="itm"><?php echo $row['name']; ?></td>
                    <td class="cat"><?php echo $row['category_name']; ?></td>
                    <td class="qut"><?php echo $quantity; ?></td>
                    <td class="price">₹<?php echo $row['discounted_price']; ?></td>
                </tr>
            </table>
        </div>
        
<hr class="hr14r">
<div>
    <div class="billing_form">

        <h2>Shipping Address</h2>
    
        <form action="user/orders.php" method="post">
                <label class="label_for_name" for="name">Your Name</label>
                <br>
                <input type="text" placeholder="Enter Your Full Name" id="name" name="name" required>

                <div class="for_contact">
                <label class="label_for_phone" for="phone">Mobile number</label>
                <br>
                <input type="phone" placeholder="Enter Mobile number" id="phone" name="phone" required>
                </div>
                <br><br>
                

                <label for="address">Flat, House no, Building, Apartment, Company</label><br>
                <input type="address" placeholder="Enter Address" id="address" name="address" required>
                <br><br>

                <label for="area">Area, Street, Sector, Village</label><br>
                <input type="area" placeholder="Enter Area..." id="area" name="area" required>
                <br><br>

                <label class="for_landmark" for="landmark">Landmark</label><br>
                <input type="landmark" placeholder="Enter landmark..." id="landmark" name="landmark" required>
                <br><br>
                
                <label class="label_for_pincode" for="pincode">Pincode</label><br>
                <input type="pincode" placeholder="Enter pincode..." id="pincode" name="pincode" required>
                
                <div class="for_contact">
                <label class="label_for_city" for="city">City/Town</label><br>
                <input  type="city" placeholder="Enter city..." id="city" name="city" required>
                </div>

    </div>

    <div class="bill">
        <div class="est">
            <h2 style="background-color: transparent;">Estimated Delivery Date:</h2><br>
            <p><?php echo isset($delivery_date) ? $delivery_date : ''; ?></p>
            <input type="hidden" id="order_date" name="order_date" value="<?php echo $order_date; ?>">
            <input type="hidden" id="delivery_date" name="delivery_date" value="<?php echo isset($delivery_date) ? $delivery_date : ''; ?>">
        </div>
        <div class="note">
            <h3 style="background-color: transparent;">Note:</h3>
            <p>During Festive seasons, a high volume of orders may result in delays in Delivery Date.</p>
        </div>
        <hr class="hr15r">
        <div class="grand_total">
            
        <h2 style="background-color: transparent;">Grand Total</h2><br>
            
            <p>Total Price:</p>
            <p class="item_amt">₹<?php echo $total_price; ?></p>
            <input type="hidden" id="total_price" name="total_price" value="<?php echo $total_price; ?>">
            
            
            <hr class="hr16r">

            <div class="tax" style="background-color: transparent;">
            <p style="background-color: transparent;">Tax Rate:</p>
            <p style="background-color: transparent;" class="item_amt">18%</p>
            
            <p style="background-color: transparent;">Tax Amount:</p>
            <p style="background-color: transparent;" class="item_tax">₹<?php echo $gst_amount; ?></p>
            <input type="hidden" id="gst_amount" name="gst_amount" value="<?php echo $gst_amount ?>">
            
            <hr class="hr17r"><br>
            
            <p style="background-color: transparent;">Order Total:</p>
            <p style="background-color: transparent;" class="grand_amt">₹<?php echo $grand_total; ?></p>
            <input type="hidden" id="grand_total" name="grand_total" value="<?php echo $grand_total; ?>">
            <input type="hidden" id="item" name="item" value="<?php echo $item; ?>">
            <input type="hidden" id="category_name" name="category_name" value="<?php echo $category_name; ?>">
            <input type="hidden" id="quantity" name="quantity" value="<?php echo $quantity; ?>">
            <input type="hidden" id="item_id" name="item_id" value="<?php echo $id; ?>">
            <input type="hidden" id="customer_id" name="customer_id" value="<?php echo $customer_id; ?>">

            <button  class="btncnt" type="submit">Place Order</button>

            <?php if (isset($_SESSION['error'])) { ?>
      
      <script>
     swal.fire(
  '<?php echo $_SESSION['error'];?>',
  '<?php echo $_SESSION['status_code'];?>',
  'success'
)
      
      </script>
  <?php   unset($_SESSION['error']);
  unset($_SESSION['status_code']);
  } ?>
  <?php
  if (isset($_SESSION['success'])) { ?>
      
  <script>
       swal.fire(
  '<?php echo $_SESSION['success'];?>',
  '<?php echo $_SESSION['status_code'];?>',
  'success'
)
  </script>
    <?php 
  unset($_SESSION['success']);
  unset($_SESSION['status_code']);
  } ?>
            <button  class="btndis" onclick="redirectToProductPage()" type="submit">Discard</button>
   
            </form>
         
<script>
    function redirectToProductPage() {
        // Replace 'product-page-url' with the actual URL of the product page
        window.location.href = 'pagitation_page.php';
    }
</script>
            </div>
        </div>
    </div>

</div>

    </div>

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

<!-- <footer>
<div class="main_footer">
    <div class="footer_contact_info">
      <div class="mail">
        <h3 style="background: transparent;">Send us an email</h3>
        <a href="#" style="background: transparent;">voyageurbags@gmail.com</a>
        </div>
<div class="call" >
        <h3 style="background: transparent;">Call us</h3>
        <p style="background: transparent;">+91-9997-8888-88</p>
        </div>
        <div class="locati">
        <h3 style="background: transparent;">Our location</h3>
        <p style="background: transparent;">Delhi Rectangle, New Delhi, India</p>
        </div>
    </div>
    <div class="social_media">
    <p style="color: white; background-color: transparent;">Follow Us:</p>
    <a href="#"><i style="color: white; background-color: transparent;" class="fa-brands fa-instagram fa-l"></i></a>&ensp;
    <a href="#"><i  style="color: white; background-color: transparent;" class="fa-brands fa-x-twitter fa-l"></i>&ensp;
    <a href="#"><i  style="color: white; background-color: transparent;" class="fa-brands fa-square-facebook fa-l"></i></a>&ensp;
    <a href="#"><i style="color: white; background-color: transparent;" class="fa-brands fa-youtube fa-l"></i></a>
    
    <div class="footer_company_logo">
    <p class="name_footer">Voyageur Bags</p>
      <img class="logo_footer" src="img/bags.png">
      
    </div>

    </div>
    
    <hr style="position: relative;
    top: 8px;" class="hr11r">
    <br>
<div class="terms">
<a style="background-color: transparent; color:whitesmoke; cursor:pointer; font-size:medium;">Terms & Condition &ensp;</a><a style="background-color: transparent; color:whitesmoke; cursor:pointer; font-size:medium;"> Privacy &ensp;</a><a style="background-color: transparent; color:whitesmoke; cursor:pointer; font-size:medium;">Personal Information Collection Statement</a>
</div>
<p class="india">INDIA</p>
  <br><br>
<p style=" position: relative;
    bottom: 8px; background-color: transparent; color: whitesmoke;">Copyright © 2024 Developed and managed by Quadrant</p>
<span class="payment">
<img class="payment_logo" src="img/Visa_Brandmark_White_RGB_2021.png">&ensp;
<img class="payment_logo" src="img/mc_symbol_opt_45_1x.png">
</span>
</div>
</footer> -->
</div>
</body>
</html>