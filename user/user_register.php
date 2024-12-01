<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include("conn.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $name = $_POST['name'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (!empty($email) && !empty($password)) {

        $name = mysqli_real_escape_string($conn, $name);
        $gender = mysqli_real_escape_string($conn, $gender);
        $email = mysqli_real_escape_string($conn, $email);
        $password = mysqli_real_escape_string($conn, $password);

        $query = "INSERT INTO user (name, gender, email, password) VALUES (?, ?, ?, ?)";
        
        $stmt = mysqli_prepare($conn, $query);

        if ($stmt) {

            mysqli_stmt_bind_param($stmt, "ssss", $name, $gender, $email, $password);

            if (mysqli_stmt_execute($stmt)) {
              header("location: ./user_login.php");
              die;
            } else {
                $_SESSION['error']="Error! Please try again later";
            header("location: user_register.php");
            exit(); 
            }
            mysqli_stmt_close($stmt);
        } else {
          $_SESSION['error']="Error in preparing statement";
          header("location: user_register.php");
          exit(); 
        }
    } else {
      $_SESSION['error']="Please enter valid details";
      header("location: user_register.php");
      exit(); 
    }
}

?>


<!DOCTYPE html>
<html lang="en" style="height: 50%;
width: auto;
    padding: 0;
    margin: 0;">

<head>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="user_register.css" rel="stylesheet">
<link rel="stylesheet" href="user_register.css?v=<?php echo time(); ?>">
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

        <div class="register">
            <h1>Register</h1>
            <form action="" method="post">
                <div class="for_form">
                    
            <label class="label_email" for="email">Email</label><br><br>
            <input type="email" id="email"  name="email" placeholder="Enter Email address" required="" autofocus="">
            <br><br><br><br>

            <label for="name">Name</label><br><br>
            <input type="name" name="name" id="name" placeholder="Enter Name" required="">

            <div class="gender">
                <p>Gender</p><br><br>
                <label for="male">Male</label>
                <input class="male" type="radio"name="gender" id="male">&ensp;&ensp;
                <label for="female">Female</label>
                <input type="radio" id="female"  name="gender" id="female">
            </div>

            <label class="password" for="inputPassword">Password</label><br><br>
            <input type="password" name="password" id="inputPassword" placeholder="Password" required="">
            <br><br>
            <ul>
                Password requirements, you have to meet all Of the following requirements:
            <li>Minimum 8 character</li>
            <li>At least one special character</li>
            <li>At least one number</li>
            <li>Can't be the same as a previous password</li>
            </ul>       
            <br>         
            <?php if (isset($_SESSION['error'])) { ?>
            <h3 style="font-size: large;color: red;"> 
              <?php echo $_SESSION['error'];?>
            </h3>
          <?php } ?>
          <p class="already">Alreday Have an account ?</p> <a class="login" href="user_login.php"><u>Login</u></a>
            <button type="submit">Sign-up</button>
            </div>

            </form>
        </div>
    </main>
    
</body>
</html>