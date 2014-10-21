
var ID=-1;

var filter_filter;
var filter_team;
var filter_fecha_d;
var filter_fecha_h;
var filter_ext_tipo;
var filter_ext_nro;
var updating=false;

function main(){
    var test;
    $.getScript('includes/js/jq/timer.js',
    function(){
       test = new class_timer(5000,function(){
       if(popup_showing(0)==false){
        refresh_list();
       }
       test.start();},true);
    });
    $("#List").html("<img src=\"img/loading.gif\" width=\"10\" heigth=\"10\"/>&nbsp;Cargando... ");
    $("#ListRC").html("<img src=\"img/loading.gif\" width=\"10\" heigth=\"10\"/>&nbsp;Cargando... ");
    
    $("#txt_area_select").idSEL({
        table:'user_teams'
    },load_filter);
    $("#txt_filtro").change(function(){
        if($("#txt_filtro").val()=="closed")
            $("#div_fechas").show();
        else
            $("#div_fechas").hide();
        if($("#txt_filtro").val()=="ext_tkt")
            $("#div_ext_tkt").show();
        else
            $("#div_ext_tkt").hide();
    });
    user.set_user_activity_change(function(){
        if(!user.user_active){
            notice_msj("Inactivo // se redujo la frecuencia de autoactualizacion a 30 min");
            test.set_time(1800000);
            //test.set_time(60000);
            test.start();
        }else{
            test.set_time(5000);
            notice_msj(""); 
            refresh_list();
            test.start();
        }
    });
    
    if(IsNumeric($_GET('ID'))){
         show_details($_GET('ID'),"TKT: "+$_GET('ID'));
    }
    
}


function refresh_list(){
    if(updating) return;
    updating=true;
    // validar datos a query
    $.post(
        "includes/ajaxQ/TKT_listToTeam.php",
        {
            team:filter_team,
            filter:filter_filter,
            fecha_d:filter_fecha_d,
            fecha_h:filter_fecha_h,
            ext_tipo:filter_ext_tipo,
            ext_nro:filter_ext_nro
        },
        function(data){
            var POS = $("body").scrollTop();
            $("#List").html(data);
            $("#TKT_list").dataTable(
            {
                "bJQueryUI": true,
                "sPaginationType": "full_numbers",
                "bAutoWidth":true,
                "bStateSave": true
            }); 
            $("body").scrollTop(POS);
            updating=false;
        }
        );
    
}


function show_childs(id){
    $("#popup_childs").html("<img src=\"img/loading.gif\" width=\"10\" heigth=\"10\"/>&nbsp;Cargando... ");
    $("#popup_childs").dialog({
        title:'Tikets adjuntos',
        resizable:false ,
        width:100,
        height:90,
        model:true
    });
    $.post(
        "includes/ajaxQ/TKT_listChilds.php",
        {
            id:id
        },
        function(data){
            $("#popup_childs").html('<div id="div_contenido_C" style="height:300px; overflow:auto;">'+data+"</div>");
            $("#popup_childs").dialog('close');
            $("#popup_childs").dialog({
                title:'Tikets adjuntos',
                resizable:false ,
                width:320,
                height:350,
                modal:true
            })
            $("#div_contenido_C").scrollTop(0);
            build_buttons();
        }
        );
    
}


function load_filter(){
    
    filter_team=$("#txt_area_select").val();
    filter_filter=$("#txt_filtro").val();
    filter_fecha_d=$("#fecha_d").val();
    filter_fecha_h=$("#fecha_h").val();
    filter_ext_tipo=$("#ext_type").val();
    filter_ext_nro=$("#ext_number").val();
    
    refresh_list();
    load_listRC();
}

function load_listRC(){
    
$.post(
        "includes/ajaxQ/TKT_listToTeam.php",
        {
            team:filter_team,
            filter:'recent',
            days:5
        },
        function(data){
            $("#ListRC").html(data);
            $("#TKT_listRC").dataTable(
            {
                "bJQueryUI": true,
                "sPaginationType": "full_numbers",
                "bAutoWidth":true,
                "bStateSave": true
            }); 
        }
        );    
    
}