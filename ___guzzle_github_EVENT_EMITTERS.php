<?php

require_once 'vendor/autoload.php';
use GuzzleHttp\Client;
use GuzzleHttp\Event;
use GuzzleHttp\Exception;


function get_time(){
    return time();
};


$github_api_token = '8f6bf8fa87e97ddc9c97a90de0ff111879ba8bdc';
$github_api_base_url = 'https://api.github.com';

$client = new Client();
$request = $client->createRequest('', '',[
    'config' => [
        'curl' =>
                [
                    CURLOPT_FRESH_CONNECT => TRUE
                ],
        ],
    
    'headers' => [
        'Cache-Control' => 'no-cache',
        //'User-Agent' => 'GUZZLE_CREATE_GITHUB_API_TOKEN',
        'Content-Type' => 'application/json'
        ],
    
    
    'auth' => ['token',$github_api_token],
    
    ]
);

// GET GITHUB API USER REPO JSON DATA
$request->setUrl($github_api_base_url.'/user');
$request->setMethod('GET');

$request->getEmitter()->on('complete', function (Event\CompleteEvent $e) {
        echo $e->getRequest();
        echo "\n";
        echo $e->getResponse();
});

$request->getEmitter()->on('error',function (Event\ErrorEvent $event) {
    echo 'request error from the api';
    echo "\n";
    echo $event->getResponse()->getBody()->getContents();
    echo "\n";
    echo "_______________________________________________";
    echo "\n";
});

try {
    $github_api_urls = json_decode($client->send($request)->getBody()->getContents());
} catch(Exception\ClientException $e){
    echo $e->getRequest();
    echo "\n";
    echo $e->getResponse();
}


//var_dump($github_api_urls);












?>