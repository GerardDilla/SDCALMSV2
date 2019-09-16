$(document).ready(function(){

    $('#AssessmentAttach').click(function(){
        show_assessment_attachment();
    });

    $('#Attachment_Queue').on('click','.removeattach', function(){
        $(this).parent('div').remove();
    });

    $('#assessment_attachment_picker').on('click', '.AssessmentPicker', function() {

        AssessmentCode = {
           'Code':$(this).attr('data-code'),
           'Name':$(this).attr('data-assessmentname'),
           'Instructor':$(this).attr('data-instructor')
        }
        select_assessment_attachment(AssessmentCode);

    });

})
function show_assessment_attachment(){
    
    assessmentdata = get_assessmentlist();
    assessmentdata.done(function(result){

        result = JSON.parse(result);
        display_assessmentlist(result);

    });
    $('#AssessmentAttachmentModal').modal('show');

}
function get_assessmentlist(){
    return $.ajax({
        url:base_url()+'index.php/Course/Ajax_get_assessments'
    });
}
function display_assessmentlist(data){

    target = $('#assessment_attachment_picker');
    target.fadeOut('fast');
    $list = '';
    $.each(data, function(index, result){
        $list += 
        '\
        <tr style="cursor:pointer" class="AssessmentPicker" data-code="'+result['AssessmentCode']+'" data-assessmentname="'+result['AssessmentName']+'" data-instructor="'+result['Instructor_Name']+'">\
            <th>'+result['Instructor_Name']+'</th>\
            <th>'+result['AssessmentName']+'</th>\
        </tr>\
        ';
    });
    setTimeout(function() {
        target.html($list).fadeIn('fast');
    }, 500);

}
function select_assessment_attachment(data){

    queue = $('#Attachment_Queue');
    queue.fadeOut('fast');
    $queuelist = 
        '\
        <div class="col-md-2 removable_attachment" style="text-align:center">\
            <button type="button" class="close removeattach" >&times;</button>\
            <h1><i class="fa fa-file-text-o"></i></h1>\
                <span><h3>'+data['Name']+'</h3></span>\
                <p>'+data['Instructor']+'</p>\
                <input type="hidden" name="AttachmentType[]" value="1">\
                <input type="hidden" name="AttachmentValue[]" value="'+data['Code']+'">\
            <hr>\
        </div>\
        ';
    setTimeout(function() {
        queue.append($queuelist).fadeIn('fast');
    }, 500);

}