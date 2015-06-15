<?php

require_once 'vendor/autoload.php';
use GuzzleHttp\Client;
use GuzzleHttp\Message\Request;

function get_time(){
    return time();
};


$github_api_token = '9bba9840807a54bc23b8a467057b7443867ec4c3_____';
$github_api_base_url = 'https://api.github.com';
$github_api_repository_base_url = 'https://api.github.com/user/repos';

$github_repository_paramaters = array(
    'name' => 'repository_name_'.get_time(),
    'description' => 'repository_description_'.get_time(),
    
);


//CREATE CLIENT AND REQUEST FOR GITHUB API URLS FOR CURRENT USER

$client = new Client();
$request = $client->createRequest('', '',[
    'headers' => [
    'User-Agent' => 'GUZZLE_POST_REPOSITORY_API_DEMO',
        'Content-Type' => 'application/json'
        ],
    'auth' => ['token',$github_api_token],
    
    //'body' => json_encode($github_repository_paramaters)
    ]
);

// GET GITHUB API BASE URLS FOR REQUESTING USER URL PATHS
$request->setUrl($github_api_base_url);
$request->setMethod('GET');
$github_api_urls = json_decode($client->send($request)->getBody()->getContents());


// GET CURRENT USER URL GITHUB URL PATHS 
$request->setUrl($github_api_urls->current_user_url);
$request->setMethod('GET');
$github_api_user_urls = json_decode($client->send($request)->getBody()->getContents());
$github_api_user_name = $github_api_user_urls->login;
//var_dump($github_api_user_urls);

// GET USER REPO NAMES FOR URL PATHS TO POST-PUT DATA
$request->setUrl($github_api_user_urls->repos_url);
$request->setMethod('GET');
$github_api_user_repos = json_decode($client->send($request)->getBody()->getContents());

$github_api_user_repo_name = array();
foreach ($github_api_user_repos as $results){
    $github_api_user_repo_name[] = $results->name;
};

//var_dump($github_api_user_repo_name);



//PUT /repos/:owner/:repo/contents/:path

$file_name = 'file_name_'.get_time();
$file_content = 'file_content_'.get_time();

$github_gist_paramaters = array(
    'path' => $file_name,
    'message' => 'test_commit_message_'.get_time(),
    'content' => base64_encode($file_content),
    'branch' => 'master'
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




$request->setUrl($github_api_base_url.'/repos/'.$github_api_user_name.'/'.$github_api_user_repo_name[0].'/contents/'.$file_name);
$request->setMethod('PUT');

$github_api_put_into_repo = json_decode($client->send($request)->getBody()->getContents());
var_dump($github_api_put_into_repo);




/*
$request->setUrl($github_api_repository_base_url);
$request->setMethod('GET');

$response = $client->send($request);

var_dump(json_decode($response->getBody()->getContents()));
*/


?>