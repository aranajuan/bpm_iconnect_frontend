<?php
/**
 * Ejecuta accion solicitada
 * @param XmlHandler $XML
 * @param string    $output //html
 */
function GO($XML,$output="html") {
    return normal_idsel($XML,"PROFILE",array("id","nombre"));
}
