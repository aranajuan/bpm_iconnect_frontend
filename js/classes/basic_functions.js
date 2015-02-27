/**
 * Serializa los datos del form para enviarlos
 * @param {string} classe clase a serializar
 * @returns {JSON}
 */
function serialize_form(classe){
    var formS = Array();
    var i=0;
    var error=false;
    $("."+classe).each(function(){
        if(!checkval($(this).val())){
            error=true;
            return;
        }
        formS[i]={id:$(this).attr("id"),value:$(this).val()};
        i++;
    });
    if(error){
        return -1;
    }
    return JSON.stringify(formS);
}

function checkval(str){
    if(str.indexOf("<")!=-1 || str.indexOf(">")!=-1){
        return false;
    }
    return true;
}

/*
 * is checked to 1/0
 */
function is_checked(obj){
    if($(obj).is(':checked'))
        return 1;
    return 0;
}


function IsNumeric(n) {
    return !isNaN(parseFloat(n)) && isFinite(n);
}

function varTodef(varval,defval){
    if(varval)
        return varval;
    else
        return defval;
}

/*
 * get from java
 */
function $_GET(q,s) { 
    s = s ? s : window.location.search; 
    var re = new RegExp('&'+q+'(?:=([^&]*))?(?=&|$)','i'); 
    return (s=s.replace('?','&').match(re)) ? (typeof s[1] == 'undefined' ? '' : decodeURIComponent(s[1])) : undefined; 
} 



function array_txt(arr){
    if(arr)
        return arr.toString();
    else
        return "";    
}
    
Array.prototype.indexOf = function(obj, start) {
    for (var i = (start || 0), j = this.length; i < j; i++) {
        if (this[i] === obj) {
            return i;
        }
    }
    return -1;
}

function strToJava(str){
    
    str=str.replace("\\", "\\\\");
    str=str.replace("\"", "&quot;");
    str=str.replace("'", "\\'");
    str=str.replace(/\n/g, "\\n");
    str=str.replace(/\r/g,"");
    return str;
    
}