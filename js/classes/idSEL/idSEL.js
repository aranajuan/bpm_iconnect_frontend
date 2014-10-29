jQuery.fn.idSEL = function(options,callback) {
    var obj=this[0];
    var idObj=$(obj).attr("id");
    if($("#"+idObj+"cont")!=undefined) //si ya esta creado el select se elimina
    {
        $("#"+idObj+"cont").empty();
        $("#"+idObj+"cont").attr("id",idObj);
        obj=$("#"+idObj); 
    }
    if(!options)
        {$(obj).html("Error JQ.");}
    else{
            if(options=="clear"){
                $("#"+idObj+"cont").empty();
                $("#"+idObj+"cont").attr("id",idObj);
                return;
            }
            if(!options.validos)
                options.validos="ALL";

            if(!options.vnames)
                options.vnames=0;
            else
                options.vnames=1;
            options.htmlid =idObj;
            $(obj).html('<img src="'+ HIMG_DIR+'/loading.gif" width="20" height="20" alt="cargando.." />');
            $.post("includes/js/jq/idSEL/"+options.table+".php",
                
                    options

                ,function(data){
                    $(obj).html(data);
                    $(obj).attr("id", $(obj).attr("id")+"cont");
                    build_buttons();
                    if(options.closeF)
                        $(obj).bind("multiselectclose", function(event, ui){options.closeF();});
                    if(callback)
                        callback();
                }
            );
    }
};