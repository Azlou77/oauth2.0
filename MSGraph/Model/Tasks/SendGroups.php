<?php
// Use dependencies commposer
require_once 'vendor/autoload.php';
require_once 'GraphHelper.php';

// Use features MSGraph
use Microsoft\Graph\Graph;
use Microsoft\Graph\Model;

// Load .env file
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
$dotenv->required(['CLIENT_ID', 'TENANT_ID', 'GRAPH_USER_SCOPES']);

// Initialisze MS-Graph client authentification
GraphHelper::initializeGraphForAppOnlyAuth();
$graph = new Graph();

//Get the access token from MSGraph class
$token = GraphHelper::getAppOnlyToken();
    
//Set the access token to the GraphHelper class
$graph->setAccessToken($token);


// define variables and set to empty values
$newGroup = 
[
    // Set displayName
    "displayName" => "",

    // Set description
    "description" => "",

    // Set groupTypes
    "groupTypes" => [
        "Unified"
    ],

    // Set mailEnabled
    "mailEnabled" => true,

    // Set mailNickname
    "mailNickname" => "",

    // Set securityEnabled
    "securityEnabled" => false

];

// Check if the form if the method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") 
{

// Get POST values
$newGroup = 
[
    // Set displayName
    "displayName" => $_POST["displayName"],

    // Set description
    "description" => $_POST["description"],

    // Set groupTypes
    "groupTypes" => [
        "Unified"
    ],

    // Set mailEnabled
    "mailEnabled" => true,

    // Set mailNickname
    "mailNickname" => $_POST["mailNickname"],

    // Set securityEnabled
    "securityEnabled" => false
];


// Request to create groups
$request = $graph->createRequest("POST", "/groups")
    ->attachBody($newGroup)
    ->setReturnType(Model\Group::class)
    ->execute();

}
?>