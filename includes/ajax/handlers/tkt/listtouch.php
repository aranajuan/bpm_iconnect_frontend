<?php

/**
 * Ejecuta accion solicitada
 * @param XmlHandler $XML
 * @param string    $output //html
 */
function GO($XML,$output="html") {
    $defcol = array("id", "FA", "usr_o.nombre=>Usuario");
    return normal_tktlist($XML, $defcol, "tablelist", $output);
}

?>
