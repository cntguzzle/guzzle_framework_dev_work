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



//https://en.wikipedia.org/wiki/List_of_HTTP_header_fields

$mailgun_api_key = 'key-4db46ae6718dbcd2ad0291c5f63180ef';

$mailgun_base_url = 'https://api.mailgun.net/v3/';
$mailgun_api_sandbox_domain = 'sandbox824ef93bc8ed47489786c74c77d86df6.mailgun.org';

$mailgun_api_sender_email_address = 'GitHub API Email <postmaster@sandbox824ef93bc8ed47489786c74c77d86df6.mailgun.org>';

$github_user_email_address = 'cnt+mailgun+demo@cntmedia.com';
$github_user_name = 'cntguzzle';
$github_user_password = 'jojo1125';


$github_api_base_url = 'https://api.github.com';


$github_api_token_paramaters = array(
	'scopes' => [
		'repo',
		'public_repo',
		'gist',
		'delete_repo',
		'user'
		],
	'note' => 'custom token made from the github api - '.get_time()
	//'note_url' => 'detailed note about the token - '.get_date_and_time()
);


//CREATE CLIENT AND REQUEST FOR GITHUB API URLS FOR CURRENT USER

$client = new Client();
$request = $client->createRequest('', '',[
	'headers' => [
	'User-Agent' => 'GUZZLE_CREATE_GITHUB_API_TOKEN',
		'Content-Type' => 'application/json'
		],
	'auth' => [$github_user_name,$github_user_password],
	
	'body' => json_encode($github_api_token_paramaters)
	]
);

// POST GITHUB API CREATE TOKEN FOR API ACCESS
$request->setUrl($github_api_base_url.'/authorizations');
$request->setMethod('POST');
$github_api_create_token = json_decode($client->send($request)->getBody()->getContents());

$github_api_token = $github_api_create_token->token;

var_dump($github_api_create_token->token);
var_dump($github_api_token);



$mailgun_api_email_paramaters = array(
	'from' => $mailgun_api_sender_email_address,
	'to' => $github_user_email_address,
	'subject' => 'GitHub API - New Token Created - API-TIMESTAMP-'.get_time(),
	'text' => 
		'GitHub API Token:'
		."\n"
		.'------------------------------------------------------------------'
		."\n"
		.$github_api_token
		."\n"
		.'------------------------------------------------------------------'
		."\n"
		.'Created On '
		.get_date_and_time()
);



//CREATE CLIENT AND REQUEST FOR MAILGUN TO SEND EMAIL

$client = new Client();

$URL = 'https://api.mailgun.net/v3/'.$mailgun_api_sandbox_domain.'/messages';

$request = $client->createRequest('','',[
	'headers' => [
		'User-Agent' => 'GUZZLE_PHP_DEMO',
		//'Content-Type' => 'application/x-www-form-encoded'
		'Content-Type' => 'multipart/form-data',
	],
	'auth' => ['api',$mailgun_api_key],
	'body' => $mailgun_api_email_paramaters
]);

$request->setMethod('POST');
$request->setUrl($mailgun_base_url.$mailgun_api_sandbox_domain.'/messages');

$mailgun_api_response = json_decode($client->send($request)->getBody()->getContents());

var_dump($mailgun_api_response);
 

 
?>