<?

    $ssql="select * from TBL_ACCIONES";
    $db= new DATOS();
    $db->loadRS($ssql);
    
    function control_totext($param,$value){
        if($value==0 && $param!="habilita_perfiles") return NULL;
        
        switch($param){
            case "0":
                return NULL;
            case "habilita_t_propio":
                if($value==1)
                    return "* Debe estar tomado por vos";
                if($value==2)
                    return "* No debe estar tomado por vos ";
                break;
            case "habilita_tomado":
                if($value==1)
                    return "* Debe estar tomado";
                if($value==2)
                    return "* No debe estar tomado";
                break;
            case "habilita_perfiles":
                return "* Perfiles: ".$value;
                break;
            case "habilita_a_propio":
                if($value==1)
                    return "* Debe estar abierto por vos";
                if($value==2)
                    return "* No debe estar abierto por vos";
                break;
            case "habilita_abierto":
                if($value==1)
                    return "* Debe estar abierto";
                if($value==2)
                    return "* No debe estar abierto"; 
                break;
            case "habilita_equipo":
                if($value==1)
                    return "* Debe estar derivado a tu equipo";
                if($value==2)
                    return "* No debe estar derivado a tu equipo"; 
                break;  
            case "habilita_master":
                if($value==1)
                    return "* No debe estar anexado a otro ticket";
                if($value==2)
                    return "* Debe estar anexado a otro ticket";                
                break;
        }
        return NULL;
    }
  
?>

<div>
    <div><h2>HELP</h2></div>
</div>

<?
    while($ad=$db->get_vector()){
        $req="";
        foreach($ad as $param => $value){
        $txt = control_totext($param,$value);
        if($txt){
            $req .= $txt."<br/>";
        }
        }
        
        echo "<script>
        var ".$ad["nombre"]."= '".
        strToJava(
                "<b style='color:blue;font-size:15px;'>".$ad["nombre"]."</b>".
                "<div><b>requisitos:</b><br/>".
                $req.
                "</div>
                <div><b>accion:</b><br/>".
                $ad["descripcion"].
                "</div>"
        )."';
         </script>";
        echo option_button($ad["nombre"],200,0,"alert_p(".$ad["nombre"].",'INFO')")."<br/>";
}
?>