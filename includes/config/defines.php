<?php

define("INSTANCES","TELECOMCCT,AGENTESTP");

// Configuraciones Base

define('BASE_DIR',realpath(dirname(realpath(dirname(__FILE__)).'/../../../')));
define('ROOT_DIR',BASE_DIR.'');
define("FRONT_NAME","LOCAL");
define("APLICATION_SERVER","http://localhost/itracker_app");
define('INCLUDE_DIR',ROOT_DIR."/includes"); 
define('AJAX_CONTROLLER',INCLUDE_DIR."/ajax/request.php"); 

define('HTML_CONTROLLER','https://192.168.1.72/itracker_front');


//time zone
date_default_timezone_set ( 'America/Argentina/Buenos_Aires' );

//adjuntos TKT
define("FILEUP_MAX_FILES",3);
define("FILEUP_MAX_FILES_SIZE",1024*1024*3);
define("FILEUP_ALLOWED_FORMATS","jpe?g|png|xls|xlsx|pdf");
define("FILEUP_TMP_FOLDER","usertmp/fileuploader");


ini_set('include_path',ini_get('include_path').'./'.PATH_SEPARATOR.INCLUDE_DIR);
?>
