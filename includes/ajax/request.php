<?php
include "classes/xmlhandler.php";
$params=$R->get_allparams();
$XML = new XmlHandler();
$XML->load_params($U, $class, $method,$params);
if($XML->send_request()){
    echo "<pre>".print_r($XML->get_respose("data"),true)."</pre>";
}else{
    echo "Error::".$XML->get_error();
}
