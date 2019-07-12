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
       YearLevel:$('#yrlvl').val()
     }
      $.ajax({
          url:Guidance_url+"index.php/Admin_Faculty/fetch_students",
          method:"GET",
          data:array,
          success:function(data)
          {        
              $("#Section").html('');
               result = JSON.parse(data);
               Display_Students(result);
      }
      });

}
function Display_Students(result){
  $('#Section').append('<option selected value="">Select Section:</option>');
  $.each(result, function(index, result) 
   {
      $('#Section').append('<option>'+result['SN']+'</option>');
   });
 
  
}