<?php

/**
 * Ejecuta accion solicitada
 * @param XmlHandler $XML
 */
function GO($XML){
    $arr = $XML->get_respose("data");
    $_SESSION["usr"] = $XML->get_user()->get_prop("usr");
    $_SESSION["hash"] = $arr["hash"];
    $_SESSION["perfil"] = $arr["perfil"];
    $_SESSION["access"] = $arr["access"];
    $_SESSION["instancia"] = $XML->get_user()->get_prop("instancia"); //default donde loguea predomina post
}
