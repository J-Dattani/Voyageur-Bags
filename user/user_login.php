<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include("conn.php");
include("./user_redirect.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $email = mysqli_real_escape_string($conn, $_POST['email']); 
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    if (!empty($email) && !empty($password) && !is_numeric($email)) {

        $query = "SELECT * FROM user WHERE email = '$email' LIMIT 1"; 
        $result = mysqli_query($conn, $query);

        if ($result) {
            if (mysqli_num_rows($result) > 0) {
                $user_data = mysqli_fetch_assoc($result);

                if ($user_data['password'] == $password) {
                    // Successful login
                        $_SESSION['status_code'] = "success";
                    $_SESSION['success'] = "You're Logged-in";
                
                    $_SESSION['valid'] = true;
                    $_SESSION['id'] = $user_data['id'];
                
                    
                } else {
                    // Incorrect password
                    $_SESSION['error'] = "Wrong email and password.";
                    header("location: ./user_login.php");
                    exit();
                }
                
            } else {
                // User not found
                $_SESSION['error'] = "User not found";
                header("location: ./user_login.php");
                exit();
            }
        } else {
            // Query failed
            $_SESSION['error'] = "Query failed";
            header("location: ./user_login.php");
            exit();
        }
    } else {
        // Invalid email or password format
        $_SESSION['error'] = "Please provide valid email and password";
        header("location: ./user_login.php");
        exit();
    }
    header("Location: ../bags.php"); // Redirect to refresh the page
    exit();
}
?>


<!DOCTYPE html>
<html lang="en" style="height: 70%;
    padding: 0;
    margin: 0;">

<head>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.11.1/dist/sweetalert2.css" rel="stylesheet">
  <link href="user_login.css" rel="stylesheet">

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.11.1/dist/sweetalert2.all.min.js"></script>
</head>
<body>
    
<div class="name">
    <img src="../img/bags.png" class="logo_icon">
        <a class="company_name">Voyageur Bags</a> 
    </div>

    <main>
        <div class="img">
            <img src="../img\login.png" alt="">
        </div>

    
        <div class="login">
            <h1><b>Login</b></h1>
            <form method="post" action="">
            <div class="main_login_form">
                <div class="for_form">
            <label class="label_email" for="email">Email</label><br><br>
            <input type="email" id="email"  name="email" placeholder="Email address" required="" autofocus="">
            <br><br><br><br>
            <label class="label_pass" for="inputPassword">Password</label><br><br>
            <input class="input_pass" type="password" name="password" id="inputPassword" placeholder="Password" required="">
            <br><br><br>

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

          <br>
          <p class="new_p">Don't Have an account ?</p> <a class="login" href="user_register.php"><u>Register</u></a>
          <button class="login-btn">Log-In</button>
          </div>
            </div>

            </form>
        </div>
        
    </main>  

  </body>


</html>