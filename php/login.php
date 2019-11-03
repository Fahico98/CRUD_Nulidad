
<?php

   include("connection.php");

   $userName = $_POST["userName"];
   $password = $_POST["password"];
   $tableName = $_POST["tableName"];

   try{
      $pdo = connect();
      $query = "SELECT * FROM $tableName WHERE usuario = :usuario";
      $result = $pdo->prepare($query);
      $result->bindValue(":usuario", $userName);
      $result->execute();
      $resultAssoc = $result->fetch(PDO::FETCH_ASSOC);
      $regCounting = $result->rowCount();
      $pdo = null;

      $passwordVerified =
         $tableName === "usuarios" ?
         password_verify($password, $resultAssoc["contraseña"]) :
         $password === $resultAssoc["contraseña"];

      if($regCounting != 0 && $passwordVerified){
         session_start();
         $_SESSION["userName"] = $userName;
         $_SESSION["userRole"] = $tableName;
         if($tableName === "usuarios"){
            $output = array("content" => file_get_contents("../html/crudUsuarios.html" ));
         }else{
            $output = array("content" => file_get_contents("../html/crudAutoridades.html"));
         }
      }else{
         $output = array("content" => "login_failed");
      }
      echo json_encode($output);
   }catch(Exception $e){
      die("ERROR: " . $e->getMessage());
   }

?>