<?php

require_once 'vendor/autoload.php';
use GuzzleHttp\Client;
use GuzzleHttp\Message\Request;

function get_time(){
    return time();
};


$github_api_token = '8f6bf8fa87e97ddc9c97a90de0ff111879ba8bdc';
$github_api_base_url = 'https://api.github.com';
$github_user_name = 'cntguzzle';
$github_user_password = 'jojo1125';


//"message": "This API can only be accessed with username and password Basic Auth",
//"documentation_url": "https://developer.github.com/v3/oauth_authorizations/#oauth-authorizations-api"




$client = new Client();
$request = $client->createRequest('', '',[
    'headers' => [
    'User-Agent' => 'GUZZLE_CREATE_GITHUB_API_TOKEN',
        'Content-Type' => 'application/json'
        ],
    'auth' => [$github_user_name,$github_user_password],  
    //'auth' => ['token',$github_api_token],
    //'body' => json_encode($github_api_token_paramaters)
    ]
);

// POST GITHUB API CREATE TOKEN FOR API ACCESS
$request->setUrl('https://api.github.com/authorizations');
$request->setMethod('GET');
$response = json_decode($client->send($request)->getBody()->getContents());


var_dump($response);






?>