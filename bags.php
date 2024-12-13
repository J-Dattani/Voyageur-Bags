<?php
include('user/queries.php');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "voyageur_bags";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM categories";
$result = $conn->query($sql);

$query = 'SELECT items.* , categories.category_name
        FROM items 
        LEFT JOIN categories
        ON items.category = categories.category_id where home_items = 1' ;

$res = $conn->query($query);

$que = 'SELECT * from team';
$resu = $conn->query($que);

$sqlt = 'SELECT * from stores';
$rest = $conn->query($sqlt);

$sqltag = 'SELECT * from tagline';
$restag = $conn->query($sqltag);

$sqlsale = "SELECT * FROM items WHERE on_sale = 1";
$resultsale = $conn->query($sqlsale);

$query_date = date('jS F, Y'); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <style>

        html {
            scroll-behavior: smooth; /* Enables smooth scrolling */
        }
        .navbar{
          right: 0;
        }  
      
    </style>
    
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
<link href="main.css" rel="stylesheet">
<link rel="stylesheet" href="main.css?v=<?php echo time(); ?>">
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voyageur Bags</title>
    <link rel="icon" href="img/bags.png" type="image/x-icon">
    
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.11.1/dist/sweetalert2.all.min.js"></script>
</head>
<body>

    <div class="name">
    <img src="img/bags.png" class="logo_icon">
        <a style="left:0px; top:-10px; position:relative; font-size:xx-large;">Voyageur Bags</a> 
    
    </div>
    <header>
    <div class="navbar" >
        <div class="" style="font-size: xxx-large;">
            <a href="#home"></a>
        </div>
        <ul class="links">
            <li><a href="#home">Home</a></li>
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
        <li><a href="#Home">Home</a></li>
        <li><a href="./pagitation_page.php">Products</a></li>
        <li><a href="#About">About</a></li>
        <li><a href="#Locations">Locations</a></li>
        <li><a href="#Contact">Contact</a></li>
        <li><a href="./my_orders.php">My Orders</a></li>
        <a onclick="noBack()" href="user/user_logout.php" class="lgout">Logout</a>
    </div>
  
</header>

<main>
    <div>
    <h1 class="tagline">
    <?php
    while ($ROW = mysqli_fetch_assoc($restag)) {?>
      <?php echo $ROW['tagline'];?>
      <?php } ?>
    </h1>
    <a class="btn-shadow10" href="#see">See More</a>
</div>
    <!---<p class="intro"> we understand that every journey begins with the right bag. Whether you're a seasoned traveler, an occasional adventurer, or a daily commuter, we have the perfect travel bags to suit your needs.</p>
---->

    <?php
    while ($ROWS = mysqli_fetch_assoc($resultsale)) {?>
    <div id="hero" class="mySlides" >

        <p class="price_is"><b><sup>₹</sup><?php echo $ROWS['discounted_price'];?><sub>only</sub></b></p>
        <p class="price_was"><del><sup>₹</sup><?php echo $ROWS['price'];?></del></p>
        <p class="sale">
         
        <?php echo $ROWS['percentage'];?>%</p>
        <?php if (!empty($ROWS['image'])) : ?>
        <img id="for_sale_img" src="admin/uploads_items/<?php echo $ROWS['image']; ?>">
        <?php else : ?>
                        <p>No image available</p>
                    <?php endif; ?>
                   
        <figcaption><?php echo $ROWS['caption'];?></figcaption>
        <div class="offer-countdown" style="margin: 10px;
    color: red;
    
    font-size: larger;
    text-align: center;"></div>
    </div>
    <?php } ?>

</div>



<div>
    <h1 id="see" style="position:relative;"><hr class="see_hr"><br>Categories</h1>
    <div class="categories">
    <?php
    while ($rows = mysqli_fetch_assoc($result)) {?>
            <div class="categories_shape">
            <?php if (!empty($rows['image'])) : ?>
              <img class="categories_img" src="admin/uploads/<?php echo $rows['image']; ?>">
              <?php else : ?>
                        <p>No image available</p>
                    <?php endif; ?>
                    
            <figcaption class="categories_img_cap"><?php echo $rows['category_name'];?></figcaption>
            </div>
<?php } ?>
</div></div>


    <!---SECTION-1-->
    <?php
            while ($roW = mysqli_fetch_assoc($res)) {
                ?>
<section id="<?php echo $roW['id']; ?>">
<div class="product_card">
    
<h1 id="products"><hr><br>Products</h1>
<div class="wrapper">
<?php if (!empty($roW['image'])) : ?>
    <div class="product-img">
    <?php else : ?>
              <p>No image available</p>
            <?php endif; ?>

      <img  src="admin/uploads_items/<?php echo $roW['image']; ?>" height="420" width="327">
      
    </div>
    <div class="product-info">
      <div class="product-text">
        <h1><?php echo $roW['category_name']; ?></h1>
        <h2 style="color: rgb(65, 58, 58);"><?php echo $roW['name']; ?></h2>
        <p style="bottom: 40px; position:relative;"><?php echo $roW['description']; ?></p>
      </div>
      <div class="product-price-btn">
        <!-- <p><span class="price_wrapper"><sup style="background-color: transparent;">₹</sup><//?php echo $roW['discounted_price']; ?></span></p> -->
        <p>Explore More...</p>
        <button type="button" onclick="buy()" id="buy">Click Here!</button>
      </div>
    </div>
  </div>
</div>

</section>
<?php } ?>
<!---PRODUCT CARDS-->

