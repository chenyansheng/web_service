<?php
/**
 * @doc For test
 * @author chenyansheng
 * @date 2016-12-09
 */
require '../config/config.php';


$Crypto = new Crypto();
$data = array(
	1 => 'aaa',
	2 => 'bbb',
	3 => 'afklsj"fslk\f%sljf^jsjf)l'
);
$encode = $Crypto ->enCode($data);
$ticket = md5(APP_KEY . $encode);

$url = 'http://test.my.com/web_service/api/demo_api.php';
$params = array(
	'ticket' => $ticket,
	'data' => $encode,
);


$ch=curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
$return = curl_exec($ch);
curl_close($ch);
unset($ch);

print_r($return);
