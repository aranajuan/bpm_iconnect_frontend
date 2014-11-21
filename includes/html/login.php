<div style="width: 100%;text-align: center;padding-top:40px;padding-bottom:40px;">
    <div style="width: 49%;text-align: center;float:left;">
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
        </table>
    </div>
    <input type="button" value="Login" id="login" />
    <div style="width: 50%;text-align: center;float:left;">

    </div>

</div>