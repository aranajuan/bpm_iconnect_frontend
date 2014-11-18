<?php

require_once 'classes/formmaker.php';

/**
 * Ejecuta accion solicitada
 * @param XmlHandler $XML
 * @return array {type,result,trycount,detail} //en error
 * @return array {type,result}
 */
function GO($XML, $output = "html") {
    if ($XML->get_error()) {
        return array("type" => "html", "html" => $XML->get_error(), "status" => "error");
    }

    if ($output != "html") {
        return array("type" => "html", "html" => "Formato no soportado.", "status" => "error");
    }

    $form = $XML->get_response("itform");
    $fm = new formmaker("actionform");
    $fm->load_vector($form);
    $html=$fm->get_html();

    return array("type" => "array", "result" => "ok", "html" => $html);
}