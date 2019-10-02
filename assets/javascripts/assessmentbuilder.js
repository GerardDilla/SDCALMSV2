$(document).ready(function(){
    
    question_toggle(1);
    assessment_input_checker();
    
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
        /*
        status = question_formchecker();
        if(status['Status'] == 1){
            console.log(status);
           
        }
        */
        $('#AssessmentForm').submit();
    });

    $('#rubrics_choice').change(function(){
        QuestionNumbering({'change':1});
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
function QuestionNumbering(settings = {}){
    
    $('.question-panel').each(function(i,panel){
        console.log(panel);

        //Number display for each question
        $(panel).find('.question-number span').html(i+1);

        //Special condition for multiple choice questions
        if($(panel).data('question-type') == 'multiplechoice'){

            $(panel).find('.question-choice').attr('name','choice['+i+'][]');

            $(panel).find('.question-tick').each(function(i3,tick){
                $(tick).find('input').attr({'name':'Answer['+i+']','id':i+'_correct_'+i3,'value':i3+1,'required':'required'});
                $(tick).find('label').attr({'for':i+'_correct_'+i3});
                console.log(tick);
            });
        }

        //Criteria assigning based on rubrics choice
        if($('#rubrics_choice').val() != 0){

            RubricsData = {'rubrics_id': $('#rubrics_choice').val()};
            rubricsdata = get_rubrics_data(RubricsData);
            rubricsdata.done(function(output){
        
                rubricresult = JSON.parse(output);

                if($(panel).find('.rubrics_criteria_option').val() == 0 || settings['change'] == 1){

                        $(panel).find('.rubrics_criteria_option').html(

                            $('<option>').attr({'selected':'selected', 'value':'0'})
                            .text('No Criteria Selected')
                            
                        );
                        $.each(rubricresult, function(i,rubdata){
    
                                $(panel).find('.rubrics_criteria_option').append(
    
                                    $('<option>').attr({'value':rubdata['criteria_id']})
                                    .text(rubdata['criteria'])
            
                                );
                            //<option selected value="0">No Rubrics Selected</option>
                        });
                }
                
                
            });
        
        }

        //console.log($(panel).data('question-type'));
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
function get_rubrics_data(RubricsData = {}){

    return $.ajax({
        url: base_url()+'index.php/AssessmentBuilder/Ajax_get_rubrics_criteria',
        type: 'post',
        data: RubricsData
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
function question_formchecker(){

    error = {'Status':1,'Message':{}};
    $('.question-panel').each(function(i,panel){

        //Number display for each question
        if($(panel).find('.question-input').val() == '' || $(panel).find('.question-input').val() == null){
            error['Status'] = 0;
            error['Message'][i] = 'You haven\'t provided a question for question #'+parseInt(i+1);
        }

        //Number display for each question
        console.log($(panel).find('input[name="Answer[]"]'));
        if($(panel).children('input[name="Answer['+i+']"]').val() == '' || $(panel).children('input[name="Answer['+i+']"]').val() == null){
            error['Status'] = 0;
            error['Message'][i] = 'You haven\'t provided an answer for question #'+parseInt(i+1);
        }

        //Number display for each question
        if($(panel).children('input[name="Points['+i+']"]').val() == '' || $(panel).children('input[name="Points['+i+']"]').val() == null){
            error['Status'] = 0;
            error['Message'][i] = 'You haven\'t provided points for question #'+parseInt(i+1);
        }

    });
    console.log(error);
    if(error['Status'] == 0){
        message = '';
        $.each(error['Message'],function(i,msg){
            message += msg+'<br>';
        });
        $('#assessment_message').html(
            $('<div>').attr({'class':'message_box'})
            .html(
                $('<div>').attr({'class':'alert alert-warning'})
                .html(
                    $('<button>').attr({'type':'button','class':'close','data-dismiss':'alert','aria-hidden':'true'}).text('x')
                )
                .append(message)
            )
        ).fadeIn('fast');
        /*
        <div class="message_box"><div class="alert alert-warning">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <?php echo $this->session->flashdata('message'); ?>
            </div>
        </div>
        */
    }else{
        $('#assessment_message').html('');
    }
    return error;

}