var TKTID=0;


function getform(accion){
        postControl.sendRequest(
            true,
            'tktgetform',
            {
                class: 'action',
                method: 'getform',
                action: accion
            },
    function(data) {
        //{"type":"array","result":{"result":"ok","msj":"","openother":"","id":"336","tkth":"ok","sendfiles":"ok"},"status":"ok"}
        if(data.status=="ok"){
            var result=data.result;
            if(result.result==="ok"){
                alert_p(result.html,"ok");
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

function go(accion){
    postControl.sendRequest(
            true,
            'tktaction',
            {
                class: 'action',
                method: 'ejecute',
                action: accion,
                idtkt:TKTID
            },
    function(data) {
        //{"type":"array","result":{"result":"ok","msj":"","openother":"","id":"336","tkth":"ok","sendfiles":"ok"},"status":"ok"}
        if(data.status=="ok"){
            var result=data.result;
            if(result.result==="ok"){
                alert_p("ok","ok");
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
