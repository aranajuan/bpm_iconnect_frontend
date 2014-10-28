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
function arrayToTable($cols,$arr,$updateFields,$idField,$isOpen,$isDelete,$isCheck,$tableId,$tableConfig){

    $colsNames=array();
    $colsAlias=array();
    
    $i=0;
    
    foreach($cols as $c){
        $cE=explode("=>",$c);
        $colsNames[$i]=$cE[0];
        $colsAlias[$i]=$cE[1];
        $i++;
    }
    
    $HTML = "<table id=\"$tableId\" $tableConfig >";
    $HTML.="<thead><tr>";
    foreach($colsAlias as $cn){
        $HTML.="<th>".$cn."</th>";
    }
    $HTML.="</tr></thead>";
    
    $HTML.= "<tbody>";
    foreach ($arr as $el) {
        $HTML.="<tr>";
        if($isCheck){
             $HTML.="<td><input type=\"checkbox\" name=\"table_$tableId\" value=\"".$el[$idField]."\" /> </td>";
        }
        foreach($colsNames as $c){
            $HTML.="<td>".$el[$c]."</td>";
        }
        //update,open,delete
        $HTML.="</tr>";
    }
    $HTML.="</tbody>";


    $HTML.="</table>";
    
    return $HTML;
    
}


// idem anterior
function arrayToExcel(){
    
}

?>
