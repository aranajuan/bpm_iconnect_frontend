function menu_go(dest) {
    location.href = "?L=" + dest + "&m=menu";
}

function menu_sub(id) {
    location.href = "?L=submenu&m=menu&main=" + id;
}

function submenu_go(dest) {
    location.href = "?L=" + dest + "&m=menu&main="+$_GET("main");
}