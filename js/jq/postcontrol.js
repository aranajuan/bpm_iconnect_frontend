//controla acciones post
function class_postControl(){
    this.postingStatus="clear";
    this.setPosting=function(){
        this.postingStatus="posting";
    }
    this.clearPosting=function(){
        this.postingStatus="clear";
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
    
}

var postControl = new class_postControl();