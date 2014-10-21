<?php

require_once '../../../init.php';
require_once 'clases/tree.php';

$t= new TREE();

echo count($t->user_files());
        
?>

