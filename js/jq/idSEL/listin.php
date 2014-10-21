<?php
require_once   "../../../init.php";
require_once 'clases/listin.php';
require_once "clases/user.php";
$u=$GLOBALS[UL]; // Cargar datos de usuario
if($u->status!="")
{
    echo $u->status. "- ".$_SERVER["PHP_SELF"];
    exit(0);
}
$htmlid=$_POST["htmlid"];
$defaultID=$_POST["defaultID"];
$LISTALL = new LISTIN();
$LISTALL_v=$LISTALL->list_all();

if($LISTALL_v==null)
    {
    echo "<div id=\"$htmlid\">No se encontraron listines.</div>";
    exit(0);
}
?>
<table>
    <td>
        <select id="<?=$htmlid;?>" class="multiselect_simple filter">
            <option value="null">Ninguno</option>
<?
$hiddenD="";
$okL=false;
foreach($LISTALL_v as $l){
 if($l->get_prop("id")==$defaultID)
    {$selectO="SELECTED"; $okL=true;}
 else 
     $selectO="";
 $hiddenD.='<input type="hidden" id="'.$htmlid.$l->get_prop("id").'TO" value="'.$l->get_prop("too").'" /><input type="hidden" id="'.$htmlid.$l->get_prop("id").'CC" value="'.$l->get_prop("cc").'" /> ';
 ?>
            <option value="<?=$l->get_prop("id");?>" <?=$selectO;?>><?=$l->get_prop("nombre");?></option>
 <?
}
?>
        </select>
   </td>
   <td>
       <?=$hiddenD;?>
       <img src="<?=HIMG_DIR."/b_tblimport.png";?>" title="detalles" class="img_lnk" onclick="details_<?=$htmlid;?>();" />
   </td>
</table>
<?
if(!$okL && is_numeric($defaultID))
    echo "error de listin en db";
?>
<script>
    function details_<?=$htmlid;?>(){
        var details="<b>TO: </b>"+$("#<?=$htmlid;?>"+$("#<?=$htmlid;?>").val()+"TO").val()+"<br /><b>CC: </b>"+$("#<?=$htmlid;?>"+$("#<?=$htmlid;?>").val()+"CC").val();
        alert_p(details, "Detalles");
    }
</script>