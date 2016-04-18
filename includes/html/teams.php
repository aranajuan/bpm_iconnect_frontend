<div style="float:left;padding-left: 10px; ">
    <div><h2>ABM EQUIPOS</h2></div>
</div>

<div id="reg_details" class="popup">
        <table>
            <tr>
                <td>Nombre:</td>
                <td><input id="txt_nombre" type="text" size="40" /></td>
            </tr>
            <tr>
                <td>Direccion:</td>
                <td>
                        <div id="txt_direccion"></div>
                </td>
            </tr>
            <tr>
                <td>Tiempo de conformidad (HH:MM):</td>
                <td><input id="txt_conformidad" type="text" size="5" value="02:00" /></td>
            </tr>
            <tr>
                <td>Relaciona(deriva) con:</td>
                <td>
                        <div id="txt_equiposderiva"></div>
                </td>
            </tr>
            <tr>
                <td>Relaciona(visible) con:</td>
                <td>
                        <div id="txt_equiposvisible"></div>
                </td>
            </tr>
            <tr>
                <td>Equipos reporta</td>
                <td>
                        <div id="txt_equiposreporta"></div>
                </td>
            </tr>
            <tr>
                <td>Listin:</td>
                <td>
                    <div id="txt_listin"></div>
                </td>
            </tr>
            <tr>
                <td>Vista inbox:</td>
                <td>
                    <input id="txt_vistainbox" type="text" size="40" />
                </td>
            </tr>
            <tr>
                <td>Vista mytkts:</td>
                <td>
                    <input id="txt_vistamytkts" type="text" size="40" />
                    <br/><i>campo=>alias,funcion:parametro=>alias,<br/>objeto.prop=>alias</i>
                </td>
            </tr>
            <tr>
                <td>Adms</td>
                <td>
                    <input id="txt_adms" type="text" size="40" />
                    <br/><i>Separar(,)</i>
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
    <input id="actualizar" type="button" class="button" value="actualizar" />
    <div id="List">
    </div>
</div>