<div class="changer" >
    <div>
<button id="prev" class="btn-95"  class="prev" onclick="changeSection(-1)"><</button>
</div>
<div >
<button id="next" class="btn-95"  class="next" onclick="changeSection(1)">></button>
</div>
</div>


<div>
    <h1 id="About"><hr style="position: relative; top: 45px;"><br>About Us</h1>
    <div class="about_head">
        
        <div class="about_container">
          
          <div class="about1">
            <hr class="hr1r">
            <h2><u>Our Journey</u></h2>

<!--FOR DESKTOP-->

            <div class="about1_p">
              
            <p>Founded in 2010, Voyageur  Bags began as a passion project<br>for two avid travelers who were frustrated with the lack of <br>high-quality, functional travel bags on the market. We,<br> envisioned a brand that would create the perfect travel<br> companion for every journey. From humble beginnings in a <br>small workshop, Voyageur Bags has grown into a renowned<br> brand trusted by travelers worldwide. Our dedication to quality,<br> innovation, and customer satisfaction has been the cornerstone of <br>our success.</p>
            
          </div>

<!--FOR MOBILE-->

          <div class="about1_p_mob">
              
            <p>Founded in 2010, Voyageur  Bags began as  <br>a passion project for two avid travelers who  <br> were frustrated with the lack of high-quality,  <br>functional travel bags on the market. We,<br> envisioned a brand that would create the  <br>perfect travel companion for every journey. <br>  From humble beginnings in a small workshop, <br>Voyageur Bags has grown into a renowned brand <br>trusted by travelers worldwide. Our dedication to quality,<br>innovation, and customer satisfaction has been the cornerstone <br>of our success.</p>
            
          </div>

            <hr class="hr2r">
            <div id="ab1_shape"> 
          </div>
          <div id="ab1_img">
            <img src="img/t.png" alt=""> 
        </div>
          </div>
        
          <div class="about2">
            <hr class="hr3r">
            <h2><u>Our Innovation</u></h2>
                <p class="about2_main">
                  At Voyageur Bags, our mission is to revolutionize the travel experience by providing bags that seamlessly combine functionality, durability, and style. We understand that every journey is unique, and our goal is to equip travelers with the perfect bag to meet their needs. Whether you are embarking on a weekend getaway or a month-long adventure, TravelEase is committed to enhancing your travel experience with thoughtfully designed products. 
                  
                  </p>
                  <div class="about2_items">
              <img id="ab2_img" src="img/2.png" alt="">
              <div class="total">
                <p class="p80">80<sup style="background-color:transparent; color:rgb(255, 166, 0);"><b style="background-color:transparent; color:rgb(255, 166, 0);">+</b ></sup></p>
                <p class="Design_Model">Design Model</p>
                <div class="vl1"></div>
                

                <p class="p450">450<sup style="background-color:transparent; color:rgb(255, 166, 0);"><b style="background-color:transparent; color:rgb(255, 166, 0);">+</b ></sup></p>
                  <p class="Reviews">Reviews</p>
                  <div class="vl2"></div>

                  <p class="p800">800<sup style="background-color:transparent; color:rgb(255, 166, 0);"><b style="background-color:transparent; color:rgb(255, 166, 0);">+</b ></sup></p>
                    <p class="Sales">Sales</p>
                    <div class="vl3"></div>

                    <p class="p20">20<sup style="background-color:transparent; color:rgb(255, 166, 0);"><b style="background-color:transparent; color:rgb(255, 166, 0);">+</b ></sup></p>
                      <p class="Stores">Stores</p>
                      
                </div>
              </div>
                <hr class="hr4r">
              <p class="tagofabout2">"Travel Well. Travel With Voyageur Bags."</p>
          </div>

          <div class="about3">
            <hr class="hr5r">
          
        <h2><u>Why To Choose Voyageur Bags ?</u></h2>

