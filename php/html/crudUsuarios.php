
<?php

   session_start();

   if(isset($_SESSION["userRole"]) && isset($_SESSION["userName"])){
      if($_SESSION["userRole"] !== "usuario"){
         header("Location:../../index.php");
      }
   }else{
      header("Location:../../index.php");
   }

?>

<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="../../bootstrap_4.3.1/css/bootstrap.css"/>
      <link rel="stylesheet" href="../../fontawesome_5.11.2/css/all.css"/>
      <link rel="stylesheet" href="../../css/mainStyleSheet.css"/>
      <title>CRUD Nulidad</title>
   </head>
   <body>
      <div class="container my-5">
         <div class="row d-flex justify-content-center my-5">
            <h2 id="mainTittle" class="mt-5 mb-3 text-wine">Panel de Administración</h2>
         </div>

         <div id="mainContainer" class="row d-flex justify-content-center mt-5">

            <!-- Add Sentence Modal Window -->
            <div class="modal fade border-dark" id="addSentenceModalWindow" tabindex="-1" role="dialog" aria-labelledby="addSentenceModalWindowTitle"
               aria-hidden="true">
               <div class="modal-dialog" role="document">
                  <div class="modal-content">
                     <div class="modal-header bg-wine">
                        <h5 class="modal-title text-my-orange" id="modalWindowTitle">Agregar nuevo producto</h5>
                        <button type="button" class="close closeNewSenteceForm" data-dismiss="modal" aria-label="Close">
                           <span aria-hidden="true">&times;</span>
                        </button>
                     </div>
                     <form id="newSentenceForm" autocomplete="off">
                        <div class="modal-body">
                           <div class="form-group input-group-sm">
                              <label for="expediente">Expediente</label>
                              <input type="text" class="form-control" name="expediente" id="expediente" aria-describedby="expedienteHelp"
                                 placeholder="expediente">
                              <small id="expedienteHelp" class="helpText text-danger mb-0 pb-0"></small>
                           </div>
                           <div class="form-group input-group-sm">
                              <label for="autoridadEmisora">Autoridad emisora</label>
                              <input type="text" class="form-control" name="autoridadEmisora" id="autoridadEmisora" aria-describedby="autoridadEmisoraHelp"
                                 placeholder="autoridad emisora">
                              <small id="autoridadEmisoraHelp" class="helpText text-danger mb-0 pb-0"></small>
                           </div>
                           <div class="form-group input-group-sm">
                              <label for="sentido">Sentido</label>
                              <input type="text" class="form-control" name="sentido" id="sentido" aria-describedby="sentidoHelp" placeholder="sentido">
                              <small id="sentidoHelp" class="helpText text-danger mb-0 pb-0"></small>
                           </div>
                           <div class="form-group input-group-sm">
                              <label for="fecha">Fecha</label>
                              <input type="date" class="form-control" name="date" id="date" aria-describedby="dateHelp">
                              <small id="dateHelp" class="helpText text-danger mb-0 pb-0"></small>
                           </div>
                           <div class="form-group input-group-sm">
                              <label for="documento">Documento</label>
                              <input type="text" class="form-control" name="documento" id="documento" aria-describedby="documentoHelp"
                                 placeholder="documento">
                              <small id="documentoHelp" class="helpText text-danger mb-0 pb-0"></small>
                           </div>
                        </div>
                        <div class="modal-footer my-0 py-3 pb-0">
                           <button type="button" class="btn btn-outline-wine text-my-orange font-weight-semi-bold closeNewSenteceForm" data-dismiss="modal">
                              Cancelar
                           </button>
                           <button type="submit" class="btn btn-wine text-my-orange font-weight-semi-bold" id="addSentenceSubmitButton">Guardar</button>
                        </div>
                     </form>
                  </div>
               </div>
            </div>

            <div class="container">
               <div class="row d-flex justify-content-start mx-1 mb-3 mt-3">
                  <div class="form-group row mx-0 my-0">
                     <!-- Add Sentence Modal Window Trigger Button -->
                     <button type="button" id="addSentenceButton" class="btn btn-wine text-my-orange font-weight-semi-bold" data-toggle="modal"
                        data-target="#addSentenceModalWindow">
                        Agregar sentencia
                     </button>
                     <div class="btn-group ml-2">
                        <button type="button" class="btn btn-wine text-my-orange font-weight-semi-bold dropdown-toggle" data-toggle="dropdown"
                           aria-haspopup="true" aria-expanded="false" id="searchCriteriaDropdown" style="width: 160px;">Número</button>
                        <div class="dropdown-menu" id="searchOptionsDropdown" name="searchOptionsDropdown">
                           <option class="dropdown-item searchOption">Número</option>
                           <option class="dropdown-item searchOption">Expediente</option>
                           <option class="dropdown-item searchOption">Autoridad emisora</option>
                           <option class="dropdown-item searchOption">Sentido</option>
                           <option class="dropdown-item searchOption">Fecha</option>
                           <option class="dropdown-item searchOption">Documento</option>
                        </div>
                     </div>
                     <div class="col ml-2 px-0 w-100">
                        <input type="number" class="form-control" placeholder="Número" id="searchInput" name="searchInput" style="width: 300px;">
                     </div>
                  </div>
               </div>
            </div>

            <table class="table">
               <thead class="bg-wine text-my-orange text-center align-middle">
                  <tr>
                     <th scope="col">Número</th>
                     <th scope="col">Expediente</th>
                     <th scope="col">Sentido</th>
                     <th scope="col">Autoridad emisora</th>
                     <th scope="col">Fecha</th>
                     <th scope="col">Documento</th>
                     <th scope="col" class="actionsCell"></th>
                  </tr>
               </thead>
               <tbody id="tableBody" name="tableBody"></tbody>
            </table>
            <div id="pagination" class="text-center mt-5"></div>

         </div>
      </div>
      <script src="../../bootstrap_4.3.1/js/jquery.js"></script>
      <script src="../../bootstrap_4.3.1/js/popper.js"></script>
      <script src="../../bootstrap_4.3.1/js/bootstrap.js"></script>
      <!--
      <script src="js/crudAdministradorScript.js"></script>
      -->
   </body>
</html>

