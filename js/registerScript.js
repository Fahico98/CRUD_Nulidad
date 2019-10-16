
var registerForm = $("#registerForm");

var registerName = $("#registerName");
var registerSala = $("#registerSala");
var registerUserName = $("#registerUserName");
var registerPassword = $("#registerPassword");
var registerPasswordConf = $("#registerPasswordConf");

var registerNameHelp = $("#registerNameHelp");
var registerSalaHelp = $("#registerSalaHelp");
var registerUserNameHelp = $("#registerUserNameHelp");
var registerPasswordHelp = $("#registerPasswordHelp");
var registerPasswordConfHelp = $("#registerPasswordConfHelp");

var closeRegister = $(".closeRegister");

var inputs = [
   registerName,
   registerSala,
   registerUserName,
   registerPassword,
   registerPasswordConf
];

var helpers = [
   registerNameHelp,
   registerSalaHelp,
   registerUserNameHelp,
   registerPasswordHelp,
   registerPasswordConfHelp,
];

$(document).ready(function(){
   registerForm.on("submit", function(event){
      event.preventDefault();
      console.log("submit...!");
      if(validateRegisterForm()){
         console.log("-> " + validateRegisterForm());
         var registerFormData = new FormData(this);
         $.ajax({
            type: "POST",
            url: "php/register.php",
            data: registerFormData,
            contentType: false,
            cache: false,
            processData: false,
            success: function(response){
               console.log(response);
            }
         });
      }else{
         console.log("...!");
      }
   });
   closeRegister.on("click", function(event){
      event.preventDefault();
      reset();
   });
});

function reset(){
   helpers.forEach((helper) => {
      helper.text("");
   });
   inputs.forEach((input) => {
      input.val("");
   });
}

function userNameExists(){
   if(registerUserName.val() !== null || registerUserName.val() !== ""){
      $.ajax({
         type: "POST",
         url: "php/validateUserName.php",
         data: {userName: registerUserName.val()},
         cache: false,
         success: function(response){
            return (response !== "0") ? false : true;
         }
      });
   }
}

function validateRegisterForm(){
   var name = registerName.val();
   var sala = registerSala.val();
   var userName = registerUserName.val();
   var pass = registerPassword.val();
   var passConf = registerPasswordConf.val();
   var output = true;

   if(name === null || name === ""){
      registerNameHelp.removeClass("text-muted").addClass("text-danger");
      registerNameHelp.text("(*) Este campo es obligatorio.");
      output = false;
   }else if(!name.match(new RegExp("[A-Za-z]", "i"))){
      registerNameHelp.removeClass("text-muted").addClass("text-danger");
      registerNameHelp.text("(*) Este campo solo debe contener caracteres alfabéticos.");
      output = false;
   }else{
      registerNameHelp.removeClass("text-danger").addClass("text-muted");
      registerNameHelp.text("Este campo solo debe contener caracteres alfabéticos.");
   }

   if(sala === null || sala === ""){
      registerSalaHelp.removeClass("text-muted").addClass("text-danger");
      registerSalaHelp.text("(*) Este campo es obligatorio.");
      output = false;
   }else if(!sala.match(new RegExp("[A-Za-z0-9]", "i"))){
      registerSalaHelp.removeClass("text-muted").addClass("text-danger");
      registerSalaHelp.text("(*) Este campo solo debe contener caracteres alfanuméricos.");
      output = false;
   }else{
      registerSalaHelp.removeClass("text-danger").addClass("text-muted");
      registerSalaHelp.text("Este campo solo debe contener caracteres alfanuméricos.");
   }

   if(userName === null || userName === ""){
      registerUserNameHelp.text("(*) Este campo es obligatorio.");
      output = false;
   }else if(userNameExists()){
      registerUserNameHelp.text("(*) El nombre de usuario ingresado ya existe.");
      output = false;
   }else if(!userName.match(new RegExp("[A-Za-z0-9]{6,}", "i"))){
      registerUserNameHelp.text("(*) Su nombre de usuario debe contener por lo menos 6 caracteres. Solo caracteres alfanuméricos.");
      output = false;
   }else{
      registerUserNameHelp.text("");
   }

   if(pass === null || pass === ""){
      registerPasswordHelp.text("(*) Este campo es obligatorio.");
      output = false;
   }else if(!pass.match(new RegExp(".{6,}", "i"))){
      registerPasswordHelp.text("(*) La contraseña debe tener por lo menos 6 caracteres.");
      output = false;
   }else{
      registerPasswordHelp.text("");
   }

   if(passConf === null || passConf === ""){
      registerPasswordConfHelp.text("(*) Este campo es obligatorio.");
      output = false;
   }else if(passConf !== pass){
      registerPasswordConfHelp.text("(*) Las contraseñas no coinciden.");
      output = false;
   }else{
      registerPasswordConfHelp.text("");
   }

   return output;
}

