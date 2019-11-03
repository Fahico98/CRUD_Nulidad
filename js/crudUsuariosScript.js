
var tableBody = $("#tableBody");
var pagination = $("#pagination");
var newSentenceForm = $("#newSentenceForm");
var searchCriteriaDropdown = $("#searchCriteriaDropdown");
var searchOptionsDropdown = $("#searchOptionsDropdown");
var searchInput = $("#searchInput");

var expediente = $("#expediente");
var autoridadEmisora = $("#autoridadEmisora");
var sentido = $("#sentido");
var date = $("#date");
var documento = $("#documento");

var expedienteHelp = $("#expedienteHelp");
var autoridadEmisoraHelp = $("#autoridadEmisoraHelp");
var sentidoHelp = $("#sentidoHelp");
var dateHelp = $("#dateHelp");
var documentoHelp = $("#documentoHelp");

var closeNewSenteceForm = $(".closeNewSenteceForm");

var inputs = [
   expediente,
   autoridadEmisora,
   sentido,
   date,
   documento
];

var helpers = [
   expedienteHelp,
   autoridadEmisoraHelp,
   sentidoHelp,
   dateHelp,
   documentoHelp
];

$(document).ready(function(){
   getSentences();
   newSentenceForm.on("submit", function(event){
      event.preventDefault();
      if(newSentenceFormValidation()){
         var data = new FormData(this);
         $.ajax({
            type: "POST",
            url: "php/addNewSentence.php",
            data: data,
            contentType: false,
            cache: false,
            processData: false,
            success: function(response){
               if($.trim(response).localeCompare("success") === 0){
                  closeNewSenteceForm.trigger("click");
                  getSentences();
               }
            }
         });
      }
   });
   closeNewSenteceForm.on("click", function(event){
      event.preventDefault();
      resetNewSenteceForm();
   });
   searchInput.on("keyup", function(event){
      event.preventDefault();
      console.log("->" + $('#searchOptionsDropdown :selected').val());
      //console.log("->" + searchOptionsDropdown.val());
   });
});

function getSentences(page = 1, parameter = "", parameterVal = ""){
   $.ajax({
      type: "POST",
      url: "php/getSentences.php",
      dataType: "html",
      data: {
         page: page,
         parameter: parameter,
         parameterVal: parameterVal
      },
      success: function(response){
         tableBody.html(response);
      }
   });
   changePage(page, parameter, parameterVal);
}


function changePage(page = 1, parameter = "", parameterVal = ""){
   currentPage = page;
   $.ajax({
      type: "POST",
      url: "php/pagination.php",
      dataType: "html",
      data: {
         page: page,
         parameter: parameter,
         parameterVal: parameterVal
      },
      success: function(response){
         pagination.html(response);
      }
   });
}

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

function newSentenceFormValidation(){
   var valueExpediente = expediente.val();
   var valueAutEmisora = autoridadEmisora.val();
   var valueSentido = sentido.val();
   var valueDate = date.val();
   var valueDoc = documento.val();
   var output = true;

   if(valueExpediente === null || valueExpediente === ""){
      expedienteHelp.text("(*) Este campo es obligatorio.");
      output = false;
   }else if(!valueExpediente.match(new RegExp("[A-Za-z0-9 ]", "i"))){
      expedienteHelp.text("(*) Este campo solo debe contener caracteres alfanuméricos.");
      output = false;
   }else{
      expedienteHelp.text("");
   }

   if(valueAutEmisora === null || valueAutEmisora === ""){
      autoridadEmisoraHelp.text("(*) Este campo es obligatorio.");
      output = false;
   }else if(autoridadEmisoraExists().localeCompare("not exists") === 0){
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
