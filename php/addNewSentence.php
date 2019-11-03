
<?php

   include("connection.php");

   $expediente = $_POST["expediente"];
   $autoridadEmisora = strtolower($_POST["autoridadEmisora"]);
   $idAutoridadEmisora = getAutoridad($autoridadEmisora);
   $sentido = $_POST["sentido"];
   $date = $_POST["date"];
   $documento = $_POST["documento"];
   $pdo = connect();
   $query = 
      "INSERT INTO registro_sentencias_nulidad (
         expediente,
         id_autoridad,
         nombre_autoridad,
         sentido,
         fecha,
         documento
      ) VALUES (
         :expediente,
         :id_autoridad,
         :nombre_autoridad,
         :sentido,
         :fecha,
         :documento
      )";
   $result = $pdo->prepare($query);
   $result->bindValue(":expediente", $expediente);
   $result->bindValue(":id_autoridad", $idAutoridadEmisora);
   $result->bindValue(":nombre_autoridad", $autoridadEmisora);
   $result->bindValue(":sentido", $sentido);
   $result->bindValue(":fecha", $date);
   $result->bindValue(":documento", $documento);
   $result->execute();
   $pdo = null;
   echo("success");

   function getAutoridad($nombreAutoridad){
      $pdo = connect();
      $query = "SELECT id FROM autoridades WHERE nombre = :nombre";
      $result = $pdo->prepare($query);
      $result->bindValue(":nombre", $nombreAutoridad);
      $result->execute();
      foreach($result as $autoridad){
         $idAutoridad = $autoridad["id"];
         break;
      }
      $pdo = null;
      return $idAutoridad;
   }

?>