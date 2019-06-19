function refresh_grading(){

    $("#Grade_sy").select2("val", "");
    $("#Grade_sem").select2("val", "");

    return false; // prevent submitting
}
function Init_API(url='',refnum='')
{   
    //console.log(url);
    if(url == ''){
        message_handler('You must provide the API URL','warning','.message_box');
        return;
    }
    if(refnum == ''){
       
        message_handler('No Token found');
        return;
    }
    if($('#Grade_sy').val() == ''){
        message_handler('You must provide School Year');
        return;
    }
    if($('#Grade_sem').val() == ''){
        message_handler('You must provide Semester');
        return;
    }

    
    ajax = $.ajax({
        url: url,
        type: 'GET',
        data: {
            Reference_Number: refnum,
            School_Year: $('#Grade_sy').val(),
            Semester: $('#Grade_sem').val()
        },
        success: function(response){

            result = JSON.parse(response);
            if(result['ResultCount']  != 0){
                console.log(result);
                //grading_display(result['Output']);

                
                $("#grading_main").dataTable().fnDestroy();
                $('.message_box').html('');
                $('#grading_main').DataTable({
                    "data": result['data'],
                    "type": "GET",
                    "columns": [
                        { "data": "Course_Code" },
                        { "data": "Course_Title" },
                        { "data": "Prelim" },
                        { "data": "Midterm" },
                        { "data": "Finals" },
                        { "data": "FINALGRADE" },
                        { "data": "REMARKS" }
                    ]
                })
                $('html, body').animate({
                    scrollTop: $('.table').offset().top
                }, 500);
                //message_handler(result['ErrorMessage'],'warning','.message_box');
            }else{
                $("#grading_main").dataTable().fnDestroy()
                $("#grading_body").html('');
                message_handler(result['ErrorMessage']);
            }

        },
        fail: function(){

            alert('Error: request failed');
            return;

        }
    });
    
    

    
}
function grading_display(resultdata)
{   


    //Displays Grades in container
    showtable = $('#grading_table');
    //clears the table before append
    showtable.html('');

    $('.message_box').html('');

    $.each(resultdata, function(index, result) 
    {
        row = $("<tr/>");
       
        row.append($("<td/>").text(result['Course_Code']));
        row.append($("<td/>").text(result['Course_Title']));
        row.append($("<td/>").text(result['Prelim']));
        row.append($("<td/>").text(result['Midterm']));
        row.append($("<td/>").text(result['Finals']));
        row.append($("<td/>").text(result['FINALGRADE']));
        row.append($("<td/>").text(result['REMARKS']));
    
        showtable.append(row);

    });
    



}
function message_handler(msg='',type='info',obj='.message_box'){
    
    var box = '';
    box += '<div class="alert alert-'+type+'">';
    box += '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>';
    box += msg;
    box += '</div>'
    $(obj).html(box);

}