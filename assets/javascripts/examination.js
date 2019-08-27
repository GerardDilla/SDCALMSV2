

$("form#ExamForm :input[type='radio']:checked").each(function(){
    console.log('test');
});
$("form#ExamForm textarea[value!='']").each(function(){
    console.log('testarea');
});

/*
function INIT_certewwsdfsfdsificate_save(data){

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
*/
