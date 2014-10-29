<?php
require_once   "../../../init.php";
require_once 'clases/division.php';
require_once "clases/user.php";
$u=$GLOBALS[UL]; // Cargar datos de usuario
if($u->status!="")
{
    echo $u->status. "- ".$_SERVER["PHP_SELF"];
    exit(0);
}
$htmlid=$_POST["htmlid"];
$defaultID=$_POST["defaultID"];
$DVALL= new DIVISION();
$DIVALL_v=$DVALL->list_all();
if($DIVALL_v==null)
    {
    echo "<div id=\"$htmlid\">No se encontraron direcciones.</div>";
    exit(0);
}
?>
<table>
    <td>
        <select id="<?=$htmlid;?>" class="multiselect_simple filter">
            <option value="null">Ninguno</option>
<?

$okL=false;
foreach($DIVALL_v as $d){
 if($d->get_prop("id")==$defaultID)
    {$selectO="SELECTED"; $okL=true;}
 else 
     $selectO="";
 ?>
            <option value="<?=$d->get_prop("id");?>" <?=$selectO;?>><?=$d->get_prop("nombre");?></option>
 <?
}
?>
        </select>
   </td>
</table>
<?
if(!$okL && is_numeric($defaultID))
    echo "error de direccion en db";
?>
