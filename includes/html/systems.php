<?
    require_once   'header.php';
?>

<div style="float:left;padding-left: 10px; ">
    <div><h2>ABM SISTEMAS</h2></div>
</div>

<div id="reg_details" class="popup">
        <table>
            <tr>
                <td>Nombre:</td>
                <td><input id="txt_nombre" type="text" size="40" /></td>
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