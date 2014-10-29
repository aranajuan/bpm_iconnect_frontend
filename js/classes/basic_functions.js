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
