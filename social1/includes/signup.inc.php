<?php
include_once "dbh.signup.inc.php";
if(isset($_POST['signup-submit'])) {

    require "dbh.inc.php";
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["pwd"];
    $passwordRepeat = $_POST["pwd-repeat"];

    if(empty($username) || empty($email) || empty($password) || empty($passwordRepeat)) {
        header("Location: ../signup.php?error=emptyfields&username=".$username."&email=".$email);
        exit();
    }
    else if(!filter_var($email. FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/".$username)) {
        header("Location: ../signup.php?error=invalidEmailOrUsername");
        exit();
    }
    else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../signup.php?error=invalidEmail&username=".$username);
        exit();
    }
    else if(!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        header("Location: ../signup.php?error=invalidUsername&email=".$email);  
        exit();
    }
    else if($password !== $passwordRepeat) {
        header("Location: ../signup.php?error=passwordCheck&username=".$username."&mail=".$email);
        exit();
    }
    else {
        $sql = "SELECT user_username FROM users WHERE user_username=?";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../signup.php?error=mysqlerror");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "s" , $username);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $resultCheck = mysqli_stmt_num_rows($stmt);
            if($resultCheck > 0) {
                header("Location: ../signup.php?error=userTaken&email=".$email);
                exit();
            } else {
                $sql = "INSERT INTO users (user_username, user_email, user_password) VALUES(?,?,?)";
                $stmt = mysqli_stmt_init($conn);
                if(!mysqli_stmt_prepare($stmt, $sql)) {
                    header("Location: ../signup.php?error=sqlerror");
                    exit();
                } else {
                    $hashedPwd = password_hash($password, PASSWORD_DEFAULT);
                    mysqli_stmt_bind_param($stmt, "sss", $username, $email, $hashedPwd );
                    mysqli_stmt_execute($stmt);
                    /*profile img info */
                    $sql = "SELECT * FROM users WHERE user_username = '$username'";
                    $result = mysqli_query($conn, $sql);
                    if(mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $userid = $row['user_id'];
                            $sql = "INSERT INTO profileimg(userid, status) VALUES ($userid, 1) ";
                            $result1 = mysqli_query($conn, $sql);
                         
                        }
                    }else {
                        echo 'you have an error';
                    }
                    /* it ends here */
                    header("Location: ../signup.php?signup=success");
                    exit();
                }
                
            }
        }
        
    }
mysqli_stmt_close($stmt);
mysqli_close($conn);

}
else {
    header("Location: ../signup.php");
    exit();
}   