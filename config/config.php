<?php
header('Content-Type: text/html; charset=utf-8');
/**
 * @doc Config File
 * @author chenyansheng
 * @date 2016-12-07
 */

define('SYSDIR', realpath(dirname(__FILE__).'/../')); 	//Base dir
define('SYSDIR_CLASS', SYSDIR . '/class/');	//Class dir
define('SYSDIR_INCLUDE', SYSDIR . '/include/');	//Include dir
define('SYSDIR_LOG', SYSDIR . '/log/');		//Log dir
define('SYSTEM_LOGS_FILE', 'run.log');		//Log file name

define('TIME_ZONE', 'PRC');  	//Timezone

define('SERVER_RUN_MODE', 1);       //Production: 0 | Development: 0

define('CRYPTO_TYPE', 1);		//See detail in Crypto.class.php
define('VERIFY_TYPE', 1);		//See detail in Crypto.class.php
define('APP_KEY', 'My_name_is_chenyansheng');		//AppKey for verify

require SYSDIR_INCLUDE . 'core.php';