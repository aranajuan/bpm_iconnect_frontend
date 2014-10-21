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
    $.post("includes/ajaxQ/LISTIN_listABM.php",{
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
}
function clear_popup(){
    mode_details=0;
    $("#txt_nombre").val("");
    $("#txt_to").val("");
    $("#txt_cc").val("");  
}
function show_details(){
    $("#reg_details").dialog({
        title:'Detalles del listin',
        resizable:false ,
        width:400,
        height:290
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
            $.post("includes/ajaxQ/LISTIN_delete.php",
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
function load_update(id,nombre,to,cc){
    UpdID=id;
    $("#txt_nombre").val(nombre);
    $("#txt_to").val(to);
    $("#txt_cc").val(cc);
    mode_details=1;
    show_details();
}

function reg_update(){
    if(!postControl.setIfClear()) return;
    $.post("includes/ajaxQ/LISTIN_update.php",
    {
        id:UpdID,
        nombre:$("#txt_nombre").val(),
        too:$("#txt_to").val(),
        cc:$("#txt_cc").val()
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
    $.post("includes/ajaxQ/LISTIN_insert.php",
    {
        nombre:$("#txt_nombre").val(),
        too:$("#txt_to").val(),
        cc:$("#txt_cc").val()
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