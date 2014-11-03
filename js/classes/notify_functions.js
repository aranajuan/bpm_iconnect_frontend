/*
 * true si detecta un cartel
 * modal, si se debe ser modal o no
 */
function popup_showing(modal){
    var dgVis=false;
    var dgClass=".ui-dialog-content";
    if(modal){
        dgClass=".ui-widget-overlay";
    }
    $(dgClass).each(
        function(){
           if($(this).is(':visible')){
                dgVis=true;
                return true;
           }
        }
    );
    return dgVis;
}


/*
 * Error en barra superior
 */
function fatal_error(msj,fnc){
    $("#msjs").html('<div class="ui-state-error"><span class=" ui-icon ui-icon-alert" style="float:left;"></span><b>Error:</b> '+msj+'</div>');    
    $("#msjs").slideDown(1000,fnc);
}

/*
 * NOTICE en barra superior
 */
function notice_msj(msj,fnc){
    if(msj!=""){
        $("#msjs").html('<div class="ui-state-highlight"><span class=" ui-icon ui-icon-info" style="float:left;"></span>'+msj+'</div>');    
        $("#msjs").slideDown(100,fnc);
    }
    else{
         $("#msjs").slideUp(0,fnc);
    }
}
/*
 * NOTICE a la derecha
 */
function notice_information(msj,fnc){
    if(msj!=""){
        $("#information").html('<div class="ui-state-highlight"><span class=" ui-icon ui-icon-info" style="float:left;"></span>'+msj+'</div>');    
        $("#information").slideDown(100,fnc);
    }
    else{
         $("#information").slideUp(0,fnc);
    }
}
/*
 * Alert JQuery MODAL
 */
function alert_p(msj,title){
    $("#alert_p").html($.trim(msj));
    $("#alert_p").dialog({
        title:title,
        resizable:false,
        minHeight:0,
        modal:true,
        buttons:{}
    });
    var alertp_size=parseInt($("#alert_p").css("height").replace("px", ""));
    alertp_size+=60;
    $("#alert_p").each(function(){
        $(this).css("height",alertp_size+"px");
    });
}
function close_p(){   
    $("#alert_p").dialog("close");    
    $("#alert_p").empty();
}
/*
 * Confirm JQuery MODAL
 */
function confirm_p(msj,title,sifunc,nofunc){
    $("#alert_p").html(msj);
    $("#alert_p").dialog({
        title:title,
        resizable:false,
        modal:true,
        buttons:{
            "SI":{
            text:"SI",
            click: function(){
                close_p();
                if(typeof sifunc === "function")
                    sifunc();
            }},
            "NO":{
            text:"NO",
            click: function(){
                close_p();
                if(typeof nofunc ==="function")
                    nofunc();
                }
            }
            }
    });
}