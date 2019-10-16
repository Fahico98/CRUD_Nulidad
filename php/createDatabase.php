
<?php

include("connection.php");

function createDatabase(){
   try{
      global $db_name;
      $pdo = connect();
      $query =
         "CREATE TABLE IF NOT EXISTS usuarios (
            id                      INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
            usuario                 VARCHAR(75) NOT NULL UNIQUE,
            contraseña              VARCHAR(255) NOT NULL,
            nombre                  VARCHAR(75) NOT NULL,
            sala                    VARCHAR(75) NOT NULL
         )";
      $pdo->query($query);
      $query =
         "CREATE TABLE IF NOT EXISTS autoridades (
            id                      INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
            usuario                 VARCHAR(75) NOT NULL UNIQUE,
            contraseña              VARCHAR(255) NOT NULL,
            nombre                  VARCHAR(75) NOT NULL UNIQUE,
            autoriada_superior      VARCHAR(75) NOT NULL
         )";
      $pdo->query($query);
      $query =
         "CREATE TABLE IF NOT EXISTS catalogo_autoridad_emito_acto (
            id                      INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
            autoridad               VARCHAR(75) NOT NULL UNIQUE,
            autoridad_superior      VARCHAR(75) NOT NULL
         )";
      $pdo->query($query);
      $query =
         "CREATE TABLE IF NOT EXISTS registro_sentencias_nulidad (
            id                      INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
            expediente              TEXT NOT NULL,
            id_autoridad            INT NOT NULL,
            nombre_autoridad        VARCHAR(75) NOT NULL,
            sentido                 TEXT,
            fecha                   DATE,
            documento               VARCHAR(255)
         )";
      $pdo->query($query);
      $pdo = null;
   }catch(Exception $e){
      die("ERROR: " . $e->getMessage());
   }
}

?>