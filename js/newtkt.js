var DelID=0;
var UpdID=0;
var mode_details=0;
var go_status="clear";

function main(){
    load_tree("");       
}

function load_tree(path){
    if(!postControl.setIfClear()) return;
    $("#tree").html("Cargando..."); 
    $.post("includes/ajaxQ/TREE_get_open.php",{
        path:path
    },
    function(data){
        postControl.clearPosting();
        $("#tree").html(data); 
        build_buttons();
    }
    );
    
   
}

function go(path){
    var valid;
    if(!postControl.ifClear()) return;
    valid=is_valid();
    if(valid=="ok"){
        postControl.setPosting();
        $.post(
            "includes/ajaxQ/TREE_getSimilars.php",{
                path:path
            },
            function(data){
                postControl.clearPosting();
                if(data=="none"){
                    open_tkt(path,'NULL');
                }else{
                    
                    $("#popup_similars").html('<div id="div_contenido" style="height:'+($(window).height()-150)+'px;width:100%;">'+data+"</div>");
                    
                    $("#popup_similars").dialog({
                        title:"Similares", 
                        width:750, 
                        height:$(window).height()-100, 
                        resizable:false,
                        modal:true,
                        draggable: false,
                        position: {
                            my: "center top", 
                            at:"center top", 
                            of:"body"
                        }
                    });
                    build_buttons();
                    $("body").scrollTop(0);
                    $("#div_contenido").tinyscrollbar();
                    // funcion open para el boton
                    $("#BT_openTKT").click(function(){
                        if(!postControl.ifClear()) return;
                        var selected=$("input[name=Sel_similar]:checked").val();
                        if(selected==undefined)
                            $("#Sel_similar_MSG").html("Debe seleccionar un tkt, o marcar NINGUNO.") ;
                        else
                            open_tkt(path,selected);
                    });
                }
            });
    }
    else{
        alert_p(valid,"Error");
    }
    
}

function open_tkt(path,idmaster){
    
    if(!postControl.setIfClear()) return;
    $.post(
        "includes/ajaxQ/ejecute_action.php",{
            accion:"ABRIR",
            comentarios:$("#detalle_tkt").html(),
            path:path,
            idmaster:idmaster
        },
        function(data){
            postControl.clearPosting();
            if(data==""){
                alert_p("No se obtuvo respuesta del servidor, verifique si se gener&oacute; correctamente en <a href='mytkts.php' class='lnk_blue'>Mis tkts</a>","Error");
                return;
            }
            //intenta convertir cadena o informa el error
            var Jdata,msj;
            try{
                 Jdata = $.parseJSON(data);
            }catch(e){
                alert_p(data,"Error fatal");
                return;
            }
            if(Jdata.ejecute!="ok"){ //error
                alert_p(Jdata.ejecute_detail,"Error");
                return;
            }
            if(Jdata.ejecute_extra!=""){ //se resuelve por link
                 msj="<p style='font-size:25px;'>Para resolver su inconveniente haga click&nbsp;<a href='"+Jdata.ejecute_extra+"'>aqu&iacute;</a></p>"+Jdata.ejecute_detail;
                 $("#tree").html(msj);
                 return;
            }
            
            
            msj="<p style='font-size:25px;'>"+Jdata.ejecute_detail+"</p>Puede darle seguimiento en&nbsp;<a href='mytkts.php' class='lnk_blue'>Mis tkts</a><br /><br />";
            $("#popup_similars").dialog('close');
            $("#tree").html(msj);
                    

        }
        );   
    
}