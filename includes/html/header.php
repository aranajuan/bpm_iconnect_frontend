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
                                <div id="notice_p" style="width: 400px;display: none;">&nbsp;</div>
                                <div id="information_head" style="width: 510px; height: 10px;">
                                    <div id="information" style="width: 500px;display: none;">&nbsp;</div>
                                </div>
                                