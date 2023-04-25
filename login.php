<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="shortcut icon" sizes="any" href="assets/img/icon4.png" type="image/x-icon">
    <title>Admin Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="assets/css/login.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
  </head>
    <?php
    session_start();

    require "config/config.php";
    require "config/db.php";
    
    if(isset($_POST['loggedin'])) {
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $pass = mysqli_real_escape_string($conn, $_POST['password']);
        
        $select = "SELECT * FROM account WHERE (admin_username = '$email' or admin_email = '$email') and admin_password = '$pass'";
        $result = mysqli_query($conn, $select);
        
        if(mysqli_num_rows($result) > 0) {
            $_SESSION['loggedin'] = true;
            header('location: home.php');
        } else {
            $error[] = 'Incorrect password or email';
        }
    }
    
    ?>
  <body>
    <div class="container">
      <div class="con-head">
        <div class="header"><span>Admin</span></div>
        <form method="POST" action="<?php $_SERVER['PHP_SELF'];?>">
          <div class="logo">
           <img src="assets/img/avat.png" alt="logo" width="70" height="70">
          </div>
          <?php
            if(isset($error)){
                foreach($error as $error){
                    echo '<span class = "error-mess">'.$error.'</span>';
                };
            };
            ?>
          <div class="box">
            <i class="fas fa-user"></i>
            <input type="text" name="email" placeholder="Email or Username" required>
          </div>
          <div class="box">
            <i class="fas fa-lock"></i>
            <input type="password" name="password" placeholder="Password"  required>
          </div>
          <div class="box button">
            <input type="submit" name="loggedin" value="Login">
          </div>
        </form>
      </div>
    </div>

  </body>
</html>