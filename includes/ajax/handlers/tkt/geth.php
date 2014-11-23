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
    $tops = make_arrayobj($result["tree"]["option"]);
    $html_tree = "<br/><b>Tipificacion:</b><br/><table>";
    foreach ($tops as $t) {
        $html_tree.="<tr><td><b>" . $t["question"] . "</b><td><td>" . $t["ans"] . "</td></tr>";
    }
    $html_tree.="</table>";
    if (is_numeric($result["master"])) {
        $res.="<div style=\"width: 50%; border:2px solid; background-color: #ccffcc; padding: 4px;cursor: pointer;margin-top:5px;\" onclick=\"show_details('" . $result["master"] . "')\" >Este ticket esta adjunto a otro que puede tener actualizaciones &nbsp;<img src=\"img/b_details.png\" class=\"img_lnk\"  /></div>";
    }
    $ths = make_arrayobj($result["ths"]["th"]);
    foreach ($ths as $th) {
        $res.="<div class='master_TH'>";
        $res.="<div class='header_TH'>";
        $res.="<div class='title_TH'>" . strtoupper($th["action"]["alias"]) . "</div>";
        $res.="<div class='date_TH'>" . $th["action"]["date"] . "</div>";
        $res.="</div>";

        if ($th["action"]["ejecuta"] === "open") {
            $res.="<div class='element'>";
            $res.=$html_tree;
            $res.="</div>";
        }
        $res.="<div class='element'>";
        if (isset($th["form"]["element"])) {
            $f = new formmaker($i);
            $f->load_vector(make_arrayobj($th["form"]["element"]));
            $res.=$f->get_htmlview();
        }
        if (isset($th["files"]["file"])) {
            $flist = make_arrayobj($th["files"]["file"]);
            foreach ($flist as $f) {
                $fv = explode(".", $f);
                $res.="<a href='?class=tkt&method=downloadfile&type=adjunto&file=$f' target='_blank' ><img src='img/thumbnail/" . $fv[1] . ".png' height='30' /></a>";
            }
        }
        $res.="</div>";
        $res.="<div class='element'>";
        $res.="<b>" . $th["action"]["value"] . "</b>";
        $res.="</div>";
        $res.="</div>";
        $i++;
    }

    if (isset($result["actions"]["action"])) {
        foreach (make_arrayobj($result["actions"]["action"]) as $A) {
            if ($A["formulario"] == 0) {
                $res.="<input type=\"button\" class=\"button\" value=\"" . $A["alias"] . "\" onclick=\"go('" . $A["nombre"] . "')\"  />";
            } else {
                $res.="<input type=\"button\" class=\"button\" value=\"" . $A["alias"] . "\" onclick=\"getform('" . $A["nombre"] . "')\"  />";
            }
        }
    }
    return array("type" => "array", "result" => "ok", "html" => $res);
}
