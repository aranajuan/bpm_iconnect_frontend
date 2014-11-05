<html>
    <head>
        <link rel="shortcut icon" href="http://dwin0292/itracker/favicon.ico"  type="image/x-icon" />
        <title>iTracker</title>

        <? require_once 'html/jsincludes.php'; // Jquery, css, UI, complementos JQ, js base ?>
        
    </head>
    <body style="background-color: white;">
        <div class="menuButton">
            <img src="img/base/menu_bt.png" />
        </div>
        <? require_once 'html/menu.php';?>
         <table id="main" class="status" cellpadding="0" cellspacing="0">
            <tr>
                <td class="main_bar">&nbsp;</td>
                <td class="main_content">
                    <table style="width: 100%;" cellpadding="0" cellspacing="0">
                        <tr>
                            <td ><img src='img/base/header.png'  style="display: block;" /></td>
                        </tr>
                        <tr>
                            <td class="main_content_TD">

                                <div id="ucontact_p" class="popup">
                                    Puede modificar aqu&iacute; sus datos de contacto.
                                    <table>
                                        <tr>
                                            <td>Mail:</td>
                                            <td><input id="txt_mail_ucontact" type="text" size="40" value="<?=$U->get_prop("mail");?>"/></td>
                                        </tr>
                                        <tr>
                                            <td>Telefono:</td>
                                            <td>
                                                <input id="txt_tel_ucontact" type="text" size="40" value="<?=$U->get_prop("telefono");?>" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <input id="details_ok_ucontact" type="button" class="button" value="guardar" />
                                                <input id="details_exit_ucontact" type="button" class="button" value="salir" />
                                            </td>
                                        </tr>
                                    </table> 
                                </div>
                                <div id="alert_p" class="popup"></div>
                                <div id="notice_p" style="width: 300px;display: none;"></div>
                                <div id="msjs" style="width: 900px;display: none;position:absolute;"></div>
                                <div id="information" style="width: 150px;display: none;position:absolute;margin-left:750px;margin-top:20px;"></div>
                                <br/>