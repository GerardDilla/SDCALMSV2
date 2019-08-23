function refresh_grading(){

    $("#Sched_sy").select2("val", "");
    $("#Sched_sem").select2("val", "");

    return false; // prevent submitting
}
function Init_ScheduleAPI(url='',refnum='')
{   
    //console.log(url);
    if(url == ''){
        config = {
            'message':'You must provide the API URL',
            'type':'warning'
        }
        message_handler(config);
        return;
    }
    if(refnum == ''){
       
        //message_handler('No Token found');
        config = {
            'message':'No Token found',
            'type':'warning'
        }
        message_handler(config);
        return;
    }
    if($('#Sched_sy').val() == ''){
        //message_handler('You must provide School Year');
        config = {
            'message':'You must provide School Year',
            'type':'warning'
        }
        message_handler(config);
        return;
    }
    if($('#Sched_sem').val() == ''){
        //message_handler('You must provide Semester');
        config = {
            'message':'You must provide Semester',
            'type':'warning'
        }
        message_handler(config);
        return;
    }

    
    ajax = $.ajax({
        url: url,
        type: 'GET',
        data: {
            Reference_Number: refnum,
            School_Year: $('#Sched_sy').val(),
            Semester: $('#Sched_sem').val()
        },
        success: function(response){

            result = JSON.parse(response);
            if(result['ResultCount']  != 0){
                console.log(result);
                //grading_display(result['Output']);

                display_sched_table(result['data']);

                $('html, body').animate({
                    scrollTop: $('.table').offset().top
                }, 500);
                //message_handler(result['ErrorMessage'],'warning','.message_box');
            }else{
                $('#schedule_main').dataTable().fnDestroy()
                $('#schedule_body').html('');
                message_handler({'message':result['ErrorMessage'],'type':'warning'});
                //message_handler(result['ErrorMessage'],'warning');
            }

        },
        fail: function(){

            alert('Error: request failed');
            return;

        }
    });
    
}
function display_sched_table(data){

    $('#schedule_main').dataTable().fnDestroy();
    $('.message_box').html('');
    $('#schedule_main').DataTable({
        "data": data,
        "type": "GET",
        "columns": [
            { "data": "Course_Code" },
            { "data": "Course_Title" },
            { "data": "Day" },
            { "data": "Time" },
            { "data": "Instructor" }
        ]
    })


}
function message_handler(settings){


    console.log(length.settings);
    if(length.settings == 0 || settings == undefined){
        settings = {
            'type':'warning',
            'message':'No Data passed to message_handler()',
            'object':'.message_box',
        };
    }else{
        if(settings.type == ''){
            settings['type'] = 'info';
          
        }
        if(settings.message == ''){
            settings['message'] = '';
            console.log('No Message provided for message_handler');
    
        }
        if(settings.object == ''){
            settings['object'] = '.message_box';
    
        }
    }

    

    var box = '';
    box += '<div class="alert alert-'+settings.type+'">';
    box += '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>';
    box += settings.message;
    box += '</div>'
    $('.message_box').html(box);

}