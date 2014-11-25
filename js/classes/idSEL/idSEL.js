/**
 * Arma idsel
 * @param {class,method,checkedlist,whitelist,blacklist,multiple,params,closeF} options
 * @param {function} callback
 * @returns {html}
 */
jQuery.fn.idSEL = function(options, callback) {

    var obj = this[0];
    var htmlid = $(obj).attr("id");
    var classC = "";
    var method = "";
    var checkedlist = "";
    var whitelist = "";
    var blacklist = "";
    var multiple = "";

    if ($("#" + htmlid + "cont") != undefined) //si ya esta creado el select se elimina
    {
        $("#" + htmlid + "cont").empty();
        $("#" + htmlid + "cont").attr("id", htmlid);
        obj = $("#" + htmlid);
    }
    if (!options)
    {
        $(obj).html("Error JQ.");
    }
    else {
        if (options == "clear") { // clear elimina objeto
            $("#" + htmlid + "cont").empty();
            $("#" + htmlid + "cont").attr("id", idObj);
            return;
        }

        /* PREPARAR VARIABLES */
        if (!options['class']) {
            $(obj).html(JAVA_ERROR);
            return;
        }
        classC = options['class'];
        if (!options.method) {
            $(obj).html(JAVA_ERROR);
            return;
        }
        method = options.method;
        checkedlist = varTodef(options.checkedlist, null);
        whitelist = varTodef(options.whitelist, null);
        blacklist = varTodef(options.blacklist, null);
        multiple = varTodef(options.multiple, false);
        $(obj).html(JAVA_LOADING);
        postControl.sendRequest(
                false,
                '',
                {
                    'class': classC,
                    method: method,
                    htmlid:htmlid,
                    checkedlist: checkedlist,
                    whitelist: whitelist,
                    blacklist: blacklist,
                    multiple: multiple,
                    sel_params: JSON.stringify(options.params)
                },
                function(data){ //func ok
                    if(data.status==="ok"){
                        var cmove = $(obj).attr('class');
                        $(obj).html(data.html);
                        $(obj).attr("id", $(obj).attr("id") + "cont");
                        $(obj).removeClass(cmove);
                        build_buttons();
                        $("#"+htmlid).addClass(cmove);
                        if (options.closeF)
                            $(obj).bind("multiselectclose", function(event, ui) {
                                options.closeF();
                            });
                        if (callback)
                            callback();    
                    }else{
                        $(obj).html(JAVA_ERROR+data.html);
                    }
                },
                function(data){ //fun error
                    $(obj).html(JAVA_ERROR+data);
                }
        );


    }
};