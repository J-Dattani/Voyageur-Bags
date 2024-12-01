<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include("conn.php");
include("admin-redirect.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $username = mysqli_real_escape_string($conn, $_POST['username']); 

    $password = mysqli_real_escape_string($conn, $_POST['password']);

    if (!empty($username) && !empty($password) && !is_numeric($username)) {

      $query = "SELECT * FROM admin WHERE username = '$username' LIMIT 1"; 
      $result = mysqli_query($conn, $query);

      if($result){
        if(mysqli_num_rows($result) > 0){

          $user_data = mysqli_fetch_assoc($result);

          if($user_data['password'] == $password)
          {
            $_SESSION['valid'] = true;
            $_SESSION['timeout'] = time();
            $_SESSION['username'] = $_POST['username'];
            $_SESSION['status_code'] = "success";
            $_SESSION['success'] = "You're Logged-in Successfully";
            header("location: dashboard.php");
            die;

          } else {
            $_SESSION['error']="Wrong username and password.";
            $_SESSION['status_code'] = "success";
            header("location: auth-login.php");
            exit(); 
          }
        } else {
          $_SESSION['error']="Admin not found";
          $_SESSION['status_code'] = "success";
          header("location: auth-login.php");
          exit();
        }
      } else {
        $_SESSION['error']="Query failed";
        $_SESSION['status_code'] = "success";
        header("location: auth-login.php");
        exit();
      }
    } else {
      $_SESSION['error']="Please provide valid email and password";
      $_SESSION['status_code'] = "success";
      header("location: auth-login.php");
      exit();
    }
}
?>

<!doctype html>
<html lang="en">
  <head>
        
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.11.1/dist/sweetalert2.css" rel="stylesheet">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">  
    <link rel="icon" href="./bags.png" type="image/x-icon">
    <title>Voyageur Bags - Admin</title>
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
        
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.11.1/dist/sweetalert2.all.min.js"></script>
  </head>
  <body class="light ">
    <div class="wrapper vh-100">
      <div class="row align-items-center h-100">

        <form method="POST"  class="col-lg-3 col-md-4 col-10 mx-auto text-center">
        <a class="navbar-brand mx-auto mt-2 flex-fill text-center" href="dashboard.php">
          <img class="navbar-brand-img brand-sm" style="width: 65px; height:65px;" src="./bags.png" alt="">
              </a>
              <h4>Voyageur Bags</h4>
          <h1 class="h6 mb-3">Admin</h1>
          <div class="form-group">
            <label for="username" class="sr-only">Username</label>
            <input type="username" name="username" id="username" class="form-control form-control-lg" placeholder="Username" required="" autofocus="">
          </div>
          <div class="form-group">
            <label for="inputPassword" class="sr-only">Password</label>
            <input type="password"  name="password" id="inputPassword" class="form-control form-control-lg" placeholder="Password" required="">
          </div>
          <div class="checkbox mb-3">
            <br>
        

            <?php if (isset($_SESSION['error'])) { ?>         

<script>

Swal.fire({
text:'<?php echo $_SESSION['error'];?>',
button: 'submit',
});
</script>

<?php unset($_SESSION['error']);
} ?>

<?php
if (isset($_SESSION['success'])) { ?>

<script>
Swal.fire({
text:'<?php echo $_SESSION['success'];?>',
button: 'submit',
});
</script>


<?php 
unset($_SESSION['success']);

} ?>
          </div>
          <button class="btn btn-lg btn-primary btn-block" type="submit">Let me in</button>
          <p class="mt-5 mb-3 text-muted">© 2024</p>
        </form>
      </div>
    </div>
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
</body>
</html>