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
    postControl.sendRequest(
            true,
            'report',
            {
                'class': 'report',
                method: 'report',
                filter:$("#filter").val(),
                from:$("#desde").val(),
                too:$("#hasta").val(),
                teams:array_txt($("#teams").val())
            },
    function (data) {
        alert(data.html);
    },
            function (data) {
                alert(data);
            }
    );

}