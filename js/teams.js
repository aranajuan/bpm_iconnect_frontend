var DelID = 0;
var UpdID = 0;
var mode_details = 0;


function main() {


    $("#nuevo").click(function () {
        clear_popup();
        show_details();
    });

    $("#details_ok").click(function () {
        if (mode_details)
            reg_update();
        else
            reg_insert();
    });

    refresh_List();



}

/**
 * Prepara popup para insert
 * @returns {undefined}
 */
function clear_popup() {
    mode_details = 0;
    $("#txt_direccion").idSEL(
            {
                'class': 'division',
                method: 'idsel_list',
                multiple: false

            }
    );

    $("#txt_equiposderiva").idSEL(
            {
                'class': 'team',
                method: 'idsel_listall',
                multiple: true

            }
    );
    $("#txt_equiposvisible").idSEL(
            {
                'class': 'team',
                method: 'idsel_listall',
                multiple: true

            }
    );

    $("#txt_listin").idSEL(
            {
                'class': 'listin',
                method: 'idsel_list',
                multiple: false

            }
    );
    $("#txt_nombre").val("");
    $("#txt_vistainbox").val("");
    $("#txt_vistamytkts").val("");
    $("#txt_adms").val("");
}

/**
 * Abre popup
 * @returns {undefined}
 */
function show_details() {
    $("#reg_details").dialog({
        title: 'Detalles del equipo',
        resizable: false,
        width: 490,
        height: 400
    });
}


function show_update(data) {
    UpdID = data.id;
    $("#txt_nombre").val(data.nombre);

    $("#txt_direccion").idSEL(
            {
                'class': 'division',
                method: 'idsel_list',
                multiple: false,
                checkedlist: data.iddireccion

            }
    );

    $("#txt_equiposderiva").idSEL(
            {
                'class': 'team',
                method: 'idsel_listall',
                multiple: true,
                checkedlist: data.idsequiposderiva

            }
    );
    $("#txt_equiposvisible").idSEL(
            {
                'class': 'team',
                method: 'idsel_listall',
                multiple: true,
                checkedlist: data.idsequiposvisible

            }
    );

    $("#txt_listin").idSEL(
            {
                'class': 'listin',
                method: 'idsel_list',
                multiple: false,
                checkedlist: data.idlistin

            }
    );


    $("#txt_conformidad").val(data.t_conformidad);

    $("#txt_vistainbox").val(data.staffhome_vista);
    $("#txt_vistamytkts").val(data.mytkts_vista);
    $("#txt_adms").val(data.idsadms);

    mode_details = 1;
    show_details();
}

/**
 * Carga tabla
 * @returns {undefined}
 */
function refresh_List() {
    postControl.sendRequest(
            true,
            'teamlist',
            {
                'class': 'team',
                method: 'list'
            },
    function (data) {
        $("#List").html(data.html);
        $("#tablelist").dataTable(
                {
                    "bJQueryUI": true,
                    "sPaginationType": "full_numbers",
                    "bAutoWidth": false
                });
    },
            function (data) {
                $("#List").html(data);
            }
    );
}


/**
 * Cierra popup
 * @returns {undefined}
 */
function close_details() {
    $("#reg_details").dialog('close');
}


/**
 * Elimina registro
 * @param {type} id
 * @returns {undefined}
 */
function show_delete(id) {
    DelID = id;
    confirm_p("Desea eliminar?", "Confirmar",
            function () {
                postControl.sendRequest(
                        true,
                        'teamdelete',
                        {
                            'class': 'team',
                            method: 'delete',
                            id: DelID
                        },
                function (data) {
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
                        function (data) {
                            alert_p(data, "Error");
                        }
                );
            }
    );

}

/**
 * Actualiza registro
 * @returns {unresolved}
 */
function reg_update() {
    postControl.sendRequest(
            true,
            'teamupdate',
            {
                'class': 'team',
                method: 'update',
                id: UpdID,
                nombre: $("#txt_nombre").val(),
                t_conformidad: $("#txt_conformidad").val(),
                iddireccion: $("#txt_direccion").val(),
                idlistin: $("#txt_listin").val(),
                idsadms: $("#txt_adms").val(),
                mytkts_vista: $("#txt_vistamytkts").val(),
                staffhome_vista: $("#txt_vistainbox").val(),
                idsequipos_deriva: array_txt($("#txt_equiposderiva").val()),
                idsequipos_visible: array_txt($("#txt_equiposvisible").val())
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
 * Inserta registro
 * @returns {unresolved}
 */
function reg_insert() {

    postControl.sendRequest(
            true,
            'teaminsert',
            {
                'class': 'team',
                method: 'insert',
                nombre: $("#txt_nombre").val(),
                t_conformidad: $("#txt_conformidad").val(),
                iddireccion: $("#txt_direccion").val(),
                idlistin: $("#txt_listin").val(),
                idsadms: $("#txt_adms").val(),
                mytkts_vista: $("#txt_vistamytkts").val(),
                staffhome_vista: $("#txt_vistainbox").val(),
                tipo: $("#sel_tipo").val(),
                idsequipos_deriva: array_txt($("#txt_equiposderiva").val()),
                idsequipos_visible: array_txt($("#txt_equiposvisible").val())
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
