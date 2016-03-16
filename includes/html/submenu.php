<div style="float:left;padding-left: 10px; ">
    <div><h2><?= strtoupper($R->get_param("main")); ?></h2></div>
</div>
<br /><br /><br /><br /><br /><br />

<?
$menu = $U->get_menu();
foreach ($menu[1] as $id => $tS) {
    if ($id == $R->get_param("main")) {
        foreach ($tS as $name => $link) {
            echo option_button($name, 300, 0, $link[2])."<br/><br/><br/>";
        }
    }
}
?>