<?php

// funciones basicas para los handlers
/**
 * Ejecuta accion solicitada
 * @param XmlHandler $XML
 * @param string    $output //html
 */
function normal_GO($XML, $output = "html") {
    if ($XML->get_error()) {
        return array("type" => "html", "html" => $XML->get_error(), "status" => "error");
    }

    if ($output != "html") {
        return array("type" => "html", "html" => "Formato no soportado.", "status" => "error");
    }

    $result = $XML->get_respose("result");

    return array("type" => "array", "result" => $result, "status" => "ok");
}

/**
 * 
 * @param XmlHandler $XML
 * @param string $objname
 * @param array $cols
 * @param string $output
 * @return array
 */
function normal_idsel($XML, $objname, $cols, $output = "html") {
    if ($XML->get_error()) {
        return array("type" => "html", "html" => $XML->get_error(), "status" => "error");
    }

    if ($output != "html") {
        return array("type" => "html", "html" => "Formato no soportado.", "status" => "error");
    }

    $list = $XML->get_respose("list");
    $listV = $list[$objname];

    $HTML = arrayToSelect(
            $listV, $cols, $XML->get_paramSent("htmlid"), $XML->get_paramSent("multiple"), arrayornull(",", $XML->get_paramSent("checkedlist")), arrayornull(",", $XML->get_paramSent("whitelist")), arrayornull(",", $XML->get_paramSent("blacklist"))
    );

    return array("type" => "html", "html" => $HTML, "status" => "ok");
}

/**
 * Genera tabla a partir del array input
 * @param array $cols   columnas a mostrar nombre=>alias
 * @param array $arr    array input
 * @param array $updateFields   datos para java update
 * @param string $idField  identificador para open,check,delete  
 * @param boolean  $isOpen se puede abrir
 * @param boolean  $isDelete se puede eliminar
 * @param boolean  $isCheck se puede marcar
 * @param string $tableId
 * @param string $tableConfig
 * @return string Tabla HTML
 */
function arrayToTable($cols, $arr, $updateFields, $idField, $isOpen, $isDelete, $isCheck, $tableId, $tableConfig) {

    $colsNames = array();
    $colsAlias = array();

    $i = 0;
    if (!isset($arr[0])) {
        $tmp = $arr;
        $arr = array();
        $arr[0] = $tmp;
    }
    foreach ($cols as $c) {
        $cE = explode("=>", $c);
        if (count($cE) > 1) {
            $colsNames[$i] = $cE[0];
            $colsAlias[$i] = $cE[1];
        } else {
            $colsNames[$i] = $c;
            $colsAlias[$i] = $c;
        }
        $i++;
    }

    $HTML = "<table id=\"$tableId\" $tableConfig >";
    $HTML.="<thead><tr>";
    if ($isCheck) {
        $HTML.="<th>&nbsp;</th>";
    }
    foreach ($colsAlias as $cn) {
        $HTML.="<th>" . $cn . "</th>";
    }
    if ($isOpen) {
        $HTML.="<th>&nbsp;</th>";
    }
    if (is_array($updateFields)) {
        $HTML.="<th>&nbsp;</th>";
    }
    if ($isDelete) {
        $HTML.="<th>&nbsp;</th>";
    }
    $HTML.="</tr></thead>";

    $HTML.= "<tbody>";
    foreach ($arr as $el) {
        $HTML.="<tr>";
        if ($isCheck) {
            $HTML.="<td><input type=\"checkbox\" name=\"table_$tableId\" value=\"" . $el[$idField] . "\" /> </td>";
        }
        foreach ($colsNames as $c) {
            $HTML.="<td>" . $el[$c] . "</td>";
        }
        //update,open,delete
        if ($isOpen) {
            $HTML.="<td><img src=\"img/b_details.png\" class=\"img_lnk\" onclick=\"show_details('" . $el[$idField] . "')\" /> </td>";
        }
        if (is_array($updateFields)) {
            $jsArray = array();
            foreach ($updateFields as $uf) {
                $jsArray[trim($uf)] = $el[$uf];
            }
            $javaTxt = str_replace("\"", "&quot;", json_encode($jsArray));
            $HTML.="<td><img src=\"img/b_edit.png\" class=\"img_lnk\" onclick=\"show_update(" . $javaTxt . ")\" /> </td>";
        }
        if ($isDelete) {
            $HTML.="<td><img src=\"img/b_drop.png\" class=\"img_lnk\"  onclick=\"show_delete('" . $el[$idField] . "')\" /> </td>";
        }

        $HTML.="</tr>";
    }
    $HTML.="</tbody>";


    $HTML.="</table>";

    return $HTML;
}

// idem anterior
function arrayToExcel() {
    
}

/**
 * 
 * @param array $arr
 * @param array{value,text} $cols
 * @param string $htmlid
 * @param boolean $multiple
 * @param array $checkedlist
 * @param array $whitelist
 * @param array $blacklist
 * @return string htmlselect
 */
function arrayToSelect($arr, $cols, $htmlid, $multiple, $checkedlist, $whitelist, $blacklist) {

    if ($multiple == "true") {
        $multipleAttr = "MULTIPLE";
        $multiple_class = "multiple";
    } else {
        $multipleAttr = "";
        $multiple_class = "simple";
    }

    if (!isset($arr[0])) {
        $tmp = $arr;
        $arr = array();
        $arr[0] = $tmp;
    }

    $HTML = "<select id=\"$htmlid\" class=\"multiselect_$multiple_class\"  $multipleAttr>";
    foreach ($arr as $el) {
        $show = true;
        if (is_array($blacklist) && in_array($el[$cols[0]], $blacklist)) {
            $show = false;
        }

        if (is_array($whitelist) && !in_array($el[$cols[0]], $whitelist)) {
            $show = false;
        }

        if ($show) {
            $selected = "";
            if (is_array($checkedlist) && in_array($el[$cols[0]], $checkedlist)) {
                $selected = "SELECTED";
            }
            $HTML .= "<option $selected value=\"" . $el[$cols[0]] . "\">" . $el[$cols[1]] . "</option>";
        }
    }
    $HTML .="</select>";
    return $HTML;
}

?>
