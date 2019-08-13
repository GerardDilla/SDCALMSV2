
/* CERTIFICATE MANAGEMENT: START */
function display_image(file){
    imagelink = (window.URL ? URL : webkitURL).createObjectURL(file.files[0]);
    $('#cert_thumbnail')[0].src = imagelink;
    $('#cert_lightbox').attr("href", imagelink);
} 
//INIT: Save certificate upon form submit
$(document).ready(function(){

    $('#cert_form').submit(function(e){
    e.preventDefault(); 

        data = {
            'form':this,
            'base_url':$('.content-body').data("base_url")
        }
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
                $('#cert_thumbnail')[0].src = data['base_url']+'/assets/images/cert_icon.png';
                $('#cert_lightbox').attr("href", data['base_url']+'/assets/images/cert_icon.png');

                inquiry = {
                    'Search':'',
                    'Limit':5
                }

                //Get Certificate List
                CertList = get_certificate_list(inquiry,data['base_url']);
                CertList.done(function(certdata){

                    CertList = JSON.parse(certdata);
                    console.log(CertList);

                    target = $('#AchievementSummary');
                    display_certificates(CertList,target,data['base_url']);

                    //Display Message
                    config = {
                        'message':result['Message'],
                        'type':'success',
                        'object':'#certificate_message',
                    }
                    portfolio_message_handler(config);

                });

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
        base_url = $('.content-body').data("base_url");
      
        //Get Certificate List
        data = get_certificate_list(inquiry,base_url);
        data.done(function(certdata){
    
            CertData = JSON.parse(certdata);
            target = $('#cert_manager');
            display_certificates_manager(CertData,target,base_url);
    
    
        });
        

}
function cert_viewall(){

    inquiry = {
        'Search':'',
        'Limit':0
    }
    base_url = $('.content-body').data("base_url");
  
    open_cert_manager();
    //Get Certificate List
    data = get_certificate_list(inquiry,base_url);
    data.done(function(certdata){

        CertData = JSON.parse(certdata);
        console.log(CertData);


        target = $('#cert_manager');
        display_certificates_manager(CertData,target,base_url);


    });

}
function open_cert_manager(){

    $.magnificPopup.open({

        items: {
            src: '#Certmanage'
        },
        type: 'inline',

		fixedContentPos: true,
		fixedBgPos: true,

		overflowY: 'auto',

		closeBtnInside: true,
		preloader: false,
		
		midClick: true,
		removalDelay: 300,
		mainClass: 'my-mfp-slide-bottom',
        modal: true,
        callbacks: {

            open: function() {
                
                $('#cert_manager_search').focus();
                document.getElementById('cert_manager_search').click();

                $('#cert_manager_search').keypress(function(event){
                    var keycode = (event.keyCode ? event.keyCode : event.which);
                    if(keycode == '13'){
                        search_cert();
                    }
                });
                
            }
        }
        
    });


}
function get_certificate_list(inquiry,base_url){

    return $.ajax({
        url: base_url+'index.php/Portfolio/Ajax_GetCertNumber',
        type: 'GET',
        data: inquiry
    });

}
function display_certificates(data,target,base_url){

    console.log('display_certificates'+target);
    target.fadeOut('slow');
    $list = '';
    $.each(data, function(index, result){

        $list += 
        '\
        <li>\
            <div class="post-image">\
                <div class="img-thumbnail cert_thumbnail">\
                    <a class="lightbox" target="_blank" href="'+base_url+'personaldata/Certificates/'+result['Certificate']+''+result['Extension']+'" data-plugin-options=\{ "type":"image" }\'>\
                        <img class="cert_img" src="'+base_url+'personaldata/Certificates/'+result['Certificate']+''+result['Extension']+'" alt="">\
                    </a>\
                </div>\
            </div>\
            <div class="post-info">\
                <a style="text-transform: uppercase; font-weight: bold; color:green" class="lightbox" href="'+base_url+'personaldata/Certificates/'+result['Certificate']+''+result['Extension']+'" data-plugin-options=\'{ "type":"image" }\'>'+result['Title']+'</a>\
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
function display_certificates_manager(data,target_mngr,base_url){

    console.log('display_certificates'+target_mngr);
    target_mngr.fadeOut('slow');
    $list = '';
    $.each(data, function(index, result){

        $list += 
        '\
        <tr>\
            <td>\
                <div class="thumb-info mb-md" style="text-align:center">\
                        <a target="_blank" href="'+base_url+'personaldata/Certificates/'+result['Certificate']+''+result['Extension']+'">\
                            <img style="margin: auto; width:70%; height:auto" src="'+base_url+'personaldata/Certificates/'+result['Certificate']+''+result['Extension']+'" class="rounded img-responsive" alt="John Doe">\
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
        target_mngr.html($list).fadeIn('slow');
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

        base_url = $('.content-body').data("base_url");

        removestatus = remove_cert(id,base_url);
        removestatus.done(function(response){
            
            inquiry = {
                'Search':$("#cert_manager_search").val(),
                'Limit':0
            }
            
            //Get Certificate List
            data = get_certificate_list(inquiry,base_url);
            data.done(function(certdata){
        
                //Refresh Cert Manager
                CertData = JSON.parse(certdata);
                target = $('tbody#cert_manager');
                console.log(target);
                //display_certificates_manager(CertData,target,base_url);
                cert_viewall();


                target = $('ul#AchievementSummary');
                refresh_cert_summary(target,base_url);
        
            });

            

        });


        alert('Successfully Removed!');


    } else {

        return;
    }
}
function remove_cert(id,base_url){

        return $.ajax({
            url: base_url+'index.php/Portfolio/remove_certificate',
            type: 'GET',
            data: {
                'ID':id
            }
        });

}
function refresh_cert_summary(target,base_url){


    //Refresh Cert View
    inquiry = {
        'Search':'',
        'Limit':5
    }
    refresh = get_certificate_list(inquiry,base_url);
    refresh.done(function(refreshlist){

        refreshdata = JSON.parse(refreshlist);
        display_certificates(refreshdata,target,base_url);

    });

}