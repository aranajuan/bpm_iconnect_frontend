<?

$datos=array();
$count=0;
foreach($TKTS as $TKT){
        $TKd=array();
        $TKd["id"]=$TKT->get_prop("id");
        $optsH = $TKT->get_tree_history();
        $oC=1;
        $last=null;
        foreach ($optsH as $o) {
                $last=$o;
                if(strtolower($o["title"])=="sistema"){
                    $TKd["sistema"]=$o["option"];
                }
                $TKd["tipificacion"].=$o["title"].": ".$o["option"]."<br/>";
                if($oC==3)
                    $TKd["tipificacioncorta"].=$o["option"]." / ";
                $oC++;
        }
        $TKd["tipificacioncorta"].=$last["option"]." / ";
        $TKd["FA"]=$TKT->get_prop("FA");
        $TKd["FB"]=$TKT->get_prop("FB");
        $TKd["usuario"]=$TKT->get_prop("usr_o")->get_prop("nombre"); //
        foreach($TKT->get_prop("usr_o")->get_prop("equiposobj") as $t){
            $TKd["equipoUA"].=$t->get_prop("nombre").";";
        }
        if($TKT->get_prop("equipo"))
            $TKd["equipo"]=$TKT->get_prop("equipo")->get_prop("nombre");
        else
            $TKd["equipo"]="";
        $TKd["status"]=$TKT->get_status();
        $TA=$TKT->get_first_tktH();
        if($TA)
            $TKd["detalle"]=$TA->get_prop("detalle");
        $posD=  strpos($TKd["detalle"], "DESCRIPCION:");
        if($posD)
            $TKd["detalle"]= substr($TKd["detalle"], $posD+12);
        else
            $TKd["detalle"]= "";
        $datos[$count]=$TKd;
        $count++;

}

?>
<table border="1">
    <tr>
        <td>
            nro de ticket
        </td>
        <td>
            sistema
        </td>
        <td>
            Tipificacion
        </td>
        <td>
            Tipificacion Corta
        </td>
        <td>
            fecha de registro
        </td>
        <td>
            Abierto Por
        </td>
        <td>
            equipo
        </td>
        <td>
            Area
        </td>
        <td>
            Estado
        </td>
        <td>
            Cerrado el
        </td>
        <td>
            Descripcion
        </td>
    </tr>
    <?
    foreach($datos as $el){
        
        ?>
        <tr>
        <td>
           <?=$el["id"];?>
        </td>
        <td>
            <?=$el["sistema"];?>
        </td>
        <td>
            <?=$el["tipificacion"];?>
        </td>
        <td>
            <?=$el["tipificacioncorta"];?>
        </td>
        <td>
            <?=$el["FA"];?>
        </td>
        <td>
            <?=$el["usuario"];?>
        </td>
        <td>
            <?=$el["equipoUA"];?>
        </td>
        <td>
            <?=$el["equipo"];?>
        </td>
        <td>
            <?=$el["status"][1];?>
        </td>
         <td>
            <?=$el["FB"];?>
        </td>
        <td>
            <?=$el["detalle"];?>
        </td>
    </tr>    
        <?
        
    }
    ?>
</table>