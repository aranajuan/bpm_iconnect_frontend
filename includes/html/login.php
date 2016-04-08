<?
    $instancesV=explode(",", INSTANCES);
    if(LOGIN_METHOD=="INTEGRATED"){
        if(count($instancesV)==1 && $R->get_param("m") != "loguedout"){
             echo "<script>
                 var autologin=true;
                 var instance='".$instancesV[0]."';
                 </script>";
        }elseif ($R->get_param("instancia") != null) {
              echo "<script>
                 var autologin=true;
                 var instance='".$R->get_param("instancia")."';
                 </script>";
        }else{
             echo "<script>var autologin=false;</script>";
        }
       
    }else{
        echo "<script>var autologin=false;</script>";
    }
?>
<div style="width: 100%;text-align: center;padding-top:10px;padding-bottom:40px;">
    <div id="statusform" style="width: 100%;text-align: center;float:left;display:block;">
        <img src="img/loading.gif" height="50" width="50"><h2>Iniciando itracker</h2>
    </div>
    <? if(LOGIN_METHOD=="INTEGRATED"){
        if(count($instancesV) > 1){
            echo "<div id=\"loginform\" style=\"display:none;\">
                <b>SELECCIONE UNA INSTANCIA DE ITRACKER</b>";
            echo "<div style=\"margin-left:300px;\">";
            foreach($instancesV as $ins){
                echo option_button($ins, 300, 0, "login('','','".$ins."',null,false)");
            }
            echo "</div>";
            echo "</div>";
        }else{
            echo "<div style=\"margin-left:300px;\">";
                echo option_button('Ingresar', 300, 0, "login('','','".$instancesV[0]."',null,false)");
            echo "</div>";
        }
    }else{?>
    <div id="loginform" style="width: 70%;text-align: center;float:left;display:none;">
        <table>
            <tr>
                <td>
                    Usuario:    
                </td>
                <td>
                    <input type="text" id="usr" size="10" />    
                </td>
            </tr>
            <tr>
                <td>
                    Contrase&ntilde;a:    
                </td>
                <td>
                    <input type="password" id="pass" size="10" />    
                </td>
            </tr>
            <tr>
                <td>
                    <?php if(count($instancesV) > 1){
                     echo 'Instancia:';
                    }
                    ?>
                </td>
                <td>
                    <?php if(count($instancesV) == 1){
                        echo '<input type="hidden" id="instancia" value="'.$instancesV[0].'" />';
                    }else{ ?>
                    <select id="instancia">
                        <?php
                        foreach ($instancesV as $I) {
                            echo "<option value=\"$I\">$I</option>";
                        }
                        ?>
                    </select>   
                    <?php }?>
                </td>
            </tr>
            <? if ($U->get_try() >= TRYMAX) { ?>
                <tr><td>Complete el captcha</td><td>
                        <img src="?L=captcha"  /><br/>
                        <input type='text' size='10' id='captchatext'/>
                    </td></tr>
                <tr><td>&nbsp;</td><td>
                        <a href="?L=login&m=recaptcha">Recargar captcha</a>
                    </td></tr>
            <? }
            ?>
                <tr>
                    <td>&nbsp;</td>
                    <td> <?= menu_button("Login", "doLogin()")?></td>
                </tr>
        </table>
        <br/>
    <br/>
    </div>
    <?}?>

</div>