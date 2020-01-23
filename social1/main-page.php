<?php 
session_start();

include_once 'includes/dbh.inc.php';
?>
<html>
<head>
    <meta charset = "utf-8">
    <meta name= "description" content = "Example of meta description">
    <meta name = "viewpoint" content = "width-device-width, initial scale=1">
<link rel="stylesheet"  href="css/main-page.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src = "js/toggle.js"></script>
</head>
<body>
    <nav class ="navbar">
        <ul class = "menu">
            <li class = "logo"><a><img src="img/logo.png" alt="logo" href = "test.php" style = "width:120px;"></a></li>
            <li class = "item"> <i class = "fa fa-home" style = "padding-right:5px;"></i><a href = "#">Home</a></li>
            <li class = "item"> <i class = "fa fa-user" style = "padding-right:5px;"></i><a href = "#">Profile</a></li>
            <li class = "item"> <i class = "fa fa-envelope" style = "padding-right:5px;"></i><a href = "includes/chat-room.php">Messages</a></li>
            <li class = "item"> <i class = "fa fa-globe" style = "padding-right:5px;"></i><a href = "#">Notification</a></li>
            <li class = "item"> <i class = "fa fa-search" style = "padding-right:5px;"></i><a href = "#">Search</a></li>
            <a class = "item" href = "includes/logout.inc.php" method = "POST">Logout</a>
            <li class="toggle"><span class="bars"></span></li>
        </ul>
    </nav>

    <div class = "column-layout" style = "top: 100px;">
        <div class = "base-column main-column">
            <div class ="choose-and-upload">
            <div class = mainpage-upload-file>
                <label for="mainpage-file-upload" class="custom-file-upload">
                Upload Image
                </label>
            </div>
            <form action="upload.php" method = "POST" enctype = "multipart/form-data">
            <input id = "mainpage-file-upload" type="file" name = "file">
           
            <button class = "upload-picture-button" type = "sumbit" name = "submit-picture">Upload</button>
            </form>
            
        </div>    
    <?php 
       $db = mysqli_connect("localhost", "root", "", "loginsystem");  
        $sql1 = "SELECT * FROM images ORDER BY img_id DESC";
        $result = mysqli_query($db, $sql1);
       
        while ($row = mysqli_fetch_array($result)) {
            $img = $row["image"];
            echo '<div id = "img-div">';
                echo " 
                <img id= 'myImg' class = 'img-upload' src = 'uploads/".$img."' > 
                ";
            echo '</div>';
        }
      ?>
        </div>
            <div id='myModal' class='modal'>
                <span class='close'>&times;</span>
                <img class='modal-content' id = "img01">           
                <div id='caption'></div>
            </div>
     
       <div class = "base-column left-column">
           <div class = "all-left-columns">
                <div class = "left-column-one">
                    <h4 ><?php echo $_SESSION['userUsername'];?></h4>
                        <div>
                        <?php
                        /* trying to make the image change depending on the user logged in*/ 
                        $sql = "SELECT * FROM users";
                        $result = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($result) > 0) {
                           $row = mysqli_fetch_assoc($result);
                                $id = $row["user_id"];
                                $sqlImg = "SELECT * FROM profileimg WHERE userid = '$id'";
                                $resultImg = mysqli_query($conn, $sqlImg);
                                    $rowImg = mysqli_fetch_assoc($resultImg);
                                    
                                    if ($id = $_SESSION['userId']) { 
                                    echo "<div>";
                                    if($rowImg['status'] == 0) {
                                        echo "
                                        <p class = 'profile-avatar'>
                                            <img class = 'profile-img' src = 'uploads/profile".$id.".jpg?'".mt_rand().">
                                        </p>
                                        ";      
                                    } else{   
                                    echo 
                                    '<p class = "profile-avatar">
                                         <img src="img/default-icon.jpg" alt="avatar" class = "profile-img"">
                                     </p>';
                                } 
                                                         
                                    echo "</div>";
                            }  /*testing purposes, the bracket is for the if ($id = $_SESSION['userId']) { statement above -- uncomment if you want to test it */
                              
                            
                        } else echo 'Rows are empty';
                        /*It ends here */
                        ?>
                        <div class = upload-file>
                            <label for="file-upload" class="custom-file-upload">
                                Change Profile Image
                            </label>
                        </div>
                            <form class = "upload-img-form" action="profile-img.php" method = "POST" enctype = "multipart/form-data">
                                <input id = "file-upload" type="file" name = "file">
                                  <div class = button-upload>
                                    <button class = "upload-button" type = "submit" name = "submit">Submit</button>
                                  </div>
                            </form>
                        </div>


                    <p>
                   <i class="fa fa-pencil fa-fw w3-margin-right w3-text-theme"> </i>
                        Guitar specialist
                    </p>
                    <p>
                    
                        <i class="fa fa-home fa-fw w3-margin-right w3-text-theme"></i>
                        Sofia, Bulgaria
                    </p>
                    <p>
                        <i class="fa fa-birthday-cake fa-fw w3-margin-right w3-text-theme"></i>
                        June 30, 1998
                    </p>
                </div>

                <div class = "left-column-two">
                    <button class = "btn1">
                        <i class="fa fa-circle-o-notch fa-fw w3-margin-right"style = "padding-right:8px;"></i>
                        Groups
                    </button>
                    <button class = "btn2">
                        <i class="fa fa-calendar-check-o fa-fw w3-margin-right" style = "padding-right:8px;"></i>
                        Events
                    </button>
                    <button class = "btn3">
                        <i class="fa fa-users fa-fw w3-margin-right"style = "padding-right:8px;"></i>
                        Photos
                    </button>
                </div>

                <div class = "left-column-three">
                   <h4>Interest</h4>
                    <p>
                        <li><a href="">News</a></li>
                        <li><a href="">Friends</a></li>
                        <li><a href="">Games</a></li>
                        <li><a href="">Blogs</a></li>
                        <li><a href="">Design</a></li>
                        <li><a href="">Sport</a></li>
                        
                    </p>
                </div>
           </div>
       </div>
      
       <div class = "base-column right-column">
            <div class = right-column-one>
                <div class = "right-column-one-one">
                    <h4>Schedule</h4>
                    <img src="img/calendar-1.png" style = "width:100%;" alt="">
                    <h4>Today's date</h4>
                    <p>04.12.2019</p>
                    <button>Calendar</button>
                    <p></p>
                </div>
            </div>    
            <div class = "right-column-two">    
                <div class = "right-column-two-two">
                    <h4>Friend Requests</h4>
                    <img src="img/angelam.jpg" alt="friend request" style = "width:100%">
                    <h4>Angela Martin</h4>
                      <div class = "check-and-remove">
                         <button class = "check">
                            <i class="fa fa-check"></i>
                         </button>
                         <button class = "remove">
                            <i class="fa fa-remove"></i>
                         </button>                         
                      </div>
                    
                    
                </div>
            </div>
            <div class = "right-column-three">    
                <div class = "right-column-three-three">
                   <div class = "ads">
                       <h4>ADS</h4>
                   </div>
                </div>
            </div>    
            </div>
       </div>
    </div>
<script src="js/ripple.js"></script>
<script src = "js/image.js"> </script>   
</body>
</html>