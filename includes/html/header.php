<html>
    <head>
        <link rel="shortcut icon" href="favicon.ico"  type="image/x-icon" />
        <title>iTracker</title>

        <? require_once 'html/jsincludes.php'; // Jquery, css, UI, complementos JQ, js base ?>
        <? require_once 'html/menu.php'; ?>
        <meta charset="UTF-8">
    </head>
    <body style="background-color: white;">
        <table id="main" class="status" cellpadding="0" cellspacing="0">
            <tr>
                <td class="main_bar">&nbsp;</td>
                <td class="main_content">
                    <table style="width: 100%;" cellpadding="0" cellspacing="0">
                        <tr>
                            <td >
                                <?=$menuTOP;?><br/>
                                <?=$menuSUB;?>
                            </td>
                        </tr>
                        <tr>
                            <td class="main_content_TD">
                                <div id="alert_p" class="popup"></div>
                                <div id="notice_p" style="width: 400px;display: none;"></div>
                                <div id="msjs" style="width: 400px;display: none;float: left;"></div>
                                <div id="information" style="width: 400px;display: none;"></div>
                                <? if($U->is_logged()){
                                    ?>
                                <div style="width: 900px;text-align: right;position: absolute;">
                                    <?
                                    echo "<b>".$U->get_prop("nombre")."</b>(".$U->get_prop("usr").")<br/>";
                                    echo $U->get_prop("instancia")."(".$U->get_prop("perfil").")<br/>";
                                    echo $U->get_prop("mail");
                                    ?>
                                </div>
                                <?
                                }
                                ?>
                                <br/>
                                