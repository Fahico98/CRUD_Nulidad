
var tableBody = $("#tableBody");
var pagination = $("#pagination");
var searchCriteriaDropdown = $("#searchCriteriaDropdown");
var searchOptionsDropdown = $("#searchOptionsDropdown");
var searchInput = $("#searchInput");

$(document).ready(function(){

   getSentences();

   searchInput.on("keyup", function(event){
      event.preventDefault();
      //console.log("->" + $('#searchOptionsDropdown :selected').val());
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
