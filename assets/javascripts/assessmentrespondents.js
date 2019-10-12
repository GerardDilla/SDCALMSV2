$(document).ready(function(){

    search_handledsubjects();

    $('#ms_filter').change(function(){
        search_respondents();
    });

    $('#filter_button').click(function(){
        search_respondents();
    }); 

    $(document).keypress(function(event){
        var keycode = (event.keyCode ? event.keyCode : event.which);
        if(keycode == '13'){
            search_respondents();
        }
    });

    $('.class_filter').change(function(){
        search_handledsubjects();
    });

    $('#active-filter-panel').on('click','.active-filter',function(){
        $(this).parent().remove();
    });
   
});
function search_handledsubjects(){

    if($('#sy_filter').val() != '' || $('#sy_filter').val() != ''){

        search_filter = {
            'School_Year':$('#sy_filter').val(),
            'Semester':$('#sem_filter').val()
        };
        classdata = get_handledclass_list(search_filter);
        classdata.done(function(result){
            result = JSON.parse(result);
            if(result.length === 0){
                $('#class_filter_list').html('').fadeOut('fast');
                $('#class_filter_list').html(
                    $('<li>').text('You have no handled classes during this time.')
                ).fadeIn('fast');

            }else{

                $('#class_filter_list').html('').fadeOut('fast');
                $.each(result,function(i,cdata){
                    $('#class_filter_list').append(
                        $('<li>').append(
                            $('<div>').attr({'class':'checkbox-custom checkbox-default'}).append(
                                $('<input>').attr({'type':'checkbox','id':cdata['Sched_Code'],'class':'class_filter_check','Onclick':'ToggleFilter("'+cdata['Course_Code']+'","'+cdata['Sched_Code']+'")'})
                            ).append(
                                $('<label>').attr({'for':cdata['Sched_Code'],'class':'todo-label'}).append(
                                    $('<span>').text(cdata['Course_Code']+' : '+cdata['Sched_Code'])
                                )
                            )
                        )
                    ).fadeIn('fast');
                });

            }
            console.log(result);
        });
    }
}
function search_respondents(){


    //Gets filters
    filter_key = $('#filter_search').val();
    ms_filters = $('#ms_filter').val();
    a_code = $('.assessment-info').data('assessment-code');
    search_filter = {'SearchKey':filter_key,'AssessmentCode':a_code};
    console.log(filter_key+' : '+ms_filters);
    display_respondents(search_filter);

}
function display_respondents(search_filter){

        respondent_list = get_respondent_list(search_filter);
        respondent_list.done(function(result){
            result = JSON.parse(result);
            if(result){
                tablecontainer = $('#respondent_table tbody');
                tablecontainer.html('').fadeOut('fast');
                $.each(result,function(i,panel){

                    tablecontainer.
                    append(
                        $('<tr>')
                        .append($('<td>').text(i + 1))
                        .append($('<td>').text(panel['Student_Number']))
                        .append($('<td>').text(panel['RespondentName']))
                        .append($('<td>').text(panel['Score']))
                    ).fadeIn('fast');
                });
                

            }else{

                console.log('Error');

            }   
            /*
            $('#respondent_table').DataTable({
                responsive: true
            });
            */
        });

} 
function get_respondent_list(search_filter){

    return $.ajax({
        url: base_url()+'index.php/Assessment/Ajax_Respondent_List',
        type: 'GET',
        data: search_filter
    });

}
function get_handledclass_list(search_filter){

    return $.ajax({
        url: base_url()+'index.php/Assessment/Ajax_HandledSubjects',
        type: 'GET',
        data: search_filter
    });

}
function ToggleFilter(CourseCode,SchedCode){

    $('#checkArray:checkbox:checked').length != 0;
    console.log('--');
    $('.class_filter_check:checkbox:checked').each(function(){

        console.log($(this).attr('id'));
        if($('#addedfilters button[value="'+$(this).attr('id')+'"]').length == 0){
            $('#addedfilters').append(
                $('<span>').attr('style','padding-left:5px').append(
                    $('<button>').attr({'type':'button','class':'btn btn-sm btn-default active-filter','value':SchedCode}).text(CourseCode+' : '+SchedCode)
                ).fadeIn('fast')
            );
        }
    });



}
function RemoveFilter(){

}