<!--FOR DESKTOP-->

        <div class="about3_p">
        <p>
        <i class="fa-solid fa-circle-check fa-l" style="color: #006f09;"></i>
      <b>Durable poly-ballistic material</b> to withstand the rigors of travel.<br><br>
      <i class="fa-solid fa-circle-check fa-l" style="color: #006f09;"></i>
      <b>Eva foam padded front </b> for added protection and durability.<br><br>
      <i class="fa-solid fa-circle-check fa-l" style="color: #006f09;"></i>
      <b>Water-resistant coating  </b> to protect your belongings from the elements.<br><br>
      <i class="fa-solid fa-circle-check fa-l" style="color: #006f09;"></i>
      <b>Adjustable compression straps </b> to secure your items in place.<br><br>
      <i class="fa-solid fa-circle-check fa-l" style="color: #006f09;"></i>
      <b>Fully lined interior </b>  with organizational pockets to keep your belongings tidy.<br><br>
      <i class="fa-solid fa-circle-check fa-l" style="color: #006f09;"></i>
      <b>Double-stitched seams and stress points</b> to ensure your Bag won't come &ensp;&ensp;apart under pressure.<br><br>
      </p>
    </div>

<!--FOR MOBILE-->

    <div class="about3_p_mob">
      <p>
      <i class="fa-solid fa-circle-check fa-l" style="color: #006f09;"></i>
    <b>Durable poly-ballistic material</b> to withstand the rigors of travel.<br><br>
    <i class="fa-solid fa-circle-check fa-l" style="color: #006f09;"></i>
    <b>Eva foam padded front </b> for added protection and durability.<br><br>
    <i class="fa-solid fa-circle-check fa-l" style="color: #006f09;"></i>
    <b>Water-resistant coating</b> to protect your belongings<br>&nbsp;&nbsp;&ensp;from the elements.<br><br>
    <i class="fa-solid fa-circle-check fa-l" style="color: #006f09;"></i>
    <b>Adjustable compression straps </b> to secure your<br>&nbsp;&nbsp;&ensp;items in place.<br><br>
    <i class="fa-solid fa-circle-check fa-l" style="color: #006f09;"></i>
    <b>Fully lined interior</b>  with organizational pockets <br>&nbsp;&nbsp;&ensp;to keep your belongings tidy.<br><br>
    <i class="fa-solid fa-circle-check fa-l" style="color: #006f09;"></i>
    <b>Double-stitched seams and stress points</b> to<br>&nbsp;&nbsp;&ensp;ensureyour Bag won't come apart under pressure.<br><br>
    </p>
  </div>
       
      <div class="ab3_img">
        <div id="ab3_a_img">
          <img src="img/a3_a.png" alt=""> 
      </div>

      <div id="ab3_a_img_mob">
        <img src="img/a3_a_mob.png" alt=""> 
    </div>

      
      <div id="ab3_b_img">
        <img src="img/a3_b.png" alt=""> 
    </div>

    
    <div id="ab3_b_img_mob">
      <img src="img/a3_b_mob.png" alt=""> 
  </div>
  </div>
  <hr class="hr6r">
          </div>
          <div class="about4">
            <hr class="hr7r">

            <h2><u>Meet the Team</u></h2>
            
               
              <div class="team">
              <?php
    while ($row = mysqli_fetch_assoc($resu)) {?> 
              <div class="team_shape">
              <?php if (!empty($row['image'])) : ?>
              <img class="team_img" src="admin/uploads_members/<?php echo $row['image']; ?>" alt="">
              <?php else : ?>
                        <p>No image available</p>
                    <?php endif; ?>
                    
              <figcaption class="team_img_cap"><?php echo $row['member'];?><br><b style="color: black; background:transparent;"><?php echo $row['designation'];?></b></figcaption>
              
              </div>
              <?php } ?>
              </div>
              
            </div>
            
            <hr class="hr8r">
          </div>
          
            </div>
      </div>
    </div>
    
    <h1 id="Locations"><hr><br>Locations</h1>
    <?php
    while ($Row = mysqli_fetch_assoc($rest)) {?>
<div class="stores store_slides fade">
  <div class="store_container">
  
  <?php if (!empty($Row['image'])) : ?>
    <img class="store_img" src="admin/uploads_stores/<?php echo $Row['image']; ?>">
    <?php else : ?>
                        <p>No image available</p>
                    <?php endif; ?>
                    
    <h3 class="store_head">Our Stores</h3>
    <div class="stores_main">
    <svg class="loc_icon" class="icon1" width="64px" height="64px" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg" fill="#000000" stroke="#000000" stroke-width="0.00016"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path fill="#009f09" d="M12.2426025,1.7573595 C14.5858025,4.1004995 14.5858025,7.8994895 12.2426025,10.2425995 L8.4852825,14 L11,14 C11.5523025,14 12,14.4476995 12,15 C12,15.5522995 11.5523025,16 11,16 L5,16 C4.4477225,16 4,15.5522995 4,15 C4,14.4476995 4.4477225,14 5,14 L7.5147225,14 L3.7573625,10.2425995 C1.4142125,7.8994895 1.4142125,4.1004995 3.7573625,1.7573595 C6.1005025,-0.5857865 9.8994925,-0.5857865 12.2426025,1.7573595 Z M5.1715725,3.1715695 C3.6094825,4.7336695 3.6094825,7.2663295 5.1715725,8.8284295 L8.000005,11.6568995 L10.8284025,8.8284295 C12.3905025,7.2663295 12.3905025,4.7336695 10.8284025,3.1715695 C9.2663325,1.6094795 6.7336725,1.6094795 5.1715725,3.1715695 Z M8.0000025,3.9999995 C9.1045725,3.9999995 10.0000025,4.8954295 10.0000025,5.9999995 C10.0000025,7.1045695 9.1045725,7.9999995 8.0000025,7.9999995 C6.8954325,7.9999995 6.0000025,7.1045695 6.0000025,5.9999995 C6.0000025,4.8954295 6.8954325,3.9999995 8.0000025,3.9999995 Z"></path> </g></svg>
    <p id="store_address"><?php echo $Row['location'];?></p>
    <svg class="num_icon" width="64px" height="64px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M3 5.5C3 14.0604 9.93959 21 18.5 21C18.8862 21 19.2691 20.9859 19.6483 20.9581C20.0834 20.9262 20.3009 20.9103 20.499 20.7963C20.663 20.7019 20.8185 20.5345 20.9007 20.364C21 20.1582 21 19.9181 21 19.438V16.6207C21 16.2169 21 16.015 20.9335 15.842C20.8749 15.6891 20.7795 15.553 20.6559 15.4456C20.516 15.324 20.3262 15.255 19.9468 15.117L16.74 13.9509C16.2985 13.7904 16.0777 13.7101 15.8683 13.7237C15.6836 13.7357 15.5059 13.7988 15.3549 13.9058C15.1837 14.0271 15.0629 14.2285 14.8212 14.6314L14 16C11.3501 14.7999 9.2019 12.6489 8 10L9.36863 9.17882C9.77145 8.93713 9.97286 8.81628 10.0942 8.64506C10.2012 8.49408 10.2643 8.31637 10.2763 8.1317C10.2899 7.92227 10.2096 7.70153 10.0491 7.26005L8.88299 4.05321C8.745 3.67376 8.67601 3.48403 8.55442 3.3441C8.44701 3.22049 8.31089 3.12515 8.15802 3.06645C7.98496 3 7.78308 3 7.37932 3H4.56201C4.08188 3 3.84181 3 3.63598 3.09925C3.4655 3.18146 3.29814 3.33701 3.2037 3.50103C3.08968 3.69907 3.07375 3.91662 3.04189 4.35173C3.01413 4.73086 3 5.11378 3 5.5Z" stroke="#009f09" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
    <p id="store_number"><?php echo $Row['phone'];?></p>  
  </div>
  
  </div>
  </div>
  <?php } ?>


