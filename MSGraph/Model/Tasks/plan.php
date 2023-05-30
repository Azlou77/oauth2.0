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
$newplanList = 
[
   // Set container
    "container" => 
    [
         "url" => "",
    ],
    // Set owner
    "owner" => "",

    // Set title
    "title" => "",
];

// Check if the form if the method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") 
{

// Get POST values
$newplanList = 
[
   // Set container
    "container" => 
    [
         "url" => "https://graph.microsoft.com/v1.0/groups/c7f96311-8320-439a-8e5f-e29344265dee",
    ],
    // Set owner
    "owner" => "6bb6a1cd-2dee-4e34-ae0d-3e585b4918ab",
    // Set title
    "title" => $_POST["title"],
];


// Request to create planlist
$response = $graph->createRequest("POST", "/planner/plans")
    ->attachBody($newplanList)
    ->setReturnType(Model\PlannerPlan::class)
    ->execute();

}
?>