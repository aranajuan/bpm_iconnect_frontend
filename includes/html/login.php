<?
    if(LOGIN_METHOD=="INTEGRATED"){
        echo "<script>var autologin=true;</script>";
    }else{
        echo "<script>var autologin=false;</script>";
    }
?>
<div style="width: 100%;text-align: center;padding-top:10px;padding-bottom:40px;">
    <div id="statusform" style="width: 100%;text-align: center;float:left;display:block;">
        <img src="img/loading.gif" height="50" width="50"><h2>Iniciando itracker</h2>
    </div>
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
                    Instancia:
                </td>
                <td>
                    <select id="instancia">
                        <?
                        foreach (explode(",", INSTANCES) as $I) {
                            echo "<option value=\"$I\">$I</option>";
                        }
                        ?>
                    </select>   
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

</div>