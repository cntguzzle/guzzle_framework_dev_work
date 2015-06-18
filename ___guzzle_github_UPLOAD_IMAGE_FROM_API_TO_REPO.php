<?php

require_once 'vendor/autoload.php';
use GuzzleHttp\Client;
use GuzzleHttp\Message\Request;

function get_time(){
    return time();
};

$meme_api_url = 'http://apimeme.com/meme';
$meme_api_names = array(
    'Sad Cat',
    'Business Cat',
    'Bad Advice Cat',
    'Hoody Cat',
    'Chemistry Cat',
    'Fat Cat',
    'First World Problems Cat',
    'Grumpy Cat',
    'I Should Buy A Boat Cat'
);

$meme_api_random_meme = array_rand($meme_api_names);



$github_api_token = '8f6bf8fa87e97ddc9c97a90de0ff111879ba8bdc';

$github_api_base_url = 'https://api.github.com';



$client = new Client();

$request = $client->createRequest('', '',[
    'config' => [
    'curl' =>
        [
            CURLOPT_FRESH_CONNECT => TRUE
        ],
    ],
    'headers' => [
    'User-Agent' => 'GUZZLE_API_DEMO',
        'Content-Type' => 'image/jpeg'
        ],
    //'auth' => ['token',$github_api_token],    
    //'body' => json_encode($github_gist_paramaters)
    ]
);


$request->setUrl($meme_api_url);
$request->setQuery([
    'meme' => 'Grumpy Cat',
    'top' => $m,.get_time(),
    'bottom' => 'bottom text '.get_time()

]);

$request->setMethod('GET');
$meme_image_response = $client->send($request)->getBody()->getContents();


//ADD CURL CONFIG KEY FOR AUTHORIZING GITHUB REQUEST
//NORMAL ADD CONFIG OPTION WAS NOT WORKING MANUAL
$request->getConfig()->set('curl',
        [
            CURLOPT_USERPWD => "token:$github_api_token"
        ]
);

//var_dump($request->getConfig());

//SET CONTENT TYPE TO JSON FOR GITHUB REQUEST
$request->setHeader('Content-Type','application/json');

//CHANGE URL TO GITHUB USER REPOS
$request->setUrl($github_api_base_url.'/user/repos');

//GET GITHUB REPO JSON DATA
$request->setMethod('GET');

$github_api_user_repo_json_data = json_decode($client->send($request)->getBody()->getContents());

// GET GITHUB API USER REPO URLS
$github_api_user_repo_urls = array();

foreach ($github_api_user_repo_json_data as $user_repo){
    $github_api_user_repo_urls[] = $user_repo->url;
};

$github_api_user_repo_most_recently_created_url = end($github_api_user_repo_urls);



$file_name = 'meme_'.get_time().'.jpg';

$github_gist_paramaters = array(
    'path' => $file_name,
    'message' => 'test_commit_message_'.get_time(),
    'content' => base64_encode($meme_image_response),
    'branch' => 'master'
);

$request->setBody(json_encode($github_gist_paramaters));

$request->setUrl($github_api_user_repo_most_recently_created_url.'/contents/'.$file_name);
$request->setMethod('PUT');

$github_api_put_into_repo = json_decode($client->send($request)->getBody()->getContents());
var_dump($github_api_put_into_repo);


?>