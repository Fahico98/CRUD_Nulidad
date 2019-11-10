
<?php

   session_start();

   if(isset($_SESSION["userRole"]) && isset($_SESSION["userName"])){
      if($_SESSION["userRole"] !== "administrador"){
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
            <h2 id="mainTittle" class="mt-5 mb-3 text-wine">Administración</h2>
         </div>

         <div id="mainContainer" class="row d-flex justify-content-center mt-5">

            <!-- Add Sentence Modal Window -->
            <div class="modal fade border-dark" id="addSentenceModalWindow" aria-labelledby="addSentenceModalWindowTitle" tabindex="-1"
               role="dialog" aria-hidden="true">
               <div class="modal-dialog" role="document">
                  <div class="modal-content">
                     <div class="modal-header bg-wine">
                        <h5 class="modal-title text-my-orange">Agregar nueva sentencia</h5>
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
                           <button type="button" class="btn btn-outline-wine text-my-orange font-weight-semi-bold" data-dismiss="modal">
                              Cancelar
                           </button>
                           <button type="submit" class="btn btn-wine text-my-orange font-weight-semi-bold">
                              Guardar
                           </button>
                        </div>
                     </form>
                  </div>
               </div>
            </div>

            <!-- Register User Modal Window -->
            <div class="modal fade border-dark" id="registerUserModalWindow" aria-labelledby="registerUserModalWindowTitle" tabindex="-2"
               role="dialog" aria-hidden="true">
               <div class="modal-dialog" role="document">
                  <div class="modal-content">
                     <div class="modal-header bg-wine">
                        <h5 class="modal-title text-my-orange">Registrar usuario</h5>
                        <button type="button" class="close closeRegisterUserForm" data-dismiss="modal" aria-label="Close">
                           <span aria-hidden="true">&times;</span>
                        </button>
                     </div>
                     <form id="registerUserForm" autocomplete="off">
                        <div class="modal-body">
                           <div class="form-group input-group-sm">
                              <label for="ame">Nombre</label>
                              <input type="text" class="form-control" name="name" id="name" aria-describedby="nameHelp" placeholder="nombre">
                              <small id="nameHelp" class="helpText text-danger mb-0 pb-0"></small>
                           </div>
                           <div class="form-group input-group-sm">
                              <label for="room">Sala</label>
                              <input type="text" class="form-control" name="room" id="room" aria-describedby="roomHelp" placeholder="sala">
                              <small id="roomHelp" class="helpText text-danger mb-0 pb-0"></small>
                           </div>
                           <div class="form-group input-group-sm">
                              <label for="userName">Nombre de usuario</label>
                              <input type="text" class="form-control" name="userName" id="userName" aria-describedby="userNameHelp"
                                 placeholder="usuario">
                              <small id="userNameHelp" class="helpText text-danger mb-0 pb-0"></small>
                           </div>
                           <div class="form-group input-group-sm">
                              <label for="password">Contraseña</label>
                              <input type="password" class="form-control" name="password" id="password" aria-describedby="passwordHelp"
                                 placeholder="contraseña">
                              <small id="passwordHelp" class="helpText text-danger mb-0 pb-0"></small>
                           </div>
                           <div class="form-group input-group-sm">
                              <label for="confPassword">Confirmación de contraseña</label>
                              <input type="password" class="form-control" name="confPassword" id="confPassword" aria-describedby="confPasswordHelp"
                                 placeholder="confirmación">
                              <small id="confPasswordHelp" class="helpText text-danger mb-0 pb-0"></small>
                           </div>
                        </div>
                        <div class="modal-footer my-0 py-3 pb-0">
                           <button type="button" class="btn btn-outline-wine text-my-orange font-weight-semi-bold" data-dismiss="modal">
                              Cancelar
                           </button>
                           <button type="submit" class="btn btn-wine text-my-orange font-weight-semi-bold">
                              Registrar
                           </button>
                        </div>
                     </form>
                  </div>
               </div>
            </div>

            <!-- Authority Register Modal Window -->
            <div class="modal fade border-dark" id="registerAuthorityModalWindow" aria-labelledby="registerAuthorityModalWindowTitle"
               tabindex="-3"
               role="dialog" aria-hidden="true">
               <div class="modal-dialog" role="document">
                  <div class="modal-content">
                     <div class="modal-header bg-wine">
                        <h5 class="modal-title text-my-orange">Registrar autoridad</h5>
                        <button type="button" class="close closeAuthorityRegisterForm" data-dismiss="modal" aria-label="Close">
                           <span aria-hidden="true">&times;</span>
                        </button>
                     </div>
                     <form id="authorityRegisterForm" autocomplete="off">
                        <div class="modal-body">
                           <div class="form-group input-group-sm">
                              <label for="authorityName">Nombre de la autoridad</label>
                              <input type="text" class="form-control" name="authorityName" id="authorityName"
                                 aria-describedby="authorityNameHelp" placeholder="autoridad">
                              <small id="authorityNameHelp" class="helpText text-danger mb-0 pb-0"></small>
                           </div>
                           <div class="form-group input-group-sm">
                              <label for="supAuthorityName">Autoridad superior</label>
                              <input type="text" class="form-control" name="supAuthorityName" id="supAuthorityName"
                                 aria-describedby="supAuthorityNameHelp" placeholder="autoridad superior">
                              <small id="supAuthorityNameHelp" class="helpText text-danger mb-0 pb-0"></small>
                           </div>
                           <div class="form-group input-group-sm">
                              <label for="authorityUserName">Nombre de usuario</label>
                              <input type="text" class="form-control" name="authorityUserName" id="authorityUserName"
                                 aria-describedby="authorityUserNameHelp" placeholder="usuario">
                              <small id="authorityUserNameHelp" class="helpText text-danger mb-0 pb-0"></small>
                           </div>
                           <div class="form-group input-group-sm">
                              <label for="authorityPass">Contraseña</label>
                              <input type="password" class="form-control" name="authorityPass" id="authorityPass"
                                 aria-describedby="authorityPassHelp" placeholder="contraseña">
                              <small id="authorityPassHelp" class="helpText text-danger mb-0 pb-0"></small>
                           </div>
                           <div class="form-group input-group-sm">
                              <label for="authorityConfPass">Confirmación de contraseña</label>
                              <input type="password" class="form-control" name="authorityConfPass" id="authorityConfPass"
                                 aria-describedby="authorityConfPassHelp" placeholder="confirmación">
                              <small id="authorityConfPassHelp" class="helpText text-danger mb-0 pb-0"></small>
                           </div>
                        </div>
                        <div class="modal-footer my-0 py-3 pb-0">
                           <button type="button" class="btn btn-outline-wine text-my-orange font-weight-semi-bold" data-dismiss="modal">
                              Cancelar
                           </button>
                           <button type="submit" class="btn btn-wine text-my-orange font-weight-semi-bold">
                              Registrar
                           </button>
                        </div>
                     </form>
                  </div>
               </div>
            </div>

            <div class="container">
               <div class="row d-flex justify-content-start mx-1 mb-3 mt-3">
                  <div class="form-group row mx-0 my-0">
                     <!-- Add Sentence Modal Window Trigger Button -->
                     <button type="button" id="addSentenceButton" class="btn btn-wine text-my-orange font-weight-semi-bold"
                        data-toggle="modal" data-target="#addSentenceModalWindow">
                        Agregar sentencia
                     </button>
                     <button type="button" id="registerUserButton" class="btn btn-wine text-my-orange font-weight-semi-bold ml-2"
                        data-toggle="modal" data-target="#registerUserModalWindow">
                        Registrar usuario
                     </button>
                     <button type="button" id="registerAutoridadButton" class="btn btn-wine text-my-orange font-weight-semi-bold ml-2"
                        data-toggle="modal" data-target="#registerAuthorityModalWindow">
                        Registrar autoridad
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

         </div>
      </div>
      <script src="../../bootstrap_4.3.1/js/jquery.js"></script>
      <script src="../../bootstrap_4.3.1/js/popper.js"></script>
      <script src="../../bootstrap_4.3.1/js/bootstrap.js"></script>
      <script src="../../js/crudTable.js"></script>
      <script src="../../js/crudAdministrador.js"></script>
      <!--
      <script src="js/crudAdministradorScript.js"></script>
      -->
   </body>
</html>

