<div style="float:left;padding-left: 10px; ">
    <div><h2>ABM USUARIOS</h2></div>
</div>

<div id="reg_details" class="popup">
    <table>
        <tr>
            <td>Dominio:</td>
            <td>
                <div id="txt_dominio"></div>
            </td>
        </tr>
        <tr>
            <td>Usuario:</td>
            <td><input id="txt_usr" type="text" size="20" /></td>
        </tr>
        <tr>
            <td>Nombre:</td>
            <td><input id="txt_nombre" type="text" size="20" /></td>
        </tr>
        <tr>
            <td>Mail:</td>
            <td><input id="txt_mail" type="text" size="20" /></td>
        </tr>
        <tr>
            <td>Telefono:</td>
            <td><input id="txt_telefono" type="text" size="20" /></td>
        </tr>
        <tr>
            <td>Puesto:</td>
            <td><input id="txt_puesto" type="text" size="20" /></td>
        </tr>
        <tr>
            <td>Ubicacion:</td>
            <td><input id="txt_ubicacion" type="text" size="20" /></td>
        </tr>
        <tr>
            <td>Fronts:</td>
            <td>
                <div id="txt_fronts"></div>
            </td>
        </tr>
        <tr>
            <td>Perfil:</td>
            <td>
                <div id="txt_perfil"></div>
            </td>
        </tr>
        <tr>
            <td>Equipos:</td>
            <td>
                <div id="txt_equipos"></div>
            </td>
        </tr>

        <tr>
            <td colspan="2">
                <br/>
                <input id="details_ok" type="button" class="button" value="Guardar" />
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input id="details_sesionc" type="button" class="button" value="Cerrar sesiones" />
            </td>
        </tr>
    </table>
</div>
<br /><br /><br /><br /><br />
<? echo filter_bar('
    <table>
        <tr>
            <td>
                <input type="text" id="txt_usr_search" size="10" />
            </td>
            <td>
                <input type="button" id="buscar_usr" class="button" value="Buscar por usuario" />
            </td>
        </tr>
    </table>
 ','width:622px;');?> 
 
 <?
// <editor-fold defaultstate="collapsed" desc="Filtro barra">
echo filter_bar('
<table >
    <tr>
       
        <td>
            <div id="txt_equipos_filter"></div>
        </td>
        <td >
            <input type="button" id="filtrar" class="button" value="filtrar" />
        </td>
        <td >
            <input id="nuevo" type="button" class="button" value="crear nuevo" />
        </td>
    </tr>
    
</table>



',"width:300px;");
//</editor-fold>
?>
 

<div style="text-align: left;padding-left: 10px;padding-right: 10px;">
    <div id="List">
    </div>
</div>