<?php

/**
 * Devuelve el array si no es null
 * @param string $str
 * @param string $spliter
 * @return null/array
 */
function arrayornull($spliter,$str){
    if($str!="" && $str){
        return explode($spliter,$str);
    }
    return null;
}

/**
 * Busca recursivamente en un array
 */
function array_get_key_val($key, $heystack) {
    if (is_array($heystack)) {
        foreach ($heystack as $k => $v) {
            if ($v == $key) {
                return $k;
            } elseif (is_array($v)) {
                return array_get_key_val($key, $v);
            }
        }
        return -1;
    }
    return -1;
}

/**
 * Dar formato a fecha
 * $str string d-m-Y H:i
 * return Y-m-d H:i
 */
function STRdate_format($str, $origin = USERDATE_READ, $format = DBDATE_WRITE) {
    if (trim($str) == "") {
        return -1;
    }
    try {
        $date = DateTime::createFromFormat($origin, $str)->format($format);
        return $date;
    } catch (Exception $e) {
        return -1;
    }
}

/**
 * fechas en formato usuario
 * devuelve minutos
 */
function DiffBetweenDates($fechaI, $fechaF) {
    if ($fechaF == "NOW")
        $fechaF = date(USERDATE_READ);
    if ($fechaI == "NOW")
        $fechaI = date(USERDATE_READ);
    $seg_dif = strtotime(STRdate_format($fechaF, USERDATE_READ, "Y-m-d H:i")) - strtotime(STRdate_format($fechaI, USERDATE_READ, "Y-m-d H:i"));
    return round($seg_dif / 60, 0, PHP_ROUND_HALF_DOWN);
}

/**
 * convierte HH:MM a MM
 */
function HsToMin($hs) {
    $time = explode(":", $hs);
    if (!is_numeric($time[0]) || !is_numeric($time[1]))
        return -1;
    return ($time[0] * 60) + $time[1];
}

/**
 * elimina todos los espacios del texto (en cualquier lugar)
 */
function space_delete($str) {

    $rta = str_replace(" ", "", $str);
    $rta = str_replace("\t", "", $rta);
    $rta = str_replace("\n", "", $rta);
    $rta = str_replace("\0", "", $rta);
    $rta = str_replace("\x0B", "", $rta);

    return $rta;
}

/**
 * Escapa caracteres especiales XML
 * @param string $string
 * @param boolean $CDATA
 * @return string
 */
function xmlEscape($string,$CDATA=false) {
    if($CDATA){
        str_replace("]]>", "&cdatag;", $string);
        return "<![CDATA[".$string."]]>";
    }
    return str_replace(array('&', '<', '>'), array('&amp;', '&lt;', '&gt;'), $string);
}

/**
 * Re genera texto de xml
 * @param string $string
 * @return string
 */
function xmlText($string){
    return str_replace(array('&amp;', '&lt;', '&gt;','&cdatag;'),array('&', '<', '>',']]>') , $string);
}

/**
 * si data es null devuelve default
 */
function dataDefatult($data, $defaultD) {
    if ($data)
        return $data;
    return $defaultD;
}

function strToSQL($txt) {
    $tmp = str_replace("'", "''", $txt);
    $tmp = str_replace("\\", "\\\\", $tmp);
    return $tmp;
}

/**
 * convierte una cadena para pasarla como parametro a una funcion js
 */
function strToJava($txt) {
    $tmp = str_replace("\\", "\\\\", $txt);
    $tmp = str_replace("\"", "&quot;", $tmp);
    $tmp = str_replace("'", "\\'", $tmp);
    $tmp = str_replace("\n", "\\n", $tmp);
    $tmp = str_replace("\r", "", $tmp);
    return $tmp;
}

/**
 * corta el string para que entre en el tamaño designado
 */
function maxLenShow($txt, $max) {
    if (strlen($txt) > $max) {
        return substr($txt, 0, $max - 3) . "...";
    }
    else
        return $txt;
}

