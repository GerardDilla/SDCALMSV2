$(document).ready(function(){
    data = [];
   $('#org_form').submit(function(e){

       e.preventDefault(); 
       data['form'] = this;
       INIT_organization_save(data);

   });
});
function INIT_organization_save(data){

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

                $('#OrgName').val('');
                $('#OrgDescription').val('');

                inquiry = {
                    'Search':'',
                    'Limit':0
                }
                data = get_orglist(inquiry);
                data.done(function(orgdata){
            
                    orgdata = JSON.parse(orgdata);
                    display_organizations(orgdata);
            
            
                });

                //Display Message
                config = {
                    'message':response['Message'],
                    'type':'success',
                    'object':'#organization_message',
                }
                org_message_handler(config);

            }else{

                //Display Message
                config = {
                    'message':response['Message'],
                    'type':'info',
                    'object':'#organization_message',
                }
                org_message_handler(config);

            }
            console.log(response);
            
        }
    });
}
function get_orglist(inquiry){

    return $.ajax({
        url: PortfolioUrl()+'index.php/Portfolio/Ajax_org_getlist',
        type: 'GET',
        data: inquiry
    });

}
function display_organizations(data){

    target = $('#OrgSummary');
    console.table(target);
    target.fadeOut('slow');
    $list = '';
    $.each(data, function(index, result){
        $list += 
        '\
            <li>\
                <span class="title">'+result['Organization']+'</span>\
                <span class="message truncate">'+result['Description']+'</span>\
            </li>\
        ';
    });
    setTimeout(function() {
        target.html($list).fadeIn('slow');
    }, 500);

}
function org_message_handler(settings){

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
        if(settings.object == ''){
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