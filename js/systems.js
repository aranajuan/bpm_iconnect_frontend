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
            'systemlist',
            {
                class: 'system',
                method: 'list'
            },
    function(data) {
        $("#List").html(data.html);
        $("#tablelist").dataTable(
                {
                    "bJQueryUI": true,
                    "sPaginationType": "full_numbers",
                    "bAutoWidth": false
                });
    },
            function(data) {
                $("#List").html(data);
            }
    );
}

/**
 * Limpia variables y form
 * @returns {undefined}
 */
function clear_popup() {
    mode_details = 0;
    DelID = 0;
    UpdID = 0;
    $("#txt_nombre").val("");
}

/**
 * Muestra popup
 * @returns {undefined}
 */
function show_details() {
    $("#reg_details").dialog({
        title: 'Detalles del sistema',
        resizable: false,
        width: 380,
        height: 150
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
                        'systemdelete',
                        {
                            class: 'system',
                            method: 'delete',
                            id: DelID
                        },
                function(data) {
                    if (data.type === "array") {
                        if (data.result === "ok") {
                            refresh_List();
                        } else {
                            alert_p(data.result, "Error");
                        }
                    } else {
                        alert_p(data.html, "Error");
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
            'systemupdate',
            {
                class: 'system',
                method: 'update',
                id: UpdID,
                nombre: $("#txt_nombre").val()
            },
    function(data) {
        if (data.type === "array") {
            if (data.result === "ok") {
                refresh_List();
                close_details();
            } else {
                alert_p(data.result, "Error");
            }
        } else {
            alert_p(data.html, "Error");
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
            'systeminsert',
            {
                class: 'system',
                method: 'insert',
                nombre: $("#txt_nombre").val()
            },
    function(data) {
        if (data.type === "array") {
            if (data.result === "ok") {
                refresh_List();
                close_details();
            } else {
                alert_p(data.result, "Error");
            }
        } else {
            alert_p(data.html, "Error");
        }

    },
            function(data) {
                alert_p(data, "Error");
            }
    );
}
