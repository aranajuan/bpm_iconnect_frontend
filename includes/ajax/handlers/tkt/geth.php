<?

include "classes/formmaker.php";

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

    $result = $XML->get_response("data");
    $res = "";
    $i = 0;
    $ths = make_arrayobj($result["ths"]["th"]);
    foreach ($ths as $th) {
        $res.=$th["action"]["alias"];
        if (isset($th["form"]["element"])) {
            $f = new formmaker($i);
            $f->load_vector(make_arrayobj($th["form"]["element"]));
            $res.=$f->get_htmlview();
        }
        $res.="<hr>";
        $i++;
    }

    //error_log(print_r($result["actions"]["action"]),true);

    foreach (make_arrayobj($result["actions"]["action"]) as $A) {
        if ($A["formulario"] == 0) {
            $res.="<input type=\"button\" value=\"" . $A["alias"] . "\" onclick=\"go('" . $A["nombre"] . "')\"  />";
        } else {
            $res.="<input type=\"button\" value=\"" . $A["alias"] . "\" onclick=\"getform('" . $A["nombre"] . "')\"  />";
        }
    }

    return array("type" => "array", "result" => $res, "status" => "ok");
}