<?php
require_once 'vendor/autoload.php';

use GuzzleHttp\Client;

$api_username = 'cntguzzle';
$api_base_url = 'https://api.github.com/users/';
$api_url = (
    $api_base_url.
    $api_username
);


$client = new Client([]);

$client_response = $client->get($api_url);
$client_responce_json_data = $client_response->getBody()->getContents();

$client_response_data = json_decode($client_responce_json_data);

echo $client_response_data->public_repos;


?>