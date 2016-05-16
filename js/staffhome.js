
var ID = -1;

var filter_filter;
var filter_team;
var filter_fecha_d;
var filter_fecha_h;
var filter_ext_tipo;
var filter_ext_nro;
var updating = false;

function main() {

    var test;
    $.getScript('js/classes/timer.js',
            function() {
                test = new class_timer(45000, function() {
                    if (popup_showing(0) == false) {
                        if($("#auto_update").is(":checked")){
                            refresh_list();
                        }
                    }
                    test.start();
                }, true);
            });

    user.set_user_activity_change(function() {
        if (!user.user_active) {
            notice_msj("Inactivo // se redujo la frecuencia de autoactualizacion");
            test.set_time(300000);
            test.start();
        } else {
            notice_msj("");
            test.set_time(45000);
            if($("#auto_update").is(":checked")){
                refresh_list();
            }
            test.start();
        }
    });

    $("#updating").html(JAVA_LOADING);


    $("#txt_area_select").idSEL(
            {
                'class': 'user',
                method: 'idsel_listteams',
                multiple: false,
                params: {filter: 'staffhome_vista'}
            }, load_filter);

    $("#buscar_numero").click(function() {
        if (IsNumeric($('#txt_idtkt').val()))
            show_details($('#txt_idtkt').val());
    });

    $("#txt_filtro").change(function() {
        if ($("#txt_filtro").val() == "closed" || $("#txt_filtro").val() == 'derived_all')
            $("#div_fechas").show();
        else
            $("#div_fechas").hide();
    });

    $("#filtrar").click(function() {
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
            "&team=" + filter_team);
}

function refresh_list() {
    if (updating)
        return;
    updating = true;
    $("#updating").html(JAVA_LOADING+' actualizando');

    postControl.sendRequest(
            true,
            'tktlistteam',
            {
                'class': 'tkt',
                method: filter_method,
                cfrom: filter_fecha_d,
                cto: filter_fecha_h,
                team: filter_team,
                filter: filter_filter
            },
    function(data) {
        var POS = $("body").scrollTop();
        $("#updating").html("");
        $("#List").html(data.html);
        $("#tablelist").DataTable(
                {
                    "bJQueryUI": true,
                    "sPaginationType": "full_numbers",
                    "bAutoWidth": false,
                    "stateSave": true
                });
        $("body").scrollTop(POS);
        updating = false;
    },
            function(data) {
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
                'class': 'tkt',
                method: 'listchilds',
                idtkt: id
            },
    function(data) {
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
            function(data) {
                $("#popup_childs").html(data);
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
    if ($("#txt_filtro").val().substr(0, 7) === 'derived') {
        filter_method = 'listtouch';
    } else {
        filter_method = 'listteam';
    }

    refresh_list();
    //load_listRC();
}

function load_listRC() {
    $("#ListRC").html(JAVA_LOADING);
    postControl.sendRequest(
            false,
            'tktlistteamclose',
            {
                'class': 'tkt',
                method: 'listteamclose',
                team: filter_team
            },
    function(data) {

        $("#ListRC").html(data.html);
        $("#tablelistRC").dataTable(
                {
                    "bJQueryUI": true,
                    "sPaginationType": "full_numbers",
                    "bAutoWidth": false
                });
    },
            function(data) {
                $("#ListRC").html(data);
            }
    );

}