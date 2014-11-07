var DelID = 0;
var UpdID = 0;
var mode_details = 0;
function main() {
    $("#nuevo").click(function() {
        clear_popup();
        show_details();
    });

    $("#details_ok").click(function() {
        if (mode_details) {
            //reg_update();
        }
        else
            reg_insert();

    });
    refresh_List();
}
function refresh_List() {
    postControl.sendRequest(
            true,
            'userlist',
            {
                class: 'user',
                method: 'list'
            },
    function(data) {
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


function clear_popup() {
    mode_details = 0;
    $("#txt_nombre").val("");
    $("#txt_mail").val("");
    $("#txt_telefono").val("");
    $("#txt_puesto").val("");
    $("#txt_ubicacion").val("");
    $("#txt_usr").val("");
    $("#txt_dominio").idSEL(
            {
                class: 'user',
                method: 'idsel_domains',
                multiple: false

            }
    );
    $("#txt_fronts").idSEL(
            {
                class: 'instance',
                method: 'idsel_listfronts',
                multiple: true

            }
    );
    $("#txt_perfil").idSEL(
            {
                class: 'user',
                method: 'idsel_profiles',
                multiple: false

            }
    );
    $("#txt_equipos").idSEL(
            {
                class: 'user',
                method: 'idsel_myadmteams',
                multiple: true

            }
    );

}

function show_details() {
    $("#reg_details").dialog({title: 'Detalles del equipo', resizable: false, width: 370, height: 410});
}


function close_details() {
    $("#reg_details").dialog('close');
}

function show_update(data) {

    mode_details = 1;
    UpdID = data.usr;
    $("#txt_nombre").val(data.nombre);
    $("#txt_mail").val(data.mail);
    $("#txt_telefono").val(data.telefono);
    $("#txt_puesto").val(data.puesto);
    $("#txt_ubicacion").val(data.ubicacion);
    $("#txt_usr").val(data.usr);
    $("#txt_dominio").idSEL(
            {
                class: 'user',
                method: 'idsel_domains',
                multiple: false,
                checkedlist: data.dominio

            }
    );
    $("#txt_fronts").idSEL(
            {
                class: 'instance',
                method: 'idsel_listfronts',
                multiple: true,
                checkedlist: data.fronts

            }
    );
    $("#txt_perfil").idSEL(
            {
                class: 'user',
                method: 'idsel_profiles',
                multiple: false,
                checkedlist: data.perfil

            }
    );
    $("#txt_equipos").idSEL(
            {
                class: 'user',
                method: 'idsel_myadmteams',
                multiple: true,
                checkedlist: data.idsequipos

            }
    );
    show_details();
}



function reg_insert() {
        postControl.sendRequest(
            true,
            'userinsert',
            {
                class: 'user',
                method: 'insert',
                usr:$("#txt_usr").val(),
                dominio: $("#txt_dominio").val(),
                nombre: $("#txt_nombre").val(),
                mail:$("#txt_mail").val(),
                tel:$("#txt_telefono").val(),
                puesto:$("#txt_puesto").val(),
                ubicacion:$("#txt_ubicacion").val(),
                perfil:$("#txt_perfil").val(),
                fronts:array_txt($("#txt_fronts").val()),
                idsequipos:array_txt($("#txt_equipos").val())
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

/*
 function reg_delete(id) {
 DelID = id;
 confirm_p("Desea eliminar?", "Confirmar",
 function() {
 if (!postControl.setIfClear())
 return;
 $.post("includes/ajaxQ/USER_delete.php",
 {
 id: DelID
 },
 function(data) {
 postControl.clearPosting();
 if (data == "ok")
 refresh_List();
 else
 alert_p(data, "Error");
 }
 );
 }
 );
 }
 function load_update(id, idequipo, perfil) {
 UpdID = id;
 $("#txt_id").val(id);
 $("#txt_id").attr("disabled", "disabled");
 $("#txt_equipo").idSEL({table: 'teams_type', defaultID: idequipo, multiple: 'true'});
 $("#txt_perfil").val(perfil);
 mode_details = 1;
 show_details();
 }
 
 function reg_update() {
 if (!postControl.setIfClear())
 return;
 $.post("includes/ajaxQ/USER_update.php",
 {
 id: UpdID,
 idsequipos: array_txt($("#txt_equipo").val()),
 perfil: $("#txt_perfil").val()
 },
 function(data) {
 postControl.clearPosting();
 if (data == "ok")
 {
 refresh_List();
 close_details();
 }
 else
 alert_p(data, "Error");
 }
 );
 }
 */