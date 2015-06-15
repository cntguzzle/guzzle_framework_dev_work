<?php

require_once 'vendor/autoload.php';
use GuzzleHttp\Client;


$api_url = 'https://api.github.com';

$client = new GuzzleHttp\Client([
	'base_uri' => $api_url
]);

$client->get('/');

function get_client_useragent(){
	echo GuzzleHttp\Utils::getDefaultUserAgent();
}

function clear_client_cache(){
	\GuzzleHttp\Tests\Server::flush();
}

function current_client_url(){
	echo GuzzleHttp\Url::fromString($api_url);
}

echo $client->getBaseUrl();


?>