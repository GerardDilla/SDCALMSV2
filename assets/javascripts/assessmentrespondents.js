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

    $('.print-summary').click(function(){

        print_summary();
        
    });

    $('#pass_select').change(function(){

        search_respondents();
        
    });
   
});
$(document).ajaxStop(function() {

    if ( ! $.fn.DataTable.isDataTable( '#respondent_table' ) ) {
        $('#respondent_table').DataTable({
            "ordering": false,
            "columnDefs": [
                { "width": "200px"}
            ],
            dom: 'Bfrtip',
            buttons: [
                'pdf'
            ]
        });
    }
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

        search_filter['Passing'] = $('#pass_select').val();
        respondent_list = get_respondent_list(search_filter);
        respondent_list.done(function(result){
            
            result = JSON.parse(result);
            if(result){
                
                //$('.passing-chart').data('easyPieChart').update(0);
                count = 0;
                tablecontainer = $('#respondent_table tbody');
                tablecontainer.html('').fadeIn('slow');

                //Display results
                $.each(result,function(i,panel){

                    
                    if(i != 'TotalPassers' && i != 'TotalFailed'){
                        count = parseInt(i) + 1;
                        tablecontainer.
                        append(
                            $('<tr>')
                            .attr({'class':'tr_inspect_student inspect_td_'+i,'style':'cursor:pointer','data-assessmentcode':panel['AssessmentCode'],'data-student-number':panel['Student_Number']})
                            //.append($('<td>').text(count))
                            .append($('<td>').text(panel['Student_Number']))
                            .append($('<td>').text(panel['RespondentName']))
                            .append($('<td>').text(panel['Section']))
                            .append($('<td>').text(panel['Score']))
                            .append($('<td>').text(panel['Remarks']))
                            .fadeIn('slow')
                        );
                        $.each(panel['Outcomedata'],function(index,outcomerow){

                            $('.inspect_td_'+i).append($('<td>').text(outcomerow));

                        });

                    }

                });

                //Starts Pie Chart
                var pie = $('#pie_outcome');
                var pie_overallchart = new Chart(pie, {
                    type: 'doughnut',
                    data: {

                        datasets: [{
                            data: [],
                            backgroundColor: []
                        }],
                        labels: [
                        ]

                    },
                    options: {
                    }
                });

                //Starts Bar Graph
                var ctx = $('#outcome_report');
                var overallchart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        //labels: ['', '', '', '', '', '', '', '', '', '', ''],
                        labels: [],
                        datasets: [
                            {
                                label: 'Passed',
                                //data: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
                                data: [],
                                backgroundColor: ['rgba(1, 128, 0, 1)'],
                                borderColor: [],
                                borderWidth: 1,
                            },
                            {
                                label: 'Fail',
                                //data: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
                                data: [],
                                backgroundColor: ['rgba(255, 0, 0, 1)'],
                                borderColor: [],
                                borderWidth: 1,
                            }
                        ]
                    },
                    options: {
                        legend: {
                            display: false
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

                outcomelist = get_outcome_list({'AssessmentCode':$('.assessment-info').data('assessment-code')});
                outcomelist.done(function(outcomedata){
                    
                    outcome_breakdown = $('.outcome-breakdown');
                    outcome_breakdown.html('');
                    outcomedata = JSON.parse(outcomedata);
                    //overallchart.data.datasets[0].data[0] = '25';
                    //overallchart.data.datasets[1].data[0] = '50';
                    count = 0;
                    total_passers = 0;
                    total_failing = 0;
                    $.each(outcomedata,function(index,outcome){

                        overallchart.data.labels.push(outcome['Outcome']);
                        outcome_breakdown.append(
                            $('<div>').attr({'class':'col-md-4 outcome-break-'+index,'style':'padding:10px'}).append(
                                $('<span>').attr({'class':'highlight'}).text(outcome['Outcome'])
                            ).append($('<br>'))
                        );
                        overall = get_overall_outcome_list({
                            'AssessmentCode':$('.assessment-info').data('assessment-code'),
                            'Outcome':outcome['Outcome'],
                            'Passing':$('#pass_select').val()
                        });
                        overall.done(function(overall_result){

                            overall_result = JSON.parse(overall_result);
                            ///overallchart.data.datasets[index].data[0] = overall_result['Total'];
                            overallchart.data.datasets[1].data[index] = overall_result['Passing'];
                            overallchart.data.datasets[1].backgroundColor[index] = 'rgba(255, 0, 0, 1)';

                            overallchart.data.datasets[0].data[index] = overall_result['Fail'];
                            overallchart.data.datasets[0].backgroundColor[index] = 'rgba(1, 128, 0, 1)';
                            
                            overallchart.update();
                            console.log(index+': '+overall_result['Total']);
                            total_passers = total_passers + overall_result['Passing'];
                            total_failing = total_failing + overall_result['Fail'];
                            console.log('totalpass:'+total_passers+': totalfail'+total_failing);


                            
                            outcome_breakdown_msg = '';
                            if(overall_result['Passing'] < search_filter['Passing']){
                                outcome_breakdown_msg = 'Needs better understanding towards the skill.';
                            }
                            if(overall_result['Passing'] > search_filter['Passing'] && overall_result['Passing'] < (search_filter['Passing'] + 20)){

                                outcome_breakdown_msg = 'Has good undestanding of the skill.';

                            }
                            if(overall_result['Passing'] > search_filter['Passing']){

                                outcome_breakdown_msg = 'Acquires exemplary knowledge towards the skill';

                            }
                            $('.outcome-break-'+index).append(outcome_breakdown_msg);
                            
                        });

                        count++;
                         
                        
                    });
                    
                    

                });


                //Updates Doughnut chart
                pie_overallchart.data.labels.push('Passed');
                pie_overallchart.data.labels.push('Fail');
                pie_overallchart.data.datasets[0].data[0] = result['TotalPassers'];
                pie_overallchart.data.datasets[0].data[1] = result['TotalFailed'];
                pie_overallchart.data.datasets[0].backgroundColor[0] = 'rgba(1, 128, 0, 1)';
                pie_overallchart.data.datasets[0].backgroundColor[1] = 'rgba(255, 0, 0, 1)';
                pie_overallchart.update();



                /*
                    outcomelist = get_outcome_list({'AssessmentCode':$('.assessment-info').data('assessment-code')});
                    outcomelist.done(function(outcomedata){

                        

                        outcome_breakdown = $('.outcome-breakdown');
                        outcome_breakdown.html('');

                        outcomedata = JSON.parse(outcomedata);

                        overallchart.data.datasets[0].data[100] = outcomedata.length;

                        $.each(outcomedata,function(index,outcome){
                            console.log(index+'test');
                            barcolor = 'rgba(0, 0, 0, 0)';
                            overallchart.data.labels.push(outcome['Outcome']);
                            pie_overallchart.data.labels.push(outcome['Outcome']);


                            outcome_breakdown.append(
                                $('<div>').attr({'class':'col-md-4 outcome-break-'+index,'style':'padding:10px'}).append(
                                    $('<span>').attr({'class':'highlight'}).text(outcome['Outcome'])
                                ).append($('<br>'))
                            );

                            overallchart.update();

                            overall = get_overall_outcome_list({
                                'AssessmentCode':$('.assessment-info').data('assessment-code'),
                                'Outcome':outcome['Outcome']
                            });
                            overall.done(function(overall_result){
                                overall_result = JSON.parse(overall_result);
                                console.log(overall_result);
                                overallchart.data.datasets[0].data[index] = overall_result;
                                pie_overallchart.data.datasets[1].data[index] = overall_result;

                                outcome_breakdown_msg = '';
                                if(overall_result < 70){
                                    outcome_breakdown_msg = 'Needs better understanding towards the skill.';
                                }
                                if(overall_result > 70 && overall_result < 80){

                                    outcome_breakdown_msg = 'Has good undestanding of the skill.';

                                }
                                if(overall_result > 80){

                                    outcome_breakdown_msg = 'Acquires exemplary knowledge towards the skill';

                                }
                                $('.outcome-break-'+index).append(outcome_breakdown_msg);

                                if(overall_result >= 70 && overall_result < 100){

                                    //Orange
                                    barcolor = 'rgba(255, 165, 0, 1)';

                                }
                                else if(overall_result >= 100){

                                    //Green
                                    barcolor = 'rgba(124,252,0, 1)';

                                }
                                if(overall_result < 70){

                                    //Red
                                    barcolor = 'rgba(255, 0, 0, 1)';

                                }
                                overallchart.data.datasets[0].backgroundColor[index] = barcolor;
                                overallchart.update();
                                
                            });


                        });

                    });
                */


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
                labels: ['0%', '10%', '20%', '30%', '40%', '50%', '60%', '70%', '80%', '90%', '100%'],
                datasets: [{
                    label: '',
                    data: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
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

        search_filter = {
            'AssessmentCode':$('.assessment-info').data('assessment-code'),
            'Outcome':$(obj).data('outcome-name'),
            'Student_Number':'',
        };
        outcomedata = get_outcome_result(search_filter);
        outcomedata.done(function(data){
        barcolor = 'rgba(0, 0, 0)';     
            if(data){
                data = JSON.parse(data);
                $.each(data,function(i,row){
    
                    console.log(i+':'+row);
                    chartindex = convert_percentage_param(i);
                    myChart.data.datasets[0].data[chartindex] = row;
                    
                    if(row <= 5){

                        //Red
                        barcolor = 'rgba(255, 0, 0, 1)';

                    }
                    if(row > 5 && row < 15){

                        
                        //Orange
                        barcolor = 'rgba(255, 165, 0, 1)';

                    }
                    if(row > 15){

                       //Green
                       barcolor = 'rgba(0, 128, 0, 1)';

                    }
                    myChart.data.datasets[0].backgroundColor[chartindex] = barcolor;
                    myChart.update();
                    
                });
            }


        });
           

    $('#Outcome_indiv_result').modal('show');
}
function convert_percentage_param(i = ''){

    if(i == 0){
        return 0
    }
    if(i == 10){
        return 1
    }
    if(i == 20){
        return 2
    }
    if(i == 30){
        return 3
    }
    if(i == 40){
        return 4
    }
    if(i == 50){
        return 5
    }
    if(i == 60){
        return 6
    }
    if(i == 70){
        return 7
    }
    if(i == 80){
        return 8
    }
    if(i == 90){
        return 9
    }
    if(i == 100){
        return 10
    }

}
function get_outcome_result(search_filter){

    return $.ajax({
        url: base_url()+'index.php/Assessment/Ajax_outcome_data',
        type: 'GET',
        data: search_filter
    });

}
function get_outcome_list(search_filter){

    return $.ajax({
        url: base_url()+'index.php/Assessment/Ajax_outcome_list',
        type: 'GET',
        data: search_filter
    });

}
function get_overall_outcome_list(search_filter){

    return $.ajax({
        url: base_url()+'index.php/Assessment/Ajax_outcome_overall',
        type: 'GET',
        data: search_filter
    });

}
function print_summary(){

    $("html, body").animate({ scrollTop: 0 }, "fast",function(){

        html2canvas(document.querySelector("#summary-report")).then(canvas => {
            //document.body.appendChild(canvas);

            let windowContent = '<!DOCTYPE html>';
            windowContent += '<html>';
            windowContent += '<head>';
            windowContent += '<title>Print Assessment Summary</title>';
            windowContent += '</head>';
            windowContent += '<body>';
            //windowContent += '<body onafterprint="assessment_form_log(&apos;'+ref+'&apos;,&apos;'+sy+'&apos;,&apos;'+sm+')">';
            windowContent += '<img src="' + canvas.toDataURL() + '">';
            windowContent += '</body>';
            windowContent += '</html>';
            
            const printWin = window.open('', '', 'width=' + screen.availWidth + ',height=' + screen.availHeight);
            printWin.document.open();
            printWin.document.write(windowContent); 
            
            printWin.document.addEventListener('load', function() {
                printWin.focus();
                printWin.print();
                printWin.document.close();
                printWin.close();        
            }, true);
        });
        

    });


}

