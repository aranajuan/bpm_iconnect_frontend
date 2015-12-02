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
    
    $actName = explode('-',$XML->get_paramSent("action"));
    $html='';
    $fm = new formmaker("actionform");
    $fm->load_vector($formel,array("tkt"=>array("id"=>$XML->get_paramSent("idtkt"))));
    $htmlForm = $fm->get_html();
    /**
     * Eliminado por REQuerimiento
    if($fm->isfileRequired() && count($actName)>2 && $actName[1]=='UPDATE'){
        $html .="<div style=\"width: 60%; border:2px solid; background-color: #ccffcc; padding: 4px;margin-top:5px;\">"
                . "No agregar adjuntos conservar&aacute; los actuales.<br/>"
                . "Si se agregan adjuntos remplazaran a todos los anteriores</div>";
    }
     * 
     */
    $html .= $htmlForm;
    $html.="<input type=\"button\" class=\"button\" value=\"GUARDAR\" onclick=\"go('" . $XML->get_paramSent("action") . "')\"  />";
    $html.="<div id=\"ejecutando_accion\"></div>";
    return array("type" => "array", "result" => "ok", "html" => $html);
}
