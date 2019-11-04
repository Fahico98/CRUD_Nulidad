
<?php

   include("php/createDatabase.php");
   createDatabase();
   session_start();
   if(isset($_SESSION["userName"]) && isset($_SESSION["userRole"])){
      header("Location:php/loginRedirect.php");
   }

?>

<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="bootstrap_4.3.1/css/bootstrap.css"/>
      <link rel="stylesheet" href="fontawesome_5.11.2/css/all.css"/>
      <link rel="stylesheet" href="css/mainStyleSheet.css"/>
      <title>CRUD Nulidad</title>
   </head>
   <body>
      <div class="container my-5">
         <div class="row d-flex justify-content-center my-5">
            <h2 id="mainTittle" class="mt-5 mb-3 text-wine">Sistema de Registro de Sentencias de Nulidad</h2>
         </div>

         <div id="mainContainer" class="row d-flex justify-content-center mt-5">

            <!-- Modal Register Form Window -->
            <div class="modal fade border-dark" id="modalRegForm" tabindex="-1" role="dialog" aria-labelledby="modalRegFormTitle"
               aria-hidden="true">
               <div class="modal-dialog" role="document">
                  <div class="modal-content">
                     <div class="modal-header bg-wine">
                        <h5 class="modal-title text-my-orange" id="modalRegFormTitle">Registrar nuevo usuario</h5>
                        <button type="button" class="close closeRegister" data-dismiss="modal" aria-label="Close">
                           <span aria-hidden="true">&times;</span>
                        </button>
                     </div>
                     <form id="registerForm" method="POST" action="#" autocomplete="off">
                        <div class="modal-body">
                           <div class="form-group input-group-sm">
                              <label for="registerName" class="text-wine">Nombre</label>
                              <input type="text" class="form-control" name="registerName" id="registerName" aria-describedby="registerNameHelp"
                                 placeholder="nombre">
                              <small id="registerNameHelp" class="helpText mb-0 pb-0 text-muted">
                                 Este campo solo debe contener caracteres alfabéticos.
                              </small>
                           </div>
                           <div class="form-group input-group-sm">
                              <label for="registerSala" class="text-wine">Sala</label>
                              <input type="text" class="form-control" name="registerSala" id="registerSala" aria-describedby="registerSalaHelp"
                                 placeholder="sala">
                              <small id="registerSalaHelp" class="helpText mb-0 pb-0 text-muted">
                                 Este campo solo debe contener caracteres alfanuméricos.
                              </small>
                           </div>
                           <div class="form-group input-group-sm">
                              <label for="registerUserName" class="text-wine">Nombre de usuario</label>
                              <input type="text" class="form-control" name="registerUserName" id="registerUserName"
                                 aria-describedby="registerUserNameHelp" placeholder="usuario">
                              <small id="registerUserNameHelp" class="helpText mb-0 pb-0 text-danger"></small>
                           </div>
                           <div class="form-group input-group-sm">
                              <label for="registerPassword" class="text-wine">Contraseña</label>
                              <input type="password" class="form-control" name="registerPassword" id="registerPassword"
                                 aria-describedby="registerPasswordHelp" placeholder="contraseña">
                              <small id="registerPasswordHelp" class="helpText mb-0 pb-0 text-danger"></small>
                           </div>
                           <div class="form-group input-group-sm">
                              <label for="registerPasswordConf" class="text-wine">Confirmación de contraseña</label>
                              <input type="password" class="form-control" name="registerPasswordConf" id="registerPasswordConf"
                                 aria-describedby="registerPasswordConfHelp" placeholder="confirmación de contraseña">
                              <small id="registerPasswordConfHelp" class="helpText mb-0 pb-0 text-danger"></small>
                           </div>
                        </div>
                        <div class="modal-footer my-0 py-3 pb-0">
                           <button type="button" class="btn btn-outline-wine text-my-orange font-weight-semi-bold closeRegister" data-dismiss="modal">
                              Cancelar
                           </button>
                           <button type="submit" class="btn btn-wine text-my-orange font-weight-semi-bold" id="submitButton">
                              Registrar
                           </button>
                        </div>
                     </form>
                  </div>
               </div>
            </div>

            <!-- Modal Register Successfully Window -->
            <div class="modal fade border-dark" id="modalRegSuccess" tabindex="-1" role="dialog" aria-labelledby="modalRegSuccessTitle"
               aria-hidden="true">
               <div class="modal-dialog" role="document">
                  <div class="modal-content">
                     <div class="modal-header bg-wine">
                        <h5 class="modal-title text-my-orange" id="modalRegSuccessTitle">Registrar nuevo usuario</h5>
                        <button type="button" class="close closeSuccess" data-dismiss="modal" aria-label="Close">
                           <span aria-hidden="true">&times;</span>
                        </button>
                     </div>
                     <div class="container">
                        <div class="form-group input-group-sm">
                           <label class="text-wine mt-3">
                              Usuario registrado con exito...
                           </label>
                        </div>
                     </div>
                     <div class="modal-footer my-0 py-3 pb-0">
                        <button type="button" class="btn btn-wine text-my-orange font-weight-semi-bold closeSuccess" data-dismiss="modal">
                           Aceptar
                        </button>
                     </div>
                  </div>
               </div>
            </div>

            <div class="card" id="loginCard">
               <h5 class="card-header bg-wine text-my-orange">Iniciar Sesión</h5>
               <div class="card-body">
                  <form id="loginForm" method="POST" action="php/loginRedirect.php">
                     <div class="row form-group mx-1">
                        <label class="text-wine" for="userName">Nombre de usuario</label>
                        <input type="text" class="form-control form-control-wine" id="userName" name="userName" placeholder="usuario">
                     </div>
                     <div class="row form-group mx-1">
                        <label class="text-wine" for="password">Contraseña</label>
                        <input type="password" class="form-control form-control-wine" id="password" name="password" placeholder="contraseña">
                     </div>

                     <!--
                     <div class="row form-group mx-1">
                        <div class="custom-control custom-checkbox mt-1">
                           <input type="checkbox" class="custom-control-input" id="autoridad">
                           <label class="custom-control-label text-wine" for="autoridad">Ingresar como autoridad o dependencia.</label>
                        </div>
                     </div>
                     -->

                     <!--
                     <div class="row form-group mx-1">
                        <p class="text-wine text-md my-0">Si no tiene una cuenta puede <a class="text-my-orange" href="#" data-toggle="modal"
                           data-target="#modalRegForm">registrarse</a> o puede ingresar como autoridad en modo 
                           <a class="text-my-orange" href="#">solo lectura</a>.
                        </p>
                     </div>
                     -->

                     <div class="row form-group mx-1 my-0">
                        <button type="submit" class="btn btn-wine text-my-orange font-weight-semi-bold">Enviar</button>
                        <button type="button" id="successRegisterButton" data-toggle="modal" data-target="#modalRegSuccess" hidden>
                           exito
                        </button>
                     </div>

                     <div id="adviceContainer" class="row form-group mx-1 mt-3 mb-0" hidden>
                        <small class="text-danger" id="advice">...</small>
                     </div>

                  </form>
               </div>
            </div>
         </div>
      </div>
      <script src="bootstrap_4.3.1/js/jquery.js"></script>
      <script src="bootstrap_4.3.1/js/popper.js"></script>
      <script src="bootstrap_4.3.1/js/bootstrap.js"></script>
      <script src="js/loginScript.js"></script>
   </body>
</html>
