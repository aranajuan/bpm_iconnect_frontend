<?php

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

    $canupdateList = array();
    $actionsBT = "";
    if (isset($result["actions"]["action"])) {
        foreach (make_arrayobj($result["actions"]["action"]) as $A) {
            $A_Split = explode('-', $A["nombre"]);
            if ($A_Split[1] == 'UPDATE') {
                if (!isset($canupdateList[$A_Split[0]])) {
                    $canupdateList[$A_Split[0]] = array();
                }
                array_push($canupdateList[$A_Split[0]], array($A_Split[2], $A["alias"]));
                continue;
            }

            if ($A["formulario"] == 0) {
                $actionsBT.="<input type=\"button\" class=\"button\" value=\"" . $A["alias"] . "\" onclick=\"go('" . $A["nombre"] . "')\"  />";
            } else {
                $actionsBT.="<input type=\"button\" class=\"button\" value=\"" . $A["alias"] . "\" onclick=\"getform('" . $A["nombre"] . "')\"  />";
            }
        }
    }
    $actionsBT.='<br/><br/>';



    $res = "";
    $i = 0;
    $tops = make_arrayobj($result["tree"]["option"]);
    $html_tree = "<br/><b>Tipificacion:</b><br/><table>";
    foreach ($tops as $t) {
        $html_tree.="<tr><td><b>" . $t["question"] . "</b><td><td>" . $t["ans"] . "</td></tr>";
    }
    $html_tree.="</table>";
    if (is_numeric($result["idmaster"])) {
        $res.="<div style=\"width: 60%; border:2px solid; background-color: #ccffcc; padding: 4px;cursor: pointer;margin-top:5px;\" onclick=\"show_details('" . $result["idmaster"] . "')\" >Este ticket esta adjunto a otro que puede tener actualizaciones &nbsp;<img src=\"img/b_details.png\" class=\"img_lnk\"  /></div>";
    }
    $ths = make_arrayobj($result["ths"]["th"]);
    foreach ($ths as $th) {
        $afterVal="";
        $res.="<div class='master_TH'>";
        $res.="<div class='header_TH'>";
        $res.="<div class='title_TH'>" . strtoupper($th["action"]["alias"]) . "</div>";
        $res.="<div class='date_TH'>" . $th["action"]["date"] . "</div>";
        $res.="</div>";

        if ($th["action"]["ejecuta"] === "open") {
            $res.="<div class='element'>";
            $res.=$html_tree;
            $res.="</div>";
            if ($GLOBALS['U']->check_access('TKT', 'getpdf')) {
                $afterVal= '<a href="?class=tkt&method=getpdf&id=' . $XML->get_paramSent('id') .
                        '">&nbsp;&nbsp;&nbsp;<img src="img/thumbnail/pdf.png"  height="20" title="exportar" alt="exportar"/><br/></a>';
            }
        }
        $res.="<div class='element'>";
        if (isset($th["itform"]["element"])) {
            $f = new formmaker($i);
            $f->load_vector(make_arrayobj($th["itform"]["element"]));
            $res.=$f->get_htmlview();
        }
        if (isset($th["files"]["file"])) {
            $flist = make_arrayobj($th["files"]["file"]);
            foreach ($flist as $f) {
                $fv = explode(".", $f);
                $res.="<a href='?class=tkt&method=downloadfile&type=adjunto&file=$f' target='_blank' ><img src='img/thumbnail/" . $fv[1] . ".png' height='30' /></a>";
            }
        }
        $acname = explode('-', $th["action"]["nombre"]);

        if (count($canupdateList[$acname[0]]) && $th["action"]["isupdated"] == 'false') {
            $res.='<br/>';
            foreach ($canupdateList[$acname[0]] as $updt) {
                $res.="<input type=\"button\" class=\"button\" value=\"" . $updt[1] . "\""
                        . " onclick='getform(\"" . $acname[0] . "-UPDATE-" . $updt[0] . "\","
                        . "{\"idth\":\"" . $th["action"]["id"] . "\"})'  />";
            }
        }
        $res.="</div>";
        $res.="<div class='element'>";
        $res.="<b>" . $th["action"]["value"] . "</b>".$afterVal;
        $res.="</div>";
        $res.="</div>";
        $i++;
    }

    if (isset($result["largestatus"]) && $result["largestatus"] != '') {
        $res.="<div class='master_TH'>";
        $res.="<div class='header_TH'>";
        $res.="<div class='title_TH' style='color:blue;'>ESTADO</div>";
        $res.="</div>";
        $res.="<div class='element'>";
        $res.=$result["largestatus"];
        $res.="</div>";
        $res.="</div>";
        $i++;
    }
    $res .= $actionsBT;

    return array("type" => "array", "result" => "ok", "html" => $res);
}
