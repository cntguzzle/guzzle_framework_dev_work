<?php

require_once 'vendor/autoload.php';

use GuzzleHttp\Client;

$client = new Client();

$client_url = 'https://api.duckduckgo.com/';

$search_term = 'query'; 

$response = $client->get($client_url,
    ['query' =>
        [
            'q' => $search_term,
            'format' => 'json'
        ]
    ]
);




// SET TO TRUE - TO RETURN AN ASSOICIATIVE ARRAY
$json_data = json_decode($response->getBody(),true);

//case sensitive array

print_r($json_data['RelatedTopics'][1]['Text']);

//print_r($json_data);


?>