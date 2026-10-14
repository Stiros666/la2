<?php
if (PHP_SAPI !== 'cli') { http_response_code(404); exit; }
$root = dirname(__DIR__);
defined('YII_DEBUG') || define('YII_DEBUG', false);
require $root . '/protected/helpers/global.php';
require $root . '/vendor/autoload.php';
require $root . '/framework/yii.php';
$_SERVER['SERVER_NAME'] = 'localhost';
$_SERVER['HTTP_HOST'] = 'localhost';
$_SERVER['SERVER_PORT'] = 80;
$_SERVER['SCRIPT_NAME'] = '/index.php';
$_SERVER['SCRIPT_FILENAME'] = dirname($root) . '/index.php';
$_SERVER['REQUEST_URI'] = '/';
$_SERVER['REMOTE_ADDR'] = '127.0.0.1';
Yii::createWebApplication($root . '/protected/config/main.php');
