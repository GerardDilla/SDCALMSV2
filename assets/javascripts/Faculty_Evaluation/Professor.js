
$(document).ready(function(){
  var Guidance_url = $("#base_urlSS").val(); 
  $.ajax({
       url:Guidance_url+"index.php/Admin_Faculty/fetch_professor",
       success:function(data)
        {        
            $("#Professor_Table").html('');
            result = JSON.parse(data);
            Display_Professor(result);
        }
   });   
});


function Display_Professor(result){
      count = 1;
      showtable = $('#Professor_Table');
      //Clears the table before append
      showtable.html('');
      $.each(result, function(index, resultdata) 
      {
     
          row = $("<tr/>");
          row.append($("<td/>").text(count++));
          row.append($("<td/>").text(resultdata['Instructor_Name']));
          row.append($("<td/>").text(resultdata['Instructor_Department']));
          if(resultdata['Active'] == 1){
            row.append($("<td/>").append($("<button/>").text('Activate').addClass('btn btn-success wew')));
          }else{
            row.append($("<td/>").append($("<button/>").text('Deactivate').addClass('btn btn-danger wew'))); 
          }
          console.log(resultdata['Active']);

          showtable.append(row);

      });

}








 
  
