
<?php

   include("connection.php");
   
   $currentPage = $_POST["page"];
   $parameter = $_POST["parameter"];
   $parameterValue = $_POST["parameterVal"];
   $scapedParameterValue = htmlentities(addslashes($parameterValue));
   $output = "";
   $perPage = 20;
   $pdo = connect();
   $query =
      ($parameter === "")?
      "SELECT * FROM registro_sentencias_nulidad ORDER BY id DESC":
      "SELECT * FROM registro_sentencias_nulidad WHERE $parameter LIKE '%$scapedParameterValue%' ORDER BY id DESC";
   $result = $pdo->query($query);
   $totalPages = ceil($result->rowCount() / $perPage);
   for($i = 1 ; $i <= $totalPages; $i++){
      $output .= 
         ($i == $currentPage)?
         "<button type='button' class='btn btn-wine text-my-orange btn-sm ml-1 pageButton' id='$i' disabled>$i</button>":
         "<button type='button' class='btn btn-wine text-my-orange btn-sm ml-1 pageButton' id='$i'>$i</button>";
   }
   $pdo = null;
   echo($output);

?>