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

    $arr = $XML->get_response("tree");
    //return array("type" => "html", "html" => "<pre>".print_r($arr,true)."</pre>", "status" => "error");
    if (isset($arr["previous"]["option"])) {
        $prev = make_arrayobj($arr["previous"]["option"]);

        $html = "";
        $histHTML = "";
        foreach ($prev as $q) {

            $histHTML.="<div class=\"history\"><b>" . $q["question"] . ":</b>&nbsp;" . $q["ans"] . "</div>";
        }

        $html.= filter_bar(
                "<div ><img src=\"img/icon.png \" style=\"vertical-align:middle\"/><span>RESPUESTAS PREVIAS</span></div> 
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


    if ($arr["previous"]["back"] != "none") {
        $backbutton = option_button("VOLVER", 450, 1, "load_tree('" . $arr["previous"]["back"] . "');") . "</br>";
    }


    if (isset($arr["opendata"])) {
        if (isset($arr["opendata"]["msj"])) {
            $html.=$arr["opendata"]["msj"];
            $openBT = option_button("ABRIR", 450, 0, "go('" . $arr["previous"]["actual"] . "');");
        } else {
            $fm = new formmaker("actionform");
            $arrForm= make_arrayobj($arr["opendata"]["itform"]["element"]);
            /*Agregar idmaster si es posible anexar*/
            if($arr["join"]=='true'){
                $masterEl = array("type"=>"hidden","id"=>"idmaster","notsave"=>"true");
                array_push($arrForm,$masterEl);
                $openBT = option_button("ABRIR", 450, 0, "get_similar('" . $arr["previous"]["actual"] . "');");
            }else{
               $openBT = option_button("ABRIR", 450, 0, "go('" . $arr["previous"]["actual"] . "');");
            }
            $fm->load_vector($arrForm);
            $html.=$fm->get_html();
        }
        $html.="<br/></br>";
        $html.="<br/><div id=\"msj_master\" style=\"color:red;\"></div></br>";
        $html.="<br/><div id=\"ejecutando_accion\"></div>";
        $html.= $openBT. "</br>";
        $html.=$backbutton;
    } else {
        $html.="<div style=\"width:55%;float:left;\">";
        $options = make_arrayobj($arr["options"]["option"]);

        $html.= "<div ><img src=\"img/icon.png \" style=\"vertical-align:middle\"/><span>".mb_strtoupper($arr["question"]["title"],'utf-8')."</span></div>";

        $html.="<br/></br>";

        if (!isset($arr["options"]["option"])) {
            $html .= "No se encontraron opciones disponibles.<br/><br/>";
        } else {
            foreach ($options as $o) {
                if($o["isnew"]==true){
                    $html.=option_button($o["title"], 450, 0, "load_tree('" . $o["destiny"] . "');");
                    $html.="<img style=\"float:left;\" src=\"img/new.png\" width=25 height=25></br>";
                }else{
                    $html.=option_button($o["title"], 450, 0, "load_tree('" . $o["destiny"] . "');") . "</br>";
                }
            }
        }
        $html.=$backbutton;
        $html.="</div>";
        $html.="<div style=\"width:40%;float:right;font-size:14px;\">";
        $html.=$arr["question"]["detail"];
        $html.="</div>";
    }




    return array("type" => "html", "status" => "ok", "html" => $html);
}
