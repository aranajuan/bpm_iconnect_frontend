        <div class="menu">
            <div>
                <?=$U->get_menu(); ?>
                <div class="menuUser" onclick="ucontact_p();">
                    <table >
                        <tr>
                            <td>
                                <img src="img/base/menu/but_user.png" />
                            </td>
                            <td>
                                <?echo $U->get_prop("nombre");?><br />
                                <?echo ucwords($U->get_prop("perfil"));?>   
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <br />
            <br />
        </div>