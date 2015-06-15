<?php

require_once 'vendor/autoload.php';
use GuzzleHttp\Client;


$github_url = 'https://api.github.com';
$github_org_name = 'twitter';
$github_org_url = 'https://api.github.com/orgs/'.$github_org_name;

$client = new Client([]);

$github_org_repos_url = $client->get($github_org_url);

echo $github_org_repos_url->getBody();


?>