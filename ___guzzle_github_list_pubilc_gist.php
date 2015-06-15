<?php

require_once 'vendor/autoload.php';
use GuzzleHttp\Client;

//'?access_token='.$github_api_token

$github_api_token = '295398f3dc4da7da1eb717babf948179a91a0860';
$github_api_url = 'https://api.github.com/';
$github_user_name = 'cntguzzle';
$github_user_public_gists_url = $github_api_url.'users/'.$github_user_name.'/gists';


$client = new Client();
$responce = $client->get($github_user_public_gists_url);
$github_user_gist = json_decode(
    $responce->getBody()->getContents()
);

$github_user_public_gist_url = $github_user_gist[0]->url;


$responce = json_decode(
    $client->get($github_user_public_gist_url)->getBody()->getContents()
);

echo $github_user_public_gist_url.'?access_token='.$github_api_token;
//print_r($responce->description);

//$ curl -i -u username -d '{"scopes":["public_repo"]}' https://api.github.com/authorizations



?>