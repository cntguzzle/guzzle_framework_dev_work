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
$github_api_url = 'https://api.github.com/';

$url = 'http://httpbin.org';

$client = new Client();
$request = $client->createRequest('','');

$request->setUrl($url.'/headers');
$request->setMethod('GET');
$request->setHeader('User-Agent','GUZZLE_DEMO');
$request->setHeader('Content-Type','application/json');
$request->setHeader('auth',['token',$github_api_token]);

$response = $client->send($request)->getBody()->getContents();

$json_data = json_decode($response);
//JSON Data with DASHES requires {'name-of-dash-object'}
echo $json_data->headers->{'User-Agent'};
echo "\n";
var_dump($json_data);









// ----------------------------------------------


//$request->setHeader('user-agent', 'guzzle_demo');

//echo $client->send($request)->getBody()->getContents();
//https://api.github.com/gists/a9a40a4a6c0ce5dc2c0b

//$request->setMethod('DELETE');
//https://api.github.com/gists/88e18d135012bdda1656


?>
