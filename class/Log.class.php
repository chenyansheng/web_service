<?php
/**
 * @doc Log handle class
 * @author chenyansheng
 * @date 2016-12-08
 */

class Log {
	const TYPE_DEBUG = 1;
	const TYPE_INFO = 2;
	const TYPE_ERROR = 3;
	
	/*
	 * Print log by log level
	 */
	public function write($mix, $type) {
		switch ($type) {
			case self::TYPE_DEBUG :
				if(LOG_LEVEL <= self::TYPE_DEBUG) {
					$header = 'DEBUG';
					$this->_dumpLogMsg($header, $mix);
				}
				break;
			case self::TYPE_INFO :
				if(LOG_LEVEL <= self::TYPE_INFO) {
					$header = 'INFO';
					$this->_dumpLogMsg($header, $mix);
				}
				break;
			case self::TYPE_ERROR :
				if(LOG_LEVEL <= self::TYPE_ERROR) {
					$header = 'ERROR';
					$this->_dumpLogMsg($header, $mix);
				}
				break;
		}
	}
	
	/*
	 * Print log
	 */
	public function dumpLogMsg($header, $file_name, $line_no, $msg) {
		$msg2 = print_r($msg,true);
		$time = date('Y-m-d H:i:s');
		$str = "【{$header}】 | {$time} | {$file_name} | {$line_no} :\r\n{$msg2}\r\n";
	
		$log_file = SYSDIR_LOG. '/'. SYSTEM_LOGS_FILE;
		if( ! file_exists($log_file) ) {
			$handle = fopen($log_file, 'a');
			fclose($handle);
			chmod($log_file, 0777);
		}
	
		file_put_contents($log_file, $str, FILE_APPEND);
	}
	
	/*
	 * Print log
	 */
	private function _dumpLogMsg($header,$mix) {
		$debug = debug_backtrace();
		$trace = array_pop($debug);
		$file = $trace['file'];
		$this->dumpLogMsg($header, $file, $trace['line'], $mix);
	}
	
}