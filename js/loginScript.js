
var username = $("#userName");
var password = $("#password");
var advice = $("#advice");
var adviceContainer = $("#adviceContainer");
var loginForm = $("#loginForm");
var mainContainer = $("#mainContainer");

$(document).ready(function(){
   loginForm.on("submit", function(event){
      event.preventDefault();
      if(loginFormValidation()){
         var loginData = new FormData(this);
         loginData.append("tableName", "usuarios");
         $.ajax({
            type: "POST",
            url: "php/login.php",
            data: loginData,
            dataType: "JSON",
            contentType: false,
            cache: false,
            processData: false,
            success: function(response){
               if(response.content === "login_failed"){
                  adviceContainer.attr("hidden", false);
                  advice.text("*** El nombre de usuario o la contraseña son incorrectos ***");
               }else{
                  adviceContainer.attr("hidden", true);
                  advice.text("");
                  mainContainer.html(response.content);
                  $("body").append("<script src='js/crudUsuariosScript.js'></script>");
               }
            }
         });
      }
   });
});

function loginFormValidation(){
   var usernameValue = username.val();
   var passwordValue = password.val();
   if(usernameValue === "" || passwordValue === ""){
      adviceContainer.attr("hidden", false);
      advice.text("*** Ninguno de los campos debe estar vacío ***");
      return false;
   }else{
      adviceContainer.attr("hidden", true);
      advice.text("***");
      return true;
   }
}