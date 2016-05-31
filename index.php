<?php

require_once 'includes/utils/init.php'; // Configuraciones DB, Constantes, Direcciones
require_once "includes/classes/xmlhandler.php";

$R = new HtmlRequest();

/**
 * Fix host
 */
$rurl = explode('?',$R->get_server('REQUEST_URI'));
$rurl[0]=$R->get_server('HTTP_HOST').$rurl[0];

if (isset($_SERVER['HTTPS']) &&
    ($_SERVER['HTTPS'] == 'on' || $_SERVER['HTTPS'] == 1) ||
    isset($_SERVER['HTTP_X_FORWARDED_PROTO']) &&
    $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https') {
  $rurl[0] = 'https://'.$rurl[0];
}
else {
  $rurl[0] = 'http://'.$rurl[0];
}
if($rurl[0]!= (HTML_CONTROLLER.'/')){
    header("Location: " . HTML_CONTROLLER . '/?'.$rurl[1]);
    exit();
}

/* redirect for api */

if(trim($R->get_param("L"))=='api'){
    $docApi= new DOMDocument();
    try{
        $docApi->loadXML(trim(file_get_contents('php://input')));
        $xpath = new DOMXpath($docApi);
        $udate= array();
        $request= array();
        $udate["usr"]=$xpath->query('/itracker/header/usr')->item(0)->nodeValue;
        $udate["instancia"]=
                $xpath->query('/itracker/header/instance')->item(0)->nodeValue;
        $udate["hash"]=
                $xpath->query('/itracker/header/hash')->item(0)->nodeValue;
        $request["class"]=
                $xpath->query('/itracker/request/class')->item(0)->nodeValue;
        $request["method"]=
                $xpath->query('/itracker/request/method')->item(0)->nodeValue;
        $params = $xpath->query('/itracker/request/params/*');
        foreach ($params as $p){
            $request["params"][$p->nodeName]=$p->nodeValue;
        }
        $U = new USER();
        $U->load_vec($udate);
        $app = new XmlHandler();
        $app->setFrontName(FRONT_NAME_API);
        $app->load_params($U, $request["class"], $request["method"], $request["params"]);
        $app->send_request();
        echo $app->plain_response();
    } catch (Exception $e){
        echo "Error: ".$e->getMessage();
    }
    exit();
}

$U = new USER();
$U->load_session();

if ($R->get_param("L") == "logout") {
    /* No dejar esperando navegador */
    ignore_user_abort(true);
    $U->endSession();
    session_write_close();
    ob_start();
    header("Location: " . HTML_CONTROLLER . "/?L=login&m=loguedout");
    header("Connection: close");
    header("Content-Encoding: none\r\n");
    header("Content-Length: 0");
    ob_end_flush();
    ob_flush();
    flush();
    $U->logout();
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
        if (LOGIN_METHOD == "INTEGRATED") {
            $user_S = explode("\\", $_SERVER['AUTH_USER']);
            if ($user_S[0] == "TELECOM" || $user_S[0] == "CCPI") {
                $uleg = $user_S[1];
            } else {
                echo json_encode(array("type" => "array", "result" => "error", "detail" => "Error:no se puede reconocer al usuario." . print_r($user_S, true) . "-" . $_SERVER["REMOTE_ADDR"]));
                exit(0);
            }
            $U->load_vec(array("usr" => $uleg));
        } else {
            if ($U->get_try() >= TRYMAX) {
                if (!isset($_SESSION['captcha']) || $_SESSION['captcha'] != $R->get_param("captchatext")) {
                    echo json_encode(array("type" => "array", "result" => "error", "trycount" => $U->get_try(), "reload" => "true", "detail" => "Captcha invalido"));
                    unset($_SESSION['captcha']);
                    exit();
                }
            }
            unset($_SESSION['captcha']);
            $U->load_vec(array("usr" => $R->get_param("usr")));
        }
        $U->set_instance($R->get_param("instancia"));
        $canAccess = array("user", "login");
    } else {
        $canAccess = $U->check_access($class, $method);
    }
    if ($canAccess) {
        if($U->get_prop('superuser')==1){
            set_time_limit(12300);
        }else{
            set_time_limit(320);
        }
        if($R->get_param("longp")==1){
            session_write_close();
        }
        echo include AJAX_CONTROLLER;
        exit();
    } else {
        if ($U->is_logged()){
            echo "No puedes ejecutar esta funcion, consulta a tu administrador";
        }else{
            echo "La sesion ha sido cerrada. Vuelve a iniciar una <a href=\"".HTML_CONTROLLER."\">aqui</a>";
        }
        exit();
    }
}

if (!$U->is_logged() && $R->get_param("L") != "login") {
    $Redirect = urlencode($R->get_server('REQUEST_URI'));
    if($R->get_param("instancia") != null){
        header("Location: " . HTML_CONTROLLER . "/?L=login&instancia=".$R->get_param("instancia")."&m=notlogged&R=" . $Redirect); // usuario no logueado
    }else{
        header("Location: " . HTML_CONTROLLER . "/?L=login&m=notlogged&R=" . $Redirect); // usuario no logueado
    }
    exit();
}

if (!$R->is_set("L")) { //enviar a home
    header("Location: " . HTML_CONTROLLER . "/?L=" . $U->get_home() . "&m=redirected"); //usuario logueado, a pagina default
    exit();
}

if (in_array($R->get_param("L"), array("login", "submenu"))) { // permite siempre acceso a
    $canAccess = array("page", $R->get_param("L"));
} else {
    $canAccess = $U->check_access("PAGE", $R->get_param("L"));
    if(!$canAccess){
        $HeaderMsjUser = "Acceso denegado a PAGE / ".$R->get_param("L");
    }
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