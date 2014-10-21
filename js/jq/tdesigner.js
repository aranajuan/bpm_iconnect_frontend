function tdesigner(){
    
    function ElementOver(Obj){
        var el1=jsPlumb.select({
            source:Obj
        });
        var el2 = jsPlumb.select({
            target:Obj
        });
        el1.setPaintStyle({
            lineWidth:5,
            strokeStyle:"green"
        });
        el1.addClass("TOP");
        el1.removeClass("_jsPlumb_connector");
        el2.addClass("TOP");
        el2.removeClass("_jsPlumb_connector");
        el2.setPaintStyle({
            lineWidth:5,
            strokeStyle:"green"
        });
    }
    function ElementOut(Obj){
        var el1=jsPlumb.select({
            source:Obj
        });
        var el2 = jsPlumb.select({
            target:Obj
        });
        el1.setPaintStyle(connectorStyle);
        el2.setPaintStyle(connectorStyle);
        el1.removeClass("TOP");
        el1.addClass("_jsPlumb_connector");
        el2.removeClass("TOP");
        el2.addClass("_jsPlumb_connector");
    }
    //objeto interno
    function class_question(optionsd){

        this.EP_from=null;
        this.EP_to=null;
        
        this.ID=optionsd.ID;
    
        this.texto=optionsd.texto;
        this.detalle=optionsd.detalle;
    
        this.type='q';
    
        //dibuja de este elemento todo para abajo
        this.drawDOM = function (DOMid){
            var DOMidJ="#"+DOMid;
            
            $(DOMidJ).append(
                '<div id="DOM_MAIN_Q'+this.ID+'" class="MAINDV">'+
                '<div id="DOM_TIT_Q'+this.ID+'" class="TITLEDV"> '+
                '<div class="element_designer_menu_container"  >'+
                '<div class="element_designer_menu">acciones<img src="../img/b_search.png" class="img_lnk" onclick="javascript:zoom_inQ(\''+this.ID+'\')" /><img src="../img/b_edit.png" class="img_lnk"  onclick="javascript:show_details(\'question\',\''+this.ID+'\')" /><img src="../img/b_drop.png" class="img_lnk" /></div>'+
                '</div>'+
                '<div class="element_designer question" id="DOM_EL_Q'+this.ID+'">'+
                '<p><b>'+this.texto+'</b>('+this.ID+')</p>'+
                '</div>'+
                '</div>'+
                '<div id="DOM_SUB_Q'+this.ID+'" class="SUBOBJDV"></div>'+
                '</div>'
                );
            this.EP_from = jsPlumb.addEndpoint('DOM_EL_Q'+this.ID,EP_LeftQuestion);
            this.EP_to = jsPlumb.addEndpoint('DOM_EL_Q'+this.ID,EP_RightQuestion);
            $('#DOM_EL_Q'+this.ID).mouseover(function(){
                ElementOver(this);
                $(this).parent().children('.element_designer_menu_container').children().show();
            });
            $('#DOM_EL_Q'+this.ID).mouseout(function(){
                ElementOut(this);
                
            });
            $('#DOM_TIT_Q'+this.ID).mouseleave(function(){
                $(this).children('.element_designer_menu_container').children().hide();
            });
            var OPTS=designer.view.getQuestionOptions(this.ID);
            var i = 0;
            while(OPTS[i]){
                OPTS[i].drawDOM("DOM_SUB_Q"+this.ID);
                i++;
            }
            
        }
        this.clearEP = function(){
            this.EP_from=null;
            this.EP_to=null;
        }
        
        this.getXML = function(){
            var rtaXML="<question>";
            rtaXML+="<ID>"+this.ID+"</ID>";
            rtaXML+="<texto>"+this.texto+"</texto>";
            rtaXML+="<detalle><![CDATA["+this.detalles+"]]></detalle>";
            rtaXML+="</question>";  
            return rtaXML;
        }    

    }
    //objeto interno
    function class_option(optionsd){
    
        this.EP_from=null;
        this.EP_to=null;
        
        this.CN_from=null;
        this.CN_to=null;// conexiones arbol
    
        this.ID=optionsd.ID;
    
        this.idpregunta=optionsd.idpregunta;
        this.texto=optionsd.texto;
        this.texto_critico=optionsd.texto_critico;
        this.ruta_destino=optionsd.ruta_destino;
        this.idequipo_destino=optionsd.idequipo_destino;
        this.pretext=optionsd.pretext;
        this.idpregunta_destino=optionsd.idpregunta_destino;
        this.autocerrar=optionsd.autocerrar;
        this.no_anexar=optionsd.no_anexar;
        this.teamName=optionsd.teamName;
        this.type='o';
    
        //dibuja de este elemento todo para abajo
        this.drawDOM = function (DOMid){
            var DOMidJ="#"+DOMid;
            
            $(DOMidJ).append(
                '<div style="clear:both;"></div><div id="DOM_MAIN_O'+this.ID+'" class="MAINDV">'+
                '<div id="DOM_TIT_O'+this.ID+'" class="TITLEDV"> '+
                '<div class="element_designer_menu_container"  >'+
                '<div class="element_designer_menu">acciones<img src="../img/b_search.png" class="img_lnk" onclick="javascript:zoom_inO(\''+this.ID+'\')" /><img src="../img/b_edit.png" class="img_lnk" onclick="javascript:show_details(\'option\',\''+this.ID+'\')" /><img src="../img/b_drop.png" class="img_lnk" /></div>'+
                '</div>'+
                '<div class="element_designer option" id="DOM_EL_O'+this.ID+'">'+
                '<p ><b class="element_designer_text">'+this.texto+'</b>('+this.ID+')</p>'+
                '</div>'+
                '</div>'+
                '<div id="DOM_SUB_O'+this.ID+'" class="SUBOBJDV"></div>'+
                '</div>'
                );
            this.EP_from = jsPlumb.addEndpoint('DOM_EL_O'+this.ID,EP_LeftOption);
            if(this.texto_critico!=''){
                $('#DOM_EL_O'+this.ID).append("<div class='element_designer_textinfo'><img src='../img/critic_icon.png' />&nbsp;"+this.texto_critico+"</div>");
            }
            $('#DOM_EL_O'+this.ID).mouseover(function(){
                ElementOver(this);
                $(this).parent().children('.element_designer_menu_container').children().show();
            });
            $('#DOM_EL_O'+this.ID).mouseout(function(){
                ElementOut(this);
                
            });
            $('#DOM_TIT_O'+this.ID).mouseleave(function(){
                $(this).children('.element_designer_menu_container').children().hide();
            });
            
            if(this.ruta_destino!='' && this.ruta_destino!=null){
                $('#DOM_EL_O'+this.ID).append("<div class='element_designer_textinfo'><img src='../img/pdf_icon.png' height='20' width='20' />&nbsp;A fuente de informacion externa.</div>");
            }
            if(this.idequipo_destino!='' && this.idequipo_destino!=null){
                $('#DOM_EL_O'+this.ID).append("<div class='element_designer_textinfo'><img src='../img/team_icon.png' height='20' width='20' />&nbsp;"+this.teamName+"</div>");
            }
            if(this.idpregunta_destino!=''){
                this.EP_to = jsPlumb.addEndpoint('DOM_EL_O'+this.ID,EP_RightOption);
                if($("#DOM_MAIN_Q"+this.idpregunta_destino).html()==undefined){
                    designer.view.getQuestion(this.idpregunta_destino).drawDOM('DOM_SUB_O'+this.ID);;
                }
                QO= designer.view.getQuestion(this.idpregunta_destino);
                if(QO.ID)
                    this.CN_to = jsPlumb.connect({
                        source:this.EP_to,
                        target:QO.EP_from,
                        overlays:["Arrow"]
                    });
            }
            
            if($("#DOM_TIT_Q"+this.idpregunta).html()!=undefined){
                var QO= designer.view.getQuestion(this.idpregunta);
                if(QO.ID)
                    this.CN_from = jsPlumb.connect({
                        source:QO.EP_to,
                        target:this.EP_from,
                        overlays:["Arrow"]
                    });
            }
            
        }
        this.clearEP = function(){
            this.EP_from=null;
            this.EP_to=null;
            this.CN_from=null;
            this.CN_to=null;
        }
    
        this.getXML = function(){
            var rtaXML="<option>";
            rtaXML+="<ID>"+this.ID+"</ID>";
            rtaXML+="<idpregunta>"+this.idpregunta+"</idpregunta>";
            rtaXML+="<texto>"+this.texto+"</texto>";
            rtaXML+="<texto_critico>"+this.texto_critico+"</texto_critico>";
            rtaXML+="<ruta_destino>"+this.ruta_destino+"</ruta_destino>";
            rtaXML+="<idequipo_destino>"+this.idequipo_destino+"</idequipo_destino>";
            rtaXML+="<pretext><![CDATA["+this.pretext+"]]></pretext>";
            rtaXML+="<idpregunta_destino>"+this.idpregunta_destino+"</idpregunta_destino>";
            rtaXML+="<teamName>"+this.teamName+"</teamName>";
            rtaXML+="</option>"; 
            return rtaXML;
        }
    }

    // contiene los elementos que se ven en el arbol actualmente
    function class_view (){
        var questions = new Array();
        var options = new Array();
        this.fstQ=4;
        this.questions= new Array();
        ;
        function getIDindex(arr,id){
            idI= parseInt(id);
            i=0;
            while(arr[i]){
               if(parseInt(arr[i].ID)==idI || arr[i].ID==id )
                    return i;
                i++;
            }
            return -1;
    
        }
        
        this.addOption= function(data){
            options.push(new class_option(data) );
            
        }
        this.addQuestion= function(data){
            questions.push(new class_question(data));
        }
        
        this.getOption = function(id){
            var pos= getIDindex(options, id);
            if(pos>-1) return options[pos];
            return -1;
        }
        
        this.setOption = function(id,obj){
            var pos= getIDindex(options, id);
            if(pos>-1){
                options[pos]=obj;
                return 1;
            }
            else
                return 0;
            
        }
        
        this.setQuestion = function(id,obj){
            var pos= getIDindex(questions, id);
            if(pos>-1){
                questions[pos]=obj;
                return 1;
            }
            else
                return 0;
            
        }
        
        this.getQuestion = function(id){
            this.questions=questions;
            var pos= getIDindex(questions, id);
            if(pos>-1) return questions[pos];
            return -1;
        }
        
        //opciones de pregutnas
        this.getQuestionOptions = function(idQ){
            var OPTS = new Array();
            var i=0;
            while(options[i]){
                if(options[i].idpregunta==idQ)
                    OPTS.push(options[i]);
                i++;
            }
            return OPTS;
        }
        
        this.setSize = function(DOMid){
            $("#"+DOMid).css("width",questions.length*1000+'px');
            if(questions.length>2 && $("#DOM_MAIN_Q"+questions[questions.length-2].ID).html()!=undefined){
                var sizeW_SND = parseInt($("#DOM_MAIN_Q"+questions[questions.length-2].ID).css("width"));
                var left_SND= parseInt($("#DOM_MAIN_Q"+questions[questions.length-2].ID).position().left);
                var finalW=sizeW_SND+ left_SND + 2000;
                $("#"+DOMid).css("width",finalW+'px');
            }
            jsPlumb.repaintEverything();
        }
        
    }
    
    this.view= new class_view ();
    
    
    function class_action(){
        // propiedades
        this.action; // delete,insert, update
        this.newOBJ; // nuevo objeto
        this.oldOBJ; // objeto anterior
        this.typeO; // option / question
        this.connectTO=null; // opcion que conecta a la nueva pregunta
        
        //carga la accion en el objeto
        this.load  = function(data){
            this.action=data.action;
            this.typeO=data.typeO;
            if(this.action=='update'){
                if(this.typeO=='question'){
                    this.oldOBJ=designer.view.getQuestion(data.ID);
                    this.oldOBJ.clearEP();
                    this.newOBJ= new class_question(data);
                }
                else{
                    this.oldOBJ=designer.view.getOption(data.ID);
                    this.oldOBJ.clearEP();
                    this.newOBJ= new class_option(data);
                }
                        
            }
            if(this.action=='insert'){
                this.oldOBJ=null;
                if(this.typeO=='question'){
                    this.connectTO=data.connectTO;
                    this.newOBJ= new class_question(data);
                }
                else{
                    this.newOBJ= new class_option(data);
                }
                
                //control de nuevos id
                if(data.ID){
                    var id = data.ID.split("_"); //N_xx
                    if(id[1]>designer.updates.newsIDS)
                        designer.updates.newsIDS=parseInt(id[1])+1
                }else{
                    this.newOBJ.ID="N_"+designer.updates.newsIDS;
                    designer.updates.newsIDS++;
                }
                        
            }
        }
        
        //ejecuta la accion
        this.ejecute = function(){
            if(this.action=='update'){
                if(this.typeO=='question'){
                    designer.view.setQuestion(this.oldOBJ.ID,this.newOBJ);
                }
                else{
                    designer.view.setOption(this.oldOBJ.ID,this.newOBJ);
                }
                        
            }
            if(this.action=='insert'){
                if(this.typeO=='question'){
                    designer.view.addQuestion(this.newOBJ);
                    var opt =designer.view.getOption(this.connectTO);
                    opt.idequipo_destino=null;
                    opt.pretext=null;
                    opt.ruta_destino=null;
                    opt.idpregunta_destino=this.newOBJ.ID;
                    designer.view.setOption(this.connectTO,opt);
                }
                else{
                    designer.view.addOption(this.newOBJ);
                }
                        
            }
            
        }
        
        //action to xml
        this.getXML = function(){
            var rtaXML="<action_element>";
            rtaXML+="<action>"+this.action+"</action>";
            rtaXML+="<typeO>"+this.typeO+"</typeO>";
            if(this.connectTO)
                rtaXML+="<connectTO>"+this.connectTO+"</connectTO>";
            rtaXML+="<newOBJ>"+this.newOBJ.getXML()+"</newOBJ>";
            if(this.oldOBJ)
                rtaXML+="<oldOBJ>"+this.oldOBJ.getXML()+"</oldOBJ>";
            rtaXML+="</action_element>";
            return rtaXML;
        }
 
    }

    function class_actionslst(){
        // propiedades
        var actions= new Array();
        var position=0;
        this.newsIDS=0;
        //inicializacion
    
        
        //funciones
        this.addAction = function(data){
            var action = new class_action();
            action.load(data);
            action.ejecute();
            actions.push(action);
                
        }
    
        this.undo = function() {
        
        }
    
        this.redo = function(){
        
        }
    
        this.deletAfterPos = function(){
        
        }
    
        this.getXML = function(){
            var XML ="<actionList>";
            var i = 0;
            for(i=0;i<actions.length;i++){
                XML +=actions[i].getXML();
            }
            
            XML +="</actionList>";
            return XML;
        }
  
    }
    function xml2json_obj(xml){
        var data;
        if($(xml).find('typeO').text()=='question'){
            var questionDat=$(xml).find('newOBJ').find('question');
            data={
                action:$(xml).find('action').text(),
                typeO:$(xml).find('typeO').text(),
                connectTO:$(xml).find('connectTO').text(),
                ID:$(questionDat).find('ID').text(),
                texto:$(questionDat).find('texto').text(),
                detalles:$(questionDat).find('detalles').text()
            };
        }else{              
            var optionDat=$(xml).find('newOBJ').find('option');
                data={
                action:$(xml).find('action').text(),
                typeO:$(xml).find('typeO').text(),
                ID:$(optionDat).find('ID').text(),
                idpregunta:$(optionDat).find('idpregunta').text(),
                texto:$(optionDat).find('texto').text(),
                texto_critico:$(optionDat).find('texto_critico').text(),
                ruta_destino:$(optionDat).find('ruta_destino').text(),
                idequipo_destino:$(optionDat).find('idequipo_destino').text(),
                pretext:$(optionDat).find('pretext').text(),
                idpregunta_destino:$(optionDat).find('idpregunta_destino').text(),
                teamName:$(optionDat).find('teamName').text()
            };
                
        }
        return data;
    }
        
    this.updates = new class_actionslst();  
    this.loadXML = function(xml){
        $(xml).find('actionList').find('action_element').each(function(){
            designer.updates.addAction(xml2json_obj(this));
        })
    }
    

    
}

var designer=new tdesigner();





