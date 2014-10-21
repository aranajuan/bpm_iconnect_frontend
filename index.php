<?php
require_once 'includes/config/init.php'; // Configuraciones DB, Constantes, Direcciones

$U = new USER();
$R = new HtmlRequest();
$U->load_session();

if ($R->is_set("class")) { // es un request ajax
    $class = $R->get_param("class");
    $method = $R->get_param("method");
    if ($class == "user" && $method == "login") {
        $U->load_vec(array("usr"=>$R->get_param("usr"),"instancia"=>$R->get_param("instancia")));
        $canAccess=true;
    } else {
        $canAccess = $U->check_access($class, $method);
    }
    if ($canAccess) {
        include AJAX_CONTROLLER;
        exit();
    } else {
        echo "No puedes ejecutar esta funcion, consulta a tu administrador";
        exit();
    }
}


/**
 *  Navegacion por webs
 */
if (!$R->is_set("L")) {
    if ($U->is_logged()) {
        header("Location: " . HTML_CONTROLLER . "/?L=index&m=redirected"); //usuario logueado, a pagina default
    } else {
        header("Location: " . HTML_CONTROLLER . "/?L=login&m=notlogged"); // usuario no logueado    
    }
}

if ($R->get_param("L") == "login") { // permite siempre acceso a login
    $canAccess = true;
} else {
    $canAccess = $U->check_access("PAGE", $R->get_param("L"));
}

if ($canAccess === false) {
    if ($U->is_logged()) {
        $HeaderMsjUser = "No tienes acceso a este sitio."; // usuario sin acceso al sitio
    } else {
        
    }
}

require_once 'html/header.php';




if ($canAccess) {
    include "html/" . $R->get_param("L") . ".php";
}

require_once 'html/footer.php';
?>