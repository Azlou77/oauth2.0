<?php
// Use dependencies commposer
require_once 'c:\\wamp64\\www\\oauth2.0\\MSGraph\\vendor\\autoload.php';
require_once 'c:\\wamp64\\www\\oauth2.0\\MSGraph\\GraphHelper.php';



// Use features MSGraph
use Microsoft\Graph\Graph;


// Load .env file
$dotenv = Dotenv\Dotenv::createImmutable('c:\\wamp64\\www\\oauth2.0\\MSGraph');
$dotenv->load();
$dotenv->required(['CLIENT_ID', 'TENANT_ID', 'GRAPH_USER_SCOPES']);

// Initialisze MS-Graph client authentification
GraphHelper::initializeGraphForAppOnlyAuth();
$graph = new Graph();

//Get the access token from MSGraph class
$token = GraphHelper::getAppOnlyToken();
    
//Set the access token to the GraphHelper class
$graph->setAccessToken($token);

