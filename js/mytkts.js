var showingteam = false;

function main() {
    $("#txt_filtro_estado").change(function () {
        if ($("#txt_filtro_estado").val() == "closed") {
            $("#div_fechas").show();
        }
        else
            $("#div_fechas").hide();
    });
    $("#txt_filtro_origen").change(function () {
        if ($("#txt_filtro_origen").val() == "team")
            $("#div_equipos").show();
        else
            $("#div_equipos").hide();
    });
    $("#txt_filtro_equipo").idSEL(
            {
                'class': 'user',
                method: 'idsel_listteams',
                multiple: true,
                params: {filter:'mytkts_vista'}
            });


    $("#buscar_numero").click(function () {
        if (IsNumeric($('#txt_idtkt').val()))
            show_details($('#txt_idtkt').val());
    });


    if (IsNumeric($_GET('ID'))) {
        show_details($_GET('ID'));
    }

    refresh_list();
}

/**
 * Lista tickets de usuario
 * @returns {undefined}
 */
function listmy() {
    showingteam = false;
    $("#List").html(JAVA_LOADING);
    postControl.sendRequest(
            true,
            'tktlistmy',
            {
                'class': 'tkt',
                method: 'listmy',
                status: $("#txt_filtro_estado").val(),
                cfrom: $("#fecha_d").val(),
                cto: $("#fecha_h").val()
            },
    function (data) {
        $("#List").html(data.html);
        $("#tablelist").dataTable(
                {
                    "bJQueryUI": true,
                    "sPaginationType": "full_numbers",
                    "bAutoWidth": false,
                    "stateSave": true
                });
    },
            function (data) {
                $("#List").html(data);
            }
    );

}

/**
 * Lista tickets de equipo
 * @returns {undefined}
 */
function listfromteam() {
    showingteam = true;
    $("#List").html(JAVA_LOADING);
    postControl.sendRequest(
            true,
            'tktlistmyteams',
            {
                'class': 'tkt',
                method: 'listmyteams',
                status: $("#txt_filtro_estado").val(),
                cfrom: $("#fecha_d").val(),
                cto: $("#fecha_h").val(),
                teams: array_txt($("#txt_filtro_equipo").val())
            },
    function (data) {
        $("#List").html(data.html);
        $("#tablelist").dataTable(
                {
                    "bJQueryUI": true,
                    "sPaginationType": "full_numbers",
                    "bAutoWidth": false,
                    "stateSave": true
                });
    },
            function (data) {
                $("#List").html(data);
            }
    );
}

/**
 * Abrir ventana de exportacion
 * @returns {undefined}
 */
function excel_link() {
    if (showingteam) {
        window.open("?class=tkt&method=listmyteams&export=xls&status=" +
                $("#txt_filtro_estado").val() +
                "&cfrom=" + $("#fecha_d").val() +
                "&cto=" + $("#fecha_h").val()+
                "&teams="+array_txt($("#txt_filtro_equipo").val()));
    } else {
        window.open("?class=tkt&method=listmy&export=xls&status=" +
                $("#txt_filtro_estado").val() +
                "&cfrom=" + $("#fecha_d").val() +
                "&cto=" + $("#fecha_h").val());
    }
}

/**
 * Actualiza lista de generados
 * @returns {undefined}
 */
function refresh_list() {
    $("#List").html("<img src=\"img/loading.gif\" width=\"10\" heigth=\"10\"/>&nbsp;Cargando... ");
    if ($("#txt_filtro_origen").val() == "my") {
        listmy();
    } else {
        listfromteam();
    }


}

/**
 * Carga tickets cerrados recientemente
 * @returns {undefined}
 */
function refresh_listClose() {
    $("#ListClosed").html("<img src=\"img/loading.gif\" width=\"10\" heigth=\"10\"/>&nbsp;Cargando... ");
    postControl.sendRequest(
            false,
            'tktlistmyclose',
            {
                'class': 'tkt',
                method: 'listmyclose'

            },
    function (data) {
        $("#ListClosed").html(data.html);
        $("#tablelistC").dataTable(
                {
                    "bJQueryUI": true,
                    "sPaginationType": "full_numbers",
                    "bAutoWidth": false
                });
    },
            function (data) {
                $("#ListClosed").html(data);
            }
    );

}
