//GET SECTIONS
$(document).ready(function(){
 $('#Program').change(function(){
  var Guidance_url = $("#base_urlSS").val(); 
  var Program_id = $('#Program').val();
    $.ajax({
        url:Guidance_url+"index.php/Admin_Faculty/fetch_sections",
        method:"POST",
        data:{Program_id:Program_id},
        success:function(data)
        {        
            $("#Section").html('');
             result = JSON.parse(data);
             Display_Section(result);
    }
    });
  });
});

function Display_Section(result){
    $('#Section').append('<option selected value="">Select Section:</option>');
    $.each(result, function(index, result) 
     {
        $('#Section').append('<option>'+result['SN']+'</option>');
     });
     $("#Section").select2("destroy");
    
}


function Get_Students(){

  var Guidance_url = $("#base_urlSS").val(); 
     array = { 
       sy:$('#sy').val(),
       sem:$('#sem').val(),
       Program:$('#Program').val(),
       Section:$('#Section').val(),
       EvaluateStudent:$('#EvaluateStudent').val(),
       YearLevel:$('#yrlvl').val()
     }

     if ($('#EvaluateStudent').val() == 1) {
               
                $.ajax({
                  url:Guidance_url+"index.php/Admin_Faculty/fetch_students",
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
                url:Guidance_url+"index.php/Admin_Faculty/fetch_studentsNon",
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