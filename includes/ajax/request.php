<?php

include "classes/xmlhandler.php";
$params = $R->get_allparams();
$XML = new XmlHandler();
$XML->load_params($U, $class, $method, $params);
$XML->send_request();
include 'handlers/' . $class . "/" . $method . ".php";
$result = GO($XML);
if($result["type"]=="array"){
    echo json_encode($result);
}elseif($result["type"]=="html"){
    echo $result["html"];
}