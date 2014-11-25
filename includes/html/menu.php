<?
$alist = $U->list_access();
$LA = $R->get_param("L");
$subel = array();

/* menu principal */
echo "<div id='$id' class='mainmenu' style='display:block;' >";
foreach ($alist as $link) {
    $exp = explode("_", $link[3]);
    $selected = false;
    if ($LA == $link[2]) {
        $selected = true;
    }
    if (count($exp) == 1) {
        echo menu_button($link[3], "menu_go('" . $link[2] . "')"); //go
    } else {
        if (!isset($subel[$exp[0]])) {
            echo menu_button($exp[0], "menu_sub('" . $exp[0] . "')"); //showsub
        }
        $subel[$exp[0]][$exp[1]] = $link;
    }
}
if ($U->is_logged()) {
    echo menu_button("Salir", "menu_go('logout')");
}
echo "</div>";

foreach ($subel as $id => $subm) {
    echo "<div id='$id' class='submenu' style='display:none;' >";
    foreach ($subm as $name => $link) {
        echo menu_button($name, "menu_go('" . $link[2] . "')");
    }
    echo menu_button("Volver", "menu_main()");
    echo "</div>";
}
?>

<!--                <div class="menuUser" onclick="ucontact_p();">
                    <table >
                        <tr>
                            <td>
                                <img src="img/base/menu/but_user.png" />
                            </td>
                            <td>
<? //echo $U->get_prop("nombre");  ?><br />
<? //echo ucwords($U->get_prop("perfil")); ?>   
                            </td>
                        </tr>
                    </table>
                </div>
            </div>-->
