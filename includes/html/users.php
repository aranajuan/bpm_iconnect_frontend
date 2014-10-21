<?
    require_once   'header.php';
?>

<div style="float:left;padding-left: 10px; ">
    <div><h2>ABM USUARIOS</h2></div>
</div>

<div id="reg_details" class="popup">
        <table>
            <tr>
                <td>Legajo:</td>
                <td><input id="txt_id" type="text" size="20" /></td>
            </tr>
            <tr>
                <td>Equipos:</td>
                <td>
                        <div id="txt_equipo"></div>
                </td>
            </tr>
            <tr>
                <td>Perfil:</td>
                <td>
                    <select id="txt_perfil" class="multiselect_simple filter">
                        <?
                            foreach($PROFILES as $id => $perfil){
                        ?>
                        <option value="<?=$id?>"><?=$perfil?></option>
                        <?
                            }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <input id="details_ok" type="button" class="button" value="guardar" />
                </td>
            </tr>
        </table>
</div>
<br /><br /><br /><br /><br /><br />
<div style="text-align: left;padding-left: 10px;padding-right: 10px;">
    <input id="nuevo" type="button" class="button" value="nuevo" />
    <div id="List">
    </div>
</div>

<?
    require_once   'footer.php';
?>