 function xmlReader(path){
    var xmlTxt;
    try{
        var fso = new ActiveXObject("Scripting.FileSystemObject");
        var a = fso.OpenTextFile(path,1,false,-2);
        xmlTxt=a.ReadAll();
        return $.parseXML( xmlTxt );
        a.Close();
    }
    catch(err){
        a.Close();
        alert("Por favor agregue este servidor a los sitios de confianza de IE. De otra manera no podra cargar su archivo.");
    }
    return null;
 }

$(document).ready(function() {
    $('#files').change(function(evt){
       var xml = xmlReader($('#files').val()); 
       jsPlumb.setSuspendDrawing(true);
    jsPlumb.deleteEveryEndpoint();
    $("#ALLJ").html("");
       designer.loadXML(xml);
       designer.view.getQuestion(designer.view.fstQ).drawDOM("ALLJ");
       jsPlumb.setSuspendDrawing(false);
       designer.view.setSize('ALLJ');
    }) ;
    designer.view.fstQ=$_GET('fst');
    if ((document.documentMode && document.documentMode > 7) || !document.documentMode) {
        $("#STATUS").html("Cargando...");
        $.post(
        "../includes/ajaxQ/TREE_designer.php",
        {path:$_GET('p')},
        function(data){
            $("#STATUS").html("Listo!");
            $("#ALL").html(data);
            $("#ALL").hide();
            
            designer.view.getQuestion(designer.view.fstQ).drawDOM("ALLJ");
            designer.view.setSize('ALLJ');

        }
        );
    }else{
        alert("Sacar vista con compatibilidad");
    }
});


var id_Editing=0;
function show_details(object, id){
    id_Editing=id;
    if(object=='option'){
        var opt = designer.view.getOption(id);
       $("#option_id").val(opt.ID);
       $("#option_texto").val(opt.texto);
       $("#option_texto_critico").val(opt.texto_critico);
       if(opt.autocerrar)
           $("#option_autocerrar").attr("checked","checked");
       else
            $("#option_autocerrar").removeAttr("checked");
       if(opt.no_anexar)
           $("#option_no_anexar").attr("checked","checked");
       else
            $("#option_no_anexar").removeAttr("checked");
       
       if(opt.idpregunta_destino){
           $("#option_destiny").val("question");
           $("#option_destiny_BT").click(function(){});
       }
       if(opt.idequipo_destino){
           $("#option_destiny").val("team");
           $("#option_destiny_BT").click(function(){
              var opt = designer.view.getOption(id_Editing);
              $("#question_edit").html(opt.pretext);
              $("#question_edit").dialog({
                    width:900,
                    height:500,
                    title:"Pretext"
                    });
                } );
       }        
       if(opt.ruta_destino){
           $("#option_destiny").val("file");
           $("#option_destiny_BT").click(function(){});
       }
       $("#option_edit").dialog();
    }
    if(object=='question'){
        var Que = designer.view.getQuestion(id);
        $("#question_edit").html(Que.texto);
        $("#question_edit").dialog({
            width:900,
            height:500,
            title:Que.texto
        });
    }
    
}

function add_opt(idp){
    var lstScroll = $(document).scrollTop();
    var update= {
        typeO:'option',
        action:'insert',
        idpregunta:idp,
        texto:'opcion nueva!!',
        texto_critico:'',
        ruta_destino:null,
        idequipo_destino:null,
        pretext:'',
        idpregunta_destino:''
 
    };
    
    
    jsPlumb.setSuspendDrawing(true);
    jsPlumb.deleteEveryEndpoint();
    $("#ALLJ").html("");
    
    designer.updates.addAction(update);

    
    designer.view.getQuestion(designer.view.fstQ).drawDOM("ALLJ");
    jsPlumb.setSuspendDrawing(false);
    designer.view.setSize('ALLJ');
    $(document).scrollTop(lstScroll);
}

function zoom_inQ(idq){
    jsPlumb.setSuspendDrawing(true);
    jsPlumb.deleteEveryEndpoint();
    $("#ALLJ").html("");
    
    
    designer.view.getQuestion(idq).drawDOM("ALLJ");
    jsPlumb.setSuspendDrawing(false);
    designer.view.setSize('ALLJ');
}

function zoom_inO(ido){
    jsPlumb.setSuspendDrawing(true);
    jsPlumb.deleteEveryEndpoint();
    $("#ALLJ").html("");
    
    
    designer.view.getOption(ido).drawDOM("ALLJ");
    jsPlumb.setSuspendDrawing(false);
    designer.view.setSize('ALLJ');
}


function zoom_out(){
    jsPlumb.setSuspendDrawing(true);
    jsPlumb.deleteEveryEndpoint();
    $("#ALLJ").html("");
    
    
    designer.view.getQuestion(designer.view.fstQ).drawDOM("ALLJ");
    jsPlumb.setSuspendDrawing(false);
    designer.view.setSize('ALLJ');
}

function change(){

    var opciones="left=100,top=100,width=300,height=250", i= 0;

   mi_ventana = window.open("FLT_2005_5_24.xml","Extraccion",opciones);
   mi_ventana.document.write(designer.updates.getXML());
   mi_ventana.document.execCommand('saveas',0,'FLT_2005_5_24.xml')
    mi_ventana.close()
    ;
    return;
        var update2= {
        typeO:'question',
        action:'update',
        ID:22,  
        texto:'asdadas',
        detalle:''
 
    };
    designer.updates.addAction(update2);
    var update1= {
        typeO:'option',
        action:'update',
        ID:15,  
        idpregunta:6,
        texto:'ESTE CAMBIO!!',
        texto_critico:'',
        ruta_destino:null,
        idequipo_destino:null,
        pretext:'',
        idpregunta_destino:8
 
    };
    var update2= {
        typeO:'question',
        action:'update',
        ID:22,  
        texto:'asdadas',
        detalle:''
 
    };
    
    var update3= {
        typeO:'question',
        action:'insert',
        connectTO:12,
        texto:'NUEVO',
        detalle:''
 
    };
    
    var update4= {
        typeO:'option',
        action:'insert',
        idpregunta:'N_0',
        texto:'opcion nueva!!',
        texto_critico:'',
        ruta_destino:null,
        idequipo_destino:null,
        pretext:'',
        idpregunta_destino:8
 
    };
    
    jsPlumb.setSuspendDrawing(true);
    jsPlumb.deleteEveryEndpoint();
    $("#ALLJ").html("");
    
    designer.updates.addAction(update1);
    designer.updates.addAction(update2);
    designer.updates.addAction(update3);
    designer.updates.addAction(update4);
    designer.updates.addAction(update4);
    
    designer.view.getQuestion(designer.view.fstQ).drawDOM("ALLJ");
    jsPlumb.setSuspendDrawing(false);
    designer.view.setSize('ALLJ');
    
    alert(designer.updates.getXML());


   
}