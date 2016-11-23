<?php


if(defined('sqlfileloader_init_autoloader')){
    return;
}

define("sqlfileloader_init_autoloader", true);

require_once("SqlFileLoader/Converter.php");
require_once("SqlFileLoader/VideoFile.php");