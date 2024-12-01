<?php
include('conn.php');

  $query="SELECT * from admin";
  $result = mysqli_query($conn, $query);

  if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {

  $new_username = mysqli_real_escape_string($conn, $_POST['new_username']);
  $new_password = mysqli_real_escape_string($conn, $_POST['new_password']);

   if (!empty($new_username) && !empty($new_password)) {
    
    $sql = "UPDATE admin SET username='$new_username', password='$new_password' WHERE id='1'";

    $stmt = mysqli_prepare($conn, $sql);
    
    if ($conn->query($sql) === TRUE) 
    {
     
      $_SESSION['error']="Record updated successfully!!";
          header("location: profile.php");
          exit();
    } 
    else
    { 
      $_SESSION['error']="Error! Please try again later";
      header("location: profile.php");
      exit();
    } 
  }
}

mysqli_close($conn);
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="./bags.png" type="image/x-icon">
    <title>Tiny Dashboard - A Bootstrap Dashboard Template</title>
    <!-- Simple bar CSS -->
    <link rel="stylesheet" href="css/simplebar.css">
    <!-- Fonts CSS -->
    <link href="https://fonts.googleapis.com/css2?family=Overpass:ital,wght@0,100;0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <!-- Icons CSS -->
    <link rel="stylesheet" href="css/feather.css">
    <!-- Date Range Picker CSS -->
    <link rel="stylesheet" href="css/daterangepicker.css">
    <!-- App CSS -->
    <link rel="stylesheet" href="css/app-light.css" id="lightTheme">
    <link rel="stylesheet" href="css/app-dark.css" id="darkTheme" disabled>
  </head>
  <body class="vertical  light  ">
    <div class="wrapper">
      <nav class="topnav navbar navbar-light">
        <button type="button" class="navbar-toggler text-muted mt-2 p-0 mr-3 collapseSidebar">
          <i class="fe fe-menu navbar-toggler-icon"></i>
        </button>
        
            <a class="nav-link dropdown-toggle text-muted pr-0" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <span class="avatar avatar-sm mt-2">
                <img src="./assets/avatars/face-1.jpg" alt="..." class="avatar-img rounded-circle">
              </span>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
              <a class="dropdown-item" href="profile.php  ">Profile</a>
              <a class="dropdown-item" href="logout.php">Logout</a>
            </div>
          </li>
        </ul>
      </nav>
      <aside class="sidebar-left border-right bg-white shadow" id="leftSidebar" data-simplebar>
        <a href="#" class="btn collapseSidebar toggle-btn d-lg-none text-muted ml-2 mt-3" data-toggle="toggle">
          <i class="fe fe-x"><span class="sr-only"></span></i>
        </a>
        <nav class="vertnav navbar navbar-light">
          <!-- nav bar -->
          <div class="w-100 mb-4 d-flex">
            <a class="navbar-brand mx-auto mt-2 flex-fill text-center" href="dashboard.php">
          <img class="navbar-brand-img brand-sm" style="width: 65px; height:65px;" src="./bags.png" alt="">
              </a>
              <h5 style="position:relative; top:40px; ">Voyageur Bags</h5>
</div>
    <!--FOR Dashboard-->
    <ul class="navbar-nav flex-fill w-100 mb-2">
            <li class="nav-item dropdown">
              <a href="#dashboard" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                <i class="fe fe-home fe-16"></i>
                <span class="ml-3 item-text">Dashboard</span><span class="sr-only">(current)</span>
              </a>
              <ul class="collapse list-unstyled pl-4 w-100" id="dashboard">
                <li class="nav-item active">
                  <a class="nav-link pl-3" href="./dashboard.php"><span class="ml-1 item-text">Home</span></a>
                </li>
              
              </ul>
            </li>
        

<!-- FOR CATEGORIES -->

<li class="nav-item dropdown">
              <a href="#charts" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
              <i class="fe fe-grid fe-16"></i>
                <span class="ml-3 item-text">Category</span>
              </a>
              <ul class="collapse list-unstyled pl-4 w-100" id="charts">
                <li class="nav-item">
                  <a class="nav-link pl-3" href="./category_add.php"><span class="ml-1 item-text">Add</span></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link pl-3" href="./category_list.php"><span class="ml-1 item-text">list</span></a>
              </ul>
            </li>

<!-- FOR items -->
      
<li class="nav-item dropdown">
              <a href="#forms" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
              <i class="fe fe-layers fe-16"></i>
                <span class="ml-3 item-text">Items</span>
              </a>
              <ul class="collapse list-unstyled pl-4 w-100" id="forms">
                <li class="nav-item">
                  <a class="nav-link pl-3" href="./items_add.php"><span class="ml-1 item-text">Add</span></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link pl-3" href="./items_list.php"><span class="ml-1 item-text">List</span></a>
                </li>
                </ul>
                
          
<!-- FOR ORDERS -->

