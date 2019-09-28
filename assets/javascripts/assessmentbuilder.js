$(document).ready(function(){
    
    question_toggle(1);
    $('.assessment_required_input').keyup(function(){
        assessment_input_checker();
    });

    $('.add_question_button').click(function(){

        QuestionData = {'Type': $('#QuestionType').val(), 'Points': $('#pointset').val()};
        display_question(QuestionData);

    });

    $('.QuestionsPanel').on('click','.remove_question_button',function(){
        remove_question(this);
    });

    $('.assessment-submit').click(function(){
        $('#AssessmentForm').submit();
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
function QuestionNumbering(){
    
    $('.question-panel').each(function(i,panel){
        
        $(panel).find('.question-number span').html(i+1);

        if($(panel).data('question-type') == 'multiplechoice'){

            $(panel).find('.question-choice').attr('name','choice['+i+'][]');

            $(panel).find('.question-tick').each(function(i3,tick){
                $(tick).find('input').attr({'name':'Answer['+i+']','id':i+'_correct_'+i3,'value':i3+1,'required':'required'});
                $(tick).find('label').attr({'for':i+'_correct_'+i3});
                console.log(tick);
            });

        }

        console.log($(panel).data('question-type'));
    });

}
function display_question(QuestionData = {}){

    questionformat = get_question_format(QuestionData);
    questionformat.done(function(output){
        $('.QuestionsPanel').append(output).fadeIn('fast');
        QuestionNumbering();
    });

}
function remove_question(obj){
    //alert('deleted');

    $(obj).closest('.question-panel').remove();
    QuestionNumbering();

}
function get_question_format(QuestionData = {}){

        return $.ajax({
            url: base_url()+'index.php/AssessmentBuilder/Ajax_GetQuestion',
            type: 'post',
            data: QuestionData
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
