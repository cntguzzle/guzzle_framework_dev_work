<?php


require_once 'vendor/autoload.php';

use GuzzleHttp\Client;
use GuzzleHttp\Subscriber\Oauth\Oauth1;

$github_api_token = '58d477211e9fd15b99a9b6b67567d889f8da7763';

$github_user_name = 'cntguzzle';
$github_user_password = 'guzzle2015';

$github_repository_name = 'github-demo';
$github_api_url = 'https://api.github.com/';


$client = new Client();

$response = $client->get($github_api_url.'user',
    ['auth' => 
        [
            $github_user_name,
            $github_user_password
        ]
    ]
);

echo $response->getBody()->getContents();


?>