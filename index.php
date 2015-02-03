<?php

require_once 'includes/utils/init.php'; // Configuraciones DB, Constantes, Direcciones

$U = new USER();
$R = new HtmlRequest();

/**
 * TESTING
 */
$U->load_session();

if ($R->get_param("L") == "logout") {
    $U->logout();
    header("Location: " . HTML_CONTROLLER . "/?L=login&m=loguedout");
    exit();
}

if ($R->get_param("L") == "captcha") {
    include 'captcha/captcha.php';
    exit();
}

/**
 * Setea la instancia a conectar
 */
if (($R->get_param("instancia") != null)) {
    $U->set_instance($R->get_param("instancia"));
}


if ($R->is_set("class")) { // es un request ajax
    $class = $R->get_param("class");
    $method = $R->get_param("method");
    if ($class == "user" && $method == "login") {
        if ($U->get_try() >= TRYMAX) {
            if (!isset($_SESSION['captcha']) || $_SESSION['captcha'] != $R->get_param("captchatext")) {
                echo json_encode(array("type"=>"array","result"=>"error","trycount"=>$U->get_try(),"reload"=>"true","detail"=>"Captcha invalido"));
                unset($_SESSION['captcha']);
                exit();
            }
        }
        unset($_SESSION['captcha']);
        $U->load_vec(array("usr" => $R->get_param("usr")));
        $U->set_instance($R->get_param("instancia"));
        $canAccess = array("user","login");
    } else {
        $canAccess = $U->check_access($class, $method);
    }
    if ($canAccess) {
        echo include AJAX_CONTROLLER;
        exit();
    } else {
        echo "No puedes ejecutar esta funcion, consulta a tu administrador";
        exit();
    }
}

if (!$U->is_logged() && $R->get_param("L") != "login") {
    $Redirect=urlencode($R->get_server('REQUEST_URI'));
    header("Location: " . HTML_CONTROLLER . "/?L=login&m=notlogged&R=".$Redirect); // usuario no logueado 
    exit();
}

if (!$R->is_set("L")) { //enviar a home
    header("Location: " . HTML_CONTROLLER . "/?L=" . $U->get_home() . "&m=redirected"); //usuario logueado, a pagina default
    exit();
}

if ($R->get_param("L") == "login") { // permite siempre acceso a login
    $canAccess = array("page","login");
} else {
    $canAccess = $U->check_access("PAGE", $R->get_param("L"));
}

if ($U->is_logged() && $R->get_param("L") == "fileuploader") {
    include 'classes/fileuploader/index.php';
    exit();
}

if ($canAccess === false) {
    if ($U->is_logged()) {
        $HeaderMsjUser = "No tienes acceso a este sitio."; // usuario sin acceso al sitio
    } else {
        
    }
}

require_once 'html/header.php';




if ($canAccess) {
    include "html/" . $canAccess[1] . ".php";
}

require_once 'html/footer.php';
?>