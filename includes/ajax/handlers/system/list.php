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
    $listins = $list["SYSTEM"];
    
    $HTML=arrayToTable(array("id","nombre"), $listins, array("id","nombre"), "id", false, true, false, "tablelist", "class=\"display\"");
    
    return array("type" => "html", "html" => $HTML);
}

?>
