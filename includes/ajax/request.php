<?php

include "handler_functions.php";
include "classes/xmlhandler.php";
$params = $R->get_allparams();
$XML = new XmlHandler();
$XML->load_params($U, $class, $method, $params);
$XML->send_request();
include 'handlers/' . $class . "/" . $method . ".php";
//return print_r($XML->get_response("list"),true);


if ($XML->get_paramSent("export") == "xls") {
    header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
    header("Content-Disposition: attachment; filename=abc.xls");
    header("Expires: 0");
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    header("Cache-Control: private", false);
    $result = GO($XML, "xls");
    return $result["html"];
} else {
    $result = GO($XML);
}

if ($result["type"] == "array") {
    return json_encode($result);
} elseif ($result["type"] == "html") {
    return json_encode($result);
} elseif ($result["type"] == "file") {
    return $result["file"];
} else {
    return "Tipo desconocido";
}