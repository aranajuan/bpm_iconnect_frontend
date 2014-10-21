<?php
require_once "../includes/init.php";
require_once "clases/db.php";
require_once "clases/user.php";
require_once "clases/tkt.php";

$u=$GLOBALS[UL]; // Cargar datos de usuario
if($u->status!="")
{
    echo $u->status. "- ".$_SERVER["PHP_SELF"];
    exit(0);
}

foreach($_GET as $nombre_campo => $valor)
   $postV [$nombre_campo ]= $valor ; 
foreach($_POST as $nombre_campo => $valor)
   $postV [$nombre_campo ]= $valor ;

if(!file_exists("codes/".$postV["rp"].".php")){
    echo "no se encuentra script";
    exit(0);
}


$ids=array();
$ssql= "select id from TBL_TICKETS where FA > ".$postV["desde"]." and FA< ".$postV["hasta"];
$db= new DATOS();
$db->loadRS($ssql);
$i=0;
$TKTS = array();
while($ii=$db->get_vector()){
    $TKT=new TKT();
    if($TKT->load_DB($ii[0])=="ok"){
        $TKTS[$i]=$TKT;
        $i++;
    }
}

include("codes/".$postV["rp"].".php");

?>