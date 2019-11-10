
// Form
var authorityRegisterForm = $("#authorityRegisterForm");

// Inputs
var authorityName = $("#authorityName");
var supAuthorityName = $("#supAuthorityName");
var authorityUserName = $("#authorityUserName");
var authorityPass = $("#authorityPass");
var authorityConfPass = $("#authorityConfPass");

// Helpers
var authorityNameHelp = $("#authorityNameHelp");
var supAuthorityNameHelp = $("#supAuthorityNameHelp");
var authorityUserNameHelp = $("#authorityUserNameHelp");
var authorityPassHelp = $("#authorityPassHelp");
var authorityConfPassHelp = $("#authorityConfPassHelp");

// Closer
var closeAuthorityRegisterForm = $(".closeAuthorityRegisterForm");

var inputs = [
   authorityName,
   supAuthorityName,
   authorityUserName,
   authorityPass,
   authorityConfPass
];

var helpers = [
   authorityNameHelp,
   supAuthorityNameHelp,
   authorityUserNameHelp,
   authorityPassHelp,
   authorityConfPassHelp
];

$(document).ready(function(){
   authorityRegisterForm.on("submit", function(event){
      event.preventDefault();
      if(authorityRegisterFormValidation()){

      }
   });
});


function resetNewSenteceForm(){

   helpers.forEach((helper) => {
      helper.text("");
   });

   inputs.forEach((input) => {
      input.val("");
   });

}

function autoridadEmisoraExists(){
   var valueNombreAutoridad = autoridadEmisora.val();
   var output;
   $.ajax({
      type: "POST",
      url: "php/validateAutoridad.php",
      data: {autoridadEmisora: valueNombreAutoridad},
      success: function(response){
         output = $.trim(response);
      },
      async: false
   });
   return output;
}

function authorityRegisterFormValidation(){

   var authorityName = authorityName.val();
   var supAuthorityName = supAuthorityName.val();
   var authorityUserName = authorityUserName.val();
   var authorityPass = authorityPass.val();
   var authorityConfPass = authorityConfPass.val();

   var output = true;

   if(authorityName === null || authorityName === ""){
      authorityNameHelp.text("(*) Este campo es obligatorio.");
      output = false;
   }else if(!authorityName.match(new RegExp("[A-Za-z0-9 ]", "i"))){
      authorityNameHelp.text("(*) Este campo solo debe contener caracteres alfanuméricos.");
      output = false;
   }else{
      authorityNameHelp.text("");
   }

   if(supAuthorityName === null || supAuthorityName === ""){
      supAuthorityNameHelp.text("(*) Este campo es obligatorio.");
      output = false;
   }else if(/*autoridadEmisoraExists().localeCompare("not exists") === 0*/){
      autoridadEmisoraHelp.text("(*) La autoridad ingresada no existe en la base de datos.");
      output = false;
   }else{
      autoridadEmisoraHelp.text("");
   }

   if(valueSentido === null || valueSentido === ""){
      sentidoHelp.text("(*) Este campo es obligatorio.");
      output = false;
   }else{
      sentidoHelp.text("");
   }

   if(valueDate === null || valueDate === ""){
      dateHelp.text("(*) Este campo es obligatorio.");
      output = false;
   }else{
      dateHelp.text("");
   }

   if(valueDoc === null || valueDoc === ""){
      documentoHelp.text("(*) Este campo es obligatorio.");
      output = false;
   }else{
      documentoHelp.text("");
   }

   return output;

}
