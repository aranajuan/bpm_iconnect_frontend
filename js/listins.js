var DelID = 0;
var UpdID = 0;
var mode_details = 0;

/**
 * Setea funciones y carga tabla inicial
 * @returns {undefined}
 */
function main() {
    $("#nuevo").click(function() {
        clear_popup();
        show_details();
    });
    $("#details_ok").click(function() {
        if (mode_details)
            reg_update();
        else
            reg_insert();
    });
    refresh_List();
}

/**
 * Carga tabla
 * @returns {undefined}
 */
function refresh_List() {
    postControl.sendRequest(
            true,
            'listinlist',
            {
                class: 'listin',
                method: 'listabm'
            },
    function(data) {
        $("#List").html(data.html);
        $("#listaListin").dataTable(
                {
                    "bJQueryUI": true,
                    "sPaginationType": "full_numbers",
                    "bAutoWidth": false
                });
    },
            null
            );

}

/**
 * Limpia variables y form
 * @returns {undefined}
 */
function clear_popup() {
    mode_details = 0;
    UpdID = 0;
    DelID = 0;
    $("#txt_nombre").val("");
    $("#txt_to").val("");
    $("#txt_cc").val("");
}

/**
 * Muestra popup
 * @returns {undefined}
 */
function show_details() {
    $("#reg_details").dialog({
        title: 'Detalles del listin',
        resizable: false,
        width: 400,
        height: 290
    });
}

/**
 * Cierra popup
 * @returns {undefined}
 */
function close_details() {
    $("#reg_details").dialog('close');
}

/**
 * 
 * @param {type} id
 * @returns {undefined}
 */
function show_delete(id) {
    DelID = id;
    confirm_p("Desea eliminar?", "Confirmar",
            function() {
                postControl.sendRequest(
                        true,
                        'listindelete',
                        {
                            class: 'listin',
                            method: 'delete',
                            id: DelID
                        },
                function(data) {
                    if (data.result === "ok") {
                        refresh_List();
                    } else {
                        alert_p(data.result, "Error");
                    }

                },
                        function(data) {
                            alert_p(data, "Error");
                        }
                );
            }
    );

}

/**
 * Carga form, muestra popup
 * @param {type} data
 * @returns {undefined}
 */
function show_update(data) {
    UpdID = data.id;
    $("#txt_nombre").val(data.nombre);
    $("#txt_to").val(data.too);
    $("#txt_cc").val(data.cc);
    mode_details = 1;
    show_details();
}

/**
 * Ejecuta atualizacion
 * @returns {unresolved}
 */
function reg_update() {
    postControl.sendRequest(
            true,
            'listinupdate',
            {
                class: 'listin',
                method: 'update',
                id: UpdID,
                nombre: $("#txt_nombre").val(),
                too: $("#txt_to").val(),
                cc: $("#txt_cc").val()
            },
    function(data) {
        if (data.result === "ok") {
            refresh_List();
            close_details();
        } else {
            alert_p(data.result, "Error");
        }

    },
            function(data) {
                alert_p(data, "Error");
            }
    );

}

/**
 * Ejecuta insert
 * @returns {unresolved}
 */
function reg_insert() {

    postControl.sendRequest(
            true,
            'listininsert',
            {
                class: 'listin',
                method: 'insert',
                nombre: $("#txt_nombre").val(),
                too: $("#txt_to").val(),
                cc: $("#txt_cc").val()
            },
    function(data) {
        if (data.result === "ok") {
            refresh_List();
            close_details();
        } else {
            alert_p(data.result, "Error");
        }

    },
            function(data) {
                alert_p(data, "Error");
            }
    );

}