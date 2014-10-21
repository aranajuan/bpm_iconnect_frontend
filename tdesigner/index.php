<!doctype html>
<?
require_once '../includes/init.php';
?>
<html>
    <head>
        <title>jsPlumb 1.5.2 - draggable connectors - jQuery</title>
        <meta http-equiv="content-type" content="text/html;charset=utf-8" />
        <link rel="stylesheet" media="all" type="text/css" href="<?= HINCLUDE_DIR; ?>/css/tdesigner.css" />
        <link rel="stylesheet" media="all" type="text/css" href="<?=HINCLUDE_DIR;?>/css/base.css" />
        <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
        <meta http-equiv="Pragma" content="no-cache">
        <meta http-equiv="Expires" content="0">
        <? require_once 'js/jq.php'; ?>


    </head>
    <body data-demo-id="draggableConnectors" data-library="jquery">

        <!-- css tdesigner -->
        <div id="STATUS" ></div>
        Cargar XML : <input type="file" id="files" name="files" multiple />
        <div><a href="#" onclick="javascript:$('._jsPlumb_connector').css('z-index',20)">Lineas atras</a> ----- <a href="#" onclick="javascript:$('._jsPlumb_connector').css('z-index',100)">Lineas adelante</a> ----- <a href="#" onclick="javascript:jsPlumb.repaintEverything();">ReDibujar</a>  --- <a href="#" onclick="javascript:change();">modificar</a> --- <a href="#" onclick="javascript:zoom_out();">zoom out</a></div>
        <div id="ALL" >

        </div>
        <div id="option_edit" class="popup">
            <input type="hidden" id="option_id" />
            <table>
                <tr>
                    <td>
                        Texto
                    </td>
                    <td>
                         <input type="text" id="option_texto" size="30" />
                    </td>
                </tr>
                <tr>
                    <td>
                        Texto critico
                    </td>
                    <td>
                         <input type="text" id="option_texto_critico" size="30" />
                    </td>
                </tr>
                <tr>
                    <td>
                        Destino
                    </td>
                    <td>
                        <div>
                            <select id="option_destiny">
                                <option value="team">Equipo</option>
                                <option value="question">Pregunta</option>
                                <option value="file">Archivo</option>
                            </select>
                            <input type="button" id="option_destiny_BT" value="..." />
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        Autocerrar
                    </td>
                    <td>
                        <input type="checkbox" id="option_autocerrar" />
                    </td>
                </tr>
                <tr>
                    <td>
                        No anexar
                    </td>
                    <td>
                        <input type="checkbox" id="option_no_anexar" />
                    </td>
                </tr>
            </table>
           
            
            
        </div>
        <div id="question_edit" class="popup">
            
        </div>
        <div id="ALLJ" >

        </div>        
        <script src="configs.js" type="text/javascript"></script>
        <? require 'js/jq/jsPlumb/jsPlumb.php' ?>
        <script src="tdesigner.js" type="text/javascript"></script>
        <script src="../includes/js/jq/tdesigner.js" type="text/javascript"></script>
    </body>
</html>
