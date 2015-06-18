<?php

require_once 'vendor/autoload.php';
use GuzzleHttp\Client;
use GuzzleHttp\Message\Request;

function get_time(){
    return time();
};


$github_api_token = '8f6bf8fa87e97ddc9c97a90de0ff111879ba8bdc';
$github_api_base_url = 'https://api.github.com';

//"message": "This API can only be accessed with username and password Basic Auth",
//"documentation_url": "https://developer.github.com/v3/oauth_authorizations/#oauth-authorizations-api"




$client = new Client();
$request = $client->createRequest('', '',[
    'headers' => [
    'User-Agent' => 'GUZZLE_CREATE_GITHUB_API_TOKEN',
        'Content-Type' => 'application/json'
        ],
    'auth' => ['token',$github_api_token],
    //'body' => json_encode($github_api_token_paramaters)
    ]
);

// GET GITHUB API USER REPO JSON DATA
$request->setUrl($github_api_base_url.'/user/repos');
$request->setMethod('GET');

$github_api_user_repo_json_data = json_decode($client->send($request)->getBody()->getContents());


// GET GITHUB API USER REPO NAMES
$github_api_user_repo_names = array();

foreach ($github_api_user_repo_json_data as $user_repo){
    $github_api_user_repo_names[] = $user_repo->full_name;
};

var_dump($github_api_user_repo_names);
echo end($github_api_user_repo_names);






?>