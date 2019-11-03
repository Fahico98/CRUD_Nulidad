
<?php

   include("connection.php");

   $nombreAutoridad = $_POST["autoridadEmisora"];

   $pdo = connect();
   $query = "SELECT * FROM autoridades WHERE nombre = :nombre";
   $result = $pdo->prepare($query);
   $result->bindValue(":nombre", $nombreAutoridad);
   $result->execute();
   $output = ($result->rowCount() !== 0) ? "exists" : "not exists";
   $pdo = null;
   echo $output;

?>