<li class="nav-item dropdown">
              <a href="#layouts" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
              <i class="fe fe-16 fe-shopping-bag"></i>
                <span class="ml-3 item-text">Orders</span>
              </a>
              <ul class="collapse list-unstyled pl-4 w-100" id="layouts">
                <li class="nav-item">
                  <a class="nav-link pl-3" href="./order_list.php"><span class="ml-1 item-text">Order Lsit</span></a>
                </li>
              </ul>
            </li>

                <!-- FOR team -->
<li class="nav-item dropdown">
              <a href="#contact" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
              <i class="fe fe-user fe-16"></i>
                <span class="ml-3 item-text">Team</span>
              </a>
              <ul class="collapse list-unstyled pl-4 w-100" id="contact">
              <a class="nav-link pl-3" href="./member_add.php"><span class="ml-1">Add Members</span></a>
                <a class="nav-link pl-3" href="./members_list.php"><span class="ml-1">Members List</span></a>
              </ul>
            </li>

            
<!-- FOR STORES -->
            <li class="nav-item dropdown">
              <a href="#support" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                <i class="fe fe-map-pin fe-16"></i>
                <span class="ml-3 item-text">Location</span>
              </a>
              <ul class="collapse list-unstyled pl-4 w-100" id="support">
                <a class="nav-link pl-3" href="./stores_add.php"><span class="ml-1">Add Stores</span></a>
                <a class="nav-link pl-3" href="./stores_list.php"><span class="ml-1">Store list</span></a>
              </ul>
            </li>

            
<!-- FOR MARKETING -->

<li class="nav-item dropdown">
              <a href="#fileman" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
              <i class="fe fe-credit-card fe-16"></i>
                <span class="ml-3 item-text">Marketing</span>
              </a>
              <ul class="collapse list-unstyled pl-4 w-100" id="fileman">
                <a class="nav-link pl-3" href="./tagline_add.php"><span class="ml-1">Add Tagline</span></a>
                <a class="nav-link pl-3" href="./tagline.php"><span class="ml-1">Tagline</span></a>
              </ul>
            </li>


            <!-- FOR USERS LIST -->
            <li class="nav-item dropdown">
              <a href="#auth" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                <i class="fe fe-users fe-16"></i>
                <span class="ml-3 item-text">Users</span>
              </a>
              <ul class="collapse list-unstyled pl-4 w-100" id="auth">
                <a class="nav-link pl-3" href="./users_list.php"><span class="ml-1">Users List</span></a>
              </ul>
            </li>


            
<!-- FOR Helpdesk -->

<li class="nav-item dropdown">
              <a href="#tables" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
              <i class="fe fe-help-circle fe-16"></i>
                <span class="ml-3 item-text">Help Desk</span>
              </a>
              <ul class="collapse list-unstyled pl-4 w-100" id="tables">
                <li class="nav-item">
                  <a class="nav-link pl-3" href="./customer_queries.php"><span class="ml-1 item-text">Customer Queries</span></a>
                </li>
              </ul>
            </li>


                </div>
        </nav>
      </aside>


      <main role="main" class="main-content">
        <div class="container-fluid">
          <div class="row justify-content-center">
            <div class="col-12 col-lg-10 col-xl-8">
              <h2 class="h3 mb-4 page-title">Profile</h2>
                <form method="POST" action=""> 
                  <hr class="my-4">
                  <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" name="new_username"
                    value="<?php 
                  while ($row = mysqli_fetch_assoc($result)) {
                  echo $row['username'];
                  } ?>" 
                    id="username" placeholder="Enter Username">
                  </div>       
                  <hr class="my-4">
                  <div class="row mb-4">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="inputPassword5">New Password</label>
                        <input type="password" class="form-control" id="inputPassword5">
                      </div>
                      <div class="form-group">
                        <label for="inputPassword6">Confirm Password</label>
                        <input type="password" name="new_password" class="form-control" id="inputPassword6">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <p class="mb-2">Password requirements</p>
                      <p class="small text-muted mb-2"> To create a new password, you have to meet all of the following requirements: </p>
                      <ul class="small text-muted pl-4 mb-0">
                        <li> Minimum 8 character </li>
                        <li>At least one special character</li>
                        <li>At least one number</li>
                        <li>Can’t be the same as a previous password </li>
                      </ul>
                    </div>
                  </div>
                  <button type="submit" value="Update" class="btn btn-primary">Save Change</button>
                  
                  
                  <?php if (isset($_SESSION['error'])) { ?>
            <h3 style="font-size: large;color: red;">
              <?php 
              echo "<br>";
              echo $_SESSION['error'];?>
            </h3>
          <?php } ?>
                </form>
        
    </div> <!-- .wrapper -->
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/moment.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/simplebar.min.js"></script>
    <script src='js/daterangepicker.js'></script>
    <script src='js/jquery.stickOnScroll.js'></script>
    <script src="js/tinycolor-min.js"></script>
    <script src="js/config.js"></script>
    <script src="js/apps.js"></script>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-56159088-1"></script>
    <script>
      window.dataLayer = window.dataLayer || [];

      function gtag()
      {
        dataLayer.push(arguments);
      }
      gtag('js', new Date());
      gtag('config', 'UA-56159088-1');
    </script>
    <?php
session_destroy()
?>  
  </body>
</html>