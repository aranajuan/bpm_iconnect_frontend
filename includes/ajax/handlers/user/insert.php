<?

/**
 * Ejecuta accion solicitada
 * @param XmlHandler $XML
 * @param string    $output //html
 */
function GO($XML, $output = "html") {
    if ($XML->get_error()) {
        return array("type" => "html", "html" => $XML->get_error(), "status" => "error");
    }

    if ($output != "html") {
        return array("type" => "html", "html" => "Formato no soportado.", "status" => "error");
    }

    $result = $XML->get_response("result");

    if ($result == "ok") {
        $LOG = new LOGGER();
        $LOG->addLine(array($XML->get_user()->get_prop("usr"), "alta usuario",$XML->get_paramSent("usr")));
    }
    return array("type" => "array", "result" => $result, "status" => "ok");
}
