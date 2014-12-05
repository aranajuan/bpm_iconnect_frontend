<?php
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING & ~E_DEPRECATED);

ini_set('display_errors', '1');

preg_match('/MSIE (.*?);/', $_SERVER['HTTP_USER_AGENT'],$matches);

if (count($matches)>1){
  $version = $matches[1];
  if($version<10){
	echo "<img src='img/b_drop.png' /> Itracker requiere IE10 o superior. Recomendamos Google Chrome para un optimo funcionamiento.";
exit(0);
  }

}

include_once 'defines.php';
require_once 'classes/logger.php';
include_once 'basic_functions.php';
include_once 'access.php';
require_once 'classes/htmlrequest.php';
require_once 'classes/user.php';

register_shutdown_function('finish');

?>