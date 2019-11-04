
<?php

   session_start();

   if(isset($_SESSION["userName"]) && isset($_SESSION["userRole"])){
      $userName = $_SESSION["userName"];
      $userRole = $_SESSION["userRole"];
      if($userRole === "usuario"){
         header("Location:html/crudUsuarios.php");
      }else if($userRole === "autoridad"){
         header("Location:html/crudAutoridades.php");
      }else if($userRole === "administrador"){
         header("Location:html/crudAdministrador.php");
      }
   }else{
      header("Location:../index.php");
   }

?>