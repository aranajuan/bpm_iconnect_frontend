<?php
require_once 'includes/init.php'; // Configuraciones DB, Constantes, Direcciones
require_once 'clases/tkt.php';

$l = $GLOBALS[UL];

if ($_GET["internal"]) {
    $root = ROOT_DIR;
} else {
    $root = EXTERNAL_FILES;
}
$path = $root."/".$_GET["path"];
$file = $_GET["file"];
$fullfile=$_GET["fullfile"];
if(strtolower(substr($fullfile, 0, 4))=="http"){
    header("Location: ".$fullfile);
}
if($file==""){
    $expF=explode("/",$fullfile);
    $file=$expF[count($expF)-1];
    $path="";
    foreach($expF as $f){
        if($f!=$file){
            $path.="/".$f;
        }
    }
    $path=  $root."/".substr($path, 1);
}else{
    $fv = explode("_", $file);
    $TKT = new TKT();
    $TH = new TKT_H();
    if ($TH->load_DB($fv[0]) != "ok"){
        echo "Acceso denegado.(1)";
        exit(0);
    }
    if ($TKT->load_DB($TH->get_prop("idtkt")) != "ok"){
        echo "Acceso denegado.(2)";
        exit(0);
    }
    $view = $l->get_view($TKT);

    if(!$TH->check_access($view)){
        echo "Acceso denegado.(3)";
        exit(0);  
    }
}

if(!file_exists($path."/access.php"))
{
    echo "No se puede validar la descarga. Archivo invalido.";
    exit(0);
}
if(!file_exists($path."/".$file))
{
    echo "Archivo invalido.";
    exit(0);
}

require_once $path."/access.php";

if(!check($view)){
    echo "Acceso denegado.(4)";
    exit(0);
}

$ext = explode(".", $file);
if(in_array(strtolower($ext[count($ext)-1]),array("png","jpg","jpeg"))){
    header('Content-type: image/png');
}else{
    header ("Content-Disposition:attachment; filename= adjunto.".$ext[count($ext)-1]); 
    header ("Content-Type: application/octet-stream");
}

header ("Content-Length: ".filesize($path."/".$file));
readfile($path."/".$file);

?>