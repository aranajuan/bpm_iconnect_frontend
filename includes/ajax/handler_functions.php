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

    $result = $XML->get_response("result");

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

    $list = $XML->get_response("list");
    $listV = $list[$objname];

    $HTML = arrayToSelect(
            $listV, $cols, $XML->get_paramSent("htmlid"), $XML->get_paramSent("multiple"), arrayornull(",", $XML->get_paramSent("checkedlist")), arrayornull(",", $XML->get_paramSent("whitelist")), arrayornull(",", $XML->get_paramSent("blacklist"))
    );

    return array("type" => "html", "html" => $HTML, "status" => "ok");
}

/**
 * Lista de tickets exportable a excel
 * @param XmlHandler $XML
 * @param array $defcol    columnas default si no estan definidas
 * @param string $id    id de la tabla
 * @param string $output    html,xls
 * @return string|null
 */
function normal_tktlist($XML,$defcol,$id, $output = "html"){
    $allow = array("html","xls");
    if ($XML->get_error()) {
        return array("type" => "html", "html" => $XML->get_error(), "status" => "error");
    }

    if (!in_array($output, $allow)) {
        return array("type" => "html", "html" => "Formato no soportado.", "status" => "error");
    }
    $data = $XML->get_response("data");
    $list = $data["list"];
    $TKL = $list["TKT"];
    
    if (isset($data["view"])) {
        $cols = explode(",", $data["view"]); 
    }else{
        $cols = $defcol;
    }
    if ($output == "html") {
        $HTML = arrayToTable(
                $cols, $TKL, null, "id", true, false, false, $id, "class=\"display\""
        );
        return array("type" => "html", "html" => $HTML, "status" => "ok");
    }
    if ($output == "xls") {
        $HTML = arrayToExcel(
                $cols, $TKL
        );
        return array("type" => "xls", "html" => $HTML, "status" => "ok");
    }
    return array("type" => "html", "html" => "Error de formato", "status" => "error");
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

    if (!is_array($arr)) {
        return TABLE_EMPTY;
    }

    if (!isset($arr[0])) {
        $tmp = $arr;
        $arr = array();
        $arr[0] = $tmp;
    }
    foreach ($cols as $c) {
        $c=xmlText($c);
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
            $HTML.="<td>" . get_value($c, $el) . "</td>";
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

/**
 * Combierte formato para excel
 * @param type $str
 * @return type
 */
function convert_string_excel($str){
    $amp=mb_convert_encoding("&amp;",'utf-16','utf-8');
    return str_replace($amp,"&#x26;",mb_convert_encoding($str,'utf-16','utf-8'));
}

/**
 * 
 * @param type $cols
 * @param type $arr
 * @return string
 */
function arrayToExcel($cols, $arr) {
    $colsNames = array();
    $colsAlias = array();

    $i = 0;

    if (!is_array($arr)) {
        return null;
    }

    if (!isset($arr[0])) {
        $tmp = $arr;
        $arr = array();
        $arr[0] = $tmp;
    }
    foreach ($cols as $c) {
        $c=xmlText($c);
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

    $HTML = "<table>";
    $HTML.="<thead><tr>";
    foreach ($colsAlias as $cn) {
        $HTML.="<th>" . convert_string_excel($cn) . "</th>";
    }
    $HTML.="</tr></thead>";

    $HTML.= "<tbody>";
    foreach ($arr as $el) {
        $HTML.="<tr>";
        foreach ($colsNames as $c) {
            $HTML.="<td>" . convert_string_excel(get_value($c, $el)) . "</td>";
        }
        

        $HTML.="</tr>";
    }
    $HTML.="</tbody>";


    $HTML.="</table>";

    return $HTML;
}

/**
 * Obtiene valor de funciones complejas
 * @param string $field funcion:par1:par2:par3
 * @param   array   $arr    array con valores del fila
 * @param boolean $html muestra html o excel(campo limpio)
 * @return string
 */
function get_value($field, $arr, $html = true) {
    $fieldv = explode(":", $field);
    if (count($fieldv) < 2) {
        return $arr[$field];
    }
    switch (strtolower($fieldv[0])) {
        case "nextans":
            return make_nextans($fieldv, $arr);
            break;
        case "js":
            return make_js($fieldv, $arr);
            break;
        default:
            return $field;
    }
}

/**
 * Devuelve JS
 * Parametros desde campos
 * js:nombrefuncion:param1,param2,param3
 * @param type $field
 * @param type $arr
 * @return string
 */
function make_js($field, $arr) {
    $len = count($field);
    if ($len < 4) {
        return "error js";
    }
    $func = $field[1];
    $params = array();
    for ($i = 2; $i <= $len - 2; $i++) {
        array_push($params, "'" . $arr[$field[$i]] . "'");
    }
    return "<a href=\"javascript:" . $func . "(" . implode(",", $params) . ")\">" . $arr[$field[$len - 1]] . "</a>";
}

/**
 * Devuelve la opcion posterior a cualquiera de los elementos
 * nextans:D1:S4:03
 * @param type $field
 * @param type $arr
 * @return string
 */
function make_nextans($field, $arr) {
    $options = json_decode($arr["origen_json"]);
    $found = false;
    foreach ($options as $o) {
        if ($found) {
            return $o->ans;
        }
        $pv = explode("-", $o->path);
        if (count(array_intersect($field, $pv))) {
            $found = true;
        }
    }
    foreach($field as $f){
        if(substr($f, 0, 1)=="P"){
            $pos=  substr($f, 1);
            $o=$options[$pos];
            if($o && $o->ans){
                return $o->ans;
            }
        }
    }
    return "";
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

    $arr = make_arrayobj($arr);

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
