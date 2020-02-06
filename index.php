<?php
session_start();
ob_start();

define('ROOT_DIR', realpath(dirname(__FILE__)) .'/');
define('APP_DIR', ROOT_DIR .'application/');
require(APP_DIR .'config/config.php');

define('BASE_URL', $config['base_url']);

require(ROOT_DIR .'system/view.php');
require(ROOT_DIR .'system/controller.php');
require(ROOT_DIR .'system/pip.php');

new run('pip');


?>