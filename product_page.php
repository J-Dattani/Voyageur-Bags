<?php

session_start();

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

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve quantity from POST data
    $quantity = isset($_POST['quantity'])? intval($_POST['quantity']) : 1;

    // Redirect to next page
    header('Location: ./order_summary.php?product_id=' . $id . '&quantity=' . $quantity);
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head> 
    
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
<link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display&display=swap" rel="stylesheet">

    <link href="main.css" rel="stylesheet">
    <link rel="stylesheet" href="main.css?v=<?php echo time(); ?>"> 
    <link rel="stylesheet" href="product_page.css?v=<?php echo time(); ?>"> 

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voyageur Bags</title>
    <link rel="icon" href="img/bags.png" type="image/x-icon">
    <style>

        html {
            scroll-behavior: smooth; 
        }
        
    </style>
</head>
<body onload="loaderFunction()" style="margin: 0">

<div id="loader"></div>

<script>
    function loaderFunction() {
      setTimeout(showPage, 1000); // Simulating a delay of 3 seconds
      document.getElementById("main_footer").style.display = "none"; // Show footer     
    }

    function showPage() {
      document.getElementById("loader").style.display = "none"; // Hide loader
      document.getElementById("page-content").style.display = "block"; // Show content
      document.getElementById("page-content").style.opacity = 1; // Ensure content opacity is 1
      document.getElementById("main_footer").style.display = "block"; // Show footer
      document.getElementById("main_footer").style.opacity = 1; // Ensure footer opacity is 1

    }
  </script>
    
    <div id="page-content">

    <div class="name">
        <img src="img/bags.png" class="logo_icon">
            <a style="left:0px; top:-10px; position:relative; font-size:xx-large" href="./bags.php">Voyageur Bags</a> 
        
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
    left: 160px;
    top: 5px;">Logout</a>
            
        </div>
    </header>

    <main>
        <div class="container_product_info">
            <div class="container_product_image">
            <?php if (!empty($row['image'])) : ?>   
                    <img class="product_image" src="admin/uploads_items/<?php echo $row['image']; ?>" />
                    <?php else : ?>
                        <p>No image available</p>
                    <?php endif; ?>

            </div>
            <div class="product_info">
             
            <h1><?php echo $row['name']; ?></h1>
                <p><?php echo $row['category_name']; ?></p>
                <div class="container_product_price">
                    </div><br>
                    <p>₹<?php echo $row['discounted_price']; ?></p>
            

                  <div class="product_offers">
                    <h2><img src="img/discount.png" stu alt=""> Bank and Store Offers</h2>
                    <br>
                    <h4>Offer 1:</h4>
                    <p>10% Instant Discount up to INR 750 on ICICI Bank Credit Card</p>
                    <br>
                    <h4>Offer 2:</h4>
                    <p>10% Instant Discount up to INR 999 on Purchase of 2</p>
                </div>

                <form method="post" action="./order_summary.php?product_id=<?php echo $row['id']; ?>">
                    <label class="quantity_label" for="quantity">Quantity</label><br>
                    <div class="value-button" id="decrease" onclick="decreaseValue()" value="Decrease Value"><p class="minus">-</p></div>
                
                    <input type="number" name="quantity" id="quantity" value="1" />
                    <div class="value-button" id="increase" onclick="increaseValue()" value="Increase Value"><p class="plus">+</p></div>
                    
                    <button class="product_buy" type="submit">BUY</button>
                  </form>
                  </div>

            </div>

            <div class="our_spe">

            <hr class="hr12r">

            <h2 class="speciality_line">Why To Buy From Us</h2>
            
            <div class="speciality">
                <div>
                    <img class="speciality_icon" src="img/product-return.png">
                    <figcaption class="speciality_icon_caption">30 Days Return</figcaption>
                </div>
                <div>
                    <img class="speciality_icon" src="img/cash-on-delivery.png">
                    <figcaption class="speciality_icon_caption">COD Available</figcaption>
                </div>
                <div>
                    <img class="speciality_icon" src="img/shipped.png">
                    <figcaption class="speciality_icon_caption">Free Shipping</figcaption>
                </div>
                <div>
                    <img class="speciality_icon" src="img/transactions.png">
                    <figcaption class="speciality_icon_caption">Secure Transaction</figcaption>
            
                </div>

            </div>
            
            <hr class="hr13r">
            </div>
            <div class="product_details">
                <h2>Product Details</h2>
                <br>
                <p>Care instructions: Wipe with Damp Cloth</p>
                <p>Country of Origin: India </p>
                <p>Item Weight: <?php echo $row['item_weight']; ?>kg</p>
                <p>Net Quantity: 1.00 count</p>
                <p>Generic Name: <?php echo $row['generic_name']; ?></</p>
            </div>

            <div class="about_this">
                <h2>About this product</h2>
                <br>
                <ol>
                    <li>
                        
                    <li class="li_about_this"><?php echo $row['about_this_product']; ?></li></li>
                </ol>
            </div>

        </div>

    </main>

    
<div id="main_footer" class="main_footer">
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
<p id="copyright">Copyright © 2024 Developed and managed by Quadrant</p>
<span class="payment">
<img class="payment_logo" src="img/Visa_Brandmark_White_RGB_2021.png">&ensp;
<img class="payment_logo" src="img/mc_symbol_opt_45_1x.png">
</span>
</div>

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
        //script for Quantity increase-decrease

        function increaseValue() {
            var value = parseInt(document.getElementById('quantity').value, 10);
            value = isNaN(value) ? 0 : value;
            value++;
            document.getElementById('quantity').value = value;
          }
          
          function decreaseValue() {
            var value = parseInt(document.getElementById('quantity').value, 10);
            value = isNaN(value) ? 0 : value;
            value < 1 ? value = 1 : '';
            value--;
            document.getElementById('quantity').value = value;
          }
    </script>


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
</div>
</body>
</html>