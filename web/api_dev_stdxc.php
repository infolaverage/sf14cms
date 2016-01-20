<?php
$redirect_to_prod = true;

if (!in_array(@$_SERVER['REMOTE_ADDR'], array('127.0.0.1', '::1')))
{
    #die('You are not allowed to access this file. Check '.basename(__FILE__).' for more information.');
}

if(isset($_SERVER['REMOTE_ADDR']) && isset($_SERVER['SERVER_ADDR'])){
    if(
        (strpos($_SERVER['REMOTE_ADDR'], "10.1.2.2") === 0) ||
        (strpos($_SERVER['SERVER_ADDR'], "10.1.2.8") === 0)
    ) {
        $redirect_to_prod = false;
    }
}

if($redirect_to_prod){

    $dev_filename = "/".basename(__FILE__);
    #echo "red:".$redirect_to_prod;
    #echo "red:".$dev_filename ;
    #echo $_SERVER["REQUEST_URI"];
    #exit;

    if(strpos($_SERVER["REQUEST_URI"], $dev_filename) !== false){
        $new_uri = str_replace($dev_filename, "", $_SERVER["REQUEST_URI"]);
        $new = "http://".$_SERVER["SERVER_NAME"].$new_uri ;
        header('HTTP/1.1 301 Moved Permanently');
        header('Location: ' . $new);
        exit;
    }
}

require_once(__DIR__.'/../config/ProjectConfiguration.class.php');

$configuration = ProjectConfiguration::getApplicationConfiguration('api', 'dev', true);
sfContext::createInstance($configuration)->dispatch();
