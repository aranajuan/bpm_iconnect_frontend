<?
    require_once   'header.php';
?>

<!-- FORMULARIO -->
<div style="margin-top:50px;">
    <table>
        <tr>
            <td>
                IDS
            </td>
            <td>
                <input type="text" id="ids" />
            </td>
            <td>
                filtrar ids especificos separado / dejar en blanco para ignorar
                este filtro anulará el resto.
            </td>
        </tr>
        <tr>
            <td>
                USUARIO
            </td>
            <td>
                <input type="text" id="usrs" disabled="disabled"  /><img src="<?=HIMG_DIR?>/b_search.png" class="img_lnk popup_open" id="usrs_search"/>
            </td>
            <td>
                usuarios que generan los tkts // pendiente de areas reporting pedazo de gato!!!
            </td>
        </tr>
        <tr>
            <td>
                MASTER
            </td>
            <td>
                <input type="text" id="master" value="*" />
            </td>
            <td>
                * cualquiera / ninguno <br/>
                X cualquiera
            </td>
        </tr>
        <tr>
            <td>
                ORIGEN
            </td>
            <td>
                <input type="text" id="origen" disabled="disabled" /><img src="<?=HIMG_DIR?>/b_search.png" class="img_lnk popup_open" id="origen_search"/>
            </td>
            <td>
                Repuestas en el arbol
            </td>
        </tr>
        <tr>
            <td>
                AREA ASIGNADA
            </td>
            <td>
                <input type="text" id="area" value="*" /><img src="<?=HIMG_DIR?>/b_search.png" />
            </td>
            <td>
                Area a la que se le asigno el tkt
            </td>
        </tr>
        <tr>
            <td>
                Utom
            </td>
            <td>
                <input type="text" id="utom" value="*" /><img src="<?=HIMG_DIR?>/b_search.png" />
            </td>
            <td>
                Usuario que tiene el tkt
            </td>
        </tr>
        <tr>
            <td>
                Uasig
            </td>
            <td>
                <input type="text" id="uasig" value="*" /><img src="<?=HIMG_DIR?>/b_search.png" />
            </td>
            <td>
                Usuario que asigno el tkt
            </td>
        </tr>
        <tr>
            <td>
                Prioridad
            </td>
            <td>
                <input type="text" id="prioridad" value="*" /><img src="<?=HIMG_DIR?>/b_search.png" />
            </td>
            <td>
                Prioridada asignada al tkt
            </td>
        </tr>
        <tr>
            <td>
                Fecha alta
            </td>
            <td>
                <input type="text" id="FA" value="*" /><img src="<?=HIMG_DIR?>/b_search.png" />
            </td>
            <td>
                Fecha de creacion del tkt
            </td>
        </tr>
        <tr>
            <td>
                Usuario cierre
            </td>
            <td>
                <input type="text" id="UB" value="*" /><img src="<?=HIMG_DIR?>/b_search.png" />
            </td>
            <td>
                * cualquiera / ninguno <br/>
                X cualquiera
            </td>
        </tr>
        <tr>
            <td>
               Fecha cierre
            </td>
            <td>
                <input type="text" id="FB" value="*" /><img src="<?=HIMG_DIR?>/b_search.png" />
            </td>
            <td>
                * cualquiera / ninguno <br/>
                X cualquiera
            </td>
        </tr>
    </table>
</div>
<!-- POPUPS -->
<div id="popup_usrs" class="popup">
    Mis equipos:
    <table>
        <tr>
            <td>
                Equipos completos
            </td>
            <td>
                <div id="popup_usrs_my_teams"></div>
            </td>
        </tr>
        <tr>
            <td>
                Usuarios
            </td>
            <td>
                <div id="popup_usrs_my_usrs" ></div>
            </td>
        </tr>
    </table>
    <input type="button" id="popup_usrs_ok" class="button" value="OK" />
</div>
                
<div id="popup_origen" class="popup">
    Busque en el arbol:
    <table>
        <tr>
            <td>
                <div id="popup_origen_tree" />
            </td>
        </tr>
    </table>
</div>
<?
    require_once   'footer.php';
?>