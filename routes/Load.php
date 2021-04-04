<?php
$dir = __DIR__;

$files = glob($dir . '/pages/*.php');

foreach ($files as $file) {
    if (strpos($file, 'Load.php') === false) {
        require($file);   
    }
}
?>