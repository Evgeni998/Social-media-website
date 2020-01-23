<?php 
    
?>
<main>
    <h1>Signup</h1>
    <?php 
    if (isset($_GET['error'])) {
        if($_GET['error'] == "emptyfields") {
            echo '<p>Fill in all fields</p>';
        }
        else if($_GET['error'] == 'invalidEmailOrUsername') {
            echo '<p> Invalid email or username </p>';
        }
        else if($_GET['error'] == 'invalidEmail') {
            echo '<p> Invalid Email </p>';
        }
        else if($_GET['error'] == 'invalidUsername') {
            echo '<p> Invalid Username</p>';
        }
        else if($_GET['error'] == 'passwordCheck') {
            echo '<p>Unmatching passwords</p>';
        }
        else if($_GET['error'] == 'userTaken') {
            echo '<p>This username already exists</p>';
        }
       
    }  else if(isset($_GET['signup'])) {
        if($_GET['signup'] == 'success') {
            echo '<p>Signup successful</p>';
        }
    }   
    ?>
    <form action="includes/signup.inc.php" method = "post">
        <input type="text" name = "username" placeholder = "Username">
        <input type="text" name = "email" placeholder = "E-mail">
        <input type="password" name = "pwd" placeholder = "Password">
        <input type="password" name = "pwd-repeat" placeholder = "Repeat password">
        <button type = "submit" name = "signup-submit">Signup</button>
    </form>
</main>