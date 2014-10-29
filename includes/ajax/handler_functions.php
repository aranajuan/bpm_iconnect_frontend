<?php

// funciones basicas para los handlers

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
            $HTML.="<td><img src=\"img/b_details.png\" class=\"img_lnk\" onclick=\"show_details('".$el[$idField]."')\" /> </td>";
        }
        if (is_array($updateFields)) {
            $jsArray=array();
            foreach ($updateFields as $uf){
                $jsArray[trim($uf)]=$el[$uf];
            }
            $javaTxt=  json_encode($jsArray);
            $HTML.="<td><img src=\"img/b_edit.png\" class=\"img_lnk\" onclick=\"show_update(".strToJava($javaTxt).")\" /> </td>";
        }
        if ($isDelete) {
            $HTML.="<td><img src=\"img/b_drop.png\" class=\"img_lnk\"  onclick=\"show_delete('".$el[$idField]."')\" /> </td>";
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

?>
