<?php

$function = $R->get_param('function');
if ($function == "empty") {
    echo count($U->user_files());
    exit();
}
if ($function == "delete") {
    echo $U->delete_tmp($R->get_param('file'));
    exit();
}
if ($function == "clear_tmp") {
    $U->delete_file_tmp();
    echo "ok";
    exit();
}

require('UploadHandler.php');
$upload_handler = new UploadHandler();
