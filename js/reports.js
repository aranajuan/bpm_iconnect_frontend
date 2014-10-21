function main() {
    $(".popup_open").click(
            function() {
                var id = $(this).attr("id").split("_");
                var name = "popup_" + id[0];
                eval(name + "()");
                $("#" + name).dialog(
                        {
                            title: 'Buscar ' + id[0],
                            resizable: false,
                            modal: true,
                            width: 'auto',
                            height: 'auto'
                        }
                );
            }
    );
}

/*
 * Funciones para filtro usuarios
 */
var popup_usrs_loaded = false;
function popup_usrs() {
    var usrs_my_teams;
    var usrs_my_usrs;
    var valSplt = $("#usrs").val().split(";");
    $.each(valSplt, function(key, value) {
        var datSplt = value.split(":");
        if (datSplt[0] === "MisEquipos") {
            usrs_my_teams = datSplt[1].replace(",", ";");
        }
        if (datSplt[0] === "MisUsuarios") {
            usrs_my_usrs = datSplt[1].replace(",", ";");
        }
    });

    if (!popup_usrs_loaded) {
        $("#popup_usrs_my_teams").idSEL({table: 'user_teams', multiple: 1, selected: usrs_my_teams});
        $("#popup_usrs_my_usrs").idSEL({table: 'teams_users', areas: 'all', multiple: 1, selected: usrs_my_usrs});

        $("#popup_usrs_ok").click(function() {
            $("#usrs").val("MisEquipos:" + array_txt($("#popup_usrs_my_teams").val()) + ";MisUsuarios:" + array_txt($("#popup_usrs_my_usrs").val()));
            $("#popup_usrs").dialog('close');
        });
        popup_usrs_loaded = true;
    }
}

/*
 * Funciones para filtro origen
 */
var popup_origen_loaded = false;
function popup_origen() {
    if (!popup_origen_loaded) {
        load_tree('', 'popup_origen_tree');
        popup_origen_loaded = true;
    }
}

function load_tree(path, Idobj) {
    if (!postControl.setIfClear())
        return;
    $("#" + Idobj).html("Cargando...");
    $.post("includes/ajaxQ/TREE_get_filter.php", {
        path: path,
        obj: Idobj
    },
    function(data) {
        postControl.clearPosting();
        $("#" + Idobj).html(data);
        build_buttons();
    }
    );
}

var popup_origen_selected = new Array();
function select_path(path, text) {
    var count = 0;
    var exist = false;
    $.each(popup_origen_selected, function(key, value) {
        if (value[0] === path)
            exist = true;
        count++;
    });
    if (!exist) {
        popup_origen_selected.push(new Array());
        popup_origen_selected[count].push(path);
        popup_origen_selected[count].push(text);
        alert(text);
    }
}
function Unselect_path(path) {
    $.each(popup_origen_selected, function(key, value) {
        if (value !== undefined) {
            if (value[0] === path)
                popup_origen_selected.splice(key, 1);
        }
    });
}