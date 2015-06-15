<?php

require_once 'vendor/autoload.php';

use GuzzleHttp\Client;

$api_url = 'https://api.github.com';

$client = new Client();

$response = $client->get($api_url);

$json_data = $response->getBody()->getContents();

$json_data_as_associative_arrays = json_decode(
	$response->getBody()->getContents(),
	true
);

//var_dump(json_decode($json_data));


$json_data_as_associative_arrays['current_user_url'];
//object are easier to read
// data->object->parent->child
//versus arrays
// array[obejct][parent][child]

$json_data_as_object = json_decode($json_data);

echo $json_data_as_object->current_user_url;




?>