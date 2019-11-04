
<?php

   include("connection.php");

   $userName = $_POST["userName"];
   $password = $_POST["password"];

   try{

      $result = userNameQuery("usuarios");
      $tableName = "usuarios";
      $output;

      if($result->rowCount() !== 0){
         $resultAssoc = $result->fetch(PDO::FETCH_ASSOC);
      }else{
         $result = userNameQuery("autoridades");
         if($result->rowCount() !== 0){
            $tableName = "autoridades";
            $resultAssoc = $result->fetch(PDO::FETCH_ASSOC);
         }else{
            $output = array("content" => "login_failed");
         }
      }

      if(validatePassword()){
         if($tableName === "usuarios"){
            $output = array("content" => "login_success");
            if($resultAssoc["rol_id"] === '1'){
               startSession("usuario");
            }else if($resultAssoc["rol_id"] === '2'){
               startSession("administrador");
            }
         }else if($tableName === "autoridades"){
            $output = array("content" => "login_success");
            startSession("autoridad");
         }
      }else{
         $output = array("content" => "login_failed");
      }

      echo json_encode($output);
      
   }catch(Exception $e){
      die("ERROR: " . $e->getMessage());
   }

   function startSession($userRole){
      global $userName;
      session_start();
      $_SESSION["userName"] = $userName;
      $_SESSION["userRole"] = $userRole;
   }

   function validatePassword(){
      global $resultAssoc;
      global $tableName;
      global $password;
      if($tableName === "usuarios"){
         return ($resultAssoc["rol_id"] === 1)?
            password_verify($password, $resultAssoc["contraseña"]):
            ($password === $resultAssoc["contraseña"]);
      }else if($tableName === "autoridades"){
         return password_verify($password, $resultAssoc["contraseña"]);
      }
   }

   function userNameQuery($tableName){
      global $userName;
      $pdo = connect();
      $query = "SELECT * FROM $tableName WHERE usuario = :usuario";
      $result = $pdo->prepare($query);
      $result->bindValue(":usuario", $userName);
      $result->execute();
      $pdo = null;
      return $result;
   }

?>