

function Get_Pagination(){

  //Sets inputs
  arrayData = {
      pageNumber: 1,
      //Pagination
      perPage:10,
      Proffesor: $("#Proffesor").val(),
      ActiveDeactive: $("#ActiveDeactive").val()
  };

  counter = ajax_getsched_pages(arrayData);
  counter.success(function(pages){
      content = ajax_getsched(arrayData);
      content.success(function(response){
          
          $('#professor_edit_pagination').pagination({
              items: pages,
              itemsOnPage: arrayData.perPage,
              cssStyle: 'light-theme',
              onPageClick: function(pageNumber){
                 arrayData['pageNumber'] = pageNumber;
                 ajax_getsched(arrayData);
              }
          });
      });
 
  });
}


function ajax_getsched_pages(arrayData){
  var Guidance_url = $("#base_urlSS").val(); 
  return $.ajax({
      url: Guidance_url+"index.php/Admin_Faculty/fetch_professors",
      type: 'GET',
      data:{Proffesor:arrayData.Proffesor,
           ActiveDeactive:arrayData.ActiveDeactive
          },
  });

}


function ajax_getsched(arrayData){
  var Guidance_url = $("#base_urlSS").val(); 
  offset = (arrayData.pageNumber - 1) * arrayData.perPage;
  return $.ajax({
      //async: false,
      url: Guidance_url+"index.php/Admin_Faculty/fetch_professor",
      type: 'GET',
      data:{Proffesor:arrayData.Proffesor,
           offset:offset,
           ActiveDeactive:arrayData.ActiveDeactive,
           perpage:arrayData.perPage},
      success:function(response){
         
          result = JSON.parse(response);
         Display_Professor(result);
      }
  });
}




function Display_Professor(result){
   
      showtable = $('#Professor_Table');
      //Clears the table before append
      showtable.html('');
      $.each(result, function(index, resultdata) 
      {
     
          row = $("<tr/>");
          row.append($("<td/>").text());
          row.append($("<td/>").text(resultdata['Instructor_Name']).addClass('text-center'));
          row.append($("<td/>").text(resultdata['Instructor_Department']));
          if(resultdata['Active'] == 1){
            row.append($("<td/>").append($("<button/>").text('Activate').addClass('btn btn-success fullwidth').attr('onclick','Active('+resultdata["ID"]+')')));
          }else{
            row.append($("<td/>").append($("<button/>").text('Deactivate').addClass('btn btn-danger fullwidth').attr('onclick','Deactive('+resultdata["ID"]+')'))); 
          }
          console.log(resultdata['Active']);

          showtable.append(row);

      });

}


function Active(id=''){
  var Active = confirm("Are you sure you want to Deactive?");
  var Guidance_url = $("#base_urlSS").val(); 
      if (Active == true) {
           $.ajax({
             url:Guidance_url+"index.php/Admin_Faculty/fetch_Active",
             method:"GET",
             data:{id:id},
             success:function(data)
             {        
                Get_Pagination();
              }
          });   
      } else {

      }
}


function Deactive(id=''){
  var Active = confirm("Are you sure you want to Active?");
  var Guidance_url = $("#base_urlSS").val(); 
  if (Active == true) {
        $.ajax({
          url:Guidance_url+"index.php/Admin_Faculty/fetch_Deactive",
          method:"GET",
          data:{id:id},
          success:function(data)
            {        
              Get_Pagination();
            }
      });   
  } else {
 }
}




 
  
