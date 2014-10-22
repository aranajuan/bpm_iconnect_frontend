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
        </table>
    </div>
    <input type="button" value="Login" id="login" />
    <div style="width: 50%;text-align: center;float:left;">
        
    </div>

</div>