<div class="main_dots" style="text-align:center">
  <span class="dot" onclick="currentSlide(1)"></span>
  <span class="dot" onclick="currentSlide(2)"></span>
  <span class="dot" onclick="currentSlide(3)"></span>
</div>

<h1 id="Contact"><hr><br>Contact Us</h1>
<br><br>
<div class="main_contact">
<h2 class="contact_line">Get &nbsp; In &nbsp; Touch<br>With Us</h2>

<div class="for_form">
<h3 class="form_line">Any Query ?? <br><p>Let us know...</p> </h3>
<form action="" method="post">

  <div class="inquire-form">
        <label for="name">Name</label>
        <br>
        <input type="text" placeholder="Enter Name" id="name" name="name" required>
        <br><br>
        <label for="email">Email</label>
        <br>
        <input type="email" placeholder="Enter Mail" id="email" name="email" required>
        <div class="for_contact">
        <label id="contact_label" for="contact">Contact Number</label>
        <br>
        <input type="phone" id="phone" placeholder="Enter Contact Number" name="phone" required>
        </div>
        <br><br>
        <label id="message_label" for="message">Message</label>
        <br>
        <textarea id="message" placeholder="Enter Your Message Here....." type="message" name="message" rows="4" required></textarea>
        <br>
        <input type="hidden" id="query_date" name="query_date" value="<?php echo $query_date; ?>">
        <button class="btncnt" type="submit">Submit</button>
        
        <?php if (isset($_SESSION['error'])) { ?>
      
    <script>
    Swal.fire({
    text:'<?php echo $_SESSION['error']; ?>',
    
    button: 'submit',
    });
    </script>
<?php 
} ?>
<?php
if (isset($_SESSION['success'])) { ?>
    
<script>
Swal.fire({
text:'<?php echo $_SESSION['success']; ?>',

button: 'submit',
});
</script>
  <?php 
unset($_SESSION['success']);
unset($_SESSION['status_code']);
} ?>
        </div>
    </form>
    </div>
    <div class="contact_text">
    <p>Contact us for questions, technical assistance, or collaboration opportunities via the contact information provided.</p>
    <br>
    </div>

    <div style="background: transparent;" class="contact_text2">
      <h4 style="background: transparent;"  style="color:#000000a1">For Bulk Orders</h4>
    <p style="background: transparent;" >For Corporate Gifting & Bulk Orders,
