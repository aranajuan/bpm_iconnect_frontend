
var ID = -1;

var filter_filter;
var filter_team;
var filter_fecha_d;
var filter_fecha_h;
var filter_ext_tipo;
var filter_ext_nro;
var updating = false;

function main() {
    /*
     var test;
     $.getScript('includes/js/jq/timer.js',
     function () {
     test = new class_timer(5000, function () {
     if (popup_showing(0) == false) {
     refresh_list();
     }
     test.start();
     }, true);
     });
     
     user.set_user_activity_change(function () {
     if (!user.user_active) {
     notice_msj("Inactivo // se redujo la frecuencia de autoactualizacion a 30 min");
     test.set_time(1800000);
     //test.set_time(60000);
     test.start();
     } else {
     test.set_time(5000);
     notice_msj("");
     refresh_list();
     test.start();
     }
     });
     */
    $("#List").html(JAVA_LOADING);
    $("#ListRC").html(JAVA_LOADING);

    $("#txt_area_select").idSEL(
            {
                class: 'user',
                method: 'idsel_listteams',
                multiple: false
            }, load_filter);

    $("#buscar_numero").click(function () {
        if (IsNumeric($('#txt_idtkt').val()))
            show_details($('#txt_idtkt').val());
    });

    $("#txt_filtro").change(function () {
        if ($("#txt_filtro").val() == "closed")
            $("#div_fechas").show();
        else
            $("#div_fechas").hide();
    });

    $("#filtrar").click(function () {
        load_filter();
    });


    if (IsNumeric($_GET('ID'))) {
        show_details($_GET('ID'), "TKT: " + $_GET('ID'));
    }

}

/**
 * Abrir ventana de exportacion
 * @returns {undefined}
 */
function excel_link() {
        window.open("?class=tkt&method=listteam&export=xls&filter=" +
                filter_filter +
                "&cfrom=" + filter_fecha_d +
                "&cto=" + filter_fecha_h +
                "&team="+filter_team);  
}

function refresh_list() {
    if (updating)
        return;
    updating = true;
    $("#List").html(JAVA_LOADING);
    postControl.sendRequest(
            true,
            'tktlistteam',
            {
                class: 'tkt',
                method: 'listteam',
                cfrom: filter_fecha_d,
                cto: filter_fecha_h,
                team: filter_team,
                filter: filter_filter
            },
    function (data) {
        var POS = $("body").scrollTop();
        $("#List").html(data.html);
        $("#tablelist").dataTable(
                {
                    "bJQueryUI": true,
                    "sPaginationType": "full_numbers",
                    "bAutoWidth": false
                });
        $("body").scrollTop(POS);
        updating = false;
    },
            function (data) {
                $("#List").html(data);
            }
    );

}


function show_childs(id) {
    $("#popup_childs").html(JAVA_LOADING);
    $("#popup_childs").dialog({
        title: 'Tikets adjuntos',
        resizable: false,
        width: 100,
        height: 90,
        model: true
    });
    postControl.sendRequest(
            true,
            'tktlistchilds',
            {
                class: 'tkt',
                method: 'listchilds',
                idtkt: id
            },
    function (data) {
        $("#popup_childs").html('<div id="div_contenido_C" style="height:300px; overflow:auto;">' + data.html + "</div>");
        $("#popup_childs").dialog('close');
        $("#popup_childs").dialog({
            title: 'Tikets adjuntos',
            resizable: false,
            width: 320,
            height: 350,
            modal: true
        });
        $("#div_contenido_C").scrollTop(0);
    },
            function (data) {
                $("#popup_childs").html(data);
            }
    );


    $.post(
            "includes/ajaxQ/TKT_listChilds.php",
            {
                id: id
            },
    function (data) {

        build_buttons();
    }
    );

}


/**
 * Carga filtro y actualiza listas
 * @returns {undefined}
 */
function load_filter() {
    filter_team = $("#txt_area_select").val();
    filter_filter = $("#txt_filtro").val();
    filter_fecha_d = $("#fecha_d").val();
    filter_fecha_h = $("#fecha_h").val();

    refresh_list();
    load_listRC();
}

function load_listRC() {
    $("#ListRC").html(JAVA_LOADING);
    postControl.sendRequest(
            false,
            'tktlistteamclose',
            {
                class: 'tkt',
                method: 'listteamclose',
                team: filter_team
            },
    function (data) {

        $("#ListRC").html(data.html);
        $("#tablelistRC").dataTable(
                {
                    "bJQueryUI": true,
                    "sPaginationType": "full_numbers",
                    "bAutoWidth": false
                });
    },
            function (data) {
                $("#ListRC").html(data);
            }
    );

}