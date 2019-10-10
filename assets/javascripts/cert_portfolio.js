
function display_image(file){
    //Displays image in panel after selecting for upload
    imagelink = (window.URL ? URL : webkitURL).createObjectURL(file.files[0]);
    $('#cert_thumbnail')[0].src = imagelink;
    //$('#cert_lightbox').attr("href", imagelink);
} 
$(document).ready(function(){
     data = [];
    $('#cert_form').submit(function(e){

        e.preventDefault(); 
        data['form'] = this;
        INIT_certificate_save(data);

    });
});
function INIT_certificate_save(data){

    
    $.ajax({
        url: $(data['form']).attr('action'),
        type: $(data['form']).attr('method'),
        data:new FormData(data['form']),
        processData:false,
        contentType:false,
        cache:false,
        async:false,
        success: function(response){

            result = JSON.parse(response);
            if(result['Status'] == 1){

                $('#CertFile').val('');
                $('#CertName').val('');
                $('#cert_thumbnail')[0].src = PortfolioUrl()+'/assets/images/cert_icon.png';
                $('#cert_lightbox').attr("href", PortfolioUrl()+'/assets/images/cert_icon.png');

                //Get Certificate List and display update
                inquiry = {
                    'Search':'',
                    'Limit':5
                }
                CertList = get_certificate_list(inquiry);
                CertList.done(function(certdata){

                    CertList = JSON.parse(certdata);
                    console.log(CertList);

                    target = $('#AchievementSummary');
                    display_certificates(CertList);
                    RefreshActivity();
                });

                //Display Message
                config = {
                    'message':result['Message'],
                    'type':'success',
                    'object':'#certificate_message',
                }
                portfolio_message_handler(config);

            }else{

                config = {
                    'message':result['Message'],
                    'type':'info',
                    'object':'#certificate_message',
                }
                portfolio_message_handler(config);
                
            }
            console.log(data);
            
        }
    });
}
function search_cert(){

    $(".searchloader").show();

        inquiry = {
            'Search':$("#cert_manager_search").val(),
            'Limit':0
        }
        //Get Certificate List
        data = get_certificate_list(inquiry);
        data.done(function(certdata){
    
            CertData = JSON.parse(certdata);
            target = $('#cert_manager');
            manager_certificates(CertData);
    
    
        });
        

}
function cert_viewall(){

    inquiry = {
        'Search':'',
        'Limit':0
    }

    open_cert_manager();
    //Get Certificate List
    data = get_certificate_list(inquiry);
    data.done(function(certdata){

        CertData = JSON.parse(certdata);
        console.log(CertData);
        target = $('#cert_manager');
        manager_certificates(CertData);


    });

}
function open_cert_manager(){

    $('#Certmanage').modal('show');
    $('#cert_manager_search').focus();
    //document.getElementById('cert_manager_search').click();

    $('#cert_manager_search').keypress(function(event){
        var keycode = (event.keyCode ? event.keyCode : event.which);
        if(keycode == '13'){
            search_cert();
        }
    });

}
function get_certificate_list(inquiry){

    console.log(PortfolioUrl());
    return $.ajax({
        url: PortfolioUrl()+'index.php/Portfolio/Ajax_GetCertNumber',
        type: 'GET',
        data: inquiry
    });

}
function display_certificates(data){

    target = $('#AchievementSummary');
    console.table(target);
    target.fadeOut('slow');
    $list = '';
    $.each(data, function(index, result){
        $list += 
        '\
        <li>\
            <div class="post-image">\
                <div class="img-thumbnail cert_thumbnail">\
                    <a href="#">\
                        <img class="cert_img preview-image" src="'+PortfolioUrl()+'personaldata/Certificates/'+result['Certificate']+''+result['Extension']+'" alt="">\
                    </a>\
                </div>\
            </div>\
            <div class="post-info">\
                <a style="text-transform: uppercase; font-weight: bold; color:green" class="lightbox" href="#">'+result['Title']+'</a>\
                <div class="post-meta cert_link">\
                '+result['Date']+'\
                </div>\
            </div>\
        </li>\
        ';
    });
    setTimeout(function() {
        target.html($list).fadeIn('slow');
    }, 500);

}
function manager_certificates(data){

    target_mngr = $('#cert_manager');
    console.table(target_mngr);
    target_mngr.fadeOut('slow');
    $manager_list = '';
    $.each(data, function(index, result){

        $manager_list += 
        '\
        <tr>\
            <td>\
                <div class="thumb-info mb-md" style="text-align:center">\
                        <a href="#">\
                            <img style="margin: auto; width:70%; height:auto" src="'+PortfolioUrl()+'personaldata/Certificates/'+result['Certificate']+''+result['Extension']+'" class="rounded img-responsive preview-image" alt="John Doe">\
                        </a>\
                        <div class="thumb-info-title" style="background:rgba(112,128,144,0.9)">\
                        <span class="thumb-info-inner">'+result['Title']+'</span>\
                        <span class="thumb-info-type">'+result['Date']+'</span>\
                    </div>\
                </div>\
            </td>\
            <td style="vertical-align: middle;">\
                <button class="btn btn-sm btn-default" onclick="INIT_CertRemoval('+result['ID']+')" type="button">\
                    <span>Remove</span>\
                </button>\
            </td>\
        </tr>\
        ';

    });
    setTimeout(function() {
        target_mngr.html($manager_list).fadeIn('slow');
    }, 500);
}
function portfolio_message_handler(settings){

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
function INIT_CertRemoval(id){

    if(confirm('Are you sure you want to remove Certificate?')) {

        removestatus = remove_cert(id);
        removestatus.done(function(response){
            
            inquiry = {
                'Search':$("#cert_manager_search").val(),
                'Limit':0
            }
            
            //Get Certificate List
            data = get_certificate_list(inquiry);
            data.done(function(certdata){
        
                //Refresh Cert Manager
                data = get_certificate_list(inquiry);
                data.done(function(certdata){
            
                    CertData = JSON.parse(certdata);
                    manager_certificates(CertData);


                    //Refresh Cert Summary
                    inquiry = {
                        'Search':'',
                        'Limit':5
                    }
                    data = get_certificate_list(inquiry);
                    data.done(function(certdata){

                        display_certificates(CertData);

                    });
            
            
                });


            });    

        });

        alert('Successfully Removed!');


    } else {

        return;
    }
}
function remove_cert(id){

        return $.ajax({
            url: PortfolioUrl()+'index.php/Portfolio/remove_certificate',
            type: 'GET',
            data: {
                'ID':id
            }
        });

}