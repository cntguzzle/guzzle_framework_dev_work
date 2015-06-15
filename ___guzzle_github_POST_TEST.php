<?php

require_once 'vendor/autoload.php';
use GuzzleHttp\Client;
use GuzzleHttp\Message\Request;

function get_time(){
    return time();
};

$github_api_token = '01295690e06f4d57232de3d8442f29a271b5b0fa';

$github_gist_paramaters = array(
    'description' => ''.get_time(),
    'public' => true,
    'files' => array('file_name_'.get_time().'.txt' => array('content' => 'data inside the file'))
);


$client_headers = array(
    'headers' => [
    'User-Agent' => 'GUZZLE_DEMO',
    'Content-Type' => 'application/json'
    ],
    'auth' => ['token',$github_api_token]
);


$client_json_data = json_encode($github_gist_paramaters);


$client = new Client();

$request = $client->createRequest('POST', 'https://api.github.com/gists',[
    $client_headers,
    //$client_authentication,
    //'auth' => ['token',$github_api_token],
    'body' => $client_json_data 
    ]
);

//'auth' => ['token',$github_api_token]

$response = $client->send($request);
var_dump($response->getBody()->getContents());


?>