<?php

/**
 * Ejecuta accion solicitada
 * @param XmlHandler $XML
 * @param string    $output //html
 */
function GO($XML, $output = "html") {
    if ($XML->get_error()) {
        return array("type" => "text", "html" => $XML->get_error(), "status" => "error");
    }

    $file = $XML->get_response("file");

    if(!isset($file["name"]) || trim($file["name"])==""){
        return array("type" => "text", "html" =>"No se gener&oacute; correctamente el archivo. Por favor reintente.", "status" => "error");
    }
    
    $ext = explode(".", $file["name"]);
    header("Content-Disposition:attachment; filename= ".$ext[0]. "_" . date("Ymd") . "." . $ext[count($ext) - 1]);
    header("Content-Type: application/octet-stream");
    return array("type" => "file", "file" => base64_decode($file["data"]));
}

?>
