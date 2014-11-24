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
    
    if (in_array(strtolower($ext[count($ext) - 1]), array("png", "jpg", "jpeg"))) {
        header('Content-type: image/png');
    } else {
        header("Content-Disposition:attachment; filename= adjunto." . $ext[count($ext) - 1]);
        header("Content-Type: application/octet-stream");
    }
    //echo $file["name"];
    return array("type"=>"file", "file"=> base64_decode($file["data"]));
    //return null;
}
