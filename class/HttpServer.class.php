<?php
/**
 * @doc HttpServer
 * @author chenyansheng
 * @date 2016-12-09
 */

class HttpServer {
	const E_OK = 1;
	const E_PARAMS_ERROR = 2;
	const E_TICKET_ERROR = 3;
	const E_ERROR = 10;
	
	/*
	 * Check params
	 */
	public function checkParams($ticket, $data) {
		if(empty($ticket) || empty($data)) {
			$ret = $this->returnParamsError();
			return $ret;
		}
		
		$Crypto = new Crypto();
		$verify = $Crypto->verify($ticket, $data);
		if($verify) {
			$ret = array(
					'result' => self::E_OK,
					'errorMsg' => '',
					'data' => ''
			);
			return $ret;
		} else {
			$ret = $this->returnTicketError();
			return $ret;
		}
	}
	
	/*
	 * Encode
	 */
	public function enCodePatams($data) {
		$Crypto = new Crypto();
		return $Crypto->enCode($data);
	}
	
	/*
	 * Decode
	 */
	public function deCodeParams($string) {
		$Crypto = new Crypto();
		return $Crypto->deCode($string);
	}
	
	/*
	 * Return result
	 */
	public function returnData($data) {
		$ret = array(
			'result' => self::E_OK,
			'errorMsg' => '',
			'data' => $data
		);
		return json_encode($ret);
	}
	
	public function returnOk() {
		$ret = array(
			'result' => self::E_OK,
			'errorMsg' => '',
			'data' => ''
		);
		return json_encode($ret);
	}
	
	public function returnError($error) {
		$ret = array(
			'result' => self::E_ERROR,
			'errorMsg' => $error,
			'data' => ''
		);
		return json_encode($ret);
	}
	

	/*
	 * Pararms error
	*/
	private function returnParamsError() {
		$ret = array(
			'result' => self::E_PARAMS_ERROR,
			'errorMsg' => 'params error',
			'data' => ''
		);
		_error('params error');
		return json_encode($ret);
	}
	
	/*
	 * Ticket error
	*/
	private function returnTicketError() {
		$ret = array(
			'result' => self::E_TICKET_ERROR,
			'errorMsg' => 'ticket error',
			'data' => ''
		);
		_error('ticket error');
		return json_encode($ret);
	}
}