<?
include("../../../init.php");
require_once 'clases/user.php';

$l= $GLOBALS[UL];
$file=$_POST['file'];
if(!strpos("-".$file,(string)$l->get_prop("id"))){
    echo "Error, archivo invalido";
    exit();
}
error_reporting(E_ALL);
if(file_exists(FILEUP_TMP_FOLDER."/".$file)){
    unlink(FILEUP_TMP_FOLDER."/".$file);
}
if(file_exists(FILEUP_TMP_FOLDER_THUMB."/".$file)){
    unlink(FILEUP_TMP_FOLDER_THUMB."/".$file);
}
echo "fin";
?>