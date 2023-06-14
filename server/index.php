<?php

if (!file_exists(__DIR__ . '/vendor/autoload.php')) {
  throw new Exception(sprintf('Please run "composer require google/apiclient:~2.0" in "%s"', __DIR__));
}
require_once __DIR__ . '/vendor/autoload.php';

$results = [];
$results['bedroom'] = loadBedRoom();
$results['livingroom'] = loadLivingRoom();
$results['bathroom'] = loadBathRoom();

echo json_encode($results);


$server   = 'dev.rightech.io';
$port     = 1883;
$clientId = 'vitaliy_urazov-alexandrovka';

$mqtt = new \PhpMqtt\Client\MqttClient($server, $port, $clientId);
$mqtt->connect();
$mqtt->publish( 'base/state/info', json_encode($results), 0, true);
$mqtt->disconnect();

function loadBedRoom(){
	$data = file_get_contents('http://192.168.0.14/sec/?pt=12&cmd=get');
	$res = parseTemp($data);
	$res[] = parseCO2("http://192.168.0.14/sec/?pt=0&cmd=get");
	return $res;
}
function loadLivingRoom(){
	$data = file_get_contents('http://192.168.0.14/sec/?pt=10&cmd=get');
	$res = parseTemp($data);
	$res[] = parseCO2("http://192.168.0.14/sec/?pt=1&cmd=get");
	return $res;
}
function loadBathRoom(){
	$data = file_get_contents('http://192.168.0.14/sec/?pt=6&cmd=get');
	$res = parseTemp($data);
	return $res;
}


function parseCO2($url){

	// 450 - чисто
	// >1000 - проветривать
	// >2500 - опасно

    $result = array();
    for ( $i = 0; $i < 5; $i++ )
	    $result[] = file_get_contents($url);

    sort($result);
    $fresult = round(($result[1] + $result[2] + $result[3]) / 3 * 6.4);
	return $fresult;
}


function parseTemp($str){
	// temp:22.99/hum:36.65
	
	preg_match('/temp:([\d\.]+)\/hum:([\d\.]+)/', $str, $matches, PREG_OFFSET_CAPTURE);
	
	//print_r($matches);
	return [$matches[1][0], $matches[2][0]];
}





/**

https://www.emqx.com/en/blog/how-to-use-mqtt-in-php

use \PhpMqtt\Client\MqttClient;
use \PhpMqtt\Client\ConnectionSettings;

$server   = 'broker.emqx.io';
$port     = 1883;
$clientId = rand(5, 15);
$username = 'emqx_user';
$password = 'public';
$clean_session = false;
$mqtt_version = MqttClient::MQTT_3_1_1;

$connectionSettings = (new ConnectionSettings)
  ->setUsername($username)
  ->setPassword($password)
  ->setKeepAliveInterval(60)
  ->setLastWillTopic('emqx/test/last-will')
  ->setLastWillMessage('client disconnect')
  ->setLastWillQualityOfService(1);


$mqtt = new MqttClient($server, $port, $clientId, $mqtt_version);

$mqtt->connect($connectionSettings, $clean_session);
printf("client connected\n");

$mqtt->subscribe('emqx/test', function ($topic, $message) {
    printf("Received message on topic [%s]: %s\n", $topic, $message);
}, 0);

for ($i = 0; $i< 10; $i++) {
  $payload = array(
    'protocol' => 'tcp',
    'date' => date('Y-m-d H:i:s'),
    'url' => 'https://github.com/emqx/MQTT-Client-Examples'
  );
  $mqtt->publish(
    // topic
    'emqx/test',
    // payload
    json_encode($payload),
    // qos
    0,
    // retain
    true
  );
  printf("msg $i send\n");
  sleep(1);
}

$mqtt->loop(true);

**/