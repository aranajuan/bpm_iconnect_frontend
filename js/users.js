var DelID = 0;
var UpdID = 0;
var mode_details = 0;

function main() {
    $("#nuevo").click(function () {
        clear_popup();
        show_details();
    });

    $("#details_ok").click(function () {
        if (mode_details) {
            reg_update();
        }
        else
            reg_insert();

    });
    refresh_List();
}

/**
 * Actualiza lista de usuario que administra el usuario
 * @returns {undefined}
 */
function refresh_List() {
    postControl.sendRequest(
            true,
            'userlist',
            {
                'class': 'user',
                method: 'list'
            },
    function (data) {
        $("#List").html(data.html);
        $("#tablelist").dataTable(
                {
                    "bJQueryUI": true,
                    "sPaginationType": "full_numbers",
                    "bAutoWidth": true
                });
    },
            null
            );
}

/**
 * Limpia popup para insert
 * @returns {undefined}
 */
function clear_popup() {
    mode_details = 0;
    $("#txt_usr").prop("disabled", false);
    $("#txt_nombre").val("");
    $("#txt_mail").val("");
    $("#txt_telefono").val("");
    $("#txt_puesto").val("");
    $("#txt_ubicacion").val("");
    $("#txt_usr").val("");
    $("#txt_dominio").idSEL(
            {
                'class': 'user',
                method: 'idsel_domains',
                multiple: false

            }
    );
    $("#txt_fronts").idSEL(
            {
                'class': 'instance',
                method: 'idsel_listfronts',
                multiple: true

            }
    );
    $("#txt_perfil").idSEL(
            {
                'class': 'user',
                method: 'idsel_profiles',
                multiple: false

            }
    );
    $("#txt_equipos").idSEL(
            {
                'class': 'user',
                method: 'idsel_myadmteams',
                multiple: true

            }
    );

}

/**
 * Muestra popup
 * @returns {undefined}
 */
function show_details() {
    $("#reg_details").dialog({title: 'Detalles del usuario', resizable: false, width: 370, height: 410});
}

/**
 * Cierra popup
 * @returns {undefined}
 */
function close_details() {
    $("#reg_details").dialog('close');
}

/**
 * Carga datos para update y muestra popup
 * @param {type} data
 * @returns {undefined}
 */
function show_update(data) {

    mode_details = 1;
    UpdID = data.usr;
    $("#txt_usr").prop("disabled", true);
    $("#txt_nombre").val(data.nombre);
    $("#txt_mail").val(data.mail);
    $("#txt_telefono").val(data.telefono);
    $("#txt_puesto").val(data.puesto);
    $("#txt_ubicacion").val(data.ubicacion);
    $("#txt_usr").val(data.usr);
    $("#txt_dominio").idSEL(
            {
                'class': 'user',
                method: 'idsel_domains',
                multiple: false,
                checkedlist: data.dominio

            }
    );
    $("#txt_fronts").idSEL(
            {
                'class': 'instance',
                method: 'idsel_listfronts',
                multiple: true,
                checkedlist: data.fronts

            }
    );
    $("#txt_perfil").idSEL(
            {
                'class': 'user',
                method: 'idsel_profiles',
                multiple: false,
                checkedlist: data.perfil

            }
    );
    $("#txt_equipos").idSEL(
            {
                'class': 'user',
                method: 'idsel_myadmteams',
                multiple: true,
                checkedlist: data.idsequipos

            }
    );
    show_details();
}


/**
 * Ejecuta insert
 * @returns {undefined}
 */
function reg_insert() {
    postControl.sendRequest(
            true,
            'userinsert',
            {
                'class': 'user',
                method: 'insert',
                usr: $("#txt_usr").val(),
                dominio: $("#txt_dominio").val(),
                nombre: $("#txt_nombre").val(),
                mail: $("#txt_mail").val(),
                tel: $("#txt_telefono").val(),
                puesto: $("#txt_puesto").val(),
                ubicacion: $("#txt_ubicacion").val(),
                perfil: $("#txt_perfil").val(),
                fronts: array_txt($("#txt_fronts").val()),
                idsequipos: array_txt($("#txt_equipos").val())
            },
    function (data) {
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
            function (data) {
                alert_p(data, "Error");
            }
    );
}

/**
 * Ejecuta update en db
 * @returns {undefined}
 */
function reg_update() {
    postControl.sendRequest(
            true,
            'userupdate',
            {
                'class': 'user',
                method: 'update',
                usr: UpdID,
                dominio: $("#txt_dominio").val(),
                nombre: $("#txt_nombre").val(),
                mail: $("#txt_mail").val(),
                tel: $("#txt_telefono").val(),
                puesto: $("#txt_puesto").val(),
                ubicacion: $("#txt_ubicacion").val(),
                perfil: $("#txt_perfil").val(),
                fronts: array_txt($("#txt_fronts").val()),
                idsequipos: array_txt($("#txt_equipos").val())
            },
    function (data) {
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
            function (data) {
                alert_p(data, "Error");
            }
    );
}

/**
 * Elimina registro / todos los equipos del logueado
 */
function show_delete(id) {
    DelID = id;
    confirm_p("Desea eliminar?", "Confirmar",
            function() {
                postControl.sendRequest(
                        true,
                        'userdelete',
                        {
                            'class': 'user',
                            method: 'delete',
                            usr: DelID
                        },
                function(data) {
                    if (data.type === "array" && data.status==="ok") {
                        if (data.result.ejecute === "ok") {
                            if(data.result.msj){
                                alert_p(data.result.msj, "Informacion");
                            }
                            refresh_List();
                        } else {
                            alert_p(data.result.msj, "Error");
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
};
