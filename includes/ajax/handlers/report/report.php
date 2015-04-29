<?php

/**
 * Ejecuta accion solicitada
 * @param XmlHandler $XML
 * @param string    $output //html
 */
function GO($XML, $output = "html") {
    if ($XML->get_error()) {
        echo $XML->get_error();
        return;
    }

    $file = $XML->get_response("file");

    $ext = explode(".", $file["name"]);
    header("Content-Disposition:attachment; filename= ".$ext[0]. "_" . date("Ymd") . "." . $ext[count($ext) - 1]);
    header("Content-Type: application/octet-stream");
    return array("type" => "file", "file" => base64_decode($file["data"]));
}

?>
