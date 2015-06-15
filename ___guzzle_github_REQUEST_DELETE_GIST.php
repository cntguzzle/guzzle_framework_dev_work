<?php
/*
curl -v -H 'Authorization: token xxx' https://api.github.com

Look for the X-OAuth-Scopes response header which will have the list of scopes:

X-OAuth-Scopes: user, public_repo, repo, gist

However, to delete a repository, the token needs to have the delete_repo scope.

So, you need a token that has different scopes than the one you have. You can create such a token using the Authorizations API:

*/

require_once 'vendor/autoload.php';
use GuzzleHttp\Client;
use GuzzleHttp\Message\Request;

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
$request->setMethod('DELETE');
$client->send($request)->getBody()->getContents();

$request->setUrl($github_api_gist_base_url);
$request->setMethod('GET');
$updated_gist_urls = json_decode($client->send($request)->getBody()->getContents());


var_dump($updated_gist_urls);

//$request->setMethod('DELETE');
//https://api.github.com/gists/88e18d135012bdda1656


?>
