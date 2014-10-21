function class_timer(time,fn,startN){
    
    this.set_time = function(time){this.sincro_time=time};
    this.start = function(){
        clearTimeout(this.sincro_timer);
        this.sincro_timer = setTimeout(this.fn,this.sincro_time);
    }
    this.stop =function(){
        clearTimeout(this.sincro_timer);
    }
    this.set_function=function(fn){
        this.fn=fn    
    }
    this.sincro_timer;
    this.sincro_time=time;
    this.fn=fn
    if(startN){
        this.start();
    }
}