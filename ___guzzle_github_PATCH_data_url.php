
<?php

require_once 'vendor/autoload.php';
use GuzzleHttp\Client;
use GuzzleHttp\Message\Request;

//'?access_token='.$github_api_token

$github_api_token = '295398f3dc4da7da1eb717babf948179a91a0860';
$github_api_url = 'https://api.github.com/';
$github_user_name = 'cntguzzle';
$github_user_public_gists_url = $github_api_url.'users/'.$github_user_name.'/gists';

$patch_url = 'http://httpbin.org/patch';

function get_time(){
    return time();
};


$client = new Client();

$headers = [
    'Authorization' => 'token 295398f3dc4da7da1eb717babf948179a91a0860'
];

$json_body = array(
    'description' => 'description for the gist -'.get_time(),
    'public'    => true,
    'files' =>  [
        'file_name_'.get_time(),
        ['content' => 'content of the file'.get_time()]

    ]
);

$json_data = json_encode($json_body);
//$request = new Request('POST', 'https://api.github.com/gists');

$response = $client->post('https://api.github.com/gists',[
        'headers' => ['Authorization' => 'token 295398f3dc4da7da1eb717babf948179a91a0860'],
    );

var_dump($response);






/*
$request = $client->createRequest('POST','https://api.github.com/gists',
    ['json' => [
    'description' => 'description for the gist -'.get_time(),
    'public'    => true,
    'files' =>  [
    'file_name_'.get_time(),
        ['content' => 'content of the file'.get_time()]
        ]
    ],$headers
   ]
);

print_r($request->getBody()->getContents());

*/

//$request = new Request('POST','https://api.github.com/gists');

//$response = $request->setHeader('Authorization','token 295398f3dc4da7da1eb717babf948179a91a0860');






//('POST','https://api.github.com/gists',$headers,)














//$response = $client->get('http://httpbin.org/get')->getBody()->getContents();
//echo $response;

//curl -v -H "Authorization: token 295398f3dc4da7da1eb717babf948179a91a0860" -d '{"description": "a gist for a user with token api call","public": true,"files": {"file1.txt": {"content": "String file contents"}}}' https://api.github.com/gists

//$request = $client->post('https://api.github.com/gists');

/*
 *
 *
 *     'files' =>  ['file_name_'.get_time(),['content' => 'content of the file'.get_time()]],
    ],
 */
?>