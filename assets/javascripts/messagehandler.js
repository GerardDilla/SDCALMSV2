$(document).ready(function(){
    

    question_toggle(1);

    $('.assessment_required_input').keyup(function(){
        assessment_input_checker();
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
function question_toggle(command = 0){
    if(command == 1){
        $('.question_adder :input').attr('disabled',true);
    }else{
        $('.question_adder :input').attr('disabled',false);
    }
    
}
