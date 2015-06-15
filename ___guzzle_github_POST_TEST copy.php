<?php

require_once 'vendor/autoload.php';
use GuzzleHttp\Client;
use GuzzleHttp\Message\Request;

function get_time(){
    return time();
};

$github_api_token = '295398f3dc4da7da1eb717babf948179a91a0860';


$request_body = array(
    'description' => ''.get_time(),
    'public' => true,
    'files' => ('file_name')
);
//file_name_'.get_time().'.txt'

$json_data = json_encode(
    array(
        'description' => ''.get_time(),
        'public' => true,
        'files' => array('file_name.txt' => array('content' => 'data inside the file'))
    )
);


/*
$request_body = array([
        'description' => 'description-'.get_time(),
        'public'    => true,
        'files' => array([
            'file_name' => array([
                'file_contents' => 'some data'
            ])
        ])
]);
*/

$json_string = '{"description": "'.get_time().'","public": true,"files": {"file_name.txt": {"content": "String file contents"}}}';




$client = new Client();

$request = $client->createRequest('POST', 'https://api.github.com/gists',[
    'headers' => [
    'User-Agent' => 'GUZZLE_DEMO',
    'Content-Type' => 'application/json'
    ],
    'auth' => ['token','295398f3dc4da7da1eb717babf948179a91a0860'],
    
    'body' => $json_data
        
    //WORKS
    //'body' => $json_string
    
    //NOT WORKING
    //'body' => $json_post_data
    //'body' => '{"description": "'.get_time().'","public": true,"files": {"file_name.txt": {"content": "String file contents"}}}'

]);



//$request->setHeader('User-Agent','GUZZLE_DEMO');

/*
echo json_encode([
    'description'=>get_time(),
    'public'=> true,
    'files' =>  array('file_name.txt')
    ]);
*/

// Debuging the JSON formating from the assotiive array
//echo json_encode($request_body);
//echo $json_data;
//echo "\n";
//echo $json_string;

$response = $client->send($request);
var_dump($response->getBody()->getContents());

// ---------------------------------------------------




//'body' => '{"description": "'.get_time().'","public": true,"files": {"file_name.txt": {"content": "String file contents"}}}'







//curl -v -H "Authorization: token 295398f3dc4da7da1eb717babf948179a91a0860" -d '{"description": "a gist for a user with token api call","public": true,"files": {"file1.txt": {"content": "String file contents"}}}' https://api.github.com/gists

?>