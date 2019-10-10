//GET SECTIONS
$(document).ready(function(){

  $('#example').DataTable({
    dom: 'Bfrtip',
    buttons: [
      'copyHtml5', 'excelHtml5', 'pdfHtml5', 'csvHtml5'
    ]
  } );

  Get_CourseTitle();

  $('#sem').change(function(){ 
    
    Get_CourseTitle();

  });

  $('#sy').change(function(){ 
    
    Get_CourseTitle();

});

 
});

function Get_CourseTitle(){
    var Guidance_url = $("#base_urlSS").val(); 
    array = { 
      sy:$('#sy').val(),
      sem:$('#sem').val(),
    }

    $.ajax({
      url:Guidance_url+"index.php/Report/fetch_sections",
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
      $('#Section').append('<option value="'+result['SC']+'">'+result['Section_Name']+': ('+result['SC']+')</option>');
   });
   $("#Section").select2("destroy");
  
}



