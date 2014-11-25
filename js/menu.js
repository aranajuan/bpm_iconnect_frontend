function menu_go(dest) {

    location.href = "?L=" + dest + "&m=menu";
}

function menu_sub(id) {
    $(".mainmenu").fadeOut(100, function () {
        $(".submenu").hide();
        $("#" + id).fadeIn();
    });
}

function menu_main() {
    $(".submenu").fadeOut(100,function(){
         $(".mainmenu").fadeIn();
    });
   
}