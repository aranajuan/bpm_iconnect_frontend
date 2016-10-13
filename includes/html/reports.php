<div>
    <div><h2>REPORTES</h2></div>
</div>


<div>
    <b>Extraer datos:</b><br/>
    <select id="filtro_origen" class="multiselect_simple">
        <option value="generadorpor" >Generado por</option>
        <option value="tratadopor">Tratado por</option>
    </select>
    <div style="display:inline;" id="teams" ></div>
    <br/><br/>
    <select id="filtro_fechas" class="multiselect_simple">
        <option value="apertura" >Generado entre</option>
        <option value="actualizado">Actualizado entre</option>
    </select>
    <div style="display:inline;">
        <input type="text" id="desde" class="dtpck"/> y 
        <input type="text" id="hasta" class="dtpck"/>
    </div>
    
    <?
        if($U->get_prop('superuser')){?>
            <br/><br/>
            <div style="display:inline;">
                <b>Avanzado:</b>(dejar en blanco para no modificar el reporte)<br/>
                <textarea id="avanzado" rows="20" cols="100"></textarea>
            </div>
    <?
        }
    ?>
    <br/><br/>
    <?= option_button("Generar",90, 0 ,"report()")?>
</div>
<br/>