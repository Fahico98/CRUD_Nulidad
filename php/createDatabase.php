
<?php

   include("connection.php");

   function createDatabase(){
      try{
         global $db_name;
         $pdo = connect();

         $query =
            "CREATE TABLE IF NOT EXISTS roles (
               id                      INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
               nombre                  VARCHAR(75) NOT NULL UNIQUE
            ) ENGINE = INNODB";
         $pdo->query($query);

         /*

         $query = "INSERT INTO roles (nombre) VALUES ('usuario')";
         $pdo->query($query);

         $query = "INSERT INTO roles (nombre) VALUES ('administrador')";
         $pdo->query($query);

         */

         $query =
            "CREATE TABLE IF NOT EXISTS usuarios (
               id                      INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
               usuario                 VARCHAR(75) NOT NULL UNIQUE,
               contraseña              VARCHAR(255) NOT NULL,
               nombre                  VARCHAR(75) NOT NULL,
               sala                    VARCHAR(75) NOT NULL,
               rol_id                  INT NOT NULL DEFAULT 1,
               FOREIGN KEY (rol_id) REFERENCES roles(id) ON UPDATE RESTRICT ON DELETE RESTRICT
            ) ENGINE = INNODB";
         $pdo->query($query);

         /*

         $query =
            "INSERT INTO usuarios (
               usuario,
               contraseña,
               nombre,
               sala,
               rol_id
            ) VALUES (
               'admin',
               '12345',
               'Administrador',
               'sala administrativa',
               2
            )";
         $pdo->query($query);

         */

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