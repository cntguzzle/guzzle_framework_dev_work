<?php

require_once 'vendor/autoload.php';

use GuzzleHttp\Client;
use GuzzleHttp\Subscriber\Oauth\Oauth1;

$github_api_token = '1df9be7967f6ec006c4c332d3d05bc0308d80929';

$github_user_name = 'cntguzzle';

$github_repository_name = 'github-demo';
$github_api_url = 'https://api.github.com/user';

$client = new Client();

$response = $client->get($github_api_url.'?access_token='.$github_api_token);

$github_data = json_decode($response->getBody()->getContents());

echo $github_data->url;

?>