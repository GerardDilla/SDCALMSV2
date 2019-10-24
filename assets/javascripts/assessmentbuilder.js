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

    $('.add-outcome').click(function(){

        AddOutcome();

    });
    
    $('.outcome-list').on('click','.remove-outcome',function(){

        RemoveOutcome(this);

    });

    $('.outcome-list').on('keyup','.outcome-input',function(){

        generate_outcome_dropdown();

    });

    
});
function AddOutcome(){

    object = $('.outcome-list');

    /*
    <div class="input-group mb-md">
        <input type="text" class="form-control" placeholder="Place Outcome here...">
        <span class="input-group-btn">
            <button class="btn btn-danger remove-outcome" type="button">Remove</button>
        </span>
    </div>
    */
    increment = $('.outcome-input').length;
    object.append(
        $('<div>').attr({'class':'input-group mb-md'}).append(
            $('<input>').attr({'type':'text','class':'form-control outcome-input','placeholder':'Place Outcome here...','name':'outcome[]','data-index':increment})
        ).append(
            $('<span>').attr({'class':'input-group-btn'}).append(
                $('<button>').attr({'class':'btn btn-danger remove-outcome','type':'button'}).text('Remove')
            )
        )
    );

    

}
function generate_outcome_dropdown(){

    if($('.outcome-input').length != 0){

        //<option selected value="0">No Outcomes Added</option>
        //Add default choice
        $('.outcome-dropdown').each(function(i,dropdown){

            //Gets index of existing answer before refreshing choices
            if($(dropdown).val() != ''){
                index = $('option:selected', dropdown).attr('data-outcome-index');
            }

            //Refreshes outcome choices
            $(dropdown).html('');
            $(dropdown).append(
                $('<option>').attr({'value':'0'}).text('No Outcome Chosen')
            );
            dropdownindex = $(dropdown).data('index');
            $('.outcome-input').each(function(i2,obj){
                //console.log($(obj).data('index')+' : '+$(obj).val());
                $(dropdown).append(
                    $('<option>').attr({'value':$(obj).val(),'data-outcome-index':i2}).text($(obj).val())
                );
            });

            //Reselect previous choice
            if(index != ''){
               
                $(dropdown).find('[data-outcome-index="'+index+'"]').attr('selected','selected');

            }



        });



    }

}
function RemoveOutcome(obj = ''){

    $(obj).parent().parent().remove();
    generate_outcome_dropdown();

}
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

        //Special condition for True of false choice questions
        if($(panel).data('question-type') == 'trueorfalse'){

            $(panel).find('.tof-choice').attr({'name':'Answer['+i+']','required':'required'});

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
        
        }else{
            $('.rubrics_criteria_option').html(
                $('<option>').attr({'value':'0'}).text('No Rubrics selected')
            )
        }

        //console.log($(panel).data('question-type'));
    });

}
function display_question(QuestionData = {}){

    questionformat = get_question_format(QuestionData);
    questionformat.done(function(output){
        $('.QuestionsPanel').append(output).fadeIn('fast');
        QuestionNumbering();
        generate_outcome_dropdown();
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