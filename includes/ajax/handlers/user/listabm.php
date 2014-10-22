<?php

/**
 * Ejecuta accion solicitada
 * @param XmlHandler $XML
 */
function GO($XML){
 return "<pre>".print_r($XML->get_respose("list"),true)."</pre>";   
}

?>
