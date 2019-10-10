$(document).ready(function(){

    data = [];
    toggle_orgsettings(1);

    //Saving new org trigger
    $('#org_form').submit(function(e){

       e.preventDefault(); 
       data['form'] = this;
       INIT_organization_save(data);

    });

    //updating org trigger
    $('#Org_Editpanel').submit(function(e){
        e.preventDefault(); 
        data['form'] = this;
        INIT_organization_update(data);
     });

    //Show org manager
    $('#OrgManagerShow').click(function(e){
        org_manager();
    });

    //Select and display org to be updated
    $('#org_manager').on('click', '.orgupdate', function() {
        set_org_edit($(this).val());
    });

    //Search start
    $('#Orgsearch').click(function() {
        org_manager();
    });

    //Remove Org
    $('.org-remove-button').click(function() {

        if(confirm('Are you sure you want to remove Organization?')) {
            INIT_organization_remove($(this).val());
        }else{
            return
        }
        
    });

    $('#org_manager_search').keypress(function(event){
        var keycode = (event.keyCode ? event.keyCode : event.which);
        if(keycode == '13'){
            org_manager();
        }
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
                    'Limit':5
                }
                data = get_orglist(inquiry);
                data.done(function(orgdata){
                    orgdata = JSON.parse(orgdata);
                    display_organizations(orgdata);
                    RefreshActivity();
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
function INIT_organization_update(data){

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

                $('#OrgId').val('');
                $('#OrganizationNameEdit').val('');
                $('#OrganizationDescEdit').val('');
                $('.org-remove-button').val('');

                toggle_orgsettings(1);

                //Refreshes Org manager window
                inquiry = {
                    'Search':'',
                    'Limit':0
                }
                data = get_orglist(inquiry);
                data.done(function(orgdata){
                    orgdata = JSON.parse(orgdata);
                    display_organizations_manager(orgdata);
                });   


                //Refreshes Org summary
                inquiry = {
                    'Search':'',
                    'Limit':5
                }
                data = get_orglist(inquiry);
                data.done(function(orgdata){
                    orgdata = JSON.parse(orgdata);
                    display_organizations(orgdata);
                });


                //Display Message
                config = {
                    'message':response['Message'],
                    'type':'success'
                }
                org_message_handler(config);

            }else{

                //Display Message
                config = {
                    'message':response['Message'],
                    'type':'info'
                }
                org_message_handler(config);

            }
            console.log(response);
            
        }
    });
}
function INIT_organization_remove(id){

    $.ajax({
        url: PortfolioUrl()+'index.php/Portfolio/Ajax_org_remove',
        type: 'POST',
        data:{'OrgId':id},
      
        success: function(response){

            response = JSON.parse(response);
            if(response['Status'] == 1){

                $('#OrgId').val('');
                $('#OrganizationNameEdit').val('');
                $('#OrganizationDescEdit').val('');
                $('.org-remove-button').val('');

                toggle_orgsettings(1);

                //Refreshes Org manager window
                inquiry = {
                    'Search':'',
                    'Limit':0
                }
                data = get_orglist(inquiry);
                data.done(function(orgdata){
                    orgdata = JSON.parse(orgdata);
                    display_organizations_manager(orgdata);
                });   


                //Refreshes Org summary
                inquiry = {
                    'Search':'',
                    'Limit':5
                }
                data = get_orglist(inquiry);
                data.done(function(orgdata){
                    orgdata = JSON.parse(orgdata);
                    display_organizations(orgdata);
                });


                //Display Message
                config = {
                    'message':response['Message'],
                    'type':'success'
                }
                org_message_handler(config);

            }else{

                //Display Message
                config = {
                    'message':response['Message'],
                    'type':'info'
                }
                org_message_handler(config);

            }
            console.log(response);
            
        }
    });
}
function org_manager(){

    inquiry = {
        'Search':$('#org_manager_search').val() != null ? $('#org_manager_search').val() : '',
        'Limit':0
    }
    data = get_orglist(inquiry);
    data.done(function(orgdata){
            
        orgdata = JSON.parse(orgdata);
        display_organizations_manager(orgdata);
        

    });
    if($('#Orgmanage').not(':visible')){

        
        $('#Orgmanage').modal('show');
        $('#org_manager_search').focus();

    }
    

}
function set_org_edit(value = ''){

    toggle_orgsettings(0);
    inquiry = {
        'Search':value,
        'Limit':0
    }
    data = get_orgdata(inquiry);
    data.done(function(orgdata){
            
        orgdata = JSON.parse(orgdata);
        $('#OrgId').val(orgdata[0]['ID']);
        $('#OrganizationNameEdit').val(orgdata[0]['Organization']);
        $('#OrganizationDescEdit').val(orgdata[0]['Description']);
        $('.org-remove-button').val(orgdata[0]['ID']);

    });
}
function get_orglist(inquiry){

    return $.ajax({
        url: PortfolioUrl()+'index.php/Portfolio/Ajax_org_getlist',
        type: 'GET',
        data: inquiry
    });

}
function get_orgdata(inquiry){

    return $.ajax({
        url: PortfolioUrl()+'index.php/Portfolio/Ajax_org_getinfo',
        type: 'GET',
        data: inquiry
    });

}
function display_organizations(data){

    target = $('#OrgSummary');
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
function display_organizations_manager(data){

    target_m = $('#org_manager');
    target_m.fadeOut('slow');
    $orglist_manager = '';
    $.each(data, function(index, result_m){
        $orglist_manager += 
        '\
            <tr>\
                <td>'+result_m['Date']+'</td>\
                <td>'+result_m['Organization']+'</td>\
                <td>'+result_m['Description']+'</td>\
                <td><button type="button" class="orgupdate btn btn-sm btn-default" value="'+result_m['ID']+'">Update</button></td>\
            </tr>\
        ';
    });
    setTimeout(function() {
        target_m.html($orglist_manager).fadeIn('slow');
    }, 500);

}
function toggle_orgsettings(option = ''){

    bool = false;
    if(option == 1){

        bool = true;
        $('#Org_Editpanel').css({'filter':'opacity(30%)'});

    }else{

        bool = false;
        $('#Org_Editpanel').css({'filter':'opacity(100%)'});

    }
    $("#Org_Editpanel :input").prop("disabled", bool);
    $("#Org_Editpanel :button").prop("disabled", bool);
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