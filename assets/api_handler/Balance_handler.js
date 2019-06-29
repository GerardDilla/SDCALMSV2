
function Init_BalanceAPI(url='',refnum='')
{   
    //console.log(url);
    if(url == ''){
        config = {
            'message':'Error: You must provide the API URL',
            'type':'warning'
        }
        message_handler(config);
        return;
    }
    if(refnum == ''){
       
        //message_handler('No Token found');
        config = {
            'message':'Error: No Token found',
            'type':'warning'
        }
        message_handler(config);
        return;
    }
    if($('#SYlegend').val() == ''){
        config = {
            'message':'Error: No School Year passed',
            'type':'warning'
        }
        message_handler(config);
        return;
    }
    if($('#Semlegend').val() == ''){
        config = {
            'message':'Error: No Semester passed',
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
            School_Year: $('#SYlegend').val(),
            Semester: $('#Semlegend').val()
        },
        success: function(response){

            result = JSON.parse(response);
            console.log(result);
            if(result['Error'] == 0){
                balance_display(result['data']);

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
function balance_display(resultdata)
{   

    $('#sem_balance').html(resultdata['Semestral_Balance']);
    $('#sem_paid').html(resultdata['Semestral_Paid']);
    $('#sem_total_balance').html(resultdata['Semestral_Total']);
    $('#previous_balance').html(resultdata['Outstanding_Balance_SemSy_Excluded']);
    $('#outstanding_balance').html(resultdata['Outstanding_Balance']);

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
    box += '</div>';
    $('.message_box').html(box);

}