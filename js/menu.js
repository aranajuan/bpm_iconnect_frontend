function menu_go(dest){
    
    location.href="?L="+dest+"&m=menu";
    
}

function menu_sub(id){
    $(".mainmenu").hide();
    $(".submenu").hide();
    $("#"+id).show();
}

function menu_main(){
    $(".submenu").hide();
    $(".mainmenu").show();
}