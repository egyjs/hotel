<?php
/**
 * Created by PhpStorm.
 * User: el3zahaby
 * Date: 11/23/18
 * Time: 2:57 PM
 */
session_start();


define('base','');
define('base_url',getenv('HTTP_HOST').'/');
define('path_config',base.'app/config.php');
include 'app/functions.php';
include 'app/core.php';
// route
$folder = "public";
$page = "index.php";



if(isset(explode("/",$_GET['data'])[0]) && explode("/",$_GET['data'])[0] != "") {
    $folder = explode("/",$_GET['data'])[0];
}
if (count(explode("/",$_GET['data']))>=0){
    $page = explode("/",$_GET['data'])[0].'.php';
    $folder = "public";

}

if(folder_exist(explode("/",$_GET['data'])[0]) ){
    if (explode("/",$_GET['data'])[0] != ""){
        $folder = explode("/",$_GET['data'])[0];
    }
    $page = "index.php";

}

if(isset(explode("/",$_GET['data'])[1]) && explode("/",$_GET['data'])[1] != "") {
    $page = explode("/",$_GET['data'])[1].'.php';
}

$assets = "//".base_url.$folder;


// includes
include path_config;
// var_dump($folder.'/'.$page);
if (file_exists($folder.'/'.$page)){
    require_once $folder.'/'.$page;
}else{
    http_response_code(404);
    include "404.php";
}
