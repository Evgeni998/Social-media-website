<?php
session_start();
include_once "includes/dbh.inc.php";
$id = $_SESSION["userId"];

if(isset($_POST["submit"])) {
    $file = $_FILES['file']; 
    $fileName = $_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileError = $_FILES['file']['error'];
    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));
    
    $allowed = array('jpg', 'jpeg', 'png');

    if(in_array($fileActualExt, $allowed)) {
        if ($fileError === 0) {
            if($fileSize < 1000000) {
                $db = mysqli_connect("localhost", "root", "", "loginsystem");  
                if (!$db) {
                    die("Connection failed: ".mysqli_connect_error());
                }
               
                $fileNameNew = "profile".$id.".".$fileActualExt;
                $fileDestination = 'uploads/'.$fileNameNew;
                move_uploaded_file($fileTmpName, $fileDestination);
                $sql = "UPDATE profileimg SET status=0 WHERE userid= '$id';";
                $result = mysqli_query($conn, $sql);
                header("Location: main-page.php?uploadsuccess");

                
              
            } else {
                echo 'File is too big';
            }
            
        } else {
            echo 'There was an error uploading your file';
        }
    }else {
        header("Location: main-page.php?error=wrongtype");
    }

}
?>