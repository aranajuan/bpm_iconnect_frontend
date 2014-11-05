<?php
include "handler_functions.php";
include "classes/xmlhandler.php";
$params = $R->get_allparams();
$XML = new XmlHandler();
$XML->load_params($U, $class, $method, $params);
$XML->send_request();
include 'handlers/' . $class . "/" . $method . ".php";
//return print_r($XML->get_respose("list"),true);
$result = GO($XML);
if($result["type"]=="array"){
    return json_encode($result);
}elseif($result["type"]=="html"){
    return json_encode($result);
}