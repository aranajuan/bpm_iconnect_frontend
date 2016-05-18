<?php

define("INSTANCES","AGENTES");
define("VERSION","vx.x.x");
define("ERROR_REPORTINGCONST",E_ALL & ~E_NOTICE & ~E_WARNING & ~E_DEPRECATED);
// Configuraciones Base

define('BASE_DIR',realpath(dirname(realpath(dirname(__FILE__)).'/../../../')));
define('ROOT_DIR',BASE_DIR.'');
define("FRONT_NAME","DMZ");
define("FRONT_NAME_API","API_DMZ");
define("APLICATION_SERVER","http://localhost/itracker_app");
define('INCLUDE_DIR',ROOT_DIR."/includes"); 
define('AJAX_CONTROLLER',INCLUDE_DIR."/ajax/request.php"); 

define('HTML_CONTROLLER','https://t0002591816/itracker_front');


//time zone
date_default_timezone_set ( 'America/Argentina/Buenos_Aires' );

//adjuntos TKT
define("FILEUP_MAX_MB",50);
define("FILEUP_MAX_FILES",3);
define("FILEUP_MAX_FILES_SIZE",1024*1024*FILEUP_MAX_MB);
define("FILEUP_ALLOWED_FORMATS","jpe?g|png|xls|xlsx|pdf|ppt|pptx|pps|ppsx|doc|docx");
define("FILEUP_TMP_FOLDER","usertmp/fileuploader");

define("LOGIN_METHOD","USERPASS"); //INTEGRATED - USERPASS  
//(para integrated debe estar como front de confianza)
define("TRYMAX",50);
define("MAXSIMILARS",3);

define("TABLE_EMPTY","<div style=\"background-color:white;border: 1px solid #0A266B; padding:3px;margin-top:10px;width:150px;\">
        <img src=\"img/critic_icon.png\" /> <b>No hay registros</b>
    </div>");
define("MSJ_INFORMATION",'Itracker es ahora multisesion, <b>no te olvides de presionar salir antes de cerrar el navegador</b>');

define("USER_INACTIVE_TIME",30000);
        
?>
