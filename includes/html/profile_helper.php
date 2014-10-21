<?php
require 'includes/profiles.php';
$i=0;
?>
<table>
    
    <?
    foreach($access as $a){
        echo "<tr><td>$i</td><td>".$a[1]."</td><td>".$a[0]."</td></tr>";
        $i++;
    }
    ?>
    
</table>