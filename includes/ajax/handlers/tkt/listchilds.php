<?php

/**
 * Ejecuta accion solicitada
 * @param XmlHandler $XML
 * @param string    $output //html
 */
function GO($XML, $output = "html") {
    if ($XML->get_error()) {
        return array("type" => "html", "html" => $XML->get_error());
    }

    if ($output != "html") {
        return array("type" => "html", "html" => "Formato no soportado.");
    }

    $data = $XML->get_response("data");
    
    $res="<table style='width:100%'>";
    $objs=  make_arrayobj($data["list"]["tkt"]);
    foreach($objs as $tkt){
        $res.="<tr >";
        $res.="<td style='border:1px solid'>".$tkt["id"]."</td><td style='border:1px solid'>".$tkt["usr_o.nombre"]."</td><td style='border:1px solid'><img class='img_lnk' src='img/b_details.png' onclick=\"javascript:show_details('".$tkt["id"]."')\" /></td>";
        $res.="</tr>";
    }
    
    $res.="</table>";
    
    return array("type" => "html", "html" => $res);
}
