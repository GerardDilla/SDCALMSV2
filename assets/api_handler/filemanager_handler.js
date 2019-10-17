$(document).ready(function(){

    
    console.log('File manager API running...');

    getfolders();

    open_folder($('#parent-folder'));

    $('.side-folders').on('click','li', function(){
        open_folder(this);
    });

    $('#parent-folder').click(function(){
        open_folder(this);
    });

    $('.uploadbutton').click(function(){
        $('#UploadFileModal').modal('show');
    });

    $('#upload_form').submit(function(e){
        e.preventDefault(); 
        upload_init(this);
    });

    $('.storage-files').on('click','.delete_file', function(){
        if (confirm('Are you sure you want to delete?')) {

            //alert($(this).data('file-id'));
            delete_init(this);

        }else{

           return;

        }
    });


    

});
function open_folder(obj){

    //alert($(obj).data('folder-id'));

    $('.folder-directory').html($(obj).data('folder-name')).fadeIn('fast');
    folder_id = $(obj).data('folder-id');
    //alert('Getting File: init');
    $('.folder_id_upload').val($(obj).data('folder-id'));

    filesdatavar = filesdata(folder_id);
    filesdatavar.done(function(result){

        //alert('Getting File: Done');
        result = JSON.parse(result);
        $('.storage-files').fadeOut('fast').html('');
        $.each(result['data'], function(index,filedata){

            //console.log(filedata);
            fileoutput = get_file_output(filedata);
            fileoutput.done(function(output){

                //alert('Getting File: Done');
                    output = JSON.parse(output);
                    console.log(output);
                    //alert(output['data']);
                    $('.storage-files').fadeIn('fast').append(output['data']);


            });
           

        });

    });

    folder_id = '0';

}
function getfolders(){

   
    folderdata = folderdata();
    folderdata.done(function(result){
        result = JSON.parse(result);
        folders = result['data'];

        if(result['ResultCount'] == 0){
            return;
        }
        $('.side-folders').fadeOut('fast').html('');
        $.each(folders, function(index, result){

            // Output of below 
            /*
            <li>
                <a href="#" class="menu-item"><i class="fa fa-folder"></i> My Files</a>
                <div class="item-options">
                    <a href="#">
                        <i class="fa fa-edit"></i>
                    </a>
                    <a href="#" class="text-danger">
                        <i class="fa fa-times"></i>
                    </a>
                </div>
            </li>
            */
            // Output of below 

            console.log(result['FolderName']);
            $('.side-folders').append(
                $('<li>').attr({'data-folder-id':result['Folder_ID'],'data-folder-name':result['FolderName']})
                .append(
                    $('<a>').attr({'href':'#','class':'menu-item'}).append(
                        $('<i>').attr({'class':'fa fa-folder'})
                    ).append(result['FolderName'])
                ).append(
                    $('<div>').attr({'class':'item-options'})
                    /*
                    .append(
                        $('<a>').attr({'href':'#'}).append(
                            $('<i>').attr({'class':'fa fa-edit'})
                        ))
                    .append(
                        $('<a>').attr({'href':'#','class':'text-danger'}).append(
                            $('<i>').attr({'class':'fa fa-times'})
                        )
                    )
                    */
                )
            ).fadeIn('fast');

        });
        console.log(result);
    });
    
}
function folderdata(){

    return $.ajax({

        url: FileAPI_URL(),
        type: 'GET',
        data: {
            Command: 'getfolder',
            InstructorID: user_token()
        }

    });

}
function filesdata(folder_id = ''){

    return $.ajax({

        url: FileAPI_URL(),
        type: 'GET',
        data: {
            Command: 'getfiles',
            InstructorID: user_token(),
            Folder_ID:folder_id
        }
    });

}
function get_file_output(filedata){

    return $.ajax({
        url: FileAPI_URL(),
        type: 'GET', 
        data: {
            Command: 'get_file_output',
            File_ID:filedata['File_ID'],
            FileType:filedata['FileType'],
            InstructorID: user_token(),
        }
    });

}
function upload_init(obj){


    uploadstatus = upload_file(obj);
    uploadstatus.done(function(result){

        result = JSON.parse(result);
        if(result['Error'] == 0){
            $('#UploadFileModal').modal('hide');
            $("#UploadFile").val('');
            open_folder($('#parent-folder'));
        }else{
            alert(result['Message']);
        }

    });
}
function delete_init(obj){

    deletestatus = delete_file(obj);
    deletestatus.done(function(result){

        open_folder($('#parent-folder'));


    });

}
function delete_file(obj){

    return $.ajax({
        url: FileAPI_URL(),
        type: 'GET', 
        data: {
            Command: 'delete_file',
            File_ID:$(obj).data('file-id'),
            InstructorID: user_token(),
        }
    });

}
function upload_file(obj){

    
    return $.ajax({
        url: $(obj).attr('action'),
        type: $(obj).attr('method'),
        data:new FormData(obj),
        processData:false,
        contentType:false,
        cache:false,
        async:false,
    });

}