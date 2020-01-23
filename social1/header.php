<?php
session_start();
include_once "includes/dbh.inc.php";
?>
<!DOCTYPE html>
  <head>
    <meta charset = "utf-8">
    <meta name= "description" content = "Example of meta description">
    <meta name = "viewpoint" content = "width-device-width, initial scale=1">
    <link rel="stylesheet"  href="css/header.css">
    <title></title>
  </head>
  <body>
      <header>
          <nav>
          <img src="img/logo.png" id ="logo1" alt="logo" href = "index.php"> 
              <div>
              <?php
              if(isset($_SESSION['userId'])) { 
                echo '
                    <form action="includes/logout.inc.php" method = "post">
                      <button  type = "submit" name = "logout-submit">Logout</button>
                    </form>';   
                }else {
                echo '
                 
                <div class = center>
                    <form action = "includes/login.inc.php" method = "post">
                      <div class = box>
                        <img class = box1 src="img/gorilla.png" id ="logo" alt="logo" href = "index.php">
                          <div class = input-container>
                            <input class = box1 type="text" name = "emailUsername" placeholder = "E-mail/Username...">
                            <input class = box1 type="password" name = "pwd" placeholder = "Password...">
                          </div>
                        <button id= login-button class = box1 type = "submit" name = "login-submit">Login</button>
                      <a id = signup-button class = box1 href = "signup.php">Signup</a>
                      </div>
                    </form>  
                </div>
                    
                    ';
                    
                }
              ?>
    	        
              </div>
          </nav>  
      </header>   
  </body>