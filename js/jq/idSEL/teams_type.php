<?php
require_once "../../../init.php";
require_once 'clases/division.php';
require_once "clases/user.php";
$u = $GLOBALS[UL]; // Cargar datos de usuario
if ($u->status != "") {
    echo $u->status . "- " . $_SERVER["PHP_SELF"];
    exit(0);
}
$htmlid = $_POST["htmlid"];
$defaultID = $_POST["defaultID"];
$hide = $_POST["hide"];
$tipoTXT = $_POST["tipo"];
$multiple = $_POST["multiple"];

$porp = "";
if ($multiple == "true") {
    $prop = "class=\"multiselect_multiple filter\" MULTIPLE";
} else {
    $prop = "class=\"multiselect_simple filter\"";
}

$tipo = TEAM::GetTipo_id($tipoTXT);
$TEAMALL_v=null;
if ($hide != "" && is_numeric($hide)) {
    $AT = new TEAM();
    if ($AT->load_DB($hide) == "ok") {
        $TEAMALL_v = array();
        $i = 0;
        foreach ($AT->get_teamsREL($tipoTXT) as $tR) {
            if ($tR->get_prop("id") != $hide) {
                $TEAMALL_v[$i] = $tR;
                $i++;
            }
        }
    }
}
if($TEAMALL_v==null){
    $TEAMALL = new TEAM();
    $TEAMALL_v = $TEAMALL->list_all($tipo, $hide);
}
if ($TEAMALL_v == null) {
    echo "<div id=\"$htmlid\">No se encontraron equipos.</div>";
    exit(0);
}
?>
<table>
    <td>
        <select name="<?= $htmlid; ?>" id="<?= $htmlid; ?>"  <?= $prop; ?>>
            <?
            $defaultIDV = explode(",", $defaultID);
            foreach ($TEAMALL_v as $t) {
                if (in_array($t->get_prop("id"), $defaultIDV)) {
                    $selectO = "SELECTED";
                } else
                    $selectO = "";
                ?>
                <option value="<?= $t->get_prop("id"); ?>" <?= $selectO; ?>><?= maxLenShow($t->get_prop("nombre"), 27); ?></option>
                <?
                $t->get_prop("nombre");
            }
            ?>
        </select>
    </td>
</table>
