<?php 
require_once 'routes/Load.php';

function LoadPath($path){
    $class = "\\routes\home";
    $arrayPath = explode("/",$path,2);
    if(count($arrayPath)>0){
        $c_path = "\\routes\\".$arrayPath[0];
        if (class_exists($c_path)) {
            $class = $c_path;
            if(count($arrayPath)>1){
                return new $class($arrayPath[1]);
            }
        }
    }
    return new $class($path);
}

?>