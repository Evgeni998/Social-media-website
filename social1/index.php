<?php 
    require "header.php";
    
?>
<main>
    <?php
     
    if(isset($_SESSION['userId'])) { 
       
        header("Location: ../social1/main-page.php");
       
    }else {
        echo '
        <form action="includes/logout.inc.php" method = "post">
          <button  type = "submit" name = "logout-submit">Logout</button>
        </form>';   
    }
    ?>
<body>
   
   
</body>
</main>