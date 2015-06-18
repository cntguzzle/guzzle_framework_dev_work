<?php

require_once 'vendor/autoload.php';
use GuzzleHttp\Client;
use GuzzleHttp\Message\Request;

function get_time(){
    return time();
};


function get_date_and_time(){
    date_default_timezone_set('America/Los_Angeles');
    
    $date_month_day_year = date('\(m/d/Y\)');
    $date_hour_seconds = date('h:i:A');
    $date_weekday_date = date('l \t\h\e jS');

    return
    $date_weekday_date
    .' @ '
    .$date_hour_seconds
    .' '
    .$date_month_day_year;
            
            
}






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

$meme_name = $meme_api_names[$meme_api_random_meme];



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
    ]
);


$request->setUrl($meme_api_url);
$request->setQuery([
    'meme' => $meme_name,
    'top' => '~~~~~~~ '.$meme_name.' ~~~~~~~',
    'bottom' => 'Meme Was Made On '.get_date_and_time()
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


$file_name = $meme_name.'-'.get_time().'.jpg';

$github_gist_paramaters = array(
    'path' => $file_name,
    'message' => $meme_name.' - Made This GitHub Commit @ '.get_date_and_time(),
    'content' => base64_encode($meme_image_response),
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


$request->setMethod('PUT');
$request->setUrl($github_api_user_repo_most_recently_created_url.'/contents/'.$file_name);

$github_api_put_into_repo = json_decode($client->send($request)->getBody()->getContents());
var_dump($github_api_put_into_repo);


?>