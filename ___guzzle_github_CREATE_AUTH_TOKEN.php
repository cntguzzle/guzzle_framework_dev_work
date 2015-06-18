<?php

require_once 'vendor/autoload.php';
use GuzzleHttp\Client;
use GuzzleHttp\Message\Request;

function get_time(){
    return time();
};


$github_user_name = 'cntguzzle';
$github_user_password = 'jojo1125';


$github_api_base_url = 'https://api.github.com';


$github_api_token_paramaters = array(
    'scopes' => [
        'repo',
        'repo:status',
        'repo_deployment',
        'public_repo',
        'delete_repo',
        'user',
        'user:email',
        'user:follow',
        'admin:org',
        'write:org',
        'read:org',
        'admin:public_key',
        'write:public_key',
        'read:public_key',
        'admin:repo_hook',
        'write:repo_hook',
        'read:repo_hook',
        'admin:org_hook',
        'gist',
        'notifications'        
        ],
    'note' => 'Master API Token - Created @ '.get_time(),
    'note_url' => 'All options selected for API Access Testing - Created @ '.get_time()
    
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