/**
 * Dibuja barra azul de filtros
 */
function filter_bar($content, $style = "") {

    $html = "
    <table style=\"$style\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" >
        <tr>
            <td style=\"background-color: #b2c8f2; padding: 3px;height: 100%;\">
                $content
            </td>
        </tr>
    </table>
    ";
    return $html;
}

/**
 * html a mayusc
 */
function htmltoupper($str) {
    $trans = get_html_translation_table(HTML_ENTITIES);
    $trans = array_flip($trans);
    $str = strtr($str, $trans);
    $str = strtoupper($str);
    $str = htmlentities($str);
    return $str;
}

/**
 * Dibuja boton de opciones de arbol
 */
function option_button($text, $width, $styleN, $Jfunction = "") {

    $colors = array("#9bc1f9", "#beb5d8");
    $fontC = array("5a5a5a", "5a5a5a");
    $size = array(28, 28);
    $Maxlenght = round($width / 8);
    $text = maxLenShow($text, $Maxlenght);
    $html = "
        <div style='width:" . $width . "px;height:" . $size[$styleN] . "px;overflow:hidden;cursor:pointer;' onclick=\"" . $Jfunction . "\">
            <div style='float:left;'>
                <img src=\"" . HIMG_DIR . "/base/but_i_$styleN.png\" />
            </div>
            <div style='float:left;background-color:" . $colors[$styleN] . ";height:100%;width: " . ($width - 13) . "px;font-size:15px;padding-top:2px;text-align:center;'>
                " . htmltoupper($text) . "
            </div>
            <div style='float:right;'>
                <img src=\"" . HIMG_DIR . "/base/but_d_$styleN.png\" />
            </div>
        </div>
    ";

    return $html;
}

/**
 * Bloquea mensajes de error y lo pone en una variable global
 */
$fatal_error_handler_MSJ = "";

function fatal_error_handler($buffer) {
    global $fatal_error_handler_MSJ;
    if (ereg("(error</b>:)(.+)(<br)", $buffer, $regs)) {
        $fatal_error_handler_MSJ = $buffer;
        return $buffer;
    }
    $fatal_error_handler_MSJ = "";
    return $buffer;
}

/**
 * inicia medicion y lo guarda en el id solicitado
 */
$measures = array();
$measures_stop = array();

function start_measure($id) {
    global $measures;
    global $measures_stop;
    $measures[$id] = microtime_float();
    $measures_stop[$id] = "";
}

/**
 * detener medicion
 */
function stop_measure($id) {
    global $measures_stop;
    $measures_stop[$id] = microtime_float();
}

/**
 * retorna el tiempo desde start_measure
 */
function get_measure($id) {
    global $measures;
    global $measures_stop;
    if ($measures_stop[$id] == "" || $measures_stop[$id] == NULL)
        $tFinish = microtime_float();
    else
        $tFinish = $measures_stop[$id];
    return ($tFinish - $measures[$id]);
}

/**
 * muestra el tiempo desde start_measure */
function show_measure($id, $text = "") {
    if (!$GLOBALS[UL])
        return;
    if (!$GLOBALS[UL]->get_prop("debug") || !DEBUG_MEASURE)
        return;
    if ($text == "")
        $text = $id;
    echo "<br/>" . $text . "=>" . get_measure($id);
}

function microtime_float() {
    list($useg, $seg) = explode(" ", microtime());
    return ((float) $useg + (float) $seg);
}

/**
 * se ejecuta al finalizar script */
function finish() {

    
}

class Encrypter {

    private static $Key = "sistemasdeventas";

    public static function encrypt($input) {
        $output = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5(Encrypter::$Key), $input, MCRYPT_MODE_CBC, md5(md5(Encrypter::$Key))));
        return $output;
    }

    public static function decrypt($input) {
        $output = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5(Encrypter::$Key), base64_decode($input), MCRYPT_MODE_CBC, md5(md5(Encrypter::$Key))), "\0");
        return $output;
    }

}

?>
