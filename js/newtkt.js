var DelID = 0;
var UpdID = 0;
var mode_details = 0;
var go_status = "clear";

function main() {
    load_tree("");
}

/**
 * Carga opciones del arbol
 * @param {type} path
 * @returns {undefined}
 */
function load_tree(path) {
    postControl.sendRequest(
            true,
            'treeoptions',
            {
                'class': 'tkt',
                method: 'get_tree_options',
                path: path
            },
    function(data) {
        $("#tree").html(data.html);
        build_buttons();
    },
            function(data) {
                $("#tree").html(data);
            }
    );
}

function go(path) {
    var data = serialize_form('actionform');
    if (data == -1) {
        alert_p("No puedes utilizar < o > en los textos");
        return;
    }
    $("#ejecutando_accion").html(JAVA_LOADING + " Guardando...");
    postControl.sendRequest(
            true,
            'tktopen',
            {
                'class': 'action',
                method: 'ejecute',
                action: 'abrir',
                sendfiles: 'true',
                path: path,
                form: data
            },
    function(data) {
        $("#ejecutando_accion").html("");
        //{"type":"array","result":{"result":"ok","msj":"","openother":"","id":"336","tkth":"ok","sendfiles":"ok"},"status":"ok"}
        if (data.status == "ok") {
            var result = data.result;
            if (result.result === "ok") {
                if (result.type == 'file') {
                    var text = "<h2>Se gener&oacute; el <a href='?L=mytkts&id=" + result.id + "'>itracker " + result.id + "</a></h2>";
                    if (ValidUrl(result.file)) {
                        text += "<h2>Por favor remitase al siguiente&nbsp;<a href='" + result.file + "' target='_blank'>LINK</a>. El ticket fue cerrado.</h2>";
                    } else {
                        text += "<h2>Por favor remitase al siguiente&nbsp;<a href='?class=tkt&method=downloadfile&type=anexo&file=" + result.file + "' target='_blank'>LINK</a>. El ticket fue cerrado.</h2>";
                    }
                } else {
                    text = "<h2>Se gener&oacute; el <a href='?L=mytkts&id=" + result.id + "'>itracker " + result.id + "</a></h2><br/>Puedes darle seguimiento desde <b>Generados</b> ingresando por el menu.";
                    if (result.openother == 1) {
                        text += "<br/>" + "<a href=\"javascript:load_tree('" + path + "')\">Abrir otro igual</a>";
                    }
                }
                if (result.msj) {
                    text += '<br/><b>' + result.msj + '</b>';
                }
                if(result.info && result.info!=''){
                	alert_p(result.info, "Informacion");
                }
                $("#tree").html(text);
            } else {
                alert_p(result.msj, "Error");
            }
        } else {
            if (data.html) {
                alert_p(data.html, "Error");
            }
        }
    },
            function(data) {
                $("#ejecutando_accion").html("");
                alert_p(data);
            }
    );
}


function get_similar(path) {
    if (IsNumeric($("#actionform_idmaster").val()) || $("#actionform_idmaster").val() === 'NULL') {
        go(path);
        return;
    }
    var data = serialize_form('actionform');
    if (data == -1) {
        alert_p("No puedes utilizar < o > en los textos");
        return;
    }
    $("#ejecutando_accion").html(JAVA_LOADING + " Guardando...");
    postControl.sendRequest(
            true,
            'tktsimilars',
            {
                'class': 'tkt',
                method: 'getsimilars',
                path: path,
                form: data
            },
    function(data) {
        $("#ejecutando_accion").html("");
        if (data.status == "ok") {
            if (data.html == "sin_elementos") {
                go(path);
            } else {
                show_similars(data.html);
            }
        } else {
            alert_p(data.html, "Error");
        }
    },
            function(data) {
                $("#ejecutando_accion").html("");
                alert_p(data);
            }
    );
}

function show_similars(html) {
    $("#popup_similars").html('<div id="div_contenido" style="height: 450px;width:100%;">' + html + "</div>");
    $("#popup_similars").dialog({
        title: "Similares",
        width: 750,
        height: 500,
        resizable: false,
        modal: true,
        draggable: true,
        position: {
            my: 'top',
            at: 'top',
            of: $(window)
        }
    });
    $("#div_contenido").tinyscrollbar();
}

function clear_master() {
    $("#actionform_idmaster").val('');
    $("#msj_master").html("");
}

function add_go(path) {
    var chosen;
    chosen = $('input[name=Sel_similar]:checked').val();
    if (chosen === undefined) {
        alert_p("Por favor seleccione una opcion", "Error");
        return;
    }
    $("#popup_similars").dialog('close');
    $("#actionform_idmaster").val(chosen);
    if (IsNumeric(chosen) && chosen>0) {
        $("#msj_master").html("Se anexar&aacute; al ticket " + $("#actionform_idmaster").val() + "  <img class=\"img_lnk\" src=\"img/b_drop.png\" onclick=\"clear_master();\"/>");
    } else {
        $("#msj_master").html("No se anexar&aacute; a ning&uacute;n ticket <img class=\"img_lnk\" src=\"img/b_drop.png\" onclick=\"clear_master();\"/>");
    }
    go(path);
}
