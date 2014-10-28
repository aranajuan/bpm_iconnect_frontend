<?php

/**
 * Ejecuta accion solicitada
 * @param XmlHandler $XML
 * @param string    $output //html
 */
function GO($XML,$output="html") {
    if($XML->get_error()){
        return array("type" => "html", "html" => $XML->get_error());
    }
    
    if($output!="html"){
        return array("type" => "html", "html" => "Formato no soportado.");
    }
    
    $list = $XML->get_respose("list");
    $users = $list["USER"];
    
    $HTML=arrayToTable(array("usr=>usuario","telefono=>telefono"), $users, array("usr","telefono"), "usr", false, false, true, "listaUsr", "");
    
    return array("type" => "html", "html" => $HTML);
}

?>
