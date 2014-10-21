function main(){
    $("#txt_filtro_estado").change(function(){
        if($("#txt_filtro_estado").val()=="closed"){
            $("#div_fechas").show();
        }
        else
            $("#div_fechas").hide();
    });
    $("#txt_filtro_origen").change(function(){
        if($("#txt_filtro_origen").val()=="team")
            $("#div_equipos").show();
        else
            $("#div_equipos").hide();
    });
    $("#buscar_numero").click(function(){
        if(IsNumeric($('#txt_idtkt').val()))
            show_details($('#txt_idtkt').val(),'TKT:'+$('#txt_idtkt').val());
    });
    $("#txt_filtro_equipo").idSEL({
        table:'user_teams'
    },undefined);
    if(IsNumeric($_GET('ID'))){
        show_details($_GET('ID'),"TKT: "+$_GET('ID'));
    }
   
    refresh_list();
    refresh_listClose();
}

function refresh_list(){
    $("#List").html("<img src=\"img/loading.gif\" width=\"10\" heigth=\"10\"/>&nbsp;Cargando... ");
    if($("#txt_filtro_origen").val()=="my"){
        $.post(
            "includes/ajaxQ/TKT_listMy.php",
            {
                filter_status:$("#txt_filtro_estado").val(),
                fecha_d:$("#fecha_d").val(),
                fecha_h:$("#fecha_h").val()
            },
            function(data){
            
                $("#List").html(data);
                $("#TKT_list").dataTable(
                {
                    "bJQueryUI": true,
                    "sPaginationType": "full_numbers",
                    "bAutoWidth":true
                });   
            }
            );
    }else{
    $.post(
            "includes/ajaxQ/TKT_listFromTeam.php",
            {
                filter_status:$("#txt_filtro_estado").val(),
                fecha_d:$("#fecha_d").val(),
                fecha_h:$("#fecha_h").val(),
                team:$("#txt_filtro_equipo").val()
            },
            function(data){
            
                $("#List").html(data);
                $("#TKT_list").dataTable(
                {
                    "bJQueryUI": true,
                    "sPaginationType": "full_numbers",
                    "bAutoWidth":true
                });   
            }
            );        
    } 
   
    
}

function refresh_listClose(){
    $("#ListClosed").html("<img src=\"img/loading.gif\" width=\"10\" heigth=\"10\"/>&nbsp;Cargando... ");    
    $.post(
        "includes/ajaxQ/TKT_listMyClosed.php",
        {
            id:1
        },
        function(data){
            
            $("#ListClosed").html(data);
            $("#TKT_listClosed").dataTable(
            {
                "bJQueryUI": true,
                "sPaginationType": "full_numbers",
                "bAutoWidth":true,
                "bFilter": false,
                "bInfo": false,
                aaSorting:[]
            });   
        }
        );
}