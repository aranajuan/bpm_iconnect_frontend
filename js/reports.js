/**
 * Setea funciones y carga tabla inicial
 * @returns {undefined}
 */
function main() {
    $("#teams").idSEL({
        'class': 'user',
        method: 'idsel_listreportteams',
        multiple: true,
        params: {filter: 'mytkts_vista'}
    });
    $("#filtro_origen").change(function () {
        var filter;
        if($("#filtro_origen").val()=='generadorpor'){
            filter='mytkts_vista';
        }else{
            filter='staffhome_vista';
        }
        $("#teams").idSEL({
            'class': 'user',
            method: 'idsel_listreportteams',
            multiple: true,
            params: {filter: filter}
        });

    });
}

/**
 * Carga tabla
 * @returns {undefined}
 */
function report() {
    var rq = "?class=report&method=report&longp=1&filter=";
    rq+=$("#filtro_origen").val() +
            "&datefilter=" + $("#filtro_fechas").val() +
            "&from=" + $("#desde").val() +
            "&too=" + $("#hasta").val() +
            "&team=" + array_txt($("#teams").val());
    if($("#avanzado").length && $("#avanzado").val()!==''){
        try{
            var txt= encodeURIComponent(JSON.stringify(JSON.parse($("#avanzado").val())));
        } catch(e){
            alert_p("Parametrizacion invalida","Error");
            return;
        }
        rq+="&config=" + txt;
    }
    window.open(rq);
}