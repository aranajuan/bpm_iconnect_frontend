
function class_tktJ(id,idmaster,idequipo){
    this.id=id;
    this.idmaster=idmaster;
    this.idequipo=idequipo;
    this.extTKT= new class_extTKT();
    
    function class_extTKT(){
        this.sent=false;
        this.nros= new Array();
        this.idaction= new Array();
        this.txt= new Array();
        
        this.add = function(nro,txt){
            this.nros.push(nro);
            this.txt.push(txt);
        }
        
        this.find = function(nro,type){
            var pos= tktJ.extTKT.nros.indexOf(parseInt(nro));
            if(pos>-1){
                if(this.txt[pos]==type)
                    return true;
            }
            return false;
            
        }
        
        this.showDetails = function(nro,type){
            alert_p("<div id='ejecutando_accion'><img src=\"img/loading.gif\" width=\"10\" heigth=\"10\"/>&nbsp;Cargando...</div>","itracker");
            var typeV = type.split("_"); 
            $.post("includes/ajaxQ/EXTTKT_getStatus.php",
                {
                    idtkt:nro,
                    type:typeV[1]
                },
                function(data){
                    alert_p(data,"itracker");
                }
            );
        }
    }
    
}

function show_details(id,title){
    $("#popup_detalles").empty();
    $("#popup_detalles").html("<img src=\"img/loading.gif\" width=\"10\" heigth=\"10\"/>&nbsp;Cargando... ");
    $("#popup_detalles").dialog({
        title:'Detalles del ticket',
        resizable:false ,
        width:100,
        height:90,
        modal:true,
        draggable: false,
        stack:true
    });
    $.post(
        "includes/ajaxQ/TKT_getH.php",
        {
            id:id
        },
        function(data){
            $("#popup_detalles").html('<div id="div_contenido" style="height:'+($(window).height()-160)+'px; width:100%;">'+data+"</div>");
            $("#popup_detalles").dialog('close');
            $("#popup_detalles").dialog({
                title:title,
                resizable:false ,
                width:800,
                height:$(window).height()-120,
                modal:true,
                draggable: false
             });
            $("#div_contenido").tinyscrollbar();
            build_buttons();
        }
        );
    
}

function get_form(accion){
    
    //elimina funciones del form anterior
    if(typeof check_valid_form == 'function'){
        check_valid_form = undefined;
    }
    if(typeof config == 'function'){
        config = undefined;
    }
    $("#popup_form").html("<img src=\"img/loading.gif\" width=\"10\" heigth=\"10\"/>&nbsp;Cargando... ");
    $("#popup_form").dialog({
        title:'Detalles del ticket',
        resizable:false ,
        width:100,
        height:90,
        model:true,
        draggable: false
    });
    $.post(
        "includes/ajaxQ/get_action_form.php",
        {
            accion:accion
        },
        function(data){
            $("#popup_form").dialog("close");
            $("#popup_form").html(data);
            build_buttons();
            $("#popup_form").dialog({
                title:"Detalles",
                resizable:false ,
                width:700,
                height:'auto',
                modal:true,
                draggable: true

            });
            //ejecuta configuracion si existe en el archivo get_form
            if (typeof config == 'function'){
                config();
            } 
            
            //carga funciones para control de tkts externos
            if($("textarea").length && $("#B_ACCION_TICKET_EXTERNO").attr("value")!=undefined && typeof  check_comment_ext != 'function'){

                $.post(
                    "includes/actions/search_ext_tkt_txt.php",
                    {
                        id:1
                    },
                    function(data){
                        $("#popup_form").append(data);
      
                    }
                    );
    
            }else{
                if(typeof  check_comment_ext == 'function')
                    check_comment_ext=undefined;
            }
            
            
        }


        );
    
    
}

function GO(accion){
    // si hay validacion java en el form la ejecuta
    if($("#ejecutando_accion").html()!=undefined){
        return false;
    }
    if(typeof check_valid_form == 'function'){
        
        if(check_valid_form())
            GO_post(accion,true);
        
    }
    else{
        GO_post(accion,true);
    }
    return true;
    
}

function GO_post(accion,needCheck){
    $("#popup_form").append("<div id='ejecutando_accion'><img src=\"img/loading.gif\" width=\"10\" heigth=\"10\"/>&nbsp;Guardando...</div>");
    $.post(
        "includes/ajaxQ/ejecute_action.php",
        {
            id:tktJ.id,
            accion:accion,
            datos:$("#form_action").serializeArray()
        },
        function(data){
            $("#ejecutando_accion").remove();
            
            //intenta convertir cadena o informa el error
            var Jdata;
            try{
                 Jdata = $.parseJSON(data);
            }catch(e){
                $("#popup_form").dialog('close');
                alert_p(data,"Error fatal");
                return;
            }
            if(Jdata.ejecute!="ok"){
                alert_p("<b>No se pudo completar la accion.</b><br/>"+Jdata.ejecute_detail,"Error");
                return;
            }
            $("#popup_form").dialog('close');
            show_details(tktJ.id,$( "#popup_detalles" ).dialog( "option", "title" )); // TODO: actualizar en dom
            
            if(Jdata.notify!="ok"){
                alert_p("<b>No se pudo notificar a los usuarios.</n><br/>"+Jdata.notify_detail,"Informacion");
                return;
            }
            if(needCheck && typeof  check_tktext == 'function'){
                check_tktext();
            }

           
        }
        );   
}

function toggle_m_body(obj){
    var arr_dat = $(obj).attr("id").split("_");
    $('#body_'+arr_dat[1]).toggle();
    $('#header_'+arr_dat[1]+' .subtitle_TH').toggle();
    
    $("#div_contenido").tinyscrollbar_update('relative');
}