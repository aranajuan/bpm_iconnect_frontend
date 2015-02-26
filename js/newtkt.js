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
    function (data) {
        $("#tree").html(data.html);
        build_buttons();
    },
            function (data) {
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
    function (data) {
        //{"type":"array","result":{"result":"ok","msj":"","openother":"","id":"336","tkth":"ok","sendfiles":"ok"},"status":"ok"}
        if (data.status == "ok") {
            var result = data.result;
            if (result.result === "ok") {
                if (result.tkth == "ok") {
                    $("#tree").html("<h2>Se gener&oacute; el <a href='?L=mytkts&id=" + result.id + "'>itracker " + result.id + "</a></h2><br/>Puedes darle seguimiento desde <b>Generados</b> ingresando por el menu.");
                } else {
                    $("#tree").html("<h2>Se gener&oacute; el <a href='?L=mytkts&id=" + result.id + "'>itracker " + result.id + "</a></h2><br/>Puedes darle seguimiento desde <b>Generados</b> ingresando por el menu.");
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
            function (data) {
                alert_p(data);
            }
    );
}
