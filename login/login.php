<?php
    require_once '../classes/database.php';
    $page_title = ' - Login';

    //we start session since we need to use session values
    session_start();
    //creating an array for list of users can login to the system
    $conn=mysqli_connect("localhost","root","","lionico");  
     $error="";  
    if (isset($_POST['login'])) {  
      //echo "<pre>";  
      //print_r($_POST);  
      $username=mysqli_real_escape_string($conn,$_POST['username']);  
      $password=mysqli_real_escape_string($conn,$_POST['password']);  
      $sql=mysqli_query($conn,"select * from useraccounts where username='$username' && password='$password'");  
      $num=mysqli_num_rows($sql);  
      if ($num>0) {  
            //echo "found";  
            $row=mysqli_fetch_assoc($sql);  
            $_SESSION['logged-in'] = $username;
            $_SESSION['fullname']=$row['firstname'] . ' ' . $row['lastname'];
            $_SESSION['user_type'] = $row['type'];
            //display the appropriate dashboard page for user
            if (($_SESSION['user_type']) == 'customer'){
                header('location: ../customer/home.html');
            }else if (($_SESSION['user_type']) == 'admin'){
                header('location: ../admin/dashboard.php');
            }else{
                header('location: login/login.php');
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>Login</title>
</head>
    <body>
        <div class="login-container">

            <form class="login-form" action="" method="POST">
                <div class="lion">
                    <img class="lion" src="../img/lion2.png" alt="lion-head">
                </div>
                <div class="logo-details">
                    <span class="logo-name">Lionico Barber Shop</span>
                </div>

                <hr class="line">

                <!--Username-->
                <label for="username">Username</label>
                <input type="text" name="username" id="username" placeholder="Enter Username" required>
                <br>
                <!--Password-->
                <label for="password">Password</label>
                <input type="password" name="password" id="password" placeholder="Enter Password" required>
                <br>
                <!--Submit Button-->

                <input class="btn" type="submit" value="Login" name="login" id="login">

                <a class="create" href="../create-account/create.php">Create an Account</a>
                <a class="forgot" href="../password/forgot.php">Forgot Password</a>


            </form>

        </div>
    </body>
</html>