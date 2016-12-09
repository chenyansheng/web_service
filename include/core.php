<?php
/**
 * @doc Global core
 * @author chenyansheng
 * @date 2016-12-08
 */

//Set timezone
date_default_timezone_set(TIME_ZONE);


//Magic function autoload class
function __autoload($className) {
	//Include some class where I need
	include(SYSDIR_CLASS . $className . ".class.php");
}


//Custom error and exception handler
function custom_error_handler($err_code, $err_msg, $err_file, $err_line) {
	$ExceptionHandle = new ExceptionHandle();
	$ExceptionHandle ->custom_error_handler($err_code, $err_msg, $err_file, $err_line);
}
function custom_exception_handler($e) {
	$ExceptionHandle = new ExceptionHandle();
	$ExceptionHandle->custom_exception_handler($e);
}
set_error_handler('custom_error_handler');
set_exception_handler("custom_exception_handler");


//Set log level by run mode
$Log = new Log();
switch (SERVER_RUN_MODE) {           //Production: 0 (default) | Development: 0
	case 1:
		define('LOG_LEVEL', $Log::TYPE_DEBUG);             //Log level  Debug: 1 | Info: 2 | Error: 3
		break;
	default:
		error_reporting(0);
		define('LOG_LEVEL', $Log::TYPE_ERROR);
		break;
}


//Print log function
function _debug($mix) {
	global $Log;
	$Log->write($mix, $Log::TYPE_DEBUG);
}
function _info($mix) {
	global $Log;
	$Log->write($mix, $Log::TYPE_INFO);
}
function _error($mix) {
	global $Log;
	$Log->write($mix, $Log::TYPE_ERROR);
}


//slash
function R($var, $defaultValue = "", $varType = "") {
	$Format = new Format();
	return $Format->slash($var, $defaultValue, $varType);
}