//controla acciones post
function class_postControl(){
    this.postingStatus="clear";
    this.modaloperation="";
    this.ok=0;
    this.posting=1;
    this.parseerror=2;
    this.setPosting=function(){
        this.postingStatus="posting";
    }
    this.clearPosting=function(){
        this.postingStatus="clear";
        this.modaloperation="";
    }
    this.ifClear = function(){
        if(this.postingStatus=="clear")
            return true;
        else
            alert_p("Hay una operacion en curso, por favor espere","Cargando...");
        return false;
        
    }
    
    this.setIfClear= function(){
        var rta = this.ifClear();
        if(rta){
            this.setPosting();
            return true;
        }
        return false;
           
    }
    
    /**
     * Envia request post y lo parsea
     * @param {boolean} modal   //verificar posting
     * @param {string} operation    //nombre de la operacion
     * @param {array} datasend  //datos para enviar
     * @param {function} funcOK   //funcion a ejecutar si ok, le pasa json
     * @param {function} funcOK   //funcion a ejecutar si error.
     * @returns {int}   //0 ok, 1 hay otra operacion modal, 2, error al parsear
     */
    this.sendRequest=function(modal,operation,datasend,funcOK,funcErr){
        
        if(modal){
            if(!this.setIfClear())
                return this.posting;
            this.modaloperation=operation;
        }
        $.post("",datasend,
            function(data){
                postControl.clearPosting();
                try{
                    var ans = jQuery.parseJSON(data);
                    funcOK(ans);
                }catch(e){
                    if(typeof(funcErr) === "function"){
                        funcErr(e+"--"+data);
                    }
                }
            }
        );
        
    }
    
}

var postControl = new class_postControl();