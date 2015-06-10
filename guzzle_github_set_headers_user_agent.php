<?php

require_once 'vendor/autoload.php';

use GuzzleHttp\Client;
use CommerceGuys\Guzzle\Oauth2\Oauth2Subscriber;

$github_client_id = 'b840d406ccf0b65a559d';

$github_client_secret = 'd50b66c62622703d45cd073cee687c52e30dc4ea';

$github_api_token = '1df9be7967f6ec006c4c332d3d05bc0308d80929';

$github_user_name = 'cntguzzle';

$github_repository_name = 'github-demo';

$github_api_oauth_url = 'https://github.com/login/oauth/authorize';

$github_api_url = 'https://api.github.com/user';

$github_custom_app_user_agent = 'guzzle_demo';

$client = new Client();

$response = $client->get($github_api_oauth_url,[
    'headers' => [
        'User-Agent' => $github_custom_app_user_agent
    ]
]);





?>