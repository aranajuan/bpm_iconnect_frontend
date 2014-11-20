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
    $data= $XML->get_response("data");
    $list =$data["list"];
    $users = $list["TKT"];
    $cols=explode(",",$data["view"]);
    if(!$cols){
        $cols=array("id","FA","usr_o.nombre=>Usuario");
    }
    $HTML=arrayToTable(
            $cols,
            $users,
            null,
            "id",
            true,
            false,
            false,
            "tablelistRC",
            "class=\"display\""
    );
    
    return array("type" => "html", "html" => $HTML);
}

?>
