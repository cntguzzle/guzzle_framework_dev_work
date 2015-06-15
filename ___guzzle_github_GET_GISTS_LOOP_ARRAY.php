<?php

require_once 'vendor/autoload.php';
use GuzzleHttp\Client;
use GuzzleHttp\Message\Request;

function get_time(){
    return time();
};

$github_api_token = 'f72b8897e6e9bedc21d03102b190aa116dba6796';
$github_api_public_gist_url = 'https://api.github.com/gists/public';
$github_api_url = 'https://api.github.com/';

$client_header_parameters = array(
    'headers' => [
        'User-Agent' => 'GUZZLE_DEMO',
        'Content-Type' => 'application/json'
    ],
    'auth' => ['token',$github_api_token]
);


$client = new Client();



$request = $client->createRequest('GET','https://api.github.com/user',[
    'headers' => [
        'User-Agent' => 'GUZZLE_DEMO',
        'Content-Type' => 'application/json'
        ],
    'auth' => ['token',$github_api_token]
    ]
);



$response = $client->send($request);
$github_api_response = json_decode($response->getBody());

$github_user_name = $github_api_response->login;
$github_user_public_gists_url = $github_api_url.'users/'.$github_user_name.'/gists';

$response = $client->get($github_user_public_gists_url,$client_header_parameters);
$github_api_response = json_decode($response->getBody()->getContents(),true);

$gist_url_array = array();



foreach ($github_api_response as $results){
    $gist_url_array[] = $results["url"];
};

echo $gist_url_array[0];

//echo $github_api_response[0]['url'];





?>