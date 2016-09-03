
<?php 
    require_once '../models/Application.php'; 
    define('baseUrl',  "http://" . $_SERVER['SERVER_NAME'].'/');
?>
<?php
    $items=[];
    $target=isset($_REQUEST['option']) ? $_REQUEST['option'] : 'Default';
    $action=isset($_REQUEST['view']) ? $_REQUEST['view'] : 'index';
    $format=isset($_REQUEST['format']) ? $_REQUEST['format'] : 'html';
    $app=new Application(['target'=>$target,'action'=>$action,'format'=>$format]);
    $app->run();

?>
