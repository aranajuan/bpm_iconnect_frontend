<?php
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING & ~E_DEPRECATED);
ini_set('display_errors', '1');

include_once 'defines.php';
require_once 'classes/logger.php';
include_once 'basic_functions.php';
include_once 'access.php';
require_once 'classes/htmlrequest.php';
require_once 'classes/user.php';

register_shutdown_function('finish');

?>