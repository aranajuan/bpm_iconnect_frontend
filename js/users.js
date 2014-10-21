var DelID=0;
var UpdID=0;
var mode_details=0;

function main(){
    $("#nuevo").click(function(){
       clear_popup();
       show_details();
   });
   $("#details_ok").click(function(){
       if(mode_details)
           reg_update();
       else
           reg_insert();
   });
    refresh_List();    
}

function refresh_List(){
   if(!postControl.setIfClear()) return;
   $.post("includes/ajaxQ/USER_listABM.php",{a:1},
    function(data){
        postControl.clearPosting();
        $("#List").html(data);
        $("#ABM_List").dataTable(
            {
                "bJQueryUI": true,
                "sPaginationType": "full_numbers",
                "bAutoWidth":true
            });
    }
   );
}
function clear_popup(){
    mode_details=0;
    $("#txt_nombre").val("");
    $("#txt_id").val("");
    $("#txt_equipo").idSEL({table:'teams_type',multiple:'true'});
    $("#txt_id").removeAttr("disabled");
}
function show_details(){
    $("#reg_details").dialog({title:'Detalles del equipo',resizable:false ,width:370,height:210});
}
function close_details(){
    $("#reg_details").dialog('close');
}
function reg_delete(id){
    DelID=id;
    confirm_p("Desea eliminar?","Confirmar",
        function(){
            if(!postControl.setIfClear()) return;
            $.post("includes/ajaxQ/USER_delete.php",
            {
                id:DelID
            },
            function(data){
                postControl.clearPosting();
                if(data=="ok")
                    refresh_List();
                else
                    alert_p(data, "Error");
            }
            ); 
        }
    );

}
function load_update(id,idequipo,perfil){
    UpdID=id;
    $("#txt_id").val(id);
    $("#txt_id").attr("disabled", "disabled");
    $("#txt_equipo").idSEL({table:'teams_type',defaultID:idequipo,multiple:'true'});
    $("#txt_perfil").val(perfil);
    mode_details=1;
    show_details();
}

function reg_update(){
    if(!postControl.setIfClear()) return;
    $.post("includes/ajaxQ/USER_update.php",
       {
           id:UpdID,
           idsequipos:array_txt($("#txt_equipo").val()),
           perfil:$("#txt_perfil").val()
       },
       function(data){
           postControl.clearPosting();
        if(data=="ok")
            {refresh_List();close_details();}
        else
            alert_p(data, "Error");
       }
       );    
}
function reg_insert(){
if(!postControl.setIfClear()) return;
    $.post("includes/ajaxQ/USER_insert.php",
       {
           id:$("#txt_id").val(),
           idsequipos:array_txt($("#txt_equipo").val()),
           perfil:$("#txt_perfil").val()
       },
       function(data){
           postControl.clearPosting();
        if(data=="ok")
            {refresh_List();close_details();}
        else
            alert_p(data, "Error");
       }
       );    
}