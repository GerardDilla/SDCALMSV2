$(document).ready(function(){

    
    console.log('File manager API running...');

    getfolders();

    $('.side-folders').on('click','li', function(){
        
        open_folder(this);

    });

    

});
function open_folder(obj){

    alert($(obj).data('folder-id'));

    $('.folder-directory').html($(obj).data('folder-name')).fadeIn('fast');
    folder_id = $(obj).data('folder-id');
    //alert('Getting File: init');


    filesdatavar = filesdata(folder_id);
    filesdatavar.done(function(result){

        //alert('Getting File: Done');

        result = JSON.parse(result);
        $('.storage-files').fadeOut('fast').html('');
        $.each(result['data'], function(index,filedata){

            //console.log(filedata);
            fileoutput = get_file_output(filedata);
            fileoutput.done(function(output){

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
                    $('<div>').attr({'class':'item-options'}).append(
                        $('<a>').attr({'href':'#'}).append(
                            $('<i>').attr({'class':'fa fa-edit'})
                        )
                    ).append(
                        $('<a>').attr({'href':'#','class':'text-danger'}).append(
                            $('<i>').attr({'class':'fa fa-times'})
                        )
                    )
                )
            ).fadeIn('fast');

        });
        console.log(result);
    });
    
}
function getfiles(){



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