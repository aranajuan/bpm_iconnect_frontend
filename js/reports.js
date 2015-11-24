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
    window.open("?class=report&method=report&longp=1&filter=" +
            $("#filtro_origen").val() +
            "&datefilter="+$("#filtro_fechas").val() +
            "&from=" + $("#desde").val() +
            "&too=" + $("#hasta").val() +
            "&team=" + array_txt($("#teams").val()));
}