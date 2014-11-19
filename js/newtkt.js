var DelID=0;
var UpdID=0;
var mode_details=0;
var go_status="clear";

function main(){
    load_tree("");   
}

/**
 * Carga opciones del arbol
 * @param {type} path
 * @returns {undefined}
 */
function load_tree(path){
    postControl.sendRequest(
            true,
            'treeoptions',
            {
                class: 'tkt',
                method: 'get_tree_options',
                path:path
            },
    function(data) {
        $("#tree").html(data.html);
        build_buttons();
    },
            function(data) {
                $("#tree").html(data);
            }
    );
}

function go(path){
    postControl.sendRequest(
            true,
            'tktopen',
            {
                class: 'action',
                method: 'ejecute',
                action: 'abrir',
                sendfiles:'true',
                path:path,
                form:serialize_form('actionform')
            },
    function(data) {
        //{"type":"array","result":{"result":"ok","msj":"","openother":"","id":"336","tkth":"ok","sendfiles":"ok"},"status":"ok"}
        if(data.status=="ok"){
            var result=data.result;
            if(result.result==="ok"){
                if(result.tkth=="ok"){
                    $("#tree").html("generado ok "+result.id);
                }else{
                    $("#tree").html("generado itracker "+result.id+"<br/>No se pudo guardar el evento, verifique en sus ticktes");
                }
            }else{
                alert_p(result.msj,"Error");
            }
        }else{
            if(data.html){
                alert_p(data.html,"Error");
            }
        }
    },
            function(data) {
               alert(data);
            }
    );
}
