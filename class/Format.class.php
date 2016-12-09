<?php
/**
 * @doc Format
 * @author chenyansheng
 * @date 2016-12-07
 */

class Format {
	
	/*
	 * Slash data input
	 */
	public function slash($key, $defaultValue = "", $varType = "") {
		if (!$key) {
			throw new Exception('$item is empty! ');
		}

		$_tmp = isset($_POST[$key]) ? $_POST[$key] :
		(isset($_GET[$key]) ? $_GET[$key] : $defaultValue);
		
		$_tmp = $this->_slash($_tmp);

		if (!empty($varType)) settype($_tmp, $varType);
		
		return $_tmp;
	}
	
	private function _slash($var) {
		if (!is_array($var)) {
			$var = htmlspecialchars($var);
			if (!get_magic_quotes_gpc()) {
				$_tmp = trim($var);
			} else {
				$_tmp = stripslashes(trim($var));
			}
		} else {
			foreach ($var as $k => $v) {
				$_tmp[$k] = $this->_slash($v);
			}
		}
		return $_tmp;
	}
	
}