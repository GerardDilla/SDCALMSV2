$(document).ready(function(){
    

    question_toggle(1);
    $('.assessment_required_input').keyup(function(){
        assessment_input_checker();
    });

    $('.add_question_button').click(function(){
        display_question();
    });
    
});
function assessment_input_checker(){

    inputerror = 0;
    $('.assessment_required_input').each(function(i, obj) {
        
        console.log(i+':'+$(obj).val());
        if($(obj).val() == '' || $(obj).val() == null){
            inputerror = 1;
        }

    });
    if(inputerror == 0){
        question_toggle();
    }else{
        
        question_toggle(1);
    }

}
function display_question(){

    questionformat = get_question_format();
    questionformat.done(function(output){
        $('.QuestionsPanel').append(output).fadeIn('fast');
    });
}
function get_question_format(){

        return $.ajax({
            url: base_url()+'index.php/AssessmentBuilder/Ajax_GetQuestion',
            type: 'post',
            data: {
                'Type':1
            }
        });

}
function question_toggle(command = 0){
    if(command == 1){
        $('.question_adder :input').attr('disabled',true);
    }else{
        $('.question_adder :input').attr('disabled',false);
    }
}
function assessmenbuilder_message_handler(msg = ''){
    target = $('#question_manager_message');
    format = '\
        <div class="alert alert-success">\
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>\
            '+msg+'\
        </div>\
    ';
    target.html(format).fadeIn('fast');
}
