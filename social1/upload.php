
<?php
session_start();
include_once "includes/dbh.inc.php";
$id = $_SESSION['id'];
if(isset($_POST["submit-picture"])) {
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
                $sql = "INSERT INTO images(image, text) VALUES ('$fileName','$text')";
                mysqli_query($db, $sql);
                $fileNameNew = uniqid('', true).".".$fileActualExt;
                $fileDestination = 'uploads/'.$fileName;
                move_uploaded_file($fileTmpName, $fileDestination);
                //
                
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