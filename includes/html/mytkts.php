<script src="js/actions.js" type="text/javascript"></script>
<div >
    <div><h2>GENERADOS</h2></div>
</div>

<div class="popup" id="popup_detalles"></div>
<div class="popup" id="popup_form"></div>
<? echo filter_bar('
    <table>
        <tr>
            <td>
                <input type="text" id="txt_idtkt" size="10" />
            </td>
            <td>
                <input type="button" id="buscar_numero" class="button" value="Buscar por Numero" />
            </td>
        </tr>
    </table>
 ','width:622px;');?>   


<div >
    <div><h2>LISTA</h2></div>
</div>
<? echo filter_bar('
<table>
    <tr>
        <td valign="top">
            <select id="txt_filtro_estado" class="multiselect_simple">
                <option value="open">Abiertos</option>
                <option value="closed">Cerrados entre...</option>
            </select>    
        </td>
        <td valign="top">
            <select id="txt_filtro_origen" class="multiselect_simple">
                <option value="my">Mios</option>
                <option value="team">Equipo</option>
            </select>
            <div id="div_equipos" style="display:none;">
                    <div id="txt_filtro_equipo"></div>    
            </div> 
        </td>
        <td valign="top">
            <input type="button" onclick="refresh_list();" class="button" value="Actualizar" />
        </td>
    </tr>
    <tr>
        <td colspan="2">
             
            <div id="div_fechas" style="display:none;">
                <font style="font-size:15px;color:#0A266B;font-weight:bold;">
                    ENTRE:
                    <input id="fecha_d" type="text" class="tmpck" />
                    Y
                    <input id="fecha_h" type="text" class="tmpck" />
                </font>
            </div>
        </td>
    </tr>
</table>
','width:700px;');?>   

<br/>
<br />
<img src="img/thumbnail/xls.png" height="30" class="img_lnk" onclick="excel_link()" />
<div id="List"></div>


<div>
    <div><h2>ULTIMOS SOLUCIONADOS</h2></div>
</div>

<div id="ListClosed"></div>
