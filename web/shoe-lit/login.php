<?php

session_start();

if (is_array($_POST) && array_key_exists('username', $_POST) && array_key_exists('password', $_POST)) {
  require_once('database.php');

  // Load the database
  $db = new Database('postgres', 'Techtastic1206', 'shoelit');

  // Check to see if we're registering
  if (array_key_exists('register', $_POST)) {
    // Handle the optional field for an avatar
    $avatar = array_key_exists('avatar', $_POST) ? $_POST['avatar'] : null;
    
    if ( $db->registerUser($_POST['username'], $_POST['password'], $_POST['password2'], $avatar) ) {
      // Make sure these values are non-existant so that the page loads with the login screen, not the registration screen
      unset($_POST['register']);
      unset($_GET['register']);
      echo "Registration Successful<br/>";
    } else {
      echo "Registration Failed<br/>";
    }

  // Otherwise, try to login
  } else {
    $res = $db->fetch(
      "SELECT * FROM public.users WHERE user_name=:name",
      array("name" => $_POST['username'])
    );
  
    if (md5($_POST['password']) == $res['password']) {
      $_SESSION['user'] = $_POST['username'];
      header("Location: ./main.php");
      die();
    } else {
      echo "Login Fail";
    }
  }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Shoelit Login</title>
  <style>
    @import url(https://fonts.googleapis.com/css?family=Roboto:300);

    .login-page {
      width: 360px;
      padding: 8% 0 0;
      margin: auto;
    }

    .form {
      position : relative;
      z-index : 1;
      background : #FFFFFF;
      max-width : 360px;
      margin : 0 auto 100px;
      padding : 45px;
      text-align : center;
      box-shadow : 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
    }

    .form input {
      font-family: "Roboto", sans-serif;
      outline: 0;
      background: #f2f2f2;
      width: 100%;
      border: 0;
      margin: 0 0 15px;
      padding: 15px;
      box-sizing: border-box;
      font-size: 14px;
    }

    .form button {
      font-family: "Roboto", sans-serif;
      text-transform: uppercase;
      outline: 0;
      background: #4CAF50;
      width: 100%;
      border: 0;
      padding: 15px;
      color: #FFFFFF;
      font-size: 14px;
      -webkit-transition: all 0.3 ease;
      transition: all 0.3 ease;
      cursor: pointer;
    }

    .form button:hover,.form button:active,.form button:focus {
      background: #43A047;
    }

    .form .message {
      margin: 15px 0 0;
      color: #b3b3b3;
      font-size: 12px;
    }

    .form .message a {
      color: #4CAF50;
      text-decoration: none;
    }

    .form .register-form {
      display: none;
    }

    .container {
      position: relative;
      z-index: 1;
      max-width: 300px;
      margin: 0 auto;
    }

    .container:before, .container:after {
      content: "";
      display: block;
      clear: both;
    }

    .container .info {
      margin: 50px auto;
      text-align: center;
    }

    .container .info h1 {
      margin: 0 0 15px;
      padding: 0;
      font-size: 36px;
      font-weight: 300;
      color: #1a1a1a;
    }

    .container .info span {
      color: #4d4d4d;
      font-size: 12px;
    }

    .container .info span a {
      color: #000000;
      text-decoration: none;
    }

    .container .info span .fa {
      color: #EF3B3A;
    }

    body {
      /* background: #76b852;
      background: -webkit-linear-gradient(right, #76b852, #8DC26F);
      background: -moz-linear-gradient(right, #76b852, #8DC26F);
      background: -o-linear-gradient(right, #76b852, #8DC26F);
      background: linear-gradient(to left, #76b852, #8DC26F); */
      font-family: "Roboto", sans-serif;
      -webkit-font-smoothing: antialiased;
      -moz-osx-font-smoothing: grayscale;      
    }

  </style>
</head>
<body>
<div class="login-page">
  <?php if (array_key_exists('register', $_GET) || array_key_exists('register', $_POST)) { ?>
    <div class="form">
      <h1>Please Register</h1>
      <form class="login-form" method="POST" action="login.php">
        <input required="required" type="text" placeholder="username" name="username"/>
        <input required="required" type="password" placeholder="password" name="password"/>
        <input required="required" type="password" placeholder="repeat password" name="password2"/>
        <input type="text" placeholder="avatar url" name="avatar"/>
        <input type="hidden" name="register">
        <button type="submit">Register</button>
      </form>
    </div>
  <?php } else { ?>
    <div class="form">
      <h1>Please Login</h1>
      <form class="login-form" method="POST" action="login.php">
        <input required="required" type="text" placeholder="username" name="username"/>
        <input required="required" type="password" placeholder="password" name="password"/>
        <button type="submit">Login</button>
        <p class="message">Not registered? <a href="login.php?register=true">Create an account</a></p>
      </form>
    </div>
  <?php } ?>
</div>
</body>
</html>

