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
    
    foreach ($users as &$u){
        $u["_usrd"]=$u["dominio"]."/<b>".$u["usr"]."</b>";
    }
    
    $HTML=arrayToTable(
            array("_usrd=>usuario","nombre","perfilT=>perfil",'equiposname=>equipos'),
            $users,
            array("dominio","usr","nombre","mail","telefono","puesto","ubicacion","fronts","perfil","idsequipos"),
            "usr",
            false,
            true,
            false,
            "tablelist",
            "class=\"display\""
    );
    
    return array("type" => "html", "html" => $HTML);
}

?>
