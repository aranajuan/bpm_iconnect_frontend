<div>
    <div><h2>REPORTES</h2></div>
</div>


<div>
    Extraer datos:<br/>
    <select id="filter" class="multiselect_simple">
        <option value="from" >Generado por</option>
        <option value="to">Tratado por</option>
    </select>
    <div id="teams" ></div>
    <br/>
    entre:
    <div>
        <input type="text" id="desde" class="dtpck"/> y 
        <input type="text" id="hasta" class="dtpck"/>
    </div>
    Seleccione un rango no mayor a 31 dias
    <br/><br/>
    <?= menu_button("DESCARGAR", "report()"); ?>

</div>
<br/>