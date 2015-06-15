<?php

require_once 'vendor/autoload.php';
use GuzzleHttp\Client;
use GuzzleHttp\Message\Request;

$base_url = 'http://httpbin.org';


$client = new Client();
//$client = Client(['base_url' => 'http://httpbin.org']);

//REQUEST REQUIRES 2 Default Values METHOD,URL - even if the values are NULL;
$request = new Request('','');
$request->setMethod('GET');
$request->setUrl($base_url.'/ip');

echo $client->send($request)->getBody()->getContents();



?>