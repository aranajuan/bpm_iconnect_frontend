<?php
include_once 'includes/config/defines.php';

ini_set('include_path',ini_get('include_path').'./'.PATH_SEPARATOR.INCLUDE_DIR);

error_reporting(ERROR_REPORTINGCONST);

ini_set('display_errors', '1');

ini_set('post_max_size', FILEUP_MAX_MB.'M');
ini_set('upload_max_filesize', FILEUP_MAX_MB.'M');

preg_match('/MSIE (.*?);/', $_SERVER['HTTP_USER_AGENT'],$matches);

if (count($matches)>1){
  $version = $matches[1];
  if($version<10){
	echo "<img src='img/b_drop.png' /> Itracker requiere IE10 o superior. Recomendamos Google Chrome para un optimo funcionamiento.";
exit(0);
  }

}

require_once 'classes/logger.php';
include_once 'basic_functions.php';
include_once 'access.php';
require_once 'classes/htmlrequest.php';
require_once 'classes/user.php';

register_shutdown_function('finish');

?>