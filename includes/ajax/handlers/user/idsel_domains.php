<?php
/**
 * Ejecuta accion solicitada
 * @param XmlHandler $XML
 * @param string    $output //html
 */
function GO($XML,$output="html") {
    return normal_idsel($XML,"domain",array("nombre","nombre"));
}
