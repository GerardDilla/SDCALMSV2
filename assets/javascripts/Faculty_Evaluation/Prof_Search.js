//GET SECTIONS
$(document).ready(function(){
 $('#sem').change(function(){
  var Guidance_url = $("#base_urlSS").val(); 
  array = { 
    sy:$('#sy').val(),
    sem:$('#sem').val(),
  }
          $.ajax({
              url:Guidance_url+"index.php/Admin_Faculty/fetch_proff",
              method:"GET",
              data:array,
              success:function(data)
              {        
                    $("#proffesor").html('');
                    result = JSON.parse(data);
                   Display_Prof(result);
              }
          });
  });
});

function Display_Prof(result){
    $('#proffesor').append('<option selected value="">Select Proffesor:</option>');
    $.each(result, function(index, result) 
     {
        $('#proffesor').append('<option value="'+result['ID']+'">'+result['Instructor_Name']+'</option>');
     });
     $("#proffesor").select2("destroy");
    
}


function Get_CourseTitle(){
  var Guidance_url = $("#base_urlSS").val(); 
  array = { 
    sy:$('#sy').val(),
    sem:$('#sem').val(),
    proffesor: $('#proffesor').val()
  }

  $.ajax({
    url:Guidance_url+"index.php/Admin_Faculty/fetch_course_title",
    method:"GET",
    data:array,
    success:function(data)
    {        
          $("#Section").html('');
          result = JSON.parse(data);
          Display_CourseTitle(result);
    }
   });

}

function Display_CourseTitle(result){

  $.each(result, function(index, result) 
   {
      $('#Section').append('<option >'+result['Section_Name']+'</option>');
   });
   $("#Section").select2("destroy");
  
}




function Get_Studentsproff(){

  var Guidance_url = $("#base_urlSS").val(); 
     array = { 
       sy:$('#sy').val(),
       sem:$('#sem').val(),
       proffesor:$('#proffesor').val(),
       Course_Title:$('#Course_Title').val(),
       Section:$('#Section').val(),
       EvaluateStudent:$('#EvaluateStudent').val()
     }

     if ($('#EvaluateStudent').val() == 1) {
               
      $.ajax({
        url:Guidance_url+"index.php/Admin_Faculty/fetch_students_proff",
        method:"GET",
        data:array,
        success:function(data)
        {        
            $("#Search_Student").html('');
            result = JSON.parse(data);
            Display_Students(result);
        }
      });   

} else if ($('#EvaluateStudent').val() == 2) {

    $.ajax({
      url:Guidance_url+"index.php/Admin_Faculty/fetch_nonstudents_proff",
      method:"GET",
      data:array,
      success:function(data)
      {        
          $("#Search_Student").html('');
          result = JSON.parse(data);
          Display_Students(result);
      }
    });   

}else{
alert('PLEASE CHOOSE EVALUATEE!!!');
}

}

function Display_Students(result){
      count = 1;
      showtable = $('#Search_Student');
      //Clears the table before append
      showtable.html('');
      $.each(result, function(index, resultdata) 
      {
      
          row = $("<tr/>");
          row.append($("<td/>").text(count++));
          row.append($("<td/>").text(resultdata['Student_Number']));
          row.append($("<td/>").text(resultdata['Last_Name']+' '+resultdata['First_Name']+','+resultdata['Middle_Name']));
          row.append($("<td/>").text(resultdata['Course']));
          row.append($("<td/>").text(resultdata['Section_Name']));
          row.append($("<td/>").text(resultdata['YearLevel']));
          showtable.append(row);

      });

}








 
  
