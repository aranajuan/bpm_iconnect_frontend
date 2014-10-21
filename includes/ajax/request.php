<?php
include "classes/xmlhandler.php";
$params=$R->get_allparams();

$XML = new XmlHandler();
$XML->load_params($U, $class, $method,$params);
echo $XML->send_request();
