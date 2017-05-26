<?php

session_start();
ob_start();
mb_internal_encoding("UTF-8");
date_default_timezone_set('Europe/Prague');
require('classes/AutoLoader.php');
spl_autoload_register('AutoLoader::load');

$MainClass = new MainClass();
$MainClass->mainMethod();