please drop in a mail with your request at
CorporateSales.lndia@voyageur.co</p>
    </div>
    

</div>
<br><br><br><br><br><br>

</main>

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
<p id="copyright">Copyright © 2024 Developed and managed by Quadrant</p>
<span class="payment">
<img class="payment_logo" src="img/Visa_Brandmark_White_RGB_2021.png">&ensp;
<img class="payment_logo" src="img/mc_symbol_opt_45_1x.png">
</span>
</div>





<script>
var myIndex = 0;
carousel();

function carousel() {
  var i;
  var x = document.getElementsByClassName("mySlides");
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";  
  }
  myIndex++;
  if (myIndex > x.length) {myIndex = 1}    
  x[myIndex-1].style.display = "block";  
  setTimeout(carousel, 2000); // Change image every 2 seconds
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


<!-- JavaScript for slider  -->
  <script>
  let slideIndex = 1;
  showSlides(slideIndex);

  function plusSlides(n) {
    showSlides(slideIndex += n);
  }

  function currentSlide(n) {
    showSlides(slideIndex = n);
  }

  function showSlides(n) {
    let i;
    let slides = document.getElementsByClassName("store_slides");
    let dots = document.getElementsByClassName("dot");
    if (n > slides.length) { slideIndex = 1; }
    if (n < 1) { slideIndex = slides.length; }
    for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";
    }
    for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
    }
    slides[slideIndex-1].style.display = "block";
    dots[slideIndex-1].className += " active";
  }
</script>

<script>
//Script for product change

    let currentSection = 1;
    const sections = document.querySelectorAll('section');

    function changeSection(n) {
        showSection(currentSection += n);
    }

    function showSection(n) {
        if (n > sections.length) {
            currentSection = 1;
        }
        if (n < 1) {
            currentSection = sections.length;
        }
        for (let i = 0; i < sections.length; i++) {
            sections[i].style.display = "none";
        }
        sections[currentSection - 1].style.display = "block";
    }

    // Show initial section
    showSection(currentSection);
</script>

<script>
//for buy now button

function buy() {
    window.location.href = "./pagitation_page.php";
}
</script>
<script>
// Function to calculate the next offer end date (6 months from the current time)
function getNextOfferEndDate() {
    // Get the current date and set the offer end to 6 months from now
    var now = new Date();
    now.setMonth(now.getMonth() + 6);  // Add 6 months
    return now.getTime();
}

// Function to update countdown timer for all products
function updateCountdown() {
    // Start with the first offer end date (6 months from now)
    var offerEndDate = getNextOfferEndDate();

    var x = setInterval(function() {
        var now = new Date().getTime();
        var distance = offerEndDate - now;
        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

        // Update countdown timer for all products
        var counters = document.querySelectorAll(".offer-countdown");
        counters.forEach(function(counter) {
            counter.innerHTML = "Offer Ends-in: " + days + "d " + hours + "h " + minutes + "m " + seconds + "s ";
        });

        // If the offer has expired, set the next countdown
        if (distance < 0) {
            clearInterval(x);
            counters.forEach(function(counter) {
                counter.innerHTML = "EXPIRED";
            });

            // After 6 months, reset to the next countdown
            setTimeout(function() {
                updateCountdown(); // Start the countdown for the next 6-month period
            }, 1000);
        }
    }, 1000); // Update every second
}

// Call updateCountdown to start countdown for all products
updateCountdown();
</script>





</body>
</html>