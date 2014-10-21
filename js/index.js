function main(){
    if(IsNumeric($_GET('ID'))){
        window.location.href="mytkts.php?ID="+$_GET('ID');
    }
}