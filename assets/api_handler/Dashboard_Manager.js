function DashboardStart(url = '',reference_number = '', sy = '', sem = ''){

    //Check if needed parameters are available
    if(url == ''){
        config = {
            'message':'You must provide the API URL',
            'type':'warning'
        }
        message_handler(config);
        return;
    }
    if(reference_number == ''){
       
        //message_handler('No Token found');
        config = {
            'message':'No Token found',
            'type':'warning'
        }
        message_handler(config);
        return;
    }
    /*
    if(sy == ''){
        //message_handler('You must provide School Year');
        config = {
            'message':'You must provide School Year',
            'type':'warning'
        }
        message_handler(config);
        return;
    }
    if(sem == ''){
        //message_handler('You must provide Semester');
        config = {
            'message':'You must provide Semester',
            'type':'warning'
        }
        message_handler(config);
        return;
    }
    */
    //Contructs Array of inputs
    inputs = {
        'Base_url':url,
        'Reference_Number':reference_number,
        'School_Year':sy,
        'Semester':sem
    }

    //Inits Schedule API
    Get_Schedule(inputs);

    //Inits Balance API
    Get_Balance(inputs);


}
function Get_Schedule(inputs)
{   

    ajax = $.ajax({
        url: inputs.Base_url+'index.php/API/ScheduleAPI',
        type: 'GET',
        data: {
            Reference_Number: inputs.Reference_Number,
            School_Year: inputs.School_Year,
            Semester: inputs.Semester
        },
        success: function(response){

            result = JSON.parse(response);
            if(result['data'].length > 0){

                console.log(result['data']);
                showtable = $('#Schedule_dash_table');
                //Clears the table before append
                showtable.html('');
                $.each(result['data'], function(index, resultdata) 
                {
                 
                    row = $("<tr/>");
                    row.append($("<td/>").text(resultdata['Course_Title']));
                    row.append($("<td/>").text(resultdata['Day']));
                    row.append($("<td/>").text(resultdata['Time']));
                    showtable.append(row);
            
                });

            }else{
                message = "You're currently not enrolled to any subjects this semester";
                $('#Schedule_dash').html(message);
            }

        },
        fail: function(){

            alert('Error: request failed');
            return;

        }
    });
    
}
function Get_Balance(inputs){

    ajax = $.ajax({
        url: inputs.Base_url+'index.php/API/BalanceAPI',
        type: 'GET',
        data: {
            Reference_Number: inputs.Reference_Number,
            School_Year: inputs.School_Year,
            Semester: inputs.Semester
        },
        success: function(response){

            result = JSON.parse(response);
            console.log(result);
            if(result['Error'] == 0){

                $('#dash_sem-balance').html(result['Output']['Semestral_Balance']);
                $('#dash_oustanding-balance').html(result['Output']['Outstanding_Balance']);

            }else{
                
                config = {
                    'message':result['ErrorMessage'],
                    'type':'warning'
                }
                message_handler(config);
                return;

            }
            
        },
        fail: function(){

            alert('Error: request failed');
            return;

        }
    });

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
    console.log(settings.message);

}