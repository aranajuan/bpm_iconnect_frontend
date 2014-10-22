<?php
include "classes/xmlhandler.php";
$params=$R->get_allparams();
$XML = new XmlHandler();
$XML->load_params($U, $class, $method,$params);
if($XML->send_request()){
    include 'handlers/'.$class."/".$method.".php";
    echo GO($XML);
    
}else{
    echo "Error::".$XML->get_error();
}
