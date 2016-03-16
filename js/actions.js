var TKTID = 0;
var EXTRA = null;
/**
 * Accion para cargar formulario
 * @param {string} accion
 * @param [Object] extra    extra data
 * @returns {undefined}
 */
function getform(accion,extra) {
    $("#popup_form").html(JAVA_LOADING);
    $("#popup_form").dialog();
    EXTRA=extra;
    postControl.sendRequest(
            true,
            'tktgetform', $.extend(
            {
                'class': 'action',
                method: 'getform',
                action: accion,
                idtkt: TKTID
            },EXTRA
            ),
            function(data) {
                if (data.result === "ok") {
                    $("#popup_form").html(data.html);
                    $("#popup_form").dialog({
                        title: "Actualizar itracker " + TKTID + " -> " + accion,
                        resizable: false,
                        width: 800,
                        height: 'auto',
                        modal: true,
                        draggable: true
                    });
                    build_buttons();
                } else {
                    $("#popup_form").dialog('close');
                    alert_p(data.html, "Error");

                }
            },
            function(data) {
                $("#popup_form").dialog('close');
                alert_p(data, "Error");
            }
    );
}

/**
 * Ejecuta accion
 * @param {string} accion
 * @param [Object] extra    extra data
 * @returns {undefined}
 */
function go(accion) {
    var data = serialize_form('actionform');
    if (data == -1) {
        alert_p("No puedes utilizar < o > en los textos");
        return;
    }
    $("#ejecutando_accion").html(JAVA_LOADING + " Guardando...");
    postControl.sendRequest(
            true,
            'tktaction',$.extend(
            {
                'class': 'action',
                method: 'ejecute',
                action: accion,
                idtkt: TKTID,
                sendfiles: 'true',
                form: data

            },EXTRA),
    function(data) {
        $("#ejecutando_accion").html("");
        //{"type":"array","result":{"result":"ok","msj":"","openother":"","id":"336","tkth":"ok","sendfiles":"ok"},"status":"ok"}
        if (data.status === "ok") {
            var result = data.result;
            if (result.result === "ok") {
                show_details(TKTID);
                try {
                    $("#popup_form").dialog('close');
                } catch (e) {
                }
                if (result.postactions !== 'ok') {
                    alert_p('Ocurrio un error inesperado, comuniquese con su soporte. ' + result.postactions, 'Error');
                }
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
                alert_p(data,'error');
            }
    );
}

/**
 * Carga detalles en #popup_detalles
 * @param {int} id
 * @returns {undefined}
 */
function show_details(id) {
    $("#popup_detalles").html(JAVA_LOADING);
    $("#popup_detalles").dialog({title: "Cargando"});
    TKTID = id;
    postControl.sendRequest(
            false,
            'openview',
            {
                'class': 'tkt',
                method: 'geth',
                id: id
            },
    function(data) {
        if (data.result === "ok") {
            $("#popup_detalles").html('<div id="div_contenido" style="width:100%;height:100%">' + data.html + "</div>");
            $("#popup_detalles").dialog('close');
            $("#popup_detalles").dialog({
                title: "itracker " + TKTID,
                resizable: false,
                width: 800,
                height: 500,
                modal: true,
                draggable: true,
                position: {
                    my: 'top',
                    at: 'top',
                    of: $(window)
                }
            });
            $("#div_contenido").tinyscrollbar();
            build_buttons();
        } else {
            $("#popup_detalles").dialog('close');
            alert_p(data.html, "error");
        }

    },
            function(data) {
                $("#popup_detalles").dialog('close');
                alert_p(data, "error");
            }
    );

}