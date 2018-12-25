<?php
/**
 * Created by PhpStorm.
 * User: el3zahaby
 * Date: 11/26/18
 * Time: 8:30 PM
 */
// include all libraries from library folder
foreach(glob(base."app/lib/*") as $file){
    //require_once 'lib/debug.phar';
    require_once $file;
}