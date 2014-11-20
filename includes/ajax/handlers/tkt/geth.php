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
    $html_tree = "<br/>Tipificacion:<br/><table>";
    foreach ($tops as $t) {
        $html_tree.="<tr><td><b>" . $t["question"] . "</b><td><td>" . $t["ans"] . "</td></tr>";
    }
    $html_tree.="</table>";
    
    $ths = make_arrayobj($result["ths"]["th"]);
    foreach ($ths as $th) {
        $res.="<b>" . $th["action"]["alias"] . "</b>(" . $th["action"]["id"] . ")<br/>(" . $th["action"]["usr"] . "-" . $th["action"]["date"] . ")";
        
        if($th["action"]["ejecuta"]==="open"){
            $res.=$html_tree;
        }

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
        $res.="<br/><b>".$th["action"]["value"]."</b>";
        $res.="<br/><hr />";
        $i++;
    }

    //error_log(print_r($result["actions"]["action"]),true);

    foreach (make_arrayobj($result["actions"]["action"]) as $A) {
        if ($A["formulario"] == 0) {
            $res.="<input type=\"button\" class=\"button\" value=\"" . $A["alias"] . "\" onclick=\"go('" . $A["nombre"] . "')\"  />";
        } else {
            $res.="<input type=\"button\" class=\"button\" value=\"" . $A["alias"] . "\" onclick=\"getform('" . $A["nombre"] . "')\"  />";
        }
    }

    return array("type" => "array", "result" => "ok", "html" => $res);
}
