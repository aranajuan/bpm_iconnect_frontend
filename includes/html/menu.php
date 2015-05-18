<?

$HLW = 409;   //ancho header left
$HLEM = 60;    //ancho elementos menu
$HRW = 80;    //ancho header right  

$LA = $R->get_param("L");
$LM = $R->get_param("main");
$menu = $U->get_menu();
$menuTOP = "<div class=\"menuel\" style=\"background-image: url(img/base/header_left.png);width: " . $HLW . "px; \"></div>";
$menuSUB = "";
$c = 0;
foreach ($menu[0] as $tM) {
    $c++;
    $selected = "";
    if ($tM["path"] == $LA || $tM[0] == $LM) {
        $selected = "selected";
    }
    $menuTOP.="<div class=\"menuel menubutton $selected\" style=\"width:" . $HLEM . "px\" onclick=\"" . $tM[1] . "\">" . strtoupper($tM[0]) . "</div>";
}
$nw = 910 - $HLW - ($c * $HLEM) - $HRW;
if ($nw > 0) {
    $menuTOP.="<div class=\"menuel menubutton_NH\" style=\"width:" . $nw . "px;\"></div>";
}
$menuTOP.="<div onclick=\"location.href='?L=logout'\" onmouseover=\"$(this).css('background-image','url(img/base/header_right_over.png)')\" onmouseout=\"$(this).css('background-image','url(img/base/header_right.png)')\" class=\"menuel\" style=\"background-image: url(img/base/header_right.png);width:" . $HRW . "px;float:right;cursor:pointer; \"></div>";
$menuSUB.="<div class=\"mainmenu\">";
if ($U->is_logged()) {
    $menuSUB.='<div class="ui-state-default user-data">';
    $menuSUB.="<b>" . $U->get_prop("nombre") . "</b>(" . $U->get_prop("usr") . ")<br/>";
    $menuSUB.=$U->get_prop("instancia") . "(" . $U->get_prop("perfil") . ")<br/>";
    $menuSUB.=$U->get_prop("mail");
    $menuSUB.='</div>';
}
$menuSUB.="</div>";