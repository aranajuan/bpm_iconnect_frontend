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
    $formel=  make_arrayobj($form["element"]);
    
    
    $fm = new formmaker("actionform");
    $fm->load_vector($formel);
    $html = $fm->get_html();
    $html.="<input type=\"button\" class=\"button\" value=\"GUARDAR\" onclick=\"go('" . $XML->get_paramSent("action") . "')\"  />";
    return array("type" => "array", "result" => "ok", "html" => $html);
}
