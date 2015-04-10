<?php

require_once 'classes/formmaker.php';
/**
 * Ejecuta accion solicitada
 * @param XmlHandler $XML
 * @param string    $output //html
 */
function GO($XML, $output = "html") {
    if ($XML->get_error()) {
        return array("type" => "html", "html" => $XML->get_error(), "status" => "error");
    }

    if ($output != "html") {
        return array("type" => "html", "html" => "Formato no soportado.", "status" => "error");
    }

    $list = $XML->get_response("list");
    if(!$list){
        return array("type" => "html", "status" => "ok", "html" => "sin_elementos");
    }
    $tkts = make_arrayobj($list["tkt"]);
    $tktsEL = array();
    $i=0;
    foreach ($tkts as $tkt) {
        $f = new formmaker();
        $resHTML = "";
        $f->load_vector(make_arrayobj($tkt["th"]["itform"]["element"]));
        $resHTML .= "<div style='border: 1px #444444 solid; background-color: #add8f2;float:left;cursor:pointer;margin:5px' onclick='$(\"input[value=".$tkt["id"]."]\").prop(\"checked\", true);'>";
        if($tkt["childsc"]>3){
            $img="postit_3.png";
        }elseif($tkt["childsc"]>=2){
            $img="postit_2.png";
        }else{
            $img="postit_1.png";
        }
        $resHTML .= "<img src=\"img/$img\" />";
        $resHTML .= "<input name=\"Sel_similar\" id=\"Sel_similar\" type=\"radio\" value=\"".$tkt["id"]."\"  />";
        $resHTML .= $tkt["id"]."(".$tkt["childsc"].")";
        $resHTML .="<div style=\"overflow: auto;height: 200px;width:195px;padding-top:3px\">";
        $resHTML .=$f->get_htmlview(array('text','link'),true);
        $resHTML .="</div>";
        $resHTML .= "</div>";
        $tktsEL[$i] = array("childs"=>$tkt["childsc"],"html"=>$resHTML);
        $i++;
        
    }
    
    function cmptmp($a,$b){
        return $a["childs"]< $b["childs"];
    }
    
    uasort($tktsEL, 'cmptmp');

    $html="";
    foreach($tktsEL as $t){
        
        $html .=$t["html"];
        
    }
    $html .= "
    <div style=\"width:625px;float:none;clear: both;border:1px solid;background-color:white;font-weight: bold; padding: 3px; margin: 4px;cursor:pointer; \" onclick='$(\"input[value=NULL]\").prop(\"checked\", true);'>
        NINGUNO <input name=\"Sel_similar\" id=\"Sel_similar\" type=\"radio\" value=\"NULL\"  />
    </div>";
    
    
    $html .= "<div style=\"margin-top:20px;float:left;clear:both;\">".option_button("Abrir", 400, 1, "add_go('".$XML->get_paramSent("path")."');")."</div>";
    
    return array("type" => "html", "status" => "ok", "html" => $html);
}