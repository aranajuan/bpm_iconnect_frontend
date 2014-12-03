/**
 * Setea funciones y carga tabla inicial
 * @returns {undefined}
 */
function main() {
    $("#teams").idSEL({
        'class': 'user',
        method: 'idsel_listteams',
        multiple: true
    });
}

/**
 * Carga tabla
 * @returns {undefined}
 */
function report() {
    window.open("?class=report&method=report&export=xls&filter=" +
            $("#filter").val() +
            "&from=" + $("#desde").val() +
            "&too=" + $("#hasta").val() +
            "&teams=" + array_txt($("#teams").val()));
}