
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
   $query =
      ($parameter === "")?
      "SELECT * FROM registro_sentencias_nulidad ORDER BY id DESC LIMIT " . ($currentPage - 1) * $perPage . ",$perPage":
      "SELECT * FROM registro_sentencias_nulidad WHERE $parameter LIKE '%$scapedParameterValue%' ORDER BY id DESC LIMIT " .
         ($currentPage - 1) * $perPage . ", $perPage";
   
   $result = $pdo->query($query);
   if($result->rowCount() !== 0){
      foreach($result as $row){
         $output .= 
            "<tr class='text-center'>
               <th scope='row' class='idCell'>" . str_pad($row["id"], 4, "0", STR_PAD_LEFT) . "</th>
               <td>" . $row["expediente"] .        "</td>
               <td>" . $row["sentido"] .           "</td>
               <td>" . $row["nombre_autoridad"] .  "</td>
               <td>" . $row["fecha"] .             "</td>
               <td>" . $row["documento"] .         "</td>
               <td class='actionsCell'>
                  <i class='fas fa-trash-alt deleteIcon' id='" . $row["id"] . "' data-toggle='tooltip' data-placement='bottom'
                     title='Eliminar'></i>
                  <i class='fas fa-edit ml-1 editIcon' id='" . $row["id"] . "' data-toggle='modal' data-target='#modalWindow'
                     data-toggle='tooltip' data-placement='bottom' title='Editar'></i>
               </td>
            </tr>";
      }
   }
   $pdo = null;
   echo($output);
?>