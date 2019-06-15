
function Init_API(url='',refnum='')
{   
    console.log(url);
    if(url == ''){
        console.log('You must provide the API URL');
        return;
    }
    if(refnum == ''){
        console.log('No Token found');
        return;
    }
    if($('#Grade_sy').val() == ''){
        console.log('You must provide School Year');
        return;
    }
    if($('#Grade_sem').val() == ''){
        console.log('You must provide Semester');
        return;
    }

    ajax = $.ajax({
        url: url,
        type: 'GET',
        data: {
            Reference_Number: refnum,
            School_Year: $('#Grade_sy').val(),
            Semester: $('#Grade_sem').val()
        },
        success: function(response){

            result = JSON.parse(response);
            if(length.result != 0){
                console.log(result);
            }else{
                alert(result['ErrorMessage']);
            }

        },
        fail: function(){

            alert('Error: request failed');
            return;

        }
    });
    
}
function trf_display(resultdata)
{   

    //Displays DATA
    //Displays Basic Info
    $('#trf_rn').html(resultdata['get_Advise'][0]['Reference_Number']);
    $('#trf_name').html(resultdata['get_Advise'][0]['First_Name']+' '+resultdata['get_Advise'][0]['Middle_Name'][0]+' '+resultdata['get_Advise'][0]['Last_Name']);
    $('#trf_address').html(
        resultdata['get_Advise'][0]['Address_No']+', '+
        resultdata['get_Advise'][0]['Address_Street']+', '+
        resultdata['get_Advise'][0]['Address_Subdivision']+', '+
        resultdata['get_Advise'][0]['Address_Barangay']+', '+
        resultdata['get_Advise'][0]['Address_City']+', '+
        resultdata['get_Advise'][0]['Address_Province']
    );
    $('#trf_sem').html(resultdata['get_Advise'][0]['Semester']);
    $('#trf_course').html(resultdata['get_Advise'][0]['Course']);
    $('#trf_sy').html(resultdata['get_Advise'][0]['School_Year']);
    $('#trf_yl').html(resultdata['get_Advise'][0]['Year_Level']);
    $('#trf_sec').html(resultdata['get_Advise'][0]['Section']);

    //Displays Payments
    $('#trf_tuition').html(resultdata['get_Advise'][0]['tuition_Fee']);
    $('#trf_misc').html(resultdata['get_miscfees'][0]['Fees_Amount']);
    
    $('#trf_other').html(resultdata['get_otherfees'][0]['Fees_Amount']);
    $('#trf_initial').html(resultdata['get_Advise'][0]['InitialPayment']);
    $('#trf_first').html(resultdata['get_Advise'][0]['First_Pay']);
    $('#trf_second').html(resultdata['get_Advise'][0]['Second_Pay']);
    $('#trf_third').html(resultdata['get_Advise'][0]['Third_Pay']);
    $('#trf_fourth').html(resultdata['get_Advise'][0]['Fourth_Pay']);
    $('#trf_scholar').html(resultdata['get_Advise'][0]['Scholarship']);
    $('#trf_scholar').html(resultdata['get_Advise'][0]['Scholarship']);
    //Lab Fees 
    /*
    labfee = 0;
    $.each(resultdata['get_labfees'], function(index, labresult) 
    {
        labfee = labfee + parseFloat(labresult['Lab_Fee']);  
    }); 
    */
    labfee = parseFloat(resultdata['get_labfees'][0]['Fees_Amount']);
    $('#trf_lab').html(labfee.toFixed(2));

    //Total Fees
    total_fees = parseFloat(resultdata['get_Advise'][0]['tuition_Fee']) + 
    parseFloat(resultdata['get_miscfees'][0]['Fees_Amount']) +
    labfee +
    parseFloat(resultdata['get_otherfees'][0]['Fees_Amount']);

    $('#trf_total_fees').html(total_fees.toFixed(2));

  
    //Displays Sched
    showtable = $('#temporary_regform_subjects');
    //clears the table before append
    showtable.html('');
    sched_checking = '';
    units = 0;
    subjectcount = 0;
    $.each(resultdata['get_Advise'], function(index, result) 
    {
        row = $("<tr/>");
        if(sched_checking != result['Sched_Code']){

            //Set custom attribute 'sched-code'
            units = units + (parseInt(result['Course_Lec_Unit']) + parseInt(result['Course_Lab_Unit']));
            subjectcount++;
            row.append($("<td/>").text(result['Sched_Code']).attr({valign:'top',width:'10%',style:'padding-right: 10px;  padding-top: 1px;'}));
            row.append($("<td/>").text(result['Course_Code']).attr({valign:'top',width:'10%',style:'padding-right: 10px;  padding-top: 1px;'}));
            row.append($("<td/>").text(result['Course_Title']).attr({valign:'top',width:'10%',style:'padding-right: 10px;  padding-top: 1px;'}));
            row.append($("<td/>").text(parseInt(result['Course_Lec_Unit']) + parseInt(result['Course_Lab_Unit'])).attr({valign:'top',width:'10%',style:'padding-right: 10px;  padding-top: 1px;'}));
            row.append($("<td/>").text(result['Day']).attr({valign:'top',width:'10%',style:'padding-right: 10px;  padding-top: 1px;', id:result['Sched_Code']+'_day'}));
            row.append($("<td/>").text(result['START']+' - '+result['END']).attr({valign:'top',width:'10%',style:'padding-right: 10px;  padding-top: 1px;', id:result['Sched_Code']+'_time'}));   
            row.append($("<td/>").text(result['Room']).attr({valign:'top',width:'10%',style:'padding-right: 10px;  padding-top: 1px;', id:result['Sched_Code']+'_room'}));
        
            
        }else{
            $('#'+result['Sched_Code']+'_day').append(' , '+result['Day']);
            $('#'+result['Sched_Code']+'_time').append(' , '+result['START']+' - '+result['END']);
            $('#'+result['Sched_Code']+'_room').append(' , '+result['Room']);
        }
        
        showtable.append(row);
        sched_checking = result['Sched_Code'];

    });

    //Total Units and Subjects
    $('#trf_total_units').html(units);
    $('#trf_total_subject').html(subjectcount);

    $('#regform').modal('show');

}