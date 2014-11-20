<script src="js/actions.js" type="text/javascript"></script>

<div>
    <div><h2>INBOX</h2></div>
</div>
<br />


<div class="popup" id="popup_detalles" ></div>
<div class="popup" id="popup_childs" ></div>
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

<?
// <editor-fold defaultstate="collapsed" desc="Filtro barra">
echo filter_bar('
<table >
    <tr>
        <td>
            <div id="txt_area_select"></div>    
        </td>
         
        <td>
                <select id="txt_filtro" class="multiselect_simple">
                    <option value="open">Abiertos</option>
                    <option value="my">Mis TKT</option>
                    <option value="myNtom" SELECTED>Mios y no tomados</option>
                    <option value="free">Sin tomar</option>
                    <option value="taken">Tomados</option>
                    <option value="closed">Cerrados entre...</option>

                </select>
        </td>
        <td >
            <input type="button" id="filtrar" class="button" value="Filtrar" />
        </td>
    </tr>
    <tr>
        <td colspan="3">
            <div id="div_fechas" style="display:none;">
                    <font style="font-size:15px;color:#0A266B;font-weight:bold;">ENTRE
                    <input id="fecha_d" type="text" class="tmpck" />
                    Y
                    <input id="fecha_h" type="text" class="tmpck" />
                    </font>
                </div>
        </td>
    </tr>
</table>



',"width:300px;");
//</editor-fold>
?>


<br/>
<br/>

<div id="List"></div>

<div>
    <div><h2>ULTIMOS SOLUCIONADOS</h2></div>
</div>

<div id="ListRC"></div>
