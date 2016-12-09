<?php
/**
 * @doc Crypto
 * @author chenyansheng
 * @date 2016-12-08
 */

class Crypto {
	const CRYPTO_TYPE_1 = 1;
	const CRYPTO_TYPE_2 = 2;
	
	const VERIFY_TYPE_1 = 1;
	const VERIFY_TYPE_2 = 2;
	
	private $crypto_type = 1;		//Defalut: 1
	private $verity_type = 1;		//Default: 1
	
	/*
	 * Encode data array
	 */
	public function enCode($data) {
		switch ($this->crypto_type) {
			case self::CRYPTO_TYPE_1 :
				$en_code = $this->enCodeType_1($data);
				break;
			case self::CRYPTO_TYPE_2 :
				$en_code = $this->enCodeType_2($data);
				break;
		}
		return $en_code;
	}
	
	/*
	 * Decode string data
	 */
	public function deCode($string) {
		switch ($this->crypto_type) {
			case self::CRYPTO_TYPE_1 :
				$de_code = $this->deCodeType_1($string);
				break;
			case self::CRYPTO_TYPE_2 :
				$de_code = $this->deCodeType_2($string);
				break;
		}
		return $de_code;
	}
	
	/*
	 * Verify
	 */
	public function verify($ticket, $msg) {
		switch ($this->verity_type) {
			case self::VERIFY_TYPE_1 :
				$verfiy = $this->verifyType_1($ticket, $msg);
				break;
			case self::VERIFY_TYPE_2 :
				$verfiy = $this->verifyType_2($ticket, $msg);
				break;
		}
		return $verfiy;
	}
	
	/*
	 * Crypto encode | decode type 1
	 */
	private function enCodeType_1($data) {
		$encode = base64_encode(json_encode($data));
		return $encode;
	}
	private function deCodeType_1($string) {
		$decode = json_decode(base64_decode($string), true);
		return $decode;
	}
	
	/*
	 * Crypto encode | decode type 2
	 */
	private function enCodeType_2($data) {
		$encode = base64_encode(implode('||||', $data));
		return $encode;
	}
	private function deCodeType_2($string) {
		$decode = explode('||||', base64_decode($string));
		return $decode;
	}
	
	/*
	 * Verify type 1
	 */
	private function verifyType_1($ticket, $msg) {
		$sign = md5(APP_KEY . $msg);
		if($sign == $ticket) {
			return true;
		} else {
			return false;
		}
	}
	
	/*
	 * Verfiy type 2
	 */
	private function verifyType_2($ticket, $msg) {
		$sign = md5($msg . APP_KEY);
		if($sign == $ticket) {
			return  true;
		} else {
			return false;
		}
	}
	
}