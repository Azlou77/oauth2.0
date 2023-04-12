<?php

use GuzzleHttp\Client;
// Enable loading of Composer dependencies
require_once 'vendor/autoload.php';
require_once 'GraphHelper.php'


/*
    *PHP client currently doesn't have an authentication provider. 
    *You will need to handle// getting an access token. The following 
    *example demonstrates the client credential// OAuth flow and assumes 
    *that an administrator has consented to the application
*/

// Load .env file
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
$dotenv->required(['CLIENT_ID', 'GRAPH_USER_SCOPES', 'CLIENT_SECRET']);

//Get env variables
$clientId = 
$tenantId = $_ENV['TENANT_ID'];
$scopes = $_ENV['GRAPH_USER_SCOPES'];

//Instanciation of new Azure AD client with GuzzleHttp Client
$guzzle = new \GuzzleHttp\Client();
$url = 'https://login.microsoftonline.com/'. $tenantId . '/oauth2/token?api-version=1.0';
$token = json_decode($guzzle->post($url, [
    'form_params'=> [
        'client_id'=> $_ENV['CLIENT_ID'],
        'client_secret'=> $_ENV['CLIENT_SECRET'],
        'resource'=> 'https://graph.microsoft.com/',
        'grant_type'=> 'client_credentials',
    ],
])->getBody()->getContents());
$accessToken = $token->access_token;

// Create a new Graph client.$graph = newGraph();
$graph->setAccessToken($accessToken);

// Make a call to /me Graph resource.$user = $graph->createRequest("GET", "/me")
$user = $graph->createRequest("GET", "/me")
              ->setReturnType(Model\User::class)
              ->execute();




?>
<html>
<head>
    <title>PHP Graph Tutorial</title>
    <!-- Boosstrap style -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <!-- Boosstrap script -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
</head>
<body>
    <h1>PHP Graph Tutorial</h1>
    <p>Check the console for the output.</p>
    
</body>
</html>