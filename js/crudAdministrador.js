
var mainContainer = $("#mainContainer");

$(document).ready(function(){
   $.ajax({
      type: "POST",
      url: "../getCrudTable.php",
      dataType: "HTML",
      success: function(response){
         mainContainer.append(response);
      }
   });
});
