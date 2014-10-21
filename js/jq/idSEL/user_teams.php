<?php
require_once "../../../init.php";
require_once "clases/user.php";

$u = $GLOBALS[UL]; // Cargar datos de usuario
if ($u->status != "") {
    echo $u->status . "- " . $_SERVER["PHP_SELF"];
    exit(0);
}

$htmlid = $_POST["htmlid"];
$selected = explode(";", $_POST["selected"]);

if (isset($_POST["multiple"]) && $_POST["multiple"] == 1) {
    $multiple = "MULTIPLE";
    $multiple_c = "multiple";
} else {
    $multiple = "";
    $multiple_c = "simple";
}


if ($u->get_prop("equiposobj") == NULL) {
    echo "<div style='color:white;font-size:16px;font-weight:bold;'>No estas vinculado a ningun equipo, consulta a tu administrador <input id='$htmlid' type='hidden' value='' /></div>";
    exit(0);
}

$t = $u->get_prop("equiposobj");
?>

<select id="<?= $htmlid; ?>" class="multiselect_<?= $multiple_c; ?>" <?= $multiple; ?>>
<?
foreach ($t as $tobj) {
    if (in_array($tobj->get_prop("id"), $selected)) {
        $selectO = "SELECTED";
    } else {
        $selectO = "";
    }
    ?>
        <option value="<?= $tobj->get_prop("id"); ?>" <?= $selectO; ?>><?= maxLenShow($tobj->get_prop("nombre"), 27); ?></option>
        <?
    }
    ?>
</select>

    <?
    if (!$okL && is_numeric($defaultID))
        echo "error de direccion en db";
    ?>
