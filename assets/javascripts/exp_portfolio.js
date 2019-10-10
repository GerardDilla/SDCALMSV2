$(document).ready(function(){

    data = [];
    toggle_expsettings(1);

    //Saving new exp trigger
    $('#exp_form').submit(function(e){

       e.preventDefault(); 
       data['form'] = this;
       INIT_experience_save(data);

    });
    //updating exp trigger
    $('#Exp_Editpanel').submit(function(e){
        e.preventDefault(); 
        data['form'] = this;
        INIT_Experience_update(data);
     });

    //Show exp manager
    $('#ExpManagerShow').click(function(e){

        exp_manager();
    });

    //Select and display exp to be updated
    $('#exp_manager').on('click', '.expupdate', function() {
        set_exp_edit($(this).val());
    });

    //Search start
    $('#Orgsearch').click(function() {
        exp_manager();
    });

    //Remove Org
    $('.exp-remove-button').click(function() {

        if(confirm('Are you sure you want to remove Experience?')) {
            INIT_Experience_remove($(this).val());
        }else{
            return
        }
        
    });

    $('#exp_manager_search').keypress(function(event){
        var keycode = (event.keyCode ? event.keyCode : event.which);
        if(keycode == '13'){
            exp_manager();
        }
    });
});
function INIT_experience_save(data){

    $.ajax({
        url: $(data['form']).attr('action'),
        type: $(data['form']).attr('method'),
        data:new FormData(data['form']),
        processData:false,
        contentType:false,
        cache:false,
        async:false,
        success: function(response){

            response = JSON.parse(response);
            if(response['Status'] == 1){

                $('#ExpName').val('');
                $('#ExpDesc').val('');

                inquiry = {
                    'Search':'',
                    'Limit':5
                }
                data = get_explist(inquiry);
                data.done(function(expdata){
                    expdata = JSON.parse(expdata);
                    display_experiences(expdata);
                    RefreshActivity();
                });

                //Display Message
                config = {
                    'message':response['Message'],
                    'type':'success',
                    'object':'#Experience_message',
                }
                exp_message_handler(config);

            }else{

                //Display Message
                config = {
                    'message':response['Message'],
                    'type':'info',
                    'object':'#Experience_message',
                }
                exp_message_handler(config);

            }
            console.log(response);
            
        }
    });
}
function INIT_Experience_update(data){

    $.ajax({
        url: $(data['form']).attr('action'),
        type: $(data['form']).attr('method'),
        data:new FormData(data['form']),
        processData:false,
        contentType:false,
        cache:false,
        async:false,
        success: function(response){

            response = JSON.parse(response);
            if(response['Status'] == 1){

                $('#ExpId').val('');
                $('#ExpNameEdit').val('');
                $('#ExpDescEdit').val('');
                $('.exp-remove-button').val('');

                toggle_expsettings(1);

                //Refreshes exp manager window
                inquiry = {
                    'Search':'',
                    'Limit':0
                }
                data = get_explist(inquiry);
                data.done(function(expdata){
                    expdata = JSON.parse(expdata);
                    display_experiences_manager(expdata);
                });   


                //Refreshes exp summary
                inquiry = {
                    'Search':'',
                    'Limit':5
                }
                data = get_explist(inquiry);
                data.done(function(expdata){
                    expdata = JSON.parse(expdata);
                    display_experiences(expdata);
                });


                //Display Message
                config = {
                    'message':response['Message'],
                    'type':'success'
                }
                exp_message_handler(config);

            }else{

                //Display Message
                config = {
                    'message':response['Message'],
                    'type':'info'
                }
                exp_message_handler(config);

            }
            console.log(response);
            
        }
    });
}
function INIT_Experience_remove(id){

    $.ajax({
        url: PortfolioUrl()+'index.php/Portfolio/Ajax_exp_remove',
        type: 'POST',
        data:{'ExpId':id},
      
        success: function(response){

            response = JSON.parse(response);
            if(response['Status'] == 1){

                $('#ExpId').val('');
                $('#ExpNameEdit').val('');
                $('#ExpDescEdit').val('');
                $('.exp-remove-button').val('');

                toggle_expsettings(1);

                //Refreshes exp manager window
                inquiry = {
                    'Search':'',
                    'Limit':0
                }
                data = get_explist(inquiry);
                data.done(function(expdata){
                    expdata = JSON.parse(expdata);
                    display_experiences_manager(expdata);
                });   

                //Refreshes exp summary
                inquiry = {
                    'Search':'',
                    'Limit':5
                }
                data = get_explist(inquiry);
                data.done(function(expdata){
                    expdata = JSON.parse(expdata);
                    display_experiences(expdata);
                });

                //Display Message
                config = {
                    'message':response['Message'],
                    'type':'success'
                }
                exp_message_handler(config);

            }else{

                //Display Message
                config = {
                    'message':response['Message'],
                    'type':'info'
                }
                exp_message_handler(config);

            }
            console.log(response);
            
        }
    });
}
function exp_manager(){

    inquiry = {
        'Search':$('#exp_manager_search').val() != null ? $('#exp_manager_search').val() : '',
        'Limit':0
    }
    data = get_explist(inquiry);
    data.done(function(expdata){
            
        expdata = JSON.parse(expdata);
        display_experiences_manager(expdata);
        

    });
    if($('#Expmanage').not(':visible')){

        
        $('#Expmanage').modal('show');
        $('#exp_manager_search').focus();

    }
    

}
function set_exp_edit(value = ''){

    toggle_expsettings(0);
    inquiry = {
        'Search':value,
        'Limit':0
    }
    data = get_expdata(inquiry);
    data.done(function(expdata){
            
        expdata = JSON.parse(expdata);
        $('#ExpId').val(expdata[0]['ID']);
        $('#ExpNameEdit').val(expdata[0]['Experience']);
        $('#ExpDescEdit').val(expdata[0]['Description']);
        $('.exp-remove-button').val(expdata[0]['ID']);

    });
}
function get_explist(inquiry){

    return $.ajax({
        url: PortfolioUrl()+'index.php/Portfolio/Ajax_exp_getlist',
        type: 'GET',
        data: inquiry
    });

}
function get_expdata(inquiry){

    return $.ajax({
        url: PortfolioUrl()+'index.php/Portfolio/Ajax_exp_getinfo',
        type: 'GET',
        data: inquiry
    });

}
function display_experiences(data){

    target_exp = $('#ExpSummary');
    target_exp.fadeOut('slow');
    $list = '';
    $.each(data, function(index, result){
        $list += 
        '\
            <li>\
                <span class="title">'+result['Experience']+'</span>\
                <span class="message truncate">'+result['Description']+'</span>\
            </li>\
        ';
    });
    setTimeout(function() {
        target_exp.html($list).fadeIn('slow');
    }, 500);
}
function display_experiences_manager(data){

    target_m_exp = $('#exp_manager');
    target_m_exp.fadeOut('slow');
    $explist_manager = '';
    $.each(data, function(index, result_m){
        $explist_manager += 
        '\
            <tr>\
                <td>'+result_m['Date']+'</td>\
                <td>'+result_m['Experience']+'</td>\
                <td>'+result_m['Description']+'</td>\
                <td><button type="button" class="expupdate btn btn-sm btn-default" value="'+result_m['ID']+'">Update</button></td>\
            </tr>\
        ';
    });
    setTimeout(function() {
        target_m_exp.html($explist_manager).fadeIn('slow');
    }, 500);

}
function toggle_expsettings(option = ''){

    bool = false;
    if(option == 1){

        bool = true;
        $('#Exp_Editpanel').css({'filter':'opacity(30%)'});

    }else{

        bool = false;
        $('#Exp_Editpanel').css({'filter':'opacity(100%)'});

    }
    $("#Exp_Editpanel :input").prop("disabled", bool);
    $("#Exp_Editpanel :button").prop("disabled", bool);
}
function exp_message_handler(settings){

    console.log(settings);
    if(length.settings == 0 || settings == undefined){
        settings = {
            'type':'warning',
            'message':'',
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
        if(settings.object == '' || settings.object == undefined){
            settings['object'] = '.message_box';
        }
    }

    var box = '';
    box += '<div class="alert alert-'+settings.type+'">';
    box += '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>';
    box += settings.message;
    box += '</div>';
    $(settings.object).html(box);

}