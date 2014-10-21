<?php
require_once "../../../init.php";
require_once 'clases/team.php';
$u = $GLOBALS[UL]; // Cargar datos de usuario
if ($u->status != "") {
    echo $u->status . "- " . $_SERVER["PHP_SELF"];
    exit(0);
}
$htmlid = $_POST["htmlid"];
$idareas = $_POST["areas"];
$hide = $_POST["hide"];
$selected = explode(";", $_POST["selected"]);

$hideV = explode(";", $hide);
$uteams = $u->get_prop("equiposobj");

if (isset($_POST["multiple"]) && $_POST["multiple"] == 1) {
    $multiple = "MULTIPLE";
    $multiple_c = "multiple";
} else {
    $multiple = "";
    $multiple_c = "simple";
}


if ($uteams == NULL) {
    echo "<div style='color:white;font-size:16px;font-weight:bold;'>No estas vinculado a ningun equipo, consulta a tu administrador <input id='$htmlid' type='hidden' value='' /></div>";
    exit(0);
}

$teams = array();
if ($idareas == "all") {
    $teams = $uteams;
} else {
    $idareasV = explode(";", $idareas);
    foreach ($idareasV as $id) {
        if (!$u->in_team($id)) {
            echo "Usted no pertenece a este equipo. Lista invalida.";
            exit(0);
        }
        foreach ($uteams as $t) {
            if ($t->get_prop("id") == $id) {
                array_push($teams, $t);
            }
        }
    }
}

$staff = array();
foreach ($teams as $t) {
    $tu = $t->get_users();
    $staff = $staff + $tu;
}


if (count($staff) == 0) {
    echo "<div id=\"$htmlid\">No se encontraron usuarios.</div>";
    exit(0);
}
?>
<table>
    <td>
        <select name="<?= $htmlid; ?>" id="<?= $htmlid; ?>" class="multiselect_<?= $multiple_c; ?> filter" <?= $multiple; ?>>
            <?
            foreach ($staff as $s) {
                if (in_array($s->get_prop("id"), $selected)) {
                    $selectO = "SELECTED";
                } else {
                    $selectO = "";
                }
                if (!in_array($s->get_prop("id"), $hideV)) {
                    ?>
                    <option value="<?= $s->get_prop("id"); ?>" <?= $selectO; ?>><?= $s->get_prop("nombre"); ?></option>
                    <?
                }
            }
            ?>
        </select>
    </td>
</table>
