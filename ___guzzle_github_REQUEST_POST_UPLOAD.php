<?php

require_once 'vendor/autoload.php';
use GuzzleHttp\Client;
use GuzzleHttp\Message\Request;

function get_time(){
    return time();
};


$github_api_token = '01295690e06f4d57232de3d8442f29a271b5b0fa';

//GITHUB API requires a header USER-AGENT to be passed
//The value for the USER_AGENT can be any value execpt NULL.
$github_api_url = 'https://api.github.com';
$github_api_gist_base_url = 'https://api.github.com/gists';


$client = new Client();
$request = $client->createRequest(
        'GET',
        'https://api.github.com/',
        [
            'headers' =>
                [
                'User-Agent' => 'GUZZLE_DEMO',
                'Content-Type' => 'application/json'
                ],

            'auth' => ['token',$github_api_token]
        ]
);

$request->setUrl($github_api_url);
$github_api_urls = json_decode($client->send($request)->getBody()->getContents());

$request->setUrl($github_api_url.'/gists');

$github_api_gist_urls = json_decode($client->send($request)->getBody()->getContents());
$github_user_gist_urls = array();

foreach ($github_api_gist_urls as $github_gist_api_json_data){
    $github_user_gist_urls[] = $github_gist_api_json_data->url;
};


$request->setUrl($github_user_gist_urls[0]);
$request->setMethod('GET');
$github_user_gist_data = json_decode($client->send($request)->getBody()->getContents());

//<------------------------------------------------------------------------------------------->\\


$github_gist_paramaters = array(
    'description' => 'some new data added to the description - updated @ '.get_time(),
);

$request = $client->createRequest('', '',[
    'headers' => [
    'User-Agent' => 'GUZZLE_PATCH_API_DEMO',
        'Content-Type' => 'application/json'
        ],
    'auth' => ['token',$github_api_token],
    
    'body' => json_encode($github_gist_paramaters)
    ]
);

$request->setUrl($github_user_gist_urls[0]);
$request->setMethod('PATCH');

var_dump($client->send($request)->getBody()->getContents());



?>
