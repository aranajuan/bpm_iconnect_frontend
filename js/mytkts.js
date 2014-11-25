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
                multiple: true
            });


    $("#buscar_numero").click(function () {
        if (IsNumeric($('#txt_idtkt').val()))
            show_details($('#txt_idtkt').val());
    });


    if (IsNumeric($_GET('ID'))) {
        show_details($_GET('ID'));
    }

    refresh_list();
    refresh_listClose();
}

/**
 * Lista tickets de usuario
 * @returns {undefined}
 */
function listmy() {
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
                    "bAutoWidth": false
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
                    "bAutoWidth": false
                });
    },
            function (data) {
                $("#List").html(data);
            }
    );
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
