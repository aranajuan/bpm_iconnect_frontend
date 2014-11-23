<?php

define("INSTANCES","AGENTES");

// Configuraciones Base

define('BASE_DIR',realpath(dirname(realpath(dirname(__FILE__)).'/../../../')));
define('ROOT_DIR',BASE_DIR.'');
define("FRONT_NAME","DMZ");
define("APLICATION_SERVER","http://localhost/itracker_app");
define('INCLUDE_DIR',ROOT_DIR."/includes"); 
define('AJAX_CONTROLLER',INCLUDE_DIR."/ajax/request.php"); 

define('HTML_CONTROLLER','https://190.175.110.1/itracker_front');


//time zone
date_default_timezone_set ( 'America/Argentina/Buenos_Aires' );

//adjuntos TKT
define("FILEUP_MAX_FILES",3);
define("FILEUP_MAX_FILES_SIZE",1024*1024*3);
define("FILEUP_ALLOWED_FORMATS","jpe?g|png|xls|xlsx|pdf");
define("FILEUP_TMP_FOLDER","usertmp/fileuploader");

define("TRYMAX",2);

define("TABLE_EMPTY","<div style=\"background-color:white;border: 1px solid #0A266B; padding:3px;margin-top:10px;width:150px;\">
        <img src=\"img/critic_icon.png\" /> <b>No hay registros</b>
    </div>");

ini_set('include_path',ini_get('include_path').'./'.PATH_SEPARATOR.INCLUDE_DIR);
?>
