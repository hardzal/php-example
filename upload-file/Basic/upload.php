<?php

// defining a upload directory 
define('UPLOAD_DIRECTORY', "upload/");

// check if the file request is set
if(isset($_FILES)) {
    
    $file_name = $_FILES['file']['name'];
    $file_type = $_FILES['file']['type'];
    $file_size = $_FILES['file']['size'];
    $file_tmp  = $_FILES['file']['tmp_name'];

    // we are going to move file upload from user locations to our directory locations 
    $upload = move_uploaded_file($file_tmp, UPLOAD_DIRECTORY.$file_name);
    if($upload) {
        $message = "Success Uploaded a new file!";
    } else {
        $message = "Failed uploaded file, check script or file!";
    }

    echo $message." <a href='javascript:history.back()'>Kembali</a>";
} else {
    echo "<a href='javascript:history.back()'>Back!</a>";
}
?>
