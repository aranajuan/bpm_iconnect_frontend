<html>
    <head>
        <link rel="shortcut icon" href="favicon.ico"  type="image/x-icon" />
        <title>iconnect</title>

        <? require_once 'html/jsincludes.php'; // Jquery, css, UI, complementos JQ, js base ?>
        <? require_once 'html/menu.php'; ?>
        <meta charset="UTF-8">
    </head>
    <body style="background-color: white;">
        <table id="main" class="status" cellpadding="0" cellspacing="0" style="margin-top: 10px;">
            <tr>
                <td class="main_bar">&nbsp;</td>
                <td class="main_content">
                    <table style="width: 100%;" cellpadding="0" cellspacing="0">
                        <tr>
                            <td >
                            	<div style="float: left;" ><img src="img/base/biglogo.png" /></div>
                            	<div style="float: left;margin-top: 56px;margin-left: 190px;">
                            		<?=$menuTOP; ?>
                            	</div>
                            	<div style="float: right; width: 100px;">
                            		<div style="float:right;"><img alt="salir" src="img/base/logout.png" onclick="location.href='?L=logout'" onmouseover="$(this).attr('src','img/base/logout_over.png')" onmouseout="$(this).attr('src','img/base/logout.png')" style="cursor:pointer; "/></div>
                            		<div style="float:right;margin-top: 30px;"><img alt="logo" src="img/base/logo_red.png"/></div>
                            	</div>
                            	<br/>
                            </td>
                        </tr>
                        <tr>
                            <td class="main_content_TD">
                            	<?=$menuSUB;?>
                                <div id="alert_p" class="popup"></div>
                                <div id="notice_p" style="width: 400px;display: none;">&nbsp;</div>
                                <div id="information_head" style="width: 510px; height: 10px;">
                                    <div id="information" style="width: 500px;display: none;">&nbsp;</div>
                                </div>
				<div id="msjs" style="width: 500px;display: none;margin-top:10px">&nbsp;</div>
                                