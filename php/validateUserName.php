
<?php

   include("connection.php");

   $userName = $_POST["userName"];

   try{
      $pdo = connect();
      $query = "SELECT * FROM usuarios WHERE (usuario = :usuario)";
      $result = $pdo->prepare($query);
      $result->bindValue(":usuario", $userName);
      $result->execute();
      $resultAssoc = $result->fetch(PDO::FETCH_ASSOC);
      $regCounting = $result->rowCount();
      echo $regCounting;
   }catch(Exception $e){
      die("ERROR: " . $e->getMessage());
   }
?>