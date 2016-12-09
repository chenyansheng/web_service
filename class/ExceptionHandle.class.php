<?php
/**
 * @doc Exception handle class
 * @author chenyansheng
 * @date 2016-12-07
 */

class ExceptionHandle {
	//PHP error levels to string
	private $phpErrorLevelArr = array (
			E_ERROR => 'Error',
			E_WARNING => 'Warning',
			E_PARSE => 'Parsing Error',
			E_NOTICE => 'Notice',
			E_CORE_ERROR => 'Core Error',
			E_CORE_WARNING => 'Core Warning',
			E_COMPILE_ERROR => 'Compile Error',
			E_COMPILE_WARNING => 'Compile Warning',
			E_USER_ERROR => 'User Error',
			E_USER_WARNING => 'User Warning',
			E_USER_NOTICE => 'User Notice',
			E_STRICT => 'Runtime Notice'
	);
	
	private $log = false;
	
	function __construct() {
		$this->log = new Log();
	}
	
	
	/*
	 * Custom error handler
	*/
	public function custom_error_handler($err_code, $err_msg, $err_file, $err_line) {
		$phpErrorLevelArr = $this->phpErrorLevelArr;;
		$error_lvl = isset($phpErrorLevelArr[$err_code]) ? $phpErrorLevelArr[$err_code] : 'UNKNOWN'.$err_code;
		$_msg = $error_lvl . ': ' . $err_msg;
		if (($err_code & error_reporting()) == $err_code) {
			$header = 'CATCH_ERROR';
			$this->log->dumpLogMsg($header, $err_file, $err_line, $_msg);
		}
	}
	
	/*
	 * Custtom error Exception
	*/
	public function custom_exception_handler($e) {
		$err_file = $e->getFile();
		$err_line = $e ->getLine();
		$err_msg = $e ->getMessage();
		$header = 'CATCH_EXCEPTION';
		$this->log->dumpLogMsg($header, $err_file, $err_line, $err_msg);
	}
	
}