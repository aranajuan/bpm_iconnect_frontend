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
    if(!postControl.setIfClear()) return false;
    $.post("includes/ajaxQ/TEAM_listABM.php",{
        a:1
    },
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
    return true;
}
function clear_popup(){
    mode_details=0;
    $("#txt_nombre").val("");
    $("#txt_direccion").idSEL({
        table:'divisions'
    });
    $("#txt_listin").idSEL({
        table:'listin'
    });
    $("#txt_conformidad").val("02:00");
    $("#txt_equiposrelacion").idSEL({
        table:'teams_type',
        multiple:'true'
    });
    $("#txt_equiposvisible").idSEL({
        table:'teams_type',
        multiple:'true'
    });
    
    $("#sel_tipo").val("1");
    
}
function show_details(){
    $("#reg_details").dialog({
        title:'Detalles del equipo',
        resizable:false ,
        width:490,
        height:300
    });
}
function close_details(){
    $("#reg_details").dialog('close');
}
function reg_delete(id){
    
    
    DelID=id;
    confirm_p("Desea eliminar?","Confirmar",
        function(){
            if(!postControl.setIfClear()) return;
            $.post("includes/ajaxQ/TEAM_delete.php",
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

function load_update(id,nombre,t_conformidad,iddireccion,idsequiposrelacion,idsequiposvisible,idlistin,tipo){
    UpdID=id;
    $("#txt_nombre").val(nombre);
    $("#txt_direccion").idSEL({
        table:'divisions',
        defaultID:iddireccion
    });
    $("#txt_listin").idSEL({
        table:'listin',
        defaultID:idlistin
    });
    $("#txt_equiposrelacion").idSEL({
        table:'teams_type',
        multiple:'true',
        defaultID:idsequiposrelacion
    });
    $("#txt_equiposvisible").idSEL({
        table:'teams_type',
        multiple:'true',
         defaultID:idsequiposvisible
    });
    $("#txt_conformidad").val(t_conformidad);
    $("#sel_tipo").val(tipo);
    mode_details=1;
    show_details();
}

function reg_update(){
    if(!postControl.setIfClear()) return;
    $.post("includes/ajaxQ/TEAM_update.php",
    {
        id:UpdID,
        nombre:$("#txt_nombre").val(),
        t_conformidad:$("#txt_conformidad").val(),
        iddireccion:$("#txt_direccion").val(),
        idlistin:$("#txt_listin").val(),
        tipo:$("#sel_tipo").val(),
        idequipos_relacion:array_txt($("#txt_equiposrelacion").val()),
        idequipos_visible:array_txt($("#txt_equiposvisible").val())
    },
    function(data){
        postControl.clearPosting();
        if(data=="ok")
        {
            refresh_List();
            close_details();
        }
        else
            alert_p(data, "Error");
    }
    );    
}
function reg_insert(){
    if(!postControl.setIfClear()) return;
    $.post("includes/ajaxQ/TEAM_insert.php",
    {
        nombre:$("#txt_nombre").val(),
        t_conformidad:$("#txt_conformidad").val(),
        iddireccion:$("#txt_direccion").val(),
        idlistin:$("#txt_listin").val(),
        tipo:$("#sel_tipo").val(),
        idequipos_relacion:array_txt($("#txt_equiposrelacion").val()),
        idequipos_visible:array_txt($("#txt_equiposvisible").val())
    },
    function(data){
        postControl.clearPosting();
        if(data=="ok")
        {
            refresh_List();
            close_details();
        }
        else
            alert_p(data, "Error");
    }
    );    
}