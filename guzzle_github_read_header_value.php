<?php

require_once 'vendor/autoload.php';

use GuzzleHttp\Client;

$api_url = 'https://api.github.com/';

$client = new Client();

$response = $client->get($api_url);

echo $response->getHeader('Server');

?>