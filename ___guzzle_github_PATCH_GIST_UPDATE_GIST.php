<?php

require_once 'vendor/autoload.php';
use GuzzleHttp\Client;
use GuzzleHttp\Message\Request;

function get_time(){
    return time();
};

$github_api_token = '295398f3dc4da7da1eb717babf948179a91a0860';

$github_gist_parameters = array(
    'description' => ''.get_time(),
    'public' => true,
    'files' => array(
        'file_name_'.get_time().'.txt' => array(
            'content' => 'data inside the file')
        )
);

$client_header_parameters = array(
    'headers' => [
        'User-Agent' => 'GUZZLE_DEMO',
        'Content-Type' => 'application/json'
    ]
);


$json_data = json_encode($github_gist_parameters);


$client = new Client();




$request = $client->createRequest('POST', 'https://api.github.com/gists',[
    'headers' => [
    'User-Agent' => 'GUZZLE_DEMO',
        'Content-Type' => 'application/json'
        ],
    'auth' => ['token','295398f3dc4da7da1eb717babf948179a91a0860'],
    
    'body' => $json_data
    ]
);




$response = $client->send($request);
var_dump($response->getBody()->getContents());

?>