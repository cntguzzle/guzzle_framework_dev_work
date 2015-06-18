<?php

require_once 'vendor/autoload.php';
use GuzzleHttp\Client;
use GuzzleHttp\Message\Request;

function get_time(){
    return time();
};


$github_user_name = 'cntguzzle____';
$github_user_password = 'jojo1125____';


$github_api_base_url = 'https://api.github.com';


$github_api_token_paramaters = array(
    'scopes' => [
        'repo',
        'public_repo',
        'gist',
        'delete_repo',
        'user'
        ],
    'note' => 'custom token made from the github api - '.get_time(),
    'note_url' => 'detailed note about the token - '.get_time()
    
);


//CREATE CLIENT AND REQUEST FOR GITHUB API URLS FOR CURRENT USER

$client = new Client();
$request = $client->createRequest('', '',[
    'headers' => [
    'User-Agent' => 'GUZZLE_CREATE_GITHUB_API_TOKEN',
        'Content-Type' => 'application/json'
        ],
    'auth' => [$github_user_name,$github_user_password],
    
    'body' => json_encode($github_api_token_paramaters)
    ]
);

// POST GITHUB API CREATE TOKEN FOR API ACCESS
$request->setUrl($github_api_base_url.'/authorizations');
$request->setMethod('POST');
$github_api_create_token = json_decode($client->send($request)->getBody()->getContents());

$github_api_token = $github_api_create_token->token;

var_dump($github_api_create_token->token);
var_dump($github_api_token);

?>