<?php
if(isset($_POST["login-submit"])) {
    
    require "dbh.inc.php";

    $emailUsername = $_POST["emailUsername"];
    $password = $_POST["pwd"];

    if(empty($emailUsername) || empty($password)) { 
        header("Location: ../index.php?error=emptyfields");
        exit();
    }
    else {
        $sql = "SELECT * FROM users WHERE user_username=? OR user_email=?;";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../index.php?error=sqlerror");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "ss", $emailUsername, $emailUsername);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            if ($row = mysqli_fetch_assoc($result)) {
                $pwdCheck = password_verify($password, $row['user_password']);
                if($pwdCheck == false) {
                    header("Location: ../index.php?error=wrongpassword");
                    exit();
                } 
                else if($pwdCheck == true) {
                    session_start();
                    $_SESSION["userId"] = $row["user_id"];
                    $_SESSION["userUsername"] = $row["user_username"];
                    // Create session for the last person that logged in so that i can track who is offline and who is offline
                    $subQuery = "INSERT INTO login_details(user_id) VALUES ('".$row['user_id']."')";
                    if (mysqli_query($conn, $subQuery)) {
                        $_SESSION['login_details_id'] = mysqli_insert_id($conn);
                       
                    } else {
                        echo "Errorrr: " . $subQuery . "<br>" . mysqli_error($conn);
                    }
                    //test ends here
                    header("Location: ../index.php?login=success");
                    exit();
                }

            
            } else {
                header("Location: ../index.php?error=nouser");
                exit();
            }
        }
    }

} else {
    header("Location: ../index.php");
}
