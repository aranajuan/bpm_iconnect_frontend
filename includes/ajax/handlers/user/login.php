<?php

/**
 * Ejecuta accion solicitada
 * @param XmlHandler $XML
 * @return array {type,result,trycount,detail} //en error
 * @return array {type,result}
 */
function GO($XML) {
    $LOG = new LOGGER();
    if ($XML->get_error()) {
        $LOG->addLine(array($XML->get_paramSent("usr"), "login fallido", $XML->get_error()));

        if (substr($XML->get_error(), 0, 8) == "*SP:") {
            $XML->get_user()->reset_try();
            $reload = "true";
        } else {
            $XML->get_user()->add_try();
            $reload = "false";
        }
        if ($XML->get_user()->get_try() >= TRYMAX) {
            $reload = "true";
        }
        return array("type" => "array", "result" => "error", "trycount" => $XML->get_user()->get_try(), "reload" => $reload, "detail" => $XML->get_error());
    }
    $LOG->addLine(array($XML->get_paramSent("usr"), "login exitoso"));
    $arr = $XML->get_response("data");
    $_SESSION["usr"] = $XML->get_user()->get_prop("usr");
    $_SESSION["nombre"] = $arr["nombre"];
    $_SESSION["puesto"] = $arr["puesto"];
    $_SESSION["ubicacion"] = $arr["ubicacion"];
    $_SESSION["mail"] = $arr["mail"];
    $_SESSION["telefono"] = $arr["telefono"];
    $_SESSION["hash"] = $arr["hash"];
    $_SESSION["perfil"] = $arr["perfil"];
    $_SESSION["access"] = $arr["access"];
    $_SESSION["instancia"] = $XML->get_user()->get_prop("instancia"); //default donde loguea predomina post
    $XML->get_user()->load_session();
    $XML->get_user()->reset_try();
    return array("type" => "array", "result" => "ok", "home" => $XML->get_user()->get_home());
}
