<?php

require_once 'vendor/autoload.php';
use GuzzleHttp\Client;
use GuzzleHttp\Message\Request;

function get_time(){
    return time();
};


$github_api_token = '9bba9840807a54bc23b8a467057b7443867ec4c3___';
$github_api_url = 'https://api.github.com/user/repos';


$github_repository_paramaters = array(
    'name' => 'repository_name_'.get_time()
);



$client = new Client();

$request = $client->createRequest('', '',[
    'headers' => [
    'User-Agent' => 'GUZZLE_POST_REPOSITORY_API_DEMO',
        'Content-Type' => 'application/json'
        ],
    'auth' => ['token',$github_api_token],
    
    'body' => json_encode($github_repository_paramaters)
    ]
);

$request->setUrl($github_api_url);
$request->setMethod('POST');

$response = $client->send($request);

var_dump($response->getBody()->getContents());

?>