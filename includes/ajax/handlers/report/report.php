<?php

/**
 * Ejecuta accion solicitada
 * @param XmlHandler $XML
 * @param string    $output //html
 */
function GO($XML,$output="xls") {
    $defcol = array("id", "FA");
    return normal_tktlist($XML, $defcol, "tablelist", $output);
}

?>
