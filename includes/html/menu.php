<?
$LA = $R->get_param("L");
$LM = $R->get_param("main");
$menu = $U->get_menu();

$menuTOP = "";
$c = 0;
foreach ($menu[0] as $tM) {
    $c++;
    $selected = "";
    if ($tM["path"] == $LA || $tM[0] == $LM) {
        $selected = "selected";
    }
    $menuTOP.="<div class=\"menu-element $selected\" onclick=\"" . $tM[1] . "\">" . strtoupper($tM[0]) . "</div>";
}
$nw = 910 - $HLW - ($c * $HLEM) - $HRW;

$menuSUB="";
if ($U->is_logged()) {
    $menuSUB.='<div class="ui-state-default user-data" style = "float:right;">';
    $menuSUB.="<b>" . $U->get_prop("nombre") . "</b>(" . $U->get_prop("usr") . ")<br/>";
    $menuSUB.=$U->get_prop("instancia") . "(" . $U->get_prop("perfil") . ")<br/>";
    $menuSUB.=$U->get_prop("mail");
    $menuSUB.='</div>';
}