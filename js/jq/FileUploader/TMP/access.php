<?php

function check(){
    global $file;
    $FV = explode ("_",$file);
    if((string)$GLOBALS[UL]->get_prop("id")==$FV[0])
        return true;
    else
        return false;
}

?>
