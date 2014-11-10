<?php

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

    $arr = $XML->get_respose("tree");

    if (isset($arr["previous"]["OPTION"])) {
        $prev = make_arrayobj($arr["previous"]["OPTION"]);

        $html = "";
        $histHTML = "";
        foreach ($prev as $q) {

            $histHTML.="<div class=\"history\"><b>" . $q["question"] . ":</b>&nbsp;" . $q["ans"] . "</div>";
        }

        $html.= filter_bar(
                "<img src=\"img/icon.png \" width=\"15\" height=\"15\" /> 
            RESPUESTAS PREVIAS 
            <br/><div style='padding-left:40px;padding-top:6px;'>
            $histHTML
            </div>", "width:80%;");
    } else {
        $html.= filter_bar(
                "<img src=\"img/icon.png \" width=\"15\" height=\"15\" /> 
            CREAR NUEVA GESTION 
            <br/><div style='padding-left:40px;padding-top:6px;'>
            Siga los pasos a continuaci&oacute;n seleccionando las opciones para generar su gesti&oacute;n.
            </div>", "width:80%;");
    }

    $html .= "<br/>";

    $html.="<div style=\"width:40%;float:left;\">";
    $options = make_arrayobj($arr["options"]["OPTION"]);

    $html.= "<img src=\"img/icon.png \" width=\"15\" height=\"15\" />" . strtoupper($arr["question"]["title"]);

    $html.="<br/></br>";

    if (!isset($arr["options"]["OPTION"])) {
        $html .= "No se encontraron opciones disponibles.<br/><br/>";
    } else {
        foreach ($options as $o) {
            $html.=option_button($o["title"], 450, 0, "load_tree('" . $o["destiny"] . "');") . "</br>";
        }
    }
    if ($arr["question"]["back"] != "none") {
        $html.= option_button("VOLVER", 450, 1, "load_tree('" . $arr["back"] . "');") . "</br>";
    }
    $html.="</div>";
    $html.="<div style=\"width:40%;float:right;\">";
    $html.=$arr["question"]["detail"];
    $html.="</div>";
    
    return array("type" => "array", "result" => "ok", "html" => $html);
}