
<?php

   include("connection.php");
   
   $name = $_POST["registerName"];
   $sala = $_POST["registerSala"];
   $userName = $_POST["registerUserName"];
   $password = $_POST["registerPassword"];

   try{
      $pdo = connect();
      $query =
         "INSERT INTO usuarios (
            usuario,
            contraseña,
            nombre,
            sala
         ) VALUES (
            :usuario,
            :pass,
            :nombre,
            :sala
         )";
      $result = $pdo->prepare($query);
      $result->bindValue(":usuario", $userName);
      $result->bindValue(":pass", password_hash($password, PASSWORD_DEFAULT, array("cost" => 12)));
      $result->bindValue(":nombre", $name);
      $result->bindValue(":sala", $sala);
      $result->execute();
      $pdo = null;
      echo("success");
   }catch(Exception $e){
      die("ERROR: " . $e->getMessage());
   }

?>