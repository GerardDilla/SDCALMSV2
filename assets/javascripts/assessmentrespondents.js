$(document).ready(function(){

    search_handledsubjects();

    search_respondents();

    $('#remark_filters').change(function(){
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
        RemoveFilter(this);
        
    });

    $('.assessment-summary').click(function(){

        search_respondents();

    });

    $('#respondent_table').on('click','.tr_inspect_student',function(){

        console.log($(this).data('assessmentcode'));
        console.log($(this).data('student-number'));
        window.open(base_url()+'index.php/Assessment/AssessmentResults/'+$(this).data('assessmentcode')+'?Student_Number='+$(this).data('student-number'), '_blank');
    });

    $('.td-outcome').click(function(){

        outcome_result(this);

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
    remark_filters = $('#remark_filters').val();
    a_code = $('.assessment-info').data('assessment-code');
    course_filter = {};
    $('#active-filter-panel button').each(function(i,filtobj){
        course_filter[i] = $(filtobj).val();
    });
    console.log('filter--');
    console.log(course_filter);
    search_filter = {
        'SearchKey':filter_key,
        'AssessmentCode':a_code,
        'CourseFilter':course_filter,
        'RemarkFilter':remark_filters
    };
    console.log(filter_key+' : '+remark_filters);
    display_respondents(search_filter);

}
function display_respondents(search_filter){

        
        respondent_list = get_respondent_list(search_filter);
        respondent_list.done(function(result){
            
            result = JSON.parse(result);
            if(result){
                $('.passing-chart').data('easyPieChart').update(0);
                count = 0;
                tablecontainer = $('#respondent_table tbody');
                tablecontainer.html('').fadeIn('slow');
                $.each(result,function(i,panel){

                    
                    if(i != 'TotalPassers'){
                        count = parseInt(i) + 1;
                        tablecontainer.
                        append(
                            $('<tr>')
                            .attr({'class':'tr_inspect_student','style':'cursor:pointer','data-assessmentcode':panel['AssessmentCode'],'data-student-number':panel['Student_Number']})
                            .append($('<td>').text(count))
                            .append($('<td>').text(panel['Student_Number']))
                            .append($('<td>').text(panel['RespondentName']))
                            .append($('<td>').text(panel['Program']))
                            .append($('<td>').text(panel['Section']))
                            .append($('<td>').text(panel['Score']))
                            .append($('<td>').text(panel['Remarks']))
                            .fadeIn('slow')
                        );
                    }

                });
                $('#passers_count').html(result['TotalPassers'] ? result['TotalPassers'] : 0).fadeIn('fast');
                $('#respondent_count').html(count).fadeIn('fast');
                percentage = (parseInt(result['TotalPassers']) / +parseInt(count)) * 100;
                //alert(percentage);
                //$('.passing-chart').attr('data-percent',percentage);
               // $('.passing-chart-label').html(percentage);
                //chart.update(percentage);
                $('.passing-chart').data('easyPieChart').update(percentage ? percentage : 0);
            }else{

                console.log('Error');

            }   
            
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

    //$('#checkArray:checkbox:checked').length != 0;
    console.log('--');
    $('.class_filter_check:checkbox:checked').each(function(){

        console.log($(this).attr('id')+':add');
        if($('#active-filter-panel button[value="'+$(this).attr('id')+'"]').length == 0){
            $('#active-filter-panel').append(
                $('<span>').attr('style','padding-left:5px').append(
                    $('<button>').attr({'type':'button','class':'btn btn-sm btn-default active-filter','value':SchedCode}).text(CourseCode+' : '+SchedCode)
                ).fadeIn('fast')
            );
        }
    });
    $('.class_filter_check:checkbox:not(:checked)').each(function(){
        console.log($(this).attr('id')+':remove');
        $('#active-filter-panel button[value="'+$(this).attr('id')+'"]').parent().remove();
    });
    console.log('--');
    search_respondents();


}
function RemoveFilter(obj){

    $(obj).parent().remove();
    $('#'+$(obj).val()).prop('checked', false);

}
function outcome_result(obj){

    $('.outcome-title').html($(obj).data('outcome-name'));

        var ctx = $('#outcome_indiv_report');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [0, 10, 20, 30, 40, 50, 60, 70, 80, 90, 100],
                datasets: [{
                    //label: '# of Votes',
                    data: [0, 10, 50, 30, 40, 50, 60, 70, 80, 90, 100],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1,
                    
                }]
            },
            options: {
                title: {
                    display: true,
                    text: $(obj).data('outcome-name')
                },
                tooltips: {
                    mode: 'index',
                    intersect: false
                },
                responsive: true,
                scales: {
                    xAxes: [{
                        stacked: true,
                    }],
                    yAxes: [{
                        stacked: true
                    }]
                }
            }
        });

    $('#Outcome_indiv_result').modal('show');
}




