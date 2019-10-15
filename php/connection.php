<?php

   $db_host = "localhost";
   $db_name = "crud_nulidad_database";
   $db_userName = "root";
   $db_password = "";
   $dns = "mysql:host=$db_host;charset=utf8";

   function connect(){
      try{
         global $db_name, $dns, $db_userName, $db_password;
         $pdo = new PDO($dns, $db_userName, $db_password);
         $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         $query = "CREATE DATABASE IF NOT EXISTS $db_name";
         $pdo->query($query);
         $query = "USE $db_name";
         $pdo->query($query);
      }catch(Exception $e){
         die("ERROR: " . $e->getMessage());
      }
      return $pdo;
   }

?>