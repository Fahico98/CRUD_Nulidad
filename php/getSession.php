
<?php

   session_start();

   if(isset($_SESSION["userName"]) && isset($_SESSION["userRole"])){
      echo json_encode([
         "userName" => $_SESSION["userName"],
         "userRole" => $_SESSION["userRole"]
      ]);
   }else{
      echo json_encode([
         "userName" => "none",
         "userRole" => "none"
      ]);
   }
   
?>
