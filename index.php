<?php 
    require_once 'path.php';
    
    $path = "home";
    if(isset($_GET['path'])){
        $path =$_GET['path'];
    }
    LoadPath($path)->Print();
?>