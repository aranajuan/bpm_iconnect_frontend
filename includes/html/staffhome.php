<?
    require_once   'header.php';
?>
<script src="<?=HINCLUDE_DIR;?>/js/actions.js" type="text/javascript"></script>
<link rel="stylesheet" media="all" type="text/css" href="<?=HINCLUDE_DIR;?>/css/tkt_details.css" />

<div>
    <div><h2>STAFF HOME</h2></div>
</div>
<br />


<div class="popup" id="popup_detalles" ></div>
<div class="popup" id="popup_childs" ></div>
<div class="popup" id="popup_form"></div>

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
                    <option value="all">Todos</option>
                    <option value="my">Mis TKT</option>
                    <option value="myNtom" SELECTED>Mios y no tomados</option>
                    <option value="free">Sin tomar</option>
                    <option value="taken">Tomados</option>
                    <option value="ext_tkt">Ticket externo</option>
                    <option value="closed">Cerrados entre...</option>

                </select>
        </td>
        <td >
            <input type="button" onclick="load_filter();" class="button" value="Flitrar" />
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
                <div id="div_ext_tkt" style="display:none;">
                    <select id="ext_type" name="ext_type" class="multiselect_simple">
                        <option value="ext_sd" >SD</option>
                        <option value="ext_im" >IM</option>
                        <option value="ext_rq_simplit">RQ SIMPLIT</option>
                        <option value="ext_rq_needit" >RQ NEEDIT</option>
                        <option value="ext_pm">PM</option>
                    </select>
                    <input id="ext_number" name="number_ext" type="text" size="20" />
                    <br />
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
<?
    require_once   'footer.php';
?>