<?php
/**
 * @doc For test api
 * @author chenyansheng
 * @date 2016-12-09
 */

require '../config/config.php';


$ticket = R('ticket');
$data = R('data');

$HttpServer = new HttpServer();
$check = $HttpServer->checkParams($ticket, $data);
if( ! isset($check['result']) || $check['result'] != $HttpServer::E_OK ) {
	echo $check;
	exit;
}

$decode_data = $HttpServer->deCodeParams($data);
print_r($decode_data);

if( empty($decode_data) ) {
	echo $HttpServer ->returnData("error");
} else {
	echo $HttpServer ->returnData("ok");
}
exit;