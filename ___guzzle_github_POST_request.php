<?php

require_once 'vendor/autoload.php';
use GuzzleHttp\Client;
use GuzzleHttp\Message\Request;

function get_time(){
    return time();
}

$url = 'http://httpbin.org/';
$github_api_token = '295398f3dc4da7da1eb717babf948179a91a0860';
$github_gist_api_url = 'https://api.github.com/gists';
$github_authorization_url = 'https://api.github.com/authorizations';

$json_body = array(
    'description' => 'description for the gist -'.get_time(),
    'public'    => true,
    'files' =>  [
        'file_name_'.get_time(),
        ['content' => 'content of the file'.get_time()]

    ]
);


$client = new GuzzleHttp\Client();

$response = $client->post(
    $github_gist_api_url,
    [
        //'debug' => true,
        'connect_timeout' => 10,
        
        //'query' => $json_body,
        
        'headers' => [
            //'User-Agent' => 'GUZZLE_DEMO',
            'Content-Type' => 'application/json',
            //'Accept' => 'application/json',
            //'Authorization' => 'token 295398f3dc4da7da1eb717babf948179a91a0860',
            //'token' => '295398f3dc4da7da1eb717babf948179a91a0860'
            ],
        //'auth' => ['cntguzzle','guzzle2015']
        'auth' => ['token','295398f3dc4da7da1eb717babf948179a91a0860']
    ]
);


echo $response->getBody()->getContents();



?>