function class_user(){
    this.name="";
    this.id='';
    this.inactivity_timer;
    this.user_active=true;
    this.user_activity_change=null;
    this.user_activity=function(){
        var last=this.user_active;
        this.user_active=true;
        clearTimeout(this.inactivity_timer);
        this.inactivity_timer = setTimeout(function(){user.user_inactive();}, USER_INACTIVE_TIME);
        if(last==false && typeof this.user_activity_change == 'function'){
            this.user_activity_change();
        }
        
    }
    this.user_inactive=function(){
        this.user_active=false;
        if(typeof this.user_activity_change == 'function'){
            this.user_activity_change();
        }
    }
    this.set_user_activity_change=function(fn){
        this.user_activity_change=fn;
    }
}

var user = new class_user();


