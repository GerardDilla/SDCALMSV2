

function Get_Proffs(){

  //Sets inputs
  arrayData = {
      pageNumber: 1,
      //Pagination
      perPage:15,
      Proffesor: $("#Proffesor").val()
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
      url: Guidance_url+"index.php/Admin_Faculty/fetch_professors_result",
      type: 'GET',
      data:{Proffesor:arrayData.Proffesor,
          },
  });

}


function ajax_getsched(arrayData){
  var Guidance_url = $("#base_urlSS").val(); 
  offset = (arrayData.pageNumber - 1) * arrayData.perPage;
  return $.ajax({
      //async: false,
      url: Guidance_url+"index.php/Admin_Faculty/fetch_professor_result",
      type: 'GET',
      data:{Proffesor:arrayData.Proffesor,
           offset:offset,
           perpage:arrayData.perPage},
      success:function(response){
         
        result = JSON.parse(response);
         Display_Professor(result,arrayData);
      }
  });
}


function ajax_getsresults(prof_id=""){
    var Guidance_url = $("#base_urlSS").val(); 
    var sem          = $("#semester").val(); 
    var sy           = $("#schoolyear").val(); 
    return $.ajax({
        url: Guidance_url+"index.php/Admin_Faculty/fetch_all_results",
        type: 'GET',
        data:{Proffesor:prof_id,
              Semester:sem,
              SchoolYear:sy,
            },
          
    });
  
  }

//DISPLAY PROFF IN TABLE
function Display_Professor(result,offset){
    var sem  = $("#semester").val(); 
    var sy   = $("#schoolyear").val(); 
      showtable = $('#Professor_Table');
      //Clears the table before append
      showtable.html('');
      $.each(result, function(index, resultdata) 
      {
        counter =  ajax_getsresults(resultdata['ID']);
        counter.success(function(totalEvaluators){
                row = $("<tr/>");
                row.append($("<td/>").text(resultdata['Instructor_Name']).addClass('text-center'));
                row.append($("<td/>").text(totalEvaluators));   
                row.append($("<td/>").text('0%'));   
                row.append($("<td/>").text('No Evaluation'));   
                row.append($("<td/>").append($("<button/>").text('View Result').addClass('btn btn-success fullwidth').attr('onclick','Get_EvalResultPage("'+resultdata['ID']+'","'+sem+'","'+sy+'")')));
                showtable.append(row);

         })

      });

}


function Get_EvalResultPage(prof_id,sem,sy){
  var Guidance_url = $("#base_urlSS").val(); 

   window.open(Guidance_url+"index.php/Admin_Faculty/Result/"+prof_id+"/"+sem+"/"+sy);
   
    
  }



 
  
