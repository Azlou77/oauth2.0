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
$newplanbuckets = 
[
    // Set name
    "name" => "",

    // Set plan id
    "planId" => "",

    // Set orderHint
    "orderHint" => " !",

];

// Check if the form if the method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") 
{

// Get POST values
$newplanbuckets = 
[
    // Set name
    "name" => $_POST["name"],

    // Set plan id
    "planId" => "A94Nset1eEy-nhtf2GrQvZgAH0Uf",

    // Set orderHint
    "orderHint" =>" !",
   
];


// Request to create buckets for a plan
$response = $graph->createRequest("POST", "/planner/buckets")
    ->attachBody($newplanbuckets)
    ->setReturnType(Model\PlannerBucket::class)
    ->execute();



}
?>