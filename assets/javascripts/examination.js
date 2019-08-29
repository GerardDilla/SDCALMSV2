$(document).ready(function(){
    timerstart();
    progresscheck();
});

//Progress checker triggers
$('.mult_question').click(function() {

    progresscheck();

});

$('.tofquestion').click(function() {

    progresscheck();
    
});

$('.taressayquestionget').keyup(function() {

    progresscheck();

});

$('.identificationquestion').keyup(function() {

    progresscheck();

});

function progresscheck(){

    radiocounter = 0;
    $("form#ExamForm :input[type='radio']:checked").each(function(){
        radiocounter++;
    });
    
    textarea_number = $('form#ExamForm textarea').filter(function() {               
        return $.trim( $(this).val());
    }).length;

    total = parseInt(radiocounter) + parseInt(textarea_number);
    console.log(radiocounter+':'+textarea_number);
    console.log(total);
    progressupdate(total);
    
}
function progressupdate(answers){

    //Compute percentage
    totalquestion = $('#totalquestions').val();
    percentage = parseInt(answers) / parseInt(totalquestion) * 100;

    progressbar = $('#ExamProgress');
    //progressbar.setAttribute('aria-valuenow',percentage);​
    progressbar.html(percentage+'%');
    progressbar.css("width", percentage+'%');
}
function timerstart(){

    timedata = $('#timerdisplay').data('timeleft');
    mins = Math.floor(timedata / 60);
    secs = timedata % 60;

    var timeleft = mins+':'+secs;
    console.log(timeleft);
    var interval = setInterval(function() {

        var timer = timeleft.split(':');
        //by parsing integer, I avoid all extra string processing
        var minutes = parseInt(timer[0], 10);
        var seconds = parseInt(timer[1], 10);
        --seconds;
        minutes = (seconds < 0) ? --minutes : minutes;
        if (minutes < 0) clearInterval(interval);
        seconds = (seconds < 0) ? 59 : seconds;
        seconds = (seconds < 10) ? '0' + seconds : seconds;
        //minutes = (minutes < 10) ?  minutes : minutes;
        $('#timerdisplay').html(minutes + ':' + seconds);
        timeleft = minutes + ':' + seconds;

        if(minutes <= 0){
            if(seconds <= 0){
                $('#ExamForm').submit(function( event ) {
                    alert('Assessment Time Expired!');
                });
                clearInterval(interval);
            }
        }
        
    }, 1000);
    //console.log(timeleft+':'+mins+':'+secs);
}


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
